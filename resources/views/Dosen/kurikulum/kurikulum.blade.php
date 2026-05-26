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
                    <h3 class="page-title">Kurikulum Program Studi</h3>
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
                    <h6 class="box-subtitle">Melihat Data Kurikulum Program Studi</h6>
                </div>

                <div class="box-body">
                    <div class="box">
                        <div class="box-body ribbon-box bg-primary-light">
                            <div class="ribbon ribbon-info">informasi</div>
                            <p class="mb-0">Menampilkan mata kuliah berdasarkan kurikulum program studi yang terdaftar.</p>
                        </div>
                    </div>

                    <div class="box-header no-border px-0">
                        <div class="row">
                            <div class="col-md-3 col-sm-6">
                                <div class="form-group mb-0">
                                    <label for="filter_tahun_kurikulum" class="font-weight-600 text-dark">Tahun Kurikulum</label>
                                    <select class="form-control" name="filter_tahun_kurikulum" id="filter_tahun_kurikulum">
                                        <option value="">- Memuat Kurikulum... -</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="table-responsive">
                        <input class="form-control" type="hidden" name="kode_prodi" id="kode_prodi" value="{{ $session_kode_program_studi }}">
                        
                        <table id="tbkurikulumprodi" class="table table-hover table-bordered table-striped" width="100%">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th>No</th>
                                    <th>Kurikulum</th>
                                    <th>Kode</th>
                                    <th>Nama Matakuliah</th>
                                    <th>Total SKS</th>
                                    <th>Semester</th>
                                    <th>Program Studi</th>
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
            var kode_prodi = $('#kode_prodi').val();

            // Load curriculum years filter dropdown
            $.ajax({
                type: 'GET',
                url: "{{ config('setting.second_url') }}akademik/select-kurikulum",
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                data: {
                    kode_prodi: kode_prodi
                },
                success: function(response) {
                    var s = '<option value="">- Semua Tahun Kurikulum -</option>';
                    // API returns under 'data' or directly array
                    var data = response.data || response;
                    if (data && data.length > 0) {
                        data.forEach(function(val) {
                            s += '<option value="' + val.id + '">' + val.text + '</option>';
                        });
                    }
                    $('#filter_tahun_kurikulum').html(s);
                    // Load DataTable
                    loadDataTable();
                },
                error: function() {
                    $('#filter_tahun_kurikulum').html('<option value="">- Semua Tahun Kurikulum -</option>');
                    loadDataTable();
                }
            });

            // Reload DataTable when filter changes
            $('#filter_tahun_kurikulum').on('change', function() {
                loadDataTable();
            });

            function loadDataTable() {
                var tahun_kurikulum = $('#filter_tahun_kurikulum').val();
                
                $("#tbkurikulumprodi").DataTable({
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
                        url: "{{ config('setting.second_url') }}akademik/matakuliah",
                        headers: {
                            "Authorization": 'Bearer ' + token,
                            "username": userlogin
                        },
                        data: {
                            kode_prodi: kode_prodi,
                            tahun_kurikulum: tahun_kurikulum
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
                            data: 'tahun_kurikulum',
                            className: 'text-center'
                        },
                        {
                            data: 'kode_matakuliah'
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
                        {
                            data: 'nama_program_studi'
                        }
                    ],
                    order: []
                });
            }
        });
    </script>
@stop
