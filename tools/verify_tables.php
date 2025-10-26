<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
use Illuminate\Support\Facades\DB;

$tables = [
    'global_antarabangsa',
    'inovasi_pengkomersilan',
    'penerbitan_penulisan',
    'penyelidikan_keusahawanan'
];

echo "\n=== Checking Table Existence ===\n";

foreach ($tables as $table) {
    $exists = DB::select("SHOW TABLES LIKE '{$table}'");
    $status = !empty($exists) ? "✅ EXISTS" : "❌ MISSING";
    echo "{$status}: {$table}\n";
    
    if (!empty($exists)) {
        $columns = DB::select("DESCRIBE {$table}");
        echo "  Columns:\n";
        foreach ($columns as $column) {
            echo "    - {$column->Field} ({$column->Type})\n";
        }
        echo "\n";
    }
}

echo "=== Check Complete ===\n";