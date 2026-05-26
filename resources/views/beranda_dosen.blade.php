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
        
        .icon-kelas {
            background-color: rgba(139, 92, 246, 0.1);
            color: #7c3aed;
        }
        
        .icon-pa {
            background-color: rgba(14, 165, 233, 0.1);
            color: #0284c7;
        }
        
        .icon-skripsi {
            background-color: rgba(16, 185, 129, 0.1);
            color: #059669;
        }
        
        .icon-ujian {
            background-color: rgba(245, 158, 11, 0.1);
            color: #d97706;
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

        /* Chart & Schedule Cards */
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

        /* Schedule list styles */
        .schedule-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .schedule-item {
            padding: 14px 16px;
            border-radius: 12px;
            background-color: #f8fafc;
            border-left: 4px solid #7c3aed;
            margin-bottom: 12px;
            transition: transform 0.2s ease;
        }

        .schedule-item:hover {
            transform: translateX(4px);
            background-color: #f1f5f9;
        }

        .schedule-item-title {
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 4px;
            font-size: 0.95rem;
        }

        .schedule-item-meta {
            font-size: 0.85rem;
            color: #64748b;
        }

        .schedule-item-meta span {
            margin-right: 12px;
            display: inline-flex;
            align-items: center;
        }

        .schedule-item-meta i {
            margin-right: 4px;
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
                .fc-center h2 {
                    font-size: 1.1rem !important;
                }
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

            .role-badge {
                display: inline-flex;
                align-items: center;
                padding: 5px 12px;
                border-radius: 10px;
                font-size: 0.75rem;
                font-weight: 600;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                margin-right: 8px;
                margin-bottom: 8px;
            }

            .badge-wali {
                background-color: #d1fae5;
                color: #065f46;
                border: 1px solid #a7f3d0;
            }

            .badge-kaprodi {
                background-color: #ede9fe;
                color: #5b21b6;
                border: 1px solid #ddd6fe;
            }

            /* Welcome Action Card Styles (Glassmorphism) */
            .welcome-action-card {
                background: rgba(255, 255, 255, 0.75);
                backdrop-filter: blur(12px);
                -webkit-backdrop-filter: blur(12px);
                border: 1px solid rgba(255, 255, 255, 0.8);
                border-radius: 16px;
                padding: 16px 20px;
                box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.04);
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }

            .welcome-action-card:hover {
                transform: translateY(-2px);
                box-shadow: 0 12px 40px 0 rgba(31, 38, 135, 0.07);
            }

            .action-item-link {
                text-decoration: none !important;
                display: block;
                margin-bottom: 10px;
            }
            
            .action-item-link:last-child {
                margin-bottom: 0;
            }

            .action-item {
                background: rgba(255, 255, 255, 0.6);
                border: 1px solid rgba(255, 255, 255, 0.4);
                border-radius: 12px;
                padding: 10px 14px;
                transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .action-item:hover {
                background: #ffffff;
                border-color: rgba(37, 99, 235, 0.25);
                transform: scale(1.02) translateX(4px);
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
            }

            .action-item-icon {
                width: 38px;
                height: 38px;
                border-radius: 10px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.15rem;
                margin-right: 12px;
                flex-shrink: 0;
                transition: all 0.3s ease;
            }
            
            .action-item:hover .action-item-icon {
                transform: rotate(8deg) scale(1.05);
            }

            .bg-light-blue {
                background-color: rgba(37, 99, 235, 0.1);
            }
            .bg-light-warning {
                background-color: rgba(245, 158, 11, 0.1);
            }
            .bg-light-success {
                background-color: rgba(16, 185, 129, 0.1);
            }

            .action-item-content {
                display: flex;
                flex-direction: column;
                min-width: 0;
            }

            .action-item-label {
                font-size: 0.88rem;
                font-weight: 600;
                color: #1e293b;
                line-height: 1.2;
                margin-bottom: 2px;
            }

            .action-item-desc {
                font-size: 0.75rem;
                color: #64748b;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            .action-badge {
                padding: 5px 10px !important;
                border-radius: 8px !important;
                font-weight: 600 !important;
                font-size: 0.8rem !important;
                min-width: 24px;
                text-align: center;
            }

            @keyframes pulse-soft {
                0% {
                    box-shadow: 0 0 0 0 rgba(245, 158, 11, 0.4);
                }
                70% {
                    box-shadow: 0 0 0 6px rgba(245, 158, 11, 0);
                }
                100% {
                    box-shadow: 0 0 0 0 rgba(245, 158, 11, 0);
                }
            }
            .pulse-badge {
                animation: pulse-soft 2s infinite;
            }
            
            /* Responsive adjustments for desktop resolutions */
            @media (max-width: 1199px) {
                .welcome-action-card {
                    padding: 12px 16px;
                }
                .action-item {
                    padding: 8px 12px;
                }
                .action-item-icon {
                    width: 34px;
                    height: 34px;
                    font-size: 1rem;
                    margin-right: 10px;
                }
                .action-item-label {
                    font-size: 0.82rem;
                }
                .action-item-desc {
                    font-size: 0.7rem;
                }
            }
            @media (max-width: 991px) {
                .mt-20 {
                    margin-top: 20px !important;
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
                    
                    <input class="form-control" type="hidden" value="{{ Session::get('kode_program_studi') }}" name="kode_prodi" id="kode_prodi">
                    <input class="form-control" type="hidden" value="{{ Session::get('tipe') }}" name="tipe" id="tipe">
                    <input class="form-control" type="hidden" value="{{ Session::get('id_dosen') }}" name="kode_dosen" id="kode_dosen">

                    <!-- Welcome Box -->
                    <div class="welcome-banner">
                        <div class="row align-items-center">
                            <div class="col-12 col-lg-7 col-xl-8">
                                <span style="color: #2563eb; font-size: 0.85rem; font-weight: 600; text-transform: uppercase; letter-spacing: 1px;">Portal Akademik Dosen</span>
                                <h2 class="mt-10">Selamat Datang Kembali,</h2>
                                <h1 class="font-size-28">{{ $session_nama }}</h1>
                                
                                <div class="mb-5">
                                    @if (Session::get('dosen_wali') == 1)
                                        <span class="role-badge badge-wali"><i class="fa fa-check-circle mr-5"></i> Dosen Wali</span>
                                    @endif
                                    @if (Session::get('kaprodi') == 1)
                                        <span class="role-badge badge-kaprodi"><i class="fa fa-star mr-5"></i> Ketua Program Studi</span>
                                    @endif
                                </div>

                                <div class="welcome-profile-meta">
                                    <div class="meta-pill" title="Nomor Induk Dosen Nasional">
                                        <i class="fa fa-id-card"></i>
                                        NIDN: <strong>{{ Session::get('nidn') ?? '-' }}</strong>
                                    </div>
                                    <div class="meta-pill" title="Email / Username Login">
                                        <i class="fa fa-envelope"></i>
                                        <span>{{ Session::get('username') }}</span>
                                    </div>
                                    <div class="meta-pill" title="Tahun Akademik Aktif">
                                        <i class="fa fa-calendar-check-o"></i>
                                        TA: <strong>{{ $session_nama_tahunakademik }} ({{ $session_semester == 1 ? 'Ganjil' : 'Genap' }})</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-5 col-xl-4 mt-20 mt-lg-0">
                                <div class="welcome-action-card">
                                    <div class="action-card-header d-flex justify-content-between align-items-center mb-15">
                                        <h5 class="action-card-title mb-0 font-weight-600 font-size-14" style="color: #0f172a;">
                                            <i class="fa fa-tasks text-primary mr-5"></i> Agenda & Status Tindakan
                                        </h5>
                                    </div>
                                    <div class="action-card-body">
                                        <!-- Action Item 1: Jadwal Mengajar -->
                                        <a href="{{ route('makul_diampu_dosen') }}" class="action-item-link">
                                            <div class="action-item d-flex align-items-center">
                                                <div class="action-item-icon bg-light-blue text-primary">
                                                    <i class="fa fa-calendar-check-o"></i>
                                                </div>
                                                <div class="action-item-content">
                                                    <span class="action-item-label">Mengajar Hari Ini</span>
                                                    <small class="action-item-desc" id="action-desc-jadwal">Memuat jadwal...</small>
                                                </div>
                                                <div class="ml-auto">
                                                    <span class="action-badge badge badge-primary" id="action-val-jadwal">-</span>
                                                </div>
                                            </div>
                                        </a>

                                        <!-- Action Item 2: Persetujuan KRS -->
                                        @if (Session::get('dosen_wali') == 1)
                                        <a href="{{ route('dosenacckrs') }}" class="action-item-link">
                                            <div class="action-item d-flex align-items-center">
                                                <div class="action-item-icon bg-light-warning text-warning">
                                                    <i class="fa fa-check-square-o"></i>
                                                </div>
                                                <div class="action-item-content">
                                                    <span class="action-item-label">Persetujuan KRS (PA)</span>
                                                    <small class="action-item-desc" id="action-desc-krs">Memuat status...</small>
                                                </div>
                                                <div class="ml-auto">
                                                    <span class="action-badge badge badge-warning" id="action-val-krs">-</span>
                                                </div>
                                            </div>
                                        </a>
                                        @endif

                                        <!-- Action Item 3: Bimbingan Skripsi -->
                                        <a href="{{ route('dosen.skripsi.index') }}" class="action-item-link">
                                            <div class="action-item d-flex align-items-center">
                                                <div class="action-item-icon bg-light-success text-success">
                                                    <i class="fa fa-graduation-cap"></i>
                                                </div>
                                                <div class="action-item-content">
                                                    <span class="action-item-label">Bimbingan Skripsi</span>
                                                    <small class="action-item-desc" id="action-desc-skripsi">Memuat status...</small>
                                                </div>
                                                <div class="ml-auto">
                                                    <span class="action-badge badge badge-success" id="action-val-skripsi">-</span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Summary Cards Row -->
                    <div class="row mb-10">
                        <!-- Kelas Card -->
                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="card-stat">
                                <div class="card-stat-icon icon-kelas">
                                    <i class="fa fa-university"></i>
                                </div>
                                <div class="card-stat-info">
                                    <h5>Kelas Diampu</h5>
                                    <h3 id="stat-kelas"><span class="shimmer" style="display:inline-block; width:60px; height:24px; border-radius:4px;"></span></h3>
                                </div>
                            </div>
                        </div>
                        
                        <!-- PA Card -->
                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="card-stat">
                                <div class="card-stat-icon icon-pa">
                                    <i class="fa fa-users"></i>
                                </div>
                                <div class="card-stat-info">
                                    <h5>Bimbingan PA</h5>
                                    <h3 id="stat-pa"><span class="shimmer" style="display:inline-block; width:60px; height:24px; border-radius:4px;"></span></h3>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Skripsi Card -->
                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="card-stat">
                                <div class="card-stat-icon icon-skripsi">
                                    <i class="fa fa-book"></i>
                                </div>
                                <div class="card-stat-info">
                                    <h5>Bimbingan Skripsi</h5>
                                    <h3 id="stat-skripsi"><span class="shimmer" style="display:inline-block; width:60px; height:24px; border-radius:4px;"></span></h3>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Ujian Card -->
                        <div class="col-xl-3 col-md-6 col-12">
                            <div class="card-stat">
                                <div class="card-stat-icon icon-ujian">
                                    <i class="fa fa-graduation-cap"></i>
                                </div>
                                <div class="card-stat-info">
                                    <h5>Siap Ujian Skripsi</h5>
                                    <h3 id="stat-siap-ujian"><span class="shimmer" style="display:inline-block; width:60px; height:24px; border-radius:4px;"></span></h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Today's Schedule & Charts Row -->
                    <div class="row">
                        <!-- Today's Teaching Schedule -->
                        <div class="col-xl-4 col-12">
                            <div class="card-chart">
                                <div class="card-chart-header">
                                    <div>
                                        <h4>Jadwal Mengajar Hari Ini</h4>
                                        <p class="text-muted" id="today-name-display">Hari ini</p>
                                    </div>
                                </div>
                                <div id="schedule-container" style="min-height: 280px; max-height: 280px; overflow-y: auto;">
                                    <div class="d-flex align-items-center justify-content-center" style="height: 200px;">
                                        <div class="text-center text-muted">
                                            <div class="spinner-border text-primary" role="status"></div>
                                            <p class="mt-2">Memuat jadwal mengajar...</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- KRS Status Distribution Donut Chart -->
                        <div class="col-xl-4 col-12">
                            <div class="card-chart">
                                <div class="card-chart-header">
                                    <div>
                                        <h4>Persetujuan KRS Bimbingan</h4>
                                        <p class="text-muted">Status KRS mahasiswa bimbingan akademik (PA)</p>
                                    </div>
                                </div>
                                <div id="krs-chart" style="min-height: 280px;">
                                    <div class="d-flex align-items-center justify-content-center" style="height: 200px;">
                                        <div class="text-center text-muted">
                                            <div class="spinner-border text-primary" role="status"></div>
                                            <p class="mt-2">Memuat grafik KRS...</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Skripsi Phase Donut Chart -->
                        <div class="col-xl-4 col-12">
                            <div class="card-chart">
                                <div class="card-chart-header">
                                    <div>
                                        <h4>Fase Mahasiswa Skripsi</h4>
                                        <p class="text-muted">Distribusi kemajuan bimbingan tugas akhir</p>
                                    </div>
                                </div>
                                <div id="skripsi-chart" style="min-height: 280px;">
                                    <div class="d-flex align-items-center justify-content-center" style="height: 200px;">
                                        <div class="text-center text-muted">
                                            <div class="spinner-border text-primary" role="status"></div>
                                            <p class="mt-2">Memuat grafik fase skripsi...</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Original Calendar Section -->
                    <div class="row mt-10">
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
                            <h4 class="box-title">Keterangan Kalender</h4>
                            <div class="box">
                                <div class="box-body bg-warning-light">
                                    <div class="box no-shadow mb-0 bg-transparent">
                                        <div class="box-body px-0 py-0 pt-0" id="tabel_kalenderakademik"></div>
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
        function drawKrsChart(accCount, pendingCount) {
            var options = {
                chart: {
                    type: 'donut',
                    height: 280
                },
                labels: ['Disetujui (ACC)', 'Belum Disetujui'],
                series: [accCount, pendingCount],
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

            $('#krs-chart').empty();
            var chart = new ApexCharts(document.querySelector("#krs-chart"), options);
            chart.render();
        }

        function drawSkripsiChart(proposalCount, bimbinganCount, readyCount) {
            var options = {
                chart: {
                    type: 'donut',
                    height: 280
                },
                labels: ['Proposal', 'Bimbingan', 'Siap Ujian'],
                series: [proposalCount, bimbinganCount, readyCount],
                colors: ['#f59e0b', '#0ea5e9', '#10b981'],
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

            $('#skripsi-chart').empty();
            var chart = new ApexCharts(document.querySelector("#skripsi-chart"), options);
            chart.render();
        }

        $(document).ready(function() {
            var token = "{{ Session::get('token') }}";
            var userlogin = "{{ Session::get('username') }}";
            
            var kode_prodi = $('#kode_prodi').val();
            var tahun = $('#session_tahun').val();
            var semester = $('#session_semester').val();
            var tipe = $('#tipe').val() || "{{ Session::get('tipe') }}";
            var kode_dosen = $('#kode_dosen').val() || "{{ Session::get('id_dosen') }}";

            // Determine today's day in Indonesian for filtering
            var daysIndonesian = {
                'Sunday': 'Minggu',
                'Monday': 'Senin',
                'Tuesday': 'Selasa',
                'Wednesday': 'Rabu',
                'Thursday': 'Kamis',
                'Friday': 'Jumat',
                'Saturday': 'Sabtu'
            };
            var todayEnglish = moment().format('dddd');
            var todayIndo = daysIndonesian[todayEnglish] || '';
            $('#today-name-display').text(todayIndo + ', ' + moment().format('DD MMMM YYYY'));

            // 1. Fetch Taught Classes & Filter Today's Schedule
            $.ajax({
                type: "GET",
                url: "{{ config('setting.second_url') }}akademik/makulpenawaran",
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                data: {
                    tahun: tahun,
                    semester: semester,
                    kode_prodi: kode_prodi,
                    tipe: tipe,
                    kode_dosen: kode_dosen
                },
                success: function(classList) {
                    var totalClasses = classList ? classList.length : 0;
                    $('#stat-kelas').text(totalClasses);

                    var scheduleHtml = '';
                    var todayClasses = [];

                    if (classList && totalClasses > 0) {
                        classList.forEach(function(row) {
                            if (row.hari && row.hari.trim().toLowerCase() === todayIndo.toLowerCase()) {
                                todayClasses.push(row);
                            }
                        });
                    }

                    // Update Opsi C widget
                    var countJadwal = todayClasses.length;
                    $('#action-val-jadwal').text(countJadwal);
                    if (countJadwal > 0) {
                        $('#action-desc-jadwal').text(countJadwal + ' kelas perlu diajar hari ini');
                    } else {
                        $('#action-desc-jadwal').text('Tidak ada kelas hari ini');
                    }

                    if (todayClasses.length > 0) {
                        scheduleHtml += '<ul class="schedule-list">';
                        todayClasses.forEach(function(row) {
                            scheduleHtml += `
                                <li class="schedule-item">
                                    <div class="schedule-item-title">${row.nama_matakuliah} (Kelas ${row.nama_kelas})</div>
                                    <div class="schedule-item-meta">
                                        <span><i class="fa fa-clock-o"></i> ${row.waktu || '-'}</span>
                                        <span><i class="fa fa-map-marker"></i> Ruang ${row.kode_ruang || '-'}</span>
                                        <span><i class="fa fa-users"></i> ${row.jumlah_peserta || 0} Mhs</span>
                                    </div>
                                </li>
                            `;
                        });
                        scheduleHtml += '</ul>';
                    } else {
                        scheduleHtml += `
                            <div class="d-flex align-items-center justify-content-center" style="height: 200px;">
                                <div class="text-center text-muted">
                                    <i class="fa fa-calendar-o fa-2x mb-10 text-primary"></i>
                                    <p class="mb-0">Tidak ada jadwal mengajar hari ini.</p>
                                </div>
                            </div>
                        `;
                    }
                    $('#schedule-container').html(scheduleHtml);
                },
                error: function() {
                    $('#stat-kelas').text('0');
                    $('#schedule-container').html(`
                        <div class="d-flex align-items-center justify-content-center" style="height: 200px;">
                            <p class="text-danger">Gagal memuat jadwal.</p>
                        </div>
                    `);
                    // Update Opsi C widget error state
                    $('#action-val-jadwal').text('0');
                    $('#action-desc-jadwal').text('Gagal memuat jadwal');
                }
            });

            // 2. Fetch Advisees (PA) and build KRS chart
            $.ajax({
                type: "GET",
                url: "{{ config('setting.second_url') }}akademik/daftarmhs-pa",
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                data: {
                    tahun: tahun,
                    semester: semester,
                    kode_prodi: kode_prodi,
                    tipe: tipe,
                    kode_dosen: kode_dosen
                },
                success: function(mhsList) {
                    var totalPa = mhsList ? mhsList.length : 0;
                    $('#stat-pa').text(totalPa);

                    var accCount = 0;
                    var pendingCount = 0;

                    if (mhsList && totalPa > 0) {
                        mhsList.forEach(function(row) {
                            if (row.status_krs === 'KRS') {
                                accCount++;
                            } else {
                                pendingCount++;
                            }
                        });
                        drawKrsChart(accCount, pendingCount);
                    } else {
                        $('#krs-chart').html(`
                            <div class="d-flex align-items-center justify-content-center" style="height: 200px;">
                                <p class="text-muted">Tidak ada data bimbingan.</p>
                            </div>
                        `);
                    }

                    // Update Opsi C widget
                    $('#action-val-krs').text(pendingCount);
                    if (pendingCount > 0) {
                        $('#action-desc-krs').text(pendingCount + ' mahasiswa menunggu ACC KRS');
                        $('#action-val-krs').addClass('pulse-badge');
                    } else {
                        $('#action-desc-krs').text('Semua KRS sudah di-ACC');
                        $('#action-val-krs').removeClass('pulse-badge');
                    }
                },
                error: function() {
                    $('#stat-pa').text('0');
                    $('#krs-chart').html(`
                        <div class="d-flex align-items-center justify-content-center" style="height: 200px;">
                            <p class="text-danger">Gagal memuat data PA.</p>
                        </div>
                    `);
                    // Update Opsi C widget error state
                    $('#action-val-krs').text('0');
                    $('#action-desc-krs').text('Gagal memuat data KRS');
                }
            });

            // 3. Fetch Thesis Advisees & build Skripsi chart
            $.ajax({
                type: "GET",
                url: "{{ config('setting.second_url') }}dosen/skripsi/dashboard",
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                data: {
                    id_dosen: kode_dosen
                },
                success: function(response) {
                    var skripsiList = response.data || [];
                    var totalSkripsi = skripsiList.length;
                    $('#stat-skripsi').text(totalSkripsi);

                    var proposalCount = 0;
                    var bimbinganCount = 0;
                    var readyCount = 0;

                    if (totalSkripsi > 0) {
                        skripsiList.forEach(function(row) {
                            if (row.fase_aktif === 'proposal') {
                                proposalCount++;
                            } else if (row.fase_aktif === 'bimbingan') {
                                bimbinganCount++;
                            } else if (row.fase_aktif === 'ujian') {
                                readyCount++;
                            }
                        });
                        
                        $('#stat-siap-ujian').text(readyCount);
                        drawSkripsiChart(proposalCount, bimbinganCount, readyCount);
                    } else {
                        $('#stat-siap-ujian').text('0');
                        $('#skripsi-chart').html(`
                            <div class="d-flex align-items-center justify-content-center" style="height: 200px;">
                                <p class="text-muted">Tidak ada data bimbingan skripsi.</p>
                            </div>
                        `);
                    }

                    // Update Opsi C widget
                    $('#action-val-skripsi').text(readyCount);
                    if (readyCount > 0) {
                        $('#action-desc-skripsi').text(readyCount + ' mahasiswa siap ujian');
                    } else {
                        $('#action-desc-skripsi').text('Tidak ada antrean ujian');
                    }
                },
                error: function() {
                    $('#stat-skripsi').text('0');
                    $('#stat-siap-ujian').text('0');
                    $('#skripsi-chart').html(`
                        <div class="d-flex align-items-center justify-content-center" style="height: 200px;">
                            <p class="text-danger">Gagal memuat data skripsi.</p>
                        </div>
                    `);
                    // Update Opsi C widget error state
                    $('#action-val-skripsi').text('0');
                    $('#action-desc-skripsi').text('Gagal memuat data skripsi');
                }
            });

            // 4. Academic Calendar Loader
            function home_kalenderakademik() {
                $.ajax({
                    type: 'GET',
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    data: {
                        tahun: tahun,
                        semester: semester
                    },
                    url: "{{ config('setting.second_url') }}akademik/home-kalenderakademik",
                    success: function(result) {
                        var jml = result ? result.length : 0;
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
                                ')</p></td></tr></tbody></table></div>';
                        }
                        $('#tabel_kalenderakademik').html(s);
                    }
                });
            }
            home_kalenderakademik();

            // 5. Calendar events loader
            var clg = [];
            $.ajax({
                type: 'GET',
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                data: {
                    tahun: tahun,
                    semester: semester
                },
                url: "{{ config('setting.second_url') }}akademik/home-kalenderakademikbase",
                success: function(result) {
                    var jml = result ? result.length : 0;
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
            });
        });
    </script>
@stop
