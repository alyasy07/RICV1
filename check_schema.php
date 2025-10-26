<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Get column information for the user table
$columns = DB::select('SHOW COLUMNS FROM user');
echo "User Table Schema:\n";
foreach ($columns as $column) {
    echo $column->Field . ' - ' . $column->Type . ' - ' . $column->Null . ' - ' . $column->Key . ' - ' . $column->Default . "\n";
}