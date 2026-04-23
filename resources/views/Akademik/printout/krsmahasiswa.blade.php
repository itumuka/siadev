@extends('layout')

@section('content')
    <div class="container-full">
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">ACC KRS</h3>
                </div>

            </div>
        </div>
        <!-- Main content -->
        <section class="content">
            <div class="box">
                <div class="box-header with-border">
                    <h6 class="box-subtitle">Melihat ACC KRS</h6>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <div class="box">
                        <div class="box-body ribbon-box bg-primary-light">
                            <div class="ribbon ribbon-info">informasi</div>
                            <p class="mb-0"></p>
                        </div> <!-- end box-body-->
                    </div>
                    <div class="box-header no-border">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <input class="form-control" type="hidden" name="nimjamak" id="nimjamak">
                                    <input class="form-control" type="hidden" name="tahun" id="tahun"
                                        value="{{ $session_tahun }}">
                                    <input class="form-control" type="hidden" name="semester" id="semester"
                                        value="{{ $session_semester }}">
                                    <select class="form-control" name="tahun_angkatan" id="tahun_angkatan">
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="kgtkrsmahasiswa" class="table table-hover table-striped">
                            <thead class="bg-dark">
                                <tr>
                                    <th>No</th>
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <th>Prodi</th>
                                    <th>IPK</th>
                                    <th>Batas SKS</th>
                                    <th>SKS Ambil</th>
                                    <th>SKS Bayar</th>
                                    <th>Cetak KRS</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>

                        <div class="box-header no-border">
                        </div>
                    </div>
                </div>
                <iframe id="printff" name="printff" style="display: none;"></iframe>
                <!-- /.box-body -->
            </div>

    </div>

    <div class="modal fade" id="modal_list_sksambil_already">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class=" ti-info-alt"></i> Data SKS Ambil</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table id="tbalreadysksambil" class="table table-hover table-sm" width="100%">
                            <thead>
                                <tr>
                                    <th>Matakuliah</th>
                                    <th>SKS</th>
                                    <th>SMT</th>
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
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="modal_list_sksbayar_already">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class=" ti-info-alt"></i> Data SKS Bayar</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table id="tbalreadysksbayar" class="table table-hover table-sm" width="100%">
                            <thead>
                                <tr>
                                    <th>Matakuliah</th>
                                    <th>SKS</th>
                                    <th>SMT</th>
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
        function cetak(nim, tahun, semester) {
            var link = ""
            $("#printff")

                .attr("src", "{{ url('akademik/cetak/cetakkrsmahasiswa') }}/" + nim + "/" + tahun + "/" + semester + "")
                .appendTo("body");

        }

        $(document).ready(function() {
            var token = "{{ Session::get('token') }}";
            var userlogin = "{{ Session::get('username') }}";
            tahun_angkatan();

            function tahun_angkatan() {
                $.ajax({
                    type: 'GET',
                    url: "{{ config('setting.second_url') }}akademik/tampiltahunangkatan",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    success: function(result) {
                        var jml = result.length;
                        var s = "";
                        for (i = 0; i < jml; i++) {
                            s = s + '<option value="' + result[i].tahun_angkatan + '"> ' + result[i]
                                .tahun_angkatan + '</option>';
                        }
                        s = s + '<option value="">Semua Angkatan</option>';
                        // console.log(result);
                        $('#tahun_angkatan').html(s);
                        var tahun_angkatan = $('#tahun_angkatan').val();
                        tbnilai(tahun_angkatan);
                    }
                })
            }

            $('#tahun_angkatan').on('change', function(event) {
                var tahun_angkatan = $('#tahun_angkatan').val();
                tbnilai(tahun_angkatan);

            });


            var id_mhs = $('#id_mhs').val();

            // function dropdown_angkatan() {
            //     $.ajax({
            //         type: "POST",
            //         url: "{{ config('setting.second_url') }}akademik/dropdown-angkatan",
            //         dataType: "json",
            //         headers: {
            //             "Authorization": 'Bearer ' + token,
            //             "username": userlogin
            //         },
            //         success: function(data) {
            //             // $('.test').fadeOut();
            //             let target = $(".dropdown-prodi")
            //             $.each(data, function(index, value) {
            //                 var el = data[index];
            //                 var flag = 0;
            //                 target.append(
            //                     '<a href="#" class="dropdown-item" id="btmodal_add" data-id=' +
            //                     el.tahun_angkatan + ' data-prodi=' + el
            //                     .tahun_angkatan +
            //                     ' data-toggle="modal" data-target="#modal_add">' + el
            //                     .tahun_angkatan + '</a>')
            //             });
            //         },
            //         error: function(error) {
            //             alert(error);
            //         }
            //     });
            // }
            // dropdown_angkatan();
            var table;

            function tbnilai(tahun_angkatan) {
                // var nim = $('#nim').val();
                var tahun = $('#tahun').val();
                var semester = $('#semester').val();
                table = $("#kgtkrsmahasiswa").DataTable({
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
                        url: "{{ config('setting.second_url') }}akademik/krsmahasiswa",
                        headers: {
                            "Authorization": 'Bearer ' + token,
                            "username": userlogin
                        },
                        data: {
                            // nim: nim,
                            tahun_angkatan: tahun_angkatan,
                            tahun: tahun,
                            semester: semester,
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
                            data: 'nim'
                        },
                        {
                            data: 'nama_mahasiswa'
                        },
                        {
                            data: 'nama_program_studi'
                        },
                        {
                            data: 'ip_semester'
                        },
                        {
                            data: 'batas_sks'
                        },
                        {
                            data: null,
                            render: function(data, type, full, meta) {
                                if (full.sks_ambil < '0') {
                                    return '<a href="javascript:void(0)" class="text-info mr-10" data-toggle="tooltip" data-original-title="Edit">0</a>';
                                } else {
                                    return '<a href="javascript:void(0)" class="text-info mr-10" id="bt_list_sksambil" data-id_krs="' +
                                        full.id_krs +
                                        '" data-toggle="tooltip" data-original-title="Edit">' + full
                                        .sks_ambil + '</a>';

                                }
                            }
                        },
                        {
                            data: null,
                            render: function(data, type, full, meta) {
                                if (full.sks_bayar < '0') {
                                    return '<a href="javascript:void(0)" class="text-info mr-10" data-toggle="tooltip" data-original-title="Edit">0</a>';
                                } else {
                                    return '<a href="javascript:void(0)" class="text-info mr-10" id="bt_list_sksbayar" data-id_krs="' +
                                        full.id_krs +
                                        '" data-toggle="tooltip" data-original-title="Edit">' + full
                                        .sks_bayar + '</a>';

                                }
                            }
                        },
                        {
                            data: null,
                            className: 'text-center',
                            render: function(data, type, full, meta) {
                                return '<a href="javascript:void(0)" class="text-info mr-10" id="cetak" data-toggle="tooltip" data-original-title="Edit" title="Cetak KRS" onclick="cetak(' +
                                    full.nim + ',' + full.tahun + ',' + full.semester +
                                    ');"><i class="fa fa-print"></i></a>';
                            }
                        },

                    ],
                    order: []
                });

                function listsksambil_already(id_krs) {
                    var tdetail = $('#tbalreadysksambil').DataTable({
                        bInfo: false,
                        bPaginate: false,
                        bLengthChange: false,
                        bFilter: false,
                        destroy: true,
                        order: false,
                        ajax: {
                            type: "GET",
                            url: "{{ config('setting.second_url') }}akademik/list-sksambil",
                            headers: {
                                "Authorization": 'Bearer ' + token,
                                "username": userlogin
                            },
                            data: {
                                id_krs: id_krs
                            },
                            dataSrc: function(json) {
                                return json;
                            }
                        },
                        columns: [{
                                data: "nama_matakuliah",
                                orderable: false
                            },
                            {
                                data: "sks_matakuliah",
                                orderable: false
                            },
                            {
                                data: "smt_matakuliah",
                                orderable: false
                            }
                            // { name : "aksi", width:'5%', className: "text-center", orderable: false,
                            //     render: (data,type,row) => {
                            //     return '<a href="#" id="delrow"><i class="ti-trash"></i></a>';
                            //     }
                            // }
                        ],
                    });
                }

                function listsksbayar_already(id_krs) {
                    var tdetail = $('#tbalreadysksbayar').DataTable({
                        bInfo: false,
                        bPaginate: false,
                        bLengthChange: false,
                        bFilter: false,
                        destroy: true,
                        order: false,
                        ajax: {
                            type: "GET",
                            url: "{{ config('setting.second_url') }}akademik/list-sksbayar",
                            headers: {
                                "Authorization": 'Bearer ' + token,
                                "username": userlogin
                            },
                            data: {
                                id_krs: id_krs
                            },
                            dataSrc: function(json) {
                                return json;
                            }
                        },
                        columns: [{
                                data: "nama_matakuliah",
                                orderable: false
                            },
                            {
                                data: "sks_matakuliah",
                                orderable: false
                            },
                            {
                                data: "smt_matakuliah",
                                orderable: false
                            }
                            // { name : "aksi", width:'5%', className: "text-center", orderable: false,
                            //     render: (data,type,row) => {
                            //     return '<a href="#" id="delrow"><i class="ti-trash"></i></a>';
                            //     }
                            // }
                        ],
                    });
                }

                table.on('click', '#bt_list_sksambil', function() {
                    $tr = $(this).closest('tr');
                    var data = table.row($tr).data();
                    var id_krs = $(this).data("id_krs");

                    $('#modal_list_sksambil_already').modal('show');
                    listsksambil_already(id_krs);

                });

                table.on('click', '#bt_list_sksbayar', function() {
                    $tr = $(this).closest('tr');
                    var data = table.row($tr).data();
                    var id_krs = $(this).data("id_krs");

                    $('#modal_list_sksbayar_already').modal('show');
                    listsksbayar_already(id_krs);

                });

                table
                    .on('select', function(e, dt, type, indexes) {
                        var oData = table.rows('.selected').data();
                        var str = "";
                        for (var i = 0; i < oData.length; i++) {
                            if (i <= 0) {
                                str = oData[i]['nim'];
                            } else {
                                str = str + "-" + oData[i]['nim'];
                            }
                        }
                        // console.log(str);
                        $('#nimjamak').val(str);
                    })
                    .on('deselect', function(e, dt, type, indexes) {
                        // var rowData = table.rows(indexes).data().toArray();
                        // console.log(table.rows('.selected').data());
                        var oData = table.rows('.selected').data();
                        var str = "";
                        for (var i = 0; i < oData.length; i++) {
                            if (i <= 0) {
                                str = oData[i]['nim'];
                            } else {
                                str = str + "-" + oData[i]['nim'];
                            }
                        }
                        // console.log(str);
                        $('#nimjamak').val(str);
                    });
            }
        });
    </script>
@stop
