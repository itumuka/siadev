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
                    <h3 class="page-title">Mata Kuliah Diampu</h3>
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
                    <h6 class="box-subtitle">Melihat Mata Kuliah Diampu</h6>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <div class="box">
                        <div class="box-body ribbon-box bg-primary-light">
                            <div class="ribbon ribbon-info">informasi</div>
                            <p class="mb-0">Presensi Mahasiswa semester ganjil tahun ajaran 2020/2021</p>
                        </div> <!-- end box-body-->

                    </div>
                    <div class="table-responsive">
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
                        <table id="tbmakulpenawaran" class="table table-hover table-sm" width="100%">
                            <thead class="bg-dark">
                                <tr>
                                    <th>Aksi</th>
                                    <th>No</th>
                                    <th>Matakuliah</th>
                                    <th>Hari</th>
                                    <th>Kelas</th>
                                    <th>Ruang</th>
                                    <th>Waktu</th>
                                    <th>Smt</th>
                                    <th>Prodi</th>
                                    <th>Kapasitas</th>
                                    <th>Peserta</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                </div>
                <!-- /.box-body -->
            </div>



            <div class="modal modal-fill fade" id="modal_list" data-backdrop="static" tabindex="-1" role="dialog"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Hitung Presensi Kuliah</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table id="tbhitung" class="table table-bordered table-sm table-striped" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Pertemuan</th>
                                            <th>Hadir</th>
                                            <th>Sakit</th>
                                            <th>Izin</th>
                                            <th>Alpha</th>
                                        </tr>
                                    </thead>
                                    <tbody id="detailpertemuan">
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <div class="modal-footer text-right">
                            <button type="button" class="btn btn-rounded btn-warning btn-outline mr-1"
                                data-dismiss="modal">
                                <i class="fa fa-times"></i> Close
                            </button>
                            {{-- <button type="submit" class="btn btn-rounded btn-primary btn-outline" id="btsubmit">
                        <i class="ti-save-alt"></i> Save
                      </button> --}}
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

            <div class="modal fade" id="modal_lihat_mhs">
                <form id="form_save_presensi" method="POST">
                    <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">

                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Daftar Mahasiswa <span id="jenis_presensi"></span></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                            </div>

                            <div class="modal-body">
                                <input type="hidden" class="form-control" name="id_kls_presensi" id="id_kls_presensi">
                                <input type="hidden" class="form-control" name="pertemuan" id="pertemuan_presensi">
                                <div class="table-responsive">
                                    <table id="tbmhs" class="table table-hover table-sm" width="100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>NIM</th>
                                                <th>Nama</th>
                                            </tr>
                                        </thead>
                                        <tbody id="lihatmhs">
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <div class="modal-footer text-right">
                                <button type="button" class="btn btn-rounded btn-warning btn-outline mr-1"
                                    data-dismiss="modal">
                                    <i class="fa fa-times"></i> Close
                                </button>
                                <button type="submit" class="btn btn-rounded btn-primary btn-outline"
                                    id="btsavepresensi">
                                    <i class="ti-save-alt"></i> Save
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
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

            var kode_prodi = $('#kode_prodi').val();
            var tahun = $('#tahun').val();
            var semester = $('#semester').val();
            var tipe = $('#tipe').val();
            var kode_dosen = $('#kode_dosen').val();

            var table = $("#tbmakulpenawaran").DataTable({
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
                // scrollX: true,
                // scrollY: true,
                // order: [[ 1, 'asc' ]],
                // fixedColumns: {
                //   leftColumns: 2
                // },
                ajax: {
                    type: "GET",
                    url: "{{ config('setting.second_url') }}akademik/makulpenawaran",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    data: {
                        tahun: tahun,
                        semester: semester,
                        kode_prodi: kode_prodi,
                        tipe: tipe,
                        kode_dosen: kode_dosen
                    },
                    dataSrc: function(json) {
                        return json;
                    }
                },
                columns: [{
                        data: null,
                        className: 'text-center',
                        render: function(data, type, full, meta) {
                            return '<a href="javascript:void(0)" class="text-primary" id="bt_modal_list" data-id="' +
                                full.id_kelas +
                                '" data-original-title="Daftar Pertemuan" data-toggle="tooltip" title="Daftar Pertemuan"><i class="ti-calendar"></i></a>';
                        }
                    },
                    {
                        data: null,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'nama_matakuliah'
                    },
                    {
                        data: 'hari'
                    },
                    {
                        data: 'nama_kelas'
                    },
                    {
                        data: 'kode_ruang'
                    },
                    {
                        data: 'waktu'
                    },
                    {
                        data: 'semester'
                    },
                    {
                        data: 'nama_program_studi'
                    },
                    {
                        data: 'kapasitas_ruang',
                        className: 'text-center'
                    },
                    {
                        data: 'jumlah_peserta',
                        className: 'text-center'
                    },

                ],
                order: []
            });

            // $('#modal_add').on('hidden.bs.modal', function(e) {
            //     tdetail.clear().draw();
            //     $(".selectmakul1,.selectmakul2").val([]).trigger("change");
            // });

            function autopertemuanba(id) {
                $.ajax({
                    url: "{{ config('setting.second_url') }}akademik/pertemuan-ba",
                    method: "GET",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    data: {
                        id_kelas: id
                    },
                    dataType: 'json',
                    success: function(result) {
                        $("#pertemuan").val(result.urut);
                    }
                });
            };

            function autopertemuanpresensi(id) {
                $.ajax({
                    url: "{{ config('setting.second_url') }}akademik/pertemuan-presensi-mhs",
                    method: "GET",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    data: {
                        id_kelas: id
                    },
                    dataType: 'json',
                    success: function(result) {
                        $("#pertemuan_presensi").val(result.urut);
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


            table.on('click', '#bt_modal_list', function() {
                $tr = $(this).closest('tr');
                var data = table.row($tr).data();
                $('#modal_list').modal('show');
                var id_kelas = $(this).data('id');
                tabelhitungpresensi(id_kelas);
            });


            function tabellistpresensi(id) {
                var tdetail = $('#tblistmhs').DataTable({
                    bInfo: false,
                    bPaginate: false,
                    bLengthChange: false,
                    bFilter: false,
                    destroy: true,
                    order: false,
                    ajax: {
                        type: "GET",
                        url: "{{ config('setting.second_url') }}akademik/presensi-mhs",
                        headers: {
                            "Authorization": 'Bearer ' + token,
                            "username": userlogin
                        },
                        data: {
                            id_kelas: id
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
                            data: "nim"
                        },
                        {
                            data: "nama_mahasiswa"
                        },
                        {
                            data: null,
                            name: 'hadir',
                            className: 'text-center',
                            render: function(data, type, full, meta) {
                                return '<input class="form-control" type="hidden" name="nim[]" id="nim" value="' +
                                    full.nim +
                                    '" ><select name="status[]" class="form-control" ><option value="Hadir" selected>Hadir</option><option value="Sakit">Sakit</option><option value="Ijin">Ijin</option><option value="Alpha">Alpha</option></select>';
                            }
                        },
                        {
                            data: null,
                            className: 'text-center',
                            visible: false,
                            render: function(data, type, full, meta) {
                                return '<input class="form-control" type="text" name="nim[]" id="nim" value="' +
                                    full.nim + '" >';
                            }
                        }
                    ],
                });
            }

            function tabelhitungpresensi(id) {
                $.ajax({
                    type: 'POST',
                    dataType: "json",
                    url: "{{ config('setting.second_url') }}akademik/data-hitungpresensi",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    data: {
                        id_kelas: id
                    },
                    success: function(data) {
                        var jml = data.length;
                        var no = 1;
                        var tampil = '';
                        if (jml > 0) {
                            for (var i = 0; i < jml; i++) {
                                var hadir = data[i].hadir == "0" ? "0" : data[i].hadir.split("#")
                                    .length;
                                var sakit = data[i].sakit == "0" ? "0" : data[i].sakit.split("#")
                                    .length;
                                var ijin = data[i].ijin == "0" ? "0" : data[i].ijin.split("#").length;
                                var alpha = data[i].alpha == "0" ? "0" : data[i].alpha.split("#")
                                    .length;

                                tampil = tampil + '<tr><td><center>' +
                                    data[i].tgl + '</center></td><td><center>' +
                                    data[i].pertemuan +
                                    '</center></td><td><center><a href="javascript:void(0)" class="text-info mr-10" onclick="tbcekmhspresensi(' +
                                    data[i].id + ',' + data[i].hadir +
                                    ')" data-toggle="tooltip" title="Lihat Mahasiswa">' + hadir +
                                    '</a>' +
                                    '</center></td><td><center>' + sakit +
                                    '</center></td><td><center>' + ijin +
                                    '</center></td><td><center>' + alpha +
                                    '</center></td></tr>';
                                no++;
                            }
                        } else {

                            tampil = tampil + '<tr><td colspan="6"> Tidak ada data </td></tr>';
                        }

                        $('#detailpertemuan').html(tampil);
                        console.log(jml);
                    }
                });

                $('#tbhitung').DataTable({
                    bInfo: false,
                    bPaginate: false,
                    bLengthChange: false,
                    bFilter: false,
                    destroy: false,
                    order: false,
                    columnDefs: [{
                        targets: [0, 1, 2, 3, 4, 5],
                        className: "text-center"
                    }]
                });

                // tb.on('click', '#btlihatmhs', function() {
                //     $tr = $(this).closest('tr');
                //     var data = tb.row($tr).data();
                //     $('#modal_lihat_mhs').modal('show');
                //     var id = $(this).data('id');
                //     tbcekmhspresensi(id);
                // });

                // $('#btlihatmhs').on('click', function() {
                //     $('#modal_lihat_mhs').modal('show');
                //     var id = $(this).data('id');
                //     tbcekmhspresensi(id);
                // });

            }



            function tbcekmhspresensi(id, nim) {
                $('#modal_lihat_mhs').modal('show');
                var jal = nim.replace("#", ",");
                console.log(jal);

                // $.ajax({
                //     type: 'POST',
                //     // headers: {
                //     //     "Authorization": 'Bearer ' + token
                //     // },
                //     dataType: "json",
                //     url: "{{ config('setting.second_url') }}akademik/daftar-mhs",
                //     data: {
                //         id: id,
                //         jmlmhs: nim
                //     },
                //     success: function(data) {
                //         var jml = data.length;
                //         var no = 1;
                //         var tampil = '';
                //         if (jml > 0) {
                //             for (var i = 0; i < jml; i++) {

                //                 tampil = tampil + '<tr><td><center>' +
                //                     no + '</center></td><td><center>' +
                //                     data[i].nim + '</center></td><td><center>' +
                //                     data[i].nama_mahasiswa + '</center></td></tr>';
                //                 no++;
                //             }
                //         } else {

                //             tampil = tampil + '<tr><td colspan="6"> Tidak ada data </td></tr>';
                //         }

                //         $('#lihatmhs').html(tampil);
                //         console.log(jml);
                //     }
                // });

                // $('#tbmhs').DataTable({
                //     bInfo: false,
                //     bPaginate: false,
                //     bLengthChange: false,
                //     bFilter: false,
                //     destroy: true,
                //     order: false,
                //     columnDefs: [
                //         { targets: [0,1,2,3,4,5], className: "text-center"}
                //     ]
                // });
            }



            // edit
            $('#form_save_presensi').on('submit', function(event) {
                event.preventDefault();
                var form_data = $(this).serialize();
                $.ajax({
                    url: "{{ config('setting.second_url') }}akademik/simpan-presensi",
                    method: "POST",
                    data: form_data,
                    dataType: "json",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    beforeSend: function() {
                        $("#btsavepresensi").prop('disabled', true);
                    },
                    success: function(data) {
                        if (data.error) {
                            showToastr('error', 'Error!', data.error);
                            table.ajax.reload();
                            $("#btsavepresensi").prop('disabled', false);
                        } else if (data.success) {
                            $('#modal_presensi').modal('hide');
                            showToastr('success', 'Success!', data.success);
                            table.ajax.reload();
                            $('#form_save_presensi')[0].reset();
                            $("#btsavepresensi").prop('disabled', false);
                        }
                    }
                })
            });

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
