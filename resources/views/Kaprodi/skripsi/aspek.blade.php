@extends('layout')
@section('content')
<div class="container-full">
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title">Master Aspek Penilaian</h3>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                            <li class="breadcrumb-item" aria-current="page">Kaprodi</li>
                            <li class="breadcrumb-item" aria-current="page"><a href="{{ route('kpskripsi_index') }}">Skripsi</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Aspek Penilaian</li>
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
                <div class="box">
                    <div class="box-header with-border bg-info-light">
                        <div class="d-flex flex-wrap justify-content-between align-items-center">
                            <div>
                                <h4 class="box-title text-dark mb-0">Daftar Master Aspek Penilaian</h4>
                                <p class="mb-0 text-muted mt-5">Kelola aspek penilaian utama skripsi secara dinamis. Total bobot seluruh aspek harus tepat 100% agar rubrik dapat digunakan.</p>
                            </div>
                            <div class="d-flex flex-wrap align-items-center mt-10 mt-md-0">
                                <button id="btn-add-aspek" class="btn btn-sm btn-success mr-10 mb-5">
                                    <i class="fa fa-plus mr-5"></i> Tambah Aspek
                                </button>
                                <button id="btn-reset-aspek" class="btn btn-sm btn-danger mr-10 mb-5">
                                    <i class="fa fa-refresh mr-5"></i> Reset ke Default
                                </button>
                                <a href="{{ route('kpskripsi_index') }}" class="btn btn-sm btn-secondary mb-5">
                                    <i class="fa fa-arrow-left mr-5"></i> Kembali
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="box-body">
                        <!-- Jalur Selector & Akumulasi Bobot -->
                        <div class="row mb-15">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="font-weight-600 text-dark">Jalur Kelulusan</label>
                                    <select id="select-jalur" class="form-control select2" style="width: 100%;">
                                        <option value="reguler" selected>Tradisional (Sidang Laporan)</option>
                                        <option value="obe">Luaran / Publikasi Artikel (OBE)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label class="font-weight-600 text-dark">Status Akumulasi Bobot Aspek</label>
                                    <div class="d-flex align-items-center" style="height: 40px;">
                                        <div class="flex-grow-1 mr-15">
                                            <div class="progress progress-lg mb-0" id="progress-bar-container" style="background-color: #e9ecef; border-radius: 4px; height: 18px;">
                                                <div class="progress-bar bg-success font-weight-bold" role="progressbar" id="aspek-progress" style="width: 0%; line-height: 18px;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                                            </div>
                                        </div>
                                        <div class="text-right" style="min-width: 170px;">
                                            <span id="aspek-status-badge" class="badge badge-warning font-size-12 px-10 py-5">Menghitung...</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Table -->
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th style="width: 8%; text-align: center;">No.</th>
                                        <th style="width: 62%;">Nama Aspek Penilaian</th>
                                        <th style="width: 15%; text-align: center;">Bobot Aspek</th>
                                        <th style="width: 15%; text-align: center;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody-aspek">
                                    <!-- Loaded via AJAX -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Add/Edit Aspect Modal -->
<div class="modal fade" id="modal-aspek" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="modal-title">Tambah Aspek Penilaian</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-aspek">
                <div class="modal-body">
                    <input type="hidden" id="aspek-id" name="id">
                    
                    <div class="form-group">
                        <label class="font-weight-600 text-dark">Nama Aspek Penilaian</label>
                        <input type="text" class="form-control" id="aspek-nama" name="nama_aspek" required placeholder="Contoh: Substansi dan Luaran, Ujian/Presentasi">
                    </div>

                    <div class="form-group">
                        <label class="font-weight-600 text-dark">Bobot Aspek (%)</label>
                        <input type="number" step="0.01" class="form-control" id="aspek-bobot" name="bobot" required min="0" max="100" placeholder="Contoh: 60.00">
                        <small class="text-muted">Masukkan nilai bobot (0-100). Sisa bobot yang tersedia akan divalidasi oleh sistem.</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success" id="btn-save-aspek">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="{{ URL::asset('js/jquery.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        const token = "{{ $api_token }}";
        const username = "{{ $session_nim }}";
        const kodeProdi = "{{ $session_kode_program_studi }}";
        const apiUrl = "{{ $api_url }}";

        let aspectsList = [];

        function loadAspek() {
            const jalur = $('#select-jalur').val();
            $('#tbody-aspek').html('<tr><td colspan="4" class="text-center text-muted"><i class="fa fa-spinner fa-spin mr-5"></i> Memuat data aspek...</td></tr>');
            
            $.ajax({
                type: 'GET',
                url: apiUrl + 'kaprodi/skripsi/get-aspek/' + kodeProdi + '?jalur=' + jalur,
                headers: {
                    'Authorization': 'Bearer ' + token,
                    'username': username
                },
                success: function(res) {
                    if (res.status === 'success') {
                        aspectsList = res.data || [];
                        renderAspek();
                    } else {
                        $('#tbody-aspek').html('<tr><td colspan="4" class="text-center text-danger">Gagal memuat data aspek.</td></tr>');
                    }
                },
                error: function() {
                    $('#tbody-aspek').html('<tr><td colspan="4" class="text-center text-danger">Terjadi kesalahan koneksi.</td></tr>');
                }
            });
        }

        function renderAspek() {
            let html = '';
            let totalBobot = 0;

            if (aspectsList.length === 0) {
                html = '<tr><td colspan="4" class="text-center text-muted">Belum ada aspek penilaian yang dikonfigurasi. Klik "Tambah Aspek" untuk memulai.</td></tr>';
            } else {
                aspectsList.forEach(function(item, index) {
                    let bobot = parseFloat(item.bobot);
                    totalBobot += bobot;

                    html += `
                        <tr>
                            <td class="text-center">${index + 1}.</td>
                            <td class="font-weight-600 text-dark">${item.nama_aspek}</td>
                            <td class="text-center font-bold text-primary">${bobot.toFixed(2)}%</td>
                            <td class="text-center">
                                <button class="btn btn-xs btn-warning btn-edit-aspek mr-5" data-id="${item.id}" data-nama="${item.nama_aspek}" data-bobot="${item.bobot}">
                                    <i class="fa fa-pencil"></i>
                                </button>
                                <button class="btn btn-xs btn-danger btn-delete-aspek" data-id="${item.id}" data-nama="${item.nama_aspek}">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    `;
                });
            }

            $('#tbody-aspek').html(html);

            // Update progress bar
            let pct = Math.min(100, totalBobot);
            $('#aspek-progress').css('width', pct + '%').text(totalBobot.toFixed(2) + '%').attr('aria-valuenow', pct);
            
            if (Math.abs(totalBobot - 100.00) < 0.01) {
                $('#aspek-progress').removeClass('bg-warning bg-danger').addClass('bg-success');
                $('#aspek-status-badge').removeClass('badge-warning badge-danger').addClass('badge-success').text('Bobot Pas (100.00%)');
            } else {
                $('#aspek-progress').removeClass('bg-success bg-danger').addClass('bg-warning');
                $('#aspek-status-badge').removeClass('badge-success badge-danger').addClass('badge-warning').text('Bobot Belum 100.00% (Tersisa: ' + (100 - totalBobot).toFixed(2) + '%)');
            }
        }

        // Trigger load
        loadAspek();
        $('#select-jalur').change(loadAspek);

        // Reset Aspek
        $('#btn-reset-aspek').click(function() {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Konfigurasi aspek penilaian saat ini akan direset ke pengaturan default (Substansi 60% & Ujian 40%)!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Reset!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Memproses...',
                        allowOutsideClick: false,
                        didOpen: () => { Swal.showLoading() }
                    });
                    
                    $.ajax({
                        type: 'POST',
                        url: apiUrl + 'kaprodi/skripsi/reset-aspek',
                        headers: {
                            'Authorization': 'Bearer ' + token,
                            'username': username
                        },
                        data: {
                            kode_prodi: kodeProdi,
                            jalur: $('#select-jalur').val()
                        },
                        success: function(res) {
                            if (res.status === 'success') {
                                Swal.fire('Berhasil!', res.message, 'success');
                                loadAspek();
                            } else {
                                Swal.fire('Gagal!', res.error || 'Gagal mereset aspek.', 'error');
                            }
                        },
                        error: function(err) {
                            Swal.fire('Error!', 'Terjadi kesalahan sistem.', 'error');
                        }
                    });
                }
            });
        });

        // Add Aspek
        $('#btn-add-aspek').click(function() {
            $('#form-aspek')[0].reset();
            $('#aspek-id').val('');
            $('#modal-title').text('Tambah Aspek Penilaian');
            $('#modal-aspek').modal('show');
        });

        // Edit Aspek
        $(document).on('click', '.btn-edit-aspek', function() {
            const id = $(this).data('id');
            const nama = $(this).data('nama');
            const bobot = $(this).data('bobot');

            $('#aspek-id').val(id);
            $('#aspek-nama').val(nama);
            $('#aspek-bobot').val(bobot);
            $('#modal-title').text('Edit Aspek Penilaian');
            $('#modal-aspek').modal('show');
        });

        // Save Aspek Form submit
        $('#form-aspek').submit(function(e) {
            e.preventDefault();
            
            const id = $('#aspek-id').val();
            const nama = $('#aspek-nama').val();
            const bobot = parseFloat($('#aspek-bobot').val());
            const jalur = $('#select-jalur').val();

            Swal.fire({
                title: 'Menyimpan...',
                allowOutsideClick: false,
                didOpen: () => { Swal.showLoading() }
            });

            $.ajax({
                type: 'POST',
                url: apiUrl + 'kaprodi/skripsi/save-aspek',
                headers: {
                    'Authorization': 'Bearer ' + token,
                    'username': username
                },
                data: {
                    id: id,
                    kode_prodi: kodeProdi,
                    nama_aspek: nama,
                    bobot: bobot,
                    jalur: jalur
                },
                success: function(res) {
                    if (res.status === 'success') {
                        $('#modal-aspek').modal('hide');
                        Swal.fire('Berhasil!', res.message, 'success');
                        loadAspek();
                    } else {
                        Swal.fire('Gagal!', res.error || 'Terjadi kesalahan.', 'error');
                    }
                },
                error: function(xhr) {
                    let err = 'Terjadi kesalahan sistem.';
                    if (xhr.responseJSON && xhr.responseJSON.error) {
                        err = Array.isArray(xhr.responseJSON.error) ? xhr.responseJSON.error.join('<br>') : xhr.responseJSON.error;
                    }
                    Swal.fire('Gagal menyimpan!', err, 'error');
                }
            });
        });

        // Delete Aspek
        $(document).on('click', '.btn-delete-aspek', function() {
            const id = $(this).data('id');
            const nama = $(this).data('nama');

            Swal.fire({
                title: 'Hapus Aspek?',
                html: `Apakah Anda yakin ingin menghapus aspek <b>${nama}</b>?<br><small class="text-danger">Aspek tidak dapat dihapus jika masih digunakan oleh indikator rubrik penilaian.</small>`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Menghapus...',
                        allowOutsideClick: false,
                        didOpen: () => { Swal.showLoading() }
                    });

                    $.ajax({
                        type: 'POST',
                        url: apiUrl + 'kaprodi/skripsi/delete-aspek/' + id,
                        headers: {
                            'Authorization': 'Bearer ' + token,
                            'username': username
                        },
                        success: function(res) {
                            if (res.status === 'success') {
                                Swal.fire('Terhapus!', res.message, 'success');
                                loadAspek();
                            } else {
                                Swal.fire('Gagal!', res.error || 'Gagal menghapus aspek.', 'error');
                            }
                        },
                        error: function(xhr) {
                            let err = 'Terjadi kesalahan sistem.';
                            if (xhr.responseJSON && xhr.responseJSON.error) {
                                err = xhr.responseJSON.error;
                            }
                            Swal.fire('Gagal!', err, 'error');
                        }
                    });
                }
            });
        });
    });
</script>
@endsection
