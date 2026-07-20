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
            font-size: 0.85rem;
            padding: 5px 10px;
            border-radius: 4px;
            font-weight: 600;
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
                                <li class="breadcrumb-item"><a href="{{ route('dosen.skripsi.index') }}">{{ $parent_breadcrumb }}</a></li>
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
                    <h4 class="box-title">Persetujuan Berita Acara & Nilai Ujian</h4>
                    <h6 class="box-subtitle">Berikut adalah daftar mahasiswa yang ujiannya telah dinilai. Silakan lakukan persetujuan Berita Acara (tanda tangan digital) untuk memfinalisasi nilai.</h6>
                </div>

                <div class="box-body">
                    <div class="box-body ribbon-box bg-light mb-4">
                        <div class="ribbon ribbon-info">Ketentuan Digital Signature</div>
                        <p class="mb-0 text-dark font-weight-medium">
                            <i class="fa fa-info-circle text-info"></i> Sesuai kebijakan akademik, <strong>ketiga Dosen Penguji / Verifikator wajib melakukan persetujuan (Tanda Tangan Digital)</strong> dengan merekam tanggal persetujuan. Setelah seluruh penguji menandatangani Berita Acara, Kaprodi dapat menetapkan nilai akhir secara resmi ke transkrip mahasiswa.
                        </p>
                    </div>

                    <input class="form-control" type="hidden" name="id_dosen" id="id_dosen" value="{{ $session_id_dosen }}">

                    <div class="table-responsive">
                        <table id="tb_penetapan_dosen" class="table table-hover table-bordered table-sm" width="100%">
                            <thead class="bg-dark">
                                <tr>
                                    <th>NIM</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>Program Studi</th>
                                    <th>Judul Skripsi / Luaran</th>
                                    <th class="text-center">Jalur</th>
                                    <th>Peran Anda</th>
                                    <th class="text-center">Status TTD Anda</th>
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

    <!-- Modal Tinjau & TTD Berita Acara -->
    <div class="modal fade" id="modal_ttd_ba" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title font-weight-bold">Tinjau Berita Acara & Persetujuan Nilai</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-light">
                    <!-- Info Mahasiswa Header Card -->
                    <div class="card card-body border-0 shadow-sm mb-4">
                        <div class="row">
                            <div class="col-md-3 border-right">
                                <span class="text-muted text-uppercase font-weight-bold small">Mahasiswa</span>
                                <h5 id="ba_mhs_nama" class="font-weight-bold mb-1 text-primary"></h5>
                                <span id="ba_mhs_nim" class="font-weight-bold text-muted"></span>
                            </div>
                            <div class="col-md-6 border-right">
                                <span class="text-muted text-uppercase font-weight-bold small">Judul Skripsi / Luaran</span>
                                <p id="ba_mhs_judul" class="font-italic text-dark mb-0"></p>
                            </div>
                            <div class="col-md-3">
                                <span class="text-muted text-uppercase font-weight-bold small">Jalur & Peran Anda</span>
                                <div><span id="ba_mhs_jalur" class="badge font-weight-bold px-2 py-1 mt-1"></span></div>
                                <div class="font-weight-bold text-dark mt-1" id="ba_mhs_peran"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Left: Rubric & Score Breakdowns -->
                        <div class="col-lg-8">
                            <div class="card border-0 shadow-sm mb-4">
                                <div class="card-header bg-white font-weight-bold text-dark" id="cpmk_card_title">
                                    <i class="fa fa-table text-primary"></i> Rincian Nilai Indikator dari Tim Penguji
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
                                        <label class="font-weight-bold text-dark">Catatan Ujian / Rekomendasi:</label>
                                        <div class="p-3 bg-white border rounded text-muted font-italic" id="ba_catatan" style="min-height: 60px;">
                                            Belum ada catatan.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right: Final Score & Signature Status -->
                        <div class="col-lg-4">
                            <div class="card border-0 shadow-sm mb-4">
                                <div class="card-header bg-white font-weight-bold text-dark text-center">
                                    <i class="fa fa-calculator text-primary"></i> Nilai Akhir & Kelulusan
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
                                    <i class="fa fa-pencil text-primary"></i> Status Tanda Tangan Digital (TTD)
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
                            <!-- Action button populated dynamically -->
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
            var userlogin = "{{ $session_username }}";
            var id_dosen = $('#id_dosen').val();
            var gradeRules = {};
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

            function calculateGradeLetter(score, kodePenilaian) {
                var kode = kodePenilaian || 1;
                var rules = gradeRules[kode] || gradeRules[1] || [];
                for (var i = 0; i < rules.length; i++) {
                    if (score >= rules[i].min) {
                        return rules[i].grade;
                    }
                }
                return 'E';
            }

            // Initialize Table
            var table = $("#tb_penetapan_dosen").DataTable({
                destroy: true,
                processing: true,
                serverSide: false,
                ajax: {
                    type: "GET",
                    url: "{{ $api_url }}dosen/skripsi/list-mahasiswa-diuji",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    data: { id_dosen: id_dosen },
                    dataSrc: function(json) {
                        if (json.grade_rules) {
                            gradeRules = json.grade_rules;
                        }
                        
                        // Filter only waiting for penetapan or already decided
                        const allData = json.data || [];
                        return allData.filter(function(row) {
                            return ['menunggu_penetapan', 'ditetapkan', 'lulus', 'tidak_lulus'].indexOf(row.status_ujian) !== -1;
                        });
                    }
                },
                columns: [
                    { data: 'nim' },
                    { data: 'nama_mahasiswa' },
                    { data: 'nama_program_studi' },
                    { 
                        data: 'judul',
                        render: function(data) {
                            return '<strong title="' + (data || '') + '">' + 
                                   (data && data.length > 60 ? data.substring(0, 60) + '...' : (data || '-')) + 
                                   '</strong>';
                        }
                    },
                    { 
                        data: 'is_obe',
                        className: 'text-center',
                        render: function(data) {
                            if (data == 1) return '<span class="badge badge-success px-2 py-1"><i class="fa fa-graduation-cap"></i> OBE</span>';
                            return '<span class="badge badge-primary px-2 py-1"><i class="fa fa-file-text"></i> Non-OBE</span>';
                        }
                    },
                    { 
                        data: 'role_dosen',
                        render: function(data, type, row) {
                            return '<strong>' + getRoleLabel(data, row.is_obe == 1) + '</strong>';
                        }
                    },
                    { 
                        data: 'status_ujian',
                        className: 'text-center',
                        render: function(data, type, row) {
                            // We need to fetch details to know, but let's check basic check first
                            // Alternatively, we can let user see inside modal. Here let's show status of sign
                            return '<span class="text-muted font-weight-bold"><i class="fa fa-info-circle"></i> Klik Tinjau</span>';
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
                            let buttons = '<button class="btn btn-sm btn-info btn-tinjau mr-1" data-row="' + b64 + '"><i class="fa fa-eye"></i> Tinjau & TTD</button>';
                            buttons += '<button class="btn btn-sm btn-secondary btn-print" data-id="' + row.id_skripsi_ujian + '"><i class="fa fa-print"></i> Cetak</button>';
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

                $('#ba_mhs_nama').text(row.nama_mahasiswa);
                $('#ba_mhs_nim').text(row.nim);
                $('#ba_mhs_judul').text(row.judul || '-');
                
                const isObe = row.is_obe == 1;
                if (isObe) {
                    $('#ba_mhs_jalur').removeClass().addClass('badge badge-success font-weight-bold px-2 py-1 mt-1').html('<i class="fa fa-graduation-cap"></i> OBE');
                } else {
                    $('#ba_mhs_jalur').removeClass().addClass('badge badge-primary font-weight-bold px-2 py-1 mt-1').html('<i class="fa fa-file-text"></i> Non-OBE');
                }
                $('#ba_mhs_peran').text(getRoleLabel(row.role_dosen, isObe));

                // Load Berita Acara details
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
                    data: { id_dosen: id_dosen },
                    beforeSend: function() {
                        $('#tbody_cpmk_breakdown').html('<tr><td colspan="6" class="text-center py-4"><i class="fa fa-spinner fa-spin"></i> Memuat Berita Acara...</td></tr>');
                        $('#list_signature_status').html('<p class="text-center py-2"><i class="fa fa-spinner fa-spin"></i> Loading...</p>');
                        $('#action_button_container').html('');
                    },
                    success: function(res) {
                        if (res.status === 'success') {
                            const data = res.data;
                            const u = data.ujian;
                            const ba = data.berita_acara;
                            const nilais = data.nilai_indikator || data.nilai_cpmk || [];

                            // Render final score boxes
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

                            $('#cpmk_card_title').html(tipeBobot === 'tunggal' ? '<i class="fa fa-table text-primary"></i> Rincian Nilai Aspek Penilaian dari Tim Penguji' : '<i class="fa fa-table text-primary"></i> Rincian Nilai Indikator Penilaian dari Tim Penguji');
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

                            // Signature List
                            let sigHtml = '';
                            const isObe = activeUjianData.is_obe == 1;
                            const examiners = [
                                { key: 'penguji1', id: u.id_penguji1, nama: u.nama_penguji1 || 'Penguji 1', roleLabel: getRoleLabel('penguji1', isObe), ttd: ba ? ba.setuju_penguji1 : null },
                                { key: 'penguji2', id: u.id_penguji2, nama: u.nama_penguji2 || 'Penguji 2', roleLabel: getRoleLabel('penguji2', isObe), ttd: ba ? ba.setuju_penguji2 : null },
                                { key: 'penguji3', id: u.id_penguji3, nama: u.nama_penguji3 || 'Penguji 3', roleLabel: getRoleLabel('penguji3', isObe), ttd: ba ? ba.setuju_penguji3 : null }
                            ];

                            let myRoleKey = null;
                            let alreadySigned = false;

                            examiners.forEach(function(ex) {
                                if (ex.id == id_dosen) {
                                    myRoleKey = ex.key;
                                    if (ex.ttd) alreadySigned = true;
                                }

                                const dateStr = formatDateTime(ex.ttd);
                                let badgeHtml = '';
                                if (ex.ttd) {
                                    badgeHtml = `<span class="signature-badge signature-signed"><i class="fa fa-check-circle"></i> Setuju: ${dateStr}</span>`;
                                } else {
                                    badgeHtml = `<span class="signature-badge signature-pending"><i class="fa fa-clock-o"></i> Belum Menyetujui</span>`;
                                }

                                sigHtml += `<div class="list-group-item d-flex justify-content-between align-items-center px-0 py-3 border-bottom">
                                    <div>
                                        <h6 class="mb-0 font-weight-bold text-dark">${ex.nama}</h6>
                                        <small class="text-muted font-weight-medium">${ex.roleLabel}</small>
                                    </div>
                                    <div class="text-right">
                                        ${badgeHtml}
                                    </div>
                                </div>`;
                            });

                            $('#list_signature_status').html(sigHtml);

                            // Action button logic
                            if (u.status === 'menunggu_penetapan') {
                                if (alreadySigned) {
                                    $('#action_button_container').html('<button class="btn btn-success" disabled><i class="fa fa-check"></i> Anda Sudah Menyetujui Berita Acara</button>');
                                } else if (myRoleKey) {
                                    $('#action_button_container').html(`<button class="btn btn-primary" id="btn_approve_ba" data-id="${u.id}"><i class="fa fa-pencil"></i> Tanda Tangani Berita Acara</button>`);
                                } else {
                                    $('#action_button_container').html('<button class="btn btn-secondary" disabled>Anda tidak berhak memberi persetujuan</button>');
                                }
                            } else {
                                $('#action_button_container').html('<span class="text-success font-weight-bold"><i class="fa fa-lock"></i> Berita Acara Sudah Difinalisasi & Ditetapkan</span>');
                            }

                            $('#modal_ttd_ba').modal('show');
                        } else {
                            showToastr('error', 'Gagal', res.message || 'Gagal memuat berita acara.');
                        }
                    },
                    error: function(err) {
                        showToastr('error', 'Gagal', err.responseJSON?.error || 'Kesalahan Server.');
                    }
                });
            }

            // Handle TTD Button Click
            $(document).on('click', '#btn_approve_ba', function() {
                const id_skripsi_ujian = $(this).data('id');
                const btn = $(this);

                swal({
                    title: 'Pernyataan Persetujuan',
                    text: "Apakah Anda menyetujui rincian penilaian dan nilai akhir Berita Acara ini secara digital? Tindakan ini setara dengan membubuhkan tanda tangan resmi.",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Saya Setujui',
                    cancelButtonText: 'Batal'
                }, function(isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            url: "{{ $api_url }}dosen/skripsi/setuju-berita-acara",
                            method: "POST",
                            headers: {
                                "Authorization": 'Bearer ' + token,
                                "username": userlogin
                            },
                            data: {
                                id_skripsi_ujian: id_skripsi_ujian,
                                id_dosen: id_dosen
                            },
                            beforeSend: function() {
                                btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Mencatat Persetujuan...');
                            },
                            success: function(res) {
                                if (res.status === 'success') {
                                    swal('Berhasil', 'Persetujuan Berita Acara berhasil dicatat.', 'success');
                                    // Refresh modal
                                    loadBeritaAcaraDetails(id_skripsi_ujian);
                                    // Refresh main table
                                    table.ajax.reload();
                                } else {
                                    swal('Gagal', res.message || 'Gagal menyetujui.', 'error');
                                    btn.prop('disabled', false).html('<i class="fa fa-pencil"></i> Tanda Tangani Berita Acara');
                                }
                            },
                            error: function(err) {
                                swal('Gagal', err.responseJSON?.error || 'Kesalahan Server.', 'error');
                                btn.prop('disabled', false).html('<i class="fa fa-pencil"></i> Tanda Tangani Berita Acara');
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
