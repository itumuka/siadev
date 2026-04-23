@extends('layout')

@section('content')

    <div class="container-full">
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">Tahun Ajaran</h3>
                    <div class="d-inline-block align-items-center">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                                <li class="breadcrumb-item" aria-current="page">Master</li>
                                <li class="breadcrumb-item active" aria-current="page">Tahun Ajaran</li>
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
                    <h6 class="box-subtitle">Melihat Data Tahun Ajaran</h6>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <div class="box">
                        <div class="box-body ribbon-box bg-primary-light">
                            <div class="ribbon ribbon-info">informasi</div>
                            <p class="mb-0">Tahun akademik yang digunakan oleh mahasiswa adalah tahun
                                akademik dengan status
                                Aktif. Pastikan tahun akademik yang berjalan sudah diaktifkan.</p>
                        </div> <!-- end box-body-->

                        <div class="box-header no-border">
                            <div class="row">
                                <div class="col-sm-12 text-right">
                                    <button type="button" class="btn btn-dark btn-sm" data-toggle="modal"
                                        data-target="#modal_add"><i class="ti-plus"></i> Tambah</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="thnajar" class="table table-hover table-striped" width="100%">
                            <thead class="bg-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Tahun</th>
                                    <th>Semester</th>
                                    <th>Tahun Akademik</th>
                                    <th>Status</th>
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
                            <h4 class="modal-title">Input Tahun Akademik</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                        <form id="form_add" method="POST">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Tahun</label>
                                    <input class="form-control" onkeypress="return isNumberKey(event)" type="text"
                                        maxlength="4" name="tahun" placeholder="ex: 2021">
                                </div>
                                <div class="form-group">
                                    <label>Semester</label>
                                    <input class="form-control" onkeypress="return isNumberKey(event)" type="text"
                                        maxlength="1" name="semester" placeholder="ex: 1 (Ganjil)">
                                </div>
                                <div class="form-group">
                                    <label>Tahun Akademik</label>
                                    <input class="form-control" type="text" maxlength="9" name="tahun_akademik"
                                        placeholder="ex: 2020/2021">
                                </div>
                                <div class="form-group">
                                    <div class="demo-radio-button">
                                        <input name="trash" type="radio" id="radio_9" class="radio-col-success"
                                            value="1" />
                                        <label for="radio_9">Aktif</label>
                                        <input name="trash" type="radio" id="radio_13" class="radio-col-danger"
                                            value="0" />
                                        <label for="radio_13">Non Aktif</label>
                                    </div>
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
                            <h4 class="modal-title">Input Tahun Akademik</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                        <form id="form_edit" method="POST">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Tahun</label>
                                    <input class="form-control" type="number" name="etahun" placeholder="ex: 2021"
                                        id="etahun">
                                    <input class="form-control" type="hidden" name="id_mreg" id="id_mreg">
                                </div>
                                <div class="form-group">
                                    <label>Semester</label>
                                    <input class="form-control" type="text" name="esemester"
                                        placeholder="ex: 1 (Ganjil)" id="esemester">
                                </div>
                                <div class="form-group">
                                    <label>Tahun Akademik</label>
                                    <input class="form-control" type="text" name="etahunakademik"
                                        placeholder="ex: 2020/2021" id="etahunakademik">
                                </div>
                                <div class="form-group">
                                    <div class="demo-radio-button">
                                        <input name="etrash" type="radio" id="1" class="radio-col-success"
                                            value="1" />
                                        <label for="1">Aktif</label>
                                        <input name="etrash" type="radio" id="0" class="radio-col-danger"
                                            value="0" />
                                        <label for="0">Non Aktif</label>
                                    </div>
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
            <iframe id="printff" name="printff" style="display: none;"></iframe>
        </section>
        <!-- /.content -->
    </div>
@endsection
@section('script-master')
    <script type="text/javascript">
        function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode != 46 && charCode > 31 &&
                (charCode < 48 || charCode > 57))
                return false;

            return true;
        }
        // var isicetakan;
        // isicetakan = 'cekcekcekcekcekcek';

        function cetak() {

            $("#printff")
                // /.hide()/
                .attr("src", "{{ url('akademik/cetak/cetaktahunajaran') }}")
                .appendTo("body");
            // var newWin = window.frames["printff"];
            // newWin.document.write('<body onload="window.print()">' + isicetakan + '</body>');
            // newWin.document.close();
            // return false;
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

            // var nim = $('#nim').val();
            // var ta = $('#ta').val();
            // var smt = $('#smt').val();
            // var token = $('#token').val();
            var table = $("#thnajar").DataTable({
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
                    url: "{{ config('setting.second_url') }}akademik/tahunajaran",
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
                        data: 'tahun'
                    },
                    {
                        data: 'semester'
                    },
                    {
                        data: 'tahun_akademik'
                    },
                    {
                        data: 'trash',
                        render: function(data, type, full, meta) {
                            if (full.trash == '1') {
                                return "Aktif";
                            } else {
                                return "Tidak Aktif";

                            }
                        }
                    },
                    {
                        data: null,
                        render: function(data, type, full, meta) {
                            if (full.trash == '1') {
                                // return '<a href="javascript:void(0)" class="text-info mr-10" id="bt_edit" data-toggle="tooltip" data-original-title="Edit" title="Edit Tahun Akademik"><i class="ti-marker-alt"></i></a> | <a href="javascript:void(0)" class="text-danger del" data-id="' +
                                //     full.id_mreg +
                                //     '" data-original-title="Delete" data-toggle="tooltip"><i class="ti-trash"></i></a> | <a href="javascript:void(0)" class="text-success mr-10 nonaktif" data-id="' +
                                //     full.id_mreg +
                                //     '" data-nilai="0" data-toggle="tooltip" data-original-title="Nonaktifkan"  disabled><i class="ti-power-off"></i></a>';
                                return "";
                            } else {
                                return '<a href="javascript:void(0)" class="text-info mr-10" id="bt_edit" data-toggle="tooltip"  data-original-title="Edit" title="Edit Tahun Akademik"><i class="ti-marker-alt"></i></a> | <a href="javascript:void(0)" class="text-danger del" data-id="' +
                                    full.id_mreg +
                                    '" data-original-title="Delete" data-toggle="tooltip"><i class="ti-trash"></i></a> | <a href="javascript:void(0)" class="text-danger mr-10 aktif" data-id="' +
                                    full.id_mreg +
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
                    url: "{{ config('setting.second_url') }}akademik/simpan-tahunajaran",
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
