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
                                <li class="breadcrumb-item active" aria-current="page"></li>
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
                    <h3 class="box-title">Presensi Mata Kuliah {{ $session_nama_tahunakademik }}</h3>
                    {{-- <h6 class="box-subtitle">Melihat Data KHS</h6> --}}
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <input class="form-control" type="hidden" name="nim" id="nim" value="{{ $session_nim }}">
                    <input class="form-control" type="hidden" name="tahun" id="tahun" value="{{ $session_tahun }}">
                    <input class="form-control" type="hidden" name="semester" id="semester"
                        value="{{ $session_semester }}">
                    <div class="table-responsive">
                        <table id="tbjadwalmakul" class="table table-hover table-sm text-nowrap" width="100%">
                            <thead class="bg-dark">
                                <tr>
                                    <th>Aksi</th>
                                    <th>Hari</th>
                                    <th>Jam</th>
                                    <th>Matakuliah</th>
                                    <th>Kode</th>
                                    <th>SKS</th>
                                    <th>SMT</th>
                                    <th>Kelas</th>
                                    <th>Dosen</th>
                                    <th>Ruang</th>
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

            var nim = $('#nim').val();
            var tahun = $('#tahun').val();
            var semester = $('#semester').val();
            var table = $("#tbjadwalmakul").DataTable({
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
                // orderable: false,
                ajax: {
                    type: "GET",
                    url: "{{ config('setting.second_url') }}mahasiswa/tampil-presensi-makul",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    data: {
                        nim: nim,
                        tahun: tahun,
                        semester: semester
                    },
                    dataSrc: function(json) {
                        return json;
                    }
                },
                columns: [{
                        data: null,
                        className: 'text-center',
                        render: function(data, type, row, meta) {
                            if (row.button_in > 0) {
                                if (row.kehadiran != null) {
                                    disable =
                                        '<p class="waves-effect waves-light btn btn-sm btn-rounded btn-primary mb-5"><i class="fa fa-check"></i> Hadir</p>'
                                } else {
                                    if (row.cekuts == "0" && parseInt(row.pertemuan_ke) >= 8) {
                                        disable =
                                            '<p class="mb-5 text-danger">Block UTS <br> <small>Belum Bayar atau Belum ACC Keuangan</small></p>';
                                    } else if (row.cekuas == "0" && parseInt(row.pertemuan_ke) >=
                                        16) {
                                        disable =
                                            '<p class="mb-5 text-danger">Block UAS</p>';
                                    } else {
                                        disable =
                                            '<button type="button" class="waves-effect waves-light btn btn-sm btn-rounded btn-success mb-5" id="clock_in" data-id_kelas="' +
                                            row.id_kelas + '" data-pertemuan="' + row.pertemuan_ke +
                                            '"><i class="fa fa-clock-o"></i> Clock In </button>';
                                    }
                                }

                            } else {
                                disable = '<p class="mb-5"><i class="fa fa-lock"></i> </p>';
                            }
                            return disable;
                        }
                    },
                    {
                        data: null,
                        render: function(data, type, row, meta) {
                            if (row.hari == null) {
                                return '<span>' + row.hari_semula + '</span>';
                            } else {
                                if (row.hari != null && row.hari == row.hari_semula) {
                                    return '<span>' + row.hari_semula + '</span>';
                                } else {
                                    return '<span class="text-danger">' + row.hari + '</span>';
                                }

                            }
                        }

                    },
                    {
                        data: null,
                        render: function(data, type, row, meta) {
                            if (row.jam == '') {
                                return '<span>' + row.jam_semula + '</span>';
                            } else {
                                if (row.jam != '' && row.jam == row.jam_semula) {
                                    return '<span>' + row.jam_semula + '</span>';
                                } else {
                                    return '<span class="text-danger">' + row.jam + '</span>';
                                }

                            }

                        }

                    },
                    {
                        data: 'nama_matakuliah'
                    },
                    {
                        data: 'kode_matakuliah'
                    },
                    {
                        data: 'sks'
                    },
                    {
                        data: 'semester'
                    },
                    {
                        data: 'nama_kelas'
                    },
                    {
                        data: 'dosen'
                    },
                    {
                        data: 'kode_ruang'
                    },
                ],
                order: []
            });


            table.on('click', '#clock_in', function(event) {
                event.preventDefault();
                var data = table.row($(this).parents('tr')).data();
                var status = 'Hadir';
                var pertemuan = $(this).data('pertemuan');
                var id_kls = $(this).data('id_kelas');

                $.ajax({
                    url: "{{ config('setting.second_url') }}mahasiswa/simpan-presensi",
                    method: "POST",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    data: {
                        pertemuan: pertemuan,
                        nim: nim,
                        status: status,
                        id_kelas: id_kls
                    },
                    dataType: "json",
                    beforeSend: function() {
                        $("#clock_in").prop('disabled', true);
                    },
                    success: function(data) {
                        if (data.error) {
                            showToastr('error', 'Error!', data.error);
                            table.ajax.reload();
                            $("#clock_in").prop('disabled', false);
                        } else if (data.success) {
                            showToastr('success', 'Success!', data.success);
                            table.ajax.reload();
                            $("#clock_in").prop('disabled', false);
                        }
                    }
                })
            });

        });
    </script>
@stop
