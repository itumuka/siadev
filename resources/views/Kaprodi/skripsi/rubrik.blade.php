@extends('layout')
@section('content')
<div class="container-full">
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title">Konfigurasi Rubrik Indikator Penilaian</h3>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                            <li class="breadcrumb-item" aria-current="page">Kaprodi</li>
                            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('kpskripsi_index') }}">Skripsi</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Rubrik Penilaian</li>
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
                        <h4 class="box-title text-dark">Daftar Rubrik Aspek & Indikator Penilaian</h4>
                        <div class="box-controls pull-right">
                            <button id="btn-add-indikator" class="btn btn-sm btn-success mr-5">
                                <i class="fa fa-plus mr-5"></i> Tambah Indikator
                            </button>
                            <button id="btn-reset-indikator" class="btn btn-sm btn-danger mr-5">
                                <i class="fa fa-refresh mr-5"></i> Reset ke Default
                            </button>
                            <a href="{{ route('kpskripsi_index') }}" class="btn btn-sm btn-secondary">
                                <i class="fa fa-arrow-left mr-5"></i> Kembali
                            </a>
                        </div>
                        <p class="mb-0 text-muted">Sesuaikan rubrik penilaian tugas akhir berbasis aspek & indikator secara dinamis untuk program studi Anda.</p>
                    </div>
                    
                    <div class="box-body">
                        <!-- Jalur & Tipe Pembobotan Selector -->
                        <div class="row mb-15">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="font-weight-600 text-dark">Jalur Kelulusan</label>
                                    <select id="select-jalur" class="form-control select2" style="width: 100%;">
                                        <option value="reguler" selected>Tradisional (Sidang Laporan)</option>
                                        <option value="obe">OBE (Publikasi Artikel Jurnal)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="font-weight-600 text-dark">Tipe Pembobotan</label>
                                    <select id="select-tipe-bobot" class="form-control select2" style="width: 100%;">
                                        <option value="indikator" selected>Kustom per Indikator</option>
                                        <option value="tunggal">Sama Rata (Tunggal Aspek)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 d-flex align-items-center justify-content-end">
                                <a href="{{ route('kpskripsi_aspek') }}" class="btn btn-info btn-sm">
                                    <i class="fa fa-cog mr-5"></i> Kelola Master Aspek Penilaian
                                </a>
                            </div>
                        </div>

                        <!-- Live Accumulator Bar Container (Dynamic Aspects) -->
                        <div class="row mb-20" id="accumulator-container">
                            <!-- Populated dynamically via JS -->
                        </div>
                        
                        <div class="row mb-20">
                            <div class="col-12">
                                <div id="validation-status-alert" class="alert alert-danger py-8 px-15 mb-0 font-weight-600 text-dark border-0" style="border-radius: 6px;">
                                    Memuat konfigurasi aspek...
                                </div>
                            </div>
                        </div>

                        <!-- Indikator Table Form -->
                        <form id="form_indikator_config">
                            <div class="table-responsive">
                                <table id="table_indikator_config" class="table table-hover table-bordered table-striped">
                                    <thead class="bg-dark text-white">
                                        <tr>
                                            <th style="width: 5%; text-align: center;">No</th>
                                            <th style="width: 25%;">Aspek Penilaian <span class="text-danger">*</span></th>
                                            <th style="width: 15%;">Kode Indikator <span class="text-danger">*</span></th>
                                            <th style="width: 40%;">Nama Indikator / Kriteria Penilaian <span class="text-danger">*</span></th>
                                            <th style="width: 10%;">Bobot Penilaian <span class="text-danger">*</span></th>
                                            <th style="width: 5%; text-align: center;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="indikator_rows">
                                        <!-- Loaded dynamically via AJAX -->
                                    </tbody>
                                </table>
                            </div>

                            <div class="box-footer text-right mt-15">
                                <button type="button" id="btn-save-indikator" class="btn btn-primary px-30 py-10" disabled>
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
    .txt-kode-indikator {
        text-transform: uppercase;
    }
    .txt-nama-indikator {
        resize: vertical;
    }
    #table_indikator_config td {
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
        semester: "{{ $session_semester }}",
        aspects: [] // loaded dynamically
    };

    $(document).ready(function () {
        // Load initial data
        loadAspectsAndIndikators();

        // On Jalur change
        $('#select-jalur').on('change', function() {
            loadAspectsAndIndikators();
        });

        // On Tipe Bobot change
        $('#select-tipe-bobot').on('change', function() {
            applyTipeBobotLogic();
            recalculateTotals();
        });

        function loadAspectsAndIndikators() {
            let jalur = $('#select-jalur').val();
            // Fetch aspects first
            $.ajax({
                url: CONFIG.api_url + "kaprodi/skripsi/get-aspek/" + CONFIG.kode_prodi + "?jalur=" + jalur,
                type: "GET",
                headers: {
                    "Authorization": "Bearer " + CONFIG.token,
                    "username": CONFIG.username
                },
                success: function(res) {
                    if (res.status === 'success') {
                        CONFIG.aspects = res.data || [];
                        renderAspectCards();
                        loadIndikatorData();
                    } else {
                        swal("Gagal!", "Gagal memuat master aspek penilaian.", "error");
                    }
                },
                error: function() {
                    swal("Gagal!", "Gagal menghubungi server untuk memuat aspek.", "error");
                }
            });
        }

        function renderAspectCards() {
            let html = '';
            let colWidth = CONFIG.aspects.length > 0 ? Math.max(4, Math.floor(12 / CONFIG.aspects.length)) : 6;
            
            CONFIG.aspects.forEach(function(a) {
                let cleanId = a.nama_aspek.replace(/[^a-zA-Z0-9]/g, '_');
                html += `
                    <div class="col-md-${colWidth}">
                        <div class="card bg-lighter no-shadow border-1" style="border-radius: 8px;">
                            <div class="card-body py-15 px-20">
                                <div class="d-flex justify-content-between align-items-center mb-10">
                                    <h5 class="mb-0 font-weight-600 text-dark">
                                        <i class="fa fa-calculator text-primary mr-10"></i>Bobot ${a.nama_aspek}
                                    </h5>
                                    <h3 id="bobot-${cleanId}-text" class="mb-0 font-weight-700 text-danger">0.00% / ${parseFloat(a.bobot).toFixed(0)}%</h3>
                                </div>
                                <div class="progress progress-lg mb-10" style="height: 12px; border-radius: 6px; background-color: #e9ecef;">
                                    <div id="bobot-${cleanId}-bar" class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" style="width: 0%; transition: width 0.3s ease;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            });

            $('#accumulator-container').html(html);
        }

        // 1. Fetch current Indikator Rubrics
        function loadIndikatorData() {
            $('#indikator_rows').html('<tr><td colspan="6" class="text-center py-30 text-muted"><i class="fa fa-spinner fa-spin fa-2x text-primary mr-10"></i> Memuat data rubrik penilaian...</td></tr>');
            
            let jalur = $('#select-jalur').val();
            $.ajax({
                url: CONFIG.api_url + "kaprodi/skripsi/get-rubrik-indikator/" + CONFIG.kode_prodi + "?jalur=" + jalur,
                type: "GET",
                headers: {
                    "Authorization": "Bearer " + CONFIG.token,
                    "username": CONFIG.username
                },
                success: function(res) {
                    if (res.status === 'success') {
                        if (res.data && res.data.length > 0) {
                            // Set Tipe Bobot from DB state
                            let first = res.data[0];
                            if (first.tipe_bobot) {
                                $('#select-tipe-bobot').val(first.tipe_bobot).trigger('change.select2');
                            }
                        }
                        renderRows(res.data);
                    } else {
                        swal("Gagal!", "Gagal memuat data rubrik.", "error");
                    }
                },
                error: function(err) {
                    swal("Gagal!", "Terjadi kesalahan pada server saat memuat data rubrik.", "error");
                }
            });
        }

        // 2. Render rows to the table body
        function renderRows(data) {
            let html = '';
            if (!data || data.length === 0) {
                html = '<tr id="no-data-row"><td colspan="6" class="text-center text-muted py-20">Belum ada rubrik penilaian yang diatur. Klik "Tambah Indikator" untuk menambahkan.</td></tr>';
                $('#indikator_rows').html(html);
                recalculateTotals();
                return;
            }
            
            data.forEach((item, index) => {
                let selectOptions = '';
                CONFIG.aspects.forEach(function(a) {
                    let selected = (item.aspek === a.nama_aspek) ? 'selected' : '';
                    selectOptions += `<option value="${a.nama_aspek}" ${selected}>${a.nama_aspek} (${parseFloat(a.bobot).toFixed(0)}%)</option>`;
                });

                html += `
                <tr class="indikator-row">
                    <td class="row-no text-center font-weight-600">${index + 1}</td>
                    <td>
                        <select class="form-control select-aspek" required>
                            ${selectOptions}
                        </select>
                    </td>
                    <td>
                        <input type="text" class="form-control font-weight-600 txt-kode-indikator" value="${item.kode_indikator || ''}" placeholder="Contoh: IND-1" required>
                    </td>
                    <td>
                        <textarea class="form-control txt-nama-indikator" rows="2" placeholder="Tuliskan kriteria penilaian..." required>${item.nama_indikator || ''}</textarea>
                    </td>
                    <td>
                        <div class="input-group">
                            <input type="number" class="form-control text-right txt-bobot" value="${item.bobot || 0}" min="0" max="100" step="0.01" placeholder="0.00" required>
                            <div class="input-group-append">
                                <span class="input-group-text font-weight-bold bg-secondary-light">%</span>
                            </div>
                        </div>
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-sm btn-danger btn-delete-row" title="Hapus Indikator">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>
                </tr>
                `;
            });
            
            $('#indikator_rows').html(html);
            updateRowNumbers();
            applyTipeBobotLogic();
            recalculateTotals();
        }

        // 3. Update sequential numbers on rows
        function updateRowNumbers() {
            $('#indikator_rows tr.indikator-row').each(function(index) {
                $(this).find('.row-no').text(index + 1);
            });
        }

        // 4. Apply Tipe Bobot logic (disabling weights if 'tunggal' is selected)
        function applyTipeBobotLogic() {
            let tipe = $('#select-tipe-bobot').val();
            if (tipe === 'tunggal') {
                $('.txt-bobot').attr('readonly', 'readonly');
                redistributeTunggalWeights();
            } else {
                $('.txt-bobot').removeAttr('readonly');
            }
        }

        function redistributeTunggalWeights() {
            CONFIG.aspects.forEach(function(a) {
                let matchingRows = $('#indikator_rows tr.indikator-row').filter(function() {
                    return $(this).find('.select-aspek').val() === a.nama_aspek;
                });

                if (matchingRows.length > 0) {
                    let share = (parseFloat(a.bobot) / matchingRows.length).toFixed(2);
                    matchingRows.each(function() {
                        $(this).find('.txt-bobot').val(share);
                    });
                }
            });
        }

        // 5. Live calculate total weights & state styling
        function recalculateTotals() {
            let tipe = $('#select-tipe-bobot').val();
            if (tipe === 'tunggal') {
                redistributeTunggalWeights();
            }

            let totals = {};
            CONFIG.aspects.forEach(function(a) {
                totals[a.nama_aspek] = 0;
            });

            $('#indikator_rows tr.indikator-row').each(function() {
                let aspek = $(this).find('.select-aspek').val();
                let bobot = parseFloat($(this).find('.txt-bobot').val());
                if (!isNaN(bobot)) {
                    if (totals[aspek] !== undefined) {
                        totals[aspek] += bobot;
                    }
                }
            });
            
            let allValid = true;
            let missingAspects = [];

            CONFIG.aspects.forEach(function(a) {
                let cleanId = a.nama_aspek.replace(/[^a-zA-Z0-9]/g, '_');
                let subTotal = Math.round(totals[a.nama_aspek] * 100) / 100;
                let target = parseFloat(a.bobot);

                $(`#bobot-${cleanId}-text`).text(subTotal.toFixed(2) + '% / ' + target.toFixed(0) + '%');
                let barPct = Math.min((subTotal / target) * 100, 100);
                $(`#bobot-${cleanId}-bar`).css('width', barPct + '%');

                if (Math.abs(subTotal - target) < 0.1) {
                    $(`#bobot-${cleanId}-text`).removeClass('text-danger').addClass('text-success');
                    $(`#bobot-${cleanId}-bar`).removeClass('bg-danger').addClass('bg-success');
                } else {
                    $(`#bobot-${cleanId}-text`).removeClass('text-success').addClass('text-danger');
                    $(`#bobot-${cleanId}-bar`).removeClass('bg-success').addClass('bg-danger');
                    allValid = false;
                }

                // Check count of rows in this aspect
                let count = $('#indikator_rows tr.indikator-row').filter(function() {
                    return $(this).find('.select-aspek').val() === a.nama_aspek;
                }).length;
                if (count === 0) {
                    missingAspects.push(a.nama_aspek);
                }
            });

            if (CONFIG.aspects.length === 0) {
                $('#validation-status-alert').removeClass('alert-success alert-warning').addClass('alert-danger')
                    .html('<i class="fa fa-times-circle mr-5 text-danger"></i> Silakan atur Master Aspek Penilaian terlebih dahulu.');
                $('#btn-save-indikator').attr('disabled', 'disabled');
                return;
            }

            if (missingAspects.length > 0) {
                $('#validation-status-alert').removeClass('alert-success alert-warning').addClass('alert-danger')
                    .html('<i class="fa fa-times-circle mr-5 text-danger"></i> Minimal harus memiliki 1 Indikator untuk aspek: ' + missingAspects.join(', ') + '.');
                $('#btn-save-indikator').attr('disabled', 'disabled');
            } else if (allValid) {
                let infoText = CONFIG.aspects.map(a => `${a.nama_aspek} ${parseFloat(a.bobot).toFixed(0)}%`).join(' & ');
                $('#validation-status-alert').removeClass('alert-danger alert-warning').addClass('alert-success')
                    .html('<i class="fa fa-check-circle mr-5 text-success"></i> Akumulasi bobot sudah sesuai (' + infoText + '). Konfigurasi siap disimpan.');
                $('#btn-save-indikator').removeAttr('disabled');
            } else {
                let infoText = CONFIG.aspects.map(a => `${a.nama_aspek} harus ${parseFloat(a.bobot).toFixed(0)}%`).join(' dan ');
                $('#validation-status-alert').removeClass('alert-success alert-success').addClass('alert-danger')
                    .html('<i class="fa fa-warning mr-5 text-danger"></i> Total bobot belum tepat (' + infoText + ').');
                $('#btn-save-indikator').attr('disabled', 'disabled');
            }
        }

        // Live calculation event bindings
        $(document).on('input', '.txt-bobot', function() {
            recalculateTotals();
        });
        $(document).on('change', '.select-aspek', function() {
            applyTipeBobotLogic();
            recalculateTotals();
        });

        // 6. Add Indikator Row Action
        $('#btn-add-indikator').on('click', function() {
            $('#no-data-row').remove();
            
            let rowCount = $('#indikator_rows tr.indikator-row').length + 1;
            let suggestedCode = "IND-" + rowCount;

            let selectOptions = '';
            CONFIG.aspects.forEach(function(a) {
                selectOptions += `<option value="${a.nama_aspek}">${a.nama_aspek} (${parseFloat(a.bobot).toFixed(0)}%)</option>`;
            });

            let newRow = `
            <tr class="indikator-row animate-fade-in">
                <td class="row-no text-center font-weight-600">${rowCount}</td>
                <td>
                    <select class="form-control select-aspek" required>
                        ${selectOptions}
                    </select>
                </td>
                <td>
                    <input type="text" class="form-control font-weight-600 txt-kode-indikator" value="${suggestedCode}" placeholder="Contoh: IND-1" required>
                </td>
                <td>
                    <textarea class="form-control txt-nama-indikator" rows="2" placeholder="Tuliskan kriteria penilaian..." required></textarea>
                </td>
                <td>
                    <div class="input-group">
                        <input type="number" class="form-control text-right txt-bobot" value="0" min="0" max="100" step="0.01" placeholder="0.00" required>
                        <div class="input-group-append">
                            <span class="input-group-text font-weight-bold bg-secondary-light">%</span>
                        </div>
                    </div>
                </td>
                <td class="text-center">
                    <button type="button" class="btn btn-sm btn-danger btn-delete-row" title="Hapus Indikator">
                        <i class="fa fa-trash"></i>
                    </button>
                </td>
            </tr>
            `;
            
            $('#indikator_rows').append(newRow);
            updateRowNumbers();
            applyTipeBobotLogic();
            recalculateTotals();
            $('#indikator_rows tr:last-child').find('.txt-nama-indikator').focus();
        });

        // 7. Delete Row Action
        $(document).on('click', '.btn-delete-row', function() {
            let row = $(this).closest('tr');
            row.remove();
            
            if ($('#indikator_rows tr.indikator-row').length === 0) {
                let html = '<tr id="no-data-row"><td colspan="6" class="text-center text-muted py-20">Belum ada rubrik penilaian yang diatur. Klik "Tambah Indikator" untuk menambahkan.</td></tr>';
                $('#indikator_rows').html(html);
            } else {
                updateRowNumbers();
            }
            applyTipeBobotLogic();
            recalculateTotals();
        });

        // 8. Save Custom Indikator Rubrics
        $('#btn-save-indikator').on('click', function(e) {
            e.preventDefault();
            
            let rubrik = [];
            let isValid = true;
            
            $('.form-control').removeClass('is-invalid');
            
            let rows = $('#indikator_rows tr.indikator-row');
            if (rows.length === 0) {
                swal("Peringatan!", "Minimal harus ada satu indikator dalam rubrik.", "warning");
                return;
            }
            
            rows.each(function() {
                let aspek = $(this).find('.select-aspek').val();
                let kode_indikator = $(this).find('.txt-kode-indikator').val().trim();
                let nama_indikator = $(this).find('.txt-nama-indikator').val().trim();
                let bobotVal = $(this).find('.txt-bobot').val();
                let bobot = parseFloat(bobotVal);
                
                if (kode_indikator === "") {
                    $(this).find('.txt-kode-indikator').addClass('is-invalid');
                    isValid = false;
                }
                if (nama_indikator === "") {
                    $(this).find('.txt-nama-indikator').addClass('is-invalid');
                    isValid = false;
                }
                if (isNaN(bobot) || bobot < 0) {
                    $(this).find('.txt-bobot').addClass('is-invalid');
                    isValid = false;
                }
                
                rubrik.push({
                    aspek: aspek,
                    kode_indikator: kode_indikator,
                    nama_indikator: nama_indikator,
                    bobot: bobot
                });
            });
            
            if (!isValid) {
                swal("Validasi Gagal!", "Semua kolom wajib (*) harus diisi dengan benar.", "error");
                return;
            }
            
            swal({
                title: "Simpan Perubahan?",
                text: "Konfigurasi rubrik indikator penilaian baru akan diterapkan untuk program studi ini.",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Simpan!",
                cancelButtonText: "Batal"
            }, function(isConfirm) {
                if (isConfirm) {
                    let btn = $('#btn-save-indikator');
                    let oldHtml = btn.html();
                    btn.attr('disabled', 'disabled').html('<i class="fa fa-spinner fa-spin mr-5"></i> Menyimpan...');
                    
                    $.ajax({
                        url: CONFIG.api_url + "kaprodi/skripsi/save-rubrik-indikator",
                        type: "POST",
                        headers: {
                            "Authorization": "Bearer " + CONFIG.token,
                            "username": CONFIG.username
                        },
                        data: {
                            kode_prodi: CONFIG.kode_prodi,
                            jalur: $('#select-jalur').val(),
                            tipe_bobot: $('#select-tipe-bobot').val(),
                            rubrik: rubrik
                        },
                        success: function(res) {
                            btn.removeAttr('disabled').html(oldHtml);
                            swal("Berhasil!", "Konfigurasi rubrik penilaian berhasil disimpan.", "success");
                            loadAspectsAndIndikators();
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

        // 9. Reset Custom Indikator Rubrics
        $('#btn-reset-indikator').on('click', function(e) {
            e.preventDefault();
            
            swal({
                title: "Reset ke Default?",
                text: "Kustomisasi rubrik prodi ini akan dihapus dan dikembalikan ke template default global. Aksi ini tidak dapat dibatalkan.",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, Reset!",
                cancelButtonText: "Batal"
            }, function(isConfirm) {
                if (isConfirm) {
                    let btn = $('#btn-reset-indikator');
                    let oldHtml = btn.html();
                    btn.attr('disabled', 'disabled').html('<i class="fa fa-spinner fa-spin mr-5"></i> Mereset...');
                    
                    $.ajax({
                        url: CONFIG.api_url + "kaprodi/skripsi/reset-rubrik-indikator",
                        type: "POST",
                        headers: {
                            "Authorization": "Bearer " + CONFIG.token,
                            "username": CONFIG.username
                        },
                        data: {
                            kode_prodi: CONFIG.kode_prodi,
                            jalur: $('#select-jalur').val()
                        },
                        success: function(res) {
                            btn.removeAttr('disabled').html(oldHtml);
                            swal("Berhasil!", "Rubrik penilaian berhasil dikembalikan ke default.", "success");
                            loadAspectsAndIndikators();
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
