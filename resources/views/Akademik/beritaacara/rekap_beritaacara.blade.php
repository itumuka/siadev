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
                                <li class="breadcrumb-item" aria-current="page">{{ $parent_breadcrumb }}</li>
                                {{-- <li class="breadcrumb-item active" aria-current="page">{{ $child_breadcrumb }}</li> --}}
                            </ol>
                        </nav>
                    </div>
                </div>

            </div>
        </div>
        <!-- Main content -->
        <section class="content">
            <div class="box no-shadow mb-0">
                <div class="box-body">
                    <div class="box">
                        <div class="box-body ribbon-box bg-primary-light">
                            <div class="ribbon ribbon-info">Informasi</div>
                            <p class="mb-0">Rekap Berita Acara (DHMD) di Semester
                                {{ $session_nama_tahunakademik }}</p>
                        </div> <!-- end box-body-->

                    </div>
                    <div class="table-responsive">
                        <input class="form-control" type="hidden" name="tahun" id="tahun"
                            value="{{ $session_tahun }}">
                        <input class="form-control" type="hidden" name="semester" id="semester"
                            value="{{ $session_semester }}">
                        <table id="tbmakulpenawaran" class="table table-hover table-sm" width="100%">
                            <thead class="bg-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Matakuliah</th>
                                    <th>Nama Dosen</th>
                                    <th>Kelas</th>
                                    <th>Prodi</th>
                                    <th>Total BA</th>
                                    <th>UTS</th>
                                    <th>UAS</th>
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
        var token = "{{ Session::get('token') }}";
        var userlogin = "{{ Session::get('username') }}";

        function cetakdhmd(id_kelas) {
            var link = ""
            $("#printff")
                .attr("src", "{{ url('akademik/cetak/cetakberitaacara') }}/" + id_kelas + "")
                .appendTo("body");
        }

        $(document).ready(function() {
            var token = "{{ Session::get('token') }}";
            var userlogin = "{{ Session::get('username') }}";

            var kd_prodi = $('#kode_prodi').val();

            // var kode_prodi = $('#kode_prodi').val();
            var tahun = $('#tahun').val();
            var semester = $('#semester').val();
            // var tipe = $('#tipe').val();
            var kode_dosen = $('#kode_dosen').val();

            var table = $("#tbmakulpenawaran").DataTable({
                destroy: true,
                dom: 'l<br>Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel'
                ],
                // responsive: true,
                // autoWidth: false,
                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                processing: true,
                lengthChange: true,
                // searching: false,
                // serverSide: true,
                // stateSave: true,
                // scrollX: true,
                // orderable: false,
                ajax: {
                    type: "GET",
                    url: "{{ config('setting.second_url') }}akademik/rekap-ba",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    data: {
                        tahun: tahun,
                        semester: semester,
                        kode_dosen: kode_dosen
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
                        data: 'nama_matakuliah'
                    },
                    {
                        data: 'fullname'
                    },
                    {
                        data: 'nama_kelas',
                        className: "text-center"
                    },
                    {
                        data: 'nama_program_studi'
                    },
                    {
                        data: 'ba_kehadiran',
                        className: "text-center"
                    },
                    {
                        name: "aksi",
                        className: "text-center",
                        orderable: false,
                        render: (data, type, row) => {
                            if (row.uts == 1) {
                                return '<span class="waves-effect waves-light btn btn-xs btn-outline btn-success" title="BA UTS telah terisi"><i class="fa fa-check"></i></span>';
                            } else {
                                return '<span class="waves-effect waves-light btn btn-xs btn-outline btn-danger" title="BA UTS belum terisi"><i class="fa fa-times"></i></span>';
                            }

                        }
                    },
                    {
                        name: "aksi",
                        className: "text-center",
                        orderable: false,
                        render: (data, type, row) => {
                            if (row.uas == 1) {
                                return '<span class="waves-effect waves-light btn btn-xs btn-outline btn-success" title="BA UAS telah terisi"><i class="fa fa-check"></i></span>';
                            } else {
                                return '<span class="waves-effect waves-light btn btn-xs btn-outline btn-danger" title="BA UAS belum terisi"><i class="fa fa-times"></i></span>';
                            }
                        }
                    },

                ],
                order: []
            });


        });
    </script>
@stop
