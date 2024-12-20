<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Create a user without a subscription
        User::create([
            'name' => 'No Subscription User',
            'email' => 'nosub@gmail.com',
            'phone_number' => '1234567890',
            'password' => bcrypt('password'),
            'role_id' => 2,
            'plan_id' => null,
        ]);

        // Create a user with Bronze subscription
        User::create([
            'name' => 'Bronze User',
            'email' => 'bronze@gmail.com',
            'phone_number' => '1234567891',
            'password' => bcrypt('password'),
            'role_id' => 2,
            'plan_id' => 1,
        ]);

        // Create a user with Silver subscription
        User::create([
            'name' => 'Silver User',
            'email' => 'silver@gmail.com',
            'phone_number' => '1234567892',
            'password' => bcrypt('password'),
            'role_id' => 2,
            'plan_id' => 2,
        ]);

        // Create a user with Gold subscription
        User::create([
            'name' => 'Gold User',
            'email' => 'gold@gmail.com',
            'phone_number' => '1234567893',
            'password' => bcrypt('password'),
            'role_id' => 2,
            'plan_id' => 3,
        ]);
    }
}
