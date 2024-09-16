<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class KaryawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => 1,
                'jabatan_id' => 1,
                'nama' => 'Samuel',
                'jkel' => 'L',
                'status' => 'aktif'
            ],
        ];

        DB::table(table: 'karyawan')->insert($data);

    }
}
