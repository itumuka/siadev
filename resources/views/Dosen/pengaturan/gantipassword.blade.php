@extends('layout')

@section('content')
    <div class="container-full">
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="page-title">Ganti Password</h3>
                    <div class="d-inline-block align-items-center">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                                <li class="breadcrumb-item" aria-current="page">{{ $parent_breadcrumb }}</li>
                                <li class="breadcrumb-item active" aria-current="page">>{{ $child_breadcrumb }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>

            </div>
        </div>
        <!-- Main content -->
        <section class="content">
            <div class="box">
                <div class="box-body">
                    <form id="form_edit_password" method="POST" autocomplete="off">
                        <div class="modal-body">
                            <div class="form-group row col-sm-6">
                                <label>Password Baru</label>
                                <input class="form-control" type="hidden" name="id_peg" value="{{$session_kode_dosen}}">
                                <input class="form-control" type="password" name="epasswordbaru" id="epasswordbaru"
                                    placeholder="Password Baru" autocomplete="off">
                            </div>
                            <div class="form-group row col-sm-6">
                                <label>Re-password Baru</label>
                                <input class="form-control" type="password" name="re_epasswordbaru" id="re_epasswordbaru" placeholder="Re-password Baru">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-rounded btn-warning btn-outline mr-1" data-dismiss="modal">
                                <i class="fa fa-times"></i> Close
                            </button>
                            <button type="submit" class="btn btn-rounded btn-primary btn-outline" id="btsubmit">
                                <i class="ti-save-alt"></i> Save
                            </button>
                        </div>
                    </form>
                </div>
                <!-- /.box-body -->
            </div>

    </div>

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


            // edit mhs
            $('#form_edit_password').on('submit', function(event) {
                event.preventDefault();
                var form_data = $(this).serialize();
                var epassword = $('#epasswordbaru').val();
                var epasswordulang = $('#re_epasswordbaru').val();
                if (epassword == epasswordulang) {

                    $.ajax({
                        url: "{{ config('setting.second_url') }}akademik/edit-password-dosen",
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
                                $("#btsubmit").prop('disabled', false);
                            } else if (data.success) {
                                $('#modal_editmhs').modal('hide');
                                showToastr('success', 'Success!', data.success);
                                $('#form_edit_password')[0].reset();
                                $("#btsubmit").prop('disabled', false);
                            }
                        }
                    })
                } else {
                    showToastr('error', 'Error!', "Password tidak sama!");
                }
            });




        });
    </script>
@stop
