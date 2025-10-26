<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h1>Test Dashboard</h1>
        
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Status Chart</div>
                    <div class="card-body">
                        <div class="chart-container" style="position: relative; height:300px;">
                            <canvas id="statusChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Category Chart</div>
                    <div class="card-body">
                        <div class="chart-container" style="position: relative; height:300px;">
                            <canvas id="categoryChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
    $(document).ready(function() {
        console.log('Document ready, initializing charts');
        
        // Very simple chart data
        const statusData = {
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
        };
        
        const categoryData = {
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
            ]
        };
        
        setTimeout(function() {
            try {
                // Status Chart
                const statusCtx = document.getElementById('statusChart').getContext('2d');
                const statusChart = new Chart(statusCtx, {
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
                                text: 'Status Projek',
                                font: {
                                    weight: 'bold',
                                    size: 16
                                }
                            },
                            legend: {
                                position: 'bottom'
                            }
                        },
                        cutout: '70%',
                    }
                });
                console.log('Status chart created successfully');
                
                // Category Chart
                const categoryCtx = document.getElementById('categoryChart').getContext('2d');
                const categoryChart = new Chart(categoryCtx, {
                    type: 'bar',
                    data: {
                        labels: categoryData.labels,
                        datasets: [{
                            label: 'Jumlah',
                            data: categoryData.values,
                            backgroundColor: [
                                '#C86CB7', '#fbbf24', '#ec4899', '#1cc88a', '#36b9cc', '#f6c23e', 
                                '#e74a3b', '#8b5cf6', '#f97316', '#6366f1'
                            ],
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
                                text: 'Projek Mengikut Kategori',
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
                                },
                                title: {
                                    display: true,
                                    text: 'Jumlah'
                                }
                            }
                        }
                    }
                });
                console.log('Category chart created successfully');
            } catch (e) {
                console.error('Error creating charts:', e);
            }
        }, 500);
    });
    </script>
</body>
</html>