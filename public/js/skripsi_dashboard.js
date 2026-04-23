/**
 * Skripsi Dashboard Core Logic
 * Handles dynamic UI rendering and API interactions
 */

$(document).ready(function () {
    initDashboard();

    // Standardized Form Submission
    $('#form_proposal_submit').on('submit', function (e) {
        e.preventDefault();
        saveProposal($(this));
    });

    $('#form_upload_naskah').on('submit', function (e) {
        e.preventDefault();
        uploadNaskah($(this));
    });
});

async function initDashboard() {
    toggleLoading(true);
    try {
        const response = await fetch(`${CONFIG.api_url}mahasiswa/skripsi/dashboard?nim=${CONFIG.nim}`, {
            headers: {
                'Authorization': `Bearer ${CONFIG.token}`,
                'username': CONFIG.username,
                'Accept': 'application/json'
            }
        });
        const result = await response.json();

        if (result.status === 'success' && result.data) {
            renderDashboard(result.data);
        } else {
            showError('Dashboard tidak dapat dimuat: ' + (result.message || result.error || 'Terjadi kesalahan sistem'));
        }
    } catch (error) {
        console.error('Fetch error:', error);
        showError('Koneksi ke server API bermasalah. Pastikan Anda terhubung ke jaringan.');
    } finally {
        toggleLoading(false);
    }
}

function renderDashboard(data) {
    if (!data || !data.mhs) {
        showError('Format data dari server tidak sesuai.');
        return;
    }

    // 1. Header & Profile
    $('#mhs_nama').text(data.mhs.nama || 'Mahasiswa');
    $('#ta_name_header').text(data.config?.nama_ta || 'Tugas Akhir');
    $('#min_bimbingan').text(data.config?.min_bimbingan || 0);

    // 2. Academic Stats
    $('#stat_sks').text(data.akademik?.total_sks || 0);
    $('#stat_ipk').text(data.akademik?.ipk || '0.00');

    // 3. Thesis Details
    if (data.skripsi) {
        $('#ta_judul').text(data.skripsi.judul).removeClass('text-muted');
        $('#ta_topik').text('Topik: ' + (data.skripsi.topik || '-'));
        $('#ta_pembimbing1').text(data.skripsi.nama_pembimbing1 || 'Menunggu Ploting...');
        $('#ta_pembimbing2').text(data.skripsi.nama_pembimbing2 || '-');
        
        const badge = $('#status_skripsi_badge').attr('class', 'badge');
        const status = data.skripsi.status || 'draft';
        
        if (status === 'lulus') badge.addClass('badge-success').text('LULUS');
        else if (status === 'aktif') badge.addClass('badge-primary').text('BIMBINGAN AKTIF');
        else if (status === 'sidang') badge.addClass('badge-warning').text('SIDANG AKHIR');
        else badge.addClass('badge-info').text(status.toUpperCase());

        // Action Buttons in Header
        let buttons = '';
        if (status === 'draft' || status === 'menunggu_pembimbing') {
            buttons += `
                <button class="btn btn-xs btn-outline btn-warning mr-5" data-toggle="modal" data-target="#modal-proposal">
                    <i class="fa fa-pencil mr-5"></i> Edit Proposal
                </button>
                <button class="btn btn-xs btn-outline btn-success mr-10" onclick="$('#form_upload_naskah').attr('data-fase', 'sempro')" data-toggle="modal" data-target="#modal-upload-naskah">
                    <i class="fa fa-upload mr-5"></i> Unggah PDF
                </button>
            `;
        } else if (status === 'aktif' || status === 'sidang') {
            const fase = status === 'sidang' ? 'ujian' : 'sempro';
            buttons += `
                <button class="btn btn-xs btn-outline btn-success mr-10" onclick="$('#form_upload_naskah').attr('data-fase', '${fase}')" data-toggle="modal" data-target="#modal-upload-naskah">
                    <i class="fa fa-upload mr-5"></i> Unggah Naskah (${fase.toUpperCase()})
                </button>
            `;
        }
        $('#btn_edit_container').html(buttons);

        if (status === 'draft' || status === 'menunggu_pembimbing') {
            const form = $('#form_proposal_submit');
            form.find('[name="topik"]').val(data.skripsi.topik);
            form.find('[name="topik_en"]').val(data.skripsi.topik_en);
            form.find('[name="judul"]').val(data.skripsi.judul);
            form.find('[name="judul_en"]').val(data.skripsi.judul_en);
            form.find('[name="abstrak"]').val(data.skripsi.abstrak);
            form.find('[name="abstrak_en"]').val(data.skripsi.abstrak_en);
        }
    } else {
        $('#ta_judul').text('Belum ada judul yang diajukan.').addClass('text-muted');
        $('#status_skripsi_badge').addClass('badge-secondary').text('MASA PENGAJUAN');
        $('#btn_edit_container').empty();
    }

    // 4. Bimbingan Progress
    const bTotal = data.bimbingan?.total || 0;
    const bMin = data.config?.min_bimbingan || 1;
    $('#bimbingan_count').text(`${bTotal}/${bMin}`);
    $('#bimbingan_progress_bar').css('width', (data.bimbingan?.persen || 0) + '%');

    // 5. Lifecycle
    renderTimeline(data);
    renderCTA(data.cta);
}

function renderTimeline(data) {
    const container = $('#timeline_container');
    container.empty();

    const config = data.config || {};
    const skripsi = data.skripsi || null;
    const bimbingan = data.bimbingan || { total: 0 };

    const steps = [
        { label: 'Pengajuan Proposal', done: skripsi && skripsi.status !== 'draft' },
        { label: 'Ploting Pembimbing', done: !!skripsi?.id_dosen_pembimbing1 },
        { label: 'Seminar Proposal', done: (config.ada_sempro == 0) || (data.sempro && data.sempro.status === 'lulus') },
        { label: 'Masa Bimbingan', done: bimbingan.total >= (config.min_bimbingan || 8) },
        { label: 'Sidang Akhir', done: data.ujian && data.ujian.status === 'lulus' }
    ];

    // Determine the first uncompleted step as the "active" one
    let activeIndex = steps.findIndex(s => !s.done);
    if (activeIndex === -1) activeIndex = steps.length - 1; // All done

    steps.forEach((step, index) => {
        const isActive = index === activeIndex;
        const dotColor = step.done ? 'bg-success' : (isActive ? 'bg-primary' : 'bg-gray-300');
        const textColor = (isActive || step.done) ? 'text-dark font-weight-bold' : 'text-muted';
        const icon = step.done ? '<i class="fa fa-check"></i>' : (index + 1);
        
        const html = `
            <div class="d-flex align-items-center mb-15">
                <div class="w-30 h-30 rounded-circle ${dotColor} text-white text-center l-h-30 z-index-10 shadow-sm">${icon}</div>
                <div class="ml-15 ${textColor}">${step.label}</div>
            </div>
        `;
        container.append(html);
    });
}

function renderCTA(cta) {
    const actions = $('#cta_actions');
    const loading = $('#cta_default');

    if (!cta) {
        loading.html('<div class="alert alert-info">Dashboard siap digunakan. Silakan ikuti petunjuk progres Anda.</div>');
        return;
    }

    loading.hide();
    actions.show();

    $('#btn_cta_link, #btn_cta_proposal, #btn_cta_upload, #cta_status_only').hide();

    if (cta.disabled) {
        // Status only phase
        $('#cta_status_only').show().find('.status-text').text(cta.label);
        $('#cta_label').text('Status Progres Saat Ini');
        const warna = cta.warna || 'warning';
        $('#cta_label').text('Lanjutkan Progres Anda');
        
        if (cta.url && cta.url.includes('#form-proposal')) {
            // Proposal Modal
            $('#btn_cta_proposal').removeClass('btn-primary btn-warning btn-success btn-info').addClass('btn-' + warna);
            $('#btn_cta_proposal').show().html(`<i class="fa fa-edit mr-10"></i> ${cta.label}`);
        } else if (cta.url && (cta.url.includes('upload-naskah') || cta.url.includes('seminar') || cta.url.includes('ujian'))) {
            // Upload Modal
            const fase = cta.url.includes('seminar') ? 'sempro' : 'ujian';
            $('#btn_cta_upload').removeClass('btn-primary btn-warning btn-success btn-info').addClass('btn-' + warna);
            $('#btn_cta_upload').show().html(`<i class="fa fa-upload mr-10"></i> ${cta.label}`)
                               .attr('onclick', `$('#form_upload_naskah').attr('data-fase', '${fase}'); $('#modal-upload-naskah').modal('show')`);
        } else if (cta.url && cta.url !== '#') {
            // Normal Link (Payment or Bimbingan)
            const baseUrl = CONFIG.app_url.replace(/\/$/, ''); // Remove trailing slash
            const relativeUrl = cta.url.replace(/^\//, ''); // Remove leading slash
            const absoluteUrl = cta.url.startsWith('http') ? cta.url : `${baseUrl}/${relativeUrl}`;
            
            $('#btn_cta_link').removeClass('btn-primary btn-warning btn-success btn-info').addClass('btn-' + warna);
            $('#btn_cta_link').show().attr('href', absoluteUrl).find('.label-text').text(cta.label);
            
            // Adjust icon based on context
            const iconClass = cta.url.includes('statuspembayaran') ? 'fa-credit-card' : 'fa-arrow-right';
            $('#btn_cta_link').find('i').attr('class', `fa ${iconClass} mr-10`);
        } else {
             $('#cta_status_only').show().find('.status-text').text(cta.label);
        }
    }
}

async function saveProposal(form) {
    const btn = $('#btn_simpan_proposal');
    const originalText = btn.html();
    btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');

    const formData = new FormData(form[0]);
    formData.append('nim', CONFIG.nim);

    try {
        const response = await fetch(`${CONFIG.api_url}mahasiswa/skripsi/simpan-proposal`, {
            method: 'POST',
            headers: {
                'Authorization': `Bearer ${CONFIG.token}`,
                'username': CONFIG.username,
                'Accept': 'application/json'
            },
            body: formData
        });
        const result = await response.json();

        if (result.success) {
            swal("Berhasil!", result.success, "success");
            $('#modal-proposal').modal('hide');
            initDashboard();
        } else {
            const errorMsg = typeof result.error === 'object' ? Object.values(result.error).join('<br>') : result.error;
            swal("Gagal!", errorMsg, "error");
        }
    } catch (error) {
        swal("Error", "Gagal menghubungi server API", "error");
    } finally {
        btn.prop('disabled', false).html(originalText);
    }
}

async function uploadNaskah(form) {
    const btn = $('#btn_submit_naskah');
    btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Mengunggah...');

    const fase = form.attr('data-fase') || 'sempro';
    const formData = new FormData(form[0]);
    formData.append('nim', CONFIG.nim);
    formData.append('fase', fase);

    try {
        const response = await fetch(`${CONFIG.api_url}mahasiswa/skripsi/upload-naskah`, {
            method: 'POST',
            headers: {
                'Authorization': `Bearer ${CONFIG.token}`,
                'username': CONFIG.username,
                'Accept': 'application/json'
            },
            body: formData
        });
        const result = await response.json();

        if (result.success) {
            swal("Berhasil!", result.success, "success");
            $('#modal-upload-naskah').modal('hide');
            form[0].reset();
            initDashboard();
        } else {
            swal("Gagal!", result.error, "error");
        }
    } catch (error) {
        swal("Error", "Gagal menghubungi server API", "error");
    } finally {
        btn.prop('disabled', false).html('<i class="fa fa-upload mr-5"></i> Unggah Sekarang');
    }
}

function toggleLoading(show) {
    if (show) {
        $('#skripsi_skeleton').show();
        $('#skripsi_content').hide();
    } else {
        $('#skripsi_skeleton').hide();
        $('#skripsi_content').fadeIn();
    }
}

function showError(msg) {
    toggleLoading(false);
    $('#skripsi_skeleton').html(`
        <div class="col-12">
            <div class="alert alert-danger text-center">
                <h5><i class="icon fa fa-ban"></i> Masalah Dashboard</h5>
                <p>${msg}</p>
                <br><button class="btn btn-default mt-10" onclick="initDashboard()">Coba Muat Ulang</button>
            </div>
        </div>
    `).show();
}