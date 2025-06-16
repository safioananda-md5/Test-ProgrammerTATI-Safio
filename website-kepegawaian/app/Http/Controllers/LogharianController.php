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
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\Facades\DataTables;

App::setLocale('id');
Carbon::setLocale('id');

class LogharianController extends Controller
{
    public function log_saya(){
        $today = Carbon::today();
        $userNip = Auth::user()->nip;
        
        if(Auth::user()->role->role_name != 'admin'){
            $hasLogToday = LogsDaily::where('nip', $userNip)
            ->whereDate('created_at', $today)
            ->exists();

            $tanggalFormat = Carbon::now('Asia/Jakarta')->translatedFormat('l, d F Y');

            return view('log-harian.log-saya', [
                'hasLogToday' => $hasLogToday,
                'tanggalFormat' => $tanggalFormat
            ]);
        }else{
            return redirect('/dashboard');
        }
        
    }

    public function log_manajemen(){
        return view('log-harian.log-manajemen');
    }

    public function store(Request $request){
        if(Auth::user()->role->role_name != 'admin'){
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
    }

    public function get(Request $request){
        if($request->ajax()){
            $data = LogsDaily::select(['id','log_detail','log_status','updated_at','created_at'])->where('nip', Auth::user()->nip)->orderBy('id', 'desc');
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
                $createdTime = Carbon::parse($row->created_at);
                $now = Carbon::now();
                if ($createdTime->diffInHours($now) < 5) {
                    if($row->log_status == "pending"){
                        return '
                            <div class="flex-md-row flex-column gap-4">
                                <button class="btn btn-warning btn-sm mb-2 mb-md-0" id="tombolModal" data-id="'.$row->id.'">Edit</button>
                            </div>
                        ';
                    }else{
                        return '<span class="text-muted">Tidak dapat diubah</span>';
                    }
                    
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
        }else{
            return redirect(route('input-log-saya'));
        }
    }

    public function show($id)
    {
        if (!request()->ajax()) {
            return redirect(route('input-log-saya'));
        }

        $log = LogsDaily::findOrFail($id);
        return response()->json($log);
    }

    public function update(Request $request){
        if(Auth::user()->role->role_name != 'admin'){
            $request->validate([
                'hidden_id_log_edit' => 'required',
                'edit_log_harian' => 'required|min:30'
            ],[
                'edit_log_harian.required' => 'Log harian wajib diisi!',
                'edit_log_harian.min' => 'Log harian min 30 char.'
            ]);

            $log_id = $request->hidden_id_log_edit;
            $log = LogsDaily::findOrFail($log_id);

            // dd($request->all());

            $createdTime = Carbon::parse($log->created_at);
            $now = Carbon::now();
            
            if (($createdTime->diffInHours($now) >= 5) && ($log->nip !== Auth::user()->nip)) {
                return response()->json(['status'=>0, 'message'=>'Log harian gagal diperbarui!']);
            }else{
                try {
                    $log->id = $request->hidden_id_log_edit;
                    $log->log_detail = $request->edit_log_harian;
                    $save = $log->save();
                    return response()->json(['status'=>1, 'message'=>'Log harian berhasil diupdate.']);
                } catch (QueryException $e) {
                    return response()->json(['status'=>0, 'message'=>'Log harian gagal diupdate!']);
                }
            }
        }
    }

    public function get_log_pegawai(Request $request){
        if($request->ajax()){
            $data = LogsDaily::select('logs_daily.log_status as log_status', 'logs_daily.id as id', 'logs_daily.nip as nip', 'users.name as name', 'users.position as position', 'logs_daily.log_detail as log_detail', 'logs_daily.created_at as created_at')->join('users', 'logs_daily.nip', '=', 'users.nip')
            ->join('roles', 'users.role_id', '=', 'roles.id')
            ->where('roles.role_name', 'kepalabagian')
            ->orderByRaw("CASE WHEN logs_daily.log_status = 'pending' THEN 0 ELSE 1 END")
            ->orderBy('logs_daily.updated_at', 'asc');

            return DataTables::of($data)
            ->editColumn('created_at', function($row){
                return Carbon::parse($row->updated_at)
                    ->locale('id') // set locale ke Bahasa Indonesia
                    ->translatedFormat('l, d F Y');
            })
            ->addColumn('actions', function($row){
                if($row->log_status == "pending"){
                    return '
                        <div class="row mb-2 d-flex justify-content-center">
                            <button class="btn btn-success btn-sm" data-id="'.$row->id.'" id="btn_setujui_log">Setujui</button>
                        </div>
                        <div class="row d-flex justify-content-center">
                            <button class="btn btn-danger btn-sm" data-id="'.$row->id.'" id="btn_tolak_log">Tolak</button>
                        </div>
                    ';
                }elseif($row->log_status == "ditolak"){
                    return '
                        <div class="row mb-2 d-flex justify-content-center">
                            <span class="badge badge-danger">'.$row->log_status.'</span>
                        </div>
                    ';
                }else{
                    return '
                        <div class="row mb-2 d-flex justify-content-center">
                            <span class="badge badge-success">'.$row->log_status.'</span>
                        </div>
                    ';
                }
                
            })->rawColumns(['actions'])->make(true);
        }else{
            redirect('/dashboard');
        }
    }

    public function setujui_log_pegawai(Request $request){
        $log = LogsDaily::findOrFail($request->id);
        try {
            $log->id = $request->id;
            $log->log_status = "disetujui";
            $save = $log->save();
            return response()->json(['status'=>1, 'message'=>'Log harian berhasil disetujui.']);
        } catch (QueryException $e) {
            return response()->json(['status'=>0, 'message'=>'Log harian gagal disetujui!']);
        }
    }

    public function tolak_log_pegawai(Request $request){
        $log = LogsDaily::findOrFail($request->id);
        try {
            $log->id = $request->id;
            $log->log_status = "ditolak";
            $save = $log->save();
            return response()->json(['status'=>1, 'message'=>'Log harian berhasil disetujui.']);
        } catch (QueryException $e) {
            return response()->json(['status'=>0, 'message'=>'Log harian gagal disetujui!']);
        }
    }

    public function kepalabagian_get_log_pegawai(Request $request){
        if($request->ajax()){
            $user_position = Auth::user()->position;

            $angka = preg_replace('/[^0-9]/', '', $user_position);
            
            $roleget = "staff".$angka[0];
            
            $data = LogsDaily::select('logs_daily.log_status as log_status', 'logs_daily.id as id', 'logs_daily.nip as nip', 'users.name as name', 'users.position as position', 'logs_daily.log_detail as log_detail','logs_daily.created_at as created_at')
            ->join('users', 'logs_daily.nip', '=', 'users.nip')
            ->where('users.position', $roleget)
            ->orderByRaw("CASE WHEN logs_daily.log_status = 'pending' THEN 0 ELSE 1 END")
            ->orderBy('logs_daily.updated_at', 'asc');

            return DataTables::of($data)
            ->editColumn('created_at', function($row){
                return Carbon::parse($row->updated_at)
                    ->locale('id') // set locale ke Bahasa Indonesia
                    ->translatedFormat('l, d F Y');
            })
            ->addColumn('actions', function($row){
                if($row->log_status == "pending"){
                    return '
                        <div class="row mb-2 d-flex justify-content-center">
                            <button class="btn btn-success btn-sm" data-id="'.$row->id.'" id="btn_setujui_log">Setujui</button>
                        </div>
                        <div class="row d-flex justify-content-center">
                            <button class="btn btn-danger btn-sm" data-id="'.$row->id.'" id="btn_tolak_log">Tolak</button>
                        </div>
                    ';
                }elseif($row->log_status == "ditolak"){
                    return '
                        <div class="row mb-2 d-flex justify-content-center">
                            <span class="badge badge-danger">'.$row->log_status.'</span>
                        </div>
                    ';
                }else{
                    return '
                        <div class="row mb-2 d-flex justify-content-center">
                            <span class="badge badge-success">'.$row->log_status.'</span>
                        </div>
                    ';
                }
                
            })->rawColumns(['actions'])->make(true);
        }
    }

    public function kepalabagian_setujui_log_pegawai(Request $request){
        $log = LogsDaily::findOrFail($request->id);
        try {
            $log->id = $request->id;
            $log->log_status = "disetujui";
            $save = $log->save();
            return response()->json(['status'=>1, 'message'=>'Log harian berhasil disetujui.']);
        } catch (QueryException $e) {
            return response()->json(['status'=>0, 'message'=>'Log harian gagal disetujui!']);
        }
    } 

    public function kepalabagian_tolak_log_pegawai(Request $request){
        $log = LogsDaily::findOrFail($request->id);
        try {
            $log->id = $request->id;
            $log->log_status = "ditolak";
            $save = $log->save();
            return response()->json(['status'=>1, 'message'=>'Log harian berhasil disetujui.']);
        } catch (QueryException $e) {
            return response()->json(['status'=>0, 'message'=>'Log harian gagal disetujui!']);
        }
    }

    public function admin_get_log_pegawai(Request $request){
        if($request->ajax()){            
            $data = LogsDaily::select('logs_daily.log_status as log_status', 'logs_daily.id as id', 'logs_daily.nip as nip', 'users.name as name', 'users.position as position', 'logs_daily.log_detail as log_detail', 'logs_daily.created_at as created_at')
            ->join('users', 'logs_daily.nip', '=', 'users.nip')
            ->orderByRaw("CASE WHEN logs_daily.log_status = 'pending' THEN 0 ELSE 1 END")
            ->orderBy('logs_daily.updated_at', 'asc');

            return DataTables::of($data)
            ->editColumn('created_at', function($row){
                return Carbon::parse($row->updated_at)
                    ->locale('id') // set locale ke Bahasa Indonesia
                    ->translatedFormat('l, d F Y');
            })
            ->editColumn('name', function($row){
                if($row->log_status == "pending"){
                    return $row->name.' <span class="badge badge-secondary">'.$row->log_status.'</span>';
                }else if($row->log_status == "disetujui"){
                    return $row->name.' <span class="badge badge-success">'.$row->log_status.'</span>';
                }else{
                    return $row->name.' <span class="badge badge-danger">'.$row->log_status.'</span>';
                }
            })
            ->addColumn('actions', function($row){
                return '
                    <div class="row mb-2 d-flex justify-content-center">
                        <button class="btn btn-success btn-sm" data-id="'.$row->id.'" id="btn_setujui_log">Setujui</button>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <button class="btn btn-danger btn-sm" data-id="'.$row->id.'" id="btn_tolak_log">Tolak</button>
                    </div>
                ';
            })->rawColumns(['actions', 'name'])->make(true);
        }
    }

    public function admin_setujui_log_pegawai(Request $request){
        $log = LogsDaily::findOrFail($request->id);
        try {
            $log->id = $request->id;
            $log->log_status = "disetujui";
            $save = $log->save();
            return response()->json(['status'=>1, 'message'=>'Log harian berhasil disetujui.']);
        } catch (QueryException $e) {
            return response()->json(['status'=>0, 'message'=>'Log harian gagal disetujui!']);
        }
    }

    public function admin_tolak_log_pegawai(Request $request){
        $log = LogsDaily::findOrFail($request->id);
        try {
            $log->id = $request->id;
            $log->log_status = "ditolak";
            $save = $log->save();
            return response()->json(['status'=>1, 'message'=>'Log harian berhasil disetujui.']);
        } catch (QueryException $e) {
            return response()->json(['status'=>0, 'message'=>'Log harian gagal disetujui!']);
        }
    }
}
