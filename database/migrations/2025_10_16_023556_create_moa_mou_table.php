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
        Schema::create('moa_mou', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_perundingan');
            $table->string('agensi_terlibat');
            $table->text('tajuk_penyelidikan');
            $table->enum('status_permohonan', ['Baharu', 'Dalam Proses', 'Lulus', 'Ditolak'])->default('Baharu');
            $table->string('user_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('moa_mou');
    }
};
