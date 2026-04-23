@extends('layout')

@section('content')
    <div class="container-full">
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">Dosen</h3>
                </div>

            </div>
        </div>
        <!-- Main content -->
        <section class="content">
            <div class="box">
                <div class="box-header with-border">
                    <h6 class="box-subtitle">Melihat Data Dosen</h6>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <div class="box">
                        <div class="box-body ribbon-box bg-primary-light">
                            <div class="ribbon ribbon-info">informasi</div>
                            <p class="mb-0">Untuk merubah dan menambah data dosen silahkan gunakan aplikasi
                                kepegawaian.</p>
                        </div> <!-- end box-body-->
                    </div>
                    <div class="table-responsive">
                        <table id="kgtdosen" class="table table-hover table-striped">
                            <thead class="bg-dark">
                                <tr>
                                    <th>No</th>
                                    <th>NIDN</th>
                                    <th>Nama</th>
                                    <th>Tempat / Tgl Lahir</th>
                                    <th>Alamat</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Agama</th>
                                    <th>Prodi</th>
                                    <th>Dosen Wali</th>
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

            var table = $("#kgtdosen").DataTable({
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
                        data: null,
                        render: function(data, type, full, meta) {
                            return full.tempat_lahir + ' ' + full.tanggal_lahir;
                        }
                    },
                    {
                        data: 'alamat'
                    },
                    {
                        data: 'jenis_kelamin'
                    },
                    {
                        data: 'nama_agama'
                    },
                    {
                        data: 'nama_program_studi'
                    },
                    {
                        data: null,
                        className: "text-center",
                        render: function(data, type, full, meta) {
                            if (full.dosen_wali == '1') {
                                return '<a href="javascript:void(0)" class="text-success nonaktif" data-id="' +
                                    full.id_pegawai +
                                    '" data-original-title="Delete" data-toggle="tooltip" title="Klik untuk merubah status"><i class="ti-info-alt"></i> Ya</a> ';
                            } else {
                                return '<a href="javascript:void(0)" class="text-danger" data-original-title="Delete" data-toggle="tooltip" title="Status Dosen Wali"><i class=" ti-info-alt"></i> Tidak</a>';

                            }
                        }
                    },

                ],
                order: []
            });

            table.on('click', '.nonaktif[data-id]', function(e) {
                e.preventDefault();
                var id = $(this).data('id');

                swal({
                    title: "Apa anda yakin?",
                    text: "Data akan dubah statusnya !",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Ya, ubah !",
                    cancelButtonText: "Tidak, batal !",
                    closeOnCancel: false
                }, function(isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            url: "{{ config('setting.second_url') }}akademik/nonaktif-mhs-dosenwali",
                            type: 'GET',
                            headers: {
                                "Authorization": 'Bearer ' + token,
                                "username": userlogin
                            },
                            data: {
                                id_pegawai: id
                            },
                            dataType: 'json',
                            success: function(data) {
                                if (data.error) {
                                    showToastr('error',
                                        'Error!', data
                                        .error);
                                } else if (data.success) {
                                    showToastr('success',
                                        'Success!', data
                                        .success);
                                    table.ajax.reload();
                                }
                            }
                        })
                    } else {
                        swal("Cancelled", "Data kamu aman! :)",
                            "error");
                    }
                });

            });

        });
    </script>
@stop
