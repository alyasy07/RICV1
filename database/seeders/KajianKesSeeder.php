<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KajianKes;
use Illuminate\Support\Facades\DB;

class KajianKesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing data
        DB::table('kajian_kes')->truncate();

        $data = [
            [
                'nama_ketua_penidik' => 'DR. NORFAZLIRDA BINTI HAIRANI',
                'ahli' => 'DR. NIK SYUHAILAH BINTI NIK HUSSIN; PUAN NADIA HANUM BINTI AMIRUDDIN',
                'tajuk_kajian_kes' => 'KAJIAN KES USAHAWAN PERUNCITAN KELANTAN: EXPLORING RETAIL DYNAMICS IN KELANTAN: A CASE STUDY APPROACH',
                'bidang_projek' => '',
                'lokasi_projek' => '',
                'tajuk_penyelidikan' => 'KAJIAN KES USAHAWAN PERUNCITAN KELANTAN: EXPLORING RETAIL DYNAMICS IN KELANTAN: A CASE STUDY APPROACH',
                'jumlah_dana_dipohon' => 0.00,
                'tempoh_penyelidikan' => '',
                'status_permohonan' => 'Dalam Proses',
                'user_id' => 1
            ],
            [
                'nama_ketua_penidik' => 'DR NORSYAMLINA CHE ABDUL RAHIM',
                'ahli' => 'PM: DR ROSLIZAWATI CHE AZIZ; DR NURUL HAFIZAH MOHD YASIN; DR NORSURIANI SAMSUDIN; DR MOHD HAKAM NAZIR; DR AHMAD FAEZI ABD RASHID',
                'tajuk_kajian_kes' => 'KAJIAN KES ANALISIS KEBERKESANAN PENJAGAAN POSTNATAL: KAJIAN KES DI PELBAGAI PUSAT JAGAAN DI MALAYSIA',
                'bidang_projek' => '',
                'lokasi_projek' => '',
                'tajuk_penyelidikan' => 'KAJIAN KES ANALISIS KEBERKESANAN PENJAGAAN POSTNATAL: KAJIAN KES DI PELBAGAI PUSAT JAGAAN DI MALAYSIA',
                'jumlah_dana_dipohon' => 0.00,
                'tempoh_penyelidikan' => '',
                'status_permohonan' => 'Dalam Proses',
                'user_id' => 1
            ]
        ];

        foreach ($data as $item) {
            KajianKes::create($item);
        }

        $this->command->info('Kajian Kes data seeded successfully!');
    }
}
