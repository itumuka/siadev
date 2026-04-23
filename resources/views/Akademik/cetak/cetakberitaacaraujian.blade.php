<html>

<head>
    <style>
        @page {
            size: A4 portrait;
        }

        @page {
            margin: 10mm 10mm 10mm 10mm;
        }
    </style>
</head>

<body>
    <input class="form-control" type="hidden" name="id_ba_ujian" id="id_ba_ujian" value="{{ $id_ba_ujian }}">

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

    <div style='font-family: Times New Roman;height:948px;'>
        <div style='margin-top:10px;text-align:center;'>
            <span style='font-size:14pt;font-weight: bold;' class="judulba"></span>
        </div>
        {{-- <div style='text-align:center;font-size:11pt;margin-top:-5px;'>
            {{$session_nama_tahunakademik}}
        </div> --}}
        <div style='margin-top:20px;font-size:11pt;'>
            <P style="text-align: justify;text-justify: inter-word;">Pada hari ini <span class="hari"
                    style="font-weight: bold;"></span> tanggal <span class="tglba" style="font-weight: bold;"></span>.
                pukul <span class="jam_mulai" style="font-weight: bold;"></span> telah dilaksanakan <span
                    class="jenis_ujian"></span> <span class="tahun_akademik"></span> secara online jenjang pendidikan
                Sarjana (S1) Fakultas <span class="nama_fakultas"></span> Program Studi <span
                    class="nama_program_studi"></span> untuk Mata
                Kuliah : </P>
            <table border='0' rules='all0' width='100%' style="font-size:11pt;">
                <tr>
                    <td style='width:35%;'>Kode MK/Kelas/SKS</td>
                    <td style='width:5%;'>:</td>
                    <td><span class="kodemk"></span></td>
                </tr>
                <tr>
                    <td style='width:35%;'>Nama Mata Kuliah</td>
                    <td style='width:5%;'>:</td>
                    <td><span class="nama_matakuliah"></span></td>
                </tr>
                <tr>
                    <td>Dosen Penguji</td>
                    <td>:</td>
                    <td><span class="dosen"></span></td>
                </tr>
                <tr>
                    <td>Metode Ujian</td>
                    <td>:</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Waktu Ujian</td>
                    <td>:</td>
                    <td><span class="waktu_ujian"></span> menit</td>
                </tr>
                <tr>
                    <td>Jumlah Peserta dalam presensi</td>
                    <td>:</td>
                    <td><span class="jml_mhs"></span> orang</td>
                </tr>
                <tr>
                    <td>Jumlah Peserta yang mengikuti ujian</td>
                    <td>:</td>
                    <td><span class="jml_hadir"></span> orang</td>
                </tr>

                <tr>
                    <td>No. Mhs Peserta tidak hadir </td>
                    <td>:</td>
                    <td><span class="nim_tidak_hadir"></span></td>
                </tr>

            </table>
        </div>

        <div style='margin-top:50px;font-size:11pt;float:right;'>
            <table border='0' rules='all0'>
                <tr>
                    <td>Karanganyar, <span class="tglttd"></span></td>
                </tr>

                <tr>
                    <td style='height:70px;'>&nbsp;</td>
                </tr>
                <tr>
                    <td>( <span class="pengawas"></span> )</td>
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
        var id_ba_ujian = $('#id_ba_ujian').val();

        $.ajax({
            type: 'POST',
            dataType: "json",
            url: "{{ config('setting.second_url') }}akademik/get-kelas-baujian",
            headers: {
                "Authorization": 'Bearer ' + token,
                "username": userlogin
            },
            data: {
                id: id_ba_ujian
            },
            success: function(result) {
                console.log(result);

                var startTime = new Date("2022-04-01 " + result.jam_mulai);
                var endTime = new Date("2022-04-01 " + result.jam_selesai);
                var difference = endTime.getTime() - startTime.getTime();
                var resultInMinutes = Math.round(difference / 60000);
                var jenisujian = (result.jenis_ujian == 'uts') ? 'Ujian Tengah Semester' :
                    'Ujian Akhir Semester';
                var judulba = (result.jenis_ujian == 'uts') ? 'BERITA ACARA UJIAN TENGAH SEMESTER' :
                    'BERITA ACARA UJIAN AKHIR SEMESTER';
                var nimtidakhadir = (result.nim_tidak_hadir == '' || result.nim_tidak_hadir ==
                        null || result.nim_tidak_hadir == 0) ? '' : result.nim_tidak_hadir
                    .replaceAll('#', ',');


                $('.nama_matakuliah').html(result.nama_matakuliah);
                $('.hari').html(result.hari);
                $('.kodemk').html(result.kode_matakuliah + '/' + result.nama_kelas + '/' + result
                    .sks_matakuliah);
                $('.harijamruang').html(result.hari + '/' + result.jam_mulai + '-' + result
                    .jam_selesai + '/' + result.kode_ruang);
                $('.jam_mulai').html(result.jam_mulai + ' WIB');
                $('.tglttd').html(result.tglindo);
                $('.tglba').html(result.tglindo);
                $('.judulba').html(judulba);
                $('.jenis_ujian').html(jenisujian);
                $('.waktu_ujian').html(resultInMinutes);
                $('.jml_mhs').html(result.jml_mhs);
                $('.jml_hadir').html(result.jml_hadir);
                $('.nim_tidak_hadir').html(nimtidakhadir);
                $('.dosen').html(result.dosen);
                $('.pengawas').html(result.dosen);
                $('.nama_fakultas').html(result.nama_fakultas);
                $('.nama_program_studi').html(result.nama_program_studi);
                $('.tahun_akademik').html(result.tahun_akademik);

                window.print();
            }
        });
    });
</script>
