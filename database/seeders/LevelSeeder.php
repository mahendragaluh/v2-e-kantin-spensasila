<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class LevelSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('levels')->insert([
            [
                'name_level' => 'Administrator'
            ],
            [
                'name_level' => 'Kasir'
            ],
            [
                'name_level' => 'Pengelola'
            ],
            [
                'name_level' => 'Pelanggan'
            ]
        ]);
    }
}
