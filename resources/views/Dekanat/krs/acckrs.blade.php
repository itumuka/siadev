@extends('layout')

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
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">ACC Kartu Rencana Studi Semester {{ $session_nama_tahunakademik }}</h3>
                    {{-- <h6 class="box-subtitle">Melihat Data KHS</h6> --}}
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <input class="form-control" type="hidden" name="kode_fakultas" id="kode_fakultas"
                        value="{{ $session_kode_fakultas }}">
                    <input class="form-control" type="hidden" name="tahun" id="tahun" value="{{ $session_tahun }}">
                    <input class="form-control" type="hidden" name="semester" id="semester"
                        value="{{ $session_semester }}">
                    <div class="table-responsive">
                        <table id="tbacckrs" class="table table-hover table-sm" width="100%">
                            <thead class="bg-dark">
                                <tr>
                                    <th>No</th>
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <th>Prodi</th>
                                    <th>IPK</th>
                                    <th>Batas SKS</th>
                                    <th>SKS Ambil</th>
                                    <th>SKS Bayar</th>
                                    <th>Cetak KRS</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.box-body -->
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

                .attr("src", "{{ url('akademik/cetak/cetakkrs') }}/" + nim + "/" + tahun + "/" + semester + "")
                .appendTo("body");
        }

        $(document).ready(function() {
            var token = "{{ Session::get('token') }}";
            var userlogin = "{{ Session::get('username') }}";

            // $(".tst3").on("click", function () {
            //     // $.toast({
            //     //     heading: 'Welcome to my EduAdmin',
            //     //     text: 'Use the predefined ones, or specify a custom position object.',
            //     //     position: 'top-right',
            //     //     loaderBg: '#ff6849',
            //     //     icon: 'success',
            //     //     hideAfter: 3500,
            //     //     stack: 6
            //     // });
            //     showToastr('error', 'Success!', 'Data telah disimpan');
            // });
            var kode_fakultas = $('#kode_fakultas').val();
            var tahun = $('#tahun').val();
            var semester = $('#semester').val();

            // var token = $('#token').val();
            var table = $("#tbacckrs").DataTable({
                destroy: true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel'
                ],
                // responsive: true,
                // autoWidth: false,
                pageLength: 10,
                processing: true,
                lengthChange: true,
                // searching: false,
                // serverSide: true,
                // stateSave: true,
                // scrollX: true,
                // orderable: false,
                ajax: {
                    type: "GET",
                    url: "{{ config('setting.second_url') }}dekanat/data-acckrs",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    data: {
                        tahun: tahun,
                        kode_fakultas: kode_fakultas,
                        semester: semester
                    },
                    dataSrc: function(json) {
                        return json;
                    }
                },
                columns: [{
                        data: null,
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
                        data: 'nama_program_studi'
                    },
                    {
                        data: 'ip_kumulatif',
                        className: 'text-center',
                    },
                    {
                        data: 'batas_sks',
                        className: 'text-center',
                    },
                    {
                        data: 'sks_ambil',
                        className: 'text-center',
                    },
                    {
                        data: 'sks_bayar',
                        className: 'text-center',
                    },
                    {
                        data: null,
                        className: 'text-center',
                        render: function(data, type, full, meta) {
                            return '<a href="javascript:void(0)" class="text-info mr-10" id="cetak_krs" data-toggle="tooltip" data-original-title="Edit" title="Cetak KRS" onclick="cetak(' +
                                full.nim + ',' + full.tahun + ',' + full.semester +
                                ');"><i class="fa fa-print"></i></a>';
                        }
                    },
                    {
                        data: 'krs',
                        className: 'text-center',
                        render: function(data, type, full, meta) {
                            if (data == 1) {
                                return '<button class="btn btn-xs btn-danger cancelacc" data-id="' +
                                    full.id_heregistrasi +
                                    '" data-nilai="0" data-toggle="tooltip"  data-original-title="Edit" title="Batal Acc KRS"><i class="fa fa-times-circle"></i></button>'
                            } else {
                                return '<button class="btn btn-xs btn-success acc" data-id="' +
                                    full.id_heregistrasi +
                                    '" data-nilai="1" data-toggle="tooltip"  data-original-title="Edit" title="Acc KRS"><i class="fa fa-check-square"></i></button>'
                            }
                        }
                    },

                ],
                order: []
            });



            table.on('click', '.acc[data-id], .cancelacc[data-id]', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                var send_value = $(this).data('nilai');

                $.ajax({
                    url: "{{ config('setting.second_url') }}dekanat/ubahstatus-acckrs",
                    type: 'GET',
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    data: {
                        id_her: id,
                        value: send_value
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.error) {
                            showToastr('error', 'Error!', data.error);
                        } else if (data.success) {
                            showToastr('success', 'Success!', data.success);
                            table.ajax.reload();
                        }
                    }
                })
            });
        });
    </script>
@stop
