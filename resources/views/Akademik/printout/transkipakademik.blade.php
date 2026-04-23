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
                        <input class="form-control" type="hidden" name="nimjamak" id="nimjamak">
                        <input class="form-control" type="hidden" name="tahun" id="tahun"
                            value="{{ $session_tahun }}">
                        <input class="form-control" type="hidden" name="semester" id="semester"
                            value="{{ $session_semester }}">
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
                                Cetak</button>
                        </div>
                        {{-- <div class="text-center">
                            <button type="button" class="btn btn-warning btn-sm float-center" onclick="cetak1();"
                                data-toggle="modal" data-target="#modal_add1"><i class="fa fa-print"></i>
                                Inggris</button>
                        </div> --}}
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <iframe id="printff" name="printff" style="display: none;"></iframe>
            {{-- <iframe id="printff1" name="printff1" style="display: none;"></iframe> --}}

    </div>

    <div class="modal fade" id="modal_edit">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Kelengkapan Transkip</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                </div>
                <form id="form_edit" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>No. Transkrip</label>
                            <input class="form-control" type="text" name="no_transkip" id="no_transkip"
                                placeholder="No. Transkrip">
                            <input class="form-control" type="hidden" name="enim" id="enim"
                                placeholder="ID Fakultas">
                        </div>
                        <div class="form-group">
                            <label>No. SK BAN PT</label>
                            <input class="form-control" type="text" name="no_sk_banpt" id="no_sk_banpt"
                                placeholder="No. SK BAN PT">
                        </div>
                        <div class="form-group">
                            <label>No. Ijazah</label>
                            <input class="form-control" type="text" name="no_ijazah" id="no_ijazah"
                                placeholder="No. Ijazah">
                        </div>
                        <div class="form-group">
                            <label>Status Akreditasi</label>
                            <select class="form-control" name="status_akreditasi" id="status_akreditasi">
                                <option value="">Pilih</option>
                                <option value="Terakreditasi">Terakreditasi</option>
                                <option value="Terakreditasi / A">Terakreditasi / A</option>
                                <option value="Terakreditasi / B">Terakreditasi / B</option>
                                <option value='Unggul'>Unggul</option>
                                <option value='Baik Sekali'>Baik Sekali</option>
                                <option value='Baik'>Baik</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Diberikan</label>
                            <input class="form-control" type="date" name="tgl_yudisium" id="tgl_yudisium"
                                placeholder="Tanggal Diberikan">
                        </div>
                        <div class="form-group">
                            <label>Tanggal Lulus</label>
                            <input class="form-control" type="date" name="tgl_lulus" id="tgl_lulus"
                                placeholder="Tanggal Lulus">
                        </div>
                        <div class="form-group">
                            <label>Judul Skripsi Indo</label><br>
                            <textarea name="judul_skripsi_indo" id="judul_skripsi_indo" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Judul Skripsi Inggris</label><br>
                            <textarea name="judul_skripsi_inggris" id="judul_skripsi_inggris" class="form-control" rows="3"></textarea>
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
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    </section>
    <!-- /.content -->
    </div>
@endsection
@section('script-master')
    <script type="text/javascript">
        var token = "{{ Session::get('token') }}";
        var userlogin = "{{ Session::get('username') }}";

        function cetak(nim, tahunangkatan) {
            var nim = $('#nimjamak').val();
            var link = "{{ url('akademik/cetak/cetaktranskipakademik') }}/" + nim;
            // $("#printff")

            //     .attr("src", "{{ url('akademik/cetak/cetaktranskipakademik') }}/" + nim + "")
            //     .appendTo("body");
            window.open(link, '_blank').focus();
        }

        function no_transkip() {
            $.ajax({
                type: 'GET',
                url: "{{ config('setting.second_url') }}akademik/tampilno_transkip",
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                success: function(result) {
                    s = result.no_transkrip;
                    t = result.no_sk;

                    $('#status_akreditasi').val(result.status_akreditasi);
                    $('#tgl_yudisium').val(result.tanggal_yudicium);
                    $('#tgl_lulus').val(result.tanggal_lulus);
                    // console.log(result);
                    $('#no_transkip').val(s);
                    $('#no_sk_banpt').val(t);
                }
            })
        }

        function cetak1() {
            var nim = $('#nimjamak').val();
            var link = "{{ url('akademik/cetak/cetaktranskipakademikinggris') }}/" + nim;
            // $("#printff")

            //     .attr("src", "{{ url('akademik/cetak/cetaktranskipakademikinggris') }}/" + nim + "")
            //     .appendTo("body");
            window.open(link, '_blank').focus();
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

            // function dropdown_angkatan() {
            //     $.ajax({
            //         type: "POST",
            //         url: "{{ config('setting.second_url') }}akademik/dropdown-angkatan",
            //         dataType: "json",
            //         headers: {
            //             "Authorization": 'Bearer ' + token,
            //             "username": userlogin
            //         },
            //         success: function(data) {
            //             // $('.test').fadeOut();
            //             let target = $(".dropdown-prodi")
            //             $.each(data, function(index, value) {
            //                 var el = data[index];
            //                 var flag = 0;
            //                 target.append(
            //                     '<a href="#" class="dropdown-item" id="btmodal_add" data-id=' +
            //                     el.id_mhs + ' data-prodi=' + el
            //                     .tahun_angkatan +
            //                     ' data-toggle="modal" data-target="#modal_add">' + el
            //                     .tahun_angkatan + '</a>')
            //             });
            //         },
            //         error: function(error) {
            //             alert(error);
            //         }
            //     });
            // }
            // dropdown_angkatan();

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
            var table = null;

            function tbnilai(thn) {
                table = $("#kgttranskipakademik").DataTable({
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
                        url: "{{ config('setting.second_url') }}akademik/transkipakademik",
                        headers: {
                            "Authorization": 'Bearer ' + token,
                            "username": userlogin
                        },
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
                                if (full.id == null) {
                                    return '<a href="javascript:void(0)" class="waves-effect waves-light btn btn-xs btn-outline btn-primary" id="bt_edit" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-plus"></i> Tambah</a>';
                                } else {
                                    return '<a href="javascript:void(0)" class="waves-effect waves-light btn btn-xs btn-outline btn-success" id="bt_edit" data-toggle="tooltip" data-original-title="Edit"><i class="ti-marker-alt"></i> Edit</a>';
                                }
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
                                str = oData[i]['nm'];
                            } else {
                                str = str + "-" + oData[i]['nm'];
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
                                str = oData[i]['nm'];
                            } else {
                                str = str + "-" + oData[i]['nm'];
                            }
                        }
                        // console.log(str);
                        $('#nimjamak').val(str);
                    });

                // show data edit
                table.on('click', '#bt_edit', function() {
                    $tr = $(this).closest('tr');
                    var data = table.row($tr).data();
                    $('#enim').val(data['nm']);
                    var nimnya = data['nm'];

                    $.ajax({
                        type: "GET",
                        url: "{{ config('setting.second_url') }}akademik/cek-nimakademik",
                        headers: {
                            "Authorization": 'Bearer ' + token,
                            "username": userlogin
                        },
                        data: {
                            nim: nimnya,
                        },
                        dataType: "json",
                        success: function(data) {
                            console.log(data.length);
                            if (data.length > 0) {
                                $('#no_transkip').val(data[0].no_transkrip);
                                $('#no_sk_banpt').val(data[0].no_sk);
                                $('#no_ijazah').val(data[0].no_ijazah);
                                $('#status_akreditasi').val(data[0].status_akreditasi);
                                $('#tgl_yudisium').val(data[0].tanggal_yudicium);
                                $('#tgl_lulus').val(data[0].tanggal_lulus);
                                $('#judul_skripsi_indo').val(data[0].judul_skripsi_indo);
                                $('#judul_skripsi_inggris').val(data[0].judul_skripsi_inggris);
                            } else {
                                no_transkip();
                                $('#no_ijazah').val('');
                                $('#status_akreditasi').val('');
                                $('#tgl_yudisium').val('');
                                $('#tgl_lulus').val('');
                                $('#judul_skripsi_indo').val('');
                                $('#judul_skripsi_inggris').val('');
                            }
                        },
                        error: function(error) {
                            alert(error);
                        }
                    });
                    $('#modal_edit').modal('show');
                });

                // edit
                $('#form_edit').on('submit', function(event) {
                    event.preventDefault();
                    var form_data = $(this).serialize();
                    $.ajax({
                        url: "{{ config('setting.second_url') }}akademik/edit-transkipakademik",
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
                                $('#modal_edit').modal('hide');
                                showToastr('success', 'Success!', data.success);
                                table.ajax.reload();
                                $('#form_edit')[0].reset();
                                $("#btsubmit").prop('disabled', false);
                            }
                        }
                    })
                });

            }
        });
    </script>
@stop
