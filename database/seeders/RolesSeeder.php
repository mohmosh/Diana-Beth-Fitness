<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesSeeder extends Seeder
{
    public function run()
    {
        Role::create(['name' => 'admin', 'description' => 'An Admin with full access']);
        Role::create(['name' => 'user', 'description' => 'A user with limited access']);
    }
}

