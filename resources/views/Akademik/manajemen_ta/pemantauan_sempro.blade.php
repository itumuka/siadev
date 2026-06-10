@extends('layout')

@section('content')
<div class="container-full">
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="box card-premium">
                    <div class="box-header with-border d-flex justify-content-between align-items-center header-navy">
                        <h3 class="box-title text-white"><i class="fa fa-eye mr-2"></i> Pemantauan Konfigurasi Sempro Prodi</h3>
                        <div>
                            <a href="#" class="btn btn-sm btn-light" id="refreshList"><i class="fa fa-refresh mr-1"></i> Refresh</a>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="alert alert-info-premium mb-4">
                            <h5 class="alert-heading"><i class="fa fa-info-circle mr-2"></i> Halaman Pemantauan</h5>
                            <p class="mb-0">Halaman ini menampilkan konfigurasi <strong>Seminar Proposal (Sempro)</strong> yang telah diatur oleh masing-masing Kaprodi. Konfigurasi dikelola sepenuhnya oleh Kaprodi masing-masing Program Studi.</p>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover table-striped table-bordered text-nowrap" id="pemantauanTable" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Kode Prodi</th>
                                        <th>Nama Program Studi</th>
                                        <th>Skema Sempro</th>
                                        <th>Mata Kuliah Syarat</th>
                                        <th>Status</th>
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

    #pemantauanTable thead th {
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

    #pemantauanTable.dataTable thead th.sorting,
    #pemantauanTable.dataTable thead th.sorting_asc,
    #pemantauanTable.dataTable thead th.sorting_desc {
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
</style>
@endsection

@section('script-advanced')
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

    var table = $('#pemantauanTable').DataTable({
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
                    return '<span class="badge-premium badge-status-active"><i class="fa fa-check-circle mr-1"></i> Aktif (Dikelola Kaprodi)</span>';
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

    $('#refreshList').on('click', function(e){
        e.preventDefault();
        table.ajax.reload(null, false);
    });
});
</script>
@endsection
