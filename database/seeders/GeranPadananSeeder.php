<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GeranPadanan;
use Illuminate\Support\Facades\DB;

class GeranPadananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing data
        DB::table('geran_padanan')->truncate();

        $data = [
            [
                'nama_pemohon' => 'PROF. MADYA DR. HASIF RAFIDEE BIN HASBOLLAH',
                'institusi_terlibat' => 'UNIVERSITI MALAYSIA KELANTAN & KRUPANIDHI COLLEGE OF MANAGEMENT/BENGALURU INDIA',
                'tajuk_penyelidikan' => 'PENEROKAAN INTENSI PELANGGAN SPA MESRA MUSLIM DI MALAYSIA DAN INDONESIA: SATU KAJIAN KES',
                'jumlah_dana_dipohon' => 10000.00,
                'tempoh_penyelidikan' => '12 BULAN',
                'status_permohonan' => 'Lulus',
                'user_id' => 1
            ],
            [
                'nama_pemohon' => 'PROF. MADYA DR. HASIF RAFIDEE BIN HASBOLLAH',
                'institusi_terlibat' => 'UNIVERSITI MALAYSIA KELANTAN & PRINCE OF SONGKLA UNIVERSITY, PHUKET CAMPUS',
                'tajuk_penyelidikan' => 'DEVELOPMENT OF QUALITY ASSURANCE TOOL FOR HOSPITALITY AND WELLNESS FACILITIES IN MALAYSIA AND THAILAND',
                'jumlah_dana_dipohon' => 10000.00,
                'tempoh_penyelidikan' => '12 BULAN',
                'status_permohonan' => 'Lulus',
                'user_id' => 1
            ],
            [
                'nama_pemohon' => 'PROF. MADYA TS. DR. NIK ZULKARNAEN BIN KHIDZIR',
                'institusi_terlibat' => 'UNIVERSITI MALAYSIA KELANTAN & KRUPANIDHI COLLEGE OF MANAGEMENT/BENGALURU INDIA',
                'tajuk_penyelidikan' => 'A COMPARATIVE CASE STUDY OF CYBER SCAMMER BEHAVIOURAL PATTERNS BETWEEN MALAYSIA AND INDIA',
                'jumlah_dana_dipohon' => 0.00,
                'tempoh_penyelidikan' => '-',
                'status_permohonan' => 'Dalam Proses',
                'user_id' => 1
            ],
            [
                'nama_pemohon' => 'PROF. MADYA DR. HASIF RAFIDEE BIN HASBOLLAH',
                'institusi_terlibat' => 'UNIVERSITI MALAYSIA KELANTAN & ISTANBUL UNIVERSITY',
                'tajuk_penyelidikan' => 'MATCHING GRANT ON THE STANDARD CARE AND FACILITIES BETWEEN MALAYSIA AND TURKEY',
                'jumlah_dana_dipohon' => 10000.00,
                'tempoh_penyelidikan' => '-',
                'status_permohonan' => 'Dalam Proses',
                'user_id' => 1
            ],
            [
                'nama_pemohon' => 'TS. DR. NOOR JANATUN NAIM BINTI JEMALI',
                'institusi_terlibat' => 'UNIVERSITI MALAYSIA KELANTAN & SCAAI ALLIANCE SINGAPORE',
                'tajuk_penyelidikan' => 'REBRANDING JELI FOR SUSTAINABLE ECO-CULTURAL TOURISM',
                'jumlah_dana_dipohon' => 445000.00,
                'tempoh_penyelidikan' => '-',
                'status_permohonan' => 'Tidak Berjaya',
                'user_id' => 1
            ],
            [
                'nama_pemohon' => 'PROF. MADYA DR. ROSLIZAWATI BINTI CHE AZIZ',
                'institusi_terlibat' => 'UNIVERSITI MALAYSIA KELANTAN & SCAAI ALLIANCE SINGAPORE',
                'tajuk_penyelidikan' => 'SMARTROOTS: EMPOWERING COMMUNITY-LED ECOTOURISM THROUGH DIGITAL & SUSTAINABLE INNOVATION IN JELI, KELANTAN',
                'jumlah_dana_dipohon' => 550000.00,
                'tempoh_penyelidikan' => '-',
                'status_permohonan' => 'Tidak Berjaya',
                'user_id' => 1
            ],
            // Additional 3 records from the new attachment
            [
                'nama_pemohon' => 'PROF. MADYA DR. ROSLIZAWATI BINTI CHE AZIZ',
                'institusi_terlibat' => 'UNIVERSITI MALAYSIA KELANTAN & PRINCE OF SONGKLA UNIVERSITY, PHUKET CAMPUS',
                'tajuk_penyelidikan' => 'ADOPTION INTENTION OF GREYWATER SYSTEM FOR HOTEL INDUSTRY: A CASE STUDY IN LANGKAWI, MALAYSIA',
                'jumlah_dana_dipohon' => 10000.00,
                'tempoh_penyelidikan' => '12 BULAN',
                'status_permohonan' => 'Dalam Proses',
                'user_id' => 1
            ],
            [
                'nama_pemohon' => 'PROF. MADYA DR. ROSLIZAWATI BINTI CHE AZIZ',
                'institusi_terlibat' => 'UNIVERSITI MALAYSIA KELANTAN & PRINCE OF SONGKLA UNIVERSITY, PHUKET CAMPUS',
                'tajuk_penyelidikan' => 'MEASURING HAWKERS\' CULTURAL ETHNOCENTRISM AND ATTACHMENT TO LOCA FOOD: A GASTRONOMICAL COMPARISON BETWEEN THAILAND AND MALAYSIA',
                'jumlah_dana_dipohon' => 10000.00,
                'tempoh_penyelidikan' => '12 BULAN',
                'status_permohonan' => 'Dalam Proses',
                'user_id' => 1
            ],
            [
                'nama_pemohon' => 'DR NURHAIDHA NORDIN',
                'institusi_terlibat' => 'UNIVERSITI MALAYSIA KELANTAN & KRUPANIDHI COLLEGE OF MANAGEMENT/BENGALURU INDIA',
                'tajuk_penyelidikan' => 'DIGITAL PAYMENT ADOPTION AND ITS IMPACT ON MSME GROWTH: A COMPARATIVE STUDY BETWEEN MALAYSIAN AND INDIA',
                'jumlah_dana_dipohon' => 10000.00,
                'tempoh_penyelidikan' => '12 BULAN',
                'status_permohonan' => 'Dalam Proses',
                'user_id' => 1
            ]
        ];

        foreach ($data as $item) {
            GeranPadanan::create($item);
        }

        $this->command->info('Geran Padanan data seeded successfully!');
    }
}