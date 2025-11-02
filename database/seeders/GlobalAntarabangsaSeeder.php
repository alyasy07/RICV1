<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pelaporan;
use App\Models\GlobalAntarabangsa;
use Illuminate\Support\Facades\DB;

class GlobalAntarabangsaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Truncate tables to start fresh
        DB::table('global_antarabangsa')->truncate();
        
        // Delete existing Pelaporan records for this jenis to avoid conflicts
        Pelaporan::where('jenis', 'global_antarabangsa')->delete();

        $data = [
            [
                'title' => 'Geran Jangka Pendek Kajian Kertas Polisi IKRAM : Merancang Dasar Literasi Digital Guru: Kerangka Pelaksanaan untuk Transformasi Pendidikan 4.0 di Malaysia (RM 6050.00)',
                'pemberi_dana' => null,
                'tarikh_tutup' => null,
                'jumlah_dana' => 6050.00,
                'status' => 'Progress - Data Analysis (Nov 2025)',
                'user_id' => 'ADMIN365'
            ],
            [
                'title' => 'Perundingan : Projek Perundingan Pemindahan Ilmu Kapakaitan Penyelidikan, Inovasi dan Penerbitan MARA 2025 (RM 17,000.00)',
                'pemberi_dana' => null,
                'tarikh_tutup' => null,
                'jumlah_dana' => 17000.00,
                'status' => 'Completed (September 2025)',
                'user_id' => 'ADMIN365'
            ],
            [
                'title' => 'Joint Authorship UMK & Universitas Medan Area (UMA) book entitled " Inspiring Innovation Through Entrepreneurship", IGI Global Scientific Professional, USA. Ahmad Rafiki (UMA), Nik Zulkarnaen Khidzir (GERIC/ FTKW, UMK), Dzulkifli Mukhtar (FKP, UMK)',
                'pemberi_dana' => 'GERIC',
                'tarikh_tutup' => '2026-03-01',
                'jumlah_dana' => 2000.00,
                'status' => 'Cadangan Permohonan Dana - Bengkel Penurniran Manuskrip (RM 2,000). Final Review and Editing (Expected to publish 2026)',
                'user_id' => 'ADMIN365'
            ],
            [
                'title' => 'Keynote Speaker : Hybrid Webinar on Digital Literacy for English Language Instructors in Higher Educational Institutions (HEIs)',
                'pemberi_dana' => 'SEGI University',
                'tarikh_tutup' => null,
                'jumlah_dana' => null,
                'status' => '3 June 2025 - Completed',
                'user_id' => 'ADMIN365'
            ],
            [
                'title' => 'Keynote Speaker : 2nd INTERNATIONAL CONFERENCE ON CUTTING EDGE TECHNOLOGY IN COMPUTING COMMUNICATION AND INTELLIGENCE 2025 CUTTACK, INDIA',
                'pemberi_dana' => 'IMIT, Bhubaneswar, Odisha, India',
                'tarikh_tutup' => null,
                'jumlah_dana' => null,
                'status' => '28s - 296 March - 2025 at 8th Floor, World Skill Center, Mancheswar, Bhubaneswar, Odisha, India',
                'user_id' => 'ADMIN365'
            ],
            [
                'title' => 'Keynote Speaker : International Public Lecture and Workshop with the theme "Optimalisasi Teknologi Digital dalam Manajemen Sekolah dan Pembelajaran Berbasis AI"',
                'pemberi_dana' => 'Faculty of Teacher Training and Education Universitas Srivijaya, Palembang Indonesia',
                'tarikh_tutup' => null,
                'jumlah_dana' => null,
                'status' => 'May 9 and 10, 2025, Universitas Srivijaya, Palembang Indonesia',
                'user_id' => 'ADMIN365'
            ],
            [
                'title' => 'International PhD Thesis External Examiner : "Detection and Analysis of Heart Disease with Deep Learning Techniques"',
                'pemberi_dana' => 'Faculty of Engineering & Technology, Shoolini University of Biotechnology and Management Sciences, Solan, India',
                'tarikh_tutup' => null,
                'jumlah_dana' => null,
                'status' => 'Completed - 24 July 2025',
                'user_id' => 'ADMIN365'
            ]
        ];

        foreach ($data as $item) {
            // Create the main pelaporan record
            $pelaporan = Pelaporan::create([
                'user_id' => $item['user_id'],
                'title' => $item['title'],
                'pemberi_dana' => $item['pemberi_dana'],
                'tarikh_tutup' => $item['tarikh_tutup'],
                'jumlah_dana' => $item['jumlah_dana'],
                'status' => $item['status'],
                'jenis' => 'global_antarabangsa'
            ]);

            // Create the related GlobalAntarabangsa record for the foreign key relationship
            GlobalAntarabangsa::create([
                'pelaporan_id' => $pelaporan->id
            ]);
        }

        $this->command->info('GlobalAntarabangsa seeder completed successfully!');
        $this->command->info('Added 7 global dan pengantarabangsaan records.');
        $this->command->info('Total funding: RM ' . number_format(array_sum(array_filter(array_column($data, 'jumlah_dana'))), 2));
    }
}