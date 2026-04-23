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
                                    <th>IPS</th>
                                    <th>SKS Semester</th>
                                    <th>IPK</th>
                                    <th>Total SKS</th>
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

        <div class="modal fade" id="modal_sks_ambil">
            <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">List Per Semester</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table id="tbsksambil" class="table table-striped table-bordered table-sm" cellspacing="0"
                                width="100%">
                                <thead class="bg-dark">
                                    <tr>
                                        <th>No</th>
                                        <th>Tahun Ajaran</th>
                                        <th>Semester</th>
                                        <th>SKS</th>
                                        <th>IPK</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>

                    </div>
                    <div class="modal-footer text-right">
                        <button type="button" class="btn btn-rounded btn-warning btn-outline mr-1" data-dismiss="modal">
                            <i class="fa fa-times"></i> Close
                        </button>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="modal_ips_ambil">
            <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">IPK MAHASISWA</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table id="tbipsambil" class="table table-striped table-bordered table-sm" cellspacing="0"
                                width="100%">
                                <thead class="bg-dark">
                                    <tr>
                                        <th>No</th>
                                        <th>NIM</th>
                                        <th>Total IPK</th>
                                        <th>Total SKS</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>

                    </div>
                    <div class="modal-footer text-right">
                        <button type="button" class="btn btn-rounded btn-warning btn-outline mr-1" data-dismiss="modal">
                            <i class="fa fa-times"></i> Close
                        </button>
                    </div>
                </div>
            </div>
        </div>

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
                    // {
                    //     data: null,
                    //     className: 'text-center',
                    //     render: function(data, type, full, meta) {
                    //         return '<a href="javascript:void(0)" class="text-info mr-10" data-id="' +
                    //             full.nim +
                    //             '" id="btsksambil" data-toggle="tooltip" data-original-title="Edit" title="List SKS">List SKS</a>';
                    //     }
                    // },
                    // {
                    //     data: null,
                    //     className: 'text-center',
                    //     render: function(data, type, full, meta) {
                    //         return '<a href="javascript:void(0)" class="text-info mr-10" data-id="' +
                    //             full.nim +
                    //             '" id="btipsambil" data-toggle="tooltip" data-original-title="Edit" title="List IPK">List IPK</a>';
                    //     }
                    // },
                    {
                        data: 'ips'
                    },
                    {
                        data: 'sksjumips'
                    },
                    {
                        data: 'ipk'
                    },
                    {
                        data: 'sksjum'
                    },

                ],
                order: []
            });

            table.on('click', '#btsksambil', function() {
                $tr = $(this).closest('tr');
                var data = table.row($tr).data();
                $('#modal_sks_ambil').modal('show');
                var nim = $(this).data('id');

                tbsksambil(nim);
            });

            table.on('click', '#btipsambil', function() {
                $tr = $(this).closest('tr');
                var data = table.row($tr).data();
                $('#modal_ips_ambil').modal('show');
                var nim = $(this).data('id');

                tbipsambil(nim);
            });

            function tbsksambil(id) {
                var tdetail = $('#tbsksambil').DataTable({
                    bInfo: false,
                    destroy: true,
                    bPaginate: false,
                    bLengthChange: false,
                    bFilter: false,
                    // "rowHeight": 'auto',      
                    order: false,
                    ajax: {
                        type: "GET",
                        url: "{{ config('setting.second_url') }}akademik/modal-sks-diambil",
                        headers: {
                            "Authorization": 'Bearer ' + token,
                            "username": userlogin
                        },
                        data: {
                            nim: id
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
                            data: null,
                            className: "text-center",
                            render: function(data, type, full, meta) {
                                var tambah = parseInt(full.tahun) + 1;
                                var tahun = full.tahun + "/" + tambah;
                                return '<label>' + tahun + '</label>';
                            }
                        },
                        {
                            data: null,
                            className: "text-center",
                            render: function(data, type, full, meta) {
                                if (full.semester == '1') {
                                    return '<label>Ganjil</label>';
                                } else {
                                    return '<label>Genap</label>';

                                }
                            }
                        },
                        {
                            data: "sks",
                            className: "text-center",
                            orderable: false
                        },
                        {
                            data: "ips",
                            className: "text-center",
                            orderable: false
                        },
                    ],
                    "footerCallback": function(row, data, start, end, display) {
                        var api = this.api(),
                            data;
                        // Remove the formatting to get integer data for summation
                        var intVal = function(i) {
                            return typeof i === 'string' ?
                                i.replace(/[\$,]/g, '') * 1 :
                                typeof i === 'number' ?
                                i : 0;
                        };
                        // Total over all pages
                        total = api
                            .column(2)
                            .data()
                            .reduce(function(a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);

                        // Update footer
                        $(api.column(2).footer()).html(total);
                    }
                });
            }

            function tbipsambil(id) {
                var tdetail = $('#tbipsambil').DataTable({
                    bInfo: false,
                    destroy: true,
                    bPaginate: false,
                    bLengthChange: false,
                    bFilter: false,
                    // "rowHeight": 'auto',      
                    order: false,
                    ajax: {
                        type: "GET",
                        url: "{{ config('setting.second_url') }}akademik/modal-ips-diambil",
                        headers: {
                            "Authorization": 'Bearer ' + token,
                            "username": userlogin
                        },
                        data: {
                            nim: id
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
                            data: "nim",
                            className: "text-center",
                            orderable: false
                        },
                        {
                            data: "sks",
                            className: "text-center",
                            orderable: false
                        },
                        {
                            data: "ipk",
                            className: "text-center",
                            orderable: false
                        },
                    ],
                    "footerCallback": function(row, data, start, end, display) {
                        var api = this.api(),
                            data;
                        // Remove the formatting to get integer data for summation
                        var intVal = function(i) {
                            return typeof i === 'string' ?
                                i.replace(/[\$,]/g, '') * 1 :
                                typeof i === 'number' ?
                                i : 0;
                        };
                        // Total over all pages
                        total = api
                            .column(2)
                            .data()
                            .reduce(function(a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);

                        // Update footer
                        $(api.column(2).footer()).html(total);
                    }
                });
            }
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
