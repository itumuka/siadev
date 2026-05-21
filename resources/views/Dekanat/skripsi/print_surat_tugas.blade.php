<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Surat Tugas Pembimbing</title>
    <style>
        @page { size: A4; margin: 2cm; }
        body { font-family: Arial, Helvetica, sans-serif; font-size: 11pt; line-height: 1.4; color: #000; background: #fff; }
        .page-break { page-break-after: always; }
        .section-title { text-align: center; font-weight: bold; text-decoration: underline; margin-top: 20px; text-transform: uppercase; }
        .nomor-sk { text-align: center; font-weight: bold; margin-bottom: 20px; }
        .content-area { margin-top: 30px; }
        .signature-box { float: right; width: 300px; text-align: left; margin-top: 50px; }
        .bold { font-weight: bold; }
        .mt-20 { margin-top: 20px; }
        .mb-20 { margin-bottom: 20px; }
        table.data-table { width: 100%; margin-top: 10px; }
        table.data-table td { vertical-align: top; padding: 3px 0; }
        .label { width: 100px; }
        .sep { width: 20px; text-align: center; }
    </style>
</head>
<body>
    <div id="print_container">
        <!-- Halaman-halaman akan di-generate oleh JS -->
    </div>

    <script src="{{ asset('js/jquery.min.js') }}"></script>
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
                    const mhsList = res.mahasiswa;

                    // Sinkronisasi logika tipe TA (Skripsi/LTA) seperti di print_sk
                    const jenjangMap = { '1': 'D3', '2': 'S1', '3': 'S2', '4': 'S3', '5': 'D4' };
                    const jenjang = sk.kode_jenjang_pendidikan;
                    
                    // Deteksi default prodi untuk penentuan tipe TA
                    const prodiList = Array.from(new Set(mhsList.map(i => i.nama_program_studi).filter(Boolean)));
                    let headerProdi = prodiList.length > 0 ? prodiList[0] : (sk.nama_program_studi || '');
                    
                    let tipeTa = "Skripsi";
                    const prodiNameForCheck = headerProdi.toUpperCase();
                    if (jenjang == '1' || jenjang == '5' || 
                        prodiNameForCheck.includes('D3') || prodiNameForCheck.includes('DIII') || 
                        prodiNameForCheck.includes('D4') || prodiNameForCheck.includes('DIV')) {
                        tipeTa = "Laporan Tugas Akhir (LTA)";
                    }

                    // Format nomor surat: Prioritaskan ST, jika tidak ada baru fallback ke SK dengan warning atau placeholder
                    let displayNoST = customNo || sk.no_surat_tugas;
                    if (!displayNoST) {
                        // Jika terpaksa menggunakan no_sk, pastikan admin tahu ini fallback
                        displayNoST = sk.no_sk ? sk.no_sk : '...';
                    }

                    let html = '';
                    mhsList.forEach((m) => {
                        // Prioritaskan nomor individu dari DB (m.no_st_ind).
                        // Gunakan customNo (dari URL) hanya jika data DB kosong, 
                        // terakhir baru fallback ke nomor batch.
                        const studentNoST = m.no_st_ind || customNo || displayNoST;
                        
                        html += `
                            <div class="page-break">
                                <!-- Kop Surat Tugas Resmi -->
                                <table style="width: 100%; border-collapse: collapse; border-bottom: 2px solid #000; padding-bottom: 5px; margin-bottom: 15px;">
                                    <tr>
                                        <td style="width: 12%; text-align: center; vertical-align: middle;">
                                            <img src="{{ asset('imageup45/logoumuka.png') }}" style="width: 75px; height: auto;" alt="Logo UMUKA">
                                        </td>
                                        <td style="width: 88%; text-align: center; vertical-align: middle; padding-left: 10px; font-family: 'Times New Roman', Times, serif;">
                                            <div style="font-size: 15pt; font-weight: bold; margin: 0; color: #000; text-transform: uppercase; letter-spacing: 0.5px;">UNIVERSITAS MUHAMMADIYAH KARANGANYAR</div>
                                            <div style="font-size: 12pt; font-weight: bold; margin: 3px 0 1px 0; color: #000; text-transform: uppercase; letter-spacing: 0.5px;">FAKULTAS ${sk.nama_fakultas.toUpperCase()}</div>
                                            <div style="font-size: 9.5pt; margin: 2px 0 1px 0; color: #000;">Jalan Raya Solo-Tawangmangu KM 12 Papahan Tasikmadu Karanganyar</div>
                                            <div style="font-size: 9pt; margin: 1px 0; color: #000;">website: www.umuka.ac.id, email: umuka@umuka.ac.id</div>
                                            <div style="font-size: 9pt; margin: 1px 0; color: #000;">Admin 08112801912  (57761)</div>
                                        </td>
                                    </tr>
                                </table>
                                
                                <div class="section-title">SURAT TUGAS</div>
                                <div class="nomor-sk">Nomor: ${studentNoST}</div>

                                <div class="content-area">
                                    <p>Assalaamu’alaikum Warahmatullaahi Wabarakaatuh.</p>
                                    <p>Yang bertanda tangan di bawah ini Dekan Fakultas ${sk.nama_fakultas} Universitas Muhammadiyah Karanganyar menugaskan kepada:</p>

                                    <table class="data-table">
                                        <tr>
                                            <td class="label">Nama</td>
                                            <td class="sep">:</td>
                                            <td class="bold">${m.nama_p1}</td>
                                        </tr>
                                        <tr>
                                            <td class="label">Sebagai</td>
                                            <td class="sep">:</td>
                                            <td>Pembimbing Utama (Pembimbing 1)</td>
                                        </tr>
                                    </table>

                                    <p class="mt-20">Membimbing ${tipeTa} untuk mahasiswa:</p>
                                    <table class="data-table">
                                        <tr>
                                            <td class="label">Nama</td>
                                            <td class="sep">:</td>
                                            <td>${m.nama_mhs}</td>
                                        </tr>
                                        <tr>
                                            <td class="label">NPM</td>
                                            <td class="sep">:</td>
                                            <td>${m.nim}</td>
                                        </tr>
                                        <tr>
                                            <td class="label">Prodi</td>
                                            <td class="sep">:</td>
                                            <td>${m.nama_program_studi || sk.nama_program_studi}</td>
                                        </tr>
                                        <tr>
                                            <td class="label">Judul</td>
                                            <td class="sep">:</td>
                                            <td class="bold">${m.judul || '-'}</td>
                                        </tr>
                                    </table>

                                    <p class="mt-20">Masa berlaku pada Semester ${sk.semester == 1 ? 'Gasal' : 'Genap'} Tahun Akademik ${sk.tahun_akademik}.</p>
                                    <p>Demikian surat tugas ini dibuat untuk dilaksanakan dengan penuh tanggungjawab dan kepada yang berkepentingan harap diperhatikan.</p>
                                    <p>Wassalaamu’alaikum Warahmatullaahi Wabarakaatuh.</p>
                                </div>

                                <div class="signature-box">
                                    <div>Karanganyar, ${new Date(sk.tgl_sk).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' })}</div>
                                    <div class="mt-20 bold">Dekan Fakultas ${sk.nama_fakultas}</div>
                                    <div style="height: 80px;"></div>
                                    <div class="bold" style="text-decoration: underline;">${(sk.gd_dekan ? sk.gd_dekan + ' ' : '') + sk.nama_dekan + (sk.gb_dekan ? ', ' + sk.gb_dekan : '')}</div>
                                    <div>NIP. ${sk.nip_dekan}</div>
                                </div>
                            </div>
                        `;

                        // Jika ada pembimbing 2, buatkan juga halamannya
                        if (m.nama_p2 && m.nama_p2 !== '-') {
                            html += `
                                <div class="page-break">
                                    <!-- Kop Surat Tugas Resmi -->
                                    <table style="width: 100%; border-collapse: collapse; border-bottom: 2px solid #000; padding-bottom: 5px; margin-bottom: 15px;">
                                        <tr>
                                            <td style="width: 12%; text-align: center; vertical-align: middle;">
                                                <img src="{{ asset('imageup45/logoumuka.png') }}" style="width: 75px; height: auto;" alt="Logo UMUKA">
                                            </td>
                                            <td style="width: 88%; text-align: center; vertical-align: middle; padding-left: 10px; font-family: 'Times New Roman', Times, serif;">
                                                <div style="font-size: 15pt; font-weight: bold; margin: 0; color: #000; text-transform: uppercase; letter-spacing: 0.5px;">UNIVERSITAS MUHAMMADIYAH KARANGANYAR</div>
                                                <div style="font-size: 12pt; font-weight: bold; margin: 3px 0 1px 0; color: #000; text-transform: uppercase; letter-spacing: 0.5px;">FAKULTAS ${sk.nama_fakultas.toUpperCase()}</div>
                                                <div style="font-size: 9.5pt; margin: 2px 0 1px 0; color: #000;">Jalan Raya Solo-Tawangmangu KM 12 Papahan Tasikmadu Karanganyar</div>
                                                <div style="font-size: 9pt; margin: 1px 0; color: #000;">website: www.umuka.ac.id, email: umuka@umuka.ac.id</div>
                                                <div style="font-size: 9pt; margin: 1px 0; color: #000;">Admin 08112801912  (57761)</div>
                                            </td>
                                        </tr>
                                    </table>
                                    
                                    <div class="section-title">SURAT TUGAS</div>
                                    <div class="nomor-sk">Nomor: ${studentNoST}</div>

                                    <div class="content-area">
                                        <p>Assalaamu’alaikum Warahmatullaahi Wabarakaatuh.</p>
                                        <p>Yang bertanda tangan di bawah ini Dekan Fakultas ${sk.nama_fakultas} Universitas Muhammadiyah Karanganyar menugaskan kepada:</p>

                                        <table class="data-table">
                                            <tr>
                                                <td class="label">Nama</td>
                                                <td class="sep">:</td>
                                                <td class="bold">${m.nama_p2}</td>
                                            </tr>
                                            <tr>
                                                <td class="label">Sebagai</td>
                                                <td class="sep">:</td>
                                                <td>Pembimbing Pendamping (Pembimbing 2)</td>
                                            </tr>
                                        </table>

                                        <p class="mt-20">Membimbing ${tipeTa} untuk mahasiswa:</p>
                                        <table class="data-table">
                                            <tr>
                                                <td class="label">Nama</td>
                                                <td class="sep">:</td>
                                                <td>${m.nama_mhs}</td>
                                            </tr>
                                            <tr>
                                                <td class="label">NPM</td>
                                                <td class="sep">:</td>
                                                <td>${m.nim}</td>
                                            </tr>
                                            <tr>
                                                <td class="label">Prodi</td>
                                                <td class="sep">:</td>
                                                <td>${m.nama_program_studi || sk.nama_program_studi}</td>
                                            </tr>
                                            <tr>
                                                <td class="label">Judul</td>
                                                <td class="sep">:</td>
                                                <td class="bold">${m.judul || '-'}</td>
                                            </tr>
                                        </table>

                                        <p class="mt-20">Masa berlaku pada Semester ${sk.semester == 1 ? 'Gasal' : 'Genap'} Tahun Akademik ${sk.tahun_akademik}.</p>
                                        <p>Demikian surat tugas ini dibuat untuk dilaksanakan dengan penuh tanggungjawab dan kepada yang berkepentingan harap diperhatikan.</p>
                                        <p>Wassalaamu’alaikum Warahmatullaahi Wabarakaatuh.</p>
                                    </div>

                                    <div class="signature-box">
                                        <div>Karanganyar, ${new Date(sk.tgl_sk).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' })}</div>
                                        <div class="mt-20 bold">Dekan Fakultas ${sk.nama_fakultas}</div>
                                        <div style="height: 80px;"></div>
                                        <div class="bold" style="text-decoration: underline;">${(sk.gd_dekan ? sk.gd_dekan + ' ' : '') + sk.nama_dekan + (sk.gb_dekan ? ', ' + sk.gb_dekan : '')}</div>
                                        <div>NIP. ${sk.nip_dekan}</div>
                                    </div>
                                </div>
                            `;
                        }
                    });

                    $('#print_container').html(html);
                    setTimeout(() => { window.print(); }, 1000);
                }
            });
        });
    </script>
</body>
</html>