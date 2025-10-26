<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
use Illuminate\Support\Facades\DB;

DB::beginTransaction();
try {
    $now = date('Y-m-d H:i:s');
    $pelaporanId = DB::table('pelaporan')->insertGetId([
        'user_id' => 'ADMIN365',
        'title' => 'TEST PELAPORAN ' . uniqid(),
        'pemberi_dana' => 'TEST',
        'tarikh_tutup' => $now,
        'jumlah_dana' => 0,
        'status' => 'Dalam Proses',
        'jenis' => 'penerbitan_penulisan',
        'created_at' => $now,
        'updated_at' => $now
    ]);

    DB::table('penerbitan_penulisan')->insert([
        'pelaporan_id' => $pelaporanId,
        'created_at' => $now,
        'updated_at' => $now
    ]);

    echo "Inserted pelaporan id={$pelaporanId} and penerbitan record.\n";

    // cleanup
    DB::table('penerbitan_penulisan')->where('pelaporan_id', $pelaporanId)->delete();
    DB::table('pelaporan')->where('id', $pelaporanId)->delete();
    DB::commit();
} catch (\Exception $e) {
    DB::rollBack();
    echo 'Error: ' . $e->getMessage() . PHP_EOL;
}
