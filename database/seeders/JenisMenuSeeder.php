<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class JenisMenuSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jenis_menus')->insert([
            [
                'name' => 'Makanan'
            ],
            [
                'name' => 'Minuman'
            ],
            [
                'name' => 'Snack'
            ]
        ]);
    }
}
