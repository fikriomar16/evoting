<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Vote;
use Illuminate\Http\Request;

class GlobalController extends Controller
{
    public function fetchCandidate(Candidate $candidate)
    {
        return response()->json($candidate);
    }

    public function getToken()
    {
        return response()->json(['token'=>csrf_token()]);
    }

    public function select_candidate(Request $request, Candidate $candidate)
    {
        $userAgent = get_browser(null, true);
        Vote::where('candidate_id','')->delete();
        if (!Vote::find(auth()->id())) {
            $vote = Vote::create([
                'user_id' => auth()->id(),
                'candidate_id' => $candidate->id,
                'ip' => $request->ip(),
                'os' => $userAgent['platform'],
                'browser' => $userAgent['browser'].' '.$userAgent['version']
            ]);
            if ($vote) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Berhasil Memilih Kandidat. <br>Terima Kasih Banyak Telah Berpartisipasi !!'
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Terdapat Kesalahan !!'
                ]);
            }
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Anda Telah Memilih, Memilih Hanya Bisa Satu Kali !!'
            ]);
        }
    }
}
