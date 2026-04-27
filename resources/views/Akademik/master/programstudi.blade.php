@extends('layout')

@section('content')
    <div class="container-full">
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">Program Studi</h3>
                    <div class="d-inline-block align-items-center">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                                <li class="breadcrumb-item" aria-current="page">Master</li>
                                <li class="breadcrumb-item active" aria-current="page">Program Studi</li>
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
                    <h6 class="box-subtitle">Melihat Data Program Studi</h6>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <div class="box">
                        <div class="box-body ribbon-box bg-primary-light">
                            <div class="ribbon ribbon-info">informasi</div>
                            <p class="mb-0">Program Studi berada di bawah Fakultas, sehingga untuk menambah data
                                program
                                studi / jurusan harus sudah ada data Fakultas.</p>
                        </div> <!-- end box-body-->
                        <div class="box-header no-border">
                            <div class="row">
                                <div class="col-sm-12 text-right">
                                    <button type="button" class="waves-effect waves-light btn btn-rounded btn-primary btn-outline btn-sm" data-toggle="modal"
                                        data-target="#modal_add"><i class="ti-plus"></i> Tambah</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="kgtprogramstudi" class="table table-hover table-striped">
                            <thead class="bg-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Kode Prodi</th>
                                    <th>Kode Prodi Forlab</th>
                                    <th>Nama Prodi</th>
                                    <th>Nama Fakultas</th>
                                    <th>Pimpinan</th>
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
                            <h4 class="modal-title">Input Program Studi</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                        <form id="form_add" method="POST">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Kode Jurusan</label>
                                    <input class="form-control" type="text" name="kode_program_studi"
                                        placeholder="Kode Jurusan">
                                </div>
                                <div class="form-group">
                                    <label>Kode Prodi Forlab</label>
                                    <input class="form-control" type="text" name="kode_prodi_forlab"
                                        placeholder="Kode Prodi Forlab">
                                </div>
                                <div class="form-group">
                                    <label>Nama Jurusan</label>
                                    <input class="form-control" type="text" name="nama_program_studi"
                                        placeholder="Nama Jurusan">
                                </div>
                                <div class="form-group">
                                    <label>Nama Fakultas</label>
                                    <select class="form-control" name="kode_fakultas" id="kode_fakultas">
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Pimpinan Fakultas</label>
                                    <select class="form-control" name="pimpinan_prodi" id="pimpinan_prodi">
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer float-right">
                                <button type="button" class="waves-effect waves-light btn btn-rounded btn-warning btn-outline mr-1"
                                    data-dismiss="modal">
                                    <i class="fa fa-times"></i> Close
                                </button>
                                <button type="submit" class="waves-effect waves-light btn btn-rounded btn-primary btn-outline" id="btsubmit">
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
                            <h4 class="modal-title">Edit Program Studi</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                        <form id="form_edit" method="POST">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Kode Prodi</label>
                                    <input class="form-control" type="text" name="ekode_program_studi"
                                        id="ekode_program_studi" placeholder="Kode Prodi">
                                    <input class="form-control" type="hidden" name="id_program_studi"
                                        id="id_program_studi" placeholder="ID Program Studi">
                                </div>
                                <div class="form-group">
                                    <label>Kode Prodi Forlab</label>
                                    <input class="form-control" type="text" name="ekode_prodi_forlab"
                                        id="ekode_prodi_forlab" placeholder="Kode Prodi Forlab">
                                </div>
                                <div class="form-group">
                                    <label>Nama Fakultas</label>
                                    <select class="form-control" name="ekode_fakultas" id="ekode_fakultas">
                                        <option value="">Pilih</option>
                                        <option value=""></option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Nama Prodi</label>
                                    <input class="form-control" type="text" name="enama_program_studi"
                                        id="enama_program_studi" placeholder="Nama Prodi">
                                </div>
                                <div class="form-group">
                                    <label>Pimpinan Fakultas</label>
                                    <select class="form-control" name="epimpinan_prodi" id="epimpinan_prodi">
                                        <option value="">Pilih</option>
                                        <option value=""></option>
                                    </select>
                                </div>
                                
                                <hr>
                                <h5 class="text-primary"><i class="fa fa-cogs mr-5"></i> Konfigurasi Tugas Akhir</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>SKS Minimal TA</label>
                                            <input class="form-control" type="number" name="eta_sks_minimal" id="eta_sks_minimal" placeholder="Contoh: 120">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Ada Sempro?</label>
                                            <select class="form-control" name="eta_ada_sempro" id="eta_ada_sempro">
                                                <option value="1">Ya</option>
                                                <option value="0">Tidak (Langsung Bimbingan)</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Komponen Bayar (Pisahkan dengan koma)</label>
                                    <input class="form-control" type="text" name="eta_komponen_bayar" id="eta_komponen_bayar" placeholder="Contoh: Bimbingan Skripsi, Ujian Skripsi">
                                    <small class="text-muted">*Harus persis dengan nama komponen di sistem Keuangan.</small>
                                </div>
                                <div class="form-group">
                                    <label>Minimal Bimbingan (Kali)</label>
                                    <input class="form-control" type="number" name="eta_min_bimbingan" id="eta_min_bimbingan" placeholder="Contoh: 8">
                                </div>
                            </div>
                            <div class="modal-footer float-right">
                                <button type="button" class="waves-effect waves-light btn btn-rounded btn-warning btn-outline mr-1"
                                    data-dismiss="modal">
                                    <i class="fa fa-times"></i> Close
                                </button>
                                <button type="submit" class="waves-effect waves-light btn btn-rounded btn-primary btn-outline" id="btsubmit">
                                    <i class="ti-save-alt"></i> Save
                                </button>
                            </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

            {{-- modal detail konfigurasi TA --}}
            <div class="modal fade" id="modal_detail_ta">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-gradient-primary">
                            <h4 class="modal-title text-white"><i class="fa fa-cogs mr-10"></i> Detail Konfigurasi Tugas Akhir</h4>
                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body p-4">
                            <!-- Prodi Info Card -->
                            <div class="card border-0 shadow-sm mb-4">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex align-items-center justify-content-center bg-primary rounded-circle mr-3" style="width: 50px; height: 50px;">
                                            <i class="fa fa-university text-white fa-lg"></i>
                                        </div>
                                        <div>
                                            <h5 id="detail_nama_prodi" class="mb-1 font-weight-600 text-primary">-</h5>
                                            <p id="detail_kode_prodi" class="text-muted mb-0 small">-</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <h6 class="mb-3 font-weight-600 text-secondary"><i class="fa fa-graduation-cap mr-2"></i> Pengaturan Tugas Akhir</h6>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="card border-0 shadow-sm h-100">
                                        <div class="card-body">
                                            <div class="d-flex align-items-start">
                                                <div class="d-flex align-items-center justify-content-center bg-info bg-opacity-10 rounded-circle mr-3" style="width: 40px; height: 40px;">
                                                    <i class="fa fa-book text-info"></i>
                                                </div>
                                                <div>
                                                    <small class="text-muted d-block mb-1">Nama Tugas Akhir</small>
                                                    <span id="detail_ta_nama" class="font-weight-600">-</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="card border-0 shadow-sm h-100">
                                        <div class="card-body">
                                            <div class="d-flex align-items-start">
                                                <div class="d-flex align-items-center justify-content-center bg-success bg-opacity-10 rounded-circle mr-3" style="width: 40px; height: 40px;">
                                                    <i class="fa fa-graduation-cap text-success"></i>
                                                </div>
                                                <div>
                                                    <small class="text-muted d-block mb-1">SKS Minimal</small>
                                                    <span id="detail_ta_sks" class="font-weight-600">-</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="card border-0 shadow-sm h-100">
                                        <div class="card-body">
                                            <div class="d-flex align-items-start">
                                                <div class="d-flex align-items-center justify-content-center bg-warning bg-opacity-10 rounded-circle mr-3" style="width: 40px; height: 40px;">
                                                    <i class="fa fa-chalkboard-teacher text-warning"></i>
                                                </div>
                                                <div>
                                                    <small class="text-muted d-block mb-1">Wajib Seminar Proposal</small>
                                                    <span id="detail_ta_sempro" class="font-weight-600">-</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="card border-0 shadow-sm h-100">
                                        <div class="card-body">
                                            <div class="d-flex align-items-start">
                                                <div class="d-flex align-items-center justify-content-center bg-danger bg-opacity-10 rounded-circle mr-3" style="width: 40px; height: 40px;">
                                                    <i class="fa fa-comments text-danger"></i>
                                                </div>
                                                <div>
                                                    <small class="text-muted d-block mb-1">Minimal Bimbingan</small>
                                                    <span id="detail_ta_bimbingan" class="font-weight-600">-</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="card border-0 shadow-sm h-100">
                                        <div class="card-body">
                                            <div class="d-flex align-items-start">
                                                <div class="d-flex align-items-center justify-content-center bg-primary bg-opacity-10 rounded-circle mr-3" style="width: 40px; height: 40px;">
                                                    <i class="fa fa-money-bill-wave text-primary"></i>
                                                </div>
                                                <div>
                                                    <small class="text-muted d-block mb-1">Komponen Bayar TA</small>
                                                    <span id="detail_ta_komponen" class="font-weight-600 small">-</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="card border-0 shadow-sm h-100">
                                        <div class="card-body">
                                            <div class="d-flex align-items-start">
                                                <div class="d-flex align-items-center justify-content-center bg-secondary bg-opacity-10 rounded-circle mr-3" style="width: 40px; height: 40px;">
                                                    <i class="fa fa-file-invoice-dollar text-secondary"></i>
                                                </div>
                                                <div>
                                                    <small class="text-muted d-block mb-1">Komponen Bayar Ujian</small>
                                                    <span id="detail_ta_komponen_ujian" class="font-weight-600 small">-</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer bg-light">
                            <button type="button" class="waves-effect waves-light btn btn-rounded btn-secondary" data-dismiss="modal">
                                <i class="fa fa-times mr-1"></i> Tutup
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
        var token = "{{ Session::get('token') }}";
        var userlogin = "{{ Session::get('username') }}";

        function pimpinan() {
            $.ajax({
                type: 'GET',
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                url: "{{ config('setting.second_url') }}akademik/tampilpimpinan",
                success: function(result) {
                    var jml = result.length;
                    var s = '<option value="">-Pilih Pimpinan-</option>';
                    for (i = 0; i < jml; i++) {
                        s = s + '<option value="' + result[i].id + '"> ' + result[i].nama + '</option>';
                    }
                    // console.log(result);
                    $('#pimpinan_prodi').html(s);
                }
            })
        }
        pimpinan();

        function editpimpinan() {
            $.ajax({
                type: 'GET',
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                url: "{{ config('setting.second_url') }}akademik/edittampilpimpinan",
                success: function(result) {
                    var jml = result.length;
                    var s = '<option value="">-Pilih Pimpinan-</option>';
                    for (i = 0; i < jml; i++) {
                        s = s + '<option value="' + result[i].id + '"> ' + result[i].nama + '</option>';
                    }
                    // console.log(result);
                    $('#epimpinan_prodi').html(s);
                }
            })
        }
        editpimpinan();

        function fakultas() {
            $.ajax({
                type: 'GET',
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                url: "{{ config('setting.second_url') }}akademik/tampilfakultas",
                success: function(result) {
                    var jml = result.length;
                    var s = '<option value="">-Pilih-</option>';
                    for (i = 0; i < jml; i++) {
                        s = s + '<option value="' + result[i].kode_fakultas + '"> ' + result[i]
                            .nama_fakultas + '</option>';
                    }
                    // console.log(result);
                    $('#kode_fakultas').html(s);
                }
            })
        }
        fakultas();

        function editfakultas() {
            $.ajax({
                type: 'GET',
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                url: "{{ config('setting.second_url') }}akademik/edittampilfakultas",
                success: function(result) {
                    var jml = result.length;
                    var s = '<option value="">-Pilih-</option>';
                    for (i = 0; i < jml; i++) {
                        s = s + '<option value="' + result[i].kode_fakultas + '"> ' + result[i]
                            .nama_fakultas + '</option>';
                    }
                    // console.log(result);
                    $('#ekode_fakultas').html(s);
                }
            })
        }
        editfakultas();
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
            var table = $("#kgtprogramstudi").DataTable({
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
                    url: "{{ config('setting.second_url') }}akademik/programstudi",
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
                        data: 'kode_program_studi'
                    },
                    {
                        data: 'kode_prodi_forlab'
                    },
                    {
                        data: 'nama_program_studi'
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
                            var btnDetail = '<a href="javascript:void(0)" class="waves-effect waves-light btn btn-xs btn-outline btn-primary mr-5" id="bt_detail_ta" data-toggle="tooltip" data-original-title="Detail Konfigurasi TA"><i class="fa fa-cogs"></i></a>';
                            if (full.trash == '1') {
                                return btnDetail + '<a href="javascript:void(0)" class="waves-effect waves-light btn btn-xs btn-outline btn-info mr-5" id="bt_edit" data-toggle="tooltip" data-original-title="Edit"><i class="ti-marker-alt"></i></a><a href="javascript:void(0)" class="waves-effect waves-light btn btn-xs btn-outline btn-danger del" data-id="' +
                                    full.id_program_studi +
                                    '" data-original-title="Delete" data-toggle="tooltip"><i class="ti-trash"></i></a>';
                            } else {
                                return btnDetail + '<a href="javascript:void(0)" class="waves-effect waves-light btn btn-xs btn-outline btn-info mr-5" id="bt_edit" data-toggle="tooltip"  data-original-title="Edit"><i class="ti-marker-alt"></i></a><a href="javascript:void(0)" class="waves-effect waves-light btn btn-xs btn-outline btn-danger del" data-id="' +
                                    full.id_program_studi +
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
                    url: "{{ config('setting.second_url') }}akademik/simpan-programstudi",
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
                $('#id_program_studi').val(data['id_program_studi']);
                $('#ekode_program_studi').val(data['kode_program_studi']);
                $('#ekode_prodi_forlab').val(data['kode_prodi_forlab']);
                $('#ekode_fakultas').val(data['kode_fakultas']);
                $('#enama_program_studi').val(data['nama_program_studi']);
                $('#epimpinan_prodi').val(data['pimpinan_prodi']);
                
                // TA Config fields
                $('#eta_sks_minimal').val(data['ta_sks_minimal']);
                $('#eta_ada_sempro').val(data['ta_ada_sempro']);
                $('#eta_komponen_bayar').val(data['ta_komponen_bayar']);
                $('#eta_min_bimbingan').val(data['ta_min_bimbingan']);

                $("#" + data.trash).prop("checked", true)
            });

            // show detail TA config
            table.on('click', '#bt_detail_ta', function() {
                $tr = $(this).closest('tr');
                var data = table.row($tr).data();
                
                // Populate modal with data
                $('#detail_nama_prodi').text(data['nama_program_studi'] || '-');
                $('#detail_kode_prodi').text(data['kode_program_studi'] || '-');
                $('#detail_ta_nama').text(data['ta_nama_tugas_akhir'] || 'Skripsi');
                $('#detail_ta_sks').text((data['ta_sks_minimal'] || '-') + ' SKS');
                $('#detail_ta_sempro').text(data['ta_ada_sempro'] == '1' || data['ta_ada_sempro'] == 1 ? 'Ya (Wajib)' : 'Tidak (Langsung Bimbingan)');
                $('#detail_ta_bimbingan').text((data['ta_minimal_bimbingan'] || '8') + ' kali');
                $('#detail_ta_komponen').text(data['ta_komponen_bayar'] || '-');
                $('#detail_ta_komponen_ujian').text(data['ta_komponen_bayar_ujian'] || '-');
                
                $('#modal_detail_ta').modal('show');
            });

            // edit
            $('#form_edit').on('submit', function(event) {
                event.preventDefault();
                var form_data = $(this).serialize();
                $.ajax({
                    url: "{{ config('setting.second_url') }}akademik/edit-programstudi",
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
                            url: "{{ config('setting.second_url') }}akademik/hapus-programstudi",
                            type: 'GET',
                            headers: {
                                "Authorization": 'Bearer ' + token,
                                "username": userlogin
                            },
                            data: {
                                id_program_studi: id
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
                            url: "{{ config('setting.second_url') }}akademik/ubahstatus-programstudi",
                            type: 'GET',
                            headers: {
                                "Authorization": 'Bearer ' + token,
                                "username": userlogin
                            },
                            data: {
                                id_program_studi: id,
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
