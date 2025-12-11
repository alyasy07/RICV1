<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Delete existing admin user if exists
        User::where('email', 'admin@iccv1.com')->delete();
        User::where('userID', 'USR001')->delete();

        // Create admin user - password will be auto-hashed by the model mutator
        User::create([
            'userID' => 'USR001',
            'username' => 'Administrator',
            'icNumber' => '000000000000',
            'email' => 'admin@iccv1.com',
            'role' => 'Admin',
            'password' => 'admin123', // Model will hash this automatically
            'userStatus' => 'Aktif',
            'profilePicture' => null,
            'remember_token' => Str::random(10),
        ]);

        $this->command->info('Admin user created successfully!');
        $this->command->info('Email: admin@iccv1.com');
        $this->command->info('Password: admin123');
        $this->command->info('UserID: USR001');
    }
}
