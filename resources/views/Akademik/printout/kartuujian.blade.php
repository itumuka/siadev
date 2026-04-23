@extends('layout')

@section('content')
    <div class="container-full">
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">Kartu Ujian</h3>
                </div>

            </div>
        </div>
        <!-- Main content -->
        <section class="content">
            <div class="box">
                <div class="box-header with-border">
                    <h6 class="box-subtitle">Melihat Kartu Ujian</h6>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <div class="box">
                        <div class="box-body ribbon-box bg-primary-light">
                            <div class="ribbon ribbon-info">informasi</div>
                            <p class="mb-0"></p>
                        </div> <!-- end box-body-->
                    </div>
                    <div class="box-header no-border">
                        <div class="row">
                            <div class="col-sm-2">Angkatan : </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <input class="form-control" type="hidden" name="nimjamak" id="nimjamak">
                                    <input class="form-control" type="hidden" name="tahun" id="tahun"
                                        value="{{ $session_tahun }}">
                                    <input class="form-control" type="hidden" name="semester" id="semester"
                                        value="{{ $session_semester }}">
                                    <select class="form-control" name="tahun_angkatan" id="tahun_angkatan">
                                    </select>
                                </div>
                            </div>
                            <!-- Tambahkan Filter UAS -->
                            <div class="col-sm-2">Filter UAS : </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <select class="form-control" id="filter_uas">
                                        <option value="">Semua Status UAS</option>
                                        <option value="Bisa">Bisa</option>
                                        <option value="Belum Bisa">Belum Bisa</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="kgtkartuujian" class="table table-hover table-striped">
                            <thead class="bg-dark">
                                <tr>
                                    <th>No</th>
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Prodi</th>
                                    <th>UTS</th>
                                    <th>UAS</th>
                                    <th>Pilih</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>

                        <div class="box-header no-border">
                        </div>
                    </div>
                    <div class="col-sm-6">
					<div class="demo-radio-button">
						<input name="jenisujian" type="radio" id="radio_30" value="1" class="with-gap radio-col-primary" />
						<label for="radio_30">UTS</label>					
						<input name="jenisujian" type="radio" id="radio_32" value="2" class="with-gap radio-col-primary" />
						<label for="radio_32">UAS</label>
					</div>
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
        function cetak(nim, tahun, semester) {
            var link = ""
            $("#printff")

                .attr("src", "{{ url('akademik/cetak/cetakkartuujian') }}/" + nim + "/" + tahun + "/" + semester + "")
                .appendTo("body");

        }

        function cetakjamak() {
            var nim = $('#nimjamak').val();
            var tahun = $('#tahun').val();
            var semester = $('#semester').val();
            // Ambil value dari radio button yang dipilih
            var jenisUjian = $('input[name="jenisujian"]:checked').val();
        
            // Cek jika tidak ada yang dipilih
            if (!jenisUjian) {
                alert("Silakan pilih jenis ujian (UTS atau UAS)");
                return;
            }
        
            var link = "{{ url('akademik/cetak/jamakcetakkartuujian') }}/" + nim + "/" + tahun + "/" + semester + "/" + jenisUjian;
        
            window.open(link, '_blank').focus();
            
        }

        function cetakjamak() {
            var nim = $('#nimjamak').val();
            var tahun = $('#tahun').val();
            var semester = $('#semester').val();
            var jenisUjian = $('input[name="jenisujian"]:checked').val();
            if (!jenisUjian) {
                alert("Silakan pilih jenis ujian (UTS atau UAS)");
                return;
            }

            var link = ""
            $("#printff").attr("src", "{{ url('akademik/cetak/jamakcetakkartuujian') }}/" + nim + "/" + tahun + "/" + semester + "/" + jenisUjian +"").appendTo("body");
        }


        // function cetakjamak() {
        //     var nim = $('#nimjamak').val();
        //     var tahun = $('#tahun').val();
        //     var semester = $('#semester').val();
        //     var link = ""
        //     $("#printff")

        //         .attr("src", "{{ url('akademik/cetak/jamakcetakkartuujian') }}/" + nim + "/" + tahun + "/" + semester + "")
        //         .appendTo("body");
        // }
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
                            s = s + '<option value="' + result[i].tahun_angkatan + '"> ' + result[i]
                                .tahun_angkatan + '</option>';
                        }
                        s = s + '<option value="">Tahun Angkatan</option>';
                        $('#tahun_angkatan').html(s);
                        var tahun_angkatan = $('#tahun_angkatan').val();
                        tbnilai(tahun_angkatan);
                    }
                })
            }

            $('#tahun_angkatan, #filter_uas').on('change', function(event) {
                var tahun_angkatan = $('#tahun_angkatan').val();
                tbnilai(tahun_angkatan);
            });

            function tbnilai(tahun_angkatan) {
                var tahun = $('#tahun').val();
                var semester = $('#semester').val();
                var filter_uas = $('#filter_uas').val();
                var table = $("#kgtkartuujian").DataTable({
                    destroy: true,
                    dom: 'l<br>Bfrtip',
                    buttons: ['copy', 'csv', 'excel',
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
                    processing: true,
                    lengthChange: true,
                    ajax: {
                        type: "GET",
                        url: "{{ config('setting.second_url') }}akademik/kartuujian",
                        headers: {
                            "Authorization": 'Bearer ' + token,
                            "username": userlogin
                        },
                        data: {
                            tahun_angkatan: tahun_angkatan,
                            tahun: tahun,
                            semester: semester,
                            filter_uas: filter_uas
                        },
                        dataSrc: function(json) {
                            return json;
                        }
                    },
                    columnDefs: [{
                        orderable: false,
                        className: 'select-checkbox',
                        targets: 7
                    }],
                    select: {
                        style: 'multi',
                        selector: 'td:last-child'
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
                        {
                            data: null,
                            render: function(data, type, full, meta) {
                                if (parseInt(full.nunggakuts) == 0 && parseInt(full.patokanuts) >
                                    0) {
                                    return '<span class="btn btn-success btn-xs">Bisa</span>';
                                } else {
                                    return '<span class="btn btn-danger btn-xs">Belum Bisa</span>';
                                }
                            }
                        },
                        {
                            data: null,
                            render: function(data, type, full, meta) {
                                if (parseInt(full.nunggakuas) == 0 && parseInt(full.patokanuas) >
                                    0 && parseInt(full.cekuase) > 0) {
                                    return '<span class="btn btn-success btn-xs">Bisa</span>';
                                } else {
                                    return '<span class="btn btn-danger btn-xs">Belum Bisa</span>';
                                }
                            }
                        },
                        {
                            data: null,
                            render: function(data, type, full, meta) {
                                return '';
                            }
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
