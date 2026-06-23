@extends('layout')

@section('css')
    <style>
        th,
        td {
            white-space: nowrap;
            vertical-align: middle !important;
        }
        .mhs-card {
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
            background: #fff;
            border: 1px solid rgba(0,0,0,0.08);
            margin-bottom: 25px;
            overflow: hidden;
        }
        .mhs-card-header {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: #fff;
            padding: 20px 25px;
            border-bottom: none;
        }
        .mhs-badge {
            font-size: 11px;
            font-weight: 600;
            padding: 4px 8px;
            border-radius: 6px;
            display: inline-flex;
            align-items: center;
        }
        .mhs-badge-nim {
            background-color: #f1f5f9;
            color: #475569;
            border: 1px solid #cbd5e1;
        }
        .mhs-badge-angkatan {
            background-color: #eff6ff;
            color: #1d4ed8;
            border: 1px solid #bfdbfe;
        }
        .action-btn {
            border-radius: 6px;
            padding: 5px 10px;
            font-size: 12px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s ease;
        }
        .action-btn:hover {
            transform: translateY(-1px);
        }
        .badge-success-light {
            background-color: #ecfdf5;
            color: #047857;
            border: 1px solid #a7f3d0;
        }
        .badge-primary-light {
            background-color: #f5f3ff;
            color: #6d28d9;
            border: 1px solid #ddd6fe;
        }
        .badge-secondary-light {
            background-color: #f8fafc;
            color: #64748b;
            border: 1px solid #e2e8f0;
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
                                <li class="breadcrumb-item active" aria-current="page">{{ $child_breadcrumb }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Main content -->
        <section class="content">
            <div class="box mhs-card">
                <div class="box-header with-border mhs-card-header">
                    <h4 class="box-title text-white" style="font-weight: 600;">Kelola Transkrip Nilai Mahasiswa</h4>
                    <p class="mb-0 text-white-50" style="font-size: 13px; margin-top: 5px;">Sinkronisasikan nilai KRS ke transkrip akademik dan lakukan pencetakan transkrip nilai mahasiswa.</p>
                </div>
                
                <!-- /.box-header -->
                <div class="box-body" style="padding: 25px;">
                    <div class="box bg-primary-light mb-4" style="border-left: 4px solid #1e3c72; border-radius: 4px; box-shadow: none;">
                        <div class="box-body ribbon-box">
                            <div class="ribbon ribbon-info" style="background-color: #1e3c72; border-radius: 3px 0px 0px 3px;">Program Studi Terkunci</div>
                            <p class="mb-0" style="font-weight: 500; color: #1e293b;">
                                Menampilkan khusus mahasiswa aktif dari program studi <strong id="lbl_nama_prodi">Loading...</strong> ({{ $session_kode_program_studi }}).
                            </p>
                        </div>
                    </div>

                    <div class="box-header no-border px-0 pt-0 mb-4">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group mb-0">
                                    <label class="font-weight-600 mb-1" style="font-size: 13px;">Pencarian NIM (Opsional)</label>
                                    <input type="text" name="nim_filter" id="nim_filter" class="form-control" placeholder="Masukkan NIM...">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group mb-0">
                                    <label class="font-weight-600 mb-1" style="font-size: 13px;">Tahun Angkatan</label>
                                    <select class="form-control" name="tahunangkatan" id="tahunangkatan">
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="table-responsive">
                        <input type="hidden" name="tahun" id="tahun" value="{{ $session_tahun }}">
                        <input type="hidden" name="semester" id="semester" value="{{ $session_semester }}">
                        <input type="hidden" name="programstudi" id="programstudi" value="{{ $session_kode_program_studi }}">
                        <input type="hidden" name="jabatan" id="jabatan" value="{{ $session_jabatan }}">
                        
                        <table id="kgttranskipnilai" class="table table-hover" width="100%">
                            <thead>
                                <tr class="bg-dark text-white">
                                    <th class="text-center" width="5%">No</th>
                                    <th width="35%">Mahasiswa</th>
                                    <th width="15%">Kelas / Jenjang</th>
                                    <th width="30%">Program Studi</th>
                                    <th class="text-center" width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>

            <!-- Modal Transkrip -->
            <div class="modal fade" id="modal_transkrip">
                <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header" style="background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%); color: white;">
                            <h4 class="modal-title" id="transkrip_title" style="font-weight: 600; color: white;">Transkrip Nilai Mahasiswa</h4>
                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" style="padding: 25px;">
                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <p class="mb-1" style="font-weight: 500; color: #64748b;">NIM / Nama Mahasiswa:</p>
                                    <h5 class="mb-0" id="lbl_mhs_info" style="font-weight: 700; color: #1e293b;">-</h5>
                                </div>
                                <div class="col-sm-6 text-sm-right mt-3 mt-sm-0">
                                    <div class="d-inline-block text-left" style="background-color: #f8fafc; padding: 10px 15px; border-radius: 8px; border: 1px solid #e2e8f0;">
                                        <span style="font-size: 13px; color: #64748b;">SKS Ditempuh: <b class="text-dark" id="totalsks">-</b></span><br>
                                        <span style="font-size: 13px; color: #64748b;">IPK: <b class="text-dark" id="nilai_ipk">-</b></span>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table id="tbkhs" class="table table-hover table-sm text-nowrap" width="100%">
                                    <thead class="bg-dark">
                                        <tr class="text-white">
                                            <th>No</th>
                                            <th>Semester</th>
                                            <th>Kode</th>
                                            <th>Matakuliah</th>
                                            <th class="text-center">SKS</th>
                                            <th class="text-center">Nilai</th>
                                            <th class="text-center">Bobot</th>
                                            <th class="text-center">Kum</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer text-right" style="background-color: #f8fafc;">
                            <button type="button" class="btn btn-rounded btn-warning btn-outline" data-dismiss="modal">
                                <i class="fa fa-times"></i> Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('script-master')
    <script type="text/javascript">
        var token = "{{ Session::get('token') }}";
        var userlogin = "{{ Session::get('username') }}";

        $(document).ready(function() {
            // Fetch prodi name dynamically via API
            var session_kode_prodi = "{{ $session_kode_program_studi }}";
            $.ajax({
                type: "POST",
                url: "{{ config('setting.second_url') }}akademik/dropdown-prodi",
                dataType: "json",
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                data: {},
                success: function(data) {
                    var prodiName = session_kode_prodi;
                    $.each(data, function(index, value) {
                        if (value.kode_program_studi == session_kode_prodi) {
                            prodiName = value.nama_program_studi;
                            return false;
                        }
                    });
                    $('#lbl_nama_prodi').text(prodiName);
                },
                error: function() {
                    $('#lbl_nama_prodi').text(session_kode_prodi);
                }
            });

            tahunangkatan();

            function tahunangkatan() {
                $.ajax({
                    type: 'GET',
                    url: "{{ config('setting.second_url') }}akademik/tampiltahunangkatan",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    success: function(result) {
                        var jml = result.length;
                        var s = '';
                        for (i = 0; i < jml; i++) {
                            s = s + '<option value="' + result[i].tahun_angkatan + '"> ' + result[i].tahun_angkatan + '</option>';
                        }
                        $('#tahunangkatan').html(s);
                        var thnn = $('#tahunangkatan').val();
                        var prodi = $('#programstudi').val();
                        tbnilai(thnn, prodi);
                    }
                })
            }

            $('#tahunangkatan').on('change', function(event) {
                var thnn = $('#tahunangkatan').val();
                var prodi = $('#programstudi').val();
                tbnilai(thnn, prodi);
            });

            function tbnilai(thn, prodi) {
                var table = $("#kgttranskipnilai").DataTable({
                    destroy: true,
                    dom: 'l<br>Bfrtip',
                    buttons: [
                        'copy', 'csv', 'excel'
                    ],
                    pageLength: 50,
                    processing: true,
                    lengthChange: true,
                    ajax: {
                        type: "GET",
                        url: "{{ config('setting.second_url') }}akademik/transkipnilai",
                        headers: {
                            "Authorization": 'Bearer ' + token,
                            "username": userlogin
                        },
                        data: {
                            tahunangkatan: thn,
                            kode_prodi: prodi,
                            tahun: $('#tahun').val(),
                            semester: $('#semester').val()
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
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }
                        },
                        {
                            data: null,
                            render: function(data, type, row, meta) {
                                var nimStr = row.nim ? row.nim : '-';
                                return `
                                    <div class="d-flex flex-column">
                                        <span class="font-size-14 font-weight-700 text-dark">${row.nama_mahasiswa}</span>
                                        <div class="d-flex align-items-center mt-1">
                                            <span class="mhs-badge mhs-badge-nim"><i class="fa fa-id-card-o mr-1"></i>${nimStr}</span>
                                        </div>
                                    </div>
                                `;
                            }
                        },
                        {
                            data: null,
                            render: function(data, type, row, meta) {
                                var jenjang = row.nama_program_pendidikan ? row.nama_program_pendidikan : '-';
                                var smt = row.semester ? `Semester ${row.semester}` : '-';
                                return `
                                    <span class="badge badge-primary-light font-size-11" style="padding: 4px 8px; border-radius: 4px;">${jenjang}</span>
                                    <span class="badge badge-secondary-light font-size-11" style="padding: 4px 8px; border-radius: 4px; margin-left: 4px;">${smt}</span>
                                `;
                            }
                        },
                        {
                            data: 'nama_program_studi'
                        },
                        {
                            data: null,
                            className: 'text-center',
                            render: function(data, type, row, meta) {
                                return `
                                    <button type="button" class="btn btn-xs btn-info" onclick="lihat_transkrip('${row.nim}', '${row.nama_mahasiswa}')" title="Lihat Nilai">
                                        <i class="fa fa-eye"></i> Lihat Nilai
                                    </button>
                                `;
                            }
                        }
                    ],
                    order: []
                });
            }

            window.lihat_transkrip = function(nim, nama) {
                $('#lbl_mhs_info').text(nim + ' / ' + nama);
                $('#modal_transkrip').modal('show');
                
                var tbtranskrip = $("#tbkhs").DataTable({
                    destroy: true,
                    pageLength: 50,
                    processing: true,
                    lengthChange: false,
                    info: false,
                    paging: false,
                    searching: false,
                    ajax: {
                        type: "GET",
                        url: "{{ config('setting.second_url') }}mahasiswa/transkrip-nilai",
                        headers: {
                            "Authorization": 'Bearer ' + token,
                            "username": userlogin
                        },
                        data: {
                            nim: nim
                        },
                        dataSrc: function(json) {
                            return json;
                        }
                    },
                    columns: [
                        {
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
                            className: "text-center",
                            render: function(data, type, row, meta) {
                                return row.nilai ? row.nilai : '-';
                            }
                        },
                        {
                            data: 'mutu',
                            className: "text-center",
                            render: function(data, type, row, meta) {
                                return (row.mutu !== null && row.mutu !== undefined) ? parseFloat(row.mutu) : '-';
                            }
                        },
                        {
                            data: 'kum_sksmutu',
                            className: "text-center",
                            render: function(data, type, row, meta) {
                                if (row.kum_sksmutu !== null && row.kum_sksmutu !== undefined) {
                                    return parseFloat(row.kum_sksmutu).toFixed(1);
                                }
                                return '0.0';
                            }
                        }
                    ]
                });
                
                get_sks_ipk(nim);
            };

            function get_sks_ipk(nim) {
                $.ajax({
                    type: 'GET',
                    dataType: "json",
                    url: "{{ config('setting.second_url') }}mahasiswa/transkrip-nilai",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    data: {
                        nim: nim
                    },
                    success: function(data) {
                        var jml = data.length;
                        var totalsks = 0;
                        var total_nilai = 0;

                        for (var i = 0; i < jml; i++) {
                            totalsks += parseFloat(data[i].sks_matakuliah || 0);
                            total_nilai += parseFloat(data[i].kum_sksmutu || 0);
                        }

                        $('#totalsks').html(totalsks + ' SKS');
                        var ipkVal = totalsks > 0 ? (total_nilai / totalsks).toFixed(2) : '0.00';
                        $('#nilai_ipk').html(ipkVal);
                    },
                    error: function() {
                        $('#totalsks').html('-');
                        $('#nilai_ipk').html('-');
                    }
                });
            }
        });
    </script>
@stop
