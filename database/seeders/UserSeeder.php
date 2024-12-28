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
        User::create([
            'name' => 'Wanjiku',
            'email' => 'wanjiku@gmail.com',
            'password' => Hash::make('password'),
            'phone_number' => '1234567890', 
            'role_id' => 1,

        ]);
    }
}
