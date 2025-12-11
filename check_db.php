<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

echo "Checking table structure:\n";
$columns = DB::select('DESCRIBE new_users');
foreach ($columns as $column) {
    echo "{$column->Field} - {$column->Type} - {$column->Null} - {$column->Key}\n";
}

echo "\nChecking users in database:\n";
$users = DB::table('new_users')->get();
foreach ($users as $user) {
    echo "ID: {$user->userID}\n";
    echo "Name: {$user->name}\n";
    echo "Email: {$user->email}\n";
    echo "Role: {$user->role}\n";
    echo "Password Hash: {$user->password}\n";
    echo "------------------------\n";
}