@extends('layout')

@section('content')
    <div class="container-full">
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">Data Kelulusan Mahasiswa</h3>
                </div>

            </div>
        </div>
        <!-- Main content -->
        <section class="content">
            <div class="box">
                <div class="box-header with-border">
                    <h6 class="box-subtitle">Form Kelulusan Mahasiswa</h6>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <div class="box">
                        <div class="box-body ribbon-box bg-primary-light">
                            <div class="ribbon ribbon-info">informasi</div>
                            <p class="mb-0">Luluskan mahasiswa dengan cara klik tombol lulus pada kolom proses di
                                bagian mahasiswa aktif.</p>
                        </div> <!-- end box-body-->
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="table-responsive">
                                <table id="kgtmahasiswalulusan" class="table table-hover table-striped">
                                    <thead class="bg-dark">
                                        <tr>
                                            <th>No</th>
                                            <th>NIM</th>
                                            <th>Nama Lengkap</th>
                                            <th>Program Studi</th>
                                            <th>Proses</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="table-responsive">
                                <table id="kgtmahasiswalulusan2" class="table table-hover table-striped">
                                    <thead class="bg-dark">
                                        <tr>
                                            <th>No</th>
                                            <th>NIM</th>
                                            <th>Nama Lengkap</th>
                                            <th>Program Studi</th>
                                            <th>Status</th>
                                            <th>Proses</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>

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
            var table = $("#kgtmahasiswalulusan").DataTable({
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
                    url: "{{ config('setting.second_url') }}akademik/mahasiswalulusan1",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    // data: {
                    //     tahunangkatan: thn,
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
                        data: 'nim'
                    },
                    {
                        data: 'nama_mahasiswa'
                    },
                    {
                        data: 'nama_program_studi'
                    },
                    {
                        data: null,
                        render: function(data, type, full, meta) {
                            return '<a href="javascript:void(0)" class="text-primary status1" data-id="' +
                                full.id_mhs +
                                '" data-original-title="Update" data-toggle="tooltip">Lulus <i class="ti-edit"></i></a> | <a href="javascript:void(0)" class="text-warning status4" data-id="' +
                                full.id_mhs +
                                '" data-original-title="Update" data-toggle="tooltip">Mengundurkan Diri <i class="ti-edit"></i></a> | <a href="javascript:void(0)" class="text-danger status5" data-id="' +
                                full.id_mhs +
                                '" data-original-title="Update" data-toggle="tooltip">Dikeluarkan <i class="ti-edit"></i></a>';
                        }
                    },

                ],
                order: []
            });


            table.on('click', '.status1[data-id]', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                swal({
                    title: "Mahasiswa Di Luluskan",
                    text: "Apa anda yakin?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Ya, Luluskan !",
                    cancelButtonText: "Tidak !",
                    closeOnCancel: false
                }, function(isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            url: "{{ config('setting.second_url') }}akademik/status_lulus_mahasiswa",
                            type: 'GET',
                            headers: {
                                "Authorization": 'Bearer ' + token,
                                "username": userlogin
                            },
                            data: {
                                id_mhs: id
                            },
                            dataType: 'json',
                            success: function(data) {
                                if (data.gagal) {
                                    showToastr('error', 'Error!', data.gagal);
                                } else if (data.berhasil) {
                                    showToastr('success', 'Success!', data.berhasil);
                                    table.ajax.reload();
                                    table1.ajax.reload();
                                }
                            }
                        })
                    } else {
                        swal("Cancelled", "Data kamu aman! :)", "error");
                    }
                });
            });

            table.on('click', '.status4[data-id]', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                swal({
                    title: "Mahasiswa Mengundurkan Diri",
                    text: "Apa anda yakin?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Ya !",
                    cancelButtonText: "Tidak !",
                    closeOnCancel: false
                }, function(isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            url: "{{ config('setting.second_url') }}akademik/status_mengundurkan_diri_mahasiswa",
                            type: 'GET',
                            headers: {
                                "Authorization": 'Bearer ' + token,
                                "username": userlogin
                            },
                            data: {
                                id_mhs: id
                            },
                            dataType: 'json',
                            success: function(data) {
                                if (data.gagal) {
                                    showToastr('error', 'Error!', data.gagal);
                                } else if (data.berhasil) {
                                    showToastr('success', 'Success!', data.berhasil);
                                    table.ajax.reload();
                                    table1.ajax.reload();
                                }
                            }
                        })
                    } else {
                        swal("Cancelled", "Data kamu aman! :)", "error");
                    }
                });
            });

            table.on('click', '.status5[data-id]', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                swal({
                    title: "Mahasiswa Dikeluarkan",
                    text: "Apa anda yakin?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Ya !",
                    cancelButtonText: "Tidak !",
                    closeOnCancel: false
                }, function(isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            url: "{{ config('setting.second_url') }}akademik/status_dikeluarkan_mahasiswa",
                            type: 'GET',
                            headers: {
                                "Authorization": 'Bearer ' + token,
                                "username": userlogin
                            },
                            data: {
                                id_mhs: id
                            },
                            dataType: 'json',
                            success: function(data) {
                                if (data.gagal) {
                                    showToastr('error', 'Error!', data.gagal);
                                } else if (data.berhasil) {
                                    showToastr('success', 'Success!', data.berhasil);
                                    table.ajax.reload();
                                    table1.ajax.reload();
                                }
                            }
                        })
                    } else {
                        swal("Cancelled", "Data kamu aman! :)", "error");
                    }
                });
            });

            var table1 = $("#kgtmahasiswalulusan2").DataTable({
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
                    url: "{{ config('setting.second_url') }}akademik/mahasiswalulusan2",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    // data: {
                    //     tahunangkatan: thn,
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
                        data: 'nim'
                    },
                    {
                        data: 'nama_mahasiswa'
                    },
                    {
                        data: 'nama_program_studi'
                    },
                    {
                        data: null,
                        render: function(data, type, full, meta) {
                            if (full.lulus == "1") {
                                return '<span class="text-success">Lulus</span>';
                            } else if (full.lulus == "2") {
                                return '<span class="text-warning">Mengundurkan Diri</span>';
                            } else if (full.lulus == "3") {
                                return '<span class="text-danger">Dikeluarkan</span>';
                            }
                        }
                    },
                    {
                        data: null,
                        render: function(data, type, full, meta) {
                            return '<a href="javascript:void(0)" class="text-danger status2" data-id="' +
                                full.id_mhs +
                                '" data-original-title="Update" data-toggle="tooltip">Batal <i class="ti-edit"></i></a>';
                        }
                    },

                ],
                order: []
            });

            table1.on('click', '.status2[data-id]', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                swal({
                    title: "Status Mahasiswa Dibatalkan",
                    text: "Apa anda yakin?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Ya, Batalkan !",
                    cancelButtonText: "Tidak !",
                    closeOnCancel: false
                }, function(isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            url: "{{ config('setting.second_url') }}akademik/status_batal_mahasiswa",
                            type: 'GET',
                            headers: {
                                "Authorization": 'Bearer ' + token,
                                "username": userlogin
                            },
                            data: {
                                id_mhs: id
                            },
                            dataType: 'json',
                            success: function(data) {
                                if (data.gagal) {
                                    showToastr('error', 'Error!', data.gagal);
                                } else if (data.berhasil) {
                                    showToastr('success', 'Success!', data.berhasil);
                                    table.ajax.reload();
                                    table1.ajax.reload();
                                }
                            }
                        })
                    } else {
                        swal("Cancelled", "Data kamu aman! :)", "error");
                    }
                });
            });

        });
    </script>
@stop
