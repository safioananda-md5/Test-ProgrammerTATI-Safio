<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    public function index(){
        return view('login.index');
    }

    public function authenticate(Request $request){
        $loginData = $request->validate([
            'signin-nip' => 'required',
            'signin-password' => 'required'
        ]);

        $credentials = [
            'nip' => $loginData['signin-nip'],
            'password' => $loginData['signin-password']
        ];

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        Alert::error('Login Gagal', 'Data yang anda masukkan salah!');
        return back();
    }
}
