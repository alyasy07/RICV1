<?php
// app/Http/Controllers/Admin/DashboardController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\GeranPenyelidikan;
use App\Models\GeranPadanan;
use App\Models\GeranIndustri;
use App\Models\Perundingan;
use App\Models\KajianKes;
use App\Models\MoaMou;
use App\Models\Pelaporan;
use App\Models\GlobalAntarabangsa;
use App\Models\PenerbitanPenulisan;
use App\Models\InovasiPengkomersilan;
use App\Models\PenyelidikanKeusahawanan;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $currentUser = auth()->user();
        $currentYear = date('Y');
        
        // Total users
        $totalUsers = User::count();
        
        // Geran Penyelidikan (all time)
        $geranPenyelidikanLulus = GeranPenyelidikan::where('status_permohonan', 'Lulus')->count();
        $geranPenyelidikanTidakBerjaya = GeranPenyelidikan::where('status_permohonan', 'Tidak Berjaya')->count();
        
        // Geran Padanan
        $geranPadananLulus = GeranPadanan::where('status_permohonan', 'Lulus')->count();
        $geranPadananTidakBerjaya = GeranPadanan::where('status_permohonan', 'Tidak Berjaya')->count();
        
        // Geran Industri
        $geranIndustriLulus = GeranIndustri::where('status_permohonan', 'Lulus')->count();
        $geranIndustriTidakBerjaya = GeranIndustri::where('status_permohonan', 'Tidak Berjaya')->count();
        
        // Perundingan
        $perundinganLulus = Perundingan::where('status_permohonan', 'Lulus')->count();
        $perundinganTidakBerjaya = Perundingan::where('status_permohonan', 'Tidak Berjaya')->count();
        
        // Kajian Kes
        $kajianKesLulus = KajianKes::where('status_permohonan', 'Lulus')->count();
        $kajianKesTidakBerjaya = KajianKes::where('status_permohonan', 'Tidak Berjaya')->count();
        
        // MoA/MoU
        $moaMouLulus = MoaMou::where('status_permohonan', 'Lulus')->count();
        $moaMouTidakBerjaya = MoaMou::where('status_permohonan', 'Tidak Berjaya')->count();
        
        // Global dan Pengantarabangsaan (status is in pelaporan table)
        $globalAntarabangsaSelesai = Pelaporan::where('jenis', 'global_antarabangsa')
            ->whereRaw('LOWER(status) LIKE ?', ['%selesai%'])
            ->count();
        $globalAntarabangsaTidakBerjaya = Pelaporan::where('jenis', 'global_antarabangsa')
            ->whereRaw('LOWER(status) LIKE ?', ['%tidak berjaya%'])
            ->count();
        
        // Penerbitan dan Penulisan Kreatif (status is in pelaporan table)
        $penerbitanPenulisanSelesai = Pelaporan::where('jenis', 'penerbitan_penulisan')
            ->whereRaw('LOWER(status) LIKE ?', ['%selesai%'])
            ->count();
        $penerbitanPenulisanTidakBerjaya = Pelaporan::where('jenis', 'penerbitan_penulisan')
            ->whereRaw('LOWER(status) LIKE ?', ['%tidak berjaya%'])
            ->count();
        
        // Inovasi dan Pengkomersilan (status is in pelaporan table)
        $inovasiPengkomersilanSelesai = Pelaporan::where('jenis', 'inovasi_pengkomersilan')
            ->whereRaw('LOWER(status) LIKE ?', ['%selesai%'])
            ->count();
        $inovasiPengkomersilanTidakBerjaya = Pelaporan::where('jenis', 'inovasi_pengkomersilan')
            ->whereRaw('LOWER(status) LIKE ?', ['%tidak berjaya%'])
            ->count();
        
        // Penyelidikan dan Keusahawanan (status is in pelaporan table)
        $penyelidikanKeusahawananSelesai = Pelaporan::where('jenis', 'penyelidikan_keusahawanan')
            ->whereRaw('LOWER(status) LIKE ?', ['%selesai%'])
            ->count();
        $penyelidikanKeusahawananTidakBerjaya = Pelaporan::where('jenis', 'penyelidikan_keusahawanan')
            ->whereRaw('LOWER(status) LIKE ?', ['%tidak berjaya%'])
            ->count();
        
        return view('Admin.adminDashboard', compact(
            'totalUsers', 
            'currentUser',
            'geranPenyelidikanLulus',
            'geranPenyelidikanTidakBerjaya',
            'geranPadananLulus',
            'geranPadananTidakBerjaya',
            'geranIndustriLulus',
            'geranIndustriTidakBerjaya',
            'perundinganLulus',
            'perundinganTidakBerjaya',
            'kajianKesLulus',
            'kajianKesTidakBerjaya',
            'moaMouLulus',
            'moaMouTidakBerjaya',
            'globalAntarabangsaSelesai',
            'globalAntarabangsaTidakBerjaya',
            'penerbitanPenulisanSelesai',
            'penerbitanPenulisanTidakBerjaya',
            'inovasiPengkomersilanSelesai',
            'inovasiPengkomersilanTidakBerjaya',
            'penyelidikanKeusahawananSelesai',
            'penyelidikanKeusahawananTidakBerjaya'
        ));
    }
    
    // Year filtering functionality has been removed
}