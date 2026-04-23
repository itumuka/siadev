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
            <div class="box box-default">
                {{-- <div class="box-header with-border">
                    <h4 class="box-title">Step wizard with validation</h4>
                    <h6 class="box-subtitle">You can us the validation like what we did</h6>
                </div> --}}
                <!-- /.box-header -->
                <div class="box-body wizard-content">
                    <input type="hidden" class="form-control" id="kode_program_studi" name="kode_program_studi"
                        value="{{ $kode_prodi }}">
                    <form action="#" class="tab-wizard wizard-circle" enctype="multipart/form-data">
                        <!-- Step 1 -->
                        <h6>Data Calon Mahasiswa</h6>
                        <input class="form-control" type="hidden" name="semester" id="semester"
                            value="{{ $session_semester }}">
                        <input class="form-control" type="hidden" name="tahun" id="tahun" value="{{ $session_tahun }}">
                        <section>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tahunangkatan"> Foto : <span class="danger">*</span>
                                        </label>
                                        <div class="fallback">
                                            <input name="file" type="file" multiple />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tahunangkatan"> Tahun Angkatan : <span class="danger">*</span>
                                        </label>
                                        <select class="form-control" name="tahunangkatan" id="tahunangkatan">
                                            <option value="{{ $session_tahun }}">{{ $session_tahun }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nik"> NIK : <span class="danger">*</span> </label>
                                        <input type="text" class="form-control required" id="nik" name="nik">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama_program_studi">Nama Prodi :</label>
                                        <select class="form-control" name="nama_program_studi"
                                            id="nama_program_studi"></select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="program_pendidikan"> Program Pendidikan : <span
                                                class="danger">*</span>
                                        </label>
                                        <select class="custom-select form-control required" id="program_pendidikan"
                                            name="program_pendidikan">
                                            <option value="">Pilih Program Pendidikan</option>
                                            <option value='1'>Kelas Reguler</option>
                                            <option value='2'>Kelas Karyawan - SJ</option>
                                            <option value='4'>Kelas Karyawan - SS</option>
                                            <option value='5'>Kelas Karyawan - SP</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="jalur_pmb"> Jalur PMB : <span class="danger">*</span>
                                        </label>
                                        <select class="custom-select form-control required" id="jalur_pmb" name="jalur_pmb">
                                            <option value="">Pilih Jalur</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama_lengkap"> Nama Lengkap : <span class="danger">*</span>
                                        </label>
                                        <input type="text" class="form-control required" id="nama_lengkap"
                                            name="nama_lengkap">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tempat_lahir"> Tempat Lahir : <span class="danger">*</span>
                                        </label>
                                        <input type="text" class="form-control required" id="tempat_lahir"
                                            name="tempat_lahir">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tgl_lahir">Tanggal Lahir :</label>
                                        <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="agama_maba">Agama :</label>
                                        <select class="custom-select form-control required" id="agama_maba"
                                            data-placeholder="Type to search cities" name="agama_maba">
                                            <option value="1">Islam</option>
                                            <option value="3">Katholik</option>
                                            <option value="2">Kristen</option>
                                            <option value="4">Hindu</option>
                                            <option value="5">Budha</option>
                                            <option value="6">Konghuchu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kewarganegaraan">Kewarganegaraan :</label>
                                        <select class="custom-select form-control required" id="kewarganegaraan"
                                            data-placeholder="Type to search cities" name="kewarganegaraan">
                                            <option value="1">WNI</option>
                                            <option value="2">WNA</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="jenis_kelamin">jenis_kelamin :</label>
                                        <select class="custom-select form-control required" id="jenis_kelamin"
                                            data-placeholder="Type to search cities" name="jenis_kelamin">
                                            <option value="L">Laki-laki</option>
                                            <option value="P">Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="alamat_asal"> Alamat Asal : <span class="danger">*</span>
                                        </label>
                                        <input type="text" class="form-control required" id="alamat_asal"
                                            name="alamat_asal">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="provinsi"> Provinsi : <span class="danger">*</span>
                                        </label>
                                        <select class="custom-select form-control required" id="provinsi" name="provinsi"
                                            onchange="tampilkabupaten(this.value)">
                                            <option value="">Pilih Provinsi</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kabupaten"> Kabupaten : <span class="danger">*</span>
                                        </label>
                                        <select class="custom-select form-control required" id="kabupaten" name="kabupaten">
                                            <option value="">Pilih Provinsi dulu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="rt"> RT : <span class="danger">*</span>
                                        </label>
                                        <input type="text" class="form-control required" id="rt" name="rt">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="rw"> RW : <span class="danger">*</span>
                                        </label>
                                        <input type="text" class="form-control required" id="rw" name="rw">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kode_pos"> Kode Pos : <span class="danger">*</span>
                                        </label>
                                        <input type="text" class="form-control required" id="kode_pos" name="kode_pos">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="no_telepon"> No Telepon : <span class="danger">*</span>
                                        </label>
                                        <input type="text" class="form-control required" id="no_telepon" name="no_telepon">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email"> Email : <span class="danger">*</span>
                                        </label>
                                        <input type="email" class="form-control required" id="email" name="email">
                                    </div>
                                </div>
                        </section>
                        <!-- Step 2 -->
                        <h6>Data Pendidikan</h6>
                        <section>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pendidikan_terakhir">Pendidikan Terakhir :</label>
                                        <input type="text" class="form-control required" id="pendidikan_terakhir"
                                            name="pendidikan_terakhir">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="jurusan">Jurusan :</label>
                                        <input type="text" class="form-control required" id="jurusan" name="jurusan">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="no_ijazah">No Ijazah :</label>
                                        <input type="text" class="form-control required" id="no_ijazah" name="no_ijazah">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tahun_ijazah">Tahun Ijazah :</label>
                                        <input type="text" class="form-control required" id="tahun_ijazah"
                                            name="tahun_ijazah">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="alamat_sekolah">Alamat Sekolah :</label>
                                        <textarea name="alamat_sekolah" id="alamat_sekolah" rows="6"
                                            class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- Step 3 -->
                        <h6>Data Orang Tua</h6>
                        <section>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama_ayah">Nama Ayah :</label>
                                        <input type="text" class="form-control required" id="nama_ayah" name="nama_ayah">
                                    </div>
                                    <div class="form-group">
                                        <label for="agama_ayah">Agama :</label>
                                        <select class="custom-select form-control required" id="agama_ayah"
                                            data-placeholder="Type to search cities" name="agama_ayah">
                                            <option value="1">Islam</option>
                                            <option value="3">Katholik</option>
                                            <option value="2">Kristen</option>
                                            <option value="4">Hindu</option>
                                            <option value="5">Budha</option>
                                            <option value="6">Konghuchu</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="pekerjaan_ayah">Pekerjaan :</label>
                                        <select class="custom-select form-control required" id="pekerjaan_ayah"
                                            name="pekerjaan_ayah">
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
                                    <div class="form-group">
                                        <label for="pendidikan_ayah">Pendidikan :</label>
                                        <select class="custom-select form-control required" id="pendidikan_ayah"
                                            name="pendidikan_ayah">
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
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama_ibu">Nama Ibu :</label>
                                        <input type="text" class="form-control required" id="nama_ibu" name="nama_ibu">
                                    </div>
                                    <div class="form-group">
                                        <label for="agama_ibu">Agama :</label>
                                        <select class="custom-select form-control required" id="agama_ibu"
                                            data-placeholder="Type to search cities" name="agama_ibu">
                                            <option value="1">Islam</option>
                                            <option value="3">Katholik</option>
                                            <option value="2">Kristen</option>
                                            <option value="4">Hindu</option>
                                            <option value="5">Budha</option>
                                            <option value="6">Konghuchu</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="pekerjaan_ibu">Pekerjaan :</label>
                                        <select class="custom-select form-control required" id="pekerjaan_ibu"
                                            name="pekerjaan_ibu">
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
                                    <div class="form-group">
                                        <label for="pendidikan_ibu">Pendidikan :</label>
                                        <select class="custom-select form-control required" id="pendidikan_ibu"
                                            name="pendidikan_ibu">
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
                                </div>
                            </div>
                        </section>
                        <!-- Step 3 -->
                        <h6>Alamat Orang Tua</h6>
                        <section>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="alamat_asal"> Alamat Asal : <span class="danger">*</span>
                                        </label>
                                        <input type="text" class="form-control required" id="alamat_asal"
                                            name="alamat_asal">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="provinsi"> Provinsi : <span class="danger">*</span>
                                        </label>
                                        <select class="custom-select form-control required" id="provinsiortu"
                                            name="provinsiortu" onchange="tampilkabupatenortu(this.value)">
                                            <option value="">Pilih Provinsi</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kabupatenortu"> Kabupaten : <span class="danger">*</span>
                                        </label>
                                        <select class="custom-select form-control required" id="kabupatenortu"
                                            name="kabupatenortu">
                                            <option value="">Pilih Kabupaten</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="rt"> RT : <span class="danger">*</span>
                                        </label>
                                        <input type="text" class="form-control required" id="rt" name="rt">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="rw"> RW : <span class="danger">*</span>
                                        </label>
                                        <input type="text" class="form-control required" id="rw" name="rw">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kode_pos"> Kode Pos : <span class="danger">*</span>
                                        </label>
                                        <input type="text" class="form-control required" id="kode_pos" name="kode_pos">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="no_telepon"> No Telepon / HP : <span class="danger">*</span>
                                        </label>
                                        <input type="text" class="form-control required" id="no_telepon" name="no_telepon">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="penghasilan">Penghasilan/Bulan :</label>
                                        <select class="custom-select form-control required" id="penghasilan"
                                            name="penghasilan">
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
                                </div>
                            </div>
                        </section>
                    </form>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>
@endsection
@section('script-master')
    <script type="text/javascript">
    
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
