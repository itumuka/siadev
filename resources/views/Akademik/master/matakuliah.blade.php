@extends('layout')

@section('css')
    <style>
        th,
        td {
            white-space: nowrap;
        }
    </style>
@endsection

@section('content')
    <div class="container-full">
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">Mata Kuliah</h3>
                    <div class="d-inline-block align-items-center">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                                {{-- <li class="breadcrumb-item" aria-current="page">{{ $parent_breadcrumb }}</li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $child_breadcrumb }}</li> --}}
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
                    <h6 class="box-subtitle">Melihat Mata Kuliah</h6>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <div class="box">
                        <div class="box-body ribbon-box bg-primary-light">
                            <div class="ribbon ribbon-info">Informasi</div>
                            <p class="mb-0">Data Mata kuliah</p>
                        </div> <!-- end box-body-->

                    </div>
                    <div class="text-right">
                        <div class="btn-group mb-5">
                            <button type="button" class="waves-effect waves-light btn btn-sm btn-dark dropdown-toggle"
                                data-toggle="dropdown"><i class="ti-plus"></i> Tambah</button>
                            <div class="dropdown-menu dataprodi">
                            </div>
                        </div>
                        {{-- <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_add"><i class="ti-plus"></i> Tambah</button> --}}
                    </div>
                    <div class="table-responsive">
                        <table id="tbkurikulum" class="table table-hover table-striped">
                            <thead class="bg-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Kurikulum</th>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Total SKS</th>
                                    <th>Semester</th>
                                    <th>Program Studi</th>
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
                <div class="modal-dialog modal-xl" role="document" style="width:1080px;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Input Mata Kuliah</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                        <form id="form_add" method="POST">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label id="nama_prodi"></label><br>
                                    <label id="nama_fakultas"></label>
                                    <input class="form-control" type="hidden" name="kode_prodi[]" id="kode_prodi"
                                        placeholder="ex: 2021">
                                    <input class="form-control" type="hidden" name="kode_fakultas[]" id="kode_fakultas"
                                        placeholder="ex: 2021">

                                </div>
                                <div class="pull-right">
                                    <button type="button" class="btn btn-sm btn-primary" id="addrow"><i
                                            class="ti-plus"></i></button>
                                </div>
                                <div class="form-group table-responsive">
                                    <table id="blanktable" class="table table-hover table-sm text-nowrap" width="100%">
                                        <thead>
                                            <tr>
                                                <th style="background-color: rgba(214, 162, 19, 0.836); color:white;">No
                                                </th>
                                                <th style="background-color: rgba(214, 162, 19, 0.836); color:white;">
                                                    Kurikulum
                                                </th>
                                                <th style="background-color: rgba(214, 162, 19, 0.836); color:white;">Kode
                                                </th>
                                                <th style="background-color: rgba(214, 162, 19, 0.836); color:white;">Nama
                                                </th>
                                                <th style="background-color: rgba(214, 162, 19, 0.836); color:white;">Nama
                                                    Inggris
                                                </th>
                                                <th style="background-color: rgba(214, 162, 19, 0.836); color:white;">SKS Teori
                                                </th>
                                                <th style="background-color: rgba(214, 162, 19, 0.836); color:white;">SKS Praktikum
                                                </th>
                                                <th style="background-color: rgba(214, 162, 19, 0.836); color:white;">Total SKS
                                                </th>
                                                <th style="background-color: rgba(214, 162, 19, 0.836); color:white;">
                                                    Semester
                                                </th>
                                                <th style="background-color: rgba(214, 162, 19, 0.836); color:white;">Sifat
                                                    Makul
                                                </th>
                                                <th style="background-color: rgba(214, 162, 19, 0.836); color:white;">
                                                    Berbayar
                                                </th>
                                                <th style="background-color: rgba(214, 162, 19, 0.836); color:white;">Aksi
                                                </th>
                                            </tr>
                                        </thead>
                                    </table>
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
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Input Tahun Akademik</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="row">
                            <div class="col-sm-7">
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Kode Matakuliah</th>
                                                <th>:</th>
                                                <th>
                                                    <label id="ekode_matakuliah1"></label>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>Nama Program Studi</th>
                                                <th>:</th>
                                                <th>
                                                    <label id="enama_program_studi1"></label>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>Tahun Kurikulum</th>
                                                <th>:</th>
                                                <th>
                                                    <label id="ekurikulum1"></label>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>Nama Matakuliah</th>
                                                <th>:</th>
                                                <th>
                                                    <label id="enama_matakuliah1"></label>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>Nama Matakuliah Inggris</th>
                                                <th>:</th>
                                                <th>
                                                    <label id="enama_matakuliah_inggris1"></label>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>SKS Teori</th>
                                                <th>:</th>
                                                <th>
                                                    <label id="eskst_matakuliah1"></label>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>SKS Paktikum</th>
                                                <th>:</th>
                                                <th>
                                                    <label id="esksp_matakuliah1"></label>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>Total SKS</th>
                                                <th>:</th>
                                                <th>
                                                    <label id="esks_matakuliah1"></label>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>Semester</th>
                                                <th>:</th>
                                                <th>
                                                    <label id="esemester1"></label>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>Kode Bayar</th>
                                                <th>:</th>
                                                <th>
                                                    <label id="ekode_bayar1"></label>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>Sifat</th>
                                                <th>:</th>
                                                <th>
                                                    <label id="ekode_sifat_matakuliah1"></label>
                                                </th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <form id="form_edit" method="POST">
                                    <div class="modal-body1">
                                        <div class="form-group">
                                            <label>Tahun</label>
                                            <input class="form-control" type="text" name="ekurikulum"
                                                id="ekurikulum">
                                        </div>
                                        <div class="form-group">
                                            <label>Kode</label>
                                            <input class="form-control" type="text" name="ekode_matakuliah"
                                                id="ekode_matakuliah" readonly>
                                            <input class="form-control" type="hidden" name="eid_matakuliah"
                                                id="eid_matakuliah" readonly>
                                            <input class="form-control" type="hidden" name="ekode_sifat_matakuliah"
                                                id="ekode_sifat_matakuliah" readonly>
                                            <input class="form-control" type="hidden" name="ekode_fakultas"
                                                id="ekode_fakultas" readonly>
                                            <input class="form-control" type="hidden" name="ekode_program_studi"
                                                id="ekode_program_studi">
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Matakuliah</label>
                                            <input class="form-control" type="text" name="enama_matakuliah"
                                                id="enama_matakuliah">
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Matakuliah Inggris</label>
                                            <input class="form-control" type="text" name="enama_matakuliah_inggris"
                                                id="enama_matakuliah_inggris">
                                        </div>
                                        <div class="form-group">
                                            <label>SKS Teori</label>
                                            <select class="form-control" style="width: 100%;" name="eskst_matakuliah"
                                                id="eskst_matakuliah">
                                                <option>SKS Teori</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>SKS Praktikum</label>
                                            <select class="form-control" style="width: 100%;" name="esksp_matakuliah"
                                                id="esksp_matakuliah">
                                                <option>SKS Praktikum</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Total SKS</label>
                                            <select class="form-control" style="width: 100%;" name="esks_matakuliah"
                                                id="esks_matakuliah">
                                                <option>Total SKS</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Semester</label>
                                            <select class="form-control" style="width: 100%;" name="esemester"
                                                id="esemester">
                                                <option>Semester</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Kode Bayar</label>
                                            <select class="form-control" style="width: 100%;" name="ekode_bayar"
                                                id="ekode_bayar">
                                                <option>Kode</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Sifat</label>
                                            <select class="form-control eselectsifatmatakuliah" style="width: 100%;"
                                                name="esifatmatakuliah" id="esifatmatakuliah"></select>
                                        </div>
                                    </div>
                                    <div class="modal-footer float-right">
                                        <button type="button" class="btn btn-rounded btn-warning btn-outline mr-1"
                                            data-dismiss="modal">
                                            <i class="fa fa-times"></i> Close
                                        </button>
                                        <button type="submit" class="btn btn-rounded btn-primary btn-outline"
                                            id="btsubmit">
                                            <i class="ti-save-alt"></i> Save
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-sm-1">
                            </div>
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
        $(document).ready(function() {
            var token = "{{ Session::get('token') }}";
            var userlogin = "{{ Session::get('username') }}";

            var kd_prodi = $('#kode_prodi').val();
            var kd_fakultas = $('#kode_fakultas').val();

            function dropdown_prodifakultas() {
                $.ajax({
                    type: "POST",
                    url: "{{ config('setting.second_url') }}akademik/dropdown-prodifakultas",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    dataType: "json",
                    success: function(data) {
                        // $('.test').fadeOut();
                        let target = $(".dataprodi")
                        $.each(data, function(index, value) {
                            var el = data[index];
                            var flag = 0;
                            target.append(
                                '<a href="#" class="dropdown-item" id="btmodal_add" data-id=' +
                                el.kode_program_studi + ' data-id_fakultas=' +
                                el.kode_fakultas + ' data-prodi=' + el
                                .nama_program_studi + ' data-fakultas=' + el
                                .nama_fakultas +
                                ' data-toggle="modal" data-target="#modal_add">' + el
                                .nama_program_studi + '</a>')
                        });
                    },
                    error: function(error) {
                        alert(error);
                    }
                });
            }
            dropdown_prodifakultas();


            $(document).on("click", "#btmodal_add", function() {
                var kode_prodi = $(this).data('id');
                var nama_prodi = $(this).data('prodi');
                var kode_fakultas = $(this).data('id_fakultas');
                var nama_fakultas = $(this).data('fakultas');
                $(".modal-body #kode_prodi").val(kode_prodi);
                $(".modal-body #kode_fakultas").val(kode_fakultas);
                $(".modal-body #nama_prodi").text('Program Studi: ' + nama_prodi);
                $(".modal-body #nama_fakultas").text('Fakultas : ' + nama_fakultas);
                // $('#addBookDialog').modal('show');
            });

            // var nim = $('#nim').val();
            // var ta = $('#ta').val();
            // var smt = $('#smt').val();
            // var token = $('#token').val();
            var table = $("#tbkurikulum").DataTable({
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
                // orderable: true,
                ajax: {
                    type: "GET",
                    url: "{{ config('setting.second_url') }}akademik/matakuliah",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    // data: {
                    //     nim: nim,
                    // },
                    dataSrc: function(json) {
                        return json;
                    }
                },
                columns: [{
                        data: null,
                        orderable: false,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'tahun_kurikulum',
                        orderable: true
                    },
                    {
                        data: 'kode_matakuliah',
                        orderable: true
                    },
                    {
                        data: 'nama_matakuliah',
                        orderable: true
                    },
                    {
                        data: 'sks_matakuliah',
                        orderable: true
                    },
                    {
                        data: 'smt_matakuliah',
                        orderable: true
                    },
                    {
                        data: 'nama_program_studi',
                        orderable: true
                    },
                    {
                        data: null,
                        orderable: false,
                        render: function(data, type, full, meta) {
                            return '<a href="javascript:void(0)" class="text-info mr-10" id="bt_edit" data-toggle="tooltip" data-original-title="Edit"><i class="ti-marker-alt"></i></a> | <a href="javascript:void(0)" class="text-danger del" data-id="' +
                                full.id_matakuliah +
                                '" data-original-title="Delete" data-toggle="tooltip"><i class="ti-trash"></i></a>';
                        }
                    },

                ],
                order: []
            });


            var tdetail = $('#blanktable').DataTable({
                bInfo: false,
                bPaginate: false,
                bLengthChange: false,
                bFilter: false,
                //   select: true,      
                order: false,
                columns: [{
                        name: "no",
                        width: '1px',
                        "sClass": "text-center",
                        orderable: false
                    },
                    {
                        name: "makul_parent",
                        width: '120px',
                        "sClass": "text-center",
                        orderable: false
                    },
                    {
                        name: "makul_child",
                        width: '150px',
                        "sClass": "text-center",
                        orderable: false
                    },
                    {
                        name: "makul_child",
                        width: '150px',
                        "sClass": "text-center",
                        orderable: false
                    },
                    {
                        name: "makul_child",
                        width: '130px',
                        "sClass": "text-center",
                        orderable: false
                    },
                    {
                        name: "makul_child",
                        width: '130px',
                        "sClass": "text-center",
                        orderable: false
                    },
                    {
                        name: "makul_child",
                        width: '130px',
                        "sClass": "text-center",
                        orderable: false
                    },
                    {
                        name: "makul_child",
                        width: '130px',
                        "sClass": "text-center",
                        orderable: false
                    },
                    {
                        name: "makul_child",
                        width: '130px',
                        "sClass": "text-center",
                        orderable: false
                    },
                    {
                        name: "makul_child",
                        width: '130px',
                        "sClass": "text-center",
                        orderable: false
                    },
                    {
                        name: "makul_child",
                        width: '130px',
                        "sClass": "text-center",
                        orderable: false
                    },
                    {
                        name: "makul_child",
                        width: '1px',
                        "sClass": "text-center",
                        orderable: false,
                        render: (data, type, row) => {
                            return '<a href="#" id="delrow"><i class="ti-trash"></i></a>';
                        }
                    }
                ],
                drawCallback: function() {
                    $('.selectkurikulum1').select2({
                        allowClear: true,
                        placeholder: '-Tahun-',
                        ajax: {
                            dataType: 'json',
                            url: "{{ config('setting.second_url') }}akademik/select-kurikulum",
                            headers: {
                                "Authorization": 'Bearer ' + token,
                                "username": userlogin
                            },
                            delay: 100,
                            data: function(params) {
                                var kd_prodi = $('#kode_prodi').val();
                                return {
                                    kode_prodi: kd_prodi,
                                    search: params.term
                                }
                            },
                            processResults: function(data) {
                                var data_array = [];
                                data.data.forEach(function(value, key) {
                                    data_array.push({
                                        id: value.id,
                                        text: value.text
                                    })
                                });

                                return {
                                    results: data_array
                                }
                            }
                        }
                    }).on('selectkurikulum:select', function(evt) {
                        $(".selectkurikulum option:selected").val();
                    });

                    $('.selectsifatmatakuliah').select2({
                        allowClear: true,
                        placeholder: '-Sifat-',
                        ajax: {
                            dataType: 'json',
                            url: "{{ config('setting.second_url') }}akademik/select-sifatmatakuliah",
                            headers: {
                                "Authorization": 'Bearer ' + token,
                                "username": userlogin
                            },
                            delay: 100,
                            data: function(params) {
                                return {
                                    search: params.term
                                }
                            },
                            processResults: function(data) {
                                var data_array = [];
                                data.data.forEach(function(value, key) {
                                    data_array.push({
                                        id: value.id,
                                        text: value.text
                                    })
                                });

                                return {
                                    results: data_array
                                }
                            }
                        }
                    }).on('selectsifatmatakuliah:select', function(evt) {
                        $(".selectsifatmatakuliah option:selected").val();
                    });
                }
            });

            $('#addrow').on('click', function() {


                tdetail.row.add([
                    '',
                    '<select class="form-control selectkurikulum1" style="width: 120px;" name="tahun_kurikulum[]" id="tahun_kurikulum"></select>',
                    '<input class="form-control" type="text" style="width: 100px;" name="kode_matakuliah[]" id="kode_matakuliah">',
                    '<input class="form-control" type="text" style="width: 200px;" name="nama_matakuliah[]" id="nama_matakuliah">',
                    '<input class="form-control" type="text" style="width: 200px;" name="nama_matakuliah_inggris[]" id="nama_matakuliah_inggris">',
                    '<select class="form-control" style="width: 90px;" name="skst_matakuliah[]" id="skst_matakuliah"><option>SKS</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option></select>',
                    '<select class="form-control" style="width: 90px;" name="sksp_matakuliah[]" id="sksp_matakuliah"><option>SKS</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option></select>',
                    '<select class="form-control" style="width: 90px;" name="sks_matakuliah[]" id="sks_matakuliah"><option>SKS</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option></select>',
                    '<select class="form-control" style="width: 90px;" name="smt_matakuliah[]" id="smt_matakuliah"><option>Semester</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option></select>',
                    '<select class="form-control selectsifatmatakuliah" style="width: 150px;" name="kode_sifat_matakuliah[]" id="kode_sifat_matakuliah"></select>',
                    '<select class="form-control selectsks" style="width: 90px;" name="kode_bayar[]" id="kode_bayar"><option>Kode</option><option value="1">1</option><option value="2">2</option></select>'
                ]);
                // auto inc datatable
                tdetail.on('order.dt search.dt', function() {
                    tdetail.column(0, {
                        search: 'applied',
                        order: 'applied'
                    }).nodes().each(function(cell, i) {
                        cell.innerHTML = i + 1;
                    });
                }).draw();
            });

            tdetail.on('click', '#delrow', function() {
                tdetail.row($(this).parents('tr'))
                    .remove()
                    .draw();
            });


            $('#modal_add').on('hidden.bs.modal', function(e) {
                tdetail.clear().draw();
                $(".selectkurikulum1").val([]).trigger("change");
            });

            $('#modal_add').on('hidden.bs.modal', function(e) {
                tdetail.clear().draw();
                $(".selectsifatmatakuliah").val([]).trigger("change");
            });

            $('.eselectkurikulum').select2({
                allowClear: true,
                placeholder: '-Select Tahun-',
                ajax: {
                    dataType: 'json',
                    url: "{{ config('setting.second_url') }}akademik/select-kurikulum",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    delay: 100,
                    data: function(params) {
                        var kd_prodi = $('#ekode_prodi').val();
                        return {
                            kode_prodi: kd_prodi,
                            search: params.term
                        }
                    },
                    processResults: function(data) {
                        var data_array = [];
                        data.data.forEach(function(value, key) {
                            data_array.push({
                                id: value.id,
                                text: value.text
                            })
                        });

                        return {
                            results: data_array
                        }
                    }
                }
            }).on('eselectkurikulum:select', function(evt) {
                $(".eselectkurikulum option:selected").val();
            });

            $('.eselectsifatmatakuliah').select2({
                allowClear: true,
                placeholder: '-Sifat-',
                ajax: {
                    dataType: 'json',
                    url: "{{ config('setting.second_url') }}akademik/select-sifatmatakuliah",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    delay: 100,
                    data: function(params) {
                        return {
                            search: params.term
                        }
                    },
                    processResults: function(data) {
                        var data_array = [];
                        data.data.forEach(function(value, key) {
                            data_array.push({
                                id: value.id,
                                text: value.text
                            })
                        });

                        return {
                            results: data_array
                        }
                    }
                }
            }).on('eselectsifatmatakuliah:select', function(evt) {
                $(".eselectsifatmatakuliah option:selected").val();
            });
            //save
            $('#form_add').on('submit', function(event) {
                event.preventDefault();
                var form_data = $(this).serialize();
                $.ajax({
                    url: "{{ config('setting.second_url') }}akademik/simpan-matakuliah",
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
                $('#ekode_program_studi').val(data['kode_prodi']);
                $('#eid_matakuliah').val(data['id_matakuliah']);
                $('#ekode_program_studi1').html(data['kode_prodi']);
                $('#ekurikulum').val(data['tahun_kurikulum']);
                $('#ekurikulum1').html(data['tahun_kurikulum']);
                $('#ekode_matakuliah').val(data['kode_matakuliah']);
                $('#ekode_fakultas').val(data['kode_fakultas']);
                $('#ekode_matakuliah1').html(data['kode_matakuliah']);
                $('#enama_program_studi').html(data['nama_program_studi']);
                $('#enama_program_studi1').html(data['nama_program_studi']);
                $('#enama_matakuliah').val(data['nama_matakuliah']);
                $('#enama_matakuliah1').html(data['nama_matakuliah']);
                $('#enama_matakuliah_inggris').val(data['nama_matakuliah_inggris']);
                $('#enama_matakuliah_inggris1').html(data['nama_matakuliah_inggris']);
                $('#eskst_matakuliah').val(data['sks_teori']);
                $('#eskst_matakuliah1').html(data['sks_teori']);
                $('#esksp_matakuliah').val(data['sks_praktikum']);
                $('#esksp_matakuliah1').html(data['sks_praktikum']);
                $('#esks_matakuliah').val(data['sks_matakuliah']);
                $('#esks_matakuliah1').html(data['sks_matakuliah']);
                $('#esemester').val(data['smt_matakuliah']);
                $('#esemester1').html(data['smt_matakuliah']);
                $('#ekode_sifat_matakuliah').val(data['kode_sifat_matakuliah']);
                $('#ekode_bayar').val(data['kode_bayar']);
                $('#ekode_sifat_matakuliah').val(data['kode_sifat_matakuliah']);
                $('#ekode_bayar1').html(data['kode_bayar']);
                $(".modal-body #ekode_prodi").val(data['kode_prodi']);
                $("#ekurikulum").empty().append('<option value="' + data['tahun_kurikulum'] + '">' + data[
                    'tahun_kurikulum'] + '</option>').val(data['tahun_kurikulum']).trigger(
                    'change');

                if (data['kode_sifat_matakuliah'] == '1') {
                    $('#ekode_sifat_matakuliah1').html('Wajib');
                } else if (data['kode_sifat_matakuliah'] == '2') {
                    $('#ekode_sifat_matakuliah1').html('Pilihan');
                }
                if (data['kode_sifat_matakuliah'] == '1') {
                    $("#esifatmatakuliah").empty().append('<option>Wajib</option>').val('Wajib')
                        .trigger('change');
                } else if (data['kode_sifat_matakuliah'] == '2') {
                    $("#esifatmatakuliah").empty().append('<option>Pilihan</option>').val('Pilihan')
                        .trigger('change');
                }
            });

            // edit
            $('#form_edit').on('submit', function(event) {
                event.preventDefault();
                var form_data = $(this).serialize();
                $.ajax({
                    url: "{{ config('setting.second_url') }}akademik/edit-matakuliah",
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
                            url: "{{ config('setting.second_url') }}akademik/hapus-matakuliah",
                            type: 'GET',
                            headers: {
                                "Authorization": 'Bearer ' + token,
                                "username": userlogin
                            },
                            data: {
                                id_matakuliah: id
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

        });
    </script>
@stop
