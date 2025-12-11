<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\NewUser;
use Illuminate\Support\Facades\Hash;

// Delete existing admin if exists
NewUser::where('email', 'admin@admin.com')->delete();

// Delete any existing users with this email
NewUser::where('email', 'admin@admin.com')->delete();

$password = 'admin123';
$hash = Hash::make($password);

$user = new NewUser();
$user->name = 'Administrator';
$user->email = 'admin@admin.com';
$user->password = $hash;
$user->role = 'admin';
$user->save();

// Verify the password hash
if (Hash::check($password, $hash)) {
    echo "Password hash verification successful!\n";
} else {
    echo "WARNING: Password hash verification failed!\n";
}

// Output the hash for verification
echo "Password Hash: " . $hash . "\n";

echo "Admin user created successfully!\n";
echo "Email: admin@admin.com\n";
echo "Password: admin123\n";