<html>

<body>
    <input class="form-control" type="hidden" name="nim" id="nim" value="{{ $nim }}">
    <input class="form-control" type="hidden" name="tahun" id="tahun" value="{{ $tahun }}">
    <input class="form-control" type="hidden" name="semester" id="semester" value="{{ $semester }}">

    <div style='padding-bottom:100px;'>
        <div style='margin-top:10px;font-size:13px;'>UNIVERSITAS MUHAMMADIYAH KARANGANYAR</div>
        <div style='margin-top:-2px;font-size:13px;'>FAKULTAS $nama_fakultas</div>

        <div style='font-family:Courier New;'>
            <div style='margin-top:10px;text-align:center;'>
                <span style='font-size:20px;'>KARTU RENCANA STUDI</span>
            </div>
            <div style='text-align:center;font-size:12px;margin-top:-5px;'> {{ $session_nama_tahunakademik }}</div>
            <div style='margin-top:20px;font-size:12px;'>
                <table border='0' rules='all0' width='100%' style='line-height:14px;font-size:11px;'>
                    <tr>
                        <td style='width:50px;'>Nama</td>
                        <td style='width:10px;'>:</td>
                        <td><span class="namamhs_"></span></td>
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
                        <td><span class="namaprodi_"></span></td>
                        <td style='width:8px;'>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                </table>
            </div>

            <div style='margin-top:5px;font-size:11px;'>
                <table border='0' rules='all0' width='100%' style="font-size:11px;">
                    <thead>
                        <tr>
                            <td colspan='8' style='border-top:2px solid black;'></td>
                        </tr>
                        <tr>
                            <td style='width:20px;padding-left:5px;padding-top:2px;padding-bottom:2px;'>NO</td>
                            <td style='width:50px;padding-left:5px;'>Kode</td>
                            <td style='width:200px;padding-left:5px;text-align:center;'>Matakuliah</td>
                            <td style='width:10px;text-align:center;'>SKS</td>
                            <td style='width:20px;text-align:center;'>Kelas</td>
                            <td style='width:200px;padding-left:5px;text-align:center;'>Dosen</td>
                        </tr>
                        <tr>
                            <td colspan='8' style='border-top:1px solid black;'></td>
                        </tr>
                    </thead>
                    <tbody id="krs">
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan='8' style='border-bottom:1px solid black;'></td>
                        </tr>
                        <tr>
                            <td colspan='3' style='text-align:right;padding-right:4px;'>Jumlah SKS</td>
                            <td style='width:30px;text-align:center;'><span id="totalsks"></td>
                        </tr>
                    </tfoot>

                </table>
            </div>

            <div style='margin-top:5px;font-size:12px;'>
                <table border='0' rules='all1' width='100%'>
                    <tr>
                        <td rowspan='4'>
                            <div style='margin-top:-18px;'>
                                &nbsp;
                            </div>
                        </td>
                        <td style='width:20px;'>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td style='width:20px;'>&nbsp;</td>
                        <td style='width:160px;'>Karanganyar, <span id="tanggalwaktu"></span></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td style='width:160px;'>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td style='height:70px;'>&nbsp;</td>
                        <td style='height:70px;'>&nbsp;</td>
                        <td style='height:70px;'>&nbsp;</td>
                        <td style='height:70px;'>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>(......................)</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
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
            url: "{{ config('setting.second_url') }}akademik/cetak-krs",
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
                for (var i = 0; i < jml; i++) {
                    tampil = tampil + '<tr style="font-size:9px;"><td style="text-align:center;">' +
                        no + '</td><td style="padding-left:5px;">' + data[i].kode_matakuliah +
                        '</td><td style="padding-left:5px;">' + data[i].nama_matakuliah +
                        '</td><td style="text-align:center;">' + data[i].sks_matakuliah +
                        '</td><td style="text-align:center;">' + data[i].nama_kelas +
                        '</td><td style="padding-left:5px;">' + data[i].nama_dosen +
                        '</td></tr>';
                    no++;
                    totalsks += data[i].sks_matakuliah;
                }
                $('#krs').html(tampil);

                $('#totalsks').html(totalsks);
                console.log(tampil);
                window.print();
            }
        });

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
                $('.nim_').html(result.nim);
                $('.namaprodi_').html(result.nama_program_studi);
                $('.namamhs_').html(result.nama_mahasiswa);
            }
        });


    });
</script>
