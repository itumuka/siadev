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
                    <form action="#" class="tab-wizard wizard-circle">
                        <!-- Step 1 -->
                        <h6>Data Calon Mahasiswa</h6>
                        <section>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="file"> Foto : <span class="danger">*</span>
                                        </label>
                                        <div class="fallback">
                                            <input name="file" type="file" multiple />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tahunangkatan"> Tahun Angkatan : <span class="danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" id="id_camaba" name="id_camaba"
                                            value="{{ $id_camaba }}">
                                        <select class="form-control" name="tahunangkatan" id="tahunangkatan"></select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nik"> NIK : <span class="danger">*</span> </label>
                                        <input type="text" class="form-control required" id="nik" name="nik">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="no_pendaftaran"> No Pendaftaran : <span class="danger">*</span>
                                        </label>
                                        <input type="text" class="form-control required" id="no_pendaftaran"
                                            name="no_pendaftaran">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama_program_studi">Nama Prodi :</label>
                                        <select class="form-control" name="nama_program_studi"
                                            id="nama_program_studi"></select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="program_pendidikan"> Program Pendidikan : <span
                                                class="danger">*</span>
                                        </label>
                                        <select class="custom-select form-control required" id="program_pendidikan"
                                            name="program_pendidikan">
                                            <option value="">Pilih Program Pendidikan</option>
                                            <option value='1'>Kelas Reguler</option>
                                            <option value='2'>Kelas Karyawan</option>
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
                                        <input type="date" class="form-control" id="tgl_lahir">
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
                                        <select class="custom-select form-control required" id="provinsi" name="provinsi">
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
                            </div>
                        </section>
                        <!-- Step 2 -->
                        <h6>Data Pendidikan</h6>
                        <section>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pendidikan_terakhir">Pendidikan Terakhir :</label>
                                        <input type="text" class="form-control required" id="pendidikan_terakhir">
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
                                        <input type="text" class="form-control required" id="nama_ayah">
                                    </div>
                                    <div class="form-group">
                                        <label for="agama_ayah">Agama :</label>
                                        <select class="custom-select form-control required" id="agama_ayah"
                                            data-placeholder="Type to search cities" name="agama_ayah">
                                            <option value="Islam">Islam</option>
                                            <option value="Katholik">Katholik</option>
                                            <option value="Kristen">Kristen</option>
                                            <option value="Hindu">Hindu</option>
                                            <option value="Budha">Budha</option>
                                            <option value="Konghuchu">Konghuchu</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="pekerjaan_ayah">Pekerjaan :</label>
                                        <select class="custom-select form-control required" id="pekerjaan_ayah"
                                            name="pekerjaan_ayah">
                                            <option value="">Pilih Pekerjaan</option>
                                            <option value="Pegawai Negeri Sipil">Pegawai Negeri Sipil</option>
                                            <option value="Pegawai Swasta">Pegawai Swasta</option>
                                            <option value="Tentara Negara Indonesia">Tentara Negara Indonesia</option>
                                            <option value="Polisi Republik Indonesia">Polisi Republik Indonesia</option>
                                            <option value="Wiraswasta">Wiraswasta</option>
                                            <option value="Petani">Petani</option>
                                            <option value="Nelayan">Nelayan</option>
                                            <option value="Ibu Rumah Tangga">Ibu Rumah Tangga</option>
                                            <option value="Lain-lain">Lain-lain</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="pendidikan_ayah">Pendidikan :</label>
                                        <select class="custom-select form-control required" id="pendidikan_ayah"
                                            name="pendidikan_ayah">
                                            <option value="">Pilih Pekerjaan</option>
                                            <option value="Tidak Tamat SD">Tidak Tamat SD</option>
                                            <option value="Sekolah Dasar">Sekolah Dasar</option>
                                            <option value="Sekolah Menengah Pertama">Sekolah Menengah Pertama</option>
                                            <option value="Sekolah Menengah Atas">Sekolah Menengah Atas</option>
                                            <option value="Diploma 1">Diploma 1</option>
                                            <option value="Diploma 2">Diploma 2</option>
                                            <option value="Diploma 3">Diploma 3</option>
                                            <option value="Diploma 4">Diploma 4</option>
                                            <option value="Strata 1">Strata 1</option>
                                            <option value="Strata 2">Strata 2</option>
                                            <option value="Strata 3">Strata 3</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama_ibu">Nama Ibu :</label>
                                        <input type="text" class="form-control required" id="nama_ibu">
                                    </div>
                                    <div class="form-group">
                                        <label for="agama_ibu">Agama :</label>
                                        <select class="custom-select form-control required" id="agama_ibu"
                                            data-placeholder="Type to search cities" name="agama_ibu">
                                            <option value="Islam">Pilih Agama</option>
                                            <option value="Islam">Islam</option>
                                            <option value="Katholik">Katholik</option>
                                            <option value="Kristen">Kristen</option>
                                            <option value="Hindu">Hindu</option>
                                            <option value="Budha">Budha</option>
                                            <option value="Konghuchu">Konghuchu</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="pekerjaan_ibu">Pekerjaan :</label>
                                        <select class="custom-select form-control required" id="pekerjaan_ibu"
                                            name="wlocation">
                                            <option value="">Pilih Pekerjaan</option>
                                            <option value="Pegawai Negeri Sipil">Pegawai Negeri Sipil</option>
                                            <option value="Pegawai Swasta">Pegawai Swasta</option>
                                            <option value="Tentara Negara Indonesia">Tentara Negara Indonesia</option>
                                            <option value="Polisi Republik Indonesia">Polisi Republik Indonesia</option>
                                            <option value="Wiraswasta">Wiraswasta</option>
                                            <option value="Petani">Petani</option>
                                            <option value="Nelayan">Nelayan</option>
                                            <option value="Ibu Rumah Tangga">Ibu Rumah Tangga</option>
                                            <option value="Lain-lain">Lain-lain</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="pendidikan_ibu">Pendidikan :</label>
                                        <select class="custom-select form-control required" id="pendidikan_ibu"
                                            name="pendidikan_ibu">
                                            <option value="">Pilih Pendidikan</option>
                                            <option value="Tidak Tamat SD">Tidak Tamat SD</option>
                                            <option value="Sekolah Dasar">Sekolah Dasar</option>
                                            <option value="Sekolah Menengah Pertama">Sekolah Menengah Pertama</option>
                                            <option value="Sekolah Menengah Atas">Sekolah Menengah Atas</option>
                                            <option value="Diploma 1">Diploma 1</option>
                                            <option value="Diploma 2">Diploma 2</option>
                                            <option value="Diploma 3">Diploma 3</option>
                                            <option value="Diploma 4">Diploma 4</option>
                                            <option value="Strata 1">Strata 1</option>
                                            <option value="Strata 2">Strata 2</option>
                                            <option value="Strata 3">Strata 3</option>
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
                                        <select class="custom-select form-control required" id="provinsiortu"
                                            name="provinsiortu">
                                            <option value="">Pilih Provinsi</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kabupaten"> Kabupaten : <span class="danger">*</span>
                                        </label>
                                        <select class="custom-select form-control required" id="kabupaten"
                                            name="kabupaten">
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
        $(document).ready(function() {
        var token = "{{ Session::get('token') }}";
        var userlogin = "{{ Session::get('username') }}";
            var kode_program_studi = $('#kode_program_studi').val();

        });

        function nama_program_studi(kode_program_studi) {
            $.ajax({
                type: 'GET',
                url: "{{ config('setting.second_url') }}akademik/tampilperprodi",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                success: function(result) {
                    var jml = result.length;
                    var s = '<option value="">-Pilih-</option>';
                    for (i = 0; i < jml; i++) {
                        s = s + '<option value="' + result[i].kode_program_studi + '"> ' + result[i]
                            .nama_program_studi + '</option>';
                    }
                    // console.log(result);
                    $('#nama_program_studi').html(s);
                }
            })
        }
        nama_program_studi();

        function jalur_pmb() {
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

        function detail_camaba() {
            var id_camaba = $('#id_camaba').val();
            $.ajax({
                type: 'POST',
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                data: {
                    id_camaba: id_camaba
                },
                url: "{{ config('setting.second_url') }}akademik/detail-camaba",
                success: function(result) {
                    // console.log(result);
                    $('#no_pendaftaran').val(result[0].no_pendaftaran);
                    $('#nama_lengkap').val(result[0].nama_camaba);
                    $('#nik').val(result[0].nik);
                    $('#tempat_lahir').val(result[0].tempat_lahir);
                    $('#tgl_lahir').val(result[0].tanggal_lahir);
                    $('#rt').val(result[0].rt);
                    $('#rw').val(result[0].rw);
                    $('#no_telepon').val(result[0].telp);
                    $('#email').val(result[0].email);
                    $('#kode_pos').val(result[0].kode_pos);
                    $('#tahunangkatan').val(result[0].tahun);
                    $('#alamat_asal').val(result[0].alamat_asal);
                    $('#pendidikan_terakhir').val(result[0].pendidikan_terakhir);
                    $('#alamat_sekolah').val(result[0].alamat_slta);
                    $('#jurusan').val(result[0].jurusan_slta);
                    $('#no_ijazah').val(result[0].no_ijazah_slta);
                    $('#tahun_ijazah').val(result[0].tahun_ijazah_slta);
                    $('#agama_ayah').val(result[0].nama_agama);
                    // console.log(result);

                    // $('#detail_camaba').html(s);
                }
            })
        }
        detail_camaba();
    </script>
@stop
