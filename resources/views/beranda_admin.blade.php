@extends('layout')
@section('css')
    <style>
        table.dataTable th,
        table.dataTable td {
            padding: 3px 6px;
            font-size: 0.8em;
        }

        /* Welcome Banner Premium Styles */
        .welcome-banner {
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
            color: #1e293b;
            border-radius: 20px;
            padding: 30px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(59, 130, 246, 0.05);
            border: 1px solid rgba(59, 130, 246, 0.1);
            margin-bottom: 24px;
        }

        .welcome-banner::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 350px;
            height: 350px;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.08) 0%, rgba(59, 130, 246, 0) 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        .welcome-banner h2 {
            color: #2563eb;
            font-size: 1.1rem;
            font-weight: 500;
            margin: 0 0 6px 0;
        }

        .welcome-banner h1 {
            color: #0f172a;
            font-weight: 700;
            margin: 0 0 15px 0;
            letter-spacing: -0.5px;
        }

        .welcome-profile-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 15px;
        }

        .meta-pill {
            display: inline-flex;
            align-items: center;
            background: #ffffff;
            border: 1px solid rgba(59, 130, 246, 0.15);
            padding: 6px 14px;
            border-radius: 12px;
            color: #475569;
            font-size: 0.88rem;
            transition: all 0.2s ease;
            box-shadow: 0 2px 4px rgba(0,0,0,0.02);
        }

        .meta-pill i {
            margin-right: 8px;
            color: #2563eb;
        }

        .meta-pill strong {
            color: #0f172a;
            margin-left: 4px;
        }

        .meta-pill:hover {
            background: #f8fafc;
            border-color: rgba(59, 130, 246, 0.3);
            color: #0f172a;
        }

        /* Summary Card Styles */
        .card-stat {
            background: #ffffff;
            border-radius: 20px;
            padding: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03);
            border: 1px solid rgba(0, 0, 0, 0.04);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            align-items: center;
            margin-bottom: 24px;
        }
        
        .card-stat:hover {
            transform: translateY(-4px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.06);
        }
        
        .card-stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.35rem;
            margin-right: 16px;
            flex-shrink: 0;
        }
        
        .icon-mhs {
            background-color: rgba(37, 99, 235, 0.1);
            color: #2563eb;
        }
        
        .icon-dosen {
            background-color: rgba(139, 92, 246, 0.1);
            color: #7c3aed;
        }
        
        .icon-prodi {
            background-color: rgba(16, 185, 129, 0.1);
            color: #059669;
        }
        
        .icon-camaba {
            background-color: rgba(245, 158, 11, 0.1);
            color: #d97706;
        }
        
        .card-stat-info {
            flex-grow: 1;
        }
        
        .card-stat-info h5 {
            font-size: 0.82rem;
            color: #64748b;
            font-weight: 500;
            margin-bottom: 2px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .card-stat-info h3 {
            font-size: 1.45rem;
            font-weight: 700;
            color: #1e293b;
            margin: 0;
        }

        /* Quick Action & Chart Styles */
        .card-chart {
            background: #ffffff;
            border-radius: 20px;
            padding: 24px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03);
            border: 1px solid rgba(0, 0, 0, 0.04);
            margin-bottom: 24px;
        }
        
        .card-chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .card-chart-header h4 {
            font-size: 1.1rem;
            font-weight: 600;
            color: #1e293b;
            margin: 0;
        }

        .quick-action-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
        }

        @media (max-width: 767px) {
            .quick-action-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        .quick-action-card {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 16px;
            text-align: center;
            transition: all 0.2s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            color: #475569;
        }

        .quick-action-card:hover {
            background: #ffffff;
            border-color: #cbd5e1;
            box-shadow: 0 4px 12px rgba(0,0,0,0.03);
            transform: translateY(-2px);
            color: #2563eb;
            text-decoration: none;
        }

        .quick-action-card i {
            font-size: 1.5rem;
            color: #64748b;
            transition: color 0.2s ease;
        }

        .quick-action-card:hover i {
            color: #2563eb;
        }

        .quick-action-card span {
            font-size: 0.85rem;
            font-weight: 500;
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
            .fc-center h2 {
                font-size: 1.1rem !important;
            }
        }
    </style>
@endsection
@section('content')
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row" id="here">
                <div class="col-12">
                    <input class="form-control" type="hidden" value="{{ $session_tahun }}" name="session_tahun" id="session_tahun">
                    <input class="form-control" type="hidden" value="{{ $session_semester }}" name="session_semester" id="session_semester">
                    
                    <!-- Welcome Box -->
                    <div class="welcome-banner">
                        <div class="row align-items-center">
                            <div class="col-12 col-xl-10">
                                <span style="color: #2563eb; font-size: 0.85rem; font-weight: 600; text-transform: uppercase; letter-spacing: 1px;">Sistem Informasi Akademik</span>
                                <h2 class="mt-10">Selamat Datang Kembali,</h2>
                                <h1 class="font-size-28">{{ $session_nama }}</h1>
                                <div class="welcome-profile-meta">
                                    <div class="meta-pill" title="Role Operator">
                                        <i class="fa fa-user-secret"></i>
                                        Role: <strong>Administrator</strong>
                                    </div>
                                    <div class="meta-pill" title="Username / Email">
                                        <i class="fa fa-envelope"></i>
                                        <span>{{ Session::get('username') }}</span>
                                    </div>
                                    <div class="meta-pill" title="Tahun Akademik Aktif">
                                        <i class="fa fa-calendar-check-o"></i>
                                        TA: <strong>{{ $session_nama_tahunakademik }} ({{ $session_semester == 1 ? 'Ganjil' : 'Genap' }})</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Summary Cards Row -->
                    <div class="row">
                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="card-stat">
                                <div class="card-stat-icon icon-mhs">
                                    <i class="fa fa-users"></i>
                                </div>
                                <div class="card-stat-info">
                                    <h5>Mahasiswa Aktif</h5>
                                    <h3>1.284</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="card-stat">
                                <div class="card-stat-icon icon-dosen">
                                    <i class="fa fa-graduation-cap"></i>
                                </div>
                                <div class="card-stat-info">
                                    <h5>Dosen Aktif</h5>
                                    <h3>86</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="card-stat">
                                <div class="card-stat-icon icon-prodi">
                                    <i class="fa fa-university"></i>
                                </div>
                                <div class="card-stat-info">
                                    <h5>Program Studi</h5>
                                    <h3>12</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="card-stat">
                                <div class="card-stat-icon icon-camaba">
                                    <i class="fa fa-user-plus"></i>
                                </div>
                                <div class="card-stat-info">
                                    <h5>Pendaftar Camaba</h5>
                                    <h3>342</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Main Grid Content -->
                    <div class="row">
                        <!-- Left Column: Actions & Calendar -->
                        <div class="col-xl-8 col-12">
                            <!-- Quick Actions -->
                            <div class="card-chart">
                                <div class="card-chart-header">
                                    <h4>Jalan Pintas Administrasi (Quick Actions)</h4>
                                </div>
                                <div class="quick-action-grid">
                                    <a href="{{ url('akademik/tahunajaran') }}" class="quick-action-card">
                                        <i class="fa fa-calendar-plus-o"></i>
                                        <span>Tahun Akademik</span>
                                    </a>
                                    <a href="{{ url('akademik/kalenderakademik') }}" class="quick-action-card">
                                        <i class="fa fa-calendar"></i>
                                        <span>Kalender</span>
                                    </a>
                                    <a href="{{ route('akmakulpenawaran') }}" class="quick-action-card">
                                        <i class="fa fa-book"></i>
                                        <span>Penawaran MK</span>
                                    </a>
                                    <a href="{{ url('akademik/mahasiswa') }}" class="quick-action-card">
                                        <i class="fa fa-address-card-o"></i>
                                        <span>Daftar Mahasiswa</span>
                                    </a>
                                    <a href="{{ url('akademik/registrasi') }}" class="quick-action-card">
                                        <i class="fa fa-user-plus"></i>
                                        <span>Registrasi</span>
                                    </a>
                                    <a href="{{ route('akdaftardosen') }}" class="quick-action-card">
                                        <i class="fa fa-file-text-o"></i>
                                        <span>Berita Acara</span>
                                    </a>
                                </div>
                            </div>

                            <!-- Calendar -->
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

                        <!-- Right Column: Charts & Legend -->
                        <div class="col-xl-4 col-12">
                            <!-- Registration Donut Chart -->
                            <div class="card-chart">
                                <div class="card-chart-header">
                                    <h4>Status Registrasi Semester</h4>
                                </div>
                                <div id="herregistrasi-chart" style="min-height: 250px;"></div>
                            </div>

                            <!-- Sebaran Prodi Bar Chart -->
                            <div class="card-chart">
                                <div class="card-chart-header">
                                    <h4>Sebaran Mahasiswa per Prodi</h4>
                                </div>
                                <div id="sebaran-chart" style="min-height: 250px;"></div>
                            </div>

                            <!-- Calendar Legend -->
                            <h4 class="box-title mt-10">Keterangan Kalender</h4>
                            <div class="box">
                                <div class="box-body bg-warning-light">
                                    <div class="box no-shadow mb-0 bg-transparent">
                                        <div class="box-body px-0 py-0 pt-0" id="tabel_kalenderakademik"></div>
                                    </div>
                                </div>
                            </div>
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
        </section>
        <!-- /.content -->
    </div>
@endsection
@section('script-master')
    <!-- Load ApexCharts CDN -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script type="text/javascript">
        $(document).ready(function() {

            var token = "{{ Session::get('token') }}";
            var userlogin = "{{ Session::get('username') }}";
            var tipe = "{{ Session::get('tipe') }}";
            var session_tahun = $('#session_tahun').val();
            var session_semester = $('#session_semester').val();

            // Render Herregistrasi Donut Chart
            var regOptions = {
                chart: {
                    type: 'donut',
                    height: 250
                },
                labels: ['Aktif Registrasi', 'Belum Registrasi'],
                series: [1130, 154],
                colors: ['#10b981', '#f59e0b'],
                legend: {
                    position: 'bottom',
                    fontSize: '11px',
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
                                    label: 'Total Mhs',
                                    color: '#64748b',
                                    formatter: function (w) {
                                        return w.globals.seriesTotals.reduce((a, b) => a + b, 0);
                                    }
                                }
                            }
                        }
                    }
                }
            };
            var regChart = new ApexCharts(document.querySelector("#herregistrasi-chart"), regOptions);
            regChart.render();

            // Render Sebaran Mhs per Prodi Bar Chart
            var sebaranOptions = {
                chart: {
                    type: 'bar',
                    height: 250,
                    toolbar: { show: false }
                },
                plotOptions: {
                    bar: {
                        horizontal: true,
                        borderRadius: 4,
                        barHeight: '60%'
                    }
                },
                colors: ['#6366f1'],
                dataLabels: {
                    enabled: true,
                    formatter: function(val) {
                        return val + " mhs";
                    },
                    style: {
                        fontSize: '10px'
                    }
                },
                series: [{
                    name: 'Mahasiswa',
                    data: [340, 280, 210, 190, 140, 124]
                }],
                xaxis: {
                    categories: ['TI', 'SI', 'Hukum', 'PGSD', 'Pendidikan', 'Manajemen'],
                    labels: {
                        style: { colors: '#64748b' }
                    }
                },
                yaxis: {
                    labels: {
                        style: { colors: '#64748b' }
                    }
                },
                grid: {
                    borderColor: '#f1f5f9'
                }
            };
            var sebaranChart = new ApexCharts(document.querySelector("#sebaran-chart"), sebaranOptions);
            sebaranChart.render();

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
                        var jml = result.length;
                        var s = '';
                        for (i = 0; i < jml; i++) {
                            s = s +
                                '<div class="table-responsive"><table class="table table-sm no-border mb-0"><tbody><tr><td><div class="h-20 w-20 l-h-20 rounded text-center" style="background-color:' +
                                result[i].background +
                                '"><p class="mb-0 font-size-15 font-weight-200"></p></div></td><td class="float-left font-size-15 font-weight-500">' +
                                result[i].nama_kegiatan +
                                '<br><p class="text-warning">(' +
                                result[i].tanggal_mulailook + ' s/d ' + result[i]
                               .tanggal_akhirlook +
                                '</p></td></tr></tbody></table></div>';
                        }
                        $('#tabel_kalenderakademik').html(s);
                    }
                })
            }
            home_kalenderakademik();

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
                    var s = '';
                    var jml = result.length;

                    for (i = 0; i < jml; i++) {
                        clg.push({
                            title: result[i].nama_kegiatan,
                            start: result[i].tanggal_mulai,
                            end: result[i].tanggal_akhir,
                            backgroundColor: result[i].background
                        });
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
            })
        });
    </script>
@stop
