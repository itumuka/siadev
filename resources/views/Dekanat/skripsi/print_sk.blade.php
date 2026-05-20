<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak SK Pembimbing - {{ $id }}</title>
    <style>
        @page { size: A4; margin: 2cm; }
        body { font-family: Arial, Helvetica, sans-serif; font-size: 11pt; line-height: 1.2; color: #000; background: #fff; }
        .page-break { page-break-after: always; }
        .header { text-align: center; margin-bottom: 10px; border-bottom: 3px solid #000; padding-bottom: 10px; }
        .header img { height: 80px; }
        .header h1 { font-size: 18pt; margin: 5px 0; }
        .header p { font-size: 10pt; margin: 0; }
        .section-title { text-align: center; font-weight: bold; text-decoration: underline; margin-top: 20px; text-transform: uppercase; }
        .nomor-sk { text-align: center; font-weight: bold; margin-bottom: 20px; }
        .content-table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        .content-table td { vertical-align: top; padding: 2px 0; }
        .label { width: 120px; font-weight: bold; }
        .separator { width: 20px; text-align: center; }
        .signature-box { float: right; width: 300px; text-align: left; margin-top: 30px; }
        .qr-code { margin: 10px 0; }
        .attachment-header { font-weight: bold; margin-bottom: 10px; }
        .table-data { width: 100%; border-collapse: collapse; margin-top: 15px; }
        .table-data th, .table-data td { border: 1px solid #000; padding: 6px; font-size: 10pt; text-align: left; }
        .table-data th { background-color: #f2f2f2; text-align: center; }
        .text-center { text-align: center !important; }
        .bold { font-weight: bold; }
        p.justify { text-align: justify; }
    </style>
</head>
<body>
    <!-- Halaman 1: Redaksi SK -->
    <div class="page-break">
        <!-- Kop Surat Digital -->
        <table style="width: 100%; border-collapse: collapse; border-bottom: 4px double #000; padding-bottom: 10px; margin-bottom: 20px;">
            <tr>
                <td style="width: 15%; text-align: center; vertical-align: middle;">
                    <img src="{{ asset('imageup45/logoumuka.png') }}" style="width: 85px; height: auto;" alt="Logo UMUKA">
                </td>
                <td style="width: 85%; text-align: center; vertical-align: middle; padding-left: 10px;">
                    <div style="font-size: 16pt; font-weight: bold; font-family: 'Arial Black', sans-serif; margin: 0; color: #1e3d59; letter-spacing: 0.5px; text-transform: uppercase;">Universitas Muhammadiyah Karanganyar</div>
                    <div style="font-size: 13pt; font-weight: bold; margin: 2px 0; color: #000; text-transform: uppercase;">Fakultas <span class="nama_fakultas_val">...</span></div>
                    <div style="font-size: 8.5pt; font-style: italic; margin: 2px 0; color: #555;">"Cerdas Membangun Peradaban Utama"</div>
                    <div style="font-size: 8.5pt; margin: 2px 0; color: #333;">Jl. Raya Solo-Tawangmangu KM 12 Papahan Tasikmadu Karanganyar (57761)</div>
                    <div style="font-size: 8.5pt; margin: 2px 0; color: #333;">Website: www.umuka.ac.id | Email: umuka@umuka.ac.id | Admin: 08112801912</div>
                </td>
            </tr>
        </table>

        <div class="section-title">KEPUTUSAN DEKAN</div>
        <div id="sk_title" class="section-title" style="text-decoration: none; margin-top: 0;text-transform: uppercase;">
            FAKULTAS <span id="nama_fakultas">...</span><br>
            UNIVERSITAS MUHAMMADIYAH KARANGANYAR 
        </div>
        <div class="nomor-sk">NOMOR: <span id="no_sk">...</span></div>
        
        <div class="text-center bold">TENTANG</div>
        <div class="text-center bold" style="margin-bottom: 15px;">
            PENGANGKATAN DOSEN PEMBIMBING <span class="tipe_ta_upper_val">SKRIPSI</span><br>
            MAHASISWA PROGRAM STUDI <span class="display_prodi_val" style="text-decoration: none;text-transform: uppercase;">...</span><br>
            SEMESTER <span id="semester">...</span> TAHUN AKADEMIK <span id="tahun">...</span><br>
            FAKULTAS <span id="nama_fakultas_2" style="text-decoration: none;text-transform: uppercase;">...</span><br>
            UNIVERSITAS MUHAMMADIYAH KARANGANYAR
        </div>

        <div class="text-center bold" style="margin-bottom: 20px;">DEKAN FAKULTAS <span id="nama_fakultas_3" style="text-decoration: none;text-transform: uppercase;">...</span></div>

        <!-- Lafal Basmalah -->
        <div class="text-center italic bold" style="margin-bottom: 15px; font-size: 11pt; font-family: 'Times New Roman', serif;">
            Bismillahirrahmanirrahim
        </div>

        <table class="content-table">
            <tr>
                <td class="label" style="width: 100px;">Menimbang</td>
                <td class="separator">:</td>
                <td style="text-align: justify;">
                    <ol type="a" style="margin: 0; padding-left: 20px;">
                        <li>bahwa dalam rangka pelaksanaan penyusunan <span class="tipe_ta_val">...</span> mahasiswa Program Studi <span class="display_prodi_val">...</span>, perlu ditetapkan dosen pembimbing;</li>
                        <li>bahwa nama-nama dosen dan mahasiswa sebagaimana tercantum dalam lampiran surat keputusan ini dipandang memenuhi syarat untuk ditetapkan sebagai pembimbing dan peserta bimbingan <span class="tipe_ta_singkat_val">...</span>;</li>
                        <li>bahwa untuk maksud tersebut perlu diterbitkan Surat Keputusan Dekan.</li>
                    </ol>
                </td>
            </tr>
            <tr>
                <td class="label">Mengingat</td>
                <td class="separator">:</td>
                <td style="text-align: justify;">
                    <ol style="margin: 0; padding-left: 20px;">
                        <li>Undang-Undang Nomor 20 Tahun 2003 tentang Sistem Pendidikan Nasional (Lembaran Negara Republik Indonesia Tahun 2003 Nomor 78, Tambahan Lembaran Negara Republik Indonesia Nomor 4301);</li>
                        <li>Undang-Undang Nomor 12 Tahun 2012 tentang Pendidikan Tinggi (Lembaran Negara Republik Indonesia Tahun 2012 Nomor 158, Tambahan Lembaran Negara Republik Indonesia Nomor 533D);</li>
                        <li>Keputusan Menteri Pendidikan, Kebudayaan, Riset, dan Teknologi Nomor 332/E/O/2022 tentang Izin Penggabungan Akademi Peternakan Karanganyar di Kabupaten Karanganyar, Akademi Sekretari dan Manajemen Santa Ana di Kabupaten Boyolali, dan Akademi Pariwisata Widya Nusantara di Kota Surakarta menjadi Universitas Muhammadiyah Karanganyar Tertanggal 19 Mei 2022;</li>
                        <li>Pedoman Pimpinan Pusat Muhammadiyah Nomor 02/PED/I.O/B/2012 tentang Perguruan Tinggi Muhammadiyah;</li>
                        <li>Keputusan Pimpinan Pusat Muhammadiyah Nomor 661/KEP/I.0/D/2022 Tentang Pengangkatan Rektor Universitas Muhammadiyah Karanganyar Masa Jabatan 2022-2026 tanggal 22 Juli 2022;</li>
                    </ol>
                </td>
            </tr>
        </table>
    </div>

    <!-- Halaman 2: Keputusan & Tanda Tangan -->
    <div class="page-break">
        <div class="text-center bold" style="margin-top: 50px;">MEMUTUSKAN</div>
        <table class="content-table">
            <tr>
                <td class="label">Menetapkan</td>
                <td class="separator">:</td>
                <td class="bold"></td>
            </tr>
            <tr>
                <td class="label">Pertama</td>
                <td class="separator">:</td>
                <td>Mengangkat dan Menetapkan dosen Pembimbing <span class="tipe_ta_val">Skripsi</span> di lingkungan Program Studi <span class="display_prodi_val">...</span> sebagaimana tersebut dalam lampiran keputusan ini;</td>
            </tr>
            <tr>
                <td class="label">Kedua</td>
                <td class="separator">:</td>
                <td>Dosen pembimbing bertugas membimbing kegiatan penyusunan <span class="tipe_ta_val">Skripsi</span> pada program studi <span class="display_prodi_val">...</span>;</td>
            </tr>
            <tr>
                <td class="label">Ketiga</td>
                <td class="separator">:</td>
                <td>Segala biaya akibat Surat Keputusan ini dibebankan kepada Anggaran Belanja Universitas Muhammadiyah Karanganyar.</td>
            </tr>
            <tr>
                <td class="label">Keempat</td>
                <td class="separator">:</td>
                <td>Surat Keputusan ini mulai berlaku sejak tanggal ditetapkan.</td>
            </tr>
        </table>

        <div class="signature-box">
            <div>Ditetapkan di : Karanganyar</div>
            <div>Pada tanggal : <span id="tgl_sk">...</span></div>
            <div style="margin-top: 20px;" class="bold">DEKAN,</div>
            
            <div style="height: 80px;"></div> <!-- Spacer area kosong untuk tanda tangan basah -->

            <div class="bold" style="text-decoration: underline;"><span id="nama_dekan">...</span></div>
            <div>NIP. <span id="nip_dekan">...</span></div>
        </div>
    </div>

    <!-- Halaman 3: Lampiran -->
    <div>
        <div class="attachment-header">
            Lampiran I Keputusan Dekan<br>
            Nomor : <span class="no_sk">...</span><br>
            Tanggal : <span class="tgl_sk">...</span>
        </div>

        <div class="text-center bold" style="margin: 20px 0;">
            DAFTAR NAMA MAHASISWA DAN DOSEN PEMBIMBING <span class="tipe_ta_upper_val">SKRIPSI</span><br>
            PROGRAM STUDI <span class="display_prodi_val" style="text-transform: uppercase;">...</span><br>
            SEMESTER <span class="semester">...</span> TAHUN AKADEMIK <span class="tahun">...</span>
        </div>

        <table class="table-data">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="30%">Nama Dosen Pembimbing</th>
                    <th width="20%">Peran</th>
                    <th width="20%">Nama Mahasiswa & NIM</th>
                    <th>Judul Skripsi</th>
                </tr>
            </thead>
            <tbody id="mhs_list"></tbody>
        </table>

        <div class="signature-box" style="margin-top: 30px;">
            <div class="bold">DEKAN,</div>
            <div style="height: 60px;"></div>
            <div class="bold" style="text-decoration: underline;"><span class="nama_dekan">...</span></div>
            <div>NIP. <span class="nip_dekan">...</span></div>
        </div>
    </div>

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/qrcode.js') }}"></script>
    <script>
        const urlParams = new URLSearchParams(window.location.search);
        const customNo = urlParams.get('no');

        const CONFIG = {
            api_url: "{{ config('setting.second_url') }}",
            token: "{{ Session::get('token') }}",
            username: "{{ Session::get('username') }}",
            sk_id: "{{ $id }}"
        };

        $(document).ready(function() {
            $.ajax({
                url: CONFIG.api_url + "kaprodi/skripsi/get-sk-detail/" + CONFIG.sk_id,
                type: "GET",
                headers: { "Authorization": "Bearer " + CONFIG.token, "username": CONFIG.username },
                success: function(res) {
                    const sk = res.sk;
                    const mhs = res.mahasiswa;

                    // determine header program: if all mahasiswa share the same program, use it;
                    // otherwise indicate multiple programs
                    const prodiList = Array.from(new Set(mhs.map(i => i.nama_program_studi).filter(Boolean)));
                    let headerProdi = '';
                    if (prodiList.length === 1) {
                        headerProdi = prodiList[0];
                    } else if (prodiList.length === 2) {
                        headerProdi = prodiList[0] + ' dan ' + prodiList[1];
                    } else if (prodiList.length > 2) {
                        const last = prodiList.pop();
                        headerProdi = prodiList.join(', ') + ', dan ' + last;
                    } else {
                        headerProdi = sk.nama_program_studi || '';
                    }

                    // Determine jenjang (D3, S1, etc.)
                    const jenjangMap = {
                        '1': 'D3',
                        '2': 'S1',
                        '3': 'S2',
                        '4': 'S3',
                        '5': 'D4'
                    };

                    const jenjang = sk.kode_jenjang_pendidikan;
                    let tipeTa = "Skripsi";
                    let tipeTaSingkat = "Skripsi";

                    // Determine if D3 or D4 (Laporan Tugas Akhir)
                    const prodiNameForCheck = headerProdi.toUpperCase();
                    if (jenjang == '1' || jenjang == '5' || prodiNameForCheck.includes('D3') || prodiNameForCheck.includes('DIII') || prodiNameForCheck.includes('D4') || prodiNameForCheck.includes('DIV')) {
                        tipeTa = "Laporan Tugas Akhir (LTA)";
                        tipeTaSingkat = "LTA";
                    }

                    // Format prodi name prefix if missing (e.g. S1 Informatika, D3 Kebidanan)
                    let displayProdi = headerProdi;
                    const prefix = jenjangMap[jenjang] || '';
                    if (prefix && !displayProdi.toUpperCase().startsWith(prefix)) {
                        displayProdi = prefix + ' ' + displayProdi;
                    }

                    $('#no_sk, .no_sk').text(customNo || sk.no_sk);
                    $('#tgl_sk, .tgl_sk').text(new Date(sk.tgl_sk).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' })); 
                    $('#nama_fakultas, #nama_fakultas_2, #nama_fakultas_3, .nama_fakultas_val').text(sk.nama_fakultas);
                    $('.nama_prodi, #nama_prodi').text(headerProdi);
                    $('.display_prodi_val').text(displayProdi);
                    $('.tipe_ta_val').text(tipeTa);
                    $('.tipe_ta_singkat_val').text(tipeTaSingkat);
                    $('.tipe_ta_upper_val').text(tipeTa.toUpperCase());
                    $('.semester, #semester').text(sk.semester);
                    $('.tahun, #tahun').text(sk.tahun_akademik);
                    $('#nama_dekan, .nama_dekan').text((sk.gd_dekan ? sk.gd_dekan + ' ' : '') + sk.nama_dekan + (sk.gb_dekan ? ', ' + sk.gb_dekan : ''));
                    $('#nip_dekan, .nip_dekan').text(sk.nip_dekan);

                    // 1. Kelompokkan data berdasarkan Nama Dosen
                const dosenGroup = {};

                mhs.forEach(item => {
                    // Memproses Pembimbing 1
                    if (item.nama_p1 && item.nama_p1 !== '-') {
                        if (!dosenGroup[item.nama_p1]) dosenGroup[item.nama_p1] = [];
                        dosenGroup[item.nama_p1].push({
                            peran: 'Pembimbing Utama',
                            mahasiswa: item
                        });
                    }
                    
                    // Memproses Pembimbing 2 (jika ada)
                    if (item.nama_p2 && item.nama_p2 !== '-') {
                        if (!dosenGroup[item.nama_p2]) dosenGroup[item.nama_p2] = [];
                        dosenGroup[item.nama_p2].push({
                            peran: 'Pembimbing Pendamping',
                            mahasiswa: item
                        });
                    }
                });

                // 2. Render HTML dengan menggunakan rowspan
                let html = '';
                let noUrut = 1;

                // Loop melalui object yang sudah dikelompokkan
                for (const [namaDosen, bimbingan] of Object.entries(dosenGroup)) {
                    const totalBimbingan = bimbingan.length;

                    bimbingan.forEach((data, index) => {
                        html += `<tr>`;
                        
                        // Kolom Nomor dan Nama Dosen hanya di-render di baris pertama tiap kelompok
                        if (index === 0) {
                            html += `<td class="text-center" rowspan="${totalBimbingan}">${noUrut++}</td>`;
                            html += `<td rowspan="${totalBimbingan}" class="bold">${namaDosen}</td>`;
                        }
                        
                        // Kolom Peran, Nama Mahasiswa, dan Judul di-render untuk setiap baris
                        html += `<td class="text-center">${data.peran}</td>`;
                        html += `<td>${data.mahasiswa.nama_mhs}<br><span style="font-size: 9pt;">NIM. ${data.mahasiswa.nim}</span></td>`;
                        html += `<td style="font-size: 8pt; text-align: justify;">${data.mahasiswa.judul || '-'}</td>`;
                        html += `</tr>`;
                    });
                }

                $('#mhs_list').html(html);

                    // QR Code dijeda sementara untuk kebutuhan tanda tangan basah
                    // const validationUrl = "{{ url('/validasi/sk/') }}/" + sk.id;
                    // new QRCode(document.getElementById("qrcode"), {
                    //     text: validationUrl,
                    //     width: 80,
                    //     height: 80
                    // });

                    setTimeout(() => { window.print(); }, 1000);
                }
            });
        });
    </script>
</body>
</html>