@extends('layout')

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
                            <li class="breadcrumb-item" aria-current="page">{{ $parent_breadcrumb }}</li>
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
            <div class="col-12">
                <div class="box animate-fade-in">
                    <div class="box-header with-border bg-primary-light">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="box-title text-dark">Persetujuan Bimbingan Skripsi (Kaprodi)</h4>
                                <p class="mb-0 text-muted small mt-5">Tinjau dan setujui log bimbingan skripsi mahasiswa Program Studi Anda setelah disetujui oleh Dosen Pembimbing.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="box-body">
                        <!-- Data Table -->
                        <div class="table-responsive">
                            <table id="table_bimbingan_kaprodi" class="table table-hover table-bordered table-striped" style="width: 100%;">
                                <thead class="bg-dark text-white">
                                    <tr>
                                        <th style="width: 5%; text-align: center;">No</th>
                                        <th style="width: 12%;">NIM</th>
                                        <th style="width: 20%;">Nama Mahasiswa</th>
                                        <th style="width: 25%;">Dosen Pembimbing I</th>
                                        <th style="width: 15%; text-align: center;">Progres Bimbingan</th>
                                        <th style="width: 13%; text-align: center;">Menunggu Kaprodi</th>
                                        <th style="width: 10%; text-align: center;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Loaded dynamically via AJAX -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal Detail Bimbingan -->
<div class="modal fade" id="modal-detail-bimbingan" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="border-radius: 12px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.15);">
            <div class="modal-header bg-primary py-15">
                <h5 class="modal-title text-white font-weight-600">Detail Log Bimbingan Mahasiswa</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body py-20 px-25">
                <!-- Info Mahasiswa -->
                <div class="row mb-15 pb-15 border-bottom">
                    <div class="col-md-6">
                        <table class="table table-sm table-borderless mb-0">
                            <tr>
                                <td style="width: 30%;" class="font-weight-600">NIM</td>
                                <td style="width: 5%;">:</td>
                                <td id="modal_nim">Loading...</td>
                            </tr>
                            <tr>
                                <td class="font-weight-600">Nama</td>
                                <td>:</td>
                                <td id="modal_nama" class="font-weight-600">Loading...</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-sm table-borderless mb-0">
                            <tr>
                                <td style="width: 30%;" class="font-weight-600">Pembimbing I</td>
                                <td style="width: 5%;">:</td>
                                <td id="modal_pembimbing">Loading...</td>
                            </tr>
                            <tr>
                                <td class="font-weight-600">Total Approved</td>
                                <td>:</td>
                                <td id="modal_total_approved" class="font-weight-700 text-success">Loading...</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-15">
                    <h5 class="box-title mb-0">Riwayat Bimbingan</h5>
                    <div id="kaprodi-decision-actions" style="display:none;">
                        <button type="button" class="btn btn-sm btn-success font-weight-600 mr-5" id="btn-approve-all">
                            <i class="fa fa-check mr-5"></i> Sahkan Bimbingan
                        </button>
                    </div>
                </div>

                <div id="logs-container" style="max-height: 450px; overflow-y: auto; padding-right: 5px;">
                    <!-- Cards Loaded dynamically -->
                </div>
            </div>
            <div class="modal-footer bg-light py-15">
                <button type="button" class="btn btn-secondary px-20 font-weight-600" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>


<style>
    .animate-fade-in {
        animation: fadeIn 0.4s ease-out;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(5px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .log-item-card {
        border-left: 4px solid #dee2e6;
        background: #f8f9fa;
        transition: all 0.2s;
    }
    .log-item-card.state-pending { border-left-color: #ffb136; }
    .log-item-card.state-revisi { border-left-color: #ef5350; }
    .log-item-card.state-disetujui { border-left-color: #0288d1; }
    .log-item-card.state-revisi-kaprodi { border-left-color: #d32f2f; }
    .log-item-card.state-disetujui-kaprodi { border-left-color: #00acc1; }
    .log-item-card.state-revisi-dekan { border-left-color: #c2185b; }
    .log-item-card.state-disetujui-dekan { border-left-color: #2e7d32; }

    .log-item-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }
</style>
@endsection

@section('script-advanced')
<script>
    const CONFIG = {
        api_url: "{{ $api_url }}",
        kode_prodi: "{{ $session_kode_program_studi }}",
        token: "{{ $api_token }}",
        username: "{{ $session_nim }}"
    };

    let tableBimbingan;
    let selectedSkripsiId = null;
    let selectedStudentNim = null;

    $(document).ready(function() {
        // Initialize Datatable
        tableBimbingan = $('#table_bimbingan_kaprodi').DataTable({
            processing: true,
            ajax: {
                url: CONFIG.api_url + "kaprodi/skripsi/bimbingan/list",
                type: "GET",
                headers: {
                    "Authorization": "Bearer " + CONFIG.token,
                    "username": CONFIG.username
                },
                data: { kode_prodi: CONFIG.kode_prodi },
                dataSrc: "data"
            },
            columns: [
                {
                    data: null,
                    className: "text-center font-weight-600",
                    render: (data, type, row, meta) => meta.row + 1
                },
                { data: 'nim', className: "font-weight-600" },
                { data: 'nama_mahasiswa', className: "font-weight-600 text-dark" },
                { data: 'pembimbing', defaultContent: '<span class="text-muted">-</span>' },
                {
                    data: null,
                    className: "text-center",
                    render: function(row) {
                        let total = parseInt(row.total_approved) || 0;
                        let min = parseInt(row.min_bimbingan) || 8;
                        let pct = Math.min(100, Math.round((total / min) * 100));
                        let colorClass = pct >= 100 ? 'bg-success' : 'bg-warning';
                        return `
                            <div class="d-flex align-items-center justify-content-center">
                                <span class="font-weight-700 mr-10">${total}/${min}</span>
                                <div class="progress progress-xs w-60 mb-0">
                                    <div class="progress-bar ${colorClass}" role="progressbar" style="width: ${pct}%" aria-valuenow="${pct}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        `;
                    }
                },
                {
                    data: 'total_waiting_kaprodi',
                    className: "text-center",
                    render: function(val) {
                        let count = parseInt(val) || 0;
                        if (count > 0) {
                            return `<span class="badge badge-pill badge-primary font-weight-700" style="font-size: 11px;">${count} Baru</span>`;
                        }
                        return `<span class="badge badge-pill badge-light text-muted">0</span>`;
                    }
                },
                {
                    data: null,
                    className: "text-center",
                    orderable: false,
                    render: function(data) {
                        return `
                            <div class="text-nowrap">
                                <button class="btn btn-sm btn-info mr-5" onclick="openDetailModal(${data.id}, '${data.nim}', '${data.nama_mahasiswa.replace(/'/g, "\\'")}', '${(data.pembimbing || '-').replace(/'/g, "\\'")}', ${data.total_approved})" title="Detail dan Approval">
                                    <i class="fa fa-check-square-o"></i>
                                </button>
                                <button class="btn btn-sm btn-dark" onclick="printBimbingan('${data.nim}')" title="Cetak Buku Bimbingan">
                                    <i class="fa fa-print"></i>
                                </button>
                            </div>
                        `;
                    }
                }
            ]
        });

        // Event handler for Sahkan Bimbingan (Bulk Approve)
        $('#btn-approve-all').on('click', function() {
            if (!selectedSkripsiId) return;

            swal({
                title: "Sahkan Bimbingan?",
                text: "Apakah Anda yakin ingin mengesahkan secara administratif seluruh log bimbingan mahasiswa ini untuk dilanjutkan ke Ujian?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#28a745",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, Sahkan!",
                cancelButtonText: "Batal"
            }, function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: CONFIG.api_url + "kaprodi/skripsi/bimbingan/approve",
                        type: "POST",
                        headers: {
                            "Authorization": "Bearer " + CONFIG.token,
                            "username": CONFIG.username
                        },
                        data: { id_skripsi: selectedSkripsiId },
                        success: function(res) {
                            if (res.success) {
                                swal("Berhasil!", "Administrasi bimbingan berhasil disahkan.", "success");
                                $('#modal-detail-bimbingan').modal('hide');
                                tableBimbingan.ajax.reload(null, false);
                            }
                        },
                        error: function(err) {
                            swal("Gagal!", err.responseJSON?.error || "Gagal mengesahkan bimbingan.", "error");
                        }
                    });
                }
            });
        });
    });

    function printBimbingan(nim) {
        window.open("{{ url('akademik/manajemen-ta/rekap-bimbingan/cetak') }}/" + nim, '_blank');
    }

    function openDetailModal(id_skripsi, nim, nama, pembimbing, totalApproved) {
        selectedSkripsiId = id_skripsi;
        selectedStudentNim = nim;

        $('#modal_nim').text(nim);
        $('#modal_nama').text(nama);
        $('#modal_pembimbing').text(pembimbing);
        $('#modal_total_approved').text(totalApproved + ' Log Disetujui');

        $('#logs-container').html('<div class="text-center py-20"><i class="fa fa-spinner fa-spin fa-2x"></i><p class="mt-5">Memuat logs bimbingan...</p></div>');
        $('#btn-approve-all').hide();
        $('#modal-detail-bimbingan').modal('show');

        loadModalLogs(nim, id_skripsi);
    }

    function loadModalLogs(nim, id_skripsi) {
        $.ajax({
            url: CONFIG.api_url + "mahasiswa/skripsi/log-bimbingan",
            type: "GET",
            headers: {
                "Authorization": "Bearer " + CONFIG.token,
                "username": CONFIG.username
            },
            data: { nim: nim },
            success: function(res) {
                if (res.status === 'success' && res.data.length > 0) {
                    let html = '';
                    let hasWaiting = false;

                    res.data.forEach(function(item, idx) {
                        let date = item.tanggal ? new Date(item.tanggal).toLocaleDateString('id-ID', {day: 'numeric', month: 'long', year: 'numeric'}) : '-';
                        let stateClass = 'state-' + (item.status || 'pending');
                        let statusText = getStatusLabel(item.status);
                        
                        let badge = `<span class="badge ${getStatusBadgeClass(item.status)}">${statusText}</span>`;
                        let fileLink = item.path_file ? `<a href="${item.path_file}" target="_blank" class="btn btn-xs btn-outline-info ml-10"><i class="fa fa-download mr-5"></i> Unduh Lampiran</a>` : '';
                        let notes = item.catatan_dosen ? `<div class="mt-5 p-5 bg-danger-light rounded small text-danger font-weight-500"><strong>Catatan/Revisi:</strong> ${item.catatan_dosen}</div>` : '';

                        if (item.status === 'disetujui') {
                            hasWaiting = true;
                        }

                        html += `
                            <div class="card mb-15 p-15 log-item-card ${stateClass}">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <span class="text-primary font-weight-700 small">Bimbingan #${idx + 1}</span>
                                        <h5 class="my-5 font-weight-600 text-dark">${item.topik || '-'}</h5>
                                        <p class="mb-5 text-muted small">${item.uraian || '-'}</p>
                                    </div>
                                    <div class="text-right">
                                        <div>${badge}</div>
                                        <div class="text-muted small mt-5"><i class="fa fa-calendar mr-5"></i> ${date}</div>
                                    </div>
                                </div>
                                ${notes}
                                <div class="mt-10">${fileLink}</div>
                            </div>
                        `;
                    });

                    $('#logs-container').html(html);

                    if (hasWaiting) {
                        $('#kaprodi-decision-actions').show();
                    } else {
                        $('#kaprodi-decision-actions').hide();
                    }
                } else {
                    $('#logs-container').html('<div class="alert alert-info">Belum ada riwayat bimbingan.</div>');
                    $('#kaprodi-decision-actions').hide();
                }
            },
            error: function() {
                $('#logs-container').html('<div class="alert alert-danger">Gagal memuat log bimbingan.</div>');
                $('#kaprodi-decision-actions').hide();
            }
        });
    }

    function getStatusLabel(status) {
        switch(status) {
            case 'pending': return 'Menunggu Dosen';
            case 'revisi': return 'Revisi Dosen';
            case 'disetujui': return 'Menunggu Kaprodi';
            case 'disetujui_kaprodi': return 'Selesai (Disetujui Kaprodi)';
            default: return status || '';
        }
    }

    function getStatusBadgeClass(status) {
        switch(status) {
            case 'pending': return 'badge-warning';
            case 'revisi': return 'badge-danger';
            case 'disetujui': return 'badge-primary';
            case 'disetujui_kaprodi': return 'badge-success';
            default: return 'badge-secondary';
        }
    }
</script>
@endsection
