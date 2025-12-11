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
        Schema::table('references', function (Blueprint $table) {
            // Add columns to support links
            $table->string('url')->nullable()->after('file_path'); // For storing web links
            $table->enum('reference_type', ['file', 'link'])->default('file')->after('file_type'); // Type of reference
            
            // Make file-related columns nullable since links won't have files
            $table->string('file_path')->nullable()->change();
            $table->string('file_type')->nullable()->change();
            $table->integer('file_size')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('references', function (Blueprint $table) {
            $table->dropColumn(['url', 'reference_type']);
            
            // Revert file_path back to required (be careful with existing data)
            $table->string('file_path')->nullable(false)->change();
        });
    }
};
