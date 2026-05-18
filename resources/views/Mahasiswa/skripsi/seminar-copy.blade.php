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
                        <div class="alert alert-success d-flex align-items-center">
                            <i class="fa fa-check-circle fa-2x mr-15"></i> 
                            <div>
                                <strong>Tercapai</strong><br>
                                SKS Anda telah mencapai minimum: 140 SKS (Syarat: 138 SKS).
                            </div>
                        </div>
                        <div class="alert alert-success d-flex align-items-center">
                            <i class="fa fa-check-circle fa-2x mr-15"></i>
                            <div>
                                <strong>Aman</strong><br>
                                Tidak ditemukan nilai D pada rekam transkrip Anda.
                            </div>
                        </div>
                        <div class="text-right mt-30">
                            <button class="btn btn-primary d-inline-flex align-items-center next-step px-30 py-10" data-target="#step-2">
                                Selanjutnya <i class="fa fa-arrow-right ml-10"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="wizard-content" id="step-2">
                        <h4 class="mb-20">Rencana Proposal</h4>
                        <div class="form-group mb-20">
                            <label class="font-weight-600">Judul Proposal Ujian Akhir</label>
                            <input type="text" class="form-control" style="height: 50px;" placeholder="Masukkan judul penelitian Anda di sini...">
                        </div>
                        <div class="form-group mb-20">
                            <label class="font-weight-600">Usulan Dosen Pembimbing</label>
                            <select class="form-control" style="height: 50px;">
                                <option>-- Pilih Usulan Dosen --</option>
                                <option>Dr. Fulan Asnawi</option>
                                <option>Budi Santoso, M.Kom</option>
                                <option>Siti Aminah, S.T., M.T.</option>
                            </select>
                        </div>
                        <div class="d-flex justify-content-between mt-30">
                            <button class="btn btn-outline-secondary prev-step px-30 py-10" data-target="#step-1"><i class="fa fa-arrow-left mr-10"></i> Kembali</button>
                            <button class="btn btn-primary next-step px-30 py-10" data-target="#step-3">Selanjutnya <i class="fa fa-arrow-right ml-10"></i></button>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="wizard-content" id="step-3">
                        <h4 class="mb-20">Unggah Dokumen Syarat</h4>
                        <div class="form-group mb-30">
                            <label class="font-weight-600">Format Proposal Lengkap (PDF)</label>
                            <div class="drag-drop-zone mt-10">
                                <i class="fa fa-cloud-upload fa-4x text-primary mb-10"></i>
                                <h5>Seret & Lepas file Anda di sini</h5>
                                <p class="text-muted">Atau klik untuk mencari file</p>
                                <input type="file" style="display:none;" id="fileUploadMock">
                                <button type="button" class="btn btn-sm btn-primary mt-10" onclick="$('#fileUploadMock').click()">Pilih File</button>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-30">
                            <button class="btn btn-outline-secondary prev-step px-30 py-10" data-target="#step-2"><i class="fa fa-arrow-left mr-10"></i> Kembali</button>
                            <button class="btn btn-primary next-step px-30 py-10" data-target="#step-4">Selanjutnya <i class="fa fa-arrow-right ml-10"></i></button>
                        </div>
                    </div>

                    <!-- Step 4 -->
                    <div class="wizard-content" id="step-4">
                        <div class="text-center mb-30">
                            <i class="fa fa-search text-info fa-4x mb-15"></i>
                            <h4 class="mb-10">Tinjauan Pendaftaran</h4>
                            <p class="text-muted">Pastikan informasi di bawah ini sudah benar. Data yang telah dikirim tidak dapat diubah tanpa persetujuan Admin Akademik.</p>
                        </div>
                        
                        <div class="bg-light p-20 rounded mb-30">
                            <div class="row">
                                <div class="col-md-4 font-weight-bold">Judul Proposal:</div>
                                <div class="col-md-8">[Akan Diisi dari Input Anda]</div>
                            </div>
                            <hr style="margin: 10px 0;">
                            <div class="row">
                                <div class="col-md-4 font-weight-bold">Usulan Pembimbing:</div>
                                <div class="col-md-8">[Akan Diisi dari Input Anda]</div>
                            </div>
                            <hr style="margin: 10px 0;">
                            <div class="row">
                                <div class="col-md-4 font-weight-bold">Dokumen:</div>
                                <div class="col-md-8"><span class="badge badge-success"><i class="fa fa-check"></i> file.pdf</span></div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-30">
                            <button class="btn btn-outline-secondary prev-step px-30 py-10" data-target="#step-3"><i class="fa fa-arrow-left mr-10"></i> Kembali</button>
                            <a href="{{ route('skripsi.dashboard') }}" class="btn btn-success px-30 py-10"><i class="fa fa-paper-plane mr-10"></i> Ajukan Pendaftaran Sekarang</a>
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
        $('.next-step').click(function() {
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
    });
</script>
@endsection
