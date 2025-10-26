<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

// Start transaction
DB::beginTransaction();

try {
    // Create global_antarabangsa table if not exists
    if (!Schema::hasTable('global_antarabangsa')) {
        echo "Creating global_antarabangsa table...\n";
        Schema::create('global_antarabangsa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pelaporan_id');
            $table->timestamps();
            
            $table->foreign('pelaporan_id')
                ->references('id')
                ->on('pelaporan')
                ->onDelete('cascade');
        });
        echo "global_antarabangsa table created successfully.\n";
    } else {
        echo "global_antarabangsa table already exists.\n";
    }

    // Create inovasi_pengkomersilan table if not exists
    if (!Schema::hasTable('inovasi_pengkomersilan')) {
        echo "Creating inovasi_pengkomersilan table...\n";
        Schema::create('inovasi_pengkomersilan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pelaporan_id');
            $table->timestamps();
            
            $table->foreign('pelaporan_id')
                ->references('id')
                ->on('pelaporan')
                ->onDelete('cascade');
        });
        echo "inovasi_pengkomersilan table created successfully.\n";
    } else {
        echo "inovasi_pengkomersilan table already exists.\n";
    }

    // Create penyelidikan_keusahawanan table if not exists
    if (!Schema::hasTable('penyelidikan_keusahawanan')) {
        echo "Creating penyelidikan_keusahawanan table...\n";
        Schema::create('penyelidikan_keusahawanan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pelaporan_id');
            $table->timestamps();
            
            $table->foreign('pelaporan_id')
                ->references('id')
                ->on('pelaporan')
                ->onDelete('cascade');
        });
        echo "penyelidikan_keusahawanan table created successfully.\n";
    } else {
        echo "penyelidikan_keusahawanan table already exists.\n";
    }

    // Update migrations table to mark the migrations as run
    $migrations = [
        '2025_10_22_050002_create_global_antarabangsa_table',
        '2025_10_22_050003_create_inovasi_pengkomersilan_table',
        '2025_10_22_050004_create_penyelidikan_keusahawanan_table'
    ];

    foreach ($migrations as $migration) {
        if (!DB::table('migrations')->where('migration', $migration)->exists()) {
            DB::table('migrations')->insert([
                'migration' => $migration,
                'batch' => DB::table('migrations')->max('batch') ?: 1
            ]);
            echo "Migration {$migration} added to migrations table.\n";
        } else {
            echo "Migration {$migration} already exists in migrations table.\n";
        }
    }

    // Commit transaction if everything is successful
    DB::commit();
    echo "All operations completed successfully.\n";

} catch (\Exception $e) {
    // Roll back transaction if any error occurs
    DB::rollBack();
    echo "Error: " . $e->getMessage() . "\n";
}