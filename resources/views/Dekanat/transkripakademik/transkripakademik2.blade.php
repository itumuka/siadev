@extends('layout')

@section('content')
    <div class="container-full">
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">Transkip Akademik</h3>
                </div>

            </div>
        </div>
        <!-- Main content -->
        <section class="content">
            <div class="box">
                <div class="box-header with-border">
                    <h6 class="box-subtitle">Melihat Transkip Akademik</h6>
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
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <select class="form-control" name="tahunangkatan" id="tahunangkatan">
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="kgttranskipakademik" class="table table-hover table-striped">
                            <thead class="bg-dark">
                                <tr>
                                    <th>Pilih</th>
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Prodi</th>
                                    <th>Proses</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>

                        <div class="box-header no-border">
                        </div>
                    </div>
                    <div class="col-sm-1">
                    </div>
                    <div class="col-sm-3">
                        <div class="text-left">
                            <button type="button" class="btn btn-warning btn-sm float-left" onclick="cetak();"
                                data-toggle="modal" data-target="#modal_add"><i class="fa fa-print"></i>
                                Indonesia</button>
                        </div>
                        <div class="text-center">
                            <button type="button" class="btn btn-warning btn-sm float-center" onclick="cetak1();"
                                data-toggle="modal" data-target="#modal_add"><i class="fa fa-print"></i> Inggris</button>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <iframe id="printff" name="printff" style="display: none;"></iframe>
            <iframe id="printff1" name="printff1" style="display: none;"></iframe>

    </div>
    </section>
    <!-- /.content -->
    </div>
@endsection
@section('script-master')
    <script type="text/javascript">
        function cetak() {

            $("#printff")
                // /.hide()/
                .attr("src", "{{ url('akademik/cetak/cetaktranskipakademik') }}")
                .appendTo("body");
            // var newWin = window.frames["printff"];
            // newWin.document.write('<body onload="window.print()">' + isicetakan + '</body>');
            // newWin.document.close();
            // return false;
        }

        function cetak1() {

            $("#printff1")
                // /.hide()/
                .attr("src", "{{ url('akademik/cetak/cetaktranskipakademikinggris') }}")
                .appendTo("body");
            // var newWin = window.frames["printff"];
            // newWin.document.write('<body onload="window.print()">' + isicetakan + '</body>');
            // newWin.document.close();
            // return false;
        }
        $(document).ready(function() {
            var token = "{{ Session::get('token') }}";
            var userlogin = "{{ Session::get('username') }}";
            tahunangkatan();

            function tahunangkatan() {
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
                                .tahun_angkatan +
                                '</option>';
                        }
                        // console.log(result);
                        $('#tahunangkatan').html(s);
                        var thnn = $('#tahunangkatan').val();
                        tbnilai(thnn);
                    }
                })
            }

            $('#tahunangkatan').on('change', function(event) {
                var thnn = $('#tahunangkatan').val();
                tbnilai(thnn);

            });


            var id_mhs = $('#id_mhs').val();

            function dropdown_angkatan() {
                $.ajax({
                    type: "POST",
                    url: "{{ config('setting.second_url') }}akademik/dropdown-angkatan",
                    dataType: "json",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    success: function(data) {
                        // $('.test').fadeOut();
                        let target = $(".dropdown-menu")
                        $.each(data, function(index, value) {
                            var el = data[index];
                            var flag = 0;
                            target.append(
                                '<a href="#" class="dropdown-item" id="btmodal_add" data-id=' +
                                el.id_mhs + ' data-prodi=' + el
                                .tahun_angkatan +
                                ' data-toggle="modal" data-target="#modal_add">' + el
                                .tahun_angkatan + '</a>')
                        });
                    },
                    error: function(error) {
                        alert(error);
                    }
                });
            }
            dropdown_angkatan();
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
            function tbnilai(thn) {
                var table = $("#kgttranskipakademik").DataTable({
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
                        headers: {
                            "Authorization": 'Bearer ' + token,
                            "username": userlogin
                        },
                        url: "{{ config('setting.second_url') }}akademik/transkipakademik",
                        data: {
                            tahunangkatan: thn,
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
                                return '';

                            }
                        },

                        {
                            data: 'nm'
                        },
                        {
                            data: 'namamhs'
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
                                return '<a href="javascript:void(0)" class="text-info mr-10" id="bt_edit" data-toggle="tooltip" data-original-title="Edit"><i class="ti-marker-alt"></i></a>';
                            }
                        },

                    ],
                    order: []
                });
            }
        });
    </script>
@stop
