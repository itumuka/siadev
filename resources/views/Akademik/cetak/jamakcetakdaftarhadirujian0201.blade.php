<html>
@php
    $pecah = explode('-', $id_tawar);
@endphp

@php $top=count($pecah); @endphp

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
                            <div
                                style='font-size:10px;border-bottom:1px solid black;padding-bottom:3px;margin-top:-3px;'>
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
                        <td><span class="namafakultas_{{ $row }}"></span></td>
                    </tr>
                    <tr>
                        <td>Program Studi</td>
                        <td>:</td>
                        <td><span class="namaprodi_{{ $row }}"></span></td>

                    </tr>
                    <tr>
                        <td>Matakuliah Uji</td>
                        <td>:</td>
                        <td><span class="nama_matakuliah_{{ $row }}"></span></td>
                    </tr>
                    <tr>
                        <td>Dosen</td>
                        <td>:</td>
                        <td colspan='2'><span class="nama_dosen_{{ $row }}"></span></td>
                    </tr>
                    <tr>
                        <td>Kelas</td>
                        <td>:</td>
                        <td><span class="namakelas_{{ $row }}"></span></td>
                    </tr>
                    <tr>
                        <td>Hari / Tanggal</td>
                        <td>:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Ruang</td>
                        <td>:</td>
                        <td></td>
                    </tr>
                </table>
            </div>

            <div style='margin-top:5px;'>
                <table border='1' rules='all' width='100%' cellpadding="4"
                    style='font-size:12px;line-height:10px'>
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
                            <td style='width:40px;padding-left:5px;text-align:center;' rowspan="2">TTD</td>
                        </tr>
                        <tr>
                            <td style='width:40px;text-align:center;'>ANGKA</td>
                            <td style='width:40px;text-align:center;'>HURUF</td>
                        </tr>
                    </thead>
                    <tbody id="daftarhadirujian{{ $row }}">
                    </tbody>

                </table>
                <br>

                <table border='0' rules='all0' width='100%' style='line-height:10px;'>
                    <tr>
                        <td style='width:50px;' rowspan="6">Nilai</td>
                        <td style='width:400px;'>A .......Orang.........%</td>
                        <td style='width:400px;'>C .......Orang.........%</td>
                    </tr>
                    <tr>
                        <td style='width:400px;'>A-.......Orang.........%</td>
                        <td style='width:400px;'>C-.......Orang.........%</td>
                    </tr>
                    <tr>
                        <td style='width:400px;'>B+.......Orang.........%</td>
                        <td style='width:400px;'>D+.......Orang.........%</td>
                    </tr>
                    <tr>
                        <td style='width:400px;'>B .......Orang.........%</td>
                        <td style='width:400px;'>D .......Orang.........%</td>
                    </tr>
                    <tr>
                        <td style='width:400px;'>B-.......Orang.........%</td>
                        <td style='width:400px;'>E .......Orang.........%</td>
                    </tr>
                    <tr>
                        <td style='width:400px;'>C+.......Orang.........%</td>
                        <td style='width:400px;'>&nbsp;</td>
                    </tr>
                </table>
                <div style='margin-top:50px;font-size:12px;float:right;'>
                    <table border='0' rules='all0'>
                        <tr>
                            <td>Mengetahui Dekan</td>
                            <td style='width:50px;'>&nbsp;</td>
                            <td>Karanganyar,........................</td>
                        </tr>
                        <tr>
                            <td>
                                <p id="namafakultase{{ $row }}"></p>
                            </td>
                            <td>&nbsp;</td>
                            <td>Dosen Pengampu</td>
                        </tr>
                        <tr>
                            <td style='height:90px;'>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td style='height:90px;'>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>
                                <p class="namadekane{{ $row }}"></p>
                            </td>
                            <td>&nbsp;</td>
                            <td>
                                <p class="namadosenpengampu{{ $row }}"></p>
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
                            '</td><td>&nbsp;</td></tr>';
                        no++;
                        // totalsks += data[i].sks_matakuliah;
                    }
                    $('#daftarhadirujian{{ $row }}').html(tampil);

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
                            // $('.nim_').html(result[0].nim);
                            $('.namafakultas_{{ $row }}').html(result[0]
                                .nama_fakultas);
                            $('.namadekane{{ $row }}').html(result[0]
                                .dekane);
                            $('#namafakultase{{ $row }}').html(result[0]
                                .nama_fakultas);
                            $('.namaprodi_{{ $row }}').html(result[0]
                                .nama_program_studi);
                            $('.namakelas_{{ $row }}').html(result[0].nama_kelas);
                            $('.semester_{{ $row }}').html(result[0].semester);
                            $('.nama_matakuliah_{{ $row }}').html(result[0]
                                .kode_matakuliah + " " + result[0]
                                .nama_matakuliah);
                            // $('.kode_matakuliah_{{ $row }}').html(result[0]
                            //     .kode_matakuliah);
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
                            $('.namadosenpengampu{{ $row }}').html(result[0]
                                .nama_dosen);
                            $('.kodeforlab_{{ $row }}').html(result[0]
                                .kode_prodi_forlab);
                            $('.nama_fakultas').html('FAKULTAS ' + result[0].nama_fakultas
                                .toUpperCase());
                            $('.nama_matkul_{{ $row }}').html(
                                '** DAFTAR HADIR UJIAN ' + result[0].nama_matakuliah +
                                ' **');
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
                                window.print();
                            }
                        }
                    });
                }
            });


        });
    </script>
@endforeach
