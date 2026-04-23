<html>
@php
    $pecah = explode('-', $nim);
@endphp

@php $top=count($pecah); @endphp

<body>
    <input class="form-control" type="hidden" name="nimjamak" id="nimjamak" value="{{ $nim }}">
    <input type="hidden" name="lutane" id="lutane" value="0">
    <input type="hidden" name="topane" id="topane" value="{{ $top }}">
    <input class="form-control" type="hidden" name="patokan" id="patokan" value="{{ $pecah[$top - 1] }}">
    @foreach ($pecah as $row)
        <input class="form-control" type="hidden" name="nim" id="nim{{ $row }}"
            value="{{ $row }}">
        <div class='row'>
            <div class='col-xs-12'>
                <table border='0' rules='all0' style='width:100%;'>
                    <tr>
                        {{-- <td style='padding-right:10px;width:80px;'><img src='{{ url('imageup45/logo_up.png') }}'
                                style='width:80px;'></td> --}}
                        <td style='padding-right:10px;width:130px;'></td>

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
        <input class="form-control" type="hidden" name="nim" id="nim" value="{{ $row }}">

        <div style='font-family:Courier New;height:945px;'>
            <div style='margin-top:10px;text-align:center;'>
                <span style='font-size:20px;font-weight:bold;'>TRANSKRIP AKADEMIK</span>
            </div>
            <div style='margin-top:-7px;text-align:center;'>
                <span style='font-size:14px;font-weight:bold;' class="nomortranskrip{{ $row }}">Nomor :</span>
            </div>

            <div style='margin-top:15px;'>
                <table border='0' rules='all0' width='100%' style='font-size:12px;line-height:10px'>
                    <tr>
                        <td style='width:95px;'>Nama</td>
                        <td style='width:10px;'>:</td>
                        <td><span class="nama_mhs{{ $row }}"></span></td>
                        <td style='width:95px;'>Tanggal Masuk/Lulus</td>
                        <td style='width:10px;'>:</td>
                        <td><span class="tanggalmasuklulus{{ $row }}"></span></td>
                    </tr>
                    <tr>
                        <td>NIM</td>
                        <td>:</td>
                        <td><span class="nim{{ $row }}">{{ $row }}</span></td>
                        <td style='width:130px;'>Jenjang Pendidikan</td>
                        <td>:</td>
                        <td>Sarjana/Strata Satu (S1)</td>
                    </tr>
                    <tr>
                        <td>Tempat Lahir</td>
                        <td>:</td>
                        <td><span class="tempat_lahir{{ $row }}"></span></td>
                        <td>Akreditasi</td>
                        <td style='width:10px;'>:</td>
                        <td><span class="status_akreditasi{{ $row }}"></span></td>
                    </tr>
                    <tr>
                        <td>Tanggal Lahir</td>
                        <td>:</td>
                        <td><span class="tgl_lahir{{ $row }}"></span></td>
                        <td>Nomor SK Akreditasi</td>
                        <td>:</td>
                        <td style='width:220px;'><span class="no_sk{{ $row }}"></span></td>
                    </tr>
                    <tr>
                        <td>Program Studi</td>
                        <td>:</td>
                        <td><span class="program_studi{{ $row }}"></span></td>
                        <td>Nomor Ijazah</td>
                        <td>:</td>
                        <td><span class="noijazah{{ $row }}"></span></td>
                    </tr>
                </table>
            </div>

            <div style='margin-top:10px;'>
                <table border='0' rules='all1' width='100%'>
                    {{-- <tr>
                        <td colspan='2' style='border-top:2px solid black;'></td>
                    </tr> --}}
                    <tr>
                        <td style='width:50%;padding-right:0px;vertical-align:top;'>
                            <table border='0' rules='all0' width='100%' style='line-height:10px;'>
                                <thead>
                                    <tr>
                                        <td colspan='5' style='border-top:2px solid black;'></td>
                                    </tr>
                                    <tr style='font-size:12px;'>
                                        <td style='padding-bottom:5px;padding-top:3px;width:20px;text-align:center;'>No
                                        </td>
                                        <td style='padding-bottom:5px;padding-top:3px;'>Nama Matakuliah</td>
                                        <td style='padding-bottom:5px;padding-top:3px;text-align:center;'>SKS</td>
                                        <td style='padding-bottom:5px;padding-top:3px;text-align:center;'>Nilai</td>
                                    </tr>
                                    <tr>
                                        <td colspan='5' style='border-top:1px solid black;'></td>
                                    </tr>
                                </thead>
                                <tbody id="transkipnilai{{ $row }}">
                                </tbody>
                            </table>
                        </td>
                        <td style='width:50%;padding-right:0px;vertical-align:top;'>
                            <table border='0' rules='all0' width='100%' style='line-height:10px;'>
                                <thead>
                                    <tr>
                                        <td colspan='5' style='border-top:2px solid black;'></td>
                                    </tr>
                                    <tr style='font-size:12px;'>
                                        <td style='padding-bottom:5px;padding-top:3px;width:20px;text-align:center;'>No
                                        </td>
                                        <td style='padding-bottom:5px;padding-top:3px;'>Nama Matakuliah</td>
                                        <td style='padding-bottom:5px;padding-top:3px;text-align:center;'>SKS</td>
                                        <td style='padding-bottom:5px;padding-top:3px;text-align:center;'>Nilai</td>
                                    </tr>
                                    <tr>
                                        <td colspan='5' style='border-top:1px solid black;'></td>
                                    </tr>
                                </thead>
                                <tbody id="transkipnilai1{{ $row }}">
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>

            <div style='font-family:Courier New;font-size:7px;padding-top:2px;'>
                <table border='0' rules='all0' width='100%'
                    style='line-height:10px;font-family:Courier New;font-size:12px;'>
                    <tr>
                        <td colspan='5' style='border-top:1px solid black;'></td>
                    </tr>
                    <tr>
                        <td colspan='3'>Hasil Komulatif</td>
                        <td colspan='2'>Judul Skripsi</td>
                    </tr>
                    <tr>
                        <td colspan='5' style='border-top:1px solid black;'></td>
                    </tr>
                    <tr>
                        <td style='width:130px;'>Jumlah SKS</td>
                        <td style='width:10px;'>:</td>
                        <td style='width:120px;'><span id="totalsks{{ $row }}"></span></td>
                        <td rowspan='4' style='width:330px;vertical-align:top;'><span style="font-size:9px;"
                                class="judul_skripsi_indo{{ $row }}"></span><br><br><span
                                style="font-size:8px;" class="judul_skripsi_inggris{{ $row }}"></span></td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>Jumlah Bobot</td>
                        <td>:</td>
                        <td><span id="totalbobot{{ $row }}"></span></td>
                    </tr>
                    <tr>
                        <td>Indeks Prestasi</td>
                        <td>:</td>
                        <td><span id="totalipk{{ $row }}"></span></td>
                    </tr>
                    <tr>
                        <td>Predikat Kelulusan</td>
                        <td>:</td>
                        <td><span id="predikat_kelulusan{{ $row }}"></span></td>
                    </tr>
                    <tr>
                        <td colspan='5' style='border-top:1px solid black;'></td>
                    </tr>
                </table>
                <div style='float:right;margin-top:10px;'>
                    <table border='0' rules='all0'
                        style='line-height:10px;font-family:Courier New;font-size:12px;'>
                        <tr>
                            <td rowspan='4'
                                style='border:0px solid black;height:110px;width:100px;text-align:center;'>Pas
                                Foto<br>3 x 4</td>
                            <td style='width:50px;'>&nbsp;</td>
                            <td>Karanganyar, <span id="tanggalwaktu{{ $row }}"></span></td>
                        </tr>
                        <tr>
                            {{-- <td>1</td> --}}
                            <td>&nbsp;</td>
                            <td><span class="ketdekan{{ $row }}">Dekan</span></td>
                        </tr>
                        <tr>
                            {{-- <td>1</td> --}}
                            <td>&nbsp;</td>
                            <td style='height:60px;'>&nbsp;</td>
                        </tr>
                        <tr>
                            {{-- <td>1</td> --}}
                            <td>&nbsp;</td>
                            <td><span class="namadekan{{ $row }}"></span></td>
                        </tr>
                    </table>
                </div>
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
            // var tw = new Date();
            // if (tw.getTimezoneOffset() == 0)(a = tw.getTime() + (7 * 60 * 60 * 1000))
            // else(a = tw.getTime());
            // tw.setTime(a);
            // var tahun = tw.getFullYear();
            // var bulan = tw.getMonth();
            // var tanggal = tw.getDate();
            // var bulanarray = new Array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus",
            //     "September", "Oktober", "November", "Desember");
            // document.getElementById("tanggalwaktu{{ $row }}").innerHTML = tanggal + " " + bulanarray[
            //     bulan] + " " + tahun;


            var nim = $('#nim{{ $row }}').val();
            // var tahun = $('#tahun').val();
            // var semester = $('#semester').val();

            $.ajax({
                type: 'POST',
                // headers: {
                //     "Authorization": 'Bearer ' + token
                // },
                dataType: "json",
                url: "{{ config('setting.second_url') }}akademik/cetak-transkipnilai1",
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                data: {
                    nim: nim
                    // tahun: tahun,
                    // semester: semester

                },
                success: function(data) {
                    var jml = data.length;

                    var cek = jml % 2;
                    var hasil = jml / 2;
                    var limit_1 = hasil;
                    var limit_2 = hasil;
                    var limit_1_f = 0;
                    var limit_2_f = 0;
                    if (cek == 0) {
                        //genap
                        limit_1_f = limit_1;
                    } else {
                        //ganjil
                        limit_1_f = Math.ceil(limit_1);
                    }

                    var no = 1;
                    var tampil = '';
                    var tampil2 = '';
                    var totalsks = 0;
                    var totalbobot = 0;
                    var totalipk = 0;
                    var jml_ipk_f = 0;
                    // var totalsks = 0;
                    for (var i = 0; i < limit_1_f; i++) {
                        var bobot = data[i].sks_matakuliah * data[i].mutu;
                        if (data[i].nama_matakuliah_inggris == '0') {
                            tampil = tampil +
                                '<tr style="font-size:12px;"><td style="text-align:center;">' +
                                no + '</td><td style="padding-left:5px;">' + data[i].nama_matakuliah +
                                '</td><td style="padding-left:5px;text-align:center;">' + data[i]
                                .sks_matakuliah +
                                '</td><td style="padding-left:5px;text-align:center;">' + data[i]
                                .biji +
                                '</tr>';
                        } else if (data[i].nama_matakuliah_inggris == '-') {
                            tampil = tampil +
                                '<tr style="font-size:12px;"><td style="text-align:center;">' +
                                no + '</td><td style="padding-left:5px;">' + data[i].nama_matakuliah +
                                '</td><td style="padding-left:5px;text-align:center;">' + data[i]
                                .sks_matakuliah +
                                '</td><td style="padding-left:5px;text-align:center;">' + data[i]
                                .biji +
                                '</tr>';
                        } else {
                            tampil = tampil +
                                '<tr style="font-size:12px;"><td style="text-align:center;">' +
                                no + '</td><td style="padding-left:5px;">' + data[i].nama_matakuliah +
                                '<br>' +
                                '<i style="font-size:10px;">' + data[i].nama_matakuliah_inggris +
                                '</i>' +
                                '</td><td style="padding-left:5px;text-align:center;">' + data[i]
                                .sks_matakuliah +
                                '</td><td style="padding-left:5px;text-align:center;">' + data[i]
                                .biji +
                                '</tr>';
                        };

                        no++;
                        totalsks += data[i].sks_matakuliah;
                        totalbobot += bobot;
                        // totalipk = totalbobot / totalsks;
                        // totalsks += data[i].sks_matakuliah;
                    }

                    // console.log(limit_2_f);
                    for (var i = limit_1_f; i < jml; i++) {
                        var bobot = data[i].sks_matakuliah * data[i].mutu;
                        if (data[i].nama_matakuliah_inggris == '0') {
                            tampil2 = tampil2 +
                                '<tr style="font-size:12px;"><td style="text-align:center;">' +
                                no + '</td><td style="padding-left:5px;">' + data[i].nama_matakuliah +
                                '</td><td style="padding-left:5px;text-align:center;">' + data[i]
                                .sks_matakuliah +
                                '</td><td style="padding-left:5px;text-align:center;">' + data[i]
                                .biji +
                                '</tr>';
                        } else if (data[i].nama_matakuliah_inggris == '-') {
                            tampil2 = tampil2 +
                                '<tr style="font-size:12px;"><td style="text-align:center;">' +
                                no + '</td><td style="padding-left:5px;">' + data[i].nama_matakuliah +
                                '</td><td style="padding-left:5px;text-align:center;">' + data[i]
                                .sks_matakuliah +
                                '</td><td style="padding-left:5px;text-align:center;">' + data[i]
                                .biji +
                                '</tr>';
                        } else {
                            tampil2 = tampil2 +
                                '<tr style="font-size:12px;"><td style="text-align:center;">' +
                                no + '</td><td style="padding-left:5px;">' + data[i].nama_matakuliah +
                                '<br>' +
                                '<i style="font-size:10px;">' + data[i].nama_matakuliah_inggris +
                                '</i>' +
                                '</td><td style="padding-left:5px;text-align:center;">' + data[i]
                                .sks_matakuliah +
                                '</td><td style="padding-left:5px;text-align:center;">' + data[i]
                                .biji +
                                '</tr>';
                        };

                        no++;
                        totalsks += data[i].sks_matakuliah;
                        totalbobot += bobot;
                        // totalsks += data[i].sks_matakuliah;
                        // jml_ipk_f = number_format(totalipk, 2);
                        // if (jml_ipk_f >= "3.51" && jml_ipk_f <= "4.00") {
                        //     predikat_kelulusan = "Cumlaude";
                        // }
                        // elseif(jml_ipk_f >= "3.01" && jml_ipk_f <= "3.50") {
                        //     predikat_kelulusan = "Sangat Memuaskan";
                        // }
                        // elseif(jml_ipk_f >= "2.76" && jml_ipk_f <= "3.00") {
                        //     predikat_kelulusan = "Memuaskan";
                        // }
                        // elseif(jml_ipk_f >= "2.00" && jml_ipk_f <= "2.75") {
                        //     predikat_kelulusan = "";
                        // }
                    }
                    totalipk = totalbobot / totalsks;
                    jml_ipk_f = parseFloat(totalipk).toFixed(2);

                    $('#transkipnilai{{ $row }}').html(tampil);
                    $('#transkipnilai1{{ $row }}').html(tampil2);

                    $('#totalsks{{ $row }}').html(totalsks);
                    $('#totalbobot{{ $row }}').html(totalbobot);
                    $('#totalipk{{ $row }}').html(totalipk.toFixed(2));

                    // $('#totalsks').html(totalsks);
                    console.log(tampil);
                    $.ajax({
                        type: 'POST',
                        dataType: "json",
                        url: "{{ config('setting.second_url') }}akademik/get-transkipnilai",
                        headers: {
                            "Authorization": 'Bearer ' + token,
                            "username": userlogin
                        },
                        data: {
                            nim: nim
                        },
                        success: function(result) {
                            console.log(result);
                            var judulindo = "";
                            if (result[0].judul_skripsi_indo != null) {
                                judulindo = result[0].judul_skripsi_indo;
                            }
                            var judulinggris = "";
                            if (result[0].judul_skripsi_inggris != null) {
                                judulinggris = result[0].judul_skripsi_inggris;
                            }
                            // $('.nim_').html(result[0].nim);
                            $('.nama_mhs{{ $row }}').html(result[0]
                                .nama_mahasiswa);
                            $('.nim{{ $row }}').html(nim);
                            $('.program_studi{{ $row }}').html(result[0]
                                .nama_program_studi);
                            $('.tgl_lahir{{ $row }}').html(result[0]
                                .tgllahir);
                            $('.tempat_lahir{{ $row }}').html(result[0]
                                .tempat_lahir);
                            $('.no_sk{{ $row }}').html(result[0].no_sk);
                            $('.status_akreditasi{{ $row }}').html(result[0]
                                .status_akreditasi);
                            $('.judul_skripsi_indo{{ $row }}').html(judulindo
                                .toUpperCase());
                            $('.judul_skripsi_inggris{{ $row }}').html("(" +
                                judulinggris.toUpperCase() + ")");
                            $('.nama_fakultas{{ $row }}').html('FAKULTAS ' +
                                result[0].nama_fakultas
                                .toUpperCase());
                            if (result[0].plt == "1") {
                                $('.ketdekan{{ $row }}').html("Plt. Dekan");
                            } else {
                                $('.ketdekan{{ $row }}').html("Dekan");
                            }
                            $('.namadekan{{ $row }}').html(result[0].namadekan);
                            $('.noijazah{{ $row }}').html(result[0].no_ijazah);
                            $('.nomortranskrip{{ $row }}').html("Nomor : " +
                                result[0]
                                .no_transkrip);
                            $('.tanggalmasuklulus{{ $row }}').html(result[0]
                                .tglmasuk + "/" + result[0].tgllulus);

                            var tahun = result[0].tglyud.substr(6, 4);
                            var bulan = parseInt(result[0].tglyud.substr(3, 2)) - 1;
                            var tanggal = result[0].tglyud.substr(0, 2);
                            var bulanarray = new Array("Januari", "Februari", "Maret",
                                "April", "Mei", "Juni", "Juli", "Agustus",
                                "September", "Oktober", "November", "Desember");
                            document.getElementById("tanggalwaktu{{ $row }}")
                                .innerHTML = tanggal + " " + bulanarray[
                                    bulan] + " " + tahun;
                            if (jml_ipk_f >= 3.51 && jml_ipk_f <= 4.00) {
                                hasilpehitungan = parseInt(result[0].tgllulus.substr(-4)) -
                                    parseInt(result[0].tglmasuk.substr(-4));
                                console.log(hasilpehitungan);
                                if (hasilpehitungan <= 5) {
                                    if (nim == '19420420004') {
                                        predikat_kelulusan = "Sangat Memuaskan";
                                    } else {
                                        predikat_kelulusan = "Cumlaude";
                                    }
                                } else {
                                    predikat_kelulusan = "Sangat Memuaskan";
                                }
                            } else if (jml_ipk_f >= 3.01 && jml_ipk_f <= 3.50) {
                                predikat_kelulusan = "Sangat Memuaskan";
                            } else if (jml_ipk_f >= 2.76 && jml_ipk_f <= 3.00) {
                                predikat_kelulusan = "Memuaskan";
                            } else if (jml_ipk_f >= 2.00 && jml_ipk_f <= 2.75) {
                                predikat_kelulusan = "Baik";
                            } else {
                                predikat_kelulusan = "";
                            }
                            $('#predikat_kelulusan{{ $row }}').html(
                                predikat_kelulusan);
                            // $forlab = result[0].kode_prodi_forlab;
                            // $forlap1 = substr($forlab, 0, 2);
                            // $forlap2 = substr($forlab, 2, 3);
                            // $('.kodeforlab_').html($forlap1.
                            //     "-".$forlap2);
                            var ambil = $('#lutane').val();
                            var hasil = parseInt(ambil) + 1;
                            $('#lutane').val(hasil);
                            if (hasil == $('#topane').val()) {
                                window.print();
                            }
                            // if ($('#nim{{ $row }}').val() == $('#patokan')
                            //     .val()) {
                            //     window.print();
                            // }
                        }
                    });


                }
            });




        });
    </script>
@endforeach
