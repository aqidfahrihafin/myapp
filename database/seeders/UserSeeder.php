<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Tambahkan ini
use Illuminate\Support\Facades\Hash; // Pastikan ini juga ada jika menggunakan Hash::make

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pengurus',
                'email' => 'pengurus@example.com',
                'password' => Hash::make('password123'),
                'role' => 'pengurus',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Santri',
                'email' => 'santri@example.com',
                'password' => Hash::make('password123'),
                'role' => 'santri',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Wali',
                'email' => 'wali@example.com',
                'password' => Hash::make('password123'),
                'role' => 'wali',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
