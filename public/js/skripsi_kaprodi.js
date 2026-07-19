$(document).ready(function () {
    let table;

    function truncateText(text, maxLength = 200) {
        if (text === null || text === undefined || text === '') return '-';
        const value = String(text);
        return value.length > maxLength ? value.substring(0, maxLength) + '...' : value;
    }

    function escapeAttr(text) {
        if (text === null || text === undefined) return '';
        return String(text)
            .replace(/&/g, '&amp;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#39;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;');
    }

    // 1. Initialize Datatable
    function initDataTable() {
        table = $('#table_kaprodi_skripsi').DataTable({
            processing: true,
            ajax: {
                url: CONFIG.api_url + "kaprodi/skripsi/list-mahasiswa",
                type: "GET",
                headers: {
                    "Authorization": "Bearer " + CONFIG.token,
                    "username": CONFIG.username
                },
                data: {
                    kode_prodi: CONFIG.kode_prodi,
                    tahun: CONFIG.tahun,
                    semester: CONFIG.semester
                },
                dataSrc: ""
            },
            columns: [
                { data: null, render: (data, type, row, meta) => meta.row + 1 },
                { data: 'nim' },
                { data: 'nama_mhs' },
                {
                    data: null,
                    render: function (data) {
                        const topik = data.topik || '-';
                        const judul = data.judul || '-';
                        const topikDisplay = truncateText(topik, 200);
                        const judulDisplay = truncateText(judul, 200);
                        return `<strong title="${escapeAttr(topik)}">${topikDisplay}</strong><br><small title="${escapeAttr(judul)}">${judulDisplay}</small>`;
                    }
                },
                {
                    data: null,
                    render: function (data) {
                        return `1. ${data.nama_pembimbing1 || '<span class="text-danger">Belum Diplot</span>'}<br>2. ${data.nama_pembimbing2 || '-'}`;
                    }
                },
                {
                    data: 'status',
                    render: function (status) {
                        const badges = {
                            'pengajuan': '<span class="badge badge-warning">Pengajuan</span>',
                            'aktif': '<span class="badge badge-primary">Bimbingan</span>',
                            'lulus': '<span class="badge badge-success">Lulus</span>'
                        };
                        return badges[status] || `<span class="badge badge-secondary">${status}</span>`;
                    }
                },
                {
                    data: null,
                    render: function (data) {
                        let semproBtn = '';
                        let semproStatus = data.sempro_status || '';

                        if (semproStatus === 'tidak_wajib') {
                            semproBtn = `
                                <button class="btn btn-sm btn-secondary" disabled title="Seminar Proposal tidak diwajibkan oleh Prodi">
                                    <i class="fa fa-calendar"></i>
                                </button>
                            `;
                        } else if (semproStatus === 'lulus_matakuliah') {
                            semproBtn = `
                                <button class="btn btn-sm btn-success" disabled title="Lulus Sempro otomatis via Nilai Mata Kuliah">
                                    <i class="fa fa-check-circle"></i>
                                </button>
                            `;
                        } else if (semproStatus === 'lulus') {
                            semproBtn = `
                                <button class="btn btn-sm btn-success" disabled title="Mahasiswa telah lulus Seminar Proposal">
                                    <i class="fa fa-check-circle"></i>
                                </button>
                            `;
                        } else if (semproStatus === 'belum_lulus_matakuliah') {
                            semproBtn = `
                                <button class="btn btn-sm btn-secondary" disabled title="Belum lulus mata kuliah syarat Sempro">
                                    <i class="fa fa-calendar"></i>
                                </button>
                            `;
                        } else if (semproStatus === 'belum_mengajukan') {
                            semproBtn = `
                                <button class="btn btn-sm btn-secondary" disabled title="Mahasiswa belum mengunggah naskah proposal">
                                    <i class="fa fa-calendar"></i>
                                </button>
                            `;
                        } else {
                            // 'diajukan', 'dijadwalkan', 'draft', 'revisi', 'ditolak'
                            semproBtn = `
                                <button class="btn btn-sm btn-success btn-plot-sempro" data-nim="${data.nim}" title="Jadwal Sempro">
                                    <i class="fa fa-calendar"></i>
                                </button>
                            `;
                        }

                        return `
                            <div class="btn-group">
                                <button class="btn btn-sm btn-info btn-plot-pembimbing" 
                                    data-id="${data.id_skripsi}" 
                                    data-nim="${data.nim}" 
                                    data-nama="${data.nama_mhs}" 
                                    data-p1="${data.id_dosen_pembimbing1 || ''}" 
                                    data-nama-p1="${data.nama_pembimbing1 || ''}"
                                    data-p2="${data.id_dosen_pembimbing2 || ''}" 
                                    data-nama-p2="${data.nama_pembimbing2 || ''}"
                                    title="Plot Pembimbing">
                                    <i class="fa fa-users"></i>
                                </button>
                                ${semproBtn}
                                <button class="btn btn-sm btn-warning text-white btn-plot-ujian" 
                                    data-id="${data.id_skripsi}" 
                                    data-nim="${data.nim}" 
                                    data-nama="${data.nama_mhs}" 
                                    data-is-obe="${data.is_obe || 0}"
                                    title="Jadwal Ujian Akhir">
                                    <i class="fa fa-graduation-cap"></i>
                                </button>
                            </div>
                        `;
                    }
                }
            ]
        });
    }

    // 2. Initialize Select2 for Dosen
    function initSelect2() {
        $('.select2-dosen').each(function () {
            $(this).select2({
                dropdownParent: $(this).closest('.modal'),
                placeholder: "Cari Dosen...",
                allowClear: true,
                minimumInputLength: 2,
                ajax: {
                    url: CONFIG.api_url + "akademik/select-dosen",
                    type: "GET",
                    dataType: 'json',
                    headers: {
                        "Authorization": "Bearer " + CONFIG.token,
                        "username": CONFIG.username
                    },
                    delay: 100,
                    data: function (params) {
                        return { search: params.term || '' };
                    },
                    processResults: function (res) {
                        return {
                            results: res.data || []
                        };
                    },
                    cache: true
                }
            });
        });
    }

    // Helper to set Select2 value for AJAX
    function setSelect2Value(selector, id, text) {
        if (!id || id === 'null' || id === '0') {
            $(selector).val(null).trigger('change');
            return;
        }
        if ($(selector).find("option[value='" + id + "']").length) {
            $(selector).val(id).trigger('change');
        } else {
            const newOption = new Option(text, id, true, true);
            $(selector).append(newOption).trigger('change');
        }
    }

    // 3. Event Handlers - Plot Pembimbing
    $(document).on('click', '.btn-plot-pembimbing', function () {
        const d = $(this).data();
        $('#plot_id_skripsi').val(d.id);
        $('#plot_nama_mhs').val(`${d.nim} - ${d.nama}`);

        // Pre-populate advisors
        setSelect2Value('#plot_p1', d.p1, d.namaP1);
        setSelect2Value('#plot_p2', d.p2, d.namaP2);

        $('#modal-plot-pembimbing').modal('show');
    });

    $('#form_plot_pembimbing').on('submit', function (e) {
        e.preventDefault();
        const formData = $(this).serialize();

        $.ajax({
            url: CONFIG.api_url + "kaprodi/skripsi/plot-pembimbing",
            type: "POST",
            headers: {
                "Authorization": "Bearer " + CONFIG.token,
                "username": CONFIG.username
            },
            data: formData,
            success: function (res) {
                swal("Berhasil!", res.success, "success");
                $('#modal-plot-pembimbing').modal('hide');
                table.ajax.reload();
            },
            error: function (err) {
                swal("Gagal!", "Terjadi kesalahan saat menyimpan data.", "error");
            }
        });
    });

    // 4. Event Handlers - Plot Sempro
    $(document).on('click', '.btn-plot-sempro', function () {
        $('#sempro_nim').val($(this).data('nim'));
        $('#modal-plot-sempro').modal('show');
    });

    $('#form_plot_sempro').on('submit', function (e) {
        e.preventDefault();
        const formData = $(this).serialize();

        $.ajax({
            url: CONFIG.api_url + "kaprodi/skripsi/plot-jadwal-sempro",
            type: "POST",
            headers: {
                "Authorization": "Bearer " + CONFIG.token,
                "username": CONFIG.username
            },
            data: formData,
            success: function (res) {
                swal("Berhasil!", res.success, "success");
                $('#modal-plot-sempro').modal('hide');
                table.ajax.reload();
            },
            error: function (err) {
                swal("Gagal!", "Pastikan semua data terisi dengan sesuai.", "error");
            }
        });
    });

    // 4b. Event Handlers - Plot Ujian / Sidang Akhir
    $(document).on('click', '.btn-plot-ujian', function () {
        const d = $(this).data();
        const isObe = parseInt(d.isObe) === 1;

        $('#ujian_id_skripsi').val(d.id);
        
        // Reset inputs
        $('#form_plot_ujian')[0].reset();
        $('#ujian_penguji1').val(null).trigger('change');
        $('#ujian_penguji2').val(null).trigger('change');
        $('#ujian_penguji3').val(null).trigger('change');

        // Dynamic labels based on OBE
        if (isObe) {
            $('#modal-plot-ujian-title').text('Jadwal Verifikasi Luaran & Tim Verifikator (OBE)');
            $('#label_penguji1').text('Tim Verifikator 1');
            $('#label_penguji2').text('Tim Verifikator 2');
            $('#label_penguji3').text('Tim Verifikator 3 (Optional)');
        } else {
            $('#modal-plot-ujian-title').text('Jadwal Ujian Sidang Akhir & Dosen Penguji');
            $('#label_penguji1').text('Dosen Penguji 1');
            $('#label_penguji2').text('Dosen Penguji 2');
            $('#label_penguji3').text('Dosen Penguji 3 (Optional)');
        }

        // Fetch current schedule
        $.ajax({
            url: CONFIG.api_url + "kaprodi/skripsi/get-jadwal-ujian/" + d.id,
            type: "GET",
            headers: {
                "Authorization": "Bearer " + CONFIG.token,
                "username": CONFIG.username
            },
            success: function (res) {
                if (res.status === 'success' && res.data) {
                    const u = res.data;
                    $('#form_plot_ujian input[name="tgl_ujian"]').val(u.tanggal_ujian);
                    $('#form_plot_ujian input[name="jam_ujian"]').val(u.jam_mulai ? u.jam_mulai.substring(0,5) : '');
                    $('#form_plot_ujian input[name="ruang_ujian"]').val(u.ruang);

                    if (u.id_penguji1) setSelect2Value('#ujian_penguji1', u.id_penguji1, u.nama_penguji1);
                    if (u.id_penguji2) setSelect2Value('#ujian_penguji2', u.id_penguji2, u.nama_penguji2);
                    if (u.id_penguji3) setSelect2Value('#ujian_penguji3', u.id_penguji3, u.nama_penguji3);
                }
                $('#modal-plot-ujian').modal('show');
            },
            error: function () {
                // Show modal anyway, just with empty fields
                $('#modal-plot-ujian').modal('show');
            }
        });
    });

    $('#form_plot_ujian').on('submit', function (e) {
        e.preventDefault();
        const formData = $(this).serialize();

        $.ajax({
            url: CONFIG.api_url + "kaprodi/skripsi/plot-jadwal-ujian",
            type: "POST",
            headers: {
                "Authorization": "Bearer " + CONFIG.token,
                "username": CONFIG.username
            },
            data: formData,
            success: function (res) {
                swal("Berhasil!", res.success, "success");
                $('#modal-plot-ujian').modal('hide');
                table.ajax.reload();
            },
            error: function (err) {
                swal("Gagal!", "Pastikan semua data terisi dengan sesuai.", "error");
            }
        });
    });

    // Run
    initDataTable();
    initSelect2();

    // 5. Sempro Configuration Logic
    window.openConfigModal = function () {
        const modal = $('#modal-config-sempro');
        
        // Load Current Config
        $.ajax({
            url: CONFIG.api_url + "kaprodi/skripsi/config-sempro/" + CONFIG.kode_prodi,
            type: "GET",
            headers: {
                "Authorization": "Bearer " + CONFIG.token,
                "username": CONFIG.username
            },
            success: function (res) {
                $('#config_skema').val(res.prodi.ta_sempro_skema || 'skripsi').trigger('change');
                
                // Reset select2 and add current mapped MK
                $('#config_mk').empty();
                if (res.mapped_matakuliah) {
                    res.mapped_matakuliah.forEach(mk => {
                        const option = new Option(mk.kode_matakuliah + ' - ' + mk.nama_matakuliah, mk.id_matakuliah, true, true);
                        $('#config_mk').append(option);
                    });
                    $('#config_mk').trigger('change');
                }
                
                modal.modal('show');
            },
            error: function () {
                swal("Gagal!", "Gagal memuat konfigurasi.", "error");
            }
        });
    };

    $('#config_skema').on('change', function() {
        if ($(this).val() === 'matakuliah') {
            $('#section_config_mk').slideDown();
        } else {
            $('#section_config_mk').slideUp();
        }
    });

    // Initialize Select2 for Matakuliah
    $('#config_mk').select2({
        dropdownParent: $('#modal-config-sempro'),
        placeholder: "Cari & Tambah Matakuliah...",
        allowClear: true,
        ajax: {
            url: CONFIG.api_url + "kaprodi/skripsi/search-matakuliah",
            type: "GET",
            headers: {
                "Authorization": "Bearer " + CONFIG.token,
                "username": CONFIG.username
            },
            data: function (params) {
                return { 
                    search: params.term || '',
                    kode_prodi: CONFIG.kode_prodi
                };
            },
            processResults: function (res) {
                return {
                    results: res.map(mk => ({
                        id: mk.id_matakuliah,
                        text: mk.kode_matakuliah + ' - ' + mk.nama_matakuliah
                    }))
                };
            }
        }
    });

    $('#form_config_sempro').on('submit', function (e) {
        e.preventDefault();
        const data = {
            kode_prodi: CONFIG.kode_prodi,
            ta_sempro_skema: $('#config_skema').val(),
            id_matakuliah: $('#config_mk').val()
        };

        $.ajax({
            url: CONFIG.api_url + "kaprodi/skripsi/update-config-sempro",
            type: "POST",
            headers: {
                "Authorization": "Bearer " + CONFIG.token,
                "username": CONFIG.username,
                "Content-Type": "application/json"
            },
            data: JSON.stringify(data),
            success: function (res) {
                swal("Berhasil!", res.success, "success");
                $('#modal-config-sempro').modal('hide');
            },
            error: function (err) {
                swal("Gagal!", "Terjadi kesalahan saat menyimpan konfigurasi.", "error");
            }
        });
    });

    // 6. Grading Configuration Logic
    window.openConfigGradingModal = function () {
        const modal = $('#modal-config-grading');
        $('#list_config_grading').html('<tr><td colspan="3" class="text-center">Memuat konfigurasi...</td></tr>');
        modal.modal('show');

        $.ajax({
            url: CONFIG.api_url + "kaprodi/skripsi/config-grading/" + CONFIG.kode_prodi,
            type: "GET",
            headers: {
                "Authorization": "Bearer " + CONFIG.token,
                "username": CONFIG.username
            },
            success: function (res) {
                if (res.status === 'success' && res.data.length > 0) {
                    let html = '';
                    res.data.forEach(mk => {
                        let selectedObe = parseInt(mk.cpmk_based) === 1 ? 'selected' : '';
                        let selectedNonObe = parseInt(mk.cpmk_based) === 0 ? 'selected' : '';
                        
                        html += `
                            <tr>
                                <td>${mk.kode_matakuliah}</td>
                                <td><strong>${mk.nama_matakuliah}</strong></td>
                                <td class="text-center">
                                    <select class="form-control select-change-grading" data-id="${mk.id_matakuliah}">
                                        <option value="1" ${selectedObe}>Rubrik Indikator Penilaian</option>
                                        <option value="0" ${selectedNonObe}>Nilai Angka Langsung (Tanpa Rubrik)</option>
                                    </select>
                                </td>
                            </tr>
                        `;
                    });
                    $('#list_config_grading').html(html);
                } else {
                    $('#list_config_grading').html('<tr><td colspan="3" class="text-center text-danger">Tidak ada mata kuliah tugas akhir/skripsi ditemukan untuk prodi ini.</td></tr>');
                }
            },
            error: function () {
                $('#list_config_grading').html('<tr><td colspan="3" class="text-center text-danger">Gagal memuat konfigurasi.</td></tr>');
            }
        });
    };

    // Handle change of grading configuration
    $(document).on('change', '.select-change-grading', function () {
        const id_matakuliah = $(this).data('id');
        const cpmk_based = $(this).val();

        $.ajax({
            url: CONFIG.api_url + "kaprodi/skripsi/update-config-grading",
            type: "POST",
            headers: {
                "Authorization": "Bearer " + CONFIG.token,
                "username": CONFIG.username,
                "Content-Type": "application/json"
            },
            data: JSON.stringify({
                id_matakuliah: id_matakuliah,
                cpmk_based: cpmk_based
            }),
            success: function (res) {
                if (res.status === 'success') {
                    swal("Berhasil!", res.message, "success");
                }
            },
            error: function () {
                swal("Gagal!", "Gagal menyimpan konfigurasi metode penilaian.", "error");
            }
        });
    });
});