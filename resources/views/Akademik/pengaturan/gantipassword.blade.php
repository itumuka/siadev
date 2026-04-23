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
                                <li class="breadcrumb-item" aria-current="page">Master</li>
                                <li class="breadcrumb-item active" aria-current="page">Ganti Password</li>
                            </ol>
                        </nav>
                    </div>
                </div>

            </div>
        </div>
        <!-- Main content -->
        <section class="content">
            <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                    <form id="form_add" method="POST">
                        <div class="modal-body">
                            <input type="hidden" name="username" value="{{ Session::get('username') }}">
                            <div class="form-group">
                                <label>Password Baru</label>
                                <input class="form-control" type="text" name="password_baru" id="epasswordbaru"
                                    placeholder="Password Baru" min="10">
                            </div>
                            <div class="form-group">
                                <label>Re-password Baru</label>
                                <input class="form-control" type="text" name="re_password_baru" id="re_epasswordbaru"
                                    min="10" placeholder="Re-password Baru">
                            </div>
                        </div>
                        <div class="modal-footer float-right">
                            <button type="button" class="btn btn-rounded btn-warning btn-outline mr-1"
                                data-dismiss="modal">
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
        var userlogin = "{{ Session::get('username') }}";
        var token = "{{ Session::get('token') }}";
        //save
        $('#form_add').on('submit', function(event) {
            event.preventDefault();
            var form_data = $(this).serialize();
            var epassword = $('#epasswordbaru').val();
            var epasswordulang = $('#re_epasswordbaru').val();
            if (epassword == epasswordulang) {
                $.ajax({
                    url: "{{ config('setting.second_url') }}akademik/edit_password_dekanadmin",
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
                        } else if (data.success) {
                            showToastr('success', 'Success!', data.success);
                        }
                    }
                })
            } else {
                showToastr('error', 'Error!', "Password tidak sama!");
            }
        });
    </script>
@stop
