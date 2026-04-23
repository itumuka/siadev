$(document).ready(function () {
    let table;

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
                    kode_prodi: CONFIG.kode_prodi
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
                        return `<strong>${data.topik || '-'}</strong><br><small>${data.judul || '-'}</small>`;
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
                                <button class="btn btn-sm btn-success btn-plot-sempro" data-nim="${data.nim}" title="Jadwal Sempro">
                                    <i class="fa fa-calendar"></i>
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

    // Run
    initDataTable();
    initSelect2();
});