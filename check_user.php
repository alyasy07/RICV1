<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\NewUser;
use Illuminate\Support\Facades\Hash;

$email = 'user@example.com';
$password = 'password123';

$user = NewUser::where('email', $email)->first();

if (!$user) {
    echo "User not found!\n";
    exit;
}

echo "User found:\n";
echo "Name: " . $user->name . "\n";
echo "Email: " . $user->email . "\n";
echo "Role: " . $user->role . "\n";
echo "Password hash: " . $user->password . "\n";
echo "Testing password: " . ($password) . "\n";
echo "Hash check result: " . (Hash::check($password, $user->password) ? "TRUE" : "FALSE") . "\n";