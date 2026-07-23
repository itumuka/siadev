@extends('layout')

@section('css')
    <style>
        .dataTables_wrapper {
            font-family: tahoma;
            font-size: 0.75em;
            position: relative;
            clear: both;
            *zoom: 1;
            zoom: 1;
        }

        .sembunyi {
            display: none !important;
        }

        /* Modern Aesthetic KRS Alerts */
        .krs-alert-card {
            border-radius: 12px;
            padding: 20px 24px;
            margin-bottom: 25px;
            display: flex;
            align-items: flex-start;
            box-shadow: 0 4px 18px rgba(0, 0, 0, 0.04);
            border: 1px solid rgba(0, 0, 0, 0.05);
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            animation: krsAlertFadeIn 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
        
        .krs-alert-card:hover {
            box-shadow: 0 6px 24px rgba(0, 0, 0, 0.06);
            transform: translateY(-1px);
        }

        .krs-alert-warning {
            background: linear-gradient(135deg, #fffcf4 0%, #fff8e7 100%);
            border-left: 5px solid #ffb300;
        }

        .krs-alert-danger {
            background: linear-gradient(135deg, #fff5f5 0%, #ffe8e8 100%);
            border-left: 5px solid #e53935;
        }

        .krs-alert-icon-wrapper {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            margin-right: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.04);
        }

        .krs-alert-warning .krs-alert-icon-wrapper {
            background-color: #ffe082;
            color: #b78103;
        }

        .krs-alert-danger .krs-alert-icon-wrapper {
            background-color: #ffcdd2;
            color: #b71c1c;
        }

        .krs-alert-content {
            flex: 1;
        }

        .krs-alert-title {
            font-size: 1.15rem;
            font-weight: 700;
            margin-top: 0;
            margin-bottom: 6px;
            letter-spacing: 0.2px;
            font-family: 'Inter', 'Segoe UI', system-ui, -apple-system, sans-serif;
        }

        .krs-alert-warning .krs-alert-title {
            color: #8d6200;
        }

        .krs-alert-danger .krs-alert-title {
            color: #a81c1c;
        }

        .krs-alert-message {
            font-size: 0.95rem;
            line-height: 1.6;
            margin: 0;
            font-weight: 500;
            color: #555;
            font-family: 'Inter', 'Segoe UI', system-ui, -apple-system, sans-serif;
        }

        .krs-alert-warning .krs-alert-message {
            color: #6d4b00;
        }

        .krs-alert-danger .krs-alert-message {
            color: #7f1d1d;
        }

        @keyframes krsAlertFadeIn {
            from {
                opacity: 0;
                transform: translateY(12px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
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
            <div class="krs-alert-card krs-alert-warning sembunyi" id="blm_her">
                <div class="krs-alert-icon-wrapper">
                    <i class="fa fa-exclamation-triangle" style="font-size: 20px;"></i>
                </div>
                <div class="krs-alert-content">
                    <h4 class="krs-alert-title">Status Registrasi Belum Aktif</h4>
                    <p class="krs-alert-message">
                        Anda belum dapat melakukan pengisian Kartu Rencana Studi (KRS). Silakan lakukan pembayaran SPP Tetap dan selesaikan proses registrasi administratif (heregistrasi) terlebih dahulu.
                    </p>
                </div>
            </div>

            <div class="krs-alert-card krs-alert-warning sembunyi" id="not_yet">
                <div class="krs-alert-icon-wrapper">
                    <i class="fa fa-exclamation-triangle" style="font-size: 20px;"></i>
                </div>
                <div class="krs-alert-content">
                    <h4 class="krs-alert-title">Jadwal Pengisian Belum Dimulai</h4>
                    <p class="krs-alert-message">
                        Pengisian Kartu Rencana Studi (KRS) untuk Semester {{ $session_nama_tahunakademik }} belum dimulai. Jadwal pengisian akan dibuka sesuai dengan ketentuan waktu yang telah ditetapkan oleh fakultas.
                    </p>
                </div>
            </div>

            <div class="krs-alert-card krs-alert-danger sembunyi" id="lewat">
                <div class="krs-alert-icon-wrapper">
                    <i class="fa fa-exclamation-triangle" style="font-size: 20px;"></i>
                </div>
                <div class="krs-alert-content">
                    <h4 class="krs-alert-title">Batas Waktu Pengisian Telah Berakhir</h4>
                    <p class="krs-alert-message">
                        Batas akhir pengisian Kartu Rencana Studi (KRS) untuk Semester {{ $session_nama_tahunakademik }} telah terlampaui. Pengisian KRS secara mandiri sudah tidak dapat dilakukan.
                    </p>
                </div>
            </div>

            <div class="box sembunyi" id="bisa_krs">
                <div class="box-header with-border">
                    <h3 class="box-title"> Kartu Rencana Studi Semester {{ $session_nama_tahunakademik }}</h3>
                    {{-- <h6 class="box-subtitle">Melihat Data KHS</h6> --}}
                    <input class="form-control" type="hidden" name="kode_prodi" id="kode_prodi"
                        value="{{ $session_kode_prodi }}">
                    <input class="form-control" type="hidden" name="nim" id="nim" value="{{ $session_nim }}">
                    <input class="form-control" type="hidden" name="tahun" id="tahun" value="{{ $session_tahun }}">
                    <input class="form-control" type="hidden" name="semester" id="semester"
                        value="{{ $session_semester }}">
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="col-sm-6 no-print mb-0">
                        <h6 class="box-subtitle mb-3">Batas Pengambilan : <span class="text-danger font-weight-bold"
                                id="batassks"></span> </h6>
                    </div>
                    <div class="col-sm-6 no-print mb-0">
                        <h6 class="box-subtitle mb-3">Mengambil : <span class="text-danger font-weight-bold"
                                id="ambilsks"></span> </h6>
                    </div>
                    <div class="table-responsive">
                        <table id="tbambilkrs" class="table table-sm table-bordered table-striped" width="100%">
                            <thead class="bg-dark">
                                <tr>
                                    <th>Aksi</th>
                                    <th>Ket</th>
                                    {{-- <th>No</th> --}}
                                    <th>Kode</th>
                                    <th>Matakuliah</th>
                                    <th>SMT</th>
                                    <th>SKS</th>
                                    <th>Kelas</th>
                                    <th>Hari</th>
                                    <th>Jam</th>
                                    <th>Ruang</th>
                                    <th>Dosen</th>
                                    <th>Terisi</th>
                                    <th>Sisa</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="row" id="keterangan-nilai">
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
            
            var fullDate = new Date()
            // var twoDigitMonth = ((fullDate.getMonth().length + 1) === 1) ? (fullDate.getMonth() + 1) : '0' + (
            //     fullDate.getMonth() + 1);
            // var datenow = fullDate.getFullYear() + "-" + twoDigitMonth + "-" + fullDate.getDate();
            var twoDigitMonth = (fullDate.getMonth() + 1).toString().padStart(2, '0');
            var twoDigitDate = fullDate.getDate().toString().padStart(2, '0');
            var datenow = fullDate.getFullYear() + "-" + twoDigitMonth + "-" + twoDigitDate;

            var kode_prodi = $('#kode_prodi').val();
            var nim = $('#nim').val();
            var tahun = $('#tahun').val();
            var semester = $('#semester').val();
            var table;
            console.log(datenow);
            // function cek_kalender_krs(id) {
            
            function debounce(func, delay) {
                let timeout;
                return function() {
                    const context = this, args = arguments;
                    if (timeout) clearTimeout(timeout);
                    timeout = setTimeout(() => func.apply(context, args), delay);
                };
            }
            
            
            $.ajax({
                url: "{{ config('setting.second_url') }}mahasiswa/kalender-krs",
                method: "GET",
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                data: {
                    nim: nim,
                    tahun: tahun,
                    semester: semester
                },
                dataType: 'json',
                success: function(result) {
                    var tglmulai = result.kalendar.tanggal_mulai + " 00:00:00";
                    var tglakhir = result.kalendar.tanggal_akhir + " 23:59:59";
                    console.log(result.beasiswa);
                    if (result.her == null) {
                        $("#blm_her").removeClass("sembunyi");
                    } else {
                        // console.log(result);
                        if (result.her.id_heregistrasi == null) {
                            $("#blm_her").removeClass("sembunyi");
                        } else {
                            if (Date.parse(tglmulai) >= Date.now() && nim.trim() !== '00000000000000000000') {
                                $("#not_yet").removeClass("sembunyi");
                            } else {
                                if (Date.parse(tglakhir) <= Date.now() && nim.trim() !== '00000000000000000000') {
                                    $("#lewat").removeClass("sembunyi");
                                } else {
                                    table = $("#tbambilkrs").DataTable({
                                        destroy: true,
                                        pageLength: 100,
                                        processing: true,
                                        lengthChange: false,
                                        ajax: {
                                            type: "GET",
                                            url: "{{ config('setting.second_url') }}mahasiswa/ambil-krs",
                                            headers: {
                                                "Authorization": 'Bearer ' + token,
                                                "username": userlogin
                                            },
                                            data: {
                                                nim: nim,
                                                tahun: tahun,
                                                kode_prodi: kode_prodi,
                                                semester: semester
                                            },
                                            dataSrc: function (json) {
												// Ambil data kode_nilai dan batasambilsks
												var kodeNilai = json.kode_nilai;
												var batasSks = json.batasambilsks;

												// Update keterangan dan batas SKS di HTML
												updateKeterangan(kodeNilai);
												updateBatasSks(batasSks);
                                    
                                                // Kembalikan hanya array "makul" untuk DataTables
                                                return json.makul;
                                            },
                                        },
                                        columns: [{
                                                data: 'nilai',
                                                render: function(data, type, row, meta) {
                                                    if (row.statuskrs == "1") {
                                                        return '<button class="badge badge-pill badge-success" disabled>Sudah ACC</button>';
                                                    } else {

                                                        if (row.sisakuota < 1) {
                                                            disabledsisa = 'disabled';
                                                        } else {
                                                            disabledsisa = '';
                                                        }

                                                        if (row.cek_pilih > 0) {
                                                            disablepilih = 'disabled';
                                                            warnabutton = 'btn-primary';
                                                            fungsi = '';
                                                            btAmbil ='Berhasil'
                                                        } else {
                                                            // if (row.nilai == null) {
                                                            disablepilih = '';
                                                            fungsi = 'id="ambil"';
                                                            warnabutton = 'btn-primary';
                                                            btAmbil = 'Ambil';
                                                        }

                                                        return '<button class="btn btn-xs ' + warnabutton + '" ' + fungsi + ' ' + disabledsisa + ' ' + disablepilih + '>'+btAmbil+'</button>';
                                                    }

                                                }
                                            },
                                            {
                                                data: null,
                                                render: function(data, type, full, meta) {
                                                    const gradeColors = {
                                                        'A': 'badge-success', 'A-': 'badge-success', 'AB': 'badge-success',
                                                        'B+': 'badge-primary', 'B': 'badge-primary', 'BC': 'badge-primary', 'B-': 'badge-primary',
                                                        'C+': 'badge-info', 'C': 'badge-info', 'CD': 'badge-info', 'C-': 'badge-info',
                                                        'D+': 'badge-warning', 'DE': 'badge-warning', 'D': 'badge-warning',
                                                        'E': 'badge-danger'
                                                    };
                                                    
                                                    let nilai = full.na_huruf;
                                                    let badgeClass = gradeColors[nilai] || '';
                                                    
                                                    if (badgeClass) {
                                                        check_icon = `<a href="javascript:void(0)" class="badge badge-pill ${badgeClass}" data-toggle="tooltip" data-original-title="Edit" title="Sudah Pernah Ambil, Nilai: ${nilai}"> ${nilai} </a>`;
                                                        disable = "";
                                                    } else {
                                                        check_icon = '';
                                                    }
                                                
                                                    return check_icon;
                                                }
                                            },
                                            {
                                                data: 'kode_matakuliah'
                                            },
                                            {
                                                data: 'nama_matakuliah'
                                            },
                                            {
                                                data: 'smt_matakuliah'
                                            },
                                            {
                                                data: 'sks'
                                            },
                                            {
                                                data: 'nama_kelas'
                                            },
                                            {
                                                data: 'hari'
                                            },
                                            {
                                                data: 'jam'
                                            },
                                            {
                                                data: 'kode_ruang'
                                            },
                                            {
                                                data: 'dosen'
                                            },
                                            {
                                                data: 'jumlah_peserta'
                                            },
                                            {
                                                data: 'sisakuota'
                                            },
                                        ],
                                        order: [],
                                        "fnRowCallback": function(nRow, aData, iDisplayIndex,
                                            iDisplayIndexFull) {
                                            if (aData.cek_pilih > 0) {
                                                $('td', nRow).css('font-weight', 'bold');
                                            }
                                        }
                                    });

                                    table.on('click', '#ambil', debounce(function() {
                                        var button = $(this);
                                        var data = table.row(button.parents('tr')).data();
                                        var id_kelas = data['id_kelas'];
                                        var id_tawar = data['id_tawar'];
                                    
                                        button.prop('disabled', true).text('Processing...'); // Ubah teks tombol
                                    
                                        $.ajax({
                                            url: "{{ config('setting.second_url') }}mahasiswa/simpan-krs",
                                            method: "POST",
                                            headers: {
                                                "Authorization": 'Bearer ' + token,
                                                "username": userlogin
                                            },
                                            data: {
                                                id_kelas: id_kelas,
                                                id_tawar: id_tawar,
                                                nim: nim,
                                                tahun: tahun,
                                                kode_prodi: kode_prodi,
                                                semester: semester
                                            },
                                            dataType: "json",
                                            success: function(data) {
                                                if (data.success) {
                                                    showToastr('success', 'Success!', data.success);
                                                    button.text('Berhasil'); // Ubah teks tombol
                                                    table.ajax.reload(null, false); // Refresh tabel tanpa reset halaman
                                                } else {
                                                    showToastr('error', 'Error!', data.error);
                                                    button.prop('disabled', false).text('Ambil'); // Aktifkan kembali jika gagal
                                                    
                                                }
                                            },
                                            error: function() {
                                                button.prop('disabled', false).text('Ambil'); // Jika error, tombol bisa diklik lagi
                                            }
                                        });
                                    }, 1500)); // Klik hanya bisa dilakukan setelah 1.5 detik

                                    $("#bisa_krs").removeClass("sembunyi");
                                }
                            }
                        }
                    }
                }
            });


    // Fungsi untuk mengganti keterangan sesuai kode_nilai
    function updateKeterangan(kodeNilai) {
        var keteranganHTML = '';

            if (kodeNilai == 1) {
                keteranganHTML = `
                <div class="col-sm-12"><div class="p-2">Keterangan</div></div>
                <div class="col-sm-6">
                    <div class="d-flex flex-column">
                        <div class="p-2"><a href="javascript:void(0)" class="badge badge-pill badge-success">A</a> Sudah Pernah Ambil, Nilai: A</div>
                        <div class="p-2"><a href="javascript:void(0)" class="badge badge-pill badge-success">A-</a> Sudah Pernah Ambil, Nilai: A-</div>
                        <div class="p-2"><a href="javascript:void(0)" class="badge badge-pill badge-primary">B+</a> Sudah Pernah Ambil, Nilai: B+</div>
                        <div class="p-2"><a href="javascript:void(0)" class="badge badge-pill badge-primary">B</a> Sudah Pernah Ambil, Nilai: B</div>
                        <div class="p-2"><a href="javascript:void(0)" class="badge badge-pill badge-primary">B-</a> Sudah Pernah Ambil, Nilai: B-</div>
                        <div class="p-2"><a href="javascript:void(0)" class="badge badge-pill badge-info">C+</a> Sudah Pernah Ambil, Nilai: C+</div>
                        <div class="p-2"><a href="javascript:void(0)" class="badge badge-pill badge-info">C</a> Sudah Pernah Ambil, Nilai: C</div>
                        <div class="p-2"><a href="javascript:void(0)" class="badge badge-pill badge-info">C-</a> Sudah Pernah Ambil, Nilai: C-</div>
                        <div class="p-2"><a href="javascript:void(0)" class="badge badge-pill badge-warning">D+</a> Sudah Pernah Ambil, Nilai: D+</div>
                        <div class="p-2"><a href="javascript:void(0)" class="badge badge-pill badge-warning">D</a> Sudah Pernah Ambil, Nilai: D</div>
                        <div class="p-2"><a href="javascript:void(0)" class="badge badge-pill badge-danger">E</a> Sudah Pernah Ambil, Nilai: E</div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="d-flex flex-column">
                        <div class="p-2"><button class="btn btn-xs btn-primary"
                                title="Ambil Mata Kuliah">Ambil</button> Bisa Ambil Matakuliah</div>
                        <div class="p-2"><button class="btn btn-xs btn-default" data-toggle="tooltip" disabled
                                title="Tidak Bisa Ambil Mata Kuliah">Ambil</button> Tidak Bisa Ambil
                            Matakuliah</div>
                        <div class="p-2"><button class="badge badge-pill badge-success" data-toggle="tooltip"
                                disabled title="Sudah ACC">Sudah ACC</button> KRS anda sudah di ACC Dosen Wali
                        </div>
                    </div>
                </div>
                `;
            } else if (kodeNilai == 2) {
                keteranganHTML = `
                <div class="col-sm-12"><div class="p-2">Keterangan</div></div>
                <div class="col-sm-6">
                    <div class="d-flex flex-column">
                        <div class="p-2"><a href="javascript:void(0)" class="badge badge-pill badge-success">A</a> Sudah Pernah Ambil, Nilai: A</div>
                        <div class="p-2"><a href="javascript:void(0)" class="badge badge-pill badge-success">AB</a> Sudah Pernah Ambil, Nilai: AB</div>
                        <div class="p-2"><a href="javascript:void(0)" class="badge badge-pill badge-primary">B</a> Sudah Pernah Ambil, Nilai: B</div>
                        <div class="p-2"><a href="javascript:void(0)" class="badge badge-pill badge-primary">BC</a> Sudah Pernah Ambil, Nilai: BC</div>
                        <div class="p-2"><a href="javascript:void(0)" class="badge badge-pill badge-info">C</a> Sudah Pernah Ambil, Nilai: C</div>
                        <div class="p-2"><a href="javascript:void(0)" class="badge badge-pill badge-info">CD</a> Sudah Pernah Ambil, Nilai: CD</div>
                        <div class="p-2"><a href="javascript:void(0)" class="badge badge-pill badge-warning">D</a> Sudah Pernah Ambil, Nilai: D</div>
                        <div class="p-2"><a href="javascript:void(0)" class="badge badge-pill badge-warning">DE</a> Sudah Pernah Ambil, Nilai: DE</div>
                        <div class="p-2"><a href="javascript:void(0)" class="badge badge-pill badge-danger">E</a> Sudah Pernah Ambil, Nilai: E</div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="d-flex flex-column">
                        <div class="p-2"><button class="btn btn-xs btn-primary"
                                title="Ambil Mata Kuliah">Ambil</button> Bisa Ambil Matakuliah</div>
                        <div class="p-2"><button class="btn btn-xs btn-default" data-toggle="tooltip" disabled
                                title="Tidak Bisa Ambil Mata Kuliah">Ambil</button> Tidak Bisa Ambil
                            Matakuliah</div>
                        <div class="p-2"><button class="badge badge-pill badge-success" data-toggle="tooltip"
                                disabled title="Sudah ACC">Sudah ACC</button> KRS anda sudah di ACC Dosen Wali
                        </div>
                    </div>
                </div>
                `;
            }
    
            // Masukkan ke dalam div dengan ID "keterangan-nilai"
            $('#keterangan-nilai').html(keteranganHTML);
        }
        
        // Fungsi untuk update tampilan batas SKS
        function updateBatasSks(batasSks) {
            if (batasSks) {
                $("#batassks").html(batasSks.batas_sks+" sks");
                $("#ambilsks").html(batasSks.sks_ambil+" sks");
            } else {
                $("#batassks").html("-");
                $("#ambilsks").html("-");
            }
        }

            // bataskuota();

            // function bataskuota() {
            //     $.ajax({
            //         url: "{{ config('setting.second_url') }}mahasiswa/ambil-krs",
            //         method: "GET",
            //         headers: {
            //             "Authorization": 'Bearer ' + token,
            //             "username": userlogin
            //         },
            //         data: {
            //             nim: nim,
            //             tahun: tahun,
            //             kode_prodi: kode_prodi,
            //             semester: semester
            //         },
            //         dataSrc: "batasambilsks",
            //         success: function(data, status, xhr) {
            //             console.log(data.batasambilsks.batas_sks);
            //             $("#batassks").html(data.batasambilsks.batas_sks);
            //             $("#ambilsks").html(data.batasambilsks.sks_ambil);
            //         }
            //     });
            // };


        });
    </script>
@stop
