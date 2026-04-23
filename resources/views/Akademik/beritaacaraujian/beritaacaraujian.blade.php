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
            <div class="box no-shadow mb-0">
                <div class="box-header no-border px-0">
                    {{-- <h6 class="box-title">Melihat Mata Kuliah Diampu</h6> --}}
                    <div class="box-controls pull-right d-md-flex d-none">
                        <a href="{{ route('akdaftardosen') }}" type="button" class="btn btn-xs btn-danger"
                            title="Kembali ke menu sebelumnya"><i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i>
                            Kembali</a>
                    </div>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <div class="box">
                        <div class="box-body ribbon-box bg-primary-light">
                            <div class="ribbon ribbon-info">informasi</div>
                            <p class="mb-0">Penawaran mata kuliah yang ditampilkan di Semester
                                {{ $session_nama_tahunakademik }}</p>
                        </div> <!-- end box-body-->

                    </div>
                    <div class="table-responsive">
                        <input class="form-control" type="hidden" name="tahun" id="tahun"
                            value="{{ $session_tahun }}">
                        <input class="form-control" type="hidden" name="semester" id="semester"
                            value="{{ $session_semester }}">
                        <input class="form-control" type="hidden" name="kode_dosen" id="kode_dosen"
                            value="{{ $session_kode_dosen }}">
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
                <!-- /.box-body -->

                <iframe id="printff" name="printff" style="display: none;"></iframe>

            </div>

            <div class="modal fade" id="modal_add">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Berita Acara Perkuliahan</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                        <form id="form_add" method="POST">
                            <div class="modal-body">
                                <input class="form-control" type="hidden" name="id_kelas" id="id_kelas">
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3">Date</label>
                                    <div class="col-md-9">
                                        <input class="form-control" type="date" name="tgl">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3">Materi Perkuliahan</label>
                                    <div class="col-md-9">
                                        <textarea rows="4" class="form-control" name="materi_makul" placeholder="Materi Perkuliahan"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3">Pertemuan Ke</label>
                                    <div class="col-md-5">
                                        <input class="form-control" type="number" name="pertemuan" id="pertemuan">
                                    </div>
                                </div>
                                {{-- <div class="form-group row">
                                    <label class="col-form-label col-md-3">Peserta Hadir</label>
                                    <div class="col-md-5">
                                        <input class="form-control" type="number" name="peserta_hadir">
                                    </div>
                                </div> --}}
                                <div class="form-group row">
                                    <label for="example-time-input" class="col-sm-3 col-form-label">Jam Mulai</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="time" name="jam_mulai" id="jam_mulai">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-time-input" class="col-sm-3 col-form-label">Jam Selesai</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="time" name="jam_selesai" id="jam_selesai">
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


            <div class="modal fade" id="modal_list">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">List Berita Acara Perkuliahan</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table id="tbba" class="table table-hover table-sm" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Aksi</th>
                                            <th>Tanggal</th>
                                            <th>Jenis Ujian</th>
                                            <th>Jam Mulai</th>
                                            <th>Jam Selesai</th>
                                            <th>Peserta</th>
                                            <th>Jml. Hadir</th>
                                            <th>Jml. Alpha</th>
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
                            {{-- <button type="submit" class="btn btn-rounded btn-primary btn-outline" id="btsubmit">
                        <i class="ti-save-alt"></i> Save
                      </button> --}}
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

            <div class="modal fade" id="modal_edit_ba" data-backdrop="static">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Berita Acara Ujian</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                        <form id="form_edit_ba" method="POST">
                            <div class="modal-body">
                                <input class="form-control" type="hidden" name="eid" id="eid">
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3">Date</label>
                                    <div class="col-md-6">
                                        <input class="form-control" type="date" name="tgl_ujian" id="etgl_ujian">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Jenis Ujian</label>
                                    <div class="col-sm-6">
                                        <select class="form-control" name="jenis_ujian" id="ejenis_ujian"
                                            width="100%">
                                            <option value="">Pilih</option>
                                            <option value="uts">UTS</option>
                                            <option value="uas">UAS</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-time-input" class="col-sm-3 col-form-label">Jam Mulai</label>
                                    <div class="col-sm-6">
                                        <input class="form-control" type="time" name="jam_mulai" id="ejam_mulai">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-time-input" class="col-sm-3 col-form-label">Jam Selesai</label>
                                    <div class="col-sm-6">
                                        <input class="form-control" type="time" name="jam_selesai" id="ejam_selesai">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="jml_mhs" class="col-sm-3 col-form-label">Jumlah Mahasiswa</label>
                                    <div class="col-sm-4">
                                        <input class="form-control" type="number" name="jml_mhs" id="ejml_mhs">
                                        <span class="text-danger" style="font-size: 0.8em">Jumlah NIM dalam
                                            presensi</span>
                                    </div>
                                </div>
                                {{-- <div class="form-group row">
                                    <label for="jml_mhs" class="col-sm-3 col-form-label">Jumlah Hadir</label>
                                    <div class="col-sm-4">
                                        <input class="form-control" type="number" name="jml_hadir" id="ejml_hadir">
                                    </div>
                                </div> --}}
                                <div class="form-group row">
                                    <label for="jml_mhs" class="col-sm-3 col-form-label">NIM Tidak Hadir</label>
                                    <div class="col-sm-4">
                                        <textarea rows="4" class="form-control" name="nim_tidak_hadir" id="enim_tidak_hadir"
                                            placeholder="Contoh pengisian: 164200000001#164200000002"></textarea>
                                    </div>
                                    <div class="col-sm-4"><span class="text-danger" style="font-size: calc(0.8em);"> *
                                            Gunakan # sebagai pemisah antar nim mahasiswa, Contoh:
                                            164200000001#164200000002#1642...</span></div>
                                </div>
                            </div>
                            <div class="modal-footer float-right">
                                <button type="button" class="btn btn-rounded btn-warning btn-outline mr-1"
                                    data-dismiss="modal">
                                    <i class="fa fa-times"></i> Close
                                </button>
                                <button type="submit" class="btn btn-rounded btn-primary btn-outline" id="btubah_ba">
                                    <i class="ti-save-alt"></i> Save
                                </button>
                            </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

            <div class="modal fade" id="modal_lihat_mhs" data-backdrop="static" tabindex="-1" role="dialog"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Daftar Mahasiswa Tidak Hadir Ujian</h5>
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

        </section>
        <!-- /.content -->
    </div>
@endsection
@section('script-master')
    <script type="text/javascript">
        cetakbaujian = function cetakbaujian(id_ba_ujian) {
            var link = ""
            $("#printff")
                .attr("src", "{{ url('akademik/cetak/cetakberitaacaraujian') }}/" + id_ba_ujian + "")
                .appendTo("body");
        }

        $(document).ready(function() {
            var token = "{{ Session::get('token') }}";
            var userlogin = "{{ Session::get('username') }}";

            var kd_prodi = $('#kode_prodi').val();

            // var kode_prodi = $('#kode_prodi').val();
            var tahun = $('#tahun').val();
            var semester = $('#semester').val();
            // var tipe = $('#tipe').val();
            var kode_dosen = $('#kode_dosen').val();

            var table = $("#tbmakulpenawaran").DataTable({
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
                    url: "{{ config('setting.second_url') }}akademik/makulpenawaran-ba-ujian",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    data: {
                        tahun: tahun,
                        semester: semester,
                        kode_dosen: kode_dosen
                    },
                    dataSrc: function(json) {
                        return json;
                    }
                },
                columns: [{
                        data: null,
                        className: 'text-center',
                        render: function(data, type, full, meta) {
                            return '<a href="javascript:void(0)" class="text-warning" id="bt_modal_list" data-id="' +
                                full.id_kelas +
                                '" data-original-title="List BA" data-toggle="tooltip" title="List BA"><i class="fa fa-list"></i></a>';
                            // '<a href="javascript:void(0)" class="text-primary" id="bt_modal_add" data-id="' +
                            //     full.id_kelas +
                            //     '" data-original-title="Tambah BA" data-toggle="tooltip" title="Tambah BA"><i class="fa fa-plus"></i></a> | <a href="javascript:void(0)" class="text-success" id="bt_modal_presensi" data-id="' + full.id_kelas + '" data-nama="' + full.nama_matakuliah + '" data-original-title="Presensi Mahasiswa" data-toggle="tooltip" title="Presensi Mahasiswa"><i class="fa fa-user"></i></a> | 
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
                        data: 'semester'
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

            // $('#modal_add').on('hidden.bs.modal', function(e) {
            //     tdetail.clear().draw();
            //     $(".selectba,.selectmakul2").val([]).trigger("change");
            // });

            function autopertemuanba(id) {
                $.ajax({
                    url: "{{ config('setting.second_url') }}akademik/autopertemuan-ba",
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
                        $("#pertemuan").val(result.urut);
                    }
                });
            };

            // function autopertemuanpresensi(id) {
            //     $.ajax({
            //         url: "{{ config('setting.second_url') }}akademik/autopertemuan-presensi-mhs",
            //         method: "POST",
            //         data: {
            //             id_kelas: id
            //         },
            //         dataType: 'json',
            //         success: function(result) {
            //             $("#pertemuan_presensi").val(result.urut);
            //         }
            //     });
            // };

            //save
            $('#form_add').on('submit', function(event) {
                event.preventDefault();
                var form_data = $(this).serialize();
                $.ajax({
                    url: "{{ config('setting.second_url') }}akademik/simpan-ba",
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

            table.on('click', '#bt_modal_presensi', function() {
                $tr = $(this).closest('tr');
                var data = table.row($tr).data();
                var id_kelas = $(this).data('id');
                var nama = $(this).data('nama');
                $('#nama_mk').html(nama);
                $('#modal_presensi').modal('show');
                $('#id_kls_presensi').val(id_kelas);
                // autopertemuanpresensi(id_kelas);
                tabellistpresensi(id_kelas);
                select_ba(id_kelas);
            });


            table.on('click', '#bt_modal_add', function() {
                $tr = $(this).closest('tr');
                var data = table.row($tr).data();
                $('#id_kelas').val(data['id_kelas']);
                var id_kelas = $(this).data('id');
                autopertemuanba(id_kelas);
                $('#modal_add').modal('show');

            });

            table.on('click', '#bt_modal_list', function() {
                $tr = $(this).closest('tr');
                var data = table.row($tr).data();
                var id_kelas = data['id_kelas'];
                tabelba(id_kelas);
                $('#modal_list').modal('show');
            });

            var tdetail;

            function tabelba(id) {
                tdetail = $('#tbba').DataTable({
                    bInfo: false,
                    bPaginate: false,
                    bLengthChange: false,
                    bFilter: false,
                    destroy: true,
                    order: false,
                    ajax: {
                        type: "GET",
                        url: "{{ config('setting.second_url') }}akademik/list-ba-ujian",
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
                            name: "aksi",
                            width: '5%',
                            className: "text-center",
                            orderable: false,
                            render: (data, type, full, meta) => {
                                return '<a href="#" class="text-info" id="bt_print" data-original-title="Print BA Ujian" data-toggle="tooltip" title="Print BA Ujian" onclick="cetakbaujian(' +
                                    full.id_ba_ujian +
                                    ');"><i class="fa fa-print"></i></a> | <a href="#" id="bt_edit_ba"><i class="fa fa-edit"></i></a>';
                            }
                        },
                        {
                            data: "tgl_indo",
                            orderable: false
                        },
                        {
                            data: null,
                            className: 'text-center',
                            render: function(data, type, full, meta) {

                                return full.jenis_ujian.toUpperCase();
                            }
                        },
                        {
                            data: "jam_mulai",
                            orderable: false
                        },
                        {
                            data: "jam_selesai",
                            className: "text-center",
                            orderable: false
                        },
                        {
                            data: "jml_mhs",
                            className: "text-center",
                            orderable: false
                        },
                        {
                            data: "jml_hadir",
                            className: "text-center",
                            orderable: false
                        },
                        {
                            data: null,
                            className: 'text-center',
                            render: function(data, type, full, meta) {
                                var alpha = (full.nim_tidak_hadir == "0" || full.nim_tidak_hadir ==
                                    null) ? "0" : full.nim_tidak_hadir.split("#").length;
                                return '<a href="javascript:void(0)" class="text-info mr-10" id="btlihatnim" data-mhs="' +
                                    full.nim_tidak_hadir +
                                    '" data-toggle="tooltip" title="List NIM Mahasiswa">' + alpha +
                                    '</a>'
                            }
                        }
                    ],
                });

                tdetail.on('click', '#btlihatnim',
                    function() {
                        $tr = $(this).closest('tr');
                        // $('#modal_lihat_mhs').modal('show');
                        var id = $(this).data('id');
                        var mhs = $(this).data('mhs');
                        tblistnim(mhs);
                    });

                tdetail.on('click', '#bt_edit_ba', function() {
                    $tr = $(this).closest('tr');
                    var data = tdetail.row($tr).data();
                    var id = data['id_ba_ujian'];
                    var tgl_ujian = data['tgl_ujian'];
                    var jenis_ujian = data['jenis_ujian'];
                    var jml_mhs = data['jml_mhs'];
                    var jml_hadir = data['jml_hadir'];
                    var jam_mulai = data['jam_mulai'];
                    var jam_selesai = data['jam_selesai'];
                    var nim_tidak_hadir = data['nim_tidak_hadir'];
                    console.log(nim_tidak_hadir);
                    $('#eid').val(id);
                    $('#etgl_ujian').val(tgl_ujian);
                    $('#ejenis_ujian').val(jenis_ujian);
                    $('#ejml_mhs').val(jml_mhs);
                    $('#ejml_hadir').val(jml_hadir);
                    $('#ejam_mulai').val(jam_mulai);
                    $('#ejam_selesai').val(jam_selesai);
                    // $("#enim_tidak_hadir").select2().val(nim_tidak_hadir).trigger('change');
                    $("#enim_tidak_hadir").text(nim_tidak_hadir);
                    $('#modal_edit_ba').modal('show');

                });

            }


            $('#form_edit_ba').on('submit', function(event) {
                event.preventDefault();
                var form_data = $(this).serialize();
                $.ajax({
                    url: "{{ config('setting.second_url') }}akademik/ubah-ba",
                    method: "POST",
                    data: form_data,
                    dataType: "json",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    beforeSend: function() {
                        $("#btubah_ba").prop('disabled', true);
                    },
                    success: function(data) {
                        if (data.error) {
                            showToastr('error', 'Error!', data.error);
                            tdetail.ajax.reload();
                            $("#btubah_ba").prop('disabled', false);
                        } else if (data.success) {
                            $('#modal_edit_ba').modal('hide');
                            showToastr('success', 'Success!', data.success);
                            tdetail.ajax.reload();
                            $("#btubah_ba").prop('disabled', false);
                        }
                    }
                })
            });

            function tblistnim(mhs) {
                $('#modal_lihat_mhs').modal('show');
                var jal = /#/.test(mhs) == false ? mhs : mhs.replace(/#/g, ",");
                console.log(jal);

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
                            nim: jal
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

            // function tabellistpresensi(id){

            //             $.ajax({
            //                 type: 'POST',
            //                 // headers: {
            //                 //     "Authorization": 'Bearer ' + token
            //                 // },
            //                 dataType: "json",
            //                 url: "{{ config('setting.second_url') }}akademik/presensi-mhs",
            //                 data: {
            //                     nama: nama
            //                 },
            //                 success: function(data) {
            //                     var jml = data.data.length;
            //                     var no = 1;
            //                     var tampil = '';
            //                     for (var i = 0; i < jml; i++) {
            //                         tampil = tampil + '<tr><td>' + data.data[i].ke + '</td><td>' + data
            //                             .data[i].dosen1 + '</td><td><center>' + data.data[i].hari +
            //                             '</center></td><td><center>' + data.data[i].jam +
            //                             '</center></td><td><center>' + data.data[i].tgl +
            //                             '</center></td></tr>';
            //                         no++;
            //                     }
            //                     $('#detailjadwal').html(tampil);
            //                     console.log(jml)
            //                     $('#lihatdetailjad').modal();
            //                 }
            //             });
            // }


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
            // hapus
            //     table.on('click', '.del[data-id]', function (e) { 
            //     e.preventDefault();     
            //     var id = $(this).data('id');
            //     swal({   
            //         title: "Apa anda yakin?",   
            //         text: "Kamu tidak akan bisa mengembalikan data!",   
            //         type: "warning",   
            //         showCancelButton: true,   
            //         confirmButtonColor: "#DD6B55",   
            //         confirmButtonText: "Ya, hapus !",   
            //         cancelButtonText: "Tidak, batal !",   
            //         closeOnCancel: false 
            //     }, function(isConfirm){   
            //         if (isConfirm) { 
            //             $.ajax({
            //               url: "{{ config('setting.second_url') }}akademik/hapus-makulprasyarat",              
            //               type: 'GET',
            //               data: {id:id},                
            //               dataType: 'json',
            //                 success: function (data) {
            //                   if(data.gagal){
            //                     showToastr('error', 'Error!', data.gagal); 
            //                   }
            //                   else if(data.berhasil)
            //                   {  
            //                     showToastr('success', 'Success!', data.berhasil);                              
            //                     table.ajax.reload();                                
            //                   }
            //                 }
            //             }) 
            //         } else {     
            //             swal("Cancelled", "Data kamu aman! :)", "error");   
            //         } 
            //     });
            // });

        });
    </script>
@stop
