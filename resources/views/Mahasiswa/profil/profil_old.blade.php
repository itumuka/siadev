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
                    <div class="box p-15">		
                        <form class="form-horizontal form-element col-12">
                            <div class="form-group row">
                            <label for="inputName" class="col-sm-3 control-label">Nama Lengkap</label>
    
                            <div class="col-sm-9">
                                <input class="form-control" type="hidden" name="nim" id="nim" value="{{ $session_nim }}">
                                <input type="text" class="form-control" id="nama_lengkap" readonly>
                            </div>
                            </div>
                            <div class="form-group row">
                            <label for="inputEmail" class="col-sm-3 control-label">Tempat/tgl lahir</label>
    
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="ttl" readonly>
                            </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputExperience" class="col-sm-3 control-label">Alamat (KTP)</label>
        
                            <div class="col-sm-9">
                                <textarea class="form-control" id="alamat_lengkap" readonly></textarea>
                            </div>
                            </div>
                            <div class="form-group row">
                            <label for="inputPhone" class="col-sm-3 control-label">Jenis Kelamin</label>
    
                            <div class="col-sm-9">
                                <input type="tel" class="form-control" id="jk" readonly>
                            </div>
                            </div>

                            <div class="form-group row">
                            <label for="inputSkills" class="col-sm-3 control-label">Agama</label>
    
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="agama" readonly>
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
                                <input type="text" class="form-control" id="kwg" readonly>
                            </div>
                            </div>

                        </form>
                    </div>	
                </div>    
                <!-- /.tab-pane -->
                
                <div class="tab-pane" id="pendidikanterakhir">
                    <div class="box p-15">		
                        <form class="form-horizontal form-element col-12">
                            <div class="form-group row">
                            <label for="inputName" class="col-sm-3 control-label">Pendidikan Terakhir</label>
    
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="pendidikan_terakhir" readonly>
                            </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputName" class="col-sm-3 control-label">Jurusan</label>
        
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="jurusan_slta" readonly>
                            </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-3 control-label">Alamat</label>
        
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="alamat_slta" readonly>
                            </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputName" class="col-sm-3 control-label">Nomor Ijazah</label>
        
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="no_ijazah" readonly>
                            </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-3 control-label">Tahun Ijazah</label>
        
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="tahun_ijazah" readonly>
                            </div>
                            </div>
                        </form>
                    </div>
                </div>    
                <!-- /.tab-pane -->

                <div class="tab-pane" id="ayah">
                    <div class="box p-15">		
                        <form class="form-horizontal form-element col-12">			
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-3 control-label">Nama Ayah</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="nama_ayah" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-3 control-label">Agama</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="agama_ayah" readonly>
                                </div>
                                </div>
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-3 control-label">Pendidikan</label>

                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="pendidikan_ayah" readonly>
                            </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-3 control-label">Pekerjaan</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="pekerjaan_ayah" readonly>
                            </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-3 control-label">Penghasilan</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="penghasilan_ayah" readonly>
                            </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-3 control-label">Phone</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="phone_ayah" readonly>
                            </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputExperience" class="col-sm-3 control-label">Alamat</label>

                            <div class="col-sm-9">
                                <textarea class="form-control" id="alamat_ayah" readonly></textarea>
                            </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.tab-pane -->

                <div class="tab-pane" id="ibu">		

                    <div class="box p-15">		
                        <form class="form-horizontal form-element col-12">			
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-3 control-label">Nama Ibu</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="nama_ibu" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-3 control-label">Agama</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="agama_ibu" readonly>
                                </div>
                                </div>
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-3 control-label">Pendidikan</label>

                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="pendidikan_ibu" readonly>
                            </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-3 control-label">Pekerjaan</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="pekerjaan_ibu" readonly>
                            </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-3 control-label">Penghasilan</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="penghasilan_ibu" readonly>
                            </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-3 control-label">Phone</label>

                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="phone_ibu" readonly>
                            </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputExperience" class="col-sm-3 control-label">Alamat</label>

                            <div class="col-sm-9">
                                <textarea class="form-control" id="alamat_ibu" readonly></textarea>
                            </div>
                            </div>
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
                                <span class="text-danger" style="font-size: 0.75em">* Silahkan upload foto formal dari Universitas Proklamasi dan maksimal ukuran file 200 KB.</span>
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
                    $('#alamat_lengkap').text(result.alamat_lengkap);
                    $('#jk').val(result.jk);
                    $('#agama').val(result.nama_agama);
                    $('#status_mhs').val(result.status_mhs);
                    $('#kwg').val(result.nama_kewarganegaraan);

                    $('#pendidikan_terakhir').val(result.pendidikan_terakhir);
                    $('#jurusan_slta').val(result.jurusan_slta);
                    $('#alamat_slta').val(result.alamat_slta);
                    $('#no_ijazah_slta').val(result.no_ijazah_slta);
                    $('#tahun_ijazah_slta').val(result.tahun_ijazah_slta);

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
                    $('#agama_ayah').val(result.jurusan_slta);
                    $('#pendidikan_ayah').val(result.pendidikan_nama);
                    $('#pekerjaan_ayah').val(result.pekerjaan_nama);
                    $('#penghasilan_ayah').val(result.penghasilan_nama);
                    $('#phone_ayah').val(result.telepon_ayah);
                    $('#alamat_ayah').val(result.alamat_ayah);
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
                    $('#agama_ibu').val(result.jurusan_slta);
                    $('#pendidikan_ibu').val(result.pendidikan_nama);
                    $('#pekerjaan_ibu').val(result.pekerjaan_nama);
                    $('#penghasilan_ibu').val(result.penghasilan_nama);
                    $('#phone_ibu').val(result.telepon_ibu);
                    $('#alamat_ibu').val(result.alamat_ibu);
            }
        });
    }

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
