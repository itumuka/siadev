@extends('layout')

@section('css')
    <style>
        th,
        td {
            white-space: nowrap;
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
                                {{-- <li class="breadcrumb-item" aria-current="page">{{ $parent_breadcrumb }}</li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $child_breadcrumb }}</li> --}}
                            </ol>
                        </nav>
                    </div>
                </div>

            </div>
        </div>
        <!-- Main content -->
        <section class="content">
            <div class="box">
                <div class="box-header with-border">
                    <h6 class="box-subtitle">Laporan Dispensasi Mahasiswa</h6>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <div class="box">
                        <div class="box-body ribbon-box bg-primary-light">
                            <div class="ribbon ribbon-info">informasi</div>
                            <p class="mb-0"></p>
                        </div> <!-- end box-body-->

                    </div>
                    <div class="box-header no-border">
                        <div class="row">
                            <div class="col-sm-3">
                                <label for="tahunakademik">Tahun Akademik</label>
                                <div class="form-group">
                                    <select class="form-control" name="tahunakademik" id="tahunakademik">
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <label for="tahunangkatan">Tahun Angkatan</label>
                                <div class="form-group">
                                    <select class="form-control" name="tahunangkatan" id="tahunangkatan">
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <label for="tahunangkatan">Program Studi</label>
                                <div class="form-group">
                                    <select class="form-control" name="programstudi" id="programstudi">
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <label for="tahunangkatan">Jenis Dispensasi</label>
                                <div class="form-group">
                                    <select class="form-control" name="jenisdispensasi" id="jenisdispensasi">
                                        <option value="">Pilih Jenis Dispensasi</option>
                                        <option value="KRS">KRS</option>
                                        <option value="UTS">UTS</option>
                                        <option value="UAS">UAS</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="tbdispensasi" class="table table-hover table-sm text-nowrap" width="100%">
                            <thead class="bg-dark">
                                <tr>
                                    <th>No</th>
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <th>Program Studi</th>
                                    <th>Tahun Angkatan</th>
                                    <th>Tanggal & Waktu Dispensasi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>

                </div>
                <!-- /.box-body -->
            </div>

        </section>
        <!-- /.content -->
    </div>
@endsection
@section('script-master')
    <script type="text/javascript">
        $(document).ready(function() {
            var token = "{{ Session::get('token') }}";
            var userlogin = "{{ Session::get('username') }}";
            tahunakademik();
            tahunangkatan();
            programstudi();

            function tahunakademik() {
                $.ajax({
                    type: 'GET',
                    url: "{{ config('setting.second_url') }}akademik/tampiltahunakademik",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    success: function(result) {
                        var jml = result.length;
                        var s = '<option value="0|0">Pilih Tahun Akademik</option>';
                        for (i = 0; i < jml; i++) {
                            s = s + '<option value="' + result[i].tahun +
                                '|' + result[i].semester +
                                '"> ' + result[i]
                                .tahun + ' | ' + result[i]
                                .semester + '</option>';
                        }
                        // console.log(result);
                        $('#tahunakademik').html(s);
                        var thnn = $('#tahunakademik').val();
                        tbnilai(thnn);
                    }
                })
            }

            $('#tahunakademik').on('change', function(event) {
                var thnn = $('#tahunakademik').val();
                tbnilai(thnn);

            });

            function tahunangkatan() {
                $.ajax({
                    type: 'GET',
                    url: "{{ config('setting.second_url') }}akademik/tampiltahunangkatan",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    success: function(result) {
                        var jml = result.length;
                        var s = '<option value="0|0">Pilih Tahun Angkatan</option>';
                        for (i = 0; i < jml; i++) {
                            s = s + '<option value="' + result[i].tahun_angkatan +
                                '"> ' + result[i]
                                .tahun_angkatan + '</option>';
                        }
                        // console.log(result);
                        $('#tahunangkatan').html(s);
                        var thnn = $('#tahunangkatan').val();
                        tbnilai(thnn);
                    }
                })
            }

            $('#tahunangkatan').on('change', function(event) {
                var thnn = $('#tahunangkatan').val();
                tbnilai(thnn);

            });

            function programstudi() {
                $.ajax({
                    type: 'GET',
                    url: "{{ config('setting.second_url') }}akademik/tampilprogramstudi",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    success: function(result) {
                        var jml = result.length;
                        var s = '<option value="0|0">Pilih Program Studi</option>';
                        for (i = 0; i < jml; i++) {
                            s = s + '<option value="' + result[i].kode_program_studi +
                                '"> ' + result[i]
                                .nama_program_studi + '</option>';
                        }
                        // console.log(result);
                        $('#programstudi').html(s);
                        var thnn = $('#programstudi').val();
                        tbnilai(thnn);
                    }
                })
            }

            $('#programstudi').on('change', function(event) {
                var thnn = $('#programstudi').val();
                tbnilai(thnn);

            });



            // var nim = $('#nim').val();

            function dropdown_akademik() {
                $.ajax({
                    type: "POST",
                    url: "{{ config('setting.second_url') }}akademik/dropdown-akademik",
                    dataType: "json",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    success: function(data) {
                        // $('.test').fadeOut();
                        let target = $(".dropdown-prodi")
                        $.each(data, function(index, value) {
                            var el = data[index];
                            var flag = 0;
                            target.append(
                                '<option class="dropdown-item">' +
                                el
                                .tahun + '' + el
                                .semester + '</option>')
                        });
                    },
                    error: function(error) {
                        alert(error);
                    }
                });
            }
            // dropdown_akademik();

            function tbnilai(thn) {

                var table = $("#tbdispensasi").DataTable({
                    destroy: true,
                    dom: 'l<br>Bfrtip',
                    buttons: [
                        'copy', 'csv', 'excel'
                    ],
                    // responsive: true,
                    // autoWidth: false,
                    // lengthMenu: [
                    //     [10, 25, 50, -1],
                    //     [10, 25, 50, "All"]
                    // ],
                    processing: true,
                    lengthChange: true,
                    // searching: false,
                    // serverSide: true,
                    // stateSave: true,
                    // scrollX: true,
                    // orderable: false,
                    ajax: {
                        type: "GET",
                        url: "{{ config('setting.second_url') }}akademik/dispensasi",
                        headers: {
                            "Authorization": 'Bearer ' + token,
                            "username": userlogin
                        },
                        data: {
                            tahunakademik: thn,
                        },
                        dataSrc: function(json) {
                            return json;
                        }
                    },
                    columns: [{
                            data: null,
                            orderable: false,
                            render: function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }
                        },
                        {
                            data: 'nim',
                            orderable: false
                        },
                        {
                            data: 'nama_mahasiswa',
                            orderable: false
                        },
                        {
                            data: 'nama_program_studi',
                            orderable: false
                        },
                        {
                            data: 'tahun',
                            orderable: false
                        },
                        {
                            data: 'dtime',
                            orderable: false
                        },

                    ],
                    order: []
                });
            }


        });
    </script>
@stop
