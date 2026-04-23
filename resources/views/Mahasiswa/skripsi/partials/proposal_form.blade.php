<div class="modal fade" id="modal-proposal" tabindex="-1" role="dialog" aria-labelledby="proposalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="proposalModalLabel"><i class="fa fa-file-text-o mr-10"></i>Form Pengajuan Judul & Proposal</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_proposal_submit">
                <div class="modal-body">
                    <div class="alert alert-info bg-info-light border-info">
                        <i class="fa fa-info-circle mr-5"></i> Masukan data judul dan proposal Anda dengan teliti. Judul dapat diubah kembali selama belum disetujui oleh Kaprodi.
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-700">Topik Utama (Bahasa Indonesia)</label>
                                <input type="text" name="topik" class="form-control" placeholder="Contoh: Kecerdasan Buatan" required>
                                <small class="text-muted">Kategori penelitian Anda</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-700">Topic (English)</label>
                                <input type="text" name="topik_en" class="form-control" placeholder="Example: Artificial Intelligence" required>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="form-group">
                        <label class="font-weight-700">Judul Lengkap (Bahasa Indonesia)</label>
                        <textarea name="judul" class="form-control" rows="3" placeholder="Masukan judul lengkap penelitian Anda..." required></textarea>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-700">Full Title (English)</label>
                        <textarea name="judul_en" class="form-control" rows="3" placeholder="Enter your full research title in English..." required></textarea>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-700">Abstrak / Gambaran Singkat</label>
                                <textarea name="abstrak" class="form-control" rows="5" placeholder="Tuliskan latar belakang singkat dan tujuan penelitian..." required></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-700">Abstract (English)</label>
                                <textarea name="abstrak_en" class="form-control" rows="5" placeholder="Write a brief background and research objectives in English..." required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="btn_simpan_proposal">
                        <i class="fa fa-paper-plane mr-5"></i> Ajukan Judul
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
