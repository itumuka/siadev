@extends('layout')

@section('content')
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title">{{ $title }}</h3>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                            <li class="breadcrumb-item" aria-current="page">{{ $parent_breadcrumb }}</li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $child_breadcrumb }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="row">
            <div class="col-12">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs customtab" role="tablist">
                    <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#siap_sk" role="tab">Menunggu SK <span id="count_siap_sk" class="badge badge-warning">0</span></a> </li>
                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#riwayat_sk" role="tab">SK Terbit</a> </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active" id="siap_sk" role="tabpanel">
                        <div class="box">
                            <div class="box-header with-border">
                                <h4 class="box-title">Daftar Mahasiswa Siap SK</h4>
                                <div class="box-controls pull-right">
                                    <button class="btn btn-sm btn-primary" id="btn-bulk-sk" disabled>
                                        <i class="fa fa-file-text-o"></i> Terbitkan SK Kolektif (<span id="count_checked">0</span>)
                                    </button>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="table_siap_sk" class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th width="5%"><input type="checkbox" id="check_all"></th>
                                                <th>NIM</th>
                                                <th>Nama</th>
                                                <th>Judul</th>
                                                <th>Pembimbing 1</th>
                                                <th>Pembimbing 2</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="riwayat_sk" role="tabpanel">
                        <div class="box">
                            <div class="box-header with-border">
                                <h4 class="box-title">Riwayat SK Terbit</h4>
                            </div>
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table id="table_riwayat_sk" class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>No SK</th>
                                                <th>Tanggal</th>
                                                <th>Perihal</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal Issue SK -->
    <div class="modal fade" id="modal-issue-sk" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="form_issue_sk">
                    <div class="modal-header">
                        <h5 class="modal-title">Terbitkan SK Kolektif</h5>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nomor SK</label>
                            <input type="text" class="form-control" name="no_sk" required placeholder="Contoh: 112.3/KEP/III.3.AU.III.1/A2/IX/2025">
                        </div>
                        <div class="form-group">
                            <label>Tanggal SK</label>
                            <input type="date" class="form-control" name="tgl_sk" required value="{{ date('Y-m-d') }}">
                        </div>
                        <div class="form-group">
                            <label>Tahun Akademik</label>
                            <input type="text" class="form-control" name="tahun_akademik" value="{{ $session_tahun }}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Semester</label>
                            <input type="text" class="form-control" name="semester" value="{{ $session_semester == 1 ? 'Gasal' : 'Genap' }}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Perihal (Optional)</label>
                            <textarea class="form-control" name="perihal" rows="2">Pengangkatan Dosen Pembimbing Skripsi</textarea>
                        </div>
                        <div id="selected_mhs_list" class="alert alert-info py-2" style="font-size: 0.9em;">
                            <strong>Akan diterapkan untuk:</strong> <span id="text_count_selected">0</span> mahasiswa tercentang.
                        </div>
                        <input type="hidden" name="kode_prodi" value="{{ Session::get('kode_program_studi') }}">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan & Terbitkan SK</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/sk_dekanat.js') }}"></script>
@endsection
