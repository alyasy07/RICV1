<?php

use App\Models\GeranPenyelidikan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

// 1. Check the structure of the status_permohonan column
$columnInfo = DB::select("SHOW COLUMNS FROM geran_penyelidikan WHERE Field = 'status_permohonan'");
echo "Column structure:\n";
print_r($columnInfo);

// 2. Try to insert a test record with 'Dalam Proses' status
try {
    $testRecord = new GeranPenyelidikan();
    $testRecord->nama_ketua_penyelidik = 'Test User';
    $testRecord->nama_geran = 'Test Geran';
    $testRecord->pemberi_dana = 'Test Donor';
    $testRecord->tarikh_tutup_permohonan = now();
    $testRecord->tajuk_penyelidikan = 'Test Research';
    $testRecord->jumlah_dana = 1000.00;
    $testRecord->status_permohonan = 'Dalam Proses';
    $testRecord->user_id = 1;
    
    $testRecord->save();
    echo "\nRecord created successfully with 'Dalam Proses' status!\n";
    echo "Created record ID: " . $testRecord->id . "\n";
    
    // Delete the test record
    $testRecord->delete();
    echo "Test record deleted.\n";
} catch (Exception $e) {
    echo "\nError: " . $e->getMessage() . "\n";
}

// 3. List all possible values for the enum
$enumValues = DB::select("SHOW COLUMNS FROM geran_penyelidikan WHERE Field = 'status_permohonan'")[0]->Type;
echo "\nEnum values: " . $enumValues . "\n";

echo "\nDiagnostic complete.\n";