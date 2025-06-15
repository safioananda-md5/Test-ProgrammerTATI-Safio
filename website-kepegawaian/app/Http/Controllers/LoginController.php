<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    public function index(){
        if (Auth::check()) {
            return redirect('/dashboard'); // atau route sesuai role
        }
        return view('login.index');
    }

    public function login(Request $request)
    {   
        $credentials = $request->validate([
            'signin-nip' => 'required',
            'signin-password' => 'required'
        ]);

        $logindata = [
            'nip' => $credentials['signin-nip'],
            'password' => $credentials['signin-password']
        ];

        if (Auth::attempt($logindata)) {
            $request->session()->regenerate();
            return redirect('/dashboard');
        }

        Alert::error('Login Gagal', 'Data credential yang dimasukkan salah!')->autoclose(3000);
        return redirect('/login');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        Alert::toast('Berhasil melakukan logout.', 'success')->autoclose(3000);
        return redirect('/login');
    }
}
