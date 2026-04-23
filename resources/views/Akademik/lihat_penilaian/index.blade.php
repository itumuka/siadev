@extends('layout')

@section('css')
    <style>
        th,
        td {
            white-space: nowrap;
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
                    <h6 class="box-subtitle">Melihat Mata Kuliah Prodi</h6>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <input class="form-control" type="hidden" name="tahun" id="tahun"
                            value="{{ $session_tahun }}">
                        <input class="form-control" type="hidden" name="semester" id="semester"
                            value="{{ $session_semester }}">
                        <input class="form-control" type="hidden" name="tipe" id="tipe"
                            value="{{ $session_tipe }}">
                        <table id="tbmakulpenawaran" class="table table-hover table-sm" width="100%">
                            <thead class="bg-dark">
                                <tr>
                                    <!--<th>No</th>-->
                                    <th>Progress</th>
                                    <th>Kode Makul</th>
                                    <th>Matakuliah</th>
                                    <th>Kelas</th>
                                    <th>Dosen</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="4" class="text-right"> Total Progress Penilaian :</th>
                                    <th id="total-penilaian"></th>
                                </tr>
                            </tfoot>
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

            var kode_prodi = $('#kode_prodi').val();
            var tahun = $('#tahun').val();
            var semester = $('#semester').val();
            var tipe = $('#tipe').val();

            var table = $("#tbmakulpenawaran").DataTable({
                destroy: true,
                dom: 'l<br>Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel'
                ],
                processing: true,
                lengthChange: true,
                ajax: {
                    type: "GET",
                    url: "{{ config('setting.second_url') }}akademik/makul-ba-ujian",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    data: {
                        tahun: tahun,
                        semester: semester,
                        kode_prodi: kode_prodi,
                        tipe: tipe
                    },
                    dataSrc: function(json) {
                        return json;
                    }
                },
                columns: [
                    {
                        data: null,
                        className: 'text-center',
                        render: function(data, type, row, meta) {
                            // Konversi nilai ke angka
                            let ba_ujian = parseFloat(row.ba_ujian) || 0;
                            let penilaian = parseFloat(row.penilaian) || 0;
                    
                            // Tentukan total maksimum (misalnya 2 jika skala nilai 1)
                            let total_maksimum = 2;
                    
                            // Hitung persen berdasarkan total maksimum
                            let persen = ((ba_ujian + penilaian) / total_maksimum * 100).toFixed(2);
                    
                            // Pastikan persen tidak lebih dari 100%
                            persen = Math.min(persen, 100);
                    
                            // Progress bar HTML
                            let bar = `
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="w-150 mx-20">
                                        <div class="progress progress-sm mb-0">
                                            <div class="progress-bar progress-bar-primary" role="progressbar" 
                                                style="width: ${persen}%;" aria-valuenow="${persen}" 
                                                aria-valuemin="0" aria-valuemax="100">
                                            </div>
                                        </div>
                                    </div>
                                    <h5 class="mb-0">${persen}%</h5>
                                </div>
                            `;
                    
                            return bar;
                        }
                    },
                    {
                        data: 'kode_matakuliah'
                    },
                    {
                        data: null,
                        render: function(data, type, row, meta) {
                            return `
                                <strong>${row.nama_matakuliah}</strong><br>
                                Semester: ${row.smt_matakuliah} | SKS: ${row.sks_matakuliah}
                            `;
                        }
                    },
                    {
                        data: 'nama_kelas', className: 'text-center'
                    },
                    {
                        data: null,
                        render: function(data, type, row, meta) {
                            let teamteach = '<ol>';
                            
                            if (row.dosen1) {
                                teamteach += '<li>' + row.dosen1 + '</li>';
                            }
                            if (row.dosen2) {
                                teamteach += '<li>' + row.dosen2 + '</li>';
                            }
                    
                            teamteach += '</ol>';
                            return teamteach;
                        }
                    },
                ],
                order: [],
                footerCallback: function(row, data, start, end, display) {
                    // Hitung total nilai penilaian dari semua data
                    let total_penilaian = data.reduce((sum, row) => sum + (parseFloat(row.penilaian) || 0), 0);
                    
                    // Hitung persentase terhadap total maksimum
                    let total_maksimum = data.length * 1; // Maksimum nilai tiap row adalah 1
                    let persen_total = ((total_penilaian / total_maksimum) * 100).toFixed(2);
                    
                    // Pastikan persen tidak lebih dari 100%
                    persen_total = Math.min(persen_total, 100);
            
                    // Tampilkan hasilnya ke dalam span di footer
                    $(row).find("th#total-penilaian").html(`<strong class="text-primary">${total_penilaian}/${total_maksimum} (${persen_total}%)</strong>`);
                }
            });

            table.on('click', '#bt_modal_add', function() {
                $tr = $(this).closest('tr');
                var data = table.row($tr).data();
                var id_kelas = $(this).data('id');
                var mk = $(this).data('mk');
                $('#id_kelas').val(id_kelas);
                $('#l_nama_makul').html(mk);
                $('#bantuan_nim').data('id', id_kelas);
                $('#modal_add').modal('show');

                $('.selectnim').select2({
                    allowClear: true,
                    placeholder: '-Pilih NIM-',
                    ajax: {
                        dataType: 'json',
                        url: "{{ config('setting.second_url') }}akademik/select-nim",
                        headers: {
                            "Authorization": 'Bearer ' + token,
                            "username": userlogin
                        },
                        delay: 100,
                        data: function(params) {
                            return {
                                id_kelas: id_kelas,
                                search: params.term
                            }
                        },
                        processResults: function(data) {
                            var data_array = [];
                            data.data.forEach(function(value, key) {
                                data_array.push({
                                    id: value.id,
                                    text: value.text
                                })
                            });

                            return {
                                results: data_array
                            }
                        }
                    }
                }).on('selectnim:select', function(evt) {
                    $(".selectnim option:selected").val();
                });

            });

            function help_nim(id) {
                var table = $("#tbhelp_nim").DataTable({
                    destroy: true,
                    // dom: 'Bfrtip',
                    // buttons: [
                    //     'copy', 'csv', 'excel'
                    // ],
                    // responsive: true,
                    pageLength: 50,
                    processing: true,
                    lengthChange: true,
                    bInfo: false,
                    bPaginate: false,
                    ajax: {
                        type: "POST",
                        url: "{{ config('setting.second_url') }}akademik/bantuan-nim-ba-ujian",
                        headers: {
                            "Authorization": 'Bearer ' + token,
                            "username": userlogin
                        },
                        data: {
                            id_kelas: id
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
                            data: "nim",
                            className: 'text-center'
                        },
                        {
                            data: "nama_mahasiswa"
                        }
                    ],
                    order: []
                });

                table.on('select', function(e, dt, type, indexes) {
                    var oData = table.rows('.selected').data();
                    var str = "";
                    for (var i = 0; i < oData.length; i++) {
                        if (i <= 0) {
                            str = oData[i]['nim'];
                        } else {
                            str = str + "#" + oData[i]['nim'];
                        }
                    }
                    // console.log(str);
                    $('#nim_tidak_hadir').html(str);
                }).on('deselect', function(e, dt, type, indexes) {
                    // var rowData = table.rows(indexes).data().toArray();
                    // console.log(table.rows('.selected').data());
                    var oData = table.rows('.selected').data();
                    var str = "";
                    for (var i = 0; i < oData.length; i++) {
                        if (i <= 0) {
                            str = oData[i]['nim'];
                        } else {
                            str = str + "#" + oData[i]['nim'];
                        }
                    }
                    // console.log(str);
                    $('#nim_tidak_hadir').html(str);
                });
            }

            $('#bantuan_nim').click(function() {
                var id = $(this).data('id');
                console.log(id);
                help_nim(id);
                $('#modal-bantuan').modal('show');
            });


            //save
            $('#form_add').on('submit', function(event) {
                event.preventDefault();
                var form_data = $(this).serialize();
                $.ajax({
                    url: "{{ config('setting.second_url') }}akademik/simpan-ba-ujian",
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

        });
    </script>
@stop
