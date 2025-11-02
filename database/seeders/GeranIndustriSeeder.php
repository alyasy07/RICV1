<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GeranIndustri;
use Illuminate\Support\Facades\DB;

class GeranIndustriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing data
        DB::table('geran_industri')->truncate();

        $data = [
            [
                'nama_pemohon' => 'PROF. MADYA DR. ROSLIZAWATI BINTI CHE AZIZ',
                'institusi_terlibat' => 'KPT TIP DANA PROGRAM TALULLAH INDUSTRI DAN PROFESIONAL',
                'tajuk_penyelidikan' => 'LATIHAN PROGRAM PROFESSIONAL MUTAWIF & MUSLIM TOUR LEADER',
                'jumlah_dana_dipohon' => 550000.00,
                'tempoh_penyelidikan' => '-',
                'status_permohonan' => 'Dalam Proses',
                'user_id' => 1
            ],
            [
                'nama_pemohon' => 'PROF. MADYA DR. ROSLIZAWATI BINTI CHE AZIZ',
                'institusi_terlibat' => 'KPT TIP DANA PROGRAM TALULLAH INDUSTRI DAN PROFESIONAL',
                'tajuk_penyelidikan' => 'PROGRAM PROFESSIONAL SPA & WELLNESS MANAGEMENT TRAINER',
                'jumlah_dana_dipohon' => 605000.00,
                'tempoh_penyelidikan' => '-',
                'status_permohonan' => 'Dalam Proses',
                'user_id' => 1
            ]
        ];

        foreach ($data as $item) {
            GeranIndustri::create($item);
        }

        $this->command->info('Geran Industri data seeded successfully!');
    }
}