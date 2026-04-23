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
                    <h3 class="page-title">Data Nilai Transkip Mahasiswa</h3>
                    <div class="d-inline-block align-items-center">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                                {{-- <li class="breadcrumb-item" aria-current="page">{{ $parent_breadcrumb }}</li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $child_breadcrumb }}</li> --}}
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
                    {{-- <h3 class="box-title">Tahun Ajaran</h3> --}}
                    <h6 class="box-subtitle">Melihat Nilai Transkip Mahasiswa</h6>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <div class="box">
                        <div class="box-body ribbon-box bg-primary-light">
                            <div class="ribbon ribbon-info">informasi</div>
                            <p class="mb-0">Penawaran mata kuliah yang ditampilkan di {{ $session_nama_tahunakademik }}
                            </p>
                        </div> <!-- end box-body-->

                    </div>
                    <div class="text-right">
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
                        {{-- <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_add"><i class="ti-plus"></i> Tambah</button> --}}
                    </div>
                    <div class="table-responsive">
                        <table id="tbnilaimahasiswa" class="table table-hover table-sm text-nowrap" width="100%">
                            <thead class="bg-dark">
                                <tr>
                                    <th>No</th>
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <th>Tmpt/Tgl Lahir</th>
                                    <th>Jalur PMB</th>
                                    <th>Kelas</th>
                                    <th>Prodi</th>
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
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Input Mata Kuliah Prasyarat</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                        <form id="form_add" method="POST">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label id="nama_prodi"></label>
                                    <input class="form-control" type="hidden" name="kode_prodi" id="kode_prodi">

                                </div>
                                <div class="pull-right">
                                    <button type="button" class="btn btn-sm btn-primary" id="addrow"><i
                                            class="ti-plus"></i></button>
                                </div>
                                {{-- <div class="form-group table-responsive">
                                    <table id="blanktable" class="table table-hover table-sm" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Mata Kuliah</th>
                                                <th>Hari</th>
                                                <th>Jam Mulai</th>
                                                <th>Jam Selesai</th>
                                                <th>Ruang</th>
                                                <th>Kelas</th>
                                                <th>Dosen</th>
                                                <th>Kaps.</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div> --}}
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

            {{-- modal edit --}}

            <div class="modal fade" id="modal_edit">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Mata Kuliah Penawaran</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                        <form id="form_edit" method="POST">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Kode Matakuliah</label>
                                    <input class="form-control" type="hidden" name="id_mhs" id="id_mhs">
                                    <input class="form-control" type="hidden" name="id_kelas" id="id_kelas">
                                    <input class="form-control" type="text" name="ekode_prodi" id="ekode_prodi" readonly>
                                    <input class="form-control" type="hidden" name="ekode_matakuliah"
                                        id="ekode_matakuliah">
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
                        var s = '<option value="">Semua Angkatan</option>';
                        for (i = 0; i < jml; i++) {
                            s = s + '<option value="' + result[i].tahun_angkatan + '"> ' + result[i]
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


            var nim = $('#nim').val();

            function dropdown_angkatan() {
                $.ajax({
                    type: "POST",
                    url: "{{ config('setting.second_url') }}akademik/dropdown-angkatan",
                    dataType: "json",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    success: function(data) {
                        // $('.test').fadeOut();
                        let target = $(".dropdown-prodi")
                        $.each(data, function(index, value) {
                            var el = data[index];
                            var flag = 0;
                            target.append(
                                '<option class="dropdown-item">' + el
                                .tahun_angkatan + '</option>')
                        });
                    },
                    error: function(error) {
                        alert(error);
                    }
                });
            }
            dropdown_angkatan();


            $(document).on("click", "#btmodal_add", function() {
                var kode_prodi = $(this).data('id');
                var nama_prodi = $(this).data('prodi');
                $(".modal-body #kode_prodi").val(kode_prodi);
                $(".modal-body #nama_prodi").text('Program Studi: ' + nama_prodi);
                // $('#addBookDialog').modal('show');
            });

            // var nim = $('#nim').val();
            // var ta = $('#ta').val();
            // var smt = $('#smt').val();
            // var token = $('#token').val();



            function tbnilai(thn) {

                var table = $("#tbnilaimahasiswa").DataTable({
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
                        url: "{{ config('setting.second_url') }}akademik/nilaimahasiswa",
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
                            orderable: false,
                            render: function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }
                        },
                        {
                            data: 'nim',
                            orderable: false
                        },
                        {
                            data: 'nama_mahasiswa',
                            orderable: false
                        },
                        {
                            data: null,
                            orderable: false,
                            render: function(data, type, full, meta) {
                                return full.tempat_lahir + ', ' + full.tanggal_lahir;
                            }
                        },
                        {
                            data: 'nama_jalur',
                            orderable: false
                        },
                        {
                            data: 'status',
                            orderable: false
                        },
                        {
                            data: 'nama_program_studi',
                            orderable: false
                        },
                        {
                            data: null,
                            render: function(data, type, full, meta) {
                                return '<a href="{{ url('akademik/mahasiswa/form-input-nilai') }}/' +
                                    full.nim +
                                    '/' + full.kode_program_studi +
                                    '" class="text-info mr-10" title><i class="ti-marker-alt"></i></a> <a href="{{ url('akademik/mahasiswa/form-input-nilai') }}/' +
                                    full.nim +
                                    '/' + full.kode_program_studi +
                                    '" class="text-info mr-10"><i class="fa fa-edit"></i></a>';
                            }
                        },

                    ],
                    order: []
                });
            }



            var tdetail = $('#blanktable').DataTable({
                bInfo: false,
                bPaginate: false,
                bLengthChange: false,
                bFilter: false,
                //   select: true,      
                order: false,
                columns: [{
                        name: "makul",
                        width: '20%',
                        "sClass": "text-center",
                        orderable: false
                    },
                    {
                        name: "hari",
                        width: '10%',
                        "sClass": "text-center",
                        orderable: false
                    },
                    {
                        name: "jam_mulai",
                        width: '10%',
                        "sClass": "text-center",
                        orderable: false
                    },
                    {
                        name: "jam_selesai",
                        width: '10%',
                        "sClass": "text-center",
                        orderable: false
                    },
                    {
                        name: "ruang",
                        width: '8%',
                        "sClass": "text-center",
                        orderable: false
                    },
                    {
                        name: "kelas",
                        width: '7%',
                        "sClass": "text-center",
                        orderable: false
                    },
                    {
                        name: "dosen",
                        width: '20%',
                        orderable: false
                    },
                    {
                        name: "kapasitas",
                        width: '10%',
                        "sClass": "text-center",
                        orderable: false
                    },
                    {
                        name: "aksi",
                        width: '5%',
                        "sClass": "text-center",
                        orderable: false,
                        render: (data, type, row) => {
                            return '<a href="#" id="delrow"><i class="ti-trash"></i></a>';
                        }
                    }
                ],
                drawCallback: function() {
                    $('.selectmakul1').select2({
                        allowClear: true,
                        placeholder: '-Select Makul-',
                        ajax: {
                            dataType: 'json',
                            url: "{{ config('setting.second_url') }}akademik/select-makul",
                            headers: {
                                "Authorization": 'Bearer ' + token,
                                "username": userlogin
                            },
                            delay: 100,
                            data: function(params) {
                                var kd_prodi = $('#kode_prodi').val();
                                return {
                                    kode_prodi: kd_prodi,
                                    search: params.term
                                }
                            },
                            processResults: function(data) {
                                var data_array = [];
                                data.data.forEach(function(value, key) {
                                    data_array.push({
                                        id: value.id,
                                        text: value.text
                                    })
                                });

                                return {
                                    results: data_array
                                }
                            }
                        }
                    }).on('selectmakul:select', function(evt) {
                        $(".selectmakul option:selected").val();
                    });


                    $('.selectdosen').select2({
                        allowClear: true,
                        placeholder: '-Select Dosen-',
                        ajax: {
                            dataType: 'json',
                            url: "{{ config('setting.second_url') }}akademik/select-dosen",
                            headers: {
                                "Authorization": 'Bearer ' + token,
                                "username": userlogin
                            },
                            delay: 100,
                            data: function(params) {
                                var kd_prodi = $('#ekode_prodi').val();
                                return {
                                    kode_prodi: kd_prodi,
                                    search: params.term
                                }
                            },
                            processResults: function(data) {
                                var data_array = [];
                                data.data.forEach(function(value, key) {
                                    data_array.push({
                                        id: value.id,
                                        text: value.text
                                    })
                                });

                                return {
                                    results: data_array
                                }
                            }
                        }
                    }).on('selectdosen:select', function(evt) {
                        $(".selectdosen option:selected").val();
                    });

                }
            });

            $('#addrow').on('click', function() {


                tdetail.row.add([
                    '<select class="form-control selectmakul1" style="width: 100%;" name="makul[]" id="makul"></select>',
                    '<input type="text" class="form-control" name="hari[]" id="hari" placeholder="Hari">',
                    '<input type="text" class="form-control" name="jam_mulai[]" id="jam_mulai" placeholder="Jam Mulai">',
                    '<input type="text" class="form-control" name="jam_selesai[]" id="jam_selesai" placeholder="Jam Selesai">',
                    '<input type="text" class="form-control" name="ruang[]" id="ruang" placeholder="Jam Selesai">',
                    '<input type="text" class="form-control" name="kelas[]" id="kelas" placeholder="Jam Selesai">',
                    '<select class="form-control selectdosen" style="width: 100%;" name="kode_dosen[]" id="kode_dosen"></select>',
                    '<input type="text" class="form-control" name="kapasitas[]" id="kapasitas" placeholder="Kapasitas">'
                ]).draw();
            });

            tdetail.on('click', '#delrow', function() {
                tdetail.row($(this).parents('tr'))
                    .remove()
                    .draw();
            });


            $('#modal_add').on('hidden.bs.modal', function(e) {
                tdetail.clear().draw();
                $(".selectmakul1,.selectmakul2").val([]).trigger("change");
            });


            $('.eselectmakul1, .eselectmakul2').select2({
                allowClear: true,
                placeholder: '-Select Makul-',
                ajax: {
                    dataType: 'json',
                    url: "{{ config('setting.second_url') }}akademik/select-makul",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    delay: 100,
                    data: function(params) {
                        // var kd_prodi = $('#ekode_prodi').val();
                        return {
                            // kode_prodi: kd_prodi,
                            search: params.term
                        }
                    },
                    processResults: function(data) {
                        var data_array = [];
                        data.data.forEach(function(value, key) {
                            data_array.push({
                                id: value.id,
                                text: value.text
                            })
                        });

                        return {
                            results: data_array
                        }
                    }
                }
            }).on('eselectmakul:select', function(evt) {
                $(".eselectmakul option:selected").val();
            });

            //select Dosen
            $('.selectdosen').select2({
                allowClear: true,
                placeholder: '-Select Dosen-',
                ajax: {
                    dataType: 'json',
                    url: "{{ config('setting.second_url') }}akademik/select-dosen",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    delay: 100,
                    data: function(params) {
                        var kd_prodi = $('#ekode_prodi').val();
                        return {
                            kode_prodi: kd_prodi,
                            search: params.term
                        }
                    },
                    processResults: function(data) {
                        var data_array = [];
                        data.data.forEach(function(value, key) {
                            data_array.push({
                                id: value.id,
                                text: value.text
                            })
                        });

                        return {
                            results: data_array
                        }
                    }
                }
            }).on('selectdosen:select', function(evt) {
                $(".selectdosen option:selected").val();
            });


            //save
            $('#form_add').on('submit', function(event) {
                event.preventDefault();
                var form_data = $(this).serialize();
                $.ajax({
                    url: "{{ config('setting.second_url') }}akademik/simpan-makulprasyarat",
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


            // show data edit
            table.on('click', '#bt_edit', function() {
                $tr = $(this).closest('tr');
                var data = table.row($tr).data();
                $('#modal_edit').modal('show');
                // $('#id_mhs').val(data['id_mhs']);
                // $('#id_kelas').val(data['id_kelas']);
                // $('#ekode_matakuliah').val(data['kode_matakuliah']);
                // $('#enama_matakuliah').val(data['nama_matakuliah']);
                // $('#enama_kelas').val(data['nama_kelas']);
                // $('#eruang').val(data['kode_ruang']);
                // $('#ehari').val(data['hari']);
                // $('#ejam_mulai').val(data['jam_mulai']);
                // $('#ejam_selesai').val(data['jam_selesai']);
                // $('#ekapasitas_ruang').val(data['kapasitas_ruang']);
                // $(".modal-body #ekode_prodi").val(data['kode_program_studi']);
                // $("#enama_dosen").empty().append('<option value="' + data['id'] + '">' + data['nidn'] +
                //     '/' + data['nama'] + '</option>').val(data['id']).trigger('change');
            });

            // edit
            $('#form_edit').on('submit', function(event) {
                event.preventDefault();
                var form_data = $(this).serialize();
                $.ajax({
                    url: "{{ config('setting.second_url') }}akademik/edit-makulpenawaran",
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
                            url: "{{ config('setting.second_url') }}akademik/hapus-makulprasyarat",
                            type: 'GET',
                            headers: {
                                "Authorization": 'Bearer ' + token,
                                "username": userlogin
                            },
                            data: {
                                id: id
                            },
                            dataType: 'json',
                            success: function(data) {
                                if (data.gagal) {
                                    showToastr('error', 'Error!', data.gagal);
                                } else if (data.berhasil) {
                                    showToastr('success', 'Success!', data.berhasil);
                                    table.ajax.reload();
                                }
                            }
                        })
                    } else {
                        swal("Cancelled", "Data kamu aman! :)", "error");
                    }
                });
            });

        });
    </script>
@stop
