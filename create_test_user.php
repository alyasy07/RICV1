<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\NewUser;
use Illuminate\Support\Facades\Hash;

// Delete any existing test users with this email
NewUser::where('email', 'user@test.com')->delete();

$password = 'password123';
$hash = Hash::make($password);

$user = new NewUser();
$user->name = 'Test User';
$user->email = 'user@test.com';
$user->password = $hash;
$user->role = 'user';  // Regular user role
$user->save();

// Verify the password hash
if (Hash::check($password, $hash)) {
    echo "Password hash verification successful!\n";
} else {
    echo "WARNING: Password hash verification failed!\n";
}

// Output the user details
echo "\nTest user created successfully!\n";
echo "Email: user@test.com\n";
echo "Password: password123\n";
echo "Role: user\n";