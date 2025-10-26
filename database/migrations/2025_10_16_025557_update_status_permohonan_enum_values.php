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
        // Update geran_padanan
        \DB::statement("ALTER TABLE geran_padanan MODIFY COLUMN status_permohonan ENUM('Tidak Berjaya', 'Dalam Proses', 'Lulus') DEFAULT 'Dalam Proses'");
        
        // Update geran_industri
        \DB::statement("ALTER TABLE geran_industri MODIFY COLUMN status_permohonan ENUM('Tidak Berjaya', 'Dalam Proses', 'Lulus') DEFAULT 'Dalam Proses'");

        // Update perundingan
        \DB::statement("ALTER TABLE perundingan MODIFY COLUMN status_permohonan ENUM('Tidak Berjaya', 'Dalam Proses', 'Lulus') DEFAULT 'Dalam Proses'");

        // Update kajian_kes
        \DB::statement("ALTER TABLE kajian_kes MODIFY COLUMN status_permohonan ENUM('Tidak Berjaya', 'Dalam Proses', 'Lulus') DEFAULT 'Dalam Proses'");

        // Update moa_mou
        \DB::statement("ALTER TABLE moa_mou MODIFY COLUMN status_permohonan ENUM('Tidak Berjaya', 'Dalam Proses', 'Lulus') DEFAULT 'Dalam Proses'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert changes if needed
        \DB::statement("ALTER TABLE geran_padanan MODIFY COLUMN status_permohonan ENUM('Lulus', 'Tidak Berjaya') DEFAULT 'Tidak Berjaya'");
        \DB::statement("ALTER TABLE geran_industri MODIFY COLUMN status_permohonan ENUM('Lulus', 'Tidak Berjaya') DEFAULT 'Tidak Berjaya'");
        \DB::statement("ALTER TABLE perundingan MODIFY COLUMN status_permohonan ENUM('Baharu', 'Dalam Proses', 'Lulus', 'Ditolak') DEFAULT 'Baharu'");
        \DB::statement("ALTER TABLE kajian_kes MODIFY COLUMN status_permohonan ENUM('Baharu', 'Dalam Proses', 'Lulus', 'Ditolak') DEFAULT 'Baharu'");
        \DB::statement("ALTER TABLE moa_mou MODIFY COLUMN status_permohonan ENUM('Baharu', 'Dalam Proses', 'Lulus', 'Ditolak') DEFAULT 'Baharu'");
    }
};
