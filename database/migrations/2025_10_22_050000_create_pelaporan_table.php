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
        // Core pelaporan table - shared fields for all pelaporan types
        Schema::create('pelaporan', function (Blueprint $table) {
            $table->id();
            $table->string('user_id', 50)->nullable(); // String type to match User model's userID
            $table->string('title');
            $table->string('pemberi_dana')->nullable();
            $table->date('tarikh_tutup')->nullable();
            $table->decimal('jumlah_dana', 15, 2)->nullable();
            $table->string('status')->default('baru');
            $table->enum('jenis', [
                'penerbitan_penulisan',
                'global_antarabangsa',
                'inovasi_pengkomersilan',
                'penyelidikan_keusahawanan'
            ]);
            $table->timestamps();
            
            // Foreign key constraint to user table with string primary key
            $table->foreign('user_id')
                  ->references('userID')
                  ->on('user')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelaporan');
    }
};