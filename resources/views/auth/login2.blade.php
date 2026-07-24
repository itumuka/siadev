<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Sistem Informasi Akademik Universitas Muhammadiyah Karanganyar - Gen Z Dark Mode">
    <meta name="author" content="UMUKA">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ url('imageup45/logoumuka.png') }}">

    <title>SIAKAD UMUKA - Log in</title>

    <!-- Vendors Style-->
    <link rel="stylesheet" href="{{ url('css/vendors_css.css') }}">

    <!-- Style-->
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
    <link rel="stylesheet" href="{{ url('css/skin_color.css') }}">
    
    <!-- Google Fonts Outfit & Plus Jakarta Sans -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', 'Outfit', sans-serif !important;
            background-color: #030712; /* Very deep charcoal/black base */
            margin: 0;
            padding: 0;
            overflow: hidden;
            height: 100vh;
        }

        .login-wrapper {
            display: flex;
            height: 100vh;
            width: 100%;
            position: relative;
            background-color: #030712;
            overflow: hidden;
        }

        /* Subtle glowing warm amber/gold and deep navy orbs in background */
        .glow-orb-1 {
            position: absolute;
            top: -10%;
            left: 20%;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(245, 158, 11, 0.08) 0%, rgba(245, 158, 11, 0) 70%); /* Warm gold glow */
            filter: blur(65px);
            pointer-events: none;
            z-index: 1;
        }

        .glow-orb-2 {
            position: absolute;
            bottom: -10%;
            right: 10%;
            width: 600px;
            height: 600px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(30, 41, 59, 0.12) 0%, rgba(30, 41, 59, 0) 70%); /* Deep cool gray/blue */
            filter: blur(80px);
            pointer-events: none;
            z-index: 1;
        }

        /* Left Panel: Branding Section (Rich Navy to deep charcoal gradient) */
        .branding-panel {
            flex: 1.1;
            background: linear-gradient(135deg, #0b132b 0%, #1c2541 50%, #030712 100%); /* Premium Rich Navy to dark base */
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 60px 40px;
            color: #ffffff;
            overflow: hidden;
            z-index: 2;
        }

        /* Warm glowing lights in branding panel */
        .branding-panel::before {
            content: '';
            position: absolute;
            width: 350px;
            height: 350px;
            background: radial-gradient(circle, rgba(234, 179, 8, 0.05) 0%, rgba(234, 179, 8, 0) 70%);
            top: 15%;
            left: 10%;
            z-index: 1;
            pointer-events: none;
        }

        .branding-content {
            position: relative;
            z-index: 3;
            text-align: center;
            max-width: 500px;
            animation: fadeInUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        /* Elegant branding logo with warm gold border accent & glow */
        .brand-logo {
            width: 120px;
            height: 120px;
            margin-bottom: 30px;
            filter: drop-shadow(0 10px 20px rgba(0, 0, 0, 0.45));
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.08);
            padding: 7px;
            border: 1.5px solid rgba(234, 179, 8, 0.65); /* Warm yellow gold border */
            box-shadow: 0 0 15px rgba(234, 179, 8, 0.2);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.4s ease;
        }

        .brand-logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            background: #ffffff;
            border-radius: 50%;
        }

        .brand-logo:hover {
            transform: scale(1.05) rotate(5deg);
            box-shadow: 0 0 25px rgba(234, 179, 8, 0.35);
        }

        .brand-title {
            font-size: 1.6rem;
            font-weight: 700;
            margin-bottom: 12px;
            letter-spacing: 0.5px;
            line-height: 1.4;
            color: #f8fafc;
            text-shadow: 0 4px 10px rgba(0, 0, 0, 0.35);
        }

        .brand-divider {
            width: 60px;
            height: 3px;
            background: linear-gradient(90deg, #eab308 0%, #fef08a 50%, #eab308 100%); /* Warm gold gradient */
            border-radius: 2px;
            margin: 18px auto;
        }

        .brand-subtitle {
            font-size: 0.98rem;
            font-weight: 400;
            color: #94a3b8;
            line-height: 1.6;
        }

        /* Right Panel: Form (Deep Rich Navy/Dark base) */
        .form-panel {
            flex: 1;
            background-color: #030712; /* Seamless blend */
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px;
            position: relative;
            z-index: 2;
        }

        /* Modern Glassmorphic Login Card in Slate/Navy tones */
        .login-card {
            width: 100%;
            max-width: 410px;
            background: rgba(15, 23, 42, 0.45); /* Deep slate navy translucent */
            backdrop-filter: blur(25px);
            -webkit-backdrop-filter: blur(25px);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 24px;
            padding: 45px 35px;
            box-shadow: 
                0 25px 50px -12px rgba(0, 0, 0, 0.5),
                inset 0 1px 0 rgba(255, 255, 255, 0.05);
            animation: fadeInRight 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            position: relative;
        }

        .login-card:hover {
            border-color: rgba(234, 179, 8, 0.15); /* Subtle warm highlight on hover */
            box-shadow: 
                0 30px 60px -15px rgba(0, 0, 0, 0.6),
                inset 0 1px 0 rgba(255, 255, 255, 0.08);
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .login-header {
            text-align: center;
            margin-bottom: 35px;
        }

        .login-header h3 {
            font-weight: 700;
            font-size: 1.65rem;
            color: #f8fafc !important; 
            margin-bottom: 8px;
            letter-spacing: -0.3px;
        }

        .login-header p {
            color: #64748b; 
            font-size: 0.92rem;
        }

        /* Custom Input Groups */
        .custom-input-group {
            position: relative;
            margin-bottom: 22px;
        }

        .custom-input-group i.input-icon {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: #475569;
            font-size: 1rem;
            transition: color 0.3s;
            z-index: 5;
        }

        /* Modern styled input fields */
        .custom-input-group .form-control {
            background: rgba(3, 7, 18, 0.5) !important;
            border: 1px solid rgba(255, 255, 255, 0.08) !important; 
            color: #f8fafc !important; 
            border-radius: 14px !important;
            padding: 15px 20px 15px 50px !important;
            height: 52px !important;
            font-size: 0.95rem !important;
            transition: all 0.3s ease !important;
            box-shadow: none !important;
            font-family: 'Plus Jakarta Sans', sans-serif !important;
        }

        .custom-input-group .form-control::placeholder {
            color: #475569;
        }

        .custom-input-group .form-control:focus {
            border-color: #eab308 !important; /* Warm gold/yellow focus border */
            background: rgba(3, 7, 18, 0.7) !important;
            box-shadow: 0 0 12px rgba(234, 179, 8, 0.2) !important; /* Warm light focus glow */
        }

        .custom-input-group .form-control:focus ~ i.input-icon {
            color: #facc15;
        }

        /* Password Toggle Eye Icon */
        .password-toggle {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: #475569;
            cursor: pointer;
            transition: color 0.3s;
            z-index: 10;
            font-size: 1rem;
        }

        .password-toggle:hover {
            color: #facc15;
        }

        /* Primary Action 'Login' Button: deep warm yellow-gold background with lamp-like glow */
        .btn-login {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%) !important; /* Rich warm yellow-gold */
            border: none !important;
            color: #030712 !important; /* Dark text for contrast */
            font-weight: 700 !important;
            font-size: 0.98rem !important;
            height: 52px !important;
            border-radius: 14px !important;
            width: 100% !important;
            cursor: pointer;
            box-shadow: 0 0 20px rgba(245, 158, 11, 0.35) !important; /* Lamp-like warm light glow */
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Plus Jakarta Sans', sans-serif !important;
        }

        .btn-login:hover {
            transform: translateY(-1px);
            box-shadow: 0 0 35px rgba(245, 158, 11, 0.6) !important; /* Intensely glowing warm lamp effect */
            filter: brightness(1.08);
        }

        .btn-login:active {
            transform: translateY(1px);
        }

        /* Alert styling override */
        .notiferror .alert {
            border-radius: 14px;
            background-color: rgba(239, 68, 68, 0.1) !important;
            border: 1px solid rgba(239, 68, 68, 0.2) !important;
            color: #fca5a5 !important;
            padding: 12px 15px;
            font-size: 0.88rem;
            margin-bottom: 20px;
        }

        .notiferror .close {
            color: #fca5a5 !important;
            opacity: 0.8;
            text-shadow: none;
        }

        /* Copyright footer text: styled clean with gold accent */
        .login-footer {
            text-align: center;
            margin-top: 35px;
            font-size: 0.85rem;
            color: #475569; 
        }

        .login-footer a {
            color: #eab308; 
            text-decoration: none;
            transition: color 0.3s;
            font-weight: 500;
        }

        .login-footer a:hover {
            color: #fef08a;
            text-decoration: underline;
        }

        /* Keyframe Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Responsive Mobile Layout */
        @media (max-width: 991px) {
            body {
                overflow: auto;
            }
            .login-wrapper {
                flex-direction: column;
                height: auto;
                min-height: 100vh;
            }
            .branding-panel {
                flex: none;
                padding: 50px 20px;
                background: linear-gradient(135deg, #0b132b 0%, #1c2541 100%);
            }
            .brand-logo {
                width: 90px;
                height: 90px;
                margin-bottom: 15px;
            }
            .brand-title {
                font-size: 1.35rem;
            }
            .form-panel {
                flex: 1;
                padding: 40px 20px;
                background-color: #030712;
            }
            .login-card {
                padding: 35px 25px;
                box-shadow: none;
                background: transparent;
                border: none;
            }
        }
    </style>
</head>

<body>

    <div class="login-wrapper">
        <!-- Background Glowing Blobs -->
        <div class="glow-orb-1"></div>
        <div class="glow-orb-2"></div>

        <!-- Left Column: Branding Section (Seamless gradient transition) -->
        <div class="branding-panel">
            <div class="branding-content">
                <div class="brand-logo">
                    <img src="{{ url('imageup45/logoumuka.png') }}" alt="Logo UMUKA" class="img-fluid rounded-circle">
                </div>
                <h1 class="brand-title">UNIVERSITAS MUHAMMADIYAH KARANGANYAR</h1>
                <div class="brand-divider"></div>
                <p class="brand-subtitle">Sistem Informasi Akademik (SIAKAD) terintegrasi untuk mahasiswa, dosen, dan staf universitas.</p>
            </div>
        </div>

        <!-- Right Column: Login Form Section (Seamless background blend) -->
        <div class="form-panel">
            <div class="login-card">
                <div class="login-header">
                    <h3>Selamat Datang</h3>
                    <p>Silakan masuk menggunakan akun SIAKAD Anda</p>
                </div>

                <div class="notiferror"></div>

                <!-- Input Username -->
                <div class="custom-input-group">
                    <i class="fa fa-user input-icon"></i>
                    <input type="text" class="form-control" name="username" id="username" placeholder="Email / NIM" autocomplete="username">
                </div>

                <!-- Input Password -->
                <div class="custom-input-group">
                    <i class="fa fa-lock input-icon"></i>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" autocomplete="current-password">
                    <i class="fa fa-eye password-toggle" id="toggle-password-icon" onclick="togglePasswordVisibility()"></i>
                </div>

                <!-- Submit Button -->
                <button type="button" id="login_enter" onclick="aksilogin();" class="btn-login">
                    <i class="fa fa-sign-in mr-2"></i> Login
                </button>

                <div class="login-footer">
                    <p>UMUKA &copy; 2026 | <a href="http://sia.umuka.ac.id" target="_blank">Bagian Sistem Informasi</a></p>
                </div>
            </div>
        </div>
    </div>


    <!-- Vendor JS -->
    <script src="{{ url('js/vendors.min.js') }}"></script>
    <script src="{{ url('js/pages/chat-popup.js') }}"></script>
    <script src="{{ url('assets/icons/feather-icons/feather.min.js') }}"></script>
    <script src="{{ url('assets/vendor_components/jquery-toast-plugin-master/src/jquery.toast.js') }}"></script>
    <script>
        // Password Visibility Toggle Function
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggle-password-icon');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }

        // Enter keypress handler to trigger login
        $(document).keypress(function(event) {
            var keycode = (event.keyCode ? event.keyCode : event.which);
            if (keycode == '13') {
                $("#login_enter").click();
            }
        });

        // Toast notification helper
        function showToastr(type, title, message) {
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

        function startSpinner() {
            $("#login_enter").prop("disabled", true);
            $("#login_enter").html(
                '<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span> Loading...'
            );
        }

        function stopSpinner() {
            $("#login_enter").prop("disabled", false);
            $("#login_enter").html('<i class="fa fa-sign-in mr-2"></i> Login');
        }

        function aksilogin() {
            var username = $("input[name=username]").val();
            var password = $("input[name=password]").val();
            
            if (!username || !password) {
                showToastr('warning', 'Peringatan', 'Username dan Password wajib diisi.');
                return;
            }
            
            startSpinner();
            $.ajax({
                type: 'POST',
                url: "{{ config('setting.second_url') }}auth-login",
                data: {
                    username: username,
                    password: password
                },
                success: function(result) {
                    if (result.success == 'Pegawai') {
                        $.ajax({
                            type: 'GET',
                            url: "{{ url('makesession-pegawai') }}",
                            data: {
                                username: username,
                                nama: result.data.nama,
                                jabatan: result.data.jabatan,
                                nm_module: result.data.nm_module,
                                kode_fakultas: result.data.kode_fakultas,
                                semester: result.smtta[0].semester,
                                tahun: result.smtta[0].tahun,
                                tahun_ajaran: result.smtta[0].tahun_ajaran,
                                token: result.token
                            },
                            success: function(result) {
                                document.location.href = "{{ url('home') }}";
                            }
                        })
                    } else if (result.success == 'Mahasiswa') {
                        if (result.token) {
                            localStorage.setItem("user_token", result.token);
                        }
                        $.ajax({
                            type: 'GET',
                            url: "{{ url('makesession-mahasiswa') }}",
                            data: {
                                username: username,
                                nama: result.data.nama_mahasiswa,
                                gender: result.data.jenis_kelamin,
                                kode_program_studi: result.data.kode_program_studi,
                                kode_penilaian: result.data.kode_penilaian,
                                semester: result.smtta[0].semester,
                                tahun: result.smtta[0].tahun,
                                tahun_ajaran: result.smtta[0].tahun_ajaran,
                                id_mhs: result.data.id_mhs,
                                id_mreg: result.smtta[0].id_mreg,
                                token: result.token
                            },
                            success: function(result) {
                                document.location.href = "{{ route('home') }}";
                            }
                        })
                    } else if (result.success == 'Dosen') {
                        $.ajax({
                            type: 'GET',
                            url: "{{ url('makesession-dosen') }}",
                            data: {
                                username: result.data.email_login,
                                nidn: result.data.nidn,
                                nama: result.data.nama_dosen,
                                kode_program_studi: result.data.kode_prodi,
                                dosen_wali: result.data.dosen_wali,
                                id_dosen: result.data.id_pegawai,
                                kaprodi: result.data.pimpinan_prodi,
                                semester: result.smtta[0].semester,
                                tahun: result.smtta[0].tahun,
                                tahun_ajaran: result.smtta[0].tahun_ajaran,
                                token: result.token
                            },
                            success: function(result) {
                                document.location.href = "{{ route('home') }}";
                            }
                        })
                    } else {
                        $(".notiferror").html(
                            '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Gagal Login!! </strong><br> ' +
                            result.error +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
                        );
                    }
                    stopSpinner();
                },
                error: function(xhr, status, error) {
                    showToastr('error', 'Error', 'Terjadi kesalahan sistem. Silakan coba beberapa saat lagi.');
                    stopSpinner();
                }
            })
        }

        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
    </script>

</body>

</html>
