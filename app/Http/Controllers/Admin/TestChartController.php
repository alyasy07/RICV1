<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestChartController extends Controller
{
    public function showTestDashboard()
    {
        // Generate some sample data
        $data = [
            'geranPenyelidikanLulus' => 10,
            'geranPenyelidikanTidakBerjaya' => 5,
            'geranPadananLulus' => 8,
            'geranPadananTidakBerjaya' => 3,
            'geranIndustriLulus' => 12,
            'geranIndustriTidakBerjaya' => 2,
            'perundinganLulus' => 7,
            'perundinganTidakBerjaya' => 4,
            'kajianKesLulus' => 9,
            'kajianKesTidakBerjaya' => 1,
            'moaMouLulus' => 15,
            'moaMouTidakBerjaya' => 3,
            'globalAntarabangsaSelesai' => 6,
            'globalAntarabangsaTidakBerjaya' => 2,
            'penerbitanPenulisanSelesai' => 14,
            'penerbitanPenulisanTidakBerjaya' => 5,
            'inovasiPengkomersilanSelesai' => 8,
            'inovasiPengkomersilanTidakBerjaya' => 3,
            'penyelidikanKeusahawananSelesai' => 11,
            'penyelidikanKeusahawananTidakBerjaya' => 4,
        ];

        // Sample yearly data
        $yearlyData = [
            '2023' => $data,
            '2024' => $data,
            '2025' => $data,
        ];

        return view('Admin.test_dashboard', $data, compact('yearlyData'));
    }
}