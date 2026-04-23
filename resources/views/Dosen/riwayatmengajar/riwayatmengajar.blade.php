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
                    <h3 class="page-title">Riwayat Mengajar</h3>
                    <div class="d-inline-block align-items-center">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                                <li class="breadcrumb-item" aria-current="page">{{ $parent_breadcrumb }}</li>
                                {{-- <li class="breadcrumb-item active" aria-current="page">{{ $child_breadcrumb }}</li> --}}
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
                    <h6 class="box-subtitle">Melihat Data Riwayat Mengajar</h6>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <div class="box">
                        <div class="box-body ribbon-box bg-primary-light">
                            <div class="ribbon ribbon-info">informasi</div>
                            <p class="mb-0">Berikut ini merupakan data riwayat mengajar dosen</p>
                        </div> <!-- end box-body-->

                    </div>
                    <div>
                        <input class="form-control" type="hidden" name="tahun" id="tahun"
                            value="{{ $session_tahun }}">
                        <input class="form-control" type="hidden" name="semester" id="semester"
                            value="{{ $session_semester }}">
                        <input class="form-control" type="hidden" name="kode_prodi" id="kode_prodi"
                            value="{{ $session_kode_program_studi }}">
                        <input class="form-control" type="hidden" name="tipe" id="tipe"
                            value="{{ $session_tipe }}">
                        <input class="form-control" type="hidden" name="kode_dosen" id="kode_dosen"
                            value="{{ $session_kode_dosen }}">
                        <table id="tbriwayatngajar" class="table table-hover table-sm" width="100%">
                            <thead class="bg-dark">
                                <tr>
                                    <th>No</th>
                                    <th>TA</th>
                                    <th>Kurikulum</th>
                                    <th>Mata Kuliah</th>
                                    <th>SKS MK</th>
                                    <th>SMT MK</th>
                                    <th>Prodi</th>
                                    <th>Kelas</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                </div>
                <!-- /.box-body -->
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

            // $(document).on("click", "#btmodal_add", function () {
            //      var kode_prodi = $(this).data('id');
            //      var nama_prodi = $(this).data('prodi');
            //      $(".modal-body #kode_prodi").val( kode_prodi );
            //      $(".modal-body #nama_prodi").text('Program Studi: '+ nama_prodi );
            // });

            var kode_prodi = $('#kode_prodi').val();
            var tahun = $('#tahun').val();
            var semester = $('#semester').val();
            var tipe = $('#tipe').val();
            var kode_dosen = $('#kode_dosen').val();

            var table = $("#tbriwayatngajar").DataTable({
                destroy: true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel'
                ],
                // responsive: true,
                // autoWidth: false,
                pageLength: 10,
                processing: true,
                lengthChange: true,
                // searching: false,
                // serverSide: true,
                // stateSave: true,
                // scrollX: true,
                orderable: false,
                scrollX: true,
                scrollY: true,
                // order: [[ 1, 'asc' ]],
                // fixedColumns: {
                //   leftColumns: 2
                // },
                ajax: {
                    type: "GET",
                    url: "{{ config('setting.second_url') }}akademik/riwayat-mengajar",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    data: {
                        id_pegawai: kode_dosen
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
                        data: 'tahun_akademik',
                        className: 'text-center'
                    },
                    {
                        data: 'tahun_kurikulum',
                        className: 'text-center'
                    },
                    {
                        data: 'makul'
                    },
                    {
                        data: 'sks_matakuliah',
                        className: 'text-center'
                    },
                    {
                        data: 'smt_matakuliah',
                        className: 'text-center'
                    },
                    {
                        data: 'nama_program_studi'
                    },
                    {
                        data: 'nama_kelas'
                    }
                ],
                order: []
            });

            // $('#modal_add').on('hidden.bs.modal', function(e) {
            //     tdetail.clear().draw();
            //     $(".selectmakul1,.selectmakul2").val([]).trigger("change");
            // });

            function autoid(id) {
                $.ajax({
                    url: "{{ config('setting.second_url') }}akademik/pertemuan-ba",
                    method: "GET",
                    data: {
                        id_tawar: id
                    },
                    dataType: 'json',
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    success: function(result) {
                        $("#pertemuan").val(result.urut);
                    }
                });
            };

            //save
            $('#form_add').on('submit', function(event) {
                event.preventDefault();
                var form_data = $(this).serialize();
                $.ajax({
                    url: "{{ config('setting.second_url') }}akademik/simpan-ba",
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
            table.on('click', '#bt_modal_add', function() {
                $tr = $(this).closest('tr');
                var data = table.row($tr).data();
                $('#id_tawar').val(data['id_tawar']);
                $('#modal_add').modal('show');
                var id_tawar = $(this).data('id');

                autoid(id_tawar);
            });

            table.on('click', '#bt_modal_list', function() {
                $tr = $(this).closest('tr');
                var data = table.row($tr).data();
                // $('#id_tawar').val(data['id_tawar']);
                $('#modal_list').modal('show');
                var id_tawar = $(this).data('id');
                tabelba(id_tawar);
            });


            function tabelba(id) {
                var tdetail = $('#tbba').DataTable({
                    bInfo: false,
                    bPaginate: false,
                    bLengthChange: false,
                    bFilter: false,
                    //   select: true,      
                    order: false,
                    ajax: {
                        type: "GET",
                        url: "{{ config('setting.second_url') }}akademik/list-ba",
                        headers: {
                            "Authorization": 'Bearer ' + token,
                            "username": userlogin
                        },
                        data: {
                            id_tawar: id
                        },
                        dataSrc: function(json) {
                            return json;
                        }
                    },
                    columns: [{
                            data: "tgl",
                            orderable: false
                        },
                        {
                            data: "pertemuan_ke",
                            orderable: false
                        },
                        {
                            data: "materi_makul",
                            orderable: false
                        },
                        {
                            data: "peserta_hadir",
                            className: "text-center",
                            orderable: false
                        },
                        {
                            data: "jam_mulai",
                            className: "text-center",
                            orderable: false
                        },
                        {
                            data: "jam_selesai",
                            className: "text-center",
                            orderable: false
                        },
                        // { name : "aksi", width:'5%', className: "text-center", orderable: false,
                        //     render: (data,type,row) => {
                        //     return '<a href="#" id="delrow"><i class="ti-trash"></i></a>';
                        //     }
                        // }
                    ],
                });
            }



            // edit
            //     $('#form_edit').on('submit', function(event){
            //       event.preventDefault();
            //       var form_data = $(this).serialize();
            //       $.ajax({
            //           url:"{{ config('setting.second_url') }}akademik/edit-makulpenawaran",
            //           method:"POST",
            //           data:form_data,
            //           dataType:"json",
            //           beforeSend: function() {
            //             $("#btsubmit").prop('disabled', true);
            //           },
            //           success:function(data)
            //           {
            //               if(data.error){
            //                 showToastr('error', 'Error!', data.error);
            //                   table.ajax.reload();   
            //                   $("#btsubmit").prop('disabled', false);                                         
            //               }
            //               else if(data.success){  
            //                 $('#modal_add').modal('hide'); 
            //                 showToastr('success', 'Success!', data.success);                              
            //                 table.ajax.reload();
            //                 $('#form_edit')[0].reset();
            //                 $("#btsubmit").prop('disabled', false);
            //             }                                   
            //           }              
            //       })                   
            //   });

            // hapus
            //     table.on('click', '.del[data-id]', function (e) { 
            //     e.preventDefault();     
            //     var id = $(this).data('id');
            //     swal({   
            //         title: "Apa anda yakin?",   
            //         text: "Kamu tidak akan bisa mengembalikan data!",   
            //         type: "warning",   
            //         showCancelButton: true,   
            //         confirmButtonColor: "#DD6B55",   
            //         confirmButtonText: "Ya, hapus !",   
            //         cancelButtonText: "Tidak, batal !",   
            //         closeOnCancel: false 
            //     }, function(isConfirm){   
            //         if (isConfirm) { 
            //             $.ajax({
            //               url: "{{ config('setting.second_url') }}akademik/hapus-makulprasyarat",              
            //               type: 'GET',
            //               data: {id:id},                
            //               dataType: 'json',
            //                 success: function (data) {
            //                   if(data.gagal){
            //                     showToastr('error', 'Error!', data.gagal); 
            //                   }
            //                   else if(data.berhasil)
            //                   {  
            //                     showToastr('success', 'Success!', data.berhasil);                              
            //                     table.ajax.reload();                                
            //                   }
            //                 }
            //             }) 
            //         } else {     
            //             swal("Cancelled", "Data kamu aman! :)", "error");   
            //         } 
            //     });
            // });

        });
    </script>
@stop
