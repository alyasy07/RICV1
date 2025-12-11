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
        Schema::create('user', function (Blueprint $table) {
            $table->string('userID', 20)->primary();
            $table->string('username', 100);
            $table->string('icNumber', 20)->nullable();
            $table->string('email', 100)->unique();
            $table->string('role', 50)->default('User');
            $table->string('password', 255);
            $table->enum('userStatus', ['Aktif', 'Tidak Aktif'])->default('Aktif');
            $table->string('profilePicture', 255)->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
