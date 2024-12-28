<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Seed a user with "Personal Training" plan
        User::create([
            'name' => 'Personal Training User',
            'email' => 'personal@example.com',
            'password' => Hash::make('password'),
            'plan_id' => 1, // Personal Training
            'phone_number' => '1234567890', // Add phone number
            'role_id' => 2,

        ]);

        // Seed a user with "Build His Temple" plan (Level 1)
        User::create([
            'name' => 'Build His Temple User',
            'email' => 'temple@example.com',
            'password' => Hash::make('password'),
            'plan_id' => 2, // Build His Temple
            'current_level' => 1, // Starting Level
            'phone_number' => '1234567890', // Add phone number
            'role_id' => 2,

        ]);

        // Seed a user without a plan
        User::create([
            'name' => 'No Plan User',
            'email' => 'noplan@example.com',
            'password' => Hash::make('password'),
            'plan_id' => null, // No plan
            'phone_number' => '1234567890', // Add phone number
            'role_id' => 2,

        ]);

          // Create users with different levels for Build His Temple plan
          User::create([
            'name' => 'User Level 1',
            'email' => 'level1@example.com',
            'password' => bcrypt('password'),
            'plan_id' => 2, // Build His Temple
            'current_level' => 1, // Level 1
            'phone_number' => '1234567890',
            'role_id' => 2, // Assuming 2 is user role
        ]);

        User::create([
            'name' => 'User Level 2',
            'email' => 'level2@example.com',
            'password' => bcrypt('password'),
            'plan_id' => 2, // Build His Temple
            'current_level' => 2, // Level 2
            'phone_number' => '0987654321',
            'role_id' => 2,
        ]);

        User::create([
            'name' => 'User Level 3',
            'email' => 'level3@example.com',
            'password' => bcrypt('password'),
            'plan_id' => 2, // Build His Temple
            'current_level' => 3, // Level 3
            'phone_number' => '1122334455',
            'role_id' => 2,
        ]);
    }
}
