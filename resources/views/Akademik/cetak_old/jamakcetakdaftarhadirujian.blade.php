<html>
@php
    $pecah = explode('-', $id_tawar);
@endphp

@php $top=count($pecah); @endphp

<body>
    <input class="form-control" type="hidden" name="id_tawarjamak" id="id_tawarjamak" value="{{ $id_tawar }}">
    <input type="hidden" name="lutane" id="lutane" value="0">
    <input type="hidden" name="topane" id="topane" value="{{ $top }}">
    <input class="form-control" type="hidden" name="patokan" id="patokan" value="{{ $pecah[$top - 1] }}">
    @foreach ($pecah as $row)
        <input class="form-control" type="hidden" name="id_tawar" id="id_tawar{{ $row }}"
            value="{{ $row }}">
        {{-- <input class="form-control" type="text" name="nim" id="nim" value="{{ $nim }}"> --}}
        {{-- <input class="form-control" type="text" name="tahun" id="tahun" value="{{ $tahun }}">
    <input class="form-control" type="text" name="semester" id="semester" value="{{ $semester }}"> --}}
        <div class='row'>
            <div class='col-xs-12'>
                <table border='0' rules='all0' style='width:100%;'>
                    <tr>
                        <td style='padding-right:10px;width:80px;'><img src='{{ url('imageup45/logoumuka.png') }}'
                                style='width:80px;'></td>
                        <td style='font-size:20px;padding-left:5px;font-weight:bold;'>UNIVERSITAS MUHAMMADIYAH
                            KARANGANYAR
                            <div id='nama_fakultas' style='font-size:20px;margin-top:-5px;'></div>
                            <div
                                style='font-size:10px;border-bottom:1px solid black;padding-bottom:3px;margin-top:-3px;'>
                                Jl. Raya Solo-Tawangmangu Km 12, Papahan, Kec. Tasikmadu, Kabupaten Karanganyar, Jawa
                                Tengah 57722</div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div style='font-family:Courier New;height:648px;line-height:10px;'>
            <div style='margin-top:10px;text-align:center;'>
                <span class='nama_matkul_{{ $row }}' style='font-size:18px;'></span>
            </div>

            <div style='margin-top:20px;'>
                <table border='0' rules='all0' width='100%' style='font-size:12px;line-height:10px'>
                    <tr>
                        <td style='width:150px;'>Semester</td>
                        <td style='width:10px;'>:</td>
                        <td colspan='2'><span>{{ Session::get('session_nama_tahunakademik') }}</span></td>
                        <td style='width:8px;'>&nbsp;</td>
                        <td>Hal</td>
                        <td style='width:10px;'>:</td>
                        <td>1</td>
                    </tr>
                    <tr>
                        <td>Program Studi</td>
                        <td>:</td>
                        <td style='width:65px;'><span class="kodeforlab_{{ $row }}"></span></td>
                        <td><span class="namaprodi_{{ $row }}"></span></td>
                        <td style='width:8px;'>&nbsp;</td>
                        <td style='width:120px;'>Jenjang</td>
                        <td>:</td>
                        <td>C-S-1</td>
                    </tr>
                    <tr>
                        <td>Matakuliah</td>
                        <td>:</td>
                        <td><span class="kode_matakuliah_{{ $row }}"></span></td>
                        <td><span class="nama_matakuliah_{{ $row }}"></span></td>
                        <td style='width:8px;'>&nbsp;</td>
                        <td>Kelas</td>
                        <td>:</td>
                        <td><span class="namakelas_{{ $row }}"></span></td>
                    </tr>
                    <tr>
                        <td>Dosen</td>
                        <td>:</td>
                        <td colspan='2'><span class="nama_dosen_{{ $row }}"></span></td>
                        <td style='width:8px;'>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                </table>
            </div>

            <div style='margin-top:5px;'>
                <table border='1' rules='all' width='100%' cellpadding="10"
                    style='font-size:12px;line-height:10px'>
                    <thead>
                        <tr>
                            <td
                                style='height:36px;width:50px;padding-left:5px;padding-top:7px;padding-bottom:7px;text-align:center;'>
                                NO</td>
                            <td style='width:95px;padding-left:5px;text-align:center;'>NIM</td>
                            <td style='padding-left:5px;text-align:center;'>NAMA MAHASISWA</td>
                            <td style='width:60px;padding-left:5px;text-align:center;'>NILAI UTS</td>
                            <td style='width:60px;padding-left:5px;text-align:center;'>NILAI AKHIR</td>
                            <td style='width:130px;padding-left:5px;text-align:center;'>TANDA TANGAN</td>
                        </tr>
                    </thead>
                    <tbody id="daftarhadirujian{{ $row }}">
                    </tbody>

                </table>

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

            var id_tawar = $('#id_tawar{{ $row }}').val();
            // var tahun = $('#tahun').val();
            // var semester = $('#semester').val();

            $.ajax({
                type: 'POST',
                dataType: "json",
                url: "{{ config('setting.second_url') }}akademik/cetak-daftarhadirujianjamak",
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                data: {
                    id_tawar: id_tawar
                    // tahun: tahun,
                    // semester: semester

                },
                success: function(data) {
                    var jml = data.length;

                    var no = 1;
                    var tampil = '';
                    // var totalsks = 0;
                    for (var i = 0; i < jml; i++) {
                        var niluts = "";
                        var niluas = "";
                        if (data[i].nilai_uts != null) {
                            niluts = data[i].nilai_uts;
                        }
                        if (data[i].nilai_akhir_huruf != null) {
                            niluas = data[i].nilai_akhir_huruf;
                        }
                        tampil = tampil +
                            '<tr style="font-size:12px;"><td style="text-align:center;">' +
                            no + '</td><td style="padding-left:5px;">' + data[i].nim +
                            '</td><td style="padding-left:5px;">' + data[i].nama_mahasiswa +
                            '</td><td style="text-align:center;">' + niluts +
                            '</td><td style="text-align:center;">' + niluas +
                            '</td><td>&nbsp;</td></tr>';
                        no++;
                        // totalsks += data[i].sks_matakuliah;
                    }
                    $('#daftarhadirujian{{ $row }}').html(tampil);

                    // $('#totalsks').html(totalsks);
                    console.log(tampil);

                    $.ajax({
                        type: 'POST',
                        dataType: "json",
                        url: "{{ config('setting.second_url') }}akademik/get-daftarhadirujian",
                        headers: {
                            "Authorization": 'Bearer ' + token,
                            "username": userlogin
                        },
                        data: {
                            id_tawar: id_tawar
                        },
                        success: function(result) {
                            console.log(result);
                            // $('.nim_').html(result[0].nim);
                            $('.namaprodi_{{ $row }}').html(result[0]
                                .nama_program_studi);
                            $('.namakelas_{{ $row }}').html(result[0].nama_kelas);
                            $('.semester_{{ $row }}').html(result[0].semester);
                            $('.nama_matakuliah_{{ $row }}').html(result[0]
                                .nama_matakuliah);
                            $('.kode_matakuliah_{{ $row }}').html(result[0]
                                .kode_matakuliah);
                            // $('.nama_dosen_{{ $row }}').html(result[0].nama_dosen);
                            if (result[0].nama_dosen2 == true, result[0].nama_dosen ==
                                false) {
                                $('.nama_dosen_{{ $row }}').html(result[0]
                                    .nama_dosen2);
                            } else if (result[0].nama_dosen == true, result[0]
                                .nama_dosen2 == false) {
                                $('.nama_dosen_{{ $row }}').html(result[0]
                                    .nama_dosen);
                            } else {
                                $('.nama_dosen_{{ $row }}').html(result[0]
                                    .nama_dosen + '/' + result[0].nama_dosen2);
                            }
                            $('.kodeforlab_{{ $row }}').html(result[0]
                                .kode_prodi_forlab);
                            $('.nama_fakultas').html('FAKULTAS ' + result[0].nama_fakultas
                                .toUpperCase());
                            $('.nama_matkul_{{ $row }}').html(
                                '** DAFTAR HADIR UJIAN ' + result[0].nama_matakuliah +
                                ' **');
                            // $forlab = result[0].kode_prodi_forlab;
                            // $forlap1 = substr($forlab, 0, 2);
                            // $forlap2 = substr($forlab, 2, 3);
                            // $('.kodeforlab_').html($forlap1.
                            //     "-".$forlap2);
                            // if ($('#id_tawar{{ $row }}').val() == $('#patokan')
                            //     .val()) {
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
