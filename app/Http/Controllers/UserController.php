<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Config;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Config $config)
    {
        return view('user.home', [
            'config' => $config->first()
        ]);
    }
    
    public function announcement(Config $config)
    {
        return view('user.announcement', [
            'config' => $config->first()
        ]);
    }
    
    public function voting(Config $config, Candidate $candidate)
    {
        $data = $config->first();
        $start = $data->start;
        $end = $data->end;
        $now = now()->format('Y-m-d H:i:s');
        if ($now < $start) {
            return view('user.wait', [
                'config' => $data
            ]);
        } else if ($now >= $start && $now <= $end) {
            return view('user.voting', [
                'config' => $data,
                'candidates' => $candidate->all()
            ]);
        } else {
            return view('user.timeover', [
                'config' => $data
            ]);
        }
    }
    
    public function result(Config $config)
    {
        $data = $config->first();
        $start = $data->start;
        $end = $data->end;
        $now = now()->format('Y-m-d H:i:s');
        if ($now < $start) {
            return back()->with('warning','Waktu Pemilihan Belum Dimulai !!');
        } else if ($now >= $start && $now <= $end) {
            return back()->with('warning','Waktu Pemilihan Masih Berjalan, Harap Tunggu Hingga Waktu Pemilihan Berakhir !!');
        } else {
            return view('user.result', [
                'config' => $data
            ]);
        }
    }
    
    public function profile()
    {
        return view('user.profile', [
            'profile' => auth()->user()
        ]);
    }
    
    public function update_profile(Request $request)
    {
        $rules = $request->validate([
            'name' => 'required|max:250',
            'birth_date' => 'required'
        ]);
        if ($request->username != auth()->user()->username) {
            $rules['username'] = 'required|min:14|max:255|unique:users,username';
        }
        if ($request->password != '') {
            $rules['password'] = 'required|min:6|max:100';
        }
        $user = User::find(auth()->user()->id);
        $user->update($rules);
        $user->touch();
        $user->save();
        return back()->with('success', 'Profile Updated Successfully');
    }
}
