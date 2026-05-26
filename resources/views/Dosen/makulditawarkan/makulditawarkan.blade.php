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
                    <h3 class="page-title">Mata Kuliah Ditawarkan</h3>
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
                    <h6 class="box-subtitle">Melihat Daftar Mata Kuliah Ditawarkan</h6>
                </div>

                <div class="box-body">
                    <div class="box">
                        <div class="box-body ribbon-box bg-primary-light">
                            <div class="ribbon ribbon-info">informasi</div>
                            <p class="mb-0">Daftar Mata Kuliah ditawarkan pada Program Studi Anda untuk Semester <strong>{{ $session_nama_tahunakademik }}</strong></p>
                        </div>
                    </div>
                    
                    <div class="table-responsive">
                        <input class="form-control" type="hidden" name="tahun" id="tahun" value="{{ $session_tahun }}">
                        <input class="form-control" type="hidden" name="semester" id="semester" value="{{ $session_semester }}">
                        <input class="form-control" type="hidden" name="kode_prodi" id="kode_prodi" value="{{ $session_kode_program_studi }}">
                        <input class="form-control" type="hidden" name="tipe" id="tipe" value="">
                        
                        <table id="tbmakulditawarkan" class="table table-hover table-bordered table-striped" width="100%">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th>No</th>
                                    <th>Matakuliah</th>
                                    <th>Hari</th>
                                    <th>Kelas</th>
                                    <th>Ruang</th>
                                    <th>Waktu</th>
                                    <th>Dosen Pengampu</th>
                                    <th>Kapasitas</th>
                                    <th>Peserta</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('script-master')
    <script type="text/javascript">
        $(document).ready(function() {
            var token = "{{ Session::get('token') }}";
            var userlogin = "{{ Session::get('username') }}";

            var kode_prodi_session = $('#kode_prodi').val();
            var tahun = $('#tahun').val();
            var semester = $('#semester').val();

            // Fetch the program study list to look up the department's name matching the session's kode_program_studi
            $.ajax({
                type: 'GET',
                url: "{{ config('setting.second_url') }}akademik/tampilprogramstudi",
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                success: function(result) {
                    var nama_program_studi = "";
                    for (var i = 0; i < result.length; i++) {
                        if (result[i].kode_program_studi == kode_prodi_session) {
                            nama_program_studi = result[i].nama_program_studi;
                            break;
                        }
                    }
                    // Load datatable once the prodi name is resolved
                    initDataTable(nama_program_studi);
                },
                error: function() {
                    // Fallback to load datatable anyway
                    initDataTable("");
                }
            });

            function initDataTable(nama_program_studi) {
                $("#tbmakulditawarkan").DataTable({
                    destroy: true,
                    dom: 'lBfrtip',
                    buttons: [
                        'copy', 'csv', 'excel'
                    ],
                    pageLength: 10,
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
                            tahun: tahun,
                            semester: semester,
                            nama_program_studi: nama_program_studi,
                            tipe: '' // Clear tipe to get all department courses (not just the ones taught by the lecturer)
                        },
                        dataSrc: function(json) {
                            return json;
                        }
                    },
                    columns: [
                        {
                            data: null,
                            render: function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }
                        },
                        {
                            data: null,
                            render: function(data, type, row) {
                                return `<strong>${row.nama_matakuliah}</strong><br>
                                        <small class="text-muted">${row.kode_matakuliah} | Semester: ${row.smt_matakuliah} | SKS: ${row.sks_matakuliah}</small>`;
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
                            render: function(data, type, row) {
                                if (row.dosen2 && row.dosen2.trim() !== '') {
                                    return `${row.dosen1}<br><small class="text-muted">${row.dosen2}</small>`;
                                } else {
                                    return row.dosen1 || '-';
                                }
                            }
                        },
                        {
                            data: 'kapasitas_ruang',
                            className: 'text-center'
                        },
                        {
                            data: 'jumlah_peserta',
                            className: 'text-center'
                        }
                    ],
                    order: []
                });
            }
        });
    </script>
@stop
