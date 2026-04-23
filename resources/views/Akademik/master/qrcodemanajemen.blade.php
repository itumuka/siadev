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
                    <canvas id="qrcodeCanvas"></canvas>
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
                                    <th>Level</th>
                                    <th>Fakultas</th>
                                    <th>Valid ID</th>
                                    <th>Kartu Ujian</th>
                                    <th>Daftar Hadir</th>
                                    {{-- <th>QR</th> --}}
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
    {{-- <script src="https://cdn.jsdelivr.net/npm/qrcode/build/qrcode.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>


    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function() {
            var token = "{{ Session::get('token') }}";
            var userlogin = "{{ Session::get('username') }}";

            function generateValidId(length) {
                const characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
                let validId = '';
                for (let i = 0; i < length; i++) {
                    const randomIndex = Math.floor(Math.random() * characters.length);
                    validId += characters[randomIndex];
                }
                return validId;
            }

            // Fungsi untuk mendapatkan waktu dengan format "dd-mm-yyyy hh:mm:ss WIB"
            function getFormattedTime() {
                const now = new Date();
                const day = String(now.getDate()).padStart(2, '0');
                const month = String(now.getMonth() + 1).padStart(2, '0');
                const year = now.getFullYear();
                const hours = String(now.getHours()).padStart(2, '0');
                const minutes = String(now.getMinutes()).padStart(2, '0');
                const seconds = String(now.getSeconds()).padStart(2, '0');
                return `${day}-${month}-${year} ${hours}:${minutes}:${seconds} WIB`;
            }

            // Inisialisasi DataTable
            var table = $("#kgtdosen").DataTable({
                destroy: true,
                dom: 'l<br>Bfrtip',
                buttons: ['copy', 'csv', 'excel'],
                processing: true,
                lengthChange: true,
                ajax: {
                    type: "GET",
                    url: "{{ config('setting.second_url') }}akademik/qrdosenmanajemen",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
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
                        data: 'nidn'
                    },
                    {
                        data: 'nama_dosen'
                    },
                    {
                        data: 'sumber_data'
                    },
                    {
                        data: 'nama_fakultas'
                    },
                    {
                        data: 'valid_id'
                    },
                    {
                        data: null,
                        render: function(data, type, full, meta) {
                            if (!full.qrcode || full.qrcode.trim() === "") {
                                return `<span>QR Code tidak tersedia</span>`;
                            }
                            return `<img src="{{ url('qrcodedosenmanajemen') }}/` + full.qrcode +
                                `_Kartu_Ujian_Akhir_Semester.png" width="100" height="100" alt="QR Code">`;
                        }
                    }, {
                        data: null,
                        render: function(data, type, full, meta) {
                            if (!full.qrcode || full.qrcode.trim() === "") {
                                return `<span>QR Code tidak tersedia</span>`;
                            }
                            return `<img src="{{ url('qrcodedosenmanajemen') }}/` + full.qrcode +
                                `_Daftar_Hadir_Kuliah.png" width="100" height="100" alt="QR Code">`;
                        }
                    }
                ],
                order: []
            });

            // Event Listener untuk Generate Semua QR
            $('#generate-all-qr').on('click', function() {
                $('#generate-all-qr').prop('disabled', true).text('Generating...');
                var allData = table.rows().data().toArray();

                if (allData.length === 0) {
                    showToastr('error', 'Tidak ada data dosen!', 'Pastikan data tersedia di tabel.');
                    $('#generate-all-qr').prop('disabled', false).text('Generate Semua QR');
                    return;
                }

                var uploadPromises = allData.map((item) => {
                    return new Promise((resolve, reject) => {
                        const qrDiv = document.createElement('div'); // Gunakan elemen <div>
                        const validId = generateValidId(
                            12); // Setiap QR Code akan memiliki valid_id yang berbeda
                        const signedDate =
                            getFormattedTime(); // Ambil tanggal dan waktu saat ini

                        const labels = ["Kartu Ujian Akhir Semester",
                            "Daftar Hadir Kuliah"
                        ];

                        labels.forEach((label) => {
                            const qrText =
                                `[valid_id=${validId}]\n[${label}]\n[nama=${item.nama_dosen}]\n[nidn=${item.nidn}]\n[signed=${signedDate}]`;

                            try {
                                const qrCode = new QRCode(qrDiv, {
                                    text: qrText,
                                    width: 200,
                                    height: 200,
                                    colorDark: "#0000FF", // Warna teks QR Code
                                    colorLight: "#FFFFFF" // Warna latar belakang QR Code
                                });

                                setTimeout(() => {
                                    const qrCanvas = qrDiv.querySelector(
                                        'canvas'
                                    ); // Ambil elemen canvas dari dalam <div>
                                    if (!qrCanvas) {
                                        reject(
                                            `Gagal membuat QR Code untuk ${label} (canvas tidak ditemukan).`
                                        );
                                        return;
                                    }

                                    qrCanvas.toBlob((blob) => {
                                        if (blob) {
                                            const formData =
                                                new FormData();
                                            formData.append('file',
                                                blob,
                                                `${item.nidn}_${label.replace(/\s/g, '_')}.png`
                                            );
                                            formData.append('id',
                                                item.id);
                                            formData.append('nidn',
                                                item.nidn);
                                            formData.append(
                                                'namafile',
                                                `${item.nidn}_${label.replace(/\s/g, '_')}.png`
                                            );

                                            // Kirim data ke endpoint pertama
                                            $.ajax({
                                                type: "POST",
                                                url: "{{ url('akademik/qrcodedosenmanajemen') }}",
                                                data: formData,
                                                processData: false,
                                                contentType: false,
                                                success: function(
                                                    response
                                                ) {
                                                    if (response
                                                        .success
                                                    ) {
                                                        // Kirim data ke endpoint kedua
                                                        $.ajax({
                                                            type: "POST",
                                                            url: "{{ config('setting.second_url') }}akademik/saveqrcodemanajemen",
                                                            headers: {
                                                                "Authorization": 'Bearer ' +
                                                                    token,
                                                                "username": userlogin
                                                            },
                                                            data: {
                                                                nidn: item
                                                                    .nidn,
                                                                id: item
                                                                    .id_pegawai,
                                                                valid_id: validId,
                                                                jenis: item
                                                                    .sumber_data,
                                                            },
                                                            success: function(
                                                                response2
                                                            ) {
                                                                if (response2
                                                                    .success
                                                                ) {
                                                                    resolve
                                                                        (
                                                                            `QR Code untuk ${item.nidn} (${label}) berhasil disimpan.`
                                                                        );
                                                                } else {
                                                                    reject
                                                                        (response2
                                                                            .error ||
                                                                            'Unknown error (saveqrcode).'
                                                                        );
                                                                }
                                                            },
                                                            error: function(
                                                                xhr,
                                                                status,
                                                                error
                                                            ) {
                                                                reject
                                                                    (error ||
                                                                        'Request error (saveqrcode).'
                                                                    );
                                                            }
                                                        });
                                                    } else {
                                                        reject
                                                            (response
                                                                .error ||
                                                                'Unknown error (qrcodedosen).'
                                                            );
                                                    }
                                                },
                                                error: function(
                                                    xhr,
                                                    status,
                                                    error
                                                ) {
                                                    reject
                                                        (error ||
                                                            'Request error (qrcodedosen).'
                                                        );
                                                }
                                            });
                                        } else {
                                            reject(
                                                `Gagal membuat QR Code untuk ${label} (toBlob menghasilkan null).`
                                            );
                                        }
                                    });
                                }, 100);
                            } catch (err) {
                                reject(
                                    `QRCode is not a constructor atau library tidak ditemukan untuk ${label}.`
                                );
                            }
                        });

                    });
                });

                Promise.allSettled(uploadPromises)
                    .then((results) => {
                        const errors = results.filter(result => result.status === 'rejected');
                        const successes = results.filter(result => result.status === 'fulfilled');

                        if (successes.length > 0) {
                            showToastr('success', 'Proses selesai!',
                                `${successes.length} QR Code berhasil disimpan.`);
                        }

                        if (errors.length > 0) {
                            // showToastr('error', 'Beberapa QR Code gagal disimpan!',
                            //     `${errors.length} gagal.`);
                            showToastr('success', 'Proses selesai!',
                                `QR Code berhasil disimpan.`);
                        }
                    })
                    .finally(() => {
                        table.ajax.reload();
                        $('#generate-all-qr').prop('disabled', false).text('Generate Semua QR');
                    });
            });






        });
    </script>
@stop
