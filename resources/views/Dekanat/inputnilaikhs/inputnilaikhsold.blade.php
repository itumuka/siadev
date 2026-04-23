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
                    <h6 class="box-subtitle">Melihat Mata Kuliah Fakultas</h6>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <div class="box">
                        <div class="box-body ribbon-box bg-primary-light">
                            <div class="ribbon ribbon-info">Informasi</div>
                            <p class="mb-0">Berikut pilihan Mata Kuliah untuk input nilai UTS/UAS Mahasiswa Admin Fakultas
                            </p>
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
                                    <th>SKS</th>
                                    <th>Smt</th>
                                    <th>Dosen</th>
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
                // responsive: true,
                // autoWidth: false,
                pageLength: 50,
                processing: true,
                lengthChange: true,
                // searching: false,
                // serverSide: true,
                // stateSave: true,
                // scrollX: true,
                orderable: false,
                // order: [[ 1, 'asc' ]],
                // fixedColumns: {
                //   leftColumns: 2
                // },
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

                            var btnuts =
                                '<a href="{{ route('dknform_input_nilai_uts_akademik') }}?id_kelas=' +
                                full.id_kelas +
                                '" class="btn btn-xs btn-info" title="Lihat Form Input Nilai UTS"><i class="fa fa-pencil"></i> UTS</a>';

                            var btnuas =
                                '<a href="{{ route('dknform_input_nilai_uas_akademik') }}?id_kelas=' +
                                full.id_kelas +
                                '" class="btn btn-xs btn-primary" title="Lihat Form Input Nilai UAS"><i class="fa fa-pencil"></i> UAS</a>';

                            return btnuts + ' | ' + btnuas;
                        }
                    },
                    {
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
                        data: 'nama_kelas'
                    },
                    {
                        data: 'sks_matakuliah'
                    },
                    {
                        data: 'tahun_akademik'
                    },
                    {
                        data: 'fullname'
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


        });
    </script>
@stop
