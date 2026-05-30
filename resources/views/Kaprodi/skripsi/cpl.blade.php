@extends('layout')
@section('content')
<div class="container-full">
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title">Master Data Capaian Pembelajaran Lulusan (CPL)</h3>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                            <li class="breadcrumb-item" aria-current="page">Kaprodi</li>
                            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('kpskripsi_index') }}">Skripsi</a></li>
                            <li class="breadcrumb-item active" aria-current="page">CPL</li>
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
                                <h4 class="box-title text-dark">Daftar Capaian Pembelajaran Lulusan (CPL) Program Studi</h4>
                                <p class="mb-0 text-muted small mt-5">Kelola daftar kompetensi lulusan (CPL) yang nantinya digunakan untuk memetakan instrumen rubrik CPMK Skripsi.</p>
                            </div>
                            <div class="box-controls">
                                <button type="button" class="btn btn-sm btn-success mr-5 font-weight-600" onclick="openAddModal()">
                                    <i class="fa fa-plus-circle mr-5"></i> Tambah CPL
                                </button>
                                <a href="{{ route('kpskripsi_index') }}" class="btn btn-sm btn-secondary font-weight-600">
                                    <i class="fa fa-arrow-left mr-5"></i> Kembali
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="box-body">
                        <!-- Filters Panel -->
                        <div class="row mb-20 bg-lighter p-15 border-1" style="border-radius: 8px; margin: 0 1px 20px 1px;">
                            <div class="col-md-3">
                                <div class="form-group mb-0">
                                    <label class="font-weight-600 text-dark small">Filter Kurikulum</label>
                                    <select id="filter-kurikulum" class="form-control select2-filter" style="width: 100%;">
                                        <option value="">Semua Kurikulum</option>
                                        <option value="2026">Kurikulum 2026</option>
                                        <option value="2025">Kurikulum 2025</option>
                                        <option value="2024" selected>Kurikulum 2024</option>
                                        <option value="2023">Kurikulum 2023</option>
                                        <option value="2022">Kurikulum 2022</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Data Table -->
                        <div class="table-responsive">
                            <table id="table_cpl_master" class="table table-hover table-bordered table-striped" style="width: 100%;">
                                <thead class="bg-dark text-white">
                                    <tr>
                                        <th style="width: 5%; text-align: center;">No</th>
                                        <th style="width: 12%;">Kode Kategori</th>
                                        <th style="width: 10%;">Kode CPL</th>
                                        <th style="width: 32%;">Deskripsi CPL</th>
                                        <th style="width: 8%; text-align: center;">Kurikulum</th>
                                        <th style="width: 10%;">Level</th>
                                        <th style="width: 13%;">Lembaga Pemilik</th>
                                        <th style="width: 5%; text-align: center;">Aktif</th>
                                        <th style="width: 5%; text-align: center;">CPMK</th>
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

<!-- Modal Tambah / Ubah CPL -->
<div class="modal fade" id="modal-cpl-form" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="border-radius: 12px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.15);">
            <div class="modal-header bg-primary py-15">
                <h5 class="modal-title text-white font-weight-600" id="modal-title-cpl">Tambah Capaian Pembelajaran Lulusan (CPL)</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_cpl_crud">
                <div class="modal-body py-20 px-25">
                    <input type="hidden" name="id" id="cpl_id">
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-600 text-dark">Kode CPL <span class="text-danger">*</span></label>
                                <input type="text" name="kode_cpl" id="cpl_kode" class="form-control text-uppercase" placeholder="Contoh: S1, P3, KU2" required>
                                <small class="text-muted">Kode unik identifikasi CPL.</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-600 text-dark">Kode Kategori <span class="text-danger">*</span></label>
                                <input type="text" name="kode_kategori" id="cpl_kategori" class="form-control" placeholder="Contoh: Sikap 1, Pengetahuan, Keterampilan" required>
                                <small class="text-muted">Kategori atau kelompok CPL.</small>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mt-10">
                        <label class="font-weight-600 text-dark">Deskripsi Capaian Pembelajaran Lulusan (CPL) <span class="text-danger">*</span></label>
                        <textarea name="deskripsi" id="cpl_deskripsi" class="form-control" rows="4" placeholder="Tuliskan rumusan/pernyataan CPL secara lengkap..." required></textarea>
                    </div>

                    <div class="row mt-10">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="font-weight-600 text-dark">Tahun Kurikulum <span class="text-danger">*</span></label>
                                <input type="number" name="tahun_kurikulum" id="cpl_tahun" class="form-control" min="2000" max="2100" value="{{ $session_tahun ?? 2024 }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="font-weight-600 text-dark">Level <span class="text-danger">*</span></label>
                                <select name="level" id="cpl_level" class="form-control" required>
                                    <option value="Program Studi" selected>Program Studi</option>
                                    <option value="Fakultas">Fakultas</option>
                                    <option value="Universitas">Universitas</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="font-weight-600 text-dark">Status Aktif <span class="text-danger">*</span></label>
                                <div class="mt-8">
                                    <label class="switch switch-border switch-primary">
                                        <input type="checkbox" name="is_aktif" id="cpl_status" value="1" checked>
                                        <span class="switch-indicator"></span>
                                        <span class="switch-description font-weight-600 text-dark small ml-5">Aktif</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light py-15 text-right">
                    <button type="button" class="btn btn-secondary px-20 font-weight-600" data-dismiss="modal">Batal</button>
                    <button type="submit" id="btn-save-submit" class="btn btn-primary px-35 font-weight-600">Simpan Data</button>
                </div>
            </form>
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
    .bg-lighter {
        background-color: #f8f9fa !important;
    }
    .border-1 {
        border: 1px solid #dee2e6 !important;
    }
    #table_cpl_master td {
        vertical-align: middle !important;
    }
    
    /* Toggle switch styling override for premium feel */
    .switch {
        position: relative;
        display: inline-flex;
        align-items: center;
        cursor: pointer;
        user-select: none;
    }
    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }
    .switch-indicator {
        position: relative;
        display: inline-block;
        width: 46px;
        height: 24px;
        background-color: #dee2e6;
        border-radius: 12px;
        transition: background-color 0.25s ease;
    }
    .switch-indicator:before {
        position: absolute;
        content: "";
        height: 18px;
        width: 18px;
        left: 3px;
        bottom: 3px;
        background-color: white;
        border-radius: 50%;
        transition: transform 0.25s ease, background-color 0.25s ease;
        box-shadow: 0 2px 4px rgba(0,0,0,0.15);
    }
    .switch input:checked + .switch-indicator {
        background-color: #389f99; /* Primary teal color of template */
    }
    .switch input:checked + .switch-indicator:before {
        transform: translateX(22px);
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

    let tableCpl;

    $(document).ready(function () {
        // Initialize Select2 filter
        $('#filter-kurikulum').select2({
            minimumResultsForSearch: -1
        });

        // 1. Initialize Datatable
        initDataTable();

        // 2. Filter Event Trigger
        $('#filter-kurikulum').on('change', function() {
            tableCpl.ajax.reload();
        });

        // 3. Form Submit Handler (CRUD)
        $('#form_cpl_crud').on('submit', function(e) {
            e.preventDefault();
            
            let btn = $('#btn-save-submit');
            let oldHtml = btn.html();
            btn.attr('disabled', 'disabled').html('<i class="fa fa-spinner fa-spin mr-5"></i> Menyimpan...');

            let formData = {
                id: $('#cpl_id').val(),
                kode_prodi: CONFIG.kode_prodi,
                kode_cpl: $('#cpl_kode').val(),
                kode_kategori: $('#cpl_kategori').val(),
                deskripsi: $('#cpl_deskripsi').val(),
                tahun_kurikulum: $('#cpl_tahun').val(),
                level: $('#cpl_level').val(),
                is_aktif: $('#cpl_status').is(':checked') ? 1 : 0
            };

            $.ajax({
                url: CONFIG.api_url + "kaprodi/skripsi/save-cpl",
                type: "POST",
                headers: {
                    "Authorization": "Bearer " + CONFIG.token,
                    "username": CONFIG.username
                },
                data: formData,
                success: function(res) {
                    btn.removeAttr('disabled').html(oldHtml);
                    if (res.status === 'success') {
                        swal("Berhasil!", res.message, "success");
                        $('#modal-cpl-form').modal('hide');
                        tableCpl.ajax.reload();
                    } else {
                        swal("Gagal!", "Gagal menyimpan data CPL.", "error");
                    }
                },
                error: function(err) {
                    btn.removeAttr('disabled').html(oldHtml);
                    let errMsg = "Terjadi kesalahan saat menyimpan data.";
                    if (err.responseJSON && err.responseJSON.error) {
                        errMsg = Array.isArray(err.responseJSON.error) ? err.responseJSON.error.join("\n") : err.responseJSON.error;
                    }
                    swal("Gagal!", errMsg, "error");
                }
            });
        });
    });

    function initDataTable() {
        tableCpl = $('#table_cpl_master').DataTable({
            processing: true,
            serverSide: false, // We're handling list locally via AJAX return
            ajax: {
                url: CONFIG.api_url + "kaprodi/skripsi/get-cpl/" + CONFIG.kode_prodi,
                type: "GET",
                headers: {
                    "Authorization": "Bearer " + CONFIG.token,
                    "username": CONFIG.username
                },
                data: function(d) {
                    d.tahun = $('#filter-kurikulum').val();
                },
                dataSrc: "data"
            },
            columns: [
                { 
                    data: null, 
                    className: "text-center font-weight-600",
                    render: (data, type, row, meta) => meta.row + 1 
                },
                { data: 'kode_kategori', className: "font-weight-600" },
                { 
                    data: 'kode_cpl', 
                    className: "font-weight-700 text-uppercase",
                    render: (val) => `<span class="badge badge-primary-light">${val}</span>`
                },
                { 
                    data: 'deskripsi',
                    render: function(val) {
                        return `<div style="white-space: normal; word-break: break-word; font-size:13px; line-height: 1.4;">${val}</div>`;
                    }
                },
                { data: 'tahun_kurikulum', className: "text-center font-weight-600" },
                { data: 'level' },
                { 
                    data: 'lembaga_pemilik',
                    render: function(val, type, row) {
                        if (row.level === 'Program Studi') {
                            return `<span class="text-dark small"><i class="fa fa-university mr-5 text-primary"></i> ${val}</span>`;
                        } else {
                            return `<span class="text-muted small"><i class="fa fa-globe mr-5"></i> ${val}</span>`;
                        }
                    }
                },
                { 
                    data: 'is_aktif', 
                    className: "text-center",
                    render: function(val, type, row) {
                        let checked = val ? 'checked' : '';
                        return `
                            <label class="switch switch-border switch-primary mb-0">
                                <input type="checkbox" class="toggle-status-switch" data-id="${row.id}" ${checked}>
                                <span class="switch-indicator" style="width:36px; height:20px; border-radius:10px;"></span>
                            </label>
                        `;
                    }
                },
                { 
                    data: 'jumlah_cpmk', 
                    className: "text-center font-weight-700 text-info"
                },
                {
                    data: null,
                    className: "text-center",
                    orderable: false,
                    render: function(data) {
                        return `
                            <button class="btn btn-xs btn-warning text-white mr-5" onclick="openEditModal(${JSON.stringify(data).replace(/"/g, '&quot;')})" title="Ubah CPL">
                                <i class="fa fa-pencil"></i> Ubah
                            </button>
                            <button class="btn btn-xs btn-danger" onclick="deleteCpl(${data.id}, '${data.kode_cpl}')" title="Hapus CPL">
                                <i class="fa fa-trash"></i> Hapus
                            </button>
                        `;
                    }
                }
            ],
            drawCallback: function() {
                // Bind toggle switch event
                $('.toggle-status-switch').off('change').on('change', function() {
                    let id = $(this).data('id');
                    let status = $(this).is(':checked');
                    toggleStatus(id, $(this));
                });
            }
        });
    }

    function openAddModal() {
        $('#form_cpl_crud')[0].reset();
        $('#cpl_id').val('');
        $('#modal-title-cpl').text('Tambah Capaian Pembelajaran Lulusan (CPL)');
        $('#cpl_kode').removeAttr('readonly');
        $('#cpl_tahun').removeAttr('readonly');
        $('#cpl_status').prop('checked', true);
        $('#modal-cpl-form').modal('show');
    }

    function openEditModal(data) {
        $('#form_cpl_crud')[0].reset();
        $('#cpl_id').val(data.id);
        $('#cpl_kode').val(data.kode_cpl);
        $('#cpl_kategori').val(data.kode_kategori);
        $('#cpl_deskripsi').val(data.deskripsi);
        $('#cpl_tahun').val(data.tahun_kurikulum);
        $('#cpl_level').val(data.level);
        $('#cpl_status').prop('checked', parseInt(data.is_aktif) === 1);
        
        $('#modal-title-cpl').text('Ubah Capaian Pembelajaran Lulusan (CPL)');
        // Disable editing key fields on update if they are bound to CPMKs
        if (parseInt(data.jumlah_cpmk) > 0) {
            $('#cpl_kode').attr('readonly', 'readonly');
            $('#cpl_tahun').attr('readonly', 'readonly');
        } else {
            $('#cpl_kode').removeAttr('readonly');
            $('#cpl_tahun').removeAttr('readonly');
        }
        
        $('#modal-cpl-form').modal('show');
    }

    function toggleStatus(id, switchEl) {
        $.ajax({
            url: CONFIG.api_url + "kaprodi/skripsi/toggle-cpl/" + id,
            type: "POST",
            headers: {
                "Authorization": "Bearer " + CONFIG.token,
                "username": CONFIG.username
            },
            success: function(res) {
                if (res.status === 'success') {
                    $.toast({
                        heading: 'Berhasil',
                        text: res.message,
                        position: 'top-right',
                        loaderBg: '#ff6849',
                        icon: 'success',
                        hideAfter: 3000,
                        stack: 6
                    });
                } else {
                    swal("Gagal!", "Gagal mengubah status aktif.", "error");
                    switchEl.prop('checked', !switchEl.is(':checked'));
                }
            },
            error: function() {
                swal("Gagal!", "Terjadi kesalahan server.", "error");
                switchEl.prop('checked', !switchEl.is(':checked'));
            }
        });
    }

    function deleteCpl(id, code) {
        swal({
            title: "Hapus CPL?",
            text: "Apakah Anda yakin ingin menghapus CPL " + code + "? Tindakan ini tidak dapat dibatalkan.",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Batal"
        }, function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: CONFIG.api_url + "kaprodi/skripsi/delete-cpl/" + id,
                    type: "POST", // mapped as POST on backend for compatibility
                    headers: {
                        "Authorization": "Bearer " + CONFIG.token,
                        "username": CONFIG.username
                    },
                    success: function(res) {
                        if (res.status === 'success') {
                            swal("Terhapus!", res.message, "success");
                            tableCpl.ajax.reload();
                        } else {
                            swal("Gagal!", res.error || "Gagal menghapus CPL.", "error");
                        }
                    },
                    error: function(err) {
                        let errMsg = "Gagal menghapus CPL.";
                        if (err.responseJSON && err.responseJSON.error) {
                            errMsg = err.responseJSON.error;
                        }
                        swal("Gagal!", errMsg, "error");
                    }
                });
            }
        });
    }
</script>
@endsection
