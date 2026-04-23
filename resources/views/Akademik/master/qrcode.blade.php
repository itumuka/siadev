@extends('layout')

@section('content')
    <div class="container-full">
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">Data QR Code</h3>
                </div>

            </div>
        </div>
        <!-- Main content -->
        <section class="content">
            <div class="box">
                <div class="box-header with-border">
                    <h6 class="box-subtitle">Melihat Data QR Code</h6>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <div class="box">
                        <div class="box-body ribbon-box bg-primary-light">
                            <div class="ribbon ribbon-info">informasi</div>
                            <p class="mb-0">Berikut adalah data QR Code.</p>
                        </div> <!-- end box-body-->
                    </div>
                    <div class="d-flex justify-content-end mb-3">
                        <button id="generate-all-qr" class="btn btn-primary">Generate Semua QR</button>
                    </div>

                    <div class="table-responsive">
                        <table id="kgtdosen" class="table table-hover table-striped">
                            <thead class="bg-dark">
                                <tr>
                                    <th>No</th>
                                    <th>NIDN</th>
                                    <th>Nama</th>
                                    {{-- <th>Jenis</th> --}}
                                    <th>QR</th>
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
@endsection
@section('script-master')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var token = "{{ Session::get('token') }}";
            var userlogin = "{{ Session::get('username') }}";

            // Inisialisasi DataTable
            var table = $("#kgtdosen").DataTable({
                destroy: true,
                dom: 'l<br>Bfrtip',
                buttons: ['copy', 'csv', 'excel'],
                processing: true,
                lengthChange: true,
                ajax: {
                    type: "GET",
                    url: "{{ config('setting.second_url') }}akademik/qrdosen",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    dataSrc: function(json) {
                        return json;
                    }
                },
                columns: [{
                        data: 'id_dosen',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'nidn'
                    },
                    {
                        data: 'nama_dosen'
                    },
                    // {
                    //     data: 'jenis'
                    // },
                    {
                        data: null,
                        render: function(data, type, full, meta) {
                            return full.qrcode;
                        }
                    },
                ],
                order: []
            });

            // Event Listener untuk Generate Semua QR
            $('#generate-all-qr').on('click', function() {
                // Ambil semua data dari DataTable
                var allData = table.rows().data().toArray();

                if (allData.length === 0) {
                    showToastr('error', 'Tidak ada data dosen!', 'Pastikan data tersedia di tabel.');
                    return;
                }

                // Tampilkan loader (opsional)
                $('#generate-all-qr').prop('disabled', true).text('Generating...');

                // Array untuk menyimpan QR Code dalam bentuk data URL
                var qrDataArray = [];

                // Proses setiap data dosen untuk membuat QR Code
                allData.forEach((item, index) => {
                    const qrCanvas = document.createElement('canvas');
                    const qrCode = new QRCode(qrCanvas, {
                        text: item.nidn,
                        width: 100,
                        height: 100
                    });

                    // Tunggu hingga QR Code selesai dibuat
                    setTimeout(() => {
                        const qrDataUrl = qrCanvas.toDataURL();
                        qrDataArray.push({
                            id: item.id_dosen,
                            nidn: item.nidn,
                            qr_code: qrDataUrl
                        });

                        // Kirim ke backend setelah selesai proses semua QR
                        if (qrDataArray.length === allData.length) {
                            //console.log(qrDataArray);
                            $.ajax({
                                type: "POST",
                                url: "{{ config('setting.second_url') }}akademik/saveqrcode",
                                headers: {
                                    "Authorization": 'Bearer ' + token,
                                    "username": userlogin
                                },
                                data: {
                                    qr_data: qrDataArray
                                },
                                success: function(response) {
                                    if (response.success) {
                                        showToastr('success',
                                            'Semua QR Code berhasil disimpan!',
                                            response.success);
                                    } else {
                                        showToastr('error', 'Error!', response
                                            .error);
                                    }

                                    // Reset tombol
                                    $('#generate-all-qr').prop('disabled',
                                        false).text('Generate Semua QR');
                                },
                                error: function(xhr, status, error) {
                                    showToastr('error', 'Terjadi kesalahan!',
                                        error);

                                    // Reset tombol
                                    $('#generate-all-qr').prop('disabled',
                                        false).text('Generate Semua QR');
                                }
                            });
                        }
                    }, 100);
                });
            });
        });
    </script>
@stop
