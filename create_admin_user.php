<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;

// Generate a unique userID for the admin
$userID = 'ADMIN' . str_pad(mt_rand(1, 999), 3, '0', STR_PAD_LEFT);

$user = new User();
$user->userID = $userID;
$user->username = 'admin1';
$user->icNumber = '000000000000'; // Placeholder IC number
$user->email = 'admin1@gmail.com';
$user->role = 'Admin';
$user->password = 'rudyykim'; // Will be automatically hashed by the model
$user->userStatus = 'Aktif';
$user->save();

echo "User created successfully with userID: {$userID}\n";