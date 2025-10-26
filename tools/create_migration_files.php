<?php
// Create an array of migrations to generate
$migrations = [
    [
        'filename' => '2025_10_22_050002_create_global_antarabangsa_table.php',
        'table' => 'global_antarabangsa',
        'comment' => 'Global dan Pengantarabangsaan'
    ],
    [
        'filename' => '2025_10_22_050003_create_inovasi_pengkomersilan_table.php',
        'table' => 'inovasi_pengkomersilan',
        'comment' => 'Inovasi dan Pengkomersilan'
    ],
    [
        'filename' => '2025_10_22_050004_create_penyelidikan_keusahawanan_table.php',
        'table' => 'penyelidikan_keusahawanan',
        'comment' => 'Penyelidikan dan Keusahawanan'
    ],
    [
        'filename' => '2025_10_22_050001_create_penerbitan_penulisan_table.php',
        'table' => 'penerbitan_penulisan',
        'comment' => 'Penerbitan dan Penulisan Kreatif'
    ]
];

// Template for migration files
$template = <<<'EOT'
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // %s
        Schema::create('%s', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pelaporan_id');
            $table->timestamps();
            
            $table->foreign('pelaporan_id')
                  ->references('id')
                  ->on('pelaporan')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('%s');
    }
};
EOT;

// Loop through migrations and create files
foreach ($migrations as $migration) {
    $path = __DIR__ . '/../database/migrations/' . $migration['filename'];
    $content = sprintf($template, $migration['comment'], $migration['table'], $migration['table']);
    
    // Delete file if it exists (to avoid errors)
    if (file_exists($path)) {
        unlink($path);
    }
    
    // Create the file
    file_put_contents($path, $content);
    echo "Created: {$migration['filename']}\n";
}

echo "All migration files have been created.\n";