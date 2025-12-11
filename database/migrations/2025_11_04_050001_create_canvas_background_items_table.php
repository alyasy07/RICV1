<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('canvas_background_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('canvas_id')->constrained()->onDelete('cascade');
            $table->text('content');
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('canvas_background_items');
    }
};