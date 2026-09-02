@extends('layout')
@section('content')
<div class="container-full">
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title">Manajemen Tugas Akhir / Skripsi <small class="text-muted">(Beta)</small></h3>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                            <li class="breadcrumb-item" aria-current="page">Kaprodi</li>
                            <li class="breadcrumb-item active" aria-current="page">Skripsi</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="row mb-10">
            <div class="col-12">
                <div class="d-flex flex-wrap align-items-center">
                    <a href="{{ route('kpskripsi_syarat') }}" class="btn btn-sm btn-dark mr-10 mb-5">
                        <i class="fa fa-list mr-5"></i> Syarat Sempro & Ujian
                    </a>

                    <a href="{{ route('kpskripsi_aspek') }}" class="btn btn-sm btn-info mr-10 mb-5">
                        <i class="fa fa-book mr-5"></i> Master Aspek Penilaian
                    </a>
                    <a href="{{ route('kpskripsi_rubrik') }}" class="btn btn-sm btn-warning mr-10 mb-5">
                        <i class="fa fa-sliders mr-5"></i> Konfigurasi Rubrik Penilaian
                    </a>
                    <button class="btn btn-sm btn-info mr-10 mb-5" onclick="openConfigModal()">
                        <i class="fa fa-cog mr-5"></i> Konfigurasi Sempro
                    </button>
                    <button class="btn btn-sm btn-success mr-10 mb-5" onclick="openConfigGradingModal()">
                        <i class="fa fa-check-square mr-5"></i> Metode Penilaian
                    </button>
                    <button class="btn btn-sm btn-danger mb-5" onclick="openModalPerpanjanganKaprodi()">
                        <i class="fa fa-calendar-plus-o mr-5"></i> Monitoring Perpanjangan Studi
                    </button>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="box">
                    <div class="box-header with-border bg-primary-light">
                        <h4 class="box-title text-dark">Daftar Pengajuan Skripsi Mahasiswa</h4>
                        <p class="mb-0 text-muted">Kelola ploting dosen pembimbing dan penjadwalan ujian untuk mahasiswa di Program Studi Anda.</p>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="table_kaprodi_skripsi" class="table table-hover table-striped">
                                <thead class="bg-dark">
                                    <tr>
                                        <th width="4%">No</th>
                                        <th>Mahasiswa & Judul / Topik</th>
                                        <th>Pembimbing 1 & 2</th>
                                        <th>Penguji / Verifikator</th>
                                        <th width="10%" class="text-center">Status</th>
                                        <th width="12%" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Dynamic -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal Plot Pembimbing -->
<div class="modal fade" id="modal-plot-pembimbing" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Ploting Dosen Pembimbing</h5>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <form id="form_plot_pembimbing">
                <div class="modal-body">
                    <input type="hidden" name="id_skripsi" id="plot_id_skripsi">
                    <div class="form-group">
                        <label>Nama Mahasiswa</label>
                        <input type="text" id="plot_nama_mhs" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label>Dosen Pembimbing 1 (Utama)</label>
                        <select class="form-control select2-dosen" name="id_dosen_pembimbing1" id="plot_p1" style="width: 100%;" required>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Dosen Pembimbing 2 (Pendamping)</label>
                        <select class="form-control select2-dosen" name="id_dosen_pembimbing2" id="plot_p2" style="width: 100%;">
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-block">Simpan Ploting</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Penjadwalan Sempro -->
<div class="modal fade" id="modal-plot-sempro" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title text-white">Jadwal Seminar Proposal</h5>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <form id="form_plot_sempro">
                <div class="modal-body">
                    <input type="hidden" name="nim" id="sempro_nim">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal Ujian</label>
                                <input type="date" name="tgl_ujian" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Jam</label>
                                <input type="time" name="jam_ujian" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Ruang</label>
                                <input type="text" name="ruang_ujian" class="form-control" placeholder="Ex: R.301">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Dosen Penguji 1</label>
                                <select class="form-control select2-dosen" name="id_penguji1" id="sempro_penguji1" style="width: 100%;" required></select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Dosen Penguji 2 (Pembimbing)</label>
                                <select class="form-control select2-dosen" name="id_penguji2" id="sempro_penguji2" style="width: 100%;"></select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-right">
                    <button type="submit" class="btn btn-success">Simpan & Umumkan Jadwal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Penjadwalan Ujian / Sidang Akhir -->
<div class="modal fade" id="modal-plot-ujian" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title text-white" id="modal-plot-ujian-title">Jadwal Ujian Sidang Akhir</h5>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <form id="form_plot_ujian">
                <div class="modal-body">
                    <input type="hidden" name="id_skripsi" id="ujian_id_skripsi">
                    
                    <div id="alert_belum_daftar_ujian" class="alert alert-warning mb-20 p-15" style="display: none; border-radius: 8px; border-left: 5px solid #f39c12; background-color: #fcf8e3;">
                        <div class="d-flex align-items-center">
                            <i class="fa fa-exclamation-triangle fa-2x text-warning mr-15"></i>
                            <div>
                                <h5 class="font-weight-bold text-dark mb-5">Mahasiswa Belum Mengajukan Ujian</h5>
                                <p class="mb-0 text-dark font-size-13">Mahasiswa ini belum mendaftar / mengajukan ujian tugas akhir di portal sistem. Penjadwalan ujian dan pemilihan dosen penguji baru dapat disimpan setelah mahasiswa melengkapi pengajuan ujian.</p>
                            </div>
                        </div>
                    </div>

                    <div id="wrapper_form_fields_ujian">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Ujian / Verifikasi Luaran</label>
                                    <input type="date" name="tgl_ujian" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Jam</label>
                                    <input type="time" name="jam_ujian" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Ruang</label>
                                    <input type="text" name="ruang_ujian" class="form-control" placeholder="Ex: R.301">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label id="label_penguji1">Dosen Penguji 1</label>
                                    <select class="form-control select2-dosen" name="id_penguji1" id="ujian_penguji1" style="width: 100%;" required></select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label id="label_penguji2">Dosen Penguji 2</label>
                                    <select class="form-control select2-dosen" name="id_penguji2" id="ujian_penguji2" style="width: 100%;" required></select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label id="label_penguji3">Dosen Penguji 3 (Optional)</label>
                                    <select class="form-control select2-dosen" name="id_penguji3" id="ujian_penguji3" style="width: 100%;"></select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer text-right">
                    <button type="submit" id="btn_submit_plot_ujian" class="btn btn-warning text-white font-weight-bold">Simpan & Umumkan Jadwal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Konfigurasi Sempro -->
<div class="modal fade" id="modal-config-sempro" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-white">Konfigurasi Seminar Proposal (Sempro)</h5>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <form id="form_config_sempro">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Skema Pelaksanaan Sempro</label>
                        <select class="form-control" name="ta_sempro_skema" id="config_skema" required>
                            <option value="skripsi">Alur Skripsi (Independen)</option>
                            <option value="matakuliah">Melalui Mata Kuliah (Terintegrasi)</option>
                        </select>
                        <small class="text-muted">Pilih 'Melalui Mata Kuliah' jika Sempro merupakan bagian dari mata kuliah tertentu.</small>
                    </div>

                    <div id="section_config_mk" style="display: none;">
                        <hr>
                        <div class="form-group">
                            <label>Mapping Mata Kuliah Sempro</label>
                            <select class="form-control select2-matakuliah" name="id_matakuliah[]" id="config_mk" style="width: 100%;" multiple>
                            </select>
                            <small class="text-info">Cari dan pilih mata kuliah yang jika lulus maka otomatis lulus Sempro.</small>
                        </div>
                        <div id="list_mapped_mk" class="mt-10">
                            <!-- List mapped MK will appear here -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info btn-block">Simpan Konfigurasi</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Konfigurasi Metode Penilaian -->
<div class="modal fade" id="modal-config-grading" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title text-white">Konfigurasi Metode Penilaian Skripsi / Tugas Akhir</h5>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p class="text-muted">Tentukan metode penilaian (Jalur Rubrik Indikator vs Nilai Angka Langsung) untuk masing-masing mata kuliah tugas akhir/skripsi aktif prodi Anda.</p>
                <div class="table-responsive text-dark">
                    <table class="table table-bordered table-striped" id="table_config_grading">
                        <thead>
                            <tr class="bg-dark">
                                <th>Kode MK</th>
                                <th>Nama Mata Kuliah</th>
                                <th width="40%" class="text-center">Metode Penilaian</th>
                            </tr>
                        </thead>
                        <tbody id="list_config_grading">
                            <!-- Dynamic -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Monitoring Perpanjangan Studi Kaprodi -->
<div class="modal fade" id="modal-perpanjangan-kaprodi" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content" style="border-radius: 12px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.15);">
            <div class="modal-header bg-danger text-white" style="border-top-left-radius: 12px; border-top-right-radius: 12px;">
                <h5 class="modal-title font-weight-bold">
                    <i class="fa fa-calendar-plus-o mr-10"></i> Monitoring Mahasiswa Perpanjangan Masa Studi
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-20">
                <div class="alert alert-info border-info mb-15 font-size-13" style="background-color: #f0f7ff;">
                    <i class="fa fa-info-circle mr-5"></i> Daftar mahasiswa bimbingan Program Studi Anda yang masa berlakunya telah diperpanjang untuk semester baru setelah memenuhi kewajiban administrasi keuangan.
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover font-size-13" id="table_kaprodi_perpanjangan" style="width: 100%;">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th width="4%" class="text-center">No</th>
                                <th width="20%">Mahasiswa</th>
                                <th>Judul / Topik & Pembimbing</th>
                                <th width="15%">Progres & Target</th>
                                <th width="12%" class="text-center">Status Keuangan</th>
                                <th width="10%" class="text-center">Aktivasi</th>
                            </tr>
                        </thead>
                        <tbody id="tbody_perpanjangan_kaprodi">
                            <!-- Dynamic -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer bg-gray-50" style="border-bottom-left-radius: 12px; border-bottom-right-radius: 12px;">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script-advanced')
<script>
    const CONFIG = {
        api_url: "{{ $api_url }}",
        kode_prodi: "{{ $session_kode_program_studi }}",
        token: "{{ $api_token }}",
        username: "{{ $session_nim }}",
        tahun: "{{ $session_tahun }}",
        semester: "{{ $session_semester }}"
    };
</script>
<script src="{{ url('js/skripsi_kaprodi.js') }}?v={{ time() }}"></script>
@endsection