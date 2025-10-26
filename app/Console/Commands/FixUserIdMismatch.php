<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\GeranPenyelidikan;

class FixUserIdMismatch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fix:user-id-mismatch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Diagnose and fix user ID mismatches between user table and other tables';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("==== User ID Mismatch Diagnostic Tool ====");
        
        // Check user table structure
        $this->info("\nChecking user table structure:");
        $userColumns = DB::select('SHOW COLUMNS FROM user');
        $this->table(['Field', 'Type', 'Key', 'Null'], collect($userColumns)->map(function ($col) {
            return [
                'Field' => $col->Field,
                'Type' => $col->Type,
                'Key' => $col->Key,
                'Null' => $col->Null,
            ];
        }));
        
        // Check geran_penyelidikan table structure
        $this->info("\nChecking geran_penyelidikan table structure:");
        $geranColumns = DB::select('SHOW COLUMNS FROM geran_penyelidikan');
        $this->table(['Field', 'Type', 'Key', 'Null'], collect($geranColumns)->map(function ($col) {
            return [
                'Field' => $col->Field,
                'Type' => $col->Type,
                'Key' => $col->Key,
                'Null' => $col->Null,
            ];
        }));
        
        // List users
        $this->info("\nListing users:");
        $users = User::all();
        $this->table(['userID', 'username', 'role'], $users->map(function ($user) {
            return [
                'userID' => $user->userID,
                'username' => $user->username,
                'role' => $user->role,
            ];
        }));
        
        // Create map of string IDs to integer IDs
        $this->info("\nUser ID mapping for foreign keys:");
        $userIdMap = [
            'ADMIN001' => 1,
            'PKA001' => 2
        ];
        
        $mapTable = [];
        foreach ($userIdMap as $stringId => $intId) {
            $mapTable[] = [
                'String ID' => $stringId,
                'Integer ID' => $intId
            ];
        }
        $this->table(['String ID', 'Integer ID'], $mapTable);
        
        // Check for any string user_id values in geran_penyelidikan
        $this->info("\nChecking for problematic user_id values in geran_penyelidikan:");
        $problematicIds = DB::select("SELECT id, user_id FROM geran_penyelidikan WHERE user_id REGEXP '[^0-9]'");
        
        if (empty($problematicIds)) {
            $this->info("No string user_id values found - all good!");
        } else {
            $this->error("Found problematic user_id values:");
            $this->table(['id', 'user_id'], $problematicIds);
            
            if ($this->confirm('Do you want to fix these values?')) {
                foreach ($problematicIds as $record) {
                    $stringId = $record->user_id;
                    $intId = $userIdMap[$stringId] ?? 1; // Default to 1 if no mapping
                    
                    DB::table('geran_penyelidikan')
                        ->where('id', $record->id)
                        ->update(['user_id' => $intId]);
                }
                $this->info("Fixed problematic user_id values.");
            }
        }
        
        $this->info("\nDiagnostic complete!");
    }
}