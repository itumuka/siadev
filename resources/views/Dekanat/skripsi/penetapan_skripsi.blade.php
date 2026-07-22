@extends('layout')

@section('css')
    <style>
        th, td {
            white-space: nowrap;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.9);
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
                            <nav class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                                <li class="breadcrumb-item"><a href="#">{{ $parent_breadcrumb }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $child_breadcrumb }}</li>
                            </nav>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="box glass-card">
                <div class="box-header with-border">
                    <h4 class="box-title">Penetapan Nilai & Nomor Berita Acara Ujian</h4>
                    <h6 class="box-subtitle">Berikut adalah daftar ujian sidang skripsi mahasiswa di Fakultas Anda (Reguler & OBE). Silakan gunakan tombol <strong>"Atur BA"</strong> untuk memasukkan nomor resmi Berita Acara dan batas revisi.</h6>
                </div>

                <div class="box-body">
                    <div class="table-responsive">
                        <table id="tb_penetapan_dekanat" class="table table-hover table-bordered table-sm" width="100%">
                            <thead class="bg-dark">
                                <tr>
                                    <th>NIM</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>Judul Skripsi</th>
                                    <th class="text-center">Tanggal Ujian</th>
                                    <th class="text-center">No. Berita Acara</th>
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

    <!-- Modal Tinjau, Input No BA & Batas Revisi -->
    <div class="modal fade" id="modal_input_ba" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title font-weight-bold"><i class="fa fa-edit"></i> Manajemen Berita Acara & Nilai Sidang</h5>
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
                        <!-- Left: Input Form Nomor BA & Batas Revisi -->
                        <div class="col-lg-5">
                            <div class="card border-0 shadow-sm mb-4">
                                <div class="card-header bg-white font-weight-bold text-dark">
                                    <i class="fa fa-file-text-o text-primary"></i> Atur Info Berita Acara
                                </div>
                                <div class="card-body">
                                    <form id="form_update_ba">
                                        <div class="form-group mb-3">
                                            <label class="font-weight-bold text-dark">Nomor Berita Acara:</label>
                                            <input type="text" name="nomor_ba" id="modal_nomor_ba" class="form-control font-weight-bold border-secondary text-dark" placeholder="Contoh: BA/SKR/12/2026">
                                            <small class="form-text text-muted">Nomor resmi yang diterbitkan untuk Berita Acara Ujian Sidang ini.</small>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="font-weight-bold text-dark">Batas Tanggal Revisi:</label>
                                            <input type="date" name="batas_revisi" id="modal_batas_revisi" class="form-control border-secondary text-dark">
                                            <small class="form-text text-muted">Batas waktu penyerahan revisi skripsi (default 14 hari sejak ujian).</small>
                                        </div>

                                        <button type="submit" class="btn btn-primary btn-block font-weight-bold mt-4" id="btn_save_ba_info">
                                            <i class="fa fa-save"></i> Simpan Info Berita Acara
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <div class="card border-0 shadow-sm">
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
                        </div>

                        <!-- Right: Scores Breakdown & Signature Status -->
                        <div class="col-lg-7">
                            <div class="card border-0 shadow-sm mb-4">
                                <div class="card-header bg-white font-weight-bold text-dark" id="cpmk_card_title">
                                    <i class="fa fa-table text-primary"></i> Kriteria Rubrik Penilaian
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-sm text-center" id="table_cpmk_breakdown">
                                            <thead class="bg-secondary text-white">
                                                <tr>
                                                    <th class="text-left" id="cpmk_th_title">Kriteria Rubrik</th>
                                                    <th>Bobot</th>
                                                    <th>P1</th>
                                                    <th>P2</th>
                                                    <th>P3</th>
                                                    <th>Rata-rata</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody_cpmk_breakdown">
                                                <!-- Populated dynamically -->
                                            </tbody>
                                        </table>
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
            var kode_fakultas = "{{ $session_kode_fakultas }}";
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
            var table = $("#tb_penetapan_dekanat").DataTable({
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
                    data: {
                        kode_fakultas: kode_fakultas
                    },
                    dataSrc: ""
                },
                columns: [
                    { data: 'nim', className: 'text-bold' },
                    { data: 'nama_mhs' },
                    { 
                        data: 'judul',
                        render: function(data, type, row) {
                            let title = data || '-';
                            let badge = row.is_obe ? ' <span class="badge badge-success-light badge-sm">OBE</span>' : ' <span class="badge badge-primary-light badge-sm">Reguler</span>';
                            return `<div style="max-width:300px; white-space:normal; font-style:italic;">${title}${badge}</div>`;
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
                        data: 'nomor_ba', 
                        className: 'text-center font-weight-bold text-dark',
                        render: function(data) {
                            return data ? `<span class="text-success">${data}</span>` : '<span class="text-muted font-italic">Belum Diinput</span>';
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
                            let buttons = `<button class="btn btn-sm btn-primary btn-tinjau mr-1" data-row="${b64}"><i class="fa fa-pencil"></i> Atur BA</button>`;
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

                // Prepopulate form fields
                $('#modal_nomor_ba').val(row.nomor_ba || '');
                $('#modal_batas_revisi').val(row.batas_revisi || '');

                loadBeritaAcaraDetails(row.id_skripsi_ujian);
                $('#modal_input_ba').modal('show');
            });

            // Handle Save Berita Acara Info
            $('#form_update_ba').on('submit', function(e) {
                e.preventDefault();
                if (!activeUjianData) return;

                const nomor_ba = $('#modal_nomor_ba').val();
                const batas_revisi = $('#modal_batas_revisi').val();

                $.ajax({
                    url: "{{ $api_url }}akademik/skripsi/update-berita-acara",
                    method: "POST",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    data: {
                        id_skripsi_ujian: activeUjianData.id_skripsi_ujian,
                        nomor_ba: nomor_ba,
                        batas_revisi: batas_revisi
                    },
                    success: function(res) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: res.message || 'Informasi Berita Acara berhasil diperbarui.',
                            timer: 2000
                        });
                        table.ajax.reload(null, false);
                        $('#modal_input_ba').modal('hide');
                    },
                    error: function(err) {
                        let errMsg = 'Gagal memperbarui Berita Acara.';
                        if (err.responseJSON && err.responseJSON.error) {
                            errMsg = err.responseJSON.error.join ? err.responseJSON.error.join('<br>') : err.responseJSON.error;
                        }
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            html: errMsg
                        });
                    }
                });
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

                            // Load/update dates in case they changed
                            if (ba) {
                                $('#modal_nomor_ba').val(ba.nomor_ba || '');
                                $('#modal_batas_revisi').val(ba.batas_revisi || '');
                            }

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

                            const tipeBobot = nilais.length > 0 ? (nilais[0].tipe_bobot || 'indikator') : 'indikator';

                            $('#cpmk_card_title').html(tipeBobot === 'tunggal' ? '<i class="fa fa-table text-primary"></i> Rincian Aspek Penilaian' : '<i class="fa fa-table text-primary"></i> Rincian Indikator Penilaian');
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
                                            indicators: [],
                                            scores_raw: {}
                                        };
                                    }
                                    if (n.nama_indikator && !rubricMap[key].indicators.includes(n.nama_indikator)) {
                                        rubricMap[key].indicators.push(n.nama_indikator);
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
                                let subIndicators = (item.indicators && item.indicators.length > 0) ? `<small class="text-muted d-block mt-1">Indikator: ${item.indicators.join(', ')}</small>` : '';

                                cpmkHtml += `<tr>
                                    <td class="text-left font-weight-medium">
                                        ${aspectBadge}<strong>${item.label}</strong>
                                        ${subIndicators}
                                    </td>
                                    <td>${parseFloat(item.bobot)}%</td>
                                    <td>${score1}</td>
                                    <td>${score2}</td>
                                    <td>${score3}</td>
                                    <td class="font-weight-bold text-primary">${avg}</td>
                                </tr>`;
                            }

                            if (cpmkHtml === '') {
                                $('#tbody_cpmk_breakdown').html('<tr><td colspan="6" class="text-center py-3 text-muted">Belum ada nilai yang diinput oleh penguji.</td></tr>');
                            } else {
                                $('#tbody_cpmk_breakdown').html(cpmkHtml);
                            }

                            // Signature status
                            let sigHtml = '';
                            const roles = ['penguji1', 'penguji2', 'penguji3'];
                            roles.forEach(role => {
                                const id_dosen = u['id_' + role];
                                const nama_dosen = u['nama_' + role];
                                const ttdTime = ba ? ba['setuju_' + role] : null;

                                if (id_dosen) {
                                    sigHtml += `
                                        <div class="list-group-item d-flex justify-content-between align-items-center bg-transparent border-0 px-0 py-2">
                                            <div>
                                                <div class="font-weight-bold text-dark">${nama_dosen}</div>
                                                <small class="text-muted">${getRoleLabel(role, u.is_obe)}</small>
                                            </div>
                                            <div>
                                                ${getStatusTtdBadge(ttdTime)}
                                            </div>
                                        </div>
                                    `;
                                }
                            });
                            $('#list_signature_status').html(sigHtml);

                        } else {
                            $('#tbody_cpmk_breakdown').html('<tr><td colspan="6" class="text-center text-danger">Gagal memuat detail nilai.</td></tr>');
                        }
                    },
                    error: function() {
                        $('#tbody_cpmk_breakdown').html('<tr><td colspan="6" class="text-center text-danger">Gagal memuat detail nilai.</td></tr>');
                    }
                });
            }
        });
    </script>
@endsection
