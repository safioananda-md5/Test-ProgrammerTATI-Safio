<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        $users = Auth::user()->load('role');
        return view('dashboard.index', compact('users'));
    }
}
