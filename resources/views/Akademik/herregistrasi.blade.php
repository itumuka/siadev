@extends('layout')

@section('content')
    <div class="container-full">
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">Data Her Registrasi</h3>
                </div>

            </div>
        </div>
        <!-- Main content -->
        <section class="content">
            <div class="box">
                <div class="box-header with-border">
                    <h6 class="box-subtitle">Data Her Registrasi</h6>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <div class="box">
                        <div class="box-body ribbon-box bg-primary-light">
                            <div class="ribbon ribbon-info">informasi</div>
                            <p class="mb-0">Halaman utama untuk melakukan heregistrasi {{ $session_nama_tahunakademik }}
                                <br>Untuk melakukan dispensasi, silahkan hubungi admin bagian keuangan.
                            </p>
                        </div> <!-- end box-body-->
                    </div>
                    <div class="table-responsive">
                        <div class="box-header no-border">
                            <div class="row">
                                <div class="col-sm-2">
                                    <label for="tahunangkatan">&emsp;&emsp;&emsp;Tahun Angkatan :</label>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <select class="form-control" name="tahunangkatan" id="tahunangkatan">
                                        </select>
                                        <input class="form-control" type="hidden" name="tahun" id="tahun"
                                            value="{{ $session_tahun }}">
                                        <input class="form-control" type="hidden" name="semester" id="semester"
                                            value="{{ $session_semester }}">
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <label for="prgstudi">&emsp;&emsp;&emsp;Program Studi :</label>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <select class="form-control" name="programstudi" id="programstudi">
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table id="kgtherregistrasi" class="table table-hover table-striped">
                            <thead class="bg-dark">
                                <tr>
                                    <th>No</th>
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <th>Tmpt/Tgl Lahir</th>
                                    <th>No Telp/HP</th>
                                    <th>Kelas</th>
                                    <th>Prodi</th>
                                    <th>Status</th>
                                    <th>SKS Ambil</th>
                                    <th>Batas SKS</th>
                                    <th>Proses</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>

            {{-- modal add --}}

            <div class="modal fade" id="modal_add">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Form Tambah Her-Registrasi</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                        <form id="form_add" method="POST">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>NIM</label>
                                    <input class="form-control" type="text" name="nim" id="nim" readonly
                                        placeholder="Nama">
                                </div>
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input class="form-control" type="text" name="nama_camaba" readonly id="nama_camaba"
                                        placeholder="Nama">
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Her Registrasi</label>
                                    <input class="form-control" type="text"
                                        value="@php echo date('Y-m-d H:i:s'); @endphp" name="tanggal_heregistrasi1" readonly
                                        id="tanggal_heregistrasi1" placeholder="Nama">
                                </div>
                                <div class="form-group">
                                    <label>Tahun</label>
                                    <input class="form-control" type="text" name="tahun1" id="tahun1"
                                        value="{{ $session_tahun }}" readonly placeholder="Nama">
                                </div>
                                <div class="form-group">
                                    <label>Semester</label>
                                    <input class="form-control" type="text" name="semester1"
                                        value="{{ $session_semester }}" readonly id="semester1" placeholder="Nama">
                                </div>
                                <div class="form-group">
                                    <label>Jenis Her</label>
                                    <select name="nama_jenis_her" id="nama_jenis_her" class="form-control">
                                        <option value="">Pilih</option>
                                        <option value=""></option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Batas SKS</label>
                                    <input class="form-control" type="number" name="batas_sks" id="batas_sks"
                                        placeholder="Batas SKS">
                                </div>
                            </div>
                            <div class="modal-footer float-right">
                                <button type="button" class="btn btn-rounded btn-warning btn-outline mr-1"
                                    data-dismiss="modal">
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

    </div>
    {{-- modal edit --}}

    <div class="modal fade" id="modal_edit">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Form Edit Her-Registrasi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                </div>
                <form id="form_edit" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <input class="form-control" type="hidden" name="eid_heregistrasi" id="eid_heregistrasi"
                                placeholder="ID Mahasiswa">
                        </div>
                        <div class="form-group">
                            <label>NIM</label>
                            <input class="form-control" type="text" name="enim" id="enim" readonly
                                placeholder="Nama">
                        </div>
                        <div class="form-group">
                            <label>Nama</label>
                            <input class="form-control" type="text" name="enama_camaba" readonly id="enama_camaba"
                                placeholder="Nama">
                        </div>
                        <div class="form-group">
                            <label>Tanggal Her Registrasi</label>
                            <input class="form-control" type="text" name="etanggal_heregistrasi" readonly
                                id="etanggal_heregistrasi" placeholder="Nama">
                        </div>
                        <div class="form-group">
                            <label>Tahun</label>
                            <input class="form-control" type="text" name="etahun" id="etahun" readonly
                                placeholder="Nama">
                        </div>
                        <div class="form-group">
                            <label>Semester</label>
                            <input class="form-control" type="text" name="esemester" readonly id="esemester"
                                placeholder="Nama">
                        </div>
                        <div class="form-group">
                            <label>Jenis Her</label>
                            <select name="enama_jenis_her" id="enama_jenis_her" class="form-control">
                                <option value="">Pilih</option>
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Batas SKS</label>
                            <input class="form-control" type="number" name="ebatas_sks" id="ebatas_sks"
                                placeholder="Batas SKS">
                        </div>
                    </div>
                    <div class="modal-footer float-right">
                        <button type="button" class="btn btn-rounded btn-warning btn-outline mr-1" data-dismiss="modal">
                            <i class="fa fa-times"></i> Close
                        </button>
                        <button type="submit" class="btn btn-rounded btn-primary btn-outline" id="btsubmit1">
                            <i class="ti-save-alt"></i> Save
                        </button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
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



        function enama_jenis_her() {
            $.ajax({
                type: 'GET',
                url: "{{ config('setting.second_url') }}akademik/edittampiljenisher",
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                success: function(result) {
                    var jml = result.length;
                    var s = '';
                    for (i = 0; i < jml; i++) {
                        s = s + '<option value="' + result[i].kode_jenis_her + '"> ' + result[i]
                            .nama_jenis_her + '</option>';
                    }
                    // console.log(result);
                    $('#enama_jenis_her').html(s);
                }
            })
        }
        enama_jenis_her();

        function nama_jenis_her() {
            $.ajax({
                type: 'GET',
                url: "{{ config('setting.second_url') }}akademik/edittampiljenisher",
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                success: function(result) {
                    var jml = result.length;
                    var s = '';
                    for (i = 0; i < jml; i++) {
                        s = s + '<option value="' + result[i].kode_jenis_her + '"> ' + result[i]
                            .nama_jenis_her + '</option>';
                    }
                    // console.log(result);
                    $('#nama_jenis_her').html(s);
                }
            })
        }
        nama_jenis_her();
        $(document).ready(function() {
            var token = "{{ Session::get('token') }}";
            var userlogin = "{{ Session::get('username') }}";

            tahunangkatan();
            programstudi();

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
                            s = s + '<option value="' + result[i].tahun_angkatan + '"> ' +
                                result[i]
                                .tahun_angkatan +
                                '</option>';
                        }
                        s = s + '<option value=""> Semua Angkatan</option>';
                        // console.log(result);
                        $('#tahunangkatan').html(s);
                        var thnn = $('#tahunangkatan').val();
                        var nama_program_studi = $('#programstudi').val();
                        tbnilai(thnn, nama_program_studi);
                    }
                })
            }

            function programstudi() {
                $.ajax({
                    type: 'GET',
                    url: "{{ config('setting.second_url') }}akademik/tampilprogramstudi",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    success: function(result) {
                        var jml = result.length;
                        var s = '';
                        for (i = 0; i < jml; i++) {
                            if (result[i].nama_program_studi != "Universitas") {
                                s = s + '<option value="' + result[i].nama_program_studi +
                                    '"> ' + result[i]
                                    .nama_program_studi + '</option>';
                            }
                        }
                        var s = s + '<option value="">Semua Program Studi</option>';
                        // console.log(result);
                        $('#programstudi').html(s);
                        var thnn = $('#tahunangkatan').val();
                        var nama_program_studi = $('#programstudi').val();
                        tbnilai(thnn, nama_program_studi);
                    }
                })
            }
            $('#programstudi').on('change', function(event) {
                var thnn = $('#tahunangkatan').val();
                var nama_program_studi = $('#programstudi').val();
                tbnilai(thnn, nama_program_studi);

            });


            $('#tahunangkatan').on('change', function(event) {
                var thnn = $('#tahunangkatan').val();
                var nama_program_studi = $('#programstudi').val();
                tbnilai(thnn, nama_program_studi);

            });

            // $(".tst3").on("click", function () {
            //     // $.toast({
            //     //     heading: 'Welcome to my EduAdmin',
            //     //     text: 'Use the predefined ones, or specify a custom position object.',
            //     //     position: 'top-right',
            //     //     loaderBg: '#ff6849',
            //     //     icon: 'success',
            //     //     hideAfter: 3500,
            //     //     stack: 6
            //     // });
            //     showToastr('error', 'Success!', 'Data telah disimpan');
            // });

            // var nim = $('#nim').val();
            // var ta = $('#ta').val();
            // var smt = $('#smt').val();
            // var token = $('#token').val();
            var table;

            function tbnilai(thn, nama_prodinya) {
                var tahun = $('#tahun').val();
                var semester = $('#semester').val();
                table = $("#kgtherregistrasi").DataTable({
                    destroy: true,
                    dom: '<"top"lf>rt<"bottom"Bip><"clear">',
                    buttons: [
                        'copy', 'csv', 'excel'
                    ],
                    // responsive: true,
                    // autoWidth: false,
                    lengthMenu: [
                        [10, 25, 50, -1],
                        [10, 25, 50, 'All'],
                    ],
                    processing: true,
                    lengthChange: true,
                    searching: true,
                    // serverSide: true,
                    stateSave: true,
                    // scrollX: true,
                    // orderable: false,
                    ajax: {
                        type: "GET",
                        url: "{{ config('setting.second_url') }}akademik/herregistrasi",
                        headers: {
                            "Authorization": 'Bearer ' + token,
                            "username": userlogin
                        },
                        data: {
                            tahunangkatan: thn,
                            tahun: tahun,
                            semester: semester,
                            nama_prodinya: nama_prodinya,
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
                            data: 'nim'
                        },

                        {
                            data: 'nama_mahasiswa'
                        },
                        {
                            data: null,
                            render: function(data, type, full, meta) {
                                return full.tempat_lahir + ', ' + full.tanggal_lahir;
                            }
                        },
                        {
                            data: 'telp'
                        },
                        {
                            data: 'status'
                        },

                        {
                            data: 'nama_program_studi'
                        },
                        {
                            data: null,
                            render: function(data, type, full, meta) {
                                if (full.cekspptetap != null || full.beasiswa == '1') {
                                    if (full.batas_sks == null || full.batas_sks ==
                                        '') {
                                        return '<label style="color:orange"><i class="fa fa-minus-circle"></i> Belum Her registrasi</label>';
                                    } else {
                                        return '<label style="color:green"><i class="fa fa-check-circle-o"></i> Sudah Her Registrasi</label>';
                                    }
                                } else {
                                    if (full.cek_dispen == null || full.cek_dispen == '') {
                                        return '<label style="color:red"><i class="fa fa-minus-circle"></i> Belum Bayar SPP</label>';
                                    } else {
                                        if (full.batas_sks == null || full.batas_sks ==
                                            '') {
                                            return '<label style="color:orange"><i class="fa fa-minus-circle"></i> Belum Her registrasi</label>';
                                        } else {
                                            return '<label style="color:green"><i class="fa fa-check-circle-o"></i> Sudah Her Registrasi</label>';
                                        }

                                    }
                                }
                            }
                        },
                        {
                            data: 'sks_ambil'
                        },
                        {
                            data: 'batas_sks'
                        },
                        {
                            data: null,
                            render: function(data, type, full, meta) {
                                if (full.cekspptetap != null || full.beasiswa == '1') {
                                    if (full.id_heregistrasi == null || full.id_heregistrasi ==
                                        '') {
                                        return '<a href="javascript:void(0)" class="text-info mr-10" id="bt_add" data-toggle="tooltip" title="Tambah" data-original-title="Add" disabled><i class="fa fa-plus-circle"></i></a> | <a href="javascript:void(0)" class="text-danger del" data-id="' +
                                            full.id_heregistrasi +
                                            '" data-original-title="Delete" data-toggle="tooltip" disabled><i class="ti-trash"></i></a>';
                                    } else {
                                        return '<a href="javascript:void(0)" class="text-info mr-10" id="bt_edit" data-toggle="tooltip" data-original-title="Edit" disabled><i class="ti-marker-alt"></i></a> | <a href="javascript:void(0)" class="text-danger del" data-id="' +
                                            full.id_heregistrasi +
                                            '" data-original-title="Delete" data-toggle="tooltip" disabled><i class="ti-trash"></i></a>';
                                    }
                                } else {
                                    if (full.cek_dispen == null || full.cek_dispen == '') {
                                        return '<center><label style="color:danger"><i class="si-lock si"></i></label></center>';
                                    } else {
                                        if (full.id_heregistrasi == null || full.id_heregistrasi ==
                                            '') {
                                            return '<a href="javascript:void(0)" class="text-info mr-10" id="bt_add" data-toggle="tooltip" title="Tambah" data-original-title="Add" disabled><i class="fa fa-plus-circle"></i></a> | <a href="javascript:void(0)" class="text-danger del" data-id="' +
                                                full.id_heregistrasi +
                                                '" data-original-title="Delete" data-toggle="tooltip" disabled><i class="ti-trash"></i></a>';
                                        } else {
                                            return '<a href="javascript:void(0)" class="text-info mr-10" id="bt_edit" data-toggle="tooltip" data-original-title="Edit" disabled><i class="ti-marker-alt"></i></a> | <a href="javascript:void(0)" class="text-danger del" data-id="' +
                                                full.id_heregistrasi +
                                                '" data-original-title="Delete" data-toggle="tooltip" disabled><i class="ti-trash"></i></a>';
                                        }

                                    }
                                }
                            }
                        },

                    ],
                    order: []
                });

                // show data add mhs
                table.on('click', '#bt_add', function() {
                    $tr = $(this).closest('tr');
                    var data = table.row($tr).data();
                    var nim = data['nim'];
                    $.ajax({
                        url: "{{ config('setting.second_url') }}akademik/batassksher",
                        type: 'GET',
                        headers: {
                            "Authorization": 'Bearer ' + token,
                            "username": userlogin
                        },
                        data: {
                            tahunangkatan: thn,
                            tahun: tahun,
                            semester: semester,
                            nim: nim
                        },
                        dataType: 'json',
                        success: function(data) {
                            $('#batas_sks').val(data);
                        }
                    });
                    $('#modal_add').modal('show');
                    // $('#id_heregistrasi').val(data['id_heregistrasi']);
                    $('#no_registrasi').val(data['no_registrasi']);
                    $('#nim').val(data['nim']);
                    $('#nama_camaba').val(data['nama_mahasiswa']);
                    $('#nama_jalur').val(data['nama_jalur']);
                    $('#kelas').val(data['kelas']);
                    $('#nama_program_studi').val(data['nama_program_studi']);
                    $('#nama_jenis_her').val(data['nama_jenis_her']);
                    $('#nama_jenis_her').val(data['kode_jenis_her']);
                    $("#" + data.trash).prop("checked", true)
                });
                // show data edit mhs
                table.on('click', '#bt_edit', function() {
                    $tr = $(this).closest('tr');
                    var data = table.row($tr).data();
                    var nim = data['nim'];
                    $.ajax({
                        url: "{{ config('setting.second_url') }}akademik/batassksher",
                        type: 'GET',
                        headers: {
                            "Authorization": 'Bearer ' + token,
                            "username": userlogin
                        },
                        data: {
                            tahunangkatan: thn,
                            tahun: tahun,
                            semester: semester,
                            nim: nim
                        },
                        dataType: 'json',
                        success: function(data) {
                            $('#ebatas_sks').val(data);
                        }
                    });
                    $('#modal_edit').modal('show');
                    $('#eid_heregistrasi').val(data['id_heregistrasi']);
                    $('#eno_registrasi').val(data['no_registrasi']);
                    $('#enim').val(data['nim']);
                    $('#enama_camaba').val(data['nama_mahasiswa']);
                    $('#enama_jalur').val(data['nama_jalur']);
                    $('#ekelas').val(data['kelas']);
                    $('#enama_program_studi').val(data['nama_program_studi']);
                    $('#etahun').val(data['tahunher']);
                    $('#esemester').val(data['smther']);
                    $('#etanggal_heregistrasi').val(data['tanggal_heregistrasi']);
                    $('#enama_jenis_her').val(data['nama_jenis_her']);
                    $('#enama_jenis_her').val(data['kode_jenis_her']);
                    // $('#ebatas_sks').val(data['batas_sks']);
                    $("#" + data.trash).prop("checked", true)
                });
                // hapus
                table.on('click', '.del[data-id]', function(e) {
                    e.preventDefault();
                    var id = $(this).data('id');
                    swal({
                        title: "Apa anda yakin?",
                        text: "Kamu tidak akan bisa mengembalikan data!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Ya, hapus !",
                        cancelButtonText: "Tidak, batal !",
                        closeOnCancel: false
                    }, function(isConfirm) {
                        if (isConfirm) {
                            $.ajax({
                                url: "{{ config('setting.second_url') }}akademik/hapus-herregistrasi",
                                type: 'GET',
                                headers: {
                                    "Authorization": 'Bearer ' + token,
                                    "username": userlogin
                                },
                                data: {
                                    id_heregistrasi: id
                                },
                                dataType: 'json',
                                success: function(data) {
                                    if (data.gagal) {
                                        showToastr('error', 'Error!', data.gagal);
                                    } else if (data.berhasil) {
                                        showToastr('success', 'Success!', data
                                            .berhasil);
                                        table.ajax.reload();
                                    }
                                }
                            })
                        } else {
                            swal("Cancelled", "Data kamu aman! :)", "error");
                        }
                    });
                });
            }
            // edit mhs
            $('#form_edit').on('submit', function(event) {
                event.preventDefault();
                var form_data = $(this).serialize();
                $.ajax({
                    url: "{{ config('setting.second_url') }}akademik/edit-herregistrasi",
                    method: "POST",
                    data: form_data,
                    dataType: "json",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    beforeSend: function() {
                        $("#btsubmit1").prop('disabled', true);
                    },
                    success: function(data) {
                        if (data.error) {
                            showToastr('error', 'Error!', data.error);
                            table.ajax.reload();
                            $("#btsubmit1").prop('disabled', false);
                        } else if (data.success) {
                            $('#modal_edit').modal('hide');
                            showToastr('success', 'Success!', data.success);
                            table.ajax.reload();
                            $('#form_edit')[0].reset();
                            $("#btsubmit1").prop('disabled', false);
                        }
                    }
                })
            });
            //save
            $('#form_add').on('submit', function(event) {
                event.preventDefault();
                var form_data = $(this).serialize();
                $.ajax({
                    url: "{{ config('setting.second_url') }}akademik/simpan-herregistrasi",
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
                            $('#modal_add').modal('hide');
                            showToastr('success', 'Success!', data.success);
                            table.ajax.reload();
                            $('#form_add')[0].reset();
                            $("#btsubmit").prop('disabled', false);
                        }
                    }
                })
            });
        });
    </script>
@stop
