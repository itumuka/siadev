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
            font-size: 14pt;
            font-weight: bold;
            text-align: center;
            margin-top: 20px;
            margin-bottom: 20px;
            text-transform: uppercase;
            text-decoration: underline;
        }

        .meta-table {
            width: 100%;
            margin-bottom: 20px;
        }

        .meta-table td {
            padding: 4px 0;
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
            margin-top: 15px;
            margin-bottom: 20px;
        }

        .score-table th,
        .score-table td {
            border: 1px solid #000;
            padding: 8px 6px;
            text-align: center;
        }

        .score-table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .text-left {
            text-align: left !important;
        }

        .font-bold {
            font-weight: bold;
        }

        .notes-box {
            border: 1px solid #000;
            padding: 10px;
            margin-top: 15px;
            margin-bottom: 30px;
            min-height: 80px;
        }

        .signature-section {
            width: 100%;
            margin-top: 30px;
        }

        .signature-title {
            text-align: center;
            font-weight: bold;
            margin-bottom: 40px;
        }

        .signature-grid {
            width: 100%;
            table-layout: fixed;
        }

        .signature-col {
            text-align: center;
            vertical-align: top;
            padding: 10px;
            border: 1px dashed #ccc;
            border-radius: 4px;
            background-color: #fafafa;
        }

        .signature-status-signed {
            color: #155724;
            font-weight: bold;
            font-size: 8.5pt;
            margin-top: 8px;
            border: 1px solid #c3e6cb;
            background-color: #d4edda;
            padding: 4px;
            border-radius: 4px;
        }

        .signature-status-pending {
            color: #721c24;
            font-weight: bold;
            font-size: 8.5pt;
            margin-top: 8px;
            border: 1px solid #f5c6cb;
            background-color: #f8d7da;
            padding: 4px;
            border-radius: 4px;
        }

        .qr-placeholder {
            margin: 10px auto;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #28a745;
            color: #28a745;
            font-size: 20px;
            border-radius: 50%;
            background-color: #fff;
        }

        .footer-date {
            text-align: right;
            margin-bottom: 15px;
            font-style: italic;
        }
    </style>
</head>

<body>
    <input type="hidden" id="id_skripsi_ujian" value="{{ $id_skripsi_ujian }}">

    <!-- Kop Surat -->
    <table class="header-table">
        <tr>
            <td class="header-logo">
                <img src="{{ url('imageup45/logoumuka.png') }}" style="width: 80px;" alt="Logo UMUKA">
            </td>
            <td>
                <div class="header-text">UNIVERSITAS MUHAMMADIYAH KARANGANYAR</div>
                <div class="header-text" id="nama_fakultas" style="font-size: 13pt; margin-top: 2px;">FAKULTAS TEKNOLOGI & SAINS</div>
                <div class="header-subtext">
                    Jl. Raya Solo-Tawangmangu Km 12, Papahan, Kec. Tasikmadu, Kabupaten Karanganyar, Jawa Tengah 57722
                </div>
            </td>
        </tr>
    </table>

    <div class="title">
        BERITA ACARA UJIAN SKRIPSI / TUGAS AKHIR
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
            <td class="meta-label">Hari & Tanggal Ujian</td>
            <td class="meta-separator">:</td>
            <td class="meta-value" id="ujian_hari_tgl">Loading...</td>
        </tr>
        <tr>
            <td class="meta-label">Waktu / Jam Ujian</td>
            <td class="meta-separator">:</td>
            <td class="meta-value" id="ujian_waktu">Loading...</td>
        </tr>
        <tr>
            <td class="meta-label">Tempat / Ruang</td>
            <td class="meta-separator">:</td>
            <td class="meta-value" id="ujian_ruang">Loading...</td>
        </tr>
    </table>

    <p>Berdasarkan hasil penilaian Tim Dewan Penguji pada pelaksanaan Ujian Akhir Skripsi/Tugas Akhir, dengan ini dinyatakan rincian perolehan nilai Capaian Pembelajaran Mata Kuliah (CPMK) sebagai berikut:</p>

    <!-- CPMK Table -->
    <table class="score-table">
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th class="text-left" style="width: 45%;">Kriteria / Rubrik CPMK</th>
                <th style="width: 10%;">Bobot</th>
                <th style="width: 11%;">Penguji 1</th>
                <th style="width: 11%;">Penguji 2</th>
                <th style="width: 11%;">Penguji 3</th>
                <th style="width: 12%;">Rata-rata</th>
            </tr>
        </thead>
        <tbody id="tbody_scores">
            <tr>
                <td colspan="7">Memuat rincian nilai...</td>
            </tr>
        </tbody>
    </table>

    <!-- Final Grade Table -->
    <table class="score-table" style="width: 50%; margin: 20px 0;">
        <tr>
            <th colspan="2">KONSOLIDASI NILAI AKHIR</th>
        </tr>
        <tr>
            <td class="font-bold text-left" style="width: 60%;">Nilai Rata-rata Angka</td>
            <td class="font-bold" id="final_angka">-</td>
        </tr>
        <tr>
            <td class="font-bold text-left">Nilai Huruf</td>
            <td class="font-bold text-success" id="final_huruf" style="font-size: 13pt;">-</td>
        </tr>
        <tr>
            <td class="font-bold text-left">Status Kelulusan</td>
            <td class="font-bold" id="status_kelulusan">-</td>
        </tr>
    </table>

    <div class="font-bold">Catatan Penguji / Perbaikan Ujian:</div>
    <div class="notes-box" id="catatan_box">
        -
    </div>

    <div class="footer-date">
        Karanganyar, <span id="tgl_cetak">{{ $tgl }}</span>
    </div>

    <!-- Signature Section -->
    <div class="signature-title">TIM DEWAN PENGUJI / TIM VERIFIKATOR</div>
    
    <table class="signature-grid" style="width: 100%;">
        <tr>
            <td class="signature-col" id="col_penguji1" style="width: 33%;">
                <div class="font-bold">Ketua Penguji</div>
                <div style="height: 10px;"></div>
                <div id="ttd_badge_p1"></div>
                <div style="height: 10px;"></div>
                <div class="font-bold" id="nama_p1">-</div>
            </td>
            <td style="width: 2%;"></td>
            <td class="signature-col" id="col_penguji2" style="width: 33%;">
                <div class="font-bold">Anggota Penguji 2</div>
                <div style="height: 10px;"></div>
                <div id="ttd_badge_p2"></div>
                <div style="height: 10px;"></div>
                <div class="font-bold" id="nama_p2">-</div>
            </td>
            <td style="width: 2%;"></td>
            <td class="signature-col" id="col_penguji3" style="width: 33%;">
                <div class="font-bold">Anggota Penguji 3</div>
                <div style="height: 10px;"></div>
                <div id="ttd_badge_p3"></div>
                <div style="height: 10px;"></div>
                <div class="font-bold" id="nama_p3">-</div>
            </td>
        </tr>
    </table>

    <script src="{{ URL::asset('js/jquery.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            const token = "{{ Session::get('token') }}";
            const userlogin = "{{ Session::get('username') }}";
            const id_skripsi_ujian = $('#id_skripsi_ujian').val();

            function formatLongDate(dateStr) {
                if (!dateStr) return '-';
                const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                
                const dt = new Date(dateStr);
                if (isNaN(dt.getTime())) return dateStr;
                
                const dayName = days[dt.getDay()];
                const dateNum = dt.getDate();
                const monthName = months[dt.getMonth()];
                const year = dt.getFullYear();
                
                return `${dayName}, ${dateNum} ${monthName} ${year}`;
            }

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
                        const nilais = data.nilai_cpmk || [];

                        // 1. Fill student details
                        $('#mhs_nama').text(u.nama_mahasiswa);
                        $('#mhs_nim').text(u.nim);
                        $('#mhs_prodi').text(u.nama_program_studi || '-');
                        $('#skripsi_judul').text(u.judul || '-');
                        $('#ujian_hari_tgl').text(formatLongDate(u.tanggal_ujian));
                        $('#ujian_waktu').text((u.jam_mulai ? u.jam_mulai.substring(0, 5) : '-') + ' WIB');
                        $('#ujian_ruang').text(u.ruang || '-');

                        // 2. Scores calculation & rendering
                        const cpmkMap = {};
                        nilais.forEach(function(n) {
                            if (!cpmkMap[n.id_cpmk]) {
                                cpmkMap[n.id_cpmk] = {
                                    kode_cpmk: n.kode_cpmk,
                                    nama_cpmk: n.nama_cpmk,
                                    bobot: n.bobot,
                                    scores: {}
                                };
                            }
                            cpmkMap[n.id_cpmk].scores[n.id_dosen] = parseFloat(n.nilai);
                        });

                        let cpmkHtml = '';
                        let index = 0;
                        for (let id_cpmk in cpmkMap) {
                            index++;
                            const item = cpmkMap[id_cpmk];
                            const score1 = item.scores[u.id_penguji1] !== undefined ? item.scores[u.id_penguji1].toFixed(2) : '-';
                            const score2 = item.scores[u.id_penguji2] !== undefined ? item.scores[u.id_penguji2].toFixed(2) : '-';
                            const score3 = item.scores[u.id_penguji3] !== undefined ? item.scores[u.id_penguji3].toFixed(2) : '-';
                            
                            const valids = [];
                            if (item.scores[u.id_penguji1] !== undefined) valids.push(item.scores[u.id_penguji1]);
                            if (item.scores[u.id_penguji2] !== undefined) valids.push(item.scores[u.id_penguji2]);
                            if (item.scores[u.id_penguji3] !== undefined) valids.push(item.scores[u.id_penguji3]);
                            const avg = valids.length > 0 ? (valids.reduce((a, b) => a + b, 0) / valids.length).toFixed(2) : '-';

                            cpmkHtml += `<tr>
                                <td>${index}</td>
                                <td class="text-left font-bold">${item.kode_cpmk} - ${item.nama_cpmk}</td>
                                <td>${parseFloat(item.bobot)}%</td>
                                <td>${score1}</td>
                                <td>${score2}</td>
                                <td>${score3}</td>
                                <td class="font-bold">${avg}</td>
                            </tr>`;
                        }

                        if (cpmkHtml === '') {
                            cpmkHtml = '<tr><td colspan="7">Belum ada nilai.</td></tr>';
                        }
                        $('#tbody_scores').html(cpmkHtml);

                        // 3. Consolidated values
                        const finalAngka = ba ? parseFloat(ba.nilai_angka).toFixed(2) : '-';
                        const finalHuruf = ba ? ba.nilai_huruf : '-';
                        $('#final_angka').text(finalAngka);
                        $('#final_huruf').text(finalHuruf);

                        let kelulusanText = 'BELUM DITETAPKAN';
                        if (u.status === 'ditetapkan' || u.status === 'lulus') {
                            kelulusanText = 'LULUS';
                        } else if (u.status === 'tidak_lulus') {
                            kelulusanText = 'TIDAK LULUS';
                        }
                        $('#status_kelulusan').text(kelulusanText);

                        // 4. Notes
                        $('#catatan_box').html(ba && ba.catatan ? ba.catatan : '<em>Tidak ada catatan perbaikan.</em>');

                        // 5. Signature verification
                        $('#nama_p1').text(u.nama_penguji1 || '-');
                        $('#nama_p2').text(u.nama_penguji2 || '-');
                        $('#nama_p3').text(u.nama_penguji3 || '-');

                        renderTtdBadge('#ttd_badge_p1', ba ? ba.setuju_penguji1 : null);
                        renderTtdBadge('#ttd_badge_p2', ba ? ba.setuju_penguji2 : null);
                        renderTtdBadge('#ttd_badge_p3', ba ? ba.setuju_penguji3 : null);

                        function renderTtdBadge(selector, timestamp) {
                            if (timestamp) {
                                $(selector).html(`
                                    <div class="qr-placeholder"><i class="fa fa-check"></i></div>
                                    <div class="signature-status-signed">
                                        ✓ DIVERIFIKASI ELEKTRONIK<br>
                                        <span style="font-size: 7.5pt; font-weight: normal;">
                                            ${formatDateTime(timestamp)}
                                        </span>
                                    </div>
                                `);
                            } else {
                                $(selector).html(`
                                    <div style="height: 50px;"></div>
                                    <div class="signature-status-pending">BELUM TANDA TANGAN</div>
                                `);
                            }
                        }

                        // Trigger print dialogue
                        setTimeout(function() {
                            window.print();
                        }, 500);
                    }
                }
            });
        });
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</body>

</html>
