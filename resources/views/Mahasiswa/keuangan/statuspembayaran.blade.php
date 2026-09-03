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
    
    /* Row yang tidak bisa dipilih (tidak punya kode_biling) */
    tbody tr.no-select {
        opacity: 0.6;
        cursor: not-allowed;
    }
    
    tbody tr.no-select:hover {
        background-color: #f8f9fa;
    }
    
    tbody tr.no-select td:first-child {
        pointer-events: none;
        opacity: 0.5;
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
                    
                    <!-- Panel Generate Multi-Bank VA -->
                    <div id="generateVASection" class="mt-4 p-3 bg-light rounded border" style="display: none;">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h4 class="font-weight-bold mb-1 text-primary">
                                    <i class="fa fa-credit-card mr-2"></i> Pilih Metode Pembayaran Virtual Account
                                </h4>
                                <span class="text-muted" id="selectedItemsInfo">0 tagihan dipilih</span>
                            </div>
                            <div class="text-right">
                                <span class="text-muted d-block font-size-12">Total Tagihan Terpilih:</span>
                                <span class="font-weight-bold font-size-20 text-success" id="selectedTotalAmount">Rp 0</span>
                            </div>
                        </div>

                        <label class="font-weight-bold mb-2 text-dark font-size-14">Pilih Bank Pembayaran:</label>
                        <div class="row">
                            <!-- BNI -->
                            <div class="col-md-4 mb-2">
                                <div class="card bank-choice-card border p-3 cursor-pointer" id="card_bank_bni" onclick="pilihBankOption('bni');" style="cursor: pointer; border-radius: 8px; border-width: 2px !important; border-color: #007bff !important; background-color: #f0f7ff;">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <div class="mr-3">
                                                <span class="badge badge-primary px-2 py-1 font-weight-bold font-size-14">BNI</span>
                                            </div>
                                            <div>
                                                <h5 class="font-weight-bold mb-0 text-dark">Bank BNI</h5>
                                                <small class="text-muted d-block">VA 16 Digit &bull; eCollection</small>
                                            </div>
                                        </div>
                                        <input type="radio" name="bank_option" value="bni" id="radio_bank_bni" checked style="transform: scale(1.3);">
                                    </div>
                                    <div class="mt-2 pt-2 border-top font-size-11 text-muted">
                                        <i class="fa fa-check-circle text-success mr-1"></i> ATM Bersama, Prima, Link &amp; Semua m-Banking
                                    </div>
                                </div>
                            </div>

                            <!-- Bank Mega Syariah -->
                            <div class="col-md-4 mb-2">
                                <div class="card bank-choice-card border p-3 cursor-pointer" id="card_bank_bms" onclick="pilihBankOption('bms');" style="cursor: pointer; border-radius: 8px; border-width: 2px !important; border-color: #dee2e6;">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <div class="mr-3">
                                                <span class="badge badge-success px-2 py-1 font-weight-bold font-size-14">BMS</span>
                                            </div>
                                            <div>
                                                <h5 class="font-weight-bold mb-0 text-dark">Bank Mega Syariah</h5>
                                                <small class="text-muted d-block">VA Berbasis NIM</small>
                                            </div>
                                        </div>
                                        <input type="radio" name="bank_option" value="bms" id="radio_bank_bms" style="transform: scale(1.3);">
                                    </div>
                                    <div class="mt-2 pt-2 border-top font-size-11 text-muted">
                                        <i class="fa fa-check-circle text-success mr-1"></i> M-Syariah &amp; Jaringan ATM Mega Syariah
                                    </div>
                                </div>
                            </div>

                            <!-- Bank Jateng Syariah -->
                            <div class="col-md-4 mb-2">
                                <div class="card bank-choice-card border p-3 cursor-pointer" id="card_bank_bjt" onclick="pilihBankOption('bjt');" style="cursor: pointer; border-radius: 8px; border-width: 2px !important; border-color: #dee2e6;">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <div class="mr-3">
                                                <span class="badge badge-info px-2 py-1 font-weight-bold font-size-14">BJS</span>
                                            </div>
                                            <div>
                                                <h5 class="font-weight-bold mb-0 text-dark">Bank Jateng Syariah</h5>
                                                <small class="text-muted d-block">VA 7 Digit NIM</small>
                                            </div>
                                        </div>
                                        <input type="radio" name="bank_option" value="bjt" id="radio_bank_bjt" style="transform: scale(1.3);">
                                    </div>
                                    <div class="mt-2 pt-2 border-top font-size-11 text-muted">
                                        <i class="fa fa-check-circle text-success mr-1"></i> Bima Mobile &amp; ATM Bank Jateng
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-3 pt-3 border-top">
                            <small class="text-muted"><i class="fa fa-shield text-info mr-1"></i> Virtual Account dibuat langsung secara resmi untuk tagihan Anda.</small>
                            <button type="button" class="btn btn-primary btn-lg font-weight-bold px-4" id="btnGenerateMultiVA" onclick="eksekusiGenerateMultiVA();">
                                <i class="fa fa-paper-plane mr-2"></i> Buat Nomor Virtual Account
                            </button>
                        </div>
                    </div>
                    
                    <!-- Hidden input untuk menyimpan id tagihan yang dipilih -->
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
                        <table id="riwayatTable" class="table table-hover table-sm text-nowrap" width="100%">
                            <thead class="bg-success">
                                <tr>
                                    <th><center>No</center></th>
                                    <th>Tanggal Bayar</th>
                                    <th>Tahun/Semester</th>
                                    <th>VA</th>
                                    <th>Keterangan Pembayaran</th>
                                    <th><center>Jumlah Bayar</center></th>
                                    <th><center>Bukti Bayar</center></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                </div>
                <!-- /.box-body -->
            </div>
        </section>
        <!-- /.content -->
    </div>
    
    <!-- Modal Sukses VA -->
    <div class="modal fade" id="modalSuksesVA" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title font-weight-bold text-white">
                        <i class="fa fa-check-circle mr-2"></i> Virtual Account Berhasil Dibuat
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <div class="text-center mb-4">
                        <span class="badge badge-secondary px-3 py-1 font-size-14 mb-2" id="modal_va_bank_badge">Bank BNI</span>
                        <p class="text-muted font-size-13 mb-1">Nomor Rekening Virtual Account:</p>
                        <div class="d-flex justify-content-center align-items-center">
                            <h2 class="font-weight-bold text-dark mb-0 mr-3" id="modal_va_number" style="letter-spacing: 2px; font-family: monospace;">-</h2>
                            <button type="button" class="btn btn-outline-primary btn-sm font-weight-bold" id="btnSalinVA" onclick="salinNomorVA();">
                                <i class="fa fa-copy mr-1"></i> Salin
                            </button>
                        </div>
                    </div>

                    <div class="row bg-light rounded p-3 mb-3">
                        <div class="col-sm-6">
                            <small class="text-muted d-block">Nama Mahasiswa</small>
                            <strong class="text-dark font-size-15" id="modal_va_mhs">-</strong>
                        </div>
                        <div class="col-sm-6 text-sm-right mt-2 mt-sm-0">
                            <small class="text-muted d-block">Total Nominal Tagihan</small>
                            <strong class="text-success font-size-18" id="modal_va_total">Rp 0</strong>
                        </div>
                        <div class="col-12 mt-2 pt-2 border-top">
                            <small class="text-muted d-block">Rincian Tagihan Terpilih:</small>
                            <span class="text-dark font-size-13" id="modal_va_tagihan">-</span>
                        </div>
                    </div>

                    <!-- Panduan Pembayaran Tabs/Accordion -->
                    <h5 class="font-weight-bold mb-2"><i class="fa fa-info-circle text-info mr-1"></i> Petunjuk Pembayaran</h5>
                    <div class="accordion" id="accordionPanduanVA">
                        <div class="card mb-1 border">
                            <div class="card-header p-2 bg-white" id="headingMbanking">
                                <h6 class="mb-0">
                                    <button class="btn btn-link font-weight-bold text-dark text-left w-100" type="button" data-toggle="collapse" data-target="#collapseMbanking">
                                        <i class="fa fa-mobile mr-2 text-primary"></i> Pembayaran via Mobile Banking
                                    </button>
                                </h6>
                            </div>
                            <div id="collapseMbanking" class="collapse show" data-parent="#accordionPanduanVA">
                                <div class="card-body font-size-13" id="panduan_mbanking_content">
                                    1. Buka aplikasi Mobile Banking.<br>
                                    2. Pilih menu <strong>Transfer &rarr; Virtual Account</strong>.<br>
                                    3. Masukkan nomor Virtual Account di atas.<br>
                                    4. Periksa kecocokan nama dan nominal, lalu konfirmasi pembayaran.
                                </div>
                            </div>
                        </div>
                        <div class="card mb-1 border">
                            <div class="card-header p-2 bg-white" id="headingATM">
                                <h6 class="mb-0">
                                    <button class="btn btn-link font-weight-bold text-dark text-left w-100 collapsed" type="button" data-toggle="collapse" data-target="#collapseATM">
                                        <i class="fa fa-university mr-2 text-success"></i> Pembayaran via Mesin ATM
                                    </button>
                                </h6>
                            </div>
                            <div id="collapseATM" class="collapse" data-parent="#accordionPanduanVA">
                                <div class="card-body font-size-13" id="panduan_atm_content">
                                    1. Masukkan kartu ATM dan PIN.<br>
                                    2. Pilih menu <strong>Menu Lainnya &rarr; Transfer &rarr; Virtual Account</strong>.<br>
                                    3. Masukkan nomor Virtual Account di atas.<br>
                                    4. Layar akan menampilkan rincian pembayaran. Konfirmasi dan simpan struk transaksi.
                                </div>
                            </div>
                        </div>
                        <div class="card mb-1 border">
                            <div class="card-header p-2 bg-white" id="headingAntarBank">
                                <h6 class="mb-0">
                                    <button class="btn btn-link font-weight-bold text-dark text-left w-100 collapsed" type="button" data-toggle="collapse" data-target="#collapseAntarBank">
                                        <i class="fa fa-exchange mr-2 text-warning"></i> Transfer dari Bank Lain (BCA, Mandiri, BRI, dll)
                                    </button>
                                </h6>
                            </div>
                            <div id="collapseAntarBank" class="collapse" data-parent="#accordionPanduanVA">
                                <div class="card-body font-size-13" id="panduan_antarbank_content">
                                    1. Pilih menu <strong>Transfer ke Bank Lain</strong>.<br>
                                    2. Pilih Bank tujuan sesuai bank yang Anda pilih.<br>
                                    3. Masukkan nomor Virtual Account di atas sebagai nomor rekening tujuan.<br>
                                    4. Masukkan nominal tagihan secara tepat, lalu selesaikan transaksi.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Tempat generate QRCode secara diam-diam -->
    <div id="qrcode" style="display: none;"></div>
@endsection
@section('script-master')
    <!-- DataTables Select Extension -->
    <script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.3/css/select.dataTables.min.css">
    
    <!-- QRCode Library -->
    <script src="{{ url('js/qrcode.js') }}"></script>
    
    <script type="text/javascript">
        // Global variables untuk digunakan di semua fungsi
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
                    "selector": 'td:first-child',
                    "info": false
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
                            if (!row.kodeva) {
                                return '<span class="badge badge-warning font-weight-normal px-2 py-1"><i class="fa fa-info-circle mr-1"></i> Belum ada VA</span>';
                            }
                            var bankBadge = '';
                            if (row.bank_va === 'BNI') {
                                bankBadge = '<span class="badge badge-primary mr-1" style="font-size: 11px;">BNI</span>';
                            } else if (row.bank_va === 'BMS') {
                                bankBadge = '<span class="badge badge-success mr-1" style="font-size: 11px;">Mega Syariah</span>';
                            } else if (row.bank_va === 'BJT') {
                                bankBadge = '<span class="badge badge-info mr-1" style="font-size: 11px;">Jateng Syariah</span>';
                            }
                            return bankBadge + '<b class="tx-14" style="letter-spacing: 0.5px;">' + row.kodeva + '</b>';
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
                "pageLength": 10
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
                    var processedData = result.map(function(item, index) {
                        item.kode = item.id_tagihan;
                        item.tahun_semester = item.tahun + ' ' + (item.semester == '1' ? 'Ganjil' : 'Genap');
                        return item;
                    });
                    
                    table.clear().rows.add(processedData).draw();
                    
                    // Disable selection hanya untuk tagihan yang sudah LUNAS
                    table.rows().every(function(rowIdx, tableLoop, rowLoop) {
                        var data = this.data();
                        if (data.status != '0') {
                            this.nodes().to$().addClass('no-select');
                            this.nodes().to$().find('td:first-child').css('pointer-events', 'none').css('opacity', '0.5');
                        }
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error loading data:', error);
                    table.clear().draw();
                }
            });

            // Handle DataTable select events
            table.on('select', function(e, dt, type, indexes) {
                var rowData = dt.rows(indexes).data()[0];
                if (!rowData || rowData.status != '0') {
                    dt.rows(indexes).deselect();
                    return false;
                }
                updateSelectedItems();
            }).on('deselect', function(e, dt, type, indexes) {
                updateSelectedItems();
            });

            // Function to update selected items
            function updateSelectedItems() {
                var selectedRows = table.rows('.selected').data();
                var selectedIds = [];
                var totalAmount = 0;
                var validItemsCount = 0;
                
                for (var i = 0; i < selectedRows.length; i++) {
                    if (selectedRows[i]['status'] == '0') {
                        selectedIds.push(selectedRows[i]['id_tagihan']);
                        validItemsCount++;
                        var sisa = parseInt(selectedRows[i]['biaya']) - parseInt(selectedRows[i]['jumbayar'] || 0);
                        totalAmount += (sisa > 0 ? sisa : parseInt(selectedRows[i]['biaya']));
                    }
                }
                
                $('#kodejamak').val(selectedIds.join(','));
                
                if (validItemsCount > 0) {
                    $('#generateVASection').slideDown();
                    $('#selectedItemsInfo').text(validItemsCount + ' tagihan dipilih');
                    $('#selectedTotalAmount').text(formatRupiah(totalAmount.toString()));
                } else {
                    $('#generateVASection').slideUp();
                    $('#selectedItemsInfo').text('0 tagihan dipilih');
                    $('#selectedTotalAmount').text('Rp 0');
                }
            }

            // Expose table to outer scope for reload
            window.tagihanTableInstance = table;
            window.updateSelectedItemsFn = updateSelectedItems;
            
            // Initialize DataTable for Riwayat Pembayaran
            var riwayatTable = $('#riwayatTable').DataTable({
                "processing": true,
                "serverSide": false,
                "data": [],
                "columns": [
                    {
                        "data": null,
                        "render": function(data, type, row, meta) {
                            return '<center>' + (meta.row + 1) + '</center>';
                        }
                    },
                    { "data": "created_at" },
                    {
                        "data": "tahun_semester",
                        "render": function(data, type, row) {
                            var smthrf = row.semester == '1' ? "Ganjil" : "Genap";
                            return row.tahun + ' ' + smthrf;
                        }
                    },
                    { "data": "kodeva" },
                    { "data": "nama_biaya" },
                    {
                        "data": "bayar",
                        "className": "text-center",
                        "render": function(data, type, row) {
                            return formatRupiah(row.bayar.toString());
                        }
                    },
                    {
                        "data": "id_bayar",
                        "className": "text-center",
                        "render": function(data, type, row) {
                            if (row.id_bayar) {
                                return '<a href="javascript:void(0);" onclick="cetakNota(' + row.id_bayar + ')" class="btn btn-primary btn-sm"><i class="fa fa-file-text"></i> Cetak</a>';
                            } else {
                                return '<a href="javascript:void(0);" class="btn btn-secondary btn-sm disabled" title="Data tidak tersedia"><i class="fa fa-file-text"></i> Cetak</a>';
                            }
                        }
                    }
                ],
                "order": [[0, 'asc']],
                "pageLength": 10,
                // "language": {
                //     "emptyTable": "Anda belum memiliki pembayaran.",
                //     "processing": "Memproses data...",
                //     "search": "Cari:",
                //     "lengthMenu": "Tampilkan _MENU_ data per halaman",
                //     "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                //     "infoEmpty": "Menampilkan 0 sampai 0 dari 0 data",
                //     "infoFiltered": "(disaring dari _MAX_ total data)",
                //     "paginate": {
                //         "first": "Pertama",
                //         "last": "Terakhir",
                //         "next": "Selanjutnya",
                //         "previous": "Sebelumnya"
                //     }
                // }
            });
            
            // Load data via AJAX for Riwayat Pembayaran
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
                    // Process data untuk DataTables
                    var processedData = result.map(function(item, index) {
                        item.tahun_semester = item.tahun + ' ' + (item.semester == '1' ? 'Ganjil' : 'Genap');
                        return item;
                    });
                    
                    riwayatTable.clear().rows.add(processedData).draw();
                },
                error: function(xhr, status, error) {
                    console.error('Error loading riwayat data:', error);
                    riwayatTable.clear().draw();
                }
            });
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
            });

        });

        // Global variable for selected bank
        var selectedBank = 'bni';

        function pilihBankOption(bank) {
            selectedBank = bank;
            $('.bank-choice-card').css({
                'border-color': '#dee2e6',
                'background-color': '#ffffff'
            });
            $('input[name="bank_option"]').prop('checked', false);

            $('#card_bank_' + bank).css({
                'border-color': '#007bff',
                'background-color': '#f0f7ff'
            });
            $('#radio_bank_' + bank).prop('checked', true);
        }

        function eksekusiGenerateMultiVA() {
            var selectedIdsString = $('#kodejamak').val();
            if (!selectedIdsString) {
                showToastr('warning', 'Peringatan!', 'Silakan pilih tagihan yang ingin dibayar terlebih dahulu.');
                return;
            }

            var $btn = $('#btnGenerateMultiVA');
            var originalText = $btn.html();
            $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin mr-2"></i> Sedang Memproses...');

            var selectedIds = selectedIdsString.split(',');

            $.ajax({
                type: 'POST',
                url: "{{ config('setting.second_url') }}mahasiswa/generate-va",
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                data: {
                    nim: nim,
                    id_tagihan: selectedIds,
                    bank: selectedBank
                },
                success: function(response) {
                    if (response.success && response.data) {
                        var data = response.data;
                        
                        // Populate modal
                        $('#modal_va_bank_badge').text(data.bank_name);
                        $('#modal_va_number').text(data.nomor_va);
                        $('#modal_va_mhs').text(data.nama_mahasiswa);
                        $('#modal_va_total').text(formatRupiah(data.total_nominal.toString()));
                        $('#modal_va_tagihan').text(data.nama_tagihan);

                        // Update petunjuk text per bank
                        updatePetunjukBank(data.bank, data.nomor_va);

                        $('#modalSuksesVA').modal('show');

                        // Reload tagihan table
                        muatUlangTagihan();
                    } else {
                        showToastr('error', 'Error!', response.message || 'Gagal membuat Virtual Account.');
                    }
                },
                error: function(xhr) {
                    var msg = 'Terjadi kesalahan saat membuat Virtual Account.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        msg = xhr.responseJSON.message;
                    }
                    showToastr('error', 'Error!', msg);
                },
                complete: function() {
                    $btn.prop('disabled', false).html(originalText);
                }
            });
        }

        function updatePetunjukBank(bank, nomorVa) {
            if (bank === 'bni') {
                $('#panduan_mbanking_content').html(
                    '1. Buka aplikasi <strong>BNI Mobile Banking</strong>.<br>' +
                    '2. Pilih menu <strong>Pembayaran &rarr; Biaya Pendidikan &rarr; Pembayaran</strong>.<br>' +
                    '3. Masukkan nomor Virtual Account: <strong>' + nomorVa + '</strong>.<br>' +
                    '4. Periksa kecocokan data nama dan jumlah bayar, lalu masukkan Password Transaksi.'
                );
                $('#panduan_atm_content').html(
                    '1. Masukkan kartu ATM BNI dan PIN.<br>' +
                    '2. Pilih menu <strong>Menu Lain &rarr; Pembayaran &rarr; Universitas/Institusi &rarr; Virtual Account Billing</strong>.<br>' +
                    '3. Masukkan nomor Virtual Account: <strong>' + nomorVa + '</strong>.<br>' +
                    '4. Konfirmasi data tagihan lalu selesaikan transaksi dan simpan struk.'
                );
                $('#panduan_antarbank_content').html(
                    '1. Buka m-Banking / ATM bank apa saja (BCA, Mandiri, BRI, dll).<br>' +
                    '2. Pilih menu <strong>Transfer Antar Bank</strong> &rarr; Pilih <strong>Bank BNI (Kode 009)</strong>.<br>' +
                    '3. Masukkan nomor Virtual Account <strong>' + nomorVa + '</strong> sebagai nomor rekening tujuan.<br>' +
                    '4. Masukkan nominal tagihan secara tepat, lalu konfirmasi transfer.'
                );
            } else if (bank === 'bms') {
                $('#panduan_mbanking_content').html(
                    '1. Buka aplikasi <strong>M-Syariah (Bank Mega Syariah)</strong>.<br>' +
                    '2. Pilih menu <strong>Pembayaran &rarr; Pendidikan</strong> &rarr; Pilih <strong>UMUKA</strong>.<br>' +
                    '3. Masukkan nomor VA/NIM: <strong>' + nomorVa + '</strong>.<br>' +
                    '4. Rincian tagihan akan muncul otomatis, konfirmasi pembayaran.'
                );
                $('#panduan_atm_content').html(
                    '1. Masukkan kartu ATM Bank Mega Syariah dan PIN.<br>' +
                    '2. Pilih menu <strong>Transaksi Lainnya &rarr; Pembayaran &rarr; Pendidikan</strong>.<br>' +
                    '3. Masukkan nomor VA/NIM: <strong>' + nomorVa + '</strong>.<br>' +
                    '4. Layar menampilkan data tagihan, konfirmasi dan ambil bukti transaksi.'
                );
                $('#panduan_antarbank_content').html(
                    '1. Melalui m-Banking bank lain, pilih transfer antar bank.<br>' +
                    '2. Pilih <strong>Bank Mega Syariah (Kode 506)</strong>.<br>' +
                    '3. Masukkan nomor VA <strong>' + nomorVa + '</strong> sebagai rekening tujuan.<br>' +
                    '4. Masukkan nominal sesuai total tagihan dan selesaikan transaksi.'
                );
            } else if (bank === 'bjt') {
                $('#panduan_mbanking_content').html(
                    '1. Buka aplikasi <strong>Bima Mobile (Bank Jateng)</strong>.<br>' +
                    '2. Pilih menu <strong>Pembayaran &rarr; Pendidikan</strong> &rarr; Pilih <strong>UMUKA</strong>.<br>' +
                    '3. Masukkan nomor VA: <strong>' + nomorVa + '</strong>.<br>' +
                    '4. Rincian tagihan akan tampil, masukkan PIN Bima Mobile untuk konfirmasi.'
                );
                $('#panduan_atm_content').html(
                    '1. Masukkan kartu ATM Bank Jateng dan PIN.<br>' +
                    '2. Pilih menu <strong>Pembayaran &rarr; Pendidikan</strong>.<br>' +
                    '3. Masukkan nomor VA <strong>' + nomorVa + '</strong>.<br>' +
                    '4. Konfirmasi pembayaran dan simpan struk pembayaran.'
                );
                $('#panduan_antarbank_content').html(
                    '1. Melalui ATM atau m-Banking bank lain, pilih Transfer Antar Bank.<br>' +
                    '2. Pilih <strong>Bank Jateng Syariah (Kode 113)</strong>.<br>' +
                    '3. Masukkan nomor VA <strong>' + nomorVa + '</strong> sebagai tujuan transfer.<br>' +
                    '4. Pastikan nominal sesuai dengan total tagihan.'
                );
            }
        }

        function salinNomorVA() {
            var noVa = $('#modal_va_number').text();
            if (navigator.clipboard) {
                navigator.clipboard.writeText(noVa).then(function() {
                    $('#btnSalinVA').html('<i class="fa fa-check mr-1"></i> Tersalin!').removeClass('btn-outline-primary').addClass('btn-success');
                    setTimeout(function() {
                        $('#btnSalinVA').html('<i class="fa fa-copy mr-1"></i> Salin').removeClass('btn-success').addClass('btn-outline-primary');
                    }, 2000);
                });
            } else {
                var temp = $('<input>');
                $('body').append(temp);
                temp.val(noVa).select();
                document.execCommand('copy');
                temp.remove();
                $('#btnSalinVA').html('<i class="fa fa-check mr-1"></i> Tersalin!').removeClass('btn-outline-primary').addClass('btn-success');
                setTimeout(function() {
                    $('#btnSalinVA').html('<i class="fa fa-copy mr-1"></i> Salin').removeClass('btn-success').addClass('btn-outline-primary');
                }, 2000);
            }
        }

        function muatUlangTagihan() {
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
                    var processedData = result.map(function(item) {
                        item.kode = item.id_tagihan;
                        item.tahun_semester = item.tahun + ' ' + (item.semester == '1' ? 'Ganjil' : 'Genap');
                        return item;
                    });
                    
                    if (window.tagihanTableInstance) {
                        window.tagihanTableInstance.clear().rows.add(processedData).draw();
                        
                        window.tagihanTableInstance.rows().every(function() {
                            var data = this.data();
                            if (data.status != '0') {
                                this.nodes().to$().addClass('no-select');
                                this.nodes().to$().find('td:first-child').css('pointer-events', 'none').css('opacity', '0.5');
                            }
                        });
                        
                        window.tagihanTableInstance.rows().deselect();
                    }
                    if (window.updateSelectedItemsFn) {
                        window.updateSelectedItemsFn();
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error reloading data:', error);
                }
            });
        }
    </script>
@stop
