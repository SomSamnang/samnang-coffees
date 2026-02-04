<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@samnang.test',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create test user
        User::create([
            'name' => 'Test User',
            'email' => 'test@samnang.test',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);
    }
}
