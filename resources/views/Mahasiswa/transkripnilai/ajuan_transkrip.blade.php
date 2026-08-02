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
                                <li class="breadcrumb-item active" aria-current="page">Pengajuan</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="row">
                <div class="col-md-4 col-12">
                    <div class="box box-solid bg-primary-light">
                        <div class="box-header with-border">
                            <h4 class="box-title">Informasi Pengajuan</h4>
                        </div>
                        <div class="box-body">
                            <p>Anda dapat mengajukan permohonan penerbitan <strong>Transkrip Nilai Resmi</strong> melalui fitur ini.</p>
                            <p>Setelah pengajuan disetujui oleh Bagian Akademik, Anda akan mendapatkan <strong>Nomor Transkrip Resmi</strong> dan dapat mengunduh atau mencetak transkrip nilai resmi Anda secara mandiri.</p>
                            
                            <hr class="my-15">
                            
                            <div class="form-group text-left">
                                <label class="font-weight-bold" for="tipe_pengajuan text-dark">Tipe Dokumen <span class="text-danger">*</span></label>
                                <select class="form-control" id="tipe_pengajuan" style="color: #000; font-weight: 500;">
                                    <option value="transkrip">Transkrip Nilai (Resmi Kelulusan)</option>
                                    <option value="rekap">Rekap Nilai (Sementara / Sebelum Lulus)</option>
                                </select>
                            </div>

                            <div class="text-center py-10">
                                <button type="button" id="btn-ajukan" class="btn btn-primary btn-block btn-lg" onclick="ajukanTranskrip();">
                                    <i class="fa fa-paper-plane mr-2"></i> Kirim Ajuan Baru
                                </button>
                                <div id="msg-status" class="mt-10 font-weight-bold text-warning"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8 col-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h4 class="box-title">Riwayat Pengajuan Transkrip Nilai</h4>
                        </div>
                        <div class="box-body">
                            <input class="form-control" type="hidden" name="nim" id="nim" value="{{ $session_nim }}">
                            
                            <div class="table-responsive">
                                <table id="tb_riwayat" class="table table-hover table-striped" width="100%">
                                    <thead>
                                        <tr class="bg-dark">
                                            <th style="width: 50px;">No</th>
                                            <th>Tanggal Ajuan</th>
                                            <th>Tipe</th>
                                            <th>Nomor Transkrip</th>
                                            <th class="text-center">Status</th>
                                            <th>Tanggal Approve</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('script-master')
    <script type="text/javascript">
        var token = "{{ Session::get('token') }}";
        var userlogin = "{{ Session::get('username') }}";
        var nim = $('#nim').val();

        function loadRiwayat() {
            $.ajax({
                type: "GET",
                url: "{{ config('setting.second_url') }}mahasiswa/transkrip-ajuan",
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                data: {
                    nim: nim
                },
                success: function(response) {
                    var html = '';
                    var hasPending = false;
                    
                    if (response.data && response.data.length > 0) {
                        $.each(response.data, function(index, row) {
                            var statusBadge = '';
                            
                            if (row.status === 'pending') {
                                statusBadge = '<span class="badge-pending">Menunggu</span>';
                                hasPending = true;
                            } else if (row.status === 'approved') {
                                statusBadge = '<span class="badge-approved">Disetujui</span>';
                            } else {
                                statusBadge = '<span class="badge-rejected">Ditolak</span>';
                            }
                            
                            var noTrans = row.no_transkrip ? row.no_transkrip : '-';
                            var tglApprove = row.approved_at ? row.approved_at.substring(0, 10) : '-';
                            var tipeText = row.tipe === 'rekap' ? 'Rekap Nilai' : 'Transkrip Nilai';
                            
                            html += '<tr>' +
                                '<td>' + (index + 1) + '</td>' +
                                '<td>' + row.tanggal_ajuan + '</td>' +
                                '<td><span class="badge badge-info">' + tipeText + '</span></td>' +
                                '<td><strong>' + noTrans + '</strong></td>' +
                                '<td class="text-center">' + statusBadge + '</td>' +
                                '<td>' + tglApprove + '</td>' +
                                '</tr>';
                        });
                    } else {
                        html = '<tr><td colspan="6" class="text-center">Belum ada riwayat pengajuan.</td></tr>';
                    }
                    
                    $('#tb_riwayat tbody').html(html);
                    
                    if (hasPending) {
                        $('#btn-ajukan').prop('disabled', true);
                        $('#msg-status').html('<i class="fa fa-info-circle mr-1"></i> Pengajuan transkrip Anda sedang diproses oleh akademik.');
                    } else {
                        $('#btn-ajukan').prop('disabled', false);
                        $('#msg-status').html('');
                    }
                },
                error: function(err) {
                    showToastr('error', 'Error!', 'Gagal memuat data riwayat.');
                }
            });
        }

        function ajukanTranskrip() {
            var tipe = $('#tipe_pengajuan').val();
            var tipeLabel = tipe === 'rekap' ? 'Rekap Nilai (Sementara)' : 'Transkrip Nilai (Resmi Kelulusan)';
            
            swal({
                title: "Konfirmasi Pengajuan",
                text: "Apakah Anda yakin ingin mengajukan permohonan " + tipeLabel + "?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Ajukan!",
                cancelButtonText: "Batal"
            }, function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: "{{ config('setting.second_url') }}mahasiswa/transkrip-ajuan",
                        method: "POST",
                        dataType: "json",
                        headers: {
                            "Authorization": 'Bearer ' + token,
                            "username": userlogin
                        },
                        data: {
                            nim: nim,
                            tipe: tipe
                        },
                        beforeSend: function() {
                            $('#btn-ajukan').prop('disabled', true);
                        },
                        success: function(response) {
                            if (response.status === 'success') {
                                showToastr('success', 'Berhasil!', response.message);
                                loadRiwayat();
                            } else {
                                showToastr('error', 'Gagal!', response.message);
                                $('#btn-ajukan').prop('disabled', false);
                            }
                        },
                        error: function(xhr) {
                            var msg = 'Gagal mengajukan transkrip.';
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                msg = xhr.responseJSON.message;
                            }
                            showToastr('error', 'Error!', msg);
                            $('#btn-ajukan').prop('disabled', false);
                        }
                    });
                }
            });
        }

        $(document).ready(function() {
            loadRiwayat();
        });
    </script>
@endsection
