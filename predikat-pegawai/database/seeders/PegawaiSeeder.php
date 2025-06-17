<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PegawaiSeeder extends Seeder
{
    public function run(): void
    {
        $namaPegawai = [
            'Andi Saputra',
            'Budi Santoso',
            'Citra Lestari',
            'Dewi Ayu',
            'Eko Prasetyo',
            'Fitriani Nur',
            'Gilang Ramadhan',
            'Hendra Wijaya',
            'Intan Permata',
            'Joko Susilo'
        ];

        foreach ($namaPegawai as $nama) {
            DB::table('employees')->insert([
                'nip' => str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT),
                'nama' => $nama,
                'hasil_kerja' => "",
                'perilaku' => "",
                'kinerja' => "",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
