<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class KontenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kontens = [
            [
                'title' => 'Video 1',
                'description' => 'Deskripsi Video 1',
                'file_path' => 'konten_files/video1.mp4',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Video 2',
                'description' => 'Deskripsi Video 2',
                'file_path' => 'konten_files/video2.mp4',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('kontens')->insert($kontens);
    }
}

