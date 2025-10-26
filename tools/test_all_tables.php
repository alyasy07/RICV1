<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
use Illuminate\Support\Facades\DB;

function testTableInsert($type, $table) {
    try {
        DB::beginTransaction();
        
        $now = date('Y-m-d H:i:s');
        $pelaporanId = DB::table('pelaporan')->insertGetId([
            'user_id' => 'ADMIN365',
            'title' => "TEST {$type} " . uniqid(),
            'pemberi_dana' => 'TEST',
            'tarikh_tutup' => $now,
            'jumlah_dana' => 0,
            'status' => 'Dalam Proses',
            'jenis' => $type,
            'created_at' => $now,
            'updated_at' => $now
        ]);

        DB::table($table)->insert([
            'pelaporan_id' => $pelaporanId,
            'created_at' => $now,
            'updated_at' => $now
        ]);

        echo "✅ SUCCESS: Inserted pelaporan id={$pelaporanId} and {$table} record.\n";

        // cleanup
        DB::table($table)->where('pelaporan_id', $pelaporanId)->delete();
        DB::table('pelaporan')->where('id', $pelaporanId)->delete();
        DB::commit();
        return true;
    } catch (\Exception $e) {
        DB::rollBack();
        echo "❌ ERROR for {$table}: " . $e->getMessage() . PHP_EOL;
        return false;
    }
}

echo "\n=== Testing Global Antarabangsa ===\n";
testTableInsert('global_antarabangsa', 'global_antarabangsa');

echo "\n=== Testing Inovasi Pengkomersilan ===\n";
testTableInsert('inovasi_pengkomersilan', 'inovasi_pengkomersilan');

echo "\n=== Testing Penyelidikan Keusahawanan ===\n";
testTableInsert('penyelidikan_keusahawanan', 'penyelidikan_keusahawanan');

echo "\n=== Testing Complete ===\n";