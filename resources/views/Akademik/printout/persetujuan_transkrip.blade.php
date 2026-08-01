@extends('layout')

@section('css')
    <style>
        .badge-pending {
            background-color: #ffeeb3 !important;
            color: #856404 !important;
            border: 1px solid #ffeeba;
            padding: 5px 10px;
            border-radius: 4px;
            font-weight: 600;
        }
        .badge-approved {
            background-color: #d4edda !important;
            color: #155724 !important;
            border: 1px solid #c3e6cb;
            padding: 5px 10px;
            border-radius: 4px;
            font-weight: 600;
        }
        .badge-rejected {
            background-color: #f8d7da !important;
            color: #721c24 !important;
            border: 1px solid #f5c6cb;
            padding: 5px 10px;
            border-radius: 4px;
            font-weight: 600;
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
                                <li class="breadcrumb-item active" aria-current="page">{{ $child_breadcrumb }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Daftar Pengajuan Transkrip Nilai</h4>
                    <div class="box-controls pull-right">
                        <div class="lookup lookup-circle lookup-right">
                            <input type="text" id="search-mhs" placeholder="Cari NIM / Nama..." onkeyup="filterTable()">
                        </div>
                    </div>
                </div>

                <div class="box-body">
                    <div class="row mb-15">
                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label>Filter Status</label>
                                <select class="form-control" id="filter-status" onchange="loadAjuan();">
                                    <option value="">Semua Status</option>
                                    <option value="pending" selected>Menunggu Persetujuan</option>
                                    <option value="approved">Disetujui</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="tb_persetujuan" class="table table-hover table-striped" width="100%">
                            <thead>
                                <tr class="bg-dark">
                                    <th style="width: 50px;">No</th>
                                    <th>NIM</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>Program Studi</th>
                                    <th>Tanggal Ajuan</th>
                                    <th>Nomor Transkrip</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center" style="width: 250px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>

        <!-- Modal Approve -->
        <div class="modal fade" id="modal_approve">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Persetujuan Transkrip Nilai</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="form_approve">
                        <div class="modal-body">
                            <input type="hidden" id="approve-id" name="id">
                            <div class="form-group">
                                <label class="font-weight-bold">Nama Mahasiswa</label>
                                <div id="approve-nama" class="form-control-static"></div>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">NIM</label>
                                <div id="approve-nim" class="form-control-static"></div>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold" for="no_transkrip">Nomor Transkrip Nilai <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="no_transkrip" name="no_transkrip" placeholder="Contoh: 421.001/III.3.AU.III.1/C/2026" required>
                                <small class="form-text text-muted">Masukkan format nomor surat transkrip resmi secara lengkap.</small>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times"></i> Tutup</button>
                            <button type="submit" class="btn btn-primary" id="btn-submit-approve"><i class="fa fa-check"></i> Setujui & Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <iframe id="printff" name="printff" style="display: none;"></iframe>
    </div>
@endsection

@section('script-master')
    <script type="text/javascript">
        var token = "{{ Session::get('token') }}";
        var userlogin = "{{ Session::get('username') }}";
        var rawData = [];

        function loadAjuan() {
            var status = $('#filter-status').val();
            $.ajax({
                type: "GET",
                url: "{{ config('setting.second_url') }}akademik/transkrip-ajuan",
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                data: {
                    status: status
                },
                success: function(response) {
                    rawData = response.data || [];
                    renderTable(rawData);
                },
                error: function(err) {
                    showToastr('error', 'Error!', 'Gagal memuat data ajuan transkrip.');
                }
            });
        }

        function renderTable(data) {
            var html = '';
            if (data && data.length > 0) {
                $.each(data, function(index, row) {
                    var statusBadge = '';
                    var btnAksi = '';
                    
                    if (row.status === 'pending') {
                        statusBadge = '<span class="badge-pending">Menunggu</span>';
                        btnAksi = '<button class="btn btn-sm btn-primary mr-1" onclick="openApproveModal(' + row.id + ', \'' + row.nim + '\', \'' + row.nama_mahasiswa.replace(/'/g, "\\'") + '\')"><i class="fa fa-check"></i> Setujui</button>';
                    } else if (row.status === 'approved') {
                        statusBadge = '<span class="badge-approved">Disetujui</span>';
                        btnAksi = '<button class="btn btn-sm btn-success mr-1" onclick="cetak(\'' + row.nim + '\')"><i class="fa fa-print"></i> Cetak</button>' +
                                  '<button class="btn btn-sm btn-warning" onclick="batalApprove(' + row.id + ')"><i class="fa fa-undo"></i> Batal</button>';
                    } else {
                        statusBadge = '<span class="badge-rejected">Ditolak</span>';
                    }
                    
                    var noTrans = row.no_transkrip ? row.no_transkrip : '-';
                    
                    html += '<tr>' +
                        '<td>' + (index + 1) + '</td>' +
                        '<td>' + row.nim + '</td>' +
                        '<td>' + row.nama_mahasiswa + '</td>' +
                        '<td>' + row.nama_program_studi + '</td>' +
                        '<td>' + row.tanggal_ajuan + '</td>' +
                        '<td><strong>' + noTrans + '</strong></td>' +
                        '<td class="text-center">' + statusBadge + '</td>' +
                        '<td class="text-center">' + btnAksi + '</td>' +
                        '</tr>';
                });
            } else {
                html = '<tr><td colspan="8" class="text-center">Tidak ada data pengajuan transkrip.</td></tr>';
            }
            
            $('#tb_persetujuan tbody').html(html);
        }

        function filterTable() {
            var search = $('#search-mhs').val().toLowerCase();
            var filtered = $.grep(rawData, function(row) {
                return row.nim.toLowerCase().indexOf(search) > -1 || 
                       row.nama_mahasiswa.toLowerCase().indexOf(search) > -1;
            });
            renderTable(filtered);
        }

        function openApproveModal(id, nim, nama) {
            $('#approve-id').val(id);
            $('#approve-nim').text(nim);
            $('#approve-nama').text(nama);
            $('#no_transkrip').val('');
            $('#modal_approve').modal('show');
        }

        $('#form_approve').on('submit', function(e) {
            e.preventDefault();
            var id = $('#approve-id').val();
            var noTrans = $('#no_transkrip').val();
            
            $.ajax({
                url: "{{ config('setting.second_url') }}akademik/transkrip-ajuan/approve",
                method: "POST",
                dataType: "json",
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                data: {
                    id: id,
                    no_transkrip: noTrans,
                    approved_by: userlogin
                },
                beforeSend: function() {
                    $('#btn-submit-approve').prop('disabled', true);
                },
                success: function(response) {
                    $('#btn-submit-approve').prop('disabled', false);
                    if (response.status === 'success') {
                        $('#modal_approve').modal('hide');
                        showToastr('success', 'Berhasil!', response.message);
                        loadAjuan();
                    } else {
                        showToastr('error', 'Gagal!', response.message);
                    }
                },
                error: function(err) {
                    $('#btn-submit-approve').prop('disabled', false);
                    showToastr('error', 'Error!', 'Gagal menyetujui pengajuan.');
                }
            });
        });

        function batalApprove(id) {
            swal({
                title: "Batalkan Persetujuan",
                text: "Apakah Anda yakin ingin membatalkan persetujuan pengajuan transkrip ini?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Batalkan!",
                cancelButtonText: "Batal"
            }, function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: "{{ config('setting.second_url') }}akademik/transkrip-ajuan/cancel",
                        method: "POST",
                        dataType: "json",
                        headers: {
                            "Authorization": 'Bearer ' + token,
                            "username": userlogin
                        },
                        data: {
                            id: id
                        },
                        success: function(response) {
                            if (response.status === 'success') {
                                showToastr('success', 'Berhasil!', response.message);
                                loadAjuan();
                            } else {
                                showToastr('error', 'Gagal!', response.message);
                            }
                        },
                        error: function(err) {
                            showToastr('error', 'Error!', 'Gagal membatalkan persetujuan.');
                        }
                    });
                }
            });
        }

        function cetak(nim) {
            $("#printff")
                .attr("src", "{{ url('akademik/cetak/cetaktranskipnilai') }}/" + nim)
                .appendTo("body");
        }

        $(document).ready(function() {
            loadAjuan();
        });
    </script>
@endsection
