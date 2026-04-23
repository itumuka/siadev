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
                    <h3 class="page-title">Mata Kuliah Penawaran</h3>
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
            <div class="box">
                <div class="box-header with-border">
                    {{-- <h3 class="box-title">Tahun Ajaran</h3> --}}
                    <h6 class="box-subtitle">Melihat Mata Kuliah Penawaran</h6>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <div class="box">
                        <div class="box-body ribbon-box bg-primary-light">
                            <div class="ribbon ribbon-info">informasi</div>
                            <p class="mb-0">Penawaran mata kuliah yang ditampilkan
                                {{ $session_nama_tahunakademik }}</p>
                        </div> <!-- end box-body-->

                    </div>
                    <div class="box-header no-border">
                        <div id="failuresLink" class="mt-2">
                            <!-- The download link will be injected here by the AJAX success handler -->
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <select class="form-control" name="programstudi" id="programstudi">
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-9">
                                <div class="text-right">
                                    <div class="btn-group mb-5">
                                        <button type="button"
                                        class="waves-effect waves-light btn btn-sm btn-success" data-toggle="modal" data-target="#modal_import"><i class="fa fa-cloud-upload"></i> Import</button>
                                        <button type="button"
                                            class="waves-effect waves-light btn btn-sm btn-dark dropdown-toggle"
                                            data-toggle="dropdown"><i class="ti-plus"></i> Tambah</button>
                                        <div class="dropdown-menu dropdownprodi">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="tbmakulpenawaran" class="table table-bordered table-striped table-hover">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th>No</th>
                                    <th>Aksi</th>
                                    <th>Matakuliah</th>
                                    <th>Hari</th>
                                    <th>Kelas</th>
                                    <th>Ruang</th>
                                    <th>Waktu</th>
                                    <th>Smt</th>
                                    <th>Dosen</th>
                                    <th>Teams</th>
                                    <th>Kapasitas</th>
                                    <th>Peserta</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
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
                            <h4 class="modal-title">Input Penawaran Matakuliah</h4>
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
                                <div class="form-group table-responsive">
                                    <input class="form-control" type="hidden" name="tahun" id="tahun"
                                        value="{{ $session_tahun }}">
                                    <input class="form-control" type="hidden" name="semester" id="semester"
                                        value="{{ $session_semester }}">
                                    <input class="form-control" type="hidden" name="kode_fakultas" id="kode_fakultas"
                                        value="{{ $session_kode_fakultas }}">
                                    <input class="form-control" type="hidden" name="jabatan" id="jabatan"
                                        value="{{ $session_jabatan }}">

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
                                                <th>Dosen 2</th>
                                                <th>Kaps.</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                    </table>
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
                                    <input class="form-control" type="hidden" name="id_tawar" id="id_tawar">
                                    <input class="form-control" type="hidden" name="id_kelas" id="id_kelas">
                                    <input class="form-control" type="hidden" name="ekode_prodi" id="ekode_prodi"
                                        readonly>
                                    <input class="form-control" type="text" name="ekode_matakuliah"
                                        id="ekode_matakuliah" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Nama Mata Kuliah</label>
                                    <input class="form-control" type="text" name="enama_matakuliah"
                                        id="enama_matakuliah" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Nama Kelas</label>
                                    <input class="form-control" type="text" name="enama_kelas" id="enama_kelas">
                                </div>
                                <div class="form-group">
                                    <label>Ruang</label>
                                    <input type="text" class="form-control" name="eruang" id="eruang"
                                        placeholder="Ruang">
                                </div>
                                <div class="form-group">
                                    <label>Hari</label>
                                    <input type="text" class="form-control" name="ehari" id="ehari"
                                        placeholder="Hari">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Jam Mulai</label>
                                            <input type="text" class="form-control" name="ejam_mulai" id="ejam_mulai"
                                                placeholder="Jam Mulai">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Jam Selesai</label>
                                            <input type="text" class="form-control" name="ejam_selesai"
                                                id="ejam_selesai" placeholder="Jam Selesai">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Kapasitas Ruang</label>
                                    <input type="text" class="form-control" name="ekapasitas_ruang"
                                        id="ekapasitas_ruang" placeholder="Kapasitas Ruang">
                                </div>
                                <div class="form-group">
                                    <label>Nama Dosen</label>
                                    <select class="form-control selectdosen" style="width: 100%;" name="enama_dosen"
                                        id="enama_dosen"></select>
                                </div>
                                <div class="form-group">
                                    <label>Nama Dosen 2</label>
                                    <select class="form-control selectdosen" style="width: 100%;" name="enama_dosen2"
                                        id="enama_dosen2"></select>
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


            <div class="modal fade" id="modal_import">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Import Mata Kuliah Penawaran</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                        <form id="form_import" method="POST">
                            <div class="modal-body">
                                <div class="form-group">
                                    <input type="file" class="form-control" name="fileimport" id="inputGroupFile04"
                                        aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary btn-sm" type="submit" id="btsubmit"><i
                                            class="fa fa-upload"></i> Upload</button>
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


        </section>
        <!-- /.content -->
    </div>
@endsection
@section('script-master')
    <script type="text/javascript">
        $(document).ready(function() {
            var token = "{{ Session::get('token') }}";
            var userlogin = "{{ Session::get('username') }}";
            programstudi();

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
                        var s = '<option value="">Program Studi</option>';
                        for (i = 0; i < jml; i++) {
                            s = s + '<option value="' + result[i].nama_program_studi +
                                '"> ' + result[i]
                                .nama_program_studi + '</option>';
                        }
                        // console.log(result);
                        $('#programstudi').html(s);
                        var nama_program_studi = $('#programstudi').val();
                        tbnilai(nama_program_studi);
                    }
                })
            }

            $('#programstudi').on('change', function(event) {
                var nama_program_studi = $('#programstudi').val();
                tbnilai(nama_program_studi);

            });

            var kd_prodi = $('#kode_prodi').val();

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
                        // $('.test').fadeOut();
                        let target = $(".dropdownprodi")
                        $.each(data, function(index, value) {
                            var el = data[index];
                            var flag = 0;
                            target.append(
                                '<a href="#" class="dropdown-item" id="btmodal_add" data-id=' +
                                el.kode_program_studi + ' data-prodi="' + el
                                .nama_program_studi.toString() +
                                '" data-toggle="modal" data-target="#modal_add">' + el
                                .nama_program_studi.toString() + '</a>')
                        });
                    },
                    error: function(error) {
                        alert(error);
                    }
                });
            }
            dropdown_prodi();


            $(document).on("click", "#btmodal_add", function() {
                var kode_prodi = $(this).data('id');
                var nama_prodi = $(this).data('prodi');
                $(".modal-body #kode_prodi").val(kode_prodi);
                $(".modal-body #nama_prodi").html('Program Studi: ' + nama_prodi);
                // $('#addBookDialog').modal('show');
                console.log(nama_prodi);
            });

            function tbnilai(nama_program_studi) {
                var kode_fakultas = $('#kode_fakultas').val();
                var tahun = $('#tahun').val();
                var semester = $('#semester').val();
                var jabatan = $('#jabatan').val();
            
                var table = $("#tbmakulpenawaran").DataTable({
                    destroy: true,
                    dom: 'l<br>Bfrtip',
                    buttons: ['copy', 'csv', 'excel'],
                    processing: true,
                    lengthChange: true,
                    ajax: {
                        type: "GET",
                        url: "{{ config('setting.second_url') }}akademik/makulpenawaran",
                        headers: {
                            "Authorization": 'Bearer ' + token,
                            "username": userlogin
                        },
                        data: {
                            nama_program_studi: nama_program_studi,
                            tahun: tahun,
                            semester: semester,
                            kode_fakultas: kode_fakultas,
                            jabatan: jabatan
                        },
                        dataSrc: function(json) {
                            return json;
                        }
                    },
                    columns: [
                        {   // No
                            data: null,
                            render: function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }
                        },
                        // {   // Aksi
                        //     data: null,
                        //     render: function(data, type, full) {
                        //         return `
                        //             <button class="btn btn-xs btn-primary" title="Tambah"><i class="ti-plus"></i></button>
                        //             <button class="btn btn-xs btn-warning" title="Detail"><i class="ti-file"></i></button>
                        //             <button class="btn btn-xs btn-danger del" data-id="${full.id_tawar}" title="Hapus"><i class="ti-trash"></i></button>
                        //         `;
                        //     }
                        // },
                        {
                            data: null,
                            render: function(data, type, full, meta) {
                                return '<a href="javascript:void(0)" class="btn btn-xs btn-primary mr-10" id="bt_edit" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-edit"></i></a><a href="javascript:void(0)" class="btn btn-xs btn-danger del" data-id="' +
                                    full.id_tawar +
                                    '" data-original-title="Delete" data-toggle="tooltip"><i class="fa fa-trash"></i></a>';
                            }
                        },
                        {   // Matakuliah + detail
                            data: null,
                            render: function(data, type, row) {
                                return `<strong>${row.nama_matakuliah}</strong><br>
                                        Semester: ${row.smt_matakuliah} | SKS: ${row.sks_matakuliah}<br>
                                        Prodi: ${row.nama_program_studi}`;
                            }
                        },
                        { data: 'hari' },
                        { data: 'nama_kelas' },
                        { data: 'kode_ruang' },
                        { data: 'waktu' },
                        { data: 'smt_matakuliah' },
                        {   // Gabungan dosen1 + dosen2
                            data: null,
                            render: function(data, type, row) {
                                if (row.dosen2 && row.dosen2.trim() !== '') {
                                    return `${row.dosen1}<br>${row.dosen2}`;
                                } else {
                                    return row.dosen1;
                                }
                            }
                        },
                        {   // Teams
                            data: 'teams',
                            render: function(data) {
                                return data === "Ya"
                                    ? '<span class="badge bg-success">Ya</span>'
                                    : '<span class="badge bg-danger">Tidak</span>';
                            }
                        },
                        { data: 'kapasitas_ruang' },
                        { data: 'jumlah_peserta' }
                    ],
                    order: []
                });




                // show data edit
                table.on('click', '#bt_edit', function() {
                    $tr = $(this).closest('tr');
                    var data = table.row($tr).data();
                    $('#modal_edit').modal('show');
                    $('#id_tawar').val(data['id_tawar']);
                    $('#id_kelas').val(data['id_kelas']);
                    $('#ekode_matakuliah').val(data['kode_matakuliah']);
                    $('#enama_matakuliah').val(data['nama_matakuliah']);
                    $('#enama_kelas').val(data['nama_kelas']);
                    $('#eruang').val(data['kode_ruang']);
                    $('#ehari').val(data['hari']);
                    $('#ejam_mulai').val(data['jam_mulai']);
                    $('#ejam_selesai').val(data['jam_selesai']);
                    $('#ekapasitas_ruang').val(data['kapasitas_ruang']);
                    $(".modal-body #ekode_prodi").val(data['kode_program_studi']);
                    $("#enama_dosen").empty().append('<option value="' + data['id_dosen1'] + '">' + data[
                            'nidn_dosen1'] +
                        '/' + data['dosen1'] + '</option>').val(data['id_dosen1']).trigger('change');
                    $("#enama_dosen2").empty().append('<option value="' + data['id_dosen2'] + '">' + data[
                            'nidn_dosen2'] +
                        '/' + data['dosen2'] + '</option>').val(data['id_dosen2']).trigger('change');
                });

                // edit
                $('#form_edit').on('submit', function(event) {
                    event.preventDefault();
                    var form_data = $(this).serialize();
                    $.ajax({
                        url: "{{ config('setting.second_url') }}akademik/edit-makulpenawaran",
                        method: "POST",
                        headers: {
                            "Authorization": 'Bearer ' + token,
                            "username": userlogin
                        },
                        data: form_data,
                        dataType: "json",
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
                                url: "{{ config('setting.second_url') }}akademik/hapus-makulpenawaran",
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
            var tdetail = $('#blanktable').DataTable({
                bInfo: false,
                bPaginate: false,
                bLengthChange: false,
                bFilter: false,
                //   select: true,      
                order: false,
                columns: [{
                        name: "makul",
                        width: '30%',
                        "sClass": "text-center",
                        orderable: false
                    },
                    {
                        name: "hari",
                        width: '15%',
                        "sClass": "text-center",
                        orderable: false
                    },
                    {
                        name: "jam_mulai",
                        width: '7%',
                        "sClass": "text-center",
                        orderable: false
                    },
                    {
                        name: "jam_selesai",
                        width: '7%',
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
                        name: "dosen2",
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
            $(".selectdosen").val("-");
            $('#addrow').on('click', function() {


                tdetail.row.add([
                    '<select class="form-control selectmakul1" style="width: 100%;" name="makul[]" id="makul"></select>',
                    '<select class="form-control" style="width: 120px;" name="hari[]" id="hari"><option value="Senin">Senin</option><option value="Selasa">Selasa</option><option value="Rabu">Rabu</option><option value="Kamis">Kamis</option><option value="Jumat">Jumat</option><option value="Sabtu">Sabtu</option><option value="Minggu">Minggu</option></select>',
                    '<input type="time" class="form-control" name="jam_mulai[]" id="jam_mulai" placeholder="Jam Mulai">',
                    '<input type="time" class="form-control" name="jam_selesai[]" id="jam_selesai" placeholder="Jam Selesai">',
                    '<input type="text" class="form-control" style="width: 80px;" name="ruang[]" id="ruang" placeholder="Ruang">',
                    '<input type="text" class="form-control" style="width: 80px;" name="kelas[]" id="kelas" placeholder="Kelas">',
                    '<select class="form-control selectdosen" style="width: 100%;" name="kode_dosen[]" id="kode_dosen"></select>',
                    '<select class="form-control selectdosen" style="width: 100%;" name="kode_dosen2[]" id="kode_dosen2"></select>',
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
                    url: "{{ config('setting.second_url') }}akademik/simpan-makulpenawaran",
                    method: "POST",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    data: form_data,
                    dataType: "json",
                    beforeSend: function() {
                        $("#btsubmit").prop('disabled', true);
                    },
                    success: function(data) {
                        if (data.error) {
                            $("#btsubmit").prop('disabled', false);
                            showToastr('error', 'Error!', data.error);
                            table.ajax.reload();
                        } else if (data.success) {
                            $("#btsubmit").prop('disabled', false);
                            $('#modal_add').modal('hide');
                            showToastr('success', 'Success!', data.success);
                            table.ajax.reload();
                            $('#form_add')[0].reset();
                        }
                    }
                })
            });

        $('#form_import').on('submit', function(event) {
            event.preventDefault();
            var form_data = new FormData(this);  // Use FormData to handle file uploads

            $.ajax({
                url: "{{ config('setting.second_url') }}akademiktools/import-makul-penawaran",
                method: "POST",
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                data: form_data,
                contentType: false,
                processData: false,
                dataType: "json",
                beforeSend: function() {
                    $("#btsubmit").prop('disabled', true);
                },
                success: function(response) {
                    $("#btsubmit").prop('disabled', false);

                    if (response.success) {
                        showToastr('success', 'Success!', response.success);
                        if (response.failures_url) {
                            // Display link to download errors
                            $('#failuresLink').html('<div class="alert alert-warning alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-warning"></i>Success with error!</h4><a href="' + response.failures_url + '" download> <i class="icon fa fa-download"></i> Download Errors </a></div>');
                        }
                        $('#modal_import').modal('hide');
                        $('#form_import')[0].reset();
                        table.ajax.reload();
                    } else {
                        showToastr('error', 'Error!', 'Unexpected error occurred.');
                    }
                },
                error: function(response) {
                    $("#btsubmit").prop('disabled', false);
                    showToastr('error', 'Error!', response.responseJSON.error);
                }
            });
        });


        });
    </script>
@stop
