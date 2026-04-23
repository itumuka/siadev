<html>

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .container {
            display: flex;
            flex-direction: row;
            gap: 20px;
        }

        .left-section {
            flex: 3;
            font-size: 14px;
        }

        .right-section {
            flex: 4;
        }

        .header {
            text-align: center;
            font-size: 20px;
            margin-bottom: 10px;
        }

        .subheader {
            text-align: center;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .info {
            line-height: 1.6;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }

        th,
        .isi td {
            border: 1px solid black;
            padding: 2.5px;
        }

        th {
            background-color: #f2f2f2;
        }

        .transparent-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
            background-color: rgba(255, 255, 255, 0);
            /* Transparan */
        }

        .transparent-table td {
            padding: 5px;
            vertical-align: top;
            text-align: left;
            /* Semua kolom rata kiri */
        }

        .transparent-table td:nth-child(2) {
            width: 10px;
            /* Lebar kolom ':' */
            text-align: center;
        }
    </style>
</head>

<body>
    <input class="form-control" type="hidden" name="nim" id="nim" value="{{ $nim }}">
    <input class="form-control" type="hidden" name="tahun" id="tahun" value="{{ $session_tahun }}">
    <input class="form-control" type="hidden" name="semester" id="semester" value="{{ $session_semester }}">

    <div>
        <div class="header" id='headersemester' style='font-size:18px;margin-top:-5px;font-weight:bold;'></div>
        <div class="header" id='nama_fakultas' style='font-size:18px;margin-top:-5px;font-weight:bold;'></div>
        <div class="header" style='margin-top:-5px;font-size:18px;font-weight:bold;'>UNIVERSITAS MUHAMMADIYAH
            KARANGANYAR</div>
        <div class="subheader" style='font-size:18px;margin-top:-5px;font-weight:bold;' id='headertahun'></div>

        <div class="container">
            <!-- Left Section -->
            <div class="left-section">
                <div class="info">
                    <center>
                        <h3></h3>
                    </center>
                    <table class="transparent-table">
                        <tr>
                            <td><strong>Prodi</strong></td>
                            <td>:</td>
                            <td><span class="nama_prodi_"></span></td>
                        </tr>
                        <tr>
                            <td><strong>Nama</strong></td>
                            <td>:</td>
                            <td><span class="nama_mahasiswa_"></span></td>
                        </tr>
                        <tr>
                            <td><strong>NPM</strong></td>
                            <td>:</td>
                            <td><span class="nim_"></span></td>
                        </tr>
                        <tr>
                            <td><strong>Semester</strong></td>
                            <td>:</td>
                            <td><span id="smstrtahun"></span></td>
                        </tr>
                    </table>
                    <br><br>
                    <table border='0' rules='all1' width='100%' style="font-size: 14px;">
                        <tr>
                            <td style='width:20px;'>&nbsp;</td>
                            <td style='width:180px;'>Karanganyar, <span id="tanggalwaktu"></span>
                            </td>
                        </tr>
                        <tr>
                            <td style='width:80px;'></td>
                            <td>Dekan</td>
                        </tr>
                        <tr>
                            <td style='width:80px;'></td>
                            <td><span id="nama_fakultaskecil"></span></td>
                        </tr>
                        <tr>
                            <td style='height:70px;'>&nbsp;</td>
                            <td style='height:70px;'>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><span id="dekane"></span></td>
                        </tr>
                    </table>
                </div>


            </div>

            <!-- Right Section -->
            <div class="right-section">
                <center>
                    <h3>Jadwal Ujian</h3>
                </center>
                <table class="isi">
                    <thead>
                        <tr>
                            <th style='width:20px;'>No</th>
                            <th style='width:80px;'>Hari/Tanggal</th>
                            <th style='width:70px;'>Jam</th>
                            <th style='width:70px;'>Ruang</th>
                            <th style='width:150px;'>Mata Kuliah</th>
                            <th style='width:50px;'>Ttd Pengawas</th>
                        </tr>
                    </thead>
                    <tbody id="kartuujian">
                        <!-- Rows will be inserted dynamically -->
                    </tbody>
                </table>
            </div>
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

        function formatTanggal(tanggal) {
            const date = new Date(tanggal);
            if (isNaN(date)) return ''; // Pastikan tanggal valid
            const day = String(date.getDate()).padStart(2, '0'); // Tambahkan nol jika kurang dari 10
            const month = String(date.getMonth() + 1).padStart(2, '0'); // Bulan mulai dari 0
            const year = date.getFullYear();
            return `${day}/${month}/${year}`;
        }
        var nim = $('#nim').val();
        var tahun = $('#tahun').val();
        var semester = $('#semester').val();

        $.ajax({
            type: 'POST',
            dataType: "json",
            url: "{{ config('setting.second_url') }}akademik/cetak-kartuujian1",
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
                    tampil = tampil +
                        '<tr style="font-size:9px;"><td style="text-align:center;height:45px;">' +
                        no + '</td><td style="padding-left:5px;">' + (data[i].ujian_hari || '') +
                        ', ' +
                        (data[i].ujian_tanggal ? formatTanggal(data[i].ujian_tanggal) : '') +
                        '</td><td style="padding-left:5px;text-align:center;">' + ((data[i]
                                .ujian_jam_mulai ? data[i].ujian_jam_mulai.substring(0, 5) : '') ||
                            '') + '-' +
                        ((data[i].ujian_jam_selesai ? data[i].ujian_jam_selesai.substring(0, 5) :
                            '') || '') +
                        '</td><td style="padding-left:5px;">' + (data[i].ujian_kode_ruang || '') +
                        '</td><td style="padding-left:5px;">' + (data[i].nama_matakuliah || '') +
                        '</td><td style="padding-left:5px;border-bottom:1px solid black;">&nbsp;</td></tr>';
                    no++;
                    totalsks += data[i].sks_matakuliah;
                }
                $('#kartuujian').html(tampil);

                $('#totalsks').html(totalsks);
                console.log(tampil);
                $.ajax({
                    type: 'POST',
                    dataType: "json",
                    url: "{{ config('setting.second_url') }}akademik/get-kartuujian",
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
                        $('.nama_mahasiswa_').html(result[0]
                            .nama_mahasiswa);
                        $('.nim_').html(result[0].nim);
                        $('.semester_').html(result[0].semester);
                        if (result[0].semester == "1") {
                            $('#headersemester').html(
                                "KARTU UJIAN AKHIR SEMESTER (UAS) GANJIL");
                            $('#smstrtahun').html(
                                "Ganjil Tahun Akademik " + tahun + "/" + (parseInt(
                                    tahun) + 1));

                        } else {
                            $('#headersemester').html(
                                    "KARTU UJIAN AKHIR SEMESTER (UAS) GENAP");
                            $('#smstrtahun').html(
                                "Genap Tahun Akademik " + tahun + "/" + (parseInt(
                                    tahun) + 1));
                        }

                        $('#headertahun').html(
                            "TAHUN AKADEMIK " + tahun + "/" + (parseInt(tahun) + 1));

                        $('.nama_prodi_').html(result[0]
                            .nama_program_studi);
                        $('.kode_matakuliah_').html(result[0]
                            .kode_matakuliah);
                        $('#foto_').html(result[0].foto);
                        $('#nama_fakultas').html('FAKULTAS ' +
                            result[0].nama_fakultas.toUpperCase());
                        $('#nama_fakultaskecil').html('Fakultas ' +
                            result[0].nama_fakultas);
                        $('#dekane').html(result[0].dekan);

                        window.print();
                    }
                });
            }
        });




    });
</script>
