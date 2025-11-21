<?php
// database/seeders/AdminSeeder.php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {

        Admin::truncate();


        Admin::create([
            'nama' => 'Super Admin',
            'email' => env('DEFAULT_ADMIN_EMAIL', 'admin@example.com'),
            'password' => Hash::make(env('DEFAULT_ADMIN_PASSWORD', 'password123')),
        ]);


        $this->command->info('Admin users seeded successfully!');
        $this->command->info('Default admin: admin@example.com / password123');
    }
}
