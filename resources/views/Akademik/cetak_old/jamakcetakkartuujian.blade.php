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

            <div style='font-family:Courier New;'>
                <div style='margin-top:10px;text-align:center;'>
                    <span style='font-size:20px;'>KARTU UJIAN</span>
                </div>
                <div style='text-align:center;font-size:12px;margin-top:-5px;'>Semester
                    {{ Session::get('session_nama_tahunakademik') }}</div>

                <div style='margin-top:20px;font-size:12px;'>
                    <table border='0' rules='all0' width='100%' style='line-height:14px;'>
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

                <div style='margin-top:5px;font-size:11px;'>
                    <table border='0' rules='all0' width='100%'>
                        <thead>
                            <tr>
                                <td colspan='8' style='border-top:2px solid black;'></td>
                            </tr>
                            <tr>
                                <td style='width:20px;padding-left:5px;padding-top:2px;padding-bottom:2px;'>NO</td>
                                <td style='width:50px;padding-left:5px;'>KodeMK</td>
                                <td style='width:200px;padding-left:5px;text-align:center;'>Matakuliah</td>
                                <td style='width:10px;text-align:center;'>SKS</td>
                                <td style='width:20px;text-align:center;'>Kls</td>
                                <td style='width:200px;padding-left:5px;text-align:center;'>Dosen</td>
                                <td style='width:60px;text-align:center;'>Prf UTS</td>
                                <td style='width:60px;text-align:center;'>Prf UAS</td>
                            </tr>
                        </thead>
                        <tbody id="kartuujian{{ $row }}">
                        </tbody>
                        <tr>
                            <td colspan='8' style='border-top:1px solid black;'></td>
                        </tr>

                        <tr>
                            <td colspan='8' style='border-bottom:1px solid black;'></td>
                        </tr>
                        <tr>
                            <td colspan='3' style='text-align:right;padding-right:4px;'>Jumlah SKS</td>
                            <td style='width:30px;text-align:center;'><span id="totalsks{{ $row }}"></span>
                            </td>
                        </tr>
                    </table>
                </div>

                <div style='margin-top:5px;font-size:12px;'>
                    <table border='0' rules='all1' width='100%'>
                        <tr>
                            <td rowspan='4'>
                                <div style='margin-top:-18px;'>
                                    <table border='1' rules='all'>
                                        <tr>
                                            <td style='width:80px;height:105px; text-align:center;'>2 x 3</td>
                                            <!-- if(empty($foto_mhs)){
                <td style='width:80px;height:105px; text-align:center;'>2 x 3</td>
            }else{
                $foto_mhs = "<img src='../../assets/images/foto_mahasiswa/$foto_mhs' style='width:95px;height:115px;'>
                <td style='width:80px;height:105px; text-align:center;'><span id="foto_"></span></td>
            }  -->

                                        </tr>
                                    </table>
                                </div>
                            </td>
                            <td style='width:20px;'>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td style='width:20px;'>&nbsp;</td>
                            <td style='width:160px;'>Karanganyar, <span id="tanggalwaktu{{ $row }}"></span>
                            </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td style='width:160px;'>Pembimbing Akademik</td>
                            <td>&nbsp;</td>
                            <td>Mahasiswa</td>
                        </tr>
                        <tr>
                            <td style='height:70px;'>&nbsp;</td>
                            <td style='height:70px;'>&nbsp;</td>
                            <td style='height:70px;'>&nbsp;</td>
                            <td style='height:70px;'>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>(......................)</td>
                            <td>&nbsp;</td>
                            <td>(......................)</td>
                        </tr>
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
                        tampil = tampil + '<tr style="font-size:9px;"><td style="text-align:center;">' +
                            no + '</td><td style="padding-left:5px;">' + data[i].kode_matakuliah +
                            '</td><td style="padding-left:5px;">' + data[i].nama_matakuliah +
                            '</td><td style="padding-left:5px;"><center>' + data[i].sks_matakuliah +
                            '</center></td><td style="padding-left:5px;"><center>' + data[i]
                            .nama_kelas +
                            '</center></td><td style="padding-left:5px;"><center>(' + data[i]
                            .nama_dosen + data[i].nama_dosen2 +
                            ')</center></td><td style="padding-left:5px;border-bottom:1px solid black;">&nbsp;</td><td style="padding-left:5px;border-bottom:1px solid black;">&nbsp;</td></tr>';
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
                            $('.nama_mahasiswa_{{ $row }}').html(result[0]
                                .nama_mahasiswa);
                            $('.nim_{{ $row }}').html(result[0].nim);
                            $('.semester_{{ $row }}').html(result[0].semester);
                            $('.nama_prodi_{{ $row }}').html(result[0]
                                .nama_program_studi);
                            $('.kode_matakuliah_{{ $row }}').html(result[0]
                                .kode_matakuliah);
                            $('#foto_{{ $row }}').html(result[0].foto);
                            $('#nama_fakultas{{ $row }}').html('FAKULTAS ' +
                                result[0].nama_fakultas.toUpperCase());
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
