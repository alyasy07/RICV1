<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
use Illuminate\Support\Facades\DB;

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Get all records from migrations table
$migrations = DB::table('migrations')->get();
echo "=== All Migration Records in Database ===\n";
echo "Total migrations: " . count($migrations) . "\n\n";

foreach ($migrations as $migration) {
    echo "{$migration->id} | {$migration->migration} | Batch: {$migration->batch}\n";
}

echo "\n=== Missing Migration Files Check ===\n";
$migrationFiles = [
    '2025_10_22_050001_create_penerbitan_penulisan_table',
    '2025_10_22_050002_create_global_antarabangsa_table',
    '2025_10_22_050003_create_inovasi_pengkomersilan_table',
    '2025_10_22_050004_create_penyelidikan_keusahawanan_table'
];

foreach ($migrationFiles as $file) {
    $exists = DB::table('migrations')->where('migration', $file)->exists();
    $status = $exists ? "✅ FOUND IN DB" : "❌ MISSING FROM DB";
    echo "{$status}: {$file}\n";
}

// Check if the migration files exist in the filesystem
echo "\n=== Migration Files in Directory ===\n";
$migrationPath = __DIR__ . '/../database/migrations/';
foreach ($migrationFiles as $file) {
    $fullPath = $migrationPath . $file . '.php';
    $fileExists = file_exists($fullPath);
    $status = $fileExists ? "✅ FILE EXISTS" : "❌ FILE MISSING";
    echo "{$status}: {$file}.php\n";
}