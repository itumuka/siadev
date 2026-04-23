@extends('layout')
@section('content')
<div class="container-full">
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title">Manajemen Tugas Akhir / Skripsi</h3>
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
                                        <th>No</th>
                                        <th>NIM</th>
                                        <th>Nama Mahasiswa</th>
                                        <th>Judul / Topik</th>
                                        <th>Pembimbing 1 & 2</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
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
@endsection

@section('script-advanced')
<script>
    const CONFIG = {
        api_url: "{{ $api_url }}",
        kode_prodi: "{{ $session_kode_program_studi }}",
        token: "{{ $api_token }}",
        username: "{{ $session_nim }}"
    };
</script>
<script src="{{ url('js/skripsi_kaprodi.js') }}?v={{ time() }}"></script>
@endsection