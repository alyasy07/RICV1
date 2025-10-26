<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Check number of records
$count = DB::table('pelaporan')->where('jenis', 'penyelidikan_keusahawanan')->count();
echo "Number of records in pelaporan with jenis='penyelidikan_keusahawanan': $count\n";

// Get the actual records
$records = DB::table('pelaporan')
    ->where('jenis', 'penyelidikan_keusahawanan')
    ->get();

echo "\nRecords:\n";
foreach ($records as $record) {
    echo "ID: {$record->id}, Title: {$record->title}, Status: {$record->status}\n";
}

// Check if there's an issue with cache
echo "\nTesting cache clearing...\n";
Artisan::call('cache:clear');
Artisan::call('view:clear');
Artisan::call('config:clear');
echo "Cache cleared.\n";

// Check if DataTables is properly initialized
echo "\nChecking DataTables server-side processing configuration...\n";
echo "This is handled in the blade template with serverSide: true\n";