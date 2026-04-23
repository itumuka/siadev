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
            <div class="box">
                <div class="box-header with-border">
                    <h6 class="box-subtitle">Import Data PMB</h6>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <div class="box">
                        <div class="box-body ribbon-box bg-primary-light">
                            <div class="ribbon ribbon-info">informasi</div>
                            <p class="mb-0">Data di bawah ini secara realtime ditampilkan dari aplikasi Penerimaan
                                Mahasiswa
                                Baru (PMB). Admin hanya dapat melakukan klik untuk melakukan import ke dalam Smart System.
                                Untuk membatalkan import/hapus dengan masuk ke menu Daftar Calon Mahasiswa Baru.</p>
                        </div> <!-- end box-body-->

                    </div>
                    <div class="box-header no-border">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control form-control-sm"
                                        placeholder="Filter Angkatan">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-rounded btn-info btn-sm dropdown-toggle"
                                            data-toggle="dropdown">Pilih Angkatan</button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="#" class="dropdown-item" {{-- id="btmodal_add" data-id='+el.kode_program_studi+' data-prodi='+el.nama_program_studi+' data-toggle="modal" data-target="#modal_add" --}}>2019</a>
                                            <a href="#" class="dropdown-item">2020</a>
                                            <a href="#" class="dropdown-item">2021</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="tbimportdatapmb" class="table table-hover table-sm text-nowrap" width="100%">
                            <thead class="thead-light">
                                <tr>
                                    <th>No</th>
                                    <th>No. Pendaftaran</th>
                                    <th>Prodi</th>
                                    <th>Tahun</th>
                                    <th>Nama</th>
                                    <th>Tpt/Tgl Lahir</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Proses</th>
                                </tr>
                            </thead>
                        </table>
                    </div>

                </div>
                <!-- /.box-body -->
            </div>

            {{-- modal add --}}
            <div class="modal fade" id="modal_add">
                <div class="modal-dialog modal-lg" role="document">
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
                                    <input class="form-control" type="hidden" name="kode_prodi" id="kode_prodi"
                                        placeholder="ex: 2021">

                                </div>
                                <div class="pull-right">
                                    <button type="button" class="btn btn-sm btn-primary" id="addrow"><i
                                            class="ti-plus"></i></button>
                                </div>
                                <div class="form-group table-responsive">
                                    <table id="blanktable" class="table table-hover table-sm text-nowrap" width="100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Mata Kuliah</th>
                                                <th>Mata Kuliah Prasyarat</th>
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
                            <h4 class="modal-title">Input Tahun Akademik</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                        <form id="form_edit" method="POST">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Mata Kuliah</label>
                                    <select class="form-control eselectmakul1" style="width: 100%;" name="emakul"
                                        id="emakul"></select>
                                    <input class="form-control" type="hidden" name="id_prasyarat" id="id_prasyarat">
                                    <input class="form-control" type="hidden" name="ekode_prodi" id="ekode_prodi">
                                </div>
                                <div class="form-group">
                                    <label>Mata Kuliah Prasyarat</label>
                                    <select class="form-control eselectmakul2" style="width: 100%;"
                                        name="emakul_prasyarat" id="emakul_prasyarat"></select>
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
                        let target = $(".dropdown-prodi")
                        $.each(data, function(index, value) {
                            var el = data[index];
                            var flag = 0;
                            target.append(
                                '<a href="#" class="dropdown-item" id="btmodal_add" data-id=' +
                                el.kode_program_studi + ' data-prodi=' + el
                                .nama_program_studi +
                                ' data-toggle="modal" data-target="#modal_add">' + el
                                .nama_program_studi + '</a>')
                        });
                    },
                    error: function(error) {
                        alert(error);
                    }
                });
            }
            // dropdown_prodi();


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
            var table = $("#tbimportdatapmb").DataTable({
                destroy: true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel'
                ],
                // responsive: true,
                // autoWidth: false,
                pageLength: 10,
                // processing: true,
                lengthChange: true,
                // searching: false,
                // serverSide: true,
                stateSave: true,
                // orderable: false,
                scrollX: true,
                scrollY: true,
                // order: [[ 1, 'asc' ]],
                // fixedColumns: {
                //   leftColumns: 2
                // },
            });


            var tdetail = $('#blanktable').DataTable({
                bInfo: false,
                bPaginate: false,
                bLengthChange: false,
                bFilter: false,
                //   select: true,      
                order: false,
                columns: [{
                        name: "no",
                        width: '1px',
                        "sClass": "text-center",
                        orderable: false
                    },
                    {
                        name: "makul_parent",
                        width: '100px',
                        "sClass": "text-center",
                        orderable: false
                    },
                    {
                        name: "makul_child",
                        width: '100px',
                        "sClass": "text-center",
                        orderable: false
                    },
                    {
                        name: "makul_child",
                        width: '1px',
                        "sClass": "text-center",
                        orderable: false,
                        render: (data, type, row) => {
                            return '<a href="#" id="delrow"><i class="ti-trash"></i></a>';
                        }
                    }
                ],
                drawCallback: function() {
                    $('.selectmakul1, .selectmakul2').select2({
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
                }
            });

            $('#addrow').on('click', function() {


                tdetail.row.add([
                    '',
                    '<select class="form-control selectmakul1" style="width: 100%;" name="makul[]" id="makul"></select>',
                    '<select class="form-control selectmakul2" style="width: 100%;" name="makul_prasyarat[]" id="makul_prasyarat"></select>'
                ]);
                // auto inc datatable
                tdetail.on('order.dt search.dt', function() {
                    tdetail.column(0, {
                        search: 'applied',
                        order: 'applied'
                    }).nodes().each(function(cell, i) {
                        cell.innerHTML = i + 1;
                    });
                }).draw();
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
            }).on('eselectmakul:select', function(evt) {
                $(".eselectmakul option:selected").val();
            });

            //save
            $('#form_add').on('submit', function(event) {
                event.preventDefault();
                var form_data = $(this).serialize();
                $.ajax({
                    url: "{{ config('setting.second_url') }}akademik/simpan-makulprasyarat",
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
                $('#id_prasyarat').val(data['id_prasyarat']);
                $(".modal-body #ekode_prodi").val(data['kode_program_studi']);
                $("#emakul").empty().append('<option value="' + data['id_matakuliah'] + '">' + data[
                    'nama_matakuliah_child'] + '</option>').val(data['id_matakuliah']).trigger('change');
                $("#emakul_prasyarat").empty().append('<option value="' + data['id_matakuliah_prasyarat'] +
                    '">' + data['nama_matakuliah_parent'] + '</option>').val(data[
                    'id_matakuliah_prasyarat']).trigger('change');
            });

            // edit
            $('#form_edit').on('submit', function(event) {
                event.preventDefault();
                var form_data = $(this).serialize();
                $.ajax({
                    url: "{{ config('setting.second_url') }}akademik/edit-makulprasyarat",
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
