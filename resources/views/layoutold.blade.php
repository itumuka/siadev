<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="SIA UMUKA">
    <meta name="author" content="Labkom UMUKA">
    <link rel="icon" href="{{ url('imageup45/logoumuka.png') }}">

    <title>{{ $title }}</title>

    <!-- Vendors Style-->
    <link rel="stylesheet" href="{{ url('css/vendors_css.css') }}">

    <!-- Style-->
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
    <link rel="stylesheet" href="{{ url('css/skin_color.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ url('assets/vendor_components/bootstrap-duallistbox-4/dist/bootstrap-duallistbox.css') }}">

    <style>
        .theme-primary.light-skin .sidebar-menu>li.active {
            background-color: rgba(0, 82, 204, 0);
            /* color: #0052cc; */
            border-left: 5px solid #7C261B;
        }

        .swal-popup {
            font-size: 0.5rem !important;
            /* width:400px !important;
            height:300px !important; */
        }

        table.dataTable tr th.select-checkbox.selected::after {
            content: "✔";
            margin-top: -11px;
            margin-left: -4px;
            text-align: center;
            text-shadow: rgb(176, 190, 217) 1px 1px, rgb(176, 190, 217) -1px -1px, rgb(176, 190, 217) 1px -1px, rgb(176, 190, 217) -1px 1px;
        }

        table.dataTable tbody th,
        table.dataTable tbody td {
            padding: 4px 10px;
            /* e.g. change 8x to 4px here */
        }
        .lowercase {
            text-transform: lowercase;
        }
        /* thead th {
            background-color: #172B4C !important;
        } */
    </style>

    @yield('css')

</head>

<body class="hold-transition light-skin sidebar-mini theme-primary fixed ">

    <div class="wrapper">
        <div id="loader"></div>

        <header class="main-header">
            <div class="d-flex align-items-center logo-box ">
                <!-- Logo -->
                <a href="#"
                    class="waves-effect waves-light nav-link d-none d-md-inline-block mx-10 push-btn bg-transparent"
                    data-toggle="push-menu" role="button">
                    <span class="icon-Align-right"><span class="path1"></span><span class="path2"></span><span
                            class="path3"></span></span>
                </a>
                <a href="index.html" class="logo">
                    <!-- logo-->
                    <div class="logo-lg">
                        <span class="light-logo"><img src="{{ url('imageup45/logoumukapanjang.png') }}" alt="logo"
                                style="width:100px"></span>
                        <span class="dark-logo"><img src="{{ url('imageup45/logoumukapanjang.png') }}" alt="logo"
                                style="width:100px"></span>
                    </div>
                </a>
            </div>
            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <div class="app-menu">
                    <ul class="header-megamenu nav">
                        <li class="btn-group nav-item d-md-none">
                            <a href="#" class="waves-effect waves-light nav-link push-btn" data-toggle="push-menu"
                                role="button">
                                <span class="icon-Align-left"><span class="path1"></span><span
                                        class="path2"></span><span class="path3"></span></span>
                            </a>
                        </li>

                    </ul>
                </div>

                <div class="navbar-custom-menu r-side">
                    <ul class="nav navbar-nav">

                        @if (Session::get('tipe') == 'Pegawai' || Session::get('tipe') == 'Dosen')
                            <li>
                                <a href="#" data-toggle="modal" data-target="#modal-right" title="Setting"
                                    class="waves-effect waves-light dropdown-toggle">
                                    <i class="icon-Settings"><span class="path1"></span><span
                                            class="path2"></span></i>
                                </a>
                            </li>
                        @endif
                        <!-- User Account-->
                        <li class="dropdown user user-menu">
                            <a href="#" class="waves-effect waves-light dropdown-toggle" data-toggle="dropdown"
                                title="User">
                                <i class="icon-User"><span class="path1"></span><span class="path2"></span></i>
                            </a>
                            <ul class="dropdown-menu animated flipInX">
                                <li class="user-body">

                                    @if (Session::get('tipe') == 'Mahasiswa')
                                        <a class="dropdown-item" href="{{ route('mhsprofil') }}"><i
                                                class="ti-user text-muted mr-2"></i>
                                            Profil</a>

                                        <a class="dropdown-item" href="{{ route('mhsgantipassword') }}"><i
                                                class="ti-settings text-muted mr-2"></i>
                                            Ganti Password</a>
                                    @endif
                                    <div class="dropdown-divider"></div>
                                    <button type="button" class="dropdown-item" onclick="logout();"><i
                                            class="ti-lock text-muted mr-2"></i> Logout</button>
                                </li>
                            </ul>
                        </li>
                    </ul>

                </div>
            </nav>
        </header>

        <div class="modal modal-right fade" id="modal-right" tabindex="-1">
            <div class="modal-dialog">
                <form id="form_tahunakademik" method="GET">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tahun Akademik</h5>
                            <button type="button" class="close" data-dismiss="modal">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <p class="text-dark my-10 font-size-16">
                            <div class="px-25 py-10 w-100"><span class="badge badge-warning" id="ta"></span>
                            </div>
                            Sesuaikan <strong class="text-warning">Tahun Akademik</strong> pilihanmu!
                            </p>
                            <p class="mb-2 text-dark my-10 font-size-16">
                                <select class="form-control selecttahunakademik" style="width: 100%;"
                                    name="tahunakademik" id="tahunakademik"></select>
                            </p>
                            {{-- <p>
                        <button type="submit" class="btn btn-sm btn-rounded btn-primary btn-outline"><i class="ti-reload"></i> Pilih
                        </button>
                    </p> --}}
                        </div>
                        <div class="modal-footer modal-footer-uniform">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary float-right">Save changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        @if (Session::get('tipe') == 'Pegawai')
            @include('sidebar_pegawai')
        @elseif (Session::get('tipe') == 'Dosen')
            @include('sidebar_dosen')
        @else
            @include('sidebar_mahasiswa')
        @endif


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <div class="pull-right d-none d-sm-inline-block">
                <ul class="nav nav-primary nav-dotted nav-dot-separated justify-content-center justify-content-md-end">
                    <li class="nav-item">
                        {{-- <a class="nav-link" href="javascript:void(0)">FAQ</a> --}}
                    </li>
                    <li class="nav-item">
                        {{-- <a class="nav-link" href="#">Purchase Now</a> --}}
                    </li>
                </ul>
            </div>
            &copy; 2023 <a href="#">Universitas Muhammadiyah Karanganyar</a>. All Rights Reserved.
        </footer>

        <!-- Control Sidebar -->

        <!-- /.control-sidebar -->

        <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>

    </div>
    <!-- ./wrapper -->


    <!-- Page Content overlay -->
    <script src="{{ URL::asset('js/jquery.min.js') }}"></script>

    <!-- Vendor JS -->
    <script src="{{ url('js/vendors.min.js') }}"></script>
    <script src="{{ url('js/pages/chat-popup.js') }}"></script>
    <script src="{{ url('assets/icons/feather-icons/feather.min.js') }}"></script>
    <script src="{{ url('js/pages/advanced-form-element.js') }}"></script>
    <script src="{{ url('assets/vendor_plugins/iCheck/icheck.min.js') }}"></script>

    {{-- <script src="{{ url('assets/vendor_components/apexcharts-bundle/dist/apexcharts.js') }}"></script> --}}
    <script src="{{ url('assets/vendor_components/moment/min/moment.min.js') }}"></script>
    <script src="{{ url('assets/vendor_components/fullcalendar/fullcalendar.js') }}"></script>
    <script src="{{ url('assets/vendor_components/datatable/datatables.min.js') }}"></script>

    <!-- EduAdmin App -->
    {{-- <script src="{{ url('js/pages/dashboard.js') }}"></script> --}}
    {{-- <script src="{{ url('js/pages/calendar.js') }}"></script> --}}
    <script src="{{ url('assets/vendor_components/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ url('assets/vendor_components/jquery-toast-plugin-master/src/jquery.toast.js') }}"></script>
    <script src="{{ url('assets/vendor_components/bootstrap-select/dist/js/bootstrap-select.js') }}"></script>
    <script src="{{ url('assets/vendor_components/select2/dist/js/select2.full.js') }}"></script>
    {{-- <script src="{{ url('js/pages/c3-bar-pie.js') }}"></script> --}}
    <script src="{{ url('assets/vendor_components/jquery-steps-master/build/jquery.steps.js') }}"></script>
    <script src="{{ url('assets/vendor_components/jquery-validation-1.17.0/dist/jquery.validate.min.js') }}"></script>
    <script src="{{ url('js/pages/steps.js') }}"></script>
    <script src="{{ url('js/template.js') }}"></script>

    <script src="{{ url('assets/vendor_components/bootstrap-duallistbox-4/dist/jquery.bootstrap-duallistbox.js') }}">
    </script>
    <script src="{{ url('assets/vendor_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.js') }}"></script>
    <script src="{{ url('assets/vendor_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js') }}">
    </script>
    <script src="{{ url('assets/vendor_plugins/input-mask/jquery.inputmask.js') }}"></script>
    <script src="{{ url('assets/vendor_plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
    <script src="{{ url('assets/vendor_plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>
    <script src="{{ url('assets/vendor_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ url('assets/vendor_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ url('assets/vendor_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}">
    </script>
    <script src="{{ url('assets/vendor_plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var token = "{{ Session::get('token') }}";
            var userlogin = "{{ Session::get('username') }}";

            // $.ajaxSetup({
            //             headers: {
            //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //             }
            // });


            $('.selecttahunakademik').select2({
                allowClear: true,
                placeholder: '-Select Tahun Akademik-',
                ajax: {
                    dataType: 'json',
                    url: "{{ config('setting.second_url') }}akademik/select-tahunakademik",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    delay: 100,
                    data: function(params) {
                        return {
                            search: params.term
                        }
                    },
                    processResults: function(data) {
                        var data_array = [];
                        data.data.forEach(function(value, key) {
                            data_array.push({
                                id: value.id,
                                text: value.text
                            })
                        });

                        return {
                            results: data_array
                        }
                    }
                }
            }).on('selecttahunakademik:select', function(evt) {
                $(".selecttahunakademik option:selected").val();
            });

            function make_session_depan(a) {
                $.ajax({
                    url: "{{ route('make_session') }}",
                    method: "GET",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    data: {
                        semester: a.smtta[0].semester,
                        tahun: a.smtta[0].tahun,
                        tahun_ajaran: a.smtta[0].tahun_ajaran
                    },
                    dataType: "json",
                    success: function(result) {
                        location.reload();
                    }
                })
            }

            $('#form_tahunakademik').on('submit', function(event) {
                event.preventDefault();
                var form_data = $(this).serialize();
                $.ajax({
                    url: "{{ config('setting.second_url') }}akademik/change-session-tahunakademik",
                    method: "GET",
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
                            showToastr('success', 'Success!', data.success);
                            $("#btsubmit").prop('disabled', false);
                            make_session_depan(data);

                        }
                    }
                })
            });

            $('#modal-right').on('shown.bs.modal', function() {
                $.ajax({
                    url: "{{ route('getsession_ta') }}",
                    method: "GET",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        $("#ta").html(data.ket);
                    }
                });

            })


        });

        function showToastr(type, title, message) {
            let body;
            $.toast({
                heading: title,
                text: message,
                position: 'top-right',
                loaderBg: '#ff6849',
                icon: type,
                hideAfter: 3500,
                stack: 6
            });
        }

        function logout_session_depan() {
            $.ajax({
                url: "{{ route('logout') }}",
                method: "GET",
                dataType: "json",
                // headers: {
                //     "Authorization": 'Bearer ' + token,
                //     "username": userlogin
                // },
                success: function(result) {
                    document.location.href = "{{ url('/') }}";
                }
            })
        }

        // function logout() {
        //     $.ajax({
        //         url: "{{ config('setting.second_url') }}logout",
        //         method: "GET",
        //         dataType: "json",
        //         // headers: {
        //         //     "Authorization": 'Bearer ' + token,
        //         //     "username": userlogin
        //         // },
        //         success: function(data) {
        //             logout_session_depan();
        //         }
        //     })

        // }

        function logout() {
            let token = localStorage.getItem('jwt_token'); // Ambil token dari localStorage

            $.ajax({
                url: "{{ config('setting.second_url') }}logout",
                method: "GET",
                headers: {
                    "Authorization": "Bearer " + token // Kirim token JWT
                },
                dataType: "json",
                success: function(data) {
                    // Hapus token dari localStorage
                    localStorage.removeItem('jwt_token');

                    // Redirect ke halaman login
                    window.location.href = "{{ url('/') }}";
                },
                error: function(xhr, status, error) {
                    console.log("Logout gagal: ", error);
                }
            });
        }
        
        // select: {
        //     style: 'multi',
        //     selector: 'td:first-child'
        // },
    </script>
    @yield('script-master')
    @yield('script-advanced')
</body>

</html>
