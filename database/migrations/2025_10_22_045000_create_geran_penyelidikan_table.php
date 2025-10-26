<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Backup existing data before dropping the table
        $records = [];
        if (Schema::hasTable('geran_penyelidikan')) {
            try {
                $records = DB::table('geran_penyelidikan')->get()->toArray();
            } catch (\Exception $e) {
                // Table exists but might be corrupted, continue with recreation
            }
        }

        // Drop the existing table
        Schema::dropIfExists('geran_penyelidikan');

        // Create the table with correct structure
        Schema::create('geran_penyelidikan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_ketua_penyelidik');
            $table->text('penyelidik_bersama')->nullable();
            $table->string('nama_geran');
            $table->string('pemberi_dana');
            $table->date('tarikh_tutup_permohonan');
            $table->text('tajuk_penyelidikan');
            $table->decimal('jumlah_dana', 15, 2);
            $table->enum('status_permohonan', ['Lulus', 'Dalam Proses', 'Tidak Berjaya']);
            // Change: Making user_id integer and not requiring it to be a specific string
            $table->integer('user_id')->nullable();
            $table->timestamps();
        });

        // Restore data if we had any
        if (!empty($records)) {
            foreach ($records as $record) {
                // Convert any non-numeric user_id to a default value
                if (isset($record->user_id) && !is_numeric($record->user_id)) {
                    // Map known string IDs to integers
                    $userIdMap = [
                        'ADMIN001' => 1,
                    ];
                    $record->user_id = $userIdMap[$record->user_id] ?? 1; // Default to 1
                }
                
                // Insert record back into the table
                DB::table('geran_penyelidikan')->insert((array)$record);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No need to implement down as we're recreating the original table structure
    }
};