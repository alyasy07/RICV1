<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

// Update moa_mou table
try {
    // First, convert any existing 'Dalam Proses' values to 'Menunggu'
    $updated = DB::table('moa_mou')
        ->where('status_permohonan', '=', 'Dalam Proses')
        ->update(['status_permohonan' => 'Menunggu']);
    
    echo "Updated {$updated} records from 'Dalam Proses' to 'Menunggu'\n";
    
    // Now, modify the ENUM to use the standard values
    $sql = "ALTER TABLE moa_mou MODIFY COLUMN status_permohonan ENUM('Tidak Berjaya', 'Menunggu', 'Lulus') DEFAULT 'Menunggu'";
    DB::statement($sql);
    echo "Successfully updated moa_mou table ENUM values\n";
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}

// Display current status of the column
$columns = DB::select("SHOW COLUMNS FROM moa_mou WHERE Field = 'status_permohonan'");
echo "\nCurrent moa_mou.status_permohonan: " . $columns[0]->Type . "\n";