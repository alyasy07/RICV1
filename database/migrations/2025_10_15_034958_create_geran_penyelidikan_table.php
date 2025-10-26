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
        Schema::create('geran_penyelidikan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_ketua_penyelidik');
            $table->text('penyelidik_bersama')->nullable();
            $table->string('nama_geran');
            $table->string('pemberi_dana');
            $table->date('tarikh_tutup_permohonan');
            $table->text('tajuk_penyelidikan');
            $table->decimal('jumlah_dana', 15, 2);
            $table->enum('status_permohonan', ['Lulus','Dalam Proses','Tidak Berjaya']);
            $table->integer('user_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('geran_penyelidikan');
    }
};
