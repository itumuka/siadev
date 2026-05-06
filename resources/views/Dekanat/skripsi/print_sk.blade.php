<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak SK Pembimbing - {{ $id }}</title>
    <style>
        @page { size: A4; margin: 2cm; }
        body { font-family: Arial, Helvetica, sans-serif; font-size: 11pt; line-height: 1.4; color: #000; background: #fff; }
        .page-break { page-break-after: always; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 3px solid #000; padding-bottom: 10px; }
        .header img { height: 80px; }
        .header h1 { font-size: 18pt; margin: 5px 0; }
        .header p { font-size: 10pt; margin: 0; }
        .section-title { text-align: center; font-weight: bold; text-decoration: underline; margin-top: 20px; text-transform: uppercase; }
        .nomor-sk { text-align: center; font-weight: bold; margin-bottom: 20px; }
        .content-table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        .content-table td { vertical-align: top; padding: 5px 0; }
        .label { width: 120px; font-weight: bold; }
        .separator { width: 20px; text-align: center; }
        .signature-box { float: right; width: 300px; text-align: left; margin-top: 50px; }
        .qr-code { margin: 10px 0; }
        .attachment-header { font-weight: bold; margin-bottom: 10px; }
        .table-data { width: 100%; border-collapse: collapse; margin-top: 15px; }
        .table-data th, .table-data td { border: 1px solid #000; padding: 8px; font-size: 10pt; text-align: left; }
        .table-data th { background-color: #f2f2f2; text-align: center; }
        .text-center { text-align: center !important; }
        .bold { font-weight: bold; }
        p.justify { text-align: justify; }
    </style>
</head>
<body>
    <!-- Halaman 1: Redaksi SK -->
    <div class="page-break">
        <div style="height: 100px;"></div> <!-- Spacer untuk Kop Kertas Fisik -->

        <div class="section-title">KEPUTUSAN DEKAN</div>
        <div id="sk_title" class="section-title" style="text-decoration: none; margin-top: 0;">
            FAKULTAS <span id="nama_fakultas">...</span><br>
            UNIVERSITAS MUHAMMADIYAH KARANGANYAR
        </div>
        <div class="nomor-sk">NOMOR: <span id="no_sk">...</span></div>

        <div class="text-center bold">TENTANG</div>
        <div class="text-center bold" style="margin-bottom: 30px;">
            PENGANGKATAN DOSEN PEMBIMBING SKRIPSI<br>
            MAHASISWA PROGRAM STUDI <span id="nama_prodi">...</span><br>
            SEMESTER <span id="semester">...</span> TAHUN AKADEMIK <span id="tahun">...</span><br>
            FAKULTAS <span id="nama_fakultas_2">...</span><br>
            UNIVERSITAS MUHAMMADIYAH KARANGANYAR
        </div>

        <div class="text-center bold" style="margin-bottom: 20px;">DEKAN FAKULTAS <span id="nama_fakultas_3">...</span></div>

        <table class="content-table">
            <tr>
                <td class="label" style="width: 100px;">Menimbang</td>
                <td class="separator">:</td>
                <td>
                    <ol type="a" style="margin: 0; padding-left: 20px;">
                        <li>bahwa untuk memperlancar pelaksanaan pengurusan Seminar Proposal Skripsi bagi mahasiswa Program Studi <span class="nama_prodi">...</span>, dipandang perlu menetapkan dosen pembimbing Skripsi pada semester <span class="semester">...</span> tahun akademik <span class="tahun">...</span></li>
                        <li>bahwa mereka yang nama dan jabatannya tersebut dalam lampiran Surat Keputusan ini dipandang mampu dan cakap serta memenuhi persyaratan untuk ditugasi sebagai dosen pembimbing Skripsi;</li>
                        <li>bahwa guna pelaksanaan dimaksud perlu ditetapkan dengan Surat Keputusan Dekan.</li>
                    </ol>
                </td>
            </tr>
            <tr>
                <td class="label">Mengingat</td>
                <td class="separator">:</td>
                <td>
                    <ol style="margin: 0; padding-left: 20px;">
                        <li>Undang-Undang No. 20 tahun 2003 tentang Sistem Pendidikan Nasional.</li>
                        <li>Undang-Undang Nomor 12 Tahun 2012 tentang Sistem Pendidikan Tinggi.</li>
                        <li>Surat Keputusan Direktur Dewan Eksekutif Badan Akreditasi Nasional Perguruan Tinggi Nomor 372/SK/BAN-PT/Ak-PNB/PT/VII/2022.</li>
                        <li>Statuta Universitas Muhammadiyah Karanganyar.</li>
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
                <td>Mengangkat dan Menetapkan dosen Pembimbing Skripsi di lingkungan Program Studi <span class="nama_prodi">...</span> sebagaimana tersebut dalam lampiran keputusan ini;</td>
            </tr>
            <tr>
                <td class="label">Kedua</td>
                <td class="separator">:</td>
                <td>Dosen pembimbing bertugas membimbing kegiatan penyusunan Skripsi pada program studi <span class="nama_prodi">...</span>;</td>
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
            
            <div id="qrcode" class="qr-code"></div>

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
            DAFTAR NAMA MAHASISWA DAN DOSEN PEMBIMBING SKRIPSI<br>
            PROGRAM STUDI <span class="nama_prodi">...</span><br>
            SEMESTER <span class="semester">...</span> TAHUN AKADEMIK <span class="tahun">...</span>
        </div>

        <table class="table-data">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="15%">NIM</th>
                    <th width="25%">Nama Mahasiswa</th>
                    <th>Judul Skripsi</th>
                    <th width="30%">Dosen Pembimbing</th>
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

                    $('#no_sk, .no_sk').text(customNo || sk.no_sk);
                    $('#tgl_sk, .tgl_sk').text(new Date(sk.tgl_sk).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' }));
                    $('#nama_fakultas, #nama_fakultas_2, #nama_fakultas_3').text(sk.nama_fakultas);
                    $('.nama_prodi, #nama_prodi').text(sk.nama_program_studi);
                    $('.semester, #semester').text(sk.semester);
                    $('.tahun, #tahun').text(sk.tahun_akademik);
                    $('#nama_dekan, .nama_dekan').text((sk.gd_dekan ? sk.gd_dekan + ' ' : '') + sk.nama_dekan + (sk.gb_dekan ? ', ' + sk.gb_dekan : ''));
                    $('#nip_dekan, .nip_dekan').text(sk.nip_dekan);

                    let html = '';
                    mhs.forEach((item, index) => {
                        html += `
                            <tr>
                                <td class="text-center">${index + 1}</td>
                                <td>${item.nim}</td>
                                <td>${item.nama_mhs}</td>
                                <td style="font-size: 9pt;">${item.judul || '-'}</td>
                                <td>
                                    1. ${item.nama_p1}<br>
                                    2. ${item.nama_p2 || '-'}
                                </td>
                            </tr>
                        `;
                    });
                    $('#mhs_list').html(html);

                    const validationUrl = "{{ url('/validasi/sk/') }}/" + sk.id;
                    new QRCode(document.getElementById("qrcode"), {
                        text: validationUrl,
                        width: 80,
                        height: 80
                    });

                    setTimeout(() => { window.print(); }, 1000);
                }
            });
        });
    </script>
</body>
</html>