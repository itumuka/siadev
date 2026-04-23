<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar position-relative">
        <div class="multinav">
            <div class="multinav-scroll" style="height: 100%;">
                <!-- sidebar menu-->
                <ul class="sidebar-menu" data-widget="tree"><br><br>
                    {{-- <center><a href="#"
                            class="mr-15 bg-lightest h-50 w-50 l-h-50 rounded-circle text-center overflow-hidden">
                            <img src="{{ url('images/usernew.jpg') }}" class="h-50 align-self-end" alt="">
                    </a><br><br><small>Admin Akademik</small></center><br><br> --}}
                    <div class="media-list media-list-hover">
                        <div class="media py-10 px-0 align-items-center">

                            <div class="media-body">
                                <p>
                                    <span class="font-size-11 text-white">{{ Session::get('nama') }}</span><br>
                                    <span class="font-size-9 text-white">({{ Session::get('username') }})</span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <li class="header">Daftar Menu</li>
                    <li class="{{ Route::is('home') ? 'active' : '' }}">
                        <a href="{{ route('home') }}" title="Beranda">
                            <i class="fa fa-home"><span class="path1"></span>
                                <span class="path2"></span></i>
                            <span>Beranda</span>
                        </a>
                    </li>

                    @if (Session::get('dosen_wali') == 1)
                        <li class="{{ Route::is('dosenacckrs') ? 'active' : '' }}">
                            <a href="{{ route('dosenacckrs') }}" title="Acc KRS">
                                <i class="fa fa-check-square-o"><span class="path1"></span><span
                                        class="path2"></span></i>
                                <span>Acc KRS</span>
                            </a>
                        </li>
                        <li class="{{ Route::is('dosendaftarmhs_pa') ? 'active' : '' }}">
                            <a href="{{ route('dosendaftarmhs_pa') }}" title="Mahasiswa Pembimbing Akademik">
                                <i class="fa fa-users"><span class="path1"></span><span class="path2"></span></i>
                                <span>Mahasiswa PA</span>
                            </a>
                        </li>
                    @endif
                    <li class="{{ Route::is('dsnriwayat_mengajar') ? 'active' : '' }}">
                        <a href="{{ route('dsnriwayat_mengajar') }}">
                            <i class="fa fa-book"><span class="path1"></span><span class="path2"></span></i>
                            <span>Riwayat Mengajar</span>
                        </a>
                    </li>
                    <li class="{{ Route::is('makul_diampu_dosen') ? 'active' : '' }}">
                        <a href="{{ route('makul_diampu_dosen') }}" title="Makul Diampu">
                            <i class="fa fa-id-card"><span class="path1"></span><span class="path2"></span></i>
                            <span>Makul Diampu</span>
                        </a>
                    </li>
                    <li class="{{ Route::is('berita_acara_dosen') ? 'active' : '' }}">
                        <a href="{{ route('berita_acara_dosen') }}" title="Berita Acara">
                            <i class="fa fa-window-restore"><span class="path1"></span><span class="path2"></span></i>
                            <span>Berita Acara</span>
                        </a>
                    </li>
                    <li class="{{ Route::is('berita_acara_ujian_dosen') ? 'active' : '' }}">
                        <a href="{{ route('berita_acara_ujian_dosen') }}" title="Berita Acara Ujian">
                            <i class="fa fa-sticky-note-o"><span class="path1"></span><span class="path2"></span></i>
                            <span>Berita Acara Input Nilai</span>
                        </a>
                    </li>
                    <li class="{{ Route::is('dsnpresensi_mhs') ? 'active' : '' }}">
                        <a href="{{ route('dsnpresensi_mhs') }}" title="Presensi Mahasiswa">
                            <i class="fa fa-table"><span class="path1"></span><span class="path2"></span></i>
                            <span>Presensi Mahasiswa</span>
                        </a>
                    </li>
                    <li class="{{ Route::is('input_nilai_khs_dosen') ? 'active' : '' }}">
                        <a href="{{ route('input_nilai_khs_dosen') }}" title="Input Nilai">
                            <i class="fa fa-bookmark"><span class="path1"></span><span class="path2"></span></i>
                            <span>Input Nilai</span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-cogs"><span class="path1"></span><span class="path2"></span></i>
                            <span>Pengaturan</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ Route::is('dsngantipassword') ? 'active' : '' }}">
                                <a href="{{ route('dsngantipassword') }}"><i class="icon-Commit"><span
                                            class="path1"></span><span class="path2"></span></i>Ganti
                                    Password</a>
                            </li>
                        </ul>
                    </li>
                    {{-- <li>
                        <a href="https://docs.google.com/spreadsheets/d/1sQMdT2eKn7ohJko3g_JhI1Evk1sIpn0hW-BcjF0Rnxw/edit?usp=sharing"
                            target="_blank" title="Jadwal Ujian"><i class="fa fa-calendar"><span
                                    class="path1"></span><span class="path2"></span></i>
                            <span>Jadwal Ujian</span></a>
                    </li> --}}
                    <li>
                        <a target="_blank"
                            href="https://docs.google.com/document/d/1sIxlOjIN8EBleDocCEg0XIWGb9PouHhv/edit?usp=sharing_eip_se_dm&rtpof=true&sd=true&ts=62ba883f"
                            title="Link Panduan Modul Dosen">
                            <i class="fa fa-question-circle"><span class="path1"></span><span
                                    class="path2"></span></i>
                            <span>Bantuan</span>
                        </a>
                        {{-- <a href="javascript:void(0)" id="bantuan" title="Download">
                            <i class="fa fa-question-circle"><span class="path1"></span><span
                                    class="path2"></span></i>
                            <span>Bantuan</span>
                        </a> --}}
                    </li>
                </ul>
            </div>
        </div>
    </section>
</aside>
@section('script-advanced')
    <script type="text/javascript">
        $(document).ready(function() {

            var token = "{{ Session::get('token') }}";
            var userlogin = "{{ Session::get('username') }}";

            $('#bantuan').on('click', function() {
                $.ajax({
                    url: "{{ config('setting.second_url') }}akademik/download-bantuan",
                    method: 'GET',
                    headers: {
                        "Authorization": 'Bearer ' + token,
                        "username": userlogin
                    },
                    xhrFields: {
                        responseType: 'blob'
                    },
                    success: function(data) {
                        var a = document.createElement('a');
                        var url = window.URL.createObjectURL(data);
                        a.href = url;
                        a.download = 'Release_Panduan_Module_Dosen_v1.pdf';
                        document.body.append(a);
                        a.click();
                        a.remove();
                        window.URL.revokeObjectURL(url);
                    }
                });
            });
        });
    </script>
@endsection
