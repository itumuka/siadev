@extends('layout')
@section('content')
<div class="container-full">
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title">Konfigurasi Rubrik CPMK Program Studi</h3>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                            <li class="breadcrumb-item" aria-current="page">Kaprodi</li>
                            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('kpskripsi_index') }}">Skripsi</a></li>
                            <li class="breadcrumb-item active" aria-current="page">CPMK</li>
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
                <div class="box">
                    <div class="box-header with-border bg-primary-light">
                        <h4 class="box-title text-dark">Daftar Rubrik Capaian Pembelajaran Mata Kuliah (CPMK)</h4>
                        <div class="box-controls pull-right">
                            <button id="btn-add-cpmk" class="btn btn-sm btn-success mr-5">
                                <i class="fa fa-plus mr-5"></i> Tambah CPMK
                            </button>
                            <button id="btn-reset-cpmk" class="btn btn-sm btn-danger mr-5">
                                <i class="fa fa-refresh mr-5"></i> Reset ke Default
                            </button>
                            <a href="{{ route('kpskripsi_index') }}" class="btn btn-sm btn-secondary">
                                <i class="fa fa-arrow-left mr-5"></i> Kembali
                            </a>
                        </div>
                        <p class="mb-0 text-muted">Sesuaikan instrumen rubrik penilaian berbasis Outcome-Based Education (OBE) untuk Ujian Skripsi / Sidang Akhir di program studi Anda.</p>
                    </div>
                    
                    <div class="box-body">
                        <!-- Live Accumulator Bar -->
                        <div class="row mb-20">
                            <div class="col-12">
                                <div class="card bg-lighter no-shadow border-1" style="border-radius: 8px;">
                                    <div class="card-body py-15 px-20">
                                        <div class="d-flex justify-content-between align-items-center mb-10">
                                            <h5 class="mb-0 font-weight-600 text-dark">
                                                <i class="fa fa-calculator text-primary mr-10"></i>Total Akumulasi Bobot Rubrik
                                            </h5>
                                            <h3 id="total-bobot-text" class="mb-0 font-weight-700 text-danger">0.00%</h3>
                                        </div>
                                        <div class="progress progress-lg mb-10" style="height: 12px; border-radius: 6px; background-color: #e9ecef;">
                                            <div id="total-bobot-bar" class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" style="width: 0%; transition: width 0.3s ease;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <div id="total-bobot-status" class="alert alert-danger py-8 px-15 mb-0 font-weight-600 text-dark border-0" style="border-radius: 6px;">
                                            <i class="fa fa-warning mr-5 text-danger"></i> Akumulasi bobot harus tepat 100.00% untuk dapat disimpan.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- CPMK Table Form -->
                        <form id="form_cpmk_config">
                            <div class="table-responsive">
                                <table id="table_cpmk_config" class="table table-hover table-bordered table-striped">
                                    <thead class="bg-dark text-white">
                                        <tr>
                                            <th style="width: 5%; text-align: center;">No</th>
                                            <th style="width: 13%;">Kode CPMK <span class="text-danger">*</span></th>
                                            <th style="width: 42%;">Deskripsi / Capaian Pembelajaran Mata Kuliah <span class="text-danger">*</span></th>
                                            <th style="width: 12%;">Bobot Penilaian <span class="text-danger">*</span></th>
                                            <th style="width: 11%;">Batas KKM <span class="text-danger">*</span></th>
                                            <th style="width: 12%;">Pemetaan CPL</th>
                                            <th style="width: 5%; text-align: center;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="cpmk_rows">
                                        <!-- Loaded dynamically via AJAX -->
                                    </tbody>
                                </table>
                            </div>

                            <div class="box-footer text-right mt-15">
                                <button type="button" id="btn-save-cpmk" class="btn btn-primary px-30 py-10" disabled>
                                    <i class="fa fa-save mr-5"></i> Simpan Konfigurasi
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
    .txt-kode-cpmk, .txt-kode-cpl {
        text-transform: uppercase;
    }
    .txt-nama-cpmk {
        resize: vertical;
    }
    #table_cpmk_config td {
        vertical-align: middle !important;
    }
</style>
@endsection

@section('script-advanced')
<script>
    const CONFIG = {
        api_url: "{{ $api_url }}",
        kode_prodi: "{{ $session_kode_program_studi }}",
        token: "{{ $api_token }}",
        username: "{{ $session_nim }}",
        tahun: "{{ $session_tahun }}",
        semester: "{{ $session_semester }}"
    };

    $(document).ready(function () {
        let activeCplList = [];

        // Fetch CPL Master Data first
        function loadActiveCpl() {
            return $.ajax({
                url: CONFIG.api_url + "kaprodi/skripsi/get-cpl/" + CONFIG.kode_prodi,
                type: "GET",
                headers: {
                    "Authorization": "Bearer " + CONFIG.token,
                    "username": CONFIG.username
                },
                success: function(res) {
                    if (res.status === 'success') {
                        // Filter CPL by active curriculum year or fallback to all active
                        let activeYear = CONFIG.tahun;
                        activeCplList = res.data.filter(c => 
                            parseInt(c.is_aktif) === 1 && 
                            String(c.tahun_kurikulum) === String(activeYear)
                        );
                        if (activeCplList.length === 0) {
                            activeCplList = res.data.filter(c => parseInt(c.is_aktif) === 1);
                        }
                    }
                }
            });
        }

        // Load data sequentially
        loadActiveCpl().then(function() {
            loadCpmkData();
        }).catch(function() {
            loadCpmkData();
        });

        // 1. Fetch current CPMK Rubrics
        function loadCpmkData() {
            $('#cpmk_rows').html('<tr><td colspan="6" class="text-center py-30 text-muted"><i class="fa fa-spinner fa-spin fa-2x text-primary mr-10"></i> Memuat data rubrik CPMK...</td></tr>');
            
            $.ajax({
                url: CONFIG.api_url + "kaprodi/skripsi/get-rubrik-cpmk/" + CONFIG.kode_prodi,
                type: "GET",
                headers: {
                    "Authorization": "Bearer " + CONFIG.token,
                    "username": CONFIG.username
                },
                success: function(res) {
                    if (res.status === 'success') {
                        renderRows(res.data);
                    } else {
                        swal("Gagal!", "Gagal memuat data CPMK.", "error");
                    }
                },
                error: function(err) {
                    swal("Gagal!", "Terjadi kesalahan pada server saat memuat data CPMK.", "error");
                }
            });
        }

        // 2. Render rows to the table body
        function renderRows(data) {
            let html = '';
            if (!data || data.length === 0) {
                html = '<tr id="no-data-row"><td colspan="7" class="text-center text-muted py-20">Belum ada rubrik CPMK yang diatur. Klik "Tambah CPMK" untuk menambahkan.</td></tr>';
                $('#cpmk_rows').html(html);
                recalculateTotal();
                return;
            }
            
            data.forEach((item, index) => {
                let selectedCpls = item.kode_cpl ? item.kode_cpl.split(',').map(s => s.trim()) : [];
                let selectOptions = '';
                
                activeCplList.forEach(c => {
                    let selected = selectedCpls.includes(c.kode_cpl) ? 'selected' : '';
                    selectOptions += `<option value="${c.kode_cpl}" ${selected}>${c.kode_cpl} - ${c.kode_kategori}</option>`;
                });

                html += `
                <tr class="cpmk-row">
                    <td class="row-no text-center font-weight-600">${index + 1}</td>
                    <td>
                        <input type="text" class="form-control font-weight-600 txt-kode-cpmk" value="${item.kode_cpmk || ''}" placeholder="Contoh: CPMK-1" required>
                    </td>
                    <td>
                        <textarea class="form-control txt-nama-cpmk" rows="2" placeholder="Tuliskan deskripsi kompetensi..." required>${item.nama_cpmk || ''}</textarea>
                    </td>
                    <td>
                        <div class="input-group">
                            <input type="number" class="form-control text-right txt-bobot" value="${item.bobot || 0}" min="0" max="100" step="0.01" placeholder="0.00" required>
                            <div class="input-group-append">
                                <span class="input-group-text font-weight-bold bg-secondary-light">%</span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <input type="number" class="form-control text-right txt-kkm" value="${item.kkm || 70.00}" min="0" max="100" step="0.01" placeholder="70.00" required>
                    </td>
                    <td>
                        <select class="form-control select-cpl-mapping" style="width: 100%;" multiple="multiple">
                            ${selectOptions}
                        </select>
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-sm btn-danger btn-delete-row" title="Hapus CPMK">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>
                </tr>
                `;
            });
            
            $('#cpmk_rows').html(html);

            // Initialize Select2 on the dynamically loaded rows
            $('.select-cpl-mapping').select2({
                placeholder: "Pilih CPL...",
                allowClear: true
            });

            updateRowNumbers();
            recalculateTotal();
        }

        // 3. Update sequential numbers on rows
        function updateRowNumbers() {
            $('#cpmk_rows tr.cpmk-row').each(function(index) {
                $(this).find('.row-no').text(index + 1);
            });
        }

        // 4. Live calculate total weight & state styling
        function recalculateTotal() {
            let total = 0;
            $('.txt-bobot').each(function() {
                let val = parseFloat($(this).val());
                if (!isNaN(val)) {
                    total += val;
                }
            });
            
            // Format to 2 decimal places to prevent float precision issues
            total = Math.round(total * 100) / 100;
            
            $('#total-bobot-text').text(total.toFixed(2) + '%');
            
            let barWidth = Math.min(total, 100);
            $('#total-bobot-bar').css('width', barWidth + '%');
            
            if (Math.abs(total - 100.00) < 0.01) {
                $('#total-bobot-text').removeClass('text-danger text-warning').addClass('text-success');
                $('#total-bobot-bar').removeClass('bg-danger bg-warning').addClass('bg-success');
                $('#total-bobot-status').removeClass('alert-danger alert-warning').addClass('alert-success')
                    .html('<i class="fa fa-check-circle mr-5 text-success"></i> Akumulasi bobot sudah tepat 100.00%. Konfigurasi siap disimpan.');
                $('#btn-save-cpmk').removeAttr('disabled');
            } else if (total > 100) {
                $('#total-bobot-text').removeClass('text-success text-warning').addClass('text-danger');
                $('#total-bobot-bar').removeClass('bg-success bg-warning').addClass('bg-danger');
                $('#total-bobot-status').removeClass('alert-success alert-warning').addClass('alert-danger')
                    .html(`<i class="fa fa-times-circle mr-5 text-danger"></i> Total bobot melebihi batas (saat ini: ${total.toFixed(2)}%). Harus tepat 100.00%.`);
                $('#btn-save-cpmk').attr('disabled', 'disabled');
            } else {
                $('#total-bobot-text').removeClass('text-success text-danger').addClass('text-warning');
                $('#total-bobot-bar').removeClass('bg-success bg-danger').addClass('bg-warning');
                $('#total-bobot-status').removeClass('alert-success alert-danger').addClass('alert-warning')
                    .html(`<i class="fa fa-warning mr-5 text-warning"></i> Total bobot kurang dari batas (saat ini: ${total.toFixed(2)}%). Harus tepat 100.00%.`);
                $('#btn-save-cpmk').attr('disabled', 'disabled');
            }
        }

        // Live calculation event bindings
        $(document).on('input', '.txt-bobot', function() {
            recalculateTotal();
        });

        // 5. Add CPMK Row Action
        $('#btn-add-cpmk').on('click', function() {
            $('#no-data-row').remove();
            
            let rowCount = $('#cpmk_rows tr.cpmk-row').length + 1;
            let suggestedCode = "CPMK-" + rowCount;
            
            let selectOptions = '';
            activeCplList.forEach(c => {
                selectOptions += `<option value="${c.kode_cpl}">${c.kode_cpl} - ${c.kode_kategori}</option>`;
            });

            let newRow = `
            <tr class="cpmk-row animate-fade-in">
                <td class="row-no text-center font-weight-600">${rowCount}</td>
                <td>
                    <input type="text" class="form-control font-weight-600 txt-kode-cpmk" value="${suggestedCode}" placeholder="Contoh: CPMK-1" required>
                </td>
                <td>
                    <textarea class="form-control txt-nama-cpmk" rows="2" placeholder="Tuliskan deskripsi kompetensi..." required></textarea>
                </td>
                <td>
                    <div class="input-group">
                        <input type="number" class="form-control text-right txt-bobot" value="0" min="0" max="100" step="0.01" placeholder="0.00" required>
                        <div class="input-group-append">
                            <span class="input-group-text font-weight-bold bg-secondary-light">%</span>
                        </div>
                    </div>
                </td>
                <td>
                    <input type="number" class="form-control text-right txt-kkm" value="70.00" min="0" max="100" step="0.01" placeholder="70.00" required>
                </td>
                <td>
                    <select class="form-control select-cpl-mapping" style="width: 100%;" multiple="multiple">
                        ${selectOptions}
                    </select>
                </td>
                <td class="text-center">
                    <button type="button" class="btn btn-sm btn-danger btn-delete-row" title="Hapus CPMK">
                        <i class="fa fa-trash"></i>
                    </button>
                </td>
            </tr>
            `;
            
            $('#cpmk_rows').append(newRow);

            // Initialize Select2 specifically for the new row
            $('#cpmk_rows tr:last-child').find('.select-cpl-mapping').select2({
                placeholder: "Pilih CPL...",
                allowClear: true
            });

            recalculateTotal();
            $('#cpmk_rows tr:last-child').find('.txt-nama-cpmk').focus();
        });

        // 6. Delete Row Action
        $(document).on('click', '.btn-delete-row', function() {
            let row = $(this).closest('tr');
            row.remove();
            
            if ($('#cpmk_rows tr.cpmk-row').length === 0) {
                let html = '<tr id="no-data-row"><td colspan="7" class="text-center text-muted py-20">Belum ada rubrik CPMK yang diatur. Klik "Tambah CPMK" untuk menambahkan.</td></tr>';
                $('#cpmk_rows').html(html);
            } else {
                updateRowNumbers();
            }
            recalculateTotal();
        });

        // 7. Save Custom CPMK Rubrics
        $('#btn-save-cpmk').on('click', function(e) {
            e.preventDefault();
            
            let rubrik = [];
            let isValid = true;
            let totalBobot = 0;
            
            $('.form-control').removeClass('is-invalid');
            
            let rows = $('#cpmk_rows tr.cpmk-row');
            if (rows.length === 0) {
                swal("Peringatan!", "Minimal harus ada satu CPMK dalam rubrik.", "warning");
                return;
            }
            
            rows.each(function() {
                let kode_cpmk = $(this).find('.txt-kode-cpmk').val().trim();
                let nama_cpmk = $(this).find('.txt-nama-cpmk').val().trim();
                let bobotVal = $(this).find('.txt-bobot').val();
                let bobot = parseFloat(bobotVal);
                let kkmVal = $(this).find('.txt-kkm').val();
                let kkm = parseFloat(kkmVal);
                
                let selectedCpls = $(this).find('.select-cpl-mapping').val();
                let kode_cpl = selectedCpls ? selectedCpls.join(',') : '';
                
                if (kode_cpmk === "") {
                    $(this).find('.txt-kode-cpmk').addClass('is-invalid');
                    isValid = false;
                }
                if (nama_cpmk === "") {
                    $(this).find('.txt-nama-cpmk').addClass('is-invalid');
                    isValid = false;
                }
                if (isNaN(bobot) || bobot <= 0) {
                    $(this).find('.txt-bobot').addClass('is-invalid');
                    isValid = false;
                } else {
                    totalBobot += bobot;
                }
                if (isNaN(kkm) || kkm < 0 || kkm > 100) {
                    $(this).find('.txt-kkm').addClass('is-invalid');
                    isValid = false;
                }
                
                rubrik.push({
                    kode_cpmk: kode_cpmk,
                    nama_cpmk: nama_cpmk,
                    bobot: bobot,
                    kkm: kkm,
                    kode_cpl: kode_cpl
                });
            });
            
            if (!isValid) {
                swal("Validasi Gagal!", "Semua kolom wajib (*) harus diisi dengan benar.", "error");
                return;
            }
            
            if (Math.abs(totalBobot - 100.00) > 0.01) {
                swal("Bobot Tidak Valid!", "Total bobot harus tepat 100% (saat ini: " + totalBobot.toFixed(2) + "%). Silakan sesuaikan bobot Anda.", "warning");
                return;
            }
            
            swal({
                title: "Simpan Perubahan?",
                text: "Konfigurasi rubrik CPMK baru akan diterapkan untuk program studi ini.",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Simpan!",
                cancelButtonText: "Batal"
            }, function(isConfirm) {
                if (isConfirm) {
                    let btn = $('#btn-save-cpmk');
                    let oldHtml = btn.html();
                    btn.attr('disabled', 'disabled').html('<i class="fa fa-spinner fa-spin mr-5"></i> Menyimpan...');
                    
                    $.ajax({
                        url: CONFIG.api_url + "kaprodi/skripsi/save-rubrik-cpmk",
                        type: "POST",
                        headers: {
                            "Authorization": "Bearer " + CONFIG.token,
                            "username": CONFIG.username
                        },
                        data: {
                            kode_prodi: CONFIG.kode_prodi,
                            rubrik: rubrik
                        },
                        success: function(res) {
                            btn.removeAttr('disabled').html(oldHtml);
                            swal("Berhasil!", "Konfigurasi rubrik CPMK berhasil disimpan.", "success");
                            loadCpmkData();
                        },
                        error: function(err) {
                            btn.removeAttr('disabled').html(oldHtml);
                            let errMsg = "Gagal menyimpan konfigurasi.";
                            if (err.responseJSON && err.responseJSON.error) {
                                if (Array.isArray(err.responseJSON.error)) {
                                    errMsg = err.responseJSON.error.join("\n");
                                } else {
                                    errMsg = err.responseJSON.error;
                                }
                            }
                            swal("Gagal!", errMsg, "error");
                        }
                    });
                }
            });
        });

        // 8. Reset Custom CPMK Rubrics
        $('#btn-reset-cpmk').on('click', function(e) {
            e.preventDefault();
            
            swal({
                title: "Reset ke Default?",
                text: "Kustomisasi rubrik CPMK prodi ini akan dihapus dan dikembalikan ke template default global. Aksi ini tidak dapat dibatalkan.",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, Reset!",
                cancelButtonText: "Batal"
            }, function(isConfirm) {
                if (isConfirm) {
                    let btn = $('#btn-reset-cpmk');
                    let oldHtml = btn.html();
                    btn.attr('disabled', 'disabled').html('<i class="fa fa-spinner fa-spin mr-5"></i> Mereset...');
                    
                    $.ajax({
                        url: CONFIG.api_url + "kaprodi/skripsi/reset-rubrik-cpmk",
                        type: "POST",
                        headers: {
                            "Authorization": "Bearer " + CONFIG.token,
                            "username": CONFIG.username
                        },
                        data: {
                            kode_prodi: CONFIG.kode_prodi
                        },
                        success: function(res) {
                            btn.removeAttr('disabled').html(oldHtml);
                            swal("Berhasil!", "Rubrik CPMK berhasil dikembalikan ke default.", "success");
                            loadCpmkData();
                        },
                        error: function(err) {
                            btn.removeAttr('disabled').html(oldHtml);
                            let errMsg = "Gagal mereset rubrik ke default.";
                            if (err.responseJSON && err.responseJSON.error) {
                                errMsg = err.responseJSON.error;
                            }
                            swal("Gagal!", errMsg, "error");
                        }
                    });
                }
            });
        });
    });
</script>
@endsection
