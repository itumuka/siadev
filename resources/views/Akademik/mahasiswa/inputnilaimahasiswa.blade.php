@extends('layout')

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

        <!-- Main content -->
        <section class="content">

            <!-- Validation wizard -->
            <div class="box box-default">
                {{-- <div class="box-header with-border">
                    <h4 class="box-title">Step wizard with validation</h4>
                    <h6 class="box-subtitle">You can us the validation like what we did</h6>
                </div> --}}
                <!-- /.box-header -->
                <div class="modal-header">
                </div>
                <input type="text" name="kode_prodi" id="kode_prodi" value="{{ $kode_program_studi }}">
                <form id="form_add" method="POST">
                    <div class="modal-body">
                        <div class="pull-right">
                            <button type="button" class="btn btn-sm btn-primary" id="addrow"><i
                                    class="ti-plus"></i></button>
                        </div>
                        <div class="form-group table-responsive">
                            <input type="hidden" name="nim" id="nim" value="{{ $nim }}">

                            <table id="blanktable" class="table table-hover table-sm" width="100%">
                                <thead>
                                    <tr>
                                        <th>Nim</th>
                                        <th>Mata Kuliah</th>
                                        <th>Nilai</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                            </table>
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
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>
@endsection
@section('script-master')
    <script type="text/javascript">
        $(document).ready(function() {
        var token = "{{ Session::get('token') }}";
        var userlogin = "{{ Session::get('username') }}";
            var kode_program_studi = $('#kode_program_studi').val();

        });

        function nama_program_studi(kode_program_studi) {
            $.ajax({
                type: 'GET',
                url: "{{ config('setting.second_url') }}akademik/tampilperprodi",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                success: function(result) {
                    var jml = result.length;
                    var s = '<option value="">-Pilih-</option>';
                    for (i = 0; i < jml; i++) {
                        s = s + '<option value="' + result[i].kode_program_studi + '"> ' + result[i]
                            .nama_program_studi + '</option>';
                    }
                    // console.log(result);
                    $('#nama_program_studi').html(s);
                }
            })
        }
        nama_program_studi();

        function jalur_pmb() {
            $.ajax({
                type: 'GET',
                url: "{{ config('setting.second_url') }}akademik/tampiljalurpmb",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                success: function(result) {
                    var jml = result.length;
                    var s = '<option value="">-Pilih-</option>';
                    for (i = 0; i < jml; i++) {
                        s = s + '<option value="' + result[i].kode_jalur_pmb + '"> ' + result[i]
                            .nama_jalur + '</option>';
                    }
                    // console.log(result);
                    $('#jalur_pmb').html(s);
                }
            })
        }
        jalur_pmb();

        function provinsi() {
            $.ajax({
                type: 'GET',
                url: "{{ config('setting.second_url') }}akademik/tampilprovinsi",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                success: function(result) {
                    var jml = result.length;
                    var s = '<option value="">-Pilih-</option>';
                    for (i = 0; i < jml; i++) {
                        s = s + '<option value="' + result[i].kode_provinsi + '"> ' + result[i]
                            .nama_provinsi + '</option>';
                    }
                    // console.log(result);
                    $('#provinsi').html(s);
                }
            })
        }
        provinsi();

        function provinsiortu() {
            $.ajax({
                type: 'GET',
                url: "{{ config('setting.second_url') }}akademik/tampilprovinsi",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                success: function(result) {
                    var jml = result.length;
                    var s = '<option value="">-Pilih-</option>';
                    for (i = 0; i < jml; i++) {
                        s = s + '<option value="' + result[i].kode_provinsi + '"> ' + result[i]
                            .nama_provinsi + '</option>';
                    }
                    // console.log(result);
                    $('#provinsiortu').html(s);
                }
            })
        }
        provinsiortu();


        var tdetail = $('#blanktable').DataTable({
            bInfo: false,
            bPaginate: false,
            bLengthChange: false,
            bFilter: false,
            //   select: true,      
            order: false,
            columns: [{
                    name: "nim",
                    width: '10%',
                    "sClass": "text-center",
                    orderable: false
                },
                {
                    name: "makul",
                    width: '20%',
                    "sClass": "text-center",
                    orderable: false
                },
                {
                    name: "nilai",
                    width: '20%',
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


                $('.selectnilai').select2({
                    allowClear: true,
                    placeholder: '-Select Nilai-',
                    ajax: {
                        dataType: 'json',
                        url: "{{ config('setting.second_url') }}akademik/select-nilai",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                        delay: 100,
                        data: function(params) {
                            // var kd_prodi = $('#kode_prodi').val();
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
                }).on('selectnilai:select', function(evt) {
                    $(".selectnilai option:selected").val();
                });

            }
        });

        //save
        $('#form_add').on('submit', function(event) {
            event.preventDefault();
            var form_data = $(this).serialize();
            $.ajax({
                url: "{{ config('setting.second_url') }}akademik/simpan-nilai_akhir1",
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
                        // $('#modal_add').modal('hide');
                        showToastr('success', 'Success!', data.success);
                        table.ajax.reload();
                        $('#form_add')[0].reset();
                        $("#btsubmit").prop('disabled', false);
                    }
                }
            })
        });
        $('#addrow').on('click', function() {


            tdetail.row.add([
                '<input type="text" class="form-control" value="{{ $nim }}" readonly="" placeholder="Nim">',
                '<select class="form-control selectmakul1" style="width: 100%;" name="makul[]" id="makul"></select>',
                '<select class="form-control selectnilai" style="width: 100%;" name="nilai_huruf_akhir[]" id="nilai_huruf_akhir"></select>'
            ]).draw();
        });

        tdetail.on('click', '#delrow', function() {
            tdetail.row($(this).parents('tr'))
                .remove()
                .draw();
        });
    </script>
@stop
