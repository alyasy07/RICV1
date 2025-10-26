<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
$users = Illuminate\Support\Facades\DB::table('user')->limit(5)->get();
if (count($users) === 0) {
    echo "No users found.\n";
    exit;
}
foreach ($users as $u) {
    echo 'userID=' . $u->userID . ' | ' . ($u->name ?? $u->username ?? '') . PHP_EOL;
}
