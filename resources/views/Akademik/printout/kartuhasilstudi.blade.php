@extends('layout')

@section('content')
    <div class="container-full">
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">Kartu Hasil Studi</h3>
                </div>

            </div>
        </div>
        <!-- Main content -->
        <section class="content">
            <div class="box">
                <div class="box-header with-border">
                    <h6 class="box-subtitle">Melihat Kartu Hasil Studi</h6>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    {{-- <div class="box">
                        <div class="box-body ribbon-box bg-primary-light">
                            <div class="ribbon ribbon-info">informasi</div>
                            <p class="mb-0"></p>
                        </div> <!-- end box-body-->
                    </div> --}}
                    <div class="box-header no-border">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <input class="form-control" type="hidden" name="nimjamak" id="nimjamak">
                                    <input class="form-control" type="hidden" name="kode_nilai" id="kode_nilai">
                                    <input class="form-control" type="hidden" name="tahun" id="tahun"
                                        value="{{ $session_tahun }}">
                                    <input class="form-control" type="hidden" name="semester" id="semester"
                                        value="{{ $session_semester }}">
                                    <select class="form-control" name="tahun_angkatan" id="tahun_angkatan">
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="kgthasilstudi" class="table table-hover table-striped" width="100%">
                            <thead class="bg-dark">
                                <tr>
                                    <th>No</th>
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Prodi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>

                        <div class="box-header no-border">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="text-left">
                            <button type="button" class="btn btn-warning btn-sm float-left" onclick="cetakjamak();"
                                data-toggle="modal"><i class="fa fa-print"></i>
                                Print</button>
                        </div>
                    </div>
                </div>
                <iframe id="printff" name="printff" style="display: none;"></iframe>
                <!-- /.box-body -->
            </div>

    </div>
    </section>
    <!-- /.content -->
    </div>
@endsection
@section('script-master')
    <script type="text/javascript">
        function cetakjamak() {
            var nim = $('#nimjamak').val();
            var tahun = $('#tahun').val();
            var semester = $('#semester').val();
            var kode_nilai = $('#kode_nilai').val();
            var link = ""
            $("#printff")
                .attr("src", "{{ url('akademik/cetak/jamakcetakkartuhasilstudi') }}/" + nim + "/" + tahun + "/" + semester +"/" + kode_nilai +"")
                .appendTo("body");
        }

        $(document).ready(function() {
            var token = "{{ Session::get('token') }}";
            var userlogin = "{{ Session::get('username') }}";
            tahun_angkatan();

            function tahun_angkatan() {
                $.ajax({
                    type: 'GET',
                    url: "{{ config('setting.second_url') }}akademik/tampiltahunangkatan",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    success: function(result) {
                        var jml = result.length;
                        var s = '';
                        for (i = 0; i < jml; i++) {
                            s = s + '<option value="' + result[i].tahun_angkatan + '" data-id="' + result[i].kode_penilaian + '"> ' 
                                + result[i].tahun_angkatan + '</option>';
                        }
                        s = '<option value=""> Pilih Tahun Angkatan </option>' + s;
                        $('#tahun_angkatan').html(s);
                        var tahun_angkatan = $('#tahun_angkatan').val();
                        // tbnilai(tahun_angkatan);
                    }
                })
            }


            $('#tahun_angkatan').on('change', function(event) {
                var tahun_angkatan = $(this).val(); // Mengambil nilai value dari option yang dipilih
                var kode_nilai = $(this).find('option:selected').data('id'); // Mengambil nilai data-id dari option yang dipilih
                
                // Set nilai data-id ke input #kode_nilai
                $('#kode_nilai').val(kode_nilai);
                
                // Melakukan tindakan lain dengan tahun_angkatan (opsional)
                tbnilai(tahun_angkatan);
            });


            var id_mhs = $('#id_mhs').val();


            function tbnilai(tahun_angkatan) {
                // var nim = $('#nim').val();
                var tahun = $('#tahun').val();
                var semester = $('#semester').val();
                var table = $("#kgthasilstudi").DataTable({
                    destroy: true,
                    dom: 'l<br>Bfrtip',
                    buttons: [
                        'copy', 'csv', 'excel',
                        {
                            text: 'Pilih Semua',
                            className: 'btn btn-success',
                            action: function(e, dt, node, config) {
                                dt.rows().select(); // Memilih semua baris
                            }
                        },
                        {
                            text: 'Tidak Pilih Semua',
                            className: 'btn btn-danger',
                            action: function(e, dt, node, config) {
                                dt.rows().deselect(); // Membatalkan pilihan semua baris
                            }
                        }
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
                        url: "{{ config('setting.second_url') }}akademik/hasilstudi",
                        headers: {
                            "Authorization": 'Bearer ' + token,
                            "username": userlogin
                        },
                        data: {
                            // nim: nim,
                            tahun_angkatan: tahun_angkatan,
                            tahun: tahun,
                            semester: semester,
                        },
                        dataSrc: function(json) {
                            return json;
                        }
                    },
                    columnDefs: [{
                        orderable: false,
                        className: 'select-checkbox',
                        targets: 0
                    }],
                    select: {
                        style: 'multi',
                        selector: 'td:first-child'
                    },
                    columns: [{
                            data: null,
                            render: function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;

                            }
                        },

                        {
                            data: 'nim'
                        },
                        {
                            data: 'nama_mahasiswa'
                        },
                        {
                            data: 'nama_program_pendidikan'
                        },
                        {
                            data: 'nama_program_studi'
                        },
                    ],
                    order: []
                });

                table
                    .on('select', function(e, dt, type, indexes) {
                        var oData = table.rows('.selected').data();
                        var str = "";
                        for (var i = 0; i < oData.length; i++) {
                            if (i <= 0) {
                                str = oData[i]['nim'];
                            } else {
                                str = str + "-" + oData[i]['nim'];
                            }
                        }
                        // console.log(str);
                        $('#nimjamak').val(str);
                    })
                    .on('deselect', function(e, dt, type, indexes) {
                        // var rowData = table.rows(indexes).data().toArray();
                        // console.log(table.rows('.selected').data());
                        var oData = table.rows('.selected').data();
                        var str = "";
                        for (var i = 0; i < oData.length; i++) {
                            if (i <= 0) {
                                str = oData[i]['nim'];
                            } else {
                                str = str + "-" + oData[i]['nim'];
                            }
                        }
                        // console.log(str);
                        $('#nimjamak').val(str);
                    });
            }
        });
    </script>
@stop
