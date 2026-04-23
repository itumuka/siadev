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
                    <h3 class="page-title">Form Input Nilai</h3>
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
            <form id="form_save_nilaikhs" method="POST">
                <div class="box">
                    <div class="box-header with-border">
                        {{-- <h3 class="box-title">Tahun Ajaran</h3> --}}
                        <h4 class="box-subtitle">Mata Kuliah: <code  id="nama_mk"></code></h4>
                        <div id="alert-container" class="mt-2">
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row no-print">
                            <div class="col-12">
                                <a href="javascript:void(0)" type="button" class="btn btn-sm btn-success" id="tutupimport"
                                    data-toggle="modal" data-target="#modal_import"><i class="ti-import"></i> Import
                                </a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <input class="form-control" type="hidden" name="tahun" id="tahun"
                                value="{{ $session_tahun }}">
                            <input class="form-control" type="hidden" name="semester" id="semester"
                                value="{{ $session_semester }}">
                            <input class="form-control" type="hidden" name="kode_prodi" id="kode_prodi"
                                value="{{ $session_kode_program_studi }}">
                            <input class="form-control" type="hidden" name="tipe" id="tipe"
                                value="{{ $session_tipe }}">
                            <input class="form-control" type="hidden" name="kode_dosen" id="kode_dosen"
                                value="{{ $session_kode_dosen }}">
                            <input class="form-control" type="hidden" name="id_kelas" id="id_kelas"
                                value="{{ $id_kelas }}">
                            <table id="tbmhs_inputnilai" class="table table-hover table-sm" width="100%">
                                <thead class="bg-dark">
                                    <tr>
                                        {{-- <th>&nbsp;&nbsp;&nbsp;UTS&nbsp;&nbsp;&nbsp;</th> --}}
                                        <th>NIM</th>
                                        <th>Nama</th>
                                        <!--<th>SKS</th>-->
                                        <!--<th>Smt.</th>-->
                                        <th>Kehadiran</th>
                                        <th>UTS</th>
                                        <th>UAS</th>
                                        <th>Tugas 1</th> 
                                        <th>Tugas 2</th>
                                        <th>Tugas 3</th>
                                        <th>NA</th>
                                        <th>Huruf</th>
                                        <!--<th>Mutu</th>-->
                                        <!--<th>Kum</th>-->
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <a href="javascript: history.back()" type="button"
                            class="btn btn-rounded btn-warning btn-outline mr-1" data-dismiss="modal">
                            <i class="ti-arrow-left"></i> Kembali
                        </a>
                        <!--<button type="submit" class="btn btn-rounded btn-primary btn-outline" id="btsavenilaikhs">-->
                        <!--    <i class="ti-save-alt"></i> Simpan-->
                        <!--</button>-->
                    </div>
                </div>
            </form>


            <div class="modal fade" id="modal_import">
                <form id="form_import_nilai" method="POST">
                    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">

                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Bulk insert Nilai</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                            </div>

                            <div class="modal-body">
                                <div class="form-group">
                                    <strong style="color: maroon;"><i class="fa fa-file-excel-o"></i> Template.xlxs</strong>
                                    <p class="text-muted" style="font-size: 15px">
                                        <a href="javascript:void(0)" id="export_template_nilai"><u>Click here to
                                                download</u></a>
                                    </p>
                                    <p style="color: maroon;">
                                    <ul>
                                        <li style="color: maroon;">Gunakan Template tanpa mengubah strukturnya</li>
                                        <li style="color: maroon;">Dilarang mengubah data apapun, termasuk yang ada di luar tabel, kecuali yang berwarna kuning. </li>
                                        <li style="color: maroon;">Angkatan Sebelum 2024 nilai berupa <strong>A, A-, B+, B, B-, C+, C,
                                                C-, D+, D, E</strong></li>
                                        <li style="color: maroon;">Angakatan 2024 nilai berupa <strong>A, AB, B, BC, C, CD, D, DE, E</strong></li>
                                    </ul>
                                    </p>
                                </div>
                                <div class="form-group">
                                    <input type="file" class="form-control" name="fileimport" id="inputGroupFile04"
                                        aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary btn-sm" type="submit" id="btimport"><i
                                            class="fa fa-upload"></i> Upload</button>
                                </div>
                            </div>
                            <div class="modal-footer text-right">
                                <a type="button" class="btn btn-rounded btn-warning btn-outline mr-1"
                                    data-dismiss="modal">
                                    <i class="fa fa-times"></i> Close
                                </a>
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
        $(document).ready(function() {
            var token = "{{ Session::get('token') }}";
            var userlogin = "{{ Session::get('username') }}";

            var id_kelas = $('#id_kelas').val();

            var table = $("#tbmhs_inputnilai").DataTable({
                destroy: true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel'
                ],
                // responsive: true,
                autoWidth: false,
                pageLength: -1,
                processing: true,
                lengthChange: true,
                // searching: false,
                // serverSide: true,
                // stateSave: true, 
                // orderable: false,
                // fixedColumns: true,
                ajax: {
                    type: "GET",
                    url: "{{ config('setting.second_url') }}akademik/data-mhs-inputnilai",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    data: {
                        id_kelas: id_kelas
                    },
                    dataSrc: function(json) {
                        if (json.length > 0) {
                            $('#nama_mk').html(json[0].nama_matakuliah + " (" + json[0].sks_matakuliah + " sks)");
                        }

                        return json;
                    },
                },
                columns: [
                    {
                        data: 'nim'
                    },
                    {
                        data: 'nama_mahasiswa'
                    },
                    // {
                    //     data: 'sks_matakuliah',
                    //     className: 'text-center'
                    // },
                    // {
                    //     data: 'smt_matakuliah',
                    //     className: 'text-center'
                    // },
                    { data: 'kehadiran', className: "text-center" },
     				{ data: 'nilai_uts', className: "text-center", render: function(data) { return data ? parseFloat(data).toFixed(1) : ''; }},
                    { data: 'nilai_uas', className: "text-center", render: function(data) { return data ? parseFloat(data).toFixed(1) : ''; }},
                    { data: 'nilai_tugas', className: "text-center", render: function(data) { return data ? parseFloat(data).toFixed(1) : ''; }},
                    { data: 'nilai_praktek', className: "text-center", render: function(data) { return data ? parseFloat(data).toFixed(1) : ''; }},
                    { data: 'nilai_kuis', className: "text-center", render: function(data) { return data ? parseFloat(data).toFixed(1) : ''; }},
                    { data: 'nilai_akhir_angka', className: "text-center", render: function(data) { return data ? parseFloat(data).toFixed(1) : ''; }},
                    {
                        data: 'nilai_akhir_huruf',
                        className: 'text-center'
                    },
                    // {
                    //     data: 'total_nilai',
                    //     className: 'text-center', visible: false
                    // },
                ],
                order: [],
            });

            
            $("#export_template_nilai").on('click', function() {

                var query = {
                    id_kelas: id_kelas
                }


                var url = "{{ config('setting.second_url') }}akademik/template-input-nilai-uas?" + $.param(
                    query)

                window.location = url;

            });

            $('#form_save_nilaikhs').on('submit', function(event) {
                event.preventDefault();
                var form_data = $(this).serialize();
                $.ajax({
                    url: "{{ config('setting.second_url') }}akademik/simpan-nilai-uas",
                    method: "POST",
                    data: form_data,
                    dataType: "json",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    beforeSend: function() {
                        $("#btsavenilaikhs").prop('disabled', true);
                    },
                    success: function(data) {
                        if (data.error) {
                            showToastr('error', 'Error!', data.error);
                            table.ajax.reload();
                            $("#btsavenilaikhs").prop('disabled', false);
                        } else if (data.success) {
                            showToastr('success', 'Success!', data.success);
                            table.ajax.reload();
                            $("#btsavenilaikhs").prop('disabled', false);
                        }
                        console.log(data);
                    }
                })
            });
            cekkalender();

            function cekkalender() {
                var tahun = $('#tahun').val();
                var semester = $('#semester').val();
                $.ajax({
                    url: "{{ config('setting.second_url') }}akademik/cekkalenderbatasinputnilai",
                    type: 'GET',
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    data: {
                        tahun: tahun,
                        smt: semester
                    },
                    dataType: 'json',
                    success: function(data) {
                        // var date = date('Y-m-d');
                        // console.log(data);

                        // buka ketika dibutuh pembatasan input nilai

                        // if (parseInt(data.tanggalmulai) > parseInt(data.tanggalsekarang) || parseInt(
                        //         data.tanggalakhir) < parseInt(data.tanggalsekarang)) {
                        //     // $("#btsavenilaikhs").prop("disabled", true);
                        //     document.getElementById("btsavenilaikhs").style.display = "none";
                        //     document.getElementById("tutupimport").style.display = "none";
                        //     $(".tutupinputnilai").prop("disabled", true);
                        //     // $(".tutupimport").prop("disabled", true);
                        // }

                        // end

                    }
                })
                // $("#btimport").prop("disabled", true);
                // $("#btimport").html(
                //     '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...'
                // );
            }

            function startSpinner() {
                $("#btimport").prop("disabled", true);
                $("#btimport").html(
                    '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...'
                );
            }

            function stopSpinner() {
                $("#btimport").prop("disabled", false);
                $("#btimport").html('<i class="fa fa-upload"></i> Upload');
            }


            $("#form_import_nilai").on('submit', function(e) {
                e.preventDefault();

                // Hapus alert yang sebelumnya jika ada
                $("#alert-container").html("");

                $.ajax({
                    url: "{{ config('setting.second_url') }}akademik/import-nilai-uas",
                    method: "POST",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    cache: false,
                    beforeSend: function() {
                        startSpinner();
                    },
                    success: function(data) {
                        stopSpinner();

                        if (data.status === 'error') {
                            $('#modal_import').modal('hide');

                            let errorMessage = '<div class="alert alert-warning alert-dismissible">';
                            errorMessage += '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
                            errorMessage += '<h4><i class="icon fa fa-warning"></i> Alert Error Import !</h4>';

                            // Buat unordered list (UL) untuk menampilkan error sebagai teks biasa
                            errorMessage += '<ul>';
                            if (Array.isArray(data.messages)) {
                                // Jika messages berupa array
                                data.messages.forEach(function(msg) {
                                    errorMessage += `<li>${msg}</li>`;
                                });
                            } else {
                                // Jika messages hanya satu pesan
                                errorMessage += `<li>${data.messages}</li>`;
                            }
                            errorMessage += '</ul>';
                            errorMessage += '</div>';

                            // Tambahkan alert ke halaman
                            $("#alert-container").html(errorMessage);

                            table.ajax.reload();
                        } else if (data.status === 'success') {
                            $('#modal_import').modal('hide');
                            showToastr('success', 'Success!', data.message);
                            table.ajax.reload();
                        }
                    },
                    error: function(xhr) {
                        stopSpinner();
                        $('#modal_import').modal('hide');
                        let errorMessage = '<div class="alert alert-warning alert-dismissible">';
                        errorMessage += '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
                        errorMessage += '<h4><i class="icon fa fa-warning"></i> Alert Error Import !</h4>';

                        // Periksa apakah responseText mengandung format JSON atau bisa diakses sebagai JSON
                        let responseData = xhr.responseJSON ? xhr.responseJSON : { messages: [xhr.responseText] };

                        // Tampilkan kesalahan dalam list
                        errorMessage += '<ul>';
                        if (Array.isArray(responseData.messages)) {
                            // Jika messages berupa array
                            responseData.messages.forEach(function(msg) {
                                errorMessage += `<li>${msg}</li>`;
                            });
                        } else {
                            // Jika messages hanya satu pesan
                            errorMessage += `<li>${responseData.messages}</li>`;
                        }
                        errorMessage += '</ul>';

                        errorMessage += '</div>';

                        $("#alert-container").html(errorMessage);
                        table.ajax.reload();
                    }
                });
            });

        });
    </script>
@stop
