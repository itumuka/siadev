@extends('layout')

@section('content')
    <div class="container-full">
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">Daftar Hadir Ujian</h3>
                </div>

            </div>
        </div>
        <!-- Main content -->
        <section class="content">
            <div class="box">
                <div class="box-header with-border">
                    <h6 class="box-subtitle">Melihat Daftar Hadir Ujian</h6>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <input class="form-control" type="hidden" name="tahun" id="tahun" value="{{ $session_tahun }}">
                    <input class="form-control" type="hidden" name="id_tawarjamak" id="id_tawarjamak">
                    <input class="form-control" type="hidden" name="semester" id="semester"
                        value="{{ $session_semester }}">
                    <div class="box">
                        <div class="box-body ribbon-box bg-primary-light">
                            <div class="ribbon ribbon-info">informasi</div>
                            <p class="mb-0">Daftar presensi hadir ujian yang ditampilkan di
                                {{ $session_nama_tahunakademik }}</p>
                        </div> <!-- end box-body-->
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <select class="form-control" name="programstudi" id="programstudi">
                            </select>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="kgtdaftarhadirujian" class="table table-hover table-striped">
                            <thead class="bg-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Matakuliah</th>
                                    <th>Prodi</th>
                                    <th>Kelas</th>
                                    <th>Dosen</th>
                                    <th>Peserta</th>
                                    {{-- <th>Jumlah Nilai</th> --}}
                                    {{-- <th>Proses</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
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
        function cetak(id_tawar) {
            var link = ""
            $("#printff")

                .attr("src", "{{ url('akademik/cetak/cetakdaftarhadirujian') }}/" +
                    id_tawar + "")
                .appendTo("body");
        }

        // function cetakjamak() {
        //     var id_tawar = $('#id_tawarjamak').val();
        //     var link = "{{ url('akademik/cetak/jamakcetakdaftarhadirujian') }}/" + id_tawar;
        //     window.open(link, '_blank').focus();
        // }
        function cetakjamak() {
            var id_tawar = $('#id_tawarjamak').val();
        
            // Ambil value dari radio button yang dipilih
            var jenisUjian = $('input[name="jenisujian"]:checked').val();
        
            // Cek jika tidak ada yang dipilih
            if (!jenisUjian) {
                alert("Silakan pilih jenis ujian (UTS atau UAS)");
                return;
            }
        
            var link = "{{ url('akademik/cetak/jamakcetakdaftarhadirujian') }}/" + id_tawar + "/" + jenisUjian;
        
            window.open(link, '_blank').focus();
        }

        
        
        $(document).ready(function() {
            var token = "{{ Session::get('token') }}";
            var userlogin = "{{ Session::get('username') }}";
            programstudi();
            // semester();

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
                        var s = '';
                        for (i = 0; i < jml; i++) {
                            if (result[i].nama_program_studi != "Universitas") {
                                s = s + '<option value="' + result[i].nama_program_studi +
                                    '"> ' + result[i]
                                    .nama_program_studi + '</option>';
                            }
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
            dropdown_prodi();
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

            // var nim = $('#nim').val();
            // var ta = $('#ta').val();
            // var smt = $('#smt').val();
            // var token = $('#token').val();
            function tbnilai(nama_program_studi) {
                var tahun = $('#tahun').val();
                var semester = $('#semester').val();
                var table = $("#kgtdaftarhadirujian").DataTable({
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
                        url: "{{ config('setting.second_url') }}akademik/daftarhadirujian",
                        headers: {
                            "Authorization": 'Bearer ' + token,
                            "username": userlogin
                        },
                        data: {
                            tahun: tahun,
                            nama_program_studi: nama_program_studi,
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
                            render: function(data, type, full, meta) {
                                return '';

                            }
                        },

                        {
                            data: 'kode_matakuliah'
                        },
                        {
                            data: 'nama_matakuliah'
                        },
                        {
                            data: 'nama_program_studi'
                        },
                        {
                            data: 'nama_kelas'
                        },
                        {
                            data: null,
                            render: function(data, type, full, meta) {
                                if (full.nama_dosen2 == '') {
                                    return full.nama_dosen;
                                } else if (full.nama_dosen == '') {
                                    return '----';
                                } else {
                                    return full.nama_dosen + '/' + full.nama_dosen2;
                                }
                            }
                        },
                        {
                            data: 'jumlah_peserta'
                        },
                        // {
                        //     data: 'jumlah_nilai'
                        // },
                        // {
                        //     data: null,
                        //     render: function(data, type, full, meta) {
                        //         return '<a href="javascript:void(0)" class="text-info mr-10" id="cetak" data-toggle="tooltip" data-original-title="Edit" title="Cetak KRS" onclick="cetak(' +
                        //             full.id_tawar +
                        //             ');"><i class="fa fa-print"></i></a>';

                        //     }
                        // },

                    ],
                    // rowCallback: function(row, data, index) {
                    //     if (data.jumlah_nilai == "0" && data.jumlah_nilaiuts == "0") {
                    //         $('td', row).css('color', 'red');
                    //     } else if (data.jumlah_nilaiuts != "0" && data.jumlah_nilai == "0") {
                    //         $('td', row).css('color', '#327941');
                    //     } else {
                    //         $('td', row).css('color', '#0087E2');
                    //     }

                    // },
                    order: []
                });

                table
                    .on('select', function(e, dt, type, indexes) {
                        var oData = table.rows('.selected').data();
                        var str = "";
                        for (var i = 0; i < oData.length; i++) {
                            if (i <= 0) {
                                str = oData[i]['id_tawar'];
                            } else {
                                str = str + "-" + oData[i]['id_tawar'];
                            }
                        }
                        // console.log(str);
                        $('#id_tawarjamak').val(str);
                    })
                    .on('deselect', function(e, dt, type, indexes) {
                        // var rowData = table.rows(indexes).data().toArray();
                        // console.log(table.rows('.selected').data());
                        var oData = table.rows('.selected').data();
                        var str = "";
                        for (var i = 0; i < oData.length; i++) {
                            if (i <= 0) {
                                str = oData[i]['id_tawar'];
                            } else {
                                str = str + "-" + oData[i]['id_tawar'];
                            }
                        }
                        // console.log(str);
                        $('#id_tawarjamak').val(str);
                    });
            }

        });
    </script>
@stop
