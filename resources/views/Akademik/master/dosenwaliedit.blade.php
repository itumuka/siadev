@extends('layout')

@section('content')
    <div class="container-full">
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">Dosen Wali</h3>
                </div>

            </div>
        </div>
        <!-- Main content -->
        <section class="content">
            <div class="box">
                <div class="box-header with-border">
                    <h6 class="box-subtitle">Melihat Data Dosen Wali</h6>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <div class="box">
                        <div class="box-body ribbon-box bg-primary-light">
                            <div class="ribbon ribbon-info">informasi</div>
                            <p class="mb-0">Silahkan tambahkan mahasiswa pada dosen wali yang bersangkutan untuk
                                melakukan
                                pengaturan dosen wali. Klik tombol <i class="ti-pencil"></i> untuk menambahkan.</p>
                        </div> <!-- end box-body-->
                    </div>
                    <div class="table-responsive">
                        <table id="kgtdosenwali" class="table table-hover table-striped">
                            <thead class="bg-dark">
                                <tr>
                                    <th>No</th>
                                    <th>NIDN</th>
                                    <th>Nama Dosen</th>
                                    <th>Prodi</th>
                                    <th>Proses</th>
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

            // var nim = $('#nim').val();
            // var ta = $('#ta').val();
            // var smt = $('#smt').val();
            // var token = $('#token').val();
            var table = $("#kgtdosenwali").DataTable({
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
                    url: "{{ config('setting.second_url') }}akademik/dosen",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    // data: {
                    //     nim: nim,
                    // },
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
                        data: 'nidn'
                    },
                    {
                        data: null,
                        render: function(data, type, full, meta) {
                            return full.gelar_depan + ' ' + full.nama + ' ' + full.gelar_belakang;
                        }
                    },
                    {
                        data: 'nama_program_studi'
                    },
                    {
                        data: null,
                        render: function(data, type, full, meta) {
                            if (full.trash == '1') {
                                return '<a href="javascript:void(0)" class="text-info mr-10" id="bt_edit" data-toggle="tooltip" data-original-title="Edit" title="Edit Dosen Wali"><i class="ti-marker-alt"></i></a> | <a href="javascript:void(0)" class="text-danger del" data-id="' +
                                    full.id_wali +
                                    '" data-original-title="Delete" data-toggle="tooltip" title="Hapus Dosen Wali"><i class="ti-trash"></i></a> ';
                            } else {
                                return '<a href="javascript:void(0)" class="text-info mr-10" id="bt_edit" data-toggle="tooltip"  data-original-title="Edit" title="Edit Dosen Wali"><i class="ti-marker-alt"></i></a> | <a href="javascript:void(0)" class="text-danger del" data-id="' +
                                    full.id_wali +
                                    '" data-original-title="Delete" data-toggle="tooltip" title="Hapus Dosen Wali"><i class="ti-trash"></i></a>';

                            }
                        }
                    },

                ],
                order: []
            });

        });
    </script>
@stop
