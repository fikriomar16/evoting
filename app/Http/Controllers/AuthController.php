<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function show_login()
    {
        return view('auth.login');
    }
    public function show_register()
    {
        return view('auth.register', [
            'profile' => new User
        ]);
    }
    public function check_login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required', 'min:6'],
        ]);
        if ($request->login_as) {
            $att_error = 'Username';
            if (auth()->guard('admin')->attempt($credentials)) {
                $request->session()->regenerate();
                return redirect()->intended('/dashboard')->with('success','Login Success, Welcome!!');
            } else {
                return back()->with('error', $att_error.' atau Password anda salah !!');
            }
        } else {
            $getUser = User::where('username',$credentials['username'])->first();
            $att_error = 'NIK ';
            if ($getUser) {
                if ($getUser['active'] == 0) {
                    return back()->with('error', 'Akun anda belum diaktifkan, Harap Hubungi Admin Untuk Mengaktifkan Akun !!');
                } else if (auth()->attempt($credentials)) {
                    $request->session()->regenerate();
                    return redirect()->intended('/')->with('success','Login Success, Welcome!!');
                } else {
                    return back()->with('error', $att_error.' atau Password anda salah !!');
                }
            } else {
                return back()->with('error', 'Terdapat Kesalahan, Pastikan Data Yang Anda Inputkan Benar');
            }
        }
    }
    public function check_register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:250',
            'username' => 'required|min:14|max:18|unique:users,username',
            'password' => 'required|min:6|max:100',
            'birth_date' => 'required'
        ]);
        $validated['password'] = bcrypt($request->password);
        $user = User::create($validated);
        if ($user) {
            // auth()->login($user);
            return redirect('/')->with('success', 'Berhasil Mendaftar, Selamat Datang '.$request->name);
        }
    }
    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success','Logout Successfully');
    }
    public function logout_admin()
    {
        auth()->guard('admin')->logout();
        session()->flush();
        return redirect('/')->with('success','Logout Successfully');
    }
}
