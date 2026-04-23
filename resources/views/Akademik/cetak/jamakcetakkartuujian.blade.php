<html>
@php
    $pecah = explode('-', $nim);
    
    $taSmt = '';
    if (Session::get('session_semester') == '1') {
        $taSmt = 'GANJIL';
    } else {
        $taSmt = 'GENAP';
    }
    
    if ($jenisujian == '1') {
        $jenisUjian = 'UJIAN TENGAH SEMESTER (UTS)';
    } else {
        $jenisUjian = 'UJIAN AKHIR SEMESTER (UAS)';
    }
    

@endphp

@php $top=count($pecah); @endphp

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
            padding: 5px;
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
        <div>
            <div class="header" id='headersemester{{ $row }}'
                style='font-size:18px;margin-top:5px;font-weight:bold;'></div>
            <div class="header" id='nama_fakultas{{ $row }}'
                style='font-size:18px;margin-top:5px;font-weight:bold;'></div>
            <div class="header" style='margin-top:5px;font-size:18px;font-weight:bold;'>UNIVERSITAS MUHAMMADIYAH
                KARANGANYAR</div>
            <div class="subheader" style='font-size:18px;margin-top:-5px;font-weight:bold;'
                id='headertahun{{ $row }}'></div>

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
                                <td><span class="nama_prodi_{{ $row }}"></span></td>
                            </tr>
                            <tr>
                                <td><strong>Nama</strong></td>
                                <td>:</td>
                                <td><span class="nama_mahasiswa_{{ $row }}"></span></td>
                            </tr>
                            <tr>
                                <td><strong>NPM</strong></td>
                                <td>:</td>
                                <td><span class="nim_{{ $row }}"></span></td>
                            </tr>
                            <tr>
                                <td><strong>Semester</strong></td>
                                <td>:</td>
                                <td><span id="smstrtahun{{ $row }}"></span></td>
                            </tr>
                        </table>
                        <br><br>
                        <table border='0' rules='all1' width='100%' style="font-size: 14px;">
                            <tr>
                                <td style='width:20px;'>&nbsp;</td>
                                <td style='width:180px;'>Karanganyar, <span
                                        id="tanggalwaktu{{ $row }}"></span>
                                </td>
                            </tr>
                            <tr>
                                <td style='width:80px;'></td>
                                <td>Dekan</td>
                            </tr>
                            <tr>
                                <td style='width:80px;'></td>
                                <td><span id="nama_fakultaskecil{{ $row }}"></span></td>
                            </tr>
                            <tr>
                                <td style='height:70px;'>&nbsp;</td>
                                <td style='height:70px;' id="qrdekan{{ $row }}">&nbsp;</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td><span id="dekane{{ $row }}"></span></td>
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
                                <th style='width:60px;'>Hari/Tanggal</th>
                                <th style='width:70px;'>Jam</th>
                                <th style='width:70px;'>Ruang</th>
                                <th style='width:150px;'>Mata Kuliah</th>
                                <th style='width:50px;'>Ttd Pengawas</th>
                            </tr>
                        </thead>
                        <tbody id="kartuujian{{ $row }}">
                            <!-- Rows will be inserted dynamically -->
                        </tbody>
                    </table>
                </div>
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

            function formatTanggal(tanggal) {
                const date = new Date(tanggal);
                if (isNaN(date)) return ''; // Pastikan tanggal valid
                const day = String(date.getDate()).padStart(2, '0'); // Tambahkan nol jika kurang dari 10
                const month = String(date.getMonth() + 1).padStart(2, '0'); // Bulan mulai dari 0
                const year = date.getFullYear();
                return `${day}/${month}/${year}`;
            }
            var nim = $('#nim{{ $row }}').val();
            var tahun = $('#tahun{{ $row }}').val();
            var semester = $('#semester{{ $row }}').val();

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
                            ' ' +
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
                    $('#kartuujian{{ $row }}').html(tampil);

                    $('#totalsks{{ $row }}').html(totalsks);
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
                            $('.nama_mahasiswa_{{ $row }}').html(result[0].nama_mahasiswa);
                            $('.nim_{{ $row }}').html(result[0].nim);
                            $('.semester_{{ $row }}').html(result[0].semester);

                            var jenisUjian = "{{ $jenisUjian }}";
                            var semesterText = "{{ $taSmt }}";
                            var tahunAkademik = tahun;

                            // Mengatur header menggunakan variabel PHP yang sudah diproses
                            $('#headersemester{{ $row }}').html(
                                "KARTU " + jenisUjian + " " + semesterText
                            );


                            $('#headertahun{{ $row }}').html("TAHUN AKADEMIK " + tahun + "/" + (parseInt(tahun) + 1));
                            $('#smstrtahun{{ $row }}').html(semesterText+" TA " + tahun + "/" + (parseInt(tahun) + 1));

                            $('.nama_prodi_{{ $row }}').html(result[0].nama_program_studi);
                            $('.kode_matakuliah_{{ $row }}').html(result[0].kode_matakuliah);
                            $('#foto_{{ $row }}').html(result[0].foto);
                            $('#nama_fakultas{{ $row }}').html('FAKULTAS ' +result[0].nama_fakultas.toUpperCase());
                            $('#nama_fakultaskecil{{ $row }}').html('Fakultas ' +result[0].nama_fakultas);
                            $('#dekane{{ $row }}').html(result[0].dekan);
                            $('#qrdekan{{ $row }}').html(`<img src="{{ url('qrcode/` + result[0].nidn + `.png') }}" alt="Image" width='60' height='60' id="qrImage{{ $row }}"><br> <small><b>valid_id : ` +result[0].valid_id + `</b></small>`);

                            var ambil = $('#lutane').val();
                            var hasil = parseInt(ambil) + 1;
                            $('#lutane').val(hasil);
                            if (hasil == $('#topane').val()) {
                                $('#qrImage{{ $row }}').on('load', function() {
                                    window.print();
                                });
                            }
                        }
                    });
                }
            });


        });
    </script>
@endforeach
