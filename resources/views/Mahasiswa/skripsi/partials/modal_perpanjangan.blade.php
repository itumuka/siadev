<!-- Modal Pengajuan Perpanjangan Masa Studi -->
<div class="modal fade" id="modal-ajukan-perpanjangan" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 12px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.15);">
            <div class="modal-header bg-danger text-white" style="border-top-left-radius: 12px; border-top-right-radius: 12px;">
                <h5 class="modal-title font-weight-bold">
                    <i class="fa fa-calendar-plus-o mr-10"></i> Pengajuan Perpanjangan Masa Studi (Tugas Akhir / Skripsi)
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_ajukan_perpanjangan">
                <div class="modal-body p-25">
                    <div class="alert alert-info border-info mb-20" style="background-color: #f0f7ff; border-radius: 8px;">
                        <i class="fa fa-info-circle mr-5"></i> Masa berlaku skripsi semester Anda telah berakhir. Anda dapat mengajukan perpanjangan studi untuk semester baru. Masa studi akan otomatis aktif kembali setelah kewajiban keuangan terkonfirmasi lunas.
                    </div>

                    <!-- Checklist Prasyarat Keuangan Dinamis -->
                    <div class="box box-bordered border-primary mb-20">
                        <div class="box-header with-border bg-primary-light py-10">
                            <h6 class="box-title font-size-14 font-weight-bold text-primary mb-0">
                                <i class="fa fa-money mr-5"></i> Status Prasyarat Keuangan Perpanjangan
                            </h6>
                        </div>
                        <div class="box-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0 font-size-13" id="table_clearance_perpanjangan">
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th>Komponen Biaya</th>
                                            <th>Keterangan / Tunggakan</th>
                                            <th class="text-center" width="20%">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="clearance_tbody">
                                        <tr><td colspan="3" class="text-center py-10 text-muted"><i class="fa fa-spin fa-spinner mr-5"></i> Memeriksa data tagihan keuangan...</td></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Form Inputs -->
                    <div class="form-group">
                        <label class="font-weight-600">Alasan Perpanjangan Masa Studi <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="alasan_perpanjangan" id="perp_alasan" rows="3" placeholder="Contoh: Masih dalam proses pengujian data ternak dan perbaikan analisis bab 4..." required minlength="10"></textarea>
                        <small class="text-muted font-size-11">Jelaskan kendala atau kegiatan yang sedang dilakukan sehingga memerlukan perpanjangan waktu.</small>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-600">Progres Riset / Naskah Terakhir</label>
                                <input type="text" class="form-control" name="progress_terakhir" id="perp_progress" placeholder="Contoh: Bimbingan Bab 4 & 5">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-600">Target Tanggal Selesai Ujian</label>
                                <input type="date" class="form-control" name="target_selesai" id="perp_target">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-gray-50" style="border-bottom-left-radius: 12px; border-bottom-right-radius: 12px;">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-danger" id="btn_submit_perpanjangan">
                        <i class="fa fa-paper-plane mr-5"></i> Kirim Pengajuan Perpanjangan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Status Pengajuan Perpanjangan -->
<div class="modal fade" id="modal-status-perpanjangan" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 12px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.15);">
            <div class="modal-header bg-warning text-dark" style="border-top-left-radius: 12px; border-top-right-radius: 12px;">
                <h5 class="modal-title font-weight-bold">
                    <i class="fa fa-hourglass-half mr-10"></i> Status Pengajuan Perpanjangan Masa Studi
                </h5>
                <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-20">
                <div class="text-center mb-20">
                    <div class="w-60 h-60 rounded-circle bg-warning-light text-warning d-inline-flex align-items-center justify-content-center font-size-30 mb-10" style="width: 60px; height: 60px;">
                        <i class="fa fa-clock-o"></i>
                    </div>
                    <h5 class="font-weight-bold text-dark mb-5">Pengajuan Sedang Dalam Proses</h5>
                    <p class="text-muted font-size-13 mb-0">Pengajuan perpanjangan masa studi Anda telah tercatat dalam sistem.</p>
                </div>

                <div class="box box-bordered border-warning mb-15">
                    <div class="box-body p-15 font-size-13">
                        <div class="d-flex justify-content-between mb-5">
                            <span class="text-muted">Status Keuangan:</span>
                            <span id="status_perp_keuangan" class="badge badge-warning">Pending / Menunggu Pembayaran</span>
                        </div>
                        <div class="d-flex justify-content-between mb-5">
                            <span class="text-muted">Status Aktivasi:</span>
                            <span id="status_perp_final" class="badge badge-secondary">Diajukan</span>
                        </div>
                        <div class="d-flex justify-content-between mb-5">
                            <span class="text-muted">Tanggal Pengajuan:</span>
                            <span id="status_perp_tgl" class="font-weight-600">-</span>
                        </div>
                        <div class="mt-10 pt-10 border-top">
                            <span class="text-muted d-block mb-2 font-size-12">Catatan Keuangan:</span>
                            <div id="status_perp_catatan" class="p-10 bg-gray-100 rounded text-dark font-size-12">-</div>
                        </div>
                    </div>
                </div>

                <div class="alert alert-warning mb-0 font-size-12">
                    <i class="fa fa-info-circle mr-5"></i> Silakan melakukan pembayaran tagihan perpanjangan di Bagian Keuangan / Bank. Setelah divalidasi lunas oleh Keuangan, masa studi Anda akan otomatis aktif kembali.
                </div>
            </div>
            <div class="modal-footer bg-gray-50" style="border-bottom-left-radius: 12px; border-bottom-right-radius: 12px;">
                <button type="button" class="btn btn-secondary w-100" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
