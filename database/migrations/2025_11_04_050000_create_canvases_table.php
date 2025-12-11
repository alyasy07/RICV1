<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('canvases', function (Blueprint $table) {
            $table->id();
            $table->string('user_id', 20);
            $table->foreign('user_id')->references('userID')->on('user')->onDelete('cascade');
            $table->string('research_working_title');
            $table->string('thesis_title')->nullable();
            $table->text('abstract')->nullable();
            $table->text('results_summary')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('canvases');
    }
};