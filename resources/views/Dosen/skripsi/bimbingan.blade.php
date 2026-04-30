@extends('layout')

@section('css')
    <style>
        .timeline {
            position: relative;
            padding: 20px 0;
            list-style: none;
        }
        .timeline-item {
            position: relative;
            margin-bottom: 20px;
        }
        .timeline-item-content {
            padding: 20px;
            background: #f8f9fc;
            border-radius: 5px;
            border-left: 4px solid #4e73df;
        }
        .status-badge {
            float: right;
        }
    </style>
@endsection

@section('content')
    <div class="container-full">
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">{{ $title }}</h3>
                    <div class="d-inline-block align-items-center">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                                <li class="breadcrumb-item"><a href="{{ route('dosen.skripsi.index') }}">{{ $parent_breadcrumb }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $child_breadcrumb }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <!-- Info Mahasiswa -->
                <div class="col-12 col-lg-4">
                    <div class="box">
                        <div class="box-header with-border">
                            <h4 class="box-title">Info Mahasiswa</h4>
                        </div>
                        <div class="box-body">
                            <!-- Populated via JS -->
                            <div id="mhs_info_placeholder" class="text-center">
                                <div class="spinner-border text-primary" role="status"></div>
                                <p>Memuat data...</p>
                            </div>
                            <div id="mhs_info_content" style="display: none;">
                                <h5 id="mhs_nama" class="mb-0 font-weight-bold"></h5>
                                <p id="mhs_nim" class="text-muted"></p>
                                <hr>
                                <h6>Judul Skripsi:</h6>
                                <p id="mhs_judul" class="font-italic"></p>
                                
                                <div class="mt-4">
                                    <button class="btn btn-block btn-success" id="btn_acc_ujian" style="display:none;" data-toggle="modal" data-target="#modal_acc_ujian">
                                        <i class="fa fa-check-circle"></i> Berikan ACC Ujian
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Log Bimbingan -->
                <div class="col-12 col-lg-8">
                    <div class="box">
                        <div class="box-header with-border">
                            <h4 class="box-title">Riwayat Log Bimbingan</h4>
                        </div>
                        <div class="box-body">
                            <input type="hidden" id="id_skripsi" value="{{ $id_skripsi }}">
                            <input type="hidden" id="id_dosen" value="{{ $session_id_dosen }}">

                            <div class="table-responsive">
                                <table id="tb_log_bimbingan" class="table table-hover" width="100%">
                                    <thead class="bg-dark">
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Topik / Catatan Mahasiswa</th>
                                            <th>Lampiran</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Data populated by DataTables -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Modal Validasi Bimbingan -->
    <div class="modal fade" id="modal_validasi">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Validasi Log Bimbingan</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="form_validasi">
                    <div class="modal-body">
                        <input type="hidden" name="id_log" id="v_id_log">
                        <input type="hidden" name="id_dosen" value="{{ $session_id_dosen }}">
                        
                        <div class="form-group">
                            <label>Catatan dari Mahasiswa:</label>
                            <div class="p-3 bg-light rounded" id="v_catatan_mhs"></div>
                        </div>

                        <div class="form-group mt-3">
                            <label class="font-weight-bold">Aksi Validasi (ACC/Revisi) <span class="text-danger">*</span></label>
                            <select name="status" id="v_status" class="form-control" required>
                                <option value="">-- Pilih Keputusan --</option>
                                <option value="disetujui">Setujui (ACC)</option>
                                <option value="revisi">Tolak / Perlu Revisi</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">Catatan Pembimbing (Feedback)</label>
                            <textarea name="catatan_dosen" id="v_catatan_dosen" rows="5" class="form-control" placeholder="Tuliskan revisi atau feedback untuk mahasiswa..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary" id="btn_submit_validasi"><i class="fa fa-save"></i> Simpan Validasi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal ACC Ujian -->
    <div class="modal fade" id="modal_acc_ujian">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Berikan ACC Ujian</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="form_acc_ujian">
                    <div class="modal-body">
                        <input type="hidden" name="id_skripsi" value="{{ $id_skripsi }}">
                        <input type="hidden" name="id_dosen" value="{{ $session_id_dosen }}">
                        
                        <div class="alert alert-info">
                            <i class="fa fa-info-circle"></i> 
                            Mahasiswa sudah memenuhi syarat minimal bimbingan. Berikan ACC untuk memperbolehkan mahasiswa mendaftar ujian.
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">Fase Ujian <span class="text-danger">*</span></label>
                            <select name="fase" class="form-control" required>
                                <option value="">-- Pilih Fase --</option>
                                <option value="sempro">Seminar Proposal (Sempro)</option>
                                <option value="ujian">Ujian Skripsi (Pendadaran)</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">Status ACC <span class="text-danger">*</span></label>
                            <select name="status_acc" class="form-control" required>
                                <option value="">-- Pilih Status --</option>
                                <option value="1">Berikan ACC (Izinkan Ujian)</option>
                                <option value="0">Cabut ACC (Batalkan Izin)</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success" id="btn_submit_acc_ujian"><i class="fa fa-check-circle"></i> Simpan ACC</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script-master')
    <script type="text/javascript">
        $(document).ready(function() {
            var token = "{{ $api_token }}";
            var userlogin = "{{ $session_username }}";
            var id_dosen = $('#id_dosen').val();
            var id_skripsi = $('#id_skripsi').val();

            // 1. Fetch data mahasiswa (using dashboard endpoint and filtering)
            $.ajax({
                url: "{{ $api_url }}dosen/skripsi/dashboard",
                method: "GET",
                headers: { 
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                data: { id_dosen: id_dosen },
                success: function(res) {
                    if(res.status == 'success') {
                        var mhs = res.data.find(m => m.id_skripsi == id_skripsi);
                        if(mhs) {
                            $('#mhs_nama').text(mhs.nama_mahasiswa);
                            $('#mhs_nim').text(mhs.nim + ' - ' + mhs.nama_program_studi);
                            $('#mhs_judul').text(mhs.judul || 'Belum ada judul');
                            
                            $('#mhs_info_placeholder').hide();
                            $('#mhs_info_content').fadeIn();

                            // Jika bimbingan ACC sudah >= batas minimum (misal 8), tampilkan tombol ACC Ujian
                            // Untuk sekarang kita asumsikan jika ACC >= 8 muncul tombolnya
                            if(mhs.total_bimbingan_acc >= 8) {
                                $('#btn_acc_ujian').show();
                            }
                        }
                    }
                }
            });

            // 2. Load Table Log Bimbingan
            var table = $("#tb_log_bimbingan").DataTable({
                destroy: true,
                processing: true,
                ajax: {
                    type: "GET",
                    url: "{{ $api_url }}dosen/skripsi/log-bimbingan",
                    headers: { 
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    data: { id_dosen: id_dosen, id_skripsi: id_skripsi },
                    dataSrc: function(json) { return json.data || []; }
                },
                columns: [
                    { 
                        data: 'tanggal',
                        render: function(data) {
                            if(!data) return '-';
                            var d = new Date(data);
                            return d.toLocaleDateString('id-ID', {day: '2-digit', month: 'short', year: 'numeric'});
                        }
                    },
                    { 
                        data: null,
                        render: function(data, type, row) {
                            return '<strong>' + (row.topik || '-') + '</strong><br><small class="text-muted">' + (row.uraian || '') + '</small>';
                        }
                    },
                    { 
                        data: 'path_file',
                        className: 'text-center',
                        render: function(data) {
                            if(data) return '<a href="' + data + '" target="_blank" class="btn btn-xs btn-outline-info"><i class="fa fa-download"></i> Unduh</a>';
                            return '<span class="text-muted">-</span>';
                        }
                    },
                    { 
                        data: 'status',
                        className: 'text-center',
                        render: function(data) {
                            if(data == 'pending') return '<span class="badge badge-warning">Pending</span>';
                            if(data == 'disetujui') return '<span class="badge badge-success">Disetujui</span>';
                            if(data == 'revisi') return '<span class="badge badge-danger">Revisi</span>';
                            return data;
                        }
                    },
                    {
                        data: null,
                        className: 'text-center',
                        render: function(data, type, row) {
                            // Convert object to base64 to pass to modal safely
                            let b64 = btoa(unescape(encodeURIComponent(JSON.stringify(row))));
                            return '<button class="btn btn-sm btn-primary btn-validasi" data-row="'+b64+'"><i class="fa fa-edit"></i> Validasi</button>';
                        }
                    }
                ],
                order: [[0, 'desc']]
            });

            // 3. Open Modal Validasi
            $('#tb_log_bimbingan').on('click', '.btn-validasi', function() {
                let rowData = JSON.parse(decodeURIComponent(escape(atob($(this).data('row')))));
                
                $('#v_id_log').val(rowData.id);
                $('#v_catatan_mhs').html('<strong>' + (rowData.topik || '') + '</strong><br>' + (rowData.uraian || ''));
                
                // Pre-fill if already validated before
                if(rowData.status != 'pending') {
                    $('#v_status').val(rowData.status);
                } else {
                    $('#v_status').val('');
                }
                $('#v_catatan_dosen').val(rowData.catatan_dosen || '');
                
                $('#modal_validasi').modal('show');
            });

            // 4. Submit Validasi
            $('#form_validasi').on('submit', function(e) {
                e.preventDefault();
                var btn = $('#btn_submit_validasi');
                var formData = $(this).serialize();

                $.ajax({
                    url: "{{ $api_url }}dosen/skripsi/validasi-bimbingan",
                    method: "POST",
                    headers: { 
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    data: formData,
                    timeout: 10000,
                    beforeSend: function() {
                        btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');
                    },
                    success: function(res) {
                        if(res.success) {
                            showToastr('success', 'Berhasil', res.success);
                            $('#modal_validasi').modal('hide');
                            table.ajax.reload();
                        } else {
                            showToastr('error', 'Gagal', 'Terjadi kesalahan');
                        }
                    },
                    error: function(err) {
                        var errorMsg = 'Kesalahan Server';
                        if(err.statusText === 'timeout') {
                            errorMsg = 'Timeout - Server tidak merespon';
                        } else if(err.responseJSON && err.responseJSON.error) {
                            errorMsg = err.responseJSON.error;
                        }
                        showToastr('error', 'Gagal', errorMsg);
                    },
                    complete: function() {
                        btn.prop('disabled', false).html('<i class="fa fa-save"></i> Simpan Validasi');
                    }
                });
            });

            // 5. Submit ACC Ujian
            $('#form_acc_ujian').on('submit', function(e) {
                e.preventDefault();
                var btn = $('#btn_submit_acc_ujian');
                var formData = $(this).serialize();

                $.ajax({
                    url: "{{ $api_url }}dosen/skripsi/acc-ujian",
                    method: "POST",
                    headers: { 
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    data: formData,
                    beforeSend: function() {
                        btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');
                    },
                    success: function(res) {
                        if(res.success) {
                            showToastr('success', 'Berhasil', res.success);
                            $('#modal_acc_ujian').modal('hide');
                            // Refresh data mahasiswa dan tombol ACC
                            $.ajax({
                                url: "{{ $api_url }}dosen/skripsi/dashboard",
                                method: "GET",
                                headers: { 
                                    "Authorization": 'Bearer ' + token,
                                    "username": userlogin
                                },
                                data: { id_dosen: id_dosen },
                                success: function(res) {
                                    if(res.status == 'success') {
                                        var mhs = res.data.find(m => m.id_skripsi == id_skripsi);
                                        if(mhs) {
                                            // Refresh tombol ACC berdasarkan status baru
                                            if(mhs.total_bimbingan_acc >= 8) {
                                                $('#btn_acc_ujian').show();
                                            } else {
                                                $('#btn_acc_ujian').hide();
                                            }
                                        }
                                    }
                                }
                            });
                        } else {
                            showToastr('error', 'Gagal', 'Terjadi kesalahan');
                        }
                    },
                    error: function(err) {
                        showToastr('error', 'Gagal', err.responseJSON?.error || 'Kesalahan Server');
                    },
                    complete: function() {
                        btn.prop('disabled', false).html('<i class="fa fa-check-circle"></i> Simpan ACC');
                    }
                });
            });
        });
    </script>
@endsection