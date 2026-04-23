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
        @php
            $smt = '';
            if ($semester == '1') {
                $smt = 'Ganjil';
            } else {
                $smt = 'Genap';
            }
            $tahunakademik = $tahun . '/' . ($tahun + 1);
        @endphp
        <input class="form-control" type="hidden" name="nim" id="nim{{ $row }}"
            value="{{ $row }}">
        <input class="form-control" type="hidden" name="tahun" id="tahun{{ $row }}"
            value="{{ $tahun }}">
        <input class="form-control" type="hidden" name="semester" id="semester{{ $row }}"
            value="{{ $semester }}">
        <input class="form-control" type="hidden" name="kode_nilai" id="kode_nilai{{ $row }}"
            value="{{ $kode_nilai }}">
        <div style='padding-bottom:100px;'>
            <div class='row'>
                <div class='col-xs-12'>
                    <table style='width:100%;'>
                        <tr>
                            <td style='padding-right:10px;width:80px;'><img src='{{ url('imageup45/logoumuka.png') }}'
                                    style='width:80px;'></td>
                            <td style='font-size:20px;padding-left:5px;font-weight:bold;'>UNIVERSITAS MUHAMMADIYAH
                                KARANGANYAR
                                <div style='font-size:12px;padding-bottom:3px;margin-top:-3px;'>
                                    Jl. Raya Solo-Tawangmangu Km 12, Papahan, Kec. Tasikmadu, Kabupaten Karanganyar,
                                    Jawa
                                    Tengah 57722</div>
                                <div style='font-size:12px;padding-bottom:3px;margin-top:-3px;'>website:
                                    www.umuka.ac.id, email:
                                    umuka@umuka.ac.id
                                </div>
                                <div
                                    style='font-size:12px;padding-bottom:3px;margin-top:-3px;border-bottom:1px solid black;'>
                                    Telepon
                                    (0271)
                                    6498851, 4993819, Admin 08112801912
                                    (57761)</div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <div style='font-family:Courier New;height:948px;'>
                <div style='margin-top:10px;text-align:center;'>
                    <span style='font-size:20px;'>KARTU HASIL STUDI (KHS) MAHASISWA</span>
                </div>
                <div style='margin-top:20px;font-size:11px;line-height:10px;'>
                    <table border='0' rules='all0' width='100%' style="font-size:10px;">
                        <tr>
                            <td>NIM</td>
                            <td>:</td>
                            <td><span class="nim_{{ $row }}"></span></td>
                            <td style='width:8px;'>&nbsp;</td>
                            <td style='width:115px;'>TA/SMT</td>
                            <td style='width:10px;'>:</td>
                            <td style='width:200px;'>{{ $smt }} {{ $tahunakademik }}</td>
                        </tr>
                        <tr>
                            <td style='width:100px;'>Nama</td>
                            <td style='width:10px;'>:</td>
                            <td><span class="namamhs_{{ $row }}"></span></td>
                            <td style='width:8px;'>&nbsp;</td>
                            <td>Fakultas</td>
                            <td>:</td>
                            <td><span id='nama_fakultas{{ $row }}'></span></td>
                        </tr>
                        <tr>
                            <td>Pembimbing Akademik</td>
                            <td>:</td>
                            <td><span id="dosenwali{{ $row }}"></span></td>
                            <td style='width:8px;'>&nbsp;</td>
                            <td>Program Studi</td>
                            <td>:</td>
                            <td><span class="namaprodi_{{ $row }}"></span></td>
                        </tr>
                        <tr>
                            <td>Jenjang Studi</td>
                            <td>:</td>
                            <td class="jenjange{{ $row }}">Strata 1 (S1)</td>
                            <td style='width:8px;'>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                </div>
                <div style='margin-top:5px;font-size:12px;'>
                    <table border='1' rules='all0' width='100%'
                        style="font-size:11px;border-collapse: collapse;">
                        <tr>
                            <td style='width:20px;padding-left:5px;text-align:center;'>NO</td>
                            <td style='width:50px;padding-left:5px;text-align:center;'>Kode MK</td>
                            <td style='width:200px;padding-left:5px;text-align:center;'>Matakuliah</td>
                            <td style='width:20px;padding-left:5px;text-align:center;'>SKS</td>
                            <td style='width:30px;padding-left:5px;text-align:center;'>Huruf</td>
                            <td style='width:30px;padding-left:5px;text-align:center;'>Mutu</td>
                            <td style='width:30px;padding-left:5px;text-align:center;'>Nilai</td>
                        </tr>
                        <tbody id="kartuhasilstudi{{ $row }}" style='font-size:11px;'>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td style='width:200px;padding-left:5px;text-align:center;' colspan="3">Jumlah SKS
                                </td>
                                <td style='width:20px;padding-left:5px;text-align:center;'>
                                    <p id="totalsks{{ $row }}"></p>
                                </td>
                                <td style='width:30px;padding-left:5px;text-align:center;'>&nbsp;</td>
                                <td style='width:30px;padding-left:5px;text-align:center;'>&nbsp;</td>
                                <td style='width:30px;padding-left:5px;text-align:center;'>
                                    <p id="totalbobot{{ $row }}"></p>
                                </td>
                            </tr>
                            <tr>
                                <td style='width:200px;padding-left:5px;text-align:center;' colspan="3">IP Semester
                                </td>
                                <td style='width:20px;padding-left:5px;text-align:center;'>
                                    <p id="totalipk{{ $row }}"></p>
                                </td>
                                <td style='width:30px;padding-left:5px;text-align:center;' colspan="3">
                                    <p id="batassks{{ $row }}"></p>
                                </td>
                            </tr>
                            <tr>
                                <td style='width:200px;padding-left:5px;text-align:center;' colspan="3">IP Komulatif
                                </td>
                                <td style='width:20px;padding-left:5px;text-align:center;'>&nbsp;</td>
                                <td style='width:30px;padding-left:5px;text-align:center;' colspan="3">&nbsp;</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div style='margin-top:50px;font-size:12px;'>
                    <table border='0' rules='all0' style='font-size:11px;'>
                        <tr>
                            <td>&nbsp;</td>
                            <td style='width:50px;'>&nbsp;</td>
                            <td>Karanganyar, <span id="tanggalwaktu{{ $row }}"></span></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>Dekan</td>
                        </tr>
                        <tr>
                            <td style='height:70px;'>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td style='height:70px;'>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td><span id="dekanebos{{ $row }}"></span></td>
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
            var tw = new Date();
            if (tw.getTimezoneOffset() == 0)(a = tw.getTime() + (7 * 60 * 60 * 1000))
            else(a = tw.getTime());
            tw.setTime(a);
            var tahun = tw.getFullYear();
            var bulan = tw.getMonth();
            var tanggal = tw.getDate();
            var bulanarray = new Array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus",
                "September", "Oktober", "Nopember", "Desember");
            document.getElementById("tanggalwaktu{{ $row }}").innerHTML = tanggal + " " + bulanarray[
                bulan] + " " + tahun;

            var nim = $('#nim{{ $row }}').val();
            var tahun = $('#tahun{{ $row }}').val();
            var semester = $('#semester{{ $row }}').val();

            $.ajax({
                type: 'POST',
                dataType: "json",
                url: "{{ config('setting.second_url') }}akademik/cetak-kartuhasilstudi1",
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                data: {
                    nim: nim,
                    tahun: tahun,
                    semester: semester

                },
                success: function(data) {
                    var jml = data.length;

                    var no = 1;
                    var tampil = '';
                    var totalsks = 0;
                    var totalbobot = 0;
                    var batassks = 0;
                    var totalipk = 0;
                    for (var i = 0; i < jml; i++) {
                        var nilaihuruf = "";
                        var mutu = "";
                        if (data[i].mutu != null) {
                            mutu = data[i].mutu;
                        }
                        if (data[i].nilai_akhir_huruf != null) {
                            nilaihuruf = data[i].nilai_akhir_huruf;
                        }
                        var bobot = data[i].sks_matakuliah * data[i].mutu;
                        tampil = tampil + '<tr style="font-size:9px;"><td style="text-align:center;">' +
                            no + '</td><td style="padding-left:5px;">' + data[i].kode_matakuliah +
                            '</td><td style="padding-left:5px;">' + data[i].nama_matakuliah +
                            '</td><td style="padding-left:5px;"><center>' + data[i].sks_matakuliah +
                            '</center></td><td style="padding-left:5px;"><center>' + nilaihuruf +
                            '</center></td><td style="padding-left:5px;"><center>' + mutu +
                            '</center></td><td style="padding-left:5px;"><center>' + bobot.toFixed(2) +
                            '</center></td></tr>';
                        no++;
                        totalsks += parseFloat(data[i].sks_matakuliah);
                        // batassks = data[i].batas_sks;
                        totalbobot += bobot;
                        totalipk = totalbobot / totalsks;
                    }
                    if (totalipk >= 3.00) {
                        batassks = 24;
                    } else if (totalipk >= 2.50) {
                        batassks = 21;
                    } else if (totalipk >= 2.00) {
                        batassks = 18;
                    } else if (totalipk >= 1.50) {
                        batassks = 15;
                    } else {
                        batassks = 12;
                    }
                    $('#kartuhasilstudi{{ $row }}').html(tampil);

                    $('#totalsks{{ $row }}').html(totalsks);
                    $('#totalbobot{{ $row }}').html(totalbobot.toFixed(2));
                    $('#batassks{{ $row }}').html("Diperbolehkan mengambil SKS max. " +
                        batassks);
                    $('#totalipk{{ $row }}').html(totalipk.toFixed(2));
                    console.log(tampil);

                    $.ajax({
                        type: 'POST',
                        dataType: "json",
                        url: "{{ config('setting.second_url') }}akademik/get-mhs",
                        headers: {
                            "Authorization": 'Bearer ' + token,
                            "username": userlogin
                        },
                        data: {
                            nim: nim
                        },
                        success: function(result) {
                            console.log(result);
                            $('.nim_{{ $row }}').html(result.nim);
                            $('.namaprodi_{{ $row }}').html(result
                                .nama_program_studi);
                            $('.namamhs_{{ $row }}').html(result.nama_mahasiswa);
                            $('#kaprodi{{ $row }}').html(result.namaprodi);
                            $('#dosenwali{{ $row }}').html(result.dosen_wali);
                            var kdjnjang = '';
                            if (result.kode_jenjang_pendidikan == '1') {
                                kdjnjang = "D3";
                            } else if (result.kode_jenjang_pendidikan == '2') {
                                kdjnjang = "S1";
                            } else if (result.kode_jenjang_pendidikan == '3') {
                                kdjnjang = "S2";
                            } else if (result.kode_jenjang_pendidikan == '4') {
                                kdjnjang = "S3";
                            } else if (result.kode_jenjang_pendidikan == '5') {
                                kdjnjang = "D4";
                            }

                            $('.jenjange{{ $row }}').html(kdjnjang);
                            $('#dekanebos{{ $row }}').html(result.dekane);
                            $('#nama_fakultas{{ $row }}').html('FAKULTAS ' +
                                result.nama_fakultas
                                .toUpperCase());


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
