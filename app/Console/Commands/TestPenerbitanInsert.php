<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PenerbitanPenulisan;
use Illuminate\Support\Facades\Log;

class TestPenerbitanInsert extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:penerbitan-insert';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test inserting a record into the PenerbitanPenulisan table';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("Testing PenerbitanPenulisan insertion...");
        
        try {
            // Create a test record
            $penerbitan = new PenerbitanPenulisan([
                'pelaporan' => 'Test Penerbitan',
                'pemberi_dana' => 'Test Funder',
                'tarikh_tutup' => now(),
                'jumlah_dana' => 5000.00,
                'status' => 'Dalam Proses',
                'user_id' => 1  // Using an integer user ID
            ]);
            
            $penerbitan->save();
            
            $this->info("Test record successfully created with ID: " . $penerbitan->id);
            
            // Verify the record was created correctly
            $retrieved = PenerbitanPenulisan::find($penerbitan->id);
            
            if (!$retrieved) {
                $this->error("Failed to retrieve the created record!");
                return 1;
            }
            
            $this->table(['Field', 'Value'], [
                ['id', $retrieved->id],
                ['pelaporan', $retrieved->pelaporan],
                ['pemberi_dana', $retrieved->pemberi_dana],
                ['tarikh_tutup', $retrieved->tarikh_tutup ?: null],
                ['jumlah_dana', $retrieved->jumlah_dana],
                ['status', $retrieved->status],
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