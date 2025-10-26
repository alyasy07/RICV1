<?php

namespace App\Console\Commands;

use App\Models\GeranPenyelidikan;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DiagnoseGeranPenyelidikanStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'diagnose:geran-penyelidikan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Diagnose issues with GeranPenyelidikan status values';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Running diagnostic checks for GeranPenyelidikan status_permohonan...');

        // Check the column structure
        $columnInfo = DB::select("SHOW COLUMNS FROM geran_penyelidikan WHERE Field = 'status_permohonan'");
        $this->info('Column structure:');
        print_r($columnInfo);

        // Test creating a record with each status
        $statuses = ['Lulus', 'Tidak Berjaya', 'Dalam Proses'];
        
        foreach ($statuses as $status) {
            $this->info("\nTesting status: " . $status);
            
            try {
                $testRecord = new GeranPenyelidikan();
                $testRecord->nama_ketua_penyelidik = 'Test User';
                $testRecord->nama_geran = 'Test Geran';
                $testRecord->pemberi_dana = 'Test Donor';
                $testRecord->tarikh_tutup_permohonan = now();
                $testRecord->tajuk_penyelidikan = 'Test Research';
                $testRecord->jumlah_dana = 1000.00;
                $testRecord->status_permohonan = $status;
                $testRecord->user_id = 1;
                
                $testRecord->save();
                $this->info("Record created successfully with '$status' status!");
                $this->info("Created record ID: " . $testRecord->id);
                
                // Delete the test record
                $testRecord->delete();
                $this->info("Test record deleted.");
            } catch (\Exception $e) {
                $this->error("Error with status '$status': " . $e->getMessage());
            }
        }

        $this->info("\nDiagnostic complete.");
    }
}