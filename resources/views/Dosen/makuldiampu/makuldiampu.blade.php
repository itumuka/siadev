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
                    <h3 class="page-title">Mata Kuliah Diampu</h3>
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
                            <p class="mb-0">Penawaran mata kuliah yang ditampilkan di Semester
                                {{ $session_nama_tahunakademik }}</p>
                        </div> <!-- end box-body-->

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
                        <table id="tbmakulpenawaran" class="table table-hover table-sm" width="100%">
                            <thead class="bg-dark">
                                <tr>
                                    <th>Aksi</th>
                                    <th>Matakuliah</th>
                                    <th>Hari</th>
                                    <th>Kelas</th>
                                    <th>Ruang</th>
                                    <th>Waktu</th>
                                    <th>Team Teach.</th>
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
            </div>

            <div class="modal fade" id="modal_add">
                <div class="modal-dialog mdoal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Tambah RPS</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                        <form id="form_update" method="POST">
                            <div class="modal-body">
                                <input class="form-control" type="hidden" name="id_tawar" id="id_tawar">
                                <div class="form-group">
                                    <label for="url_rps" class="col-form-label">URL RPS</label>
                                        <input class="form-control" type="text" name="url_rps" id="url_rps">
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

        </section>
        <!-- /.content -->
    </div>
@endsection
@section('script-master')
    <script type="text/javascript">
        $(document).ready(function() {
            var token = "{{ Session::get('token') }}";
            var userlogin = "{{ Session::get('username') }}";


            var kode_prodi = $('#kode_prodi').val();
            var tahun = $('#tahun').val();
            var semester = $('#semester').val();
            var tipe = $('#tipe').val();
            var kode_dosen = $('#kode_dosen').val();

            var table = $("#tbmakulpenawaran").DataTable({
                destroy: true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel'
                ],
                pageLength: 10,
                processing: true,
                lengthChange: true,
                orderable: false,
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
                        kode_prodi: kode_prodi,
                        tipe: tipe,
                        kode_dosen: kode_dosen
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
                        data: 'url_rps',
                        render: function(data, type, row, meta) {
                            if (data) {
                                return `<a href="javascript:void(0)" class="waves-effect waves-light btn btn-sm btn-outline btn-secondary" id="bt_modal_add" data-id="` + row.id_tawar + `"  data-original-title="Input URL RPS" data-toggle="tooltip" title="Input URL RPS"><i class="fa fa-upload"></i></a> <a href="` + row.url_rps + `" target="_blank" class="waves-effect waves-light btn btn-sm btn-outline btn-primary" title="Lihat RPS"><i class="fa fa-file-pdf-o"></i></a>`;
                            } else {
                                return `<a href="javascript:void(0)" class="waves-effect waves-light btn btn-sm btn-outline btn-secondary" id="bt_modal_add" data-id="` + row.id_tawar + `"  data-original-title="Input URL RPS" data-toggle="tooltip" title="Input URL RPS"><i class="fa fa-upload"></i></a> <a href="#" class="waves-effect waves-light btn btn-sm btn-outline btn-default" title="Lihat RPS"><i class="fa fa-file-pdf-o"></i></a>`;
                            }
                        }
                    },
                    {
                        data: null,
                        render: function(data, type, row, meta) {
                            return `
                                <strong>${row.nama_matakuliah}</strong><br>
                                Semester: ${row.smt_matakuliah} | SKS: ${row.sks_matakuliah}<br>
                                Prodi: ${row.nama_program_studi}
                            `;
                        }
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
                        data: null,
                        className: 'text-center',
                        render: function(data, type, row, meta) {
                            return (row.kode_dosen && row.kode_dosen2) 
                                ? `<button class="btn btn-success btn-xs">Ya</button>` 
                                : `<button class="btn btn-danger btn-xs">Tidak</button>`;
                        }
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

            table.on('click', '#bt_modal_add', function() {
                $tr = $(this).closest('tr');
                var data = table.row($tr).data();
                $('#modal_add').modal('show');
                var id_tawar = $(this).data('id');
                $('#id_tawar').val(id_tawar);
            });

            $('#form_update').on('submit', function(event) {
                event.preventDefault();
                var form_data = $(this).serialize();
                $.ajax({
                    url: "{{ config('setting.second_url') }}akademik/update-rps",
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
                            $("#btsubmit").prop('disabled', false);
                        } else if (data.success) {
                            $('#modal_add').modal('hide');
                            showToastr('success', 'Success!', data.success);
                            $("#btsubmit").prop('disabled', false);
                        }
                        table.ajax.reload();
                    }
                })
            });


        });
    </script>
@stop
