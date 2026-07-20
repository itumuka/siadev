<html>

<head>
    <title>{{ $title }}</title>
    <style>
        @page {
            size: A4 portrait;
            margin: 15mm 15mm 15mm 15mm;
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 11pt;
            color: #000;
            line-height: 1.4;
        }

        .page-break {
            page-break-before: always;
        }

        .header-table {
            width: 100%;
            border-bottom: 3px double #000;
            padding-bottom: 5px;
            margin-bottom: 15px;
        }

        .header-logo {
            width: 80px;
            padding-right: 15px;
            text-align: center;
        }

        .header-text {
            font-size: 13pt;
            font-weight: bold;
            text-align: center;
        }

        .header-subtext {
            font-size: 9pt;
            font-weight: normal;
            text-align: center;
            margin-top: 5px;
            line-height: 1.2;
        }

        .title {
            font-size: 13pt;
            font-weight: bold;
            text-align: center;
            margin-top: 15px;
            margin-bottom: 15px;
            text-transform: uppercase;
        }

        .meta-table {
            width: 100%;
            margin-bottom: 15px;
        }

        .meta-table td {
            padding: 3px 0;
            vertical-align: top;
        }

        .meta-label {
            width: 25%;
        }

        .meta-separator {
            width: 3%;
        }

        .meta-value {
            width: 72%;
        }

        .score-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            margin-bottom: 15px;
        }

        .score-table th,
        .score-table td {
            border: 1px solid #000;
            padding: 6px 6px;
            text-align: center;
        }

        .score-table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .text-left {
            text-align: left !important;
        }

        .text-center {
            text-align: center !important;
        }

        .font-bold {
            font-weight: bold;
        }

        .notes-box {
            border: 1px solid #000;
            padding: 8px;
            margin-top: 10px;
            margin-bottom: 20px;
            min-height: 60px;
            font-style: italic;
        }

        .signature-section {
            width: 100%;
            margin-top: 20px;
        }

        .signature-table {
            width: 100%;
            margin-top: 15px;
        }

        .signature-table td {
            vertical-align: top;
            padding: 5px;
        }

        .signature-title {
            text-align: center;
            font-weight: bold;
            margin-bottom: 10px;
            text-decoration: underline;
        }

        .signature-status-signed {
            color: #155724;
            font-weight: bold;
            font-size: 8pt;
            margin-top: 5px;
            border: 1px solid #c3e6cb;
            background-color: #d4edda;
            padding: 3px;
            border-radius: 4px;
            display: inline-block;
        }

        .signature-status-pending {
            color: #721c24;
            font-weight: bold;
            font-size: 8pt;
            margin-top: 5px;
            border: 1px solid #f5c6cb;
            background-color: #f8d7da;
            padding: 3px;
            border-radius: 4px;
            display: inline-block;
        }

        .qr-placeholder {
            margin: 5px auto;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #28a745;
            color: #28a745;
            font-size: 16px;
            border-radius: 50%;
            background-color: #fff;
        }

        .checkbox-container {
            margin-top: 10px;
            margin-bottom: 15px;
        }

        .checkbox-item {
            margin-bottom: 5px;
            font-weight: bold;
        }

        .checkbox-box {
            display: inline-block;
            width: 14px;
            height: 14px;
            border: 1px solid #000;
            margin-right: 8px;
            vertical-align: middle;
            text-align: center;
            line-height: 12px;
            font-weight: bold;
        }

        .scale-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 8pt;
            margin-top: 10px;
        }

        .scale-table th, .scale-table td {
            border: 1px solid #000;
            padding: 3px;
            text-align: center;
        }

        .scale-table th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <input type="hidden" id="id_skripsi_ujian" value="{{ $id_skripsi_ujian }}">

    <!-- ================= PAGE 1: BERITA ACARA ================= -->
    <div id="page_berita_acara">
        <!-- Kop Surat -->
        <table class="header-table">
            <tr>
                <td class="header-logo">
                    <img src="{{ url('imageup45/logoumuka.png') }}" style="width: 75px;" alt="Logo UMUKA">
                </td>
                <td>
                    <div class="header-text">UNIVERSITAS MUHAMMADIYAH KARANGANYAR</div>
                    <div class="header-text" id="header_fakultas" style="font-size: 12pt; margin-top: 2px;">FAKULTAS</div>
                    <div class="header-subtext">
                        Jl. Raya Solo-Tawangmangu Km 12, Papahan, Kec. Tasikmadu, Kabupaten Karanganyar, Jawa Tengah 57722
                    </div>
                </td>
            </tr>
        </table>

        <div class="title" id="ba_title">
            BERITA ACARA UJIAN SIDANG SKRIPSI
        </div>
        <div class="text-center font-bold" style="margin-top: -10px; margin-bottom: 15px;">
            Nomor: <span id="ba_nomor">___/___/___/2026</span>
        </div>

        <p>Pada hari ini <span id="ba_hari_tanggal_indo" class="font-bold">...</span>, telah dilaksanakan Ujian Sidang Skripsi bagi mahasiswa:</p>

        <!-- Meta Information -->
        <table class="meta-table" style="margin-left: 15px;">
            <tr>
                <td class="meta-label">Nama Mahasiswa</td>
                <td class="meta-separator">:</td>
                <td class="meta-value font-bold" id="mhs_nama">...</td>
            </tr>
            <tr>
                <td class="meta-label">NIM</td>
                <td class="meta-separator">:</td>
                <td class="meta-value font-bold" id="mhs_nim">...</td>
            </tr>
            <tr>
                <td class="meta-label">Judul Skripsi</td>
                <td class="meta-separator">:</td>
                <td class="meta-value font-bold" style="font-style: italic;" id="skripsi_judul">...</td>
            </tr>
        </table>

        <div class="font-bold" style="margin-top: 15px; margin-bottom: 5px;">TIM PENGUJI</div>
        <table class="score-table">
            <thead>
                <tr>
                    <th style="width: 8%;">No.</th>
                    <th style="width: 32%;">Kedudukan</th>
                    <th style="width: 45%; text-align: left;">Nama</th>
                    <th style="width: 15%;">NIDN</th>
                </tr>
            </thead>
            <tbody id="tbody_tim_penguji">
                <!-- Dynamic -->
            </tbody>
        </table>

        <div class="font-bold" style="margin-top: 15px; margin-bottom: 5px;">PENILAIAN Tim Penguji</div>
        <table class="score-table">
            <thead>
                <tr>
                    <th style="width: 8%;">No.</th>
                    <th style="width: 47%; text-align: left;">Nama Dosen</th>
                    <th style="width: 15%;">Nilai Angka</th>
                    <th style="width: 15%;">Nilai Huruf</th>
                    <th style="width: 15%;">Tanda Tangan</th>
                </tr>
            </thead>
            <tbody id="tbody_penilaian_penguji">
                <!-- Dynamic -->
            </tbody>
        </table>

        <div class="checkbox-container">
            <div class="checkbox-item">
                <span class="checkbox-box" id="cb_lulus_tanpa_perbaikan">&nbsp;</span> Lulus Tanpa Perbaikan
            </div>
            <div class="checkbox-item">
                <span class="checkbox-box" id="cb_lulus_dengan_perbaikan">&nbsp;</span> Lulus dengan Perbaikan
            </div>
            <div class="checkbox-item">
                <span class="checkbox-box" id="cb_tidak_lulus_ujian_ulang">&nbsp;</span> Tidak Lulus dengan Ujian Ulang
            </div>
            <div class="checkbox-item">
                <span class="checkbox-box" id="cb_tidak_lulus_judul_baru">&nbsp;</span> Tidak Lulus dengan Menulis Skripsi Judul Baru
            </div>
        </div>

        <table class="signature-table" style="width: 100%; margin-top: 30px;">
            <tr>
                <td style="width: 50%; text-align: center;">
                    Mengetahui,<br>
                    Dekan <span id="sign_nama_fakultas">...</span>
                    <br><br><br><br>
                    <span class="font-bold" id="sign_dekan_nama">...</span><br>
                    NIDN. <span id="sign_dekan_nidn">...</span>
                </td>
                <td style="width: 50%; text-align: center;">
                    Karanganyar, <span id="ba_tgl_cetak">...</span><br>
                    Ketua Program Studi,
                    <br><br><br><br>
                    <span class="font-bold" id="sign_kaprodi_nama">...</span><br>
                    NIDN. <span id="sign_kaprodi_nidn">...</span>
                </td>
            </tr>
        </table>
    </div>

    <!-- ================= DYNAMIC INDIVIDUAL SCORING PAGES ================= -->
    <div id="individual_scoring_pages">
        <!-- Rendered Dynamically via JS -->
    </div>

    <script src="{{ URL::asset('js/jquery.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            const token = "{{ Session::get('token') }}";
            const userlogin = "{{ Session::get('username') }}";
            const id_skripsi_ujian = $('#id_skripsi_ujian').val();
            var gradeRules = {};

            function getRoleLabel(role, isObe) {
                if (isObe) {
                    if (role === 'penguji1') return 'Ketua Tim Verifikasi';
                    if (role === 'penguji2') return 'Verifikator 2';
                    if (role === 'penguji3') return 'Verifikator 3';
                    return 'Tim Verifikator';
                } else {
                    if (role === 'penguji1') return 'Ketua Penguji / Sidang';
                    if (role === 'penguji2') return 'Dosen Penguji II';
                    if (role === 'penguji3') return 'Dosen Penguji III';
                    return 'Dosen Penguji';
                }
            }

            function dateToIndonesianText(dateStr) {
                if (!dateStr) return '...';
                const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                
                const dt = new Date(dateStr);
                if (isNaN(dt.getTime())) return dateStr;
                
                const dayName = days[dt.getDay()];
                const dateNum = dt.getDate();
                const monthName = months[dt.getMonth()];
                const year = dt.getFullYear();
                
                function terbilang(n) {
                    const words = ["nol", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas"];
                    if (n < 12) return words[n];
                    if (n < 20) return terbilang(n - 10) + " belas";
                    if (n < 100) return terbilang(Math.floor(n / 10)) + " puluh " + (n % 10 !== 0 ? terbilang(n % 10) : "");
                    if (n < 200) return "seratus " + terbilang(n - 100);
                    if (n < 1000) return terbilang(Math.floor(n / 100)) + " ratus " + (n % 100 !== 0 ? terbilang(n % 100) : "");
                    if (n < 2000) return "seribu " + terbilang(n - 1000);
                    if (n < 1000000) return terbilang(Math.floor(n / 1000)) + " ribu " + (n % 1000 !== 0 ? terbilang(n % 1000) : "");
                    return n;
                }
                
                return `${dayName} tanggal ${terbilang(dateNum)} bulan ${monthName} tahun ${terbilang(year)}`;
            }

            function formatLongDate(dateStr) {
                if (!dateStr) return '-';
                const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                const dt = new Date(dateStr);
                if (isNaN(dt.getTime())) return dateStr;
                return `${dt.getDate()} ${months[dt.getMonth()]} ${dt.getFullYear()}`;
            }

            function formatDateTime(dateTimeStr) {
                if (!dateTimeStr) return null;
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
            }

            function calculateGradeLetter(score, kodePenilaian) {
                var kode = kodePenilaian || 1;
                var rules = gradeRules[kode] || [
                    { min: 91, grade: 'A' }, { min: 86, grade: 'A-' }, { min: 81, grade: 'B+' },
                    { min: 76, grade: 'B' }, { min: 71, grade: 'B-' }, { min: 66, grade: 'C+' },
                    { min: 60, grade: 'C' }, { min: 55, grade: 'C-' }, { min: 50, grade: 'D+' },
                    { min: 40, grade: 'D' }, { min: 0, grade: 'E' }
                ];
                for (var i = 0; i < rules.length; i++) {
                    if (score >= rules[i].min) {
                        return rules[i].grade;
                    }
                }
                return 'E';
            }

            function isAspectMatch(dbAspek, targetAspek) {
                let dbVal = (dbAspek || '').toLowerCase().trim();
                let targetVal = (targetAspek || '').toLowerCase().trim();
                if (dbVal === targetVal) return true;
                if (dbVal === 'substansi' && targetVal.indexOf('substansi') !== -1) return true;
                if (dbVal === 'ujian' && targetVal.indexOf('ujian') !== -1) return true;
                return false;
            }

            // Fetch rules
            $.ajax({
                type: "GET",
                url: "{{ config('setting.second_url') }}dosen/skripsi/list-mahasiswa-diuji",
                headers: { "Authorization": 'Bearer ' + token, "username": userlogin },
                success: function(json) {
                    if (json.grade_rules) {
                        gradeRules = json.grade_rules;
                    }
                    loadBeritaAcaraData();
                },
                error: function() {
                    loadBeritaAcaraData();
                }
            });

            function loadBeritaAcaraData() {
                $.ajax({
                    type: 'GET',
                    dataType: "json",
                    url: "{{ config('setting.second_url') }}dosen/skripsi/berita-acara/" + id_skripsi_ujian,
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    success: function(res) {
                        if (res.status === 'success') {
                            const data = res.data;
                            const u = data.ujian;
                            const ba = data.berita_acara;
                            const nilais = data.nilai_indikator || [];
                            const isObe = u.is_obe == 1;
                            const currentStudentKodePenilaian = u.kode_penilaian || 1;
                            const aspects = data.aspek && data.aspek.length > 0 ? data.aspek : [
                                { nama_aspek: 'Substansi dan Luaran', bobot: 60.00 },
                                { nama_aspek: 'Ujian / Presentasi', bobot: 40.00 }
                            ];

                            // 1. Populate Page 1 Header & Info
                            $('#header_fakultas').text(u.nama_fakultas ? u.nama_fakultas.toUpperCase() : 'FAKULTAS');
                            $('#ba_title').text(isObe ? 'BERITA ACARA UJIAN SIDANG SKRIPSI BERBASIS OBE' : 'BERITA ACARA UJIAN SIDANG SKRIPSI');
                            $('#ba_nomor').text(ba && ba.id ? `BA/SKR/${ba.id}/${new Date(u.tanggal_ujian).getFullYear()}` : '___/___/___/2026');
                            $('#ba_hari_tanggal_indo').text(dateToIndonesianText(u.tanggal_ujian));
                            
                            $('#mhs_nama').text(u.nama_mahasiswa);
                            $('#mhs_nim').text(u.nim);
                            $('#skripsi_judul').text(u.judul || '-');

                            $('#ba_tgl_cetak').text(formatLongDate(u.tanggal_ujian));
                            $('#sign_nama_fakultas').text(u.nama_fakultas || '...');
                            $('#sign_dekan_nama').text(u.nama_dekan || '...');
                            $('#sign_dekan_nidn').text(u.nidn_dekan || '...');
                            $('#sign_kaprodi_nama').text(u.nama_kaprodi || '...');
                            $('#sign_kaprodi_nidn').text(u.nidn_kaprodi || '...');

                            // 2. Tim Penguji Table Page 1
                            let timHtml = '';
                            let index = 1;
                            const examiners = [
                                { id: u.id_penguji1, name: u.nama_penguji1, nidn: u.nidn_penguji1, role: 'penguji1' },
                                { id: u.id_penguji2, name: u.nama_penguji2, nidn: u.nidn_penguji2, role: 'penguji2' },
                                { id: u.id_penguji3, name: u.nama_penguji3, nidn: u.nidn_penguji3, role: 'penguji3' }
                            ].filter(ex => ex.id !== null);

                            examiners.forEach(ex => {
                                timHtml += `
                                    <tr>
                                        <td>${index++}.</td>
                                        <td class="font-bold">${getRoleLabel(ex.role, isObe)}</td>
                                        <td class="text-left font-bold">${ex.name}</td>
                                        <td>${ex.nidn || '-'}</td>
                                    </tr>
                                `;
                            });
                            $('#tbody_tim_penguji').html(timHtml);

                            // 3. Process scores per examiner
                            let totalFinalAngka = 0;
                            let examinerRowsHtml = '';
                            let individualPagesHtml = '';

                            index = 1;
                            examiners.forEach(ex => {
                                let exScores = nilais.filter(n => n.id_dosen == ex.id);
                                let exFinal = 0;
                                let tipe_bobot = exScores.length > 0 ? (exScores[0].tipe_bobot || 'indikator') : 'indikator';
                                
                                if (tipe_bobot === 'tunggal') {
                                    let sumAspectWeighted = 0;
                                    aspects.forEach(a => {
                                        let aspectScores = exScores.filter(n => isAspectMatch(n.aspek, a.nama_aspek));
                                        let avg = aspectScores.length > 0 ? (aspectScores.reduce((sum, n) => sum + parseFloat(n.nilai), 0) / aspectScores.length) : 0;
                                        sumAspectWeighted += avg * (parseFloat(a.bobot) / 100);
                                    });
                                    exFinal = sumAspectWeighted;
                                } else {
                                    let sumWeighted = 0;
                                    let sumBobot = 0;
                                    exScores.forEach(n => {
                                        sumWeighted += parseFloat(n.nilai) * parseFloat(n.bobot);
                                        sumBobot += parseFloat(n.bobot);
                                    });
                                    exFinal = sumBobot > 0 ? (sumWeighted / sumBobot) : 0;
                                }

                                totalFinalAngka += exFinal;
                                let letter = calculateGradeLetter(exFinal, currentStudentKodePenilaian);

                                // Examiner signature status
                                let ttdStatus = ba ? ba[`setuju_${ex.role}`] : null;
                                let ttdBadge = '';
                                if (ttdStatus) {
                                    ttdBadge = `<span style="color:#28a745; font-weight:bold;">✓ Ttd digital<br><span style="font-size:7pt; font-weight:normal;">${formatDateTime(ttdStatus)}</span></span>`;
                                } else {
                                    ttdBadge = `<span style="color:#dc3545; font-weight:bold;">Belum Ttd</span>`;
                                }

                                examinerRowsHtml += `
                                    <tr>
                                        <td>${index}.</td>
                                        <td class="text-left font-bold">${ex.name}</td>
                                        <td class="font-bold">${exFinal.toFixed(2)}</td>
                                        <td class="font-bold text-success">${letter}</td>
                                        <td>${ttdBadge}</td>
                                    </tr>
                                `;

                                // Construct individual scoring page (Page 2+)
                                individualPagesHtml += `
                                    <div class="page-break">
                                        <!-- Kop Surat -->
                                        <table class="header-table">
                                            <tr>
                                                <td class="header-logo">
                                                    <img src="${url('imageup45/logoumuka.png')}" style="width: 75px;" alt="Logo UMUKA">
                                                </td>
                                                <td>
                                                    <div class="header-text">UNIVERSITAS MUHAMMADIYAH KARANGANYAR</div>
                                                    <div class="header-text" style="font-size: 12pt; margin-top: 2px;">${u.nama_fakultas ? u.nama_fakultas.toUpperCase() : 'FAKULTAS'}</div>
                                                    <div class="header-subtext">
                                                        Jl. Raya Solo-Tawangmangu Km 12, Papahan, Kec. Tasikmadu, Kabupaten Karanganyar, Jawa Tengah 57722
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>

                                        <div class="title">FORM PENILAIAN UJIAN SKRIPSI</div>
                                        
                                        <table class="meta-table" style="margin-left: 10px;">
                                            <tr>
                                                <td class="meta-label">Nama Mahasiswa</td>
                                                <td class="meta-separator">:</td>
                                                <td class="meta-value font-bold">${u.nama_mahasiswa}</td>
                                            </tr>
                                            <tr>
                                                <td class="meta-label">NIM</td>
                                                <td class="meta-separator">:</td>
                                                <td class="meta-value font-bold">${u.nim}</td>
                                            </tr>
                                            <tr>
                                                <td class="meta-label">Judul Skripsi</td>
                                                <td class="meta-separator">:</td>
                                                <td class="meta-value font-bold" style="font-style: italic;">${u.judul || '-'}</td>
                                            </tr>
                                        </table>

                                        <table class="score-table">
                                            <thead>
                                                <tr>
                                                    <th style="width: 5%;">No</th>
                                                    <th style="width: 45%; text-align: left;">Kriteria / Indikator Penilaian</th>
                                                    <th style="width: 15%;">Bobot (%)</th>
                                                    <th style="width: 15%;">Nilai (0-100)</th>
                                                    <th style="width: 20%;">Nilai Terbobot</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                `;

                                let idx_row = 1;
                                let alphabet = ['A', 'B', 'C', 'D', 'E', 'F'];
                                
                                if (tipe_bobot === 'tunggal') {
                                    aspects.forEach((a) => {
                                        let aspectScores = exScores.filter(n => isAspectMatch(n.aspek, a.nama_aspek));
                                        if (aspectScores.length > 0) {
                                            let val = aspectScores.reduce((sum, n) => sum + parseFloat(n.nilai), 0) / aspectScores.length;
                                            let bobotVal = parseFloat(a.bobot);
                                            let weighted = (val * bobotVal) / 100;
                                            individualPagesHtml += `
                                                <tr>
                                                    <td>${idx_row++}</td>
                                                    <td class="text-left font-bold">Aspek ${a.nama_aspek}</td>
                                                    <td>${bobotVal.toFixed(2)}%</td>
                                                    <td>${val.toFixed(2)}</td>
                                                    <td class="font-bold">${weighted.toFixed(2)}</td>
                                                </tr>
                                            `;
                                        }
                                    });
                                } else {
                                    aspects.forEach((a, aIdx) => {
                                        let aspectScores = exScores.filter(n => isAspectMatch(n.aspek, a.nama_aspek));
                                        if (aspectScores.length > 0) {
                                            let label = alphabet[aIdx] || String.fromCharCode(65 + aIdx);
                                            individualPagesHtml += `<tr style="background-color:#fafafa;"><td colspan="5" class="text-left font-bold">${label}. Aspek ${a.nama_aspek} (Bobot: ${parseFloat(a.bobot).toFixed(0)}%)</td></tr>`;
                                            aspectScores.forEach(n => {
                                                let bobotVal = parseFloat(n.bobot);
                                                let val = parseFloat(n.nilai);
                                                let weighted = (val * bobotVal) / 100;
                                                individualPagesHtml += `
                                                    <tr>
                                                        <td>${idx_row++}</td>
                                                        <td class="text-left">${n.nama_indikator}</td>
                                                        <td>${bobotVal.toFixed(2)}%</td>
                                                        <td>${val.toFixed(2)}</td>
                                                        <td class="font-bold">${weighted.toFixed(2)}</td>
                                                    </tr>
                                                `;
                                            });
                                        }
                                    });
                                }

                                individualPagesHtml += `
                                                <tr style="background-color:#f2f2f2;">
                                                    <td colspan="2" class="text-left font-bold">TOTAL NILAI AKHIR KUMULATIF</td>
                                                    <td class="font-bold">100%</td>
                                                    <td></td>
                                                    <td class="font-bold text-primary" style="font-size:12pt;">${exFinal.toFixed(2)}</td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <table class="signature-table" style="width: 100%; margin-top: 15px;">
                                            <tr>
                                                <td style="width: 50%;">
                                                    <table class="scale-table">
                                                        <thead>
                                                            <tr>
                                                                <th>SKALA 100</th>
                                                                <th>SKALA 4</th>
                                                                <th>PREDIKAT</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr><td>91 - 100</td><td>4.0</td><td>A</td></tr>
                                                            <tr><td>86 - 90</td><td>3.6</td><td>A-</td></tr>
                                                            <tr><td>81 - 85</td><td>3.3</td><td>B+</td></tr>
                                                            <tr><td>76 - 80</td><td>3.0</td><td>B</td></tr>
                                                            <tr><td>71 - 75</td><td>2.7</td><td>B-</td></tr>
                                                            <tr><td>66 - 70</td><td>2.4</td><td>C+</td></tr>
                                                            <tr><td>60 - 65</td><td>2.0</td><td>C</td></tr>
                                                            <tr><td>55 - 59</td><td>1.7</td><td>C-</td></tr>
                                                            <tr><td>50 - 54</td><td>1.4</td><td>D+</td></tr>
                                                            <tr><td>40 - 49</td><td>1.0</td><td>D</td></tr>
                                                            <tr><td>0 - 39</td><td>0.0</td><td>E</td></tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                                <td style="width: 50%; text-align: center; vertical-align: middle;">
                                                    Karanganyar, ${formatLongDate(u.tanggal_ujian)}<br>
                                                    <span class="font-bold">${getRoleLabel(ex.role, isObe)}</span>
                                                    <br><br>
                                                    ${ttdStatus ? `
                                                        <div class="qr-placeholder"><i class="fa fa-check"></i></div>
                                                        <div class="signature-status-signed">✓ VERIFIKASI ELEKTRONIK</div>
                                                    ` : `
                                                        <div style="height: 50px;"></div>
                                                        <div class="signature-status-pending">Belum Tanda Tangan</div>
                                                    `}
                                                    <br><br>
                                                    <span class="font-bold" style="text-decoration: underline;">${ex.name}</span><br>
                                                    NIDN. ${ex.nidn || '-'}
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                `;

                                index++;
                            });

                            $('#tbody_penilaian_penguji').html(examinerRowsHtml);
                            $('#individual_scoring_pages').html(individualPagesHtml);

                            // 4. Calculate Final Cumulative Grade
                            let finalKumulatif = examiners.length > 0 ? (totalFinalAngka / examiners.length) : 0;
                            let letterKumulatif = calculateGradeLetter(finalKumulatif, currentStudentKodePenilaian);

                            // Append Consolidated row to Penilaian Tim Penguji Table
                            $('#tbody_penilaian_penguji').append(`
                                <tr style="background-color:#f2f2f2;">
                                    <td colspan="2" class="text-left font-bold">NILAI AKHIR KUMULATIF (RATA-RATA)</td>
                                    <td class="font-bold" style="font-size:12pt; color:#007bff;">${finalKumulatif.toFixed(2)}</td>
                                    <td class="font-bold text-success" style="font-size:12pt;">${letterKumulatif}</td>
                                    <td></td>
                                </tr>
                            `);

                            // Check dynamic status box
                            let catatanText = (ba && ba.catatan) ? ba.catatan.toLowerCase() : '';
                            if (u.status === 'lulus') {
                                if (catatanText.trim() === '' || catatanText.includes('tidak ada') || catatanText.includes('tanpa revisi') || catatanText.includes('tanpa perbaikan') || catatanText.includes('tanpa revisi')) {
                                    $('#cb_lulus_tanpa_perbaikan').html('✓');
                                } else {
                                    $('#cb_lulus_dengan_perbaikan').html('✓');
                                }
                            } else if (u.status === 'tidak_lulus') {
                                if (catatanText.includes('judul baru') || catatanText.includes('menulis baru') || catatanText.includes('ganti judul')) {
                                    $('#cb_tidak_lulus_judul_baru').html('✓');
                                } else {
                                    $('#cb_tidak_lulus_ujian_ulang').html('✓');
                                }
                            }

                            // 5. Trigger print dialogue
                            setTimeout(function() {
                                window.print();
                            }, 500);
                        }
                    }
                });
            }

            function url(path) {
                return "{{ url('/') }}/" + path;
            }
        });
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</body>

</html>
