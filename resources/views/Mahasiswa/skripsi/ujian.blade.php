@extends('layout')
@section('css')
<style>
    /* Premium Aesthetic Wizard CSS for Ujian */
    .wizard-steps { display: flex; justify-content: space-between; margin-bottom: 40px; position: relative;}
    .wizard-steps::before { content: ""; position: absolute; top: 20px; left: 0; width: 100%; height: 4px; background: #e9ecef; z-index: 1;}
    .wizard-step { position: relative; z-index: 2; text-align: center; flex: 1;}
    .wizard-step-circle { width: 45px; height: 45px; border-radius: 50%; background: #e9ecef; color: #6c757d; line-height: 45px; margin: 0 auto; font-weight: bold; font-size: 18px; transition: all 0.3s ease; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
    .wizard-step.active .wizard-step-circle { background: #6f42c1; color: #fff; transform: scale(1.1); box-shadow: 0 4px 15px rgba(111, 66, 193, 0.4);}
    .wizard-step.completed .wizard-step-circle { background: #20c997; color: #fff; }
    .wizard-step-label { margin-top: 12px; font-weight: 600; font-size: 14px; color: #495057; }
    
    .wizard-content { display: none; }
    .wizard-content.active { display: block; animation: slideIn 0.6s cubic-bezier(0.165, 0.84, 0.44, 1); }
    
    @keyframes slideIn { from { opacity: 0; transform: translateX(20px); } to { opacity: 1; transform: translateX(0); } }
    
    .glassmorphism { background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(14px); border: 1px solid rgba(255,255,255,0.7); border-radius: 16px; padding: 30px; box-shadow: 0 8px 32px 0 rgba(111, 66, 193, 0.05); }
    .drag-drop-zone { border: 2px dashed #6f42c1; border-radius: 10px; padding: 40px; text-align: center; background: #fdfbff; cursor: pointer; transition: background 0.3s; }
    .drag-drop-zone:hover { background: #f4ecff; }
</style>
@endsection

@section('content')
<div class="container-full">
    <section class="content">
        <div class="box glassmorphism border-0">
            <div class="box-header no-border pb-0">
                <h3 class="box-title mb-30" style="font-weight: 700; color: #2c3e50;">Pendaftaran Ujian Tugas Akhir (Pendadaran)</h3>
            </div>
            <div class="box-body pt-0">
                <div class="wizard-steps px-20">
                    <div class="wizard-step active" id="step-1-indicator">
                        <div class="wizard-step-circle"><i class="fa fa-lock"></i></div>
                        <div class="wizard-step-label">Prasyarat Akhir</div>
                    </div>
                    <div class="wizard-step" id="step-2-indicator">
                        <div class="wizard-step-circle">2</div>
                        <div class="wizard-step-label">Data Pendadaran</div>
                    </div>
                    <div class="wizard-step" id="step-3-indicator">
                        <div class="wizard-step-circle">3</div>
                        <div class="wizard-step-label">Upload Berkas</div>
                    </div>
                    <div class="wizard-step" id="step-4-indicator">
                        <div class="wizard-step-circle"><i class="fa fa-flag-checkered"></i></div>
                        <div class="wizard-step-label">Finalisasi</div>
                    </div>
                </div>

                <div class="wizard-stages px-20">
                    <!-- Step 1 -->
                    <div class="wizard-content active" id="step-1">
                        <h4 class="mb-20">Verifikasi Prasyarat Sidang Akhir</h4>
                        
                        <div id="loading-syarat" class="text-center py-20">
                            <i class="fa fa-spinner fa-spin fa-3x" style="color: #6f42c1;"></i>
                            <p class="mt-10">Mengecek Data Evaluasi Akhir...</p>
                        </div>
                        
                        <div id="syarat-container" style="display:none;"></div>

                        <div class="text-right mt-30">
                            <button id="btn-next-to-2" class="btn btn-primary d-inline-flex align-items-center next-step px-30 py-10" data-target="#step-2" style="background-color: #6f42c1; border-color: #6f42c1;" disabled>
                                Lanjut <i class="fa fa-arrow-right ml-10"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="wizard-content" id="step-2">
                        <h4 class="mb-20">Validasi Data Skripsi Anda</h4>
                        <div class="alert alert-info border-info">Pastikan judul yang tercetak di bawah ini adalah judul final yang telah disetujui Dosen Pembimbing untuk diujikan. Jika ada perubahan, silakan perbarui judul.</div>
                        <div class="form-group mb-20">
                            <label class="font-weight-600">Judul Final Skripsi / Tugas Akhir</label>
                            <input type="text" id="input_judul" class="form-control" style="height: 50px;">
                        </div>
                        <div class="d-flex justify-content-between mt-30">
                            <button class="btn btn-outline-secondary prev-step px-30 py-10" data-target="#step-1"><i class="fa fa-arrow-left mr-10"></i> Kembali</button>
                            <button class="btn btn-primary next-step px-30 py-10" data-target="#step-3" style="background-color: #6f42c1; border-color: #6f42c1;">Selanjutnya <i class="fa fa-arrow-right ml-10"></i></button>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="wizard-content" id="step-3">
                        <h4 class="mb-20">Kumpulkan Berkas Digital Sesuai Opsi Prodi</h4>
                        <p class="text-muted mb-20">Lengkapi berkas pendadaran (Jurnal, Naskah Lengkap, Plagiasi, dsb) secara digital.</p>
                        
                        <div id="upload-container">
                            <p class="text-muted">Loading field upload berdasarkan aturan prodi...</p>
                        </div>

                        <div class="d-flex justify-content-between mt-30">
                            <button class="btn btn-outline-secondary prev-step px-30 py-10" data-target="#step-2"><i class="fa fa-arrow-left mr-10"></i> Kembali</button>
                            <button class="btn btn-primary next-step px-30 py-10" data-target="#step-4" style="background-color: #6f42c1; border-color: #6f42c1;" onclick="prepareReview()">Lanjut ke Review <i class="fa fa-arrow-right ml-10"></i></button>
                        </div>
                    </div>

                    <!-- Step 4 -->
                    <div class="wizard-content" id="step-4">
                        <div class="text-center mb-30">
                            <i class="fa fa-trophy text-warning fa-4x mb-15"></i>
                            <h4 class="mb-10">Sedikit Lagi Menuju Gelar Ahli / Sarjana!</h4>
                            <p class="text-muted">Pastikan informasi di bawah telah sesuai, form akan diteruskan ke Kaprodi dan Tata Usaha Fakultas.</p>
                        </div>

                        <div class="bg-light p-20 rounded mb-30" style="border: 1px solid #e9ecef;">
                            <div class="row">
                                <div class="col-md-4 font-weight-bold">Judul Akhir Ujian:</div>
                                <div class="col-md-8" id="review_judul"></div>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between mt-30">
                            <button class="btn btn-outline-secondary prev-step px-30 py-10" data-target="#step-3"><i class="fa fa-arrow-left mr-10"></i> Kembali</button>
                            <button class="btn btn-success px-30 py-10" id="btn-submit-final" style="background-color: #20c997; border-color: #20c997;"><i class="fa fa-paper-plane mr-10"></i> Konfirmasi Pendaftaran Ujian</button>
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
    var token = "{{ $api_token }}";
    var nim = "{{ $session_nim }}";
    var userlogin = "{{ $session_nim }}";

    $(document).ready(function() {
        // Navigation Logics
        $('.next-step').click(function() {
            var target = $(this).data('target');
            if($(this).attr('disabled')) return;

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
            
            if(targetNum == 1) { $('#step-1-indicator .wizard-step-circle').html('<i class="fa fa-lock"></i>'); }
            else { $('#step-' + targetNum + '-indicator .wizard-step-circle').html(targetNum); }
        });

        // Load API Ujian
        $.ajax({
            url: "{{ config('setting.second_url') }}mahasiswa/skripsi/cek-kelayakan",
            type: "GET",
            data: { nim: nim, fase: 'ujian' },
            headers: {
                "Authorization": 'Bearer ' + token,
                "username": userlogin
            },
            success: function(res) {
                $('#loading-syarat').hide();
                $('#syarat-container').show();
                
                if(res.status == 'success') {
                    let html = '<div class="row">';
                    let htmlLeft = '<div class="col-md-6"><ul class="list-group">';
                    let htmlRight = '<div class="col-md-6"><ul class="list-group">';
                    
                    let uploadHtml = '';
                    let idx = 0;

                    res.data.syarat_list.forEach(function(item) {
                        let isOk = item.status == 'v' || item.status == 'i';
                        let liClass = isOk ? 'badge-success' : 'badge-danger';
                        let iClass = isOk ? 'fa-check' : 'fa-times';
                        let label = item.syarat + (isOk ? '' : ' <small style="color:red">('+item.isi+')</small>');
                        
                        let liItem = `
                            <li class="list-group-item d-flex justify-content-between align-items-center mb-1">
                                <span>${label}</span>
                                <span class="badge ${liClass} badge-pill"><i class="fa ${iClass}"></i></span>
                            </li>
                        `;

                        if (idx % 2 == 0) htmlLeft += liItem;
                        else htmlRight += liItem;
                        idx++;

                        // Upload Field Form Generator
                        if(item.jenis == 'berkas') {
                            uploadHtml += `
                            <div class="form-group mb-30 p-3" style="border:1px solid #ddd; border-radius:10px;">
                                <label class="font-weight-600">${item.syarat}</label>
                                <div class="row">
                                    <div class="col-md-9">
                                      <input type="${item.tipe_upload == 'url' ? 'text' : 'file'}" 
                                             class="form-control" 
                                             id="file_${item.id_syarat_prodi}" 
                                             placeholder="${item.tipe_upload == 'url' ? 'Masukkan Link (Cth: OJS Jurnal, GDrive, dll)' : 'Pilih File'}">
                                    </div>
                                    <div class="col-md-3">
                                      <button type="button" class="btn btn-sm text-white w-100 mt-1" style="background-color: #6f42c1;" onclick="uploadDoc(${item.id_syarat_prodi}, '${item.tipe_upload}')"><i class="fa fa-upload"></i> Unggah</button>
                                    </div>
                                </div>
                                <div class="mt-1" id="statusUpload_${item.id_syarat_prodi}">
                                    ${item.status == 'i' ? '<span class="text-success"><i class="fa fa-check"></i> Sudah tersimpan dalam sistem.</span>' : '<span class="text-danger">Belum ada file</span>'}
                                </div>
                            </div>
                            `;
                        }
                    });

                    htmlLeft += '</ul></div>';
                    htmlRight += '</ul></div>';
                    html += htmlLeft + htmlRight + '</div>';

                    $('#syarat-container').html(html);
                    
                    if(uploadHtml) {
                        $('#upload-container').html(uploadHtml);
                    } else {
                        $('#upload-container').html('<div class="alert alert-info">Tidak ada form berkas untuk prodi ini.</div>');
                    }

                    if(res.data.semua_lolos) {
                        $('#btn-next-to-2').removeAttr('disabled').html('Syarat Lengkap, Lanjut Step 2 <i class="fa fa-arrow-right ml-10"></i>');
                    } else {
                        $('#syarat-container').append('<div class="alert alert-warning mt-20"><i class="fa fa-warning"></i> Ceklis yang berwarna merah menunjukkan syarat belum lengkap. Lengkapi dahulu sebelum mendaftar.</div>');
                    }
                }
            },
            error: function() {
                $('#loading-syarat').html('<div class="text-danger"><i class="fa fa-times"></i> Gagal terhubung dengan server.</div>');
            }
        });

        // Submit form placeholder (Endpoint pendaftaran ujian bisa diseragamkan dengan modul skripsi update)
        $('#btn-submit-final').click(function(){
            $(this).prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Menyimpan...');
            
            // Endpoint ini akan menggunakan mekanisme yang sama (update judal, fase)
            $.ajax({
                url: "{{ config('setting.second_url') }}mahasiswa/skripsi/daftar-sempro", 
                method: "POST", // Nanti buat daftar_ujian di Controller
                data: {
                    nim: nim,
                    judul: $('#input_judul').val()
                },
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                success: function(data) {
                    showToastr('success', 'Berhasil', 'Pendaftaran Ujian Terkirim.');
                    window.location.href = "{{ route('skripsi.dashboard') }}";
                },
                error: function(err) {
                    showToastr('error', 'Gagal', 'Terjadi Kesalahan Jaringan');
                    $('#btn-submit-final').prop('disabled', false).html('Konfirmasi Pendaftaran Ujian');
                }
            });
        });
    });

    function prepareReview() {
        $('#review_judul').html($('#input_judul').val() || '-');
    }

    function uploadDoc(id_syarat, tipe) {
        var fileInput = $('#file_' + id_syarat);
        var formData = new FormData();
        formData.append('nim', nim);
        formData.append('id_syarat_prodi', id_syarat);
        formData.append('fase', 'ujian');
        formData.append('tipe', tipe);
        
        if (tipe == 'file') {
            if (fileInput[0].files.length == 0){ alert("Pilih file terlebih dahulu"); return; }
            formData.append('file_berkas', fileInput[0].files[0]);
        } else {
            if (!fileInput.val()){ alert("Masukkan URL terlebih dahulu"); return; }
            formData.append('url_berkas', fileInput.val());
        }

        $('#statusUpload_' + id_syarat).html('<i class="fa fa-spinner fa-spin"></i> Mengunggah...');

        $.ajax({
            url: "{{ config('setting.second_url') }}mahasiswa/skripsi/upload-berkas",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            headers: { "Authorization": 'Bearer ' + token, "username": userlogin },
            success: function(res) {
                if (res.success) $('#statusUpload_' + id_syarat).html('<span class="text-success"><i class="fa fa-check"></i> Berhasil diunggah!</span>');
                else $('#statusUpload_' + id_syarat).html('<span class="text-danger"><i class="fa fa-times"></i> Gagal upload.</span>');
            },
            error: function() {
                $('#statusUpload_' + id_syarat).html('<span class="text-danger"><i class="fa fa-times"></i> Terjadi kesalahan jaringan.</span>');
            }
        });
    }
</script>
@endsection
