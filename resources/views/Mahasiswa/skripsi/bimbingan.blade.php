@extends('layout')

@section('css')
<style>
    .log-card { border-left: 4px solid #0066cc; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); margin-bottom: 20px; padding: 15px 20px; transition: transform 0.2s;}
    .log-card:hover { transform: translateX(5px); }
    .status-acc { background-color: #e5f9e7; color: #1e7e34; padding: 4px 10px; border-radius: 20px; font-weight: 600; font-size: 12px;}
    .status-pending { background-color: #fff3cd; color: #856404; padding: 4px 10px; border-radius: 20px; font-weight: 600; font-size: 12px;}
    .status-revisi { background-color: #f8d7da; color: #721c24; padding: 4px 10px; border-radius: 20px; font-weight: 600; font-size: 12px;}
    .loading-spinner { display: inline-block; width: 20px; height: 20px; border: 2px solid #f3f3f3; border-top: 2px solid #3498db; border-radius: 50%; animation: spin 1s linear infinite; }
    @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
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
                        <p class="text-white-50">Syarat minimal bimbingan adalah <span id="min-bimbingan-text">...</span> kali sebelum dapat mendaftar Ujian Akhir Skripsi.</p>
                        
                        <div class="mt-20 px-20" id="progress-container">
                            <div class="d-flex justify-content-between text-white mb-5">
                                <span>Progres (<span id="progress-text">...</span>)</span>
                                <span id="progress-percent">...</span>
                            </div>
                            <div class="progress progress-sm">
                                <div id="progress-bar" class="progress-bar bg-warning" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>

                        <button class="btn btn-warning mt-30 btn-block" data-toggle="modal" data-target="#modalTambahBimbingan">
                            <i class="fa fa-plus"></i> Tambah Catatan Bimbingan
                        </button>
                    </div>
                </div>
                
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">Info Pembimbing</h4>
                    </div>
                    <div class="box-body">
                        <div class="d-flex align-items-center mb-15">
                            <i class="fa fa-user-circle fa-2x text-primary mr-15"></i>
                            <div>
                                <small class="text-muted">Pembimbing 1</small>
                                <div id="pembimbing-1" class="font-weight-600"><i class="fa fa-spinner fa-spin"></i></div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="fa fa-user-circle fa-2x text-info mr-15"></i>
                            <div>
                                <small class="text-muted">Pembimbing 2</small>
                                <div id="pembimbing-2" class="font-weight-600"><i class="fa fa-spinner fa-spin"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-8 col-12">
                <h4 class="mb-20">Riwayat Bimbingan Anda</h4>
                <div id="bimbingan-list">
                    <div class="text-center py-50">
                        <div class="loading-spinner"></div>
                        <p class="text-muted mt-10">Memuat data bimbingan...</p>
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
            <form id="form-bimbingan" enctype="multipart/form-data">
                <div class="modal-body">
                    <div id="form-alert"></div>
                    <div class="form-group">
                        <label>Tanggal Bimbingan <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal" id="tanggal-bimbingan" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Materi / Topik Konsultasi <span class="text-danger">*</span></label>
                        <input type="text" name="topik" id="topik-bimbingan" class="form-control" placeholder="Cth: Bab 3 - Perancangan Sistem" required>
                        <small class="text-muted">Wajib diisi</small>
                    </div>
                    <div class="form-group">
                        <label>Uraian / Pesan ke Pembimbing</label>
                        <textarea name="uraian" id="uraian-bimbingan" class="form-control" rows="4" placeholder="Jelaskan progres Anda..."></textarea>
                    </div>
                    <div class="form-group">
                        <label>Upload File (Opsional)</label>
                        <input type="file" name="file_bimbingan" id="file-bimbingan" class="form-control-file" accept=".pdf,.doc,.docx">
                        <small class="text-muted">Format .pdf, .doc, .docx Maks 5MB.</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="btn-simpan-bimbingan"><i class="fa fa-save"></i> Simpan Catatan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script-master')
<script>
    const CONFIG = {
        api_url: '{{ config('setting.second_url') }}',
        app_url: '{{ url('/') }}',
        token: '{{ $api_token }}',
        username: '{{ $nim }}',
        nim: '{{ $nim }}'
    };

    $(document).ready(function() {
        // Set default date to today
        $('#tanggal-bimbingan').val(new Date().toISOString().split('T')[0]);
        
        // Load bimbingan data
        loadBimbinganData();
        
        // Handle form submission
        $('#form-bimbingan').on('submit', function(e) {
            e.preventDefault();
            simpanBimbingan();
        });
    });

    function loadBimbinganData() {
        $.ajax({
            url: CONFIG.api_url + 'mahasiswa/skripsi/bimbingan',
            type: 'GET',
            headers: {
                'Authorization': 'Bearer ' + CONFIG.token,
                'username': CONFIG.username
            },
            data: { nim: CONFIG.nim },
            success: function(response) {
                if (response.status === 'success') {
                    renderBimbinganData(response.data);
                } else {
                    showError(response.error || 'Gagal memuat data');
                }
            },
            error: function(xhr) {
                console.error('Error:', xhr);
                showError('Terjadi kesalahan saat memuat data');
            }
        });
    }

    function renderBimbinganData(data) {
        // Update progress - using total_bimbingan like dashboard
        const total = data.total_bimbingan || 0;
        const minimal = data.minimal_bimbingan || 8;
        const percent = data.persen || 0;
        
        $('#progress-text').text(total + '/' + minimal);
        $('#progress-percent').text(percent + '%');
        $('#min-bimbingan-text').text(minimal);
        $('#progress-bar')
            .css('width', percent + '%')
            .attr('aria-valuenow', percent);
        
        // Update pembimbing info
        $('#pembimbing-1').text(data.pembimbing['1'] || 'Belum Diplot');
        $('#pembimbing-2').text(data.pembimbing['2'] || '-');
        
        // Render bimbingan list
        const listContainer = $('#bimbingan-list');
        
        if (!data.bimbingan_list || data.bimbingan_list.length === 0) {
            listContainer.html(`
                <div class="alert alert-info">
                    <i class="fa fa-info-circle mr-10"></i>
                    Belum ada catatan bimbingan. Silakan tambahkan catatan bimbingan pertama Anda.
                </div>
            `);
            return;
        }
        
        let html = '';
        data.bimbingan_list.forEach((item, index) => {
            const no = data.bimbingan_list.length - index;
            const statusClass = item.status === 'disetujui' ? 'status-acc' : 
                               (item.status === 'revisi' ? 'status-revisi' : 'status-pending');
            const statusIcon = item.status === 'disetujui' ? 'check-circle' : 
                              (item.status === 'revisi' ? 'times-circle' : 'clock');
            const statusText = item.status === 'disetujui' ? 'Disetujui Dosen' : 
                              (item.status === 'revisi' ? 'Perlu Revisi' : 'Menunggu Validasi');
            
            html += `
                <div class="log-card bg-white">
                    <div class="d-flex justify-content-between align-items-center mb-10">
                        <span class="font-weight-600 text-primary">Bimbingan #${no}</span>
                        <span class="text-muted"><i class="fa fa-calendar"></i> ${formatDate(item.tanggal)}</span>
                    </div>
                    <h5>${escapeHtml(item.topik)}</h5>
                    <p class="text-fade">${escapeHtml(item.uraian) || 'Tidak ada uraian'}</p>
                    <div class="mt-15 d-flex justify-content-between align-items-center">
                        <span class="${statusClass}"><i class="fa fa-${statusIcon}"></i> ${statusText}</span>
                        ${item.catatan_dosen ? `<div class="text-danger small"><strong>Catatan Dosen:</strong> ${escapeHtml(item.catatan_dosen)}</div>` : ''}
                    </div>
                    ${item.path_file ? `
                    <div class="mt-10">
                        <a href="${CONFIG.app_url}/storage/${item.path_file.replace('public/', '')}" target="_blank" class="btn btn-sm btn-outline-info">
                            <i class="fa fa-file"></i> Lihat File
                        </a>
                    </div>
                    ` : ''}
                </div>
            `;
        });
        
        listContainer.html(html);
    }

    function simpanBimbingan() {
        // Validation - Materi wajib diisi
        const topik = $('#topik-bimbingan').val().trim();
        if (!topik) {
            showFormAlert('Materi / Topik Konsultasi wajib diisi!', 'danger');
            $('#topik-bimbingan').focus();
            return;
        }
        
        const btn = $('#btn-simpan-bimbingan');
        const originalText = btn.html();
        btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');
        
        const formData = new FormData($('#form-bimbingan')[0]);
        formData.append('nim', CONFIG.nim);
        
        $.ajax({
            url: CONFIG.api_url + 'mahasiswa/skripsi/bimbingan',
            type: 'POST',
            headers: {
                'Authorization': 'Bearer ' + CONFIG.token,
                'username': CONFIG.username
            },
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    showFormAlert(response.success, 'success');
                    setTimeout(function() {
                        $('#modalTambahBimbingan').modal('hide');
                        $('#form-bimbingan')[0].reset();
                        $('#tanggal-bimbingan').val(new Date().toISOString().split('T')[0]);
                        $('#form-alert').empty();
                        loadBimbinganData();
                    }, 1500);
                } else {
                    showFormAlert(response.error || 'Gagal menyimpan data', 'danger');
                }
                btn.prop('disabled', false).html(originalText);
            },
            error: function(xhr) {
                console.error('Error:', xhr);
                let errorMsg = 'Terjadi kesalahan saat menyimpan data';
                if (xhr.responseJSON && xhr.responseJSON.error) {
                    errorMsg = JSON.stringify(xhr.responseJSON.error);
                }
                showFormAlert(errorMsg, 'danger');
                btn.prop('disabled', false).html(originalText);
            }
        });
    }

    function showFormAlert(message, type) {
        const alertHtml = `<div class="alert alert-${type} alert-dismissible fade show" role="alert">
            ${message}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>`;
        $('#form-alert').html(alertHtml);
    }

    function showError(message) {
        // Update progress area to show error too
        $('#progress-text').text('-/-');
        $('#progress-percent').text('-');
        $('#progress-bar').css('width', '0%').attr('aria-valuenow', 0);
        $('#pembimbing-1').text('-');
        $('#pembimbing-2').text('-');
        
        $('#bimbingan-list').html(`
            <div class="alert alert-danger">
                <i class="fa fa-exclamation-triangle mr-10"></i>
                ${message}
            </div>
        `);
    }

    function formatDate(dateString) {
        if (!dateString) return '-';
        const date = new Date(dateString);
        return date.toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });
    }

    function escapeHtml(text) {
        if (!text) return '';
        return text
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
    }
</script>
@endsection
