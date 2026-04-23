<html>
@php
    $pecah = explode('-', $id_tawar);
@endphp

@php $top=count($pecah); @endphp

<head>
    <style>
        @page {
            size: A4 landscape;
        }

        @page {
            margin: 10mm 10mm 10mm 10mm;
        }
    </style>
</head>

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
    <input class="form-control" type="hidden" name="id_tawarjamak" id="id_tawarjamak" value="{{ $id_tawar }}">
    <input type="hidden" name="lutane" id="lutane" value="0">
    <input type="hidden" name="topane" id="topane" value="{{ $top }}">
    <input class="form-control" type="hidden" name="patokan" id="patokan" value="{{ $pecah[$top - 1] }}">
    @foreach ($pecah as $row)
        <input class="form-control" type="hidden" name="id_tawar" id="id_tawar{{ $row }}"
            value="{{ $row }}">
        <div class='row'>
            <div class='col-xs-12'>
                <table border='0' rules='all0' style='width:100%;'>
                    <tr>
                        <td style='padding-right:10px;width:80px;'><img src='{{ url('imageup45/logoumuka.png') }}'
                                style='width:80px;'></td>
                        <td style='font-size:20px;padding-left:5px;font-weight:bold;'>UNIVERSITAS MUHAMMADIYAH
                            KARANGANYAR
                            <div id='nama_fakultas' style='font-size:20px;margin-top:-5px;'></div>
                            <div
                                style='font-size:10px;border-bottom:1px solid black;padding-bottom:3px;margin-top:-3px;'>
                                Jl. Raya Solo-Tawangmangu Km 12, Papahan, Kec. Tasikmadu, Kabupaten Karanganyar, Jawa
                                Tengah 57722</div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div style='font-family:Courier New;height:648px;line-height:10px;'>
            <div style='margin-top:10px;text-align:center;'>
                <span style='font-size:18px;'>** DAFTAR HADIR KULIAH **</span>
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
                        <td class="jenjange{{ $row }}">C-S-1</td>
                    </tr>
                    <tr>
                        <td>Program Studi</td>
                        <td>:</td>
                        <td style='width:65px;'><span class="namaprodi_{{ $row }}"></span></td>
                        <td>&nbsp;</td>
                        <td style='width:8px;'>&nbsp;</td>
                        <td>Kelas</td>
                        <td>:</td>
                        <td><span class="namakelas_{{ $row }}"></span></td>
                    </tr>
                    <tr>
                        <td>Matakuliah</td>
                        <td>:</td>
                        <td><span class="kode_matakuliah_{{ $row }}"></span></td>
                        <td><span class="nama_matakuliah_{{ $row }}"></span></td>
                        <td style='width:8px;'>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>Dosen</td>
                        <td>:</td>
                        <td colspan='2'><span class="nama_dosen_{{ $row }}"></span></td>
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
                    <tbody id="daftarhadirkuliah{{ $row }}">
                    </tbody>

                </table>

                <div style='margin-top:50px;font-size:12px;'>
                    <table border='0' rules='all0'>
                        <tr>
                            <td style='width:50px;'>&nbsp;</td>
                            <td style='text-align:center;'>Dekan</td>
                            <td style='width:200px;'>&nbsp;</td>
                            <td style='text-align:center;'>Kaprodi</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td style='text-align:center;'>
                                <p id="namafakultase{{ $row }}"></p>
                            </td>
                            <td>&nbsp;</td>
                            <td style='text-align:center;'>
                                <p id="namaprodine{{ $row }}"></p>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center; vertical-align: middle;">&nbsp;</td>
                            <td style="text-align: center; vertical-align: middle; height:120px;"
                                id="qrdekan{{ $row }}">&nbsp;</td>
                            <td style="text-align: center; vertical-align: middle;">&nbsp;</td>
                            <td style="text-align: center; vertical-align: middle; height:120px;" id="qrprodi{{ $row }}">&nbsp;</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td style='text-align:center;'>
                                <p class="namadekane{{ $row }}"></p>
                            </td>
                            <td>&nbsp;</td>
                            <td style='text-align:center;'>
                                <p class="namakaprodine{{ $row }}"></p>
                            </td>
                        </tr>
                    </table>
                </div>

                <div style='page-break-after:always'></div>
    @endforeach
</body>

</html>
<script src="{{ URL::asset('js/jquery.min.js') }}"></script>

@foreach ($pecah as $row)
    <script>
        $(document).ready(function() {
            var token = "{{ Session::get('token') }}";
            var userlogin = "{{ Session::get('username') }}";


            var id_tawar = $('#id_tawar{{ $row }}').val();
            // var tahun = $('#tahun').val();
            // var semester = $('#semester').val();

            $.ajax({
                type: 'GET',
                dataType: "json",
                url: "{{ config('setting.second_url') }}akademik/presensi-permakul1",
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
                    var jmlm = Array(16).fill(
                        0); // Menggunakan array untuk jumlah mahasiswa hadir per sesi

                    for (var i = 0; i < jml; i++) {
                        var jmlmsk = 0;

                        // Loop untuk menghitung kehadiran per mahasiswa
                        for (var k = 1; k <= 16; k++) {
                            var key = k === 1 ? 'i' : k === 2 ? 'ii' : k === 3 ? 'iii' : k === 4 ?
                                'iv' :
                                k === 5 ? 'v' : k === 6 ? 'vi' : k === 7 ? 'vii' : k === 8 ? 'viii' :
                                k === 9 ? 'ix' : k === 10 ? 'x' : k === 11 ? 'xi' : k === 12 ? 'xii' :
                                k === 13 ? 'xiii' : k === 14 ? 'xiv' : k === 15 ? 'xv' : 'xvi';

                            if (data[i][key] === "H") {
                                jmlmsk++;
                                jmlm[k - 1]++;
                            }
                        }

                        var persene = ((jmlmsk / 14) * 100).toFixed(2);

                        // Membuat baris untuk setiap mahasiswa
                        tampil += '<tr style="font-size:10px;">' +
                            '<td style="text-align:center;">' + no + '</td>' +
                            '<td style="padding-left:5px;text-align:center;">' + data[i].nim + '</td>' +
                            '<td style="padding-left:5px;">' + data[i].nama_mahasiswa + '</td>';

                        for (var k = 1; k <= 16; k++) {
                            var key = k === 1 ? 'i' : k === 2 ? 'ii' : k === 3 ? 'iii' : k === 4 ?
                                'iv' :
                                k === 5 ? 'v' : k === 6 ? 'vi' : k === 7 ? 'vii' : k === 8 ? 'viii' :
                                k === 9 ? 'ix' : k === 10 ? 'x' : k === 11 ? 'xi' : k === 12 ? 'xii' :
                                k === 13 ? 'xiii' : k === 14 ? 'xiv' : k === 15 ? 'xv' : 'xvi';

                            tampil += '<td style="width:20px;text-align:center;">' + (data[i][key] ||
                                '') + '</td>';
                        }

                        tampil += '<td style="width:20px;text-align:center;">' + jmlmsk + '</td></tr>';
                        no++;
                    }

                    // Membuat baris untuk tanggal
                    var tampungtanggal = '';
                    for (var j = 0; j < 16; j++) {
                        var tanggal = data[0]['tgl' + (j + 1)] || ""; // Mengambil tanggal dari data
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
                    $('#daftarhadirkuliah{{ $row }}').html(tampil);


                    // $('#totalsks').html(totalsks);
                    console.log(tampil);
                    $.ajax({
                        type: 'POST',
                        dataType: "json",
                        url: "{{ config('setting.second_url') }}akademik/get-daftarhadirkuliah",
                        headers: {
                            "Authorization": 'Bearer ' + token,
                            "username": userlogin
                        },
                        data: {
                            id_tawar: id_tawar
                        },
                        success: function(result) {
                            console.log(result);
                            // $('.nim_').html(result[0].nim);
                            $('.namaprodi_{{ $row }}').html(result[0]
                                .nama_program_studi);
                            var kdjnjang = '';

                            if (result[0].kode_jenjang_pendidikan == '1') {
                                kdjnjang = "Diploma 3";
                            } else {
                                kdjnjang = "Sarjana";
                            }
                            $('.jenjange{{ $row }}').html(kdjnjang);



                            if (result[0].kodefak == '1') {
                                $('#ttdkombis').css("display", "none");
                                $('#ttdsaintek').css("display", "none");
                            } else if (result[0].kodefak == '2') {
                                $('#ttdkombis').css("display", "none");
                                $('#ttdsaintek').css("display", "none");
                            }


                            $('.namakelas_{{ $row }}').html(result[0].nama_kelas);
                            $('.nama_matakuliah_{{ $row }}').html(result[0]
                                .nama_matakuliah);
                            $('.kode_matakuliah_{{ $row }}').html(result[0]
                                .kode_matakuliah);
                            // $('.nama_dosen_{{ $row }}').html(result[0].nama_dosen);
                            if (result[0].nama_dosen2 == true, result[0].nama_dosen ==
                                false) {
                                $('.nama_dosen_{{ $row }}').html(result[0]
                                    .nama_dosen2);
                            } else if (result[0].nama_dosen == true, result[0]
                                .nama_dosen2 == false) {
                                $('.nama_dosen_{{ $row }}').html(result[0]
                                    .nama_dosen);
                            } else {
                                $('.nama_dosen_{{ $row }}').html(result[0]
                                    .nama_dosen + '/' + result[0].nama_dosen2);
                            }
                            $('.kodeforlab_{{ $row }}').html(result[0]
                                .kode_prodi_forlab);
                            $('#namafakultase{{ $row }}').html(result[0]
                                .nama_fakultas);
                            $('#namaprodine{{ $row }}').html(result[0]
                                .nama_program_studi);
                            // dekan
                            $('#qrdekan{{ $row }}').html(
                                `<img src="{{ url('qrcodedosenmanajemen/` + result[0].nidndekan + `_Daftar_Hadir_Kuliah.png') }}" alt="Image" width='120' height='120' id="qrImage{{ $row }}"><br> <small><b>valid_id : ` +
                                result[0].validdekan + `</b></small>`
                            );
                            $('.namadekane{{ $row }}').html(result[0]
                                .namadekan);
                            $('#qrprodi{{ $row }}').html(
                                `<img src="{{ url('qrcodedosenmanajemen/` + result[0].nidnkaprodi + `_Daftar_Hadir_Kuliah.png') }}" alt="Image" width='120' height='120' id="qrImage1{{ $row }}"><br> <small><b>valid_id : ` +
                                result[0].validkaprodi + `</b></small>`
                            );
                            $('.namakaprodine{{ $row }}').html(result[0]
                                .namakaprodi);
                            $('.nama_fakultas').html('FAKULTAS ' + result[0].nama_fakultas
                                .toUpperCase());
                            // $forlab = result[0].kode_prodi_forlab;
                            // $forlap1 = substr($forlab, 0, 2);
                            // $forlap2 = substr($forlab, 2, 3);
                            // $('.kodeforlab_').html($forlap1.
                            //     "-".$forlap2);
                            // if ($('#id_tawar{{ $row }}').val() == $('#patokan')
                            //     .val()) {
                            //     window.print();
                            // }
                            var ambil = $('#lutane').val();
                            var hasil = parseInt(ambil) + 1;
                            $('#lutane').val(hasil);
                            if (hasil == $('#topane').val()) {
                                $('#qrImage1{{ $row }}').on('load', function() {
                                    window.print();
                                window.print();
                                });
                            }
                        }
                    });


                }
            });




        });
    </script>
@endforeach
