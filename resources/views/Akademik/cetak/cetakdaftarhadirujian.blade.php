<html>

<body>
    <style type="text/css">
        table {
            page-break-inside: auto
        }

        tr {
            page-break-inside: avoid;
            page-break-after: auto
        }

        thead {
            display: table-header-group
        }

        tfoot {
            display: table-footer-group
        }
    </style>

    <input class="form-control" type="hidden" name="id_tawar" id="id_tawar" value="{{ $id_tawar }}">
    {{-- <input class="form-control" type="text" name="nim" id="nim" value="{{ $nim }}"> --}}
    {{-- <input class="form-control" type="text" name="tahun" id="tahun" value="{{ $tahun }}">
    <input class="form-control" type="text" name="semester" id="semester" value="{{ $semester }}"> --}}
    <div class='row'>
        <div class='col-xs-12'>
            <table border='0' rules='all0' style='width:100%;'>
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
    @php
        $semester = '';
        if (Session::get('session_semester') == '1') {
            $semester = 'GANJIL';
        } else {
            $semester = 'GENAP';
        }

        $tahun = Session::get('session_tahun') . '/' . (intval(Session::get('session_tahun')) + 1);
    @endphp

    <div style='font-family:Courier New;height:648px;line-height:10px;'>
        <div style='margin-top:10px;text-align:center;'>
            <span style='font-size:18px;'>DAFTAR PESERTA UJIAN DAN NILAI AKHIR
                SEMESTER {{ $semester }}<br><br>UNIVERSITAS MUHAMMADIYAH
                KARANGANYAR<br><br>TAHUN AKADEMIK {{ $tahun }}<br></span>
        </div>

        <div style='margin-top:20px;'>
            <table border='0' rules='all0' width='100%' style='font-size:12px;line-height:10px'>
                <tr>
                    <td style='width:150px;'>Fakultas</td>
                    <td style='width:10px;'>:</td>
                    <td><span class="namafakultas_"></span></td>
                </tr>
                <tr>
                    <td>Program Studi</td>
                    <td>:</td>
                    <td><span class="namaprodi_"></span></td>

                </tr>
                <tr>
                    <td>Matakuliah Uji</td>
                    <td>:</td>
                    <td><span class="nama_matakuliah_"></span></td>
                </tr>
                <tr>
                    <td>Dosen</td>
                    <td>:</td>
                    <td colspan='2'><span class="nama_dosen_"></span></td>
                </tr>
                <tr>
                    <td>Kelas</td>
                    <td>:</td>
                    <td><span class="namakelas_"></span></td>
                </tr>
                <tr>
                    <td>Hari / Tanggal</td>
                    <td>:</td>
                    <td><span class="haritanggal_"></span></td>
                </tr>
                <tr>
                    <td>Ruang</td>
                    <td>:</td>
                    <td><span class="ruang_"></span></td>
                </tr>
            </table>
        </div>

        <div style='margin-top:5px;'>
            <table border='1' rules='all' width='100%' cellpadding="4" style='font-size:12px;line-height:10px'>
                <thead>
                    <tr>
                        <td style='height:36px;width:10px;padding-left:5px;padding-top:7px;padding-bottom:7px;text-align:center;'
                            rowspan="2">
                            NO</td>
                        <td style='width:70px;padding-left:5px;text-align:center;' rowspan="2">NIM</td>
                        <td style='width:95px;padding-left:5px;text-align:center;' rowspan="2">NAMA MAHASISWA
                        </td>
                        <td style='width:40px;padding-left:5px;text-align:center;' rowspan="2">HADIR
                        </td>
                        <td style='width:40px;padding-left:5px;text-align:center;' rowspan="2">TUGAS</td>
                        <td style='width:40px;padding-left:5px;text-align:center;' rowspan="2">PRAKTEK</td>
                        <td style='width:40px;padding-left:5px;text-align:center;' rowspan="2">KUIS</td>
                        <td style='width:40px;padding-left:5px;text-align:center;' rowspan="2">NILAI UTS</td>
                        <td style='width:40px;padding-left:5px;text-align:center;' rowspan="2">NILAI UAS</td>
                        <td style='width:40px;padding-left:5px;text-align:center;' colspan="2">NILAI AKHIR</td>
                    </tr>
                    <tr>
                        <td style='width:40px;text-align:center;'>ANGKA</td>
                        <td style='width:40px;text-align:center;'>HURUF</td>
                    </tr>
                </thead>
                <tbody id="daftarhadirujian">
                </tbody>

            </table>
            <br>

            <!--<table border='0' rules='all0' width='100%' style='line-height:10px;'>-->
            <!--    <tr>-->
            <!--        <td style='width:50px;' rowspan="6">Nilai</td>-->
            <!--        <td style='width:400px;'>A .......Orang.........%</td>-->
            <!--        <td style='width:400px;'>C .......Orang.........%</td>-->
            <!--    </tr>-->
            <!--    <tr>-->
            <!--        <td style='width:400px;'>A-.......Orang.........%</td>-->
            <!--        <td style='width:400px;'>C-.......Orang.........%</td>-->
            <!--    </tr>-->
            <!--    <tr>-->
            <!--        <td style='width:400px;'>B+.......Orang.........%</td>-->
            <!--        <td style='width:400px;'>D+.......Orang.........%</td>-->
            <!--    </tr>-->
            <!--    <tr>-->
            <!--        <td style='width:400px;'>B .......Orang.........%</td>-->
            <!--        <td style='width:400px;'>D .......Orang.........%</td>-->
            <!--    </tr>-->
            <!--    <tr>-->
            <!--        <td style='width:400px;'>B-.......Orang.........%</td>-->
            <!--        <td style='width:400px;'>E .......Orang.........%</td>-->
            <!--    </tr>-->
            <!--    <tr>-->
            <!--        <td style='width:400px;'>C+.......Orang.........%</td>-->
            <!--        <td style='width:400px;'>&nbsp;</td>-->
            <!--    </tr>-->
            <!--</table>-->
            <div style='margin-top:50px;font-size:12px;float:right;'>
                <table border='0' rules='all0' class='table_ttd'>
                </table>
            </div>

            <div style='page-break-after:always'></div>

</body>

</html>
<script src="{{ URL::asset('js/jquery.min.js') }}"></script>

<script>
    $(document).ready(function() {
        var token = "{{ Session::get('token') }}";
        var userlogin = "{{ Session::get('username') }}";
        var dosenPengampu = "{{ Session::get('nama') }}";

        var id_tawar = $('#id_tawar').val();
        // var tahun = $('#tahun').val();
        // var semester = $('#semester').val();
        const tanggalSekarang = new Date().toLocaleDateString('id-ID', {
            // weekday: 'long',  // Nama hari
            day: 'numeric',   // Tanggal
            month: 'long',    // Nama bulan
            year: 'numeric'   // Tahun
        });
        
        console.log(tanggalSekarang);

        $.ajax({
            type: 'POST',
            dataType: "json",
            url: "{{ config('setting.second_url') }}akademik/cetak-daftarhadirujianjamak",
            headers: {
                "Authorization": 'Bearer ' + token,
                "username": userlogin
            },
            data: {
                id_tawar: id_tawar
                // tahun: tahun,
                // semester: semester

            },
            success: function(data) {
                var jml = data.length;

                var no = 1;
                var tampil = '';
                // var totalsks = 0;
                for (var i = 0; i < jml; i++) {

                    var kehadiran = "";
                    var niltugas = "";
                    var nilpraktek = "";
                    var nilkuis = "";
                    var niluts = "";
                    var niluas = "";
                    var nilakhirangka = "";
                    var nilakhirhuruf = "";

                    if (data[i].kehadiran != null) {
                        kehadiran = data[i].kehadiran;
                    }
                    if (data[i].nilai_tugas != null) {
                        niltugas = data[i].nilai_tugas;
                    }
                    if (data[i].nilai_praktek != null) {
                        nilpraktek = data[i].nilai_praktek;
                    }
                    if (data[i].nilai_kuis != null) {
                        nilkuis = data[i].nilai_kuis;
                    }
                    if (data[i].nilai_uts != null) {
                        niluts = data[i].nilai_uts;
                    }
                    if (data[i].nilai_uas != null) {
                        niluas = data[i].nilai_uas;
                    }
                    if (data[i].nilai_akhir_angka != null) {
                        nilakhirangka = data[i].nilai_akhir_angka;
                    }
                    if (data[i].nilai_akhir_huruf != null) {
                        nilakhirhuruf = data[i].nilai_akhir_huruf;
                    }

                    tampil = tampil +
                        '<tr style="font-size:12px;height:35px;"><td style="text-align:center;">' +
                        no + '</td><td style="padding-left:5px;">' + data[i].nim +
                        '</td><td style="padding-left:5px;">' + data[i].nama_mahasiswa +
                        '</td><td style="text-align:center;">' + kehadiran +
                        '</td><td style="text-align:center;">' + niltugas +
                        '</td><td style="text-align:center;">' + nilpraktek +
                        '</td><td style="text-align:center;">' + nilkuis +
                        '</td><td style="text-align:center;">' + niluts +
                        '</td><td style="text-align:center;">' + niluas +
                        '</td><td style="text-align:center;">' + nilakhirangka +
                        '</td><td style="text-align:center;">' + nilakhirhuruf +
                        '</td></tr>';
                    no++;
                    // totalsks += data[i].sks_matakuliah;
                }
                $('#daftarhadirujian').html(tampil);

                // $('#totalsks').html(totalsks);
                console.log(tampil);

                $.ajax({
                    type: 'POST',
                    dataType: "json",
                    url: "{{ config('setting.second_url') }}akademik/get-daftarhadirujian",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    data: {
                        id_tawar: id_tawar
                    },
                    success: function(result) {
                        console.log(result);
                        var tgl = result[0]?.ujian_tanggal || result[0]?.tgl_ba_ujian;
                        var ujianTanggal = new Date(tgl); // Pastikan tanggal dalam format yang dikenali oleh JavaScript
                        var formattedTanggal = ujianTanggal.getDate().toString()
                            .padStart(2, '0') + "-" +
                            (ujianTanggal.getMonth() + 1)
                            .toString().padStart(2, '0') + "-" +
                            ujianTanggal.getFullYear();
                        var hariUjian = result[0].ujian_hari||result[0].hari;
                        var ruang = result[0].ujian_kode_ruang||result[0].kode_ruang;
                        // $('.nim_').html(result[0].nim);
                        $('.namafakultas_').html(result[0]
                            .nama_fakultas);
                        $('.namadekane').html(result[0]
                            .dekane);
                        $('#namafakultase').html(result[0]
                            .nama_fakultas);
                        $('.namaprodi_').html(result[0]
                            .nama_program_studi);
                        $('.namakelas_').html(result[0].nama_kelas);
                        $('.haritanggal_').html(hariUjian + " " + formattedTanggal);
                        $('.ruang_').html(ruang);
                        $('.semester_').html(result[0].semester);
                        $('.nama_matakuliah_').html(result[0]
                            .kode_matakuliah + " " + result[0]
                            .nama_matakuliah);
                        // $('.kode_matakuliah_').html(result[0]
                        //     .kode_matakuliah);
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

                        let tableHtml = `
                            <tr>
                                <td></td>
                                <td style='width:50px;'>&nbsp;</td>
                                <td>Karanganyar, <span class="tanggalSekarang"></span></td>
                            </tr>`;
                        
                        if (result[0].nama_dosen2 && !result[0].nama_dosen) {
                            tableHtml += `
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>Dosen Pengampu</td>
                            </tr>
                            <tr>
                                <td style='height:90px;'>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td style='height:90px;'>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td><p>${result[0].nama_dosen2}</p></td>
                            </tr>`;
                        } else if (result[0].nama_dosen && !result[0].nama_dosen2) {
                            tableHtml += `
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>Dosen Pengampu</td>
                            </tr>
                            <tr>
                                <td style='height:90px;'>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td style='height:90px;'>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td><p>${result[0].nama_dosen}</p></td>
                            </tr>`;
                        } else {
                            tableHtml += `
                            <tr>
                                <td>Dosen Pengampu 1</td>
                                <td>&nbsp;</td>
                                <td>Dosen Pengampu 2</td>
                            </tr>
                            <tr>
                                <td style='height:90px;'>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td style='height:90px;'>&nbsp;</td>
                            </tr>
                            <tr>
                                <td><p>${result[0].nama_dosen}</p></td>
                                <td>&nbsp;</td>
                                <td><p>${result[0].nama_dosen2}</p></td>
                            </tr>`;
                        }
                        
                        $('.table_ttd').html(tableHtml);


                        // $('.namadosenpengampu').html(result[0]
                        //     .nama_dosen);
                        $('.kodeforlab_').html(result[0]
                            .kode_prodi_forlab);
                        $('.nama_fakultas').html('FAKULTAS ' + result[0].nama_fakultas
                            .toUpperCase());
                        $('.nama_matkul_').html(
                            '** DAFTAR HADIR UJIAN ' + result[0].nama_matakuliah +
                            ' **');
                        $('.tanggalSekarang').html(tanggalSekarang);
                        window.print();
                    }
                });
            }
        });


    });
</script>