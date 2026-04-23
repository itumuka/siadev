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
                                    <div class="text-mute font-size-25"><a href="{{ url('file') }}/Panduan-HostToHost.pdf"
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
                        <table class="table table-hover table-sm text-nowrap" width="100%">
                            <thead class="bg-dark">
                                <tr>
                                    <th>
                                        <center>No</center>
                                    </th>
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
                            <tfoot id="isinya">
                                <tr>
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
                    var jml = result.length;
                    var s = '';
                    if (jml == 0) {
                        s = "<tr><td colspan='5' align='center'>Anda belum memiliki tagihan.</td></tr>";
                    }
                    for (i = 0; i < jml; i++) {
                        var smthrf;
                        var stthrf;
                        if (result[i].semester == '1') {
                            smthrf = "Ganjil";
                        } else {
                            smthrf = "Genap";
                        }
                        if (result[i].status == '0') {
                            stthrf =
                                "<center><span class='badge badge-warning'>Belum Lunas</span></center>";
                        } else {
                            stthrf = "<center><span class='badge badge-success'>Lunas</span></center>";
                        }

                        bayarmhs = result[i].jumbayar;

                        var hasilhit = parseInt(result[i].biaya);
                        var bilangan = hasilhit.toString();
                        var number_string = bilangan.toString(),
                            sisa = number_string.length % 3,
                            rupiah = number_string.substr(0, sisa),
                            ribuan = number_string.substr(sisa).match(/\d{3}/g);

                        if (ribuan) {
                            separator = sisa ? '.' : '';
                            rupiah += separator + ribuan.join('.');
                        }

                        var hasilhit1 = parseInt(bayarmhs);
                        var bilangan1 = hasilhit1.toString();
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
                            '</td><td> <b>' + (result[i].kodeva || '') + '</b></td><td> ' + result[i]
                            .nama_biaya +
                            '</td><td> <center>' + rupiah +
                            '</center></td><td> <center>' + rupiah1 +
                            '</center></td><td> ' + stthrf + '</td></tr>';
                        // console.log(result[i].id_heregistrasi);
                    }
                    $('#isinya').html(s);
                }
            })
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
