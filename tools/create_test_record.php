<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Pelaporan;
use App\Models\PenyelidikanKeusahawanan;
use Illuminate\Support\Facades\DB;

// Create a test record
DB::transaction(function () {
    $pelaporan = new Pelaporan();
    $pelaporan->user_id = 'ADMIN365'; // Assuming this is a valid user_id
    $pelaporan->title = 'TEST PELAPORAN PENYELIDIKAN KEUSAHAWANAN';
    $pelaporan->pemberi_dana = 'DANA TEST';
    $pelaporan->tarikh_tutup = '2023-12-31';
    $pelaporan->jumlah_dana = 5000.00;
    $pelaporan->status = 'Dalam Proses';
    $pelaporan->jenis = 'penyelidikan_keusahawanan';
    $pelaporan->save();
    
    // Create the related record
    $penyelidikan = new PenyelidikanKeusahawanan();
    $penyelidikan->pelaporan_id = $pelaporan->id;
    $penyelidikan->save();
    
    echo "Created test record with ID: {$pelaporan->id}\n";
});

// Verify the record was created
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