<?php

namespace App\Http\Controllers;

use App\Models\LogsDaily;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\User;
use Illuminate\Support\Facades\App;
use Yajra\DataTables\Facades\DataTables;

App::setLocale('id');
Carbon::setLocale('id');

class LogharianController extends Controller
{
    public function log_saya(){
        $today = Carbon::today();
        $userNip = Auth::user()->nip;

        $hasLogToday = LogsDaily::where('nip', $userNip)
            ->whereDate('created_at', $today)
            ->exists();

        $tanggalFormat = Carbon::now('Asia/Jakarta')->translatedFormat('l, d F Y');

        return view('log-harian.log-saya', [
            'hasLogToday' => $hasLogToday,
            'tanggalFormat' => $tanggalFormat
        ]);
    }

    public function log_manajemen(){
        return view('log-harian.log-manajemen');
    }

    public function store(Request $request){
        $request->validate([
            'log_harian'=>'required|min:30',
        ],[
            'log_harian.required'=>'Log harian wajib diisi!',
            'log_harian.min'=>'Log harian min 30 char.'
        ]);

        // dd($request->all());
        try {
            LogsDaily::create([
                'nip' => Auth::user()->nip,
                'log_detail' => $request->log_harian,
                'log_status' => 'pending',
            ]);

            return response()->json(['status'=>1, 'message'=>'Log harian berhasil dicatat.']);
        } catch (QueryException $e) {
            return response()->json(['status'=>0, 'message'=>'Log harian gagal dicatat!']);
        }
    }

    public function get(Request $request){
        if($request->ajax()){
            $data = LogsDaily::select(['id','log_detail','log_status','updated_at'])->orderBy('id', 'desc');
            return DataTables::of($data)
            ->editColumn('log_status', function($row) {
                if($row->log_status == 'pending'){
                    return '<span class="badge badge-secondary">'.$row->log_status.'</span>';
                }else if($row->log_status == 'disetujui'){
                    return '<span class="badge badge-success">'.$row->log_status.'</span>';
                }else{
                    return '<span class="badge badge-danger">'.$row->log_status.'</span>';
                }
            })
            ->editColumn('updated_at', function($row) {
                return Carbon::parse($row->updated_at)
                    ->locale('id') // set locale ke Bahasa Indonesia
                    ->translatedFormat('l, d F Y');
            })
            ->addColumn('actions', function($row){
                $updatedTime = Carbon::parse($row->updated_at);
                $now = Carbon::now();
                if ($updatedTime->diffInHours($now) < 12) {
                    return '
                        <button class="btn btn-warning btn-sm">Edit</button>
                        <button class="btn btn-danger btn-sm">Delete</button>
                    ';
                } else {
                    return '<span class="text-muted">Tidak dapat diubah</span>';
                }
            })->editColumn('log_detail', function($row) {
                $lines = preg_split('/\r\n|\r|\n/', $row->log_detail);
                $lines = array_filter(array_map('trim', $lines));
                $html = '<ol style="padding-left: 1rem; margin:0;">';
                foreach ($lines as $line) {
                    $cleanLine = preg_replace('/^\d+\.\s*/', '', $line);
                    $html .= '<li>' . e($cleanLine) . '</li>';
                }
                $html .= '</ol>';

                return $html;
            })
            ->rawColumns(['log_detail', 'log_status', 'actions'])->make(true);
        }
    }
}
