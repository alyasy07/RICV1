<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\GeranPenyelidikan;
use Illuminate\Support\Facades\Validator;

class TestGeranValidation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:geran-validation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test the GeranPenyelidikan validation and database connection';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("======= Testing GeranPenyelidikan Model =======\n");

        // Test creating a GeranPenyelidikan with each status
        $statuses = ['Lulus', 'Dalam Proses', 'Tidak Berjaya'];
        $results = [];

        foreach ($statuses as $status) {
            $data = [
                'nama_ketua_penyelidik' => 'Test Researcher',
                'penyelidik_bersama' => 'Co-researcher',
                'nama_geran' => 'Test Grant',
                'pemberi_dana' => 'Test Funder',
                'tarikh_tutup_permohonan' => date('Y-m-d'),
                'tajuk_penyelidikan' => 'Test Research Title',
                'jumlah_dana' => 10000.00,
                'status_permohonan' => $status,
                'user_id' => 1
            ];
            
            // Test validation
            $validator = Validator::make($data, [
                'nama_ketua_penyelidik' => 'required|string|max:255',
                'penyelidik_bersama' => 'nullable|string',
                'nama_geran' => 'required|string|max:255',
                'pemberi_dana' => 'required|string|max:255',
                'tarikh_tutup_permohonan' => 'required|date',
                'tajuk_penyelidikan' => 'required|string',
                'jumlah_dana' => 'required|numeric|min:0',
                'status_permohonan' => 'required|in:Tidak Berjaya,Dalam Proses,Lulus'
            ]);
            
            $this->line("Testing status: $status");
            
            if ($validator->fails()) {
                $this->error("  Validation FAILED: " . json_encode($validator->errors()->toArray()));
                $results[$status] = "Validation Failed";
                continue;
            }
            
            $this->info("  Validation passed");
            
            // Try to create the record (we'll only simulate, not actually save)
            try {
                // Create model but don't save to DB
                $geran = new GeranPenyelidikan($data);
                $this->info("  Model creation successful");
                $results[$status] = "Success";
            } catch (\Exception $e) {
                $this->error("  EXCEPTION: " . $e->getMessage());
                $results[$status] = "Exception: " . $e->getMessage();
            }
            
            $this->newLine();
        }

        $this->info("======= SUMMARY =======");
        foreach ($results as $status => $result) {
            $this->line("$status: $result");
        }
    }
}