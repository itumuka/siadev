@extends('layout')

@section('content')
<div class="container-full">
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="box">
                    <div class="box-header with-border d-flex justify-content-between align-items-center">
                        <h3 class="box-title">Rekap Bimbingan</h3>
                        <div>
                            <a href="#" class="btn btn-sm btn-primary" id="refreshList"><i class="fa fa-refresh"></i> Refresh</a>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped table-bordered text-nowrap" id="rekapTable" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>NIM</th>
                                        <th>Nama Mahasiswa</th>
                                        <th>Program Studi</th>
                                        <th>Dosen Pembimbing</th>
                                        <th>Progres</th>
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

<!-- Modal: Rekap Log Bimbingan -->
<div class="modal fade" id="modalRekapLog" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Rekap Bimbingan <span id="modal_nama"></span></h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="rekapLogContainer">
                    <div class="text-center p-20">
                        <i class="fa fa-spinner fa-spin fa-2x"></i>
                        <p>Memuat rekapan bimbingan...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
<style>
    #rekapTable thead th {
        background-color: #172B4C !important;
        color: #ffffff !important;
        border-color: #172B4C !important;
        vertical-align: middle;
    }

    #rekapTable.dataTable thead th.sorting,
    #rekapTable.dataTable thead th.sorting_asc,
    #rekapTable.dataTable thead th.sorting_desc {
        background-color: #172B4C !important;
        color: #ffffff !important;
    }

    #rekapTable_filter .filter-prodi-label {
        margin-left: 10px;
    }

    #rekapTable_filter .filter-prodi-label select {
        margin-left: 6px;
        min-width: 180px;
        display: inline-block;
    }
</style>
@endsection

@section('script-advanced')
<script>
$(function(){
    var apiToken = "{{ $api_token }}";
    var apiUrl = "{{ $api_url }}";
    var sessionUser = "{{ $session_username }}";

    $.fn.DataTable.ext.pager.numbers_length = 3;

    function handleAuthFailure(xhr) {
        var response = xhr && xhr.responseJSON ? xhr.responseJSON : {};
        var message = (response.message || '') + ' ' + (response.error || '');
        if (xhr && xhr.status === 401 && /invalid token|signature verification failed|missing authorization token/i.test(message)) {
            window.location.href = "{{ route('logout') }}";
            return true;
        }
        return false;
    }

    var table = $('#rekapTable').DataTable({
        destroy: true,
        processing: true,
        lengthChange: true,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, 'All']],
        pageLength: 10,
        order: [[1, 'asc']],
        dom: 'lfrtip',
        ajax: {
            type: 'GET',
            url: apiUrl + 'akademik/rekap-bimbingan',
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
            { data: 'nim' },
            { data: 'nama_mahasiswa', render: function(data){ return data || '-'; } },
            { data: 'prodi', render: function(data){ return data || '-'; } },
            { data: 'pembimbing', render: function(data){ return data || '-'; } },
            {
                data: null,
                orderable: false,
                searchable: false,
                render: function(data, type, row) {
                    var minBimbingan = Number(row.min_bimbingan) || 8;
                    var total = Number(row.total_bimbingan) || 0;
                    var percent = Math.min(100, Math.round((total / minBimbingan) * 100));

                    return '<div style="min-width:220px;">' +
                        '<div class="d-flex align-items-center">' +
                            '<div class="progress flex-grow-1 mr-2" style="height:14px;">' +
                                '<div class="progress-bar bg-success" role="progressbar" style="width:' + percent + '%" aria-valuenow="' + percent + '" aria-valuemin="0" aria-valuemax="100"></div>' +
                            '</div>' +
                            '<small class="text-muted">' + total + '/' + minBimbingan + '</small>' +
                        '</div>' +
                    '</div>';
                }
            },
            {
                data: null,
                orderable: false,
                searchable: false,
                className: 'text-center',
                render: function(data, type, row) {
                    return '<button class="btn btn-sm btn-info btn-view-log" data-nim="'+row.nim+'" data-nama="'+(row.nama_mahasiswa||'')+'">Lihat</button>';
                }
            }
        ],
        language: {
            emptyTable: 'Tidak ada data.',
            zeroRecords: 'Data tidak ditemukan.',
            loadingRecords: 'Memuat data...',
            processing: 'Memuat data...'
        },
        initComplete: function() {
            var api = this.api();
            var $filter = $('#rekapTable_filter');

            if (!$filter.find('#filterProdi').length) {
                $filter.append(
                    '<label class="filter-prodi-label">Program Studi:' +
                    '<select id="filterProdi" class="form-control form-control-sm">' +
                    '<option value="">Semua</option>' +
                    '</select>' +
                    '</label>'
                );
            }

            function updateProdiOptions() {
                var $select = $('#filterProdi');
                var selected = $select.val() || '';
                var source = api.column(3, { search: 'none' }).data().toArray();
                var uniq = [];

                source.forEach(function(item) {
                    var val = (item || '-').toString().trim();
                    if (val && uniq.indexOf(val) === -1) {
                        uniq.push(val);
                    }
                });

                uniq.sort(function(a, b) {
                    return a.localeCompare(b, 'id');
                });

                $select.find('option:not(:first)').remove();
                uniq.forEach(function(val) {
                    $select.append('<option value="' + $('<div/>').text(val).html() + '">' + val + '</option>');
                });

                $select.val(selected);
                if ($select.val() !== selected) {
                    $select.val('');
                }
            }

            updateProdiOptions();

            $filter.off('change.rekapProdi', '#filterProdi').on('change.rekapProdi', '#filterProdi', function() {
                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                api.column(3).search(val ? '^' + val + '$' : '', true, false).draw();
            });

            api.on('draw', function() {
                updateProdiOptions();
            });
        }
    });

    // Show logs in modal
    $(document).on('click', '.btn-view-log', function(){
        var nim = $(this).data('nim');
        var nama = $(this).data('nama');
        $('#modal_nama').text(' - ' + nama + ' ('+nim+')');
        $('#rekapLogContainer').html('<div class="text-center p-20"><i class="fa fa-spinner fa-spin fa-2x"></i><p>Memuat rekapan bimbingan...</p></div>');
        $('#modalRekapLog').modal('show');

        $.ajax({
            url: apiUrl + 'mahasiswa/skripsi/log-bimbingan',
            method: 'GET',
            headers: { 'Authorization': 'Bearer ' + apiToken, 'username': sessionUser },
            data: { nim: nim },
            success: function(res){
                if(res.status === 'success'){
                    var html = '';
                    if(res.data.length === 0) {
                        html = '<div class="alert alert-info">Belum ada riwayat bimbingan.</div>';
                    } else {
                        res.data.forEach(function(item, idx){
                            var date = item.tanggal ? new Date(item.tanggal).toLocaleDateString('id-ID') : '-';
                            var status = item.status || '';
                            var badge = '<span class="badge badge-secondary">'+status+'</span>';
                            if(status == 'disetujui') badge = '<span class="badge badge-success">Disetujui</span>';
                            if(status == 'revisi') badge = '<span class="badge badge-warning">Revisi</span>';

                            html += '<div class="card mb-2"><div class="card-body">' +
                                    '<div class="d-flex justify-content-between"><div><strong>'+ (idx+1) +'. '+ (item.topik || '-') +'</strong><div class="text-muted small">'+(item.uraian||'')+'</div></div><div class="text-right">'+badge+'<div class="text-muted small">'+date+'</div></div></div>' +
                                    '</div></div>';
                        });
                    }
                    $('#rekapLogContainer').html(html);
                } else {
                    $('#rekapLogContainer').html('<div class="alert alert-danger">Gagal memuat rekapan bimbingan.</div>');
                }
            },
            error: function(xhr){
                if (handleAuthFailure(xhr)) {
                    return;
                }
                $('#rekapLogContainer').html('<div class="alert alert-danger">Gagal memuat rekapan bimbingan.</div>');
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
