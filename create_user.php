<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\NewUser;

use Illuminate\Support\Facades\Hash;

// Delete existing user if exists
NewUser::where('email', 'user@example.com')->delete();

$user = new NewUser();
$user->name = 'Test User';
$user->email = 'user@example.com';
$user->password = Hash::make('password123');
$user->role = 'user';
$user->save();

echo "User created successfully!\n";

