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
        <input class="form-control" type="hidden" name="tahun" id="tahun{{ $row }}"
            value="{{ $tahun }}">
        <input class="form-control" type="hidden" name="semester" id="semester{{ $row }}"
            value="{{ $semester }}">
        <div style='padding-bottom:100px;'>
            <div style='margin-top:10px;font-size:13px;'>UNIVERSITAS MUHAMMADIYAH KARANGANYAR</div>
            <div id='nama_fakultas{{ $row }}' style='font-size:20px;margin-top:-5px;'></div>
            <div style='font-size:10px;border-bottom:1px solid black;padding-bottom:3px;margin-top:-3px;'>Jl. Raya
                Solo-Tawangmangu Km 12, Papahan, Kec. Tasikmadu, Kabupaten Karanganyar, Jawa
                Tengah 57722</div>

            <div style='font-family:Courier New;height:948px;'>
                <div style='margin-top:10px;text-align:center;'>
                    <span style='font-size:20px;'>KARTU HASIL STUDI</span>
                </div>

                <div style='text-align:center;font-size:12px;margin-top:-5px;'>Semester
                    {{ Session::get('session_nama_tahunakademik') }}</div>

                <div style='margin-top:20px;font-size:11px;line-height:10px;'>
                    <table border='0' rules='all0' width='100%' style="font-size:10px;">
                        <tr>
                            <td style='width:50px;'>Nama</td>
                            <td style='width:10px;'>:</td>
                            <td><span class="nama_mahasiswa_{{ $row }}"></span></td>
                            <td style='width:8px;'>&nbsp;</td>
                            <td style='width:115px;'>Status Jurusan</td>
                            <td style='width:10px;'>:</td>
                            <td style='width:120px;'>Terakreditasi</td>
                        </tr>
                        <tr>
                            <td>NIM</td>
                            <td>:</td>
                            <td><span class="nim_{{ $row }}"></span></td>
                            <td style='width:8px;'>&nbsp;</td>
                            <td>Jenjang Studi</td>
                            <td>:</td>
                            <td>Strata 1 (S1)</td>
                        </tr>
                        <tr>
                            <td>Jurusan/Prodi</td>
                            <td>:</td>
                            <td><span class="nama_prodi_{{ $row }}"></span></td>
                            <td style='width:8px;'>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                    </table>
                </div>
                <div style='margin-top:5px;font-size:12px;'>
                    <table border='0' rules='all0' width='100%' style="font-size:10px;">
                        <thead>
                            <tr>
                                <td colspan='8' style='border-top:1px solid black;'></td>
                            </tr>
                            <tr>
                                <td style='width:20px;padding-left:5px;'>NO</td>
                                <td style='width:50px;padding-left:5px;'>KodeMK</td>
                                <td style='width:200px;padding-left:5px;text-align:center;'>Matakuliah</td>
                                <td style='width:20px;padding-left:5px;'>SKS</td>
                                <td style='width:30px;padding-left:5px;'>Nilai</td>
                                <td style='width:30px;padding-left:5px;'>Mutu</td>
                                <td style='width:30px;padding-left:5px;'>Bobot</td>
                                <td style='width:200px;padding-left:5px;text-align:center;'>Dosen</td>
                            </tr>
                        </thead>
                        <tbody id="kartuhasilstudi{{ $row }}">
                        </tbody>
                        <tr>
                            <td colspan='8' style='border-top:1px solid black;'></td>
                        </tr>



                        <tr>
                            <td colspan='8' style='border-top:1px solid black;'></td>
                        </tr>
                    </table>
                </div>
                <div>
                    <table border='0' rules='all0' width:100%; style='font-size:10px;'>
                        <tr>
                            <td style='width:50px;'>IP</td>
                            <td style='width:7px;'>:</td>
                            <td style='width:30px;'><span id="totalipk{{ $row }}"></span></td>
                            <td style='width:217px;text-align:right;padding-right:4px;'>Jumlah SKS</td>
                            <td style='width:30px;'><span id="totalsks{{ $row }}"></span></td>
                            <td style='width:95px;text-align:right;padding-right:4px;'>Jumlah Bobot</td>
                            <td style='width:25px;'><span id="totalbobot{{ $row }}"></span></td>
                        </tr>
                        <tr>
                            <td>Hak SKS</td>
                            <td>:</td>
                            <td style='width:30px;'><span id="batassks{{ $row }}"></span></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                    </table>
                </div>
                <div style='margin-top:50px;font-size:12px;float:right;'>
                    <table border='0' rules='all0' style="font-size:10px;">
                        <tr>
                            <td>&nbsp;</td>
                            <td style='width:50px;'>&nbsp;</td>
                            <td>Karanganyar, <span id="tanggalwaktu{{ $row }}"></span></td>
                        </tr>
                        <tr>
                            <td>Ketua Program Studi</td>
                            <td>&nbsp;</td>
                            <td>Pembimbing Akademik</td>
                        </tr>
                        <tr>
                            <td style='height:70px;'>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td style='height:70px;'>&nbsp;</td>
                        </tr>
                        <tr>
                            <td><span id="kaprodi{{ $row }}"></span></td>
                            <td>&nbsp;</td>
                            <td><span id="dpa{{ $row }}"></span></td>
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
                        var nilaiangka = "";
                        if (data[i].nilai_akhir_angka != null) {
                            nilaiangka = data[i].nilai_akhir_angka;
                        }
                        if (data[i].nilai_akhir_huruf != null) {
                            nilaihuruf = data[i].nilai_akhir_huruf;
                        }
                        var bobot = data[i].sks_matakuliah * data[i].nilai_akhir_angka;
                        tampil = tampil + '<tr style="font-size:9px;"><td style="text-align:center;">' +
                            no + '</td><td style="padding-left:5px;">' + data[i].kode_matakuliah +
                            '</td><td style="padding-left:5px;">' + data[i].nama_matakuliah +
                            '</td><td style="padding-left:5px;"><center>' + data[i].sks_matakuliah +
                            '</center></td><td style="padding-left:5px;"><center>' + nilaihuruf +
                            '</center></td><td style="padding-left:5px;">' + nilaiangka +
                            '</center></td><td style="padding-left:5px;">' + bobot +
                            '</center></td><td style="padding-left:5px;"><center>(' + data[i]
                            .nama_dosen + data[i].nama_dosen2 +
                            ')</center></td></tr>';
                        no++;
                        totalsks += data[i].sks_matakuliah;
                        batassks = data[i].batas_sks;
                        totalbobot += bobot;
                        totalipk = totalbobot / totalsks;
                    }
                    $('#kartuhasilstudi{{ $row }}').html(tampil);

                    $('#totalsks{{ $row }}').html(totalsks);
                    $('#totalbobot{{ $row }}').html(totalbobot);
                    $('#batassks{{ $row }}').html(batassks);
                    $('#totalipk{{ $row }}').html(totalipk.toFixed(2));
                    console.log(tampil);

                    $.ajax({
                        type: 'POST',
                        dataType: "json",
                        url: "{{ config('setting.second_url') }}akademik/get-kartuhasilstudi",
                        headers: {
                            "Authorization": 'Bearer ' + token,
                            "username": userlogin
                        },
                        data: {
                            nim: nim,
                            tahun: tahun,
                            semester: semester
                        },
                        success: function(result) {
                            console.log(result);
                            $('.nama_mahasiswa_{{ $row }}').html(result[0]
                                .nama_mahasiswa);
                            $('.nim_{{ $row }}').html(result[0].nim);
                            $('.semester_{{ $row }}').html(result[0].semester);
                            $('.nama_prodi_{{ $row }}').html(result[0]
                                .nama_program_studi);
                            $('.kode_matakuliah_{{ $row }}').html(result[0]
                                .kode_matakuliah);
                            $('#nama_fakultas{{ $row }}').html('FAKULTAS ' +
                                result[0].nama_fakultas.toUpperCase());
                            $('#dpa{{ $row }}').html('' + result[0]
                                .nama_dpa);
                            $('#kaprodi{{ $row }}').html('' + result[0]
                                .nama_kaprodi);
                            // $forlab = result[0].kode_prodi_forlab;
                            // $forlap1 = substr($forlab, 0, 2);
                            // $forlap2 = substr($forlab, 2, 3);
                            // $('.kodeforlab_').html($forlap1.
                            //     "-".$forlap2);
                            // if ($('#nim{{ $row }}').val() == $('#patokan')
                            // .val()) {
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
