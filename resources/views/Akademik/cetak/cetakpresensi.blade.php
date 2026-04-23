<html>

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
    <input class="form-control" type="hidden" name="id_kelas" id="id_kelas" value="{{ $id_kelas }}">

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
            <span style='font-size:20px;'>BERITA ACARA</span>
        </div>
        <div style='text-align:center;font-size:12px;margin-top:-5px;'>
            {{ $session_nama_tahunakademik }}
        </div>
        <div style='margin-top:20px;font-size:11px;line-height:10px;'>
            <table border='0' rules='all0' width='100%'>
                <tr>
                    <td style='width:20%;'>Mata Kuliah</td>
                    <td style='width:5%;'>:</td>
                    <td><span class="nama_matakuliah"></span></td>
                    <td style='width:8px;'>&nbsp;</td>
                    <td style='width:20%;'>KodeMK/SKS/Kelas</td>
                    <td style='width:5%;'>:</td>
                    <td><span class="kodemk"></span></td>
                </tr>
                <tr>
                    <td>Dosen</td>
                    <td>:</td>
                    <td><span class="dosen"></span></td>
                    <td style='width:8px;'>&nbsp;</td>
                    <td>HARI/JAM/RUANG</td>
                    <td>:</td>
                    <td><span class="harijamruang"></span></td>
                </tr>
            </table>
        </div>
        <div style='margin-top:5px;'>
            <table border='1' rules='all' width='100%' style='font-size:10px;'>
                <tr>
                    <td colspan="2" style='width:5%;text-align:center;'>Pertemuan</td>
                    <td colspan="5" style='width:2%;text-align:center;'>(Diisi Oleh Dosen)</td>
                    <td colspan="6" style='width:20%;text-align:center;'>(Diisi oleh pejabat yang ditunjuk)</td>
                </tr>
                <tr>
                    <td rowspan="2" style='width:5%;text-align:center;'>Tanggal</td>
                    <td rowspan="2" style='width:2%;text-align:center;'>Ke</td>
                    <td rowspan="2" style='width:20%;text-align:center;'>Materi Perkuliahan / Praktikum</td>
                    <td rowspan="2" style='width:6%;text-align:center;'>Jumlah Hadir Mhs</td>
                    <td colspan="2" style='width:5%;text-align:center;'>Alokasi Waktu</td>
                    <td rowspan="2" style='width:5%;text-align:center;'>Tanda Tangan Dosen</td>
                    <td colspan="3" style='width:8%;text-align:center;'>Kesesuaian materi dengan SAP</td>
                    <td rowspan="2" style='width:8%;text-align:center;'>Tanda Tangan Pemeriksa</td>
                    <td rowspan="2" style='width:12%;text-align:center;'>Catatan</td>
                    <td rowspan="2" style='width:8%;text-align:center;'>Paraf petugas presensi</td>
                </tr>
                <tr>
                    <td style='width:5%;text-align:center;'>Mulai</td>
                    <td style='width:5%;text-align:center;'>Selesai</td>
                    <td style='width:8%;text-align:center;'>Materi & Waktu Tepat</td>
                    <td style='width:8%;text-align:center;'>Materi tepat & waktu tidak tepat</td>
                    <td style='width:8%;text-align:center;'>Materi tidak tepat & waktu tepat</td>
                </tr>
                <tbody id="beritaacara" style='font-size:10px;'>
                </tbody>
            </table>
        </div>
        <div style='margin-top:50px;font-size:12px;float:right;'>
            <table border='0' rules='all0'>
                <tr>
                    <td>Karanganyar, <span id="tanggalwaktu"></span></td>
                </tr>
                <tr>
                    <td>Kepala Bagian Akademik</td>
                </tr>
                <tr>
                    <td style='height:70px;'>&nbsp;</td>
                </tr>
                <tr>
                    <td>(.......................)</td>
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
        var id_kelas = $('#id_kelas').val();

        $.ajax({
            type: 'POST',
            dataType: "json",
            url: "{{ config('setting.second_url') }}akademik/get-kelas-mk",
            headers: {
                "Authorization": 'Bearer ' + token,
                "username": userlogin
            },
            data: {
                id_kelas: id_kelas
            },
            success: function(result) {
                console.log(result);
                $('.nama_matakuliah').html(result.nama_matakuliah);
                $('.kodemk').html(result.kode_matakuliah + '/' + result.sks_matakuliah + '/' +
                    result.nama_kelas);
                $('.harijamruang').html(result.hari + '/' + result.jam_mulai + '-' + result
                    .jam_selesai + '/' + result.kode_ruang);
                $('.dosen').html(result.dosen);
                $('#nama_fakultas').html('FAKULTAS ' + result.nama_fakultas.toUpperCase());
                get_table();
            }
        });

        function get_table() {
            $.ajax({
                type: 'GET',
                dataType: "json",
                url: "{{ config('setting.second_url') }}akademik/list-ba",
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                data: {
                    id_kelas: id_kelas
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
                            data[i].tgl + '</td><td style="padding-left:5px;">' + data[i]
                            .pertemuan_ke +
                            '</td><td style="padding-left:5px;">' + data[i].materi_makul +
                            '</td><td style="text-align:center;">' + data[i].peserta_hadir +
                            '</td><td style="text-align:center;">' + data[i].jam_mulai +
                            '</td><td style="text-align:center;">' + data[i].jam_selesai +
                            '</td><td style="text-align:center;">' +
                            '</td><td style="padding-left:5px;">' +
                            '</td><td style="padding-left:5px;">' +
                            '</td><td style="padding-left:5px;">' +
                            '</td><td style="padding-left:5px;">' +
                            '</td><td style="padding-left:5px;">' +
                            '</td><td style="padding-left:5px;">' +
                            '</td></tr>';
                    }

                    $('#beritaacara').html(tampil);
                    window.print();
                }
            });

        }


    });
</script>
