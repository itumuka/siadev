@extends('layout')

@section('content')
    <div class="container-full">
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">Data Registrasi</h3>
                </div>

            </div>
        </div>
        <!-- Main content -->
        <section class="content">
            <div class="box">
                <div class="box-header with-border">
                    <h6 class="box-subtitle">Data Registrasi</h6>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <div class="box">
                        <div class="box-body ribbon-box bg-primary-light">
                            <div class="ribbon ribbon-info">informasi</div>
                            <p class="mb-0">Daftarkan calon mahasiswa baru menjadi mahasiswa dengan klik tombol
                                pada kolom
                                proses <i class="ti-pencil"></i>.</p>
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
                        <table id="kgtregistrasi" class="table table-hover table-striped">
                            <thead class="bg-dark">
                                <tr>
                                    <th>No</th>
                                    <th>No.Pendaftaran</th>
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <th>Tmpt/Tgl Lahir</th>
                                    <th>Jalur PMB</th>
                                    <th>Jenis Kelas</th>
                                    <th>Beasiswa</th>
                                    <th>Prodi</th>
                                    <th>Tahun Semester</th>
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

            <div class="modal fade" id="modal_edit">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Form Edit Registrasi</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                        <form id="form_edit" method="POST">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>No Pendaftaran*</label>
                                    <input class="form-control" readonly type="text" name="eno_pendaftaran"
                                        id="eno_pendaftaran" required>
                                    <input class="form-control" type="hidden" name="id_camaba" id="id_camaba"
                                        placeholder="ID Mahasiswa">
                                    <input class="form-control" type="hidden" name="ekode_program_pendidikan"
                                        id="ekode_program_pendidikan" placeholder="ID Mahasiswa">
                                    <input class="form-control" type="hidden" name="eid_mhs" id="eid_mhs"
                                        placeholder="ID Mahasiswa">
                                </div>
                                <div class="form-group">
                                    <label>Nama*</label>
                                    <input class="form-control" readonly type="text" name="enama_camaba"
                                        id="enama_camaba" placeholder="Nama">
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Registrasi*</label>
                                    <input class="form-control" type="date" name="etanggal_heregistrasi"
                                        id="etanggal_heregistrasi" placeholder="Nama">
                                </div>
                                <div class="form-group">
                                    <label>NIM*</label>
                                    <input class="form-control" type="text" name="enim" id="enim"
                                        placeholder="Nama">
                                </div>
                                <div class="form-group">
                                    <label>Tahun*</label>
                                    <input class="form-control" readonly type="text" name="etahun" id="etahun"
                                        placeholder="Nama">
                                </div>
                                <div class="form-group">
                                    <label>Semester*</label>
                                    <input class="form-control" readonly type="text" name="esemester" id="esemester"
                                        placeholder="Nama">
                                </div>
                                <div class="form-group">
                                    <label>Program Pendidikan*</label>
                                    <input class="form-control" readonly type="text" name="enama_program_pendidikan"
                                        id="enama_program_pendidikan" placeholder="Nama">
                                </div>
                                <div class="form-group">
                                    <label>Program Studi*</label>
                                    <input class="form-control" readonly type="text" name="enama_program_studi"
                                        id="enama_program_studi" placeholder="Nama">
                                </div>
                                <div class="form-group">
                                    <label>Tahun Kurikulum*</label>
                                    <select name="etahun_kurikulum" id="etahun_kurikulum" class="form-control">
                                        <option value="">Pilih</option>
                                        <option value=""></option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Model Pembayaran*</label>
                                    <select name="emodel_pembayaran" id="emodel_pembayaran" class="form-control">
                                        <option value="">Pilih Model Pembayaran</option>
                                        <option value="S">Semester</option>
                                        <option value="B">Bulanan</option>
                                    </select>
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
        </section>
        <!-- /.content -->
    </div>
@endsection
@section('script-master')
    <script type="text/javascript">
        var token = "{{ Session::get('token') }}";
        var userlogin = "{{ Session::get('username') }}";

        function editkurikulum() {
            $.ajax({
                type: 'GET',
                url: "{{ config('setting.second_url') }}akademik/edittampilkurikulum",
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                success: function(result) {
                    var jml = result.length;
                    var s = '<option value="">-Pilih Kurikulum-</option>';
                    for (i = 0; i < jml; i++) {
                        s = s + '<option value="' + result[i].tahun_kurikulum + '"> ' + result[i]
                            .tahun_kurikulum + '</option>';
                    }
                    // console.log(result);
                    $('#etahun_kurikulum').html(s);
                }
            })
        }
        editkurikulum();

        $(document).ready(function() {
            var token = "{{ Session::get('token') }}";
            var userlogin = "{{ Session::get('username') }}";
            tahunangkatan();

            function tahunangkatan() {
                $.ajax({
                    type: 'GET',
                    url: "{{ config('setting.second_url') }}akademik/tampiltahunangkatanmaba",
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
            function tbnilai(thn) {
                var table = $("#kgtregistrasi").DataTable({
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
                    // stateSave: true,
                    // scrollX: true,
                    // orderable: false,
                    ajax: {
                        type: "GET",
                        url: "{{ config('setting.second_url') }}akademik/registrasi",
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
                            data: 'no_pendaftaran'
                        },
                        {
                            data: 'nim'
                        },
                        {
                            data: 'nama_camaba'
                        },
                        {
                            data: null,
                            render: function(data, type, full, meta) {
                                return full.tempat_lahir + ', ' + full.tanggal_lahir;
                            }
                        },
                        {
                            data: 'nama_jalur'
                        },
                        {
                            data: 'nama_program_pendidikan'
                        },
                        {
                            data: null,
                            render: function(data, type, full, meta) {
                                if (full.jenis_pembayaran == 'Mandiri') {
                                    return "";
                                } else {
                                    return full.jenis_pembayaran;
                                }
                            }
                        },
                        {
                            data: 'nama_program_studi'
                        },
                        {
                            data: null,
                            render: function(data, type, full, meta) {
                                if (full.tahun_angkatan == null || full.tahun_angkatan == "") {
                                    return '';
                                } else {
                                    var smt = "";
                                    if (full.semester == '1') {
                                        smt = 'Ganjil';
                                    } else {
                                        smt = "Genap";
                                    }
                                    return full.tahun_angkatan + ' ' + smt;
                                }
                            }
                        }

                    ],
                    order: []
                });
                // show data edit mhs
                table.on('click', '#bt_edit', function() {
                    $tr = $(this).closest('tr');
                    var data = table.row($tr).data();
                    $('#modal_edit').modal('show');
                    $('#id_camaba').val(data['id_camaba']);
                    $('#eid_mhs').val(data['id_mhs']);
                    $('#eno_pendaftaran').val(data['no_pendaftaran']);
                    var kodeprodi = data['kode_program_studi'];
                    var tahunangkatan = data['no_pendaftaran'].substr(0, 4);
                    if (data['nim'] == "" || data['nim'] == null) {
                        $.ajax({
                            type: 'GET',
                            url: "{{ config('setting.second_url') }}akademik/ceknimterakhir",
                            headers: {
                                "Authorization": 'Bearer ' + token,
                                "username": userlogin
                            },
                            data: {
                                kode_program_studi: kodeprodi,
                                tahun_angkatan: tahunangkatan
                            },
                            success: function(result) {
                                console.log(result);
                                if (result != "") {
                                    var nimhasil = result.nim;
                                    var kodejalur = "";
                                    if (data['kode_jalur_pmb'] == "1") {
                                        kodejalur = "1";
                                    } else {
                                        kodejalur = "2";
                                    }
                                    var nimganti = nimhasil.substr(0, 6) + kodejalur + nimhasil
                                        .substr(7, 4);
                                    var nim = parseInt(nimganti) + 1;
                                    $('#enim').val(nim);
                                }
                            }
                        })
                    } else {
                        $('#enim').val(data['nim']);
                    }
                    $('#enama_camaba').val(data['nama_camaba']);
                    $('#etempat_lahir').val(data['tempat_lahir']);
                    $('#etanggal_lahir').val(data['tanggal_lahir']);
                    $('#enama_jalur').val(data['nama_jalur']);
                    $('#ekelas').val(data['kelas']);
                    $('#enama_program_studi').val(data['nama_program_studi']);
                    $('#etahun').val(data['tahun']);
                    $('#esemester').val(data['semester']);
                    $('#etanggal_heregistrasi').val(data['tgl_registrasi']);
                    $('#enama_program_pendidikan').val(data['nama_program_pendidikan']);
                    $('#ekode_program_pendidikan').val(data['kode_program_pendidikan']);
                    $('#etahun_kurikulum').val(data['tahun_kurikulum']);
                    $('#emodel_pembayaran').val(data['model_pembayaran']);
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
                                url: "{{ config('setting.second_url') }}akademik/ubahstatus-registrasi",
                                type: 'GET',
                                headers: {
                                    "Authorization": 'Bearer ' + token,
                                    "username": userlogin
                                },
                                data: {
                                    no_pendaftaran: id
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

                // edit
                $('#form_edit').on('submit', function(event) {
                    event.preventDefault();
                    var form_data = $(this).serialize();
                    $.ajax({
                        url: "{{ config('setting.second_url') }}akademik/edit-registrasi",
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
        });
    </script>
@stop
