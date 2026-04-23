@extends('layout')

@section('content')
    <div class="container-full">
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">User</h3>
                    <div class="d-inline-block align-items-center">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                                <li class="breadcrumb-item" aria-current="page">Master</li>
                                <li class="breadcrumb-item active" aria-current="page">User</li>
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
                    <h6 class="box-subtitle">Melihat Data User</h6>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <div class="box">
                        <div class="box-body ribbon-box bg_primary-light">
                            <div class="ribbon ribbon-info">informasi</div>
                            <p class="mb-0"></p>
                        </div> <!-- end box-body-->
                    </div>
                    <div class="table-responsive">
                        <div class="text-right">
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                data-target="#modal_add"><i class="ti-plus"></i> Tambah</button>
                        </div>
                        <table id="kgtuser" class="table table-hover table-striped">
                            <thead class="bg_primary">
                                <tr>
                                    <th>No</th>
                                    <th>Group</th>
                                    <th>Username</th>
                                    <th>Nama</th>
                                    <th>Jabatan</th>
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

            {{-- modal add --}}
            <div class="modal fade" id="modal_add">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Input User Baru</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                        <form id="form_add" method="POST">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input class="form-control" type="text" name="username" placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="form-control" type="password" name="password" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input class="form-control" type="text" name="nama" placeholder="Nama">
                                </div>
                                <div class="form-group">
                                    <label>Fakultas</label>
                                    <select class="form-control" name="nama_fakultas" id="nama_fakultas">
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Group User</label>
                                    <select class="form-control" name="kode_group" id="kode_group">
                                    </select>
                                    <input class="form-control" type="text" name="nm_module" placeholder="nm_module">
                                </div>
                            </div>
                            <div class="modal-footer float-right">
                                <button type="button" class="btn btn-rounded btn-warning btn-outline mr-1"
                                    data-dismiss="modal">
                                    <i class="fa fa-times"></i> Close
                                </button>
                                <button type="submit" class="btn btn-rounded btn-primary btn-outline" id="btsubmit">
                                    <i class="ti-save-alt"></i> Save
                                </button>
                            </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

            {{-- modal edit --}}

            <div class="modal fade" id="modal_edit">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Data User</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                        <form id="form_edit" method="POST">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Kode Group</label>
                                    <input class="form-control" readonly type="text" name="ekode_group1"
                                        id="ekode_group1" placeholder="Kode Group">
                                    <input class="form-control" type="hidden" name="id_user" id="id_user"
                                        placeholder="ID Group">
                                </div>
                                <div class="form-group">
                                    <label>Nama Group</label>
                                    <input class="form-control" type="text" name="enm_module" id="enm_module"
                                        placeholder="Nama Group" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Username</label>
                                    <input class="form-control" type="text" name="eusername" id="eusername"
                                        placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input class="form-control" type="text" name="enama" id="enama"
                                        placeholder="Nama">
                                </div>
                                <div class="form-group">
                                    <label>Fakultas</label>
                                    <select class="form-control" name="efakultas" id="efakultas">
                                        <option value="">Pilih</option>
                                        <option value=""></option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Jabatan</label>
                                    <input class="form-control" type="text" name="ejabatan" id="ejabatan"
                                        placeholder="Jabatan">
                                </div>
                            </div>
                            <div class="modal-footer float-right">
                                <button type="button" class="btn btn-rounded btn-warning btn-outline mr-1"
                                    data-dismiss="modal">
                                    <i class="fa fa-times"></i> Close
                                </button>
                                <button type="submit" class="btn btn-rounded btn-primary btn-outline" id="btsubmit">
                                    <i class="ti-save-alt"></i> Save
                                </button>
                            </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection
@section('script-master')
    <script type="text/javascript">
        var token = "{{ Session::get('token') }}";
        var userlogin = "{{ Session::get('username') }}";

        function fakultas() {
            $.ajax({
                type: 'GET',
                url: "{{ config('setting.second_url') }}akademik/tampilfakultas",
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                success: function(result) {
                    var jml = result.length;
                    var s = '<option value="">-Pilih Fakultas-</option>';
                    for (i = 0; i < jml; i++) {
                        s = s + '<option value="' + result[i].id + '"> ' + result[i].nama + '</option>';
                    }
                    // console.log(result);
                    $('#fakultas').html(s);
                }
            })
        }
        fakultas();

        function editfakultas() {
            $.ajax({
                type: 'GET',
                url: "{{ config('setting.second_url') }}akademik/edittampilfakultas",
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                success: function(result) {
                    var jml = result.length;
                    var s = '<option value="' + result[i].id_fak + '">' + result[i].nama_fakultas + '</option>';
                    for (i = 0; i < jml; i++) {
                        s = s + '<option value="' + result[i].id_fak + '"> ' + result[i].nama_fakultas +
                            '</option>';
                    }
                    // console.log(result);
                    $('#efakultas').html(s);
                }
            })
        }
        editfakultas();

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
            var table = $("#kgtuser").DataTable({
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
                searching: false,
                // serverSide: true,
                // stateSave: true,
                // scrollX: true,
                // orderable: false,
                ajax: {
                    type: "GET",
                    url: "{{ config('setting.second_url') }}akademik/user",
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
                        data: 'nama_m'
                    },
                    {
                        data: 'username'
                    },
                    {
                        data: 'nama'
                    },
                    {
                        data: 'jabatan'
                    },
                    {
                        data: null,
                        render: function(data, type, full, meta) {
                            if (full.trash == '1') {
                                return '<a href="javascript:void(0)" class="text-info mr-10" id="bt_edit" data-toggle="tooltip" data-original-title="Edit"><i class="ti-marker-alt"></i></a> | <a href="javascript:void(0)" class="text-danger del" data-id="' +
                                    full.id_user +
                                    '" data-original-title="Delete" data-toggle="tooltip"><i class="ti-trash"></i></a> | <a href="javascript:void(0)" class="text-success mr-10 nonaktif" data-id="' +
                                    full.id_user +
                                    '" data-nilai="0" data-toggle="tooltip" data-original-title="Nonaktifkan" ><i class="ti-power-off"></i></a>';
                            } else {
                                return '<a href="javascript:void(0)" class="text-info mr-10" id="bt_edit" data-toggle="tooltip"  data-original-title="Edit"><i class="ti-marker-alt"></i></a> | <a href="javascript:void(0)" class="text-danger del" data-id="' +
                                    full.id_user +
                                    '" data-original-title="Delete" data-toggle="tooltip"><i class="ti-trash"></i></a> | <a href="javascript:void(0)" class="text-danger mr-10 aktif" data-id="' +
                                    full.id_user +
                                    '" data-nilai="1" data-toggle="tooltip" data-original-title="Aktifkan"><i class="ti-power-off"></i></a>';

                            }
                        }
                    },

                ],
                order: []
            });


            //save
            $('#form_add').on('submit', function(event) {
                event.preventDefault();
                var form_data = $(this).serialize();
                $.ajax({
                    url: "{{ config('setting.second_url') }}akademik/simpan-fakultas",
                    method: "POST",
                    data: form_data,
                    dataType: "json",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    beforeSend: function() {
                        $("#btsubmit").prop('disabled', true);
                    },
                    success: function(data) {
                        if (data.error) {
                            showToastr('error', 'Error!', data.error);
                            table.ajax.reload();
                            $("#btsubmit").prop('disabled', false);
                        } else if (data.success) {
                            $('#modal_add').modal('hide');
                            showToastr('success', 'Success!', data.success);
                            table.ajax.reload();
                            $('#form_add')[0].reset();
                            $("#btsubmit").prop('disabled', false);
                        }
                    }
                })
            });


            // show data edit
            table.on('click', '#bt_edit', function() {
                $tr = $(this).closest('tr');
                var data = table.row($tr).data();
                $('#modal_edit').modal('show');
                $('#id_user').val(data['id_user']);
                $('#enm_module').val(data['nama_m']);
                $('#ekode_group1').val(data['id_group']);
                $('#enama').val(data['nama']);
                $('#eusername').val(data['username']);
                $('#ejabatan').val(data['jabatan']);
                $('#efakultas').val(data['nama_fakultas']);
            });

            // edit
            $('#form_edit').on('submit', function(event) {
                event.preventDefault();
                var form_data = $(this).serialize();
                $.ajax({
                    url: "{{ config('setting.second_url') }}akademik/edit-user",
                    method: "POST",
                    data: form_data,
                    dataType: "json",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    beforeSend: function() {
                        $("#btsubmit").prop('disabled', true);
                    },
                    success: function(data) {
                        if (data.error) {
                            showToastr('error', 'Error!', data.error);
                            table.ajax.reload();
                            $("#btsubmit").prop('disabled', false);
                        } else if (data.success) {
                            $('#modal_edit').modal('hide');
                            showToastr('success', 'Success!', data.success);
                            table.ajax.reload();
                            $('#form_add')[0].reset();
                            $("#btsubmit").prop('disabled', false);
                        }
                    }
                })
            });

            // hapus
            table.on('click', '.del[data-id]', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                swal({
                    title: "Apa anda yakin?",
                    text: "Kamu tidak akan bisa mengembalikan data!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Ya, hapus !",
                    cancelButtonText: "Tidak, batal !",
                    closeOnCancel: false
                }, function(isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            url: "{{ config('setting.second_url') }}akademik/hapus-user",
                            type: 'GET',
                            headers: {
                                "Authorization": 'Bearer ' + token,
                                "username": userlogin
                            },
                            data: {
                                id_user: id
                            },
                            dataType: 'json',
                            success: function(data) {
                                if (data.gagal) {
                                    showToastr('error', 'Error!', data.gagal);
                                } else if (data.berhasil) {
                                    showToastr('success', 'Success!', data.berhasil);
                                    table.ajax.reload();
                                }
                            }
                        })
                    } else {
                        swal("Cancelled", "Data kamu aman! :)", "error");
                    }
                });
            });


            table.on('click', '.aktif[data-id], .nonaktif[data-id]', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                var send_value = $(this).data('nilai');

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
                            url: "{{ config('setting.second_url') }}akademik/ubahstatus-user",
                            type: 'GET',
                            headers: {
                                "Authorization": 'Bearer ' + token,
                                "username": userlogin
                            },
                            data: {
                                id_user: id,
                                send_value: send_value
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
                    } else {
                        swal("Cancelled", "Data kamu aman! :)", "error");
                    }
                });

            });

        });
    </script>
@stop
