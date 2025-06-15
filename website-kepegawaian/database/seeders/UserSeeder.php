<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
           
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'role_id'=>1,
                'name' => 'Administrator',
                'nip' => '99999999',
                'password' => Hash::make('admin456'),
                'alamat' => 'Jl. 90909090909',
                'nomer_telepon' => '99999999',
                'remember_token' => Str::random(10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'role_id'=>2,
                'nama' => 'Drs. Ahmad Hidayat, M.Si.',
                'nip' => '197512241998031001',
                'password' => Hash::make('ahmad123'),
                'alamat' => 'Jl. Merdeka No. 1, Surabaya',
                'nomer_telepon' => '081234567890',
                'remember_token' => Str::random(10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'role_id'=>3,
                'nama' => 'Ir. Siti Nurhaliza, M.T.',
                'nip' => '198004111999032002',
                'password' => Hash::make('sitinur456'),
                'alamat' => 'Jl. Melati No. 23, Bandung',
                'nomer_telepon' => '082112345678',
                'remember_token' => Str::random(10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'role_id'=>3,
                'nama' => 'Dr. Budi Santoso, S.Kom., M.Kom.',
                'nip' => '198309251997011003',
                'password' => Hash::make('budi789'),
                'alamat' => 'Jl. Mawar No. 10, Jakarta',
                'nomer_telepon' => '083145678901',
                'remember_token' => Str::random(10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'role_id'=>4,
                'nama' => 'Prof. Dr. Rina Kartika, M.Pd.',
                'nip' => '196712121990042004',
                'password' => Hash::make('rina321'),
                'alamat' => 'Jl. Kenanga No. 5, Yogyakarta',
                'nomer_telepon' => '081267891234',
                'remember_token' => Str::random(10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'role_id'=>4,
                'nama' => 'Hj. Dewi Anggraini, S.E., M.M.',
                'nip' => '197901051999052005',
                'password' => Hash::make('dewi654'),
                'alamat' => 'Jl. Cempaka No. 8, Semarang',
                'nomer_telepon' => '082198765432',
                'remember_token' => Str::random(10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
