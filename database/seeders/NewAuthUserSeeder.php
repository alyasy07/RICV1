<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\NewUser;

class NewAuthUserSeeder extends Seeder
{
    public function run(): void
    {
        // Create a default user for the new auth system
        NewUser::create([
            'name' => 'New Auth Admin',
            'email' => 'admin-newauth@example.com',
            'password' => Hash::make('password123'),
        ]);
    }
}
