<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar position-relative">
        <div class="multinav">
            <div class="multinav-scroll" style="height: 100%;">
                <!-- sidebar menu-->
                <ul class="sidebar-menu" data-widget="tree">
                    {{-- <center><a href="#"
                            class="mr-15 bg-lightest h-50 w-50 l-h-50 rounded-circle text-center overflow-hidden">
                            <img src="{{ url('images/student.png') }}" class="h-50 align-self-end" alt="">
                        </a><br><br><small>Mahasiswa</small></center><br><br> --}}


                    <li class="header"><h6>{{ Session::get('nama') }}<br>
                    <span>({{ Session::get('username') }})</span></h6>
                    </li>
                    <li class="header">Daftar Menu</li>
                    <li class="{{ Route::is('home') ? 'active' : '' }}">
                        <a href="{{ route('home') }}"><i class="fa fa-home"><span class="path1"></span><span
                                    class="path2"></span></i>
                            <span>Beranda</span></a>
                    </li>
                    <li class="{{ Route::is('presensikuliah') ? 'active' : '' }}">
                        <a href="{{ route('presensikuliah') }}"><i class="fa fa-calendar-check-o"><span
                                    class="path1"></span><span class="path2"></span></i>
                            <span>Presensi Kuliah</span></a>
                    </li>

                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-pencil-square-o"><span class="path1"></span><span
                                    class="path2"></span></i><span>KRS</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ Route::is('mhskrs') ? 'active' : '' }}">
                                <a href="{{ route('mhskrs') }}"><i class="icon-Commit"><span class="path1"></span><span
                                            class="path2"></span></i>Ambil KRS </a>
                            </li>
                            <li class="{{ Route::is('mhsrevisikrs') ? 'active' : '' }}">
                                <a href="{{ route('mhsrevisikrs') }}"><i class="icon-Commit"><span
                                            class="path1"></span><span class="path2"></span></i>Revisi KRS</a>
                            </li>
                        </ul>
                    </li>
                    <li class="{{ Route::is('mhskhs') ? 'active' : '' }}">
                        <a href="{{ route('mhskhs') }}"><i class="fa fa-id-card-o"><span class="path1"></span><span
                                    class="path2"></span></i>
                            <span>KHS</span></a>
                    </li>
                    <li class="{{ Route::is('mhskartuujian') ? 'active' : '' }}">
                        <a href="{{ route('mhskartuujian') }}"><i class="fa fa-address-card-o"><span
                                    class="path1"></span><span class="path2"></span></i>
                            <span>Kartu Ujian </span></a>
                    </li>
                    <li class="{{ Route::is('mhstranskripnilai') ? 'active' : '' }}">
                        <a href="{{ route('mhstranskripnilai') }}"><i class="fa fa-file-text-o"><span
                                    class="path1"></span><span class="path2"></span></i>
                            <span>Transkrip</span>
                        </a>
                    </li>
                    <li class="{{ Route::is('statuspembayaran') ? 'active' : '' }}">
                        <a href="{{ route('statuspembayaran') }}"><i class="fa fa-money"><span
                                    class="path1"></span><span class="path2"></span></i>
                            <span>Status Pembayaran</span>
                        </a>
                    </li>
                    <li class="{{ Route::is('jadwalkuliah') ? 'active' : '' }}">
                        <a href="{{ route('jadwalkuliah') }}"><i class="fa fa-calendar"><span
                                    class="path1"></span><span class="path2"></span></i>
                            <span>Jadwal Kuliah</span></a>
                    </li>
                    
                    <li class="treeview {{ request()->is('mahasiswa/skripsi*') ? 'active' : '' }}">
                        <a href="#">
                            <i class="fa fa-graduation-cap"><span class="path1"></span><span
                                    class="path2"></span></i><span>Tugas Akhir</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ Route::is('skripsi.dashboard') ? 'active' : '' }}">
                                <a href="{{ route('skripsi.dashboard') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Dashboard</a>
                            </li>
                            <li class="{{ Route::is('skripsi.seminar') ? 'active' : '' }}">
                                <a href="{{ route('skripsi.seminar') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Seminar Proposal</a>
                            </li>
                            <li class="{{ Route::is('skripsi.bimbingan') ? 'active' : '' }}">
                                <a href="{{ route('skripsi.bimbingan') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Bimbingan</a>
                            </li>
                            <li class="{{ Route::is('skripsi.ujian') ? 'active' : '' }}">
                                <a href="{{ route('skripsi.ujian') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Ujian Skripsi</a>
                            </li>
                        </ul>
                    </li>
                    {{-- <li>
                        <a href="https://docs.google.com/spreadsheets/d/1sQMdT2eKn7ohJko3g_JhI1Evk1sIpn0hW-BcjF0Rnxw/edit?usp=sharing"
                            target="_blank" title="Jadwal Ujian"><i class="fa fa-calendar"><span
                                    class="path1"></span><span class="path2"></span></i>
                            <span>Jadwal Ujian</span></a>
                    </li> --}}
                    {{-- <li>
                        <a href="https://forms.gle/jtBVHwnLXu8URrJT7" target="_blank" title="Jadwal Ujian"><i
                                class="fa fa-pencil-square-o"><span class="path1"></span><span
                                    class="path2"></span></i>
                            <span>Kuesioner Evaluasi</span></a>
                    </li> --}}
                    <li>
                        <a href="{{ url('file') }}/PANDUAN_MODUL_MAHASISWA.pdf"
                            title="Download Bantuan Modul Mahasiswa" target="_blank">
                            <i class="fa fa-question-circle"><span class="path1"></span><span
                                    class="path2"></span></i>
                            <span>Bantuan</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <div class="sidebar-footer">

        <a href="javascript:void(0)" class="link" data-toggle="tooltip" title=""
            data-original-title="Keluar"><span class="icon-Lock-overturning"><span class="path1"></span><span
                    class="path2"></span></span></a>
    </div>
</aside>
@section('script-advanced')
    <script type="text/javascript">
        $(document).ready(function() {

            var token = "{{ Session::get('token') }}";
            var userlogin = "{{ Session::get('username') }}";

            $('#bantuan_mhs').on('click', function() {
                $.ajax({
                    url: "{{ config('setting.second_url') }}mahasiswa/download-bantuan-mhs",
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
                        a.download = 'Release_Panduan_Module_Mahasiswa_v1.pdf';
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
