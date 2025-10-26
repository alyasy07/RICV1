<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard - GERIC</title>
    <link rel="icon" type="image/png" sizes="180x180" href="{{ asset('images/bulat_logo2.png') }}">
    <link href="{{ asset('css/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Edu+NSW+ACT+Cursive:wght@400..700&display=swap" rel="stylesheet">
  
    <style>
        /* Page background only — do not change card styles */
        html, body, #wrapper, #content-wrapper {
          min-height: 100%;
          height: 100%;
          background: linear-gradient(180deg, #fff7ed 0%, #fff6eaff 100%) fixed;
          background-repeat: no-repeat;
        }

        /* Make sure containers are transparent so the page background shows through */
        .container, .container-fluid, #content {
          background: transparent !important;
        }
        
        /* Card hover and clickable styles */
        .card-clickable {
          transition: all 0.3s ease;
          cursor: pointer;
          position: relative;
          overflow: hidden;
        }
        
        .card-clickable:hover {
          transform: translateY(-5px);
          box-shadow: 0 10px 20px rgba(0,0,0,0.15) !important;
        }
        
        .card-clickable::after {
          content: '';
          position: absolute;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          background: rgba(255,255,255,0.1);
          opacity: 0;
          transition: all 0.3s ease;
        }
        
        .card-clickable:hover::after {
          opacity: 1;
        }
        
        .card-clickable:active {
          transform: translateY(-2px);
          box-shadow: 0 5px 10px rgba(0,0,0,0.1) !important;
        }
        
        /* Ripple effect style */
        .ripple {
            position: absolute;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.5);
            width: 5px;
            height: 5px;
            animation: ripple-effect 0.6s ease-out;
            transform: scale(0);
        }
        
        @keyframes ripple-effect {
            0% {
                transform: scale(0);
                opacity: 1;
            }
            100% {
                transform: scale(80);
                opacity: 0;
            }
        }
    </style>
  
</head>
<body id="page-top">
    
    <div id="wrapper">
        @include('layouts.sidebar')
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('layouts.header')
                <div class="container-fluid">
                    <!-- Welcome Banner -->
                    <div class="card shadow mb-4" style="background: linear-gradient(135deg, #f97316 0%, #7c3aed 100%); border: none;">
                        <div class="card-body py-4">
                            <div class="d-flex align-items-center text-white">
                                <i class="fas fa-building fa-3x mr-3"></i>
                                <div>
                                    <h3 class="mb-2 font-weight-bold">Selamat Datang ke Sistem Pengurusan Laporan</h3>
                                    <p class="mb-0">Portal rasmi untuk pengurusan dan pemantauan laporan. Sistem ini menyediakan akses selamat dan terkini kepada maklumat laporan penting untuk memastikan transparansi dan keberkesanan dalam pentadbiran awam.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Statistics Title -->
                    <h4 class="mb-4 font-weight-bold text-gray-800">Statistik</h4>

                    <!-- Statistics Section - Row 1 -->
                    <div class="row">
                        <!-- Geran Penyelidikan -->
                        <div class="col-xl-2 col-md-4 col-sm-6 mb-4">
                            <div class="card shadow h-100 py-3 card-clickable" onclick="window.location.href='{{ route('admin.geranpenyelidikan') }}'">
                                <div class="card-body text-center">
                                    <h1 class="font-weight-bold mb-1" style="color: #C86CB7;">{{ $geranPenyelidikanLulus + $geranPenyelidikanTidakBerjaya }}</h1>
                                    <div class="text-xs font-weight-bold text-dark mb-3">Geran Penyelidikan</div>
                                    <div class="mb-2">
                                        <span class="text-muted small">Lulus</span>
                                        <span class="text-warning font-weight-bold ml-2">{{ $geranPenyelidikanLulus }}</span>
                                    </div>
                                    <div>
                                        <span class="text-muted small">Tidak Berjaya</span>
                                        <span class="text-warning Font-weight-bold ml-2">{{ $geranPenyelidikanTidakBerjaya }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Geran Padanan -->
                        <div class="col-xl-2 col-md-4 col-sm-6 mb-4">
                            <div class="card shadow h-100 py-3 card-clickable" onclick="window.location.href='{{ route('admin.geranpadanan') }}'">
                                <div class="card-body text-center">
                                    <h1 class="font-weight-bold mb-1" style="color: #fbbf24;">{{ $geranPadananLulus + $geranPadananTidakBerjaya }}</h1>
                                    <div class="text-xs font-weight-bold text-dark mb-3">Geran Padanan</div>
                                    <div class="mb-2">
                                        <span class="text-muted small">Lulus</span>
                                        <span class="text-warning font-weight-bold ml-2">{{ $geranPadananLulus }}</span>
                                    </div>
                                    <div>
                                        <span class="text-muted small">Tidak Berjaya</span>
                                        <span class="text-warning font-weight-bold ml-2">{{ $geranPadananTidakBerjaya }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Geran Industri -->
                        <div class="col-xl-2 col-md-4 col-sm-6 mb-4">
                            <div class="card shadow h-100 py-3 card-clickable" onclick="window.location.href='{{ route('admin.granindustri') }}'">
                                <div class="card-body text-center">
                                    <h1 class="font-weight-bold mb-1" style="color: #ec4899;">{{ $geranIndustriLulus + $geranIndustriTidakBerjaya }}</h1>
                                    <div class="text-xs font-weight-bold text-dark mb-3">Geran Industri</div>
                                    <div class="mb-2">
                                        <span class="text-muted small">Lulus</span>
                                        <span class="text-warning font-weight-bold ml-2">{{ $geranIndustriLulus }}</span>
                                    </div>
                                    <div>
                                        <span class="text-muted small">Tidak Berjaya</span>
                                        <span class="text-warning font-weight-bold ml-2">{{ $geranIndustriTidakBerjaya }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Perundingan -->
                        <div class="col-xl-2 col-md-4 col-sm-6 mb-4">
                            <div class="card shadow h-100 py-3 card-clickable" onclick="window.location.href='{{ route('admin.perundingan') }}'">
                                <div class="card-body text-center">
                                    <h1 class="font-weight-bold mb-1" style="color: #10b981;">{{ $perundinganLulus + $perundinganTidakBerjaya }}</h1>
                                    <div class="text-xs font-weight-bold text-dark mb-3">Perundingan</div>
                                    <div class="mb-2">
                                        <span class="text-muted small">Lulus</span>
                                        <span class="text-warning font-weight-bold ml-2">{{ $perundinganLulus }}</span>
                                    </div>
                                    <div>
                                        <span class="text-muted small">Tidak Berjaya</span>
                                        <span class="text-warning font-weight-bold ml-2">{{ $perundinganTidakBerjaya }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Kajian Kes -->
                        <div class="col-xl-2 col-md-4 col-sm-6 mb-4">
                            <div class="card shadow h-100 py-3 card-clickable" onclick="window.location.href='{{ route('admin.kajiankes') }}'">
                                <div class="card-body text-center">
                                    <h1 class="font-weight-bold mb-1" style="color: #6366f1;">{{ $kajianKesLulus + $kajianKesTidakBerjaya }}</h1>
                                    <div class="text-xs font-weight-bold text-dark mb-3">Kajian Kes</div>
                                    <div class="mb-2">
                                        <span class="text-muted small">Lulus</span>
                                        <span class="text-warning font-weight-bold ml-2">{{ $kajianKesLulus }}</span>
                                    </div>
                                    <div>
                                        <span class="text-muted small">Tidak Berjaya</span>
                                        <span class="text-warning font-weight-bold ml-2">{{ $kajianKesTidakBerjaya }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- MoA/MoU -->
                        <div class="col-xl-2 col-md-4 col-sm-6 mb-4">
                            <div class="card shadow h-100 py-3 card-clickable" onclick="window.location.href='{{ route('admin.moamou') }}'">
                                <div class="card-body text-center">
                                    <h1 class="font-weight-bold mb-1" style="color: #f97316;">{{ $moaMouLulus + $moaMouTidakBerjaya }}</h1>
                                    <div class="text-xs font-weight-bold text-dark mb-3">MoA/MoU</div>
                                    <div class="mb-2">
                                        <span class="text-muted small">Lulus</span>
                                        <span class="text-warning font-weight-bold ml-2">{{ $moaMouLulus }}</span>
                                    </div>
                                    <div>
                                        <span class="text-muted small">Tidak Berjaya</span>
                                        <span class="text-warning font-weight-bold ml-2">{{ $moaMouTidakBerjaya }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Statistics Section - Row 2 -->
                    <div class="row">
                        <!-- Global dan Pengantarabangsaan -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card shadow h-100 py-3 card-clickable" onclick="window.location.href='{{ route('admin.globalantarabangsa') }}'">
                                <div class="card-body text-center">
                                    <h1 class="font-weight-bold mb-1" style="color: #6366f1;">{{ $globalAntarabangsaSelesai + $globalAntarabangsaTidakBerjaya }}</h1>
                                    <div class="text-xs font-weight-bold text-dark mb-3">Global dan Pengantarabangsaan</div>
                                    <div class="mb-2">
                                        <span class="text-muted small">Selesai</span>
                                        <span class="text-warning font-weight-bold ml-2">{{ $globalAntarabangsaSelesai }}</span>
                                    </div>
                                    <div>
                                        <span class="text-muted small">Tidak Berjaya</span>
                                        <span class="text-warning font-weight-bold ml-2">{{ $globalAntarabangsaTidakBerjaya }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Penerbitan dan Penulisan Kreatif -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card shadow h-100 py-3 card-clickable" onclick="window.location.href='{{ route('admin.penerbitanpenulisan') }}'">
                                <div class="card-body text-center">
                                    <h1 class="font-weight-bold mb-1" style="color: #ef4444;">{{ $penerbitanPenulisanSelesai + $penerbitanPenulisanTidakBerjaya }}</h1>
                                    <div class="text-xs font-weight-bold text-dark mb-3">Penerbitan dan Penulisan Kreatif</div>
                                    <div class="mb-2">
                                        <span class="text-muted small">Selesai</span>
                                        <span class="text-warning font-weight-bold ml-2">{{ $penerbitanPenulisanSelesai }}</span>
                                    </div>
                                    <div>
                                        <span class="text-muted small">Tidak Berjaya</span>
                                        <span class="text-warning font-weight-bold ml-2">{{ $penerbitanPenulisanTidakBerjaya }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Inovasi dan Pengkomersilan -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card shadow h-100 py-3 card-clickable" onclick="window.location.href='{{ route('admin.inovasipengkomersilan') }}'">
                                <div class="card-body text-center">
                                    <h1 class="font-weight-bold mb-1" style="color: #3b82f6;">{{ $inovasiPengkomersilanSelesai + $inovasiPengkomersilanTidakBerjaya }}</h1>
                                    <div class="text-xs font-weight-bold text-dark mb-3">Inovasi dan Pengkomersilan</div>
                                    <div class="mb-2">
                                        <span class="text-muted small">Selesai</span>
                                        <span class="text-warning font-weight-bold ml-2">{{ $inovasiPengkomersilanSelesai }}</span>
                                    </div>
                                    <div>
                                        <span class="text-muted small">Tidak Berjaya</span>
                                        <span class="text-warning font-weight-bold ml-2">{{ $inovasiPengkomersilanTidakBerjaya }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Penyelidikan dan Keusahawanan -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card shadow h-100 py-3 card-clickable" onclick="window.location.href='{{ route('admin.penyelidikankeusahawanan') }}'">
                                <div class="card-body text-center">
                                    <h1 class="font-weight-bold mb-1" style="color: #8b5cf6;">{{ $penyelidikanKeusahawananSelesai + $penyelidikanKeusahawananTidakBerjaya }}</h1>
                                    <div class="text-xs font-weight-bold text-dark mb-3">Penyelidikan dan Keusahawanan</div>
                                    <div class="mb-2">
                                        <span class="text-muted small">Selesai</span>
                                        <span class="text-warning font-weight-bold ml-2">{{ $penyelidikanKeusahawananSelesai }}</span>
                                    </div>
                                    <div>
                                        <span class="text-muted small">Tidak Berjaya</span>
                                        <span class="text-warning font-weight-bold ml-2">{{ $penyelidikanKeusahawananTidakBerjaya }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Chart Analytics Section -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Analisis Data</h6>
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <select id="reportTypeFilter" class="form-control form-control-sm">
                                                <option value="all">Semua Jenis</option>
                                                <option value="permohonan">Permohonan</option>
                                                <option value="pelaporan">Pelaporan</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="chart-container" style="position: relative; height:300px;">
                                                <canvas id="statusChart"></canvas>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="chart-container" style="position: relative; height:300px;">
                                                <canvas id="categoryChart"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; GERIC {{ date('Y') }}</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>
    
    <!-- Core JS -->
    <script src="{{ asset('js/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('js/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
    
    <!-- Chart.js - Using CDN without integrity check that was causing issues -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
    
    <script>
        // Global error handler
        window.onerror = function(message, source, lineno, colno, error) {
            console.error('Global error caught:', message, 'at', source, 'line', lineno, error);
            return false;
        };
        
        $(document).ready(function() {
            console.log('Document ready, preparing charts');
            
            // Add ripple effect for clickable cards
            $('.card-clickable').on('mousedown', function(e) {
                var card = $(this);
                var x = e.pageX - card.offset().left;
                var y = e.pageY - card.offset().top;
                
                var ripple = $('<span class="ripple"></span>');
                ripple.css({
                    left: x + 'px',
                    top: y + 'px'
                });
                
                card.append(ripple);
                
                setTimeout(function() {
                    ripple.remove();
                }, 600);
            });
            
            // Global variables
            let statusChart, categoryChart;
            let currentReportType = 'all';
            
            // Store data categorized by type to make filtering easier
            const categoryDataByType = {
                'permohonan': {
                    labels: ['Geran Penyelidikan', 'Geran Padanan', 'Geran Industri', 'Perundingan', 'Kajian Kes', 'MoA/MoU'],
                    values: [
                        {{ $geranPenyelidikanLulus + $geranPenyelidikanTidakBerjaya }},
                        {{ $geranPadananLulus + $geranPadananTidakBerjaya }},
                        {{ $geranIndustriLulus + $geranIndustriTidakBerjaya }},
                        {{ $perundinganLulus + $perundinganTidakBerjaya }},
                        {{ $kajianKesLulus + $kajianKesTidakBerjaya }},
                        {{ $moaMouLulus + $moaMouTidakBerjaya }}
                    ],
                    colors: ['#C86CB7', '#fbbf24', '#ec4899', '#10b981', '#6366f1', '#f97316']
                },
                'pelaporan': {
                    labels: ['Global & Antarabangsa', 'Penerbitan', 'Inovasi', 'Penyelidikan'],
                    values: [
                        {{ $globalAntarabangsaSelesai + $globalAntarabangsaTidakBerjaya }},
                        {{ $penerbitanPenulisanSelesai + $penerbitanPenulisanTidakBerjaya }},
                        {{ $inovasiPengkomersilanSelesai + $inovasiPengkomersilanTidakBerjaya }},
                        {{ $penyelidikanKeusahawananSelesai + $penyelidikanKeusahawananTidakBerjaya }}
                    ],
                    colors: ['#6366f1', '#ef4444', '#3b82f6', '#8b5cf6']
                },
                'all': {
                    labels: ['Geran Penyelidikan', 'Geran Padanan', 'Geran Industri', 'Perundingan', 'Kajian Kes', 'MoA/MoU', 'Global', 'Penerbitan', 'Inovasi', 'Penyelidikan'],
                    values: [
                        {{ $geranPenyelidikanLulus + $geranPenyelidikanTidakBerjaya }},
                        {{ $geranPadananLulus + $geranPadananTidakBerjaya }},
                        {{ $geranIndustriLulus + $geranIndustriTidakBerjaya }},
                        {{ $perundinganLulus + $perundinganTidakBerjaya }},
                        {{ $kajianKesLulus + $kajianKesTidakBerjaya }},
                        {{ $moaMouLulus + $moaMouTidakBerjaya }},
                        {{ $globalAntarabangsaSelesai + $globalAntarabangsaTidakBerjaya }},
                        {{ $penerbitanPenulisanSelesai + $penerbitanPenulisanTidakBerjaya }},
                        {{ $inovasiPengkomersilanSelesai + $inovasiPengkomersilanTidakBerjaya }},
                        {{ $penyelidikanKeusahawananSelesai + $penyelidikanKeusahawananTidakBerjaya }}
                    ],
                    colors: ['#C86CB7', '#fbbf24', '#ec4899', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b', '#8b5cf6', '#f97316', '#6366f1']
                }
            };
            
            // Similarly organize status data by type
            const statusDataByType = {
                'permohonan': {
                    labels: ['Lulus', 'Tidak Berjaya'],
                    values: [
                        {{ $geranPenyelidikanLulus + $geranPadananLulus + $geranIndustriLulus + 
                           $perundinganLulus + $kajianKesLulus + $moaMouLulus }},
                        {{ $geranPenyelidikanTidakBerjaya + $geranPadananTidakBerjaya + $geranIndustriTidakBerjaya + 
                           $perundinganTidakBerjaya + $kajianKesTidakBerjaya + $moaMouTidakBerjaya }}
                    ]
                },
                'pelaporan': {
                    labels: ['Selesai', 'Tidak Berjaya'],
                    values: [
                        {{ $globalAntarabangsaSelesai + $penerbitanPenulisanSelesai + 
                           $inovasiPengkomersilanSelesai + $penyelidikanKeusahawananSelesai }},
                        {{ $globalAntarabangsaTidakBerjaya + $penerbitanPenulisanTidakBerjaya + 
                           $inovasiPengkomersilanTidakBerjaya + $penyelidikanKeusahawananTidakBerjaya }}
                    ]
                },
                'all': {
                    labels: ['Lulus/Selesai', 'Tidak Berjaya'],
                    values: [
                        {{ $geranPenyelidikanLulus + $geranPadananLulus + $geranIndustriLulus + 
                           $perundinganLulus + $kajianKesLulus + $moaMouLulus +
                           $globalAntarabangsaSelesai + $penerbitanPenulisanSelesai + 
                           $inovasiPengkomersilanSelesai + $penyelidikanKeusahawananSelesai }},
                        {{ $geranPenyelidikanTidakBerjaya + $geranPadananTidakBerjaya + $geranIndustriTidakBerjaya + 
                           $perundinganTidakBerjaya + $kajianKesTidakBerjaya + $moaMouTidakBerjaya +
                           $globalAntarabangsaTidakBerjaya + $penerbitanPenulisanTidakBerjaya + 
                           $inovasiPengkomersilanTidakBerjaya + $penyelidikanKeusahawananTidakBerjaya }}
                    ]
                }
            };
            
            // Year filter functionality has been removed
            
            // Initialize filter change events
            function initFilterEvents() {
                $('#reportTypeFilter').on('change', function() {
                    currentReportType = $(this).val();
                    updateFilteredCharts();
                });
            }
            
            // Main function to update charts based on filters
            function updateFilteredCharts() {
                console.log(`Updating charts with Type: ${currentReportType}`);
                
                // Clean up existing charts
                if (statusChart) {
                    statusChart.destroy();
                    statusChart = null;
                }
                
                if (categoryChart) {
                    categoryChart.destroy();
                    categoryChart = null;
                }
                
                // Create fresh chart canvases
                $('.chart-container:first').html('<canvas id="statusChart"></canvas>');
                $('.chart-container:last').html('<canvas id="categoryChart"></canvas>');
                
                try {
                    // Get current data based on selected filters
                    const statusData = statusDataByType[currentReportType];
                    const categoryData = categoryDataByType[currentReportType];
                    
                    if (!statusData || !categoryData) {
                        console.error('Invalid data type selected');
                        return;
                    }
                    
                    // Year filtering removed - always show data
                    let hasData = true;
                    
                    // Set appropriate titles
                    let statusTitle = currentReportType === 'permohonan' ? 'Status Permohonan' : 
                                     (currentReportType === 'pelaporan' ? 'Status Pelaporan' : 'Status Keseluruhan');
                    
                    let categoryTitle = currentReportType === 'permohonan' ? 'Permohonan Mengikut Kategori' : 
                                       (currentReportType === 'pelaporan' ? 'Pelaporan Mengikut Kategori' : 'Status Lulus/Selesai Mengikut Kategori');
                    
                    // Year filter has been removed
                    
                    // Create status chart
                    const statusCanvas = document.getElementById('statusChart');
                    if (statusCanvas) {
                        const statusCtx = statusCanvas.getContext('2d');
                        
                        // Always show charts - year filtering removed
                        statusChart = new Chart(statusCtx, {
                            type: 'doughnut',
                            data: {
                                labels: statusData.labels,
                                datasets: [{
                                    data: statusData.values,
                                    backgroundColor: ['#4e73df', '#e74a3b'],
                                    hoverBackgroundColor: ['#2e59d9', '#be2617'],
                                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: {
                                    title: {
                                        display: true,
                                        text: statusTitle,
                                        font: {
                                            weight: 'bold',
                                            size: 16
                                        }
                                    },
                                    legend: {
                                        position: 'bottom'
                                    },
                                    tooltip: {
                                        callbacks: {
                                            label: function(context) {
                                                const value = context.raw;
                                                const total = context.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                                                const percentage = Math.round((value / total) * 100);
                                                return `${context.label}: ${value} (${percentage}%)`;
                                            }
                                        }
                                    }
                                },
                                cutout: '70%'
                            }
                        });
                    }
                    
                    // Create category chart
                    const categoryCanvas = document.getElementById('categoryChart');
                    if (categoryCanvas) {
                        const categoryCtx = categoryCanvas.getContext('2d');
                        
                        // Always show charts - year filtering removed
                        categoryChart = new Chart(categoryCtx, {
                            type: 'bar',
                            data: {
                                labels: categoryData.labels,
                                datasets: [{
                                    label: 'Jumlah',
                                    data: categoryData.values,
                                    backgroundColor: categoryData.colors,
                                    barPercentage: 0.7,
                                    categoryPercentage: 0.8
                                }]
                            },
                            options: {
                                maintainAspectRatio: false,
                                responsive: true,
                                plugins: {
                                    title: {
                                        display: true,
                                        text: categoryTitle,
                                        font: {
                                            weight: 'bold',
                                            size: 16
                                        }
                                    },
                                    legend: {
                                        display: false
                                    }
                                },
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        ticks: {
                                            precision: 0
                                        }
                                    }
                                }
                            }
                        });
                    }
                } catch (error) {
                    console.error('Error rendering charts:', error);
                }
            }
            
            // Initialize filters - year filter removed
            initFilterEvents();
            
            // Create the initial charts (with a small delay to ensure the DOM is ready)
            setTimeout(function() {
                updateFilteredCharts();
            }, 300);
        });
    </script>
</body>
</html>