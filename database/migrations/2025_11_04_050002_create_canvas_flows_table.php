<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('canvas_flows', function (Blueprint $table) {
            $table->id();
            $table->foreignId('canvas_id')->constrained()->onDelete('cascade');
            $table->text('problem')->nullable();
            $table->text('objective')->nullable();
            $table->text('methodology')->nullable();
            $table->text('discussion')->nullable();
            $table->text('conclusion')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('canvas_flows');
    }
};