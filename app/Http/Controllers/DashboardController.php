<?php

namespace App\Http\Controllers;

use DateTime;
use DataTables;
use App\Models\User;
use App\Models\Vote;
use App\Models\Config;
use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'user' => User::get()->count(),
            'candidate' => Candidate::get()->count(),
            'vote' => Vote::get()->count(),
            'config' => Config::first()
        ]);
    }
    
    public function voting_data()
    {
        return view('admin.votingdata');
    }
    public function get_voting(Request $request, Vote $vote)
    {
        if ($request->ajax()) {
            $data = $vote->get();
            return DataTables::of($data)->addIndexColumn()->addColumn('pemilih', function ($data)
            {
                return $data->user->name;
            })->addColumn('kandidat', function ($data){
                return $data->candidate->nama_calon.' - '.$data->candidate->nama_wakil_calon;
            })->addColumn('created_at', function ($data){
                return $data->created_at->format('d/M/Y-H:i');
            })->addColumn('updated_at', function ($data){
                return $data->updated_at->format('d/M/Y-H:i');
            })->rawColumns([''])->make(true);
        }
    }
    public function count_vote()
    {
        config()->set('database.connections.mysql.strict', false);
        DB::reconnect();
        $get = DB::table('votes')->join('candidates', 'votes.candidate_id', '=', 'candidates.id')->select(DB::raw('votes.candidate_id, candidates.nama_calon, candidates.nama_wakil_calon, candidates.foto, count(user_id) as jumlah'))->groupBy('votes.candidate_id')->orderByDesc('jumlah')->get();
        return response()->json($get);
    }
    public function count_voter()
    {
        return response()->json(Vote::get()->count());
    }
    
    public function configuration()
    {
        return view('admin.configuration', [
            'config' => Config::first()
        ]);
    }
    public function update_config(Request $request, Config $config)
    {
        if ($request->date_start <= $request->date_end) {
            if ($request->time_start < $request->time_end) {
                $time_rules = [
                    'date_start' => 'required',
                    'date_end' => 'required',
                    'time_start' => 'required',
                    'time_end' => 'required'
                ];
                $rules = [
                    'event_name' => 'required|min:6|max:100',
                    'location' => 'required|min:6|max:100'
                ];
                $request->validate($time_rules);
                $cred = $request->validate($rules);
                $cred['start'] = $request->date_start.' '.$request->time_start;
                $cred['end'] = $request->date_end.' '.$request->time_end;
                $update = $config->update($cred);
                if ($update) {
                    $config->touch();
                    $config->save();
                    return response()->json([
                        'success' => 'Konfigurasi Berhasil Diperbarui'
                    ]);
                }
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Waktu Mulai tidak boleh kurang dari Waktu Berakhir'
                ]);
            }
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Tanggal Mulai tidak boleh kurang dari Tanggal Berakhir'
            ]);
        }
    }
    public function update_announcement(Request $request, Config $config)
    {
        $rules = [
            'announcement' => 'required|min:6'
        ];
        $cred = $request->validate($rules);
        $update = $config->update($cred);
        if ($update) {
            $config->touch();
            $config->save();
            return response()->json([
                'success' => 'Pengumuman Berhasil Diperbarui'
            ]);
        }
    }
    public function resetUser()
    {
        if (auth()->guard('admin')->user()->is_super == 1) {
			DB::statement('SET FOREIGN_KEY_CHECKS=0;');
			User::truncate();
			DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            return response()->json([
                'success' => 'Data Pemilih Berhasil diReset'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'You have no authrization to do this !!'
            ]);
        }
        
    }
    public function resetCandidate()
    {
        if (auth()->guard('admin')->user()->is_super == 1) {
			$foto = Candidate::where('foto', '!=', 'default.png')->get()->pluck('foto');
			foreach ($foto as $ft) {
				Storage::disk('public')->delete('candidate/'.$ft);
			}
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
			Candidate::truncate();
			DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            return response()->json([
                'success' => 'Data Kandidat Berhasil diReset'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'You have no authrization to do this !!'
            ]);
        }
        
    }
    public function resetVote()
    {
        if (auth()->guard('admin')->user()->is_super == 1) {
            Vote::truncate();
            return response()->json([
                'success' => 'Data Voting Berhasil diReset'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'You have no authrization to do this !!'
            ]);
        }
        
    }
}
