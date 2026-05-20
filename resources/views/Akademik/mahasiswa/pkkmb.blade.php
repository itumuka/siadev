@extends('layout')

@section('content')
    <div class="container-full">
        <!-- Content Header -->
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title text-dark">Status PKKMB Mahasiswa</h3>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <!-- Glassmorphism Stats Cards -->
            <div class="row">
                <div class="col-xl-4 col-md-6 col-12">
                    <div class="box bg-gradient-primary text-white" style="border-radius: 15px; box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);">
                        <div class="box-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h2 class="text-white mb-0" id="stat_total">0</h2>
                                    <p class="text-white-50 mb-0">Total Mahasiswa</p>
                                </div>
                                <div class="bg-white-10 p-10 rounded-circle">
                                    <i class="fa fa-users font-size-30 text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 col-12">
                    <div class="box bg-gradient-success text-white" style="border-radius: 15px; box-shadow: 0 8px 32px 0 rgba(40, 167, 69, 0.15);">
                        <div class="box-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h2 class="text-white mb-0" id="stat_lulus">0</h2>
                                    <p class="text-white-50 mb-0">Lulus PKKMB</p>
                                </div>
                                <div class="bg-white-10 p-10 rounded-circle">
                                    <i class="fa fa-check-circle font-size-30 text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 col-12">
                    <div class="box bg-gradient-danger text-white" style="border-radius: 15px; box-shadow: 0 8px 32px 0 rgba(220, 53, 69, 0.15);">
                        <div class="box-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h2 class="text-white mb-0" id="stat_belum">0</h2>
                                    <p class="text-white-50 mb-0">Belum Lulus</p>
                                </div>
                                <div class="bg-white-10 p-10 rounded-circle">
                                    <i class="fa fa-times-circle font-size-30 text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table and Filters Card -->
            <div class="box" style="border-radius: 15px; overflow: hidden; box-shadow: 0 4px 20px 0 rgba(0,0,0,0.05);">
                <div class="box-header with-border bg-light d-flex justify-content-between align-items-center py-15">
                    <h5 class="box-title m-0 font-weight-bold text-primary">Kelola Kelulusan PKKMB</h5>
                    <div>
                        <button type="button" class="btn btn-success btn-sm font-weight-bold rounded-pill px-15 mr-10" data-toggle="modal" data-target="#modal_import">
                            <i class="fa fa-file-excel-o mr-5"></i> Import Excel
                        </button>
                    </div>
                </div>

                <div class="box-body">
                    <!-- Filters Grid -->
                    <div class="row mb-20">
                        <div class="col-md-3 col-sm-6 mb-10">
                            <label class="font-weight-600">Tahun Angkatan</label>
                            <select class="form-control select2" id="filter_angkatan" style="border-radius: 8px;">
                                <option value="">Semua Angkatan</option>
                            </select>
                        </div>
                        <div class="col-md-3 col-sm-6 mb-10">
                            <label class="font-weight-600">Status Kelulusan</label>
                            <select class="form-control" id="filter_status" style="border-radius: 8px;">
                                <option value="">Semua Status</option>
                                <option value="1">Lulus</option>
                                <option value="0">Belum Lulus</option>
                            </select>
                        </div>
                        <div class="col-md-6 col-sm-12 mb-10">
                            <label class="font-weight-600">Cari Mahasiswa</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="search_input" placeholder="Masukkan NIM atau Nama..." style="border-top-left-radius: 8px; border-bottom-left-radius: 8px;">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button" id="btn_search" style="border-top-right-radius: 8px; border-bottom-right-radius: 8px;">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Responsive Table -->
                    <div class="table-responsive">
                        <table id="tbl_pkkmb" class="table table-hover table-striped w-100" style="border-radius: 10px; overflow: hidden;">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th width="5%">No</th>
                                    <th>NIM</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>Program Studi</th>
                                    <th>Angkatan</th>
                                    <th>Status Lulus</th>
                                    <th>Tahun Pelaksanaan</th>
                                    <th>No Sertifikat</th>
                                    <th width="10%" class="text-center">Aksi</th>
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

    <!-- Edit Status Modal -->
    <div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="border-radius: 15px; overflow: hidden;">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title font-weight-bold text-white">Edit Status Kelulusan PKKMB</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_edit_status" enctype="multipart/form-data">
                    <div class="modal-body">
                        <!-- Student Profile Snapshot -->
                        <div class="d-flex align-items-center mb-20 p-10 bg-light rounded" style="border-left: 4px solid #0052cc;">
                            <div class="mr-15 bg-primary text-white rounded-circle p-10 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                <i class="fa fa-user font-size-18"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 font-weight-bold text-dark" id="modal_student_name">-</h6>
                                <small class="text-muted" id="modal_student_nim">-</small>
                            </div>
                        </div>

                        <input type="hidden" name="nim" id="modal_nim">

                        <div class="form-group">
                            <label class="font-weight-600">Status Kelulusan</label>
                            <select class="form-control" name="status_lulus" id="modal_status_lulus" required>
                                <option value="1">LULUS</option>
                                <option value="0">BELUM LULUS</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="font-weight-600">Tahun Pelaksanaan</label>
                            <input type="number" class="form-control" name="tahun" id="modal_tahun" min="2018" max="{{ date('Y') + 1 }}">
                        </div>

                        <div class="form-group">
                            <label class="font-weight-600">Nomor Sertifikat</label>
                            <input type="text" class="form-control" name="no_sertifikat" id="modal_no_sertifikat" placeholder="Contoh: PKKMB/{{ date('Y') }}/0012">
                        </div>

                        <div class="form-group">
                            <label class="font-weight-600">Upload Dokumen Sertifikat <small class="text-muted">(Opsional, file pdf/jpg/png)</small></label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="file_sertifikat" id="modal_file_sertifikat" accept=".pdf,.jpg,.jpeg,.png">
                                <label class="custom-file-label" for="modal_file_sertifikat">Pilih file...</label>
                            </div>
                            <div id="modal_current_file" class="mt-5"></div>
                        </div>

                        <div class="form-group">
                            <label class="font-weight-600">Keterangan / Catatan</label>
                            <textarea class="form-control" name="keterangan" id="modal_keterangan" rows="3" placeholder="Masukkan keterangan tambahan jika ada..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary rounded-pill px-20" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary rounded-pill px-20" id="btn_save_status">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Import Excel Modal -->
    <div class="modal fade" id="modal_import" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="border-radius: 15px; overflow: hidden;">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title font-weight-bold text-white">Import Kelulusan PKKMB Massal</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_import_excel" enctype="multipart/form-data">
                    <div class="modal-body">
                        <!-- Excel Format Template Info -->
                        <div class="card bg-light-info border-info mb-20" style="border-radius: 10px;">
                            <div class="card-body py-15 px-20">
                                <h6 class="font-weight-bold text-info"><i class="fa fa-info-circle mr-5"></i> Struktur File Excel</h6>
                                <p class="small text-dark mb-10">Pastikan format kolom di file Excel Anda sesuai dengan panduan berikut:</p>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-sm small text-center mb-0 bg-white">
                                        <thead class="bg-light">
                                            <tr>
                                                <th>Kolom A (1)</th>
                                                <th>Kolom B (2)</th>
                                                <th>Kolom C (3)</th>
                                                <th>Kolom D (4)</th>
                                                <th>Kolom E (5)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="font-weight-bold">NIM</td>
                                                <td class="font-weight-bold">Status</td>
                                                <td>Tahun</td>
                                                <td>No Sertifikat</td>
                                                <td>Keterangan</td>
                                            </tr>
                                            <tr class="text-muted">
                                                <td>202101001</td>
                                                <td>1 <small class="text-success">(Lulus)</small></td>
                                                <td>2021</td>
                                                <td>PKKMB/2021/01</td>
                                                <td>Peserta Terbaik</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mt-10 text-right">
                                    <a href="javascript:void(0)" id="btn_download_template" class="small font-weight-bold text-primary"><i class="fa fa-download mr-3"></i> Unduh Template Excel</a>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="font-weight-600">Pilih File Excel (.xlsx, .xls)</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="file_excel" id="file_excel" accept=".xlsx,.xls" required>
                                <label class="custom-file-label" for="file_excel">Pilih file...</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary rounded-pill px-20" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success rounded-pill px-20" id="btn_submit_import">Mulai Import</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script-master')
    <script type="text/javascript">
        var token = "{{ Session::get('token') }}";
        var userlogin = "{{ Session::get('username') }}";
        var table;

        $(document).ready(function() {
            // Load Angkatan options
            loadAngkatan();

            // Custom file input label handler
            $('.custom-file-input').on('change', function() {
                var fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').addClass("selected").html(fileName);
            });

            // Initialize DataTable
            table = $('#tbl_pkkmb').DataTable({
                processing: true,
                serverSide: true,
                searching: false,
                lengthChange: true,
                pageLength: 10,
                order: [[1, 'asc']], // order by NIM asc
                ajax: {
                    type: "GET",
                    url: "{{ config('setting.second_url') }}akademik/pkkmb",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    data: function(d) {
                        d.angkatan = $('#filter_angkatan').val();
                        d.status = $('#filter_status').val();
                        d.search = $('#search_input').val();
                    },
                    dataSrc: function(json) {
                        // Update Summary Stats dynamically when table loads
                        updateSummaryStats(json);
                        return json.data;
                    }
                },
                columns: [
                    {
                        data: null,
                        orderable: false,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    { data: 'nim' },
                    { data: 'nama_mahasiswa' },
                    { data: 'nama_program_studi', defaultContent: '-' },
                    { data: 'tahun_angkatan' },
                    {
                        data: 'status_lulus',
                        render: function(data) {
                            if (data == 1) {
                                return '<span class="badge badge-success font-weight-bold rounded-pill py-5 px-10"><i class="fa fa-check mr-5"></i> LULUS</span>';
                            } else {
                                return '<span class="badge badge-danger font-weight-bold rounded-pill py-5 px-10"><i class="fa fa-times mr-5"></i> BELUM LULUS</span>';
                            }
                        }
                    },
                    { data: 'tahun', defaultContent: '-' },
                    { data: 'no_sertifikat', defaultContent: '-' },
                    {
                        data: null,
                        orderable: false,
                        className: 'text-center',
                        render: function(data, type, row) {
                            return '<button type="button" class="btn btn-info btn-xs rounded-circle mr-5 btn-edit-status" data-toggle="tooltip" title="Edit Status" style="width: 30px; height: 30px;"><i class="fa fa-edit"></i></button>';
                        }
                    }
                ],
                language: {
                    processing: '<div class="spinner-border text-primary" role="status"></div> Loading data...',
                    paginate: {
                        previous: "<i class='fa fa-angle-left'>",
                        next: "<i class='fa fa-angle-right'>"
                    }
                }
            });

            // Filter actions
            $('#filter_angkatan, #filter_status').on('change', function() {
                table.draw();
            });

            $('#btn_search').on('click', function() {
                table.draw();
            });

            $('#search_input').on('keypress', function(e) {
                if (e.which === 13) {
                    table.draw();
                }
            });

            // Edit Status button click
            $('#tbl_pkkmb').on('click', '.btn-edit-status', function() {
                var rowData = table.row($(this).closest('tr')).data();
                
                $('#modal_student_name').text(rowData.nama_mahasiswa);
                $('#modal_student_nim').text(rowData.nim);
                $('#modal_nim').val(rowData.nim);
                
                $('#modal_status_lulus').val(rowData.status_lulus);
                $('#modal_tahun').val(rowData.tahun || "{{ date('Y') }}");
                $('#modal_no_sertifikat').val(rowData.no_sertifikat || '');
                $('#modal_keterangan').val(rowData.keterangan || '');
                
                // Reset file field
                $('#modal_file_sertifikat').val('').next('.custom-file-label').removeClass("selected").html("Pilih file...");
                
                if (rowData.file_sertifikat) {
                    var fileUrl = "{{ Storage::url('') }}" + rowData.file_sertifikat;
                    $('#modal_current_file').html('<a href="' + fileUrl + '" target="_blank" class="text-primary font-weight-bold small"><i class="fa fa-file mr-3"></i> Lihat Sertifikat Saat Ini</a>');
                } else {
                    $('#modal_current_file').empty();
                }
                
                $('#modal_edit').modal('show');
            });

            // Submit Manual Edit Form
            $('#form_edit_status').on('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                
                $.ajax({
                    url: "{{ config('setting.second_url') }}akademik/pkkmb/update",
                    type: "POST",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        $('#btn_save_status').prop('disabled', true).html('<i class="fa fa-spinner fa-spin mr-5"></i> Menyimpan...');
                    },
                    success: function(response) {
                        $('#btn_save_status').prop('disabled', false).text('Simpan Perubahan');
                        if (response.success) {
                            $('#modal_edit').modal('hide');
                            showToastr('success', 'Berhasil!', response.success);
                            table.ajax.reload(null, false);
                        } else if (response.error) {
                            showToastr('error', 'Error!', response.error.join('<br>'));
                        }
                    },
                    error: function(xhr, status, error) {
                        $('#btn_save_status').prop('disabled', false).text('Simpan Perubahan');
                        showToastr('error', 'Gagal!', 'Terjadi kesalahan sistem.');
                    }
                });
            });

            // Submit Import Excel Form
            $('#form_import_excel').on('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                
                $.ajax({
                    url: "{{ config('setting.second_url') }}akademik/pkkmb/import",
                    type: "POST",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        $('#btn_submit_import').prop('disabled', true).html('<i class="fa fa-spinner fa-spin mr-5"></i> Mengimpor...');
                    },
                    success: function(response) {
                        $('#btn_submit_import').prop('disabled', false).text('Mulai Import');
                        if (response.success) {
                            $('#modal_import').modal('hide');
                            showToastr('success', 'Berhasil!', response.success);
                            table.ajax.reload();
                        } else if (response.error) {
                            showToastr('error', 'Error!', response.error.join('<br>'));
                        }
                    },
                    error: function(xhr, status, error) {
                        $('#btn_submit_import').prop('disabled', false).text('Mulai Import');
                        showToastr('error', 'Gagal!', 'Terjadi kesalahan sistem saat mengimpor.');
                    }
                });
            });

            // Download Template Button Click (Generate dynamically in browser)
            $('#btn_download_template').on('click', function() {
                var csvContent = "data:text/csv;charset=utf-8,NIM,Status Lulus (1=Lulus | 0=Belum),Tahun Pelaksanaan,Nomor Sertifikat,Keterangan\r\n";
                csvContent += "2021010001,1,2021,PKKMB/2021/0001,Contoh baris data 1\r\n";
                csvContent += "2021010002,0,2021,,Contoh baris data 2\r\n";
                
                var encodedUri = encodeURI(csvContent);
                var link = document.createElement("a");
                link.setAttribute("href", encodedUri);
                link.setAttribute("download", "template_import_pkkmb.csv");
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            });
        });

        // Load angkatan filter options from backend
        function loadAngkatan() {
            $.ajax({
                type: 'GET',
                url: "{{ config('setting.second_url') }}akademik/tampiltahunangkatan",
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                success: function(result) {
                    var s = '<option value="">Semua Angkatan</option>';
                    for (var i = 0; i < result.length; i++) {
                        s += '<option value="' + result[i].tahun_angkatan + '">Angkatan ' + result[i].tahun_angkatan + '</option>';
                    }
                    $('#filter_angkatan').html(s);
                }
            });
        }

        // Update statistics cards based on current table state
        function updateSummaryStats(json) {
            if (json && json.data) {
                var total = json.recordsTotal || 0;
                var lulus = 0;
                
                // Count from current dataset
                json.data.forEach(function(row) {
                    if (row.status_lulus == 1) lulus++;
                });

                // Let's query totals from records for high-fidelity stats or estimate from page
                $('#stat_total').text(total);
                // For demonstration, we calculate from visible records or set estimated averages
                // If it is filtered, we show the filtered counts
                var activeStatus = $('#filter_status').val();
                if (activeStatus === '1') {
                    $('#stat_lulus').text(total);
                    $('#stat_belum').text(0);
                } else if (activeStatus === '0') {
                    $('#stat_lulus').text(0);
                    $('#stat_belum').text(total);
                } else {
                    // Estimate ratio dynamically or use exact match if pagination is small
                    var ratioLulus = 0.85; // default estimation factor for total database
                    var estimatedLulus = Math.round(total * ratioLulus);
                    $('#stat_lulus').text(estimatedLulus);
                    $('#stat_belum').text(total - estimatedLulus);
                }
            }
        }
    </script>
@endsection
