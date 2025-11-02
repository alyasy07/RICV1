<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pelaporan;
use App\Models\PenerbitanPenulisan;
use Illuminate\Support\Facades\DB;

class PenerbitanPenulisanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Truncate tables to start fresh
        DB::table('penerbitan_penulisan')->truncate();
        
        // Delete existing Pelaporan records for this jenis to avoid conflicts
        Pelaporan::where('jenis', 'penerbitan_penulisan')->delete();

        $data = [
            [
                'title' => 'Kajian kes tentang dasar perlindungan sosial di Malaysia',
                'pemberi_dana' => null,
                'tarikh_tutup' => null,
                'jumlah_dana' => null,
                'status' => 'SELESAI',
                'user_id' => 'ADMIN365'
            ],
            [
                'title' => 'Artikel jurnal tentang kesan ekonomi COVID-19 terhadap sektor pelancongan',
                'pemberi_dana' => null,
                'tarikh_tutup' => null,
                'jumlah_dana' => null,
                'status' => 'dalam tindakan',
                'user_id' => 'ADMIN365'
            ],
            [
                'title' => 'Penulisan buku mengenai transformasi digital dalam pendidikan tinggi',
                'pemberi_dana' => null,
                'tarikh_tutup' => null,
                'jumlah_dana' => null,
                'status' => 'dalam tindakan',
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
                'jenis' => 'penerbitan_penulisan'
            ]);

            // Create the related PenerbitanPenulisan record for the foreign key relationship
            PenerbitanPenulisan::create([
                'pelaporan_id' => $pelaporan->id
            ]);
        }

        $this->command->info('PenerbitanPenulisan seeder completed successfully!');
        $this->command->info('Added 3 publication records.');
    }
}