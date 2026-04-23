@extends('layout')

@section('css')
    <style>
        .tdLessPadding {
            td {
                padding: .2em .2em !important;
            }
        }

        .sembunyi {
            display: none;
        }
    </style>
@endsection

@section('content')
    <div class="container-full">
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">{{ $title }}</h3>
                    <div class="d-inline-block align-items-center">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                                <li class="breadcrumb-item" aria-current="page">{{ $parent_breadcrumb }}</li>
                                <li class="breadcrumb-item active" aria-current="page"></li>
                            </ol>
                        </nav>
                    </div>
                </div>

            </div>
        </div>
        <!-- Main content -->
        <section class="content">
            <div class="box box-solid bg-primary sembunyi" id="blm_her">
                <div class="box-header">
                    <h4 class="box-title"><i class="fa fa-exclamation-triangle"></i> Anda Memiliki Tunggakan Pembayaran</h4>
                </div>
                <div class="box-body text-danger">
                    Silahkan lakukan pelunasan Tunggakan Pembayaran terlebih dahulu supaya dapat lihat jadwal ujian dan ambil Kartu Ujian Akhir Semester {{ $session_nama_tahunakademik }} di admin akademik. Terima Kasih
                </div>
            </div>
            <div class="box box-solid bg-primary sembunyi" id="not_yet">
                <div class="box-header">
                    <h4 class="box-title"><i class="fa fa-exclamation-triangle"></i> Jadwal Belum ditentukan</h4>
                </div>
                <div class="box-body text-danger">
                    Anda tidak mencetak Kartu Ujian Tengah Semester {{ $session_nama_tahunakademik }}. Silahkan menunggu
                    sampai batas yang sudah ditentukan oleh fakultas.
                </div>
            </div>
            <div class="box box-solid bg-primary sembunyi" id="not_yetuas">
                <div class="box-header">
                    <h4 class="box-title"><i class="fa fa-exclamation-triangle"></i> Jadwal Belum ditentukan</h4>
                </div>
                <div class="box-body text-danger">
                    Anda tidak mencetak Kartu Ujian Akhir Semester {{ $session_nama_tahunakademik }}. Silahkan menunggu
                    sampai batas yang sudah ditentukan oleh fakultas.
                </div>
            </div>

            <div class="box box-solid bg-danger sembunyi" id="lewat">
                <div class="box-header">
                    <h4 class="box-title"><i class="fa fa-exclamation-triangle"></i>Cetak Kartu Ujian telah berakhir</h4>
                </div>
                <div class="box-body text-danger">
                    Cetak Kartu Ujian {{ $session_nama_tahunakademik }} sudah tidak bisa dilakukan karena sudah melebihi
                    batas akhir tanggal pengisian KRS.
                </div>
            </div>

            <input class="form-control" type="hidden" name="kode_prodi" id="kode_prodi" value="{{ $session_kode_prodi }}">
            <input class="form-control" type="hidden" name="nim" id="nim" value="{{ $session_nim }}">
            <input class="form-control" type="hidden" name="tahun" id="tahun" value="{{ $session_tahun }}">
            <input class="form-control" type="hidden" name="semester" id="semester" value="{{ $session_semester }}">

            <div class="box box-solid bg-primary sembunyi" id="bisa_cetak_uts">
                <div class="box-header">
                    <h4 class="box-title"><i class="fa fa-check-circle-o"></i> Information</h4>
                </div>
                <div class="box-body">
                    <p class="text-muted">Silahkan Cetak Kartu Ujian Tengah Semester pada tombol cetak.</p>
                    <div class="clearfix">
                        <button type="button" class="waves-effect waves-light btn btn-rounded btn-success mb-5"
                            onclick="cetak({{ $session_nim }},{{ $session_tahun }},{{ $session_semester }})"><i
                                class="fa fa-print"></i> Cetak Kartu Ujian</button>

                    </div>
                </div>
            </div>

            <div class="box box-solid bg-primary sembunyi" id="bisa_cetak_uas">
                <div class="box-header">
                    <h4 class="box-title"><i class="fa fa-check-circle-o"></i> Information</h4>
                </div>
                <div class="box-body">
                    <p class="text-muted">Silahkan Cetak Kartu Ujian Akhir Semester pada tombol cetak.</p>
                    <div class="clearfix">
                        <button type="button" class="waves-effect waves-light btn btn-rounded btn-success mb-5"
                            onclick="cetak(`{{ $session_nim }}`,{{ $session_tahun }},{{ $session_semester }})"><i
                                class="fa fa-print"></i> Cetak Kartu Ujian</button>
                    </div>
                </div>
            </div>

            <br>
            <div class="table-responsive sembunyi" id="list_jadwal">
                <table id="tbjadwalmakul" class="table table-hover table-sm">
                    <thead class="bg-dark">
                        <tr>
                            <th>No</th>
                            <th>Hari/Tanggal</th>
                            <th>Jam</th>
                            <th>Ruang</th>
                            <th>Mata Kuliah</th>
                        </tr>
                    </thead>
                    <tbody id="kartuujian">
                    </tbody>
                </table>
            </div>

            <iframe id="printff" name="printff" style="display: none;"></iframe>
        </section>
        <!-- /.content -->
    </div>
@endsection
@section('script-master')
    <script type="text/javascript">
        function cetak(nim, tahun, semester) {
            var link = ""
            $("#printff")

                .attr("src", "{{ url('akademik/cetak/cetakkartuujian') }}/" + nim + "/" + tahun + "/" + semester + "")
                .appendTo("body");

        }


        $(document).ready(function() {
            var token = "{{ Session::get('token') }}";
            var userlogin = "{{ Session::get('username') }}";

            var kode_prodi = $('#kode_prodi').val();
            var nim = $('#nim').val();
            var tahun = $('#tahun').val();
            var semester = $('#semester').val();


            $.ajax({
                url: "{{ config('setting.second_url') }}mahasiswa/kalender-cetak-kartu",
                method: "GET",
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                data: {
                    nim: nim,
                    tahun: tahun,
                    semester: semester
                },
                dataType: 'json',
                success: function(result) {
                    var tglmulai_uts = result.kalendar_uts_tanggal_mulai + " 00:00:00";
                    var tglakhir_uts = result.kalendar_uts_tanggal_akhir + " 23:59:59";
                    var tglmulai_uas = result.kalendar_uas_tanggal_mulai + " 00:00:00";
                    var tglakhir_uas = result.kalendar_uas_tanggal_akhir + " 23:59:59";



                    if (Date.parse(tglmulai_uts) >= Date.now()) {
                        //belum diset
                        $("#not_yet").removeClass("sembunyi");
                    } else {
                        //sudah diset
                        if (Date.parse(tglakhir_uts) <= Date.now()) {
                            //uts lewat
                            if (Date.parse(tglmulai_uas) >= Date.now()) {
                                //belum set tgl uas
                                $("#not_yetuas").removeClass("sembunyi");
                            } else {
                                //sudah set tgl uas
                                if (Date.parse(tglakhir_uas) <= Date.now()) {
                                    $("#lewat").removeClass("sembunyi");
                                } else {
                                    if ((result.her.id_heregistrasi == null) || (result.her
                                            .id_heregistrasi != null &&
                                            result.cekstatusuas == 0 && result
                                            .cekdispenuas == 0 && result.cekbeasiswa == 0)) {
                                        //blm her
                                        $("#blm_her").removeClass("sembunyi");
                                    } else {
                                        //bisa lihat uas
                                        $("#list_jadwal").removeClass("sembunyi");
                                    }
                                }
                            }
                        } else {
                            if ((result.her.id_heregistrasi == null) || (result.her
                                    .id_heregistrasi != null &&
                                    result.cekstatusuts == 0 && result
                                    .cekdispen == 0 && result.cekbeasiswa == 0)) {
                                //blm her
                                $("#blm_her").removeClass("sembunyi");
                            } else {
                                //bisa lihat jadwal
                                $("#list_jadwal").removeClass("sembunyi");
                            }
                        }
                    }

                    // console.log(Date.now());
                    // console.log(Date.parse(tglakhir_uts));
                }
            });

            function formatTanggal(tanggal) {
                const date = new Date(tanggal);
                if (isNaN(date)) return ''; // Pastikan tanggal valid
                const day = String(date.getDate()).padStart(2, '0'); // Tambahkan nol jika kurang dari 10
                const month = String(date.getMonth() + 1).padStart(2, '0'); // Bulan mulai dari 0
                const year = date.getFullYear();
                return `${day}/${month}/${year}`;
            }

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
                            '<tr><td>' +
                            no + '</td><td>' + (data[i].ujian_hari || '') +
                            ', ' +
                            (data[i].ujian_tanggal ? formatTanggal(data[i].ujian_tanggal) : '') +
                            '</td><td>' + ((data[i]
                                    .ujian_jam_mulai ? data[i].ujian_jam_mulai.substring(0, 5) : '') ||
                                '') + '-' +
                            ((data[i].ujian_jam_selesai ? data[i].ujian_jam_selesai.substring(0, 5) :
                                '') || '') +
                            '</td><td>' + (data[i].ujian_kode_ruang || '') +
                            '</td><td>' + (data[i].nama_matakuliah || '') +
                            '</td></tr>';
                        no++;
                        totalsks += data[i].sks_matakuliah;
                    }
                    $('#kartuujian').html(tampil);
                }
            });


        });
    </script>
@stop
