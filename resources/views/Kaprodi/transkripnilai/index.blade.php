@extends('layout')

@section('css')
    <style>
        th,
        td {
            white-space: nowrap;
            vertical-align: middle !important;
        }
        .mhs-card {
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
            background: #fff;
            border: 1px solid rgba(0,0,0,0.08);
            margin-bottom: 25px;
            overflow: hidden;
        }
        .mhs-card-header {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: #fff;
            padding: 20px 25px;
            border-bottom: none;
        }
        .mhs-badge {
            font-size: 11px;
            font-weight: 600;
            padding: 4px 8px;
            border-radius: 6px;
            display: inline-flex;
            align-items: center;
        }
        .mhs-badge-nim {
            background-color: #f1f5f9;
            color: #475569;
            border: 1px solid #cbd5e1;
        }
        .mhs-badge-angkatan {
            background-color: #eff6ff;
            color: #1d4ed8;
            border: 1px solid #bfdbfe;
        }
        .action-btn {
            border-radius: 6px;
            padding: 5px 10px;
            font-size: 12px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s ease;
        }
        .action-btn:hover {
            transform: translateY(-1px);
        }
        .badge-success-light {
            background-color: #ecfdf5;
            color: #047857;
            border: 1px solid #a7f3d0;
        }
        .badge-primary-light {
            background-color: #f5f3ff;
            color: #6d28d9;
            border: 1px solid #ddd6fe;
        }
        .badge-secondary-light {
            background-color: #f8fafc;
            color: #64748b;
            border: 1px solid #e2e8f0;
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
        
        <!-- Main content -->
        <section class="content">
            <div class="box mhs-card">
                <div class="box-header with-border mhs-card-header">
                    <h4 class="box-title text-white" style="font-weight: 600;">Kelola Transkrip Nilai Mahasiswa</h4>
                    <p class="mb-0 text-white-50" style="font-size: 13px; margin-top: 5px;">Sinkronisasikan nilai KRS ke transkrip akademik dan lakukan pencetakan transkrip nilai mahasiswa.</p>
                </div>
                
                <!-- /.box-header -->
                <div class="box-body" style="padding: 25px;">
                    <div class="box bg-primary-light mb-4" style="border-left: 4px solid #1e3c72; border-radius: 4px; box-shadow: none;">
                        <div class="box-body ribbon-box">
                            <div class="ribbon ribbon-info" style="background-color: #1e3c72; border-radius: 3px 0px 0px 3px;">Program Studi Terkunci</div>
                            <p class="mb-0" style="font-weight: 500; color: #1e293b;">
                                Menampilkan khusus mahasiswa aktif dari program studi <strong>{{ $nama_program_studi }}</strong> ({{ $session_kode_program_studi }}).
                            </p>
                        </div>
                    </div>

                    <div class="box-header no-border px-0 pt-0 mb-4">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group mb-0">
                                    <label class="font-weight-600 mb-1" style="font-size: 13px;">Pencarian NIM (Opsional)</label>
                                    <input type="text" name="nim_filter" id="nim_filter" class="form-control" placeholder="Masukkan NIM...">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group mb-0">
                                    <label class="font-weight-600 mb-1" style="font-size: 13px;">Tahun Angkatan</label>
                                    <select class="form-control" name="tahunangkatan" id="tahunangkatan">
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="table-responsive">
                        <input type="hidden" name="nimjamak" id="nimjamak">
                        <input type="hidden" name="tahun" id="tahun" value="{{ $session_tahun }}">
                        <input type="hidden" name="semester" id="semester" value="{{ $session_semester }}">
                        <input type="hidden" name="programstudi" id="programstudi" value="{{ $session_kode_program_studi }}">
                        <input type="hidden" name="jabatan" id="jabatan" value="{{ $session_jabatan }}">
                        
                        <table id="kgttranskipnilai" class="table table-hover" width="100%">
                            <thead>
                                <tr class="bg-dark text-white">
                                    <th class="text-center" width="5%">Pilih</th>
                                    <th width="35%">Mahasiswa</th>
                                    <th width="15%">Kelas / Jenjang</th>
                                    <th width="30%">Program Studi</th>
                                    <th class="text-center" width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                    <div class="row mt-4">
                        <div class="col-sm-12 d-flex align-items-center gap-3">
                            <button type="button" class="btn btn-primary action-btn mr-2" id="btn-sinkron" onclick="btn_sinkron();">
                                <i class="fa fa-refresh"></i> Sinkron Transkrip
                            </button>
                            <button type="button" class="btn btn-warning action-btn" onclick="cetak();">
                                <i class="fa fa-print"></i> Print Terpilih
                            </button>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <iframe id="printff" name="printff" style="display: none;"></iframe>
            </div>

            <!-- Modal Edit Kelengkapan -->
            <div class="modal fade" id="modal_edit">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" style="font-weight: 600;">Input Kelengkapan Transkip</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="form_edit" method="POST">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label class="font-weight-600">No Transkip</label>
                                    <input class="form-control" type="hidden" name="id_program_studi" id="id_program_studi" value="{{ $session_kode_program_studi }}">
                                    <input class="form-control" type="text" name="no_transkip" id="no_transkip" placeholder="Masukkan No Transkrip Nilai...">
                                    <input class="form-control" type="hidden" name="enim" id="enim">
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-600">No SK BAN PT</label>
                                    <input class="form-control" type="text" name="no_sk_banpt" id="no_sk_banpt" placeholder="Masukkan No SK BAN PT...">
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-600">Status Akreditasi</label>
                                    <select class="form-control" name="status_akreditasi" id="status_akreditasi">
                                        <option value="">-- Pilih Akreditasi --</option>
                                        <option value="Terakreditasi">Terakreditasi</option>
                                        <option value="Terakreditasi / A">Terakreditasi / A</option>
                                        <option value="Terakreditasi / B">Terakreditasi / B</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer float-right">
                                <button type="button" class="btn btn-rounded btn-warning btn-outline mr-2" data-dismiss="modal">
                                    <i class="fa fa-times"></i> Close
                                </button>
                                <button type="submit" class="btn btn-rounded btn-primary btn-outline" id="btsubmit">
                                    <i class="ti-save-alt"></i> Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('script-master')
    <script type="text/javascript">
        var token = "{{ Session::get('token') }}";
        var userlogin = "{{ Session::get('username') }}";

        function cetak() {
            var nim = $('#nimjamak').val();
            if (!nim) {
                swal("Peringatan!", "Pilih minimal 1 mahasiswa terlebih dahulu.", "warning");
                return;
            }
            var link = "{{ url('akademik/cetak/cetaktranskipnilai') }}/" + nim;
            window.open(link, '_blank').focus();
        }

        function single_cetak(nim) {
            var link = "{{ url('akademik/cetak/cetaktranskipnilai') }}/" + nim;
            window.open(link, '_blank').focus();
        }

        function no_transkip() {
            $.ajax({
                type: 'GET',
                url: "{{ config('setting.second_url') }}akademik/tampilno_transkip",
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                success: function(result) {
                    s = result.no_transkrip;
                    t = result.no_sk;
                    $('#no_transkip').val(s);
                    $('#no_sk_banpt').val(t);
                }
            })
        }

        $(document).ready(function() {
            tahunangkatan();

            function tahunangkatan() {
                $.ajax({
                    type: 'GET',
                    url: "{{ config('setting.second_url') }}akademik/tampiltahunangkatan",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    success: function(result) {
                        var jml = result.length;
                        var s = '';
                        for (i = 0; i < jml; i++) {
                            s = s + '<option value="' + result[i].tahun_angkatan + '"> ' + result[i].tahun_angkatan + '</option>';
                        }
                        $('#tahunangkatan').html(s);
                        var thnn = $('#tahunangkatan').val();
                        var prodi = $('#programstudi').val();
                        tbnilai(thnn, prodi);
                    }
                })
            }

            $('#tahunangkatan').on('change', function(event) {
                var thnn = $('#tahunangkatan').val();
                var prodi = $('#programstudi').val();
                tbnilai(thnn, prodi);
            });

            function tbnilai(thn, prodi) {
                var table = $("#kgttranskipnilai").DataTable({
                    destroy: true,
                    dom: 'l<br>Bfrtip',
                    buttons: [
                        'copy', 'csv', 'excel',
                        {
                            text: 'Pilih Semua',
                            className: 'btn btn-success',
                            action: function(e, dt, node, config) {
                                dt.rows().select();
                            }
                        },
                        {
                            text: 'Batal Pilih Semua',
                            className: 'btn btn-danger',
                            action: function(e, dt, node, config) {
                                dt.rows().deselect();
                            }
                        }
                    ],
                    pageLength: 50,
                    processing: true,
                    lengthChange: true,
                    ajax: {
                        type: "GET",
                        url: "{{ config('setting.second_url') }}akademik/transkipnilai",
                        headers: {
                            "Authorization": 'Bearer ' + token,
                            "username": userlogin
                        },
                        data: {
                            tahunangkatan: thn,
                            kode_prodi: prodi
                        },
                        dataSrc: function(json) {
                            return json;
                        }
                    },
                    columnDefs: [{
                        orderable: false,
                        className: 'select-checkbox',
                        targets: 0
                    }],
                    select: {
                        style: 'multi',
                        selector: 'td:first-child'
                    },
                    columns: [
                        {
                            data: null,
                            render: function(data, type, row, meta) {
                                return '';
                            }
                        },
                        {
                            data: null,
                            render: function(data, type, row, meta) {
                                var nimStr = row.nim ? row.nim : '-';
                                return `
                                    <div class="d-flex flex-column">
                                        <span class="font-size-14 font-weight-700 text-dark">${row.nama_mahasiswa}</span>
                                        <div class="d-flex align-items-center mt-1">
                                            <span class="mhs-badge mhs-badge-nim"><i class="fa fa-id-card-o mr-1"></i>${nimStr}</span>
                                        </div>
                                    </div>
                                `;
                            }
                        },
                        {
                            data: null,
                            render: function(data, type, row, meta) {
                                var jenjang = row.nama_program_pendidikan ? row.nama_program_pendidikan : '-';
                                return `<span class="badge badge-primary-light font-size-11" style="padding: 4px 8px; border-radius: 4px;">${jenjang}</span>`;
                            }
                        },
                        {
                            data: 'nama_program_studi'
                        },
                        {
                            data: null,
                            className: 'text-center',
                            render: function(data, type, row, meta) {
                                return `
                                    <button type="button" class="btn btn-xs btn-info mr-1" onclick="edit_kelengkapan('${row.nim}')" title="Kelengkapan Transkrip">
                                        <i class="ti-marker-alt"></i> Edit
                                    </button>
                                    <button type="button" class="btn btn-xs btn-warning mr-1" onclick="single_cetak('${row.nim}')" title="Print">
                                        <i class="fa fa-print"></i>
                                    </button>
                                    <button type="button" class="btn btn-xs btn-primary" onclick="single_sync('${row.nim}')" title="Sync Nilai">
                                        <i class="fa fa-refresh"></i>
                                    </button>
                                `;
                            }
                        }
                    ],
                    order: []
                });

                table
                    .on('select', function(e, dt, type, indexes) {
                        var oData = table.rows('.selected').data();
                        var str = "";
                        for (var i = 0; i < oData.length; i++) {
                            if (i <= 0) {
                                str = oData[i]['nim'];
                            } else {
                                str = str + "-" + oData[i]['nim'];
                            }
                        }
                        $('#nimjamak').val(str);
                    })
                    .on('deselect', function(e, dt, type, indexes) {
                        var oData = table.rows('.selected').data();
                        var str = "";
                        for (var i = 0; i < oData.length; i++) {
                            if (i <= 0) {
                                str = oData[i]['nim'];
                            } else {
                                str = str + "-" + oData[i]['nim'];
                            }
                        }
                        $('#nimjamak').val(str);
                    });
            }

            // show data edit
            window.edit_kelengkapan = function(nim) {
                no_transkip();
                $('#modal_edit').modal('show');
                $('#enim').val(nim);
            };

            // edit submit
            $('#form_edit').on('submit', function(event) {
                event.preventDefault();
                var form_data = $(this).serialize();
                $.ajax({
                    url: "{{ config('setting.second_url') }}akademik/edit-transkipnilai",
                    method: "POST",
                    data: form_data,
                    dataType: "json",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    beforeSend: function() {
                        $("#btsubmit").prop('disabled', true);
                    },
                    success: function(data) {
                        if (data.error) {
                            showToastr('error', 'Error!', data.error);
                            $("#btsubmit").prop('disabled', false);
                        } else if (data.success) {
                            $('#modal_edit').modal('hide');
                            showToastr('success', 'Success!', data.success);
                            $('#tbdaftarmhs_prodi').DataTable().ajax.reload();
                            $('#form_edit')[0].reset();
                            $("#btsubmit").prop('disabled', false);
                            // reload table
                            var thnn = $('#tahunangkatan').val();
                            var prodi = $('#programstudi').val();
                            tbnilai(thnn, prodi);
                        }
                    }
                })
            });

            window.single_sync = function(nim) {
                swal({
                    title: "Sinkronisasi Transkrip",
                    text: "Apakah Anda yakin ingin mensinkronkan nilai KRS mahasiswa dengan NIM " + nim + " ke transkrip?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "Ya, Sinkronkan!",
                    cancelButtonText: "Batal",
                    closeOnConfirm: false
                }, function(isConfirm) {
                    if (isConfirm) {
                        ajax_sinkron({ nim: nim });
                    }
                });
            }

            window.btn_sinkron = function() {
                var nim_filter = $('#nim_filter').val();
                var nim = $('#nimjamak').val();
                var tahunangkatan = $('#tahunangkatan').val();
                var kode_prodi = $('#programstudi').val();

                if (nim_filter) {
                    swal({
                        title: "Konfirmasi Sinkronisasi",
                        text: "Sinkronisasi Transkrip berdasarkan Filter NIM?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "Ya, Sinkronkan!",
                        cancelButtonText: "Batal",
                        closeOnConfirm: false
                    }, function(isConfirm) {
                        if (isConfirm) {
                            ajax_sinkron({ nim: nim_filter });
                        }
                    });
                } else if (nim) {
                    swal({
                        title: "Sinkronisasi Transkrip",
                        text: "Apakah Anda yakin ingin mensinkronkan nilai KRS mahasiswa yang dipilih ke transkrip?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "Ya, Sinkronkan!",
                        cancelButtonText: "Batal",
                        closeOnConfirm: false
                    }, function(isConfirm) {
                        if (isConfirm) {
                            ajax_sinkron({ nim: nim });
                        }
                    });
                } else {
                    var textMsg = "Apakah Anda yakin ingin mensinkronkan nilai KRS seluruh mahasiswa Angkatan " + tahunangkatan + " ke transkrip?";
                    swal({
                        title: "Sinkronisasi Massal Transkrip",
                        text: textMsg,
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "Ya, Sinkronkan Massal!",
                        cancelButtonText: "Batal",
                        closeOnConfirm: false
                    }, function(isConfirm) {
                        if (isConfirm) {
                            ajax_sinkron({
                                tahun_angkatan: tahunangkatan,
                                kode_prodi: kode_prodi
                            });
                        }
                    });
                }
            };

            function ajax_sinkron(post_data) {
                swal({
                    title: "Sedang memproses...",
                    text: "Mohon tunggu hingga proses sinkronisasi selesai.",
                    showConfirmButton: false,
                    allowOutsideClick: false
                });

                $.ajax({
                    url: "{{ config('setting.second_url') }}akademik/sinkron-transkrip",
                    type: "POST",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    data: post_data,
                    success: function(response) {
                        if (response.status === 'success') {
                            swal("Berhasil!", response.message, "success");
                            var thnn = $('#tahunangkatan').val();
                            var prodi = $('#programstudi').val();
                            tbnilai(thnn, prodi);
                        } else {
                            swal("Gagal!", response.message, "error");
                        }
                    },
                    error: function(xhr) {
                        var errMsg = "Terjadi kesalahan saat memproses sinkronisasi.";
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errMsg = xhr.responseJSON.message;
                        }
                        swal("Gagal!", errMsg, "error");
                    }
                });
            }
        });
    </script>
@stop
