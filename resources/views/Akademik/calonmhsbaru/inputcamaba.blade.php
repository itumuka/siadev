@extends('layout')

@section('content')
    <div class="container-full">
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">{{ $title }}</h3>
                    <div class="d-inline-block align-items-center">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                                <li class="breadcrumb-item" aria-current="page">{{ $parent_breadcrumb }}</li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $child_breadcrumb }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>

            </div>
        </div>
        <!-- Main content -->

        <!-- Main content -->
        <section class="content">

            <!-- Validation wizard -->
            <div class="box">
                {{-- <div class="box-header with-border">
                    <h4 class="box-title">Step wizard with validation</h4>
                    <h6 class="box-subtitle">You can us the validation like what we did</h6>
                </div> --}}
                <!-- /.box-header -->
                <input type="hidden" class="form-control" id="kode_program_studi" name="kode_program_studi"
                    value="{{ $kode_prodi }}">
                <form id="form_add" method="POST" action="#" enctype="multipart/form-data">
                    <!-- Step 1 -->
                    <input class="form-control" type="hidden" name="semester" id="semester"
                        value="{{ $session_semester }}">
                    <input class="form-control" type="hidden" name="tahun" id="tahun" value="{{ $session_tahun }}">

                    <!-- /.box-body -->
                    <div class="row">
                        <div class="col-12">
                            <div class="box">
                                <div class="box-header with-border">
                                    <h4 class="box-title text-primary"><i class="ti-user mr-15"></i> Data Calon Mahasiswa
                                    </h4>
                                </div>
                                <div class="box-body pb-0">
                                    <div class="row">
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="tahunangkatan"> Foto Camaba:
                                                    <input type="file" name="file" class="form-control">
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label> Tahun Angkatan :</label>
                                                <select class="form-control select2" style="width: 100%;"
                                                    name="tahunangkatan" id="tahunangkatan" required>
                                                    <option value="">Pilih</option>
                                                    <option value="{{ $session_tahun }}">{{ $session_tahun }}</option>
                                                </select>
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label>NIK : <span class="danger">*</span></label>
                                                <input type="text" class="form-control" id="nik" name="nik"
                                                    placeholder="NIK KTP" required>
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="nama_program_studi">Nama Prodi :</label>
                                                <select class="form-control select2" style="width: 100%;"
                                                    name="nama_program_studi" id="nama_program_studi" required>
                                                    <option value="">Pilih</option>
                                                </select>
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="program_pendidikan"> Program Pendidikan : <span
                                                        class="danger">*</span>
                                                </label>
                                                <select class="form-control select2" style="width: 100%;"
                                                    id="program_pendidikan" name="program_pendidikan" required>
                                                    <option value="">Pilih Program Pendidikan</option>
                                                    <option value='1'>Kelas Reguler</option>
                                                    <option value='2'>Kelas Karyawan - SJ</option>
                                                    <option value='4'>Kelas Karyawan - SS</option>
                                                    <option value='5'>Kelas Karyawan - SP</option>
                                                </select>
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="jalur_pmb"> Jalur PMB : <span class="danger">*</span>
                                                </label>
                                                <select class="form-control select2" style="width: 100%;" id="jalur_pmb"
                                                    name="jalur_pmb" required>
                                                    <option value="">Pilih Jalur</option>
                                                </select>
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label> Nama Lengkap : <span class="danger">*</span></label>
                                                <input type="text" class="form-control" id="nama_lengkap"
                                                    placeholder="Nama Lengkap" name="nama_lengkap" required>
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="tempat_lahir"> Tempat Lahir : <span class="danger">*</span>
                                                </label>
                                                <input type="text" class="form-control" id="tempat_lahir"
                                                    placeholder="Tempat Lahir" name="tempat_lahir" required>
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="tgl_lahir">Tanggal Lahir : <span
                                                        class="danger">*</span></label>
                                                <input type="date" class="form-control" id="tgl_lahir"
                                                    name="tgl_lahir" placeholder="Tanggal Lahir" required>
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="agama_maba">Agama : <span class="danger">*</span></label>
                                                <select class="form-control select2" style="width: 100%;" id="agama_maba"
                                                    data-placeholder="Pilih Agama" name="agama_maba" required>
                                                    <option value="">Pilih Agama</option>
                                                    <option value="1">Islam</option>
                                                    <option value="3">Katholik</option>
                                                    <option value="2">Kristen</option>
                                                    <option value="4">Hindu</option>
                                                    <option value="5">Budha</option>
                                                    <option value="6">Konghuchu</option>
                                                </select>
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="kewarganegaraan">Kewarganegaraan : <span
                                                        class="danger">*</span></label>
                                                <select class="select2 form-control" id="kewarganegaraan"
                                                    style="width: 100%;" data-placeholder="Kewarganegaraan"
                                                    name="kewarganegaraan" required>
                                                    <option value="">Kewarganegaraan</option>
                                                    <option value="1">WNI</option>
                                                    <option value="2">WNA</option>
                                                </select>
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="jenis_kelamin">Jenis Kelamin :</label>
                                                <select class="select2 form-control" id="jenis_kelamin"
                                                    style="width: 100%;" data-placeholder="Jenis Kelamin"
                                                    name="jenis_kelamin" required>
                                                    <option value="">Pilih Jenis Kelamin</option>
                                                    <option value="L">Laki-laki</option>
                                                    <option value="P">Perempuan</option>
                                                </select>
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="alamat_asal"> Alamat Asal : <span class="danger">*</span>
                                                </label>
                                                <input type="text" class="form-control" id="alamat_asal"
                                                    name="alamat_asal"placeholder="Alamat Asal" required>
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="provinsi"> Provinsi : <span class="danger">*</span>
                                                </label>
                                                <select class="select2 form-control" id="provinsi" name="provinsi"
                                                    style="width: 100%;" onchange="tampilkabupaten(this.value)" required>
                                                    <option value="">Pilih Provinsi</option>
                                                </select>
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="kabupaten"> Kabupaten : <span class="danger">*</span>
                                                </label>
                                                <select class="select2 form-control" id="kabupaten" name="kabupaten"
                                                    style="width: 100%;" required>
                                                    <option value="">Pilih Provinsi dulu</option>
                                                </select>
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="rt"> RT : <span class="danger">*</span>
                                                </label>
                                                <input type="text" class="form-control" id="rt" name="rt"
                                                    placeholder="RT" required>
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="rw"> RW : <span class="danger">*</span>
                                                </label>
                                                <input type="text" class="form-control" id="rw" name="rw"
                                                    placeholder="RW" required>
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="kode_pos"> Kode Pos : <span class="danger">*</span>
                                                </label>
                                                <input type="text" class="form-control" id="kode_pos"
                                                    name="kode_pos" placeholder="Kode Pos" required>
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="no_telepon"> No Telepon : <span class="danger">*</span>
                                                </label>
                                                <input type="text" class="form-control" id="no_telepon"
                                                    name="no_telepon" placeholder="No Telepon" required>
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="email"> Email : <span class="danger">*</span>
                                                </label>
                                                <input type="email" class="form-control" id="email" name="email"
                                                    placeholder="Email" required>
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                        <!-- /.col -->
                                        <!-- /.col -->
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="email"> Jenis Pembayaran : <span class="danger">*</span>
                                                </label>
                                                <select class="form-control" id="jenisbayar" name="jenisbayar"
                                                    style="width: 100%;" required>
                                                    <option value="Mandiri">Mandiri</option>
                                                    <option value="Beasiswa">Beasiswa</option>
                                                    <option value="Beasiswa Penuh">Beasiswa Penuh</option>
                                                </select>
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
                                                <label for="pendidikan_terakhir">Pendidikan Terakhir :</label>
                                                <input type="text" class="form-control" id="pendidikan_terakhir"
                                                    name="pendidikan_terakhir" placeholder="Pendidikan Terakhir">
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                        <!-- /.col -->

                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="jurusan">Jurusan :</label>
                                                <input type="text" class="form-control" id="jurusan" name="jurusan"
                                                    placeholder="Jurusan" required>
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="no_ijazah">No Ijazah : <span class="danger">*</span></label>
                                                <input type="text" class="form-control" id="no_ijazah"
                                                    name="no_ijazah" placeholder="No Ijazah" required>
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="nisn">NISN : <span class="danger">*</span></label>
                                                <input type="text" class="form-control" id="nisn" name="nisn"
                                                    placeholder="NISN" required>
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="tahun_ijazah">Tahun Ijazah :</label>
                                                <input type="text" class="form-control" id="tahun_ijazah"
                                                    placeholder="Tahun Ijazah" name="tahun_ijazah" required>
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="alamat_sekolah">Alamat Sekolah :</label>
                                                <textarea name="alamat_sekolah" id="alamat_sekolah" rows="6" class="form-control"></textarea>
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
                                            class="fa fa-female"></i> Data Orang Tua</h4>
                                </div>
                                <div class="box-body pb-0">
                                    <div class="row">
                                        <!-- /.col -->
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="nama_ayah">Nama Ayah :</label>
                                                <input type="text" class="form-control" id="nama_ayah"
                                                    name="nama_ayah" placeholder="Nama Ayah" required>
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="agama_ayah">Agama :</label>
                                                <select class="select2 form-control" id="agama_ayah" name="agama_ayah"
                                                    style="width: 100%;" required>
                                                    <option value="">Pilih Agama</option>
                                                    <option value="1">Islam</option>
                                                    <option value="3">Katholik</option>
                                                    <option value="2">Kristen</option>
                                                    <option value="4">Hindu</option>
                                                    <option value="5">Budha</option>
                                                    <option value="6">Konghuchu</option>
                                                </select>
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="pekerjaan_ayah">Pekerjaan :</label>
                                                <select class="select2 form-control" id="pekerjaan_ayah"
                                                    style="width: 100%;" name="pekerjaan_ayah" required>
                                                    <option value="">Pilih Pekerjaan</option>
                                                    <option value="1">Pegawai Negeri Sipil</option>
                                                    <option value="2">Pegawai Swasta</option>
                                                    <option value="3">Tentara Negara Indonesia</option>
                                                    <option value="4">Polisi Republik Indonesia</option>
                                                    <option value="5">Wiraswasta</option>
                                                    <option value="6">Petani</option>
                                                    <option value="7">Nelayan</option>
                                                    <option value="8">Ibu Rumah Tangga</option>
                                                    <option value="9">Lain-lain</option>
                                                </select>
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="pendidikan_ayah">Pendidikan :</label>
                                                <select class="select2 form-control" id="pendidikan_ayah"
                                                    style="width: 100%;" name="pendidikan_ayah" required>
                                                    <option value="">Pilih Pekerjaan</option>
                                                    <option value="1">Tidak Tamat SD</option>
                                                    <option value="2">Sekolah Dasar</option>
                                                    <option value="3">Sekolah Menengah Pertama</option>
                                                    <option value="4">Sekolah Menengah Atas</option>
                                                    <option value="5">Diploma 1</option>
                                                    <option value="6">Diploma 2</option>
                                                    <option value="7">Diploma 3</option>
                                                    <option value="8">Diploma 4</option>
                                                    <option value="9">Strata 1</option>
                                                    <option value="10">Strata 2</option>
                                                    <option value="11">Strata 3</option>
                                                </select>
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="nama_ibu">Nama Ibu : <span class="danger">*</span></label>
                                                <input type="text" class="form-control" id="nama_ibu"
                                                    name="nama_ibu" placeholder="Nama Ibu" required>
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="agama_ibu">Agama :</label>
                                                <select class="select2 form-control" id="agama_ibu" name="agama_ibu"
                                                    style="width: 100%;" required>
                                                    <option value="">Pilih Agama</option>
                                                    <option value="1">Islam</option>
                                                    <option value="3">Katholik</option>
                                                    <option value="2">Kristen</option>
                                                    <option value="4">Hindu</option>
                                                    <option value="5">Budha</option>
                                                    <option value="6">Konghuchu</option>
                                                </select>
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="pekerjaan_ibu">Pekerjaan :</label>
                                                <select class="select2 form-control" id="pekerjaan_ibu"
                                                    style="width: 100%;" name="pekerjaan_ibu" required>
                                                    <option value="">Pilih Pekerjaan</option>
                                                    <option value="1">Pegawai Negeri Sipil</option>
                                                    <option value="2">Pegawai Swasta</option>
                                                    <option value="3">Tentara Negara Indonesia</option>
                                                    <option value="4">Polisi Republik Indonesia</option>
                                                    <option value="5">Wiraswasta</option>
                                                    <option value="6">Petani</option>
                                                    <option value="7">Nelayan</option>
                                                    <option value="8">Ibu Rumah Tangga</option>
                                                    <option value="9">Lain-lain</option>
                                                </select>
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="pendidikan_ibu">Pendidikan :</label>
                                                <select class="select2 form-control" id="pendidikan_ibu"
                                                    style="width: 100%;" name="pendidikan_ibu" required>
                                                    <option value="">Pilih Pekerjaan</option>
                                                    <option value="1">Tidak Tamat SD</option>
                                                    <option value="2">Sekolah Dasar</option>
                                                    <option value="3">Sekolah Menengah Pertama</option>
                                                    <option value="4">Sekolah Menengah Atas</option>
                                                    <option value="5">Diploma 1</option>
                                                    <option value="6">Diploma 2</option>
                                                    <option value="7">Diploma 3</option>
                                                    <option value="8">Diploma 4</option>
                                                    <option value="9">Strata 1</option>
                                                    <option value="10">Strata 2</option>
                                                    <option value="11">Strata 3</option>
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
                                                <label for="alamat_asal"> Alamat Asal : <span class="danger">*</span>
                                                </label>
                                                <input type="text" class="form-control" id="alamat_asal"
                                                    name="alamat_asal" placeholder="Alamat Asal" required>
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="provinsi"> Provinsi : <span class="danger">*</span>
                                                </label>
                                                <select class="select2 form-control" id="provinsiortu"
                                                    name="provinsiortu" onchange="tampilkabupatenortu(this.value)"
                                                    style="width: 100%;" required>
                                                    <option value="">Pilih Provinsi</option>
                                                </select>
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="kabupatenortu"> Kabupaten : <span class="danger">*</span>
                                                </label>
                                                <select class="select2 form-control" id="kabupatenortu"
                                                    style="width: 100%;" name="kabupatenortu" required>
                                                    <option value="">Pilih Kabupaten</option>
                                                </select>
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="rt"> RT : <span class="danger">*</span>
                                                </label>
                                                <input type="text" class="form-control" id="rt" name="rt"
                                                    placeholder="RT" required>
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="rw"> RW : <span class="danger">*</span>
                                                </label>
                                                <input type="text" class="form-control" id="rw" name="rw"
                                                    placeholder="RW" required>
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="kode_pos"> Kode Pos : <span class="danger">*</span>
                                                </label>
                                                <input type="text" class="form-control" id="kode_pos"
                                                    name="kode_pos" placeholder="Kode Pos" required>
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="no_telepon"> No Telepon / HP : <span class="danger">*</span>
                                                </label>
                                                <input type="text" class="form-control" id="no_telepon"
                                                    name="no_telepon" placeholder="No Telepon / HP" required>
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-3 col-12">
                                            <div class="form-group">
                                                <label for="penghasilan">Penghasilan/Bulan :</label>
                                                <select class="select2 form-control" id="penghasilan"
                                                    style="width: 100%;" name="penghasilan" required>
                                                    <option value="">Pilih Penghasilan</option>
                                                    <option value="1">500000</option>
                                                    <option value="2">500.000 - 1.000.000</option>
                                                    <option value="3">1.000.000 - 2.500.000</option>
                                                    <option value="4">2.500.000 - 5.000.000</option>
                                                    <option value="5">5.000.000 - 7.500.000</option>
                                                    <option value="6">7.500.000 - 10.000.000</option>
                                                    <option value="7"> 10.000.000</option>
                                                </select>
                                            </div>
                                            <!-- /.form-group -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <center><button type="submit" class="btn btn-rounded btn-info">Simpan Data Camaba</button></center>
                    <br>
                </form>
                <!-- /.box -->
            </div>

        </section>
        <!-- /.content -->
    </div>
@endsection
@section('script-master')
    <script type="text/javascript">
        var token = "{{ Session::get('token') }}";
        var userlogin = "{{ Session::get('username') }}";
        //save
        $('#form_add').on('submit', function(event) {
            event.preventDefault();
            var form_data = $(this).serialize();
            $.ajax({
                url: "{{ config('setting.second_url') }}akademik/simpan-camaba",
                method: "POST",
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                data: form_data,
                dataType: "json",
                beforeSend: function() {
                    $("#btsubmit").prop('disabled', true);
                },
                success: function(data) {
                    if (data.error) {
                        showToastr('error', 'Error!', data.error);
                        table.ajax.reload();
                        $("#btsubmit").prop('disabled', false);
                    } else if (data.success) {
                        $('#modal_add').modal('hide');
                        showToastr('success', 'Success!', data.success);
                        window.location.href = '{{ url('akademik/calonmhsbaru/daftarmaba') }}';
                        $('#form_add')[0].reset();
                        $("#btsubmit").prop('disabled', false);
                    }
                }
            })
        });
        // $(".tab-wizard").steps({
        //         headerTag: "h6",
        //         bodyTag: "section",
        //         transitionEffect: "none",
        //         titleTemplate: '<span class="step">#index#</span> #title#',
        //         labels: {
        //             finish: "Submit"
        //         },
        //         onFinished: function(event, currentIndex) {
        //             var form_data = $(this).serialize();
        //             $.ajax({
        //                 url: "{{ config('setting.second_url') }}akademik/simpan-camaba",
        //                 method: "POST",
        //                 headers: {
        //                     "Authorization": 'Bearer ' + token,
        //                     "username": userlogin
        //                 },
        //                 data: form_data,
        //                 dataType: "json",
        //                 beforeSend: function() {
        //                     $("#finish").prop('disabled', true);
        //                 },
        //                 success: function(data) {
        //                     if (data.error) {
        //                         showToastr('error', 'Error!', data.error);
        //                         table.ajax.reload();
        //                         $("#finish").prop('disabled', false);
        //                     } else if (data.success) {
        //                         // $('#modal_add').modal('hide');
        //                         showToastr('success', 'Success!', data.success);
        //                         table.ajax.reload();
        //                         $('#form_add')[0].reset();
        //                         $("#finish").prop('disabled', false);
        //                     }
        //                 }
        //             })

        //         }
        //     });
        $(document).ready(function() {
            var token = "{{ Session::get('token') }}";
            var userlogin = "{{ Session::get('username') }}";
            var kode_program_studi = $('#kode_program_studi').val();

            nama_program_studi(kode_program_studi);
        });



        function nama_program_studi(kode_program_studi) {
            var token = "{{ Session::get('token') }}";
            var userlogin = "{{ Session::get('username') }}";
            // var kode_program_studi = $('#kode_program_studi').val();
            $.ajax({
                type: 'GET',
                url: "{{ config('setting.second_url') }}akademik/tampilperprodi",
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                data: {
                    kode_program_studi: kode_program_studi
                },
                success: function(result) {
                    var jml = result.length;
                    var s = '';
                    for (i = 0; i < jml; i++) {
                        s = s + '<option value="' + result[i].kode_program_studi + '"> ' + result[i]
                            .nama_program_studi + '</option>';
                    }
                    // console.log(result);
                    $('#nama_program_studi').html(s);
                }
            })
        }

        function jalur_pmb() {
            var token = "{{ Session::get('token') }}";
            var userlogin = "{{ Session::get('username') }}";
            $.ajax({
                type: 'GET',
                url: "{{ config('setting.second_url') }}akademik/tampiljalurpmb",
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
                    $('#jalur_pmb').html(s);
                }
            })
        }
        jalur_pmb();

        function provinsi() {
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
                    $('#provinsi').html(s);
                }
            })
        }
        provinsi();

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
                    $('#provinsiortu').html(s);
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
                    $('#kabupaten').html(s);
                }
            })
        }
        tampilkabupaten();

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
                    $('#kabupatenortu').html(s);
                    console.log(s);
                }
            })
        }


        // var form = $(".validation-wizard").show();

        // $(".validation-wizard").steps({
        //     headerTag: "h6",
        //     bodyTag: "section",
        //     transitionEffect: "none",
        //     titleTemplate: '<span class="step">#index#</span> #title#',
        //     labels: {
        //         finish: "Submit"
        //     },
        //     onStepChanging: function(event, currentIndex, newIndex) {
        //         return currentIndex > newIndex || !(3 === newIndex && Number($("#age-2").val()) < 18) && (
        //             currentIndex < newIndex && (form.find(".body:eq(" + newIndex + ") label.error")
        //                 .remove(), form.find(".body:eq(" + newIndex + ") .error").removeClass("error")),
        //             form
        //             .validate().settings.ignore = ":disabled,:hidden", form.valid())
        //     },
        //     onFinishing: function(event, currentIndex) {
        //         return form.validate().settings.ignore = ":disabled", form.valid()
        //     },
        //     onFinished: function(event, currentIndex) {
        //         swal("Sukses");
        //     }
        // }), $(".validation-wizard").validate({
        //     ignore: "input[type=hidden]",
        //     errorClass: "text-danger",
        //     successClass: "text-success",
        //     highlight: function(element, errorClass) {
        //         $(element).removeClass(errorClass)
        //     },
        //     unhighlight: function(element, errorClass) {
        //         $(element).removeClass(errorClass)
        //     },
        //     errorPlacement: function(error, element) {
        //         error.insertAfter(element)
        //     },
        //     rules: {
        //         email: {
        //             email: !0
        //         }
        //     }
        // })
    </script>
@stop
