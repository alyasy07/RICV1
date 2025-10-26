<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Alter the user table to increase icNumber length
try {
    DB::statement('ALTER TABLE `user` MODIFY `icNumber` varchar(20) COLLATE utf8mb4_unicode_ci');
    echo "Successfully modified the icNumber column in the user table to varchar(20).\n";
} catch (Exception $e) {
    echo "Error modifying the table: " . $e->getMessage() . "\n";
}