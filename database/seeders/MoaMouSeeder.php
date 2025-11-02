<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MoaMou;
use Illuminate\Support\Facades\DB;

class MoaMouSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing data
        DB::table('moa_mou')->truncate();

        $data = [
            [
                'jenis_perundingan' => 'MoU',
                'agensi_terlibat' => 'UNIVERSITI MALAYSIA KELANTAN (UMK) & LEMBAGA KEMAJUAN KELANTAN SELATAN (KESEDAR)',
                'tajuk_penyelidikan' => 'KERJASAMA BERKAITAN PENYELIDIKAN, KEUSAHAWANAN, PROGRAM LATIHAN, PERUNDINGAN, PEMINDAHAN ILMU DAN INOVASI',
                'status_permohonan' => 'Dalam Proses',
                'user_id' => 1
            ],
            [
                'jenis_perundingan' => 'MoU',
                'agensi_terlibat' => 'UNIVERSITI MALAYSIA KELANTAN (UMK) & SCAVAI ALLIANCE PTE LTD',
                'tajuk_penyelidikan' => 'KERJASAMA BERKAITAN PENYELIDIKAN, KEUSAHAWANAN, PROGRAM LATIHAN, PERUNDINGAN, PEMINDAHAN ILMU DAN INOVASI',
                'status_permohonan' => 'Dalam Proses',
                'user_id' => 1
            ]
        ];

        foreach ($data as $item) {
            MoaMou::create($item);
        }

        $this->command->info('MoA/MoU data seeded successfully!');
    }
}