@extends('layout')

@section('css')
    <style>
        th, td {
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
                                @if(!empty($child_breadcrumb))
                                    <li class="breadcrumb-item active" aria-current="page">{{ $child_breadcrumb }}</li>
                                @endif
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
                    <h6 class="box-subtitle">Daftar Mahasiswa Bimbingan Anda</h6>
                </div>

                <div class="box-body">
                    <div class="box-body ribbon-box bg-primary-light">
                        <div class="ribbon ribbon-info">Informasi</div>
                        <p class="mb-0">Pilih mahasiswa untuk melihat riwayat dan memvalidasi log bimbingan mereka.</p>
                    </div>

                    <div class="table-responsive">
                        <input class="form-control" type="hidden" name="id_dosen" id="id_dosen" value="{{ $session_id_dosen }}">
                        
                        <table id="tb_mahasiswa_bimbingan" class="table table-hover table-sm" width="100%">
                            <thead class="bg-dark">
                                <tr>
                                    <th>NIM</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>Prodi</th>
                                    <th>Judul Skripsi</th>
                                    <th>Status/Fase</th>
                                    <th>Total Bimbingan (ACC)</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Data populated by DataTables -->
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
            var token = "{{ $api_token }}";
            var userlogin = "{{ $session_username }}";
            var id_dosen = $('#id_dosen').val();

            var table = $("#tb_mahasiswa_bimbingan").DataTable({
                destroy: true,
                processing: true,
                serverSide: false, // For simplicity unless we have thousands
                ajax: {
                    type: "GET",
                    url: "{{ $api_url }}dosen/skripsi/dashboard",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    data: {
                        id_dosen: id_dosen
                    },
                    dataSrc: function(json) {
                        return json.data || [];
                    }
                },
                columns: [
                    { data: 'nim' },
                    { data: 'nama_mahasiswa' },
                    { data: 'nama_program_studi' },
                    { 
                        data: null, 
                        render: function(data, type, row) {
                            return row.judul ? '<strong>' + row.judul + '</strong>' : '<em class="text-muted">Belum ada judul</em>';
                        }
                    },
                    { 
                        data: null,
                        render: function(data, type, row) {
                            let faseBadge = '';
                            if (row.fase_aktif == 'proposal') faseBadge = '<span class="badge badge-warning">Proposal</span>';
                            else if (row.fase_aktif == 'bimbingan') faseBadge = '<span class="badge badge-info">Bimbingan Skripsi</span>';
                            else if (row.fase_aktif == 'ujian') faseBadge = '<span class="badge badge-success">Siap Ujian</span>';
                            
                            return faseBadge + '<br><small class="text-muted">' + row.status_skripsi.toUpperCase() + '</small>';
                        }
                    },
                    { 
                        data: 'total_bimbingan_acc',
                        className: 'text-center',
                        render: function(data, type, row) {
                            // Can add total requirement logic if needed later
                            return '<strong>' + data + '</strong> kali';
                        }
                    },
                    {
                        data: null,
                        className: 'text-center',
                        render: function(data, type, row) {
                            let urlDetail = "{{ route('dosen.skripsi.detail_bimbingan', ':id') }}";
                            urlDetail = urlDetail.replace(':id', row.id_skripsi);
                            
                            return '<a href="' + urlDetail + '" class="btn btn-sm btn-primary" title="Lihat & Validasi Bimbingan"><i class="fa fa-book"></i> Log Bimbingan</a>';
                        }
                    }
                ],
                order: [[5, 'asc']] // Sort by least bimbingan first maybe? Or just leave default
            });
        });
    </script>
@endsection
