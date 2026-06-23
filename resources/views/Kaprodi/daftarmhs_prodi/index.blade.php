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
        .wa-btn {
            background-color: #25d366;
            color: white !important;
            border-radius: 6px;
            padding: 4px 10px;
            font-size: 12px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            text-decoration: none;
            transition: all 0.2s ease;
            border: none;
            box-shadow: 0 2px 4px rgba(37, 211, 102, 0.2);
        }
        .wa-btn:hover {
            background-color: #128c7e;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(18, 140, 126, 0.3);
        }
        .badge-success-light {
            background-color: #ecfdf5;
            color: #047857;
            border: 1px solid #a7f3d0;
        }
        .badge-danger-light {
            background-color: #fef2f2;
            color: #b91c1c;
            border: 1px solid #fecaca;
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
        .badge-info-light {
            background-color: #f0fdfa;
            color: #0f766e;
            border: 1px solid #99f6e4;
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
                    <h4 class="box-title text-white" style="font-weight: 600;">Daftar Mahasiswa Aktif Prodi</h4>
                    <p class="mb-0 text-white-50" style="font-size: 13px; margin-top: 5px;">Melihat seluruh daftar mahasiswa aktif di bawah naungan Program Studi Anda.</p>
                </div>
                
                <!-- /.box-header -->
                <div class="box-body" style="padding: 25px;">
                    <div class="box bg-primary-light mb-4" style="border-left: 4px solid #1e3c72; border-radius: 4px; box-shadow: none;">
                        <div class="box-body ribbon-box">
                            <div class="ribbon ribbon-info" style="background-color: #1e3c72; border-radius: 3px 0px 0px 3px;">Info Periode</div>
                            @php
                                $smstr = ($session_semester == '1') ? 'Ganjil' : 'Genap';
                            @endphp
                            <p class="mb-0" style="font-weight: 500; color: #1e293b;">
                                Menampilkan data mahasiswa aktif pada periode Tahun Akademik <strong>{{ $session_tahun }}/{{ $session_tahun + 1 }}</strong> Semester <strong>{{ $smstr }}</strong>.
                            </p>
                        </div>
                    </div>
                    
                    <div class="table-responsive">
                        <input type="hidden" name="tahun" id="tahun" value="{{ $session_tahun }}">
                        <input type="hidden" name="semester" id="semester" value="{{ $session_semester }}">
                        <input type="hidden" name="kode_program_studi" id="kode_program_studi" value="{{ $session_kode_program_studi }}">
                        <input type="hidden" name="jabatan" id="jabatan" value="{{ $session_jabatan }}">
                        
                        <table id="tbdaftarmhs_prodi" class="table table-hover" width="100%">
                            <thead>
                                <tr class="bg-dark text-white">
                                    <th class="text-center" width="5%">No</th>
                                    <th width="35%">Mahasiswa</th>
                                    <th width="20%">Kelas / Semester</th>
                                    <th width="20%">Dosen Wali</th>
                                    <th width="12%">Kontak &amp; Agama</th>
                                    <th class="text-center" width="8%">Status</th>
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
    <script type="text/javascript">
        $(document).ready(function() {
            var token = "{{ Session::get('token') }}";
            var userlogin = "{{ Session::get('username') }}";

            var kode_program_studi = $('#kode_program_studi').val();
            var tahun = $('#tahun').val();
            var semester = $('#semester').val();
            var jabatan = $('#jabatan').val();

            var table = $("#tbdaftarmhs_prodi").DataTable({
                destroy: true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel'
                ],
                pageLength: 50,
                processing: true,
                lengthChange: true,
                orderable: false,
                ajax: {
                    type: "GET",
                    url: "{{ config('setting.second_url') }}kaprodi/daftarmhs-prodi",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    data: {
                        tahun: tahun,
                        semester: semester,
                        kode_program_studi: kode_program_studi,
                        jabatan: jabatan
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
                            var angkatanStr = row.tahun_angkatan ? row.tahun_angkatan : '-';
                            return `
                                <div class="d-flex flex-column">
                                    <span class="font-size-15 font-weight-700 text-dark" style="letter-spacing: 0.2px;">${row.nama_mahasiswa}</span>
                                    <div class="d-flex align-items-center gap-2 mt-2">
                                        <span class="mhs-badge mhs-badge-nim" style="margin-right: 6px;"><i class="fa fa-id-card-o" style="margin-right: 4px;"></i>${nimStr}</span>
                                        <span class="mhs-badge mhs-badge-angkatan"><i class="fa fa-calendar" style="margin-right: 4px;"></i>Angkatan ${angkatanStr}</span>
                                    </div>
                                </div>
                            `;
                        }
                    },
                    {
                        data: null,
                        render: function(data, type, row, meta) {
                            var prodi = row.nama_program_studi ? row.nama_program_studi : '-';
                            var jenjang = row.nama_program_pendidikan ? row.nama_program_pendidikan : '';
                            var smt = row.semester ? `Semester ${row.semester}` : '-';
                            return `
                                <div class="d-flex flex-column">
                                    <span class="font-weight-600 text-dark" style="font-size: 13px;">${prodi}</span>
                                    <div class="mt-2">
                                        <span class="badge badge-primary-light font-size-11" style="padding: 3px 6px; border-radius: 4px;">${jenjang}</span>
                                        <span class="badge badge-secondary-light font-size-11" style="padding: 3px 6px; border-radius: 4px; margin-left: 4px;">${smt}</span>
                                    </div>
                                </div>
                            `;
                        }
                    },
                    {
                        data: null,
                        render: function(data, type, row, meta) {
                            return row.dosen_wali ? `<span class="font-weight-600 text-slate-700"><i class="fa fa-user-o text-muted" style="margin-right: 5px;"></i>${row.dosen_wali}</span>` : '<span class="text-muted">-</span>';
                        }
                    },
                    {
                        data: null,
                        render: function(data, type, row, meta) {
                            var agamaStr = row.nama_agama ? `<span class="badge badge-info-light font-size-11" style="padding: 3px 6px; border-radius: 4px; margin-bottom: 5px;">${row.nama_agama}</span>` : '';
                            var hpStr = row.no_hp ? row.no_hp : '';
                            var waBtn = '';
                            if (hpStr) {
                                var cleanHp = hpStr.replace(/\D/g, ''); // strip non-numeric
                                if (cleanHp.startsWith('0')) {
                                    cleanHp = '62' + cleanHp.substring(1);
                                }
                                waBtn = `
                                    <a href="https://wa.me/${cleanHp}" target="_blank" class="wa-btn">
                                        <i class="fa fa-whatsapp"></i> ${hpStr}
                                    </a>
                                `;
                            } else {
                                waBtn = '<span class="text-muted font-size-12">Tidak ada No. HP</span>';
                            }
                            return `
                                <div class="d-flex flex-column align-items-start">
                                    ${agamaStr}
                                    ${waBtn}
                                </div>
                            `;
                        }
                    },
                    {
                        data: null,
                        className: 'text-center',
                        render: function(data, type, row, meta) {
                            var krsClass = (row.status_krs == 'KRS') ? 'badge-success-light' : 'badge-danger-light';
                            var krsIcon = (row.status_krs == 'KRS') ? 'fa-check-circle' : 'fa-times-circle';
                            var krsText = row.status_krs;

                            var herClass = (row.cekher != null) ? 'badge-success-light' : 'badge-danger-light';
                            var herIcon = (row.cekher != null) ? 'fa-check-circle' : 'fa-times-circle';
                            var herText = (row.cekher != null) ? 'Herregistrasi' : 'Belum Her';

                            return `
                                <div class="d-flex flex-column align-items-center" style="gap: 5px;">
                                    <span class="badge ${krsClass} font-size-11" style="padding: 4px 8px; border-radius: 4px; display: inline-flex; align-items: center; width: 100px; justify-content: center;"><i class="fa ${krsIcon}" style="margin-right: 4px;"></i>${krsText}</span>
                                    <span class="badge ${herClass} font-size-11" style="padding: 4px 8px; border-radius: 4px; display: inline-flex; align-items: center; width: 100px; justify-content: center;"><i class="fa ${herIcon}" style="margin-right: 4px;"></i>${herText}</span>
                                </div>
                            `;
                        }
                    }
                ],
                order: []
            });
        });
    </script>
@stop
