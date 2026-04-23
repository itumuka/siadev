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
                        <h6 class="box-subtitle">{{ $child_breadcrumb }}</h6>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row no-print">
                            <div class="col-12">
                                <a href="javascript:void(0)" type="button" class="btn btn-sm btn-success"
                                    data-toggle="modal" data-target="#modal_import"><i class="ti-import"></i> Import
                                </a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <input class="form-control" type="hidden" name="tahun" id="tahun"
                                value="{{ $session_tahun }}">
                            <input class="form-control" type="hidden" name="semester" id="semester"
                                value="{{ $session_semester }}">
                            <input class="form-control" type="hidden" name="kode_fakultas" id="kode_fakultas"
                                value="{{ $session_kode_fakultas }}">
                            <input class="form-control" type="hidden" name="id_kelas" id="id_kelas"
                                value="{{ $id_kelas }}">
                            <table id="tbmhs_inputnilai" class="table table-hover table-sm" width="100%">
                                <thead class="bg-dark">
                                    <tr>
                                        <th>Nilai</th>
                                        {{-- <th>&nbsp;&nbsp;&nbsp;UAS&nbsp;&nbsp;&nbsp;</th> --}}
                                        <th>NIM</th>
                                        <th>Nama</th>
                                        <th>Mata Kuliah</th>
                                        <th>SKS</th>
                                        <th>Semester</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <a href="javascript: history.back()" type="button" class="btn btn-rounded btn-warning mr-1"
                            data-dismiss="modal">
                            <i class="ti-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-rounded btn-primary" id="btsavenilaikhs">
                            <i class="ti-save-alt"></i> Simpan
                        </button>
                    </div>
                    <div class="modal-footer text-right">
                        <span class="text-danger">* tombol simpan ini digunakan untuk menyimpan nilai via sistem bukan
                            import </span>
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
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="file" class="form-control" name="fileimport" id="inputGroupFile04"
                                            aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                                    </div>
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
                // lengthChange: true,
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
                        return json;
                    }
                },
                columns: [
                    // {
                    //     data: null,
                    //     render: function(data, type, row, meta) {
                    //         return meta.row + meta.settings._iDisplayStart + 1;
                    //     }
                    // },
                    {
                        name: 'nilai_uts',
                        width: '100px',
                        className: 'text-center',
                        render: function(data, type, full, meta) {

                            var nilai = (full.nilai_uts != null ? full.nilai_uts : '');

                            return '<input type="text" class="form-control p-1" name="nilai_uts[]" id="nilai_uts" value="' +
                                nilai + '" ><input type="hidden" name="tahun_kurikulum[]" value="' +
                                full.tahun_kurikulum +
                                '"><input type="hidden" name="id_detail_krs[]" value="' + full
                                .id_detail_krs +
                                '"><input type="hidden" name="id_matakuliah[]" value="' + full
                                .id_matakuliah + '"><input type="hidden" name="nim[]" value="' +
                                full.nim + '">';
                        }
                    },
                    {
                        data: 'nim'
                    },
                    {
                        data: 'nama_mahasiswa'
                    },
                    {
                        data: 'nama_matakuliah'
                    },
                    {
                        data: 'sks_matakuliah',
                        className: 'text-center'
                    },
                    {
                        data: 'smt_matakuliah',
                        className: 'text-center'
                    },
                ],
                order: [],
                drawCallback: function(setting) {

                    var api = this.api();

                    // Output the data for the visible rows to the browser's console
                    // console.log( api.rows().data().nim );

                    $('.selectnilaihuruf').select2({
                        allowClear: true,
                        placeholder: '-Select Nilai-',
                        ajax: {
                            dataType: 'json',
                            url: "{{ config('setting.second_url') }}akademik/select-predikat-nilai",
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
                    }).on('selectnilaihuruf:select', function(evt) {
                        $(".selectnilaihuruf option:selected").val();
                    });

                    // $(".selectnilaihuruf").append('<option value="'+full.nilai_akhir_huruf+'">'+full.nilai_akhir_huruf+'</option>').val(full.nilai_akhir_huruf).trigger('change');
                }
            });


            // $('#myModal').on('shown.bs.modal', function () {
            //     $('#myInput').trigger('focus')
            // })

            $("#export_template_nilai").on('click', function() {

                var query = {
                    id_kelas: id_kelas
                }

                var url = "{{ config('setting.second_url') }}akademik/template-input-nilai-uts?" + $.param(
                    query)

                window.location = url;

            });

            $('#form_save_nilaikhs').on('submit', function(event) {
                event.preventDefault();
                var form_data = $(this).serialize();
                $.ajax({
                    url: "{{ config('setting.second_url') }}akademik/simpan-nilai-uts",
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
                $.ajax({
                    url: "{{ config('setting.second_url') }}akademik/import-nilai-uts",
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
                        if (data.error) {
                            $('#modal_import').modal('hide');
                            showToastr('error', 'Error!', data.error);
                            table.ajax.reload();
                            stopSpinner();
                            // $("#btimport").prop('disabled', false);
                        } else if (data.success) {
                            $('#modal_import').modal('hide');
                            showToastr('success', 'Success!', data.success);
                            table.ajax.reload();
                            stopSpinner();
                            // $("#btimport").prop('disabled', false);
                        }
                        console.log(data);
                    },
                    error: function(xhr, status, error) {
                        stopSpinner();
                        showToastr('error', 'Error!', xhr.responseText);
                    }
                })
            })


        });
    </script>
@stop
