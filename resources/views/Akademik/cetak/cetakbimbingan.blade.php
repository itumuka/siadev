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

        .header-table {
            width: 100%;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }

        .header-logo {
            width: 80px;
            padding-right: 15px;
        }

        .header-text {
            font-size: 14pt;
            font-weight: bold;
            text-align: center;
        }

        .header-subtext {
            font-size: 9pt;
            font-weight: normal;
            text-align: center;
            margin-top: 5px;
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

        .log-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            margin-bottom: 15px;
        }

        .log-table th,
        .log-table td {
            border: 1px solid #000;
            padding: 6px 6px;
            text-align: center;
            font-size: 10pt;
        }

        .log-table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .text-left {
            text-align: left !important;
        }

        .font-bold {
            font-weight: bold;
        }

        .signature-section {
            width: 100%;
            margin-top: 25px;
        }

        .signature-grid {
            width: 100%;
            table-layout: fixed;
        }

        .signature-col {
            text-align: center;
            vertical-align: top;
            padding: 5px;
        }

        .signature-status-signed {
            color: #155724;
            font-weight: bold;
            font-size: 7.5pt;
            margin: 3px auto;
            border: 1px solid #c3e6cb;
            background-color: #d4edda;
            padding: 3px;
            border-radius: 4px;
            width: fit-content;
            max-width: 90%;
            line-height: 1.1;
        }

        .row-qrcode img, .row-qrcode canvas { 
            width: 55px; 
            height: 55px; 
            display: block; 
            margin: 0 auto;
        }
        #qrcode_kaprodi_container img, #qrcode_kaprodi_container canvas,
        #qrcode_pembimbing1_container img, #qrcode_pembimbing1_container canvas { 
            width: 75px; 
            height: 75px; 
            display: block; 
            margin: 0 auto;
        }

        .footer-date {
            text-align: right;
            margin-bottom: 10px;
            margin-right: 30px;
            font-style: italic;
        }
    </style>
</head>

<body>
    <input type="hidden" id="nim" value="{{ $nim }}">

    <!-- Kop Surat -->
    <table class="header-table">
        <tr>
            <td class="header-logo">
                <img src="{{ url('imageup45/logoumuka.png') }}" style="width: 80px;" alt="Logo UMUKA">
            </td>
            <td>
                <div class="header-text">UNIVERSITAS MUHAMMADIYAH KARANGANYAR</div>
                <div class="header-text" id="nama_fakultas" style="font-size: 12pt; margin-top: 2px;">FAKULTAS TEKNOLOGI & SAINS</div>
                <div class="header-subtext">
                    Jl. Raya Solo-Tawangmangu Km 12, Papahan, Kec. Tasikmadu, Kabupaten Karanganyar, Jawa Tengah 57722
                </div>
            </td>
        </tr>
    </table>

    <div class="title">
        BLANKO BIMBINGAN TUGAS AKHIR / SKRIPSI
    </div>

    <!-- Meta Information -->
    <table class="meta-table">
        <tr>
            <td class="meta-label">Nama Mahasiswa</td>
            <td class="meta-separator">:</td>
            <td class="meta-value font-bold" id="mhs_nama">Loading...</td>
        </tr>
        <tr>
            <td class="meta-label">NIM</td>
            <td class="meta-separator">:</td>
            <td class="meta-value" id="mhs_nim">Loading...</td>
        </tr>
        <tr>
            <td class="meta-label">Program Studi</td>
            <td class="meta-separator">:</td>
            <td class="meta-value" id="mhs_prodi">Loading...</td>
        </tr>
        <tr>
            <td class="meta-label">Judul Skripsi</td>
            <td class="meta-separator">:</td>
            <td class="meta-value font-bold" style="font-style: italic;" id="skripsi_judul">Loading...</td>
        </tr>
        <tr>
            <td class="meta-label">Dosen Pembimbing I</td>
            <td class="meta-separator">:</td>
            <td class="meta-value" id="pembimbing1">Loading...</td>
        </tr>
        <tr id="row_pembimbing2" style="display:none;">
            <td class="meta-label">Dosen Pembimbing II</td>
            <td class="meta-separator">:</td>
            <td class="meta-value" id="pembimbing2">-</td>
        </tr>
    </table>

    <p style="font-size: 10pt; margin-bottom: 5px;"><strong>Proses Pembimbingan:</strong></p>

    <!-- Logs Table -->
    <table class="log-table">
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 15%;">Tanggal</th>
                <th class="text-left" style="width: 50%;">Uraian / Materi Pembimbingan</th>
                <th style="width: 15%;">Paraf Mhs</th>
                <th style="width: 15%;">Ttd Pembimbing</th>
            </tr>
        </thead>
        <tbody id="tbody_logs">
            <tr>
                <td colspan="5">Memuat riwayat bimbingan...</td>
            </tr>
        </tbody>
    </table>

    <div class="footer-date">
        Karanganyar, <span id="tgl_cetak">{{ $tgl }}</span>
    </div>

    <!-- Signature Section -->
    <table class="signature-grid" style="width: 100%; margin-top: 10px;">
        <tr>
            <td class="signature-col" style="width: 50%;">
                <div>Ketua Program Studi</div>
                <div id="qrcode_kaprodi_container" style="width: 75px; height: 75px; margin: 8px auto;"></div>
                <div class="font-bold" id="sign_kaprodi">-</div>
                <div style="font-size: 9pt;" id="nidn_kaprodi">NIDN. -</div>
            </td>
            <td class="signature-col" style="width: 50%;">
                <div>Dosen Pembimbing I</div>
                <div id="qrcode_pembimbing1_container" style="width: 75px; height: 75px; margin: 8px auto;"></div>
                <div class="font-bold" id="sign_pembimbing1">-</div>
                <div style="font-size: 9pt;" id="nidn_pembimbing1">NIDN. -</div>
            </td>
        </tr>
    </table>

    <script src="{{ URL::asset('js/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('js/qrcode.js') }}"></script>
    <script>
        $(document).ready(function() {
            const token = "{{ Session::get('token') }}";
            const userlogin = "{{ Session::get('username') }}";
            const nim = $('#nim').val();

            function formatDate(dateStr) {
                if (!dateStr) return '-';
                const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
                const dt = new Date(dateStr);
                if (isNaN(dt.getTime())) return dateStr;
                return dt.getDate() + ' ' + months[dt.getMonth()] + ' ' + dt.getFullYear();
            }

            $.ajax({
                type: 'GET',
                dataType: "json",
                url: "{{ config('setting.second_url') }}akademik/skripsi/bimbingan/cetak-data",
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                data: { nim: nim },
                success: function(res) {
                    if (res.status === 'success') {
                        const m = res.data.mahasiswa;
                        const s = res.data.skripsi;
                        const logs = res.data.logs || [];

                        // 1. Profil
                        $('#mhs_nama').text(m.nama_mahasiswa);
                        $('#mhs_nim').text(m.nim);
                        $('#mhs_prodi').text(m.nama_program_studi);
                        if (m.nama_fakultas) {
                            $('#nama_fakultas').text('FAKULTAS ' + m.nama_fakultas.toUpperCase());
                        }

                        // 2. Skripsi & Pembimbing
                        if (s) {
                            $('#skripsi_judul').text(s.judul || '-');
                            $('#pembimbing1').text(s.nama_pembimbing1 || '-');
                            $('#sign_pembimbing1').text(s.nama_pembimbing1 || '-');
                            $('#nidn_pembimbing1').text('NIDN. ' + (s.nidn_pembimbing1 || '-'));

                            if (s.nama_pembimbing2) {
                                $('#pembimbing2').text(s.nama_pembimbing2);
                                $('#row_pembimbing2').show();
                            }
                        }

                        // 3. Kaprodi Sign
                        $('#sign_kaprodi').text(m.nama_kaprodi || '-');
                        $('#nidn_kaprodi').text('NIDN. ' + (m.nidn_kaprodi || '-'));

                        // 4. Render logs table
                        let html = '';
                        const totalRows = Math.max(8, logs.length);

                        for (let i = 0; i < totalRows; i++) {
                            const index = i + 1;
                            if (i < logs.length) {
                                const log = logs[i];
                                const formattedDate = formatDate(log.tanggal);
                                const description = `<strong>${log.topik}</strong><br><span style="color:#444; font-size:9.5pt;">${log.uraian || ''}</span>`;
                                
                                const statusBadge = `<div class="signature-status-signed">✓ VERIFIKASI DIGITAL</div>`;
                                const dosenBadge = `<div class="row-qrcode" data-valid-id="${log.valid_id || ''}" id="row_qr_${log.id}" style="width: 55px; height: 55px; margin: 0 auto;"></div>`;

                                html += `<tr>
                                    <td>${index}</td>
                                    <td>${formattedDate}</td>
                                    <td class="text-left">${description}</td>
                                    <td>${statusBadge}</td>
                                    <td>${dosenBadge}</td>
                                </tr>`;
                            } else {
                                // Empty row for padding/manual entries
                                html += `<tr style="height: 45px;">
                                    <td>${index}</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>`;
                            }
                        }

                        $('#tbody_logs').html(html);

                        // Generate QRCodes dynamically for rows
                        logs.forEach(function(log) {
                            if (log.valid_id) {
                                new QRCode(document.getElementById("row_qr_" + log.id), {
                                    text: log.valid_id,
                                    width: 55,
                                    height: 55,
                                    colorDark : "#000000",
                                    colorLight : "#ffffff",
                                    correctLevel : QRCode.CorrectLevel.M
                                });
                            }
                        });

                        // Generate QRCode for Kaprodi
                        if (m.valid_id_kaprodi) {
                            new QRCode(document.getElementById("qrcode_kaprodi_container"), {
                                text: m.valid_id_kaprodi,
                                width: 75,
                                height: 75,
                                colorDark : "#000000",
                                colorLight : "#ffffff",
                                correctLevel : QRCode.CorrectLevel.M
                            });
                        }

                        // Generate QRCode for Pembimbing I
                        if (s && s.valid_id_pembimbing1) {
                            new QRCode(document.getElementById("qrcode_pembimbing1_container"), {
                                text: s.valid_id_pembimbing1,
                                width: 75,
                                height: 75,
                                colorDark : "#000000",
                                colorLight : "#ffffff",
                                correctLevel : QRCode.CorrectLevel.M
                            });
                        }

                        // Trigger print dialogue after resources load
                        setTimeout(function() {
                            window.print();
                        }, 800);
                    }
                },
                error: function() {
                    $('#tbody_logs').html('<tr><td colspan="5" class="text-danger">Gagal memuat data cetakan.</td></tr>');
                }
            });
        });
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</body>

</html>
