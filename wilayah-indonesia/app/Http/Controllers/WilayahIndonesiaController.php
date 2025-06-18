<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProvinceResource;
use App\Models\District;
use App\Models\Province;
use App\Models\Regencies;
use App\Models\Village;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class WilayahIndonesiaController extends Controller
{
    public function ResetDatabase(){
         
        DB::table('provinces')->truncate();
        // DB::table('regencies')->truncate();
        // DB::table('districts')->truncate();
        // DB::table('villages')->truncate();

        $ambil_province = Http::get('https://wilayah.id/api/provinces.json');
        
        // Ambil province saja
        if ($ambil_province->successful()) {
            $data_province = $ambil_province->json()['data'];

            foreach ($data_province as $item_province) {
                $records_province[] = [
                    'code' => $item_province['code'],
                    'name' => $item_province['name'],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];
            }

            Province::insert($records_province);

            return response()->json([
                'status' => 1,
                'message' => 'Data provinsi indonesia berhasil direset pada database.'
            ]);
        }

        // Ambil Keseluruhan data, butuh waktu luaamaaa
        // -------------------------------------------
        // if ($ambil_province->successful()) {
        //     $data_province = $ambil_province->json()['data'];

        //     foreach ($data_province as $item_province) {
        //         $records_province[] = [
        //             'code' => $item_province['code'],
        //             'name' => $item_province['name']
        //         ];

        //         $ambil_regencies = Http::get('https://wilayah.id/api/regencies/'.$item_province['code'].'.json');

        //         if ($ambil_regencies->successful()) {
        //             $data_regencies = $ambil_regencies->json()['data'];
        //             foreach ($data_regencies as $item_regencies) {
        //                 $records_regencies[] = [
        //                     'code' => $item_regencies['code'],
        //                     'name' => $item_regencies['name']
        //                 ];

        //                 $ambil_districts = Http::get('https://wilayah.id/api/districts/'.$item_regencies['code'].'.json');

        //                 if ($ambil_districts->successful()) {
        //                     $data_districts = $ambil_districts->json()['data'];
        //                     foreach ($data_districts as $item_districts) {
        //                         $records_districts[] = [
        //                             'code' => $item_districts['code'],
        //                             'name' => $item_districts['name']
        //                         ];

        //                         $ambil_villages = Http::get('https://wilayah.id/api/villages/'.$item_districts['code'].'.json');
        //                         if ($ambil_villages->successful()) {
        //                             $data_villages = $ambil_villages->json()['data'];
        //                             foreach ($data_villages as $item_villages) {
        //                                 $records_villages[] = [
        //                                     'code' => $item_villages['code'],
        //                                     'name' => $item_villages['name'],
        //                                     'postal_code' => $item_villages['postal_code']
        //                                 ];
        //                             }
        //                         }
        //                     }
        //                 }
        //             }
        //         }
        //     }

        //     Province::insert($records_province);
        //     Regencies::insert($records_regencies);
        //     District::insert($records_districts);
        //     Village::insert($records_villages);

        //     // return response()->json($records_province);
        //     return response()->json([
        //         'status' => 1,
        //         'message' => 'Data wilayah indonesia berhasil disimpan ke database.'
        //     ]);
        // }

        // return response()->json($records_province);
        return response()->json([
            'status' => 0,
            'message' => 'Gagal mengambil data wilayah indonesia dari API wilayah.id'
        ], 500);
    }

    public function get_provinsi(){
        $data_province = Province::all();
        return ProvinceResource::collection($data_province);
    }

    public function detail_provinsi($code){
        $data_province = Province::where('code', $code)->firstOrFail();
        return new ProvinceResource($data_province);
    }

    public function create_provinsi(Request $request){
        $validator = Validator::make($request->all(), [
            'code' => 'required|unique:provinces,code',
            'name' => 'required'
        ],[
           'code.required' => 'Code Provinsi Wajib Diisi!',
           'code.unique' => 'Code Sudah Digunakan | Wajib Unik!',
           'name.required' => 'Nama Provinsi Wajib Diisi!'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'message' => 'Validasi gagal!',
                'errors' => $validator->errors()
            ]);
        }

        $data_province = $request->all();
        $data_province['created_at'] = Carbon::now();
        $data_province['updated_at'] = Carbon::now();

        Province::insert($data_province);
        return response()->json([
            'status' => 1,
            'message' => 'Data provinsi indonesia berhasil disimpan ke database.'
        ]);
    }

    public function update_provinsi(Request $request, $code){
        $validator = Validator::make($request->all(), [
            'code' => 'required|unique:provinces,code',
            'name' => 'required'
        ],[
           'code.required' => 'Code Provinsi Wajib Diisi!',
           'code.unique' => 'Code Sudah Digunakan | Wajib Unik!',
           'name.required' => 'Nama Provinsi Wajib Diisi!'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'message' => 'Validasi gagal!',
                'errors' => $validator->errors()
            ]);
        }

        $data_province = Province::where('code', $code)->firstOrFail();

        $data_update = $request->all();
        $data_update['updated_at'] = Carbon::now();
        $data_province->update($data_update);

        return response()->json([
            'status' => 1,
            'message' => 'Data provinsi indonesia berhasil diperbarui pada database.'
        ]);
    }

    public function delete_provinsi($code){
        $data_province = Province::where('code', $code)->firstOrFail();
        $data_province->delete();

        return response()->json([
            'status' => 1,
            'message' => 'Data provinsi indonesia berhasil dihapus pada database.'
        ]);
    }
}
