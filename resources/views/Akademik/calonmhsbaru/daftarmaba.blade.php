@extends('layout')

@section('content')
    <div class="container-full">
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">Data calon Mahasiswa</h3>
                </div>

            </div>
        </div>
        <!-- Main content -->
        <section class="content">
            <div class="box">
                <div class="box-header with-border">
                    <h6 class="box-subtitle">Melihat Data calon Mahasiswa</h6>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <div class="box">
                        <div class="box-body ribbon-box bg-primary-light">
                            <div class="ribbon ribbon-info">informasi</div>
                            <p class="mb-0">Data calon mahasiswa baru ditampilkan per tahun angkatan. Untuk
                                menambahkan calon mahasiswa baru dapat menggunakan menu import dari data PMB atau mengisi
                                formulir tambah calon mahasiswa baru.</p>
                        </div> <!-- end box-body-->
                    </div>
                    <div class="box-header no-border">
                        <div class="row">
                            <div class="col-sm-2">
                                <label for="tahunakademik">&emsp;&emsp;&emsp;Tahun Akademik :</label>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <select class="form-control" name="tahunangkatan" id="tahunangkatan">
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="text-center">
                                    <a href="{{ route('aktambahcalonmhs') }}" type="button"
                                        class="btn btn-primary btn-sm float-right"><i class="fa fa-plus"></i>
                                        &nbspTambah</a>
                                    {{-- <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal"
                                        data-target="#modal_add"><i class="fa fa-plus"></i> Tambah</button> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="kgtdaftarmaba" class="table table-hover table-striped">
                            <thead class="bg-dark">
                                <tr>
                                    <th>No</th>
                                    <th>No. Pendaftaran</th>
                                    <th>Nama</th>
                                    <th>Tempat/Tgl Lahir</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Jurusan</th>
                                    <th>Jenis Kelas</th>
                                    <th>Jalur <br>PMB</th>
                                    <th>Proses</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            
    {{-- modal edit --}}

<div class="modal fade" id="modal_edit2">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Mahasiswa</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <form id="form_edit2" method="POST" enctype="multipart/form-data">
                
                <!-- /.box-body -->
                <div class="row">
                    <div class="col-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <h4 class="box-title text-primary"><i class="ti-user mr-15"></i> Mahasiswa/i : <span class="nama_mahasiswa12"></span> | Dosen Wali : <span class="id_dosen_wali11"></span>
                                </h4>
                            </div>
                            <div class="box-body pb-0">
                                <div class="row">
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label>NIK : <span class="danger">*</span></label>
                                            <input type="text" class="form-control" id="nik11" name="nik11" placeholder="NIK KTP" required>
                                            <input type="hidden" class="form-control" id="no_pendaftaran11" name="no_pendaftaran11" placeholder="NIK KTP" required>
                                            <input type="hidden" class="form-control" id="id_camaba" name="id_camaba" placeholder="NIK KTP" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="editprogramstudi">Nama Prodi :</label>
                                            <select class="form-control" name="editprogramstudi" id="editprogramstudi">
                                            <option value="">Pilih</option>
                                            <option value=""></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="nama_fakultas11">Nama Fakultas :</label>
                                            <select class="form-control" name="nama_fakultas11" id="nama_fakultas11">
                                            <option value="">Pilih</option>
                                            <option value=""></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="editjalurpmb"> Jalur PMB : <span class="danger">*</span>
                                            </label>
                                            <select class="form-control" style="width: 100%;" id="editjalurpmb" name="editjalurpmb" required>
                                                <option value="">Pilih Jalur</option>
                                                <option value=""></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label> Nama Lengkap : <span class="danger">*</span></label>
                                            <input type="text" class="form-control" id="nama_mahasiswa11" placeholder="Nama Lengkap" name="nama_mahasiswa11" required>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="tempat_lahir11"> Tempat Lahir : <span class="danger">*</span>
                                            </label>
                                            <input type="text" class="form-control" id="tempat_lahir11"
                                                placeholder="Tempat Lahir" name="tempat_lahir11" required>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="tgl_lahir11">Tanggal Lahir : <span
                                                    class="danger">*</span></label>
                                            <input type="date" class="form-control" id="tgl_lahir11"
                                                name="tgl_lahir11" placeholder="Tanggal Lahir" required>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="editagama">Agama : <span class="danger">*</span></label>
                                            <select class="form-control" style="width: 100%;" id="editagama"
                                                data-placeholder="Pilih Agama" name="editagama" required>
                                                <option value="">Pilih Agama</option>
                                                <option value=""></option>
                                            </select>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="kode_kewarganegaraan11">Kewarganegaraan : <span
                                                    class="danger">*</span></label>
                                            <select class="form-control" id="kode_kewarganegaraan11"
                                                style="width: 100%;" data-placeholder="Kewarganegaraan"
                                                name="kode_kewarganegaraan11" required>
                                                <option value="">Kewarganegaraan</option>
                                                <option value=""></option>
                                            </select>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="editjkmhs">Jenis Kelamin :</label>
                                            <select class="form-control" id="editjkmhs"
                                                style="width: 100%;" data-placeholder="Jenis Kelamin"
                                                name="editjkmhs" required>
                                                <option value="">Pilih Jenis Kelamin</option>
                                                <option value=""></option>
                                            </select>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="alamat_asal11"> Alamat Asal : <span class="danger">*</span>
                                            </label>
                                            <input type="text" class="form-control" id="alamat_asal11"
                                                name="alamat_asal11"placeholder="Alamat Asal" required>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="provinsi11"> Provinsi : <span class="danger">*</span>
                                            </label>
                                            <select class="form-control" id="provinsi11" name="provinsi11"
                                                style="width: 100%;" onchange="tampilkabupaten(this.value)">
                                                <option value="">Pilih Provinsi</option>
                                            </select>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="kabupaten11"> Kabupaten : <span class="danger">*</span>
                                            </label>
                                            <select class="form-control" id="kabupaten11" name="kabupaten11" style="width: 100%;" >
                                                <option value="">Pilih Provinsi dulu</option>
                                            </select>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="rt11"> RT : <span class="danger">*</span>
                                            </label>
                                            <input type="text" class="form-control" id="rt11" name="rt11"
                                                placeholder="RT" required>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="rw11"> RW : <span class="danger">*</span>
                                            </label>
                                            <input type="text" class="form-control" id="rw11" name="rw11"
                                                placeholder="RW" required>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="kode_pos_mhs"> Kode Pos : <span class="danger">*</span>
                                            </label>
                                            <input type="text" class="form-control" id="kode_pos_mhs"
                                                name="kode_pos_mhs" placeholder="Kode Pos" required>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="telp11"> No Telepon : <span class="danger">*</span>
                                            </label>
                                            <input type="text" class="form-control" id="telp11"
                                                name="telp11" placeholder="No Telepon" required>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="email111"> Email : <span class="danger">*</span>
                                            </label>
                                            <input type="email" class="form-control" id="email111" name="email111"
                                                placeholder="Email" required>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.box-body -->
                            <!-- /.row -->
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="col-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <h4 class="box-title text-primary"><i class="fa fa-university"></i> Data Pendidikan
                                </h4>
                            </div>
                            <div class="box-body pb-0">
                                <div class="row">
                                    <!-- /.col -->
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="pendidikan_terakhir11">Pendidikan Terakhir :</label>
                                            <input type="text" class="form-control" id="pendidikan_terakhir11"
                                                name="pendidikan_terakhir11" placeholder="Pendidikan Terakhir">
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->

                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="jurusan_slta11">Jurusan :</label>
                                            <input type="text" class="form-control" id="jurusan_slta11" name="jurusan_slta11"
                                                placeholder="Jurusan" required>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="no_ijazah_slta11">No Ijazah : <span class="danger">*</span></label>
                                            <input type="text" class="form-control" id="no_ijazah_slta11"
                                                name="no_ijazah_slta11" placeholder="No Ijazah" required>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="nisn_mhs11">NISN : <span class="danger">*</span></label>
                                            <input type="text" class="form-control" id="nisn_mhs11" name="nisn_mhs11"
                                                placeholder="NISN" required>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="tahun_ijazah_slta11">Tahun Ijazah :</label>
                                            <input type="text" class="form-control" id="tahun_ijazah_slta11"
                                                placeholder="Tahun Ijazah" name="tahun_ijazah_slta11" required>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="alamat_slta11">Alamat Sekolah :</label>
                                            <textarea name="alamat_slta11" id="alamat_slta11" rows="6" class="form-control"></textarea>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="col-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <h4 class="box-title text-primary"><i class="fa fa-male"></i><i
                                        class="fa fa-female"></i> Data Ayah</h4>
                            </div>
                            <div class="box-body pb-0">
                                <div class="row">
                                    <!-- /.col -->
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="nama_ayah11">Nama Ayah :</label>
                                            <input type="text" class="form-control" id="nama_ayah11"
                                                name="nama_ayah11" placeholder="Nama Ayah" required>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="kode_agama_ayah11">Agama :</label>
                                            <select class="form-control" id="kode_agama_ayah11" name="kode_agama_ayah11"
                                                style="width: 100%;" required>
                                                <option value="">Pilih Agama</option>
                                                <option value=""></option>
                                            </select>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="pekerjaan_ayah11">Pekerjaan :</label>
                                            <select class="form-control" id="pekerjaan_ayah11"
                                                style="width: 100%;" name="pekerjaan_ayah11" required>
                                                <option value="">Pilih Pekerjaan</option>
                                                <option value=""></option>
                                            </select>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="jenjang_pendidikan_ayah11">Pendidikan :</label>
                                            <select class="form-control" id="jenjang_pendidikan_ayah11"
                                                style="width: 100%;" name="jenjang_pendidikan_ayah11" required>
                                                <option value="">Pilih Pendidikan</option>
                                                <option value=""></option>
                                            </select>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="telepon_ayah11"> No Telepon / HP : <span class="danger">*</span>
                                            </label>
                                            <input type="text" class="form-control" id="telepon_ayah11"
                                                name="telepon_ayah11" placeholder="No Telepon / HP" required>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="kode_penghasilan_ayah11">Penghasilan_ayah/Bulan :</label>
                                            <select class="form-control" id="kode_penghasilan_ayah11"
                                                style="width: 100%;" name="kode_penghasilan_ayah11" required>
                                                <option value="">Pilih Penghasilan</option>
                                                <option value=""></option>
                                            </select>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <!-- /.box-body -->
                    <div class="col-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <h4 class="box-title text-primary"><i class="fa fa-male"></i><i
                                        class="fa fa-female"></i> Data Ibu</h4>
                            </div>
                            <div class="box-body pb-0">
                                <div class="row">
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="nama_ibu11">Nama Ibu : <span class="danger">*</span></label>
                                            <input type="text" class="form-control" id="nama_ibu11"
                                                name="nama_ibu11" placeholder="Nama Ibu" required>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="kode_agama_ibu11">Agama :</label>
                                            <select class="form-control" id="kode_agama_ibu11" name="kode_agama_ibu11"
                                                style="width: 100%;" required>
                                                <option value="">Pilih Agama</option>
                                                <option value=""></option>
                                            </select>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="pekerjaan_ibu11">Pekerjaan :</label>
                                            <select class="form-control" id="pekerjaan_ibu11"
                                                style="width: 100%;" name="pekerjaan_ibu11" required>
                                                <option value="">Pilih Pekerjaan</option>
                                                <option value=""></option>
                                            </select>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="jenjang_pendidikan_ibu11">Pendidikan :</label>
                                            <select class="form-control" id="jenjang_pendidikan_ibu11"
                                                style="width: 100%;" name="jenjang_pendidikan_ibu11" required>
                                                <option value="">Pilih Pendidikan</option>
                                                <option value=""></option>
                                            </select>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="telepon_ibu11"> No Telepon / HP : <span class="danger">*</span>
                                            </label>
                                            <input type="text" class="form-control" id="telepon_ibu11"
                                                name="telepon_ibu11" placeholder="No Telepon / HP" required>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="kode_penghasilan_ibu11">Penghasilan/Bulan :</label>
                                            <select class="form-control" id="kode_penghasilan_ibu11"
                                                style="width: 100%;" name="kode_penghasilan_ibu11" required>
                                                <option value="">Pilih Penghasilan</option>
                                                <option value=""></option>
                                            </select>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="col-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <h4 class="box-title text-primary"><i class="fa fa-map-pin"></i> Alamat Orang Tua</h4>
                            </div>
                            <div class="box-body pb-0">
                                <div class="row">
                                    <!-- /.col -->
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="alamat_ayah11"> Alamat Asal : <span class="danger">*</span>
                                            </label>
                                            <input type="text" class="form-control" id="alamat_ayah11"
                                                name="alamat_ayah11" placeholder="Alamat Asal" required>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="provinsi"> Provinsi : <span class="danger">*</span>
                                            </label>
                                            <select class="select2 form-control" id="provinsiortu11"
                                                name="provinsiortu11" onchange="tampilkabupatenortu(this.value)"
                                                style="width: 100%;">
                                                <option value="">Pilih Provinsi</option>
                                            </select>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="kabupatenortu11"> Kabupaten : <span class="danger">*</span>
                                            </label>
                                            <select class="select2 form-control" id="kabupatenortu11"
                                                style="width: 100%;" name="kabupatenortu11">
                                                <option value="">Pilih Kabupaten</option>
                                            </select>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="rt_ayah11"> RT : <span class="danger">*</span>
                                            </label>
                                            <input type="text" class="form-control" id="rt_ayah11" name="rt_ayah11"
                                                placeholder="RT" required>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="rw_ayah11"> RW : <span class="danger">*</span>
                                            </label>
                                            <input type="text" class="form-control" id="rw_ayah11" name="rw_ayah11"
                                                placeholder="RW" required>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-3 col-12">
                                        <div class="form-group">
                                            <label for="kode_pos_ayah11"> Kode Pos : <span class="danger">*</span>
                                            </label>
                                            <input type="text" class="form-control" id="kode_pos_ayah11"
                                                name="kode_pos_ayah11" placeholder="Kode Pos" required>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer float-right">
                    <button type="submit" class="btn btn-rounded btn-primary btn-outline" id="btsubmit">
                        <i class="ti-save-alt"></i> Save
                    </button>
                    <button type="button" class="btn btn-rounded btn-warning btn-outline mr-1" data-dismiss="modal">
                        <i class="fa fa-times"></i> Close
                    </button>
                </div>
                <!-- <center><button type="submit" class="btn btn-rounded btn-info">Simpan Data Camaba</button></center> -->
                <br>
            </form>
            <!-- /.box -->
    </div>
    <!-- /.modal-dialog -->
            {{-- modal edit --}}

            <div class="modal fade" id="modal_edit">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Fakultas</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                        </div>
                        <form>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div id="image-popups" class="row">
                                            <center>
                                                <div class="col-sm-5">
                                                    <a href="{{ url('images/gallery/thumb/10.jpg') }}"
                                                        data-effect="mfp-zoom-in"><img
                                                            src="{{ url('images/gallery/thumb/10.jpg') }}" class="img-fluid"
                                                            alt="" /></a>
                                                </div>
                                            </center>
                                        </div><br><br>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">Nama</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" name="nama_camaba"
                                                    id="nama_camaba" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">No Pendaftaran</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" name="no_pendaftaran"
                                                    id="no_pendaftaran" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-2">Jenis Kelamin</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" name="jenis_kelamin"
                                                    id="jenis_kelamin" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="box box-default">
                                            <!-- /.box-header -->
                                            <div class="box-body">
                                                <!-- Nav tabs -->
                                                <ul class="nav nav-tabs" role="tablist">
                                                    <li class="nav-item"> <a class="nav-link active" data-toggle="tab"
                                                            href="#home8" role="tab"><span><i
                                                                    class="ion-home mr-15"></i>Data Mahasiswa</span></a>
                                                    </li>
                                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab"
                                                            href="#profile8" role="tab"><span><i
                                                                    class="ion-person mr-15"></i>Pendidikan</span></a> </li>
                                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab"
                                                            href="#messages8" role="tab"><span><i
                                                                    class="ion-email mr-15"></i>Orang Tua</span></a> </li>
                                                </ul>
                                                <!-- Tab panes -->
                                                <div class="tab-content tabcontent-border">
                                                    <div class="tab-pane active" id="home8" role="tabpanel">
                                                        <div class="p-15">
                                                            <table>
                                                                <tr>
                                                                    <td>Nama</td>
                                                                    <td>:</td>
                                                                    <td>Nama</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Nama</td>
                                                                    <td>:</td>
                                                                    <td>Nama</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Nama</td>
                                                                    <td>:</td>
                                                                    <td>Nama</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Nama</td>
                                                                    <td>:</td>
                                                                    <td>Nama</td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="profile8" role="tabpanel">
                                                        <div class="p-15">
                                                            <table>
                                                                <tr>
                                                                    <td>Nama</td>
                                                                    <td>:</td>
                                                                    <td>Nama</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Nama</td>
                                                                    <td>:</td>
                                                                    <td>Nama</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Nama</td>
                                                                    <td>:</td>
                                                                    <td>Nama</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Nama</td>
                                                                    <td>:</td>
                                                                    <td>Nama</td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="messages8" role="tabpanel">
                                                        <div class="p-15">
                                                            <table>
                                                                <tr>
                                                                    <td>Nama</td>
                                                                    <td>:</td>
                                                                    <td>Nama</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Nama</td>
                                                                    <td>:</td>
                                                                    <td>Nama</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Nama</td>
                                                                    <td>:</td>
                                                                    <td>Nama</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Nama</td>
                                                                    <td>:</td>
                                                                    <td>Nama</td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.box-body -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer float-right">
                                <button type="button" class="btn btn-rounded btn-warning btn-outline mr-1"
                                    data-dismiss="modal">
                                    <i class="fa fa-times"></i> Close
                                </button>
                            </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->

            </div>

    </div>
    </section>
    <!-- /.content -->
    </div>
@endsection
@section('script-master')
    <script type="text/javascript">
            var token = "{{ Session::get('token') }}";
            var userlogin = "{{ Session::get('username') }}";
        
        function editprogramstudi() {
        $.ajax({
            type: 'GET',
            url: "{{ config('setting.second_url') }}akademik/edittampilprogramstudi",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
            success: function(result) {
                var jml = result.length;
                var s = '<option value="">-Pilih Program Studi-</option>';
                for (i = 0; i < jml; i++) {
                    s = s + '<option value="' + result[i].kode_program_studi + '"> ' + result[i].nama_program_studi + '</option>';
                }
                // console.log(result);
                $('#editprogramstudi').html(s);
            }
        })
    }
    editprogramstudi();
        function editagama() {
            $.ajax({
                type: 'GET',
                url: "{{ config('setting.second_url') }}akademik/edittampilagama",
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                success: function(result) {
                    var jml = result.length;
                    var s = '<option value="">-Pilih-</option>';
                    for (i = 0; i < jml; i++) {
                        s = s + '<option value="' + result[i].kode_agama + '"> ' + result[i]
                            .nama_agama + '</option>';
                    }
                    // console.log(result);
                    $('#editagama').html(s);
                }
            })
        }
        editagama();

        function editjkmhs() {
            $.ajax({
                type: 'GET',
                url: "{{ config('setting.second_url') }}akademik/edittampiljeniskelamin",
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                success: function(result) {
                    var jml = result.length;
                    var s = '<option value="">-Pilih-</option>';
                    for (i = 0; i < jml; i++) {
                        s = s + '<option value="' + result[i].kode_jenis_kelamin + '"> ' + result[i]
                            .nama_jenis_kelamin + '</option>';
                    }
                    // console.log(result);
                    $('#editjkmhs').html(s);
                }
            })
        }
        editjkmhs();
        function editagamaayah() {
            $.ajax({
                type: 'GET',
                url: "{{ config('setting.second_url') }}akademik/edittampilagama",
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                success: function(result) {
                    var jml = result.length;
                    var s = '<option value="">-Pilih-</option>';
                    for (i = 0; i < jml; i++) {
                        s = s + '<option value="' + result[i].kode_agama + '"> ' + result[i]
                            .nama_agama + '</option>';
                    }
                    // console.log(result);
                    $('#kode_agama_ayah11').html(s);
                }
            })
        }
        editagamaayah();

        function editagamaibu() {
            $.ajax({
                type: 'GET',
                url: "{{ config('setting.second_url') }}akademik/edittampilagama",
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                success: function(result) {
                    var jml = result.length;
                    var s = '<option value="">-Pilih-</option>';
                    for (i = 0; i < jml; i++) {
                        s = s + '<option value="' + result[i].kode_agama + '"> ' + result[i]
                            .nama_agama + '</option>';
                    }
                    // console.log(result);
                    $('#kode_agama_ibu11').html(s);
                }
            })
        }
        editagamaibu();

        function editfakultas() {
            $.ajax({
                type: 'GET',
                url: "{{ config('setting.second_url') }}akademik/edittampilfakultas",
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                success: function(result) {
                    var jml = result.length;
                    var s = '<option value="">-Pilih-</option>';
                    for (i = 0; i < jml; i++) {
                        s = s + '<option value="' + result[i].kode_fakultas + '"> ' + result[i]
                            .nama_fakultas + '</option>';
                    }
                    // console.log(result);
                    $('#nama_fakultas11').html(s);
                }
            })
        }
        editfakultas();

        function editprogrampendidikan() {
            $.ajax({
                type: 'GET',
                url: "{{ config('setting.second_url') }}akademik/edittampilkelas",
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                success: function(result) {
                    var jml = result.length;
                    var s = '<option value="">-Pilih-</option>';
                    for (i = 0; i < jml; i++) {
                        s = s + '<option value="' + result[i].kode_program_pendidikan + '"> ' + result[i]
                            .nama_program_pendidikan + '</option>';
                    }
                    // console.log(result);
                    $('#nama_program_pendidikan11').html(s);
                }
            })
        }
        editprogrampendidikan();

        function editjalurpmb() {
            $.ajax({
                type: 'GET',
                url: "{{ config('setting.second_url') }}akademik/edittampiljalurpmb",
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                success: function(result) {
                    var jml = result.length;
                    var s = '<option value="">-Pilih-</option>';
                    for (i = 0; i < jml; i++) {
                        s = s + '<option value="' + result[i].kode_jalur_pmb + '"> ' + result[i]
                            .nama_jalur + '</option>';
                    }
                    // console.log(result);
                    $('#editjalurpmb').html(s);
                }
            })
        }
        editjalurpmb();

        function editstatusnikah() {
            $.ajax({
                type: 'GET',
                url: "{{ config('setting.second_url') }}akademik/edittampilstatusnikah",
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                success: function(result) {
                    var jml = result.length;
                    var s = '<option value="">-Pilih-</option>';
                    for (i = 0; i < jml; i++) {
                        s = s + '<option value="' + result[i].id + '"> ' + result[i]
                            .nama_status_nikah + '</option>';
                    }
                    // console.log(result);
                    $('#status_nikah11').html(s);
                }
            })
        }
        editstatusnikah();

        function editkewarganegaraan() {
            $.ajax({
                type: 'GET',
                url: "{{ config('setting.second_url') }}akademik/edittampilkewarganegaraan",
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                success: function(result) {
                    var jml = result.length;
                    var s = '<option value="">-Pilih-</option>';
                    for (i = 0; i < jml; i++) {
                        s = s + '<option value="' + result[i].kode_kewarganegaraan + '"> ' + result[i]
                            .nama_kewarganegaraan + '</option>';
                    }
                    // console.log(result);
                    $('#kode_kewarganegaraan11').html(s);
                }
            })
        }
        editkewarganegaraan();

        function editjenjangpendidikanayah() {
            $.ajax({
                type: 'GET',
                url: "{{ config('setting.second_url') }}akademik/edittampiljenjangpendidikan",
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                success: function(result) {
                    var jml = result.length;
                    var s = '<option value="">-Pilih-</option>';
                    for (i = 0; i < jml; i++) {
                        s = s + '<option value="' + result[i].pendidikan_id + '"> ' + result[i]
                            .pendidikan_nama + '</option>';
                    }
                    // console.log(result);
                    $('#jenjang_pendidikan_ayah11').html(s);
                }
            })
        }
        editjenjangpendidikanayah();

        function editjenjangpendidikanibu() {
            $.ajax({
                type: 'GET',
                url: "{{ config('setting.second_url') }}akademik/edittampiljenjangpendidikan",
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                success: function(result) {
                    var jml = result.length;
                    var s = '<option value="">-Pilih-</option>';
                    for (i = 0; i < jml; i++) {
                        s = s + '<option value="' + result[i].pendidikan_id + '"> ' + result[i]
                            .pendidikan_nama + '</option>';
                    }
                    // console.log(result);
                    $('#jenjang_pendidikan_ibu11').html(s);
                }
            })
        }
        editjenjangpendidikanibu();

        function editjenispekerjaanibu() {
            $.ajax({
                type: 'GET',
                url: "{{ config('setting.second_url') }}akademik/edittampiljenispekerjaan",
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                success: function(result) {
                    var jml = result.length;
                    var s = '<option value="">-Pilih-</option>';
                    for (i = 0; i < jml; i++) {
                        s = s + '<option value="' + result[i].pekerjaan_id + '"> ' + result[i]
                            .pekerjaan_singkatan + '</option>';
                    }
                    // console.log(result);
                    $('#pekerjaan_ibu11').html(s);
                }
            })
        }
        editjenispekerjaanibu();

        function editjenispekerjaanayah() {
            $.ajax({
                type: 'GET',
                url: "{{ config('setting.second_url') }}akademik/edittampiljenispekerjaan",
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                success: function(result) {
                    var jml = result.length;
                    var s = '<option value="">-Pilih-</option>';
                    for (i = 0; i < jml; i++) {
                        s = s + '<option value="' + result[i].pekerjaan_id + '"> ' + result[i]
                            .pekerjaan_singkatan + '</option>';
                    }
                    // console.log(result);
                    $('#pekerjaan_ayah11').html(s);
                }
            })
        }
        editjenispekerjaanayah();

        function editkodepenghasilanayah() {
            $.ajax({
                type: 'GET',
                url: "{{ config('setting.second_url') }}akademik/edittampilpenghasilan",
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                success: function(result) {
                    var jml = result.length;
                    var s = '<option value="">-Pilih-</option>';
                    for (i = 0; i < jml; i++) {
                        s = s + '<option value="' + result[i].penghasilan_id + '"> ' + result[i]
                            .penghasilan_nama + '</option>';
                    }
                    // console.log(result);
                    $('#kode_penghasilan_ayah11').html(s);
                }
            })
        }
        editkodepenghasilanayah();

        function editkodepenghasilanibu() {
            $.ajax({
                type: 'GET',
                url: "{{ config('setting.second_url') }}akademik/edittampilpenghasilan",
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                success: function(result) {
                    var jml = result.length;
                    var s = '<option value="">-Pilih-</option>';
                    for (i = 0; i < jml; i++) {
                        s = s + '<option value="' + result[i].penghasilan_id + '"> ' + result[i]
                            .penghasilan_nama + '</option>';
                    }
                    // console.log(result);
                    $('#kode_penghasilan_ibu11').html(s);
                }
            })
        }
        editkodepenghasilanibu();
        $(document).ready(function() {
            var token = "{{ Session::get('token') }}";
            var userlogin = "{{ Session::get('username') }}";
            tahunangkatan();

            function ubahformattgl(inputDate, format) {
                //parse the input date
                const date = new Date(inputDate);

                //extract the parts of the date
                const day = date.getDate();
                const month = date.getMonth() + 1;
                const year = date.getFullYear();

                //replace the month
                format = format.replace("MM", month.toString().padStart(2, "0"));

                //replace the year
                if (format.indexOf("yyyy") > -1) {
                    format = format.replace("yyyy", year.toString());
                } else if (format.indexOf("yy") > -1) {
                    format = format.replace("yy", year.toString().substr(2, 2));
                }

                //replace the day
                format = format.replace("dd", day.toString().padStart(2, "0"));

                return format;
            }


            function tahunangkatan() {
                $.ajax({
                    type: 'GET',
                    url: "{{ config('setting.second_url') }}akademik/tampiltahunangkatanmaba",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    success: function(result) {
                        var jml = result.length;
                        var s = '';
                        for (i = 0; i < jml; i++) {
                            s = s + '<option value="' + result[i].tahun_angkatan + '"> ' + result[i]
                                .tahun_angkatan +
                                '</option>';
                        }
                        s = s + '<option value="">Semua Tahun</option>';
                        // console.log(result);
                        $('#tahunangkatan').html(s);
                        var thnn = $('#tahunangkatan').val();
                        tbnilai(thnn);
                    }
                })
            }

            $('#tahunangkatan').on('change', function(event) {
                var thnn = $('#tahunangkatan').val();
                tbnilai(thnn);

            });


            var id_camaba = $('#id_camaba').val();

            // function dropdown_angkatan() {
            //     $.ajax({
            //         type: "POST",
            //         url: "{{ config('setting.second_url') }}akademik/dropdown-angkatan",
            //         dataType: "json",
            //         headers: {
            //             "Authorization": 'Bearer ' + token,
            //             "username": userlogin
            //         },
            //         success: function(data) {
            //             // $('.test').fadeOut();
            //             let target = $(".dropdown-prodi")
            //             $.each(data, function(index, value) {
            //                 var el = data[index];
            //                 var flag = 0;
            //                 target.append(
            //                     '<a href="#" class="dropdown-item" id="btmodal_add" data-id=' +
            //                     el.id_mhs + ' data-prodi=' + el
            //                     .tahun_angkatan +
            //                     ' data-toggle="modal" data-target="#modal_add">' + el
            //                     .tahun_angkatan + '</a>')
            //             });
            //         },
            //         error: function(error) {
            //             alert(error);
            //         }
            //     });
            // }
            // dropdown_angkatan();

            function tbnilai(thn) {
                var table = $("#kgtdaftarmaba").DataTable({
                    destroy: true,
                    dom: 'l<br>Bfrtip',
                    buttons: [
                        'copy', 'csv', 'excel'
                    ],
                    // responsive: true,
                    // autoWidth: false,
                    // lengthMenu: [
                    //     [10, 25, 50, -1],
                    //     [10, 25, 50, "All"]
                    // ],
                    processing: true,
                    lengthChange: true,
                    // searching: false,
                    // serverSide: true,
                    // stateSave: true,
                    // scrollX: true,
                    // orderable: false,
                    ajax: {
                        type: "GET",
                        url: "{{ config('setting.second_url') }}akademik/daftarmaba",
                        headers: {
                            "Authorization": 'Bearer ' + token,
                            "username": userlogin
                        },
                        data: {
                            tahunangkatan: thn,
                        },
                        dataSrc: function(json) {
                            return json;
                        }
                    },
                    columns: [{
                            data: null,
                            render: function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }
                        },

                        {
                            data: 'no_pendaftaran'
                        },
                        {
                            data: 'nama_camaba'
                        },
                        {
                            data: null,
                            render: function(data, type, full, meta) {
                                return full.tempat_lahir + ', ' + ubahformattgl(full.tanggal_lahir,
                                    'dd-MM-yyyy');
                            }
                        },
                        {
                            data: null,
                            render: function(data, type, full, meta) {
                                if (full.jenis_kelamin == 'L') {
                                    return 'Laki-laki';
                                } else if (full.jenis_kelamin == 'P') {
                                    return 'Perempuan';
                                } else {
                                    return '-';
                                }
                            }
                        },
                        {
                            data: 'nama_program_studi'
                        },
                        {
                            data: 'nama_program_pendidikan'
                        },
                        {
                            data: 'nama_jalur'
                        },
                        {
                            data: null,
                            render: function(data, type, full, meta) {
                                if (full.id_camaba < '0') {
                                    return '<a href="javascript:void(0)" class="text-primary mr-10" id="bt_edit2" data-toggle="tooltip" data-original-title="Edit"><i class="ti-marker-alt"></i></a>';
                                } else {
                                    return '<a href="javascript:void(0)" class="text-primary mr-10" id="bt_edit2" data-toggle="tooltip" data-original-title="Edit"><i class="ti-marker-alt"></i></a> | <a href="javascript:void(0)" class="text-danger del" data-id="' +
                                        full.id_camaba +
                                        '" data-original-title="Delete" data-toggle="tooltip"><i class="ti-trash"></i></a>';

                                }
                            }
                        },

                    ],
                    order: []
                });


                // show data edit
                table.on('click', '#bt_edit', function() {
                    $tr = $(this).closest('tr');
                    var data = table.row($tr).data();
                    $('#modal_edit').modal('show');
                    $('#nama_camaba').val(data['nama_camaba']);
                    $('#no_pendaftaran').val(data['no_pendaftaran']);
                    $('#jenis_kelamin').val(data['jenis_kelamin']);
                    $('#tempat_lahir').val(data['tempat_lahir']);
                    $('#tanggal_lahir').val(data['tanggal_lahir']);
                    $('#alamat_asal').val(data['alamat_asal']);
                    $('#semester').val(data['semester']);
                    $('#tahun').val(data['tahun']);
                    $('#kode_kewarganegaraan').val(data['kode_kewarganegaraan']);
                    $('#kode_agama').val(data['kode_agama']);
                    $('#rt').val(data['rt']);
                    $('#rw').val(data['rw']);
                    $('#telp').val(data['telp']);
                    $('#email').val(data['email']);
                });

                // show data edit
                table.on('click', '#bt_edit2', function() {
                    $tr = $(this).closest('tr');
                    var data = table.row($tr).data();
                    $('#modal_edit2').modal('show');
                    $('#nama_mahasiswa11').val(data['nama_camaba']);
                    $('#nama_mahasiswa111').val(data['nama_camaba']);
                    $('#id_camaba').val(data['id_camaba']);
                    $('#nama_ayah11').val(data['nama_ayah']);
                    $('#nisn_mhs11').val(data['nisn']);
                    $('#nama_ibu11').val(data['nama_ibu']);
                    $('#no_pendaftaran11').val(data['pendaftaran_mhs']);
                    $('#no_pendaftaran111').val(data['pendaftaran_mhs']);
                    $('#tgl_registrasi11').val(data['tgl_registrasi']);
                    $('#nim11').val(data['nim']);
                    $('#nim111').val(data['nim']);
                    $('#nik11').val(data['nik_mhs']);
                    $('.nama_mahasiswa12').html(data['nama_camaba']);
                    $('#editjalurpmb').val(data['kode_jalur_pmb']);
                    $('#editjkmhs').val(data['jk_mhs']);
                    $('#provinsi11').val(data['provinsi_mhs']);
                    $('#kabupaten11').val(data['kabupaten_mhs']);
                    $('#jenis_kelamin111').val(data['jk_mhs']);
                    $('#tempat_lahir11').val(data['tempat_lahir_mhs']);
                    $('#tempat_lahir111').val(data['tempat_lahir_mhs']);
                    $('#tgl_lahir11').val(data['tanggal_lahir_mhs']);
                    $('#tanggal_lahir111').val(data['tanggal_lahir_mhs']);
                    $('#alamat_asal11').val(data['alamat_mhs']);
                    $('#alamat_asal111').val(data['alamat_mhs']);
                    $('#semester11').val(data['semester']);
                    $('#semester111').val(data['semester']);
                    $('#tahun_angkatan11').val(data['tahun_angkatan']);
                    $('#tahun_angkatan111').val(data['tahun_angkatan']);
                    $('#status_mhs11').val(data['status_mhs']);
                    $('#kode_kewarganegaraan11').val(data['kode_kewarganegaraan']);
                    $('#nama_kewarganegaraan11').val(data['nama_kewarganegaraan']);
                    $('#nama_kewarganegaraan111').val(data['nama_kewarganegaraan']);
                    $('#editagama').val(data['agama_mhs']);
                    console.log(data['kode_agama']);
                    $('#nama_agama111').val(data['kode_agama']);
                    $('#agama_ayah11').val(data['kode_agama']);
                    $('#agama_ibu11').val(data['kode_agama']);
                    $('#kode_agama_ayah11').val(data['agama_ayah']);
                    $('#kode_agama_ibu11').val(data['agama_ibu']);
                    $('#rt11').val(data['rt_mhs']);
                    $('#rt111').val(data['rt_mhs']);
                    $('#rt_ayah11').val(data['rt_ayah']);
                    $('#rw_ayah11').val(data['rw_ayah']);
                    $('#rw11').val(data['rw_mhs']);
                    $('#rw111').val(data['rw_mhs']);
                    $('#rw_ibu11').val(data['rw_ibu']);
                    $('#telp11').val(data['telp']);
                    $('#kode_pos_ayah11').val(data['kode_pos_ayah']);
                    $('#kode_pos_mhs').val(data['kode_pos_mhs']);
                    $('#jenjang_pendidikan_ayah11').val(data['jenjangpendidikan_ayah']);
                    $('#jenjang_pendidikan_ibu11').val(data['jenjangpendidikan_ibu']);
                    $('#pekerjaan_ayah11').val(data['kode_pekerjaan_ayah']);
                    $('#pekerjaan_ibu11').val(data['kode_pekerjaan_ibu']);
                    $('#kode_jenis_pekerjaan_ayah11').val(data['kode_pekerjaan_ayah']);
                    $('#kode_jenis_pekerjaan_ibu11').val(data['kode_pekerjaan_ibu']);
                    $('#kode_penghasilan_ayah11').val(data['kode_penghasilan_ayah']);
                    $('#kode_penghasilan_ibu11').val(data['kode_penghasilan_ibu']);
                    $('#kode_pos_ibu11').val(data['kode_pos_ibu']);
                    $('#telepon_ayah11').val(data['telepon_ayah']);
                    $('#telepon_ibu11').val(data['telepon']);
                    $('#alamat_ayah11').val(data['alamat_ayah']);
                    $('#alamat_ibu11').val(data['alamat_ibu']);
                    $('#telp111').val(data['telp']);
                    $('#email11').val(data['email_mhs']);
                    $('#email111').val(data['email_mhs']);
                    $('#nama_program_pendidikan11').val(data['kode_program_pendidikan']);
                    $('#nama_program_pendidikan111').val(data['nama_program_pendidikan']);
                    $('#nama_fakultas11').val(data['kode_fakultas']);
                    $('#nama_fakultas111').val(data['nama_fakultas']);
                    $('#nama_program_studi11').val(data['kode_program_studi']);
                    $('#nama_program_studi111').val(data['nama_program_studi']);
                    $('#tahun_kurikulum11').val(data['tahun_kurikulum']);
                    $('#pendidikan_terakhir11').val(data['pendidikan_terakhir']);
                    $('#jurusan_slta11').val(data['jurusan_slta']);
                    $('#alamat_slta11').val(data['alamat_slta']);
                    $('#no_ijazah_slta11').val(data['no_ijazah_slta']);
                    $('#tahun_ijazah_slta11').val(data['tahun_ijazah_slta']);
                    $('#editprogramstudi').val(data['kode_program_studi']); 
                });

                // edit
                $('#form_edit2').on('submit', function(event) {
                    event.preventDefault();
                    var form_data = $(this).serialize();
                    $.ajax({
                        url: "{{ config('setting.second_url') }}akademik/edit-camaba",
                        method: "POST",
                        data: form_data,
                        dataType: "json",
                        headers: {
                            "Authorization": 'Bearer ' + token,
                            "username": userlogin
                        },
                        beforeSend: function() {
                            $("#btsubmit").prop('disabled', true);
                        },
                        success: function(data) {
                            if (data.error) {
                                showToastr('error', 'Error!', data.error);
                                table.ajax.reload();
                                $("#btsubmit").prop('disabled', false);
                            } else if (data.success) {
                                $('#modal_edit2').modal('hide');
                                showToastr('success', 'Success!', data.success);
                                table.ajax.reload();
                                $('#form_edit2')[0].reset();
                                $("#btsubmit").prop('disabled', false);
                            }
                        }
                    })
                });

                // hapus
                table.on('click', '.del[data-id]', function(e) {
                    e.preventDefault();
                    var id = $(this).data('id');
                    swal({
                        title: "Apa anda yakin?",
                        text: "Kamu tidak akan bisa mengembalikan data!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Ya, hapus !",
                        cancelButtonText: "Tidak, batal !",
                        closeOnCancel: false
                    }, function(isConfirm) {
                        if (isConfirm) {
                            $.ajax({
                                url: "{{ config('setting.second_url') }}akademik/ubahstatus-camaba",
                                type: 'GET',
                                headers: {
                                    "Authorization": 'Bearer ' + token,
                                    "username": userlogin
                                },
                                data: {
                                    id_camaba: id
                                },
                                dataType: 'json',
                                success: function(data) {
                                    if (data.gagal) {
                                        showToastr('error', 'Error!', data.gagal);
                                    } else if (data.berhasil) {
                                        showToastr('success', 'Success!', data
                                            .berhasil);
                                        table.ajax.reload();
                                    }
                                }
                            })
                        } else {
                            swal("Cancelled", "Data kamu aman! :)", "error");
                        }
                    });
                });
            }
        });
        function provinsi11() {
            var token = "{{ Session::get('token') }}";
            var userlogin = "{{ Session::get('username') }}";
            $.ajax({
                type: 'GET',
                url: "{{ config('setting.second_url') }}akademik/tampilprovinsi",
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                success: function(result) {
                    var jml = result.length;
                    var s = '<option value="">-Pilih-</option>';
                    for (i = 0; i < jml; i++) {
                        s = s + '<option value="' + result[i].kode_provinsi + '"> ' + result[i]
                            .nama_provinsi + '</option>';
                    }
                    // console.log(result);
                    $('#provinsi11').html(s);
                }
            })
        }
        provinsi11();

        function provinsiortu() {
            var token = "{{ Session::get('token') }}";
            var userlogin = "{{ Session::get('username') }}";
            $.ajax({
                type: 'GET',
                url: "{{ config('setting.second_url') }}akademik/tampilprovinsi",
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                success: function(result) {
                    var jml = result.length;
                    var s = '<option value="">-Pilih-</option>';
                    for (i = 0; i < jml; i++) {
                        s = s + '<option value="' + result[i].kode_provinsi + '"> ' + result[i]
                            .nama_provinsi + '</option>';
                    }
                    // console.log(result);
                    $('#provinsiortu11').html(s);
                }
            })
        }
        provinsiortu();

        function tampilkabupaten(kd_provinsi) {
            var token = "{{ Session::get('token') }}";
            var userlogin = "{{ Session::get('username') }}";
            $.ajax({
                type: 'GET',
                url: "{{ config('setting.second_url') }}akademik/tampilkabupaten",
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                data: {
                    kd_provinsi: kd_provinsi
                },
                success: function(result) {
                    var jml = result.length;
                    var s = '<option value="">-Pilih-</option>';
                    for (i = 0; i < jml; i++) {
                        s = s + '<option value="' + result[i].kode_kabupaten + '"> ' + result[i]
                            .nama_kabupaten + '</option>';
                    }
                    // console.log(result);
                    $('#kabupaten11').html(s);
                }
            })
        }
        // tampilkabupaten();

        tampilkabupatenortu();

        function tampilkabupatenortu(kd_provinsi) {
            var token = "{{ Session::get('token') }}";
            var userlogin = "{{ Session::get('username') }}";
            $.ajax({
                type: 'GET',
                url: "{{ config('setting.second_url') }}akademik/tampilkabupaten",
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                data: {
                    kd_provinsi: kd_provinsi
                },
                success: function(result) {
                    var jml = result.length;
                    var s = '<option value="">-Pilih-</option>';
                    for (i = 0; i < jml; i++) {
                        s = s + '<option value="' + result[i].kode_kabupaten + '"> ' + result[i]
                            .nama_kabupaten + '</option>';
                    }
                    // console.log(result);
                    $('#kabupatenortu11').html(s);
                    console.log(s);
                }
            })
        }
    </script>
@stop
