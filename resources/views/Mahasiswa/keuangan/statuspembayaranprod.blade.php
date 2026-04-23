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
                                    <th>Tahun/Semester</th>
                                    <th>Keterangan Pembayaran</th>
                                    <th>
                                        <center>Jumlah Bayar</center>
                                    </th>
                                    <th>Bukti Bayar</th>
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
    
<!-- Tempat generate QRCode secara diam-diam -->
<div id="qrcode" style="display: none;"></div>    
    
@endsection
@section('script-master')
    <script type="text/javascript">

        var token = "{{ Session::get('token') }}";
        var userlogin = "{{ Session::get('username') }}";
        var nim = "{{ Session::get('username') }}";
        
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
        function formatTanggal(tgl) {
            const d = new Date(tgl);
        
            // Deteksi apakah string input mengandung waktu (jam dan menit)
            const hasTime = /[T ]\d{2}:\d{2}/.test(tgl);
        
            return d.toLocaleDateString("id-ID", {
                day: '2-digit',
                month: 'long',
                year: 'numeric',
                ...(hasTime && {
                    hour: '2-digit',
                    minute: '2-digit'
                })
            });
        }

        function terbilang(nilai) {
            nilai = Math.floor(nilai);
        
            if (nilai === 0) return 'nol';
        
            const satuan = ["", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas"];
        
            function baca(n) {
                if (n < 12) {
                    return satuan[n];
                } else if (n < 20) {
                    return satuan[n - 10] + " Belas";
                } else if (n < 100) {
                    return baca(Math.floor(n / 10)) + " Puluh" + (n % 10 !== 0 ? " " + baca(n % 10) : "");
                } else if (n < 200) {
                    return "Seratus" + (n - 100 !== 0 ? " " + baca(n - 100) : "");
                } else if (n < 1000) {
                    return baca(Math.floor(n / 100)) + " Ratus" + (n % 100 !== 0 ? " " + baca(n % 100) : "");
                } else if (n < 2000) {
                    return "Seribu" + (n - 1000 !== 0 ? " " + baca(n - 1000) : "");
                } else if (n < 1000000) {
                    return baca(Math.floor(n / 1000)) + " Ribu" + (n % 1000 !== 0 ? " " + baca(n % 1000) : "");
                } else if (n < 1000000000) {
                    return baca(Math.floor(n / 1000000)) + " Juta" + (n % 1000000 !== 0 ? " " + baca(n % 1000000) : "");
                } else {
                    return "terlalu besar";
                }
            }
        
            return baca(nilai).trim();
        }
        
        function cetakNota(id_bayar) {
            
            $.ajax({
                type: 'GET',
                url: "{{ config('setting.second_url') }}mahasiswa/getbukti",
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                data: { id: id_bayar },
                success: function(res) {
                    let semester = res.semester == '1' ? 'Ganjil' : 'Genap';
                    let terbilangText = terbilang(res.bayar);
        
            if (res.valid_id) {
                $('#qrcode').empty();
            
                // Susun isi QR code
                let qrText = `VALID ID: ${res.valid_id}`;
                if (res.waktubayar) {
                    qrText += `\nWaktu Bayar: ${formatTanggal(res.waktubayar)}`;
                }
                if (res.payment_by) {
                    qrText += `\nPayment By: ${res.payment_by}`;
                }
                if (res.keterangan) {
                    qrText += `\nKeterangan: ${res.keterangan}`;
                }
                // Render QR code
                new QRCode(document.getElementById("qrcode"), {
                    text: qrText,
                    width: 100,
                    height: 100,
                    correctLevel: QRCode.CorrectLevel.H
                });
            }
            
            
            setTimeout(() => {
                let qrSrc = '';
                if (res.valid_id) {
                    const qrImg = document.querySelector('#qrcode img');
                    qrSrc = qrImg ? qrImg.src : '';
                }
                        let html = `
                            <div style="font-family: Arial, sans-serif; font-size: 14px; padding: 20px;">
                                <div style="text-align:center; margin-bottom: 10px;">
                                    <img src="{{ url('imageup45/logoumuka.png') }}" alt="Logo" style="height:70px;">
                                    <h3 style="margin:0;">UNIVERSITAS MUHAMMADIYAH KARANGANYAR</h3>
                                    <p style="margin:0;">Jalan Raya Solo-Tawangmangu Km. 9, Karanganyar | www.umuka.ac.id | Email: umuka@umuka.ac.id</p>
                                    <p style="margin:0;">Telp: (0271) 6498851, 4993981</p>
                                    <hr>
                                </div>
            
                                <h4 style="text-align:center; text-decoration: underline;">BUKTI PENERIMAAN KAS</h4>
            
                                <table style="width: 100%; margin-bottom: 10px;">
                                    <tr>
                                        <td><strong>No. Trans</strong></td>
                                        <td>: ${res.no_transaksi}</td>
                                        <td><strong>No. Kwitansi</strong></td>
                                        <td>: ${res.no_kwitansi}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Nama</strong></td>
                                        <td>: ${res.nama_mahasiswa}</td>
                                        <td><strong>NIM</strong></td>
                                        <td>: ${res.nim}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Prodi</strong></td>
                                        <td>: ${res.jurusan || '-'}</td>
                                        <td><strong>Fakultas</strong></td>
                                        <td>: ${res.fakultas || '-'}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Semester</strong></td>
                                        <td>: ${semester}</td>
                                        <td><strong>Payment By</strong></td>
                                        <td>: ${res.payment_by}</td>
                                    </tr>
                                </table>
            
                                <table style="width: 100%; border-collapse: collapse;" border="1">
                                    <thead>
                                        <tr style="background:#f0f0f0;">
                                            <th style="padding: 6px;">No</th>
                                            <th style="padding: 6px;">Keterangan</th>
                                            <th style="padding: 6px;">Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="text-align:center;">1</td>
                                            <td style="text-align:center;">${res.nama_biaya} (SMT ${res.semester})</td>
                                            <td style="text-align:right;">Rp ${parseInt(res.bayar).toLocaleString('id-ID')}</td>
                                        </tr>
                                    </tbody>
                                </table>
            
                                <p><strong>Terbilang:</strong> <i> ${terbilangText} rupiah </i></p>
            
                                <h4 style="text-align: right;">Grand Total: Rp ${parseInt(res.bayar).toLocaleString('id-ID')}</h4>
            
                                <div style="margin-top: 30px;">
                                    <table style="width:100%;">
                                        <tr>
                                            <td style="text-align: left;">
                                                <p style="margin-bottom: 0;"><strong>Note:</strong></p>
                                                <ol style="margin-top: 4px;">
                                                    <li>Disimpan sebagai bukti pembayaran yang SAH</li>
                                                    <li>Uang yang sudah dibayarkan tidak dapat diminta kembali</li>
                                                </ol>
                                            </td>
                                            <td style="text-align: center;">
                                                Karanganyar, ${formatTanggal(res.tgl_bayar)}<br><br>
                                                Petugas yang menerima<br>
                                                    ${res.valid_id && qrSrc ? `
                                                        <div style="margin: 10px auto;">
                                                            <img src="${qrSrc}" width="100" height="100" />
                                                        </div>` : ''
                                                    }
                                                <strong>${res.user_by || '(ttd)'}</strong>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <p style="margin-top: 10px; font-size: 12px; text-align:center;">
                                    Payment Info | Kontak: 08112801912 | Email: umuka@umuka.ac.id
                                </p>
                            </div>
                        `;
            
                        // Cetak langsung di tab baru
                        const printWindow = window.open('', '_blank');
                            printWindow.document.open();
                            printWindow.document.write(`
                                <html>
                                    <head>
                                        <title>Cetak Nota</title>
                                        <style>@media print { body { margin: 0; } }</style>
                                    </head>
                                    <body onload="window.print(); window.onafterprint = window.close();">
                                        ${html}
                                    </body>
                                </html>
                            `);
                            printWindow.document.close();
                        }, 300); // Delay 300ms cukup untuk QRCode.js merender
                    },
                    error: function() {
                        alert('Gagal memuat data nota.');
                    }
                });
            }
        
        
        $(document).ready(function() {
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
                        // s = s + '<tr><td><center>' + (i + 1) + '</center></td><td> ' + result[i].tahun +
                        //     ' ' + smthrf +
                        //     '</td><td> ' + result[i].nama_biaya + '</td><td> <center>' + rupiah1 +
                        //     '</center></td></tr>';
                        
                    s = s + '<tr>' +
                        '<td><center>' + (i + 1) + '</center></td>' +
                        '<td>' + result[i].tahun + ' ' + smthrf + '</td>' +
                        '<td>' + result[i].nama_biaya + '</td>' +
                        '<td><center>' + rupiah1 + '</center></td>' +
                        '<td>' +
                        (result[i].valid_id ? 
                            '<a href="javascript:void(0);" onclick="cetakNota(' + result[i].id_bayar + ')" class="btn btn-primary btn-sm">' :
                            '<a href="javascript:void(0);" class="btn btn-secondary btn-sm disabled" title="Data tidak valid">' ) +
                        '<i class="fa fa-file-text"></i>' +
                        '</a>' +
                        '</td>' +
                        '</tr>';
                        
                        
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
