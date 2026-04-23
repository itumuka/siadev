@extends('layout')
@section('css')
    <style>
        table.dataTable th,
        table.dataTable td {
            padding: 3px 6px;
            font-size: 0.8em;
            /* e.g. change 8x to 4px here */
        }

        .sembunyi {
            display: none;
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
                                <li class="breadcrumb-item active" aria-current="page"></li>
                            </ol>
                        </nav>
                    </div>
                </div>

            </div>
        </div>
        <!-- Main content -->
        <section class="content">
            {{-- <div class="box box-solid bg-danger sembunyi" id="lewat">
                <div class="box-header">
                    <h4 class="box-title"><i class="fa fa-exclamation-triangle"></i> Batas perubahan KRS telah berakhir
                    </h4>
                </div>
                <div class="box-body text-danger">
                    Anda sudah tidak dapat melakukan perubahan, karena jadwal Perubahan KRS
                    {{ $session_nama_tahunakademik }} telah berakhir. Terima kasih.
                </div>
            </div> --}}

            <div class="box" id="bisa_rev">
                <div class="box-header with-border">
                    <h3 class="box-title">Revisi Kartu Rencana Studi Semester {{ $session_nama_tahunakademik }}</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">

                    <input class="form-control" type="hidden" name="kode_prodi" id="kode_prodi"
                        value="{{ $session_kode_prodi }}">
                    <input class="form-control" type="hidden" name="nim" id="nim" value="{{ $session_nim }}">
                    <input class="form-control" type="hidden" name="tahun" id="tahun" value="{{ $session_tahun }}">
                    <input class="form-control" type="hidden" name="semester" id="semester"
                        value="{{ $session_semester }}">


                    <div class="row no-print">
                        <div class="col-sm-6">
                            <button type="button" id="printButton" class="btn btn-sm btn-success mb-2"
                                onclick="cetak_revisi_krs(`{{ $session_nim }}`,{{ $session_tahun }},{{ $session_semester }})"><i
                                    class="fa fa-print"></i> Print</button>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="tbrevisikrs" class="table table-hover table-sm" width="100%">
                            <thead class="bg-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                    <th>Kode</th>
                                    <th>Matakuliah</th>
                                    <th>SMT</th>
                                    <th>SKS</th>
                                    <th>Kelas</th>
                                    <th>Hari</th>
                                    <th>Jam</th>
                                    <th>Ruang</th>
                                    <th>Dosen</th>
                                    <th>Terisi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <iframe id="printff" name="printff" style="display: none;"></iframe>
        </section>
        <!-- /.content -->
    </div>
@endsection
@section('script-master')
    <script type="text/javascript">
        function cetak_revisi_krs(nim, tahun, semester) {
            var link = ""
            $("#printff")

                .attr("src", "{{ url('akademik/cetak/cetak-revisi-krs') }}/" + nim + "/" + tahun + "/" + semester)
                .appendTo("body");
        }

        $(document).ready(function() {
            var token = "{{ Session::get('token') }}";
            var userlogin = "{{ Session::get('username') }}";

            var kode_prodi = $('#kode_prodi').val();
            var nim = $('#nim').val();
            var tahun = $('#tahun').val();
            var semester = $('#semester').val();
            $("#printButton").hide();

            var fullDate = new Date()
            var twoDigitMonth = ((fullDate.getMonth().length + 1) === 1) ? (fullDate.getMonth() + 1) : '0' + (
                fullDate.getMonth() + 1);
            var datenow = fullDate.getFullYear() + "-" + twoDigitMonth + "-" + fullDate.getDate();

            // $.ajax({
            //     url: "{{ config('setting.second_url') }}mahasiswa/kalender-revisikrs",
            //     method: "GET",
            //     headers: {
            //         "Authorization": 'Bearer ' + token,
            //         "username": userlogin
            //     },
            //     data: {
            //         tahun: tahun,
            //         semester: semester
            //     },
            //     dataType: 'json',
            //     success: function(result) {
            //         var tglakhir = result.tanggal_akhir + " 23:59:59";

            //         if (Date.parse(tglakhir) < Date.now()) {
            //             $("#lewat").removeClass("sembunyi");
            //         } else {
            //             $("#bisa_rev").removeClass("sembunyi");
            //         }
            //     }
            // });


            var table = $("#tbrevisikrs").DataTable({
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
                    url: "{{ config('setting.second_url') }}mahasiswa/revisi-krs",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    data: {
                        nim: nim,
                        tahun: tahun,
                        kode_prodi: kode_prodi,
                        semester: semester
                    },
                    dataSrc: function(json) {
                        let hasApprovedKRS = json.some(item => item.krs == 1);
                        if (hasApprovedKRS) {
                            $("#printButton").show();
                        } else {
                            $("#printButton").hide();
                        }
                        return json;
                    }
                },
                columns: [
                    {
                        data: null,
                        className: 'text-center',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'krs',
                        className: 'text-center',
                        render: function(data, type, full, meta) {
                            if (data == 1) {
                                return '<p class="badge badge-success">Acc</p>'
                            } else {
                                return '<p class="badge badge-danger">Belum Acc</p>'
                            }
                        }
                    },
                    {
                        data: null,
                        className: 'text-center',
                        render: function(data, type, full, meta) {
                            if (full.krs == 1) {
                                button = '<p class="text-success">-</p>'
                            } else {
                                button =
                                    '<a href="javascript:void(0)" class="waves-effect waves-light btn btn-xs btn-outline btn-danger" id="delrow" data-idkrs="' +
                                    full.id_krs + '" data-idkelas="' + full.id_kelas +
                                    '" data-toggle="tooltip"  data-original-title="Edit" title="Hapus Makul KRS"><i class="ti-trash"></i></a>'
                            }
                            return button;
                        }
                    },
                    {
                        data: 'kode_matakuliah'
                    },
                    {
                        data: 'nama_matakuliah'
                    },
                    {
                        data: 'semester',
                        className: 'text-center'
                    },
                    {
                        data: 'sks',
                        className: 'text-center'
                    },
                    {
                        data: 'nama_kelas',
                        className: 'text-center'
                    },
                    {
                        data: 'hari'
                    },
                    {
                        data: 'jam'
                    },
                    {
                        data: 'kode_ruang',
                        className: 'text-center'
                    },
                    {
                        data: 'dosen'
                    },
                    {
                        data: 'jumlah_peserta',
                        className: 'text-center'
                    },
                ],
                order: []
            });


            table.on('click', '#delrow', function(e) {
                e.preventDefault();
                var idkrs = $(this).data('idkrs');
                var idkelas = $(this).data('idkelas');

                swal({
                    title: "Apa anda yakin?",
                    text: "Data akan dihapus !",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Ya, hapus !",
                    cancelButtonText: "Tidak, batal !",
                    closeOnCancel: false
                }, function(isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            url: "{{ config('setting.second_url') }}mahasiswa/-hapus-revisi-krs",
                            type: 'GET',
                            headers: {
                                "Authorization": 'Bearer ' + token,
                                "username": userlogin
                            },
                            data: {
                                id_krs: idkrs,
                                id_kelas: idkelas
                            },
                            dataType: 'json',
                            success: function(data) {
                                if (data.error) {
                                    showToastr('error', 'Error!', data.error);
                                } else if (data.success) {
                                    showToastr('success', 'Success!', data.success);
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
