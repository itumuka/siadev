@extends('layout')

@section('content')
    <div class="container-full">
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">Ubah Password Mahasiswa</h3>
                </div>

            </div>
        </div>
        <!-- Main content -->
        <section class="content">
            <div class="box">
                <div class="box-header with-border">
                    <h6 class="box-subtitle">Ubah Password Mahasiswa</h6>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <div class="box">
                        <div class="box-body ribbon-box bg-primary-light">
                            <div class="ribbon ribbon-info">informasi</div>
                            <p class="mb-0">Reset password mahasiswa dan orang tua mahasiswa dengan klik tombol <i
                                    class="ti-key"></i>.</p>
                        </div> <!-- end box-body-->
                    </div>
                    <div class="box-header no-border">
                        <div class="row">
                            <div class="col-sm-2">
                                <label for="tahunangkatan">&emsp;&emsp;&emsp;Tahun Angkatan :</label>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <select class="form-control" name="tahunangkatan" id="tahunangkatan">
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="kgtpasswordmahasiswa" class="table table-hover table-striped">
                            <thead class="bg-dark">
                                <tr>
                                    <th>No</th>
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <th>Program Studi</th>
                                    <th>Password Mahasiswa</th>
                                    <th>Password Orang Tua</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>

            {{-- modal edit --}}

            <div class="modal fade" id="modal_editmhs">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Password Mahasiswa</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                        <form id="form_editmhs" method="POST">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Password Baru</label>
                                    <input class="form-control" type="password" name="epasswordbaru" id="epasswordbaru"
                                        placeholder="Password Baru">
                                    <input class="form-control" type="hidden" name="id_mhs" id="id_mhs"
                                        placeholder="ID Mahasiswa">
                                </div>
                                <div class="form-group">
                                    <label>Ulangi Password</label>
                                    <input class="form-control" type="password" name="eulangipassword" id="eulangipassword"
                                        placeholder="Password Baru">
                                </div>
                            </div>
                            <div class="modal-footer float-right">
                                <button type="button" class="btn btn-rounded btn-warning btn-outline mr-1"
                                    data-dismiss="modal">
                                    <i class="fa fa-times"></i> Close
                                </button>
                                <button type="submit" class="btn btn-rounded btn-primary btn-outline" id="btsubmitmhs">
                                    <i class="ti-save-alt"></i> Save
                                </button>
                            </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

            {{-- modal edit --}}

            <div class="modal fade" id="modal_editortu">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Password Orang Tua</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                        <form id="form_editortu" method="POST">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Password Baru</label>
                                    <input class="form-control" type="password" name="epasswordbaru1" id="epasswordbaru1"
                                        placeholder="Password Baru">
                                    <input class="form-control" type="hidden" name="id_mhs1" id="id_mhs1"
                                        placeholder="ID Mahasiswa">
                                </div>
                                <div class="form-group">
                                    <label>Ulangi Password</label>
                                    <input class="form-control" type="password" name="eulangipasswordbaru1"
                                        id="eulangipasswordbaru1" placeholder="Password Baru">
                                </div>
                            </div>
                            <div class="modal-footer float-right">
                                <button type="button" class="btn btn-rounded btn-warning btn-outline mr-1"
                                    data-dismiss="modal">
                                    <i class="ti-trash"></i> Close
                                </button>
                                <button type="submit" class="btn btn-rounded btn-primary btn-outline" id="btsubmitortu">
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
        $(document).ready(function() {
            var token = "{{ Session::get('token') }}";
            var userlogin = "{{ Session::get('username') }}";
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
                            s = s + '<option value="' + result[i].tahun_angkatan + '"> ' +
                                result[i]
                                .tahun_angkatan +
                                '</option>';
                        }
                        s = s + '<option value="">Semua Angkatan</option>';
                        // console.log(result);
                        $('#tahunangkatan').html(s);
                        var thnn = $('#tahunangkatan').val();
                        tbnilai(thnn);
                    }
                })
            }

            $('#tahunangkatan').on('change', function(event) {
                var thnn = $('#tahunangkatan').val();
                tbnilai(thnn);

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

            function tbnilai(thn) {
                table = $("#kgtpasswordmahasiswa").DataTable({
                    destroy: true,
                    dom: 'l<br>Bfrtip',
                    buttons: [
                        'copy', 'csv', 'excel'
                    ],
                    // responsive: true,
                    // autoWidth: false,
                    // lengthMenu: [
                    //     [10, 25, 50, -1],
                    //     [10, 25, 50, "All"]
                    // ],
                    processing: true,
                    lengthChange: true,
                    // searching: false,
                    // serverSide: true,
                    // stateSave: true,
                    // scrollX: true,
                    // orderable: false,
                    ajax: {
                        type: "GET",
                        url: "{{ config('setting.second_url') }}akademik/passwordmahasiswa",
                        headers: {
                            "Authorization": 'Bearer ' + token,
                            "username": userlogin
                        },
                        data: {
                            tahunangkatan: thn,
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
                            data: 'nama_program_studi'
                        },
                        {
                            data: null,
                            render: function(data, type, full, meta) {
                                if (full.trash == '1') {
                                    return '<a href="javascript:void(0)" class="text-info mr-10" id="bt_editmhs" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-key"></i> Ubah Password Mahasiswa</a>';
                                } else {
                                    return '<a href="javascript:void(0)" class="text-info mr-10" id="bt_editmhs" data-toggle="tooltip"  data-original-title="Edit"><i class="fa fa-key"></i> Ubah Password Mahasiswa</a>';

                                }
                            }
                        },
                        {
                            data: null,
                            render: function(data, type, full, meta) {
                                if (full.trash == '1') {
                                    return '<a href="javascript:void(0)" class="text-info mr-10" id="bt_editortu" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-key"></i> Ubah Password Orang Tua</a>';
                                } else {
                                    return '<a href="javascript:void(0)" class="text-info mr-10" id="bt_editortu" data-toggle="tooltip"  data-original-title="Edit"><i class="fa fa-key"></i> Ubah Password Orang Tua</a>';

                                }
                            }
                        },

                    ],
                    order: []
                });
                // show data edit mhs
                table.on('click', '#bt_editmhs', function() {
                    $tr = $(this).closest('tr');
                    var data = table.row($tr).data();
                    $('#modal_editmhs').modal('show');
                    $('#id_mhs').val(data['id_mhs']);
                    // $('#epasswordbarumhs').val(data['passwordbarumhs']);
                    // $('#eulangpasswordmhs').val(data['ulangpasswordmhs']);
                    // $("#" + data.trash).prop("checked", true)
                });
                // show data edit ortu
                table.on('click', '#bt_editortu', function() {
                    $tr = $(this).closest('tr');
                    var data = table.row($tr).data();
                    $('#modal_editortu').modal('show');
                    $('#id_mhs1').val(data['id_mhs']);
                    // $('#epasswordbaruortu').val(data['passwordbaruortu']);
                    // $('#eulangpasswordortu').val(data['ulangpasswordortu']);
                    // $("#" + data.trash).prop("checked", true)
                });
            }


            // edit mhs
            $('#form_editmhs').on('submit', function(event) {
                event.preventDefault();
                var form_data = $(this).serialize();
                var epassword = $('#epasswordbaru').val();
                var epasswordulang = $('#eulangipassword').val();
                if (epassword == epasswordulang) {

                    $.ajax({
                        url: "{{ config('setting.second_url') }}akademik/edit-passwordmahasiswamhs",
                        method: "POST",
                        data: form_data,
                        dataType: "json",
                        headers: {
                            "Authorization": 'Bearer ' + token,
                            "username": userlogin
                        },
                        beforeSend: function() {
                            $("#btsubmitmhs").prop('disabled', true);
                        },
                        success: function(data) {
                            if (data.error) {
                                showToastr('error', 'Error!', data.error);
                                $("#btsubmitmhs").prop('disabled', false);
                                table.ajax.reload();
                            } else if (data.success) {
                                $('#modal_editmhs').modal('hide');
                                showToastr('success', 'Success!', data.success);
                                $("#btsubmitmhs").prop('disabled', false);
                                table.ajax.reload();
                                $('#form_editmhs')[0].reset();
                            }
                        }
                    })
                } else {
                    showToastr('error', 'Error!', "Password tidak sama!");
                }
            });

            // edit ortu
            $('#form_editortu').on('submit', function(event) {
                event.preventDefault();
                var form_data = $(this).serialize();
                var epasswordortu = $('#epasswordbaru1').val();
                var epasswordulangortu = $('#eulangipasswordbaru1').val();
                if (epasswordortu == epasswordulangortu) {

                    $.ajax({
                        url: "{{ config('setting.second_url') }}akademik/edit-passwordmahasiswaortu",
                        method: "POST",
                        data: form_data,
                        dataType: "json",
                        headers: {
                            "Authorization": 'Bearer ' + token,
                            "username": userlogin
                        },
                        beforeSend: function() {
                            $("#btsubmitortu").prop('disabled', true);
                        },
                        success: function(data) {
                            if (data.error) {
                                showToastr('error', 'Error!', data.error);
                                table.ajax.reload();
                                $("#btsubmitortu").prop('disabled', false);
                            } else if (data.success) {
                                $('#modal_editortu').modal('hide');
                                showToastr('success', 'Success!', data.success);
                                table.ajax.reload();
                                $('#form_addortu')[0].reset();
                                $("#btsubmitortu").prop('disabled', false);
                            }
                        }
                    })
                } else {
                    showToastr('error', 'Error!', "Password tidak sama!");
                }
            });
        });
    </script>
@stop
