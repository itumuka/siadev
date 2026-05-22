@extends('layout')
@section('content')
<div class="container-full">
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title">Konfigurasi Syarat Sempro & Ujian Skripsi</h3>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                            <li class="breadcrumb-item" aria-current="page">Kaprodi</li>
                            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('kpskripsi_index') }}">Skripsi</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Syarat</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="box animate-fade-in">
                    <div class="box-header with-border bg-primary-light">
                        <h4 class="box-title text-dark">Daftar Syarat Pendaftaran Program Studi</h4>
                        <div class="box-controls pull-right">
                            <button class="btn btn-sm btn-success mr-5" onclick="openAddModal()">
                                <i class="fa fa-plus mr-5"></i> Tambah Syarat
                            </button>
                            <a href="{{ route('kpskripsi_index') }}" class="btn btn-sm btn-secondary">
                                <i class="fa fa-arrow-left mr-5"></i> Kembali
                            </a>
                        </div>
                        <p class="mb-0 text-muted">Atur syarat berkas dan kelayakan (seperti IPK minimal, SKS minimal, sertifikat, dll.) yang harus dipenuhi mahasiswa pada saat pendaftaran Seminar Proposal maupun Sidang Akhir.</p>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="table_kaprodi_syarat" class="table table-hover table-striped">
                                <thead class="bg-dark text-white">
                                    <tr>
                                        <th style="width: 5%">No</th>
                                        <th style="width: 25%">Syarat (Master)</th>
                                        <th style="width: 8%">Jenjang</th>
                                        <th style="width: 10%">Fase</th>
                                        <th style="width: 12%">Kondisi Target</th>
                                        <th style="width: 10%">Tipe Upload</th>
                                        <th style="width: 10%">Validatur</th>
                                        <th style="width: 5%">Wajib</th>
                                        <th style="width: 5%">Status</th>
                                        <th style="width: 10%; text-align: center;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Dynamic content loaded via AJAX -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal Tambah / Edit Syarat Prodi -->
<div class="modal fade" id="modal-syarat-prodi" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="modal-syarat-title">Tambah Syarat Prodi</h5>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <form id="form_syarat_prodi">
                <div class="modal-body">
                    <input type="hidden" name="id" id="syarat_id">
                    <input type="hidden" name="kode_prodi" id="syarat_kode_prodi" value="{{ $session_kode_program_studi }}">
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="font-weight-bold">Pilih Syarat (Master) <span class="text-danger">*</span></label>
                                <select class="form-control select2" name="kode_syarat" id="syarat_kode_syarat" style="width: 100%;" required>
                                    <!-- Dynamic options from /kaprodi/skripsi/master-syarat -->
                                </select>
                                <small class="text-muted">Pilih jenis syarat berkas/kriteria yang ada di sistem master akademik.</small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Jenjang Pendidikan <span class="text-danger">*</span></label>
                                <select class="form-control" name="kode_jenjang" id="syarat_kode_jenjang" required>
                                    <option value="S1">S1 - Sarjana</option>
                                    <option value="D4">D4 - Diploma IV</option>
                                    <option value="D3">D3 - Diploma III</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Fase Pengajuan <span class="text-danger">*</span></label>
                                <select class="form-control" name="fase" id="syarat_fase" required>
                                    <option value="sempro">Seminar Proposal (Sempro)</option>
                                    <option value="ujian">Ujian Skripsi / Sidang Akhir</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="font-weight-bold">Operator Pembanding <span class="text-danger">*</span></label>
                                <select class="form-control" name="operator" id="syarat_operator" required>
                                    <option value="-">- (Hanya Berkas / Tanpa Angka)</option>
                                    <option value="EXISTS">EXISTS (Wajib Ada/Upload)</option>
                                    <option value=">=">&gt;= (Lebih Besar atau Sama Dengan)</option>
                                    <option value="&lt;=">&lt;= (Lebih Kecil atau Sama Dengan)</option>
                                    <option value="=">= (Sama Dengan)</option>
                                </select>
                                <small class="text-muted">Gunakan '&gt;=' untuk target angka (misal: IPK atau SKS minimal).</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="font-weight-bold">Nilai Target</label>
                                <input type="text" name="nilai_target" id="syarat_nilai_target" class="form-control" placeholder="Contoh: 2.00 atau 120">
                                <small class="text-muted">Isi jika menggunakan operator pembanding (angka).</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="font-weight-bold">Tipe Input/Unggah <span class="text-danger">*</span></label>
                                <select class="form-control" name="tipe_upload" id="syarat_tipe_upload" required>
                                    <option value="file">Unggah File (PDF/Gambar)</option>
                                    <option value="url">Link / URL Dokumen</option>
                                    <option value="bebas">Bebas (Teks Deskripsi / File / URL)</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Petugas Validasi <span class="text-danger">*</span></label>
                                <input type="text" name="petugas_validasi" id="syarat_petugas_validasi" class="form-control" value="Petugas Fakultas" required>
                                <small class="text-muted">Siapa yang bertugas memverifikasi kelengkapan syarat ini.</small>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="font-weight-bold">Wajib Dipenuhi? <span class="text-danger">*</span></label>
                                <select class="form-control" name="is_wajib" id="syarat_is_wajib" required>
                                    <option value="1">Wajib (Mahasiswa tidak bisa submit jika kosong)</option>
                                    <option value="0">Opsional (Hanya pendukung)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="font-weight-bold">No. Urut Tampil <span class="text-danger">*</span></label>
                                <input type="number" name="urutan" id="syarat_urutan" class="form-control" value="1" min="1" required>
                                <small class="text-muted">Urutan tampil di wizard form mahasiswa.</small>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-9">
                            <div class="form-group">
                                <label class="font-weight-bold">Keterangan / Instruksi Tambahan</label>
                                <textarea name="keterangan" id="syarat_keterangan" class="form-control" rows="3" placeholder="Tuliskan petunjuk pengisian atau upload berkas bagi mahasiswa..."></textarea>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="font-weight-bold">Status Aktif <span class="text-danger">*</span></label>
                                <select class="form-control" name="is_aktif" id="syarat_is_aktif" required>
                                    <option value="1">Aktif</option>
                                    <option value="0">Non-Aktif</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" id="btn-save-syarat">Simpan Syarat</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script-advanced')
<script>
    const CONFIG = {
        api_url: "{{ $api_url }}",
        kode_prodi: "{{ $session_kode_program_studi }}",
        token: "{{ $api_token }}",
        username: "{{ $session_nim }}",
        tahun: "{{ $session_tahun }}",
        semester: "{{ $session_semester }}"
    };
</script>
<script src="{{ url('js/skripsi_kaprodi_syarat.js') }}?v={{ time() }}"></script>
@endsection
