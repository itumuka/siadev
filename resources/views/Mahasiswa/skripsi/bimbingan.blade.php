@extends('layout')

@section('css')
<style>
    .log-card { border-left: 4px solid #0066cc; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); margin-bottom: 20px; padding: 15px 20px; transition: transform 0.2s;}
    .log-card:hover { transform: translateX(5px); }
    .status-acc { background-color: #e5f9e7; color: #1e7e34; padding: 4px 10px; border-radius: 20px; font-weight: 600; font-size: 12px;}
    .status-pending { background-color: #fff3cd; color: #856404; padding: 4px 10px; border-radius: 20px; font-weight: 600; font-size: 12px;}
    .status-revisi { background-color: #f8d7da; color: #721c24; padding: 4px 10px; border-radius: 20px; font-weight: 600; font-size: 12px;}
</style>
@endsection

@section('content')
<div class="container-full">
    <section class="content">
        <div class="row">
            <div class="col-xl-4 col-12">
                <div class="box bg-primary">
                    <div class="box-body text-center p-30">
                        <i class="fa fa-book fa-3x text-white mb-10"></i>
                        <h3 class="text-white">Buku Bimbingan Digital</h3>
                        <p class="text-white-50">Syarat minimal bimbingan adalah <span id="min_bimbingan_text">8</span> kali sebelum dapat mendaftar Ujian Akhir Skripsi.</p>
                        
                        <div class="mt-20 px-20">
                            <div class="d-flex justify-content-between text-white mb-5">
                                <span id="progress_label">Progres (0/8)</span>
                                <span id="progress_percent">0%</span>
                            </div>
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-warning" id="progress_bar_fill" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>

                        <button class="btn btn-warning mt-30 btn-block" data-toggle="modal" data-target="#modalTambahBimbingan">
                            <i class="fa fa-plus"></i> Tambah Catatan Bimbingan
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-xl-8 col-12">
                <h4 class="mb-20">Riwayat Bimbingan Anda</h4>
                <div id="log-container">
                    <div class="text-center p-20">
                        <i class="fa fa-spinner fa-spin fa-2x"></i>
                        <p>Memuat riwayat bimbingan...</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal Tambah Bimbingan -->
<div class="modal fade" id="modalTambahBimbingan" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Catat Bimbingan Baru</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formTambahBimbingan" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Tanggal Bimbingan</label>
                        <input type="date" class="form-control" name="tanggal" id="tanggal_bimbingan" required>
                        <small class="text-muted">Tanggal tidak boleh melebihi hari ini</small>
                    </div>
                    <div class="form-group">
                        <label>Materi / Topik Konsultasi</label>
                        <input type="text" class="form-control" name="topik" placeholder="Cth: Bab 3 - Perancangan Sistem" required>
                    </div>
                    <div class="form-group">
                        <label>Uraian / Pesan ke Pembimbing</label>
                        <textarea class="form-control" name="uraian" rows="4" placeholder="Jelaskan progres Anda..." required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Upload File (Opsional)</label>
                        <input type="file" class="form-control-file" name="file_lampiran" accept=".pdf,.doc,.docx">
                        <small class="text-muted">Format .pdf atau .docx Maks 5MB.</small>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" form="formTambahBimbingan" class="btn btn-primary" id="btnSimpanBimbingan"><i class="fa fa-save"></i> Simpan Catatan</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script-advanced')
<script>
$(document).ready(function() {
    var token = "{{ $api_token }}";
    var nim = "{{ $session_nim }}";
    var apiUrl = "{{ $api_url }}mahasiswa/skripsi/";

    // Set max date to today for tanggal bimbingan
    var today = new Date().toISOString().split('T')[0];
    $('#tanggal_bimbingan').attr('max', today);
    $('#tanggal_bimbingan').val(today);

    function loadDashboardData() {
        $.ajax({
            url: apiUrl + "dashboard",
            type: "GET",
            headers: {
                "Authorization": "Bearer " + token,
                "username": nim
            },
            data: { nim: nim },
            success: function(res) {
                if(res.status == 'success') {
                    var minBimbingan = res.data.config.min_bimbingan || 8;
                    var totalAcc = res.data.bimbingan.total || 0;
                    var persen = res.data.bimbingan.persen || 0;

                    $('#min_bimbingan_text').text(minBimbingan);
                    $('#progress_label').text('Progres (' + totalAcc + '/' + minBimbingan + ')');
                    $('#progress_percent').text(persen + '%');
                    $('#progress_bar_fill').css('width', persen + '%').attr('aria-valuenow', persen);
                }
            }
        });
    }

    function loadLogs() {
        $.ajax({
            url: apiUrl + "log-bimbingan",
            type: "GET",
            headers: {
                "Authorization": "Bearer " + token,
                "username": nim
            },
            data: { nim: nim },
            success: function(res) {
                var container = $('#log-container');
                container.empty();

                if(res.status == 'success' && res.data.length > 0) {
                    var logsHtml = '';
                    res.data.forEach(function(item, index) {
                        var no = res.data.length - index;
                        var date = new Date(item.tanggal).toLocaleDateString('id-ID', {day: 'numeric', month: 'long', year: 'numeric'});
                        
                        var statusBadge = '';
                        if(item.status == 'disetujui') {
                            statusBadge = '<span class="status-acc"><i class="fa fa-check-circle"></i> Disetujui Dosen</span>';
                        } else if(item.status == 'revisi') {
                            statusBadge = '<span class="status-revisi"><i class="fa fa-times-circle"></i> Perlu Revisi</span>';
                        } else {
                            statusBadge = '<span class="status-pending"><i class="fa fa-clock-o"></i> Menunggu Validasi</span>';
                        }

                        var fileBadge = item.path_file ? '<a href="'+item.path_file+'" target="_blank" class="btn btn-sm btn-outline-info ml-2"><i class="fa fa-download"></i> Unduh Lampiran</a>' : '';
                        
                        var dosenFeedback = '';
                        if(item.catatan_dosen) {
                            dosenFeedback = '<div class="text-danger small mt-2"><strong>Catatan Dosen:</strong> '+item.catatan_dosen+'</div>';
                        }

                        logsHtml += `
                            <div class="log-card bg-white">
                                <div class="d-flex justify-content-between align-items-center mb-10">
                                    <span class="font-weight-600 text-primary">Bimbingan #${no}</span>
                                    <span class="text-muted"><i class="fa fa-calendar"></i> ${date}</span>
                                </div>
                                <h5>${item.topik}</h5>
                                <p class="text-fade">${item.uraian || '-'}</p>
                                <div class="mt-15">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>${statusBadge} ${fileBadge}</div>
                                    </div>
                                    ${dosenFeedback}
                                </div>
                            </div>
                        `;
                    });
                    container.html(logsHtml);
                } else {
                    container.html('<div class="alert alert-info">Belum ada riwayat bimbingan.</div>');
                }
            },
            error: function() {
                $('#log-container').html('<div class="alert alert-danger">Gagal memuat data.</div>');
            }
        });
    }

    loadDashboardData();
    loadLogs();

    $('#formTambahBimbingan').on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        formData.append('nim', nim);

        var btn = $('#btnSimpanBimbingan');
        btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');

        $.ajax({
            url: apiUrl + "tambah-bimbingan",
            type: "POST",
            headers: {
                "Authorization": "Bearer " + token,
                "username": nim
            },
            data: formData,
            processData: false,
            contentType: false,
            success: function(res) {
                if(res.success) {
                    showToastr('success', 'Berhasil', res.success);
                    $('#modalTambahBimbingan').modal('hide');
                    $('#formTambahBimbingan')[0].reset();
                    loadLogs(); // Reload data
                    loadDashboardData(); // Update progress bar
                } else {
                    showToastr('error', 'Gagal', 'Terjadi kesalahan.');
                }
            },
            error: function(err) {
                var msg = 'Terjadi kesalahan server.';
                if(err.responseJSON && err.responseJSON.error) {
                    if(typeof err.responseJSON.error === 'object') {
                        msg = Object.values(err.responseJSON.error)[0][0];
                    } else {
                        msg = err.responseJSON.error;
                    }
                }
                showToastr('error', 'Gagal', msg);
            },
            complete: function() {
                btn.prop('disabled', false).html('<i class="fa fa-save"></i> Simpan Catatan');
            }
        });
    });
});
</script>
@endsection