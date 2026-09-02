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

    // Reset form and UI when modal is hidden
    $('#modal-upload-naskah').on('hidden.bs.modal', function () {
        $('#form_upload_naskah')[0].reset();
        $('input[name="file_naskah"]').attr('required', true);
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

    // 0. Handle Expired State
    if (data.is_expired) {
        if (data.tgl_batas_kalender) {
            const dateOptions = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            const formattedDeadline = new Date(data.tgl_batas_kalender).toLocaleDateString('id-ID', dateOptions);
            $('#expired_deadline_text').text(formattedDeadline);
        }
        $('#expired_warning_banner').show();
    } else {
        $('#expired_warning_banner').hide();
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
        
        const luaranLabels = {
            'buku_skripsi': 'Buku Skripsi / Tugas Akhir',
            'jurnal_sinta': 'Publikasi Jurnal SINTA',
            'jurnal_internasional': 'Publikasi Jurnal Internasional',
            'prosiding': 'Publikasi Prosiding Konferensi Ilmiah',
            'paten': 'Paten / Paten Sederhana',
            'hki': 'Hak Cipta / HKI Non-Paten',
            'lainnya': 'Lainnya / Sesuai Kebijakan Prodi'
        };
        const targetLuaranLabel = luaranLabels[data.skripsi.target_luaran] || 'Buku Skripsi / Tugas Akhir';
        $('#ta_target_luaran').text('Target Luaran: ' + targetLuaranLabel);

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
                <button class="btn btn-warning btn-sm font-weight-bold shadow-sm px-15 py-5 mr-5" data-toggle="modal" data-target="#modal-proposal">
                    <i class="fa fa-pencil mr-5"></i> Edit Proposal
                </button>
                <button class="btn btn-success btn-sm font-weight-bold shadow-sm px-15 py-5 mr-10" onclick="$('#form_upload_naskah').attr('data-fase', 'sempro')" data-toggle="modal" data-target="#modal-upload-naskah">
                    <i class="fa fa-upload mr-5"></i> Unggah Naskah
                </button>
            `;
        } else if (status === 'aktif' || status === 'sidang') {
            const fase = status === 'sidang' ? 'ujian' : 'sempro';
            buttons += `
                <button class="btn btn-success btn-sm font-weight-bold shadow-sm px-15 py-5 mr-10" onclick="$('#form_upload_naskah').attr('data-fase', '${fase}')" data-toggle="modal" data-target="#modal-upload-naskah">
                    <i class="fa fa-upload mr-5"></i> Unggah Naskah
                </button>
            `;
        }
        $('#btn_edit_container').html(buttons);

        // 3.1 Render History Naskah
        if (data.sempro && data.sempro.path_file_pdf) {
            const path = data.sempro.path_file_pdf.replace('public/', 'storage/');
            const fileName = path.split('/').pop();
            const fullUrl = CONFIG.api_url.replace('/api', '') + '/' + path;

            $('#label-naskah-terakhir').text(fileName);
            $('#link-naskah-terakhir').attr('href', fullUrl.replace(/([^:]\/)\/+/g, "$1"));
            $('#history-naskah').show();
            // Jika sudah ada file, input tidak wajib (boleh hanya update data lain jika ada)
            // Namun karena ini modal khusus upload, kita tetap biarkan agar mahasiswa tahu bisa upload ulang
            $('input[name="file_naskah"]').removeAttr('required');
        } else {
            $('#history-naskah').hide();
            $('input[name="file_naskah"]').attr('required', true);
        }

        if (status === 'draft' || status === 'menunggu_pembimbing') {
            const form = $('#form_proposal_submit');
            form.find('[name="topik"]').val(data.skripsi.topik);
            form.find('[name="topik_en"]').val(data.skripsi.topik_en);
            form.find('[name="judul"]').val(data.skripsi.judul);
            form.find('[name="judul_en"]').val(data.skripsi.judul_en);
            form.find('[name="abstrak"]').val(data.skripsi.abstrak);
            form.find('[name="abstrak_en"]').val(data.skripsi.abstrak_en);
            form.find('[name="target_luaran"]').val(data.skripsi.target_luaran || 'buku_skripsi');
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
    renderRevisionCard(data);

    // 6. Portfolio CPL (OBE) - Removed/Disabled per leadership request
    // if (data.skripsi && data.skripsi.is_obe == 1) {
    //     loadPortfolioCPL();
    // } else {
    //     $('#box_portfolio_cpl').hide();
    // }
}

function renderTimeline(data) {
    const container = $('#timeline_container');
    container.empty();

    const config = data.config || {};
    const skripsi = data.skripsi || null;
    const bimbingan = data.bimbingan || { total: 0 };
    
    // Check if sempro is disabled
    const semproDisabled = config.ada_sempro == 0 || config.ada_sempro === '0' || config.ada_sempro === 'Tidak';
    const semproLabel = semproDisabled ? 'Seminar Proposal (Tidak Diwajibkan)' : 'Seminar Proposal';

    const steps = [
        { label: 'Pengajuan Proposal', done: skripsi && skripsi.status !== 'draft' },
        { label: 'Ploting Pembimbing', done: !!skripsi?.id_dosen_pembimbing1 },
        // Consider sempro done when either disabled, explicitly 'lulus', or Kaprodi has approved/scheduled it
        { label: semproLabel, done: semproDisabled || (data.sempro && (data.sempro.status === 'disetujui' || data.sempro.status === 'lulus' || data.sempro.tanggal_sempro)), skipped: semproDisabled },
        { label: 'Masa Bimbingan', done: bimbingan.total >= (config.min_bimbingan || 8) },
        { label: 'Sidang Akhir', done: data.ujian && ['lulus', 'tidak_lulus'].includes(data.ujian.status) }
    ];

    // Determine the first uncompleted step as the "active" one
    let activeIndex = steps.findIndex(s => !s.done);
    if (activeIndex === -1) activeIndex = steps.length - 1; // All done

    steps.forEach((step, index) => {
        const isActive = index === activeIndex;
        const dotColor = step.done ? 'bg-success' : (step.skipped ? 'bg-secondary' : (isActive ? 'bg-primary' : 'bg-gray-300'));
        const textColor = (isActive || step.done) ? 'text-dark font-weight-bold' : (step.skipped ? 'text-muted font-italic' : 'text-muted');
        const icon = step.done ? '<i class="fa fa-check"></i>' : (step.skipped ? '<i class="fa fa-minus"></i>' : (index + 1));
        
        const html = `
            <div class="d-flex align-items-center mb-15">
                <div class="w-30 h-30 rounded-circle ${dotColor} text-white text-center l-h-30 z-index-10 shadow-sm">${icon}</div>
                <div class="ml-15 ${textColor}">${step.label}</div>
            </div>
        `;
        container.append(html);
    });
}

function renderExamScheduleCard(schedule) {
    const container = $('#exam_schedule_container');
    if (!schedule) {
        container.hide().empty();
        return;
    }

    // Format date Indonesian style
    const dateOptions = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    const dateFormatted = new Date(schedule.tgl_ujian).toLocaleDateString('id-ID', dateOptions);

    let pengujiHtml = '';
    if (schedule.penguji && schedule.penguji.length > 0) {
        const titleText = schedule.is_obe ? 'Dosen Verifikator (OBE):' : 'Dosen Penguji:';
        pengujiHtml = `<div class="mt-15"><h6 class="font-weight-600 mb-10 text-dark">${titleText}</h6><div class="row">`;
        schedule.penguji.forEach(p => {
            let roleBadge = 'badge-primary';
            if (p.peran.includes('Verifikator 1') || p.peran.includes('Ketua') || p.peran.includes('Penguji 1')) roleBadge = 'badge-info';
            else if (p.peran.includes('Verifikator 2') || p.peran.includes('Penguji 2')) roleBadge = 'badge-secondary';
            else if (p.peran.includes('Verifikator 3') || p.peran.includes('Penguji 3')) roleBadge = 'badge-dark';
            
            pengujiHtml += `
                <div class="col-12 mb-5">
                    <div class="d-flex justify-content-between align-items-center bg-light p-10 rounded">
                        <span class="text-dark font-weight-500 font-size-13">${p.nama}</span>
                        <span class="badge ${roleBadge}">${p.peran}</span>
                    </div>
                </div>
            `;
        });
        pengujiHtml += '</div></div>';
    }

    const html = `
        <div class="box-header with-border">
            <h4 class="box-title"><i class="fa fa-calendar text-primary mr-10"></i> Jadwal Sidang Ujian Akhir</h4>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-12 mb-10">
                    <div class="d-flex align-items-center">
                        <i class="fa fa-calendar-o font-size-18 text-muted mr-15"></i>
                        <div>
                            <span class="text-muted font-size-12">Hari & Tanggal</span>
                            <h6 class="mb-0 font-weight-600 text-dark">${dateFormatted}</h6>
                        </div>
                    </div>
                </div>
                <div class="col-6 mb-10">
                    <div class="d-flex align-items-center">
                        <i class="fa fa-clock-o font-size-18 text-muted mr-15"></i>
                        <div>
                            <span class="text-muted font-size-12">Waktu</span>
                            <h6 class="mb-0 font-weight-600 text-dark">${schedule.jam_mulai || '--:--'} s/d ${schedule.jam_selesai || 'Selesai'}</h6>
                        </div>
                    </div>
                </div>
                <div class="col-6 mb-10">
                    <div class="d-flex align-items-center">
                        <i class="fa fa-map-marker font-size-18 text-muted mr-15"></i>
                        <div>
                            <span class="text-muted font-size-12">Ruangan / Link</span>
                            <h6 class="mb-0 font-weight-600 text-dark">${schedule.ruang || '-'}</h6>
                        </div>
                    </div>
                </div>
            </div>
            ${pengujiHtml}
        </div>
    `;

    container.html(html).fadeIn();
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

    // Render schedule card if extra_data exists, otherwise hide it
    if (cta.extra_data) {
        renderExamScheduleCard(cta.extra_data);
    } else {
        $('#exam_schedule_container').hide().empty();
    }

    if (cta.is_expired) {
        $('#cta_label').html('<span class="text-danger font-weight-bold"><i class="fa fa-ban mr-5"></i>Masa Skripsi Semester Ini Berakhir</span>');
        
        if (cta.perpanjangan_status === 'diajukan') {
            $('#cta_status_only')
                .removeClass('alert-secondary alert-success alert-danger alert-warning alert-info bg-gray-100')
                .addClass('alert-warning')
                .show()
                .html(`
                    <div class="mb-10 text-left font-size-13 text-dark">
                        <i class="fa fa-clock-o text-warning mr-5"></i> Pengajuan perpanjangan masa studi Anda sedang diproses dan menunggu konfirmasi kelunasan keuangan.
                    </div>
                    <button class="btn btn-warning btn-block font-weight-bold py-10 shadow-sm" onclick="openModalStatusPerpanjangan()">
                        <i class="fa fa-hourglass-half mr-5"></i> Cek Status Pengajuan Perpanjangan
                    </button>
                `);
        } else {
            $('#cta_status_only')
                .removeClass('alert-secondary alert-success alert-danger alert-warning alert-info bg-gray-100')
                .addClass('alert-danger')
                .show()
                .html(`
                    <div class="mb-10 text-left font-size-13 text-dark">
                        <i class="fa fa-exclamation-triangle text-danger mr-5"></i> Batas waktu pelaksanaan ujian semester ini telah berakhir.
                    </div>
                    <button class="btn btn-danger btn-block font-weight-bold py-10 shadow animate-up" onclick="openModalAjukanPerpanjangan()">
                        <i class="fa fa-calendar-plus-o mr-5"></i> Ajukan Perpanjangan Masa Studi
                    </button>
                `);
        }
        return;
    }

    if (cta.disabled) {
        // Status only phase - apply dynamic warna
        const warna = cta.warna || 'secondary';
        const iconMap = {
            'success': 'fa-trophy',
            'danger': 'fa-exclamation-triangle',
            'secondary': 'fa-clock-o',
            'warning': 'fa-clock-o',
            'info': 'fa-info-circle'
        };
        const icon = iconMap[warna] || 'fa-clock-o';

        // Apply dynamic color to the status box
        $('#cta_status_only')
            .removeClass('alert-secondary alert-success alert-danger alert-warning alert-info bg-gray-100')
            .addClass(`alert-${warna}`)
            .show()
            .html(`<i class="fa ${icon} mr-5"></i> <span class="status-text">${cta.label}</span>`);

        // Update the label above the button area
        if (warna === 'success') {
            $('#cta_label').html('<span class="text-success"><i class="fa fa-check-circle mr-5"></i>Progres Selesai!</span>');
        } else if (warna === 'danger') {
            $('#cta_label').html('<span class="text-danger"><i class="fa fa-exclamation-circle mr-5"></i>Perhatian</span>');
        } else {
            $('#cta_label').text('Status Progres Saat Ini');
        }
    } else {
        const warna = cta.warna || 'warning';
        $('#cta_label').text('Lanjutkan Progres Anda');
        
        if (cta.url && cta.url.includes('#form-proposal')) {
            // Proposal Modal
            $('#btn_cta_proposal').removeClass('btn-primary btn-warning btn-success btn-info').addClass('btn-' + warna);
            $('#btn_cta_proposal').show().html(`<i class="fa fa-edit mr-10"></i> ${cta.label}`);
        } else if (cta.url && (cta.url.includes('upload-naskah') || (cta.url.includes('seminar') && !cta.url.includes('mahasiswa/skripsi/seminar')) || (cta.url.includes('ujian') && !cta.url.includes('mahasiswa/skripsi/ujian')))) {
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
            
            $('#btn_cta_link').removeClass('btn-primary btn-warning btn-success btn-info btn-danger').addClass('btn-' + warna);
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
    
    // Client-side validation for file size (10MB)
    const fileInput = form.find('input[name="file_naskah"]')[0];
    if (fileInput.files.length > 0) {
        const file = fileInput.files[0];
        if (file.size > 10 * 1024 * 1024) { // 10MB
            swal("Gagal!", "Ukuran file naskah maksimal 10MB.", "error");
            return false;
        }
    }

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

function renderRevisionCard(data) {
    const container = $('#revision_card_container');
    if (!data.ujian || data.ujian.keputusan !== 'lulus_dengan_perbaikan') {
        container.hide().empty();
        return;
    }

    // Tampilkan kartu revisi HANYA jika ujian sudah selesai/dinilai penuh oleh penguji (status: 'menunggu_penetapan', 'ditetapkan', 'lulus', atau BA 'selesai')
    const validRevisionStatuses = ['menunggu_penetapan', 'ditetapkan', 'lulus'];
    if (!validRevisionStatuses.includes(data.ujian.status) && data.ujian.ba_status !== 'selesai' && data.ujian.all_signed != 1) {
        container.hide().empty();
        return;
    }

    const u = data.ujian;
    const dateOptions = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    const dateFormatted = u.batas_revisi ? new Date(u.batas_revisi).toLocaleDateString('id-ID', dateOptions) : 'Tidak ditentukan';

    // Check if student is on OBE path
    const isObe = data.skripsi && data.skripsi.is_obe == 1;

    let luaranInfoHtml = '';
    if (data.luaran) {
        if (isObe) {
            luaranInfoHtml = `
                <div class="mt-15 bg-light p-15 rounded border">
                    <h6 class="font-weight-600 mb-10 text-dark">Informasi Jurnal/Luaran Saat Ini:</h6>
                    <div class="font-size-13 text-dark">
                        <strong>Link Jurnal/Luaran:</strong> 
                        ${data.luaran.url_link ? `<a href="${data.luaran.url_link}" target="_blank" class="text-primary font-weight-bold" style="text-decoration: underline; word-break: break-all;">${data.luaran.url_link}</a>` : '<span class="text-danger">Belum diisi / belum valid</span>'}
                        <br><strong>Judul Publikasi:</strong> ${data.luaran.judul_luaran || '-'}
                        <br><strong>Publisher/Media:</strong> ${data.luaran.nama_media || '-'}
                    </div>
                </div>
            `;
        } else {
            luaranInfoHtml = `
                <div class="mt-15 bg-light p-15 rounded border">
                    <h6 class="font-weight-600 mb-10 text-dark">Link Dokumen / Google Drive Saat Ini:</h6>
                    <div class="font-size-13 text-dark">
                        <strong>Link Google Drive:</strong> 
                        ${data.luaran.url_link ? `<a href="${data.luaran.url_link}" target="_blank" class="text-primary font-weight-bold" style="text-decoration: underline; word-break: break-all;">${data.luaran.url_link}</a>` : '<span class="text-danger">Belum diisi / belum ada</span>'}
                    </div>
                </div>
            `;
        }
    }

    const buttonLabel = isObe ? 'Perbarui Revisi & Link Jurnal / Luaran' : 'Perbarui Revisi & Berkas Ujian';

    const html = `
        <div class="box-header with-border bg-warning-light" style="background-color: #fff3cd; border-bottom: 1px solid #ffeeba;">
            <h4 class="box-title font-weight-bold" style="color: #856404;">
                <i class="fa fa-exclamation-triangle mr-10"></i> Ujian Akhir: Lulus dengan Perbaikan
            </h4>
        </div>
        <div class="box-body">
            <div class="mb-15">
                <span class="text-muted font-size-12 d-block">Tenggat Waktu Perbaikan / Revisi:</span>
                <strong class="text-danger font-size-15"><i class="fa fa-calendar"></i> ${dateFormatted}</strong>
            </div>
            
            <div class="mb-15">
                <span class="text-muted font-size-12 d-block">Catatan / Rekomendasi Perbaikan:</span>
                <div class="p-10 border rounded bg-gray-50 text-dark font-italic font-size-13" style="max-height: 120px; overflow-y: auto; background-color: #fafafa;">
                    ${u.catatan_revisi || 'Tidak ada catatan tertulis.'}
                </div>
            </div>

            ${luaranInfoHtml}

            <div class="mt-20">
                <a href="${CONFIG.app_url}/mahasiswa/skripsi/ujian" class="btn btn-warning btn-block shadow font-weight-bold" style="background-color: #ffb700; border-color: #ffb700; color: #fff;">
                    <i class="fa fa-pencil mr-5"></i> ${buttonLabel}
                </a>
            </div>
        </div>
    `;

    container.html(html).fadeIn();
}

/**
 * ============================================================================
 * MODUL PERPANJANGAN MASA STUDI (TUGAS AKHIR / SKRIPSI)
 * ============================================================================
 */

function getApiUrl(endpoint) {
    const base = CONFIG.api_url ? (CONFIG.api_url.endsWith('/') ? CONFIG.api_url : CONFIG.api_url + '/') : '';
    const cleanEndpoint = endpoint.startsWith('/') ? endpoint.substring(1) : endpoint;
    return base + cleanEndpoint;
}

function openModalAjukanPerpanjangan() {
    $('#clearance_tbody').html('<tr><td colspan="3" class="text-center py-15 text-muted"><i class="fa fa-spin fa-spinner mr-5"></i> Memeriksa data tagihan keuangan perpanjangan...</td></tr>');
    $('#modal-ajukan-perpanjangan').modal('show');

    $.ajax({
        url: getApiUrl('mahasiswa/skripsi/cek-syarat-perpanjangan'),
        type: 'GET',
        data: { nim: CONFIG.nim },
        headers: { 'Authorization': 'Bearer ' + CONFIG.token },
        success: function(res) {
            if (res.status === 'success' && res.data) {
                renderClearanceTable(res.data.clearance);
            }
        },
        error: function(err) {
            $('#clearance_tbody').html('<tr><td colspan="3" class="text-center text-danger py-10">Gagal memuat status prasyarat keuangan. Silakan coba lagi.</td></tr>');
        }
    });
}

function renderClearanceTable(clearance) {
    if (!clearance || !clearance.rincian || clearance.rincian.length === 0) {
        $('#clearance_tbody').html('<tr><td colspan="3" class="text-center text-muted py-10">Tidak ada komponen tagihan khusus yang disyaratkan.</td></tr>');
        return;
    }

    let rows = '';
    clearance.rincian.forEach(function(item) {
        const isLunas = item.status === 'lunas' || item.is_lunas;
        const badgeClass = isLunas ? 'badge-success' : 'badge-danger';
        const iconClass = isLunas ? 'fa-check' : 'fa-times';
        const statusText = isLunas ? 'Lunas' : 'Belum Lunas';

        rows += `
            <tr>
                <td class="font-weight-600 text-dark">${item.label}</td>
                <td class="font-size-12 ${isLunas ? 'text-success' : 'text-danger font-weight-500'}">
                    ${item.keterangan || (isLunas ? 'Sudah Lunas' : 'Menunggak')}
                </td>
                <td class="text-center">
                    <span class="badge ${badgeClass} font-size-11 px-10 py-5">
                        <i class="fa ${iconClass} mr-5"></i> ${statusText}
                    </span>
                </td>
            </tr>
        `;
    });

    $('#clearance_tbody').html(rows);
}

// Submit Form Pengajuan Perpanjangan
$('#form_ajukan_perpanjangan').on('submit', function(e) {
    e.preventDefault();

    const submitBtn = $('#btn_submit_perpanjangan');
    submitBtn.prop('disabled', true).html('<i class="fa fa-spin fa-spinner mr-5"></i> Menyimpan...');

    const payload = {
        nim: CONFIG.nim,
        alasan_perpanjangan: $('#perp_alasan').val(),
        progress_terakhir: $('#perp_progress').val(),
        target_selesai: $('#perp_target').val()
    };

    $.ajax({
        url: getApiUrl('mahasiswa/skripsi/ajukan-perpanjangan'),
        type: 'POST',
        data: payload,
        headers: { 'Authorization': 'Bearer ' + CONFIG.token },
        success: function(res) {
            submitBtn.prop('disabled', false).html('<i class="fa fa-paper-plane mr-5"></i> Kirim Pengajuan Perpanjangan');
            $('#modal-ajukan-perpanjangan').modal('hide');

            if (res.status === 'success') {
                swal({
                    title: "Pengajuan Terkirim!",
                    text: res.message,
                    type: res.data.status_final === 'disetujui' ? "success" : "info",
                    confirmButtonClass: "btn-primary"
                }, function() {
                    initDashboard();
                });
            }
        },
        error: function(err) {
            submitBtn.prop('disabled', false).html('<i class="fa fa-paper-plane mr-5"></i> Kirim Pengajuan Perpanjangan');
            let msg = 'Terjadi kesalahan saat menyimpan pengajuan perpanjangan.';
            if (err.responseJSON && err.responseJSON.error) {
                if (typeof err.responseJSON.error === 'object') {
                    msg = Object.values(err.responseJSON.error).flat().join('<br>');
                } else {
                    msg = err.responseJSON.error;
                }
            }
            swal("Gagal", msg, "error");
        }
    });
});

function openModalStatusPerpanjangan() {
    $.ajax({
        url: getApiUrl('mahasiswa/skripsi/cek-syarat-perpanjangan'),
        type: 'GET',
        data: { nim: CONFIG.nim },
        headers: { 'Authorization': 'Bearer ' + CONFIG.token },
        success: function(res) {
            if (res.status === 'success' && res.data && res.data.pengajuan_aktif) {
                const p = res.data.pengajuan_aktif;
                const statusKeuangan = p.status_keuangan || 'pending';
                const statusFinal = p.status_final || 'diajukan';

                if (statusKeuangan === 'lunas') {
                    $('#status_perp_keuangan').removeClass('badge-warning badge-danger').addClass('badge-success').text('Lunas Terverifikasi');
                } else if (statusKeuangan === 'ditolak') {
                    $('#status_perp_keuangan').removeClass('badge-warning badge-success').addClass('badge-danger').text('Ditolak');
                } else {
                    $('#status_perp_keuangan').removeClass('badge-success badge-danger').addClass('badge-warning').text('Pending / Menunggu Pembayaran');
                }

                if (statusFinal === 'disetujui') {
                    $('#status_perp_final').removeClass('badge-secondary badge-warning').addClass('badge-success').text('Aktif / Disetujui');
                } else {
                    $('#status_perp_final').removeClass('badge-success').addClass('badge-warning').text('Dalam Proses');
                }

                const createdDate = p.created_at ? new Date(p.created_at).toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' }) : '-';
                $('#status_perp_tgl').text(createdDate);
                $('#status_perp_catatan').text(p.catatan_keuangan || 'Belum ada catatan dari bagian keuangan.');

                $('#modal-status-perpanjangan').modal('show');
            } else {
                openModalAjukanPerpanjangan();
            }
        },
        error: function(err) {
            swal("Error", "Gagal memuat status pengajuan perpanjangan.", "error");
        }
    });
}