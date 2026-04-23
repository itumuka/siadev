@extends('layout')

@section('css')
    <style>
        th,
        td {
            white-space: nowrap;
        }

        .text-center {
            text-align: center;
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
                                {{-- <li class="breadcrumb-item active" aria-current="page">{{ $child_breadcrumb }}</li> --}}
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
                    <h6 class="box-subtitle">Melihat Mata Kuliah Diampu</h6>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <div class="box">
                        <div class="box-body ribbon-box bg-primary-light">
                            <div class="ribbon ribbon-info">informasi</div>
                            <p class="mb-0">Presensi Mahasiswa semester {{ $session_nama_tahunakademik }}</p>
                        </div> <!-- end box-body-->

                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <select class="form-control" name="programstudi" id="programstudi">
                            </select>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <input class="form-control" type="hidden" name="tahun" id="tahun"
                            value="{{ $session_tahun }}">
                        <input class="form-control" type="hidden" name="semester" id="semester"
                            value="{{ $session_semester }}">
                        <input class="form-control" type="hidden" name="kode_prodi" id="kode_prodi" value="">
                        <input class="form-control" type="hidden" name="tipe" id="tipe" value="0">
                        <table id="tbmakulpenawaran" class="table table-hover table-sm" width="100%">
                            <thead class="bg-dark">
                                <tr>
                                    <th>Aksi</th>
                                    <th>No</th>
                                    <th>Matakuliah</th>
                                    <th>Hari</th>
                                    <th>Kelas</th>
                                    <th>Ruang</th>
                                    <th>Waktu</th>
                                    <th>Smt</th>
                                    <th>Prodi</th>
                                    <th>Kapasitas</th>
                                    <th>Peserta</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                </div>
                <iframe id="printff" name="printff" style="display: none;"></iframe>
            </div>

            <div class="modal fade" id="modal_list" data-backdrop="static" tabindex="-1" role="dialog"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Verifikasi List Presensi <Span id="nama_mk_verifikasi"></Span></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table id="tbhitung" class="table table-bordered table-sm table-striped" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Pertemuan</th>
                                            <th>Hadir</th>
                                            <th>Sakit</th>
                                            <th>Izin</th>
                                            <th>Alpha</th>
                                            <th>Total</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
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

            <div class="modal fade" id="modal_lihat_mhs" data-backdrop="static" tabindex="-1" role="dialog"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Daftar Mahasiswa Presensi</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table id="tbmhs" class="table table-bordered table-sm table-striped" width="100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>NIM</th>
                                            <th>Nama Mahasiswa</th>
                                        </tr>
                                    </thead>
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

            <div class="modal fade" id="modal_edit_presensi" data-backdrop="static" tabindex="-1" role="dialog"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <form id="form_edit_presensi" method="POST">
                    <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">

                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Edit Presensi Mahasiswa </h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                            </div>

                            <div class="modal-body">
                                <input class="form-control" type="hidden" name="id_presensi" id="id_presensi">
                                <div class="table-responsive">
                                    <table id="tblistmhs" class="table table-hover table-sm" width="100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>NIM</th>
                                                <th>Nama</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <div class="modal-footer text-right">
                                <button type="button" class="btn btn-rounded btn-warning btn-outline mr-1"
                                    data-dismiss="modal">
                                    <i class="fa fa-times"></i> Close
                                </button>
                                <button type="submit" class="btn btn-rounded btn-primary btn-outline"
                                    id="bteditpresensi">
                                    <i class="ti-save-alt"></i> Save
                                </button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                </form>
                <!-- /.modal-dialog -->
            </div>

            <div class="modal fade" id="modal_export">
                <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">

                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Rekap Presensi Mahasiswa </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>

                        <div class="modal-body">
                            <div class="table-responsive">
                                <table id="tbexport" class="table table-hover table-sm" cellpadding="0" width="100%"
                                    style="padding: 2px 4px;font-size: 0.8em;">
                                    <thead style="text-align: center" class="bg-secondary">
                                        <tr>
                                            <th rowspan="2">NIM</th>
                                            <th rowspan="2">Nama</th>
                                            <th colspan="16">Pertemuan</th>
                                            <th rowspan="2">Persentase</th>
                                        </tr>
                                        <tr>
                                            <th>i</th>
                                            <th>ii</th>
                                            <th>iii</th>
                                            <th>iv</th>
                                            <th>v</th>
                                            <th>vi</th>
                                            <th>vii</th>
                                            <th>viii</th>
                                            <th>ix</th>
                                            <th>x</th>
                                            <th>xi</th>
                                            <th>xii</th>
                                            <th>xiii</th>
                                            <th>xiv</th>
                                            <th>xv</th>
                                            <th>xvi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <div class="modal-footer text-right">
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

            <div class="modal fade" id="modal_presensi">
                <form id="form_save_presensi" method="POST">
                    <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">

                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">List Mahasiswa Mata Kuliah <Span id="nama_mk"></Span></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                            </div>

                            <div class="modal-body">
                                <input type="hidden" class="form-control" name="id_kls_presensi" id="id_kls_presensi">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Pilih BA Perkuliahan</label>
                                        <select class="form-control" name="berita_acara" id="selectba">
                                        </select>
                                        <span class="text-danger font-italic">* Harus dipilih dan/atau Isi BA Terlebih
                                            dahulu jika tidak tampil</span>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table id="tbtambah_presensi" class="table table-hover table-sm" width="100%">
                                        <thead class="bg-secondary">
                                            <tr>
                                                <th>No</th>
                                                <th>NIM</th>
                                                <th>Nama</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <div class="modal-footer text-right">
                                <button type="button" class="btn btn-rounded btn-warning btn-outline mr-1"
                                    data-dismiss="modal">
                                    <i class="fa fa-times"></i> Close
                                </button>
                                <button type="submit" class="btn btn-rounded btn-primary btn-outline"
                                    id="btsavepresensi">
                                    <i class="ti-save-alt"></i> Save
                                </button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                </form>
                <!-- /.modal-dialog -->
            </div>

        </section>
        <!-- /.content -->
    </div>
@endsection
@section('script-master')
    <script type="text/javascript">
        function cetakpresensi(id_kelas) {
            var link = ""
            $("#printff")
                .attr("src", "{{ url('akademik/cetak/cetakpresensi') }}/" + id_kelas + "")
                .appendTo("body");
        }

        $(document).ready(function() {
            var token = "{{ Session::get('token') }}";
            var userlogin = "{{ Session::get('username') }}";

            // var kode_prodi = $('#kode_prodi').val();
            var tahun = $('#tahun').val();
            var semester = $('#semester').val();
            var tipe = $('#tipe').val();

            programstudi();

            function programstudi() {
                $.ajax({
                    type: 'GET',
                    url: "{{ config('setting.second_url') }}akademik/tampilprogramstudi",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    success: function(result) {
                        var jml = result.length;
                        var s = '<option value="">Program Studi</option>';
                        for (i = 0; i < jml; i++) {
                            s = s + '<option value="' + result[i].nama_program_studi +
                                '"> ' + result[i]
                                .nama_program_studi + '</option>';
                        }
                        // console.log(result);
                        $('#programstudi').html(s);
                        var nama_program_studi = $('#programstudi').val();
                        tbpresensi(nama_program_studi);
                    }
                })
            }
            $('#programstudi').on('change', function(event) {
                var nama_program_studi = $('#programstudi').val();
                tbpresensi(nama_program_studi);

            });
            var table;

            function tbpresensi(nama_program_studi) {
                table = $("#tbmakulpenawaran").DataTable({
                    destroy: true,
                    dom: 'Bfrtip',
                    buttons: [
                        'copy', 'csv', 'excel'
                    ],
                    // responsive: true,
                    // autoWidth: false,
                    pageLength: 10,
                    processing: true,
                    lengthChange: true,
                    // searching: false,
                    // serverSide: true,
                    // stateSave: true,
                    // scrollX: true,
                    orderable: false,
                    // scrollX: true,
                    // scrollY: true,
                    // order: [[ 1, 'asc' ]],
                    // fixedColumns: {
                    //   leftColumns: 2
                    // },
                    ajax: {
                        type: "GET",
                        url: "{{ config('setting.second_url') }}akademik/makulpenawaran",
                        headers: {
                            "Authorization": 'Bearer ' + token,
                            "username": userlogin
                        },
                        data: {
                            tahun: tahun,
                            semester: semester,
                            nama_program_studi: nama_program_studi,
                            tipe: tipe
                        },
                        dataSrc: function(json) {
                            return json;
                        }
                    },
                    columns: [{
                            data: null,
                            className: 'text-center',
                            render: function(data, type, full, meta) {
                                return '<a href="javascript:void(0)" class="waves-effect waves-light btn btn-xs btn-outline btn-success" id="bt_modal_presensi" data-id="' +
                                    full.id_kelas + '" data-nama="' + full.nama_matakuliah +
                                    '" data-original-title="Tambah Presensi Mahasiswa" data-toggle="tooltip" title="Tambah Presensi Mahasiswa"><i class="fa fa-user"></i></a> | <a href="javascript:void(0)" class="waves-effect waves-light btn btn-xs btn-outline btn-warning" id="bt_modal_export" data-id="' +
                                    full.id_kelas +
                                    '"  title="Presensi Satu Semester"><i class="fa fa-list" aria-hidden="true"></i></a>';

                                //button add presensi
                                //  
                            }
                        },
                        {
                            data: null,
                            render: function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }
                        },
                        {
                            data: 'nama_matakuliah'
                        },
                        {
                            data: 'hari'
                        },
                        {
                            data: 'nama_kelas'
                        },
                        {
                            data: 'kode_ruang'
                        },
                        {
                            data: 'waktu'
                        },
                        {
                            data: 'smt_matakuliah'
                        },
                        {
                            data: 'nama_program_studi'
                        },
                        {
                            data: 'kapasitas_ruang',
                            className: 'text-center'
                        },
                        {
                            data: 'jumlah_peserta',
                            className: 'text-center'
                        },

                    ],
                    order: []
                });

                table.on('click', '#bt_modal_presensi', function() {
                    $tr = $(this).closest('tr');
                    var data = table.row($tr).data();
                    var id_kelas = $(this).data('id');
                    var nama = $(this).data('nama');
                    $('#nama_mk').html(nama);
                    $('#modal_presensi').modal('show');
                    $('#id_kls_presensi').val(id_kelas);
                    // autopertemuanpresensi(id_kelas);
                    table_add_presensi(id_kelas);
                    select_ba(id_kelas);
                });
                table.on('click', '#bt_modal_import', function() {
                    $tr = $(this).closest('tr');
                    var data = table.row($tr).data();
                    $('#modal_import').modal('show');
                    var id_kelas = $(this).data('id');
                    $("#kelas_id").val(id_kelas);
                    autopertemuanpresensi(id_kelas);
                });

                table.on('click', '#bt_modal_export', function() {
                    $tr = $(this).closest('tr');
                    var data = table.row($tr).data();
                    $('#modal_export').modal('show');
                    var id_kelas = $(this).data('id');
                    presensipermakul(id_kelas)
                });
            }

            function table_add_presensi(id) {
                var tdetail = $('#tbtambah_presensi').DataTable({
                    bInfo: false,
                    bPaginate: false,
                    bLengthChange: false,
                    bFilter: false,
                    destroy: true,
                    order: false,
                    ajax: {
                        type: "GET",
                        url: "{{ config('setting.second_url') }}akademik/presensi-mhs",
                        headers: {
                            "Authorization": 'Bearer ' + token,
                            "username": userlogin
                        },
                        data: {
                            id_kelas: id
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
                            data: "nim"
                        },
                        {
                            data: "nama_mahasiswa"
                        },
                        {
                            data: null,
                            name: 'hadir',
                            className: 'text-center',
                            render: function(data, type, full, meta) {
                                return '<input class="form-control" type="hidden" name="nim[]" id="nim" value="' +
                                    full.nim +
                                    '" ><select name="status[]" class="form-control" ><option value="Hadir" selected>Hadir</option><option value="Sakit">Sakit</option><option value="Ijin">Ijin</option><option value="Alpha">Alpha</option></select>';
                            }
                        },
                    ],
                });
            }

            function select_ba(id) {
                $.ajax({
                    type: 'GET',
                    url: "{{ config('setting.second_url') }}akademik/list-ba",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    data: {
                        id_kelas: id
                    },
                    success: function(result) {
                        var jml = result.length;
                        var s = '<option value="">Pilih Salah Satu</option>';
                        for (i = 0; i < jml; i++) {
                            s = s + '<option value="' + result[i].id +
                                '"> Pertemuan  ' + result[i]
                                .pertemuan_ke + ' pada ' + result[i]
                                .tgl_indo + '</option>';
                        }
                        // console.log(result);
                        $('#selectba').html(s);
                    }
                })
            }

            //save
            $('#form_save_presensi').on('submit', function(event) {
                event.preventDefault();
                var form_data = $(this).serialize();
                $.ajax({
                    url: "{{ config('setting.second_url') }}akademik/simpan-presensi",
                    method: "POST",
                    data: form_data,
                    dataType: "json",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    beforeSend: function() {
                        $("#btsavepresensi").prop('disabled', true);
                    },
                    success: function(data) {
                        if (data.error) {
                            showToastr('error', 'Error!', data.error);
                            table.ajax.reload();
                            $("#btsavepresensi").prop('disabled', false);
                        } else if (data.success) {
                            $('#modal_presensi').modal('hide');
                            showToastr('success', 'Success!', data.success);
                            table.ajax.reload();
                            $('#form_save_presensi')[0].reset();
                            $("#btsavepresensi").prop('disabled', false);
                        }
                    }
                })
            });





            function presensipermakul(id) {
                var tdetail = $('#tbexport').DataTable({
                    bInfo: false,
                    bPaginate: false,
                    bLengthChange: false,
                    bFilter: false,
                    destroy: true,
                    "targets": 'no-sort',
                    "bSort": false,
                    "order": [],
                    ajax: {
                        type: "GET",
                        url: "{{ config('setting.second_url') }}akademik/presensi-permakul",
                        headers: {
                            "Authorization": 'Bearer ' + token,
                            "username": userlogin
                        },
                        data: {
                            id_kelas: id
                        },
                        dataSrc: function(json) {
                            return json;
                        }
                    },
                    columns: [{
                            data: "nim",
                            className: "text-center" // Rata tengah
                        },
                        {
                            data: "nama_mahasiswa",
                        },
                        {
                            data: "i",
                            className: "text-center" // Rata tengah
                        },
                        {
                            data: "ii",
                            className: "text-center" // Rata tengah
                        },
                        {
                            data: "iii",
                            className: "text-center" // Rata tengah
                        },
                        {
                            data: "iv",
                            className: "text-center" // Rata tengah
                        },
                        {
                            data: "v",
                            className: "text-center" // Rata tengah
                        },
                        {
                            data: "vi",
                            className: "text-center" // Rata tengah
                        },
                        {
                            data: "vii",
                            className: "text-center" // Rata tengah
                        },
                        {
                            data: "viii",
                            className: "text-center" // Rata tengah
                        },
                        {
                            data: "ix",
                            className: "text-center" // Rata tengah
                        },
                        {
                            data: "x",
                            className: "text-center" // Rata tengah
                        },
                        {
                            data: "xi",
                            className: "text-center" // Rata tengah
                        },
                        {
                            data: "xii",
                            className: "text-center" // Rata tengah
                        },
                        {
                            data: "xiii",
                            className: "text-center" // Rata tengah
                        },
                        {
                            data: "xiv",
                            className: "text-center" // Rata tengah
                        },
                        {
                            data: "xv",
                            className: "text-center" // Rata tengah
                        },
                        {
                            data: "xvi",
                            className: "text-center" // Rata tengah
                        },
                        {
                            data: null,
                            className: "text-center", // Rata tengah
                            render: function(data, type, full, meta) {
                                var jmlmsk = 0;
                                if (full.i == "H") jmlmsk++;
                                if (full.ii == "H") jmlmsk++;
                                if (full.iii == "H") jmlmsk++;
                                if (full.iv == "H") jmlmsk++;
                                if (full.v == "H") jmlmsk++;
                                if (full.vi == "H") jmlmsk++;
                                if (full.vii == "H") jmlmsk++;
                                if (full.viii == "H") jmlmsk++;
                                if (full.ix == "H") jmlmsk++;
                                if (full.x == "H") jmlmsk++;
                                if (full.xi == "H") jmlmsk++;
                                if (full.xii == "H") jmlmsk++;
                                if (full.xiii == "H") jmlmsk++;
                                if (full.xiv == "H") jmlmsk++;
                                if (full.xv == "H") jmlmsk++;
                                if (full.xvi == "H") jmlmsk++;

                                var persene = ((jmlmsk / 14) * 100);
                                return persene.toFixed(0) + ' %';
                            }
                        },
                    ],

                });
            }



            $("#export_template_presensi").on('click', function() {
                var id_kelas = $("#kelas_id").val();
                var query = {
                    id_kelas: id_kelas
                }
                var url = "{{ config('setting.second_url') }}akademik/template-presensi?" + $.param(
                    query)

                window.location = url;
            });

            function autopertemuanpresensi(id) {
                $.ajax({
                    url: "{{ config('setting.second_url') }}akademik/autopertemuan-presensi-mhs",
                    method: "POST",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    data: {
                        id_kelas: id
                    },
                    dataType: 'json',
                    success: function(result) {
                        $("#pertemuan_presensi").val(result.urut);
                    }
                });
            };
            var tabelhitungpresensi;

            function hitungpresensi(id) {
                tabelhitungpresensi = $('#tbhitung').DataTable({
                    bInfo: false,
                    bPaginate: false,
                    bLengthChange: false,
                    bFilter: false,
                    destroy: true,
                    order: false,
                    ajax: {
                        type: "POST",
                        url: "{{ config('setting.second_url') }}akademik/data-hitungpresensi",
                        headers: {
                            "Authorization": 'Bearer ' + token,
                            "username": userlogin
                        },
                        data: {
                            id_kelas: id
                        },
                        dataSrc: function(json) {
                            return json;
                        }
                    },
                    columns: [{
                            data: "tgl",
                            className: 'text-center'
                        },
                        {
                            data: "pertemuan",
                            className: 'text-center'
                        },
                        {
                            data: null,
                            className: 'text-center',
                            render: function(data, type, full, meta) {
                                var hadir = (full.hadir == null || full.hadir == 0) ? "0" : full
                                    .hadir.split("#").length;
                                return '<a href="javascript:void(0)" class="text-info mr-10" id="btlihathadir" data-mhs="' +
                                    full.hadir +
                                    '" data-toggle="tooltip" title="Lihat Mahasiswa">' + hadir +
                                    '</a>'
                            }
                        },
                        {
                            data: null,
                            className: 'text-center',
                            render: function(data, type, full, meta) {
                                var sakit = (full.sakit == null || full.sakit == 0) ? "0" : full
                                    .sakit.split("#").length;
                                return '<a href="javascript:void(0)" class="text-info mr-10" id="btlihatsakit" data-mhs="' +
                                    full.sakit +
                                    '" data-toggle="tooltip" title="Lihat Mahasiswa">' + sakit +
                                    '</a>'
                            }
                        },
                        {
                            data: null,
                            className: 'text-center',
                            render: function(data, type, full, meta) {
                                var ijin = (full.ijin == null || full.ijin == 0) ? "0" : full.ijin
                                    .split("#").length;
                                return '<a href="javascript:void(0)" class="text-info mr-10" id="btlihatijin" data-mhs="' +
                                    full.ijin + '" data-toggle="tooltip" title="Lihat Mahasiswa">' +
                                    ijin + '</a>'
                            }
                        },
                        {
                            data: null,
                            className: 'text-center',
                            render: function(data, type, full, meta) {
                                var alpha = (full.alpha == null || full.alpha == 0) ? "0" : full
                                    .alpha.split("#").length;
                                return '<a href="javascript:void(0)" class="text-info mr-10" id="btlihatalpha" data-mhs="' +
                                    full.alpha +
                                    '" data-toggle="tooltip" title="Lihat Mahasiswa">' + alpha +
                                    '</a>'
                            }
                        },
                        {
                            data: null,
                            className: 'text-center',
                            render: function(data, type, full, meta) {
                                var alpha = (full.alpha == null || full.alpha == 0) ? "0" : full
                                    .alpha.split("#").length;
                                var ijin = (full.ijin == null || full.ijin == 0) ? "0" : full.ijin
                                    .split("#").length;
                                var sakit = (full.sakit == null || full.sakit == 0) ? "0" : full
                                    .sakit.split("#").length;
                                var hadir = (full.hadir == null || full.hadir == 0) ? "0" : full
                                    .hadir.split("#").length;
                                var total = parseInt(hadir) + parseInt(ijin) + parseInt(sakit) +
                                    parseInt(alpha);
                                return '<a href="javascript:void(0)" class="text-info mr-10" data-mhs="' +
                                    full.alpha +
                                    '" data-toggle="tooltip" title="Lihat Mahasiswa">' + total +
                                    '</a>'
                            }
                        },
                        {
                            data: null,
                            className: 'text-center',
                            render: function(data, type, full, meta) {
                                return '<a href="#" class="waves-effect waves-light btn btn-xs btn-outline btn-info" id="btedit_presensi" data-id="' +
                                    full.id_kelas + '" data-id_presensi="' + full.id +
                                    '" data-pt="' + full.pertemuan +
                                    '" title="Verifikasi Presensi Pertemuan ini"><i class="fa fa-check-square-o" aria-hidden="true"></i></a> | <a href="javascript:void(0)" class="waves-effect waves-light btn btn-xs btn-outline btn-danger" id="bthps_presensi" data-id="' +
                                    full.id +
                                    '" title="Hapus Presensi"><i class="fa fa-trash-o"></i></a>';
                            }
                        },

                    ],
                });


                tabelhitungpresensi.on('click', '#btlihathadir,#btlihatsakit,#btlihatijin,#btlihatalpha',
                    function() {
                        $tr = $(this).closest('tr');
                        // var data = tabelhitungpresensi.row($tr).data();
                        $('#modal_lihat_mhs').modal('show');
                        var id = $(this).data('id');
                        var mhs = $(this).data('mhs');
                        tbcekmhspresensi(mhs);
                    });

                tabelhitungpresensi.on('click', '#btedit_presensi', function() {
                    $tr = $(this).closest('tr');
                    var data = tabelhitungpresensi.row($tr).data();
                    var id = $(this).data('id');
                    console.log(id);
                    var id_presensi = $(this).data('id_presensi');
                    var pt = $(this).data('pt');
                    // var id_presensi = data['id'];
                    $('#modal_edit_presensi').modal('show');
                    $('#id_presensi').val(id_presensi);

                    tabellistpresensi(id, pt);
                });



                tabelhitungpresensi.on('click', '#bthps_presensi', function(e) {
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
                                url: "{{ config('setting.second_url') }}akademik/hapus-presensi",
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
                                        showToastr('success', 'Success!', data
                                            .berhasil);
                                        tabelhitungpresensi.ajax.reload();
                                    }
                                }
                            })
                        } else {
                            swal("Cancelled", "Data kamu aman! :)", "error");
                        }
                    });
                });

            }


            table.on('click', '#bt_modal_list', function() {
                $tr = $(this).closest('tr');
                var data = table.row($tr).data();
                $('#modal_list').modal('show');
                var id_kelas = $(this).data('id');
                var nama = $(this).data('nama');
                $('#nama_mk_verifikasi').html(nama);
                hitungpresensi(id_kelas);
            });

            function tabellistpresensi(id, pt) {
                var teditpresensi = $('#tblistmhs').DataTable({
                    bInfo: false,
                    bPaginate: false,
                    bLengthChange: false,
                    bFilter: false,
                    destroy: true,
                    // order: true,
                    ordering: true,
                    ajax: {
                        type: "GET",
                        url: "{{ config('setting.second_url') }}akademik/presensi-mhs",
                        headers: {
                            "Authorization": 'Bearer ' + token,
                            "username": userlogin
                        },
                        data: {
                            id_kelas: id,
                            pertemuan: pt
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
                            data: "nim"
                        },
                        {
                            data: "nama_mahasiswa"
                        },
                        {
                            data: null,
                            name: 'hadir',
                            className: 'text-center',
                            render: function(data, type, full, meta) {
                                var hadirs = "";
                                var sakits = "";
                                var ijins = "";
                                var alphas = "";
                                if (full.hadir == '1') {
                                    hadirs = "selected";
                                } else if (full.sakit == '1') {
                                    sakits = "selected";
                                } else if (full.ijin == '1') {
                                    ijins = "selected";
                                } else {
                                    alphas = "selected";
                                }
                                return '<input class="form-control" type="hidden" name="nim[]" id="nim" value="' +
                                    full.nim +
                                    '" ><select name="status[]" class="form-control" ><option value="Alpha" ' +
                                    alphas +
                                    '>Alpha</option><option value="Hadir" ' +
                                    hadirs + '>Hadir</option><option value="Sakit" ' + sakits +
                                    '>Sakit</option><option value="Ijin" ' + ijins +
                                    '>Ijin</option></select>';
                            }
                        },
                    ],
                });
            }
            $('#form_edit_presensi').on('submit', function(event) {
                event.preventDefault();
                var form_data = $(this).serialize();
                $.ajax({
                    url: "{{ config('setting.second_url') }}akademik/edit-presensi",
                    method: "POST",
                    data: form_data,
                    dataType: "json",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    beforeSend: function() {
                        $("#bteditpresensi").prop('disabled', true);
                    },
                    success: function(data) {
                        if (data.error) {
                            showToastr('error', 'Error!', data.error);
                            $("#bteditpresensi").prop('disabled', false);
                        } else if (data.success) {
                            $('#modal_edit_presensi').modal('hide');
                            $('#modal_list').modal('hide');
                            showToastr('success', 'Success!', data.success);
                            $("#bteditpresensi").prop('disabled', false);
                        }
                    }
                })
            });

            function tbcekmhspresensi(mhs) {
                $('#modal_lihat_mhs').modal('show');
                var jal = /#/.test(mhs.toString()) == false ? mhs.toString() : mhs.toString().replace(/#/g, '","');
                console.log(jal);
                var hslnya = '"' + jal + '"';

                $('#tbmhs').DataTable({
                    bInfo: false,
                    bPaginate: false,
                    bLengthChange: false,
                    bFilter: false,
                    destroy: true,
                    order: false,
                    ajax: {
                        type: "POST",
                        url: "{{ config('setting.second_url') }}akademik/lihat-mhs-presensi",
                        headers: {
                            "Authorization": 'Bearer ' + token,
                            "username": userlogin
                        },
                        data: {
                            nim: hslnya
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
                            className: 'text-center'
                        },
                        {
                            data: "nama_mahasiswa"
                        }
                    ],
                });

            }


            // edit
            $("#form_import_presensi").on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ config('setting.second_url') }}akademik/import-presensi",
                    method: "POST",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function(data) {
                        if (data.error) {
                            $('#modal_import').modal('hide');
                            showToastr('error', 'Error!', data.error);
                            table.ajax.reload();
                            $("#btimport_presensi").prop('disabled', false);
                        } else if (data.success) {
                            $('#modal_import').modal('hide');
                            showToastr('success', 'Success!', data.success);
                            table.ajax.reload();
                            $("#btimport_presensi").prop('disabled', false);
                        }
                        console.log(data);
                    }
                })
            })

        });
    </script>
@stop
