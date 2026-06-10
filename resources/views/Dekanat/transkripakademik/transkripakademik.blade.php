@extends('layout')

@section('content')
    <div class="container-full">
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">Transkip Akademik</h3>
                </div>

            </div>
        </div>
        <!-- Main content -->
        <section class="content">
            <div class="box">
                <div class="box-header with-border">
                    <h6 class="box-subtitle">Melihat Transkip Akademik</h6>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <div class="box">
                        <input class="form-control" type="hidden" name="nimjamak" id="nimjamak">
                        <input class="form-control" type="hidden" name="tahun" id="tahun"
                            value="{{ $session_tahun }}">
                        <input class="form-control" type="hidden" name="semester" id="semester"
                            value="{{ $session_semester }}">
                        <div class="box-body ribbon-box bg-primary-light">
                            <div class="ribbon ribbon-info">informasi</div>
                            <p class="mb-0"></p>
                        </div> <!-- end box-body-->
                    </div>
                    <div class="box-header no-border">
                        <div class="row">
                            <div class="row">
                                <div class="col-md-2">
                                    <input type="text" name="nim_filter" id="nim_filter" class="form-control mb-2"
                                        placeholder="Filter NIM (Opsional)">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <select class="form-control" name="tahunangkatan" id="tahunangkatan">
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <select class="form-control" name="programstudi" id="programstudi">
                                        <option value="">Semua Program Studi</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="kgttranskipakademik" class="table table-hover table-striped">
                            <thead class="bg-dark">
                                <tr>
                                    <th>Pilih</th>
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Prodi</th>
                                    <th>Proses</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>

                        <div class="box-header no-border">
                        </div>
                    </div>
                    <div class="col-sm-1">
                    </div>
                    <div class="col-sm-5">
                        <div class="text-left">
                            <button type="button" class="btn btn-primary btn-sm float-left mr-2" id="btn-sinkron" onclick="btn_sinkron();">
                                <i class="fa fa-refresh"></i> Sinkron Transkrip
                            </button>
                            <button type="button" class="btn btn-warning btn-sm float-left" onclick="cetak();"
                                data-toggle="modal" data-target="#modal_add"><i class="fa fa-print"></i>
                                Cetak</button>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <iframe id="printff" name="printff" style="display: none;"></iframe>
            <iframe id="printff1" name="printff1" style="display: none;"></iframe>

    </div>

    <div class="modal fade" id="modal_edit">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Kelengkapan Transkip</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                </div>
                <form id="form_edit" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>No. Transkrip</label>
                            <input class="form-control" type="text" name="no_transkip" id="no_transkip"
                                placeholder="No. Transkrip">
                            <input class="form-control" type="hidden" name="enim" id="enim"
                                placeholder="ID Fakultas">
                        </div>
                        <div class="form-group">
                            <label>No. SK BAN PT</label>
                            <input class="form-control" type="text" name="no_sk_banpt" id="no_sk_banpt"
                                placeholder="No. SK BAN PT">
                        </div>
                        <div class="form-group">
                            <label>Status Akreditasi</label>
                            <select class="form-control" name="status_akreditasi" id="status_akreditasi">
                                <option value="">Pilih</option>
                                <option value="Terakreditasi">Terakreditasi</option>
                                <option value="Terakreditasi / A">Terakreditasi / A</option>
                                <option value="Terakreditasi / B">Terakreditasi / B</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Yudicium</label>
                            <input class="form-control" type="date" name="tgl_yudisium" id="tgl_yudisium"
                                placeholder="Tanggal Yudicium">
                        </div>
                        <div class="form-group">
                            <label>Tanggal Lulus</label>
                            <input class="form-control" type="date" name="tgl_lulus" id="tgl_lulus"
                                placeholder="Tanggal Lulus">
                        </div>
                        <div class="form-group">
                            <label>Judul Skripsi Indo</label><br>
                            <textarea name="judul_skripsi_indo" id="judul_skripsi_indo" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Judul Skripsi Inggris</label><br>
                            <textarea name="judul_skripsi_inggris" id="judul_skripsi_inggris" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer float-right">
                        <button type="button" class="btn btn-rounded btn-warning btn-outline mr-1" data-dismiss="modal">
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
        var token = "{{ Session::get('token') }}";
        var userlogin = "{{ Session::get('username') }}";

        function cetak(nim, tahunangkatan) {
            var nim = $('#nimjamak').val();
            var link = ""
            $("#printff")

                .attr("src", "{{ url('akademik/cetak/cetaktranskipakademik') }}/" + nim + "")
                .appendTo("body");
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
                    // console.log(result);
                    $('#no_transkip').val(s);
                    $('#no_sk_banpt').val(t);
                }
            })
        }

        function cetak1() {
            var nim = $('#nimjamak').val();
            var link = ""
            $("#printff")

                .attr("src", "{{ url('akademik/cetak/cetaktranskipakademikinggris') }}/" + nim + "")
                .appendTo("body");
        }
        $(document).ready(function() {
            var token = "{{ Session::get('token') }}";
            var userlogin = "{{ Session::get('username') }}";
            dropdown_prodi();
            tahunangkatan();

            function dropdown_prodi() {
                $.ajax({
                    type: "POST",
                    url: "{{ config('setting.second_url') }}akademik/dropdown-prodi",
                    dataType: "json",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    success: function(data) {
                        let target = $("#programstudi");
                        target.empty().append('<option value="">Semua Program Studi</option>');
                        $.each(data, function(index, value) {
                            target.append('<option value="' + value.kode_program_studi + '">' + value.nama_program_studi + '</option>');
                        });
                    }
                });
            }

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
                            s = s + '<option value="' + result[i].tahun_angkatan + '"> ' + result[i]
                                .tahun_angkatan +
                                '</option>';
                        }
                        // console.log(result);
                        $('#tahunangkatan').html(s);
                        var thnn = $('#tahunangkatan').val();
                        var prodi = $('#programstudi').val();
                        tbnilai(thnn, prodi);
                    }
                })
            }

            $('#tahunangkatan, #programstudi').on('change', function(event) {
                var thnn = $('#tahunangkatan').val();
                var prodi = $('#programstudi').val();
                tbnilai(thnn, prodi);

            });


            var id_mhs = $('#id_mhs').val();

            function tbnilai(thn, prodi = '') {
                var table = $("#kgttranskipakademik").DataTable({
                    destroy: true,
                    dom: 'Bfrtip',
                    buttons: [
                        'copy', 'csv', 'excel'
                    ],
                    pageLength: 10,
                    processing: true,
                    lengthChange: true,
                    ajax: {
                        type: "GET",
                        url: "{{ config('setting.second_url') }}akademik/transkipakademik",
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
                    columns: [{
                            data: null,
                            render: function(data, type, row, meta) {
                                return '';

                            }
                        },

                        {
                            data: 'nm'
                        },
                        {
                            data: 'namamhs'
                        },
                        {
                            data: 'nama_program_pendidikan'
                        },
                        {
                            data: 'nama_program_studi'
                        },
                        {
                            data: null,
                            render: function(data, type, full, meta) {
                                return '<a href="javascript:void(0)" class="text-info mr-10" id="bt_edit" data-toggle="tooltip" data-original-title="Edit"><i class="ti-marker-alt"></i></a>';
                            }
                        },

                    ],
                    order: []
                });

                table
                    .on('select', function(e, dt, type, indexes) {
                        var oData = table.rows('.selected').data();
                        var str = "";
                        for (var i = 0; i < oData.length; i++) {
                            if (i <= 0) {
                                str = oData[i]['nm'];
                            } else {
                                str = str + "-" + oData[i]['nm'];
                            }
                        }
                        $('#nimjamak').val(str);
                    })
                    .on('deselect', function(e, dt, type, indexes) {
                        var oData = table.rows('.selected').data();
                        var str = "";
                        for (var i = 0; i < oData.length; i++) {
                            if (i <= 0) {
                                str = oData[i]['nm'];
                            } else {
                                str = str + "-" + oData[i]['nm'];
                            }
                        }
                        $('#nimjamak').val(str);
                    });


                // show data edit
                table.on('click', '#bt_edit', function() {
                    $tr = $(this).closest('tr');
                    var data = table.row($tr).data();
                    $('#enim').val(data['nm']);

                    $.ajax({
                        type: "GET",
                        url: "{{ config('setting.second_url') }}akademik/cek-nimakademik",
                        headers: {
                            "Authorization": 'Bearer ' + token,
                            "username": userlogin
                        },
                        data: {
                            nim: data.nim,
                        },
                        dataType: "json",
                        success: function(data) {

                            if (data.nim != null) {
                                $('#no_transkip').val(data.no_transkrip);
                            } else {
                                no_transkip();
                            }
                        },
                        error: function(error) {
                            alert(error);
                        }
                    });

                    $('#modal_edit').modal('show');
                });

                // edit
                $('#form_edit').on('submit', function(event) {
                    event.preventDefault();
                    var form_data = $(this).serialize();
                    $.ajax({
                        url: "{{ config('setting.second_url') }}akademik/edit-transkipakademik",
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
                                table.ajax.reload();
                                $("#btsubmit").prop('disabled', false);
                            } else if (data.success) {
                                $('#modal_edit').modal('hide');
                                showToastr('success', 'Success!', data.success);
                                table.ajax.reload();
                                $('#form_edit')[0].reset();
                                $("#btsubmit").prop('disabled', false);
                            }
                        }
                    })
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
                    swal({
                        title: "Sinkronisasi Transkrip Massal",
                        text: "Apakah Anda yakin ingin mensinkronkan nilai KRS SELURUH mahasiswa pada angkatan dan program studi terpilih ke transkrip? (Proses ini mungkin memakan waktu agak lama)",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "Ya, Sinkronkan Semua!",
                        cancelButtonText: "Batal",
                        closeOnConfirm: false
                    }, function(isConfirm) {
                        if (isConfirm) {
                            ajax_sinkron({ tahun_angkatan: tahunangkatan, kode_prodi: kode_prodi });
                        }
                    });
                }

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
            };
        });
    </script>
@stop
