@extends('layout')

@section('content')
    <div class="container-full">
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">Kalender Akademik</h3>
                    <div class="d-inline-block align-items-center">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                                <li class="breadcrumb-item" aria-current="page">Master</li>
                                <li class="breadcrumb-item active" aria-current="page">Kalender Akademik</li>
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
                    <h6 class="box-subtitle">Melihat Data Kalender Akademik</h6>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <div class="box">
                        <div class="box-body ribbon-box bg-primary-light">
                            <div class="ribbon ribbon-info">informasi</div>
                            <p class="mb-0">Kalender akademik digunakan sebagai acuan pelaksanaan kegiatan belajar
                                mengajar.
                                Silahkan isikan Kalender Akademik pada setiap semesternya.</p>
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
                        <table id="kgtkalenderakademik" class="table table-hover table-striped">
                            <thead class="bg-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Tahun</th>
                                    <th>Semester</th>
                                    <th>Nama Kegiatan</th>
                                    <th>Tanggal Awal</th>
                                    <th>Tanggal Akhir</th>
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
                            <h4 class="modal-title">Input Kalender Akademik</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                        <form id="form_add" method="POST">
                            <div class="modal-body">
                                <input class="form-control" type="hidden" name="tahun" id="tahun"
                                    value="{{ $session_tahun }}">
                                <input class="form-control" type="hidden" name="semester" id="semester"
                                    value="{{ $session_semester }}">
                                <div class="form-group">
                                    <label>Kegiatan Akademik</label>
                                    <select class="form-control" name="kode_kegiatan_akademik" id="kode_kegiatan_akademik">
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-6">
                                            <label>Tanggal Mulai</label>
                                            <div class="input-group">
                                                <input type="date" name="tanggal1" id="tanggal1" class="form-control"
                                                    data-inputmask="'alias': 'dd/mm/yyyy'">
                                            </div>
                                            <!-- /.input group -->
                                        </div>
                                        <div class="col-6">
                                            <!-- Date mm/dd/yyyy -->
                                            <label>Tanggal Akhir</label>
                                            <div class="input-group">
                                                <input type="date" name="tanggal2" id="tanggal2" class="form-control"
                                                    data-inputmask="'alias': 'mm/dd/yyyy'">
                                            </div>
                                            <!-- /.input group -->
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Background</label>
                                    <div>
                                        <input class="form-control" type="color" name="background" id="background">
                                        <span class="form-text text-muted">Pilih Warna Background</span>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer float-right">
                                <button type="button" class="btn btn-rounded btn-warning btn-outline mr-1"
                                    data-dismiss="modal">
                                    <i class="fa fa-times"></i> Batal
                                </button>
                                <button type="submit" class="btn btn-rounded btn-primary btn-outline" id="btsubmit">
                                    <i class="ti-save-alt"></i> Simpan
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
                            <h4 class="modal-title">Edit Kalender Akademik</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                        <form id="form_edit" method="POST">
                            <div class="modal-body">
                                <div class="form-group">
                                    <input class="form-control" type="hidden" name="id_kalender" id="id_kalender"
                                        placeholder="ID Kalender Akademik">
                                    <input type="text" name="enama_kegiatan" id="enama_kegiatan_akademik">
                                </div>
                                <div class="form-group">
                                    <label>Kegiatan Akademik</label>
                                    <select class="form-control" name="ekode_kegiatan_akademik"
                                        id="ekode_kegiatan_akademik">
                                        <option value="">Pilih</option>
                                        <option value=""></option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-6">
                                            <label>Tanggal Mulai</label>
                                            <div class="input-group">
                                                <input type="date" name="etanggal1" id="etanggal1"
                                                    class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'">
                                            </div>
                                            <!-- /.input group -->
                                        </div>
                                        <div class="col-6">
                                            <!-- Date mm/dd/yyyy -->
                                            <label>Tanggal Akhir</label>
                                            <div class="input-group">
                                                <input type="date" name="etanggal2" id="etanggal2"
                                                    class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'">
                                            </div>
                                            <!-- /.input group -->
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Background</label>
                                    <div>
                                        <input class="form-control" type="color" name="edbackground">
                                        <span class="form-text text-muted">Pilih Warna Background</span>
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
        </section>
        <!-- /.content -->
    </div>
@endsection
@section('script-master')
    <script type="text/javascript">
        var token = "{{ Session::get('token') }}";
        var userlogin = "{{ Session::get('username') }}";

        function kegiatanakademik() {
            $.ajax({
                type: 'GET',
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                url: "{{ config('setting.second_url') }}akademik/tampilkegiatanakademik",
                success: function(result) {
                    var jml = result.length;
                    var s = '<option value="">-Pilih Kegiatan Akademik-</option>';
                    for (i = 0; i < jml; i++) {
                        s = s + '<option value="' + result[i].kode_kegiatan + '"> ' +
                            result[i]
                            .nama_kegiatan + '</option>';
                    }
                    // console.log(result);
                    $('#kode_kegiatan_akademik').html(s);
                }
            })
        }
        kegiatanakademik();

        function editkegiatanakademik() {
            $.ajax({
                type: 'GET',
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                url: "{{ config('setting.second_url') }}akademik/edittampilkegiatanakademik",
                success: function(result) {
                    var jml = result.length;
                    var s = '<option>Pilih Kegiatan</option>';
                    for (i = 0; i < jml; i++) {
                        s = s + '<option value="' + result[i].kode_kegiatan_akademik + '"> ' +
                            result[i]
                            .nama_kegiatan + '</option>';
                    }
                    // console.log(result);
                    $('#ekode_kegiatan_akademik').html(s);
                }
            })
        }
        editkegiatanakademik();

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
            var table = $("#kgtkalenderakademik").DataTable({
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
                    url: "{{ config('setting.second_url') }}akademik/kalenderakademik",
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
                        data: 'nama_kegiatan'
                    },
                    {
                        data: 'tanggal_mulai'
                    },
                    {
                        data: 'tanggal_akhir'
                    },
                    {
                        data: null,
                        render: function(data, type, full, meta) {
                            if (full.trash == '1') {
                                return '<a href="javascript:void(0)" class="text-info mr-10" id="bt_edit" data-toggle="tooltip" data-original-title="Edit"><i class="ti-marker-alt"></i></a> | <a href="javascript:void(0)" class="text-danger del" data-id="' +
                                    full.id +
                                    '" data-original-title="Delete" data-toggle="tooltip"><i class="ti-trash"></i></a>';
                            } else {
                                return '<a href="javascript:void(0)" class="text-info mr-10" id="bt_edit" data-toggle="tooltip"  data-original-title="Edit"><i class="ti-marker-alt"></i></a> | <a href="javascript:void(0)" class="text-danger del" data-id="' +
                                    full.id +
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
                    url: "{{ config('setting.second_url') }}akademik/simpan-kalenderakademik",
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
                $('#id_kalender').val(data['id']);
                $('#ekode_kegiatan_akademik').val(data['kode_kegiatan_akademik']);
                $('#enama_kegiatan_akademik').val(data['nama_kegiatan']);
                $('#etanggal1').val(data['tanggal_mulai']);
                $('#etanggal2').val(data['tanggal_akhir']);
                $('#ebackground').val(data['background']);
                $("#" + data.trash).prop("checked", true)
            });

            // edit
            $('#form_edit').on('submit', function(event) {
                event.preventDefault();
                var form_data = $(this).serialize();
                $.ajax({
                    url: "{{ config('setting.second_url') }}akademik/edit-kalenderakademik",
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
                            url: "{{ config('setting.second_url') }}akademik/hapus-kalenderakademik",
                            type: 'GET',
                            headers: {
                                "Authorization": 'Bearer ' + token,
                                "username": userlogin
                            },
                            data: {
                                id: id
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
                            url: "{{ config('setting.second_url') }}akademik/ubahstatus-kalenderakademik",
                            type: 'GET',
                            headers: {
                                "Authorization": 'Bearer ' + token,
                                "username": userlogin
                            },
                            data: {
                                id: id,
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
