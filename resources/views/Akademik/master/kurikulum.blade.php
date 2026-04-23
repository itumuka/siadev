@extends('layout')

@section('content')
    <div class="container-full">
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">Kurikulum</h3>
                    <div class="d-inline-block align-items-center">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                                <li class="breadcrumb-item" aria-current="page">Master</li>
                                <li class="breadcrumb-item active" aria-current="page">Kurikulum</li>
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
                    <h6 class="box-subtitle">Melihat Data Kurikulum</h6>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <div class="box">
                        <div class="box-body ribbon-box bg-primary-light">
                            <div class="ribbon ribbon-info">informasi</div>
                            <p class="mb-0">Kurikulum menjadi acuan penambahan data mata kuliah.</p>
                        </div> <!-- end box-body-->
                        <div class="box-header no-border">
                            <div class="row">
                                <div class="col-sm-12 text-right">
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                        data-target="#modal_add"><i class="ti-plus"></i> Tambah</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="kgtkurikulum" class="table table-hover table-striped">
                            <thead class="bg-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Kurikulum</th>
                                    <th>Program Studi</th>
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
                            <h4 class="modal-title">Input Kurikulum</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                        <form id="form_add" method="POST">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Kurikulum</label>
                                    <input class="form-control" type="text" name="tahun_kurikulum"
                                        placeholder="Kurikulum">
                                    <input class="form-control" type="hidden" name="trash" value="0"
                                        placeholder="Kurikulum">
                                </div>
                                <div class="form-group">
                                    <label>Program Studi</label>
                                    <select class="form-control" name="kode_prodi" id="kode_prodi">
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="hidden" name="date" value="<?php echo DATE(NOW()); ?>"
                                        placeholder="Kurikulum">
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
                            <h4 class="modal-title">Edit Kurikulum</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                        <form id="form_edit" method="POST">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Kurikulum</label>
                                    <input class="form-control" type="text" name="etahun_kurikulum" id="etahun_kurikulum"
                                        placeholder="Tahun Kurikulum">
                                    <input class="form-control" type="hidden" name="id_kurikulum" id="id_kurikulum"
                                        placeholder="ID Kurikulum">
                                    <input class="form-control" type="hidden" name="edate" id="edate"
                                        placeholder="ID Kurikulum">
                                    <input class="form-control" type="hidden" name="etrash" id="etrash"
                                        placeholder="ID Kurikulum">
                                </div>
                                <div class="form-group">
                                    <label>Program Studi</label>
                                    <select class="form-control" name="ekode_prodi" id="ekode_prodi">
                                        <option value="">Pilih</option>
                                        <option value=""></option>
                                    </select>
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

        function programstudi() {
            $.ajax({
                type: 'GET',
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                url: "{{ config('setting.second_url') }}akademik/tampilprogramstudi",
                success: function(result) {
                    var jml = result.length;
                    var s = '<option value="">-Pilih Program Studi-</option>';
                    for (i = 0; i < jml; i++) {
                        s = s + '<option value="' + result[i].kode_program_studi + '"> ' + result[i]
                            .nama_program_studi + '</option>';
                    }
                    // console.log(result);
                    $('#kode_prodi').html(s);
                }
            })
        }
        programstudi();



        function ekode_prodi() {
            $.ajax({
                type: 'GET',
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                url: "{{ config('setting.second_url') }}akademik/edittampilprogramstudi",
                success: function(result) {
                    var jml = result.length;
                    var s = '<option value="">-Pilih-</option>';
                    for (i = 0; i < jml; i++) {
                        s = s + '<option value="' + result[i].kode_program_studi + '"> ' + result[i]
                            .nama_program_studi + '</option>';
                    }
                    // console.log(result);
                    $('#ekode_prodi').html(s);
                }
            })
        }
        ekode_prodi();

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
            var table = $("#kgtkurikulum").DataTable({
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
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    // headers: {
                    //     "Authorization": 'Bearer ' + token
                    // },
                    url: "{{ config('setting.second_url') }}akademik/kurikulum",
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
                        data: 'tahun_kurikulum'
                    },
                    {
                        data: 'nama_program_studi'
                    },
                    {
                        data: null,
                        render: function(data, type, full, meta) {
                            if (full.trash == '1') {
                                return '<a href="javascript:void(0)" class="text-info mr-10" id="bt_edit" data-toggle="tooltip" data-original-title="Edit"><i class="ti-marker-alt"></i></a> | <a href="javascript:void(0)" class="text-danger del" data-id="' +
                                    full.id_kurikulum +
                                    '" data-original-title="Delete" data-toggle="tooltip"><i class="ti-trash"></i></a>';
                            } else {
                                return '<a href="javascript:void(0)" class="text-info mr-10" id="bt_edit" data-toggle="tooltip"  data-original-title="Edit"><i class="ti-marker-alt"></i></a> | <a href="javascript:void(0)" class="text-danger del" data-id="' +
                                    full.id_kurikulum +
                                    '" data-original-title="Delete" data-toggle="tooltip"><i class="ti-trash"></i></a>';

                            }
                        }
                    },

                ],
                order: []
            });


            $('#modal_add').on('hidden.bs.modal', function(e) {
                $(".tampilprogramstudi1").val([]).trigger("change");
            });


            $('.eselectprodi1').select2({
                allowClear: true,
                placeholder: '-Select Program Studi-',
                ajax: {
                    dataType: 'json',
                    url: "{{ config('setting.second_url') }}akademik/tampilprogramstudi",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    delay: 100,
                    data: function(params) {
                        return {
                            search: params.term
                        }
                    },
                    processResults: function(data) {
                        var data_array = [];
                        data.data.forEach(function(value, key) {
                            data_array.push({
                                id: value.id,
                                text: value.text
                            })
                        });

                        return {
                            results: data_array
                        }
                    }
                }
            }).on('eselectprodi1:select', function(evt) {
                $(".eselectprodi1 option:selected").val();
            });

            //save
            $('#form_add').on('submit', function(event) {
                event.preventDefault();
                var form_data = $(this).serialize();
                $.ajax({
                    url: "{{ config('setting.second_url') }}akademik/simpan-kurikulum",
                    method: "POST",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    data: form_data,
                    dataType: "json",
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
                $('#id_kurikulum').val(data['id_kurikulum']);
                $('#etahun_kurikulum').val(data['tahun_kurikulum']);
                $('#ekode_prodi').val(data['kode_program_studi']);
                // $("#ekode_prodi").empty().append('<option value="' + data['kode_program_studi'] + '">' +
                //     data[
                //         'nama_program_studi'] + '</option>').val(data['kode_program_studi']).trigger(
                //     'change');
                $('#edate').val(data['date']);
                $('#etrash').val(data['trash']);
                $("#" + data.trash).prop("checked", true)
            });

            // edit
            $('#form_edit').on('submit', function(event) {
                event.preventDefault();
                var form_data = $(this).serialize();
                $.ajax({
                    url: "{{ config('setting.second_url') }}akademik/edit-kurikulum",
                    method: "POST",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    data: form_data,
                    dataType: "json",
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
                            url: "{{ config('setting.second_url') }}akademik/hapus-kurikulum",
                            type: 'GET',
                            headers: {
                                "Authorization": 'Bearer ' + token,
                                "username": userlogin
                            },
                            data: {
                                id_kurikulum: id
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
                            url: "{{ config('setting.second_url') }}akademik/ubahstatus-kurikulum",
                            type: 'GET',
                            headers: {
                                "Authorization": 'Bearer ' + token,
                                "username": userlogin
                            },
                            data: {
                                id_fak: id,
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
