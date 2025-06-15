<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogharianController extends Controller
{
    public function index(){
        return view('log-harian.index');
    }

    public function create(Request $request){
        dd($request->all());
    }
}
