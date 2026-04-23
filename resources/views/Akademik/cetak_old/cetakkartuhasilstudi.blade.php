<html>

<body>
    <input class="form-control" type="hidden" name="nim" id="nim" value="{{ $nim }}">
    <input class="form-control" type="hidden" name="tahun" id="tahun" value="{{ $session_tahun }}">
    <input class="form-control" type="hidden" name="semester" id="semester" value="{{ $session_semester }}">
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

    <div style='font-family:Courier New;height:948px;'>
        <div style='margin-top:10px;text-align:center;'>
            <span style='font-size:20px;'>KARTU HASIL STUDI</span>
        </div>

        <div style='text-align:center;font-size:12px;margin-top:-5px;'>Semester
            {{ Session::get('session_nama_tahunakademik') }}</div>

        <div style='margin-top:20px;font-size:11px;line-height:10px;'>
            <table border='0' rules='all0' width='100%'>
                <tr>
                    <td style='width:50px;'>Nama</td>
                    <td style='width:10px;'>:</td>
                    <td><span class="nama_mahasiswa_"></span></td>
                    <td style='width:8px;'>&nbsp;</td>
                    <td style='width:115px;'>Status Jurusan</td>
                    <td style='width:10px;'>:</td>
                    <td style='width:120px;'>Terakreditasi</td>
                </tr>
                <tr>
                    <td>NIM</td>
                    <td>:</td>
                    <td><span class="nim_"></span></td>
                    <td style='width:8px;'>&nbsp;</td>
                    <td>Jenjang Studi</td>
                    <td>:</td>
                    <td>Strata 1 (S1)</td>
                </tr>
                <tr>
                    <td>Jurusan/Prodi</td>
                    <td>:</td>
                    <td><span class="nama_prodi_"></span></td>
                    <td style='width:8px;'>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
            </table>
        </div>
        <div style='margin-top:5px;font-size:12px;'>
            <table border='0' rules='all0' width='100%'>
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
                <tbody id="kartuhasilstudi">
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
            <table border='0' rules='all0' width:100%; style='font-size:12px;'>
                <tr>
                    <td style='width:50px;'>IP</td>
                    <td style='width:7px;'>:</td>
                    <td style='width:30px;'><span id="totalipk"></span></td>
                    <td style='width:217px;text-align:right;padding-right:4px;'>Jumlah SKS</td>
                    <td style='width:30px;'><span id="totalsks"></span></td>
                    <td style='width:95px;text-align:right;padding-right:4px;'>Jumlah Bobot</td>
                    <td style='width:25px;'><span id="totalbobot"></span></td>
                </tr>
                <tr>
                    <td>Hak SKS</td>
                    <td>:</td>
                    <td style='width:30px;'><span id="batassks"></span></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
            </table>
        </div>
        <div style='margin-top:50px;font-size:12px;float:right;'>
            <table border='0' rules='all0'>
                <tr>
                    <td>&nbsp;</td>
                    <td style='width:50px;'>&nbsp;</td>
                    <td>Karanganyar, <span id="tanggalwaktu"></span></td>
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
                    <td>(...................)</td>
                    <td>&nbsp;</td>
                    <td>(...................)</td>
                </tr>
            </table>
        </div>
    </div>
    <div style='page-break-after:always'></div>
</body>

</html>
<script src="{{ URL::asset('js/jquery.min.js') }}"></script>
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
        document.getElementById("tanggalwaktu").innerHTML = tanggal + " " + bulanarray[bulan] + " " + tahun;

        var nim = $('#nim').val();
        var tahun = $('#tahun').val();
        var semester = $('#semester').val();

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
                    var bobot = data[i].sks_matakuliah * data[i].nilai_akhir_angka;
                    tampil = tampil + '<tr style="font-size:9px;"><td style="text-align:center;">' +
                        no + '</td><td style="padding-left:5px;">' + data[i].kode_matakuliah +
                        '</td><td style="padding-left:5px;">' + data[i].nama_matakuliah +
                        '</td><td style="padding-left:5px;"><center>' + data[i].sks_matakuliah +
                        '</center></td><td style="padding-left:5px;"><center>' + data[i]
                        .nilai_akhir_huruf +
                        '</center></td><td style="padding-left:5px;"><center>' + data[i]
                        .nilai_akhir_angka +
                        '</center></td><td style="padding-left:5px;"><center>' + bobot +
                        '</center></td><td style="padding-left:5px;"><center>(' + data[i]
                        .nama_dosen + data[i].nama_dosen2 +
                        ')</center></td></tr>';
                    no++;
                    totalsks += data[i].sks_matakuliah;
                    batassks = data[i].batas_sks;
                    totalbobot += bobot;
                    totalipk = totalbobot / totalsks;
                }
                $('#kartuhasilstudi').html(tampil);

                $('#totalsks').html(totalsks);
                $('#totalbobot').html(totalbobot);
                $('#batassks').html(batassks);
                $('#totalipk').html(totalipk.toFixed(2));
                console.log(tampil);
                window.print();
            }
        });

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
                $('.nama_mahasiswa_').html(result[0].nama_mahasiswa);
                $('.nim_').html(result[0].nim);
                $('.semester_').html(result[0].semester);
                $('.nama_prodi_').html(result[0].nama_program_studi);
                $('.kode_matakuliah_').html(result[0].kode_matakuliah);
                $('#foto_').html(result[0].foto);
                $('#nama_fakultas').html('FAKULTAS ' + result[0].nama_fakultas.toUpperCase());
                // $forlab = result[0].kode_prodi_forlab;
                // $forlap1 = substr($forlab, 0, 2);
                // $forlap2 = substr($forlab, 2, 3);
                // $('.kodeforlab_').html($forlap1.
                //     "-".$forlap2);
            }
        });


    });
</script>
