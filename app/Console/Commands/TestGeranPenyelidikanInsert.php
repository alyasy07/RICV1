<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\GeranPenyelidikan;
use Illuminate\Support\Facades\Log;

class TestGeranPenyelidikanInsert extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:geran-insert';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test inserting a record into the GeranPenyelidikan table';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("Testing GeranPenyelidikan insertion...");
        
        try {
            // Create a test record
            $geran = new GeranPenyelidikan([
                'nama_ketua_penyelidik' => 'Dr. Test Researcher',
                'penyelidik_bersama' => 'Co-researcher test',
                'nama_geran' => 'Test Grant Name',
                'pemberi_dana' => 'Test Funder',
                'tarikh_tutup_permohonan' => now(),
                'tajuk_penyelidikan' => 'Test Research Title',
                'jumlah_dana' => 10000.00,
                'status_permohonan' => 'Dalam Proses',
                'user_id' => 1  // Using an integer user ID
            ]);
            
            $geran->save();
            
            $this->info("Test record successfully created with ID: " . $geran->id);
            
            // Verify the record was created correctly
            $retrieved = GeranPenyelidikan::find($geran->id);
            
            if (!$retrieved) {
                $this->error("Failed to retrieve the created record!");
                return 1;
            }
            
            $this->table(['Field', 'Value'], [
                ['id', $retrieved->id],
                ['nama_ketua_penyelidik', $retrieved->nama_ketua_penyelidik],
                ['nama_geran', $retrieved->nama_geran],
                ['status_permohonan', $retrieved->status_permohonan],
                ['user_id', $retrieved->user_id]
            ]);
            
            $this->info("Test completed successfully!");
            
        } catch (\Exception $e) {
            $this->error("Error: " . $e->getMessage());
            $this->error($e->getTraceAsString());
            return 1;
        }
        
        return 0;
    }
}