@extends('layout')

@section('css')
    <style>
        .tdLessPadding {
            td {
                padding: .2em .2em !important;
            }
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
            <div class="box cekpembayaran">
                <div class="box-header with-border">
                    <h3 class="box-title">Transkrip Nilai {{ $session_nama_tahunakademik }}</h3>
                    {{-- <h6 class="box-subtitle">Melihat Data KHS</h6> --}}
                </div>
                {{-- <div class="box-header no-border">


                    <form class="form-inline">
                        <div class="form-group mx-sm-2 mb-2">
                          <select class="form-control selecttahunakademik" style="width: 100%;" name="tahunakademik" id="tahunakademik"></select>
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary mb-2">Tampil</button>
                      </form>

                </div> --}}
                <!-- /.box-header -->
                <div class="box-body">
                    <input class="form-control" type="hidden" name="kode_prodi" id="kode_prodi"
                        value="{{ $session_kode_prodi }}">
                    <input class="form-control" type="hidden" name="nim" id="nim" value="{{ $session_nim }}">
                    <input class="form-control" type="hidden" name="tahun" id="tahun" value="{{ $session_tahun }}">
                    <input class="form-control" type="hidden" name="semester" id="semester"
                        value="{{ $session_semester }}">

                    <div class="row">
                        <div class="col-12 table-responsive">
                            <table id="tbkhs" class="table table-hover table-sm text-nowrap" width="100%">
                                <thead class="bg-dark">
                                    <tr>
                                        <th>No</th>
                                        <th>Semester</th>
                                        <th>Kode</th>
                                        <th>Matakuliah</th>
                                        <th>SKS</th>
                                        <th>Nilai</th>
                                        <th>Bobot</th>
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
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                    </div>
                    <div class="row no-print">
                        <div class="col-12 text-right">
                            <div>
                                <p>Total SKS: <b><span class="text-danger" id="total_sks"></b></p>
                                <p>IPK: <b><span class="text-danger" id="ipk"></span></b></p>
                            </div>
                        </div>
                    </div>
                    <div class="row no-print">
                        <div class="col-12 text-right">
                            <button type="button" class="btn btn-sm btn-success" onclick="cetak(`{{ $session_nim }}`);"><i
                                    class="fa fa-print"></i> Print
                            </button>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <iframe id="printff" name="printff" style="display: none;"></iframe>
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection
@section('script-master')
    <script type="text/javascript">
        function cetak(nim) {
            // var nim = $('#nimjamak').val();
            var link = ""
            $("#printff")

                .attr("src", "{{ url('mahasiswa/cetak/cetaktranskipnilai-mhs') }}/`" + nim + "`")
                .appendTo("body");
        }

        $(document).ready(function() {
            var token = "{{ Session::get('token') }}";
            var userlogin = "{{ Session::get('username') }}";

            var kode_prodi = $('#kode_prodi').val();
            var nim = $('#nim').val();
            var tahun = $('#tahun').val();
            var semester = $('#semester').val();
            // var token = $('#token').val();
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
                    url: "{{ config('setting.second_url') }}mahasiswa/transkrip-nilai",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    data: {
                        nim: nim,
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
                        data: 'smt_matakuliah',
                        className: "text-center"
                    },
                    {
                        data: 'kode_matakuliah'
                    },
                    {
                        data: 'nama_matakuliah'
                    },
                    {
                        data: 'sks_matakuliah',
                        className: "text-center"
                    },
                    {
                        data: 'nilai',
                        className: "text-center"
                    },
                    {
                        data: 'mutu',
                        visible: false
                    },
                    {
                        data: 'kum_sksmutu',
                        visible: false
                    }
                ],
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
                        .column(4)
                        .data()
                        .reduce(function(a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    jmlsksmutu = api
                        .column(7)
                        .data()
                        .reduce(function(a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                    $('#total_sks').html(jumlahsks + ' sks');
                    $('#ipk').html((jmlsksmutu / jumlahsks).toFixed(2));
                    // Update footer
                    // $( api.column( 2 ).footer() ).html(total);
                }
            });


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


            function filterkhs() {
                $.ajax({
                    type: 'GET',
                    url: "{{ config('setting.second_url') }}mahasiswa/select-khs",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    success: function(result) {
                        var jml = result.length;
                        var s = '<option value="">-Pilih Tahun Akademik-</option>';
                        for (i = 0; i < jml; i++) {
                            s = s + '<option value="' + result[i].id_heregistrasi + '"> ' + result[i]
                                .tahun_ajaran + '</option>';
                        }
                        // console.log(result);
                        $('.selecttahunakademik').html(s);
                    }
                })
            }
            filterkhs();

            // show data edit
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
                    Anda tidak bisa melihat Transkrip. Silahkan lakukan pelunasan Tagihan Pembayaran yang ada pada menu Status Pembayaran. Terima Kasih.
                </div>
            </div>`;
                    console.log(result);
                    if (result == 0) {
                        $('.cekpembayaran').html(hh);
                    }
                }
            })


        });
    </script>
@stop
