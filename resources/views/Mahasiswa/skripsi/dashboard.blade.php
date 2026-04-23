@extends('layout')
@section('content')
<div class="container-full">
    <section class="content">
        <!-- Dashboard Header -->
        <div class="row">
            <div class="col-12">
                <div class="box bg-primary-light" style="border-radius: 15px; overflow: hidden; background: linear-gradient(90deg, #172b4d 0%, #3f51b5 100%);">
                    <div class="box-body d-flex px-0">
                        <div class="flex-grow-1 p-30 bg-img dask-bg bg-none-md">
                            <div class="row">
                                <div class="col-12 col-md-8">
                                    <h2 class="text-white font-weight-600 mb-2">Pusat Kendali <span id="ta_name_header">Tugas Akhir</span></h2>
                                    <p class="text-white-50 font-size-16">Halo, <span id="mhs_nama" class="font-weight-bold text-white">...</span>! Pantau setiap langkah riset Anda menuju kelulusan di sini.</p>
                                </div>
                                <div class="col-12 col-md-4 text-md-right align-self-center">
                                    <div id="cta_header_container"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Skeleton Loader -->
        <div id="skripsi_skeleton" class="row">
            <div class="col-12"><div class="box box-body"><div class="p-30 text-center"><i class="fa fa-spinner fa-spin fa-3x text-primary"></i><p class="mt-10">Memuat data riset Anda...</p></div></div></div>
        </div>

        <!-- Main Dashboard Content (Hidden until loaded) -->
        <div id="skripsi_content" class="row" style="display: none;">
            <!-- Left: Progress & Logic -->
            <div class="col-xl-7 col-12">
                <!-- Progress Timeline -->
                <div class="box" style="border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                    <div class="box-header with-border">
                        <h4 class="box-title">Timeline Progres</h4>
                    </div>
                    <div class="box-body">
                        <div id="timeline_container" class="timeline-v" style="position: relative; padding: 20px 0;">
                            <!-- Injected by JS -->
                        </div>
                    </div>
                </div>

                <!-- Info Cards Row -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="box bg-info-light">
                            <div class="box-body">
                                <div class="d-flex align-items-center">
                                    <div class="w-50 h-50 rounded-circle bg-white text-info text-center l-h-50 font-size-24"><i class="fa fa-book"></i></div>
                                    <div class="ml-15">
                                        <h6 class="mb-0 text-dark">SKS Kumulatif</h6>
                                        <h4 class="mb-0 font-weight-700" id="stat_sks">0</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="box bg-warning-light">
                            <div class="box-body">
                                <div class="d-flex align-items-center">
                                    <div class="w-50 h-50 rounded-circle bg-white text-warning text-center l-h-50 font-size-24"><i class="fa fa-star"></i></div>
                                    <div class="ml-15">
                                        <h6 class="mb-0 text-dark">IPK Saat Ini</h6>
                                        <h4 class="mb-0 font-weight-700" id="stat_ipk">0.00</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Details & Status -->
            <div class="col-xl-5 col-12">
                <!-- Proposal Detail -->
                <div id="card_proposal" class="box" style="border-radius: 12px;">
                    <div class="box-header with-border bg-white">
                        <h4 class="box-title">Detail Riset</h4>
                        <div class="box-controls pull-right">
                           <span id="btn_edit_container"></span>
                           <span class="badge" id="status_skripsi_badge">Draft</span>
                        </div>
                    </div>
                    <div class="box-body">
                        <h5 class="font-weight-600 mb-0" id="ta_judul">Belum ada judul yang diajukan.</h5>
                        <p class="text-muted font-size-12 mb-20" id="ta_topik">Topik: -</p>
                        
                        <hr>
                        
                        <div class="d-flex mb-15">
                            <div class="w-40 h-40 rounded-circle bg-secondary text-center l-h-40"><i class="fa fa-user"></i></div>
                            <div class="ml-15">
                                <span class="text-muted font-size-12">Pembimbing Utama</span>
                                <h6 class="mb-0 font-weight-600" id="ta_pembimbing1">Menunggu Ploting...</h6>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="w-40 h-40 rounded-circle bg-secondary text-center l-h-40"><i class="fa fa-user-o"></i></div>
                            <div class="ml-15">
                                <span class="text-muted font-size-12">Pembimbing Pendamping</span>
                                <h6 class="mb-0 font-weight-600" id="ta_pembimbing2">-</h6>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bimbingan Progress -->
                <div class="box">
                    <div class="box-body">
                        <div class="d-flex justify-content-between align-items-center mb-10">
                            <h4 class="box-title mb-0">Progress Bimbingan</h4>
                            <span class="text-primary font-weight-700" id="bimbingan_count">0/--</span>
                        </div>
                        <div class="progress progress-sm mb-5">
                            <div id="bimbingan_progress_bar" class="progress-bar progress-bar-primary" role="progressbar" style="width: 0%"></div>
                        </div>
                        <p class="font-size-12 text-muted">*Minimal bimbingan yang disetujui: <span id="min_bimbingan">?</span> kali.</p>
                    </div>
                </div>

                <!-- Main CTA Action (Intuitive Design) -->
                <div id="main_cta_container" class="text-center p-20 bg-white box shadow-sm" style="border: 2px dashed #0052cc; border-radius: 12px;">
                    <!-- Default State / Loading -->
                    <div id="cta_default">
                        <i class="fa fa-spinner fa-spin fa-2x text-primary mb-10"></i>
                        <p class="mb-0 text-muted">Menganalisis status progres Anda...</p>
                    </div>

                    <!-- Action Buttons (Hidden by default) -->
                    <div id="cta_actions" style="display: none;">
                        <h4 id="cta_label" class="mb-15 font-weight-600 text-dark">Lanjutkan Progres Anda</h4>
                        <div class="d-flex justify-content-center flex-wrap gap-10">
                            <!-- Link-based Buttons -->
                            <a id="btn_cta_link" href="#" class="btn btn-warning btn-lg shadow animate-up">
                                <i class="fa fa-arrow-right mr-10"></i> <span class="label-text">Lanjutkan</span>
                            </a>
                            
                            <!-- Modal-based Buttons -->
                            <button id="btn_cta_proposal" type="button" class="btn btn-warning btn-lg shadow animate-up" data-toggle="modal" data-target="#modal-proposal">
                                <i class="fa fa-edit mr-10"></i> Mulai Pengajuan Proposal
                            </button>

                            <button id="btn_cta_upload" type="button" class="btn btn-success btn-lg shadow animate-up" data-toggle="modal" data-target="#modal-upload-naskah">
                                <i class="fa fa-upload mr-10"></i> Unggah Naskah
                            </button>

                            <!-- Status Only (Disabled) -->
                            <div id="cta_status_only" class="alert alert-secondary bg-gray-100 border-0 mb-0 w-p100" style="display: none;">
                                <i class="fa fa-clock-o mr-5"></i> <span class="status-text text-dark">Menunggu proses verifikasi...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal Container -->
<div id="modal_skripsi_container">
    @include('Mahasiswa.skripsi.partials.proposal_form')
    @include('Mahasiswa.skripsi.partials.upload_naskah_modal')
</div>

@endsection

@section('script-advanced')
<script>
    const CONFIG = {
        app_url: "{{ url('/') }}",
        api_url: "{{ $api_url }}",
        nim: "{{ $session_nim }}",
        username: "{{ $session_nim }}",
        token: "{{ $api_token }}"
    };
</script>
<script src="{{ url('js/skripsi_dashboard.js') }}"></script>
@endsection
