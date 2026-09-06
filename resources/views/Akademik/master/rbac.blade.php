@extends('layout')

@section('css')
<style>
    .badge-primary-role {
        background: linear-gradient(135deg, #1e88e5 0%, #1565c0 100%);
        color: #fff;
        box-shadow: 0 2px 4px rgba(21, 101, 192, 0.3);
    }
    .badge-unit-prodi {
        background-color: #e8f5e9;
        color: #2e7d32;
        border: 1px solid #a5d6a7;
        font-weight: 600;
    }
    .badge-unit-fakultas {
        background-color: #e3f2fd;
        color: #1565c0;
        border: 1px solid #90caf9;
        font-weight: 600;
    }
    .badge-unit-univ {
        background-color: #f3e5f5;
        color: #7b1fa2;
        border: 1px solid #ce93d8;
        font-weight: 600;
    }
    .badge-status-definitif {
        background-color: #ede7f6;
        color: #512da8;
        font-weight: 600;
    }
    .badge-status-plt {
        background-color: #fff3e0;
        color: #e65100;
        font-weight: 600;
    }
    .badge-status-pj {
        background-color: #e0f7fa;
        color: #00838f;
        font-weight: 600;
    }
    .stat-card {
        border-radius: 8px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }
    .table-rbac td, .table-rbac th {
        vertical-align: middle !important;
    }
    .select2-container {
        width: 100% !important;
    }
</style>
@endsection

@section('content')
<div class="container-full">
    <div class="content-header">
        <div class="d-flex align-items-center justify-content-between">
            <div class="mr-auto">
                <h3 class="page-title"><i class="fa fa-shield text-primary mr-2"></i> Akses Kontrol</h3>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="mdi mdi-home-outline"></i></a></li>
                            <li class="breadcrumb-item" aria-current="page">Master</li>
                            <li class="breadcrumb-item active" aria-current="page">Akses Kontrol</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div>
                <button type="button" class="btn btn-primary btn-rounded shadow-sm px-3 py-2 font-weight-600" id="btn_open_add_modal">
                    <i class="fa fa-plus-circle mr-1"></i> Tambah Penugasan
                </button>
                <button type="button" class="btn btn-secondary btn-rounded shadow-sm px-3 py-2 font-weight-600 ml-2" id="btn_refresh_table">
                    <i class="fa fa-refresh mr-1"></i> Refresh
                </button>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <!-- Summary Counter Cards -->
        <div class="row">
            <div class="col-xl-3 col-md-6 col-12">
                <div class="box box-body stat-card bg-primary-light border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="text-muted font-weight-500 font-size-13 text-uppercase">Total Penugasan</span>
                            <h2 class="font-weight-700 text-primary mb-0 mt-1" id="count_total">0</h2>
                        </div>
                        <div class="font-size-36 text-primary opacity-50">
                            <i class="fa fa-users"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-12">
                <div class="box box-body stat-card bg-success-light border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="text-muted font-weight-500 font-size-13 text-uppercase">Penugasan Aktif</span>
                            <h2 class="font-weight-700 text-success mb-0 mt-1" id="count_active">0</h2>
                        </div>
                        <div class="font-size-36 text-success opacity-50">
                            <i class="fa fa-check-circle"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-12">
                <div class="box box-body stat-card bg-warning-light border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="text-muted font-weight-500 font-size-13 text-uppercase">Peran Utama (Primary)</span>
                            <h2 class="font-weight-700 text-warning mb-0 mt-1" id="count_primary">0</h2>
                        </div>
                        <div class="font-size-36 text-warning opacity-50">
                            <i class="fa fa-star"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-12">
                <div class="box box-body stat-card bg-danger-light border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="text-muted font-weight-500 font-size-13 text-uppercase">Non-Aktif</span>
                            <h2 class="font-weight-700 text-danger mb-0 mt-1" id="count_inactive">0</h2>
                        </div>
                        <div class="font-size-36 text-danger opacity-50">
                            <i class="fa fa-times-circle"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Card & Filter -->
        <div class="box">
            <div class="box-header with-border">
                <h5 class="box-title text-dark"><i class="fa fa-filter text-muted mr-2"></i> Filter & Pencarian Data</h5>
            </div>
            <div class="box-body">
                <div class="row align-items-end mb-3">
                    <div class="col-md-4 col-12 mb-2">
                        <label class="font-weight-600">Filter Jabatan / Peran:</label>
                        <select class="form-control select2" id="filter_role" style="width: 100%;">
                            <option value="">-- Semua Peran / Jabatan --</option>
                        </select>
                    </div>
                    <div class="col-md-3 col-12 mb-2">
                        <label class="font-weight-600">Filter Unit / Prodi:</label>
                        <select class="form-control select2" id="filter_unit" style="width: 100%;">
                            <option value="">-- Semua Unit / Prodi --</option>
                        </select>
                    </div>
                    <div class="col-md-3 col-12 mb-2">
                        <label class="font-weight-600">Filter Status:</label>
                        <select class="form-control" id="filter_status">
                            <option value="">-- Semua Status --</option>
                            <option value="1">Aktif</option>
                            <option value="0">Non-Aktif</option>
                        </select>
                    </div>
                    <div class="col-md-2 col-12 mb-2 text-right">
                        <button type="button" class="btn btn-secondary btn-block" id="btn_reset_filter">
                            <i class="fa fa-undo mr-1"></i> Reset
                        </button>
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="table_rbac" class="table table-hover table-striped table-bordered table-rbac" width="100%">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th style="width: 5%;">No</th>
                                <th style="width: 25%;">Pegawai / Dosen</th>
                                <th style="width: 18%;">Jabatan / Peran</th>
                                <th style="width: 18%;">Tingkat & Unit Kerja</th>
                                <th style="width: 16%;">SK & Masa Tugas</th>
                                <th style="width: 8%;" class="text-center">Status</th>
                                <th style="width: 10%;" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- MODAL ADD RBAC -->
<div class="modal fade" id="modal_add_rbac" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="border-radius: 8px;">
            <div class="modal-header bg-primary text-white">
                <h4 class="modal-title font-weight-600 text-white"><i class="fa fa-user-plus mr-2"></i> Tambah Akses Kontrol</h4>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_add_rbac">
                <div class="modal-body py-4">
                    <div class="form-group">
                        <label class="font-weight-600">Pilih Pegawai / Dosen <span class="text-danger">*</span></label>
                        <select class="form-control" name="id_pegawai" id="add_id_pegawai" required style="width: 100%;">
                            <option value="">-- Cari Nama / NIDN Pegawai --</option>
                        </select>
                        <small class="text-muted">Cari dosen atau staf pegawai yang akan diberikan jabatan/peran.</small>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-600">Peran / Jabatan <span class="text-danger">*</span></label>
                                <select class="form-control" name="role_code" id="add_role_code" required>
                                    <option value="">-- Pilih Peran / Jabatan --</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-600">Status Jabatan <span class="text-danger">*</span></label>
                                <select class="form-control" name="status_jabatan" id="add_status_jabatan" required>
                                    <option value="definitif">Definitif</option>
                                    <option value="plt">Pelaksana Tugas (Plt)</option>
                                    <option value="pj">Penanggung Jawab (Pj)</option>
                                    <option value="interim">Interim</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="unit_type" id="add_unit_type" value="prodi">

                    <div class="form-group" id="group_unit_selector">
                        <label class="font-weight-600" id="label_unit_selector">Unit Kerja / Program Studi <span class="text-danger">*</span></label>
                        <select class="form-control" name="unit_id" id="add_unit_id" required style="width: 100%;">
                            <option value="">-- Pilih Unit / Prodi --</option>
                        </select>
                        <div id="unit_info_static" class="alert alert-info py-2 px-3 mt-1 d-none">
                            <i class="fa fa-info-circle mr-1"></i> Berlaku untuk seluruh lingkup Universitas.
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-600">Tanggal Mulai Berlaku</label>
                                <input type="date" class="form-control" name="tgl_mulai" id="add_tgl_mulai">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-600">Tanggal Selesai (Opsional)</label>
                                <input type="date" class="form-control" name="tgl_selesai" id="add_tgl_selesai">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-600">Nomor Surat Keputusan (SK)</label>
                        <input type="text" class="form-control" name="sk_nomor" id="add_sk_nomor" placeholder="Contoh: 123/SK/REK/2026">
                    </div>

                    <div class="form-group">
                        <label class="font-weight-600">Keterangan Tambahan</label>
                        <textarea class="form-control" name="keterangan" id="add_keterangan" rows="2" placeholder="Catatan penugasan (opsional)..."></textarea>
                    </div>

                    <div class="form-group mb-0">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="is_primary" id="add_is_primary" value="1">
                            <label class="custom-control-label font-weight-600 text-primary" for="add_is_primary">
                                <i class="fa fa-star text-warning mr-1"></i> Jadikan Peran Utama (Primary / Default Role)
                            </label>
                        </div>
                        <small class="text-muted d-block mt-1">Jika dicentang, prodi/jabatan ini akan menjadi konteks aktif bawaan saat pegawai login.</small>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary btn-rounded" data-dismiss="modal">
                        <i class="fa fa-times mr-1"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-primary btn-rounded" id="btn_submit_add">
                        <i class="fa fa-save mr-1"></i> Simpan Penugasan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL EDIT RBAC -->
<div class="modal fade" id="modal_edit_rbac" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="border-radius: 8px;">
            <div class="modal-header bg-info text-white">
                <h4 class="modal-title font-weight-600 text-white"><i class="fa fa-edit mr-2"></i> Edit Akses Kontrol</h4>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_edit_rbac">
                <input type="hidden" name="id" id="edit_id">
                <div class="modal-body py-4">
                    <div class="form-group">
                        <label class="font-weight-600">Pegawai / Dosen <span class="text-danger">*</span></label>
                        <select class="form-control" name="id_pegawai" id="edit_id_pegawai" required style="width: 100%;">
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-600">Peran / Jabatan <span class="text-danger">*</span></label>
                                <select class="form-control" name="role_code" id="edit_role_code" required>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-600">Status Jabatan <span class="text-danger">*</span></label>
                                <select class="form-control" name="status_jabatan" id="edit_status_jabatan" required>
                                    <option value="definitif">Definitif</option>
                                    <option value="plt">Pelaksana Tugas (Plt)</option>
                                    <option value="pj">Penanggung Jawab (Pj)</option>
                                    <option value="interim">Interim</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="unit_type" id="edit_unit_type" value="prodi">

                    <div class="form-group" id="group_edit_unit_selector">
                        <label class="font-weight-600" id="label_edit_unit_selector">Unit Kerja / Program Studi <span class="text-danger">*</span></label>
                        <select class="form-control" name="unit_id" id="edit_unit_id" required style="width: 100%;">
                        </select>
                        <div id="unit_edit_info_static" class="alert alert-info py-2 px-3 mt-1 d-none">
                            <i class="fa fa-info-circle mr-1"></i> Berlaku untuk seluruh lingkup Universitas.
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-600">Tanggal Mulai Berlaku</label>
                                <input type="date" class="form-control" name="tgl_mulai" id="edit_tgl_mulai">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-600">Tanggal Selesai (Opsional)</label>
                                <input type="date" class="form-control" name="tgl_selesai" id="edit_tgl_selesai">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-600">Nomor Surat Keputusan (SK)</label>
                        <input type="text" class="form-control" name="sk_nomor" id="edit_sk_nomor">
                    </div>

                    <div class="form-group">
                        <label class="font-weight-600">Keterangan Tambahan</label>
                        <textarea class="form-control" name="keterangan" id="edit_keterangan" rows="2"></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-0">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="is_primary" id="edit_is_primary" value="1">
                                    <label class="custom-control-label font-weight-600 text-primary" for="edit_is_primary">
                                        <i class="fa fa-star text-warning mr-1"></i> Peran Utama (Primary)
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-0">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="is_active" id="edit_is_active" value="1">
                                    <label class="custom-control-label font-weight-600 text-success" for="edit_is_active">
                                        <i class="fa fa-check-circle mr-1"></i> Status Aktif
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary btn-rounded" data-dismiss="modal">
                        <i class="fa fa-times mr-1"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-info btn-rounded" id="btn_submit_edit">
                        <i class="fa fa-save mr-1"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script-master')
<script type="text/javascript">
    $(document).ready(function() {
        var token = "{{ Session::get('token') }}";
        var userlogin = "{{ Session::get('username') }}";
        var baseUrl = "{{ config('setting.second_url') }}";

        var masterRoles = [];
        var prodiList = [];
        var fakultasList = [];
        var rbacTable;

        // Init Select2 on filter
        $('#filter_role, #filter_unit').select2();

        // 1. Load Master Roles & Units for Dropdowns
        function loadMetadata() {
            // Master Roles
            $.ajax({
                url: baseUrl + "akademik/rbac/master-roles",
                type: "GET",
                headers: { "Authorization": "Bearer " + token, "username": userlogin },
                success: function(res) {
                    if (res.status && res.data) {
                        masterRoles = res.data;
                        var filterRoleHtml = '<option value="">-- Semua Peran / Jabatan --</option>';
                        var addRoleHtml = '<option value="">-- Pilih Peran / Jabatan --</option>';

                        masterRoles.forEach(function(r) {
                            var levelText = r.level_hierarki == 1 ? 'Univ' : (r.level_hierarki == 2 ? 'Fakultas' : 'Prodi');
                            var opt = '<option value="' + r.role_code + '" data-hierarki="' + r.level_hierarki + '">' + r.role_name + ' (' + levelText + ')</option>';
                            filterRoleHtml += opt;
                            addRoleHtml += opt;
                        });

                        $('#filter_role').html(filterRoleHtml);
                        $('#add_role_code').html(addRoleHtml);
                        $('#edit_role_code').html(addRoleHtml);
                    }
                }
            });

            // Units (Prodi & Fakultas)
            $.ajax({
                url: baseUrl + "akademik/rbac/unit-options",
                type: "GET",
                headers: { "Authorization": "Bearer " + token, "username": userlogin },
                success: function(res) {
                    if (res.status) {
                        prodiList = res.prodi || [];
                        fakultasList = res.fakultas || [];

                        var filterUnitHtml = '<option value="">-- Semua Unit / Prodi --</option>';
                        filterUnitHtml += '<optgroup label="Program Studi">';
                        prodiList.forEach(function(p) {
                            filterUnitHtml += '<option value="' + p.kode_program_studi + '">' + p.nama_program_studi + ' (' + p.kode_program_studi + ')</option>';
                        });
                        filterUnitHtml += '</optgroup><optgroup label="Fakultas">';
                        fakultasList.forEach(function(f) {
                            filterUnitHtml += '<option value="' + f.kode_fakultas + '">' + f.nama_fakultas + '</option>';
                        });
                        filterUnitHtml += '</optgroup>';

                        $('#filter_unit').html(filterUnitHtml);
                    }
                }
            });
        }
        loadMetadata();

        // 2. Select2 Pegawai Setup
        function initPegawaiSelect2(elementSelector, parentModalSelector) {
            $(elementSelector).select2({
                dropdownParent: $(parentModalSelector),
                placeholder: "-- Ketik Nama atau NIDN Pegawai --",
                allowClear: true,
                minimumInputLength: 2,
                ajax: {
                    url: baseUrl + "akademik/rbac/pegawai-options",
                    type: "GET",
                    headers: { "Authorization": "Bearer " + token, "username": userlogin },
                    delay: 250,
                    data: function(params) {
                        return { q: params.term };
                    },
                    processResults: function(response) {
                        return {
                            results: $.map(response.data, function(item) {
                                var prodiBadge = item.kode_prodi ? ' [' + item.kode_prodi + ']' : '';
                                return {
                                    id: item.id,
                                    text: item.nama + ' (NIDN: ' + (item.nidn || '-') + ')' + prodiBadge
                                };
                            })
                        };
                    },
                    cache: true
                }
            });
        }
        initPegawaiSelect2('#add_id_pegawai', '#modal_add_rbac');
        initPegawaiSelect2('#edit_id_pegawai', '#modal_edit_rbac');

        // Dynamic Unit Selector based on selected Role Hierarki
        function updateUnitOptions(roleSelectEl, unitSelectEl, unitTypeEl, labelEl, staticInfoEl) {
            var selectedCode = $(roleSelectEl).val();
            var roleObj = masterRoles.find(function(r) { return r.role_code === selectedCode; });

            if (!roleObj) {
                $(unitSelectEl).html('<option value="">-- Pilih Unit / Prodi --</option>').val('').trigger('change');
                return;
            }

            var hierarki = parseInt(roleObj.level_hierarki);
            var html = '';

            if (hierarki === 1) {
                // Universitas
                $(unitTypeEl).val('universitas');
                $(labelEl).html('Unit Kerja <span class="text-danger">*</span>');
                $(unitSelectEl).html('<option value="UNIV" selected>Tingkat Universitas</option>').addClass('d-none');
                $(staticInfoEl).removeClass('d-none');
            } else if (hierarki === 2) {
                // Fakultas
                $(unitTypeEl).val('fakultas');
                $(labelEl).html('Pilih Fakultas <span class="text-danger">*</span>');
                $(unitSelectEl).removeClass('d-none');
                $(staticInfoEl).addClass('d-none');
                html = '<option value="">-- Pilih Fakultas --</option>';
                fakultasList.forEach(function(f) {
                    html += '<option value="' + f.kode_fakultas + '">' + f.nama_fakultas + '</option>';
                });
                $(unitSelectEl).html(html);
            } else {
                // Prodi
                $(unitTypeEl).val('prodi');
                $(labelEl).html('Pilih Program Studi <span class="text-danger">*</span>');
                $(unitSelectEl).removeClass('d-none');
                $(staticInfoEl).addClass('d-none');
                html = '<option value="">-- Pilih Program Studi --</option>';
                prodiList.forEach(function(p) {
                    html += '<option value="' + p.kode_program_studi + '">' + p.nama_program_studi + ' (' + p.kode_program_studi + ')</option>';
                });
                $(unitSelectEl).html(html);
            }
        }

        $('#add_role_code').on('change', function() {
            updateUnitOptions('#add_role_code', '#add_unit_id', '#add_unit_type', '#label_unit_selector', '#unit_info_static');
        });

        $('#edit_role_code').on('change', function() {
            updateUnitOptions('#edit_role_code', '#edit_unit_id', '#edit_unit_type', '#label_edit_unit_selector', '#unit_edit_info_static');
        });

        // 3. DataTable RBAC Initialization
        rbacTable = $("#table_rbac").DataTable({
            processing: true,
            lengthChange: true,
            searching: true,
            ordering: true,
            ajax: {
                type: "GET",
                url: baseUrl + "akademik/rbac",
                headers: {
                    "Authorization": "Bearer " + token,
                    "username": userlogin
                },
                data: function(d) {
                    d.role_code = $('#filter_role').val();
                    d.unit_id = $('#filter_unit').val();
                    d.is_active = $('#filter_status').val();
                },
                dataSrc: function(json) {
                    var items = json.data || [];
                    // Update counters
                    var total = items.length;
                    var active = items.filter(function(i) { return i.is_active == 1; }).length;
                    var primary = items.filter(function(i) { return i.is_primary == 1; }).length;
                    var inactive = total - active;

                    $('#count_total').text(total);
                    $('#count_active').text(active);
                    $('#count_primary').text(primary);
                    $('#count_inactive').text(inactive);

                    return items;
                }
            },
            columns: [
                {
                    data: null,
                    className: "text-center font-weight-600",
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: "nama_pegawai",
                    render: function(data, type, row) {
                        var nidnText = row.nidn ? row.nidn : '-';
                        var homebaseText = row.prodi_homebase ? '<span class="badge badge-secondary ml-1" title="Homebase">' + row.prodi_homebase + '</span>' : '';
                        return '<div class="font-weight-600 text-dark">' + (data || '-') + homebaseText + '</div>' +
                               '<small class="text-muted"><i class="fa fa-id-card-o mr-1"></i> NIDN: ' + nidnText + '</small>';
                    }
                },
                {
                    data: "role_name",
                    render: function(data, type, row) {
                        var statusBadge = '';
                        if (row.status_jabatan === 'definitif') {
                            statusBadge = '<span class="badge badge-status-definitif">Definitif</span>';
                        } else if (row.status_jabatan === 'plt') {
                            statusBadge = '<span class="badge badge-status-plt">Plt</span>';
                        } else if (row.status_jabatan === 'pj') {
                            statusBadge = '<span class="badge badge-status-pj">Pj</span>';
                        } else {
                            statusBadge = '<span class="badge badge-secondary">' + (row.status_jabatan || '-') + '</span>';
                        }

                        var primaryBadge = row.is_primary == 1 
                            ? '<span class="badge badge-primary-role ml-1" title="Peran Utama"><i class="fa fa-star text-warning"></i> Utama</span>' 
                            : '';

                        return '<div class="font-weight-600">' + (data || row.role_code) + primaryBadge + '</div>' +
                               '<div class="mt-1">' + statusBadge + '</div>';
                    }
                },
                {
                    data: "nama_unit",
                    render: function(data, type, row) {
                        var unitBadgeClass = 'badge-unit-univ';
                        var unitIcon = 'fa-university';
                        var unitLabel = 'Universitas';

                        if (row.unit_type === 'prodi') {
                            unitBadgeClass = 'badge-unit-prodi';
                            unitIcon = 'fa-graduation-cap';
                            unitLabel = 'Program Studi';
                        } else if (row.unit_type === 'fakultas') {
                            unitBadgeClass = 'badge-unit-fakultas';
                            unitIcon = 'fa-building-o';
                            unitLabel = 'Fakultas';
                        }

                        return '<div><span class="badge ' + unitBadgeClass + ' py-1 px-2"><i class="fa ' + unitIcon + ' mr-1"></i> ' + (data || row.unit_id) + '</span></div>' +
                               '<small class="text-muted font-italic">' + unitLabel + ' (' + row.unit_id + ')</small>';
                    }
                },
                {
                    data: "sk_nomor",
                    render: function(data, type, row) {
                        var sk = data ? '<div class="font-weight-600 text-dark"><i class="fa fa-file-text-o text-muted mr-1"></i> ' + data + '</div>' : '<span class="text-muted">-</span>';
                        var periode = '';
                        if (row.tgl_mulai) {
                            periode = '<small class="text-muted d-block">' + row.tgl_mulai + ' s/d ' + (row.tgl_selesai || 'Sekarang') + '</small>';
                        }
                        return sk + periode;
                    }
                },
                {
                    data: "is_active",
                    className: "text-center",
                    render: function(data) {
                        if (data == 1) {
                            return '<span class="badge badge-success py-1 px-2 font-weight-600"><i class="fa fa-check-circle mr-1"></i> Aktif</span>';
                        } else {
                            return '<span class="badge badge-danger py-1 px-2 font-weight-600"><i class="fa fa-times-circle mr-1"></i> Non-Aktif</span>';
                        }
                    }
                },
                {
                    data: null,
                    className: "text-center text-nowrap",
                    orderable: false,
                    render: function(data, type, row) {
                        var toggleIcon = row.is_active == 1 ? 'fa-toggle-on text-success' : 'fa-toggle-off text-muted';
                        var toggleTitle = row.is_active == 1 ? 'Nonaktifkan' : 'Aktifkan';

                        return '<button type="button" class="btn btn-sm btn-outline-info btn-edit-rbac mr-1" data-id="' + row.id + '" title="Edit Penugasan"><i class="fa fa-pencil"></i></button>' +
                               '<button type="button" class="btn btn-sm btn-outline-secondary btn-toggle-rbac mr-1" data-id="' + row.id + '" title="' + toggleTitle + '"><i class="fa ' + toggleIcon + '"></i></button>' +
                               '<button type="button" class="btn btn-sm btn-outline-danger btn-delete-rbac" data-id="' + row.id + '" data-nama="' + (row.nama_pegawai || '') + '" title="Hapus Penugasan"><i class="fa fa-trash"></i></button>';
                    }
                }
            ],
            order: [[1, "asc"]]
        });

        // Filter triggers
        $('#filter_role, #filter_unit, #filter_status').on('change', function() {
            rbacTable.ajax.reload();
        });

        $('#btn_reset_filter').on('click', function() {
            $('#filter_role').val('').trigger('change.select2');
            $('#filter_unit').val('').trigger('change.select2');
            $('#filter_status').val('');
            rbacTable.ajax.reload();
        });

        $('#btn_refresh_table').on('click', function() {
            rbacTable.ajax.reload();
        });

        // 4. Open Modal Add
        $('#btn_open_add_modal').on('click', function() {
            $('#form_add_rbac')[0].reset();
            $('#add_id_pegawai').val(null).trigger('change');
            $('#add_role_code').val('').trigger('change');
            $('#modal_add_rbac').modal('show');
        });

        // 5. Submit Add
        $('#form_add_rbac').on('submit', function(e) {
            e.preventDefault();
            var submitBtn = $('#btn_submit_add');
            submitBtn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin mr-1"></i> Menyimpan...');

            var payload = {
                id_pegawai: $('#add_id_pegawai').val(),
                role_code: $('#add_role_code').val(),
                unit_type: $('#add_unit_type').val(),
                unit_id: $('#add_unit_id').val(),
                status_jabatan: $('#add_status_jabatan').val(),
                is_primary: $('#add_is_primary').is(':checked') ? 1 : 0,
                tgl_mulai: $('#add_tgl_mulai').val() || null,
                tgl_selesai: $('#add_tgl_selesai').val() || null,
                sk_nomor: $('#add_sk_nomor').val() || null,
                keterangan: $('#add_keterangan').val() || null
            };

            $.ajax({
                url: baseUrl + "akademik/rbac",
                type: "POST",
                headers: {
                    "Authorization": "Bearer " + token,
                    "username": userlogin
                },
                data: payload,
                dataType: "json",
                success: function(res) {
                    submitBtn.prop('disabled', false).html('<i class="fa fa-save mr-1"></i> Simpan Penugasan');
                    if (res.status) {
                        $('#modal_add_rbac').modal('hide');
                        showToastr('success', 'Berhasil!', res.message || 'Penugasan berhasil disimpan.');
                        rbacTable.ajax.reload();
                    } else {
                        swal("Peringatan!", res.message || 'Gagal menyimpan penugasan.', "warning");
                    }
                },
                error: function(xhr) {
                    submitBtn.prop('disabled', false).html('<i class="fa fa-save mr-1"></i> Simpan Penugasan');
                    var errMsg = 'Terjadi kesalahan pada server.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errMsg = xhr.responseJSON.message;
                    }
                    swal("Gagal!", errMsg, "error");
                }
            });
        });

        // 6. Open Modal Edit
        $('#table_rbac').on('click', '.btn-edit-rbac', function() {
            var id = $(this).data('id');
            var tr = $(this).closest('tr');
            var rowData = rbacTable.row(tr).data();

            if (!rowData) return;

            $('#edit_id').val(rowData.id);
            
            // Set Pegawai option in Select2
            var option = new Option(rowData.nama_pegawai + ' (NIDN: ' + (rowData.nidn || '-') + ')', rowData.id_pegawai, true, true);
            $('#edit_id_pegawai').empty().append(option).trigger('change');

            $('#edit_role_code').val(rowData.role_code);
            $('#edit_status_jabatan').val(rowData.status_jabatan || 'definitif');
            
            // Trigger unit options update for role
            updateUnitOptions('#edit_role_code', '#edit_unit_id', '#edit_unit_type', '#label_edit_unit_selector', '#unit_edit_info_static');
            $('#edit_unit_id').val(rowData.unit_id);

            $('#edit_tgl_mulai').val(rowData.tgl_mulai || '');
            $('#edit_tgl_selesai').val(rowData.tgl_selesai || '');
            $('#edit_sk_nomor').val(rowData.sk_nomor || '');
            $('#edit_keterangan').val(rowData.keterangan || '');
            $('#edit_is_primary').prop('checked', rowData.is_primary == 1);
            $('#edit_is_active').prop('checked', rowData.is_active == 1);

            $('#modal_edit_rbac').modal('show');
        });

        // 7. Submit Edit
        $('#form_edit_rbac').on('submit', function(e) {
            e.preventDefault();
            var id = $('#edit_id').val();
            var submitBtn = $('#btn_submit_edit');
            submitBtn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin mr-1"></i> Menyimpan...');

            var payload = {
                id_pegawai: $('#edit_id_pegawai').val(),
                role_code: $('#edit_role_code').val(),
                unit_type: $('#edit_unit_type').val(),
                unit_id: $('#edit_unit_id').val(),
                status_jabatan: $('#edit_status_jabatan').val(),
                is_primary: $('#edit_is_primary').is(':checked') ? 1 : 0,
                is_active: $('#edit_is_active').is(':checked') ? 1 : 0,
                tgl_mulai: $('#edit_tgl_mulai').val() || null,
                tgl_selesai: $('#edit_tgl_selesai').val() || null,
                sk_nomor: $('#edit_sk_nomor').val() || null,
                keterangan: $('#edit_keterangan').val() || null
            };

            $.ajax({
                url: baseUrl + "akademik/rbac/" + id,
                type: "PUT",
                headers: {
                    "Authorization": "Bearer " + token,
                    "username": userlogin
                },
                data: payload,
                dataType: "json",
                success: function(res) {
                    submitBtn.prop('disabled', false).html('<i class="fa fa-save mr-1"></i> Simpan Perubahan');
                    if (res.status) {
                        $('#modal_edit_rbac').modal('hide');
                        showToastr('success', 'Berhasil!', res.message || 'Perubahan penugasan berhasil disimpan.');
                        rbacTable.ajax.reload();
                    } else {
                        swal("Peringatan!", res.message || 'Gagal mengubah penugasan.', "warning");
                    }
                },
                error: function(xhr) {
                    submitBtn.prop('disabled', false).html('<i class="fa fa-save mr-1"></i> Simpan Perubahan');
                    var errMsg = 'Terjadi kesalahan pada server.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errMsg = xhr.responseJSON.message;
                    }
                    swal("Gagal!", errMsg, "error");
                }
            });
        });

        // 8. Toggle Active Status
        $('#table_rbac').on('click', '.btn-toggle-rbac', function() {
            var id = $(this).data('id');
            $.ajax({
                url: baseUrl + "akademik/rbac/" + id + "/toggle",
                type: "POST",
                headers: {
                    "Authorization": "Bearer " + token,
                    "username": userlogin
                },
                dataType: "json",
                success: function(res) {
                    if (res.status) {
                        showToastr('success', 'Status Berubah!', res.message);
                        rbacTable.ajax.reload();
                    } else {
                        swal("Gagal!", res.message || 'Gagal mengubah status.', "error");
                    }
                },
                error: function(xhr) {
                    swal("Gagal!", "Terjadi kesalahan pada server saat mengubah status.", "error");
                }
            });
        });

        // 9. Delete RBAC Assignment
        $('#table_rbac').on('click', '.btn-delete-rbac', function() {
            var id = $(this).data('id');
            var nama = $(this).data('nama');

            swal({
                title: "Konfirmasi Hapus?",
                text: "Apakah Anda yakin ingin menghapus penugasan untuk " + nama + "?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Ya, Hapus!",
                cancelButtonText: "Batal",
                closeOnConfirm: true
            }, function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: baseUrl + "akademik/rbac/" + id,
                        type: "DELETE",
                        headers: {
                            "Authorization": "Bearer " + token,
                            "username": userlogin
                        },
                        dataType: "json",
                        success: function(res) {
                            if (res.status) {
                                showToastr('success', 'Dihapus!', res.message || 'Penugasan berhasil dihapus.');
                                rbacTable.ajax.reload();
                            } else {
                                swal("Gagal!", res.message || 'Gagal menghapus penugasan.', "error");
                            }
                        },
                        error: function(xhr) {
                            swal("Gagal!", "Terjadi kesalahan saat menghapus data.", "error");
                        }
                    });
                }
            });
        });

    });
</script>
@endsection
