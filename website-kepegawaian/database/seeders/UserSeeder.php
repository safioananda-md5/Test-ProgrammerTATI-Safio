<?php

namespace Database\Seeders;

// database/seeders/UserSeeder.php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder {
    public function run(): void {
        DB::table('users')->insert([
            [
                'role_id'=>1,
                'name' => 'Administrator',
                'nip' => '99999999',
                'password' => Hash::make('admin456'),
                'position' => 'admin',
                'address' => 'Jl. 90909090909',
                'phone_number' => '99999999',
                'remember_token' => Str::random(10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'role_id'=>2,
                'nama' => 'Drs. Ahmad Hidayat, M.Si.',
                'nip' => '197512241998031001',
                'password' => Hash::make('ahmad123'),
                'position' => 'kepaladinas',
                'address' => 'Jl. Merdeka No. 1, Surabaya',
                'phone_number' => '081234567890',
                'remember_token' => Str::random(10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'role_id'=>3,
                'nama' => 'Ir. Siti Nurhaliza, M.T.',
                'nip' => '198004111999032002',
                'password' => Hash::make('sitinur456'),
                'position' => 'kepalabagian1',
                'address' => 'Jl. Melati No. 23, Bandung',
                'phone_number' => '082112345678',
                'remember_token' => Str::random(10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'role_id'=>3,
                'nama' => 'Dr. Budi Santoso, S.Kom., M.Kom.',
                'nip' => '198309251997011003',
                'password' => Hash::make('budi789'),
                'position' => 'kepalabagian2',
                'address' => 'Jl. Mawar No. 10, Jakarta',
                'phone_number' => '083145678901',
                'remember_token' => Str::random(10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'role_id'=>4,
                'nama' => 'Prof. Dr. Rina Kartika, M.Pd.',
                'nip' => '196712121990042004',
                'password' => Hash::make('rina321'),
                'position' => 'staff1',
                'address' => 'Jl. Kenanga No. 5, Yogyakarta',
                'phone_number' => '081267891234',
                'remember_token' => Str::random(10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'role_id'=>4,
                'nama' => 'Hj. Dewi Anggraini, S.E., M.M.',
                'nip' => '197901051999052005',
                'password' => Hash::make('dewi654'),
                'position' => 'staff2',
                'address' => 'Jl. Cempaka No. 8, Semarang',
                'phone_number' => '082198765432',
                'remember_token' => Str::random(10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}

