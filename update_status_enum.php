<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

$tables = [
    'geran_penyelidikan',
    'geran_padanan',
    'geran_industri',
    'perundingan',
    'kajian_kes',
    'moa_mou'
];

$successCount = 0;

foreach ($tables as $table) {
    try {
        echo "Updating $table table... ";
        $sql = "ALTER TABLE $table MODIFY COLUMN status_permohonan ENUM('Tidak Berjaya', 'Menunggu', 'Lulus') DEFAULT 'Menunggu'";
        DB::statement($sql);
        echo "SUCCESS\n";
        $successCount++;
    } catch (Exception $e) {
        echo "ERROR: " . $e->getMessage() . "\n";
    }
}

echo "\nSummary: Successfully updated $successCount out of " . count($tables) . " tables.\n";

// Now let's check the current column definitions
echo "\nCurrent status_permohonan column definitions:\n";
echo "-----------------------------------------------\n";

foreach ($tables as $table) {
    try {
        $columns = DB::select("SHOW COLUMNS FROM $table WHERE Field = 'status_permohonan'");
        if (!empty($columns)) {
            echo "$table: " . $columns[0]->Type . "\n";
        } else {
            echo "$table: Column not found\n";
        }
    } catch (Exception $e) {
        echo "$table: ERROR - " . $e->getMessage() . "\n";
    }
}