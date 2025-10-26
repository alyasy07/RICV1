<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // First, backup current status values
        $rows = DB::table('pelaporan')->get(['id', 'status']);
        $statusValues = [];
        
        foreach ($rows as $row) {
            $statusValues[$row->id] = $row->status;
        }
        
        Schema::table('pelaporan', function (Blueprint $table) {
            // Change the status column from enum to string
            $table->string('status')->default('baru')->change();
        });
        
        // Restore status values
        foreach ($statusValues as $id => $status) {
            DB::table('pelaporan')
                ->where('id', $id)
                ->update(['status' => $status]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No revert provided as it would require converting back to enum
        // which might cause data loss if custom values were added
        Schema::table('pelaporan', function (Blueprint $table) {
            // We can't easily go back to the enum constraint without data loss
        });
    }
};
