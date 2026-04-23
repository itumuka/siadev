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
                            <p class="mb-0">Daftar Mata kuliah yang diampu di
                                {{ $session_nama_tahunakademik }}</p>
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
                                    <th>Status</th>
                                    <th>Matakuliah</th>
                                    <th>Hari</th>
                                    <th>Kelas</th>
                                    <th>Ruang</th>
                                    <th>Waktu</th>
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

                <iframe id="printff" name="printff" style="display: none;"></iframe>

            </div>

            <div class="modal fade" id="modal_add">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Berita Acara Perkuliahan</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                        <form id="form_add" method="POST">
                            <div class="modal-body">
                                <input class="form-control" type="hidden" name="id_kelas" id="id_kelas">
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3">Date</label>
                                    <div class="col-md-9">
                                        <input class="form-control" type="date" name="tgl">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3">Materi Perkuliahan</label>
                                    <div class="col-md-9">
                                        <textarea rows="4" class="form-control" name="materi_makul" placeholder="Materi Perkuliahan"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3">Pertemuan Ke</label>
                                    <div class="col-md-5">
                                        <input class="form-control" type="number" name="pertemuan" id="pertemuan">
                                    </div>
                                </div>
                                {{-- <div class="form-group row">
                                    <label class="col-form-label col-md-3">Peserta Hadir</label>
                                    <div class="col-md-5">
                                        <input class="form-control" type="number" name="peserta_hadir">
                                    </div>
                                </div> --}}
                                <div class="form-group row">
                                    <label for="example-time-input" class="col-sm-3 col-form-label">Jam Mulai</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="time" name="jam_mulai" id="jam_mulai">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-time-input" class="col-sm-3 col-form-label">Jam Selesai</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="time" name="jam_selesai" id="jam_selesai">
                                    </div>
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


            <div class="modal fade" id="modal_list">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">List Berita Acara Perkuliahan</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table id="tbba" class="table table-hover table-sm" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Pertemuan</th>
                                            <th>Materi</th>
                                            <th>Peserta</th>
                                            <th>Jam Mulai</th>
                                            <th>Jam Selesai</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
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

            <div class="modal fade" id="modal_edit_ba" data-backdrop="static">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Berita Acara Perkuliahan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                        <form id="form_edit_ba" method="POST">
                            <div class="modal-body">
                                <input class="form-control" type="hidden" name="eid" id="eid">
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3">Date</label>
                                    <div class="col-md-9">
                                        <input class="form-control" type="date" name="etgl" id="etgl">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3">Materi Perkuliahan</label>
                                    <div class="col-md-9">
                                        <textarea rows="4" class="form-control" name="emateri_makul" id="emateri_makul"
                                            placeholder="Materi Perkuliahan"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3">Pertemuan Ke</label>
                                    <div class="col-md-5">
                                        <input class="form-control" type="number" name="epertemuan" id="epertemuan">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3">Peserta Hadir</label>
                                    <div class="col-md-5">
                                        <input class="form-control" type="number" name="epeserta_hadir"
                                            id="epeserta_hadir">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-time-input" class="col-sm-3 col-form-label">Jam Mulai</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="time" name="ejam_mulai" id="ejam_mulai">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-time-input" class="col-sm-3 col-form-label">Jam Selesai</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="time" name="ejam_selesai"
                                            id="ejam_selesai">
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer float-right">
                                <button type="button" class="btn btn-rounded btn-warning btn-outline mr-1"
                                    data-dismiss="modal">
                                    <i class="fa fa-times"></i> Close
                                </button>
                                <button type="submit" class="btn btn-rounded btn-primary btn-outline" id="btubah_ba">
                                    <i class="ti-save-alt"></i> Save
                                </button>
                            </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

            <div class="modal fade" id="modal_presensi">
                <form id="form_save_presensi" method="POST">
                    <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">

                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">List Mahasiswa Mata Kuliah <Span id="nama_mk"></Span></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                            </div>

                            <div class="modal-body">
                                <input type="hidden" class="form-control" name="id_kls_presensi" id="id_kls_presensi">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Pilih BA Perkuliahan</label>
                                        <select class="form-control" name="berita_acara" id="selectba">
                                        </select>
                                        <span class="text-danger font-italic">* Harus dipilih dan/atau Isi BA Terlebih
                                            dahulu jika tidak tampil</span>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table id="tblistmhs" class="table table-hover table-sm" width="100%">
                                        <thead class="bg-secondary">
                                            <tr>
                                                <th>No</th>
                                                <th>NIM</th>
                                                <th>Nama</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
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
                        <!-- /.modal-content -->
                    </div>
                </form>
                <!-- /.modal-dialog -->
            </div>

        </section>
        <!-- /.content -->
    </div>
@endsection
@section('script-master')
    <script type="text/javascript">

        var currentPrintBtn = null;
        var originalBtnHtml = '';
        
        function cetakdhmd(id_kelas, btn) {
            // Simpan referensi tombol yang diklik
            currentPrintBtn = btn;
            originalBtnHtml = $(btn).html();
        
            // Ganti tombol jadi spinner
            $(btn).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>')
                  .prop('disabled', true);
        
            // Set iframe src untuk load file cetak
            $("#printff")
                .attr("src", "{{ url('akademik/cetak/cetakberitaacara') }}/" + id_kelas)
                .appendTo("body");
        }
        
        // Tangkap pesan dari file cetak
        window.addEventListener('message', function(event) {
            if (event.data === 'print_ready' && currentPrintBtn) {
                // Kembalikan tombol ke keadaan semula
                $(currentPrintBtn).html(originalBtnHtml).prop('disabled', false);
        
                // Reset variabel
                currentPrintBtn = null;
                originalBtnHtml = '';
            }
        });


        $(document).ready(function() {
            var token = "{{ Session::get('token') }}";
            var userlogin = "{{ Session::get('username') }}";

            var kd_prodi = $('#kode_prodi').val();

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
                pageLength: 10,
                processing: true,
                lengthChange: true,
                orderable: false,
                scrollX: true,
                scrollY: true,
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
                columns: [
                    {
                        data: null,
                        className: 'text-center',
                        render: function(data, type, full, meta) {
                            let btnAdd = '<a href="javascript:void(0)" class="waves-effect waves-light btn btn-xs btn-outline btn-primary" id="bt_modal_add" data-id="' +
                                full.id_kelas +
                                '" data-original-title="Tambah BA" data-toggle="tooltip" title="Tambah BA"><i class="fa fa-plus"></i></a>';
                    
                            let btnList = '<a href="javascript:void(0)" class="waves-effect waves-light btn btn-xs btn-outline btn-warning" id="bt_modal_list" data-id="' +
                                full.id_kelas +
                                '" data-original-title="List BA" data-toggle="tooltip" title="List BA"><i class="fa fa-list"></i></a>';
                    
                            let btnPrint = '';
                            if (full.validated_ba == 1) {
                                // btnPrint = '<a href="javascript:void(0)" class="waves-effect waves-light btn btn-xs btn-outline btn-info" id="bt_print" data-id="' +
                                //     full.id_kelas +
                                //     '" data-original-title="Print Presensi" data-toggle="tooltip" title="Print BA" onclick="cetakdhmd(' +
                                //     full.id_kelas + ');"><i class="fa fa-print"></i></a>';
                                btnPrint = '<a href="javascript:void(0)" class="waves-effect waves-light btn btn-xs btn-outline btn-info" id="bt_print" data-id="' +
                                    full.id_kelas +
                                    '" data-original-title="Print Presensi" data-toggle="tooltip" title="Print BA" onclick="cetakdhmd(' +
                                    full.id_kelas + ', this);"><i class="fa fa-print"></i></a>';
                            }
                    
                            return btnAdd + ' ' + btnList + ' ' + btnPrint;
                        }
                    },
                    {
                        data: null,
                        className: 'text-center',
                        render: function(data, type, row, meta) {
                            // return meta.row + meta.settings._iDisplayStart + 1;
                            let bt_validate='';
                            if(row.validated_ba != 0){
                                bt_validate = '<strong class="text-success" title="Tervalidasi"><i class="fa fa-check"></i></strong>'
                            }else{
                                bt_validate = '<strong class="text-default" title="Moderasi"><i class="fa fa-minus"></i></strong>'
                            }
                            return bt_validate;
                        }
                    },
                    {
                        data: null,
                        render: function(data, type, row, meta) {
                            return `
                                <strong>${row.nama_matakuliah}</strong><br>
                                Semester: ${row.smt_matakuliah} | SKS: ${row.sks_matakuliah}<br>
                                Prodi: ${row.nama_program_studi}
                            `;
                        }
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


            function autopertemuanba(id) {
                $.ajax({
                    url: "{{ config('setting.second_url') }}akademik/autopertemuan-ba",
                    method: "POST",
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

            table.on('click', '#bt_modal_presensi', function() {
                $tr = $(this).closest('tr');
                var data = table.row($tr).data();
                var id_kelas = $(this).data('id');
                var nama = $(this).data('nama');
                $('#nama_mk').html(nama);
                $('#modal_presensi').modal('show');
                $('#id_kls_presensi').val(id_kelas);
                // autopertemuanpresensi(id_kelas);
                tabellistpresensi(id_kelas);
                select_ba(id_kelas);
            });


            table.on('click', '#bt_modal_add', function() {
                $tr = $(this).closest('tr');
                var data = table.row($tr).data();
                $('#id_kelas').val(data['id_kelas']);
                var id_kelas = $(this).data('id');
                autopertemuanba(id_kelas);
                $('#modal_add').modal('show');

            });

            table.on('click', '#bt_modal_list', function() {
                $tr = $(this).closest('tr');
                var data = table.row($tr).data();
                var id_kelas = data['id_kelas'];
                tabelba(id_kelas);
                $('#modal_list').modal('show');
            });

            var tdetail;

            function tabelba(id) {
                tdetail = $('#tbba').DataTable({
                    bInfo: false,
                    bPaginate: false,
                    bLengthChange: false,
                    bFilter: false,
                    destroy: true,
                    order: false,
                    ajax: {
                        type: "GET",
                        url: "{{ config('setting.second_url') }}akademik/list-ba",
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
                        {
                            name: "aksi",
                            width: '5%',
                            className: "text-center",
                            orderable: false,
                            render: (data, type, row) => {
                                return '<a href="#" id="bt_edit_ba"><i class="fa fa-edit"></i></a>| <a href="javascript:void(0)" class="text-danger" id="bthps_ba" data-id="' +
                                    row.id +
                                    '" title="Hapus Presensi"><i class="fa fa-trash-o"></i></a>';
                            }
                        }
                    ],
                });

                tdetail.on('click', '#bt_edit_ba', function() {
                    // $('#emateri_makul').text("");
                    $tr = $(this).closest('tr');
                    var data = tdetail.row($tr).data();
                    var id = data['id'];
                    var tgl = data['tgl'];
                    var materi_makul = data['materi_makul'];
                    var pertemuan = data['pertemuan_ke'];
                    var peserta_hadir = data['peserta_hadir'];
                    var jam_mulai = data['jam_mulai'];
                    var jam_selesai = data['jam_selesai'];
                    $('#eid').val(id);
                    $('#etgl').val(tgl);
                    $('#emateri_makul').val(materi_makul);
                    $('#epertemuan').val(pertemuan);
                    $('#epeserta_hadir').val(peserta_hadir);
                    $('#ejam_mulai').val(jam_mulai);
                    $('#ejam_selesai').val(jam_selesai);
                    $('#modal_edit_ba').modal('show');
                });


                tdetail.on('click', '#bthps_ba', function(e) {
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
                                url: "{{ config('setting.second_url') }}akademik/hapus-ba",
                                type: 'GET',
                                data: {
                                    id: id
                                },
                                dataType: 'json',
                                headers: {
                                    "Authorization": 'Bearer ' + token,
                                    "username": userlogin
                                },
                                success: function(data) {
                                    if (data.gagal) {
                                        showToastr('error', 'Error!', data.gagal);
                                    } else if (data.berhasil) {
                                        showToastr('success', 'Success!', data
                                            .berhasil);
                                        tdetail.ajax.reload();
                                    }
                                }
                            })
                        } else {
                            swal("Cancelled", "Data kamu aman! :)", "error");
                        }
                    });
                });

            }


        $('#form_edit_ba').on('submit', function(event) {
            event.preventDefault();
        
            // Validasi manual (opsional, bisa tambahkan lebih lanjut)
            if (!$('#etgl').val() || !$('#epertemuan').val()) {
                showToastr('error', 'Validasi Gagal', 'Tanggal dan Pertemuan wajib diisi!');
                return;
            }
        
            var form_data = $(this).serialize();
        
            $.ajax({
                url: "{{ config('setting.second_url') }}akademik/ubah-ba",
                method: "POST",
                data: form_data,
                dataType: "json",
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin,
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // kalau pakai CSRF
                },
                beforeSend: function() {
                    $("#btubah_ba").prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Mengubah...');
                },
                success: function(data) {
                    $("#btubah_ba").prop('disabled', false).html('Ubah');
        
                    if (data.error) {
                        showToastr('error', 'Error!', data.error);
                    } else if (data.success) {
                        $('#modal_edit_ba').modal('hide');
                        showToastr('success', 'Berhasil!', data.success);
                    }
        
                    tdetail.ajax.reload();
                },
                error: function(xhr, status, error) {
                    $("#btubah_ba").prop('disabled', false).html('Ubah');
                    console.error('AJAX Error:', xhr.responseText);
                    showToastr('error', 'Gagal!', 'Terjadi kesalahan sistem.');
                }
            });
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
                    ],
                });
            }

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

            function select_ba(id) {
                $.ajax({
                    type: 'GET',
                    url: "{{ config('setting.second_url') }}akademik/list-ba",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    data: {
                        id_kelas: id
                    },
                    success: function(result) {
                        var jml = result.length;
                        var s = '<option value="">Pilih Salah Satu</option>';
                        for (i = 0; i < jml; i++) {
                            s = s + '<option value="' + result[i].id +
                                '"> Pertemuan  ' + result[i]
                                .pertemuan_ke + ' pada ' + result[i]
                                .tgl_indo + '</option>';
                        }
                        // console.log(result);
                        $('#selectba').html(s);
                    }
                })
            }

        });
    </script>
@stop
