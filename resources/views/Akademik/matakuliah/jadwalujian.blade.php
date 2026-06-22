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
                    <h3 class="page-title">Jadwal Ujian</h3>
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
                    <h6 class="box-subtitle">Melihat Jadwal Ujian</h6>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <div class="box">
                        <div class="box-body ribbon-box bg-primary-light">
                            <div class="ribbon ribbon-info">informasi</div>
                            <p class="mb-0">Jadwal Ujian yang ditampilkan
                                {{ $session_nama_tahunakademik }}</p>
                        </div> <!-- end box-body-->

                    </div>
                    <div class="box-header no-border">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <select class="form-control" name="programstudi" id="programstudi">
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <button type="button" class="btn btn-sm btn-info" id="btn_modal_import" style="display:none; margin-top: 4px;">
                                    <i class="ti-import"></i> Import Massal
                                </button>
                            </div>
                        </div>
                        <div id="alert-import-container" class="mt-2"></div>
                    </div>
                    <div class="table-responsive">
                        <table id="tbmakulpenawaran" class="table table-hover table-striped">
                            <thead class="bg-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Matakuliah</th>
                                    <th>SKS</th>
                                    <th>Kelas</th>
                                    <th>Hari & Tanggal</th>
                                    <th>Ruang</th>
                                    <th>Waktu</th>
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
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Input Penawaran Matakuliah</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                        <form id="form_add" method="POST">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label id="nama_prodi"></label>
                                    <input class="form-control" type="hidden" name="kode_prodi" id="kode_prodi">

                                </div>
                                <div class="pull-right">
                                    <button type="button" class="btn btn-sm btn-primary" id="addrow"><i
                                            class="ti-plus"></i></button>
                                </div>
                                <div class="form-group table-responsive">
                                    <input class="form-control" type="hidden" name="tahun" id="tahun"
                                        value="{{ $session_tahun }}">
                                    <input class="form-control" type="hidden" name="semester" id="semester"
                                        value="{{ $session_semester }}">
                                    <input class="form-control" type="hidden" name="kode_fakultas" id="kode_fakultas"
                                        value="{{ $session_kode_fakultas }}">
                                    <input class="form-control" type="hidden" name="jabatan" id="jabatan"
                                        value="{{ $session_jabatan }}">

                                    <table id="blanktable" class="table table-hover table-sm" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Mata Kuliah</th>
                                                <th>Hari</th>
                                                <th>Jam Mulai</th>
                                                <th>Jam Selesai</th>
                                                <th>Ruang</th>
                                                <th>Kelas</th>
                                                <th>Dosen</th>
                                                <th>Dosen 2</th>
                                                <th>Kaps.</th>
                                                <th>Aksi</th>
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
                                <button type="submit" class="btn btn-rounded btn-primary btn-outline">
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
                            <h4 class="modal-title">Edit Jadwal Ujian</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                        <form id="form_edit" method="POST">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Kode Matakuliah</label>
                                    <input class="form-control" type="hidden" name="id_tawar" id="id_tawar">
                                    <input class="form-control" type="hidden" name="id_kelas" id="id_kelas">
                                    <input class="form-control" type="hidden" name="ekode_prodi" id="ekode_prodi"
                                        readonly>
                                    <input class="form-control" type="text" name="ekode_matakuliah"
                                        id="ekode_matakuliah" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Nama Mata Kuliah</label>
                                    <input class="form-control" type="text" name="enama_matakuliah"
                                        id="enama_matakuliah" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Nama Kelas</label>
                                    <input class="form-control" type="text" name="enama_kelas" id="enama_kelas"
                                        readonly>
                                </div>
                                <div class="form-group">
                                    <label>Ruang</label>
                                    <input type="text" class="form-control" name="eruang" id="eruang"
                                        placeholder="Ruang">
                                </div>
                                <div class="form-group">
                                    <label>Hari</label>
                                    <select name="ehari" id="ehari" class="form-control">
                                        <option value="Senin" selected>Senin</option>
                                        <option value="Selasa">Selasa</option>
                                        <option value="Rabu">Rabu</option>
                                        <option value="Kamis">Kamis</option>
                                        <option value="Jumat">Jumat</option>
                                        <option value="Sabtu">Sabtu</option>
                                        <option value="Minggu">Minggu</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Ujian</label>
                                    <input type="date" class="form-control" name="etgl" id="etgl"
                                        placeholder="Tanggal Ujian">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Jam Mulai</label>
                                            <input type="time" class="form-control" name="ejam_mulai" id="ejam_mulai"
                                                placeholder="Jam Mulai">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Jam Selesai</label>
                                            <input type="time" class="form-control" name="ejam_selesai"
                                                id="ejam_selesai" placeholder="Jam Selesai">
                                        </div>
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

            {{-- modal import --}}
            <div class="modal fade" id="modal_import" data-backdrop="static" tabindex="-1" role="dialog">
                <form id="form_import_jadwal" method="POST" enctype="multipart/form-data">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Import Massal Jadwal Ujian</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <strong style="color: maroon;"><i class="fa fa-file-excel-o"></i> Download Template Pengisian</strong>
                                    <p class="text-muted" style="font-size: 15px">
                                        <a href="javascript:void(0)" id="link_download_template"><u>Klik di sini untuk mengunduh template</u></a>
                                    </p>
                                </div>
                                <div class="form-group">
                                    <label>Pilih File Excel Jadwal Ujian</label>
                                    <input type="file" class="form-control" name="fileimport" id="fileimport" required>
                                    <span class="text-danger font-italic">* Harus berupa ekstensi .xls atau .xlsx</span>
                                </div>
                            </div>
                            <div class="modal-footer text-right">
                                <button type="button" class="btn btn-rounded btn-warning btn-outline mr-1" data-dismiss="modal">
                                    <i class="fa fa-times"></i> Tutup
                                </button>
                                <button type="submit" class="btn btn-rounded btn-primary btn-outline" id="btn_submit_import">
                                    <i class="fa fa-upload"></i> Upload & Proses
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
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
                        tbnilai(nama_program_studi);
                    }
                })
            }

            $('#programstudi').on('change', function(event) {
                var nama_program_studi = $('#programstudi').val();
                tbnilai(nama_program_studi);
            });


            function tbnilai(nama_program_studi) {
                var kode_fakultas = $('#kode_fakultas').val();
                var tahun = $('#tahun').val();
                var semester = $('#semester').val();
                var jabatan = $('#jabatan').val();
                var table = $("#tbmakulpenawaran").DataTable({
                    destroy: true,
                    dom: 'l<br>Bfrtip',
                    buttons: [
                        'copy', 'csv', 'excel'
                    ],
                    processing: true,
                    lengthChange: true,
                    ajax: {
                        type: "GET",
                        url: "{{ config('setting.second_url') }}akademik/makulpenawaran",
                        headers: {
                            "Authorization": 'Bearer ' + token,
                            "username": userlogin
                        },
                        data: {
                            nama_program_studi: nama_program_studi,
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
                            render: function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }
                        },
                        {
                            data: 'kode_matakuliah'
                        },
                        {
                            data: 'nama_matakuliah'
                        },
                        {
                            data: 'sks_matakuliah'
                        },
                        {
                            data: 'nama_kelas'
                        },
                        {
                            data: null,
                            render: function(data, type, full, meta) {
                                const formatTanggal = function(tanggal) {
                                    if (!tanggal)
                                        return ''; // Jika null, kembalikan string kosong
                                    const date = new Date(
                                        tanggal); // Pastikan tipe data adalah Date
                                    const day = String(date.getDate()).padStart(2,
                                        '0'); // Tambahkan 0 jika kurang dari 10
                                    const month = String(date.getMonth() + 1).padStart(2,
                                        '0'); // Bulan mulai dari 0
                                    const year = date.getFullYear();
                                    return `${day}/${month}/${year}`;
                                };

                                const ujianHari = full.ujian_hari ? full.ujian_hari : '';
                                const ujianTanggal = full.ujian_tanggal ? formatTanggal(full
                                    .ujian_tanggal) : '';
                                return ujianHari + (ujianHari && ujianTanggal ? ', ' : '') +
                                    ujianTanggal;
                            }
                        },
                        {
                            data: 'ujian_kode_ruang'
                        },
                        {
                            data: 'ujianwaktu'
                        },
                        {
                            data: null,
                            render: function(data, type, full, meta) {
                                return '<a href="javascript:void(0)" class="btn btn-info btn-xs" id="bt_edit" data-toggle="tooltip" data-original-title="Edit"><i class="ti-marker-alt"></i> Edit Jadwal</a>';
                            }
                        },

                    ],
                    order: []
                });





                // show data edit
                table.on('click', '#bt_edit', function() {
                    $tr = $(this).closest('tr');
                    var data = table.row($tr).data();
                    $('#modal_edit').modal('show');
                    $('#id_tawar').val(data['id_tawar']);
                    $('#id_kelas').val(data['id_kelas']);
                    $('#ekode_matakuliah').val(data['kode_matakuliah']);
                    $('#enama_matakuliah').val(data['nama_matakuliah']);
                    $('#enama_kelas').val(data['nama_kelas']);
                    $('#eruang').val(data['ujian_kode_ruang']);
                    $('#ehari').val(data['ujian_hari']);
                    $('#ejam_mulai').val(data['ujian_jam_mulai']);
                    $('#ejam_selesai').val(data['ujian_jam_selesai']);
                    $(".modal-body #ekode_prodi").val(data['kode_program_studi']);
                    event.stopImmediatePropagation();
                });

                // edit
                $('#form_edit').on('submit', function(event) {
                    event.preventDefault();
                    var form_data = $(this).serialize();
                    $.ajax({
                        url: "{{ config('setting.second_url') }}akademik/edit-jadwalujian",
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

                // Import Massal logic
                if ($('#programstudi').val()) {
                    $('#btn_modal_import').show();
                } else {
                    $('#btn_modal_import').hide();
                }

                $('#btn_modal_import').off('click').on('click', function() {
                    $('#modal_import').modal('show');
                    $('#fileimport').val('');
                    $('#alert-import-container').html('');
                });

                $('#link_download_template').off('click').on('click', function() {
                    var prodi = $('#programstudi').val();
                    var query = {
                        tahun: "{{ $session_tahun }}",
                        semester: "{{ $session_semester }}",
                        nama_program_studi: prodi
                    };
                    var url = "{{ config('setting.second_url') }}akademik/jadwalujian/export-template?" + $.param(query);
                    window.location = url;
                });

                $('#form_import_jadwal').off('submit').on('submit', function(e) {
                    e.preventDefault();
                    $('#alert-import-container').html('');
                    
                    var formData = new FormData(this);
                    
                    $.ajax({
                        url: "{{ config('setting.second_url') }}akademik/jadwalujian/import",
                        method: "POST",
                        headers: {
                            "Authorization": 'Bearer ' + token,
                            "username": userlogin
                        },
                        data: formData,
                        processData: false,
                        contentType: false,
                        cache: false,
                        beforeSend: function() {
                            $('#btn_submit_import').prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Memproses...');
                        },
                        success: function(data) {
                            $('#btn_submit_import').prop('disabled', false).html('<i class="fa fa-upload"></i> Upload & Proses');
                            $('#modal_import').modal('hide');
                            table.ajax.reload();
                            
                            if (data.status === 'error') {
                                let alertHtml = '<div class="alert alert-warning alert-dismissible">';
                                alertHtml += '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
                                alertHtml += '<h4><i class="icon fa fa-warning"></i> Log Peringatan Import Ujian !</h4>';
                                alertHtml += '<p>' + data.message + '</p>';
                                alertHtml += '<ul class="pl-4">';
                                data.messages.forEach(function(msg) {
                                    alertHtml += '<li>' + msg + '</li>';
                                });
                                alertHtml += '</ul></div>';
                                
                                $('#alert-import-container').html(alertHtml);
                                showToastr('warning', 'Selesai dengan error', 'Beberapa baris gagal diproses. Cek log error.');
                            } else if (data.status === 'success') {
                                showToastr('success', 'Sukses!', data.message);
                            }
                        },
                        error: function(xhr) {
                            $('#btn_submit_import').prop('disabled', false).html('<i class="fa fa-upload"></i> Upload & Proses');
                            $('#modal_import').modal('hide');
                            
                            let response = xhr.responseJSON ? xhr.responseJSON : { messages: ['Gagal melakukan koneksi dengan API Backend.'] };
                            let alertHtml = '<div class="alert alert-danger alert-dismissible">';
                            alertHtml += '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
                            alertHtml += '<h4><i class="icon fa fa-ban"></i> Kegagalan Sistem Import!</h4><ul class="pl-4">';
                            
                            if (Array.isArray(response.messages)) {
                                response.messages.forEach(function(msg) {
                                    alertHtml += '<li>' + msg + '</li>';
                                });
                            } else {
                                alertHtml += '<li>' + response.messages + '</li>';
                            }
                            alertHtml += '</ul></div>';
                            
                            $('#alert-import-container').html(alertHtml);
                            showToastr('error', 'Gagal', 'Terjadi kesalahan sistem saat memproses file.');
                        }
                    });
                });

            }

        });
    </script>
@stop
