<?php

namespace App\Http\Controllers;

use App\Models\LogsDaily;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotifikasiController extends Controller
{
    public function getNotif(Request $request)
    {
        if($request->ajax()){
            // Contoh: hitung log status pending
            $user_position = Auth::user()->position;
            $user_role_name = Auth::user()->role->role_name;
            $angka = preg_replace('/[^0-9]/', '', $user_position);
            if (strlen($angka) > 0) {
                $roleget = "staff" . $angka[0];
            }
            // dd($user_role_name);
            if($user_role_name == 'admin'){
                $count = LogsDaily::where('log_status', 'pending')->count();
            }else if($user_role_name == 'kepaladinas'){
                $count = LogsDaily::select('logs_daily.log_status as log_status', 'logs_daily.id as id', 'logs_daily.nip as nip', 'users.name as name', 'users.position as position', 'logs_daily.log_detail as log_detail')->join('users', 'logs_daily.nip', '=', 'users.nip')
                ->join('roles', 'users.role_id', '=', 'roles.id')
                ->where('logs_daily.log_status', 'pending')
                ->where('roles.role_name', 'kepalabagian')->count();
            }else if($user_role_name == 'kepalabagian'){
                $count = LogsDaily::select('logs_daily.log_status as log_status', 'logs_daily.id as id', 'logs_daily.nip as nip', 'users.name as name', 'users.position as position', 'logs_daily.log_detail as log_detail')->join('users', 'logs_daily.nip', '=', 'users.nip')
                ->where('logs_daily.log_status', 'pending')
                ->where('users.position', $roleget)->count();
            }
            

            return response()->json([
                'status' => 1,
                'jumlah' => $count
            ]);
        }
    }
}
