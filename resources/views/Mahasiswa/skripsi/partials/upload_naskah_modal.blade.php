<div class="modal fade" id="modal-upload-naskah" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title text-white" id="uploadModalLabel"><i class="fa fa-cloud-upload mr-10"></i>Unggah Naskah / Draft</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_upload_naskah" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="font-weight-700">Pilih File Naskah (PDF)</label>
                        <input type="file" name="file_naskah" class="form-control" accept=".pdf" required>
                        <small class="text-muted text-danger">* Maksimal ukuran file 10MB.</small>
                    </div>
                    
                    <div class="alert alert-warning bg-warning-light border-warning mt-15">
                        <i class="fa fa-exclamation-triangle mr-5"></i> Pastikan naskah yang diunggah sudah sesuai dengan format yang ditentukan (BAB 1-3 untuk Sempro, atau Lengkap untuk Ujian Akhir).
                    </div>

                    <div id="history-naskah" class="mt-20" style="display: none;">
                        <label class="font-weight-700">Naskah Terakhir:</label>
                        <div class="p-10 border rounded bg-light d-flex justify-content-between align-items-center">
                            <span id="label-naskah-terakhir" class="text-truncate mr-10" style="max-width: 250px;">-</span>
                            <a href="#" id="link-naskah-terakhir" target="_blank" class="btn btn-xs btn-info"><i class="fa fa-download"></i> Lihat</a>
                        </div>
                        <small class="text-muted mt-5 d-block text-italic">* Unggah file baru untuk memperbarui naskah.</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success" id="btn_submit_naskah">
                        <i class="fa fa-upload mr-5"></i> Unggah Sekarang
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
