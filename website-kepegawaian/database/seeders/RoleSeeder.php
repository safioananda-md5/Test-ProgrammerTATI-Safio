<?php

namespace Database\Seeders;

// database/seeders/RoleSeeder.php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder {
    public function run(): void {
        DB::table('roles')->insert([
            ['role_name' => 'admin', 'created_at' => now(), 'updated_at' => now()],
            ['role_name' => 'kepaladinas', 'created_at' => now(), 'updated_at' => now()],
            ['role_name' => 'kepalabagian', 'created_at' => now(), 'updated_at' => now()],
            ['role_name' => 'staff', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}

