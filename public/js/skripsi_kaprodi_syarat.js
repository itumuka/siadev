$(document).ready(function () {
    let table;
    let masterSyaratList = [];

    // 1. Fetch Master Syarat once to populate dropdown
    function loadMasterSyarat(callback) {
        $.ajax({
            url: CONFIG.api_url + "kaprodi/skripsi/master-syarat",
            type: "GET",
            headers: {
                "Authorization": "Bearer " + CONFIG.token,
                "username": CONFIG.username
            },
            success: function (res) {
                masterSyaratList = res;
                let html = '<option value="">-- Pilih Master Syarat --</option>';
                res.forEach(item => {
                    html += `<option value="${item.kode_syarat}">${item.kode_syarat} - ${item.nama_syarat} (${item.jenis})</option>`;
                });
                $('#syarat_kode_syarat').html(html);
                
                // Initialize select2
                $('#syarat_kode_syarat').select2({
                    dropdownParent: $('#modal-syarat-prodi'),
                    placeholder: "Pilih Syarat...",
                    allowClear: true
                });

                if (callback) callback();
            },
            error: function () {
                swal("Gagal!", "Gagal memuat master syarat.", "error");
            }
        });
    }

    // 2. Initialize DataTable
    function initDataTable() {
        table = $('#table_kaprodi_syarat').DataTable({
            processing: true,
            ajax: {
                url: CONFIG.api_url + "kaprodi/skripsi/syarat-prodi/" + CONFIG.kode_prodi,
                type: "GET",
                headers: {
                    "Authorization": "Bearer " + CONFIG.token,
                    "username": CONFIG.username
                },
                dataSrc: ""
            },
            columns: [
                { data: null, render: (data, type, row, meta) => meta.row + 1 },
                { 
                    data: null, 
                    render: function (data) {
                        return `<strong>${data.nama_syarat}</strong><br><small class="text-muted">Kode: ${data.kode_syarat} | Jenis: ${data.jenis}</small>`;
                    }
                },
                { 
                    data: 'kode_jenjang',
                    render: function (data) {
                        return `<span class="badge badge-secondary">${data}</span>`;
                    }
                },
                { 
                    data: 'fase',
                    render: function (data) {
                        const phases = {
                            'sempro': '<span class="badge badge-info-light">Seminar Proposal</span>',
                            'ujian': '<span class="badge badge-warning-light">Sidang Akhir</span>'
                        };
                        return phases[data] || data;
                    }
                },
                { 
                    data: null,
                    render: function (data) {
                        if (data.operator === '-' || !data.operator) {
                            return '<span class="text-muted">-</span>';
                        }
                        return `<code>${data.operator} ${data.nilai_target || ''}</code>`;
                    }
                },
                { 
                    data: 'tipe_upload',
                    render: function (data) {
                        const types = {
                            'file': '<i class="fa fa-file-pdf-o text-danger mr-5"></i> File/Dokumen',
                            'url': '<i class="fa fa-link text-info mr-5"></i> URL/Link',
                            'bebas': '<i class="fa fa-pencil text-success mr-5"></i> Bebas'
                        };
                        return types[data] || data;
                    }
                },
                { data: 'petugas_validasi', render: (data) => data || '-' },
                { 
                    data: 'is_wajib',
                    render: function (data) {
                        return parseInt(data) === 1 
                            ? '<span class="badge badge-danger">Wajib</span>' 
                            : '<span class="badge badge-secondary">Opsional</span>';
                    }
                },
                { 
                    data: 'is_aktif',
                    render: function (data) {
                        return parseInt(data) === 1 
                            ? '<span class="badge badge-success">Aktif</span>' 
                            : '<span class="badge badge-danger">Non-Aktif</span>';
                    }
                },
                {
                    data: null,
                    orderable: false,
                    className: 'text-center',
                    render: function (data) {
                        // Store full row data as JSON attribute
                        const rowData = encodeURIComponent(JSON.stringify(data));
                        return `
                            <div class="btn-group">
                                <button class="btn btn-sm btn-info btn-edit-syarat" data-row="${rowData}" title="Edit Syarat">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-danger btn-delete-syarat" data-id="${data.id}" title="Hapus Syarat">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                        `;
                    }
                }
            ]
        });
    }

    // 3. Open Modal - Add Mode
    window.openAddModal = function () {
        $('#form_syarat_prodi')[0].reset();
        $('#syarat_id').val('');
        $('#syarat_kode_syarat').val('').trigger('change');
        
        // Reset defaults
        $('#syarat_kode_jenjang').val('S1');
        $('#syarat_fase').val('sempro');
        $('#syarat_operator').val('-');
        $('#syarat_nilai_target').val('');
        $('#syarat_tipe_upload').val('file');
        $('#syarat_petugas_validasi').val('Petugas Fakultas');
        $('#syarat_urutan').val('1');
        $('#syarat_is_wajib').val('1');
        $('#syarat_is_aktif').val('1');
        $('#syarat_keterangan').val('');

        $('#modal-syarat-title').text('Tambah Konfigurasi Syarat Prodi');
        $('#modal-syarat-prodi').modal('show');
    };

    // 4. Open Modal - Edit Mode
    $(document).on('click', '.btn-edit-syarat', function () {
        const raw = $(this).data('row');
        const data = JSON.parse(decodeURIComponent(raw));

        $('#syarat_id').val(data.id);
        $('#syarat_kode_syarat').val(data.kode_syarat).trigger('change');
        $('#syarat_kode_jenjang').val(data.kode_jenjang);
        $('#syarat_fase').val(data.fase);
        $('#syarat_operator').val(data.operator || '-');
        $('#syarat_nilai_target').val(data.nilai_target || '');
        $('#syarat_tipe_upload').val(data.tipe_upload || 'file');
        $('#syarat_petugas_validasi').val(data.petugas_validasi || 'Petugas Fakultas');
        $('#syarat_urutan').val(data.urutan || 1);
        $('#syarat_is_wajib').val(data.is_wajib);
        $('#syarat_is_aktif').val(data.is_aktif);
        $('#syarat_keterangan').val(data.keterangan || '');

        $('#modal-syarat-title').text('Edit Konfigurasi Syarat Prodi');
        $('#modal-syarat-prodi').modal('show');
    });

    // 5. Submit Form (Save / Update)
    $('#form_syarat_prodi').on('submit', function (e) {
        e.preventDefault();
        
        // Prepare JSON payload or Form Serialization
        const data = {
            id: $('#syarat_id').val(),
            kode_prodi: $('#syarat_kode_prodi').val(),
            kode_syarat: $('#syarat_kode_syarat').val(),
            kode_jenjang: $('#syarat_kode_jenjang').val(),
            fase: $('#syarat_fase').val(),
            operator: $('#syarat_operator').val(),
            nilai_target: $('#syarat_nilai_target').val(),
            tipe_upload: $('#syarat_tipe_upload').val(),
            petugas_validasi: $('#syarat_petugas_validasi').val(),
            urutan: $('#syarat_urutan').val(),
            is_wajib: $('#syarat_is_wajib').val(),
            is_aktif: $('#syarat_is_aktif').val(),
            keterangan: $('#syarat_keterangan').val()
        };

        if (!data.kode_syarat) {
            swal("Peringatan!", "Silakan pilih Syarat Master terlebih dahulu.", "warning");
            return;
        }

        $.ajax({
            url: CONFIG.api_url + "kaprodi/skripsi/save-syarat-prodi",
            type: "POST",
            headers: {
                "Authorization": "Bearer " + CONFIG.token,
                "username": CONFIG.username,
                "Content-Type": "application/json"
            },
            data: JSON.stringify(data),
            success: function (res) {
                swal("Berhasil!", res.success || "Data berhasil disimpan.", "success");
                $('#modal-syarat-prodi').modal('hide');
                table.ajax.reload();
            },
            error: function (xhr) {
                let errorMsg = "Terjadi kesalahan saat menyimpan data.";
                if (xhr.responseJSON && xhr.responseJSON.error) {
                    errorMsg = Array.isArray(xhr.responseJSON.error) 
                        ? xhr.responseJSON.error.join("<br>") 
                        : xhr.responseJSON.error;
                }
                swal("Gagal!", errorMsg, "error");
            }
        });
    });

    // 6. Delete Requirement mapping
    $(document).on('click', '.btn-delete-syarat', function () {
        const id = $(this).data('id');
        
        swal({
            title: "Apakah Anda yakin?",
            text: "Syarat ini akan dihapus dari program studi Anda!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Batal",
            closeOnConfirm: false
        }, function () {
            $.ajax({
                url: CONFIG.api_url + "kaprodi/skripsi/delete-syarat-prodi/" + id,
                type: "DELETE",
                headers: {
                    "Authorization": "Bearer " + CONFIG.token,
                    "username": CONFIG.username
                },
                success: function (res) {
                    swal("Terhapus!", res.success || "Syarat berhasil dihapus.", "success");
                    table.ajax.reload();
                },
                error: function () {
                    swal("Gagal!", "Gagal menghapus syarat.", "error");
                }
            });
        });
    });

    // Run
    loadMasterSyarat(function() {
        initDataTable();
    });
});
