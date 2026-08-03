@extends('layout')

@section('css')
    <style>
        th, td {
            white-space: nowrap;
        }
        td.col-nama-matakuliah {
            white-space: normal;
            min-width: 220px;
        }
        .nama-id {
            display: block;
            font-weight: 500;
        }
        .nama-en {
            display: block;
            font-style: italic;
            color: #28a745;
            font-size: 0.82em;
            margin-top: 2px;
            cursor: pointer;
            border-bottom: 1px dashed transparent;
            transition: border-color 0.2s;
        }
        .nama-en:hover {
            border-bottom-color: #28a745;
        }
        .nama-en-empty {
            display: block;
            font-style: italic;
            color: #adb5bd;
            font-size: 0.80em;
            margin-top: 2px;
            cursor: pointer;
        }
        .nama-en-input {
            font-size: 0.82em;
            font-style: italic;
            border: 1px solid #28a745;
            border-radius: 3px;
            padding: 2px 6px;
            width: 100%;
            outline: none;
            color: #28a745;
        }
        .btn-sync-translate {
            transition: all 0.2s;
        }
        .sync-progress {
            font-size: 0.85em;
            color: #6c757d;
        }
    </style>
@endsection

@section('content')
    <div class="container-full">
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">Kurikulum Program Studi</h3>
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
            <div class="box">
                <div class="box-header with-border">
                    <h6 class="box-subtitle">Kurikulum Program Studi — Nama Bilingual</h6>
                </div>

                <div class="box-body">
                    <div class="box">
                        <div class="box-body ribbon-box bg-success-light">
                            <div class="ribbon ribbon-success">Kaprodi</div>
                            <p class="mb-0">
                                Klik nama Bahasa Inggris untuk mengedit langsung. Gunakan tombol <strong>Auto-Translate</strong> untuk mentranslasi otomatis mata kuliah yang belum memiliki nama Inggris.
                            </p>
                        </div>
                    </div>

                    <div class="box-header no-border px-0">
                        <div class="row align-items-end">
                            <div class="col-md-3 col-sm-6">
                                <div class="form-group mb-0">
                                    <label for="filter_tahun_kurikulum" class="font-weight-600 text-dark">Tahun Kurikulum</label>
                                    <select class="form-control" id="filter_tahun_kurikulum">
                                        <option value="">- Memuat... -</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-5 col-sm-6">
                                <button id="btn-sync-translate" class="btn btn-info btn-sm btn-sync-translate" style="display:none;" type="button">
                                    <i class="fa fa-language"></i> Auto-Translate
                                    <span class="badge badge-light ml-1" id="count-untranslated">0</span> mata kuliah
                                </button>
                                <span id="sync-progress-text" class="sync-progress ml-2" style="display:none;"></span>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive mt-2">
                        <input type="hidden" id="kode_prodi" value="{{ $session_kode_program_studi }}">
                        <table id="tbkurikulumkaprodi" class="table table-hover table-bordered table-striped" width="100%">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th>No</th>
                                    <th>Kurikulum</th>
                                    <th>Kode</th>
                                    <th>Nama Matakuliah <small class="text-warning">(klik nama Inggris untuk edit)</small></th>
                                    <th>SKS</th>
                                    <th>Smt</th>
                                    <th>Program Studi</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('script-master')
<script type="text/javascript">
$(document).ready(function() {
    var token    = "{{ Session::get('token') }}";
    var userlogin = "{{ Session::get('username') }}";
    var kode_prodi = $('#kode_prodi').val();
    var apiUrl   = "{{ config('setting.second_url') }}";
    var isSyncing = false;

    // ─── Load Kurikulum Filter ─────────────────────────────────────────────
    $.ajax({
        type: 'GET',
        url: apiUrl + 'akademik/select-kurikulum',
        headers: { "Authorization": 'Bearer ' + token, "username": userlogin },
        data: { kode_prodi: kode_prodi },
        success: function(response) {
            var s = '<option value="">- Semua Tahun Kurikulum -</option>';
            var data = response.data || response;
            if (data && data.length > 0) {
                data.forEach(function(val) {
                    s += '<option value="' + val.id + '">' + val.text + '</option>';
                });
            }
            $('#filter_tahun_kurikulum').html(s);
            loadDataTable();
        },
        error: function() {
            $('#filter_tahun_kurikulum').html('<option value="">- Semua Tahun Kurikulum -</option>');
            loadDataTable();
        }
    });

    $('#filter_tahun_kurikulum').on('change', function() { loadDataTable(); });

    // ─── DataTable ────────────────────────────────────────────────────────
    function loadDataTable() {
        var tahun_kurikulum = $('#filter_tahun_kurikulum').val();
        $("#tbkurikulumkaprodi").DataTable({
            destroy: true,
            dom: 'lBfrtip',
            buttons: ['copy', 'csv', 'excel'],
            pageLength: 25,
            processing: true,
            lengthChange: true,
            ajax: {
                type: "GET",
                url: apiUrl + 'akademik/matakuliah',
                headers: { "Authorization": 'Bearer ' + token, "username": userlogin },
                data: { kode_prodi: kode_prodi, tahun_kurikulum: tahun_kurikulum },
                dataSrc: function(json) { return json; }
            },
            columns: [
                {
                    data: null,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                { data: 'tahun_kurikulum', className: 'text-center' },
                { data: 'kode_matakuliah' },
                {
                    data: null,
                    className: 'col-nama-matakuliah',
                    render: function(data, type, row) {
                        if (type === 'export' || type === 'sort' || type === 'filter') {
                            return row.nama_matakuliah;
                        }
                        var idMk = row.id_matakuliah;
                        var namaID = '<span class="nama-id">' + row.nama_matakuliah + '</span>';
                        var namaEN;
                        if (row.nama_matakuliah_inggris) {
                            namaEN = '<span class="nama-en" data-id="' + idMk + '" data-src="' + encodeURIComponent(row.nama_matakuliah) + '" title="Klik untuk edit">'
                                + row.nama_matakuliah_inggris + '</span>';
                        } else {
                            namaEN = '<span class="nama-en-empty" data-id="' + idMk + '" data-src="' + encodeURIComponent(row.nama_matakuliah) + '" title="Klik untuk edit">'
                                + '✎ (belum tersedia)</span>';
                        }
                        return namaID + namaEN;
                    }
                },
                { data: 'sks_matakuliah', className: 'text-center' },
                { data: 'smt_matakuliah', className: 'text-center' },
                { data: 'nama_program_studi' }
            ],
            order: [],
            drawCallback: function() {
                updateSyncBadge();
            }
        });
    }

    // ─── Update Badge Count ────────────────────────────────────────────────
    function updateSyncBadge() {
        var count = $('.nama-en-empty').length;
        if (count > 0) {
            $('#count-untranslated').text(count);
            $('#btn-sync-translate').show();
        } else {
            $('#btn-sync-translate').hide();
        }
    }

    // ─── Inline Edit: Click nama EN ───────────────────────────────────────
    $(document).on('click', '.nama-en, .nama-en-empty', function() {
        var $el = $(this);
        var idMk = $el.data('id');
        var currentText = $el.hasClass('nama-en-empty') ? '' : $el.text().trim();
        var $input = $('<input type="text" class="nama-en-input" />')
            .val(currentText)
            .attr('placeholder', 'Masukkan nama Inggris...');

        $el.replaceWith($input);
        $input.focus().select();

        function saveInlineEdit() {
            var newVal = $input.val().trim();
            if (newVal && newVal !== currentText) {
                saveTranslation(idMk, newVal, function(saved) {
                    var $newEl = $('<span class="nama-en" title="Klik untuk edit"></span>')
                        .text(saved)
                        .attr('data-id', idMk);
                    $input.replaceWith($newEl);
                    updateSyncBadge();
                });
            } else if (newVal === '') {
                var $emptyEl = $('<span class="nama-en-empty" title="Klik untuk edit">✎ (belum tersedia)</span>')
                    .attr('data-id', idMk);
                $input.replaceWith($emptyEl);
            } else {
                var $restoredEl = $('<span class="nama-en" title="Klik untuk edit"></span>')
                    .text(currentText)
                    .attr('data-id', idMk);
                $input.replaceWith($restoredEl);
            }
        }

        $input.on('blur', saveInlineEdit);
        $input.on('keydown', function(e) {
            if (e.key === 'Enter') { e.preventDefault(); $input.blur(); }
            if (e.key === 'Escape') {
                var $cancelEl = currentText
                    ? $('<span class="nama-en" title="Klik untuk edit"></span>').text(currentText).attr('data-id', idMk)
                    : $('<span class="nama-en-empty" title="Klik untuk edit">✎ (belum tersedia)</span>').attr('data-id', idMk);
                $input.replaceWith($cancelEl);
            }
        });
    });

    // ─── Save Translation to DB ────────────────────────────────────────────
    function saveTranslation(idMk, namaInggris, callback) {
        $.ajax({
            type: 'POST',
            url: apiUrl + 'akademik/update-translate-matakuliah',
            headers: { "Authorization": 'Bearer ' + token, "username": userlogin },
            data: { id_matakuliah: idMk, nama_matakuliah_inggris: namaInggris },
            success: function(res) {
                if (res.success) {
                    toastr.success('Nama Inggris berhasil disimpan', '', { timeOut: 2000, positionClass: 'toast-bottom-right' });
                    if (typeof callback === 'function') callback(namaInggris);
                }
            },
            error: function() {
                toastr.error('Gagal menyimpan, coba lagi.', '', { timeOut: 3000 });
            }
        });
    }

    // ─── Sync Translate Button ─────────────────────────────────────────────
    $('#btn-sync-translate').on('click', function() {
        if (isSyncing) return;
        isSyncing = true;
        $(this).prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Mentranslasi...');
        $('#sync-progress-text').show();

        var $pending = $('.nama-en-empty').toArray();
        var total = $pending.length;
        var done = 0;

        function processNext() {
            if (done >= total) {
                isSyncing = false;
                $('#btn-sync-translate').prop('disabled', false);
                updateSyncBadge();
                if ($('.nama-en-empty').length === 0) {
                    $('#btn-sync-translate').hide();
                    $('#sync-progress-text').hide();
                    toastr.success('Semua mata kuliah berhasil ditranslasi!', '', { timeOut: 3000 });
                }
                return;
            }

            var $el = $($pending[done]);
            var idMk = $el.data('id');
            var namaSrc = decodeURIComponent($el.data('src') || '');
            done++;
            $('#sync-progress-text').text('(' + done + '/' + total + ') Mentranslasi: ' + namaSrc.substring(0, 40) + '...');

            $.ajax({
                type: 'POST',
                url: apiUrl + 'tools/translate',
                headers: { "Authorization": 'Bearer ' + token, "username": userlogin },
                data: { text: namaSrc },
                success: function(res) {
                    if (res.status === 'success' && res.translated_text) {
                        var translated = res.translated_text;
                        var $newEl = $('<span class="nama-en" title="Klik untuk edit"></span>')
                            .text(translated).attr('data-id', idMk).attr('data-src', $el.attr('data-src'));
                        $el.replaceWith($newEl);
                        saveTranslation(idMk, translated, null);
                    }
                    setTimeout(processNext, 350);
                },
                error: function() {
                    setTimeout(processNext, 350);
                }
            });
        }

        processNext();
    });
});
</script>
@stop
