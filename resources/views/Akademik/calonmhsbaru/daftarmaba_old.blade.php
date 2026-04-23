@extends('layout')

@section('content')
    <div class="container-full">
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">Data calon Mahasiswa</h3>
                </div>

            </div>
        </div>
        <!-- Main content -->
        <section class="content">
            <div class="box">
                <div class="box-header with-border">
                    <h6 class="box-subtitle">Melihat Data calon Mahasiswa</h6>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <div class="box">
                        <div class="box-body ribbon-box bg-primary-light">
                            <div class="ribbon ribbon-info">informasi</div>
                            <p class="mb-0">Data calon mahasiswa baru ditampilkan per tahun angkatan. Untuk
                                menambahkan calon mahasiswa baru dapat menggunakan menu import dari data PMB atau mengisi
                                formulir tambah calon mahasiswa baru.</p>
                        </div> <!-- end box-body-->
                    </div>
                    <div class="box-header no-border">
                        <div class="row">
                            <div class="col-sm-2">
                                <label for="tahunakademik">&emsp;&emsp;&emsp;Tahun Akademik :</label>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <select class="form-control" name="tahunangkatan" id="tahunangkatan">
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="text-center">
                                    <a href="{{ route('aktambahcalonmhs') }}" type="button"
                                        class="btn btn-primary btn-sm float-right"><i class="fa fa-plus"></i>
                                        &nbspTambah</a>
                                    {{-- <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal"
                                        data-target="#modal_add"><i class="fa fa-plus"></i> Tambah</button> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="kgtdaftarmaba" class="table table-hover table-striped">
                            <thead class="bg-dark">
                                <tr>
                                    <th>No</th>
                                    <th>No. Pendaftaran</th>
                                    <th>Nama</th>
                                    <th>Tempat/Tgl Lahir</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Jurusan</th>
                                    <th>Jenis Kelas</th>
                                    <th>Jalur <br>PMB</th>
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
            {{-- modal edit --}}

            <div class="modal fade" id="modal_edit">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Fakultas</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                        <form>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div id="image-popups" class="row">
                                            <center>
                                                <div class="col-sm-5">
                                                    <a href="{{ url('images/gallery/thumb/10.jpg') }}"
                                                        data-effect="mfp-zoom-in"><img
                                                            src="{{ url('images/gallery/thumb/10.jpg') }}" class="img-fluid"
                                                            alt="" /></a>
                                                </div>
                                            </center>
                                        </div><br><br>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">Nama</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" name="nama_camaba"
                                                    id="nama_camaba" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">No Pendaftaran</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" name="no_pendaftaran"
                                                    id="no_pendaftaran" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">Jenis Kelamin</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" name="jenis_kelamin"
                                                    id="jenis_kelamin" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="box box-default">
                                            <!-- /.box-header -->
                                            <div class="box-body">
                                                <!-- Nav tabs -->
                                                <ul class="nav nav-tabs" role="tablist">
                                                    <li class="nav-item"> <a class="nav-link active" data-toggle="tab"
                                                            href="#home8" role="tab"><span><i
                                                                    class="ion-home mr-15"></i>Data Mahasiswa</span></a>
                                                    </li>
                                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab"
                                                            href="#profile8" role="tab"><span><i
                                                                    class="ion-person mr-15"></i>Pendidikan</span></a> </li>
                                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab"
                                                            href="#messages8" role="tab"><span><i
                                                                    class="ion-email mr-15"></i>Orang Tua</span></a> </li>
                                                </ul>
                                                <!-- Tab panes -->
                                                <div class="tab-content tabcontent-border">
                                                    <div class="tab-pane active" id="home8" role="tabpanel">
                                                        <div class="p-15">
                                                            <table>
                                                                <tr>
                                                                    <td>Nama</td>
                                                                    <td>:</td>
                                                                    <td>Nama</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Nama</td>
                                                                    <td>:</td>
                                                                    <td>Nama</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Nama</td>
                                                                    <td>:</td>
                                                                    <td>Nama</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Nama</td>
                                                                    <td>:</td>
                                                                    <td>Nama</td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="profile8" role="tabpanel">
                                                        <div class="p-15">
                                                            <table>
                                                                <tr>
                                                                    <td>Nama</td>
                                                                    <td>:</td>
                                                                    <td>Nama</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Nama</td>
                                                                    <td>:</td>
                                                                    <td>Nama</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Nama</td>
                                                                    <td>:</td>
                                                                    <td>Nama</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Nama</td>
                                                                    <td>:</td>
                                                                    <td>Nama</td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="messages8" role="tabpanel">
                                                        <div class="p-15">
                                                            <table>
                                                                <tr>
                                                                    <td>Nama</td>
                                                                    <td>:</td>
                                                                    <td>Nama</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Nama</td>
                                                                    <td>:</td>
                                                                    <td>Nama</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Nama</td>
                                                                    <td>:</td>
                                                                    <td>Nama</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Nama</td>
                                                                    <td>:</td>
                                                                    <td>Nama</td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.box-body -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer float-right">
                                <button type="button" class="btn btn-rounded btn-warning btn-outline mr-1"
                                    data-dismiss="modal">
                                    <i class="fa fa-times"></i> Close
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

            function ubahformattgl(inputDate, format) {
                //parse the input date
                const date = new Date(inputDate);

                //extract the parts of the date
                const day = date.getDate();
                const month = date.getMonth() + 1;
                const year = date.getFullYear();

                //replace the month
                format = format.replace("MM", month.toString().padStart(2, "0"));

                //replace the year
                if (format.indexOf("yyyy") > -1) {
                    format = format.replace("yyyy", year.toString());
                } else if (format.indexOf("yy") > -1) {
                    format = format.replace("yy", year.toString().substr(2, 2));
                }

                //replace the day
                format = format.replace("dd", day.toString().padStart(2, "0"));

                return format;
            }


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
                            s = s + '<option value="' + result[i].tahun_angkatan + '"> ' + result[i]
                                .tahun_angkatan +
                                '</option>';
                        }
                        s = s + '<option value="">Semua Tahun</option>';
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


            var id_mhs = $('#id_mhs').val();

            // function dropdown_angkatan() {
            //     $.ajax({
            //         type: "POST",
            //         url: "{{ config('setting.second_url') }}akademik/dropdown-angkatan",
            //         dataType: "json",
            //         headers: {
            //             "Authorization": 'Bearer ' + token,
            //             "username": userlogin
            //         },
            //         success: function(data) {
            //             // $('.test').fadeOut();
            //             let target = $(".dropdown-prodi")
            //             $.each(data, function(index, value) {
            //                 var el = data[index];
            //                 var flag = 0;
            //                 target.append(
            //                     '<a href="#" class="dropdown-item" id="btmodal_add" data-id=' +
            //                     el.id_mhs + ' data-prodi=' + el
            //                     .tahun_angkatan +
            //                     ' data-toggle="modal" data-target="#modal_add">' + el
            //                     .tahun_angkatan + '</a>')
            //             });
            //         },
            //         error: function(error) {
            //             alert(error);
            //         }
            //     });
            // }
            // dropdown_angkatan();

            function tbnilai(thn) {
                var table = $("#kgtdaftarmaba").DataTable({
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
                        url: "{{ config('setting.second_url') }}akademik/daftarmaba",
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
                            data: 'nama_camaba'
                        },
                        {
                            data: null,
                            render: function(data, type, full, meta) {
                                return full.tempat_lahir + ', ' + ubahformattgl(full.tanggal_lahir,
                                    'dd-MM-yyyy');
                            }
                        },
                        {
                            data: null,
                            render: function(data, type, full, meta) {
                                if (full.jenis_kelamin == 'L') {
                                    return 'Laki-laki';
                                } else if (full.jenis_kelamin == 'P') {
                                    return 'Perempuan';
                                } else {
                                    return '-';
                                }
                            }
                        },
                        {
                            data: 'nama_program_studi'
                        },
                        {
                            data: 'nama_program_pendidikan'
                        },
                        {
                            data: 'nama_jalur'
                        },
                        {
                            data: null,
                            render: function(data, type, full, meta) {
                                if (full.id_camaba < '0') {
                                    return '<a href="{{ url('akademik/calonmhsbaru/edit-mahasiswabaru') }}/' +
                                        full.id_camaba +
                                        '" class="text-info mr-10" data-toggle="tooltip" data-original-title="Edit"><i class="ti-marker-alt"></i></a> <a href="javascript:void(0)" class="text-info mr-10" id="bt_edit" data-toggle="tooltip" data-original-title="Lihat Data" title="Lihat Data"><i class="ti-eye"></i></a> <a href="javascript:void(0)" class="text-danger del" data-id="' +
                                        full.id_camaba +
                                        '" data-original-title="Delete" data-toggle="tooltip"><i class="ti-trash"></i></a>';
                                } else {
                                    return '<a href="{{ url('akademik/calonmhsbaru/edit-mahasiswabaru') }}/' +
                                        full.id_camaba +
                                        '" class="text-info mr-10" data-toggle="tooltip" data-original-title="Edit"><i class="ti-marker-alt"></i></a> <a href="javascript:void(0)" class="text-info mr-10" id="bt_edit" data-toggle="tooltip" data-original-title="Lihat Data" title="Lihat Data"><i class="ti-eye"></i></a><a href="javascript:void(0)" class="text-danger del" data-id="' +
                                        full.id_camaba +
                                        '" data-original-title="Delete" data-toggle="tooltip"><i class="ti-trash"></i></a>';

                                }
                            }
                        },

                    ],
                    order: []
                });


                // show data edit
                table.on('click', '#bt_edit', function() {
                    $tr = $(this).closest('tr');
                    var data = table.row($tr).data();
                    $('#modal_edit').modal('show');
                    $('#nama_camaba').val(data['nama_camaba']);
                    $('#no_pendaftaran').val(data['no_pendaftaran']);
                    $('#jenis_kelamin').val(data['jenis_kelamin']);
                    $('#tempat_lahir').val(data['tempat_lahir']);
                    $('#tanggal_lahir').val(data['tanggal_lahir']);
                    $('#alamat_asal').val(data['alamat_asal']);
                    $('#semester').val(data['semester']);
                    $('#tahun').val(data['tahun']);
                    $('#kode_kewarganegaraan').val(data['kode_kewarganegaraan']);
                    $('#kode_agama').val(data['kode_agama']);
                    $('#rt').val(data['rt']);
                    $('#rw').val(data['rw']);
                    $('#telp').val(data['telp']);
                    $('#email').val(data['email']);
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
                                url: "{{ config('setting.second_url') }}akademik/ubahstatus-camaba",
                                type: 'GET',
                                headers: {
                                    "Authorization": 'Bearer ' + token,
                                    "username": userlogin
                                },
                                data: {
                                    id_camaba: id
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
        });
    </script>
@stop
