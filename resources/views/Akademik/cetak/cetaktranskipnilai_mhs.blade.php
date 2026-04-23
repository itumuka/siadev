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
        <input class="form-control" type="hidden" name="nim" id="nim" value="{{ $row }}">

        <div style='font-family:Courier New;height:850px;'>
            <div style='margin-top:10px;text-align:center;'>
                <span style='font-size:20px;font-weight:bold;'>TRANSKRIP NILAI</span>
            </div>
            <div style='margin-top:-7px;text-align:center;'>
                <span style='font-size:14px;font-weight:bold;'>Nomor :</span>
            </div>

            <div style='margin-top:15px;'>
                <table border='0' rules='all0' width='100%' style='font-size:11px;line-height:10px'>
                    <tr>
                        <td style='width:95px;'>Nama</td>
                        <td style='width:10px;'>:</td>
                        <td style='width:220px;'><span class="nama_mhs{{ $row }}"></span></td>
                        <td style='width:170px;'>Jenjang Pendidikan</td>
                        <td>:</td>
                        <td>Strata 1</td>
                    </tr>
                    <tr>
                        <td>NIM</td>
                        <td>:</td>
                        <td><span class="nim{{ $row }}">{{ $row }}</span></td>
                        <td>Program Studi</td>
                        <td>:</td>
                        <td><span class="program_studi{{ $row }}"></span></td>
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
                        <td>Nomor SK BAN PT</td>
                        <td>:</td>
                        <td style='width:220px;'><span class="no_sk{{ $row }}"></span></td>
                    </tr>
                </table>
            </div>

            <div style='font-size:10px;padding-top:2px;'>
                <table border='0' rules='all1' width='100%'>
                    <tr>
                        <td colspan='2' style='border-top:2px solid black;'></td>
                    </tr>
                    <tr>
                        <td style='width:50%;padding-right:2px;vertical-align:top;'>
                            <table border='0' rules='all0' width='100%' style='line-height:10px;'>
                                <thead>
                                    <tr style='font-size:11px;'>
                                        <td
                                            style='width:50px;padding-left:5px;padding-top:7px;padding-bottom:7px;text-align:center;'>
                                            NO
                                        </td>
                                        <td style='width:130px;padding-left:5px;'>Nama Matakuliah</td>
                                        <td style='padding-left:5px;text-align:center;'>SKS</td>
                                        <td style='width:80px;text-align:center;'>Nilai</td>
                                    </tr>
                                    <tr>
                                        <td colspan='5' style='border-top:1px solid black;'></td>
                                    </tr>
                                </thead>
                                <tbody id="transkipnilai{{ $row }}">
                                </tbody>
                            </table>
                        </td>
                        <td style='width:50%;padding-right:2px;vertical-align:top;'>
                            <table border='0' rules='all0' width='100%' style='line-height:10px;'>
                                <thead>
                                    <tr style='font-size:11px;'>
                                        <td
                                            style='width:50px;padding-left:5px;padding-top:7px;padding-bottom:7px;text-align:center;'>
                                            NO
                                        </td>
                                        <td style='width:130px;padding-left:5px;'>Nama Matakuliah</td>
                                        <td style='padding-left:5px;text-align:center;'>SKS</td>
                                        <td style='width:80px;text-align:center;'>Nilai</td>
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
            <div style='font-size:10px;padding-top:2px;'>
                <table border='0' rules='all0' width='100%' style='line-height:10px;'>
                    <tr>
                        <td style='border-top:1px solid black;'></td>
                    </tr>
                </table>
                <table border='0' rules='all0' width='100%' style='line-height:10px;font-size:10px;'>
                    <tr style='border-top:1px solid black;'>
                        <td style='width:80px;'>Jumlah SKS</td>
                        <td style='width:10px;'>:</td>
                        <td style='width:50px;'><span id="totalsks{{ $row }}"></span></td>
                        <td style='width:140px;'>Jumlah SKS x Nilai</td>
                        <td style='width:10px;'>:</td>
                        <td style='width:70px;'><span id="totalbobot{{ $row }}"></span></td>
                        <td style='width:20px;'>IP</td>
                        <td style='width:10px;'>:</td>
                        <td style='width:10px;'><span id="totalipk{{ $row }}"></span></td>
                        <td style='width:50px;'>&nbsp;</td>
                        <td style='width:200px;'>( Nilai D = <span id="nilaid{{ $row }}"></span>, E = <span
                                id="nilaie{{ $row }}"></span> )</td>
                        <td style='width:50px;'>&nbsp;</td>
                    </tr>
                </table>
                <table border='0' rules='all0' width='100%' style='line-height:10px;'>
                    <tr>
                        <td style='border-top:1px solid black;'></td>
                    </tr>
                </table>
                <div style='float:right;margin-top:10px;'>
                    <table border='0' rules='all0' style='line-height:10px;font-size:12px;'>
                        <tr>
                            <td style='width:50px;'>&nbsp;</td>
                            <td>Karanganyar, <span id="tanggalwaktu{{ $row }}"></span></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>Kepala Program Studi</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><span id="prodi{{ $row }}"></span></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td style='height:60px;'>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><span id="kaprodi{{ $row }}"></span></td>
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
            var tw = new Date();
            if (tw.getTimezoneOffset() == 0)(a = tw.getTime() + (7 * 60 * 60 * 1000))
            else(a = tw.getTime());
            tw.setTime(a);
            var tahun = tw.getFullYear();
            var bulan = tw.getMonth();
            var tanggal = tw.getDate();
            var bulanarray = new Array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus",
                "September", "Oktober", "November", "Desember");
            document.getElementById("tanggalwaktu{{ $row }}").innerHTML = tanggal + " " + bulanarray[
                bulan] + " " + tahun;


            var nim = $('#nim{{ $row }}').val();
            // var tahun = $('#tahun').val();
            // var semester = $('#semester').val();

            $.ajax({
                type: 'POST',
                dataType: "json",
                url: "{{ config('setting.second_url') }}akademik/cetaktranskipnilaikurikulum",
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
                    var nilaid = 0;
                    var nilaie = 0;
                    // var totalsks = 0;
                    for (var i = 0; i < limit_1_f; i++) {
                        var nilai = "";
                        if (data[i].nilai_huruf_akhir == null) {

                        } else {
                            nilai = data[i].nilai_huruf_akhir;
                            var bobot = data[i].sks_matakuliah * data[i].mutu;
                            totalsks += data[i].sks_matakuliah;
                            totalbobot += bobot;
                            totalipk = totalbobot / totalsks;
                        }
                        if (data[i].nilai_huruf_akhir == "D") {
                            nilaid = nilaid + 1;
                        } else if (data[i].nilai_huruf_akhir == "E") {
                            nilaie = nilaie + 1;
                        }
                        tampil = tampil + '<tr style="font-size:9px;"><td style="text-align:center;">' +
                            no + '</td><td style="padding-left:5px;">' + data[i].nama_matakuliah +
                            '</td><td style="padding-left:5px;text-align:center;">' + data[i]
                            .sks_matakuliah +
                            '</td><td style="padding-left:5px;text-align:center;">' + nilai +
                            '</tr>';
                        no++;
                    }
                    for (var i = limit_1_f; i < jml; i++) {
                        var nilai = "";
                        if (data[i].nilai_huruf_akhir == null) {

                        } else {
                            nilai = data[i].nilai_huruf_akhir;
                            var bobot = data[i].sks_matakuliah * data[i].mutu;
                            totalsks += data[i].sks_matakuliah;
                            totalbobot += bobot;
                            totalipk = totalbobot / totalsks;
                        }
                        if (data[i].nilai_huruf_akhir == "D") {
                            nilaid = nilaid + 1;
                        } else if (data[i].nilai_huruf_akhir == "E") {
                            nilaie = nilaie + 1;
                        }
                        tampil2 = tampil2 +
                            '<tr style="font-size:9px;"><td style="text-align:center;">' +
                            no + '</td><td style="padding-left:5px;">' + data[i].nama_matakuliah +
                            '</td><td style="padding-left:5px;text-align:center;">' + data[i]
                            .sks_matakuliah +
                            '</td><td style="padding-left:5px;text-align:center;">' + nilai +
                            '</tr>';
                        no++;
                    }
                    $('#totalsks{{ $row }}').html(totalsks);
                    $('#totalbobot{{ $row }}').html(totalbobot);
                    $('#totalipk{{ $row }}').html(totalipk.toFixed(2));
                    $('#transkipnilai{{ $row }}').html(tampil);
                    $('#transkipnilai1{{ $row }}').html(tampil2);
                    $('#nilaid{{ $row }}').html(nilaid);
                    $('#nilaie{{ $row }}').html(nilaie);

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
                            // $('.nim_').html(result[0].nim);
                            $('.nama_mhs{{ $row }}').html(result[0]
                                .nama_mahasiswa);
                            $('.nim{{ $row }}').html(nim);
                            $('.program_studi{{ $row }}').html(result[0]
                                .nama_program_studi);
                            $('.tgl_lahir{{ $row }}').html(result[0]
                                .tanggal_lahir);
                            $('.tempat_lahir{{ $row }}').html(result[0]
                                .tempat_lahir);
                            $('.no_sk{{ $row }}').html(result[0].no_sk);
                            $('.gabungan{{ $row }}').html(result[0].gelar_depan +
                                ' ' + result[0].nama + ' ' + result[0].gelar_belakang);
                            $('.status_akreditasi{{ $row }}').html(result[0]
                                .status_akreditasi);
                            $('.nama_fakultas{{ $row }}').html('FAKULTAS ' +
                                result[0].nama_fakultas
                                .toUpperCase());
                            $('#prodi{{ $row }}').html('' + result[0]
                                .nama_program_studi);
                            $('#kaprodi{{ $row }}').html('' + result[0]
                                .namakaprodi);
                            // if ($('#nim{{ $row }}').val() == $('#patokan')
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
