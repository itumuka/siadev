$(document).ready(function() {
    let tableSiap, tableRiwayat;

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

    // 1. Initialize Tables
    function initTables() {
        tableSiap = $('#table_siap_sk').DataTable({
            processing: true,
            dom: 'lBfrtip',
            buttons: [
                {
                    text: '<i class="fa fa-check-square-o"></i> Pilih Semua',
                    className: 'btn btn-sm btn-success',
                    action: function(e, dt) { dt.rows().select(); }
                },
                {
                    text: '<i class="fa fa-square-o"></i> Batal Pilih',
                    className: 'btn btn-sm btn-danger',
                    action: function(e, dt) { dt.rows().deselect(); }
                }
            ],
            ajax: {
                url: CONFIG.api_url + "kaprodi/skripsi/list-siap-sk",
                type: "GET",
                headers: { "Authorization": "Bearer " + CONFIG.token, "username": CONFIG.username },
                data: function(d) {
                    d.kode_prodi = CONFIG.kode_prodi;
                    d.angkatan = $('#filter_angkatan').val();
                    d.tahun = CONFIG.tahun;
                    d.semester = CONFIG.semester;
                    return d;
                },
                dataSrc: ""
            },
            columnDefs: [{
                orderable: false,
                className: 'select-checkbox',
                targets: 0
            }],
            select: {
                style: 'multi',
                selector: 'td:first-child'
            },
            columns: [
                { 
                    data: null, 
                    render: function() { return ''; } 
                },
                { data: 'nim' },
                { data: 'nama_mhs' },
                { data: 'tahun_angkatan' },
                {
                    data: 'judul',
                    render: function(data) {
                        const display = truncateText(data, 200);
                        return '<span title="' + escapeAttr(data || '-') + '">' + display + '</span>';
                    }
                },
                { data: 'nama_pembimbing1' },
                { data: 'nama_pembimbing2' }
            ],
            drawCallback: function() {
                const api = this.api();
                $('#count_siap_sk').text(api.rows().count());
                
                // Update bulk button state using API instance to avoid undefined tableSiap during init
                const count = api.rows({ selected: true }).count();
                $('#count_checked').text(count);
                $('#btn-bulk-sk').prop('disabled', count === 0);
            }
        });

        tableSiap.on('select deselect', function() {
            updateBulkButton();
        });

        tableRiwayat = $('#table_riwayat_sk').DataTable({
            processing: true,
            ajax: {
                url: CONFIG.api_url + "kaprodi/skripsi/list-sk-terbit",
                type: "GET",
                headers: { "Authorization": "Bearer " + CONFIG.token, "username": CONFIG.username },
                data: { kode_prodi: CONFIG.kode_prodi },
                dataSrc: ""
            },
            columns: [
                { data: 'no_sk', render: d => `<strong>${d}</strong>` },
                { data: 'tgl_sk' },
                { data: 'perihal' },
                { 
                    data: 'id', 
                    render: function(id, type, row) {
                        return `
                            <a href="javascript:void(0)" class="btn btn-sm btn-info" onclick="openPrintModal('${id}', 'sk')" title="Cetak SK">
                                <i class="fa fa-file-text"></i> SK
                            </a>
                            <a href="javascript:void(0)" class="btn btn-sm btn-primary" onclick="openPrintModal('${id}', 'st')" title="Cetak Surat Tugas">
                                <i class="fa fa-print"></i> Surat Tugas
                            </a>
                            <a href="javascript:void(0)" class="btn btn-sm btn-warning" onclick="openEditSkModal('${id}', '${row.no_sk}', '${row.no_surat_tugas || ''}')" title="Edit Nomor SK">
                                <i class="fa fa-pencil"></i> Edit
                            </a>
                        `;
                    }
                }
            ]
        });
    }

    // Global functions for onclick handlers
    window.openPrintModal = function(id, type) {
        let url = "";
        if (type === 'sk') {
            url = CONFIG.app_url + "/dekanat/skripsi/cetak-sk/" + id;
        } else {
            url = CONFIG.app_url + "/dekanat/skripsi/cetak-surat-tugas/" + id;
        }

        $("#printff").attr("src", url);
    }; 
    
    window.openEditSkModal = function(id, no_sk, no_surat_tugas) {
        $('#edit_sk_id').val(id);
        $('#edit_no_sk').val(no_sk);
        $('#edit_no_surat_tugas').val(no_surat_tugas);
        $('#modal-edit-sk').modal('show');
    };

    $('#form_edit_sk').on('submit', function(e) {
        e.preventDefault();
        const formData = $(this).serialize();

        $.ajax({
            url: CONFIG.api_url + "kaprodi/skripsi/update-sk",
            type: "POST",
            headers: { "Authorization": "Bearer " + CONFIG.token, "username": CONFIG.username },
            data: formData,
            success: function(res) {
                swal("Berhasil!", res.success, "success");
                $('#modal-edit-sk').modal('hide');
                tableRiwayat.ajax.reload(null, false);
            },
            error: function(err) {
                swal("Gagal!", "Pastikan semua data terisi dengan sesuai.", "error");
            }
        });
    });

    function updateBulkButton() {
        if (!tableSiap) return;
        const count = tableSiap.rows({ selected: true }).count();
        $('#count_checked').text(count);
        $('#btn-bulk-sk').prop('disabled', count === 0);
    }

    // 3. Issue SK
    $('#btn-bulk-sk').on('click', function() {
        const count = tableSiap.rows({ selected: true }).count();
        $('#text_count_selected').text(count);
        
        $('#issue_tahun_akademik').val(CONFIG.tahun);
        $('#issue_semester').val(CONFIG.semester == 1 ? 'Gasal' : 'Genap');
        $('#issue_tgl_sk').val(new Date().toISOString().split('T')[0]);
        $('#issue_kode_prodi').val(CONFIG.kode_prodi);
        $('#modal-issue-sk').modal('show');
    });

    $('#form_issue_sk').on('submit', function(e) {
        e.preventDefault();
        
        let selectedIds = tableSiap.rows({ selected: true }).data().toArray().map(row => row.id_skripsi);

        const formData = {
            no_sk: $('input[name="no_sk"]').val(),
            no_surat_tugas: $('input[name="no_surat_tugas"]').val(),
            tgl_sk: $('input[name="tgl_sk"]').val(),
            tahun_akademik: $('input[name="tahun_akademik"]').val(),
            semester: $('input[name="semester"]').val(),
            perihal: $('textarea[name="perihal"]').val(),
            kode_prodi: $('input[name="kode_prodi"]').val(),
            id_skripsi: selectedIds
        };

        $.ajax({
            url: CONFIG.api_url + "kaprodi/skripsi/issue-sk-kolektif",
            type: "POST",
            headers: { "Authorization": "Bearer " + CONFIG.token, "username": CONFIG.username },
            contentType: "application/json",
            data: JSON.stringify(formData),
            success: function(res) {
                swal("Berhasil!", res.success, "success");
                $('#modal-issue-sk').modal('hide');
                tableSiap.ajax.reload();
                tableRiwayat.ajax.reload();
                $('#check_all').prop('checked', false);
            },
            error: function(err) {
                swal("Gagal!", "Pastikan semua data terisi dengan sesuai.", "error");
            }
        });
    });

    // 4. Initialization
    function init() {
        initTables();
        tampilan_angkatan();
    }

    function tampilan_angkatan() {
        $.ajax({
            type: 'GET',
            url: CONFIG.api_url + "akademik/tampiltahunangkatan",
            headers: { "Authorization": 'Bearer ' + CONFIG.token, "username": CONFIG.username },
            success: function(result) {
                let html = '<option value="">- Semua Angkatan -</option>';
                result.forEach(item => {
                    html += `<option value="${item.tahun_angkatan}">${item.tahun_angkatan}</option>`;
                });
                $('#filter_angkatan').html(html);
            }
        });
    }

    init();

    // 5. Filter Logic
    $('#filter_angkatan').on('change', function() {
        tableSiap.ajax.reload();
    });
});