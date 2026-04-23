@extends('layout')
@section('css')
<style>
    /* Premium Aesthetic Wizard CSS */
    .wizard-steps { display: flex; justify-content: space-between; margin-bottom: 40px; position: relative;}
    .wizard-steps::before { content: ""; position: absolute; top: 20px; left: 0; width: 100%; height: 4px; background: #e9ecef; z-index: 1;}
    .wizard-step { position: relative; z-index: 2; text-align: center; flex: 1;}
    .wizard-step-circle { width: 45px; height: 45px; border-radius: 50%; background: #e9ecef; color: #6c757d; line-height: 45px; margin: 0 auto; font-weight: bold; font-size: 18px; transition: all 0.3s ease; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
    .wizard-step.active .wizard-step-circle { background: #0066cc; color: #fff; transform: scale(1.1); box-shadow: 0 4px 15px rgba(0, 102, 204, 0.4);}
    .wizard-step.completed .wizard-step-circle { background: #28a745; color: #fff; }
    .wizard-step-label { margin-top: 12px; font-weight: 600; font-size: 14px; color: #495057; }
    
    .wizard-content { display: none; }
    .wizard-content.active { display: block; animation: slideUp 0.6s cubic-bezier(0.165, 0.84, 0.44, 1); }
    
    @keyframes slideUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    
    .glassmorphism { background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(14px); border: 1px solid rgba(255,255,255,0.5); border-radius: 16px; padding: 30px; box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.05); }
    .drag-drop-zone { border: 2px dashed #0066cc; border-radius: 10px; padding: 40px; text-align: center; background: #f8faff; cursor: pointer; transition: background 0.3s; }
    .drag-drop-zone:hover { background: #eef4ff; }
</style>
@endsection

@section('content')
<div class="container-full">
    <section class="content">
        <div class="box glassmorphism border-0">
            <div class="box-header no-border pb-0">
                <h3 class="box-title mb-30" style="font-weight: 700; color: #2c3e50;">Pendaftaran Seminar Proposal</h3>
            </div>
            <div class="box-body pt-0">
                <div class="wizard-steps px-20">
                    <div class="wizard-step active" id="step-1-indicator">
                        <div class="wizard-step-circle"><i class="fa fa-list-alt"></i></div>
                        <div class="wizard-step-label">Cek Syarat</div>
                    </div>
                    <div class="wizard-step" id="step-2-indicator">
                        <div class="wizard-step-circle">2</div>
                        <div class="wizard-step-label">Data Proposal</div>
                    </div>
                    <div class="wizard-step" id="step-3-indicator">
                        <div class="wizard-step-circle">3</div>
                        <div class="wizard-step-label">Upload Dokumen</div>
                    </div>
                    <div class="wizard-step" id="step-4-indicator">
                        <div class="wizard-step-circle"><i class="fa fa-check"></i></div>
                        <div class="wizard-step-label">Review Akhir</div>
                    </div>
                </div>

                <div class="wizard-stages px-20">
                    <!-- Step 1 -->
                    <div class="wizard-content active" id="step-1">
                        <h4 class="mb-20">Verifikasi Syarat Akademik</h4>
                        <div id="verification-container">
                            <div class="text-center py-20">
                                <i class="fa fa-spinner fa-spin fa-2x text-primary"></i>
                                <p class="mt-10">Memeriksa data akademik Anda...</p>
                            </div>
                        </div>
                        <div class="text-right mt-30">
                            <button id="next-step-btn" class="btn btn-primary d-inline-flex align-items-center next-step px-30 py-10" data-target="#step-2" disabled>
                                Selanjutnya <i class="fa fa-arrow-right ml-10"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="wizard-content" id="step-2">
                        <h4 class="mb-20">Rencana Proposal</h4>
                        <form id="proposal-form">
                            <div class="form-group mb-20">
                                <label class="font-weight-600">Judul Proposal Ujian Akhir <span class="text-danger">*</span></label>
                                <input type="text" id="judul-proposal" name="judul" class="form-control" style="height: 50px;" placeholder="Masukkan judul penelitian Anda di sini..." required>
                                <small class="text-muted">Judul akan digunakan untuk surat resmi universitas</small>
                            </div>
                            <div class="form-group mb-20">
                                <label class="font-weight-600">Usulan Dosen Pembimbing <span class="text-danger">*</span></label>
                                <select id="dosen-pembimbing" name="dosen_pembimbing" class="form-control" style="height: 50px;" required>
                                    <option value="">-- Pilih Usulan Dosen --</option>
                                    <option disabled><i class="fa fa-spinner fa-spin"></i> Memuat data dosen...</option>
                                </select>
                                <small class="text-muted">Pilih dosen yang sesuai dengan topik penelitian Anda</small>
                            </div>
                            <div class="d-flex justify-content-between mt-30">
                                <button type="button" class="btn btn-outline-secondary prev-step px-30 py-10" data-target="#step-1"><i class="fa fa-arrow-left mr-10"></i> Kembali</button>
                                <button type="button" id="save-proposal-btn" class="btn btn-primary next-step px-30 py-10" data-target="#step-3">Selanjutnya <i class="fa fa-arrow-right ml-10"></i></button>
                            </div>
                        </form>
                    </div>

                    <!-- Step 3 -->
                    <div class="wizard-content" id="step-3">
                        <h4 class="mb-20">Unggah Dokumen Syarat</h4>
                        <div class="form-group mb-30">
                            <label class="font-weight-600">Format Proposal Lengkap (PDF) <span class="text-danger">*</span></label>
                            <div class="drag-drop-zone mt-10" id="dropZone">
                                <i class="fa fa-cloud-upload fa-4x text-primary mb-10" id="uploadIcon"></i>
                                <h5 id="uploadText">Seret & Lepas file Anda di sini</h5>
                                <p class="text-muted" id="uploadSubtext">Atau klik untuk mencari file</p>
                                <input type="file" style="display:none;" id="fileInput" accept=".pdf">
                                <button type="button" class="btn btn-sm btn-primary mt-10" onclick="$('#fileInput').click()">Pilih File</button>
                            </div>
                            <div id="uploadProgress" class="mt-15" style="display:none;">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%" id="progressBar"></div>
                                </div>
                                <small class="text-muted mt-5 d-block" id="progressText">Mengunggah...</small>
                            </div>
                            <div id="fileInfo" class="mt-15" style="display:none;">
                                <div class="alert alert-success">
                                    <i class="fa fa-check-circle mr-10"></i>
                                    <span id="fileName"></span> (<span id="fileSize"></span>)
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-30">
                            <button type="button" class="btn btn-outline-secondary prev-step px-30 py-10" data-target="#step-2"><i class="fa fa-arrow-left mr-10"></i> Kembali</button>
                            <button type="button" id="upload-btn" class="btn btn-primary next-step px-30 py-10" data-target="#step-4" disabled>Selanjutnya <i class="fa fa-arrow-right ml-10"></i></button>
                        </div>
                    </div>

                    <!-- Step 4 -->
                    <div class="wizard-content" id="step-4">
                        <div class="text-center mb-30">
                            <i class="fa fa-search text-info fa-4x mb-15"></i>
                            <h4 class="mb-10">Tinjauan Pendaftaran</h4>
                            <p class="text-muted">Pastikan informasi di bawah ini sudah benar. Data yang telah dikirim tidak dapat diubah tanpa persetujuan Admin Akademik.</p>
                        </div>
                        
                        <div class="bg-light p-20 rounded mb-30" id="reviewContainer">
                            <div class="row">
                                <div class="col-md-4 font-weight-bold">Judul Proposal:</div>
                                <div class="col-md-8" id="reviewJudul">Memuat...</div>
                            </div>
                            <hr style="margin: 10px 0;">
                            <div class="row">
                                <div class="col-md-4 font-weight-bold">Usulan Pembimbing:</div>
                                <div class="col-md-8" id="reviewDosen">Memuat...</div>
                            </div>
                            <hr style="margin: 10px 0;">
                            <div class="row">
                                <div class="col-md-4 font-weight-bold">Dokumen:</div>
                                <div class="col-md-8" id="reviewDokumen">Memuat...</div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-30">
                            <button type="button" class="btn btn-outline-secondary prev-step px-30 py-10" data-target="#step-3"><i class="fa fa-arrow-left mr-10"></i> Kembali</button>
                            <button type="button" id="submit-btn" class="btn btn-success px-30 py-10"><i class="fa fa-paper-plane mr-10"></i> Ajukan Pendaftaran Sekarang</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('script-master')
<script>
    $(document).ready(function() {
        // Load verification data on page load
        loadVerificationData();
        
        // Load lecturer data when Step 2 becomes active
        $('body').on('click', '.next-step', function() {
            var target = $(this).data('target');
            if(target === '#step-2') {
                loadLecturerData();
            }
        });
        
        $('.next-step').click(function(e) {
            if($(this).prop('disabled')) {
                e.preventDefault();
                return false;
            }
            
            var target = $(this).data('target');
            $('.wizard-content').removeClass('active');
            $(target).addClass('active');
            
            var targetNum = target.replace('#step-', '');
            $('#step-' + (targetNum - 1) + '-indicator').removeClass('active').addClass('completed');
            $('#step-' + (targetNum - 1) + '-indicator .wizard-step-circle').html('<i class="fa fa-check"></i>');
            $('#step-' + targetNum + '-indicator').addClass('active');
        });
        
        $('.prev-step').click(function() {
            var target = $(this).data('target');
            $('.wizard-content').removeClass('active');
            $(target).addClass('active');
            
            var targetNum = target.replace('#step-', '');
            $('#step-' + (parseInt(targetNum) + 1) + '-indicator').removeClass('active');
            $('#step-' + targetNum + '-indicator').removeClass('completed').addClass('active');
            
            // Restore number for the current active step backwards
            if(targetNum == 1) { $('#step-1-indicator .wizard-step-circle').html('<i class="fa fa-list-alt"></i>'); }
            else { $('#step-' + targetNum + '-indicator .wizard-step-circle').html(targetNum); }
        });
        
        function loadVerificationData() {
            $.ajax({
                url: '{{ $api_url }}mahasiswa/skripsi/cek-kelayakan',
                method: 'GET',
                data: {
                    nim: '{{ $nim }}',
                    fase: 'sempro'
                },
                headers: {
                    'Authorization': 'Bearer {{ $api_token }}',
                    'username': '{{ $nim }}'
                },
                success: function(response) {
                    if(response.status === 'success') {
                        displayVerificationResults(response.data);
                    } else {
                        showError('Gagal memuat data verifikasi');
                    }
                },
                error: function(xhr) {
                    console.error('Error loading verification data:', xhr);
                    showError('Terjadi kesalahan saat memuat data verifikasi');
                }
            });
        }
        
        function displayVerificationResults(data) {
            var container = $('#verification-container');
            var html = '';
            var canProceed = data.semua_lolos;
            
            // Add specific SKS and Grade cards
            var sksInfo = getSKSInfo(data);
            var gradeInfo = getGradeInfo(data);
            
            // SKS Card
            html += '<div class="alert alert-' + sksInfo.alertClass + ' d-flex align-items-center">';
            html += '<i class="fa fa-' + sksInfo.icon + ' fa-2x mr-15"></i>';
            html += '<div>';
            html += '<strong>' + sksInfo.title + '</strong><br>';
            html += sksInfo.message;
            html += '</div>';
            html += '</div>';
            
            // Grade Card
            html += '<div class="alert alert-' + gradeInfo.alertClass + ' d-flex align-items-center">';
            html += '<i class="fa fa-' + gradeInfo.icon + ' fa-2x mr-15"></i>';
            html += '<div>';
            html += '<strong>' + gradeInfo.title + '</strong><br>';
            html += gradeInfo.message;
            html += '</div>';
            html += '</div>';
            
            // Display other requirements
            data.syarat_list.forEach(function(syarat) {
                // Skip SKS and grade requirements since we already displayed them
                if(syarat.jenis === 'sistem' && (syarat.kode_syarat === 'SKS_MIN' || syarat.kode_syarat === 'BEBAS_E')) {
                    return;
                }
                
                var alertClass = syarat.status === 'v' ? 'success' : 'danger';
                var iconClass = syarat.status === 'v' ? 'check-circle' : 'times-circle';
                var iconElement = syarat.status === 'i' ? 'info-circle' : iconClass;
                
                html += '<div class="alert alert-' + alertClass + ' d-flex align-items-center">';
                html += '<i class="fa fa-' + iconElement + ' fa-2x mr-15"></i>';
                html += '<div>';
                html += '<strong>' + syarat.syarat + '</strong><br>';
                html += syarat.isi;
                if(!syarat.is_wajib) {
                    html += ' <span class="badge badge-info">Opsional</span>';
                }
                html += '</div>';
                html += '</div>';
            });
            
            container.html(html);
            
            // Additional validation: check if SKS requirement is met
            var sksMet = checkSKSRequirement(data);
            var gradesMet = checkGradesRequirement(data);
            
            // Override canProceed if critical requirements are not met
            var canActuallyProceed = canProceed && sksMet && gradesMet;
            
            // Enable/disable next button based on eligibility
            if(canActuallyProceed) {
                $('#next-step-btn').prop('disabled', false);
            } else {
                $('#next-step-btn').prop('disabled', true);
                var warningMessage = 'Anda belum memenuhi semua syarat wajib untuk melanjutkan pendaftaran seminar proposal.';
                if(!sksMet) {
                    warningMessage += ' SKS Anda belum mencukupi.';
                }
                if(!gradesMet) {
                    warningMessage += ' Terdapat nilai D/E/K pada transkrip Anda.';
                }
                container.append('<div class="alert alert-warning mt-10"><i class="fa fa-exclamation-triangle mr-10"></i>' + warningMessage + '</div>');
            }
        }
        
        function checkSKSRequirement(data) {
            var sksRequirement = data.syarat_list.find(function(syarat) {
                return syarat.jenis === 'sistem' && syarat.kode_syarat === 'SKS_MIN';
            });
            
            if(sksRequirement) {
                return sksRequirement.status === 'v';
            }
            
            // Fallback: check using calculated data
            var currentSKS = data.sks_calc || 0;
            var minSKS = 138;
            return currentSKS >= minSKS;
        }
        
        function checkGradesRequirement(data) {
            var gradeRequirement = data.syarat_list.find(function(syarat) {
                return syarat.jenis === 'sistem' && syarat.kode_syarat === 'BEBAS_E';
            });
            
            if(gradeRequirement) {
                return gradeRequirement.status === 'v';
            }
            
            // Fallback: check using calculated data
            var totalBadGrades = data.total_e || 0;
            return totalBadGrades === 0;
        }
        
        function getSKSInfo(data) {
            var sksRequirement = data.syarat_list.find(function(syarat) {
                return syarat.jenis === 'sistem' && syarat.kode_syarat === 'SKS_MIN';
            });
            
            if(sksRequirement && sksRequirement.status === 'v') {
                return {
                    alertClass: 'success',
                    icon: 'check-circle',
                    title: 'Tercapai',
                    message: sksRequirement.isi
                };
            } else if(sksRequirement) {
                return {
                    alertClass: 'danger',
                    icon: 'times-circle',
                    title: 'Belum Tercapai',
                    message: sksRequirement.isi
                };
            } else {
                // Fallback using calculated data
                var currentSKS = data.sks_calc || 0;
                var minSKS = 138; // Default minimum
                return {
                    alertClass: currentSKS >= minSKS ? 'success' : 'danger',
                    icon: currentSKS >= minSKS ? 'check-circle' : 'times-circle',
                    title: currentSKS >= minSKS ? 'Tercapai' : 'Belum Tercapai',
                    message: 'SKS Anda: ' + currentSKS + ' SKS (Syarat: ' + minSKS + ' SKS)'
                };
            }
        }
        
        function getGradeInfo(data) {
            var gradeRequirement = data.syarat_list.find(function(syarat) {
                return syarat.jenis === 'sistem' && syarat.kode_syarat === 'BEBAS_E';
            });
            
            if(gradeRequirement && gradeRequirement.status === 'v') {
                return {
                    alertClass: 'success',
                    icon: 'check-circle',
                    title: 'Aman',
                    message: 'Tidak ditemukan nilai D pada rekam transkrip Anda.'
                };
            } else if(gradeRequirement) {
                return {
                    alertClass: 'danger',
                    icon: 'times-circle',
                    title: 'Perhatian',
                    message: gradeRequirement.isi
                };
            } else {
                // Fallback using calculated data - check total_e which now includes D grades
                var totalBadGrades = data.total_e || 0;
                var hasBadGrades = totalBadGrades > 0;
                return {
                    alertClass: hasBadGrades ? 'danger' : 'success',
                    icon: hasBadGrades ? 'times-circle' : 'check-circle',
                    title: hasBadGrades ? 'Perhatian' : 'Aman',
                    message: hasBadGrades ? 'Ditemukan ' + totalBadGrades + ' matakuliah dengan nilai D/E/K pada rekam transkrip Anda.' : 'Tidak ditemukan nilai D pada rekam transkrip Anda.'
                };
            }
        }
        
        function showError(message) {
            $('#verification-container').html(
                '<div class="alert alert-danger">' +
                '<i class="fa fa-exclamation-triangle mr-10"></i>' +
                message +
                '</div>'
            );
        }
        
        function loadLecturerData() {
            $.ajax({
                url: '{{ $api_url }}akademik/select-dosen',
                method: 'GET',
                data: {
                    search: ''
                },
                headers: {
                    'Authorization': 'Bearer {{ $api_token }}',
                    'username': '{{ $nim }}'
                },
                success: function(response) {
                    var select = $('#dosen-pembimbing');
                    select.html('<option value="">-- Pilih Usulan Dosen --</option>');
                    
                    if(response.data && response.data.length > 0) {
                        response.data.forEach(function(dosen) {
                            var option = '<option value="' + dosen.id + '">' + dosen.text + '</option>';
                            select.append(option);
                        });
                    } else {
                        select.append('<option disabled>Tidak ada data dosen tersedia</option>');
                    }
                },
                error: function(xhr) {
                    console.error('Error loading lecturer data:', xhr);
                    $('#dosen-pembimbing').html('<option disabled>Gagal memuat data dosen</option>');
                }
            });
        }
        
        // Handle proposal form submission
        $('#save-proposal-btn').click(function() {
            var judul = $('#judul-proposal').val().trim();
            var dosenId = $('#dosen-pembimbing').val();
            
            // Validation
            if(!judul) {
                showNotification('Judul proposal wajib diisi', 'danger');
                $('#judul-proposal').focus();
                return;
            }
            
            if(!dosenId) {
                showNotification('Pilih dosen pembimbing terlebih dahulu', 'danger');
                $('#dosen-pembimbing').focus();
                return;
            }
            
            // Save proposal data
            saveProposalData(judul, dosenId);
        });
        
        function saveProposalData(judul, dosenId) {
            $.ajax({
                url: '{{ $api_url }}mahasiswa/skripsi/simpan-proposal',
                method: 'POST',
                data: {
                    nim: '{{ $nim }}',
                    judul: judul,
                    judul_en: judul, // For now, use same title
                    topik: judul, // For now, use same title
                    topik_en: judul, // For now, use same title
                    abstrak: 'Akan diisi kemudian', // Temporary
                    abstrak_en: 'Will be filled later' // Temporary
                },
                headers: {
                    'Authorization': 'Bearer {{ $api_token }}',
                    'username': '{{ $nim }}'
                },
                success: function(response) {
                    if(response.success) {
                        showNotification('Data proposal berhasil disimpan', 'success');
                        // Store data for review step
                        sessionStorage.setItem('proposalData', JSON.stringify({
                            judul: judul,
                            dosen_pembimbing: $('#dosen-pembimbing option:selected').text()
                        }));
                        
                        // Continue to next step
                        var target = $('#save-proposal-btn').data('target');
                        $('.wizard-content').removeClass('active');
                        $(target).addClass('active');
                        
                        var targetNum = target.replace('#step-', '');
                        $('#step-' + (targetNum - 1) + '-indicator').removeClass('active').addClass('completed');
                        $('#step-' + (targetNum - 1) + '-indicator .wizard-step-circle').html('<i class="fa fa-check"></i>');
                        $('#step-' + targetNum + '-indicator').addClass('active');
                    } else {
                        showNotification(response.error || 'Gagal menyimpan data proposal', 'danger');
                    }
                },
                error: function(xhr) {
                    console.error('Error saving proposal:', xhr);
                    showNotification('Terjadi kesalahan saat menyimpan data proposal', 'danger');
                }
            });
        }
        
        function showNotification(message, type) {
            var alertClass = 'alert-' + type;
            var icon = type === 'success' ? 'check-circle' : 'exclamation-triangle';
            var notification = '<div class="alert ' + alertClass + ' alert-dismissible fade show" role="alert">' +
                '<i class="fa fa-' + icon + ' mr-10"></i>' +
                message +
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                '<span aria-hidden="true">&times;</span>' +
                '</button>' +
                '</div>';
            
            $('#proposal-form').prepend(notification);
            
            // Auto dismiss after 5 seconds
            setTimeout(function() {
                $('.alert').alert('close');
            }, 5000);
        }
        
        // File upload functionality
        var selectedFile = null;
        
        // Drag and drop handlers
        $('#dropZone').on('dragover', function(e) {
            e.preventDefault();
            $(this).addClass('border-primary bg-light');
        });
        
        $('#dropZone').on('dragleave', function(e) {
            e.preventDefault();
            $(this).removeClass('border-primary bg-light');
        });
        
        $('#dropZone').on('drop', function(e) {
            e.preventDefault();
            $(this).removeClass('border-primary bg-light');
            
            var files = e.originalEvent.dataTransfer.files;
            if(files.length > 0) {
                handleFileSelect(files[0]);
            }
        });
        
        // File input change handler
        $('#fileInput').change(function(e) {
            if(e.target.files.length > 0) {
                handleFileSelect(e.target.files[0]);
            }
        });
        
        function handleFileSelect(file) {
            // Validate file type
            if(file.type !== 'application/pdf') {
                showNotification('Hanya file PDF yang diperbolehkan', 'danger');
                return;
            }
            
            // Validate file size (10MB max)
            if(file.size > 10 * 1024 * 1024) {
                showNotification('Ukuran file maksimal 10MB', 'danger');
                return;
            }
            
            selectedFile = file;
            displayFileInfo(file);
            $('#upload-btn').prop('disabled', false);
        }
        
        function displayFileInfo(file) {
            var fileSize = (file.size / 1024 / 1024).toFixed(2) + ' MB';
            $('#fileName').text(file.name);
            $('#fileSize').text(fileSize);
            $('#fileInfo').show();
            $('#dropZone').hide();
        }
        
        // Upload button handler
        $('#upload-btn').click(function() {
            if(!selectedFile) {
                showNotification('Pilih file terlebih dahulu', 'danger');
                return;
            }
            
            uploadFile(selectedFile);
        });
        
        function uploadFile(file) {
            var formData = new FormData();
            formData.append('nim', '{{ $nim }}');
            formData.append('file_naskah', file);
            formData.append('fase', 'sempro');
            
            $('#uploadProgress').show();
            $('#progressBar').css('width', '0%');
            
            $.ajax({
                url: '{{ $api_url }}mahasiswa/skripsi/upload-naskah',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'Authorization': 'Bearer {{ $api_token }}',
                    'username': '{{ $nim }}'
                },
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener('progress', function(e) {
                        if(e.lengthComputable) {
                            var percentComplete = (e.loaded / e.total) * 100;
                            $('#progressBar').css('width', percentComplete + '%');
                            $('#progressText').text('Mengunggah... ' + Math.round(percentComplete) + '%');
                        }
                    }, false);
                    return xhr;
                },
                success: function(response) {
                    if(response.success) {
                        $('#progressBar').css('width', '100%');
                        $('#progressText').text('Upload berhasil!');
                        
                        // Store file info for review
                        sessionStorage.setItem('uploadedFile', JSON.stringify({
                            name: file.name,
                            size: (file.size / 1024 / 1024).toFixed(2) + ' MB',
                            id_proposal: response.id_proposal
                        }));
                        
                        setTimeout(function() {
                            // Continue to next step
                            var target = $('#upload-btn').data('target');
                            $('.wizard-content').removeClass('active');
                            $(target).addClass('active');
                            
                            var targetNum = target.replace('#step-', '');
                            $('#step-' + (targetNum - 1) + '-indicator').removeClass('active').addClass('completed');
                            $('#step-' + (targetNum - 1) + '-indicator .wizard-step-circle').html('<i class="fa fa-check"></i>');
                            $('#step-' + targetNum + '-indicator').addClass('active');
                            
                            // Load review data
                            loadReviewData();
                        }, 1000);
                    } else {
                        showNotification(response.error || 'Gagal mengunggah file', 'danger');
                        $('#uploadProgress').hide();
                    }
                },
                error: function(xhr) {
                    console.error('Upload error:', xhr);
                    showNotification('Terjadi kesalahan saat mengunggah file', 'danger');
                    $('#uploadProgress').hide();
                }
            });
        }
        
        // Load review data when Step 4 becomes active
        function loadReviewData() {
            var proposalData = JSON.parse(sessionStorage.getItem('proposalData') || '{}');
            var fileData = JSON.parse(sessionStorage.getItem('uploadedFile') || '{}');
            
            $('#reviewJudul').text(proposalData.judul || 'Tidak tersedia');
            $('#reviewDosen').text(proposalData.dosen_pembimbing || 'Tidak tersedia');
            
            if(fileData.name) {
                $('#reviewDokumen').html('<span class=\"badge badge-success\"><i class=\"fa fa-check\"></i> ' + fileData.name + ' (' + fileData.size + ')</span>');
            } else {
                $('#reviewDokumen').html('<span class=\"badge badge-secondary\"><i class=\"fa fa-times\"></i> Belum diunggah</span>');
            }
        }
        
        // Submit final registration
        $('#submit-btn').click(function() {
            var proposalData = JSON.parse(sessionStorage.getItem('proposalData') || '{}');
            var fileData = JSON.parse(sessionStorage.getItem('uploadedFile') || '{}');
            
            if(!proposalData.judul || !fileData.name) {
                showNotification('Lengkapi semua data sebelum mengajukan pendaftaran', 'danger');
                return;
            }
            
            // Show loading
            $(this).prop('disabled', true).html('<i class=\"fa fa-spinner fa-spin mr-10\"></i> Memproses...');
            
            // Simulate final submission (in real app, this would call an API)
            setTimeout(function() {
                showNotification('Pendaftaran seminar proposal berhasil diajukan! Menunggu persetujuan Kaprodi.', 'success');
                
                // Clear session storage
                sessionStorage.removeItem('proposalData');
                sessionStorage.removeItem('uploadedFile');
                
                // Redirect to dashboard after 3 seconds
                setTimeout(function() {
                    window.location.href = '{{ route("skripsi.dashboard") }}';
                }, 3000);
            }, 2000);
        });
    });
</script>
@endsection
