@extends('layout')

@section('content')
    <div class="container-full">
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">Profil Mahasiswa</h3>
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
<section class="content">
    <div class="row">
        <div class="col-12 col-lg-5 col-xl-4">
            <div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-black" style="background-color: rgb(255, 144, 103)">
                <h3 class="widget-user-username" id="nama_lengkap_profil"></h3>
                <h6 class="widget-user-desc" id="nama_prodi_profil"></h6>
            </div>
            <div class="widget-user-image">
                <img class="rounded-circle" src="{{ url('images/nouser.gif') }}" alt="User Avatar">
            </div>
            <div class="box-footer">
                <div class="row">
                <div class="col-sm-4">
                    <div class="description-block">
                    <h5 class="description-header">NIM</h5>
                    <span class="description-text" id="nim_side"></span>
                    </div>
                    <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4 br-1 bl-1">
                    <div class="description-block">
                    <h5 class="description-header">Program</h5>
                    <span class="description-text" id="nama_program_pendidikan_side"></span>
                    </div>
                    <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4">
                    <div class="description-block">
                    <h5 class="description-header">Angkatan</h5>
                    <span class="description-text" id="tahun_angkatan_side"></span>
                    </div>
                    <!-- /.description-block -->
                </div>
                <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            </div>
            <div class="box">
            <div class="box-body box-profile">            
                <div class="row">
                <div class="col-12">
                    <div>
                        <p>Email :<span class="text-gray pl-10" id="email_side"></span> </p>
                        <p>Phone :<span class="text-gray pl-10" id="phone_side"></span></p>
                        <p>Program Studi :<span class="text-gray pl-10" id="prodi_side">-</span></p>
                        <p>Fakultas :<span class="text-gray pl-10" id="fakultas_side">-</span></p>
                        <p>Tahun Kurikulum :<span class="text-gray pl-10" id="tahun_kurikulum_side">-</span></p>
                    </div>
                </div>
                </div>
            </div>
            <!-- /.box-body -->
            </div>
        </div>

        <div class="col-12 col-lg-7 col-xl-8">
            
            <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li><a href="#userprofil" class="active" data-toggle="tab">Personal</a></li>
                <li><a href="#pendidikanterakhir" data-toggle="tab">Pendidikan Terakhir</a></li>
                <li><a href="#ayah" data-toggle="tab">Ayah</a></li>
                <li><a href="#ibu" data-toggle="tab">Ibu</a></li>
                <li><a href="#uploadavatar" data-toggle="tab">Upload Foto</a></li>
            </ul>

            <div class="tab-content">
                <div class="active tab-pane" id="userprofil">
            <form id="form_add" method="POST" enctype="multipart/form-data">
                    <div class="box p-15">		
                            <div class="form-group row">
                            <label for="inputName" class="col-sm-3 control-label">Nama Lengkap</label>
    
                            <div class="col-sm-9">
                                <input class="form-control" type="hidden" name="nim" id="nim" value="{{ $session_nim }}">
                                <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" readonly>
                                <input type="hidden" class="form-control" name="no_pendaftaran" id="no_pendaftaran" readonly>
                            </div>
                            </div>
                            <div class="form-group row">
                            <label for="inputName" class="col-sm-3 control-label">NIK (KTP)</label>    
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="nik_mhs" id="nik_mhs">
                            </div>
                            </div>

                            <div class="form-group row">
                            <label for="inputEmail" class="col-sm-3 control-label">Tempat/tgl lahir</label>
    
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir">
                            </div>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir">
                            </div>
                            </div>
                            <!-- <div class="form-group row">
                                <label for="inputExperience" class="col-sm-3 control-label">Alamat (KTP)</label>
        
                            <div class="col-sm-9">
                                <textarea class="form-control" id="alamat_lengkap1" readonly></textarea>
                            </div>
                            </div> -->
                            <div class="form-group row">
                            <label for="inputName" class="col-sm-3 control-label">Email</label>    
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="email" id="email">
                            </div>
                            </div>
                            <div class="form-group row">
                            <label for="inputName" class="col-sm-3 control-label">No Telepon (WA)</label>    
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="telp" id="telp">
                            </div>
                            </div>
                            <div class="form-group row">
                            <label for="inputPhone" class="col-sm-3 control-label">Jenis Kelamin</label>
    
                            <div class="col-sm-9">
                                            <select class="form-control" id="jk"
                                                style="width: 100%;" data-placeholder="Jenis Kelamin"
                                                name="jk">
                                                <option value="">Pilih Jenis Kelamin</option>
                                                <option value=""></option>
                                            </select>
                            </div>
                            </div>

                            <div class="form-group row">
                            <label for="inputSkills" class="col-sm-3 control-label">Agama</label>
    
                            <div class="col-sm-9">
                                            <select class="form-control" style="width: 100%;" id="editagama"
                                                data-placeholder="Pilih Agama" name="editagama">
                                                <option value="">Pilih Agama</option>
                                                <option value=""></option>
                                            </select>
                            </div>
                            </div>

                            <div class="form-group row">
                            <label for="inputSkills" class="col-sm-3 control-label">Status</label>
    
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="status_mhs" readonly>
                            </div>
                            </div>

                            <div class="form-group row">
                            <label for="inputSkills" class="col-sm-3 control-label">Kewarganegaraan</label>
    
                            <div class="col-sm-9">
                                            <select class="form-control" id="kwg"
                                                style="width: 100%;" data-placeholder="Kewarganegaraan"
                                                name="kwg">
                                                <option value="">Kewarganegaraan</option>
                                                <option value=""></option>
                                            </select>
                            </div>
                            </div>

                            <div class="form-group row">
                            <label for="inputSkills" class="col-sm-3 control-label">Provinsi</label>
    
                            <div class="col-sm-9">
                                            <select class="form-control" id="kode_provinsi" style="width: 100%;" data-placeholder="Provinsi" name="kode_provinsi" onchange="tampilkabupaten(this.value)">
                                                <option value="">Provinsi</option>
                                                <option value=""></option>
                                            </select>
                            </div>
                            </div>
                            <div class="form-group row">
                            <label for="inputSkills" class="col-sm-3 control-label">Kabupaten</label>
    
                            <div class="col-sm-9">
                                            <select class="form-control" id="kode_kabupaten" style="width: 100%;" data-placeholder="Kabupaten" name="kode_kabupaten">
                                                <option value="">Kabupaten</option>
                                                <option value=""></option>
                                            </select>
                            </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputExperience" class="col-sm-3 control-label">Alamat (KTP)</label>
        
                            <div class="col-sm-1">
                            <center><label for="inputExperience" class="control-label">RT</label></center>
                                <input type="text" class="form-control" name="rt" id="rt">
                            </div>
                            <div class="col-sm-1">
                            <center><label for="inputExperience" class="control-label">RW</label></center>
                                <input type="text" class="form-control" name="rw" id="rw">
                            </div>
                            <div class="col-sm-2">
                            <center><label for="inputExperience" class="control-label">Kode Pos</label></center>
                                <input type="text" class="form-control" name="kode_pos" id="kode_pos">
                            </div>
                            <div class="col-sm-3">
                            <center><label for="inputExperience" class="control-label">Alamat</label></center>
                                <input type="text" class="form-control" name="alamat_lengkap" id="alamat_lengkap">
                            </div>
                            </div>
                    <center><button type="submit" class="btn btn-rounded btn-info" id="btsubmit2"><i class="fa fa-save"></i> Simpan</button></center>
                    <br>

                        </form>
                    </div>	
                </div>    
                <!-- /.tab-pane -->
                
                <div class="tab-pane" id="pendidikanterakhir">
            <form id="form_pendidikan" method="POST" enctype="multipart/form-data">
                    <div class="box p-15">		
                        <form class="form-horizontal form-element col-12">
                            <div class="form-group row">
                            <label for="inputName" class="col-sm-3 control-label">Pendidikan Terakhir</label>
    
                            <div class="col-sm-9">
                                <input class="form-control" type="hidden" name="pendidikan_nim" id="pendidikan_nim" value="{{ $session_nim }}">
                                <input type="text" class="form-control" name="pendidikan_terakhir" id="pendidikan_terakhir">
                            </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputName" class="col-sm-3 control-label">Jurusan</label>
        
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="jurusan_slta" id="jurusan_slta">
                            </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-3 control-label">Alamat</label>
        
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="alamat_slta" id="alamat_slta">
                            </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputName" class="col-sm-3 control-label">Nomor Ijazah</label>
        
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="no_ijazah" id="no_ijazah">
                            </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-3 control-label">Tahun Ijazah</label>
        
                            <div class="col-sm-9">
                                <input type="text" class="form-control" data-placeholder="20**" name="tahun_ijazah" id="tahun_ijazah">
                            </div>
                            </div>
                    <center><button type="submit" class="btn btn-rounded btn-info" id="btsubmit3"><i class="fa fa-save"></i> Simpan Pendidikan</button></center>
                    <br>

                        </form>
                    </div>
                </div>    
                <!-- /.tab-pane -->

                <div class="tab-pane" id="ayah">
                    <div class="box p-15">		
            <form id="form_ayah" method="POST" enctype="multipart/form-data">		
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-3 control-label">Nama Ayah</label>

                                <div class="col-sm-9">
                                    <input type="hidden" class="form-control" name="ayah_no_pendaftaran" id="ayah_no_pendaftaran">
                                    <input type="text" class="form-control" name="nama_ayah" id="nama_ayah">
                                </div>
                            </div>		
                            <div class="form-group row">
                                            <label for="agama_ayah" class="col-sm-3 control-label">Agama :</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" id="agama_ayah" name="agama_ayah"
                                                style="width: 100%;">
                                                <option value="">Pilih Agama</option>
                                                <option value=""></option>
                                            </select>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->		
                            <div class="form-group row">
                                            <label for="pekerjaan_ayah" class="col-sm-3 control-label">Pekerjaan :</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" id="pekerjaan_ayah"
                                                style="width: 100%;" name="pekerjaan_ayah">
                                                <option value="">Pilih Pekerjaan</option>
                                                <option value=""></option>
                                            </select>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->		
                            <div class="form-group row">
                                            <label for="pendidikan_ayah" class="col-sm-3 control-label">Pendidikan :</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" id="pendidikan_ayah"
                                                style="width: 100%;" name="pendidikan_ayah">
                                                <option value="">Pilih Pendidikan</option>
                                                <option value=""></option>
                                            </select>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->		
                            <div class="form-group row">
                                            <label for="penghasilan_ayah" class="col-sm-3 control-label">Penghasilan Ayah/Bulan :</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" id="penghasilan_ayah"
                                                style="width: 100%;" name="penghasilan_ayah">
                                                <option value="">Pilih Penghasilan</option>
                                                <option value=""></option>
                                            </select>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-3 control-label">Phone</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="phone_ayah" id="phone_ayah">
                            </div>
                            </div>

                            <div class="form-group row">
                            <label for="inputSkills" class="col-sm-3 control-label">Provinsi</label>

                            <div class="col-sm-9">
                                            <select class="form-control" id="kode_provinsi_ayah" style="width: 100%;" data-placeholder="Provinsi" name="kode_provinsi_ayah" onchange="tampilkabupatenayah(this.value)">
                                                <option value="">Provinsi</option>
                                                <option value=""></option>
                                            </select>
                            </div>
                            </div>
                            <div class="form-group row">
                            <label for="inputSkills" class="col-sm-3 control-label">Kabupaten</label>

                            <div class="col-sm-9">
                                            <select class="form-control" id="kode_kabupaten_ayah" style="width: 100%;" data-placeholder="Kabupaten" name="kode_kabupaten_ayah">
                                                <option value="">Kabupaten</option>
                                                <option value=""></option>
                                            </select>
                            </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputExperience" class="col-sm-3 control-label">Alamat (KTP)</label>

                            <div class="col-sm-1">
                            <center><label for="inputExperience" class="control-label">RT</label></center>
                                <input type="text" class="form-control" name="rt_ayah" id="rt_ayah">
                            </div>
                            <div class="col-sm-1">
                            <center><label for="inputExperience" class="control-label">RW</label></center>
                                <input type="text" class="form-control" name="rw_ayah" id="rw_ayah">
                            </div>
                            <div class="col-sm-2">
                            <center><label for="inputExperience" class="control-label">Kode Pos</label></center>
                                <input type="text" class="form-control" name="kode_pos_ayah" id="kode_pos_ayah">
                            </div>
                            <div class="col-sm-3">
                            <center><label for="inputExperience" class="control-label">Alamat</label></center>
                                <input type="text" class="form-control" name="alamat_ayah" id="alamat_ayah">
                            </div>
                            </div>
                    <center><button type="submit" class="btn btn-rounded btn-info" id="btsubmit4"><i class="fa fa-save"></i> Simpan Data Ayah</button></center>
                    <br>
                        </form>
                    </div>
                </div>
                <!-- /.tab-pane -->

                <div class="tab-pane" id="ibu">		

                    <div class="box p-15">		
            <form id="form_ibu" method="POST" enctype="multipart/form-data">		
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-3 control-label">Nama Ibu</label>

                                <div class="col-sm-9">
                                    <input type="hidden" class="form-control" name="ibu_no_pendaftaran" id="ibu_no_pendaftaran">
                                    <input type="text" class="form-control" name="nama_ibu" id="nama_ibu">
                                </div>
                            </div>		
                            <div class="form-group row">
                                            <label for="agama_ibu" class="col-sm-3 control-label">Agama :</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" id="agama_ibu" name="agama_ibu"
                                                style="width: 100%;">
                                                <option value="">Pilih Agama</option>
                                                <option value=""></option>
                                            </select>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->		
                            <div class="form-group row">
                                            <label for="pekerjaan_ibu" class="col-sm-3 control-label">Pekerjaan :</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" id="pekerjaan_ibu"
                                                style="width: 100%;" name="pekerjaan_ibu">
                                                <option value="">Pilih Pekerjaan</option>
                                                <option value=""></option>
                                            </select>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->		
                            <div class="form-group row">
                                            <label for="pendidikan_ibu" class="col-sm-3 control-label">Pendidikan :</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" id="pendidikan_ibu"
                                                style="width: 100%;" name="pendidikan_ibu">
                                                <option value="">Pilih Pendidikan</option>
                                                <option value=""></option>
                                            </select>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->		
                            <div class="form-group row">
                                            <label for="penghasilan_ibu" class="col-sm-3 control-label">Penghasilan Ibu/Bulan :</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" id="penghasilan_ibu"
                                                style="width: 100%;" name="penghasilan_ibu">
                                                <option value="">Pilih Penghasilan</option>
                                                <option value=""></option>
                                            </select>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-3 control-label">Phone</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="phone_ibu" id="phone_ibu">
                            </div>
                            </div>

                            <div class="form-group row">
                            <label for="inputSkills" class="col-sm-3 control-label">Provinsi</label>

                            <div class="col-sm-9">
                                            <select class="form-control" id="kode_provinsi_ibu" style="width: 100%;" data-placeholder="Provinsi" name="kode_provinsi_ibu" onchange="tampilkabupatenibu(this.value)">
                                                <option value="">Provinsi</option>
                                                <option value=""></option>
                                            </select>
                            </div>
                            </div>
                            <div class="form-group row">
                            <label for="inputSkills" class="col-sm-3 control-label">Kabupaten</label>

                            <div class="col-sm-9">
                                            <select class="form-control" id="kode_kabupaten_ibu" style="width: 100%;" data-placeholder="Kabupaten" name="kode_kabupaten_ibu">
                                                <option value="">Kabupaten</option>
                                                <option value=""></option>
                                            </select>
                            </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputExperience" class="col-sm-3 control-label">Alamat (KTP)</label>

                            <div class="col-sm-1">
                            <center><label for="inputExperience" class="control-label">RT</label></center>
                                <input type="text" class="form-control" name="rt_ibu" id="rt_ibu">
                            </div>
                            <div class="col-sm-1">
                            <center><label for="inputExperience" class="control-label">RW</label></center>
                                <input type="text" class="form-control" name="rw_ibu" id="rw_ibu">
                            </div>
                            <div class="col-sm-2">
                            <center><label for="inputExperience" class="control-label">Kode Pos</label></center>
                                <input type="text" class="form-control" name="kode_pos_ibu" id="kode_pos_ibu">
                            </div>
                            <div class="col-sm-3">
                            <center><label for="inputExperience" class="control-label">Alamat</label></center>
                                <input type="text" class="form-control" name="alamat_ibu" id="alamat_ibu">
                            </div>
                            </div>
                    <center><button type="submit" class="btn btn-rounded btn-info" id="btsubmit4"><i class="fa fa-save"></i> Simpan Data Ibu</button></center>
                    <br>
                        </form>
                    </div>	  
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="uploadavatar">
                    <form id="form_upload_foto" method="POST" enctype="multipart/form-data">
                        @csrf			
                        <div class="form-group row">
                            <label class="col-form-label col-lg-3">Foto Profil</label>
                            <div class="col-lg-9">
                                <input type="hidden" name="nim_mhs" class="form-control" value="{{ $session_nim }}">
                                <input type="file" name="file_upload" class="form-control">
                                <span class="text-danger" style="font-size: 0.75em">* Silahkan upload foto formal dari Universitas Muhammadiyah Karanganyar dan maksimal ukuran file 200 KB.</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-lg-3"></label>
                            <div class="col-lg-9">
                                <button type="submit" class="btn btn-sm btn-rounded btn-primary" id="btsubmit"><i class="fa fa-upload"></i> Upload
                                </button>
                            </div>
                        </div>
                </form>
                </div>
                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->		

        </div>
        <!-- /.row -->
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
                    $('#editagama').html(s);
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
                    $('#agama_ayah').html(s);
                }
            })
        }
        editagamaayah();

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
            $('#pendidikan_ayah').html(s);
        }
    })
}
editjenjangpendidikanayah();

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
            $('#pekerjaan_ayah').html(s);
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
            $('#penghasilan_ayah').html(s);
        }
    })
}
editkodepenghasilanayah();

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
                    $('#agama_ibu').html(s);
                }
            })
        }
        editagamaibu();

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
            $('#pendidikan_ibu').html(s);
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
            $('#pekerjaan_ibu').html(s);
        }
    })
}
editjenispekerjaanibu();

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
            $('#penghasilan_ibu').html(s);
        }
    })
}
editkodepenghasilanibu();

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
                    $('#jk').html(s);
                }
            })
        }
        editjkmhs();
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
                    $('#kwg').html(s);
                }
            })
        }
        editkewarganegaraan();
        function provinsi11() {
            $.ajax({
                type: 'GET',
                url: "{{ config('setting.second_url') }}mahasiswa/tampilprovinsi",
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
                    $('#kode_provinsi').html(s);
                }
            })
        }
        provinsi11();

function tampilkabupaten(kd_provinsi) {
    $.ajax({
        type: 'GET',
        url: "{{ config('setting.second_url') }}mahasiswa/tampilkabupaten",
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
                s = s + '<option value="' + result[i].id_kab + '"> ' + result[i]
                    .nama_kabupaten + '</option>';
            }
            // console.log(result);
            $('#kode_kabupaten').html(s);
        }
    })
}
tampilkabupaten();
        function provinsiayah() {
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
                    $('#kode_provinsi_ayah').html(s);
                }
            })
        }
        provinsiayah();

function tampilkabupatenayah(kd_provinsi) {
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
                s = s + '<option value="' + result[i].id_kab + '"> ' + result[i]
                    .nama_kabupaten + '</option>';
            }
            // console.log(result);
            $('#kode_kabupaten_ayah').html(s);
        }
    })
}
tampilkabupatenayah();
        function provinsiibu() {
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
                    $('#kode_provinsi_ibu').html(s);
                }
            })
        }
        provinsiibu();

function tampilkabupatenibu(kd_provinsi) {
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
                s = s + '<option value="' + result[i].id_kab + '"> ' + result[i]
                    .nama_kabupaten + '</option>';
            }
            // console.log(result);
            $('#kode_kabupaten_ibu').html(s);
        }
    })
}
tampilkabupatenibu();
        function cetak() {
            $("#printff")
                // /.hide()/
                .attr("src", "{{ url('akademik/cetak/cetaktahunajaran') }}")
                .appendTo("body");
            // var newWin = window.frames["printff"];
            // newWin.document.write('<body onload="window.print()">' + isicetakan + '</body>');
            // newWin.document.close();
            // return false;
        }
        $(document).ready(function() {
        var token = "{{ Session::get('token') }}";
        var userlogin = "{{ Session::get('username') }}";
        var nim = $('#nim').val();

        $.ajax({
            type: 'POST',
            dataType: "json",
            url: "{{ config('setting.second_url') }}mahasiswa/profil-personal",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
            data: {
                nim: nim
            },
            success: function(result) {
                console.log(result);
                    $('#nim_side').html(result.nim);
                    $('#nim').html(result.nim);
                    $('#pendidikan_nim').html(result.nim);
                    $('#nik_mhs').val(result.nik_mhs);
                    $('#no_pendaftaran').val(result.no_pendaftaran);
                    $('#ayah_no_pendaftaran').val(result.no_pendaftaran);
                    $('#ibu_no_pendaftaran').val(result.no_pendaftaran);
                    $('#telp').val(result.telp);
                    $('#email').val(result.email);
                    $('#nama_program_pendidikan_side').html(result.nama_program_pendidikan);
                    $('#tahun_angkatan_side').html(result.tahun_angkatan);
                    $('#email_side').html(result.email);
                    $('#phone_side').html(result.telp);
                    $('#prodi_side').html(result.nama_program_studi);
                    $('#nama_prodi_profil').html(result.nama_program_studi);
                    $('#fakultas_side').html(result.nama_fakultas);
                    $('#tahun_kurikulum_side').html(result.tahun_kurikulum);
                    $('#nama_lengkap').val(result.nama_mahasiswa);
                    $('#nama_lengkap_profil').html(result.nama_mahasiswa);
                    $('#ttl').val(result.ttl);
                    $('#alamat_lengkap1').text(result.alamat_lengkap);
                    $('#jk').val(result.jenis_kelamin);
                    $('#agama').val(result.kode_agama);
                    $('#kode_provinsi').val(result.kode_provinsi);
                    $('#kode_kabupaten').val(result.kabupaten_mhs);
                    $('#status_mhs').val(result.status_mhs);
                    $('#kwg').val(result.kode_kewarganegaraan);

                    $('#editagama').val(result.kode_agama);
                    $('#tempat_lahir').val(result.tempat_lahir);
                    $('#tanggal_lahir').val(result.tanggal_lahir);
                    $('#rt').val(result.rt);
                    $('#rw').val(result.rw);
                    $('#kode_pos').val(result.kode_pos);
                    $('#alamat_lengkap').val(result.alamat_asal_mhs);
                    $('#pendidikan_terakhir').val(result.pendidikan_terakhir);
                    $('#jurusan_slta').val(result.jurusan_slta);
                    $('#alamat_slta').val(result.alamat_slta);
                    $('#no_ijazah').val(result.no_ijazah_slta);
                    $('#tahun_ijazah').val(result.tahun_ijazah_slta);

                    profil_ayah(result.no_pendaftaran);
                    profil_ibu(result.no_pendaftaran);
            }
        });



function profil_ayah(id){
    $.ajax({
            type: 'POST',
            dataType: "json",
            url: "{{ config('setting.second_url') }}mahasiswa/profil-ayah",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
            data: {
                no_pendaftaran: id
            },
            success: function(result) {
                console.log(result);
                    $('#nama_ayah').val(result.nama);
                    $('#agama_ayah').val(result.kode_agama);
                    $('#pendidikan_ayah').val(result.kode_jenjang_pendidikan);
                    $('#pekerjaan_ayah').val(result.kode_jenis_pekerjaan);
                    $('#penghasilan_ayah').val(result.kode_penghasilan);
                    $('#phone_ayah').val(result.telepon_ayah);
                    $('#alamat_ayah').val(result.alamat);
                    $('#rt_ayah').val(result.rt);
                    $('#rw_ayah').val(result.rw);
                    $('#kode_provinsi_ayah').val(result.kode_propinsi);
                    $('#kode_kabupaten_ayah').val(result.kode_kabupaten);
                    $('#kode_pos_ayah').val(result.kode_pos);
            }
        });
}

    function profil_ibu(id){
        $.ajax({
            type: 'POST',
            dataType: "json",
            url: "{{ config('setting.second_url') }}mahasiswa/profil-ibu",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
            data: {
                no_pendaftaran: id
            },
            success: function(result) {
                console.log(result);
                    $('#nama_ibu').val(result.nama);
                    $('#agama_ibu').val(result.kode_agama);
                    $('#pendidikan_ibu').val(result.kode_jenjang_pendidikan);
                    $('#pekerjaan_ibu').val(result.kode_jenis_pekerjaan);
                    $('#penghasilan_ibu').val(result.kode_penghasilan);
                    $('#phone_ibu').val(result.telepon);
                    $('#alamat_ibu').val(result.alamat);
                    $('#rt_ibu').val(result.rt);
                    $('#rw_ibu').val(result.rw);
                    $('#kode_provinsi_ibu').val(result.kode_propinsi);
                    $('#kode_kabupaten_ibu').val(result.kode_kabupaten);
                    $('#kode_pos_ibu').val(result.kode_pos);
            }
        });
    }

function startSpinner5() {
        $("#btsubmit5").prop("disabled", true);
        $("#btsubmit5").html(
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...'
        );
    }

    function stopSpinner3() {
        $("#btsubmit5").prop("disabled", false); 
        $("#btsubmit5").html('<i class="fa fa-save"></i> Simpan');
    }
    $('#form_ibu').on('submit', function(event) {
        event.preventDefault();
        var form_data = $(this).serialize();
        $.ajax({
            url: "{{ config('setting.second_url') }}mahasiswa/simpan-ibu-mahasiswa",
            method: "POST",
            headers: {
                "Authorization": 'Bearer ' + token,
                "username": userlogin
            },
            data:  new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
            beforeSend: function() {
                // $("#btsubmit").prop('disabled', true);
                    startSpinner5();
            },
            success: function(data) {
                if (data.error) {
                    showToastr('error', 'Error!', data.error);
                        stopSpinner3();
                    // $("#btsubmit").prop('disabled', false);
                } else if (data.success) {
                    showToastr('success', 'Success!', data.success);
                    window.location.href = '{{ url('mahasiswa/profil') }}';
                    $('#form_ibu')[0].reset();
                        stopSpinner3();
                    // $("#btsubmit").prop('disabled', false);
                }
            },
                error: function(xhr, status, error) {
                    stopSpinner3();
                    showToastr('error', 'Error!', xhr.responseText);
                }
        })
    });

function startSpinner4() {
        $("#btsubmit4").prop("disabled", true);
        $("#btsubmit4").html(
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...'
        );
    }

    function stopSpinner3() {
        $("#btsubmit4").prop("disabled", false);
        $("#btsubmit4").html('<i class="fa fa-save"></i> Simpan');
    }
    $('#form_ayah').on('submit', function(event) {
        event.preventDefault();
        var form_data = $(this).serialize();
        $.ajax({
            url: "{{ config('setting.second_url') }}mahasiswa/simpan-ayah-mahasiswa",
            method: "POST",
            headers: {
                "Authorization": 'Bearer ' + token,
                "username": userlogin
            },
            data:  new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
            beforeSend: function() {
                // $("#btsubmit").prop('disabled', true);
                    startSpinner4();
            },
            success: function(data) {
                if (data.error) {
                    showToastr('error', 'Error!', data.error);
                        stopSpinner3();
                    // $("#btsubmit").prop('disabled', false);
                } else if (data.success) {
                    showToastr('success', 'Success!', data.success);
                    window.location.href = '{{ url('mahasiswa/profil') }}';
                    $('#form_ayah')[0].reset();
                        stopSpinner3();
                    // $("#btsubmit").prop('disabled', false);
                }
            },
                error: function(xhr, status, error) {
                    stopSpinner3();
                    showToastr('error', 'Error!', xhr.responseText);
                }
        })
    });

    function startSpinner3() {
            $("#btsubmit3").prop("disabled", true);
            $("#btsubmit3").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...'
            );
        }

        function stopSpinner3() {
            $("#btsubmit3").prop("disabled", false);
            $("#btsubmit3").html('<i class="fa fa-save"></i> Simpan');
        }
        $('#form_pendidikan').on('submit', function(event) {
            event.preventDefault();
            var form_data = $(this).serialize();
            $.ajax({
                url: "{{ config('setting.second_url') }}mahasiswa/simpan-pendidikan-mahasiswa",
                method: "POST",
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                data:  new FormData(this),
                    processData: false,
                    contentType: false,
                    cache: false,
                beforeSend: function() {
                    // $("#btsubmit").prop('disabled', true);
                        startSpinner3();
                },
                success: function(data) {
                    if (data.error) {
                        showToastr('error', 'Error!', data.error);
                            stopSpinner3();
                        // $("#btsubmit").prop('disabled', false);
                    } else if (data.success) {
                        showToastr('success', 'Success!', data.success);
                        window.location.href = '{{ url('mahasiswa/profil') }}';
                        $('#form_pendidikan')[0].reset();
                            stopSpinner3();
                        // $("#btsubmit").prop('disabled', false);
                    }
                },
                    error: function(xhr, status, error) {
                        stopSpinner3();
                        showToastr('error', 'Error!', xhr.responseText);
                    }
            })
        });
    function startSpinner2() {
            $("#btsubmit2").prop("disabled", true);
            $("#btsubmit2").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...'
            );
        }

        function stopSpinner2() {
            $("#btsubmit2").prop("disabled", false);
            $("#btsubmit2").html('<i class="fa fa-save"></i> Simpan');
        }
        $('#form_add').on('submit', function(event) {
            event.preventDefault();
            var form_data = $(this).serialize();
            $.ajax({
                url: "{{ config('setting.second_url') }}mahasiswa/simpan-profil-mahasiswa",
                method: "POST",
                headers: {
                    "Authorization": 'Bearer ' + token,
                    "username": userlogin
                },
                data:  new FormData(this),
                    processData: false,
                    contentType: false,
                    cache: false,
                beforeSend: function() {
                    // $("#btsubmit").prop('disabled', true);
                        startSpinner2();
                },
                success: function(data) {
                    if (data.error) {
                        showToastr('error', 'Error!', data.error);
                            stopSpinner2();
                        // $("#btsubmit").prop('disabled', false);
                    } else if (data.success) {
                        showToastr('success', 'Success!', data.success);
                        window.location.href = '{{ url('mahasiswa/profil') }}';
                        $('#form_add')[0].reset();
                            stopSpinner2();
                        // $("#btsubmit").prop('disabled', false);
                    }
                },
                    error: function(xhr, status, error) {
                        stopSpinner2();
                        showToastr('error', 'Error!', xhr.responseText);
                    }
            })
        });

        function startSpinner() {
            $("#btsubmit").prop("disabled", true);
            $("#btsubmit").html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...'
            );
        }

        function stopSpinner() {
            $("#btsubmit").prop("disabled", false);
            $("#btsubmit").html('<i class="fa fa-upload"></i> Upload');
        }

        $("#form_upload_foto").on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ config('setting.second_url') }}mahasiswa/upload-foto",
                    method: "POST",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    cache: false,
                    beforeSend: function() {
                        // $("#btimport").prop('disabled', true);
                        startSpinner();
                    },
                    success: function(data) {
                        if (data.error) {
                            showToastr('error', 'Error!', data.error);
                            // $("#btimport").prop('disabled', false);
                            stopSpinner();
                        } else if (data.success) {
                            showToastr('success', 'Success!', data.success);
                            stopSpinner();
                        }
                    },
                    error: function(xhr, status, error) {
                        stopSpinner();
                        showToastr('error', 'Error!', xhr.responseText);
                    }
                })
            })

        });
    </script>
@stop
