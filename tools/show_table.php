<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
$table = 'penerbitan_penulisan';
$rows = Illuminate\Support\Facades\DB::select("SHOW COLUMNS FROM {$table}");
if (!$rows) {
    echo "Table '{$table}' does not exist.\n";
    exit(1);
}
foreach ($rows as $r) {
    echo $r->Field . ' | ' . $r->Type . ' | ' . $r->Null . ' | ' . $r->Key . ' | ' . $r->Default . ' | ' . $r->Extra . PHP_EOL;
}
