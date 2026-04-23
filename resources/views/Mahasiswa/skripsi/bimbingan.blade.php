@extends('layout')

@section('css')
<style>
    .log-card { border-left: 4px solid #0066cc; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); margin-bottom: 20px; padding: 15px 20px; transition: transform 0.2s;}
    .log-card:hover { transform: translateX(5px); }
    .status-acc { background-color: #e5f9e7; color: #1e7e34; padding: 4px 10px; border-radius: 20px; font-weight: 600; font-size: 12px;}
    .status-pending { background-color: #fff3cd; color: #856404; padding: 4px 10px; border-radius: 20px; font-weight: 600; font-size: 12px;}
    .status-revisi { background-color: #f8d7da; color: #721c24; padding: 4px 10px; border-radius: 20px; font-weight: 600; font-size: 12px;}
</style>
@endsection

@section('content')
<div class="container-full">
    <section class="content">
        <div class="row">
            <div class="col-xl-4 col-12">
                <div class="box bg-primary">
                    <div class="box-body text-center p-30">
                        <i class="fa fa-book fa-3x text-white mb-10"></i>
                        <h3 class="text-white">Buku Bimbingan Digital</h3>
                        <p class="text-white-50">Syarat minimal bimbingan adalah 8 kali sebelum dapat mendaftar Ujian Akhir Skripsi.</p>
                        
                        <div class="mt-20 px-20">
                            <div class="d-flex justify-content-between text-white mb-5">
                                <span>Progres (3/8)</span>
                                <span>37%</span>
                            </div>
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 37%" aria-valuenow="37" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>

                        <button class="btn btn-warning mt-30 btn-block" data-toggle="modal" data-target="#modalTambahBimbingan">
                            <i class="fa fa-plus"></i> Tambah Catatan Bimbingan
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-xl-8 col-12">
                <h4 class="mb-20">Riwayat Bimbingan Anda</h4>
                
                <div class="log-card bg-white">
                    <div class="d-flex justify-content-between align-items-center mb-10">
                        <span class="font-weight-600 text-primary">Bimbingan #3</span>
                        <span class="text-muted"><i class="fa fa-calendar"></i> 24 Mei 2026</span>
                    </div>
                    <h5>Revisi Bab 2 & Metodologi</h5>
                    <p class="text-fade">Saya sudah memperbaiki rumusan masalah dan menambahkan literature review terkait Machine Learning pada bagian tinjauan pustaka.</p>
                    <div class="mt-15 d-flex justify-content-between align-items-center">
                        <span class="status-acc"><i class="fa fa-check-circle"></i> Disetujui Dosen</span>
                        <button class="btn btn-sm btn-outline-primary"><i class="fa fa-eye"></i> Lihat Detail</button>
                    </div>
                </div>

                <div class="log-card bg-white">
                    <div class="d-flex justify-content-between align-items-center mb-10">
                        <span class="font-weight-600 text-primary">Bimbingan #2</span>
                        <span class="text-muted"><i class="fa fa-calendar"></i> 10 Mei 2026</span>
                    </div>
                    <h5>Konsultasi Bab 1 dan 2</h5>
                    <p class="text-fade">Pengajuan bab 1 latar belakang dan tujuan penelitian. Bab 2 landasan teori masih disusun.</p>
                    <div class="mt-15 d-flex justify-content-between align-items-center">
                        <span class="status-revisi"><i class="fa fa-times-circle"></i> Perlu Revisi</span>
                        <div class="text-danger small"><strong>Catatan Dosen:</strong> Latar belakang kurang tajam, tambahkan data statistik pendukung.</div>
                    </div>
                </div>
                
                <div class="log-card bg-white">
                    <div class="d-flex justify-content-between align-items-center mb-10">
                        <span class="font-weight-600 text-primary">Bimbingan #1</span>
                        <span class="text-muted"><i class="fa fa-calendar"></i> 25 April 2026</span>
                    </div>
                    <h5>Penentuan Judul Akhir</h5>
                    <p class="text-fade">Diskusi awal terkait judul dan topik. Disepakati untuk berfokus pada AI dan Sistem Pendukung Keputusan.</p>
                    <div class="mt-15 d-flex justify-content-between align-items-center">
                        <span class="status-acc"><i class="fa fa-check-circle"></i> Disetujui Dosen</span>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>

<!-- Modal Tambah Bimbingan -->
<div class="modal fade" id="modalTambahBimbingan" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Catat Bimbingan Baru</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label>Tanggal Bimbingan</label>
                        <input type="date" class="form-control" value="2026-06-01">
                    </div>
                    <div class="form-group">
                        <label>Materi / Topik Konsultasi</label>
                        <input type="text" class="form-control" placeholder="Cth: Bab 3 - Perancangan Sistem">
                    </div>
                    <div class="form-group">
                        <label>Uraian / Pesan ke Pembimbing</label>
                        <textarea class="form-control" rows="4" placeholder="Jelaskan progres Anda..."></textarea>
                    </div>
                    <div class="form-group">
                        <label>Upload File (Opsional)</label>
                        <input type="file" class="form-control-file">
                        <small class="text-muted">Format .pdf atau .docx Maks 5MB.</small>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary"><i class="fa fa-save"></i> Simpan Catatan</button>
            </div>
        </div>
    </div>
</div>
@endsection
