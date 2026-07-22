<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="SIA UMUKA">
    <meta name="author" content="Labkom UMUKA">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
        /* Logo Box Centering & Premium Shadow */
        .logo-box {
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
        }
        .logo-box .logo {
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            flex-grow: 1;
            padding: 0 !important;
        }
        .logo-lg img {
            filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.35));
            transition: all 0.3s ease;
        }
        .logo-lg img:hover {
            filter: drop-shadow(0 6px 12px rgba(0, 0, 0, 0.5));
            transform: scale(1.04);
        }

        /* Premium Floating Capsule Active Menu */
        .sidebar-menu > li.active:not(.treeview) > a,
        .sidebar-menu .treeview-menu > li.active > a {
            background: linear-gradient(135deg, #7C261B 0%, #a8382a 100%) !important;
            color: #ffffff !important;
            border-radius: 12px !important;
            margin: 4px 14px !important;
            padding: 12px 18px !important;
            box-shadow: 0 8px 16px rgba(124, 38, 27, 0.3) !important;
            transition: all 0.3s ease !important;
        }

        .sidebar-menu > li.active:not(.treeview) > a i,
        .sidebar-menu .treeview-menu > li.active > a i {
            color: #ffffff !important;
        }

        .sidebar-menu > li.active:not(.treeview) > a:hover,
        .sidebar-menu .treeview-menu > li.active > a:hover {
            transform: translateY(-1.5px);
            box-shadow: 0 10px 20px rgba(124, 38, 27, 0.45) !important;
            filter: brightness(1.05);
        }

        /* Parent treeview link when sub-item is active */
        .sidebar-menu > li.treeview.active > a {
            background: rgba(124, 38, 27, 0.08) !important;
            color: #7C261B !important;
            border-radius: 12px !important;
            margin: 4px 14px !important;
            padding: 12px 18px !important;
            border-left: 4px solid #7C261B !important;
        }

        .sidebar-menu > li.treeview.active > a i {
            color: #7C261B !important;
        }

        /* Remove default active styling */
        .theme-primary.light-skin .sidebar-menu > li.active {
            background-color: transparent !important;
            border-left: none !important;
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

        .sidebar-menu .menu-ta-beta > a,
        .sidebar-menu .menu-ta-beta .treeview-menu > li > a {
            white-space: normal;
            line-height: 1.35;
        }

        .sidebar-menu .menu-beta-badge {
            display: inline-block;
            margin-left: 6px;
            padding: 1px 6px;
            font-size: 10px;
            line-height: 1.3;
            color: #fff;
            background-color: #dc3545;
            border-radius: 10px;
            vertical-align: middle;
        }
        /* Logo Hover Micro-animation */
        .logo-lg img {
            transition: transform 0.3s ease;
        }
        .logo:hover .logo-lg img {
            transform: scale(1.05);
        }

        /* Premium Sidebar User Panel */
        .sidebar-user-panel {
            padding: 16px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            background-color: rgba(255, 255, 255, 0.03);
            transition: all 0.3s ease;
        }

        .sidebar-user-avatar {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: linear-gradient(135deg, #7C261B 0%, #a8382a 100%);
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.05rem;
            box-shadow: 0 4px 10px rgba(124, 38, 27, 0.15);
            flex-shrink: 0;
            text-transform: uppercase;
        }

        .sidebar-user-info {
            overflow: hidden;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .sidebar-user-name {
            font-size: 0.88rem;
            font-weight: 600;
            color: #f8fafc;
            margin: 0;
            white-space: nowrap;
            text-overflow: ellipsis;
            overflow: hidden;
            line-height: 1.3;
        }

        .sidebar-user-email {
            font-size: 0.72rem;
            color: #cbd5e1;
            margin: 2px 0 0 0;
            white-space: nowrap;
            text-overflow: ellipsis;
            overflow: hidden;
            line-height: 1.2;
        }

        .sidebar-user-role {
            display: inline-flex;
            align-items: center;
            font-size: 0.65rem;
            font-weight: 700;
            color: #fca5a5;
            background-color: rgba(248, 113, 113, 0.15);
            padding: 2px 6px;
            border-radius: 4px;
            margin-top: 5px;
            width: fit-content;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Collapsed Sidebar User Panel Styles */
        .sidebar-collapse .sidebar-user-panel {
            padding: 12px 0;
            justify-content: center;
            gap: 0;
        }

        .sidebar-collapse .sidebar-user-info {
            display: none !important;
        }
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
                <a href="{{ route('home') }}" class="logo">
                    <!-- logo-->
                    <div class="logo-lg">
                        <span class="light-logo"><img src="{{ url('imageup45/logoumukapanjang.png') }}" alt="logo"
                                style="max-height: 38px; width: auto !important; object-fit: contain;"></span>
                        <span class="dark-logo"><img src="{{ url('imageup45/logoumukapanjang.png') }}" alt="logo"
                                style="max-height: 38px; width: auto !important; object-fit: contain;"></span>
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
                        
                        <!-- Notifications Dropdown -->
                        <li class="dropdown messages-menu" id="notification_dropdown_container">
                            <a href="#" class="waves-effect waves-light dropdown-toggle" data-toggle="dropdown" title="Notifikasi" id="notification_bell_btn">
                                <i class="icon-Notifications"><span class="path1"></span><span class="path2"></span></i>
                                <span class="label label-danger" id="notification_badge" style="display: none; position: absolute; top: 8px; right: 5px; font-size: 9px; padding: 2px 4px; border-radius: 50%;">0</span>
                            </a>
                            <ul class="dropdown-menu animated flipInX" style="width: 320px; max-height: 480px; overflow-y: auto;">
                                <li class="header">
                                    <div class="d-flex justify-content-between align-items-center p-10 bg-light border-bottom">
                                        <span class="font-weight-bold text-dark"><i class="fa fa-bell text-primary"></i> Notifikasi</span>
                                        <a href="javascript:void(0);" id="btn_mark_all_read" style="font-size: 8.5pt; font-weight: 600;" class="text-primary"><i class="fa fa-check-circle"></i> Tandai Semua Dibaca</a>
                                    </div>
                                </li>
                                <li>
                                    <ul class="menu" id="notification_list_container" style="list-style: none; padding: 0; margin: 0; max-height: 350px; overflow-y: auto;">
                                        <!-- Will be populated dynamically via JavaScript -->
                                        <li class="text-center py-4 text-muted" id="notification_empty_state">
                                            <i class="fa fa-bell-slash-o fa-2x mb-2 d-block"></i>
                                            Tidak ada notifikasi baru
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>

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
            &copy; 2026 <a href="#">Universitas Muhammadiyah Karanganyar</a>. All Rights Reserved.
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
    
    <script src="{{ url('js/qrcode.js') }}"></script>
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


            // ================= SYSTEM NOTIFICATIONS SYSTEM =================
            var notificationsUrl = "{{ config('setting.second_url') }}notifications";

            function fetchNotifications() {
                if (!token || !userlogin) return;
                
                $.ajax({
                    url: notificationsUrl,
                    method: "GET",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    success: function(res) {
                        if (res.status === 'success') {
                            updateNotificationUI(res.notifications, res.unread_count);
                        }
                    },
                    error: function(err) {
                        console.error('Gagal mengambil notifikasi', err);
                    }
                });
            }

            function updateNotificationUI(list, unreadCount) {
                // Update badge
                if (unreadCount > 0) {
                    $('#notification_badge').text(unreadCount).show();
                } else {
                    $('#notification_badge').hide();
                }

                // Update list dropdown
                if (list.length > 0) {
                    $('#notification_empty_state').hide();
                    
                    // Clear old entries but keep empty state if needed
                    $('.dynamic-notification-item').remove();

                    let itemsHtml = '';
                    list.forEach(function(item) {
                        let readStyle = item.is_read ? 'opacity: 0.7;' : 'background-color: rgba(0, 82, 204, 0.05); font-weight: bold; border-left: 3px solid #0052cc;';
                        let typeIcon = 'fa-info-circle text-info';
                        if (item.type === 'skripsi') typeIcon = 'fa-graduation-cap text-primary';
                        else if (item.type === 'krs') typeIcon = 'fa-file-text-o text-success';
                        else if (item.type === 'nilai') typeIcon = 'fa-calculator text-warning';

                        itemsHtml += `
                            <li class="dynamic-notification-item" style="border-bottom: 1px solid rgba(0,0,0,0.05); ${readStyle}">
                                <a href="javascript:void(0);" class="p-10 d-block notification-click-target" data-id="${item.id}" data-url="${item.target_url || ''}">
                                    <div class="d-flex align-items-start">
                                        <div class="mr-10 mt-5">
                                            <i class="fa ${typeIcon} fa-lg"></i>
                                        </div>
                                        <div style="flex-grow: 1; white-space: normal;">
                                            <div class="text-dark font-size-13">${item.title}</div>
                                            <div class="text-muted font-size-11 my-5">${item.message}</div>
                                            <div class="text-primary font-size-10 font-italic">${item.time_diff}</div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        `;
                    });
                    
                    $('#notification_list_container').prepend(itemsHtml);
                } else {
                    $('.dynamic-notification-item').remove();
                    $('#notification_empty_state').show();
                }
            }

            // Click single notification
            $(document).on('click', '.notification-click-target', function(e) {
                e.preventDefault();
                let notifId = $(this).data('id');
                let redirectUrl = $(this).data('url');

                $.ajax({
                    url: notificationsUrl + "/read",
                    method: "POST",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    data: { id: notifId },
                    success: function() {
                        if (redirectUrl) {
                            window.location.href = redirectUrl.startsWith('/') ? "{{ url('/') }}" + redirectUrl : redirectUrl;
                        } else {
                            fetchNotifications();
                        }
                    },
                    error: function() {
                        if (redirectUrl) {
                            window.location.href = redirectUrl.startsWith('/') ? "{{ url('/') }}" + redirectUrl : redirectUrl;
                        }
                    }
                });
            });

            // Click mark all as read
            $('#btn_mark_all_read').on('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                $.ajax({
                    url: notificationsUrl + "/read",
                    method: "POST",
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    success: function() {
                        fetchNotifications();
                        showToastr('success', 'Berhasil', 'Semua notifikasi telah ditandai dibaca.');
                    }
                });
            });

            // Initial load & Polling (Every 60 seconds)
            fetchNotifications();
            setInterval(fetchNotifications, 60000);

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
