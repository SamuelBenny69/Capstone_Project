<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => 1,
                'karyawan_id' => 1,
                'email' => 'admin@gmail.com',
                'password' => Hash::make('12345'),
            ],
        ];

        DB::table(table: 'users')->insert($data);

    }
}
