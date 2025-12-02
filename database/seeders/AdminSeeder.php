<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'nama' => 'Admin User',
            'email' => 'admin@adr.com',
            'password' => Hash::make('admin123'),
            'nomor_handphone' => '08123456789',
        ]);
    }
}
