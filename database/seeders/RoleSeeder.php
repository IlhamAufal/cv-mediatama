<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            [
                'name'         => 'Admin',
                'description'  => 'Akses penuh ke seluruh fitur sistem, termasuk manajemen user, role, dan konfigurasi.',
            ],
            [
                'name'         => 'Customer',
                'description'  => 'Pengguna umum dengan akses baca dan partisipasi di komunitas serta event.',
            ],
        ];

        DB::table('roles')->insert($roles);
        
    }
}
