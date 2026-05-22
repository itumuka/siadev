@extends('layout')

@section('css')
    <style>
        th, td {
            white-space: nowrap;
        }
        .grade-highlight {
            font-size: 2.2rem;
            font-weight: 800;
            color: #28a745;
        }
        .score-highlight {
            font-size: 2.2rem;
            font-weight: 800;
            color: #007bff;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            border-radius: 8px;
            border: 1px solid rgba(0, 0, 0, 0.08);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
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
                                <li class="breadcrumb-item"><a href="{{ route('dosen.skripsi.index') }}">{{ $parent_breadcrumb }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $child_breadcrumb }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="box glass-card">
                <div class="box-header with-border">
                    <h4 class="box-title">Daftar Sidang & Pertanggungjawaban Luaran</h4>
                    <h6 class="box-subtitle">Pilih mahasiswa di bawah ini untuk menginput nilai sidang / memverifikasi pertanggungjawaban luaran.</h6>
                </div>

                <div class="box-body">
                    <div class="box-body ribbon-box bg-light mb-4">
                        <div class="ribbon ribbon-info">Kebijakan Akademik</div>
                        <p class="mb-0 text-dark font-weight-medium">
                            <i class="fa fa-info-circle text-info"></i> Jalur <strong>OBE (Luaran)</strong> dinilai melalui <strong>Pertanggungjawaban Luaran</strong> oleh <strong>Tim Verifikator</strong>. Jalur <strong>Non-OBE</strong> dinilai melalui <strong>Ujian Pendadaran</strong> oleh <strong>Tim Penguji</strong>. Kata/istilah disesuaikan secara dinamis untuk kenyamanan administrasi prodi.
                        </p>
                    </div>

                    <input class="form-control" type="hidden" name="id_dosen" id="id_dosen" value="{{ $session_id_dosen }}">

                    <div class="table-responsive">
                        <table id="tb_mahasiswa_diuji" class="table table-hover table-bordered table-sm" width="100%">
                            <thead class="bg-dark">
                                <tr>
                                    <th>NIM</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>Program Studi</th>
                                    <th>Judul Skripsi / Luaran</th>
                                    <th class="text-center">Jalur</th>
                                    <th>Peran Anda</th>
                                    <th class="text-center">Nilai Ujian</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Loaded dynamically via DataTable -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Modal Input Penilaian / Verifikasi Luaran -->
    <div class="modal fade" id="modal_nilai_ujian" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title font-weight-bold" id="modal_title_text">Penilaian Ujian Skripsi / Verifikasi Luaran</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_nilai_ujian">
                    <div class="modal-body bg-light">
                        <!-- Info Mahasiswa Header Card -->
                        <div class="card card-body border-0 shadow-sm mb-4">
                            <div class="row">
                                <div class="col-md-3 border-right">
                                    <span class="text-muted text-uppercase font-weight-bold small">Mahasiswa</span>
                                    <h5 id="n_mhs_nama" class="font-weight-bold mb-1 text-primary"></h5>
                                    <span id="n_mhs_nim" class="font-weight-bold text-muted"></span>
                                </div>
                                <div class="col-md-6 border-right">
                                    <span class="text-muted text-uppercase font-weight-bold small">Judul Skripsi / Luaran</span>
                                    <p id="n_mhs_judul" class="font-italic text-dark mb-0"></p>
                                </div>
                                <div class="col-md-3">
                                    <span class="text-muted text-uppercase font-weight-bold small">Jalur & Peran Anda</span>
                                    <div><span id="n_mhs_jalur" class="badge font-weight-bold px-2 py-1 mt-1"></span></div>
                                    <div class="font-weight-bold text-dark mt-1" id="n_mhs_peran"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Main Rubrics & Real-time Calculator Layout -->
                        <div class="row">
                            <!-- Left: Rubric input fields -->
                            <div class="col-lg-8">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-header bg-white font-weight-bold text-dark">
                                        <i class="fa fa-list-ol text-primary"></i> <span id="rubrik_panel_title">Kriteria Penilaian / Rubrik CPMK</span>
                                    </div>
                                    <div class="card-body">
                                        <input type="hidden" name="id_skripsi" id="n_id_skripsi">
                                        <input type="hidden" name="id_skripsi_ujian" id="n_id_skripsi_ujian">
                                        <input type="hidden" name="id_dosen" value="{{ $session_id_dosen }}">
                                        
                                        <div id="rubrik_inputs_container">
                                            <!-- Dynamically generated list of CPMK inputs -->
                                            <div class="text-center py-4">
                                                <div class="spinner-border text-primary" role="status"></div>
                                                <p class="mt-2 text-muted">Memuat rubrik penilaian...</p>
                                            </div>
                                        </div>

                                        <hr class="my-4">

                                        <!-- Catatan -->
                                        <div class="form-group">
                                            <label class="font-weight-bold text-dark" id="lbl_catatan">Catatan / Rekomendasi Ujian</label>
                                            <textarea name="catatan" id="n_catatan" rows="4" class="form-control border-secondary" placeholder="Tuliskan catatan perbaikan atau rekomendasi kelulusan jika ada..."></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Right: Live Score Dashboard Card (Sticky Style) -->
                            <div class="col-lg-4">
                                <div class="card border-0 shadow-sm bg-white position-sticky" style="top: 20px;">
                                    <div class="card-header bg-primary text-white font-weight-bold text-center">
                                        <i class="fa fa-calculator"></i> Ringkasan Nilai Akhir
                                    </div>
                                    <div class="card-body text-center">
                                        <div class="mb-3">
                                            <span class="text-muted d-block small font-weight-bold text-uppercase">Nilai Kumulatif Anda</span>
                                            <div class="score-highlight" id="lbl_score_total">0.00</div>
                                        </div>
                                        <div class="mb-4">
                                            <span class="text-muted d-block small font-weight-bold text-uppercase">Nilai Huruf (Estimasi)</span>
                                            <div class="grade-highlight" id="lbl_grade_letter">-</div>
                                        </div>

                                        <div class="card bg-white border-warning text-left small mb-0 shadow-none">
                                            <div class="card-body p-3">
                                                <h6 class="font-weight-bold mb-2 text-warning"><i class="fa fa-info-circle"></i> Informasi Penilaian:</h6>
                                                <ul class="pl-3 mb-0 text-dark" style="line-height: 1.5; white-space: normal;">
                                                    <li class="mb-1">Nilai harus diisi dalam rentang <strong>0 - 100</strong>.</li>
                                                    <li class="mb-1">Nilai Akhir adalah rata-rata tertimbang bobot CPMK.</li>
                                                    <li>Nilai Huruf di atas dihitung berdasarkan standar konversi akademik universitas.</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-white border-top">
                        <button type="button" class="btn btn-secondary px-4" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success px-4" id="btn_submit_nilai"><i class="fa fa-save"></i> Simpan Nilai</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script-master')
    <script type="text/javascript">
        $(document).ready(function() {
            var token = "{{ $api_token }}";
            var userlogin = "{{ $session_username }}";
            var id_dosen = $('#id_dosen').val();
            var gradeRules = {};
            var currentStudentKodePenilaian = 1;

            // Format Helper
            function getRoleLabel(role, isObe) {
                if (isObe) {
                    if (role === 'penguji1') return 'Verifikator 1 (Utama)';
                    if (role === 'penguji2') return 'Verifikator 2';
                    if (role === 'ketua') return 'Ketua Tim Verifikasi';
                    return 'Tim Verifikator';
                } else {
                    if (role === 'penguji1') return 'Dosen Penguji 1';
                    if (role === 'penguji2') return 'Dosen Penguji 2';
                    if (role === 'ketua') return 'Ketua Penguji / Sidang';
                    return 'Dosen Penguji';
                }
            }

            // Grade Mapping Helper
            function calculateGradeLetter(score, kodePenilaian) {
                var kode = kodePenilaian || 1;
                var rules = gradeRules[kode] || gradeRules[1] || [];
                for (var i = 0; i < rules.length; i++) {
                    if (score >= rules[i].min) {
                        return rules[i].grade;
                    }
                }
                return 'E';
            }

            // Initialize Table
            var table = $("#tb_mahasiswa_diuji").DataTable({
                destroy: true,
                processing: true,
                serverSide: false,
                ajax: {
                    type: "GET",
                    url: "{{ $api_url }}dosen/skripsi/list-mahasiswa-diuji",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    data: { id_dosen: id_dosen },
                    dataSrc: function(json) {
                        if (json.grade_rules) {
                            gradeRules = json.grade_rules;
                        }
                        return json.data || [];
                    }
                },
                columns: [
                    { data: 'nim' },
                    { data: 'nama_mahasiswa' },
                    { data: 'nama_program_studi' },
                    { 
                        data: 'judul',
                        render: function(data, type, row) {
                            return '<strong title="' + (data || '') + '">' + 
                                   (data && data.length > 80 ? data.substring(0, 80) + '...' : (data || '-')) + 
                                   '</strong>';
                        }
                    },
                    { 
                        data: 'is_obe',
                        className: 'text-center',
                        render: function(data) {
                            if (data == 1) return '<span class="badge badge-success px-2 py-1"><i class="fa fa-graduation-cap"></i> OBE (Luaran)</span>';
                            return '<span class="badge badge-primary px-2 py-1"><i class="fa fa-file-text"></i> Non-OBE</span>';
                        }
                    },
                    { 
                        data: 'role_dosen',
                        render: function(data, type, row) {
                            return '<strong>' + getRoleLabel(data, row.is_obe == 1) + '</strong>';
                        }
                    },
                    { 
                        data: 'nilai_angka',
                        className: 'text-center',
                        render: function(data, type, row) {
                            if (data === null || data === undefined || data === '') {
                                return '<span class="text-danger font-weight-bold"><i class="fa fa-warning"></i> Belum Dinilai</span>';
                            }
                            let letter = calculateGradeLetter(parseFloat(data), row.kode_penilaian);
                            return '<span class="badge badge-success px-2 py-1 font-weight-bold" style="font-size:0.95rem;">' + parseFloat(data).toFixed(2) + ' (' + letter + ')</span>';
                        }
                    },
                    {
                        data: null,
                        className: 'text-center',
                        render: function(data, type, row) {
                            let isObe = row.is_obe == 1;
                            let btnText = isObe ? '<i class="fa fa-check-square-o"></i> Verifikasi Luaran' : '<i class="fa fa-pencil"></i> Input Nilai Sidang';
                            let btnClass = isObe ? 'btn-success' : 'btn-primary';
                            
                            // Base64 serialize student details
                            let b64 = btoa(unescape(encodeURIComponent(JSON.stringify(row))));
                            return '<button class="btn btn-sm ' + btnClass + ' btn-grade" data-row="' + b64 + '">' + btnText + '</button>';
                        }
                    }
                ],
                order: [[6, 'asc']] // Belum dinilai first
            });

            // Handle Input Click & Load Modal
            var currentRubrics = [];
            $('#tb_mahasiswa_diuji').on('click', '.btn-grade', function() {
                var student = JSON.parse(decodeURIComponent(escape(atob($(this).data('row')))));
                var isObe = student.is_obe == 1;
                currentStudentKodePenilaian = student.kode_penilaian || 1;
                
                // Populate student header
                $('#n_id_skripsi').val(student.id_skripsi);
                $('#n_id_skripsi_ujian').val(student.id_skripsi_ujian);
                $('#n_mhs_nama').text(student.nama_mahasiswa);
                $('#n_mhs_nim').text(student.nim);
                $('#n_mhs_judul').text(student.judul || 'Belum ada judul/luaran');
                $('#n_mhs_peran').text(getRoleLabel(student.role_dosen, isObe));
                
                // Dynamic labels depending on OBE status
                if (isObe) {
                    $('#modal_title_text').text('Pertanggungjawaban Luaran (Jalur OBE) - Verifikasi Tim Verifikator');
                    $('#n_mhs_jalur').text('OBE (LUARAN)').removeClass('badge-primary').addClass('badge-success');
                    $('#rubrik_panel_title').text('Kriteria Kelayakan & Capaian CPMK Luaran');
                    $('#lbl_catatan').text('Catatan Hasil Verifikasi & Pertanggungjawaban Luaran');
                    $('#n_catatan').attr('placeholder', 'Tuliskan catatan hasil verifikasi luaran, kesesuaian dengan CPL, atau rekomendasi perbaikan...');
                } else {
                    $('#modal_title_text').text('Sidang Pertanggungjawaban Skripsi - Penilaian Dosen Penguji');
                    $('#n_mhs_jalur').text('REGULER (NON-OBE)').removeClass('badge-success').addClass('badge-primary');
                    $('#rubrik_panel_title').text('Rubrik Penilaian Ujian (CPMK)');
                    $('#lbl_catatan').text('Catatan & Masukan Dosen Penguji');
                    $('#n_catatan').attr('placeholder', 'Tuliskan revisi, masukan, atau catatan khusus jalannya ujian sidang...');
                }

                // Reset summary
                $('#lbl_score_total').text('0.00');
                $('#lbl_grade_letter').text('-');
                $('#rubrik_inputs_container').html('<div class="text-center py-4"><div class="spinner-border text-primary" role="status"></div><p class="mt-2 text-muted">Memuat rubrik dan nilai...</p></div>');

                // Open modal
                $('#modal_nilai_ujian').modal('show');

                // Load rubrics first, then load existing scores
                $.ajax({
                    url: "{{ $api_url }}dosen/skripsi/get-rubrik-cpmk",
                    method: "GET",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    data: { kode_prodi: student.kode_prodi },
                    success: function(rubricRes) {
                        if (rubricRes.status === 'success') {
                            currentRubrics = rubricRes.data;
                            
                            // Load existing grades
                            $.ajax({
                                url: "{{ $api_url }}dosen/skripsi/get-nilai-ujian-cpmk",
                                method: "GET",
                                headers: {
                                    "Authorization": 'Bearer ' + token,
                                    "username": userlogin
                                },
                                data: { id_skripsi_ujian: student.id_skripsi_ujian, id_dosen: id_dosen },
                                success: function(nilaiRes) {
                                    var gradesMap = {};
                                    var existingCatatan = '';
                                    if (nilaiRes.status === 'success') {
                                        nilaiRes.data.forEach(function(n) {
                                            gradesMap[n.id_cpmk] = n.nilai;
                                        });
                                        existingCatatan = nilaiRes.catatan || '';
                                    }
                                    
                                    $('#n_catatan').val(existingCatatan);
                                    renderRubricInputs(currentRubrics, gradesMap);
                                }
                            });
                        } else {
                            $('#rubrik_inputs_container').html('<div class="alert alert-danger">Gagal memuat rubrik penilaian.</div>');
                        }
                    },
                    error: function() {
                        $('#rubrik_inputs_container').html('<div class="alert alert-danger">Koneksi API bermasalah.</div>');
                    }
                });
            });

            // Render Inputs dynamically
            function renderRubricInputs(rubrics, gradesMap) {
                var html = '';
                
                rubrics.forEach(function(r) {
                    var val = gradesMap[r.id] !== undefined ? gradesMap[r.id] : '';
                    var cplBadge = r.kode_cpl ? '<span class="badge badge-info-light font-weight-bold ml-2">Mapping CPL: ' + r.kode_cpl + '</span>' : '';
                    
                    html += `
                    <div class="form-group row align-items-center mb-3 py-2 border-bottom">
                        <div class="col-md-7">
                            <label class="font-weight-bold text-dark mb-0">
                                <span class="badge badge-secondary mr-2">${r.kode_cpmk}</span> 
                                ${r.nama_cpmk}
                            </label>
                            <div class="small text-muted mt-1">Bobot kriteria ini: <strong>${parseFloat(r.bobot)}%</strong> ${cplBadge}</div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group">
                                <input type="number" 
                                       name="nilai[${r.id}]" 
                                       class="form-control border-primary rubric-score-input" 
                                       data-id="${r.id}" 
                                       data-bobot="${r.bobot}" 
                                       min="0" 
                                       max="100" 
                                       step="0.01" 
                                       value="${val}" 
                                       placeholder="0-100" 
                                       required>
                                <div class="input-group-append">
                                    <span class="input-group-text bg-light font-weight-bold">/ 100</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 text-right">
                            <span class="small text-muted font-weight-bold">Skor Tertimbang:</span>
                            <div class="font-weight-bold text-dark text-right dynamic-weighted-score" id="weighted_score_${r.id}">0.00</div>
                        </div>
                    </div>`;
                });

                $('#rubrik_inputs_container').html(html);
                
                // Recalculate initially
                recalculateTotalScore();

                // Bind live update keyup/change
                $('.rubric-score-input').on('input change', function() {
                    var val = parseFloat($(this).val());
                    if (val > 100) $(this).val(100);
                    if (val < 0 || isNaN(val)) $(this).val('');
                    
                    recalculateTotalScore();
                });
            }

            // Recalculate Live Score & Letter Grade
            function recalculateTotalScore() {
                var total = 0;
                var totalBobotUsed = 0;
                var hasEmpty = false;

                $('.rubric-score-input').each(function() {
                    var id = $(this).data('id');
                    var bobot = parseFloat($(this).data('bobot'));
                    var val = parseFloat($(this).val());

                    if (!isNaN(val)) {
                        var weighted = (val * bobot) / 100;
                        $('#weighted_score_' + id).text(weighted.toFixed(2));
                        total += weighted;
                        totalBobotUsed += bobot;
                    } else {
                        $('#weighted_score_' + id).text('0.00');
                        hasEmpty = true;
                    }
                });

                // Display score
                $('#lbl_score_total').text(total.toFixed(2));
                
                // Live Grade Letter
                if (totalBobotUsed > 0 && !hasEmpty) {
                    var gradeLetter = calculateGradeLetter(total, currentStudentKodePenilaian);
                    $('#lbl_grade_letter').text(gradeLetter);
                } else {
                    $('#lbl_grade_letter').text('-');
                }
            }

            // Form Submit Value
            $('#form_nilai_ujian').on('submit', function(e) {
                e.preventDefault();
                var btn = $('#btn_submit_nilai');
                var id_skripsi_ujian = $('#n_id_skripsi_ujian').val();
                var catatan = $('#n_catatan').val();
                
                // Collect grades as key-value object
                var nilai = {};
                var allFilled = true;
                $('.rubric-score-input').each(function() {
                    var id_cpmk = $(this).data('id');
                    var val = $(this).val();
                    if (val === '' || isNaN(parseFloat(val))) {
                        allFilled = false;
                        return false;
                    }
                    nilai[id_cpmk] = parseFloat(val);
                });

                if (!allFilled) {
                    showToastr('warning', 'Peringatan', 'Harap isi semua nilai kriteria rubrik CPMK.');
                    return;
                }

                $.ajax({
                    url: "{{ $api_url }}dosen/skripsi/simpan-nilai-ujian-cpmk",
                    method: "POST",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    data: {
                        id_skripsi_ujian: id_skripsi_ujian,
                        id_dosen: id_dosen,
                        catatan: catatan,
                        nilai: nilai
                    },
                    beforeSend: function() {
                        btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan Nilai...');
                    },
                    success: function(res) {
                        if (res.status === 'success') {
                            showToastr('success', 'Berhasil', res.message);
                            $('#modal_nilai_ujian').modal('hide');
                            table.ajax.reload();
                        } else {
                            showToastr('error', 'Gagal', res.message || 'Gagal menyimpan nilai.');
                        }
                    },
                    error: function(err) {
                        showToastr('error', 'Gagal', err.responseJSON?.message || 'Kesalahan Server.');
                    },
                    complete: function() {
                        btn.prop('disabled', false).html('<i class="fa fa-save"></i> Simpan Nilai');
                    }
                });
            });
        });
    </script>
@endsection
