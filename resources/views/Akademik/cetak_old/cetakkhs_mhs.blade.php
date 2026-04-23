<html>

<body>
    <input class="form-control" type="hidden" name="nim" id="nim" value="{{ $nim }}">
    <input class="form-control" type="hidden" name="tahun" id="tahun" value="{{ $tahun }}">
    <input class="form-control" type="hidden" name="semester" id="semester" value="{{ $semester }}">
    <input class="form-control" type="hidden" name="id_her" id="id_her"
        value="{{ isset($id_her) ? $id_her : '' }}">

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
            <span style='font-size:20px;'>KARTU HASIL STUDI</span>
        </div>
        <div style='text-align:center;font-size:12px;margin-top:-5px;'>
            @php
                $smt = '';
                if ($semester == '1') {
                    $smt = 'Ganjil';
                } else {
                    $smt = 'Genap';
                }
                $tahunakademik = $tahun . '/' . ($tahun + 1);
            @endphp
            Semester {{ $smt }} {{ $tahunakademik }}
        </div>
        <div style='margin-top:20px;font-size:11px;line-height:10px;'>
            <table border='0' rules='all0' width='100%' style="font-size:11px;">
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

        <div style='margin-top:5px;font-size:12px;'>
            <table border='0' rules='all0' width='100%' style="font-size:11px;">
                <tr>
                    <td colspan='8' style='border-top:1px solid black;'></td>
                </tr>
                <tr>
                    <td style='width:20px;padding-left:5px;'>NO</td>
                    <td style='width:50px;padding-left:5px;'>Kode MK</td>
                    <td style='width:200px;padding-left:5px;text-align:center;'>Matakuliah</td>
                    <td style='width:20px;padding-left:5px;'>SKS</td>
                    <td style='width:30px;padding-left:5px;'>Nilai</td>
                    <td style='width:30px;padding-left:5px;'>Mutu</td>
                    <td style='width:30px;padding-left:5px;'>Bobot</td>
                    <td style='width:200px;padding-left:5px;text-align:center;'>Dosen</td>
                </tr>
                <tr>
                    <td colspan='8' style='border-top:1px solid black;'></td>
                </tr>
                <tbody id="krs" style='font-size:11px;'>
                </tbody>

                <tr>
                    <td colspan='8' style='border-top:1px solid black;'></td>
                </tr>
            </table>
        </div>
        <div>
            <table border='0' rules='all0' width:100%; style='font-size:11px;'>
                <tr>
                    <td style='width:35px;'>IP</td>
                    <td style='width:7px;'>:</td>
                    <td style='width:30px;'><span id="nilai_ip"></span></td>
                    <td style='width:100px;text-align:right;padding-right:4px;'>Jumlah SKS</td>
                    <td style='width:7px;'>:</td>
                    <td style='width:30px;'><span id="totalsks"></span></td>
                    <td style='width:95px;text-align:right;padding-right:4px;'>Jumlah Bobot</td>
                    <td style='width:7px;'>:</td>
                    <td style='width:45px;'><span id="bobot"></span></td>
                    <td style='width:70px;'>Hak SKS</td>
                    <td style='width:7px;'>:</td>
                    <td style='width:30px;'><span id="batas_sks"></span></td>
                </tr>
            </table>
        </div>
        <div style='margin-top:50px;font-size:12px;float:right;'>
            <table border='0' rules='all0' style='font-size:11px;'>
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
                    <td><span id="kaprodi"></span></td>
                    <td>&nbsp;</td>
                    <td><span id="dosenwali"></span></td>
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
        var id_her = $('#id_her').val();

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
                $('#kaprodi').html(result.namaprodi);
                $('#dosenwali').html(result.dosen_wali);
                $('#nama_fakultas').html('FAKULTAS ' + result.nama_fakultas.toUpperCase());
                get_table();
            }
        });

        function get_table() {
            $.ajax({
                type: 'POST',
                dataType: "json",
                url: "{{ config('setting.second_url') }}akademik/cetak-khs",
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                data: {
                    nim: nim,
                    tahun: tahun,
                    semester: semester,
                    id_her: id_her
                },
                success: function(data) {
                    var jml = data.length;

                    var no = 1;
                    var tampil = '';
                    var totalsks = 0;
                    var bobot = 0;
                    var total_nilai = 0;

                    for (var i = 0; i < jml; i++) {
                        tampil = tampil +
                            '<tr style="font-size:10px;"><td style="text-align:center;">' +
                            no + '</td><td style="padding-left:5px;">' + data[i].kode_matakuliah +
                            '</td><td style="padding-left:5px;">' + data[i].nama_matakuliah +
                            '</td><td style="text-align:center;">' + data[i].sks +
                            '</td><td style="text-align:center;">' + data[i].nilai_huruf_akhir +
                            '</td><td style="text-align:center;">' + data[i].nilai_akhir_angka +
                            '</td><td style="text-align:center;">' + data[i].total_nilai +
                            '</td><td style="padding-left:5px;">' + data[i].nama_dosen +
                            '</td></tr>';
                        totalsks += data[i].sks;
                        bobot += parseFloat(data[i].mutu);
                        total_nilai += data[i].total_nilai;
                        no++;
                    }

                    $('#krs').html(tampil);
                    $('#totalsks').html(totalsks);
                    $('#bobot').html(bobot);
                    $('#nilai_ip').html((total_nilai / totalsks).toFixed(2));


                    var ips = (total_nilai / totalsks).toFixed(2);
                    //sylvert code (batas sks)
                    if (ips >= 3.00) {
                        batas_sks = 24;
                    } else if (ips >= 2.50) {
                        batas_sks = 21;
                    } else if (ips >= 2.00) {
                        batas_sks = 18;
                    } else if (ips >= 1.50) {
                        batas_sks = 15;
                    } else {
                        batas_sks = 12;
                    }

                    $('#batas_sks').html(batas_sks);

                    // console.log(tampil);
                    window.print();
                }
            });
        }


    });
</script>
