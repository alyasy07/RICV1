<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Perundingan;
use Illuminate\Support\Facades\DB;

class PerundinganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing data
        DB::table('perundingan')->truncate();

        $data = [
            [
                'nama_ketua_penyelidik' => 'TS. DR. NOOR JANATUN NAIM BINTI JEMALI',
                'penyelidik_bersama' => 'I: PROF. MADYA DR. ROSLIZAWATI BINTI CHE AZIZ, II: PROF. MADYA DR. ANIS AMIRA BT AB RAHMAN',
                'nama_pelanggan' => 'GLOBAL ENVIRONMENT CENTRE (GEC)',
                'bidang_projek' => 'PERHUTANAN, PELANCONGAN DAN KEUSAHAWANAN',
                'lokasi_projek' => 'SUNGAI SIPUT, PERAK',
                'tajuk_penyelidikan' => 'DEVELOPMENT OF SUSTAINABLE COMMUNITY BUSINESS MODEL FOR KAMPUNG ORANG ASLI KENANG AND ENHANCEMENT OF EXISTING BUSINESS PLAN MODEL FOR THE ECOTOURISM INITIATIVES AT KAMPUNG ORANG ASLI TONGGANG, PERAK',
                'jumlah_dana_dipohon' => 20000.00,
                'tempoh_penyelidikan' => '4 BULAN (23 JUN 2025 - 23 OKT 2025)',
                'status_permohonan' => 'Dalam Proses',
                'user_id' => 1
            ]
        ];

        foreach ($data as $item) {
            Perundingan::create($item);
        }

        $this->command->info('Perundingan data seeded successfully!');
    }
}