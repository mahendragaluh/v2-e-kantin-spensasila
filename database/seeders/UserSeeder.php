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
                'id_siswa' => '-',
                'username_nisn' => 'admin',
                'name' => 'Admin',
                'kelas' => '-',
                'no_hp' => '-',
                'password' => Hash::make('admin123'),
                'level_id' => 1
            ],
            [
                'id_siswa' => '-',
                'username_nisn' => 'kasir',
                'name' => 'Kasir',
                'kelas' => '-',
                'no_hp' => '-',
                'password' => Hash::make('kasir123'),
                'level_id' => 2
            ],
            [
                'id_siswa' => '-',
                'username_nisn' => 'pengelola',
                'name' => 'Pengelola',
                'kelas' => '-',
                'no_hp' => '-',
                'password' => Hash::make('pengelola123'),
                'level_id' => 3
            ]
        ]);
    }
}
