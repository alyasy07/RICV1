<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
$rows = Illuminate\Support\Facades\DB::table('migrations')->where('migration','like','%penerbitan%')->get();
foreach ($rows as $r) {
    echo $r->id . ' | ' . $r->migration . ' | ' . $r->batch . PHP_EOL;
}
if (count($rows) === 0) {
    echo "no rows\n";
}
