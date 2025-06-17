<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelloworldController extends Controller
{
    public function index(){
        return view('dashboard.index');
    }

    public function processing(Request $request){
        $for_loop = $request->number_input;
        return view('output.index', compact('for_loop'));
    }
}
