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
        Schema::create('geran_industri', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pemohon');
            $table->string('institusi_terlibat');
            $table->text('tajuk_penyelidikan');
            $table->decimal('jumlah_dana_dipohon', 15, 2);
            $table->string('tempoh_penyelidikan');
            $table->enum('status_permohonan', ['Lulus', 'Tidak Berjaya']);
            $table->string('user_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('geran_industri');
    }
};
