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
            <div class="box cekpembayaran">
                <div class="box-header with-border">
                    <h3 class="box-title">Kartu Hasil Studi Mahasiswa</h3>
                    {{-- <h6 class="box-subtitle">Melihat Data KHS</h6> --}}
                </div>
                <div class="box-header no-border">
                    <div class="row no-print">
                        <div class="col-sm-6">
                            <div class="form-group mb-2">
                                <select class="form-control" style="width: 100%;" name="filtertahun"
                                    id="filtertahun"></select>
                            </div>
                            <button type="button" id="filter" class="btn btn-sm btn-primary mb-2">Tampil</button>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <input class="form-control" type="hidden" name="kode_prodi" id="kode_prodi"
                        value="{{ $session_kode_prodi }}">
                    <input class="form-control" type="hidden" name="nim" id="nim" value="{{ $session_nim }}">
                    <input class="form-control" type="hidden" name="tahun" id="tahun" value="{{ $session_tahun }}">
                    <input class="form-control" type="hidden" name="semester" id="semester"
                        value="{{ $session_semester }}">
                    <center>
                        <h3 id="judulsemester"></h3>
                    </center>
                    <div class="table-responsive">
                        <table id="tbkhs" class="table table-hover table-sm text-nowrap" width="100%">
                            <thead class="bg-dark">
                                <tr>
                                    <th style="width: 5%;">No</th>
                                    <th>Kode</th>
                                    <th>Matakuliah</th>
                                    <th>SKS</th>
                                    {{-- <th>Nilai UTS</th> --}}
                                    <th>Nilai Akhir</th>
                                    <th>Total</th>
                                    <th>Kum</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th> <span></span></th>
                                    {{-- <th></th> --}}
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>


                    <div class="col-12 no-print mb-0 row">
                        <div class="col-3">

                        </div>
                        <div class="col-4">
                            <h5 class="float-right">IP Semester Mahasiswa : <b><span class="text-danger"
                                        id="ipk"></span></b></h5>
                        </div>
                        <div class="col-4">
                            <h5>Total SKS : <b><span id="totsksnya"></span> SKS</b></h5>
                        </div>
                    </div>
                    <div class="row no-print">
                        <div class="col-12">
                            <a href="javascript:void(0)" class="btn btn-sm btn-success" id="cetak_khs"
                                onclick="cetak_khs(`{{ $session_nim }}`,{{ $session_tahun }},{{ $session_semester }})"><i
                                    class="fa fa-print"></i> Print
                            </a>
                            {{-- <a href="javascript:void(0)" class="btn btn-sm btn-success" id="cetak_khs" data-nim="{{$session_nim}}" data-smt="{{$session_semester}}" data-th="{{$session_tahun}}"><i class="fa fa-print"></i> Print
                          </a> --}}
                        </div>
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
        function cetak_khs(nim, tahun, semester, id = '') {
            var link = ""
            var id = $('#filtertahun').val();
            var myarr = id.split(",");
            var idher = myarr[0];
            var tahunher = myarr[1];
            var semesterher = myarr[2];
            console.log(id);
            $("#printff")

                .attr("src", "{{ url('akademik/cetak/cetakkhs') }}/" + nim + "/" + tahunher + "/" + semesterher + "/" +
                    idher + "")
                .appendTo("body");
            // console.log(nim);
            // console.log(tahun);
            // console.log(semester);
        }


        $(document).ready(function() {
            var token = "{{ Session::get('token') }}";
            var userlogin = "{{ Session::get('username') }}";

            var kode_prodi = $('#kode_prodi').val();
            var nim = $('#nim').val();
            var tahun = $('#tahun').val();
            var semester = $('#semester').val();
            // var token = $('#token').val();

            table_khs(id = 0);

            function table_khs(id = 0) {
                var table = $("#tbkhs").DataTable({
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
                    info: false,
                    paging: false,
                    // searching: false,
                    // serverSide: true,
                    // stateSave: true,
                    // scrollX: true,
                    // orderable: false,
                    ajax: {
                        type: "GET",
                        url: "{{ config('setting.second_url') }}mahasiswa/data-khs",
                        headers: {
                            "Authorization": 'Bearer ' + token,
                            "username": userlogin
                        },
                        data: {
                            nim: nim,
                            tahun: tahun,
                            kode_prodi: kode_prodi,
                            semester: semester,
                            id_her: id
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
                            data: 'kode_matakuliah'
                        },
                        {
                            data: 'nama_matakuliah'
                        },
                        {
                            data: 'sks',
                            className: "text-center",
                        },
                        // {
                        //     data: 'nilai_uts',
                        //     className: "text-center",
                        // },
                        {
                            data: 'nilai_huruf_akhir',
                            className: "text-center",
                        },
                        {
                            data: 'total_nilai',
                            className: "text-center",
                        },
                        {
                            data: 'kum_sksmutu',
                            visible: false
                        }

                    ],
                    order: [],
                    "footerCallback": function(row, data, start, end, display) {
                        var api = this.api(),
                            data;
                        // Remove the formatting to get integer data for summation
                        var intVal = function(i) {
                            return typeof i === 'string' ?
                                i.replace(/[\$,]/g, '') * 1 :
                                typeof i === 'number' ?
                                i : 0;
                        };
                        // Total SKS
                        jumlahsks = api
                            .column(3)
                            .data()
                            .reduce(function(a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);
                        // console.log(jumlahsks);
                        jmlsksmutu = api
                            .column(6)
                            .data()
                            .reduce(function(a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);

                        // console.log(jmlsksmutu);
                        // console.log(id);
                        // $(api.column(4).footer()).html(jumlahsks + ' sks');
                        var tot = isNaN(jmlsksmutu / jumlahsks) ? 0 : jmlsksmutu / jumlahsks;
                        $('#ipk').html((tot).toFixed(2));
                        $('#totsksnya').html((jumlahsks));
                    }
                });


                table.on('click', '#bt_edit', function() {
                    $tr = $(this).closest('tr');
                    var data = table.row($tr).data();
                    $('#modal_edit').modal('show');
                    $('#id_mreg').val(data['id_mreg']);
                    $('#etahun').val(data['tahun']);
                    $('#esemester').val(data['semester']);
                    $('#etahunakademik').val(data['tahun_akademik']);
                    $("#" + data.trash).prop("checked", true)
                });


            }


            $('#filter').click(function() {
                var th = $('#filtertahun').val();
                var myarr = th.split(",");
                var myvar = myarr[0];
                var tahun = myarr[1];
                var smt = myarr[2];
                var smstr = "";
                var thn = parseInt(tahun) + 1;
                var tahunak = tahun + "/" + thn;
                if (smt == "1") {
                    smstr = "Ganjil";
                } else {
                    smstr = "Genap";
                }
                $('#judulsemester').html("Semester " + smstr + " " + tahunak);
                console.log(myvar);
                table_khs(myvar);
            });
            // $('#filtertahun').on('change', function(event) {
            //         var th = $('#filtertahun').val();
            //         console.log(th);
            //         table_khs(th);
            // });

            // $('#filter').click(function(){
            //     // var selectopt = $('#tahunakademik').val();
            //     var selectopt = $('#tahunakademik option:selected');
            //     console.log(selectopt);
            //     alert(selectopt);
            //     if(selectopt != 0)
            //     {
            //         $('#tbkhs').DataTable().destroy();
            //         table_khs(selectopt);
            //     }
            //     else
            //     {
            //         showToastr('error', 'Error!', 'Pilih Tahun Akademik terlebih dahulu');
            //     }
            // });

            //save
            $('#form_add').on('submit', function(event) {
                event.preventDefault();
                var form_data = $(this).serialize();
                $.ajax({
                    url: "{{ config('setting.second_url') }}akademik/simpan-tahunajaran",
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


            $.ajax({
                type: 'GET',
                url: "{{ config('setting.second_url') }}mahasiswa/select-khs",
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                data: {
                    nim: nim
                },
                success: function(result) {
                    var jml = result.length;
                    var s = '<option value="">-Pilih Tahun Akademik-</option>';
                    for (i = 0; i < jml; i++) {
                        s = s + '<option value="' + result[i].id_heregistrasi + ',' + result[i].tahun +
                            ',' + result[i].semester + '"> ' + result[i]
                            .tahun_ajaran + '</option>';
                        // console.log(result[i].id_heregistrasi);
                    }
                    $('#filtertahun').html(s);
                }
            })

            $.ajax({
                type: 'GET',
                url: "{{ config('setting.second_url') }}mahasiswa/dispensasikhs",
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                data: {
                    nim: nim
                },
                success: function(result) {
                    var hh = `
                    <div class="box box-solid bg-primary sembunyi">
                <div class="box-header">
                    <h4 class="box-title"><i class="fa fa-exclamation-triangle"></i> Belum Heregistrasi</h4>
                </div>
                <div class="box-body text-danger">
                    Anda tidak bisa melihat KHS. Silahkan lakukan pelunasan Tagihan Pembayaran yang ada pada menu Status Pembayaran. Terima Kasih.
                </div>
            </div>`;
                    if (result == 0) {
                        $('.cekpembayaran').html(hh);
                    }
                }
            })

        });
    </script>
@stop
