<?php

namespace App\Http\Controllers;

use App\Models\employee;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class PredikatController extends Controller
{
    public function index(){
        return view('dashboard.index');
    }

    public function get_pegawai(Request $request){
        if($request->ajax()){
            $data = employee::all();

            return DataTables::of($data)
            ->editColumn('kinerja', function($row){
                if($row->kinerja == 'Sangat Baik'){
                    return '<span class="badge text-bg-success">'.$row->kinerja.'</span>';
                }else if($row->kinerja == 'Baik'){
                    return '<span class="badge text-bg-info">'.$row->kinerja.'</span>';
                }else if($row->kinerja == 'Butuh Perbaikan'){
                    return '<span class="badge text-bg-warning">'.$row->kinerja.'</span>';
                }else if($row->kinerja == 'Kurang'){
                    return '<span class="badge text-bg-primary">'.$row->kinerja.'</span>';
                }else{
                    return '<span class="badge bg-danger">'.$row->kinerja.'</span>';
                }
            })->addColumn('actions', function($row){
                return '
                    <div class="row mb-2 d-flex justify-content-center mx-2">
                        <button class="btn btn-warning btn-sm" data-id="'.$row->id.'" id="kinerja">Edit</button>
                    </div>
                ';
            })
            ->rawColumns(['actions', 'kinerja'])->make(true);
        }else{
            redirect('/');
        }
    }

    public function edit_pegawai(Request $request){
        $request->validate([
            'id' => 'required|integer',
            'kategori' => 'required|string',
            'status' => 'required|string',
        ]);
    }

    public function show($id)
    {
        if (!request()->ajax()) {
            return redirect(route('/'));
        }

        $log = employee::findOrFail($id);
        return response()->json($log);
    }

    public function input(Request $request){

        $request->validate([
                'hidden_id' => 'required|integer',
                'input_hasil_kerja' => 'required|string|in:diatas,sesuai,dibawah',
                'input_perilaku' => 'required|string|in:diatas,sesuai,dibawah',
        ]);

        $pegawai_id = $request->hidden_id;
        $pegawai = employee::findOrFail($pegawai_id);

        $hasil_kerja = $request->input_hasil_kerja;
        $perilaku = $request->input_perilaku;
        // dd($request->input_hasil_kerja);
        // dd($request->input_perilaku);
        if(($hasil_kerja == "diatas") && ($perilaku == "diatas")){
            $hasil = "Sangat Baik";
        }else if(($hasil_kerja == "diatas") && ($perilaku == "sesuai")){
            $hasil = "Baik";
        }else if(($hasil_kerja == "diatas") && ($perilaku == "dibawah")){
            $hasil = "Kurang";
        }else if(($hasil_kerja == "sesuai") && ($perilaku == "diatas")){
            $hasil = "Baik";
        }else if(($hasil_kerja == "sesuai") && ($perilaku == "sesuai")){
            $hasil = "Baik";
        }else if(($hasil_kerja == "sesuai") && ($perilaku == "dibawah")){
            $hasil = "Kurang";
        }else if(($hasil_kerja == "dibawah") && ($perilaku == "diatas")){
            $hasil = "Butuh Perbaikan";
        }else if(($hasil_kerja == "dibawah") && ($perilaku == "sesuai")){
            $hasil = "Butuh Perbaikan";
        }else{
            $hasil = "Sangat Kurang";
        }

        try {
            $pegawai->id = $pegawai_id;
            $pegawai->hasil_kerja = $hasil_kerja;
            $pegawai->perilaku = $perilaku;
            $pegawai->kinerja = $hasil;
            $save = $pegawai->save();
            return response()->json(['status'=>1, 'message'=>'Kinerja berhasil dikirim!']);
        } catch (QueryException $e) {
            return response()->json(['status'=>0, 'message'=>'Kinerja gagal dikirim!']);
        }
    }
}
