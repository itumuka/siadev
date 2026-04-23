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
                    <input class="form-control" type="hidden" name="dosen_wali" id="dosen_wali"
                        value="{{ $session_dosen_wali }}">
                    <input class="form-control" type="hidden" name="id_dosen" id="id_dosen"
                        value="{{ $session_id_dosen }}">
                    <input class="form-control" type="hidden" name="nidn" id="nidn" value="{{ $session_nidn }}">
                    <input class="form-control" type="hidden" name="namadosen" id="namadosen"
                        value="{{ Session::get('nama') }}">
                    <input class="form-control" type="hidden" name="tahun" id="tahun" value="{{ $session_tahun }}">
                    <input class="form-control" type="hidden" name="semester" id="semester"
                        value="{{ $session_semester }}">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">ACC Kartu Rencana Studi Semester {{ $session_nama_tahunakademik }}</h3>
                    {{-- <h6 class="box-subtitle">Melihat Data KHS</h6> --}}
                </div>
                <!-- /.box-header -->
                <div class="box-body">
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
                                    <th>Valid ID</th>
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
            <canvas id="qrcodeCanvas"></canvas>
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
                                            <th>Matakuliah</th>
                                            <th>Hari</th>
                                            <th>Kelas</th>
                                            <th>Ruang</th>
                                            <th>Waktu</th>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        function cetak_krs(nim, tahun, semester) {

            $("#printff")

                .attr("src", "{{ url('akademik/cetak/cetakkrs') }}/" + nim.toString() + "/" + tahun + "/" + semester + "")
                .appendTo("body");
            return false;
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
                pageLength: 20,
                processing: true,
                lengthChange: true,
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
                    {
                        data: 'batas_sks',
                        className: 'text-center',
                    },
                    {
                        data: null,
                        className: 'text-center',
                        render: function(data, type, full, meta) {
                            return '<a href="javascript:void(0)" class="waves-effect waves-light btn btn-xs btn-outline btn-primary mb-5" data-id="' +
                                full.id_krs +
                                '" id="btsksambil" data-toggle="tooltip" data-original-title="total SKS diambil" title="total SKS diambil">' +
                                full.total_sks_ambil + '</a>';
                        }
                    },
                    {
                        data: null,
                        className: 'text-center',
                        render: function(data, type, full, meta) {
                            if (full.krs == 1) {
                                return '<a href="javascript:void(0)" class="waves-effect waves-light btn btn-xs btn-outline btn-primary mb-5" id="cetak_krs" data-toggle="tooltip" data-original-title="Cetak KRS" title="Cetak KRS" onclick="cetak_krs(`' +
                                    full.nim + '`,' + full.tahun + ',' + full.semester +
                                    ');"><i class="fa fa-print"></i></a>';
                            } else {
                                return '-'; // Tidak menampilkan tombol jika krs == 0
                            }
                        }
                    },
                    {
                        data: null,
                        className: 'text-center',
                        render: function(data, type, full, meta) {
                            return '<a href="javascript:void(0)" class="waves-effect waves-light btn btn-xs btn-outline btn-primary mb-5" data-id="' +
                                full.nim +
                                '" id="bttranskrip" title="Cek Transkrip"><i class="fa fa-file-text-o"></i></a>';
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
                        data: 'valid_id'
                    },
                    {
                        data: 'krs',
                        className: 'text-center',
                        render: function(data, type, full, meta) {
                            if (data == 1) {
                                return '<button class="btn btn-xs btn-danger cancelacc" data-id="' +
                                    full.id_heregistrasi +
                                    '" data-nim="' + full.nim +
                                    '" data-nilai="0" data-toggle="tooltip"  data-original-title="Edit" title="Batal Acc KRS">Batalkan</button>'
                            } else {
                                // Kalau total_sks_ambil = 0 → tombol disabled
                                if (full.total_sks_ambil == 0) {
                                    return '<button class="btn btn-xs btn-secondary" disabled ' +
                                        'title="Belum ambil KRS">Terima</button>';
                                } else {
                                    // Kalau ada SKS → tombol ACC normal
                                    return '<button class="btn btn-xs btn-success acc" data-id="' +
                                        full.id_heregistrasi +
                                        '" data-nim="' + full.nim +
                                        '" data-sks="' + full.total_sks_ambil + '" ' + 
                                        'data-nilai="1" data-toggle="tooltip"  data-original-title="Edit" title="Acc KRS">Terima</button>';
                                }
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
                        url: "{{ config('setting.second_url') }}mahasiswa/transkrip-nilai",
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
                            data: 'mutu',
                            visible: false
                        },
                        {
                            data: 'kum_sksmutu',
                            visible: false
                        }
                    ],
                    "footerCallback": function(row, data, start, end, display) {
                        var api = this.api();
                        var intVal = function(i) {
                            return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
                        };
                        var totalSks = api.column(4).data().reduce(function(a, b) { return intVal(a) + intVal(b); }, 0);
                        var totalKum = api.column(7).data().reduce(function(a, b) { return intVal(a) + intVal(b); }, 0);
                        $('#totalsks').html(totalSks + ' sks');
                        $('#nilai_ipk').html(totalSks > 0 ? (totalKum / totalSks).toFixed(2) : '0.00');
                    }
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
                    dataSrc: function (json) {
                        return json;
                    }
                },
                columns: [
                    {
                        data: null,
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: null,
                        render: function (data, type, row, meta) {
                            return `
                                <strong>${row.nama_matakuliah}</strong><br>
                                Semester: ${row.smt_matakuliah} | SKS: ${row.sks_matakuliah}
                            `;
                        }
                    },
                    { data: 'hari' },
                    { data: 'nama_kelas' },
                    { data: 'kode_ruang' },
                    {
                        data: null,
                        render: function (data, type, row, meta) {
                            // Ambil jam dan menit saja (xx:xx)
                            let jamMulai = row.jam_mulai ? row.jam_mulai.substring(0,5) : '';
                            let jamSelesai = row.jam_selesai ? row.jam_selesai.substring(0,5) : '';
                            return `${jamMulai} - ${jamSelesai}`;
                        }
                    }
                ],
                footerCallback: function (row, data, start, end, display) {
                    var api = this.api();
                    let total = 0;
        
                    // Loop semua baris data untuk menjumlahkan SKS
                    data.forEach(function (rowData) {
                        total += parseInt(rowData.sks_matakuliah) || 0;
                    });
        
                    // Update footer di kolom kedua (atau kolom manapun yang diinginkan)
                    $(api.column(1).footer()).html(`Total SKS: <strong>${total}</strong>`);
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


            // table.on('click', '.acc[data-id], .cancelacc[data-id]', function (e) {
            //     e.preventDefault();
            //     var id = $(this).data('id');
            //     var nim = $(this).data('nim');
            //     var send_value = $(this).data('nilai');
            
            //     if (!id) {
            //         showToastr('error', 'Error!', 'ID tidak valid.');
            //         return;
            //     }
            
            //     if ($(this).hasClass('acc')) {
            //         cetakqrcode(id, nim)
            //             .then(() => {
            //                 console.log("QR Code berhasil dibuat, lanjut ubah status.");
            //                 ubahStatusKRS(id, send_value);
            //             })
            //             .catch(error => {
            //                 console.log(error);
            //                 showToastr('error', 'Error!', 'Gagal membuat QR Code.');
            //             });
            //     } else {
            //         ubahStatusKRS(id, send_value);
            //     }
            // });

            // table.on('click', '.acc[data-id], .cancelacc[data-id]', async function (e) {
            //     e.preventDefault();
            //     var $btn = $(this);
            //     var originalHtml = $btn.html();
            //     var id = $btn.data('id');
            //     var nim = $btn.data('nim');
            //     var send_value = $btn.data('nilai');
            
            //     if (!id) {
            //         showToastr('error', 'Error!', 'ID tidak valid.');
            //         return;
            //     }
            
            //     $btn.html('<i class="fa fa-spinner"></i> Processing...').prop('disabled', true);
            
            //     try {
            //         if ($btn.hasClass('acc')) {
            //             await cetakqrcode(id, nim);  // Gunakan await agar proses dijalankan sebelum lanjut
            //             console.log("QR Code berhasil dibuat, lanjut ubah status.");
            //         }
            
            //         await ubahStatusKRS(id, send_value);  // Gunakan await juga di sini
            //         console.log("Status berhasil diubah.");
            //     } catch (error) {
            //         console.log(error);
            //         showToastr('error', 'Error!', 'Terjadi kesalahan.');
            //     } finally {
            //         $btn.html(originalHtml).prop('disabled', false); // Pastikan tombol kembali normal
            //     }
            // });

            table.on('click', '.acc[data-id], .cancelacc[data-id]', async function (e) {
                e.preventDefault();
                var $btn = $(this);
                var originalHtml = $btn.html();
                var id = $btn.data('id');
                var nim = $btn.data('nim');
                var send_value = $btn.data('nilai');
                var totalSks = $btn.data('sks') || 0; // default 0 kalau undefined
                
                if (!id) {
                    showToastr('error', 'Error!', 'ID tidak valid.');
                    return;
                }
                // ✅ Cek jika tombol acc tapi total_sks_ambil masih 0
                if ($btn.hasClass('acc') && totalSks == 0) {
                    showToastr('warning', 'Peringatan!', 'Belum ambil KRS, tidak bisa Acc.');
                    return;
                }
                
                $btn.html('<i class="fa fa-spinner fa-spin"></i> Processing...').prop('disabled', true);
            
                try {
                    if ($btn.hasClass('acc')) {
                        await cetakqrcode(id, nim);
                        console.log("QR Code berhasil dibuat, lanjut ubah status.");
                    }
            
                    await ubahStatusKRS(id, send_value);
                    console.log("Status berhasil diubah.");
            
                    //  Ganti tombol setelah berhasil
                    if ($btn.hasClass('acc')) {
                        $btn.removeClass('btn-success acc')
                            .addClass('btn-danger cancelacc')
                            .text('Batalkan');
                        $btn.attr('data-nilai', '0'); // Ubah nilai untuk membatalkan
                    } else {
                        $btn.removeClass('btn-danger cancelacc')
                            .addClass('btn-success acc')
                            .text('Terima');
                        $btn.attr('data-nilai', '1'); // Ubah nilai untuk meng-acc lagi
                    }
            
                } catch (error) {
                    console.log(error);
                    showToastr('error', 'Error!', 'Terjadi kesalahan.');
                } finally {
                    $btn.prop('disabled', false); // Pastikan tombol bisa diklik lagi
                }
            });


            // Fungsi terpisah untuk ubah status
            function ubahStatusKRS(id, send_value) {
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
                    success: function (data) {
                        if (data.error) {
                            showToastr('error', 'Error!', data.error);
                        } else if (data.success) {
                            showToastr('success', 'Success!', data.success);
                            table.ajax.reload();
                        }
                    }
                });
            }

            function generateValidId(length) {
                const characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
                let validId = '';
                for (let i = 0; i < length; i++) {
                    const randomIndex = Math.floor(Math.random() * characters.length);
                    validId += characters[randomIndex];
                }
                return validId;
            }
            // Fungsi untuk mendapatkan waktu dengan format "dd-mm-yyyy hh:mm:ss WIB"
            function getFormattedTime() {
                const now = new Date();
                const day = String(now.getDate()).padStart(2, '0');
                const month = String(now.getMonth() + 1).padStart(2, '0');
                const year = now.getFullYear();
                const hours = String(now.getHours()).padStart(2, '0');
                const minutes = String(now.getMinutes()).padStart(2, '0');
                const seconds = String(now.getSeconds()).padStart(2, '0');
                return `${day}-${month}-${year} ${hours}:${minutes}:${seconds} WIB`;
            }
            function cetakqrcode(id, nim) {

                return new Promise((resolve, reject) => {
                    const qrDiv = document.createElement('div'); // Gunakan elemen <div>
                    const validId = generateValidId(12); // Setiap QR Code akan memiliki valid_id yang berbeda
                    const signedDate = getFormattedTime(); // Ambil tanggal dan waktu saat ini
                    const label = "ACC KRS MAHASISWA";
                    const nidndosen = $('#nidn').val();
                    const namadosen = $('#namadosen').val();
                    
                    console.log("Valid ID yang dikirim ke server:", validId);
                    
                    // const qrText =
                    //     `[valid_id=${validId}]\n[${label}]\n[nama=${namadosen}]\n[nidn=${nidndosen}]\n[nim=${nim}]\n[signed=${signedDate}]`;
                    let qrText = `[valid_id=${validId}]\n[${label}]\n[nama=${namadosen}]\n[nidn=${nidndosen}]\n[nim=${nim}]\n[signed=${signedDate}]`;
                    qrText = qrText.normalize("NFKC").replace(/[^\x00-\x7F]/g, ""); // Remove hidden Unicode

                    try {
                        const qrCode = new QRCode(qrDiv, {
                            text: qrText,
                            width: 200,
                            height: 200,
                            colorDark: "#0000FF", // Warna teks QR Code
                            colorLight: "#FFFFFF" // Warna latar belakang QR Code
                        });
                        setTimeout(() => {
                            const qrCanvas = qrDiv.querySelector(
                                'canvas'); // Ambil elemen canvas dari dalam <div>
                            if (!qrCanvas) {
                                reject(
                                    `Gagal membuat QR Code untuk ${label} (canvas tidak ditemukan).`
                                );
                                return;
                            }
                            
	
                            qrCanvas.toBlob((blob) => {
                                if (!blob) {
                                    reject(
                                        `Gagal membuat QR Code untuk ${label} (toBlob menghasilkan null).`
                                    );
                                    return;
                                }
                                
	
                                const formData = new FormData();
                                formData.append('file', blob,
                                    `${nidndosen}-${id}_${label.replace(/\s/g, '_')}.png`
                                );
                                formData.append('id', id);
                                formData.append('nidn', nidndosen);
                                formData.append('namafile',
                                    `${nidndosen}-${id}_${label.replace(/\s/g, '_')}.png`
                                );
                                
	
                                // Kirim data ke endpoint pertama
                                console.log(formData);
                                $.ajax({
                                    type: "POST",
                                    url: "{{ url('akademik/qrcodedowalacc') }}",
                                    headers: {
                                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]')
                                            .attr('content') // CSRF Token Laravel
                                    },
                                    data: formData,
                                    processData: false,
                                    contentType: false,
                                    success: function(response) {
                                        console.log(
                                            "Response dari qrcodedowalacc:",
                                            response); // Debugging
                                        if (response.success) {
                                            // Kirim data ke endpoint kedua
                                            // $.ajax({
                                            //     type: "POST",
                                            //     url: "{{ config('setting.second_url') }}akademik/saveqrcodeacc",
                                            //     headers: {
                                            //         "Authorization": 'Bearer ' + token,
                                            //         "username": userlogin
                                            //     },
                                            //     data: {
                                            //         nidn: nidndosen,
                                            //         id: id,
                                            //         valid_id: validId
                                            //     },
                                            //     success: function(
                                            //         response2) {
                                            //         if (response2
                                            //             .success) {
                                            //             resolve(
                                            //                 `QR Code untuk ${nidndosen} (${label}) berhasil disimpan.`
                                            //             );
                                            //         } else {
                                            //             reject(response2
                                            //                 .error ||
                                            //                 'Unknown error (saveqrcode).'
                                            //             );
                                            //         }
                                            //     },
                                            //     error: function(xhr,
                                            //         status, error) {
                                            //         reject(error ||
                                            //             'Request error (saveqrcode).'
                                            //         );
                                            //     }
                                            // });
                                            
                                            $.ajax({
                                                type: "POST",
                                                url: "{{ config('setting.second_url') }}akademik/saveqrcodeacc",
                                                headers: {
                                                    "Authorization": 'Bearer ' + token,
                                                    "username": userlogin
                                                },
                                                data: {
                                                    nidn: nidndosen,
                                                    id: id,
                                                    valid_id: validId
                                                },
                                                success: function(response2) {
                                                    console.log("Response dari saveqrcodeacc:", response2); // Cek response
                                                    if (response2==1) { // Sekarang bisa dicek dengan benar!
                                                        resolve(`QR Code untuk ${nidndosen} (${label}) berhasil disimpan.`);
                                                    } else {
                                                        reject(response2.error || 'Unknown error (saveqrcode).');
                                                    }
                                                },
                                                error: function(xhr, status, error) {
                                                    reject(error || 'Request error (saveqrcode).');
                                                }
                                            });


                                        } else {
                                            reject(response.error ||
                                                'Unknown error (qrcodedosen).'
                                            );
                                        }
                                    },
                                    error: function(xhr, status, error) {
                                        reject(error ||
                                            'Request error (qrcodedosen).');
                                    }
                                });
                                
                                
                                
                            });
                        }, 100);
                    } catch (err) {
                        reject(`QRCode is not a constructor atau library tidak ditemukan untuk ${label}.`);
                    }
                });
            }
        });
    </script>
@stop
