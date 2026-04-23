@extends('layout')
@section('css')
    <style>
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
            <div class="cekpembayaran">
                <div class="box">
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
                    <div class="box-body sembunyi" id="default-content">
                        <input class="form-control" type="hidden" name="kode_prodi" id="kode_prodi"
                            value="{{ $session_kode_prodi }}">
                        <input class="form-control" type="hidden" name="nim" id="nim" value="{{ $session_nim }}">
                        <input class="form-control" type="hidden" name="tahun" id="tahun" value="{{ $session_tahun }}">
                        <input class="form-control" type="hidden" name="semester" id="semester"
                            value="{{ $session_semester }}">
                        <input class="form-control" type="hidden" name="kode_nilai" id="kode_nilai"
                            value="{{ $session_kode_nilai }}">
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
                                    onclick="cetak_khs(`{{ $session_nim }}`,{{ $session_tahun }},{{ $session_semester }},{{ $session_kode_nilai }})"><i
                                        class="fa fa-print"></i> Print
                                </a>
                            </div>
                        </div>
    
                    </div>
                    <!-- /.box-body -->
                </div>
                <div class="sembunyi" id="warning-content">
                    <div class="box box-solid bg-warning">
                        <div class="box-header">
                            <h4 class="box-title"><i class="fa fa-exclamation-circle"></i> Data Kuesioner Belum Di Isi</h4>
                        </div>
                        <div class="box-body text-danger">
                            Anda belum mengisi kuesioner di <a href="https://siedom.umuka.ac.id" class="btn btn-xs btn-danger" target="_blank">SIEDOM</a>. Silahkan klik button SIEDOM dan isi kuesioner setiap matakuliah terlebih dahulu.
                        </div>
                    </div>
                </div>
            </div>
            
            <iframe id="printff" name="printff" style="display: none;"></iframe>
        </section>
        <!-- /.content -->
    </div>
@endsection
@section('script-master')
    <script type="text/javascript">
        function cetak_khs(nim, tahun, semester, kode_nilai, id = '') {
            var link = ""
            var id = $('#filtertahun').val();
            var myarr = id.split(",");
            var idher = myarr[0];
            var tahunher = myarr[1];
            var semesterher = myarr[2];
            console.log(id);
            $("#printff")

                .attr("src", "{{ url('akademik/cetak/cetakkhs') }}/" + nim + "/" + tahunher + "/" + semesterher + "/" + kode_nilai + "/" + idher + "")
                .appendTo("body");
            // console.log(nim);
            // console.log(tahun);
            // console.log(semester);
        }


$(document).ready(function() {
    var token = "{{ Session::get('token') }}";
    var userlogin = "{{ Session::get('username') }}";
    var id_mhs = "{{ Session::get('id_mhs') }}";
    var id_mreg = "{{ Session::get('id_mreg') }}";
    var kode_nilai = "{{ Session::get('kode_penilaian') }}";
    console.log(kode_nilai);
    

    var kode_prodi = $('#kode_prodi').val();
    var nim = $('#nim').val();
    var tahun = $('#tahun').val();
    var semester = $('#semester').val();
    var globalStatus = '';
    table_khs(id = 0);
    function table_khs(id = 0) {
        var table = $("#tbkhs").DataTable({
            destroy: true,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel'
            ],
            pageLength: 10,
            processing: true,
            lengthChange: true,
            info: false,
            paging: false,
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
                    id_her: id,
                    id_mreg: id_mreg,
                    id_mhs:id_mhs,
                    kode_nilai:kode_nilai
                },
                dataSrc: function(json) {
                    console.log("Full JSON Response: ", json);  // Log the full response
                    // if (json.status) {
                    //     globalStatus = json.status;
                    //     console.log("Dalam src: ", globalStatus);  // This will show the correct value
                    // } else {
                    //     console.error("Error: 'status' field is missing in the response.");
                    // }
                    // return json.data;
                    return json;
                },
                error: function(xhr, error, code) {
                    console.error("AJAX Error: ", error);
                    console.error("AJAX Error Details: ", xhr.responseText);
                }
            },
            columns: [
                {
                    data: null,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                { data: 'kode_matakuliah' },
                { data: 'nama_matakuliah' },
                { data: 'sks', className: "text-center" },
                { data: 'nilai_huruf_akhir', className: "text-center" },
                { data: 'total_nilai', className: "text-center" },
                { data: 'kum_sksmutu', visible: false }
            ],
            order: [],
            footerCallback: function(row, data, start, end, display) {
                var api = this.api();

                // Remove the formatting to get integer data for summation
                var intVal = function(i) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '') * 1 :
                        typeof i === 'number' ? i : 0;
                };

                // Total SKS
                var jumlahsks = api
                    .column(3)
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                var jmlsksmutu = api
                    .column(6)
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                var tot = isNaN(jmlsksmutu / jumlahsks) ? 0 : jmlsksmutu / jumlahsks;
                $('#ipk').html((tot).toFixed(2));
                $('#totsksnya').html(jumlahsks);
            }
        });

        table.on('click', '#bt_edit', function() {
            var $tr = $(this).closest('tr');
            var data = table.row($tr).data();
            $('#modal_edit').modal('show');
            $('#id_mreg').val(data['id_mreg']);
            $('#etahun').val(data['tahun']);
            $('#esemester').val(data['semester']);
            $('#etahunakademik').val(data['tahun_akademik']);
            $("#" + data.trash).prop("checked", true);
        });
       
    }

    $('#filter').click(function() {
        var th = $('#filtertahun').val(); //ambil id_her, th, semester
        var myarr = th.split(",");//split ,
        var f_id_hereg = myarr[0];//ambil index 1 atau id_her
        var f_tahun = myarr[1];
        var f_smt = myarr[2];
        var smstr = "";
        var thn = parseInt(f_tahun) + 1;
        var tahunak = f_tahun + "/" + thn;
        if (f_smt == "1") {
            smstr = "Ganjil";
        } else {
            smstr = "Genap";
        }
        $('#judulsemester').html("Semester " + smstr + " " + tahunak);
        // console.log(f_id_hereg);

        $.ajax({
            url: '{{ config('setting.second_url') }}mahasiswa/check-edom',
            type: 'GET',
            headers: {
                "Authorization": 'Bearer ' + token,
                "username": userlogin
            },
            data: {
                nim: nim,
                tahun: f_tahun,
                semester: f_smt,
                // id_mreg: id_mreg,
                id_mhs:id_mhs
            },
            success: function(response) {
                var status = response.status;
                    console.log(status);
                if (status == 'notCompletedFilled') {
                    $("#default-content").addClass("sembunyi");
                    $("#warning-content").removeClass("sembunyi");
                    table_khs(f_id_hereg);
                } else if (status == 'completedFilled') {
                    $("#default-content").removeClass("sembunyi");
                    $("#warning-content").addClass("sembunyi");
                    table_khs(f_id_hereg);
                }
                // table_khs(id = 0);
            },
            error: function(xhr, status, error) {
                console.log('Error: ' + error);
            }
        });


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
                s += '<option value="' + result[i].id_heregistrasi + ',' + result[i].tahun + ',' + result[i].semester + '"> ' + result[i].tahun_ajaran + '</option>';
            }
            $('#filtertahun').html(s);
        },
        error: function(xhr, error, code) {
            console.error("AJAX Error: ", error);
            console.error("AJAX Error Details: ", xhr.responseText);
        }
    });

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
            if (result == 0) {
                var hh = `
                <div class="box box-solid bg-primary sembunyi">
                    <div class="box-header">
                        <h4 class="box-title"><i class="fa fa-exclamation-triangle"></i> Belum Heregistrasi</h4>
                    </div>
                    <div class="box-body text-danger">
                        Anda tidak bisa melihat KHS. Silahkan lakukan pelunasan Tagihan Pembayaran yang ada pada menu Status Pembayaran. Terima Kasih.
                    </div>
                </div>`;
                $('.cekpembayaran').html(hh);
            }
        },
        error: function(xhr, error, code) {
            console.error("AJAX Error: ", error);
            console.error("AJAX Error Details: ", xhr.responseText);
        }
    });

});



    </script>
@stop
