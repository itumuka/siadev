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
                    <h6 class="box-subtitle">Melihat Mata Kuliah Diampu Fakultas</h6>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <div class="box">
                        <div class="box-body ribbon-box bg-primary-light">
                            <div class="ribbon ribbon-info">Informasi</div>
                            <p class="mb-0">Berikut pilihan Mata Kuliah untuk input nilai KHS Mahasiswa di Admin Fakultas</p>
                        </div> <!-- end box-body-->

                    </div>
                    <div class="table-responsive">
                        <input class="form-control" type="hidden" name="tahun" id="tahun"
                            value="{{ $session_tahun }}">
                        <input class="form-control" type="hidden" name="semester" id="semester"
                            value="{{ $session_semester }}">
                        <input class="form-control" type="hidden" name="kode_fakultas" id="kode_fakultas"
                            value="{{ $session_kode_fakultas }}">
                        <table id="tbmakulpenawaran" class="table table-hover table-sm" width="100%">
                            <thead class="bg-dark">
                                <tr>
                                    <th>Aksi</th>
                                    <th>No</th>
                                    <th>Kode Makul</th>
                                    <th>Matakuliah</th>
                                    <th>Kelas</th>
                                    <th>Smt.</th>
                                    <th>SKS</th>
                                    <th>Prodi</th>
                                    <th>Peserta</th>
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
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Berita Acara Input Nilai Mata kuliah <code id="l_nama_makul"></code></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                        <form id="form_add" method="POST">
                            <div class="modal-body">
                                <input class="form-control" type="hidden" name="id_kelas" id="id_kelas">
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3">Date</label>
                                    <div class="col-md-6">
                                        <input class="form-control" type="date" name="tgl_ujian">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Jenis Ujian</label>
                                    <div class="col-sm-6">
                                        <select class="form-control" name="jenis_ujian" id="jenis_ujian" width="100%">
                                            {{-- <option value="">Pilih</option> --}}
                                            {{-- <option value="uts">UTS</option> --}}
                                            <option value="uas">UAS</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-time-input" class="col-sm-3 col-form-label">Jam Mulai</label>
                                    <div class="col-sm-6">
                                        <input class="form-control" type="time" name="jam_mulai" id="jam_mulai">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-time-input" class="col-sm-3 col-form-label">Jam Selesai</label>
                                    <div class="col-sm-6">
                                        <input class="form-control" type="time" name="jam_selesai" id="jam_selesai">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="jml_mhs" class="col-sm-3 col-form-label">Jumlah Mahasiswa</label>
                                    <div class="col-sm-4">
                                        <input class="form-control" type="number" name="jml_mhs" id="jml_mhs">
                                        <span class="text-danger" style="font-size: 0.8em">Jumlah NIM dalam
                                            presensi</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="jml_mhs" class="col-sm-3 col-form-label">NIM Tidak Hadir</label>
                                    <div class="col-sm-4">
                                        <textarea rows="4" class="form-control" name="nim_tidak_hadir" id="nim_tidak_hadir"
                                            placeholder="Contoh pengisian: 164200000001#164200000002"></textarea>
                                        <span class="text-danger" style="font-size: 0.8em"> * Gunakan # sebagai pemisah
                                            antar nim mahasiswa <b> bukan spasi </b>, Contoh:
                                            164200000001#164200000002#1642...</span>
                                    </div>
                                    <div class="col-sm-4">
                                        <button type="button"
                                            class="waves-effect waves-light btn btn-sm btn-outline btn-info"
                                            id="bantuan_nim" data-id="" title="Bantuan input nim tidak hadir"><i
                                                class="fa fa-question" aria-hidden="true"></i> Bantuan</button>
                                    </div>
                                </div>
                                {{-- <div class="form-group" id="show_bantuan" style="display: none">

                                </div> --}}

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

            <div class="modal modal-right fade" id="modal-bantuan" tabindex="-1">
                <div class="modal-dialog modal-md modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Bantuan Insert NIM Tidak Hadir</h5>
                            <button type="button" class="close" data-dismiss="modal">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table id="tbhelp_nim" class="table table-bordered table-sm table-striped"
                                    width="100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>NIM</th>
                                            <th>Nama Mahasiswa</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer modal-footer-uniform">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
        $(document).ready(function() {
            var token = "{{ Session::get('token') }}";
            var userlogin = "{{ Session::get('username') }}";

            var kode_fakultas = $('#kode_fakultas').val();
            var tahun = $('#tahun').val();
            var semester = $('#semester').val();
            var jabatan = $('#jabatan').val();

            var table = $("#tbmakulpenawaran").DataTable({
                destroy: true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel'
                ],
                pageLength: 50,
                processing: true,
                lengthChange: true,
                orderable: false,
                ajax: {
                    type: "GET",
                    url: "{{ config('setting.second_url') }}dekanat/makulpenawaran-ba-ujian",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    data: {
                        tahun: tahun,
                        semester: semester,
                        kode_fakultas: kode_fakultas,
                        jabatan: jabatan
                    },
                    dataSrc: function(json) {
                        return json;
                    }
                },
                columns: [{
                        data: null,
                        className: 'text-center',
                        render: function(data, type, full, meta) {

                            var btnuas = full.bt_uas == 1 ?
                                '<a href="{{ route('dknform_input_nilai_uas_akademik') }}?id_kelas=' +
                                full.id_kelas +
                                '" class="btn btn-xs btn-primary" title="Lihat Form Input Nilai UAS"><i class="fa fa-pencil"></i> UAS</a>' :
                                '<a href="javascript:void(0)" class="waves-effect waves-light btn btn-xs btn-default" id="bt_modal_add" data-id="' +
                                full.id_kelas + '" data-mk="' + full.nama_matakuliah + '" data-original-title="Input BA Ujian" data-toggle="tooltip" title="Silahkan Input BA UAS terlebih dahulu">Input BA</a>';

                            // return btnuts + ' | ' + btnuas;
                            return btnuas;
                        }
                    },
                    {
                        data: null,
                        className: 'text-center',
                        render: function(data, type, row, meta) {
                            return '<button class="waves-effect waves-light btn btn-xs btn-success export-template" data-id="' + row.id_kelas + '" title="Export Template Nilai UAS">' +
                                   '<i class="fa fa-download"></i></button>';
                        }
                    },
                    {
                        data: 'kode_matakuliah'
                    },
                    {
                        data: 'nama_matakuliah'
                    },
                    {
                        data: 'nama_kelas', className: 'text-center'
                    },
                    {
                        data: 'smt_matakuliah', className: 'text-center'
                    },
                    {
                        data: 'sks_matakuliah', className: 'text-center'
                    },
                    {
                        data: 'nama_program_studi'
                    },
                    {
                        data: 'jumlah_peserta',
                        className: 'text-center'
                    },

                ],
                order: []
            });

            // Event handler untuk tombol Export Template
            table.on('click', '.export-template', function () {
                var id_kelas = $(this).data('id');
            
                var query = {
                    id_kelas: id_kelas
                };
            
                var url = "{{ config('setting.second_url') }}akademik/template-input-nilai-uas?" + $.param(query);
            
                window.location.href = url;
            });


            table.on('click', '#bt_modal_add', function() {
                $tr = $(this).closest('tr');
                var data = table.row($tr).data();
                var id_kelas = $(this).data('id');
                var mk = $(this).data('mk');
                $('#id_kelas').val(id_kelas);
                $('#l_nama_makul').html(mk);
                $('#bantuan_nim').data('id', id_kelas);
                $('#modal_add').modal('show');

                $('.selectnim').select2({
                    allowClear: true,
                    placeholder: '-Pilih NIM-',
                    ajax: {
                        dataType: 'json',
                        url: "{{ config('setting.second_url') }}akademik/select-nim",
                        headers: {
                            "Authorization": 'Bearer ' + token,
                            "username": userlogin
                        },
                        delay: 100,
                        data: function(params) {
                            return {
                                id_kelas: id_kelas,
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
                }).on('selectnim:select', function(evt) {
                    $(".selectnim option:selected").val();
                });

            });

            function help_nim(id) {
                var table = $("#tbhelp_nim").DataTable({
                    destroy: true,
                    // dom: 'Bfrtip',
                    // buttons: [
                    //     'copy', 'csv', 'excel'
                    // ],
                    // responsive: true,
                    pageLength: 50,
                    processing: true,
                    lengthChange: true,
                    bInfo: false,
                    bPaginate: false,
                    ajax: {
                        type: "POST",
                        url: "{{ config('setting.second_url') }}akademik/bantuan-nim-ba-ujian",
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
                    columnDefs: [{
                        orderable: false,
                        className: 'select-checkbox',
                        targets: 0
                    }],
                    select: {
                        style: 'multi',
                        selector: 'td:first-child'
                    },
                    columns: [{
                            data: null,
                            render: function(data, type, full, meta) {
                                return '';

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
                    order: []
                });

                table.on('select', function(e, dt, type, indexes) {
                    var oData = table.rows('.selected').data();
                    var str = "";
                    for (var i = 0; i < oData.length; i++) {
                        if (i <= 0) {
                            str = oData[i]['nim'];
                        } else {
                            str = str + "#" + oData[i]['nim'];
                        }
                    }
                    // console.log(str);
                    $('#nim_tidak_hadir').html(str);
                }).on('deselect', function(e, dt, type, indexes) {
                    // var rowData = table.rows(indexes).data().toArray();
                    // console.log(table.rows('.selected').data());
                    var oData = table.rows('.selected').data();
                    var str = "";
                    for (var i = 0; i < oData.length; i++) {
                        if (i <= 0) {
                            str = oData[i]['nim'];
                        } else {
                            str = str + "#" + oData[i]['nim'];
                        }
                    }
                    // console.log(str);
                    $('#nim_tidak_hadir').html(str);
                });
            }

            $('#bantuan_nim').click(function() {
                var id = $(this).data('id');
                console.log(id);
                help_nim(id);
                $('#modal-bantuan').modal('show');
            });


            //save
            $('#form_add').on('submit', function(event) {
                event.preventDefault();
                var form_data = $(this).serialize();
                $.ajax({
                    url: "{{ config('setting.second_url') }}akademik/simpan-ba-ujian",
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

        });
    </script>
@stop
