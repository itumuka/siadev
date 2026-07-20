@extends('layout')

@section('css')
    <style>
        th, td {
            white-space: nowrap;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            border-radius: 8px;
            border: 1px solid rgba(0, 0, 0, 0.08);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }
        .signature-badge {
            font-size: 0.8rem;
            padding: 4px 8px;
            border-radius: 4px;
            font-weight: 600;
            display: inline-block;
        }
        .signature-signed {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .signature-pending {
            background-color: #fff3cd;
            color: #856404;
            border: 1px solid #ffeeba;
        }
        .score-box {
            background: #f8f9fa;
            border-radius: 6px;
            padding: 15px;
            border: 1px dashed #dee2e6;
            text-align: center;
        }
    </style>
@endsection

@section('content')
    <div class="container-full">
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">{{ $title }}</h3>
                    <div class="d-inline-block align-items-center">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                                <li class="breadcrumb-item"><a href="{{ route('kpskripsi_index') }}">{{ $parent_breadcrumb }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $child_breadcrumb }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="box glass-card">
                <div class="box-header with-border">
                    <h4 class="box-title">Sidang Skripsi: Penetapan Kelulusan & Nilai Akhir</h4>
                    <div class="box-controls pull-right">
                        <a href="{{ route('kpskripsi_index') }}" class="btn btn-sm btn-secondary">
                            <i class="fa fa-arrow-left mr-5"></i> Kembali
                        </a>
                    </div>
                    <h6 class="box-subtitle">Berikut adalah daftar ujian skripsi mahasiswa di program studi Anda yang telah diinput nilainya. Kaprodi dapat meresmikan/menetapkan kelulusan mahasiswa ke transkrip nilai setelah ditandatangani secara digital oleh ketiga Dosen Penguji.</h6>
                </div>

                <div class="box-body">
                    <div class="box-body ribbon-box bg-light mb-4">
                        <div class="ribbon ribbon-info">Ketentuan Alur Penetapan</div>
                        <p class="mb-0 text-dark font-weight-medium">
                            <i class="fa fa-info-circle text-info"></i> Kaprodi memegang otoritas untuk meresmikan nilai ujian skripsi menjadi nilai transkrip akhir. Tombol <strong>"Tetapkan Nilai"</strong> hanya akan aktif apabila <strong>Ketiga Dosen Penguji</strong> sudah membubuhkan tanda tangan digital (menyetujui Berita Acara).
                        </p>
                    </div>

                    <div class="table-responsive">
                        <table id="tb_penetapan_kaprodi" class="table table-hover table-bordered table-sm" width="100%">
                            <thead class="bg-dark">
                                <tr>
                                    <th>NIM</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>Judul Skripsi</th>
                                    <th class="text-center">Tanggal Ujian</th>
                                    <th class="text-center">Nilai Angka</th>
                                    <th class="text-center">Nilai Huruf</th>
                                    <th class="text-center">TTD Penguji (1 / 2 / 3)</th>
                                    <th class="text-center">Status Ujian</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Loaded dynamically via DataTable -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Modal Tinjau & Tetapkan Nilai -->
    <div class="modal fade" id="modal_tetapkan_nilai" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title font-weight-bold">Penetapan Nilai Akhir & Berita Acara Sidang</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-light">
                    <!-- Info Mahasiswa Header Card -->
                    <div class="card card-body border-0 shadow-sm mb-4">
                        <div class="row">
                            <div class="col-md-4 border-right">
                                <span class="text-muted text-uppercase font-weight-bold small">Mahasiswa</span>
                                <h5 id="ba_mhs_nama" class="font-weight-bold mb-1 text-primary"></h5>
                                <span id="ba_mhs_nim" class="font-weight-bold text-muted"></span>
                            </div>
                            <div class="col-md-8">
                                <span class="text-muted text-uppercase font-weight-bold small">Judul Skripsi / Tugas Akhir</span>
                                <p id="ba_mhs_judul" class="font-italic text-dark mb-0"></p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Left: Rubric & Score Breakdowns -->
                        <div class="col-lg-8">
                            <div class="card border-0 shadow-sm mb-4">
                                <div class="card-header bg-white font-weight-bold text-dark" id="cpmk_card_title">
                                    <i class="fa fa-table text-primary"></i> Rincian Penilaian Indikator dari Ketiga Penguji
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-sm text-center" id="table_cpmk_breakdown">
                                            <thead class="bg-secondary text-white">
                                                <tr>
                                                    <th class="text-left" id="cpmk_th_title">Kriteria Rubrik Penilaian</th>
                                                    <th>Bobot</th>
                                                    <th>Penguji 1</th>
                                                    <th>Penguji 2</th>
                                                    <th>Penguji 3</th>
                                                    <th>Rata-rata</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody_cpmk_breakdown">
                                                <!-- Populated dynamically -->
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="mt-3">
                                        <label class="font-weight-bold text-dark">Catatan Perbaikan / Rekomendasi Ujian:</label>
                                        <div class="p-3 bg-white border rounded text-muted font-italic" id="ba_catatan" style="min-height: 60px;">
                                            Tidak ada catatan perbaikan.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right: Final Score & Signature Status -->
                        <div class="col-lg-4">
                            <div class="card border-0 shadow-sm mb-4">
                                <div class="card-header bg-white font-weight-bold text-dark text-center">
                                    <i class="fa fa-calculator text-primary"></i> Nilai Akhir Konsolidasi
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6 pr-1">
                                            <div class="score-box">
                                                <small class="text-muted text-uppercase d-block">Angka</small>
                                                <span class="font-weight-bold text-primary" style="font-size: 2rem;" id="ba_nilai_angka">0.00</span>
                                            </div>
                                        </div>
                                        <div class="col-6 pl-1">
                                            <div class="score-box">
                                                <small class="text-muted text-uppercase d-block">Huruf</small>
                                                <span class="font-weight-bold text-success" style="font-size: 2rem;" id="ba_nilai_huruf">-</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center mt-3">
                                        <span class="badge px-3 py-2 font-weight-bold text-uppercase" id="ba_kelulusan_badge">MENUNGGU PENETAPAN</span>
                                    </div>
                                </div>
                            </div>

                            <div class="card border-0 shadow-sm">
                                <div class="card-header bg-white font-weight-bold text-dark">
                                    <i class="fa fa-pencil text-primary"></i> Verifikasi Tanda Tangan Penguji
                                </div>
                                <div class="card-body">
                                    <div class="list-group list-group-flush" id="list_signature_status">
                                        <!-- Populated dynamically -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-white d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <div>
                        <button type="button" class="btn btn-info mr-2" id="btn_modal_print"><i class="fa fa-print"></i> Cetak Berita Acara</button>
                        <span id="action_button_container">
                            <!-- Populated dynamically -->
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script-master')
    <script type="text/javascript">
        $(document).ready(function() {
            var token = "{{ $api_token }}";
            var userlogin = "{{ $session_nim }}";
            var kode_prodi = "{{ $session_kode_program_studi }}";
            var activeUjianData = null;

            function formatDateTime(dateTimeStr) {
                if (!dateTimeStr) return null;
                try {
                    const dt = new Date(dateTimeStr);
                    if (isNaN(dt.getTime())) return null;
                    return dt.toLocaleString('id-ID', {
                        day: 'numeric',
                        month: 'long',
                        year: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit',
                        second: '2-digit'
                    }) + ' WIB';
                } catch (e) {
                    return null;
                }
            }

            function getStatusTtdBadge(ttdTime) {
                if (ttdTime) {
                    return `<span class="badge badge-success" title="Sudah TTD pada ${formatDateTime(ttdTime)}"><i class="fa fa-check"></i> Sudah TTD</span>`;
                }
                return '<span class="badge badge-warning" title="Belum menyetujui"><i class="fa fa-clock-o"></i> Belum TTD</span>';
            }

            function getRoleLabel(role, isObe) {
                if (isObe) {
                    if (role === 'penguji1') return 'Verifikator 1 (Utama)';
                    if (role === 'penguji2') return 'Verifikator 2';
                    if (role === 'ketua' || role === 'penguji3') return 'Ketua Tim Verifikasi';
                    return 'Tim Verifikator';
                } else {
                    if (role === 'penguji1') return 'Dosen Penguji 1';
                    if (role === 'penguji2') return 'Dosen Penguji 2';
                    if (role === 'ketua' || role === 'penguji3') return 'Ketua Penguji / Sidang';
                    return 'Dosen Penguji';
                }
            }

            // Initialize Table
            var table = $("#tb_penetapan_kaprodi").DataTable({
                destroy: true,
                processing: true,
                serverSide: false,
                ajax: {
                    type: "GET",
                    url: "{{ $api_url }}kaprodi/skripsi/penetapan-nilai",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    data: { kode_prodi: kode_prodi },
                    dataSrc: function(json) {
                        return json || [];
                    }
                },
                columns: [
                    { data: 'nim' },
                    { data: 'nama_mhs' },
                    { 
                        data: 'judul',
                        render: function(data) {
                            return '<strong title="' + (data || '') + '">' + 
                                   (data && data.length > 50 ? data.substring(0, 50) + '...' : (data || '-')) + 
                                   '</strong>';
                        }
                    },
                    { 
                        data: 'tanggal_ujian',
                        className: 'text-center',
                        render: function(data) {
                            if (!data) return '-';
                            const dt = new Date(data);
                            return dt.toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' });
                        }
                    },
                    { 
                        data: 'nilai_angka',
                        className: 'text-center',
                        render: function(data) {
                            return data ? parseFloat(data).toFixed(2) : '-';
                        }
                    },
                    { 
                        data: 'nilai_huruf',
                        className: 'text-center',
                        render: function(data) {
                            return data ? '<strong>' + data + '</strong>' : '-';
                        }
                    },
                    {
                        data: null,
                        className: 'text-center',
                        render: function(data, type, row) {
                            let badge1 = getStatusTtdBadge(row.setuju_penguji1);
                            let badge2 = getStatusTtdBadge(row.setuju_penguji2);
                            let badge3 = getStatusTtdBadge(row.setuju_penguji3);
                            return `<div class="d-flex justify-content-center" style="gap: 5px;">
                                ${badge1}
                                ${badge2}
                                ${badge3}
                            </div>`;
                        }
                    },
                    { 
                        data: 'status_ujian',
                        className: 'text-center',
                        render: function(data) {
                            if (data === 'menunggu_penetapan') return '<span class="badge badge-warning">Menunggu Penetapan</span>';
                            if (data === 'ditetapkan' || data === 'lulus') return '<span class="badge badge-success">Lulus / Ditetapkan</span>';
                            if (data === 'tidak_lulus') return '<span class="badge badge-danger">Tidak Lulus</span>';
                            return '<span class="badge badge-secondary">' + data + '</span>';
                        }
                    },
                    {
                        data: null,
                        className: 'text-center',
                        render: function(data, type, row) {
                            let b64 = btoa(unescape(encodeURIComponent(JSON.stringify(row))));
                            let buttons = `<button class="btn btn-sm btn-info btn-tinjau mr-1" data-row="${b64}"><i class="fa fa-eye"></i> Tinjau</button>`;
                            buttons += `<button class="btn btn-sm btn-secondary btn-print" data-id="${row.id_skripsi_ujian}"><i class="fa fa-print"></i> Cetak</button>`;
                            return buttons;
                        }
                    }
                ]
            });

            // Handle Tinjau Click
            $(document).on('click', '.btn-tinjau', function() {
                const b64 = $(this).data('row');
                const row = JSON.parse(decodeURIComponent(escape(atob(b64))));
                activeUjianData = row;

                $('#ba_mhs_nama').text(row.nama_mhs);
                $('#ba_mhs_nim').text(row.nim);
                $('#ba_mhs_judul').text(row.judul || '-');

                loadBeritaAcaraDetails(row.id_skripsi_ujian);
            });

            // Handle Print Click from table
            $(document).on('click', '.btn-print', function() {
                const id = $(this).data('id');
                window.open("{{ url('akademik/cetak/cetakberitaacaraskripsi') }}/" + id, '_blank');
            });

            // Handle Print Click from Modal
            $('#btn_modal_print').on('click', function() {
                if (activeUjianData) {
                    window.open("{{ url('akademik/cetak/cetakberitaacaraskripsi') }}/" + activeUjianData.id_skripsi_ujian, '_blank');
                }
            });

            function loadBeritaAcaraDetails(id_skripsi_ujian) {
                $.ajax({
                    url: "{{ $api_url }}dosen/skripsi/berita-acara/" + id_skripsi_ujian,
                    method: "GET",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    beforeSend: function() {
                        $('#tbody_cpmk_breakdown').html('<tr><td colspan="6" class="text-center py-4"><i class="fa fa-spinner fa-spin"></i> Memuat rincian nilai...</td></tr>');
                        $('#list_signature_status').html('<p class="text-center py-2"><i class="fa fa-spinner fa-spin"></i> Loading...</p>');
                        $('#action_button_container').html('');
                    },
                    success: function(res) {
                        if (res.status === 'success') {
                            const data = res.data;
                            const u = data.ujian;
                            const ba = data.berita_acara;
                            const nilais = data.nilai_indikator || data.nilai_cpmk || [];

                            const finalAngka = ba ? parseFloat(ba.nilai_angka).toFixed(2) : '0.00';
                            const finalHuruf = ba ? ba.nilai_huruf : '-';
                            $('#ba_nilai_angka').text(finalAngka);
                            $('#ba_nilai_huruf').text(finalHuruf);

                            // Status badge
                            let badgeClass = 'badge-warning';
                            let statusText = 'Menunggu Penetapan';
                            if (u.status === 'ditetapkan' || u.status === 'lulus') {
                                badgeClass = 'badge-success';
                                statusText = 'Lulus / Selesai';
                            } else if (u.status === 'tidak_lulus') {
                                badgeClass = 'badge-danger';
                                statusText = 'Tidak Lulus';
                            }
                            $('#ba_kelulusan_badge').removeClass().addClass('badge px-3 py-2 font-weight-bold text-uppercase ' + badgeClass).text(statusText);

                            // Catatan
                            $('#ba_catatan').html(ba && ba.catatan ? ba.catatan : '<em class="text-muted">Tidak ada catatan perbaikan.</em>');

                            const tipeBobot = nilais.length > 0 ? (nilais[0].tipe_bobot || 'indikator') : 'indikator';

                            $('#cpmk_card_title').html(tipeBobot === 'tunggal' ? '<i class="fa fa-table text-primary"></i> Rincian Nilai Aspek Penilaian dari Ketiga Penguji' : '<i class="fa fa-table text-primary"></i> Rincian Nilai Indikator Penilaian dari Ketiga Penguji');
                            $('#cpmk_th_title').text(tipeBobot === 'tunggal' ? 'Aspek Penilaian' : 'Kriteria Rubrik Penilaian');

                            function isAspectMatch(dbAspek, targetAspek) {
                                let dbVal = (dbAspek || '').toLowerCase().trim();
                                let targetVal = (targetAspek || '').toLowerCase().trim();
                                if (dbVal === targetVal) return true;
                                if (dbVal === 'substansi' && targetVal.indexOf('substansi') !== -1) return true;
                                if (dbVal === 'ujian' && targetVal.indexOf('ujian') !== -1) return true;
                                return false;
                            }

                            // Rincian Rubrik table
                            const rubricMap = {};
                            if (tipeBobot === 'tunggal') {
                                nilais.forEach(function(n) {
                                    const key = n.aspek || 'Lainnya';
                                    if (!rubricMap[key]) {
                                        let matchAspek = (data.aspek || []).find(a => isAspectMatch(a.nama_aspek, key));
                                        let aspectBobot = matchAspek ? parseFloat(matchAspek.bobot) : (n.bobot !== null && n.bobot !== undefined ? parseFloat(n.bobot) : 100.00);
                                        
                                        rubricMap[key] = {
                                            aspek: key,
                                            label: 'Aspek ' + key,
                                            bobot: aspectBobot,
                                            scores_raw: {}
                                        };
                                    }
                                    if (!rubricMap[key].scores_raw[n.id_dosen]) {
                                        rubricMap[key].scores_raw[n.id_dosen] = [];
                                    }
                                    rubricMap[key].scores_raw[n.id_dosen].push(parseFloat(n.nilai));
                                });

                                for (let key in rubricMap) {
                                    rubricMap[key].scores = {};
                                    for (let id_dosen in rubricMap[key].scores_raw) {
                                        const vals = rubricMap[key].scores_raw[id_dosen];
                                        rubricMap[key].scores[id_dosen] = vals.reduce((a, b) => a + b, 0) / vals.length;
                                    }
                                }
                            } else {
                                nilais.forEach(function(n) {
                                    const key = n.id_rubrik_indikator || n.id_cpmk || n.id;
                                    if (!rubricMap[key]) {
                                        rubricMap[key] = {
                                            aspek: n.aspek || '-',
                                            label: n.nama_indikator || n.nama_cpmk || 'Kriteria Penilaian',
                                            bobot: n.bobot !== null && n.bobot !== undefined ? n.bobot : 100.00,
                                            scores: {}
                                        };
                                    }
                                    rubricMap[key].scores[n.id_dosen] = parseFloat(n.nilai);
                                });
                            }

                            let cpmkHtml = '';
                            for (let key in rubricMap) {
                                const item = rubricMap[key];
                                const score1 = item.scores[u.id_penguji1] !== undefined ? item.scores[u.id_penguji1].toFixed(2) : '-';
                                const score2 = item.scores[u.id_penguji2] !== undefined ? item.scores[u.id_penguji2].toFixed(2) : '-';
                                const score3 = item.scores[u.id_penguji3] !== undefined ? item.scores[u.id_penguji3].toFixed(2) : '-';
                                
                                const valids = [];
                                if (item.scores[u.id_penguji1] !== undefined) valids.push(item.scores[u.id_penguji1]);
                                if (item.scores[u.id_penguji2] !== undefined) valids.push(item.scores[u.id_penguji2]);
                                if (item.scores[u.id_penguji3] !== undefined) valids.push(item.scores[u.id_penguji3]);
                                const avg = valids.length > 0 ? (valids.reduce((a, b) => a + b, 0) / valids.length).toFixed(2) : '-';

                                const aspectBadge = tipeBobot === 'tunggal' ? '' : `<span class="badge badge-primary mr-1">${item.aspek}</span> `;

                                cpmkHtml += `<tr>
                                    <td class="text-left font-weight-medium">
                                        ${aspectBadge}${item.label}
                                    </td>
                                    <td>${parseFloat(item.bobot)}%</td>
                                    <td>${score1}</td>
                                    <td>${score2}</td>
                                    <td>${score3}</td>
                                    <td class="font-weight-bold text-primary">${avg}</td>
                                </tr>`;
                            }

                            if (cpmkHtml === '') {
                                cpmkHtml = '<tr><td colspan="6" class="text-center text-muted">Belum ada rincian nilai rubrik.</td></tr>';
                            }
                            $('#tbody_cpmk_breakdown').html(cpmkHtml);

                            // Signatures
                            const isObe = activeUjianData.is_obe == 1;
                            const examiners = [
                                { name: u.nama_penguji1 || 'Penguji 1 (Ketua)', role: getRoleLabel('penguji1', isObe), ttd: ba ? ba.setuju_penguji1 : null },
                                { name: u.nama_penguji2 || 'Penguji 2', role: getRoleLabel('penguji2', isObe), ttd: ba ? ba.setuju_penguji2 : null },
                                { name: u.nama_penguji3 || 'Penguji 3', role: getRoleLabel('penguji3', isObe), ttd: ba ? ba.setuju_penguji3 : null }
                            ];

                            let allSigned = true;
                            let sigHtml = '';

                            examiners.forEach(function(ex) {
                                if (!ex.ttd) allSigned = false;

                                const dateStr = formatDateTime(ex.ttd);
                                let badgeHtml = '';
                                if (ex.ttd) {
                                    badgeHtml = `<span class="signature-badge signature-signed"><i class="fa fa-check-circle"></i> Setuju: ${dateStr}</span>`;
                                } else {
                                    badgeHtml = `<span class="signature-badge signature-pending"><i class="fa fa-clock-o"></i> Belum Menyetujui</span>`;
                                }

                                sigHtml += `<div class="list-group-item d-flex justify-content-between align-items-center px-0 py-3 border-bottom">
                                    <div>
                                        <h6 class="mb-0 font-weight-bold text-dark">${ex.name}</h6>
                                        <small class="text-muted font-weight-medium">${ex.role}</small>
                                    </div>
                                    <div class="text-right">
                                        ${badgeHtml}
                                    </div>
                                </div>`;
                            });

                            $('#list_signature_status').html(sigHtml);

                            // Action button logic for Kaprodi
                            if (u.status === 'menunggu_penetapan') {
                                if (allSigned) {
                                    $('#action_button_container').html(`
                                        <button class="btn btn-success btn-tetapkan" data-id="${u.id}" data-status="lulus"><i class="fa fa-check"></i> Tetapkan Lulus</button>
                                        <button class="btn btn-danger btn-tetapkan" data-id="${u.id}" data-status="tidak_lulus"><i class="fa fa-times"></i> Tetapkan Tidak Lulus</button>
                                    `);
                                } else {
                                    $('#action_button_container').html('<button class="btn btn-secondary" disabled title="Semua penguji harus menandatangani digital sebelum penetapan"><i class="fa fa-lock"></i> Menunggu TTD Semua Penguji</button>');
                                }
                            } else {
                                $('#action_button_container').html('<span class="text-success font-weight-bold"><i class="fa fa-lock"></i> Nilai Sudah Resmi Ditetapkan & Tersinkron ke Transkrip</span>');
                            }

                            $('#modal_tetapkan_nilai').modal('show');
                        } else {
                            swal("Gagal", res.message || "Gagal memuat rincian Berita Acara.", "error");
                        }
                    },
                    error: function(err) {
                        swal("Gagal", err.responseJSON?.error || "Kesalahan Server.", "error");
                    }
                });
            }

            // Handle Tetapkan Click
            $(document).on('click', '.btn-tetapkan', function() {
                const id_skripsi_ujian = $(this).data('id');
                const status = $(this).data('status');
                const statusLabel = status === 'lulus' ? 'LULUS' : 'TIDAK LULUS';
                const statusColor = status === 'lulus' ? '#28a745' : '#dc3545';

                swal({
                    title: "Konfirmasi Penetapan Nilai",
                    text: `Apakah Anda yakin ingin menetapkan status ujian mahasiswa ini sebagai ${statusLabel}? Nilai akhir akan disinkronisasikan ke transkrip akademik secara resmi.`,
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: statusColor,
                    cancelButtonColor: "#6c757d",
                    confirmButtonText: `Ya, Tetapkan ${statusLabel}`,
                    cancelButtonText: "Batal"
                }, function(isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            url: "{{ $api_url }}kaprodi/skripsi/tetapkan-nilai",
                            method: "POST",
                            headers: {
                                "Authorization": 'Bearer ' + token,
                                "username": userlogin
                            },
                            data: {
                                id_skripsi_ujian: id_skripsi_ujian,
                                status: status
                            },
                            success: function(res) {
                                swal("Berhasil", "Penetapan nilai skripsi berhasil disimpan dan disinkronkan ke transkrip.", "success");
                                $('#modal_tetapkan_nilai').modal('hide');
                                table.ajax.reload();
                            },
                            error: function(err) {
                                swal("Gagal", err.responseJSON?.error || "Terjadi kesalahan server.", "error");
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
