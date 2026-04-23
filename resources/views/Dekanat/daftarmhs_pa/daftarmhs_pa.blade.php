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
                    <h6 class="box-subtitle">Melihat Daftar Mahasiswa</h6>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <div class="box">
                        <div class="box-body ribbon-box bg-primary-light">
                            <div class="ribbon ribbon-info">informasi</div>
                            @php
                                $smstr = '';
                                if ($session_semester == '1') {
                                    $smstr = 'Ganjil';
                                } else {
                                    $smstr = 'Genap';
                                }
                            @endphp
                            <p class="mb-0">Daftar Mahasiswa Pembimbing Akademik (Tahun Ajaran
                                {{ $session_tahun }}/{{ $session_tahun + 1 }} {{ $smstr }})</p>
                        </div> <!-- end box-body-->

                    </div>
                    <div class="table-responsive">
                        <input class="form-control" type="hidden" name="tahun" id="tahun"
                            value="{{ $session_tahun }}">
                        <input class="form-control" type="hidden" name="semester" id="semester"
                            value="{{ $session_semester }}">
                        <input class="form-control" type="hidden" name="kode_fakultas" id="kode_fakultas"
                            value="{{ $session_kode_fakultas }}">
                        <input class="form-control" type="hidden" name="jabatan" id="jabatan"
                            value="{{ $session_jabatan }}">
                        <table id="tbdaftarmhs_pa" class="table table-hover table-sm" width="100%">
                            <thead class="bg-dark">
                                <tr>
                                    <th>No</th>
                                    <th>NIM</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>Angkatan</th>
                                    <th>Prodi</th>
                                    <th>No. HP</th>
                                    <th>Agama</th>
                                    <th>Kelas</th>
                                    <th>Dosen Wali</th>
                                    <th>Registrasi</th>
                                    <th>Status KRS</th>
                                    <th>Status Herregistrasi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                </div>
                <!-- /.box-body -->
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

            var table = $("#tbdaftarmhs_pa").DataTable({
                destroy: true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel'
                ],
                // responsive: true,
                // autoWidth: false,
                pageLength: 50,
                processing: true,
                lengthChange: true,
                // searching: false,
                // serverSide: true,
                orderable: false,
                // order: [[ 1, 'asc' ]],
                ajax: {
                    type: "GET",
                    url: "{{ config('setting.second_url') }}dekanat/daftarmhs-pa",
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
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'nim',
                        className: 'text-center'
                    },
                    {
                        data: 'nama_mahasiswa'
                    },
                    {
                        data: 'tahun_angkatan',
                        className: 'text-center'
                    },
                    {
                        data: 'nama_program_studi'
                    },
                    {
                        data: 'no_hp',
                        className: 'text-center'
                    },
                    {
                        data: 'nama_agama',
                        className: 'text-center'
                    },
                    {
                        data: 'nama_program_pendidikan',
                        className: 'text-center'
                    },
                    {
                        data: 'dosen_wali',
                        className: 'text-center'
                    },
                    {
                        data: null,
                        render: function(data, type, full, meta) {
                            if (full.tahun_angkatan == null || full.tahun_angkatan == "") {
                                return '';
                            } else {
                                var smt = "";
                                if (full.smtmhs == '1') {
                                    smt = 'Ganjil';
                                } else {
                                    smt = "Genap";
                                }
                                return full.tahun_angkatan + ' ' + smt;
                            }
                        }
                    },
                    {
                        data: null,
                        render: function(data, type, row, meta) {
                            var warna = (row.status_krs == 'KRS') ? 'text-success' : 'text-danger';
                            var icon = (row.status_krs == 'KRS') ?
                                '<i class="fa fa-check-circle-o" aria-hidden="true"></i>' :
                                '<i class="fa fa-times-circle-o" aria-hidden="true"></i>';
                            return '<span class="' + warna + '" title="Status Mahasiswa">' + icon +
                                ' ' + row.status_krs + '</span>'
                        }
                    },
                    {
                        data: null,
                        render: function(data, type, row, meta) {
                            var warna = (row.cekher != null) ? 'text-success' : 'text-danger';
                            var textnya = (row.cekher != null) ? 'Sudah Herregistrasi' :
                                'Belum Herregistrasi';
                            var icon = (row.cekher != null) ?
                                '<i class="fa fa-check-circle-o" aria-hidden="true"></i>' :
                                '<i class="fa fa-times-circle-o" aria-hidden="true"></i>';
                            return '<span class="' + warna + '" title="Status Mahasiswa">' + icon +
                                ' ' + textnya + '</span>'
                        }
                    }
                ],
                order: []
            });



        });
    </script>
@stop
