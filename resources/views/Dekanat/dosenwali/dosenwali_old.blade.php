@extends('layout')
@section('css')
    <style>
        table.dataTable th,
        table.dataTable td {
            padding: 3px 6px;
            font-size: 0.8em;
            /* e.g. change 8x to 4px here */
        }
    </style>
@endsection
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
                        <input class="form-control" type="hidden" name="tahun" id="tahun"
                            value="{{ $session_tahun }}">
                        <input class="form-control" type="hidden" name="semester" id="semester"
                            value="{{ $session_semester }}">
                        <input class="form-control" type="hidden" name="kode_fakultas" id="kode_fakultas"
                            value="{{ $session_kode_fakultas }}">
                        <table id="kgtdosenwali" class="table table-hover table-striped" width="100%">
                            <thead class="bg-dark">
                                <tr>
                                    <th>No</th>
                                    <th>NIDN</th>
                                    <th>Nama Dosen</th>
                                    <th>Prodi</th>
                                    <th>Dosen Wali</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <div class="modal fade" id="modal_add">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Form Dosen Wali <span id="nama_dosen"></span></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <input class="form-control" type="hidden" name="id_pegawai" id="id_pegawai"
                                        value="">
                                    {{-- <select multiple="multiple" size="10" id="duallistbox_demo1" name="nim[]"
                                            title="duallistbox_demo1[]"></select> --}}
                                    <h4 class="modal-title">List Mahasiswa</h4>
                                    <div class="table-responsive">
                                        <table id="tbchandmhs" class="table table-hover table-sm" width="100%">
                                            <thead class="bg-secondary-light">
                                                <tr>
                                                    <th>No</th>
                                                    <th>NIM</th>
                                                    <th>Nama Mahasiswa</th>
                                                    <th>Angkatan</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <h4 class="modal-title">Hasil Tautan PA</h4>
                                    <div class="table-responsive">
                                        <table id="tbalreadymhs" class="table table-hover table-sm" width="100%">
                                            <thead class="bg-dark">
                                                <tr>
                                                    <th>No</th>
                                                    <th>NIM</th>
                                                    <th>Nama Mahasiswa</th>
                                                    <th>Angkatan</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer text-right">
                            <button type="button" class="btn btn-rounded btn-warning btn-outline mr-1"
                                data-dismiss="modal">
                                <i class="fa fa-times"></i> Close
                            </button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

            <div class="modal fade" id="modal_list_mhs_already">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">List Mahasiswa Yang Ditautkan ke Dosen Wali</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                        </div>
                        <div class="modal-footer text-right">
                            <button type="button" class="btn btn-rounded btn-warning btn-outline mr-1"
                                data-dismiss="modal">
                                <i class="fa fa-times"></i> Close
                            </button>
                        </div>
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

        function tambah_mhs(nim) {
            var id_pegawai = document.getElementById("id_pegawai").value;
            $.ajax({
                url: "{{ config('setting.second_url') }}dekanat/add-mhs-dosenwali",
                method: "POST",
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                data: {
                    nim: nim,
                    id_pegawai: id_pegawai
                },
                dataType: "json",
                beforeSend: function() {
                    $("#add_mhs").prop('disabled', true);
                },
                success: function(data) {
                    if (data.error) {
                        showToastr('error', 'Error!', data.error);
                        $("#tbchandmhs").DataTable().ajax.reload();
                        $("#tbalreadymhs").DataTable().ajax.reload();
                        $("#kgtdosenwali").DataTable().ajax.reload();
                        $("#add_mhs").prop('disabled', false);
                    } else if (data.success) {
                        showToastr('success', 'Success!', data.success);
                        $("#tbchandmhs").DataTable().ajax.reload();
                        $("#tbalreadymhs").DataTable().ajax.reload();
                        $("#kgtdosenwali").DataTable().ajax.reload();
                        $("#add_mhs").prop('disabled', false);
                    }
                }
            })
        }

        $(document).ready(function() {
            var token = "{{ Session::get('token') }}";
            var userlogin = "{{ Session::get('username') }}";

            var kode_fakultas = $('#kode_fakultas').val();
            var tbchandmhs;
            var tdetail;
            $.fn.DataTable.ext.pager.numbers_length = 3;
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
                    url: "{{ config('setting.second_url') }}dekanat/setting-dosenwali",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    data: {
                        kode_fakultas: kode_fakultas,
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
                        data: 'nidn'
                    },
                    {
                        data: 'dosen',
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
                                    '" data-original-title="Delete" data-toggle="tooltip" title="Kilk untuk merubah status"><i class="ti-info-alt"></i> Ya</a> ';
                            } else {
                                return '<a href="javascript:void(0)" class="text-danger" data-original-title="Delete" data-toggle="tooltip" title="Status Dosen Wali"><i class=" ti-info-alt"></i> Tidak</a>';

                            }
                        }
                    },
                    {
                        data: null,
                        className: "text-center",
                        render: function(data, type, full, meta) {

                            return '<a href="javascript:void(0)" class="btn btn-xs btn-primary" id="bt_edit"  data-id="' +
                                full.id_pegawai + '" data-prodi="' + full.kode_prodi +
                                '"  title="Ubah Status Dosen jadi Aktif"><i class="ti-pencil-alt"></i> Ubah</a>';
                        }
                    },

                ],
                order: []
            });

            function ubah_dosenwali(id, prodi) {
                tbchandmhs = $('#tbchandmhs').DataTable({
                    bLengthChange: false,
                    pageLength: 10,
                    destroy: true,
                    order: true,
                    ajax: {
                        type: "GET",
                        url: "{{ config('setting.second_url') }}dekanat/daftar-mahasiswa",
                        headers: {
                            "Authorization": 'Bearer ' + token,
                            "username": userlogin
                        },
                        data: {
                            id: id,
                            kode_prodi: prodi
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
                        }, {
                            data: "nim",
                            orderable: true
                        },
                        {
                            data: "nama_mahasiswa",
                            orderable: true
                        },
                        {
                            data: "tahun_angkatan",
                            orderable: true
                        },
                        {
                            name: "aksi",
                            width: '5%',
                            className: "text-center",
                            orderable: false,
                            render: (data, type, full, meta) => {
                                return '<button class="btn btn-xs btn-success" onclick="tambah_mhs(' +
                                    full.nim + ');" data-id="' + full.nim +
                                    '" id="add_mhs"><i class="fa fa-plus"></i></button>';
                            }
                        }
                    ],
                    order: []
                });

                tdetail = $('#tbalreadymhs').DataTable({
                    pageLength: 10,
                    bLengthChange: false,
                    destroy: true,
                    order: true,
                    ajax: {
                        type: "GET",
                        url: "{{ config('setting.second_url') }}dekanat/list-mhs-already",
                        headers: {
                            "Authorization": 'Bearer ' + token,
                            "username": userlogin
                        },
                        data: {
                            id: id,
                            kode_prodi: prodi
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
                        }, {
                            data: "nim",
                            orderable: true
                        },
                        {
                            data: "nama_mahasiswa",
                            orderable: true
                        },
                        {
                            data: "tahun_angkatan",
                            orderable: true
                        },
                        {
                            name: "aksi",
                            width: '5%',
                            className: "text-center",
                            orderable: false,
                            render: (data, type, row) => {
                                return '<a href="javascript:void(0)" class="btn btn-xs btn-danger" id="delmhs" data-id="' +
                                    row.nim + '"><i class="fa fa-trash"></i></a>';
                            }
                        }
                    ],
                    order: []
                });

                tdetail.on('click', '#delmhs[data-id]', function(e) {
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
                                url: "{{ config('setting.second_url') }}dekanat/hapus-mhs-dosenwali",
                                type: 'GET',
                                headers: {
                                    "Authorization": 'Bearer ' + token,
                                    "username": userlogin
                                },
                                data: {
                                    nim: id
                                },
                                dataType: 'json',
                                success: function(data) {
                                    if (data.error) {
                                        showToastr('error',
                                            'Error!', data.error);
                                    } else if (data.success) {
                                        showToastr('success',
                                            'Success!', data.success);
                                        tdetail.ajax.reload();
                                        tbchandmhs.ajax.reload();
                                    }
                                }
                            })
                        } else {
                            swal("Cancelled", "Data kamu aman! :)",
                                "error");
                        }
                    });

                });

            }

            table.on('click', '#bt_edit', function() {
                $tr = $(this).closest('tr');
                var data = table.row($tr).data();
                var id_pegawai = $(this).data("id");
                var kode_prodi = $(this).data("prodi");
                // var  = data['id_pegawai'];
                $('#id_pegawai').val(data['id_pegawai']);
                $('#modal_add').modal('show');
                ubah_dosenwali(id_pegawai, kode_prodi);
                // $('#nama_dosen').html(data['dosen']);
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
                            url: "{{ config('setting.second_url') }}dekanat/nonaktif-mhs-dosenwali",
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
