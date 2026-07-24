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
    
    <!-- Google Fonts Outfit -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Outfit', sans-serif !important;
            background-color: #121214; /* Deep, textured matte charcoal black */
            background-image: 
                radial-gradient(circle at 10% 20%, rgba(18, 18, 20, 0.9) 0%, rgba(10, 10, 12, 0.95) 100%),
                radial-gradient(rgba(255, 255, 255, 0.015) 1px, transparent 0);
            background-size: auto, 24px 24px;
            margin: 0;
            padding: 0;
            overflow: hidden;
            height: 100vh;
        }

        .login-wrapper {
            display: flex;
            height: 100vh;
            width: 100%;
        }

        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Left Panel: Branding / Curves (Deep Violet to Deep Charcoal Gradient) */
        .branding-panel {
            flex: 1.2;
            background: linear-gradient(135deg, #2e1065 0%, #1e1b4b 40%, #111827 80%, #121214 100%);
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px;
            color: #ffffff;
            overflow: hidden;
            border-right: 1px solid rgba(255, 255, 255, 0.03);
        }

        /* Glowing accents */
        .branding-panel::before {
            content: '';
            position: absolute;
            top: -20%;
            right: -20%;
            width: 80%;
            height: 80%;
            background: radial-gradient(circle, rgba(212, 175, 55, 0.08) 0%, rgba(212, 175, 55, 0) 70%);
            z-index: 1;
            pointer-events: none;
        }

        .branding-panel::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -10%;
            width: 90%;
            height: 90%;
            background: radial-gradient(circle, rgba(139, 92, 246, 0.15) 0%, rgba(139, 92, 246, 0) 70%);
            z-index: 1;
            pointer-events: none;
        }

        /* Background organic curved SVG */
        .branding-bg-curves {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            pointer-events: none;
            opacity: 0.35;
        }

        .branding-content {
            position: relative;
            z-index: 2;
            text-align: center;
            max-width: 520px;
            animation: fadeInUp 1s ease-out;
        }

        @keyframes brandLogoPulse2 {
            0% {
                box-shadow: 0 8px 32px rgba(0, 0, 0, 0.5), 0 0 0 0px rgba(212, 175, 55, 0.25);
            }
            70% {
                box-shadow: 0 8px 32px rgba(0, 0, 0, 0.5), 0 0 0 10px rgba(212, 175, 55, 0);
            }
            100% {
                box-shadow: 0 8px 32px rgba(0, 0, 0, 0.5), 0 0 0 0px rgba(212, 175, 55, 0);
            }
        }

        @keyframes shineDivider {
            0% { background-position: 0% 50%; }
            100% { background-position: 200% 50%; }
        }

        /* Logo: detailed but rendered in muted, aged gold and matte white against violet background */
        .brand-logo {
            width: 130px;
            height: 130px;
            margin-bottom: 25px;
            filter: drop-shadow(0 12px 24px rgba(0, 0, 0, 0.6));
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.08);
            padding: 8px;
            border: 2.5px dashed rgba(212, 175, 55, 0.75); /* Muted aged gold border */
            transition: transform 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            animation: brandLogoPulse2 3s infinite ease-in-out;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.5), inset 0 2px 4px rgba(255, 255, 255, 0.1);
            position: relative;
            overflow: hidden;
        }

        .brand-logo::after {
            content: '';
            position: absolute;
            top: 0;
            left: -150%;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                90deg,
                rgba(255, 255, 255, 0) 0%,
                rgba(255, 255, 255, 0.25) 50%,
                rgba(255, 255, 255, 0) 100%
            );
            transform: skewX(-20deg);
            transition: left 0.8s ease-out;
        }

        .brand-logo:hover::after {
            left: 150%;
        }

        .brand-logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            transition: all 0.3s ease;
            filter: grayscale(15%) sepia(20%) brightness(95%) contrast(105%); /* aged gold/matte white tint */
            background: #ffffff !important;
        }

        .brand-logo:hover {
            transform: rotate(15deg) scale(1.08);
        }

        .brand-title {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 12px;
            letter-spacing: 0.8px;
            line-height: 1.3;
            color: #f8fafc; /* Clean, light matte white */
            text-shadow: 0 4px 12px rgba(0, 0, 0, 0.4), 0 0 10px rgba(139, 92, 246, 0.25);
        }

        .brand-divider {
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, #d4af37 0%, #fef08a 50%, #d4af37 100%); /* Muted aged gold divider */
            background-size: 200% auto;
            border-radius: 2px;
            margin: 15px auto;
            animation: shineDivider 4s infinite linear;
        }

        .brand-subtitle {
            font-size: 1.15rem;
            font-weight: 400;
            color: #cbd5e1; /* Clean, light matte white */
            line-height: 1.5;
        }

        /* Right Panel: Form (Deep Matte Charcoal Black Background) */
        .form-panel {
            flex: 1;
            background-color: #121214; 
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px;
            position: relative;
            z-index: 2;
        }

        /* Wave Divider between panels */
        .wave-divider {
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 120px;
            fill: #121214; /* Match form panel background */
            transform: translateX(-99%);
            z-index: 10;
            pointer-events: none;
        }

        /* Login Card: smooth, very dark, cool-toned slate gray */
        .login-card {
            width: 100%;
            max-width: 430px;
            background: rgba(30, 41, 59, 0.7); 
            backdrop-filter: blur(30px);
            -webkit-backdrop-filter: blur(30px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 30px;
            padding: 45px 35px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.6), inset 0 1px 1px rgba(255, 255, 255, 0.05);
            animation: fadeInRight 1s ease-out;
        }

        .login-header {
            text-align: center;
            margin-bottom: 35px;
        }

        /* Welcome text: clear matte white */
        .login-header h3 {
            font-weight: 600;
            font-size: 1.8rem;
            color: #f8fafc !important; 
            margin-bottom: 8px;
            letter-spacing: -0.5px;
        }

        .login-header p {
            color: #e2e8f0; 
            font-size: 0.95rem;
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
            color: rgba(94, 234, 212, 0.65); /* soft deep turquoise tint for icon */
            font-size: 1.1rem;
            transition: color 0.3s;
            z-index: 5;
        }

        /* Input field: borders and input text itself have soft, deep turquoise or cool teal tint */
        .custom-input-group .form-control {
            background: rgba(15, 23, 42, 0.75) !important;
            border: 1.5px solid rgba(13, 148, 136, 0.3) !important; 
            color: #99f6e4 !important; 
            border-radius: 18px !important;
            padding: 15px 20px 15px 52px !important;
            height: 56px !important;
            font-size: 0.98rem !important;
            transition: all 0.3s ease !important;
            box-shadow: none !important;
            font-family: 'Outfit', sans-serif !important;
        }

        .custom-input-group .form-control::placeholder {
            color: rgba(94, 234, 212, 0.45);
        }

        .custom-input-group .form-control:focus {
            border-color: #0d9488 !important; /* Deep turquoise focus */
            background: rgba(15, 23, 42, 0.9) !important;
            box-shadow: 0 0 14px rgba(13, 148, 136, 0.35) !important;
        }

        .custom-input-group .form-control:focus ~ i.input-icon {
            color: #2dd4bf;
        }

        /* Password Toggle Eye Icon */
        .password-toggle {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(94, 234, 212, 0.65);
            cursor: pointer;
            transition: color 0.3s;
            z-index: 10;
            font-size: 1.1rem;
        }

        .password-toggle:hover {
            color: #2dd4bf;
        }

        /* Primary Action 'Login' Button: deep, rich turquoise with intense, cool-toned neon turquoise border and subtle cool-light glow */
        .btn-login {
            background: linear-gradient(135deg, #0f766e 0%, #0d9488 100%) !important; 
            border: 2px solid #2dd4bf !important; 
            color: #ffffff !important;
            font-weight: 600 !important;
            font-size: 1.05rem !important;
            height: 56px !important;
            border-radius: 18px !important;
            width: 100% !important;
            cursor: pointer;
            box-shadow: 0 0 15px rgba(45, 212, 191, 0.35) !important; 
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Outfit', sans-serif !important;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 0 25px rgba(45, 212, 191, 0.55) !important; 
            filter: brightness(1.1);
        }

        .btn-login:active {
            transform: translateY(1px);
        }

        /* Alert styling override */
        .notiferror .alert {
            border-radius: 16px;
            background-color: rgba(239, 68, 68, 0.15) !important;
            border: 1px solid rgba(239, 68, 68, 0.3) !important;
            color: #fca5a5 !important;
            padding: 15px;
            font-size: 0.9rem;
            margin-bottom: 20px;
        }

        .notiferror .close {
            color: #fca5a5 !important;
            opacity: 0.8;
            text-shadow: none;
        }

        .notiferror .close:hover {
            opacity: 1;
        }

        /* Small footer and copyright text: clear matte white, accented in deep gold */
        .login-footer {
            text-align: center;
            margin-top: 35px;
            font-size: 0.88rem;
            color: #e2e8f0; 
        }

        .login-footer a {
            color: #d4af37; 
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
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(45px);
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
                padding: 60px 20px;
                border-right: none;
                border-bottom: 1px solid rgba(255, 255, 255, 0.03);
            }
            .brand-logo {
                width: 100px;
                height: 100px;
                margin-bottom: 15px;
            }
            .brand-title {
                font-size: 1.5rem;
            }
            .form-panel {
                flex: 1;
                padding: 40px 20px;
                background-color: #121214;
            }
            .wave-divider {
                display: none;
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
        <!-- Left Column: Branding Section with Curved Elements -->
        <div class="branding-panel">
            <!-- Organic elegant curves background -->
            <svg class="branding-bg-curves" viewBox="0 0 800 800" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M-100,200 C100,300 200,100 400,300 C600,500 700,300 900,400" stroke="rgba(167, 139, 250, 0.12)" stroke-width="4" stroke-dasharray="10 15" />
                <path d="M-50,300 C150,450 300,250 500,450 C700,650 650,400 850,550" stroke="rgba(139, 92, 246, 0.16)" stroke-width="6" />
                <path d="M-200,450 C50,600 150,400 350,600 C550,800 600,550 800,700" stroke="rgba(212, 175, 55, 0.08)" stroke-width="8" />
            </svg>

            <div class="branding-content">
                <div class="brand-logo">
                    <img src="{{ url('imageup45/logoumuka.png') }}" alt="Logo UMUKA" class="img-fluid rounded-circle" style="background: white;">
                </div>
                <h1 class="brand-title">UNIVERSITAS MUHAMMADIYAH KARANGANYAR</h1>
                <div class="brand-divider"></div>
                <p class="brand-subtitle">Sistem Informasi Akademik (SIAKAD) terintegrasi untuk mahasiswa, dosen, dan staf universitas.</p>
            </div>
        </div>

        <!-- Right Column: Login Form Section with Wave Divider -->
        <div class="form-panel">
            <!-- Wave Divider cutting into left column -->
            <svg class="wave-divider" viewBox="0 0 100 100" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M100,0 C30,30 0,70 100,100 Z" />
            </svg>

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

        // Use custom styling for spinner stopping
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
