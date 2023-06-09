<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'level_id' => $row['level_id'],
            'id_siswa' => $row['id_siswa'],
            'username_nisn' => $row['username_nisn'],
            'name'     => $row['name'],
            'kelas' => $row['kelas'],
            'no_hp' => $row['no_hp'],
            'password' => Hash::make($row['password']),
        ]);
    }
}
