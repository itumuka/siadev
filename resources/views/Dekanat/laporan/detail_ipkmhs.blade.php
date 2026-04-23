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
                                <li class="breadcrumb-item active" aria-current="page">{{ $child_breadcrumb }}</li>
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
                    <h6 class="box-subtitle">Melihat Data IPK Mahasiswa</h6>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <input type="hidden" class="form-control" id="kode_program_studi" name="kode_program_studi"
                            value="{{ $kode_prodi }}">
                        {{-- <input class="form-control" type="text" name="tahun" id="tahun" value="{{ $session_tahun }}">
                        <input class="form-control" type="text" name="semester" id="semester"
                            value="{{ $session_semester }}"> --}}
                        <table id="lapdetipk" class="table table-hover table-sm table-striped text-nowrap" width="100%">
                            <thead class="bg-dark">
                                <tr>
                                    <th>No</th>
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <th>Jumlah SKS</th>
                                    <th>IPK</th>
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


            var kode_program_studi = $('#kode_program_studi').val();
            // var ta = $('#ta').val();
            // var smt = $('#smt').val();
            // var token = $('#token').val();
            var table = $("#lapdetipk").DataTable({
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
                    url: "{{ config('setting.second_url') }}akademik/lap_ipk_Mahasiswa_detail",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    data: {
                        kode_program_studi: kode_program_studi
                    },
                    dataSrc: function(json) {
                        return json.data;
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
                        data: 'nama'
                    },
                    // {
                    //     data: null,
                    //     orderable: false,
                    //     render: function(data, type, full, meta) {
                    //         return full.sks_ambil + ' SKS';
                    //     }
                    // },
                    {
                        data: 'sksjum'
                    },
                    {
                        data: 'ipk'
                    },
                    // {
                    //     data: 'sks_kumulatif'
                    // },

                ],
                order: []
            });


            //save
            $('#form_add').on('submit', function(event) {
                event.preventDefault();
                var form_data = $(this).serialize();
                $.ajax({
                    url: "{{ config('setting.second_url') }}akademik/simpan-tahunajaran",
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
                $('#id_mreg').val(data['id_mreg']);
                $('#etahun').val(data['tahun']);
                $('#esemester').val(data['semester']);
                $('#etahunakademik').val(data['tahun_akademik']);
                $("#" + data.trash).prop("checked", true)
            });

            // edit
            $('#form_edit').on('submit', function(event) {
                event.preventDefault();
                var form_data = $(this).serialize();
                $.ajax({
                    url: "{{ config('setting.second_url') }}akademik/edit-tahunajaran",
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
                            $('#form_edit')[0].reset();
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
                        $('#form_add').on('submit', function(event) {
                            event.preventDefault();
                            var form_data = $(this).serialize();
                            $.ajax({
                                url: "{{ config('setting.second_url') }}akademik/simpan-tahunajaran",
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
                                        showToastr('error', 'Error!', data
                                            .error);
                                        table.ajax.reload();
                                        $("#btsubmit").prop('disabled', false);
                                    } else if (data.success) {
                                        $('#modal_add').modal('hide');
                                        showToastr('success', 'Success!', data
                                            .success);
                                        table.ajax.reload();
                                        $('#form_add')[0].reset();
                                        $("#btsubmit").prop('disabled', false);
                                    }
                                }
                            })
                        });
                    }
                });
            });


            // show data edit
            table.on('click', '#bt_edit', function() {
                $tr = $(this).closest('tr');
                var data = table.row($tr).data();
                $('#modal_edit').modal('show');
                $('#id_mreg').val(data['id_mreg']);
                $('#etahun').val(data['tahun']);
                $('#esemester').val(data['semester']);
                $('#etahunakademik').val(data['tahun_akademik']);
                $("#" + data.trash).prop("checked", true)
            });

            // edit
            $('#form_edit').on('submit', function(event) {
                event.preventDefault();
                var form_data = $(this).serialize();
                $.ajax({
                    url: "{{ config('setting.second_url') }}akademik/edit-tahunajaran",
                    method: "POST",
                    data: form_data,
                    dataType: "json",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    beforeSend: function() {
                        $("#btsubmit").prop('disabled', true);
                    },
                    success: function(data) {
                        if (data.error) {
                            showToastr('error', 'Error!', data
                                .error);
                            table.ajax.reload();
                            $("#btsubmit").prop('disabled', false);
                        } else if (data.success) {
                            $('#modal_edit').modal('hide');
                            showToastr('success', 'Success!', data
                                .success);
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
                            url: "{{ config('setting.second_url') }}akademik/hapus-tahunajaran",
                            type: 'GET',
                            headers: {
                                "Authorization": 'Bearer ' + token,
                                "username": userlogin
                            },
                            data: {
                                id_mreg: id
                            },
                            dataType: 'json',
                            success: function(data) {
                                if (data.gagal) {
                                    showToastr('error',
                                        'Error!', data
                                        .gagal);
                                } else if (data.berhasil) {
                                    showToastr('success',
                                        'Success!', data
                                        .berhasil);
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
                            url: "{{ config('setting.second_url') }}akademik/ubahstatus-tahunajaran",
                            type: 'GET',
                            headers: {
                                "Authorization": 'Bearer ' + token,
                                "username": userlogin
                            },
                            data: {
                                id_mreg: id,
                                send_value: send_value
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
