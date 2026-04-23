@extends('layout')

@section('head')
<style>
    /* DataTables Select Checkbox Styling */
    .select-checkbox {
        position: relative;
    }
    
    .select-checkbox:before {
        content: '';
        display: block;
        position: absolute;
        top: 50%;
        left: 50%;
        width: 16px;
        height: 16px;
        margin-top: -8px;
        margin-left: -8px;
        border: 2px solid #007bff;
        border-radius: 3px;
        background-color: white;
    }
    
    .selected .select-checkbox:after {
        content: '✓';
        display: block;
        position: absolute;
        top: 50%;
        left: 50%;
        width: 16px;
        height: 16px;
        margin-top: -8px;
        margin-left: -8px;
        text-align: center;
        line-height: 12px;
        font-size: 12px;
        color: white;
        background-color: #007bff;
        border-radius: 3px;
    }
    
    .table td {
        vertical-align: middle;
    }
    
    .table th {
        vertical-align: middle;
    }
    
    #generateGroupVAContainer {
        background-color: #f8f9fa;
        padding: 15px;
        border-radius: 5px;
        border: 1px solid #dee2e6;
    }
    
    .selected-row {
        background-color: #e3f2fd !important;
    }
    
    /* Hover effect for selectable rows */
    tbody tr:hover {
        background-color: #f5f5f5;
        cursor: pointer;
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
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Panduan Pembayaran</h3>
                    {{-- <h6 class="box-subtitle">Melihat Data KHS</h6> --}}
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row col-xl-12">
                        {{-- <div class="col-xl-7">
                            <div class="box bg-primary-light">
                                <div class="box-body"><i class="text-warning fa fa-address-book-o font-size-40"><span
                                            class="path1"></span><span class="path2"></span><span
                                            class="path3"></span><span class="path4"></span></i>
                                    <div class="text-warning font-weight-600 font-size-18 mb-2 mt-5">Nomor Virtual Akun
                                        Mahasiswa :</div>
                                    <div class="text-mute font-size-24 vamahasiswa"></div>
                                </div>
                            </div>
                        </div> --}}
                        <div class="col-xl-5">
                            <div class="box bg-primary-light">
                                <div class="box-body"><i class="text-warning fa fa-download font-size-40"><span
                                            class="path1"></span><span class="path2"></span><span
                                            class="path3"></span><span class="path4"></span></i>
                                    <div class="text-warning font-weight-600 font-size-18 mb-2 mt-5">Download Panduan
                                        Pembayaran</div>
                                    <div class="text-mute font-size-25"><a href="{{ url('file') }}/BNI-Pembayaran.pdf"
                                            target="_blank">Download Disini</a></div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.box-body -->
            </div>
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Tagihan Pembayaran</h3>
                    {{-- <h6 class="box-subtitle">Melihat Data KHS</h6> --}}
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="tagihanTable" class="table table-hover table-sm text-nowrap" width="100%">
                            <thead class="bg-dark">
                                <tr>
                                    <th></th>
                                    <th>Tahun/Semester
                                    </th>
                                    <th>Nomor Virtual Akun
                                    </th>
                                    <th>Nama Tagihan
                                    </th>
                                    <th>
                                        <center>Jumlah Tagihan</center>
                                    </th>
                                    <th>
                                        <center>Jumlah Bayar</center>
                                    </th>
                                    <th>
                                        <center>Status</center>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Button Generate Group VA -->
                    <div id="generateGroupVAContainer" class="mt-3" style="display: none;">
                        <button type="button" class="btn btn-success btn-lg" id="generateGroupVA">
                            <i class="fa fa-credit-card"></i> Generate Group VA
                        </button>
                        <span class="ml-3 text-muted" id="selectedItemsInfo"></span>
                    </div>
                    
                    <!-- Hidden input untuk menyimpan kode yang dipilih -->
                    <input type="hidden" id="kodejamak" name="kodejamak" value="">

                </div>
                <!-- /.box-body -->
            </div>
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Riwayat Pembayaran</h3>
                    {{-- <h6 class="box-subtitle">Melihat Data KHS</h6> --}}
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-sm text-nowrap" width="100%">
                            <thead class="bg-success">
                                <tr>
                                    <th>
                                        <center>No</center>
                                    </th>
                                    <th>Tahun/Semester
                                    </th>
                                    <th>Keterangan Pembayaran
                                    </th>
                                    <th>
                                        <center>Jumlah Bayar</center>
                                    </th>

                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot id="isinyariw">
                                <tr>
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
                <!-- /.box-body -->
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection
@section('script-master')
    <!-- DataTables Select Extension -->
    <script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.3/css/select.dataTables.min.css">
    
    <script type="text/javascript">
        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }
        $(document).ready(function() {

            var token = "{{ Session::get('token') }}";
            var userlogin = "{{ Session::get('username') }}";
            var nim = "{{ Session::get('username') }}";
            
            // Initialize DataTable
            var table = $('#tagihanTable').DataTable({
                "processing": true,
                "serverSide": false,
                "data": [],
                "columnDefs": [{
                    "orderable": false,
                    "className": 'select-checkbox',
                    "targets": 0
                }],
                "select": {
                    "style": 'multi',
                    "selector": 'td:first-child'
                },
                "columns": [
                    {
                        "data": null,
                        "render": function(data, type, full, meta) {
                            return '';
                        }
                    },
                    {
                        "data": "tahun_semester",
                        "render": function(data, type, row) {
                            var smthrf = row.semester == '1' ? "Ganjil" : "Genap";
                            return row.tahun + ' ' + smthrf;
                        }
                    },
                    {
                        "data": "kodeva",
                        "render": function(data, type, row) {
                            return '<b>' + (row.kodeva || '') + '</b>';
                        }
                    },
                    { "data": "nama_biaya" },
                    {
                        "data": "biaya",
                        "className": "text-center",
                        "render": function(data, type, row) {
                            return formatRupiah(row.biaya.toString());
                        }
                    },
                    {
                        "data": "jumbayar",
                        "className": "text-center",
                        "render": function(data, type, row) {
                            return formatRupiah(row.jumbayar.toString());
                        }
                    },
                    {
                        "data": "status",
                        "className": "text-center",
                        "render": function(data, type, row) {
                            if (row.status == '0') {
                                return '<center><span class="badge badge-warning">Belum Lunas</span></center>';
                            } else {
                                return '<center><span class="badge badge-success">Lunas</span></center>';
                            }
                        }
                    }
                ],
                "order": [[1, 'asc']],
                "pageLength": 10,
                "language": {
                    "emptyTable": "Anda belum memiliki tagihan.",
                    "processing": "Memproses data...",
                    "search": "Cari:",
                    "lengthMenu": "Tampilkan _MENU_ data per halaman",
                    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    "infoEmpty": "Menampilkan 0 sampai 0 dari 0 data",
                    "infoFiltered": "(disaring dari _MAX_ total data)",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Selanjutnya",
                        "previous": "Sebelumnya"
                    }
                }
            });

            // Load data via AJAX
            $.ajax({
                type: 'GET',
                url: "{{ config('setting.second_url') }}mahasiswa/tampilstatuspembayaran",
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                data: {
                    nim: nim
                },
                success: function(result) {
                    // Add kode field to each row for selection
                    var processedData = result.map(function(item, index) {
                        item.kode = item.id_heregistrasi || item.kodeva || 'item_' + index;
                        item.tahun_semester = item.tahun + ' ' + (item.semester == '1' ? 'Ganjil' : 'Genap');
                        return item;
                    });
                    
                    table.clear().rows.add(processedData).draw();
                },
                error: function(xhr, status, error) {
                    console.error('Error loading data:', error);
                    table.clear().draw();
                }
            });

            // Handle DataTable select events
            table.on('select', function(e, dt, type, indexes) {
                updateSelectedItems();
            }).on('deselect', function(e, dt, type, indexes) {
                updateSelectedItems();
            });

            // Function to update selected items
            function updateSelectedItems() {
                var selectedRows = table.rows('.selected').data();
                var selectedCodes = [];
                var totalAmount = 0;
                
                for (var i = 0; i < selectedRows.length; i++) {
                    selectedCodes.push(selectedRows[i]['kode']);
                    // Only count unpaid items
                    if (selectedRows[i]['status'] == '0') {
                        totalAmount += parseInt(selectedRows[i]['biaya']);
                    }
                }
                
                var codesString = selectedCodes.join('-');
                $('#kodejamak').val(codesString);
                
                if (selectedRows.length > 0) {
                    $('#generateGroupVAContainer').show();
                    $('#selectedItemsInfo').text(selectedRows.length + ' item dipilih - Total: ' + formatRupiah(totalAmount.toString()));
                } else {
                    $('#generateGroupVAContainer').hide();
                    $('#selectedItemsInfo').text('');
                }
            }

            // Handle Generate Group VA button click
            $('#generateGroupVA').on('click', function() {
                var selectedCodes = $('#kodejamak').val();
                if (selectedCodes) {
                    // Here you can add your logic to generate group VA
                    alert('Generate Group VA untuk kode: ' + selectedCodes);
                    // You can redirect to another page or make AJAX call here
                    // window.location.href = '/generate-group-va?codes=' + selectedCodes;
                }
            });
            $.ajax({
                type: 'GET',
                url: "{{ config('setting.second_url') }}mahasiswa/tampilstatuspembayaranriwayat",
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                data: {
                    nim: nim
                },
                success: function(result) {
                    var jml = result.length;
                    var s = '';
                    if (jml == 0) {
                        s =
                            "<tr><td colspan='5' align='center'>Anda belum memiliki pembayaran.</td></tr>";
                    }
                    for (i = 0; i < jml; i++) {
                        var smthrf;
                        var stthrf;
                        if (result[i].semester == '1') {
                            smthrf = "Ganjil";
                        } else {
                            smthrf = "Genap";
                        }
                        var bilangan1 = result[i].bayar;
                        var number_string1 = bilangan1.toString(),
                            sisa1 = number_string1.length % 3,
                            rupiah1 = number_string1.substr(0, sisa1),
                            ribuan1 = number_string1.substr(sisa1).match(/\d{3}/g);

                        if (ribuan1) {
                            separator1 = sisa1 ? '.' : '';
                            rupiah1 += separator1 + ribuan1.join('.');
                        }
                        s = s + '<tr><td><center>' + (i + 1) + '</center></td><td> ' + result[i].tahun +
                            ' ' + smthrf +
                            '</td><td> ' + result[i].nama_biaya + '</td><td> <center>' + rupiah1 +
                            '</center></td></tr>';
                        // console.log(result[i].id_heregistrasi);
                    }
                    $('#isinyariw').html(s);
                }
            })
            $.ajax({
                type: 'GET',
                url: "{{ config('setting.second_url') }}mahasiswa/tampilstatusva",
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                data: {
                    nim: nim
                },
                success: function(result) {
                    var jml = result.length;
                    var bjs;
                    var bri;
                    var bsb;
                    if (jml == 0) {
                        bjs = "";
                        bri = "";
                        bsb = "";
                    }
                    for (i = 0; i < jml; i++) {
                        bjs = "Virtual Akun BJS : <b>" + result[i].va_bjs + "</b>";
                        bri = result[i].va_bri ?? "";
                        bsb = result[i].va_bsb ?? "";
                    }
                    $('.vamahasiswa').html(bjs + bri + bsb);
                }
            })

        });
    </script>
@stop
