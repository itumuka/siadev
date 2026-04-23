@extends('layout')

@section('content')
    <div class="container-full">
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">Fakultas</h3>
                    <div class="d-inline-block align-items-center">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                                <li class="breadcrumb-item" aria-current="page">Master</li>
                                <li class="breadcrumb-item active" aria-current="page">Fakultas</li>
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
                    <h6 class="box-subtitle">Melihat Data Fakultas</h6>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <div class="box">
                        <div class="box-body ribbon-box bg-primary-light">
                            <div class="ribbon ribbon-info">informasi</div>
                            <p class="mb-0">Master data Fakultas menampilkan data Fakultas dan Pimpinan Fakultas. Isikan
                                nama Pimpinan untuk data pada printout transkrip mahasiswa.</p>
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
                        <table id="kgtfakultas" class="table table-hover table-striped">
                            <thead class="bg-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Kode Fakultas</th>
                                    <th>Nama Fakultas</th>
                                    <th>Pimpinan Fakultas</th>
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
                            <h4 class="modal-title">Input Fakultas</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                        <form id="form_add" method="POST">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Kode Fakultas</label>
                                    <input class="form-control" type="text" name="kode_fakultas"
                                        placeholder="Kode Fakultas">
                                    <input class="form-control" type="hidden" name="plt" value="1"
                                        placeholder="Kode Fakultas">
                                    <input class="form-control" type="hidden" name="trash" value="0"
                                        placeholder="Kode Fakultas">
                                </div>
                                <div class="form-group">
                                    <label>Nama Fakultas</label>
                                    <input class="form-control" type="text" name="nama_fakultas"
                                        placeholder="Nama Fakultas">
                                </div>
                                <div class="form-group">
                                    <label>Jenjang Pendidikan</label>
                                    <select class="form-control" name="kode_jenjang_pendidikan"
                                        id="kode_jenjang_pendidikan">
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Pimpinan Fakultas</label>
                                    <select class="form-control" name="pimpinan" id="pimpinan">
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

            {{-- modal edit --}}

            <div class="modal fade" id="modal_edit">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Fakultas</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                        <form id="form_edit" method="POST">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Kode Fakultas</label>
                                    <input class="form-control" type="text" name="ekode_fakultas" id="ekode_fakultas"
                                        placeholder="Kode Fakultas">
                                    <input class="form-control" type="hidden" name="id_fak" id="id_fak"
                                        placeholder="ID Fakultas">
                                </div>
                                <div class="form-group">
                                    <label>Nama Fakultas</label>
                                    <input class="form-control" type="text" name="enama_fakultas" id="enama_fakultas"
                                        placeholder="Nama Fakultas">
                                </div>
                                <div class="form-group">
                                    <label>Pimpinan Fakultas</label>
                                    <select class="form-control" name="editpimpinan" id="editpimpinan">
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

        function pimpinan() {
            $.ajax({
                type: 'GET',
                url: "{{ config('setting.second_url') }}akademik/tampilpimpinan",
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                success: function(result) {
                    var jml = result.length;
                    var s = '<option value="">-Pilih Pimpinan-</option>';
                    for (i = 0; i < jml; i++) {
                        s = s + '<option value="' + result[i].id + '"> ' + result[i].nama + '</option>';
                    }
                    // console.log(result);
                    $('#pimpinan').html(s);
                }
            })
        }
        pimpinan();

        function editpimpinan() {
            $.ajax({
                type: 'GET',
                url: "{{ config('setting.second_url') }}akademik/edittampilpimpinan",
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                success: function(result) {
                    var jml = result.length;
                    var s = '<option value="">-Pilih Pimpinan-</option>';
                    for (i = 0; i < jml; i++) {
                        s = s + '<option value="' + result[i].id + '"> ' + result[i].nama + '</option>';
                    }
                    // console.log(result);
                    $('#editpimpinan').html(s);
                }
            })
        }
        editpimpinan();

        function jenjang() {
            $.ajax({
                type: 'GET',
                url: "{{ config('setting.second_url') }}akademik/tampiljenjang",
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                success: function(result) {
                    var jml = result.length;
                    var s = '<option value="">-Pilih-</option>';
                    for (i = 0; i < jml; i++) {
                        s = s + '<option value="' + result[i].kode_jenjang_pendidikan + '"> ' + result[i]
                            .nama_jenjang_pendidikan + '</option>';
                    }
                    // console.log(result);
                    $('#kode_jenjang_pendidikan').html(s);
                }
            })
        }
        jenjang();
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
            var table = $("#kgtfakultas").DataTable({
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
                    url: "{{ config('setting.second_url') }}akademik/fakultas",
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
                        data: 'kode_fakultas'
                    },
                    {
                        data: 'nama_fakultas'
                    },
                    {
                        data: 'nama'
                    },
                    {
                        data: null,
                        render: function(data, type, full, meta) {
                            if (full.trash == '1') {
                                return '<a href="javascript:void(0)" class="text-info mr-10" id="bt_edit" data-toggle="tooltip" data-original-title="Edit"><i class="ti-marker-alt"></i></a> | <a href="javascript:void(0)" class="text-danger del" data-id="' +
                                    full.id_fak +
                                    '" data-original-title="Delete" data-toggle="tooltip"><i class="ti-trash"></i></a>';
                            } else {
                                return '<a href="javascript:void(0)" class="text-info mr-10" id="bt_edit" data-toggle="tooltip"  data-original-title="Edit"><i class="ti-marker-alt"></i></a> | <a href="javascript:void(0)" class="text-danger del" data-id="' +
                                    full.id_fak +
                                    '" data-original-title="Delete" data-toggle="tooltip"><i class="ti-trash"></i></a>';

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
                $('#id_fak').val(data['id_fak']);
                $('#ekode_fakultas').val(data['kode_fakultas']);
                $('#enama_fakultas').val(data['nama_fakultas']);
                $('#editpimpinan').val(data['pimpinan']);
            });

            // edit
            $('#form_edit').on('submit', function(event) {
                event.preventDefault();
                var form_data = $(this).serialize();
                $.ajax({
                    url: "{{ config('setting.second_url') }}akademik/edit-fakultas",
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
                        $.ajax({
                            url: "{{ config('setting.second_url') }}akademik/ubahstatus-fakultas",
                            type: 'GET',
                            headers: {
                                "Authorization": 'Bearer ' + token,
                                "username": userlogin
                            },
                            data: {
                                id_fak: id
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
                            url: "{{ config('setting.second_url') }}akademik/ubahstatus-fakultas",
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


            // $("#jadwalperkul").on('click', '.aksidetailjad', function(event) {


            //     event.preventDefault();
            //     var datafull = table.row($(this).parents('tr')).data();
            //     var nama = datafull['nama_mk'];

            //     $.ajax({
            //         type: 'POST',
            //         headers: {
            //             "Authorization": 'Bearer ' + token
            //         },
            //         dataType: "json",
            //         url: "{{ config('setting.second_url') }}perkuliahan/jadwaldetailmhs",
            //         data: {
            //             nama: nama
            //         },
            //         success: function(data) {
            //             var jml = data.data.length;
            //             var no = 1;
            //             var tampil = '';
            //             for (var i = 0; i < jml; i++) {
            //                 tampil = tampil + '<tr><td>' + data.data[i].ke + '</td><td>' + data
            //                     .data[i].dosen1 + '</td><td><center>' + data.data[i].hari +
            //                     '</center></td><td><center>' + data.data[i].jam +
            //                     '</center></td><td><center>' + data.data[i].tgl +
            //                     '</center></td></tr>';
            //                 no++;
            //             }
            //             $('#detailjadwal').html(tampil);
            //             console.log(jml)
            //             $('#lihatdetailjad').modal();
            //         }
            //     })
            // })

            // $("#jadwalperkul").on('click', '.aksidetailpes', function(event) {


            //     event.preventDefault();
            //     var datafull = table.row($(this).parents('tr')).data();
            //     var kdmk = datafull['kd_mk'];

            //     $.ajax({
            //         type: 'POST',
            //         headers: {
            //             "Authorization": 'Bearer ' + token
            //         },
            //         dataType: "json",
            //         url: "{{ config('setting.second_url') }}perkuliahan/cekpeserta",
            //         data: {
            //             kd_mk: kdmk,
            //             ta: ta,
            //             smt: smt
            //         },
            //         success: function(data) {
            //             var jml = data.data.length;
            //             var no = 1;
            //             var tampil = '';
            //             for (var i = 0; i < jml; i++) {
            //                 tampil = tampil + '<tr><td>' + data.data[i].nim + '</td><td>' + data
            //                     .data[i].nama + '</td></tr>';
            //                 no++;
            //             }
            //             $('#detailpeserta').html(tampil);
            //             console.log(kdmk)
            //             $('#lihatdetailpes').modal();
            //         }
            //     })
            // })

        });
    </script>
@stop
