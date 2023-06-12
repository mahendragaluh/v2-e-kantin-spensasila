<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'id_siswa' => '1234567890',
                'nisn' => '1234567890',
                'name' => 'Admin',
                'kelas' => '-',
                'no_hp' => '1234567890',
                'password' => Hash::make('admin123'),
                'level_id' => 1
            ],
            [
                'id_siswa' => '2345678901',
                'nisn' => '2345678901',
                'name' => 'Kasir',
                'kelas' => '-',
                'no_hp' => '2345678901',
                'password' => Hash::make('kasir123'),
                'level_id' => 2
            ],
            [
                'id_siswa' => '3456789012',
                'nisn' => '3456789012',
                'name' => 'Pengelola',
                'kelas' => '-',
                'no_hp' => '3456789012',
                'password' => Hash::make('pengelola123'),
                'level_id' => 3
            ]
        ]);
    }
}
