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
                    <h3 class="page-title"> Transkrip Nilai Mahasiswa</h3>
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
                    {{-- <h3 class="box-title">Tahun Ajaran</h3> --}}
                    <h6 class="box-subtitle">Melihat Nilai Transkip Mahasiswa</h6>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <div class="box">
                        <div class="box-body ribbon-box bg-primary-light">
                            <div class="ribbon ribbon-info">informasi</div>
                            <p class="mb-0">Pilih sesuai tahun angkatan yang diinginkan
                            </p>
                            <div class="text-right">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <select class="form-control" name="tahunangkatan" id="tahunangkatan">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- end box-body-->

                    </div>
                    <div class="col-sm-12">
                        <div class="bb-1 clearFix">
                            <div class="text-right pb-15">
                                <button id="print2" class="btn btn-primary" type="button"> <span><i
                                            class="fa fa-print"></i> Print</span> </button>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <input class="form-control" type="hidden" name="tahun" id="tahun"
                            value="{{ $session_tahun }}">
                        <input class="form-control" type="hidden" name="semester" id="semester"
                            value="{{ $session_semester }}">
                        <input class="form-control" type="hidden" name="kode_fakultas" id="kode_fakultas"
                            value="{{ $session_kode_fakultas }}">
                        <table id="tbnilaimahasiswa" class="table table-hover table-sm text-nowrap">
                            <thead class="bg-dark">
                                <tr>
                                    <th>No</th>
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Prodi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
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
            tahunangkatan();

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
                        var s = '';
                        for (i = 0; i < jml; i++) {
                            s = s + '<option value="' + result[i].tahun_angkatan + '"> ' + result[i]
                                .tahun_angkatan +
                                '</option>';
                        }
                        // console.log(result);
                        $('#tahunangkatan').html(s);
                        // var thnn = $('#tahunangkatan').val();
                        // tbnilai(thnn);
                    }
                })
            }

            $('#tahunangkatan').on('change', function(event) {
                var thnn = $('#tahunangkatan').val();
                var kd_fak = $('#kode_fakultas').val();
                tbnilai(thnn, kd_fak);

            });


            function tbnilai(thn, kd_fak) {

                var table = $("#tbnilaimahasiswa").DataTable({
                    destroy: true,
                    // dom: 'Bfrtip',
                    // buttons: [
                    //     'copy', 'csv', 'excel'
                    // ],
                    // responsive: true,
                    // autoWidth: false,
                    pageLength: 10,
                    processing: true,
                    lengthChange: true,
                    // searching: false,
                    serverSide: true,
                    // stateSave: true,
                    // scrollX: true,
                    // orderable: false,
                    // scrollX: true,
                    // scrollY: true,
                    // order: [[ 1, 'asc' ]],
                    // fixedColumns: {
                    //   leftColumns: 2
                    // },
                    ajax: {
                        type: "GET",
                        url: "{{ config('setting.second_url') }}dekanat/data-transkripnilai",
                        headers: {
                            "Authorization": 'Bearer ' + token,
                            "username": userlogin
                        },
                        data: {
                            tahun: thn,
                            kode_fakultas: kd_fak
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
                            data: 'nim'

                        },
                        {
                            data: 'nama_mahasiswa'
                        },
                        {
                            data: 'nama_program_pendidikan'
                        },
                        {
                            data: 'nama_program_studi'
                        }

                    ],
                    order: []
                });
            }


        });
    </script>
@stop
