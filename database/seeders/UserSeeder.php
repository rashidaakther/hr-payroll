<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Demo Admin Account
        User::updateOrCreate(
            ['email' => 'admin@company.com'],
            [
                'name' => 'System Admin',
                'password' => Hash::make('123456'),
                'confirm_password' => Hash::make('123456'),
                'role' => 'admin',
            ]
        );

        // 2. Create Demo User Account
        User::updateOrCreate(
            ['email' => 'user@company.com'],
            [
                'name' => 'General Employee',
                'password' => Hash::make('123456'),
                'confirm_password' => Hash::make('123456'),
                'role' => 'user',
            ]
        );
    }
}