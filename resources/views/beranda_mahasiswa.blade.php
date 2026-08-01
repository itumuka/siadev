@extends('layout')
@section('css')
    <style>
        table.dataTable th,
        table.dataTable td {
            padding: 3px 6px;
            font-size: 0.8em;
        }

        /* Card Styles */
        .card-stat {
            background: #ffffff;
            border-radius: 20px;
            padding: 24px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
            border: 1px solid rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            margin-bottom: 24px;
        }
        
        .card-stat:hover {
            transform: translateY(-4px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
        }
        
        .card-stat-icon {
            width: 56px;
            height: 56px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-right: 20px;
            flex-shrink: 0;
        }
        
        .icon-ipk {
            background-color: rgba(234, 179, 8, 0.1);
            color: #ca8a04;
        }
        
        .icon-sks {
            background-color: rgba(14, 165, 233, 0.1);
            color: #0284c7;
        }
        
        .icon-mk {
            background-color: rgba(16, 185, 129, 0.1);
            color: #059669;
        }
        
        .icon-semester {
            background-color: rgba(139, 92, 246, 0.1);
            color: #7c3aed;
        }
        
        .card-stat-info {
            flex-grow: 1;
        }
        
        .card-stat-info h5 {
            font-size: 0.88rem;
            color: #64748b;
            font-weight: 500;
            margin-bottom: 4px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .card-stat-info h3 {
            font-size: 1.6rem;
            font-weight: 700;
            color: #1e293b;
            margin: 0;
        }
        
        .card-stat-progress {
            margin-top: 10px;
            height: 6px;
            border-radius: 3px;
            background-color: #f1f5f9;
            overflow: hidden;
        }
        
        .card-stat-progress-bar {
            height: 100%;
            border-radius: 3px;
            transition: width 1s ease-in-out;
        }
        
        /* Chart Card */
        .card-chart {
            background: #ffffff;
            border-radius: 20px;
            padding: 24px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
            border: 1px solid rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
        }
        
        .card-chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .card-chart-header h4 {
            font-size: 1.15rem;
            font-weight: 600;
            color: #1e293b;
            margin: 0;
        }
        
        .card-chart-header p {
            font-size: 0.85rem;
            color: #64748b;
            margin: 0;
        }
        
        /* Shimmer loading */
        .shimmer {
            background: linear-gradient(90deg, #f1f5f9 25%, #e2e8f0 50%, #f1f5f9 75%);
            background-size: 200% 100%;
            animation: loading-shimmer 1.5s infinite;
        }
        
        @keyframes loading-shimmer {
            0% {
                background-position: 200% 0;
            }
            100% {
                background-position: -200% 0;
            }
        }

        /* Custom Calendar Styling */
        #calendar {
            border: none !important;
            font-family: 'Outfit', sans-serif;
        }

        .fc-view-container {
            border: 1px solid #f1f5f9;
            border-radius: 16px;
            overflow: hidden;
            background: #ffffff;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
        }

        .fc-head-container {
            background-color: #f8fafc;
            border-bottom: 1px solid #e2e8f0 !important;
        }

        .fc-head th {
            padding: 12px 0 !important;
            font-weight: 600;
            color: #475569;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.5px;
            border: none !important;
        }

        .fc-day-number {
            font-weight: 500;
            color: #64748b;
            padding: 8px !important;
        }

        .fc-today {
            background: rgba(2, 132, 199, 0.05) !important;
        }

        .fc-event {
            border: none !important;
            border-radius: 8px !important;
            padding: 4px 8px !important;
            font-weight: 500 !important;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04) !important;
            font-size: 0.85rem !important;
        }

        .fc-state-default {
            background-color: #ffffff !important;
            background-image: none !important;
            border: 1px solid #e2e8f0 !important;
            color: #475569 !important;
            box-shadow: none !important;
            text-shadow: none !important;
            border-radius: 10px !important;
            padding: 6px 12px !important;
            height: auto !important;
            font-weight: 500 !important;
            transition: all 0.2s ease !important;
        }

        .fc-state-default:hover {
            background-color: #f8fafc !important;
            color: #1e293b !important;
            border-color: #cbd5e1 !important;
        }

        .fc-state-active {
            background-color: #0284c7 !important;
            color: #ffffff !important;
            border-color: #0284c7 !important;
        }

        .fc-header-toolbar {
            margin-bottom: 20px !important;
            display: flex !important;
            flex-wrap: wrap !important;
            justify-content: space-between !important;
            align-items: center !important;
        }

        .fc-center h2 {
            font-size: 1.25rem !important;
            font-weight: 600 !important;
            color: #1e293b !important;
        }

        @media (max-width: 767px) {
            .fc-header-toolbar {
                flex-direction: column !important;
                gap: 10px !important;
            }
        }

        /* Calendar Legend Styles */
        .border-bottom-dashed {
            border-bottom: 1px dashed rgba(0, 0, 0, 0.08);
        }
        .border-bottom-dashed:last-child {
            border-bottom: none;
            margin-bottom: 0 !important;
            padding-bottom: 0 !important;
        }
        .legend-color-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            display: inline-block;
            flex-shrink: 0;
            margin-top: 4px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .legend-item {
            transition: transform 0.2s ease;
        }
        .legend-item:hover {
            transform: translateX(3px);
        }
        .btn-outline-primary {
            border-color: rgba(37, 99, 235, 0.2) !important;
            color: #2563eb !important;
            background-color: transparent !important;
            border-radius: 6px !important;
            padding: 4px 8px !important;
            transition: all 0.2s ease !important;
        }
        .btn-outline-primary:hover:not(:disabled) {
            background-color: #2563eb !important;
            border-color: #2563eb !important;
            color: #ffffff !important;
        }
        .btn-outline-primary:disabled {
            opacity: 0.4 !important;
            cursor: not-allowed !important;
            border-color: rgba(0, 0, 0, 0.05) !important;
            color: #64748b !important;
        }
    </style>
@endsection
@section('content')
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row" id="here">
                <div class="col-12">
                    <input class="form-control" type="hidden" value="{{ $session_tahun }}" name="session_tahun"
                        id="session_tahun">
                    <input class="form-control" type="hidden" value="{{ $session_semester }}" name="session_semester"
                        id="session_semester">
                    
                    <!-- Welcome Box -->
                    <div class="box bg-primary-light mb-24">
                        <div class="box-body d-flex px-0">
                            <div class="flex-grow-1 p-30 bg-img dask-bg bg-none-md"
                                style="background-position: right bottom; background-size: auto 100%; background-image: url(../images/svg-icon/color-svg/custom-1.svg)">
                                <div class="row">
                                    <div class="col-12 col-xl-8">
                                        <h2 class="font-weight-600">Selamat Datang di Portal Mahasiswa</h2>
                                        <p class="text-dark my-10 font-size-18"><strong
                                                class="text-warning">{{ $session_nama }}</strong> (NIM: {{ Session::get('username') }})
                                        </p>

                                         <!-- Awal Notifikasi Kelengkapan Data & Verifikasi -->
                                         <div id="notif-lengkapi-profil" style="display: none; max-width: 550px;">
                                             <div class="alert alert-warning d-flex justify-content-between align-items-center py-2 px-3 mt-3 mb-0" style="border-radius: 12px; box-shadow: 0 4px 15px rgba(245, 158, 11, 0.15); border: 1px solid rgba(245, 158, 11, 0.2);">
                                               <small class="mb-0 text-dark" id="notif-profil-text"><i class="fa fa-info-circle mr-1"></i> Data profil Anda belum lengkap.</small>
                                               <a href="{{ url('/mahasiswa/profil') }}" id="notif-profil-btn" class="btn btn-danger btn-xs ml-3" style="border-radius: 8px; font-weight: 500; padding: 4px 12px;">Lengkapi</a>
                                             </div>
                                         </div>
                                         <!-- Akhir Notifikasi Kelengkapan Data & Verifikasi -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Summary Cards Row -->
                    <div class="row mb-10">
                        <!-- IPK Card -->
                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="card-stat">
                                <div class="card-stat-icon icon-ipk">
                                    <i class="fa fa-graduation-cap"></i>
                                </div>
                                <div class="card-stat-info">
                                    <h5>IPK Kumulatif</h5>
                                    <h3 id="stat-ipk"><span class="shimmer" style="display:inline-block; width:60px; height:24px; border-radius:4px;"></span></h3>
                                </div>
                            </div>
                        </div>
                        
                        <!-- SKS Card -->
                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="card-stat">
                                <div class="card-stat-icon icon-sks">
                                    <i class="fa fa-book"></i>
                                </div>
                                <div class="card-stat-info">
                                    <h5>SKS Diperoleh</h5>
                                    <h3 id="stat-sks"><span class="shimmer" style="display:inline-block; width:60px; height:24px; border-radius:4px;"></span></h3>
                                    <div class="card-stat-progress">
                                        <div class="card-stat-progress-bar bg-sky" id="sks-progress" style="width: 0%"></div>
                                    </div>
                                    <small class="text-muted mt-1 d-block" id="sks-percentage">Target: 144 SKS</small>
                                </div>
                            </div>
                        </div>
                        
                        <!-- MK Card -->
                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="card-stat">
                                <div class="card-stat-icon icon-mk">
                                    <i class="fa fa-check-circle"></i>
                                </div>
                                <div class="card-stat-info">
                                    <h5>MK Diselesaikan</h5>
                                    <h3 id="stat-mk"><span class="shimmer" style="display:inline-block; width:60px; height:24px; border-radius:4px;"></span></h3>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Semester Card -->
                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="card-stat">
                                <div class="card-stat-icon icon-semester">
                                    <i class="fa fa-calendar-check-o"></i>
                                </div>
                                <div class="card-stat-info">
                                    <h5>Semester Aktif</h5>
                                    <h3 id="stat-semester"><span class="shimmer" style="display:inline-block; width:60px; height:24px; border-radius:4px;"></span></h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Charts Row -->
                    <div class="row">
                        <!-- IP Semester Progression Line Chart -->
                        <div class="col-xl-8 col-12">
                            <div class="card-chart">
                                <div class="card-chart-header">
                                    <div>
                                        <h4>Tren IP Semester (IPS)</h4>
                                        <p class="text-muted">Perkembangan pencapaian Indeks Prestasi Anda setiap semester</p>
                                    </div>
                                </div>
                                <div id="ips-chart" style="min-height: 350px;">
                                    <div class="d-flex align-items-center justify-content-center" style="height: 350px;">
                                        <div class="text-center text-muted">
                                            <div class="spinner-border text-primary" role="status"></div>
                                            <p class="mt-2">Memuat grafik perkembangan...</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Grade Distribution Donut Chart -->
                        <div class="col-xl-4 col-12">
                            <div class="card-chart">
                                <div class="card-chart-header">
                                    <div>
                                        <h4>Distribusi Nilai Huruf</h4>
                                        <p class="text-muted">Persentase perolehan nilai mata kuliah</p>
                                    </div>
                                </div>
                                <div id="grades-chart" style="min-height: 350px;">
                                    <div class="d-flex align-items-center justify-content-center" style="height: 350px;">
                                        <div class="text-center text-muted">
                                            <div class="spinner-border text-primary" role="status"></div>
                                            <p class="mt-2">Memuat grafik distribusi...</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Original Calendar Section -->
                    <div class="row">
                        <div class="col-xl-8 col-12">
                            <div class="box bg-transparent no-shadow mb-0">
                                <div class="box-header no-border px-0">
                                    <h4 class="box-title">Kalender Akademik</h4>
                                    <div class="box-controls pull-right d-md-flex d-none">
                                        <a href="#" id="nama_tahun_akademik">{{ $session_nama_tahunakademik }}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="box">
                                <div class="box-body py-0" id="calendar"></div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-12">
                            <div class="box bg-transparent no-shadow mb-0">
                                <div class="box-header no-border px-0">
                                    <h4 class="box-title">Keterangan Kalender</h4>
                                </div>
                            </div>
                            <div class="box">
                                <div class="box-body bg-warning-light d-flex flex-column justify-content-between" style="border-radius: 16px; height: 535px; padding: 20px;">
                                    <div id="tabel_kalenderakademik" style="height: 440px;"></div>
                                    <div id="kalender_pagination" class="d-flex align-items-center justify-content-between pt-15" style="border-top: 1px solid rgba(0, 0, 0, 0.05);"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Detail Event Kalender -->
                    <div class="modal fade" id="modal-detail-event" tabindex="-1" role="dialog" aria-labelledby="modalDetailEventLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content" style="border-radius: 20px; border: none; box-shadow: 0 15px 35px rgba(0,0,0,0.2);">
                                <div class="modal-header" style="border-bottom: 1px solid #f1f5f9; padding: 20px;">
                                    <h5 class="modal-title font-weight-600" id="modalDetailEventLabel" style="color: #1e293b;"><i class="fa fa-info-circle text-primary mr-2"></i> Detail Kegiatan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body" style="padding: 24px;">
                                    <div class="d-flex align-items-start">
                                        <div id="event-badge-color" style="width: 16px; height: 16px; border-radius: 50%; margin-right: 15px; margin-top: 5px; flex-shrink: 0; background-color: #0284c7;"></div>
                                        <div>
                                            <h4 class="font-weight-600 mb-5" id="event-detail-title" style="color: #1e293b; line-height: 1.4; font-size: 1.15rem;">-</h4>
                                            <p class="text-muted mb-0 font-size-14" id="event-detail-time">-</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer" style="border-top: none; padding: 20px;">
                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal" style="border-radius: 10px; padding: 8px 16px;">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection
@section('script-master')
    <!-- Load ApexCharts CDN -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    
    <script type="text/javascript">
        // Global functions for ApexCharts
        function drawIpsChart(labels, seriesData) {
            var options = {
                chart: {
                    type: 'area',
                    height: 350,
                    toolbar: {
                        show: false
                    },
                    zoom: {
                        enabled: false
                    }
                },
                colors: ['#0284c7'],
                dataLabels: {
                    enabled: true,
                    background: {
                        borderWidth: 0,
                        foreColor: '#ffffff',
                        padding: 4,
                        borderRadius: 6,
                    },
                    style: {
                        fontSize: '11px',
                        colors: ['#0284c7']
                    }
                },
                stroke: {
                    curve: 'smooth',
                    width: 3
                },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.4,
                        opacityTo: 0.05,
                        stops: [0, 90, 100]
                    }
                },
                series: [{
                    name: 'IP Semester',
                    data: seriesData
                }],
                xaxis: {
                    categories: labels,
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    },
                    labels: {
                        style: {
                            colors: '#64748b',
                            fontSize: '12px'
                        }
                    }
                },
                yaxis: {
                    min: 0,
                    max: 4.0,
                    tickAmount: 4,
                    labels: {
                        style: {
                            colors: '#64748b',
                            fontSize: '12px'
                        },
                        formatter: function(val) {
                            return val.toFixed(2);
                        }
                    }
                },
                grid: {
                    borderColor: '#f1f5f9',
                    strokeDashArray: 4
                },
                tooltip: {
                    theme: 'light',
                    x: {
                        show: true
                    }
                }
            };

            $('#ips-chart').empty();
            var chart = new ApexCharts(document.querySelector("#ips-chart"), options);
            chart.render();
        }

        function drawGradesChart(labels, seriesData) {
            let finalLabels = [];
            let finalSeries = [];
            
            for (let i = 0; i < labels.length; i++) {
                if (seriesData[i] > 0) {
                    finalLabels.push(labels[i]);
                    finalSeries.push(seriesData[i]);
                }
            }
            
            if (finalSeries.length === 0) {
                $('#grades-chart').html('<div class="d-flex align-items-center justify-content-center" style="height:350px;"><p class="text-muted">Tidak ada data nilai</p></div>');
                return;
            }

            var options = {
                chart: {
                    type: 'donut',
                    height: 350
                },
                labels: finalLabels,
                series: finalSeries,
                colors: ['#10b981', '#0ea5e9', '#f59e0b', '#ef4444', '#64748b'],
                legend: {
                    position: 'bottom',
                    fontSize: '12px',
                    labels: {
                        colors: '#64748b'
                    }
                },
                dataLabels: {
                    enabled: true,
                    formatter: function (val) {
                        return val.toFixed(0) + "%"
                    }
                },
                plotOptions: {
                    pie: {
                        donut: {
                            size: '65%',
                            labels: {
                                show: true,
                                total: {
                                    show: true,
                                    label: 'Total MK',
                                    color: '#64748b',
                                    formatter: function (w) {
                                        return w.globals.seriesTotals.reduce((a, b) => a + b, 0);
                                    }
                                }
                            }
                        }
                    }
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return val + " Mata Kuliah";
                        }
                    }
                }
            };

            $('#grades-chart').empty();
            var chart = new ApexCharts(document.querySelector("#grades-chart"), options);
            chart.render();
        }
        
        function renderEmptyState() {
            $('#stat-ipk').text('0.00');
            $('#stat-sks').text('0 SKS');
            $('#stat-mk').text('0');
            $('#stat-semester').text('-');
            $('#sks-progress').css('width', '0%');
            $('#ips-chart').html('<div class="d-flex align-items-center justify-content-center" style="height: 350px;"><p class="text-muted">Belum ada riwayat nilai semester.</p></div>');
            $('#grades-chart').html('<div class="d-flex align-items-center justify-content-center" style="height: 350px;"><p class="text-muted">Belum ada riwayat nilai.</p></div>');
        }

        $(document).ready(function() {
            var token = "{{ Session::get('token') }}";
            var userlogin = "{{ Session::get('username') }}";
            var tipe = "{{ Session::get('tipe') }}";
            var session_tahun = $('#session_tahun').val();
            var session_semester = $('#session_semester').val();

            // Fetch and Calculate Academic Stats & Charts
            $.ajax({
                type: "GET",
                url: "{{ config('setting.second_url') }}mahasiswa/transkrip-nilai",
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                data: {
                    nim: userlogin,
                },
                success: function(transcriptData) {
                    if (!transcriptData || transcriptData.length === 0) {
                        renderEmptyState();
                        return;
                    }
                    
                    let totalSks = 0;
                    let totalSksMutu = 0;
                    let coursesCompleted = 0;
                    let semestersSet = new Set();
                    let gradesCount = { 'A': 0, 'B': 0, 'C': 0, 'D': 0, 'E': 0 };
                    let semData = {}; // smt_matakuliah -> { sks: X, sksMutu: Y }
                    
                    transcriptData.forEach(function(row) {
                        let sks = parseFloat(row.sks_matakuliah) || 0;
                        let sVal = row.smt_matakuliah;
                        let grade = (row.nilai || '').toUpperCase().trim();
                        let mutu = parseFloat(row.mutu) || 0;
                        let sksMutu = parseFloat(row.kum_sksmutu) || 0;
                        
                        totalSks += sks;
                        totalSksMutu += sksMutu;
                        coursesCompleted++;
                        
                        if (sVal) {
                            semestersSet.add(sVal);
                            if (!semData[sVal]) {
                                semData[sVal] = { sks: 0, sksMutu: 0 };
                            }
                            semData[sVal].sks += sks;
                            semData[sVal].sksMutu += sksMutu;
                        }
                        
                        // Parse grade prefix (A, B, C, D, E)
                        let baseGrade = grade.length > 0 ? grade.charAt(0) : 'E';
                        if (baseGrade === 'F') baseGrade = 'E'; // Group F with E
                        if (gradesCount.hasOwnProperty(baseGrade)) {
                            gradesCount[baseGrade]++;
                        } else {
                            gradesCount['E']++;
                        }
                    });
                    
                    let gpa = totalSks > 0 ? (totalSksMutu / totalSks) : 0.00;
                    
                    // Render Cards
                    $('#stat-ipk').text(gpa.toFixed(2));
                    $('#stat-sks').text(totalSks + ' SKS');
                    $('#stat-mk').text(coursesCompleted);
                    
                    let sksPercentage = Math.min((totalSks / 144) * 100, 100);
                    $('#sks-progress').css('width', sksPercentage + '%');
                    $('#sks-percentage').text('Target: 144 SKS (' + sksPercentage.toFixed(1) + '% Tercapai)');
                    
                    let activeSemesterNum = semestersSet.size > 0 ? Math.max(...Array.from(semestersSet).map(Number)) : '-';
                    $('#stat-semester').text('Smt ' + activeSemesterNum);
                    
                    // Line chart data preparation
                    let sortedSemesters = Array.from(semestersSet).map(Number).sort((a, b) => a - b);
                    let ipsList = [];
                    let semesterLabels = [];
                    
                    sortedSemesters.forEach(function(sem) {
                        let data = semData[sem];
                        let semIps = data.sks > 0 ? (data.sksMutu / data.sks) : 0.00;
                        ipsList.push(parseFloat(semIps.toFixed(2)));
                        semesterLabels.push('Semester ' + sem);
                    });
                    
                    drawIpsChart(semesterLabels, ipsList);
                    drawGradesChart(Object.keys(gradesCount), Object.values(gradesCount));
                },
                error: function() {
                    renderEmptyState();
                }
            });

            // Academic Calendar Loader & Pagination
            var calendarEvents = [];
            var legendCurrentPage = 0;
            var legendItemsPerPage = 5;

            function renderLegendPage() {
                var start = legendCurrentPage * legendItemsPerPage;
                var end = start + legendItemsPerPage;
                var pageItems = calendarEvents.slice(start, end);
                
                var s = '<div class="calendar-legend-list" style="height: 440px;">';
                if (pageItems.length > 0) {
                    pageItems.forEach(function(item) {
                        s += `
                            <div class="legend-item d-flex align-items-start mb-15 pb-15 border-bottom-dashed">
                                <span class="legend-color-dot mr-10" style="background-color: ${item.background};"></span>
                                <div class="legend-text">
                                    <div class="legend-title font-size-13 font-weight-600" style="color: #1e293b; line-height: 1.3; font-family: 'Outfit', sans-serif;">${item.nama_kegiatan}</div>
                                    <div class="legend-date text-warning font-size-11 mt-5" style="font-weight: 500;">
                                        <i class="fa fa-calendar-o mr-5"></i>${item.tanggal_mulailook} s/d ${item.tanggal_akhirlook}
                                    </div>
                                </div>
                            </div>
                        `;
                    });
                } else {
                    s += `
                        <div class="d-flex align-items-center justify-content-center" style="height: 300px;">
                            <p class="text-muted">Tidak ada agenda kegiatan.</p>
                        </div>
                    `;
                }
                s += '</div>';
                $('#tabel_kalenderakademik').html(s);

                // Update pagination controls
                var total = calendarEvents.length;
                var shownStart = total > 0 ? start + 1 : 0;
                var shownEnd = Math.min(end, total);
                
                $('#pagination-info').text(`Menampilkan ${shownStart}-${shownEnd} dari ${total}`);
                
                $('#btn-prev-legend').prop('disabled', legendCurrentPage === 0);
                $('#btn-next-legend').prop('disabled', end >= total);
            }

            function home_kalenderakademik() {
                $.ajax({
                    type: 'GET',
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    data: {
                        tahun: session_tahun,
                        semester: session_semester
                    },
                    url: "{{ config('setting.second_url') }}akademik/home-kalenderakademik",
                    success: function(result) {
                        var rawEvents = result || [];
                        calendarEvents = [];
                        rawEvents.forEach(function(item) {
                            if (!(item.kode_kegiatan_akademik == '22' && tipe == 'Mahasiswa')) {
                                calendarEvents.push(item);
                            }
                        });
                        legendCurrentPage = 0;
                        
                        // Set up initial pagination HTML controls
                        var paginationHtml = `
                            <span class="text-muted font-size-12" id="pagination-info">-</span>
                            <div class="pagination-buttons">
                                <button class="btn btn-outline-primary mr-5" id="btn-prev-legend" style="padding: 4px 8px; font-size: 11px;"><i class="fa fa-chevron-left"></i></button>
                                <button class="btn btn-outline-primary" id="btn-next-legend" style="padding: 4px 8px; font-size: 11px;"><i class="fa fa-chevron-right"></i></button>
                            </div>
                        `;
                        $('#kalender_pagination').html(paginationHtml);

                        // Bind event handlers
                        $('#btn-prev-legend').off('click').on('click', function() {
                            if (legendCurrentPage > 0) {
                                legendCurrentPage--;
                                renderLegendPage();
                            }
                        });

                        $('#btn-next-legend').off('click').on('click', function() {
                            if ((legendCurrentPage + 1) * legendItemsPerPage < calendarEvents.length) {
                                legendCurrentPage++;
                                renderLegendPage();
                            }
                        });

                        renderLegendPage();
                    }
                });
            }
            home_kalenderakademik();

            // Calendar events loader
            var clg = [];
            $.ajax({
                type: 'GET',
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                data: {
                    tahun: session_tahun,
                    semester: session_semester
                },
                url: "{{ config('setting.second_url') }}akademik/home-kalenderakademikbase",
                success: function(result) {
                    var jml = result.length;
                    for (i = 0; i < jml; i++) {
                        if (result[i].kode_kegiatan_akademik == '22' && tipe == 'Mahasiswa') {
                            // skip
                        } else {
                            clg.push({
                                title: result[i].nama_kegiatan,
                                start: result[i].tanggal_mulai,
                                end: result[i].tanggal_akhir,
                                backgroundColor: result[i].background
                            });
                        }
                    }
                    var CalendarApp = function() {
                        this.$calendar = $('#calendar');
                        this.$calendarObj = null;
                    };

                    CalendarApp.prototype.onEventClick = function(calEvent, jsEvent, view) {
                        var title = calEvent.title;
                        var color = calEvent.backgroundColor || '#0284c7';
                        
                        var startDate = moment(calEvent.start);
                        var timeStr = startDate.format('DD MMMM YYYY');
                        
                        if (calEvent.end) {
                            var endDate = moment(calEvent.end);
                            if (calEvent.allDay) {
                                // FullCalendar exclusive end date for allDay events
                                endDate.subtract(1, 'days');
                            }
                            if (!startDate.isSame(endDate, 'day')) {
                                timeStr += ' s/d ' + endDate.format('DD MMMM YYYY');
                            }
                        }
                        
                        $('#event-detail-title').text(title);
                        $('#event-detail-time').text(timeStr);
                        $('#event-badge-color').css('background-color', color);
                        
                        $('#modal-detail-event').modal('show');
                    };

                    CalendarApp.prototype.init = function() {
                        var defaultEvents = clg;
                        var $this = this;
                        $this.$calendarObj = $this.$calendar.fullCalendar({
                            defaultView: 'month',
                            handleWindowResize: true,
                            header: {
                                left: 'prev,next today',
                                center: 'title',
                                right: 'month'
                            },
                            events: defaultEvents,
                            editable: false,
                            droppable: false,
                            eventLimit: true,
                            selectable: false,
                            eventClick: function(calEvent, jsEvent, view) {
                                $this.onEventClick(calEvent, jsEvent, view);
                            }
                        });
                    };

                    $.CalendarApp = new CalendarApp, $.CalendarApp.Constructor = CalendarApp;
                    $.CalendarApp.init();
                }
            });
        });

        // Profile & Semester Verification checking
        $(document).ready(function() {
            var token = "{{ Session::get('token') }}";
            var userlogin = "{{ Session::get('username') }}";
            var session_tahun = $('#session_tahun').val();
            var session_semester = $('#session_semester').val();

            $.ajax({
                type: 'GET',
                url: "{{ config('setting.second_url') }}mahasiswa/check-verifikasi-semester",
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                data: {
                    nim: userlogin,
                    tahun: session_tahun,
                    semester: session_semester
                },
                success: function(response) {
                    if (response.status === 'success') {
                        if (response.is_profile_complete === 0) {
                            $('#notif-profil-text').html('<i class="fa fa-exclamation-triangle text-danger mr-1"></i> Data profil atau data orang tua Anda belum lengkap.');
                            $('#notif-profil-btn').text('Lengkapi').attr('href', "{{ url('/mahasiswa/profil') }}");
                            $('#notif-lengkapi-profil').fadeIn();
                        } else if (response.is_verified === 0) {
                            $('#notif-profil-text').html('<i class="fa fa-info-circle text-primary mr-1"></i> Harap verifikasi data profil & portofolio SKPI Anda untuk semester ini.');
                            $('#notif-profil-btn').text('Verifikasi').attr('href', "{{ url('/mahasiswa/profil') }}?tab=verifikasi");
                            $('#notif-lengkapi-profil').fadeIn();
                        }
                    }
                }
            });
        });
    </script>
@stop
