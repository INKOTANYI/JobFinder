<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create an admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@ishakiro.com',
            'password' => bcrypt('Inkotanyi123@'), // Password will be hashed
            'role' => 'admin',
        ]);
    }
}