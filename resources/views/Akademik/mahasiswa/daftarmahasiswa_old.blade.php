@extends('layout')

@section('content')
    <div class="container-full">
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">Data Mahasiswa</h3>
                </div>

            </div>
        </div>
        <!-- Main content -->
        <section class="content">
            <div class="box">
                <div class="box-header with-border">
                    <h6 class="box-subtitle">Melihat Data Mahasiswa</h6>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <div class="box">
                        <div class="box-body ribbon-box bg-primary-light">
                            <div class="ribbon ribbon-info">informasi</div>
                            <p class="mb-0">Data mahasiswa ditampilkan per tahun angkatan. Untuk menambahkan
                                mahasiswa baru
                                dapat menggunakan menu import dari data PMB atau mengisi formulir tambah calon mahasiswa
                                baru. Proses penambahan data mahasiswa harus melalui penambahan calon mahasiswa baru.</p>
                        </div> <!-- end box-body-->
                    </div>
                    <div class="box-header no-border">
                        <div class="row">
                            <div class="col-sm-2">
                                <label for="tahunangkatan">&emsp;&emsp;&emsp;Tahun Angkatan :</label>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <select class="form-control" name="tahunangkatan" id="tahunangkatan">
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="text-center">
                                    <button type="button" class="btn btn-warning btn-sm float-right" data-toggle="modal"
                                        data-target="#modal_add"><i class="fa fa-print"></i> Export to Excel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="kgtdaftarmahasiswa" class="table table-hover table-striped">
                            <thead class="bg-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Proses</th>
                                    <th>NIM</th>
                                    <th>Tgl Registrasi</th>
                                    <th>Program Studi</th>

                                    <th>Nama</th>
                                    <th>Tempat Lahir</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Nama Ibu</th>
                                    <th>Tgl Lahir</th>
                                    <th>Agama</th>
                                    <th>Kewarganegaraan</th>
                                    <th>NIK</th>
                                    <th>NISN</th>
                                    <th>Dusun</th>
                                    <th>No HP</th>
                                    <th>Alamat</th>
                                    <th>Email</th>

                                    <th>No Pendaftaran</th>
                                    <th>Angkatan</th>
                                    <th>SMT</th>
                                    <th>Kelas</th>
                                    <th>Kurikulum</th>
                                    <th>Pendidikan Terakhir</th>
                                    <th>Jurusan SLTA</th>
                                    <th>No Ijazah SLTA</th>
                                    <th>Tahun Ijazah</th>
                                    <th>Alamat SLTA</th>
                                    <th>Provinsi</th>
                                    <th>Fakultas</th>
                                    <th>Jalur PMB</th>
                                    <th>Nama Ayah</th>
                                    <th>Pekerjaan Ayah</th>
                                    <th>Pekerjaan Ibu</th>
                                    <th>Alamat Ayah</th>
                                    <th>Alamat Ibu</th>
                                    <th>Status</th>
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
                                            <label class="col-form-label col-md-5">Nama</label>
                                            <div class="col-md-7">
                                                <input class="form-control" type="text" name="nama_camaba"
                                                    id="nama_camaba" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-5">No Pendaftaran</label>
                                            <div class="col-md-7">
                                                <input class="form-control" type="text" name="no_pendaftaran1"
                                                    id="no_pendaftaran1" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-5">NIM</label>
                                            <div class="col-md-7">
                                                <input class="form-control" type="text" name="nim" id="nim"
                                                    readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-5">Tempat/Tgl Lahir</label>
                                            <div class="col-md-4">
                                                <input class="form-control" type="text" name="tempat_lahir"
                                                    id="tempat_lahir" readonly>
                                            </div>
                                            <div class="col-md-3">
                                                <input class="form-control" type="text" name="tanggal_lahir"
                                                    id="tanggal_lahir" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-5">Jenis Kelamin</label>
                                            <div class="col-md-7">
                                                <input class="form-control" type="text" name="jenis_kelamin"
                                                    id="jenis_kelamin" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-5">Agama</label>
                                            <div class="col-md-7">
                                                <input class="form-control" type="text" name="nama_agama"
                                                    id="nama_agama" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-5">Fakultas</label>
                                            <div class="col-md-7">
                                                <input class="form-control" type="text" name="nama_fakultas"
                                                    id="nama_fakultas" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-5">Kelas</label>
                                            <div class="col-md-7">
                                                <input class="form-control" type="text" name="nama_program_pendidikan"
                                                    id="nama_program_pendidikan" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-5">Angkatan</label>
                                            <div class="col-md-7">
                                                <input class="form-control" type="text" name="tahun_angkatan"
                                                    id="tahun_angkatan" readonly>
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
                                                            href="#personal" role="tab"><span><i
                                                                    class="ion-home mr-15"></i>Personal</span></a>
                                                    </li>
                                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab"
                                                            href="#pendidikan" role="tab"><span><i
                                                                    class="ion-person mr-15"></i>Pendidikan
                                                                Terakhir</span></a> </li>
                                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab"
                                                            href="#ayah" role="tab"><span><i
                                                                    class="ion-email mr-15"></i>Ayah</span></a> </li>
                                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab"
                                                            href="#ibu" role="tab"><span><i
                                                                    class="ion-email mr-15"></i>Ibu</span></a> </li>
                                                </ul>
                                                <!-- Tab panes -->
                                                <div class="tab-content tabcontent-border">
                                                    <div class="tab-pane active" id="personal" role="tabpanel">
                                                        <div class="p-15">
                                                            <table>
                                                                <tr>
                                                                    <td width="300px">NIM</td>
                                                                    <td width="20px">:</td>
                                                                    <td width="300px">
                                                                        <input class="form-control" type="text"
                                                                            name="nim1" id="nim1" readonly>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Nama</td>
                                                                    <td>:</td>
                                                                    <td>
                                                                        <input class="form-control" type="text"
                                                                            name="nama_camaba1" id="nama_camaba1"
                                                                            readonly>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Tempat/Tgl Lahir</td>
                                                                    <td>:</td>
                                                                    <td>
                                                                        <input class="form-control" type="text"
                                                                            name="tempat_lahir1" id="tempat_lahir1"
                                                                            readonly>
                                                                        <input class="form-control" type="text"
                                                                            name="tanggal_lahir1" id="tanggal_lahir1"
                                                                            readonly>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Alamat Asal</td>
                                                                    <td>:</td>
                                                                    <td>
                                                                        <input class="form-control" type="text"
                                                                            name="alamat_asal" id="alamat_asal" readonly>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Jenis Kelamin</td>
                                                                    <td>:</td>
                                                                    <td>
                                                                        <input class="form-control" type="text"
                                                                            name="jenis_kelamin" id="jenis_kelamin"
                                                                            readonly>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Agama</td>
                                                                    <td>:</td>
                                                                    <td>
                                                                        <input class="form-control" type="text"
                                                                            name="nama_agama1" id="nama_agama1" readonly>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Status</td>
                                                                    <td>:</td>
                                                                    <td>
                                                                        <input class="form-control" type="text"
                                                                            name="status" id="status" readonly>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Kewarganegaraan</td>
                                                                    <td>:</td>
                                                                    <td>
                                                                        <input class="form-control" type="text"
                                                                            name="nama_kewarganegaraan1"
                                                                            id="nama_kewarganegaraan1" readonly>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>No Telp</td>
                                                                    <td>:</td>
                                                                    <td>
                                                                        <input class="form-control" type="text"
                                                                            name="telp1" id="telp1" readonly>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Fakultas</td>
                                                                    <td>:</td>
                                                                    <td>
                                                                        <input class="form-control" type="text"
                                                                            name="nama_fakultas1" id="nama_fakultas1"
                                                                            readonly>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Jurusan</td>
                                                                    <td>:</td>
                                                                    <td>
                                                                        <input class="form-control" type="text"
                                                                            name="nama_program_studi1"
                                                                            id="nama_program_studi1" readonly>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Angkatan</td>
                                                                    <td>:</td>
                                                                    <td>
                                                                        <input class="form-control" type="text"
                                                                            name="tahun_angkatan1" id="tahun_angkatan1"
                                                                            readonly>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Tahun Kurikulum</td>
                                                                    <td>:</td>
                                                                    <td>
                                                                        <input class="form-control" type="text"
                                                                            name="tahun_kurikulum" id="tahun_kurikulum"
                                                                            readonly>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="pendidikan" role="tabpanel">
                                                        <div class="p-15">
                                                            <table>
                                                                <tr>
                                                                    <td width="300px">Pendidikan Terakhir</td>
                                                                    <td width="20px">:</td>
                                                                    <td width="300px">
                                                                        <input class="form-control" type="text"
                                                                            name="pendidikan_terakhir"
                                                                            id="pendidikan_terakhir" readonly>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Jurusan</td>
                                                                    <td>:</td>
                                                                    <td>
                                                                        <input class="form-control" type="text"
                                                                            name="jurusan_slta" id="jurusan_slta"
                                                                            readonly>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Alamat</td>
                                                                    <td>:</td>
                                                                    <td>
                                                                        <input class="form-control" type="text"
                                                                            name="alamat_slta" id="alamat_slta" readonly>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Nomer Ijazah</td>
                                                                    <td>:</td>
                                                                    <td>
                                                                        <input class="form-control" type="text"
                                                                            name="no_ijazah_slta" id="no_ijazah_slta"
                                                                            readonly>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Tahun Ijazah</td>
                                                                    <td>:</td>
                                                                    <td>
                                                                        <input class="form-control" type="text"
                                                                            name="tahun_ijazah_slta"
                                                                            id="tahun_ijazah_slta" readonly>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="ayah" role="tabpanel">
                                                        <div class="p-15">
                                                            <table>
                                                                <tr>
                                                                    <td width="300px">Nama Ayah</td>
                                                                    <td width="20px">:</td>
                                                                    <td width="300px">
                                                                        <input class="form-control" type="text"
                                                                            name="nama_ayah" id="nama_ayah" readonly>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td width="300px">Agama</td>
                                                                    <td width="20px">:</td>
                                                                    <td width="300px">
                                                                        <input class="form-control" type="text"
                                                                            name="agama_ayah" id="agama_ayah" readonly>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Pendidikan</td>
                                                                    <td>:</td>
                                                                    <td>Nama</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Pekerjaan</td>
                                                                    <td>:</td>
                                                                    <td>Nama</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Penghasilan</td>
                                                                    <td>:</td>
                                                                    <td>Nama</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>No.Telp</td>
                                                                    <td>:</td>
                                                                    <td>Nama</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Alamat</td>
                                                                    <td>:</td>
                                                                    <td>Nama</td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="ibu" role="tabpanel">
                                                        <div class="p-15">
                                                            <table>
                                                                <tr>
                                                                    <td width="300px">Nama Ibu</td>
                                                                    <td width="20px">:</td>
                                                                    <td width="300px">
                                                                        <input class="form-control" type="text"
                                                                            name="nama_ibu" id="nama_ibu" readonly>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td width="300px">Agama</td>
                                                                    <td width="20px">:</td>
                                                                    <td width="300px">
                                                                        <input class="form-control" type="text"
                                                                            name="agama_ibu" id="agama_ibu" readonly>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Pendidikan</td>
                                                                    <td>:</td>
                                                                    <td>Nama</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Pekerjaan</td>
                                                                    <td>:</td>
                                                                    <td>Nama</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Penghasilan</td>
                                                                    <td>:</td>
                                                                    <td>Nama</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>No.Telp</td>
                                                                    <td>:</td>
                                                                    <td>Nama</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Alamat</td>
                                                                    <td>:</td>
                                                                    <td>Nama</td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer float-right">
                                <button type="button" class="btn btn-rounded btn-warning btn-outline mr-1"
                                    data-dismiss="modal">
                                    <i class="fa fa-times"></i> Close
                                </button>
                            </div>
                    </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
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
                                    <div class="col-md-7">
                                        <input class="form-control" type="hidden" name="id_mhs11" id="id_mhs11"
                                            readonly>
                                        <input class="form-control" type="hidden" name="nim11" id="nim11"
                                            readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-5">Nama</label>
                                    <div class="col-md-7">
                                        <input class="form-control" type="text" name="nama_camaba11"
                                            id="nama_camaba11">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-5">No Pendaftaran</label>
                                    <div class="col-md-7">
                                        <input class="form-control" type="text" name="no_pendaftaran11"
                                            id="no_pendaftaran11" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-5">NIK</label>
                                    <div class="col-md-7">
                                        <input class="form-control" type="text" name="nik11" id="nik11">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-5">Tempat/Tgl Lahir</label>
                                    <div class="col-md-4">
                                        <input class="form-control" type="text" name="tempat_lahir11"
                                            id="tempat_lahir11">
                                    </div>
                                    <div class="col-md-3">
                                        <input class="form-control" type="text" name="tanggal_lahir11"
                                            id="tanggal_lahir11">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-5">Jenis Kelamin</label>
                                    <div class="col-md-7">
                                        <select class="form-control" name="jenis_kelamin11" id="jenis_kelamin11">
                                            <option value="L">Laki-laki</option>
                                            <option value="P">Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-5">Agama</label>
                                    <div class="col-md-7">
                                        <select class="form-control nama_agama11" name="nama_agama11" id="nama_agama11">
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-5">Fakultas</label>
                                    <div class="col-md-7">
                                        <select class="form-control" name="nama_fakultas11" id="nama_fakultas11">
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-5">Jalur PMB</label>
                                    <div class="col-md-7">
                                        <select class="form-control" name="jalur_pmb11" id="jalur_pmb11">
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-5">Kewarganegaraan</label>
                                    <div class="col-md-7">
                                        <select class="form-control" name="kode_kewarganegaraan11"
                                            id="kode_kewarganegaraan11">
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-5">Kelas</label>
                                    <div class="col-md-7">
                                        <select class="form-control" name="nama_program_pendidikan11"
                                            id="nama_program_pendidikan11">
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-5">Status Menikah</label>
                                    <div class="col-md-7">
                                        <select class="form-control" name="status_nikah11" id="status_nikah11">
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-5">No Telepon</label>
                                    <div class="col-md-7">
                                        <input class="form-control" type="text" name="telp11" id="telp11">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-5">Email</label>
                                    <div class="col-md-7">
                                        <input class="form-control" type="text" name="email11" id="email11">
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
                                                    href="#pendidikan1" role="tab"><span><i
                                                            class="ion-person mr-15"></i>Pendidikan
                                                        Terakhir</span></a> </li>
                                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#ayah1"
                                                    role="tab"><span><i class="ion-email mr-15"></i>Ayah</span></a>
                                            </li>
                                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#ibu1"
                                                    role="tab"><span><i class="ion-email mr-15"></i>Ibu</span></a>
                                            </li>
                                        </ul>
                                        <div class="tab-content tabcontent-border">
                                            <div class="tab-pane active" id="pendidikan1" role="tabpanel">
                                                <div class="p-15">
                                                    <table>
                                                        <tr>
                                                            <td width="300px">Pendidikan Terakhir</td>
                                                            <td width="20px">:</td>
                                                            <td width="300px">
                                                                <input class="form-control" type="text"
                                                                    name="pendidikan_terakhir11"
                                                                    id="pendidikan_terakhir11">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Jurusan</td>
                                                            <td>:</td>
                                                            <td>
                                                                <input class="form-control" type="text"
                                                                    name="jurusan_slta11" id="jurusan_slta11">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Alamat</td>
                                                            <td>:</td>
                                                            <td>
                                                                <input class="form-control" type="text"
                                                                    name="alamat_slta11" id="alamat_slta11">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Nomer Ijazah</td>
                                                            <td>:</td>
                                                            <td>
                                                                <input class="form-control" type="text"
                                                                    name="no_ijazah_slta11" id="no_ijazah_slta11">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Tahun Ijazah</td>
                                                            <td>:</td>
                                                            <td>
                                                                <input class="form-control" type="text"
                                                                    name="tahun_ijazah_slta11" id="tahun_ijazah_slta11">
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="ayah1" role="tabpanel">
                                                <div class="p-15">
                                                    <table>
                                                        <tr>
                                                            <td width="300px">Nama Ayah</td>
                                                            <td width="20px">:</td>
                                                            <td width="300px">
                                                                <input class="form-control" type="text"
                                                                    name="nama_ayah11" id="nama_ayah11">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="300px">Agama</td>
                                                            <td width="20px">:</td>
                                                            <td width="300px">
                                                                <select class="form-control" name="kode_agama_ayah11"
                                                                    id="kode_agama_ayah11">
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Pendidikan</td>
                                                            <td>:</td>
                                                            <td width="300px">
                                                                <select class="form-control"
                                                                    name="jenjang_pendidikan_ayah11"
                                                                    id="jenjang_pendidikan_ayah11">
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Pekerjaan</td>
                                                            <td>:</td>
                                                            <td width="300px">
                                                                <select class="form-control"
                                                                    name="kode_jenis_pekerjaan_ayah11"
                                                                    id="kode_jenis_pekerjaan_ayah11">
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Penghasilan</td>
                                                            <td>:</td>
                                                            <td width="300px">
                                                                <select class="form-control"
                                                                    name="kode_penghasilan_ayah11"
                                                                    id="kode_penghasilan_ayah11">
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>No.Telp</td>
                                                            <td>:</td>
                                                            <td width="300px">
                                                                <input class="form-control" type="text"
                                                                    name="telepon_ayah11" id="telepon_ayah11">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Alamat</td>
                                                            <td>:</td>
                                                            <td width="300px">
                                                                <input class="form-control" type="text"
                                                                    name="alamat_ayah11" id="alamat_ayah11">
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="ibu1" role="tabpanel">
                                                <div class="p-15">
                                                    <table>
                                                        <tr>
                                                            <td width="300px">Nama Ibu</td>
                                                            <td width="20px">:</td>
                                                            <td width="300px">
                                                                <input class="form-control" type="text"
                                                                    name="nama_ibu11" id="nama_ibu11">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="300px">Agama</td>
                                                            <td width="20px">:</td>
                                                            <td width="300px">
                                                                <select class="form-control" name="kode_agama_ibu11"
                                                                    id="kode_agama_ibu11">
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Pendidikan</td>
                                                            <td>:</td>
                                                            <td width="300px">
                                                                <select class="form-control"
                                                                    name="jenjang_pendidikan_ibu11"
                                                                    id="jenjang_pendidikan_ibu11">
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Pekerjaan</td>
                                                            <td>:</td>
                                                            <td width="300px">
                                                                <select class="form-control"
                                                                    name="kode_jenis_pekerjaan_ibu11"
                                                                    id="kode_jenis_pekerjaan_ibu11">
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Penghasilan</td>
                                                            <td>:</td>
                                                            <td width="300px">
                                                                <select class="form-control" name="kode_penghasilan_ibu11"
                                                                    id="kode_penghasilan_ibu11">
                                                                </select>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>No.Telp</td>
                                                            <td>:</td>
                                                            <td width="300px">
                                                                <input class="form-control" type="text"
                                                                    name="telepon_ibu11" id="telepon_ibu11">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Alamat</td>
                                                            <td>:</td>
                                                            <td width="300px">
                                                                <input class="form-control" type="text"
                                                                    name="alamat_ibu11" id="alamat_ibu11">
                                                            </td>
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
                        <button type="submit" class="btn btn-rounded btn-primary btn-outline" id="btsubmit">
                            <i class="ti-save-alt"></i> Save
                        </button>
                        <button type="button" class="btn btn-rounded btn-warning btn-outline mr-1" data-dismiss="modal">
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
                    $('#nama_agama11').html(s);
                }
            })
        }
        editagama();

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
                    $('#jalur_pmb11').html(s);
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
                    $('#kode_jenis_pekerjaan_ibu11').html(s);
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
                    $('#kode_jenis_pekerjaan_ayah11').html(s);
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

            function tahunangkatan() {
                $.ajax({
                    type: 'GET',
                    url: "{{ config('setting.second_url') }}akademik/tampiltahunangkatan",
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
            //                     '<option class="dropdown-item">' + el
            //                     .tahun_angkatan + '</option>')
            //             });
            //         },
            //         error: function(error) {
            //             alert(error);
            //         }
            //     });
            // }
            // dropdown_angkatan();

            function tbnilai(thn) {
                var table = $("#kgtdaftarmahasiswa").DataTable({
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
                        url: "{{ config('setting.second_url') }}akademik/mahasiswa",
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
                            data: null,
                            render: function(data, type, full, meta) {
                                if (full.nim < '0') {
                                    return '<a href="javascript:void(0)" class="text-primary mr-10" id="bt_edit2" data-toggle="tooltip" data-original-title="Edit"><i class="ti-marker-alt"></i></a> | <a href="javascript:void(0)" class="text-success mr-10" id="bt_edit" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-eye"></i></a>';
                                } else {
                                    return '<a href="javascript:void(0)" class="text-primary mr-10" id="bt_edit2" data-toggle="tooltip"  data-original-title="Edit"><i class="ti-marker-alt"></i></a> | <a href="javascript:void(0)" class="text-success mr-10" id="bt_edit" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-eye"></i></a>';

                                }
                            }
                        },

                        {
                            data: 'nim'
                        },
                        {
                            data: 'tgl_registrasi'
                        },
                        {
                            data: 'nama_program_studi'
                        },
                        {
                            data: 'nama_mahasiswa'
                        },
                        {
                            data: null,
                            render: function(data, type, full, meta) {
                                return full.tempat_lahir;
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
                            data: 'nama_ibu'
                        },
                        {
                            data: null,
                            render: function(data, type, full, meta) {
                                return full.tanggal_lahir;
                            }
                        },
                        {
                            data: 'nama_agama'
                        },
                        {
                            data: 'nama_kewarganegaraan'
                        },
                        {
                            data: 'nik'
                        },
                        {
                            data: 'nisn'
                        },
                        {
                            data: null,
                            render: function(data, type, full, meta) {
                                if (full.rw == null) {
                                    return 'RT ' + full.rt + ', ' + 'RW ' + '-' + ', ' + full
                                        .alamat_asal + ', ' + full
                                        .kode_pos;
                                } else if (full.rw == '') {
                                    return 'RT ' + full.rt + ', ' + 'RW ' + '-' + ', ' + full
                                        .alamat_asal + ', ' + full
                                        .kode_pos;
                                } else if (full.rw == 0) {
                                    return 'RT ' + full.rt + ', ' + 'RW ' + '-' + ', ' + full
                                        .alamat_asal + ', ' + full
                                        .kode_pos;
                                } else if (full.rt == null) {
                                    return 'RT ' + '-' + ', ' + 'RW ' + full.rw + ', ' + full
                                        .alamat_asal + ', ' + full
                                        .kode_pos;
                                } else if (full.rt == '') {
                                    return 'RT ' + '-' + ', ' + 'RW ' + full.rw + ', ' + full
                                        .alamat_asal + ', ' + full
                                        .kode_pos;
                                } else if (full.rt == 0) {
                                    return 'RT ' + '-' + ', ' + 'RW ' + full.rw + ', ' + full
                                        .alamat_asal + ', ' + full
                                        .kode_pos;
                                } else if (full.kode_pos == null) {
                                    return 'RT ' + full.rt + ', ' + 'RW ' + full.rw + ', ' + full
                                        .alamat_asal + ', ' + '-';
                                } else if (full.kode_pos == '') {
                                    return 'RT ' + full.rt + ', ' + 'RW ' + full.rw + ', ' + full
                                        .alamat_asal + ', ' + '-';
                                } else if (full.kode_pos == 0) {
                                    return 'RT ' + full.rt + ', ' + 'RW ' + full.rw + ', ' + full
                                        .alamat_asal + ', ' + '-';
                                } else if (full.alamat_asal == null) {
                                    return 'RT ' + full.rt + ', ' + 'RW ' + full.rw + ', ' + full
                                        .alamat_asal + ', ' + '-';
                                } else if (full.alamat_asal == 0) {
                                    return 'RT ' + full.rt + ', ' + 'RW ' + full.rw + ', ' + full
                                        .alamat_asal + ', ' + '-';
                                } else if (full.alamat_asal == '') {
                                    return 'RT ' + full.rt + ', ' + 'RW ' + full.rw + ', ' + full
                                        .alamat_asal + ', ' + '-';
                                } else {
                                    return 'RT ' + full.rt + ', ' + 'RW ' + full.rw + ', ' + full
                                        .alamat_asal + ', ' +
                                        full
                                        .kode_pos;
                                }
                            }
                        },
                        {
                            data: 'telp'
                        },
                        {
                            data: null,
                            render: function(data, type, full, meta) {
                                if (full.rw == null) {
                                    return 'RT ' + full.rt + ', ' + 'RW ' + '-' + ', ' + full
                                        .alamat_asal + ', ' + full
                                        .kode_pos;
                                } else if (full.rw == '') {
                                    return 'RT ' + full.rt + ', ' + 'RW ' + '-' + ', ' + full
                                        .alamat_asal + ', ' + full
                                        .kode_pos;
                                } else if (full.rw == 0) {
                                    return 'RT ' + full.rt + ', ' + 'RW ' + '-' + ', ' + full
                                        .alamat_asal + ', ' + full
                                        .kode_pos;
                                } else if (full.rt == null) {
                                    return 'RT ' + '-' + ', ' + 'RW ' + full.rw + ', ' + full
                                        .alamat_asal + ', ' + full
                                        .kode_pos;
                                } else if (full.rt == '') {
                                    return 'RT ' + '-' + ', ' + 'RW ' + full.rw + ', ' + full
                                        .alamat_asal + ', ' + full
                                        .kode_pos;
                                } else if (full.rt == 0) {
                                    return 'RT ' + '-' + ', ' + 'RW ' + full.rw + ', ' + full
                                        .alamat_asal + ', ' + full
                                        .kode_pos;
                                } else if (full.kode_pos == null) {
                                    return 'RT ' + full.rt + ', ' + 'RW ' + full.rw + ', ' + full
                                        .alamat_asal + ', ' + '-';
                                } else if (full.kode_pos == '') {
                                    return 'RT ' + full.rt + ', ' + 'RW ' + full.rw + ', ' + full
                                        .alamat_asal + ', ' + '-';
                                } else if (full.kode_pos == 0) {
                                    return 'RT ' + full.rt + ', ' + 'RW ' + full.rw + ', ' + full
                                        .alamat_asal + ', ' + '-';
                                } else if (full.alamat_asal == null) {
                                    return 'RT ' + full.rt + ', ' + 'RW ' + full.rw + ', ' + full
                                        .alamat_asal + ', ' + '-';
                                } else if (full.alamat_asal == 0) {
                                    return 'RT ' + full.rt + ', ' + 'RW ' + full.rw + ', ' + full
                                        .alamat_asal + ', ' + '-';
                                } else if (full.alamat_asal == '') {
                                    return 'RT ' + full.rt + ', ' + 'RW ' + full.rw + ', ' + full
                                        .alamat_asal + ', ' + '-';
                                } else {
                                    return 'RT ' + full.rt + ', ' + 'RW ' + full.rw + ', ' + full
                                        .alamat_asal + ', ' +
                                        full
                                        .kode_pos;
                                }
                            }
                        },
                        {
                            data: 'email'
                        },
                        {
                            data: 'no_pendaftaran'
                        },

                        {
                            data: 'tahun_angkatan'
                        },
                        {
                            data: 'semester'
                        },
                        {
                            data: 'nama_program_pendidikan'
                        },
                        {
                            data: 'tahun_kurikulum'
                        },
                        {
                            data: 'pendidikan_terakhir'
                        },
                        {
                            data: 'jurusan_slta'
                        },
                        {
                            data: 'no_ijazah_slta'
                        },
                        {
                            data: 'tahun_ijazah_slta'
                        },
                        {
                            data: 'alamat_slta'
                        },
                        {
                            data: 'nama_provinsi'
                        },
                        {
                            data: 'nama_fakultas'
                        },
                        {
                            data: 'nama_jalur'
                        },
                        {
                            data: 'nama_ayah'
                        },

                        {
                            data: 'pekerjaan_ayah'
                        },
                        {
                            data: 'pekerjaan_ibu'
                        },
                        {
                            data: null,
                            render: function(data, type, full, meta) {
                                return 'RT ' + full.rt_ayah + ', ' + 'RW' + full.rw_ayah + ', ' +
                                    full.alamat_ayah + ', ' + full.kode_pos_ayah;
                            }
                        },
                        {
                            data: null,
                            render: function(data, type, full, meta) {
                                return 'RT ' + full.rt_ibu + ', ' + 'RW' + full.rw_ibu + ', ' + full
                                    .alamat_ibu + ', ' + full.kode_pos_ibu;
                            }
                        },
                        {
                            data: null,
                            render: function(data, type, full, meta) {
                                if (full.lulus == '0') {
                                    return '<label style="color:green"><i class="fa fa-check-circle-o"></i> Aktif</label>';
                                } else if (full.lulus == '1') {
                                    return '<label style="color:blue"><i class="fa fa-check-circle-o"></i> Sudah Lulus</label>';
                                } else if (full.lulus == '2') {
                                    return '<label style="color:red"><i class="fa fa-minus-circle"></i> Mengundurkan Diri</label>';
                                } else if (full.lulus == '3') {
                                    return '<label style="color:red"><i class="fa fa-minus-circle"></i> Dikeluarkan</label>';
                                } else {
                                    return '';

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
                    console.log(data['no_pendaftaran']);
                    $('#modal_edit').modal('show');
                    $('#nama_camaba').val(data['nama_camaba']);
                    $('#nama_camaba1').val(data['nama_camaba']);
                    $('#nama_ayah').val(data['nama_ayah']);
                    $('#nama_ibu').val(data['nama_ibu']);
                    $('#no_pendaftaran').val(data['no_pendaftaran']);
                    $('#no_pendaftaran1').val(data['no_pendaftaran']);
                    $('#nim').val(data['nim']);
                    $('#nim1').val(data['nim']);
                    $('#jenis_kelamin').val(data['jenis_kelamin']);
                    $('#jenis_kelamin1').val(data['jenis_kelamin']);
                    $('#tempat_lahir').val(data['tempat_lahir']);
                    $('#tempat_lahir1').val(data['tempat_lahir']);
                    $('#tanggal_lahir').val(data['tanggal_lahir']);
                    $('#tanggal_lahir1').val(data['tanggal_lahir']);
                    $('#alamat_asal').val(data['alamat_asal']);
                    $('#alamat_asal1').val(data['alamat_asal']);
                    $('#semester').val(data['semester']);
                    $('#semester1').val(data['semester']);
                    $('#tahun_angkatan').val(data['tahun_angkatan']);
                    $('#tahun_angkatan1').val(data['tahun_angkatan']);
                    $('#kode_kewarganegaraan').val(data['kode_kewarganegaraan']);
                    $('#nama_kewarganegaraan').val(data['nama_kewarganegaraan']);
                    $('#nama_kewarganegaraan1').val(data['nama_kewarganegaraan']);
                    $('#nama_agama').val(data['kode_agama']);
                    $('#nama_agama1').val(data['kode_agama']);
                    $('#agama_ayah').val(data['kode_agama']);
                    $('#agama_ibu').val(data['kode_agama']);
                    $('#rt').val(data['rt']);
                    $('#rt1').val(data['rt']);
                    $('#rt_ayah').val(data['rt_ayah']);
                    $('#rw').val(data['rw']);
                    $('#rw1').val(data['rw']);
                    $('#rw_ibu').val(data['rw_ibu']);
                    $('#telp').val(data['telp']);
                    $('#kode_pos_ayah').val(data['kode_pos_ayah']);
                    $('#kode_pos_ibu').val(data['kode_pos_ibu']);
                    $('#telp1').val(data['telp']);
                    $('#email').val(data['email']);
                    $('#email1').val(data['email']);
                    $('#email11').val(data['email']);
                    $('#telp11').val(data['telp']);
                    $('#nama_program_pendidikan').val(data['nama_program_pendidikan']);
                    $('#nama_program_pendidikan1').val(data['nama_program_pendidikan']);
                    $('#nama_fakultas').val(data['nama_fakultas']);
                    $('#nama_fakultas1').val(data['nama_fakultas']);
                    $('#nama_program_studi').val(data['nama_program_studi']);
                    $('#nama_program_studi1').val(data['nama_program_studi']);
                    $('#tahun_kurikulum').val(data['tahun_kurikulum']);
                    $('#pendidikan_terakhir').val(data['pendidikan_terakhir']);
                    $('#jurusan_slta').val(data['jurusan_slta']);
                    $('#alamat_slta').val(data['alamat_slta']);
                    $('#no_ijazah_slta').val(data['no_ijazah_slta']);
                    $('#tahun_ijazah_slta').val(data['tahun_ijazah_slta']);
                });


                // show data edit
                table.on('click', '#bt_edit2', function() {
                    $tr = $(this).closest('tr');
                    var data = table.row($tr).data();
                    $('#modal_edit2').modal('show');
                    $('#id_mhs11').val(data['id_mhs']);
                    $('#nama_camaba11').val(data['nama_camaba']);
                    $('#nama_camaba111').val(data['nama_camaba']);
                    $('#nama_ayah11').val(data['nama_ayah']);
                    $('#nama_ibu11').val(data['nama_ibu']);
                    $('#no_pendaftaran11').val(data['no_pendaftaran']);
                    $('#no_pendaftaran111').val(data['no_pendaftaran']);
                    $('#nim11').val(data['nim']);
                    $('#nim111').val(data['nim']);
                    $('#nik11').val(data['nik']);
                    $('#status_nikah11').val(data['status_pernikahan']);
                    $('#jalur_pmb11').val(data['kode_jalur_pmb']);
                    $('#jenis_kelamin11').val(data['jenis_kelamin']);
                    $('#jenis_kelamin111').val(data['jenis_kelamin']);
                    $('#tempat_lahir11').val(data['tempat_lahir']);
                    $('#tempat_lahir111').val(data['tempat_lahir']);
                    $('#tanggal_lahir11').val(data['tanggal_lahir']);
                    $('#tanggal_lahir111').val(data['tanggal_lahir']);
                    $('#alamat_asal11').val(data['alamat_asal']);
                    $('#alamat_asal111').val(data['alamat_asal']);
                    $('#semester11').val(data['semester']);
                    $('#semester111').val(data['semester']);
                    $('#tahun_angkatan11').val(data['tahun_angkatan']);
                    $('#tahun_angkatan111').val(data['tahun_angkatan']);
                    $('#status_mhs11').val(data['status_mhs']);
                    $('#kode_kewarganegaraan11').val(data['kode_kewarganegaraan']);
                    $('#nama_kewarganegaraan11').val(data['nama_kewarganegaraan']);
                    $('#nama_kewarganegaraan111').val(data['nama_kewarganegaraan']);
                    $('.nama_agama11').val(data['kode_agama']);
                    console.log(data['kode_agama']);
                    $('#nama_agama111').val(data['kode_agama']);
                    $('#agama_ayah11').val(data['kode_agama']);
                    $('#agama_ibu11').val(data['kode_agama']);
                    $('#kode_agama_ayah11').val(data['agama_ayah']);
                    $('#kode_agama_ibu11').val(data['agama_ibu']);
                    $('#rt11').val(data['rt']);
                    $('#rt111').val(data['rt']);
                    $('#rt_ayah11').val(data['rt_ayah']);
                    $('#rw11').val(data['rw']);
                    $('#rw111').val(data['rw']);
                    $('#rw_ibu11').val(data['rw_ibu']);
                    $('#telp11').val(data['telp']);
                    $('#kode_pos_ayah11').val(data['kode_pos_ayah']);
                    $('#jenjang_pendidikan_ayah11').val(data['jenjangpendidikan_ayah']);
                    $('#jenjang_pendidikan_ibu11').val(data['jenjangpendidikan_ibu']);
                    $('#pekerjaan_ayah11').val(data['pekerjaan_ayah']);
                    $('#pekerjaan_ibu11').val(data['pekerjaan_ibu']);
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
                    $('#email11').val(data['email']);
                    $('#email111').val(data['email']);
                    $('#nama_program_pendidikan11').val(data['kode_program_pendidikan']);
                    $('#nama_program_pendidikan111').val(data['nama_program_pendidikan']);
                    $('#nama_fakultas11').val(data['kode_fakultas']);
                    $('#nama_fakultas111').val(data['nama_fakultas']);
                    $('#nama_program_studi11').val(data['nama_program_studi']);
                    $('#nama_program_studi111').val(data['nama_program_studi']);
                    $('#tahun_kurikulum11').val(data['tahun_kurikulum']);
                    $('#pendidikan_terakhir11').val(data['pendidikan_terakhir']);
                    $('#jurusan_slta11').val(data['jurusan_slta']);
                    $('#alamat_slta11').val(data['alamat_slta']);
                    $('#no_ijazah_slta11').val(data['no_ijazah_slta']);
                    $('#tahun_ijazah_slta11').val(data['tahun_ijazah_slta']);
                });


                // edit
                $('#form_edit2').on('submit', function(event) {
                    event.preventDefault();
                    var form_data = $(this).serialize();
                    $.ajax({
                        url: "{{ config('setting.second_url') }}akademik/edit-mahasiswa",
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
            }
        });
    </script>
@stop
