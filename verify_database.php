<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;

echo "=== Database User Check ===\n\n";

$users = User::all();

echo "Total users in database: " . $users->count() . "\n\n";

if ($users->count() > 0) {
    foreach ($users as $user) {
        echo "UserID: " . $user->userID . "\n";
        echo "Username: " . $user->username . "\n";
        echo "Email: " . $user->email . "\n";
        echo "Role: " . $user->role . "\n";
        echo "Status: " . $user->userStatus . "\n";
        echo "---\n";
    }
} else {
    echo "No users found in the database.\n";
}

echo "\n=== Login Test ===\n";
$admin = User::where('email', 'admin@iccv1.com')->first();
if ($admin) {
    echo "Admin user found!\n";
    echo "Testing password... ";
    if (\Illuminate\Support\Facades\Hash::check('admin123', $admin->password)) {
        echo "✓ Password is correct!\n";
    } else {
        echo "✗ Password verification failed!\n";
    }
} else {
    echo "Admin user not found!\n";
}
