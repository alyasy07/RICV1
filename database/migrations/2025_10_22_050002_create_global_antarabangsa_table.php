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
        // Global dan Pengantarabangsaan
        Schema::create("global_antarabangsa", function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("pelaporan_id");
            $table->timestamps();
            
            $table->foreign("pelaporan_id")
                  ->references("id")
                  ->on("pelaporan")
                  ->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("global_antarabangsa");
    }
};
