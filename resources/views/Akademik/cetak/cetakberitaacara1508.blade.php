<html>

<head>
    <style>
        /*@page {*/
        /*    size: A4 landscape;*/
        /*}*/

        /*@page {*/
        /*    margin: 10mm 10mm 10mm 10mm;*/
        /*}*/



        tr {
            page-break-inside: avoid;
            /* Hindari potongan di tengah baris */
        }

        table {
            page-break-inside: auto;
            /* Pastikan tabel tidak terputus */
        }
    </style>
</head>

<body>
    <input class="form-control" type="hidden" name="id_kelas" id="id_kelas" value="{{ $id_kelas }}">

    <div class='row'>
        <div class='col-xs-12'>
            <table style='width:100%;'>
                <tr>
                    <td style='padding-right:10px;width:80px;'><img src='{{ url('imageup45/logoumuka.png') }}'
                            style='width:80px;'></td>
                    <td style='font-size:20px;padding-left:5px;font-weight:bold;'>UNIVERSITAS MUHAMMADIYAH
                        KARANGANYAR
                        <div id='nama_fakultas' style='font-size:20px;margin-top:-5px;'></div>
                        <div style='font-size:10px;border-bottom:1px solid black;padding-bottom:3px;margin-top:-3px;'>
                            Jl. Raya Solo-Tawangmangu Km 12, Papahan, Kec. Tasikmadu, Kabupaten Karanganyar, Jawa
                            Tengah 57722</div>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div style='font-family:Courier New;height:948px;'>
        <div style='margin-top:10px;text-align:center;'>
            <span style='font-size:20px;'>JURNAL PERKULIAHAN</span>
        </div>
        <div style='text-align:center;font-size:12px;margin-top:-5px;'>
            {{ $session_nama_tahunakademik }}
        </div>
        <div style='margin-top:20px;font-size:11px;line-height:10px;'>
            <table border='0' rules='all0' width='100%'>
                <tr>
                    <td style='width:20%;'>Program Studi</td>
                    <td style='width:5%;'>:</td>
                    <td><span id="nama_program"></span></td>
                    <td style='width:8px;'>&nbsp;</td>
                    <td style='width:20%;'>KodeMK/SKS/Kelas</td>
                    <td style='width:5%;'>:</td>
                    <td><span class="kodemk"></span></td>
                </tr>
                <tr>
                    <td style='width:20%;'>Mata Kuliah</td>
                    <td style='width:5%;'>:</td>
                    <td><span class="nama_matakuliah"></span></td>
                    <td style='width:8px;'>&nbsp;</td>
                    <td>HARI/JAM/RUANG</td>
                    <td>:</td>
                    <td><span class="harijamruang"></span></td>
                </tr>
                <tr>
                    <td>Dosen</td>
                    <td>:</td>
                    <td><span class="dosen"></span></td>
                    <td style='width:8px;'>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
            </table>
        </div>
        <div style='margin-top:5px;'>
            <table border='1' rules='all' width='100%' style='font-size:10px;'>
                <tr>
                    <td rowspan="2" style='width:7%;text-align:center;height:70px;'>Tanggal</td>
                    <td rowspan="2" style='width:2%;text-align:center;'>Ke</td>
                    <td rowspan="2" style='width:20%;text-align:center;'>Materi Perkuliahan / Praktikum</td>
                    <td colspan="2" style='width:5%;text-align:center;'>Alokasi Waktu</td>
                    <td colspan="2" style='width:5%;text-align:center;'>Jumlah</td>
                    <!--<td colspan="2" style='width:5%;text-align:center;'>Tanda Tangan</td>-->
                    <td rowspan="2" style='width:12%;text-align:center;'>Catatan</td>
                </tr>
                <tr>
                    <td style='width:5%;text-align:center;'>Mulai</td>
                    <td style='width:5%;text-align:center;'>Selesai</td>
                    <td style='width:6%;text-align:center;'>Hadir</td>
                    <td style='width:6%;text-align:center;'>Tidak Hadir</td>
                    <!--<td style='width:5%;text-align:center;'>Dosen</td>-->
                    <!--<td style='width:5%;text-align:center;'>Mahasiswa</td>-->
                </tr>
                <tbody id="beritaacara" style='font-size:10px;'>
                </tbody>
            </table>

            <table border='0' rules='all1' width='100%'
                style="margin-top:50px;margin-left:50px;font-size: 14px;page-break-inside: avoid;">
                <tr>
                    <td style='width:300px;'>&nbsp;</td>
                    <td style='width:240px;'>Karanganyar, <span id="tanggalwaktu"></span>
                    </td>
                </tr>
                <!--<tr>-->
                <!--    <td>Kepala Program Studi</td>-->
                <!--    <td style='width:80px;'>Dosen Pengampu</td>-->
                <!--</tr>-->
                <!--<tr>-->
                <!--    <td><span id="nama_prodi"></span></td>-->
                <!--    <td style='width:80px;'></td>-->
                <!--</tr>-->
                <!--<tr>-->
                <!--    <td style='height:70px;'>&nbsp;</td>-->
                <!--    <td style='height:70px;'>&nbsp;</td>-->
                <!--</tr>-->
                <!--<tr>-->
                <!--    <td><span id="kaprodi"></span></td>-->
                <!--    <td><span id="dosene"></span></td>-->
                <!--</tr>-->
                <tr>
                    <td></td>
                    <td style='width:80px;'>Kepala Program Studi</td>
                </tr>
                <tr>
                    <td></td>
                    <td style='width:80px;'><span id="nama_prodi"></span></td>
                </tr>
                <tr>
                    <td style='height:110px;'>&nbsp;</td>
                    <!--<td style='height:110px;'><img id="signatureImage" src="" width="200" height="100">-->
                    <td style='height:110px;'><div class="signature-container">
                        <img id="signatureImage" src="" width="200" height="100">
                    </div></td>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><span id="kaprodi"></span></td>
                </tr>

            </table>
        </div>

        <div style="page-break-after: always;"></div>

        <div style='font-family:Courier New;height:648px;line-height:10px;'>
            <div style='margin-top:10px;text-align:center;'>
                <span style='font-size:18px;'>PRESENSI PERKULIAHAN</span>
            </div>

            <div style='margin-top:20px;'>
                <table border='0' rules='all0' width='100%' style='font-size:12px;line-height:10px'>
                    <tr>
                        <td style='width:150px;'>Semester</td>
                        <td style='width:10px;'>:</td>
                        <td colspan='2'><span>{{ Session::get('session_nama_tahunakademik') }}</span></td>
                        <td style='width:8px;'>&nbsp;</td>
                        <td style='width:120px;'>Jenjang</td>
                        <td>:</td>
                        <td class="jenjange">C-S-1</td>
                    </tr>
                    <tr>
                        <td>Program Studi</td>
                        <td>:</td>
                        <td style='width:65px;'><span class="namaprodi_"></span></td>
                        <td>&nbsp;</td>
                        <td style='width:8px;'>&nbsp;</td>
                        <td>Kelas</td>
                        <td>:</td>
                        <td><span class="namakelas_"></span></td>
                    </tr>
                    <tr>
                        <td>Matakuliah</td>
                        <td>:</td>
                        <td><span class="kode_matakuliah_"></span></td>
                        <td><span class="nama_matakuliah_"></span></td>
                        <td style='width:8px;'>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>Dosen</td>
                        <td>:</td>
                        <td colspan='2'><span class="nama_dosen_"></span></td>
                        <td style='width:8px;'>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                </table>
            </div>
            <div style='margin-top:5px;'>
                <table border='1' rules='all' width='100%' cellpadding="5"
                    style='font-size:10px;line-height:10px'>
                    <thead>
                        <tr>
                            <td style='width:50px;padding-left:5px;padding-top:7px;padding-bottom:7px;text-align:center;'
                                rowspan="2">
                                NO</td>
                            <td style='width:95px;padding-left:5px;text-align:center;' rowspan="2">NIM</td>
                            <td style='padding-left:5px;text-align:center;' rowspan="2">Nama Mahasiswa</td>
                            <td colspan="16" style='padding-left:5px;text-align:center;'>Tatap Muka</td>
                            <td rowspan="2" style='padding-left:5px;text-align:center;'>Jumlah</td>
                        </tr>
                        <tr>
                            <td style='width:28px;text-align:center;'>1</td>
                            <td style='width:28px;text-align:center;'>2</td>
                            <td style='width:28px;text-align:center;'>3</td>
                            <td style='width:28px;text-align:center;'>4</td>
                            <td style='width:28px;text-align:center;'>5</td>
                            <td style='width:28px;text-align:center;'>6</td>
                            <td style='width:28px;text-align:center;'>7</td>
                            <td style='width:28px;text-align:center;'>UTS</td>
                            <td style='width:28px;text-align:center;'>9</td>
                            <td style='width:28px;text-align:center;'>10</td>
                            <td style='width:28px;text-align:center;'>11</td>
                            <td style='width:28px;text-align:center;'>12</td>
                            <td style='width:28px;text-align:center;'>13</td>
                            <td style='width:28px;text-align:center;'>14</td>
                            <td style='width:28px;text-align:center;'>15</td>
                            <td style='width:28px;text-align:center;'>UAS</td>
                        </tr>
                    </thead>
                    <tbody id="daftarhadirkuliah">
                    </tbody>

                </table>

                <div style='page-break-after:always'></div>
            </div>
            <!--<div style='page-break-after:always'></div>-->
</body>

</html>
<script src="{{ URL::asset('js/jquery.min.js') }}"></script>
<script>
    $(document).ready(function() {
        var tw = new Date();
        if (tw.getTimezoneOffset() == 0)(a = tw.getTime() + (7 * 60 * 60 * 1000))
        else(a = tw.getTime());
        tw.setTime(a);
        var tahun = tw.getFullYear();
        var bulan = tw.getMonth();
        var tanggal = tw.getDate();
        var bulanarray = new Array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus",
            "September", "Oktober", "Nopember", "Desember");
        document.getElementById("tanggalwaktu").innerHTML = tanggal + " " + bulanarray[bulan] + " " + tahun;

        var token = "{{ Session::get('token') }}";
        var userlogin = "{{ Session::get('username') }}";
        var id_kelas = $('#id_kelas').val();

        $.ajax({
            type: 'POST',
            dataType: "json",
            url: "{{ config('setting.second_url') }}akademik/get-kelas-mk",
            headers: {
                "Authorization": 'Bearer ' + token,
                "username": userlogin
            },
            data: {
                id_kelas: id_kelas
            },
            success: function(result) {
                console.log(result);
                var baseUrl = "{{ url('ttd/') }}/";
                // var imageUrl = baseUrl + result.file_ttd;

                var baseUrl = "{{ url('ttd/') }}/";
        
                if (result.file_ttd) {
                    var imageUrl = baseUrl + result.file_ttd;
                    if ($("#signatureImage").length === 0) {
                        // Jika elemen tidak ada, tambahkan kembali ke dalam HTML
                        $(".signature-container").append('<img id="signatureImage" src="' + imageUrl + '" width="200" height="100">');
                    } else {
                        // Jika elemen ada, perbarui src-nya
                        $("#signatureImage").attr("src", imageUrl);
                    }
                } else {
                    $("#signatureImage").remove(); // Hapus elemen jika file_ttd null
                }                

                console.log(result.file_ttd);

                $('.nama_matakuliah').html(result.nama_matakuliah);
                $('.kodemk').html(result.kode_matakuliah + '/' + result.sks_matakuliah + '/' +
                    result.nama_kelas);
                $('.harijamruang').html(result.hari + '/' + result.jam_mulai + '-' + result
                    .jam_selesai + '/' + result.kode_ruang);

                if (result.nama_dosen2 && !result.nama_dosen) {
                    $('.dosen').html(result
                        .nama_dosen2);
                } else if (result.nama_dosen && !result.nama_dosen2) {
                    $('.dosen').html(result.nama_dosen);
                } else {
                    $('.dosen').html(result.nama_dosen+'/'+result.nama_dosen2);
                }
                
                $('#nama_fakultas').html('FAKULTAS ' + result.nama_fakultas.toUpperCase());
                $('#nama_fakultaskecil').html(result.nama_fakultas);
                $('#nama_prodi').html(result.nama_program_studi);
                $('#nama_program').html(result.nama_program_studi);
                $('#dekane').html(result.dekan);
                $('#kaprodi').html(result.namakaprodi);
                $('#dosene').html(result.dosen);
                // $("#signatureImage").attr("src", imageUrl);
                get_table();
            }
        });

        function get_table() {
            $.ajax({
                type: 'GET',
                dataType: "json",
                url: "{{ config('setting.second_url') }}akademik/list-ba",
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                data: {
                    id_kelas: id_kelas
                },
                success: function(data) {
                    var jml = data.length;

                    var no = 1;
                    var tampil = '';
                    var presensi = '';
                    var totalsks = 0;
                    var bobot = 0;
                    var total_nilai = 0;

                    for (var i = 0; i < jml; i++) {

                        var hadir = (data[i].hadir == null || data[i].hadir == 0) ? "0" : data[i]
                            .hadir.split("#").length;
                        var alpha = (data[i].alpha == null || data[i].alpha == 0) ? "0" : data[i]
                            .alpha.split("#").length;
                        var kehadiran = data[i].peserta_hadir == null ? hadir : data[i]
                            .peserta_hadir;
                        var tdkkehadiran = data[i].peserta_hadir == null ? 'Belum verifikasi saat dikelas':alpha;
                        tampil = tampil +
                            '<tr style="font-size:10px;height:50px;"><td style="text-align:center;">' +
                            data[i].tgl + '</td><td style="padding-left:5px;"><center>' + data[i]
                            .pertemuan_ke +
                            '</center></td><td style="padding-left:5px;">' + data[i].materi_makul +
                            '</td><td style="text-align:center;">' + data[i].jam_mulai +
                            '</td><td style="text-align:center;">' + data[i].jam_selesai +
                            '</td><td style="text-align:center;">' + kehadiran +
                            '</td><td style="text-align:center;">' + tdkkehadiran +
                            // '</td><td style="padding-left:5px;">' +
                            // '</td><td style="padding-left:5px;">' +
                            '</td><td style="padding-left:5px;">' +
                            '</td></tr>';
                    }

                    $('#beritaacara').html(tampil);

                    $.ajax({
                        type: 'GET',
                        dataType: "json",
                        url: "{{ config('setting.second_url') }}akademik/presensi-permakul",
                        headers: {
                            "Authorization": 'Bearer ' + token,
                            "username": userlogin
                        },
                        data: {
                            id_kelas: id_kelas
                            // tahun: tahun,
                            // semester: semester

                        },
                        success: function(data) {
                            var jml = data.length;
                            var no = 1;
                            var tampil = '';
                            var jmlm = Array(16).fill(
                                0
                            ); // Menggunakan array untuk jumlah mahasiswa hadir per sesi

                            for (var i = 0; i < jml; i++) {
                                var jmlmsk = 0;

                                // Loop untuk menghitung kehadiran per mahasiswa
                                for (var k = 1; k <= 16; k++) {
                                    var key = k === 1 ? 'i' : k === 2 ? 'ii' : k === 3 ?
                                        'iii' : k === 4 ?
                                        'iv' :
                                        k === 5 ? 'v' : k === 6 ? 'vi' : k === 7 ?
                                        'vii' : k === 8 ? 'viii' :
                                        k === 9 ? 'ix' : k === 10 ? 'x' : k === 11 ?
                                        'xi' : k === 12 ? 'xii' :
                                        k === 13 ? 'xiii' : k === 14 ? 'xiv' : k ===
                                        15 ? 'xv' : 'xvi';

                                    if (data[i][key] === "H") {
                                        jmlmsk++;
                                        jmlm[k - 1]++;
                                    }
                                }

                                var persene = ((jmlmsk / 14) * 100).toFixed(2);

                                // Membuat baris untuk setiap mahasiswa
                                tampil += '<tr style="font-size:10px;">' +
                                    '<td style="text-align:center;">' + no + '</td>' +
                                    '<td style="padding-left:5px;text-align:center;">' +
                                    data[i].nim + '</td>' +
                                    '<td style="padding-left:5px;">' + data[i]
                                    .nama_mahasiswa + '</td>';

                                for (var k = 1; k <= 16; k++) {
                                    var key = k === 1 ? 'i' : k === 2 ? 'ii' : k === 3 ?
                                        'iii' : k === 4 ?
                                        'iv' :
                                        k === 5 ? 'v' : k === 6 ? 'vi' : k === 7 ?
                                        'vii' : k === 8 ? 'viii' :
                                        k === 9 ? 'ix' : k === 10 ? 'x' : k === 11 ?
                                        'xi' : k === 12 ? 'xii' :
                                        k === 13 ? 'xiii' : k === 14 ? 'xiv' : k ===
                                        15 ? 'xv' : 'xvi';

                                    tampil +=
                                        '<td style="width:20px;text-align:center;">' + (
                                            data[i][key] ||
                                            '') + '</td>';
                                }

                                tampil += '<td style="width:20px;text-align:center;">' +
                                    jmlmsk + '</td></tr>';
                                no++;
                            }

                            // Membuat baris untuk tanggal
                            var tampungtanggal = '';
                            for (var j = 0; j < 16; j++) {
                                var tanggal = data[0]['tgl' + (j + 1)] ||
                                    ""; // Mengambil tanggal dari data
                                tampungtanggal += '<td>' + tanggal + '</td>';
                            }

                            // Membuat baris untuk jumlah mahasiswa hadir
                            var tampungjmlm = '';
                            jmlm.forEach(function(jumlah) {
                                tampungjmlm += '<td>' + jumlah + '</td>';
                            });

                            // Menambahkan baris tanggal, jumlah hadir, dan paraf dosen
                            var rowTanggal =
                                '<tr style="font-size:10px;"><td style="text-align:center;" colspan="3">Tanggal</td>' +
                                tampungtanggal + '<td>&nbsp;</td></tr>';
                            var rowJumlahHadir =
                                '<tr style="font-size:10px;"><td style="text-align:center;" colspan="3">Jumlah Mahasiswa Hadir</td>' +
                                tampungjmlm + '<td>&nbsp;</td></tr>';
                            var rowParafDosen =
                                '<tr style="font-size:10px;"><td style="text-align:center;" colspan="3">Paraf Dosen Pengampu</td>' +
                                '<td colspan="17">&nbsp;</td></tr>';

                            tampil += rowTanggal + rowJumlahHadir + rowParafDosen;

                            // Menampilkan hasil ke elemen HTML
                            $('#daftarhadirkuliah').html(tampil);


                            // $('#totalsks').html(totalsks);
                            console.log(tampil);
                            $.ajax({
                                type: 'POST',
                                dataType: "json",
                                url: "{{ config('setting.second_url') }}akademik/get-daftarhadirkuliah1",
                                headers: {
                                    "Authorization": 'Bearer ' + token,
                                    "username": userlogin
                                },
                                data: {
                                    id_kelas: id_kelas
                                },
                                success: function(result) {
                                    console.log(result);
                                    // $('.nim_').html(result[0].nim);
                                    $('.namaprodi_')
                                        .html(result[0]
                                            .nama_program_studi);
                                    var kdjnjang = '';

                                    if (result[0].kode_jenjang_pendidikan ==
                                        '1') {
                                        kdjnjang = "Diploma 3";
                                    } else {
                                        kdjnjang = "Sarjana";
                                    }
                                    $('.jenjange').html(
                                        kdjnjang);


                                    $('.namakelas_')
                                        .html(result[0].nama_kelas);
                                    $('.nama_matakuliah_')
                                        .html(result[0]
                                            .nama_matakuliah);
                                    $('.kode_matakuliah_')
                                        .html(result[0]
                                            .kode_matakuliah);
                                    // $('.nama_dosen_').html(result[0].nama_dosen);
                                    if (result[0].nama_dosen2 && !result[0].nama_dosen) {
                                        $('.nama_dosen_').html(result[0]
                                            .nama_dosen2);
                                    } else if (result[0].nama_dosen && !result[0].nama_dosen2) {
                                        $('.nama_dosen_').html(result[0]
                                            .nama_dosen);
                                    } else {
                                        $('.nama_dosen_').html(result[0].nama_dosen+'/'+result[0].nama_dosen2);
                                    }
                                    $('.kodeforlab_')
                                        .html(result[0]
                                            .kode_prodi_forlab);
                                    $('#namafakultase')
                                        .html(result[0]
                                            .nama_fakultas);
                                    $('#namaprodine')
                                        .html(result[0]
                                            .nama_program_studi);
                                    $('.nama_fakultas').html('FAKULTAS ' +
                                        result[0].nama_fakultas
                                        .toUpperCase());
                                    window.print();

                                }
                            });


                        }
                    });
                }
            });

        }


    });
</script>