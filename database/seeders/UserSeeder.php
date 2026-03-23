<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin user
        User::create([
            'lname' => 'Admin',
            'fname' => 'Test',
            'middle_initial' => 'A',
            'email' => 'admin@pokestop.local',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'status' => 'active',
            'email_verified_at' => now(),
        ]);

        // Regular users
        User::create([
            'lname' => 'Smith',
            'fname' => 'John',
            'middle_initial' => 'J',
            'email' => 'john@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'status' => 'active',
            'email_verified_at' => now(),
        ]);

        User::create([
            'lname' => 'Doe',
            'fname' => 'Jane',
            'middle_initial' => 'M',
            'email' => 'jane@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'status' => 'active',
            'email_verified_at' => now(),
        ]);
    }
}

