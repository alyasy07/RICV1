<?php

// Include the autoloader to access Laravel classes
require_once 'vendor/autoload.php';
require_once 'bootstrap/app.php';

// Get the application instance
$app = app();

// Testing GeranPenyelidikan model and validation
use App\Models\GeranPenyelidikan;
use Illuminate\Support\Facades\Validator;

echo "======= Testing GeranPenyelidikan Model =======\n\n";

// Test creating a GeranPenyelidikan with each status
$statuses = ['Lulus', 'Dalam Proses', 'Tidak Berjaya'];
$results = [];

foreach ($statuses as $status) {
    $data = [
        'nama_ketua_penyelidik' => 'Test Researcher',
        'penyelidik_bersama' => 'Co-researcher',
        'nama_geran' => 'Test Grant',
        'pemberi_dana' => 'Test Funder',
        'tarikh_tutup_permohonan' => date('Y-m-d'),
        'tajuk_penyelidikan' => 'Test Research Title',
        'jumlah_dana' => 10000.00,
        'status_permohonan' => $status,
        'user_id' => 1
    ];
    
    // Test validation
    $validator = Validator::make($data, [
        'nama_ketua_penyelidik' => 'required|string|max:255',
        'penyelidik_bersama' => 'nullable|string',
        'nama_geran' => 'required|string|max:255',
        'pemberi_dana' => 'required|string|max:255',
        'tarikh_tutup_permohonan' => 'required|date',
        'tajuk_penyelidikan' => 'required|string',
        'jumlah_dana' => 'required|numeric|min:0',
        'status_permohonan' => 'required|in:Tidak Berjaya,Dalam Proses,Lulus'
    ]);
    
    echo "Testing status: $status\n";
    
    if ($validator->fails()) {
        echo "  Validation FAILED: " . json_encode($validator->errors()->toArray()) . "\n";
        $results[$status] = "Validation Failed";
        continue;
    }
    
    echo "  Validation passed\n";
    
    // Try to create the record (we'll only simulate, not actually save)
    try {
        // Create model but don't save to DB
        $geran = new GeranPenyelidikan($data);
        echo "  Model creation successful\n";
        $results[$status] = "Success";
    } catch (\Exception $e) {
        echo "  EXCEPTION: " . $e->getMessage() . "\n";
        $results[$status] = "Exception: " . $e->getMessage();
    }
    
    echo "\n";
}

echo "======= SUMMARY =======\n";
foreach ($results as $status => $result) {
    echo "$status: $result\n";
}
?>