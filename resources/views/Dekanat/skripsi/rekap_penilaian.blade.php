@extends('layout')

@section('css')
    <style>
        th, td {
            white-space: nowrap;
        }
        #tb_rekap_penilaian td:nth-child(4) {
            white-space: normal !important;
            word-break: break-word !important;
            word-wrap: break-word !important;
            min-width: 240px;
            max-width: 320px;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(12px);
            border-radius: 12px;
            border: 1px solid rgba(0, 0, 0, 0.08);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }
        .stat-card {
            border-radius: 10px;
            padding: 15px 20px;
            color: #fff;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }
        .badge-eval-ok {
            background-color: #28a745;
            color: #fff;
            font-size: 0.75rem;
            padding: 4px 7px;
            border-radius: 4px;
            font-weight: 600;
        }
        .badge-eval-wait {
            background-color: #dc3545;
            color: #fff;
            font-size: 0.75rem;
            padding: 4px 7px;
            border-radius: 4px;
            font-weight: 600;
        }
        .score-pill {
            font-weight: 700;
            font-size: 1.05rem;
            color: #2c3e50;
            background: #f1f3f5;
            padding: 4px 10px;
            border-radius: 6px;
            display: inline-block;
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
                                <li class="breadcrumb-item"><a href="#">{{ $parent_breadcrumb }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $child_breadcrumb }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <!-- Header Summary Widgets -->
            <div class="row mb-20">
                <div class="col-md-4">
                    <div class="stat-card bg-primary">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-uppercase font-weight-bold mb-5" style="opacity:0.85;">Total Ujian Sidang</h6>
                                <h2 id="widget_total" class="font-weight-bold mb-0">0</h2>
                            </div>
                            <div>
                                <i class="fa fa-graduation-cap fa-3x" style="opacity:0.4;"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card bg-success">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-uppercase font-weight-bold mb-5" style="opacity:0.85;">Final Penilaian 🟢</h6>
                                <h2 id="widget_final" class="font-weight-bold mb-0">0</h2>
                            </div>
                            <div>
                                <i class="fa fa-check-circle fa-3x" style="opacity:0.4;"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card bg-warning">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-uppercase font-weight-bold mb-5" style="opacity:0.85;">Belum Final 🟡</h6>
                                <h2 id="widget_belum" class="font-weight-bold mb-0">0</h2>
                            </div>
                            <div>
                                <i class="fa fa-hourglass-half fa-3x" style="opacity:0.4;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Table Box -->
            <div class="box glass-card">
                <div class="box-header with-border d-flex justify-content-between align-items-center flex-wrap">
                    <div>
                        <h4 class="box-title font-weight-bold text-dark"><i class="fa fa-list-alt text-primary mr-10"></i> Rekapitulasi Penilaian Akhir Ujian Skripsi</h4>
                        <h6 class="box-subtitle mb-0">Monitoring transparansi penginputan nilai dosen penguji (P1, P2, P3) dan penetapan Kaprodi per Fakultas.</h6>
                    </div>
                    <div class="mt-10 mt-md-0 d-flex align-items-center flex-wrap" style="gap: 10px;">
                        <div>
                            <select id="filter_prodi" class="form-control form-control-sm" style="min-width: 190px;">
                                <option value="">-- Semua Program Studi --</option>
                            </select>
                        </div>
                        <div>
                            <select id="filter_status_final" class="form-control form-control-sm" style="min-width: 170px;">
                                <option value="">-- Semua Status Final --</option>
                                <option value="final">Final Penilaian 🟢</option>
                                <option value="belum_final">Belum Final 🟡</option>
                            </select>
                        </div>
                        <button id="btn_export_excel" class="btn btn-success btn-sm font-weight-bold">
                            <i class="fa fa-file-excel-o mr-5"></i> Ekspor Excel (.xlsx)
                        </button>
                    </div>
                </div>

                <div class="box-body">
                    <div class="table-responsive">
                        <table id="tb_rekap_penilaian" class="table table-hover table-bordered table-sm" width="100%">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th class="text-center">NIM</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>Program Studi</th>
                                    <th>Judul Skripsi / TA</th>
                                    <th class="text-center">Luaran</th>
                                    <th class="text-center">Matriks Penilai (P1 / P2 / P3 / Kaprodi)</th>
                                    <th class="text-center">Nilai Akhir</th>
                                    <th class="text-center">Status Final</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Loaded dynamically via DataTables -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Modal Detail Rincian Nilai Indikator per Dosen -->
    <div class="modal fade" id="modal_detail_nilai" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden;">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title font-weight-bold"><i class="fa fa-bar-chart mr-10"></i> Rincian Nilai Indikator Ujian Skripsi</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-light" style="max-height: 80vh; overflow-y: auto;">
                    <!-- Info Mahasiswa Header Card -->
                    <div class="card card-body border-0 shadow-sm mb-20 bg-white">
                        <div class="row">
                            <div class="col-md-6 border-right">
                                <span class="text-muted text-uppercase font-weight-bold small">Mahasiswa</span>
                                <h5 id="detail_mhs_nama" class="font-weight-bold mb-1 text-primary"></h5>
                                <span id="detail_mhs_nim" class="font-weight-bold text-muted"></span> | <span id="detail_mhs_prodi" class="text-secondary font-weight-bold"></span>
                            </div>
                            <div class="col-md-6">
                                <span class="text-muted text-uppercase font-weight-bold small">Nilai Akhir Sidang</span>
                                <div class="d-flex align-items-center mt-1">
                                    <span id="detail_nilai_angka" class="score-pill mr-10"></span>
                                    <span id="detail_nilai_huruf" class="badge badge-success font-weight-bold px-10 py-5" style="font-size: 1rem;"></span>
                                </div>
                            </div>
                        </div>
                        <hr class="my-10">
                        <div>
                            <span class="text-muted small font-weight-bold">Judul Skripsi:</span>
                            <p id="detail_mhs_judul" class="mb-0 font-weight-bold text-dark" style="font-size: 0.95rem;"></p>
                        </div>
                    </div>

                    <!-- Container Dynamic Rubric Scores per Dosen -->
                    <div id="detail_scores_container">
                        <div class="text-center py-30">
                            <i class="fa fa-spinner fa-spin fa-2x text-primary"></i>
                            <p class="mt-10 mb-0 text-muted">Memuat rincian nilai indikator penguji...</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-white">
                    <button type="button" class="btn btn-secondary px-20" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script-master')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var token = "{{ $api_token }}";
            var userlogin = "{{ $session_username }}";
            var kode_fakultas = "{{ $session_kode_fakultas }}";
            var rawDataList = [];

            // Load Filter Prodi for this Faculty
            $.ajax({
                url: "{{ config('setting.second_url') }}skripsi/dekanat/prodi-list",
                type: "GET",
                data: { kode_fakultas: kode_fakultas },
                headers: { "Authorization": 'Bearer ' + token, "username": userlogin },
                success: function(res) {
                    var html = '<option value="">-- Semua Program Studi --</option>';
                    if (Array.isArray(res)) {
                        res.forEach(function(item) {
                            html += '<option value="' + item.kode_program_studi + '">' + item.kode_program_studi + ' - ' + item.nama_program_studi + '</option>';
                        });
                    }
                    $('#filter_prodi').html(html);
                }
            });

            // Register DataTables Custom Search Filter for Status Final
            $.fn.dataTable.ext.search.push(
                function(settings, data, dataIndex, rowData) {
                    var selectedStatus = $('#filter_status_final').val();
                    if (!selectedStatus) return true;
                    if (selectedStatus === 'final' && rowData.is_final) return true;
                    if (selectedStatus === 'belum_final' && !rowData.is_final) return true;
                    return false;
                }
            );

            // Initialize DataTables
            var table = $('#tb_rekap_penilaian').DataTable({
                destroy: true,
                processing: true,
                order: [],
                ajax: {
                    url: "{{ config('setting.second_url') }}skripsi/dekanat/rekap-penilaian",
                    type: "GET",
                    data: function(d) {
                        d.kode_fakultas = kode_fakultas;
                        d.kode_prodi = $('#filter_prodi').val();
                    },
                    headers: { "Authorization": 'Bearer ' + token, "username": userlogin },
                    dataSrc: function(json) {
                        rawDataList = json || [];
                        updateWidgets(rawDataList);
                        return rawDataList;
                    }
                },
                columns: [
                    { data: 'nim', className: 'text-center font-weight-bold' },
                    { data: 'nama_mahasiswa', className: 'font-weight-bold' },
                    { data: 'nama_program_studi' },
                    { data: 'judul' },
                    { 
                        data: 'target_luaran', 
                        className: 'text-center',
                        render: function(data) {
                            if (data && data !== 'buku_skripsi') {
                                return '<span class="badge badge-info font-weight-bold" title="Luaran OBE"><i class="fa fa-star mr-1"></i> OBE (' + data + ')</span>';
                            }
                            return '<span class="badge badge-secondary font-weight-bold" title="Buku Skripsi">Non-OBE</span>';
                        }
                    },
                    {
                        data: null,
                        className: 'text-center',
                        render: function(data, type, row) {
                            var p1 = row.penguji.p1;
                            var p2 = row.penguji.p2;
                            var p3 = row.penguji.p3;
                            var kap = row.penguji.kaprodi;

                            var p1_html = '<span class="' + (p1.evaluated ? 'badge-eval-ok' : 'badge-eval-wait') + '" data-toggle="tooltip" title="Penguji 1: ' + (p1.nama || '-') + '">P1: ' + (p1.evaluated ? '✓' : '✗') + '</span>';
                            var p2_html = p2.id ? '<span class="' + (p2.evaluated ? 'badge-eval-ok' : 'badge-eval-wait') + '" data-toggle="tooltip" title="Penguji 2: ' + (p2.nama || '-') + '">P2: ' + (p2.evaluated ? '✓' : '✗') + '</span>' : '';
                            var p3_html = p3.id ? '<span class="' + (p3.evaluated ? 'badge-eval-ok' : 'badge-eval-wait') + '" data-toggle="tooltip" title="Penguji 3: ' + (p3.nama || '-') + '">P3: ' + (p3.evaluated ? '✓' : '✗') + '</span>' : '';
                            var kap_html = '<span class="' + (kap.validated ? 'badge-eval-ok' : 'badge-eval-wait') + '" data-toggle="tooltip" title="Kaprodi Status">Kaprodi: ' + (kap.validated ? '✓' : '✗') + '</span>';

                            return '<div class="d-flex justify-content-center flex-wrap gap-1" style="gap: 4px;">' + p1_html + p2_html + p3_html + kap_html + '</div>';
                        }
                    },
                    {
                        data: null,
                        className: 'text-center',
                        render: function(data, type, row) {
                            if (row.nilai_angka && row.nilai_angka !== '-') {
                                return '<span class="score-pill">' + row.nilai_angka + '</span> <span class="badge badge-success font-weight-bold ml-1">' + row.nilai_huruf + '</span>';
                            }
                            return '<span class="text-muted">-</span>';
                        }
                    },
                    {
                        data: null,
                        className: 'text-center',
                        render: function(data, type, row) {
                            return '<span class="badge ' + row.status_badge_class + ' font-weight-bold px-10 py-5" style="font-size: 0.82rem;">' + row.status_badge + '</span>';
                        }
                    },
                    {
                        data: null,
                        className: 'text-center',
                        render: function(data, type, row) {
                            return '<button class="btn btn-xs btn-outline-primary btn-detail-nilai font-weight-bold" data-id="' + row.id_skripsi_ujian + '"><i class="fa fa-search mr-1"></i> Rincian</button>';
                        }
                    }
                ],
                drawCallback: function() {
                    $('[data-toggle="tooltip"]').tooltip();
                }
            });

            // Filter prodi & status final change events
            $('#filter_prodi').change(function() {
                table.ajax.reload();
            });

            $('#filter_status_final').change(function() {
                table.draw();
            });

            // Update Summary Widgets
            function updateWidgets(list) {
                var total = list.length;
                var finalCount = 0;
                var belumCount = 0;

                list.forEach(function(item) {
                    if (item.is_final) finalCount++;
                    else belumCount++;
                });

                $('#widget_total').text(total);
                $('#widget_final').text(finalCount);
                $('#widget_belum').text(belumCount);
            }

            // Click Detail Rincian Nilai
            $('#tb_rekap_penilaian').on('click', '.btn-detail-nilai', function() {
                var id_ujian = $(this).data('id');
                var rowData = rawDataList.find(item => item.id_skripsi_ujian == id_ujian);

                if (rowData) {
                    $('#detail_mhs_nama').text(rowData.nama_mahasiswa);
                    $('#detail_mhs_nim').text(rowData.nim);
                    $('#detail_mhs_prodi').text(rowData.nama_program_studi);
                    $('#detail_mhs_judul').text(rowData.judul);
                    $('#detail_nilai_angka').text('Skor: ' + rowData.nilai_angka);
                    $('#detail_nilai_huruf').text(rowData.nilai_huruf);
                }

                $('#detail_scores_container').html('<div class="text-center py-30"><i class="fa fa-spinner fa-spin fa-2x text-primary"></i><p class="mt-10 mb-0 text-muted">Memuat rincian nilai indikator penguji...</p></div>');
                $('#modal_detail_nilai').modal('show');

                $.ajax({
                    url: "{{ config('setting.second_url') }}skripsi/dekanat/detail-penilaian/" + id_ujian,
                    type: "GET",
                    headers: { "Authorization": 'Bearer ' + token, "username": userlogin },
                    success: function(res) {
                        if (!res.scores || res.scores.length === 0) {
                            $('#detail_scores_container').html('<div class="alert alert-warning text-center my-20"><i class="fa fa-info-circle mr-2"></i> Belum ada penginputan indikator nilai dari tim dosen penguji.</div>');
                            return;
                        }

                        var html = '';
                        res.scores.forEach(function(dosen, idx) {
                            html += '<div class="box box-bordered border-primary mb-20" style="border-radius: 8px; overflow: hidden;">';
                            html += '  <div class="box-header with-border bg-primary-light p-15 d-flex justify-content-between align-items-center">';
                            html += '    <h5 class="box-title font-weight-bold text-primary mb-0"><i class="fa fa-user-md mr-2"></i> Dosen Penguji ' + (idx + 1) + ': ' + dosen.nama_dosen + '</h5>';
                            html += '    <span class="badge badge-primary font-weight-bold px-10 py-5">Total Skor: ' + dosen.total_skor.toFixed(2) + '</span>';
                            html += '  </div>';
                            html += '  <div class="box-body p-0">';
                            html += '    <table class="table table-sm table-striped mb-0">';
                            html += '      <thead class="bg-light">';
                            html += '        <tr>';
                            html += '          <th>Indikator Assessment</th>';
                            html += '          <th>Aspek</th>';
                            html += '          <th class="text-center">Bobot</th>';
                            html += '          <th class="text-center">Nilai Input</th>';
                            html += '          <th class="text-center">Skor Terbobot</th>';
                            html += '        </tr>';
                            html += '      </thead>';
                            html += '      <tbody>';

                            dosen.indikator.forEach(function(ind) {
                                html += '      <tr>';
                                html += '        <td class="font-weight-600">' + ind.nama_indikator + '</td>';
                                html += '        <td><span class="badge badge-secondary">' + ind.aspek + '</span></td>';
                                html += '        <td class="text-center">' + ind.bobot + '%</td>';
                                html += '        <td class="text-center font-weight-bold text-dark">' + ind.nilai + '</td>';
                                html += '        <td class="text-center font-weight-bold text-primary">' + ind.skor_terbobot + '</td>';
                                html += '      </tr>';
                            });

                            html += '      </tbody>';
                            html += '    </table>';
                            html += '  </div>';
                            html += '</div>';
                        });

                        $('#detail_scores_container').html(html);
                    },
                    error: function() {
                        $('#detail_scores_container').html('<div class="alert alert-danger text-center my-20">Gagal memuat detail nilai dari server.</div>');
                    }
                });
            });

            // Export Excel (.xlsx) Custom Handler (Filtered Data, No Status Evaluasi & No Status Final)
            $('#btn_export_excel').click(function() {
                var filteredData = table.rows({ search: 'applied' }).data().toArray();

                if (!filteredData || filteredData.length === 0) {
                    Swal.fire('Informasi', 'Tidak ada data yang sesuai dengan filter untuk diekspor', 'info');
                    return;
                }

                var excelContent = '<table border="1">';
                excelContent += '<thead>';
                excelContent += '<tr style="background-color: #1b4332; color: #ffffff; font-weight: bold;">';
                excelContent += '<th>No</th>';
                excelContent += '<th>NIM</th>';
                excelContent += '<th>Nama Mahasiswa</th>';
                excelContent += '<th>Program Studi</th>';
                excelContent += '<th>Judul Skripsi / Tugas Akhir</th>';
                excelContent += '<th>Luaran</th>';
                excelContent += '<th>Penguji 1</th>';
                excelContent += '<th>Penguji 2</th>';
                excelContent += '<th>Penguji 3</th>';
                excelContent += '<th>Nilai Angka</th>';
                excelContent += '<th>Nilai Huruf</th>';
                excelContent += '</tr>';
                excelContent += '</thead>';
                excelContent += '<tbody>';

                filteredData.forEach(function(row, index) {
                    var p1 = row.penguji.p1;
                    var p2 = row.penguji.p2;
                    var p3 = row.penguji.p3;

                    excelContent += '<tr>';
                    excelContent += '<td style="text-align: center;">' + (index + 1) + '</td>';
                    excelContent += '<td style="text-align: center;">' + row.nim + '</td>';
                    excelContent += '<td>' + row.nama_mahasiswa + '</td>';
                    excelContent += '<td>' + row.nama_program_studi + '</td>';
                    excelContent += '<td>' + row.judul + '</td>';
                    excelContent += '<td>' + row.target_luaran + '</td>';
                    excelContent += '<td>' + (p1.nama || '-') + '</td>';
                    excelContent += '<td>' + (p2.nama || '-') + '</td>';
                    excelContent += '<td>' + (p3.nama || '-') + '</td>';
                    excelContent += '<td style="text-align: center;">' + row.nilai_angka + '</td>';
                    excelContent += '<td style="text-align: center;">' + row.nilai_huruf + '</td>';
                    excelContent += '</tr>';
                });

                excelContent += '</tbody></table>';

                var blob = new Blob(['\ufeff' + excelContent], { type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' });
                var url = URL.createObjectURL(blob);
                var a = document.createElement('a');
                a.href = url;
                a.download = 'Rekap_Penilaian_Akhir_Skripsi_Fakultas_' + kode_fakultas + '.xlsx';
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
            });
        });
    </script>
@endsection
