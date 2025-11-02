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
        
        // Geran Penyelidikan (all time) - count ALL records, then break down by status
        $geranPenyelidikanTotal = GeranPenyelidikan::count();
        $geranPenyelidikanLulus = GeranPenyelidikan::where('status_permohonan', 'Lulus')->count();
        $geranPenyelidikanTidakBerjaya = GeranPenyelidikan::where('status_permohonan', 'Tidak Berjaya')->count();
        
        // Geran Padanan - count ALL records, then break down by status
        $geranPadananTotal = GeranPadanan::count();
        $geranPadananLulus = GeranPadanan::where('status_permohonan', 'Lulus')->count();
        $geranPadananTidakBerjaya = GeranPadanan::where('status_permohonan', 'Tidak Berjaya')->count();
        
        // Geran Industri - count ALL records, then break down by status
        $geranIndustriTotal = GeranIndustri::count();
        $geranIndustriLulus = GeranIndustri::where('status_permohonan', 'Lulus')->count();
        $geranIndustriTidakBerjaya = GeranIndustri::where('status_permohonan', 'Tidak Berjaya')->count();
        
        // Perundingan - count ALL records, then break down by status
        $perundinganTotal = Perundingan::count();
        $perundinganLulus = Perundingan::where('status_permohonan', 'Lulus')->count();
        $perundinganTidakBerjaya = Perundingan::where('status_permohonan', 'Tidak Berjaya')->count();
        
        // Kajian Kes - count ALL records, then break down by status
        $kajianKesTotal = KajianKes::count();
        $kajianKesLulus = KajianKes::where('status_permohonan', 'Lulus')->count();
        $kajianKesTidakBerjaya = KajianKes::where('status_permohonan', 'Tidak Berjaya')->count();
        
        // MoA/MoU - count ALL records, then break down by status
        $moaMouTotal = MoaMou::count();
        $moaMouLulus = MoaMou::where('status_permohonan', 'Lulus')->count();
        $moaMouTidakBerjaya = MoaMou::where('status_permohonan', 'Tidak Berjaya')->count();
        
        // Global dan Pengantarabangsaan (use proper total and status logic)
        $globalAntarabangsaTotal = Pelaporan::where('jenis', 'global_antarabangsa')->count();
        $globalAntarabangsaSelesai = Pelaporan::where('jenis', 'global_antarabangsa')
            ->where(function($query) {
                $query->whereRaw('LOWER(status) LIKE ?', ['%selesai%'])
                      ->orWhereRaw('LOWER(status) LIKE ?', ['%completed%']);
            })
            ->count();
        $globalAntarabangsaTidakBerjaya = $globalAntarabangsaTotal - $globalAntarabangsaSelesai;
        
        // Penerbitan dan Penulisan Kreatif (count SELESAI vs anything else as dalam tindakan)
        $penerbitanPenulisanTotal = Pelaporan::where('jenis', 'penerbitan_penulisan')->count();
        $penerbitanPenulisanSelesai = Pelaporan::where('jenis', 'penerbitan_penulisan')
            ->whereRaw('UPPER(status) = ?', ['SELESAI'])
            ->count();
        $penerbitanPenulisanTidakBerjaya = $penerbitanPenulisanTotal - $penerbitanPenulisanSelesai;
        
        // Inovasi dan Pengkomersilan (status is in pelaporan table)
        $inovasiPengkomersilanTotal = Pelaporan::where('jenis', 'inovasi_pengkomersilan')->count();
        $inovasiPengkomersilanSelesai = Pelaporan::where('jenis', 'inovasi_pengkomersilan')
            ->whereRaw('LOWER(status) LIKE ?', ['%selesai%'])
            ->count();
        $inovasiPengkomersilanTidakBerjaya = $inovasiPengkomersilanTotal - $inovasiPengkomersilanSelesai;
        
        // Penyelidikan dan Keusahawanan (status is in pelaporan table)
        $penyelidikanKeusahawananTotal = Pelaporan::where('jenis', 'penyelidikan_keusahawanan')->count();
        $penyelidikanKeusahawananSelesai = Pelaporan::where('jenis', 'penyelidikan_keusahawanan')
            ->whereRaw('LOWER(status) LIKE ?', ['%selesai%'])
            ->count();
        $penyelidikanKeusahawananTidakBerjaya = $penyelidikanKeusahawananTotal - $penyelidikanKeusahawananSelesai;
        
        return view('Admin.adminDashboard', compact(
            'totalUsers', 
            'currentUser',
            'geranPenyelidikanTotal',
            'geranPenyelidikanLulus',
            'geranPenyelidikanTidakBerjaya',
            'geranPadananTotal',
            'geranPadananLulus',
            'geranPadananTidakBerjaya',
            'geranIndustriTotal',
            'geranIndustriLulus',
            'geranIndustriTidakBerjaya',
            'perundinganTotal',
            'perundinganLulus',
            'perundinganTidakBerjaya',
            'kajianKesTotal',
            'kajianKesLulus',
            'kajianKesTidakBerjaya',
            'moaMouTotal',
            'moaMouLulus',
            'moaMouTidakBerjaya',
            'globalAntarabangsaTotal',
            'globalAntarabangsaSelesai',
            'globalAntarabangsaTidakBerjaya',
            'penerbitanPenulisanTotal',
            'penerbitanPenulisanSelesai',
            'penerbitanPenulisanTidakBerjaya',
            'inovasiPengkomersilanTotal',
            'inovasiPengkomersilanSelesai',
            'inovasiPengkomersilanTidakBerjaya',
            'penyelidikanKeusahawananTotal',
            'penyelidikanKeusahawananSelesai',
            'penyelidikanKeusahawananTidakBerjaya'
        ));
    }
    
    // Year filtering functionality has been removed
}