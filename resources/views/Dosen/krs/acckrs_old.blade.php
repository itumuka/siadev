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
                    <h3 class="page-title">{{ $title }}</h3>
                    <div class="d-inline-block align-items-center">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                                <li class="breadcrumb-item" aria-current="page">{{ $parent_breadcrumb }}</li>
                                <li class="breadcrumb-item active" aria-current="page"></li>
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
                    <h3 class="box-title">ACC Kartu Rencana Studi Semester {{ $session_nama_tahunakademik }}</h3>
                    {{-- <h6 class="box-subtitle">Melihat Data KHS</h6> --}}
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <input class="form-control" type="hidden" name="dosen_wali" id="dosen_wali"
                        value="{{ $session_dosen_wali }}">
                    <input class="form-control" type="hidden" name="id_dosen" id="id_dosen"
                        value="{{ $session_id_dosen }}">
                    <input class="form-control" type="hidden" name="tahun" id="tahun" value="{{ $session_tahun }}">
                    <input class="form-control" type="hidden" name="semester" id="semester"
                        value="{{ $session_semester }}">
                    <div class="table-responsive">
                        <table id="tbacckrs" class="table table-hover table-sm" width="100%">
                            <thead class="bg-dark">
                                <tr>
                                    <th>No</th>
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <th>No. HP</th>
                                    <th>Prodi</th>
                                    {{-- <th>IPK</th> --}}
                                    <th>Batas SKS</th>
                                    <th>SKS Ambil</th>
                                    <th>Cetak KRS</th>
                                    <th>Transkrip</th>
                                    <th>Status</th>
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
            <iframe id="printff" name="printff" style="display: none;"></iframe>

            <div class="modal fade" id="modal_sks_ambil">
                <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">List SKS Diambil</h4>
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
                                            <th>Mata Kuliah</th>
                                            <th>SKS</th>
                                            <th>Semester</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th colspan="2" style="text-align:right">Total:</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                        </div>
                        <div class="modal-footer text-right">
                            <button type="button" class="btn btn-rounded btn-warning btn-outline mr-1"
                                data-dismiss="modal">
                                <i class="fa fa-times"></i> Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modal_sks_bayar">
                <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">List SKS Dibayar</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table id="tbsksbayar" class="table table-striped table-bordered table-sm" cellspacing="0"
                                    width="100%">
                                    <thead class="bg-dark">
                                        <tr>
                                            <th>No</th>
                                            <th>Mata Kuliah</th>
                                            <th>SKS</th>
                                            <th>Semester</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th colspan="2" style="text-align:right">Total:</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                        </div>
                        <div class="modal-footer text-right">
                            <button type="button" class="btn btn-rounded btn-warning btn-outline mr-1"
                                data-dismiss="modal">
                                <i class="ti-trash"></i> Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modal_transkrip">
                <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Transkrip Mahasiswa</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="col-12 no-print mb-0">
                                <span>SKS Ditempuh : <b><span class="text-success" id="totalsks"></span></b></span><br>
                                <span>IPK : <b><span class="text-success" id="nilai_ipk"></span></b></span>
                            </div>
                            <div class="table-responsive">
                                <table id="tbkhs" class="table table-hover table-sm text-nowrap" width="100%">
                                    <thead class="bg-dark">
                                        <tr>
                                            <th>No</th>
                                            <th>Semester</th>
                                            <th>Kode</th>
                                            <th>Matakuliah</th>
                                            <th>SKS</th>
                                            <th>Nilai</th>
                                            <th>Bobot</th>
                                            <th>Kum</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer text-right">
                            <button type="button" class="btn btn-rounded btn-warning btn-outline mr-1"
                                data-dismiss="modal">
                                Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </section>
        <!-- /.content -->
    </div>
@endsection
@section('script-master')
    <script type="text/javascript">
        function cetak_krs(nim, tahun, semester) {
            var link = ""
            $("#printff")

                .attr("src", "{{ url('akademik/cetak/cetakkrs') }}/" + nim + "/" + tahun + "/" + semester + "")
                .appendTo("body");
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
            var id_dosen = $('#id_dosen').val();
            var dosen_wali = $('#dosen_wali').val();
            var tahun = $('#tahun').val();
            var semester = $('#semester').val();

            // var token = $('#token').val();
            var table = $("#tbacckrs").DataTable({
                destroy: true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel'
                ],
                // responsive: true,
                // autoWidth: false,
                pageLength: 20,
                processing: true,
                lengthChange: true,
                // searching: false,
                // serverSide: true,
                // stateSave: true,
                // scrollX: true,
                // orderable: false,
                ajax: {
                    type: "GET",
                    url: "{{ config('setting.second_url') }}dekanat/data-acckrs",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    data: {
                        tahun: tahun,
                        dosen_wali: dosen_wali,
                        id_dosen: id_dosen,
                        semester: semester
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
                        data: 'no_hp'
                    },
                    {
                        data: 'nama_program_studi'
                    },
                    // {
                    //     data: 'ip_kumulatif',
                    //     className: 'text-center',
                    // },
                    {
                        data: 'batas_sks',
                        className: 'text-center',
                    },
                    {
                        data: null,
                        className: 'text-center',
                        render: function(data, type, full, meta) {
                            return '<a href="javascript:void(0)" class="text-info mr-10" data-id="' +
                                full.id_krs +
                                '" id="btsksambil" data-toggle="tooltip" data-original-title="Edit" title="Cetak KRS">' +
                                full.sks_ambil + '</a>';
                        }
                    },
                    {
                        data: null,
                        className: 'text-center',
                        render: function(data, type, full, meta) {
                            return '<a href="javascript:void(0)" class="text-info mr-10" id="cetak_krs" data-toggle="tooltip" data-original-title="Edit" title="Cetak KRS" onclick="cetak_krs(' +
                                full.nim + ',' + full.tahun + ',' + full.semester +
                                ');"><i class="fa fa-print"></i></a>';
                        }
                    },
                    {
                        data: null,
                        className: 'text-center',
                        render: function(data, type, full, meta) {
                            return '<a href="javascript:void(0)" class="text-info mr-10" data-id="' +
                                full.nim +
                                '" id="bttranskrip" title="Cek Transkrip"><i class="fa fa-info-circle"></i></a>';
                        }
                    },
                    {
                        data: 'krs',
                        className: 'text-center',
                        render: function(data, type, full, meta) {
                            if (data == 1) {
                                return '<p class="text-success">Acc</p>'
                            } else {
                                return '<p class="text-danger">Belum Acc</p>'
                            }
                        }
                    },
                    {
                        data: 'krs',
                        className: 'text-center',
                        render: function(data, type, full, meta) {
                            if (data == 1) {
                                return '<button class="btn btn-xs btn-danger cancelacc" data-id="' +
                                    full.id_heregistrasi +
                                    '" data-nilai="0" data-toggle="tooltip"  data-original-title="Edit" title="Batal Acc KRS">Batalkan</button>'
                            } else {
                                return '<button class="btn btn-xs btn-success acc" data-id="' +
                                    full.id_heregistrasi +
                                    '" data-nilai="1" data-toggle="tooltip"  data-original-title="Edit" title="Acc KRS">Acc KRS</button>'
                            }
                        }
                    },

                ],
                order: []
            });


            table.on('click', '#btsksambil', function() {
                $tr = $(this).closest('tr');
                var data = table.row($tr).data();
                $('#modal_sks_ambil').modal('show');
                var id_krs = $(this).data('id');

                tbsksambil(id_krs);
            });

            table.on('click', '#btsksbayar', function() {
                $tr2 = $(this).closest('tr');
                var data2 = table.row($tr2).data();
                $('#modal_sks_bayar').modal('show');
                var id_krs2 = $(this).data('id');

                tbsksbayar(id_krs2);
            });

            table.on('click', '#bttranskrip', function() {
                $tr = $(this).closest('tr');
                var data = table.row($tr).data();
                $('#modal_transkrip').modal('show');
                var nim = $(this).data('id');

                tbtranskrip(nim);
            });

            function tbtranskrip(nim) {
                var tbtranskrip = $("#tbkhs").DataTable({
                    destroy: true,
                    // dom: 'Bfrtip',
                    // buttons: [
                    //     'copy', 'csv', 'excel'
                    // ],
                    // responsive: true,
                    // autoWidth: false,
                    pageLength: 10,
                    processing: true,
                    lengthChange: true,
                    info: false,
                    paging: false,
                    // searching: false,
                    // serverSide: true,
                    // stateSave: true,
                    // scrollX: true,
                    // orderable: false,
                    ajax: {
                        type: "GET",
                        url: "{{ config('setting.second_url') }}akademik/cek-transkrip-krs",
                        headers: {
                            "Authorization": 'Bearer ' + token,
                            "username": userlogin
                        },
                        data: {
                            nim: nim
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
                            data: 'smt_matakuliah',
                            className: "text-center"
                        },
                        {
                            data: 'kode_matakuliah'
                        },
                        {
                            data: 'nama_matakuliah'
                        },
                        {
                            data: 'sks_matakuliah',
                            className: "text-center"
                        },
                        {
                            data: 'nilai',
                            className: "text-center"
                        },
                        {
                            data: 'mutu_nilai',
                            visible: false
                        },
                        {
                            data: 'kum_sksmutu',
                            visible: false
                        }
                    ]
                });
                get_sks_ipk(nim);
            }


            function get_sks_ipk(nim) {
                $.ajax({
                    type: 'GET',
                    dataType: "json",
                    url: "{{ config('setting.second_url') }}mahasiswa/transkrip-nilai",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    data: {
                        nim: nim
                    },
                    success: function(data) {
                        var jml = data.length;
                        var totalsks = 0;
                        var bobot = 0;
                        var total_nilai = 0;

                        for (var i = 0; i < jml; i++) {
                            totalsks += data[i].sks_matakuliah;
                            total_nilai += data[i].kum_sksmutu;
                        }

                        $('#totalsks').html(totalsks + ' sks');
                        $('#nilai_ipk').html((total_nilai / totalsks).toFixed(2));
                    }
                });
            }


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
                        url: "{{ config('setting.second_url') }}akademik/modal-sks-ambil",
                        headers: {
                            "Authorization": 'Bearer ' + token,
                            "username": userlogin
                        },
                        data: {
                            id_krs: id
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
                            data: "nama_matakuliah",
                            orderable: false
                        },
                        {
                            data: "sks_matakuliah",
                            className: "text-center",
                            orderable: false
                        },
                        {
                            data: "smt_matakuliah",
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

            function tbsksbayar(id) {
                var tdetail = $('#tbsksbayar').DataTable({
                    bInfo: false,
                    destroy: true,
                    bPaginate: false,
                    bLengthChange: false,
                    bFilter: false,
                    // "rowHeight": 'auto',      
                    order: false,
                    ajax: {
                        type: "GET",
                        url: "{{ config('setting.second_url') }}akademik/modal-sks-ambil",
                        headers: {
                            "Authorization": 'Bearer ' + token,
                            "username": userlogin
                        },
                        data: {
                            id_krs: id
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
                            data: "nama_matakuliah",
                            orderable: false
                        },
                        {
                            data: "sks_matakuliah",
                            className: "text-center",
                            orderable: false
                        },
                        {
                            data: "smt_matakuliah",
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

            table.on('click', '.acc[data-id], .cancelacc[data-id]', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                var send_value = $(this).data('nilai');

                $.ajax({
                    url: "{{ config('setting.second_url') }}dekanat/ubahstatus-acckrs",
                    type: 'GET',
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    data: {
                        id_her: id,
                        value: send_value
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
            });

        });
    </script>
@stop
