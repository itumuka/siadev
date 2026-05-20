@extends('layout')

@section('content')
<div class="container-full">
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="box card-premium">
                    <div class="box-header with-border d-flex justify-content-between align-items-center header-navy">
                        <h3 class="box-title text-white"><i class="fa fa-shield mr-2"></i> Validasi Konfigurasi Sempro Prodi</h3>
                        <div>
                            <a href="#" class="btn btn-sm btn-light" id="refreshList"><i class="fa fa-refresh mr-1"></i> Refresh</a>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="alert alert-info-premium mb-4">
                            <h5 class="alert-heading"><i class="fa fa-info-circle mr-2"></i> Sistem Pengawasan Administrator</h5>
                            <p class="mb-0">Halaman ini digunakan untuk mengontrol dan memvalidasi konfigurasi <strong>Seminar Proposal (Sempro)</strong> yang diatur oleh masing-masing Kaprodi. Demi menjaga integritas akademik, skema <strong>"Integrasi Mata Kuliah"</strong> baru akan aktif pada portal mahasiswa setelah disetujui (divalidasi) oleh Administrator di bawah ini.</p>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover table-striped table-bordered text-nowrap" id="validasiTable" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Kode Prodi</th>
                                        <th>Nama Program Studi</th>
                                        <th>Skema Sempro</th>
                                        <th>Mata Kuliah Syarat</th>
                                        <th>Status Validasi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('css')
<style>
    .card-premium {
        border-radius: 12px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.05);
        overflow: hidden;
        border: none;
    }

    .header-navy {
        background: linear-gradient(135deg, #172B4C 0%, #0a172c 100%) !important;
        border-bottom: none;
        padding: 18px 24px;
    }

    #validasiTable thead th {
        background-color: #172B4C !important;
        color: #ffffff !important;
        border-color: #172B4C !important;
        vertical-align: middle;
        text-transform: uppercase;
        font-size: 11px;
        letter-spacing: 0.5px;
        font-weight: 700;
        padding: 12px 15px;
    }

    #validasiTable.dataTable thead th.sorting,
    #validasiTable.dataTable thead th.sorting_asc,
    #validasiTable.dataTable thead th.sorting_desc {
        background-color: #172B4C !important;
        color: #ffffff !important;
    }

    .alert-info-premium {
        background-color: #e8f4fd;
        border-left: 5px solid #1976d2;
        color: #0d47a1;
        padding: 15px;
        border-radius: 6px;
    }

    .badge-premium {
        font-size: 11px;
        padding: 6px 12px;
        border-radius: 20px;
        font-weight: 600;
        display: inline-block;
    }

    .badge-matakuliah {
        background-color: #e3f2fd;
        color: #0d47a1;
        border: 1px solid #90caf9;
    }

    .badge-skripsi {
        background-color: #f5f5f5;
        color: #616161;
        border: 1px solid #e0e0e0;
    }

    .badge-status-pending {
        background-color: #fff8e1;
        color: #ff8f00;
        border: 1px solid #ffe082;
    }

    .badge-status-active {
        background-color: #e8f5e9;
        color: #2e7d32;
        border: 1px solid #a5d6a7;
    }

    .badge-status-neutral {
        background-color: #eceff1;
        color: #37474f;
        border: 1px solid #cfd8dc;
    }

    .badge-mk-pill {
        display: inline-block;
        background-color: #f1f3f4;
        color: #3c4043;
        border-radius: 4px;
        padding: 3px 8px;
        margin: 2px;
        font-size: 11px;
        font-weight: 500;
        border: 1px solid #dadce0;
    }

    .btn-action-premium {
        border-radius: 20px;
        font-size: 11px;
        padding: 5px 12px;
        font-weight: 600;
        transition: all 0.2s ease;
    }

    .btn-action-premium:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
</style>
<!-- Inject SweetAlert2 for high quality premium alerts -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@endsection

@section('script-advanced')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(function(){
    var apiToken = "{{ $api_token }}";
    var apiUrl = "{{ $api_url }}";
    var sessionUser = "{{ $session_username }}";

    function handleAuthFailure(xhr) {
        var response = xhr && xhr.responseJSON ? xhr.responseJSON : {};
        var message = (response.message || '') + ' ' + (response.error || '');
        if (xhr && xhr.status === 401 && /invalid token|signature verification failed|missing authorization token/i.test(message)) {
            window.location.href = "{{ route('logout') }}";
            return true;
        }
        return false;
    }

    var table = $('#validasiTable').DataTable({
        destroy: true,
        processing: true,
        lengthChange: true,
        pageLength: 25,
        dom: 'lftip',
        ajax: {
            type: 'GET',
            url: apiUrl + 'akademik/skripsi/list-config-sempro',
            headers: {
                'Authorization': 'Bearer ' + apiToken,
                'username': sessionUser
            },
            dataSrc: function(json) {
                return (json && json.data) ? json.data : [];
            },
            error: function(xhr) {
                if (handleAuthFailure(xhr)) {
                    return;
                }
            }
        },
        columns: [
            {
                data: null,
                orderable: false,
                searchable: false,
                className: 'text-center',
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { data: 'kode_program_studi', className: 'text-center font-weight-600' },
            { data: 'nama_program_studi', className: 'font-weight-600' },
            { 
                data: 'ta_sempro_skema',
                className: 'text-center',
                render: function(data) {
                    if (data === 'matakuliah') {
                        return '<span class="badge-premium badge-matakuliah"><i class="fa fa-book mr-1"></i> Integrasi Mata Kuliah</span>';
                    }
                    return '<span class="badge-premium badge-skripsi"><i class="fa fa-graduation-cap mr-1"></i> Alur Skripsi (Manual)</span>';
                }
            },
            {
                data: 'mapped_matakuliah',
                render: function(data, type, row) {
                    if (row.ta_sempro_skema !== 'matakuliah') {
                        return '<span class="text-muted italic">-</span>';
                    }
                    if (!data || data.length === 0) {
                        return '<span class="text-danger"><i class="fa fa-warning"></i> Belum Dipetakan</span>';
                    }
                    var html = '';
                    data.forEach(function(mk) {
                        html += '<span class="badge-mk-pill" title="Kode: ' + mk.kode_matakuliah + '">' + mk.nama_matakuliah + '</span>';
                    });
                    return html;
                }
            },
            {
                data: null,
                className: 'text-center',
                render: function(data, type, row) {
                    if (row.ta_sempro_skema !== 'matakuliah') {
                        return '<span class="badge-premium badge-status-neutral"><i class="fa fa-check-circle-o mr-1"></i> Aktif Otomatis</span>';
                    }
                    if (row.ta_sempro_is_validated == 1) {
                        return '<span class="badge-premium badge-status-active"><i class="fa fa-check-circle mr-1"></i> Divalidasi & Aktif</span>';
                    }
                    return '<span class="badge-premium badge-status-pending"><i class="fa fa-clock-o mr-1"></i> Menunggu Validasi</span>';
                }
            },
            {
                data: null,
                orderable: false,
                searchable: false,
                className: 'text-center',
                render: function(data, type, row) {
                    var html = '';
                    if (row.ta_sempro_skema === 'matakuliah') {
                        if (row.ta_sempro_is_validated == 0) {
                            html += '<button class="btn btn-xs btn-success btn-action-premium btn-approve mr-1" data-id="'+row.kode_program_studi+'" data-name="'+row.nama_program_studi+'"><i class="fa fa-check mr-1"></i> Setujui</button>';
                        } else {
                            html += '<button class="btn btn-xs btn-warning btn-action-premium btn-suspend mr-1" data-id="'+row.kode_program_studi+'" data-name="'+row.nama_program_studi+'"><i class="fa fa-lock mr-1"></i> Tangguhkan</button>';
                        }
                        html += '<button class="btn btn-xs btn-danger btn-action-premium btn-reset" data-id="'+row.kode_program_studi+'" data-name="'+row.nama_program_studi+'"><i class="fa fa-undo mr-1"></i> Kembalikan ke Skripsi</button>';
                    } else {
                        html += '<span class="text-muted font-size-11">Tidak Ada Aksi</span>';
                    }
                    return html;
                }
            }
        ],
        language: {
            emptyTable: 'Tidak ada data konfigurasi prodi.',
            zeroRecords: 'Konfigurasi tidak ditemukan.',
            loadingRecords: 'Memuat data konfigurasi...',
            processing: 'Memuat data konfigurasi...'
        }
    });

    // Setujui (Approve)
    $(document).on('click', '.btn-approve', function() {
        var id = $(this).data('id');
        var name = $(this).data('name');

        Swal.fire({
            title: 'Setujui Konfigurasi?',
            text: 'Apakah Anda yakin ingin menyetujui skema "Integrasi Mata Kuliah" untuk Program Studi ' + name + '?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#2e7d32',
            cancelButtonColor: '#757575',
            confirmButtonText: 'Ya, Setujui!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Memproses...',
                    didOpen: () => { Swal.showLoading(); }
                });

                $.ajax({
                    url: apiUrl + 'akademik/skripsi/validate-config-sempro',
                    method: 'POST',
                    headers: {
                        'Authorization': 'Bearer ' + apiToken,
                        'username': sessionUser
                    },
                    data: {
                        kode_prodi: id,
                        status: 1
                    },
                    success: function(res) {
                        if (res.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: res.message,
                                timer: 2000,
                                showConfirmButton: false
                            });
                            table.ajax.reload(null, false);
                        } else {
                            Swal.fire('Gagal!', 'Terjadi kesalahan saat memproses data.', 'error');
                        }
                    },
                    error: function(xhr) {
                        if (handleAuthFailure(xhr)) return;
                        Swal.fire('Gagal!', 'Terjadi kesalahan koneksi server.', 'error');
                    }
                });
            }
        });
    });

    // Tangguhkan (Suspend)
    $(document).on('click', '.btn-suspend', function() {
        var id = $(this).data('id');
        var name = $(this).data('name');

        Swal.fire({
            title: 'Tangguhkan Konfigurasi?',
            text: 'Apakah Anda yakin ingin menangguhkan skema untuk Program Studi ' + name + '? Mahasiswa prodi ini sementara tidak bisa lulus Sempro otomatis.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ff8f00',
            cancelButtonColor: '#757575',
            confirmButtonText: 'Ya, Tangguhkan!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Memproses...',
                    didOpen: () => { Swal.showLoading(); }
                });

                $.ajax({
                    url: apiUrl + 'akademik/skripsi/validate-config-sempro',
                    method: 'POST',
                    headers: {
                        'Authorization': 'Bearer ' + apiToken,
                        'username': sessionUser
                    },
                    data: {
                        kode_prodi: id,
                        status: 0
                    },
                    success: function(res) {
                        if (res.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Ditangguhkan!',
                                text: res.message,
                                timer: 2000,
                                showConfirmButton: false
                            });
                            table.ajax.reload(null, false);
                        } else {
                            Swal.fire('Gagal!', 'Terjadi kesalahan saat memproses data.', 'error');
                        }
                    },
                    error: function(xhr) {
                        if (handleAuthFailure(xhr)) return;
                        Swal.fire('Gagal!', 'Terjadi kesalahan koneksi server.', 'error');
                    }
                });
            }
        });
    });

    // Kembalikan ke Skripsi (Reset to default skripsi manual)
    $(document).on('click', '.btn-reset', function() {
        var id = $(this).data('id');
        var name = $(this).data('name');

        Swal.fire({
            title: 'Kembalikan ke Alur Skripsi?',
            text: 'Skema Sempro untuk ' + name + ' akan langsung di-reset kembali ke "Alur Skripsi (Manual)". Data pemetaan mata kuliah syarat akan dihapus.',
            icon: 'error',
            showCancelButton: true,
            confirmButtonColor: '#d32f2f',
            cancelButtonColor: '#757575',
            confirmButtonText: 'Ya, Reset ke Manual!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Memproses...',
                    didOpen: () => { Swal.showLoading(); }
                });

                $.ajax({
                    url: apiUrl + 'kaprodi/skripsi/update-config-sempro',
                    method: 'POST',
                    headers: {
                        'Authorization': 'Bearer ' + apiToken,
                        'username': sessionUser
                    },
                    data: {
                        kode_prodi: id,
                        ta_sempro_skema: 'skripsi',
                        id_matakuliah: []
                    },
                    success: function(res) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil di-Reset!',
                            text: 'Konfigurasi prodi ' + name + ' berhasil dikembalikan ke Alur Skripsi manual.',
                            timer: 2500,
                            showConfirmButton: false
                        });
                        table.ajax.reload(null, false);
                    },
                    error: function(xhr) {
                        if (handleAuthFailure(xhr)) return;
                        Swal.fire('Gagal!', 'Terjadi kesalahan saat mereset konfigurasi.', 'error');
                    }
                });
            }
        });
    });

    $('#refreshList').on('click', function(e){
        e.preventDefault();
        table.ajax.reload(null, false);
    });
});
</script>
@endsection
