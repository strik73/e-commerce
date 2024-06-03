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
        DB::table('users')->insert([
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@mail.com',
                'username' => 'superadmin',
                'password' => Hash::make('123456'),
                'city' => 'Bandung',
                'address' => 'Kopo Sayati 165',
                'status' => true,
                'created_at' => \now(),
                'updated_at' => \now(),
            ], [
                'name' => 'Yefta',
                'email' => 'yeftasm@mail.com',
                'username' => 'yeftasm',
                'password' => Hash::make('123456'),
                'city' => 'Bandung',
                'address' => 'Pasirkoja 4a',
                'status' => true,
                'created_at' => \now(),
                'updated_at' => \now(),
            ]
        ]);
    }
}
