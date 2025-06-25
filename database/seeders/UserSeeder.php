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
            'name' => 'Kui',
            'email' => 'cmaina413@gmail.com',
            'password' => Hash::make('secret'),
            'phone_number' => '254729472867',
            'role_id' => 1
        ]);

        User::create([
            'name' => 'Talmon',
            'email' => 'talimwakesi@gmail.com',
            'password' => Hash::make('secret'),
            'phone_number' => '254727136485',
            'role_id' => 2
        ]);
    }
}
