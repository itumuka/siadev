@extends('layout')

@section('content')
    <div class="container-full">
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">Dosen</h3>
                </div>

            </div>
        </div>
        <!-- Main content -->
        <section class="content">
            <div class="box">
                <div class="box-header with-border">
                    <h6 class="box-subtitle">Melihat Data Dosen</h6>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <div class="box">
                        <div class="box-body ribbon-box bg-primary-light">
                            <div class="ribbon ribbon-info">informasi</div>
                            <p class="mb-0">Untuk melihat Berita acara masing-masing Dosen, silahkan pilih salah satu dari
                                daftar Dosen pada {{ $session_nama_tahunakademik }}</p>
                        </div> <!-- end box-body-->
                    </div>
                    <div class="table-responsive">
                        <table id="kgtdosen" class="table table-hover table-striped" width="100%">
                            <thead class="bg-dark">
                                <tr>
                                    <th>Aksi</th>
                                    <th>NIDN</th>
                                    <th>Nama</th>
                                    <th>Prodi</th>
                                    <th>No. HP</th>
                                    <th>Email</th>
                                    <th>Dosen Wali</th>
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
            var kode_prodi = "{{ Session::get('kode_program_studi') }}";
            var kaprodi = "{{ Session::get('kaprodi') }}";;

            var table = $("#kgtdosen").DataTable({
                destroy: true,
                dom: 'l<br>Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel'
                ],
                processing: true,
                lengthChange: true,
                ajax: {
                    type: "GET",
                    url: "{{ config('setting.second_url') }}akademik/dosen",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    data: {
                        kaprodi: kaprodi,
                        kode_prodi : kode_prodi
                    },
                    dataSrc: function(json) {
                        return json;
                    }
                },
                columns: [{
                        data: null,
                        className: 'text-center',
                        render: function(data, type, row, meta) {
                            return '<a href="{{ url('akademik/berita-acara') }}/' + row
                                .id_pegdosen +
                                '" type="button" class="btn btn-xs btn-info" title="Click untuk melihat berita acara"><i class="fa fa-search"></i> Lihat</a>';
                        }
                    },
                    {
                        data: 'nidn'
                    },
                    {
                        data: 'dosen'
                    },
                    {
                        data: 'nama_program_studi'
                    },
                    {
                        data: 'hp'
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: null,
                        className: "text-center",
                        render: function(data, type, full, meta) {
                            if (full.dosen_wali == '1') {
                                return '<span class="text-success" title="Adalah Dosen DPA"><i class="ti-info-alt"></i> Ya</span> ';
                            } else {
                                return '<span class="text-danger" title="Bukan Dosen DPA"><i class=" ti-info-alt"></i> Tidak</span>';

                            }
                        }
                    },

                ],
                order: []
            });
        });
    </script>
@stop
