<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar position-relative">
        <div class="multinav">
            <div class="multinav-scroll" style="height: 100%;">
                @php
                    $nama = Session::get('nama') ?? 'Dosen';
                    $words = explode(' ', $nama);
                    $initials = '';
                    if (count($words) >= 2) {
                        $initials = strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1));
                    } else {
                        $initials = strtoupper(substr($nama, 0, 2));
                    }
                @endphp
                <div class="sidebar-user-panel">
                    <div class="sidebar-user-avatar">{{ $initials }}</div>
                    <div class="sidebar-user-info">
                        <h4 class="sidebar-user-name" title="{{ Session::get('nama') }}">{{ Session::get('nama') }}</h4>
                        <span class="sidebar-user-email" title="{{ Session::get('username') }}">{{ strtolower(Session::get('username')) }}</span>
                        <span class="sidebar-user-role">
                            @if (Session::get('kaprodi') == 1)
                                Kaprodi
                            @else
                                Dosen
                            @endif
                        </span>
                    </div>
                </div>

                <!-- sidebar menu-->
                <ul class="sidebar-menu" data-widget="tree">

                    <li class="header">Daftar Menu</li>
                    <li class="{{ Route::is('home') ? 'active' : '' }}">
                        <a href="{{ route('home') }}" title="Beranda">
                            <i class="fa fa-home"><span class="path1"></span>
                                <span class="path2"></span></i>
                            <span>Beranda</span>
                        </a>
                    </li>
                    @if (Session::get('kaprodi') != NULL || Session::get('kaprodi') != '' )
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-user-circle-o"><span class="path1"></span><span class="path2"></span></i>
                            <span>Kaprodi</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ Route::is('akdaftardosen') ? 'active' : '' }}">
                                <a href="{{ route('akdaftardosen') }}"><i class="fa fa-file-text"><span
                                            class="path1"></span><span class="path2"></span></i>Jurnal Perkuliahan Prodi</a>
                            </li>
                            <li class="{{ Route::is('kplihat_penilaian') ? 'active' : '' }}">
                                <a href="{{ route('kplihat_penilaian') }}"><i class="fa fa-list-alt"><span
                                            class="path1"></span><span class="path2"></span></i>Penilaian Semester</a>
                            </li>
                            <li class="{{ Route::is('kpskripsi_index') ? 'active' : '' }}">
                                <a href="{{ route('kpskripsi_index') }}"><i class="fa fa-graduation-cap"><span
                                             class="path1"></span><span class="path2"></span></i>Manajemen Skripsi <sup class="text-danger">(Beta)</sup></a>
                            </li>
                            <li class="{{ Route::is('kpskripsi_cpl') ? 'active' : '' }}">
                                <a href="{{ route('kpskripsi_cpl') }}"><i class="fa fa-book"><span
                                             class="path1"></span><span class="path2"></span></i>Master Data CPL</a>
                            </li>
                            <li class="{{ Route::is('kpskripsi_cpmk') ? 'active' : '' }}">
                                <a href="{{ route('kpskripsi_cpmk') }}"><i class="fa fa-sliders"><span
                                             class="path1"></span><span class="path2"></span></i>Konfigurasi Rubrik CPMK</a>
                            </li>
                            <li class="{{ Route::is('kpskripsi_penetapan') ? 'active' : '' }}">
                                <a href="{{ route('kpskripsi_penetapan') }}"><i class="fa fa-gavel"><span
                                             class="path1"></span><span class="path2"></span></i>Penetapan Nilai (BA)</a>
                            </li>
                        </ul>
                    </li>
                    @endif

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
                    <li class="treeview {{ Route::is('makul_diampu_dosen') || Route::is('dosen.makul_ditawarkan') || Route::is('dosen.kurikulum') ? 'active' : '' }}">
                        <a href="#">
                            <i class="fa fa-book"><span class="path1"></span><span class="path2"></span></i>
                            <span>Matakuliah</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ Route::is('makul_diampu_dosen') ? 'active' : '' }}">
                                <a href="{{ route('makul_diampu_dosen') }}" title="Mata Kuliah Diampu">
                                    <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>
                                    <span>Mata Kuliah Diampu</span>
                                </a>
                            </li>
                            <li class="{{ Route::is('dosen.makul_ditawarkan') ? 'active' : '' }}">
                                <a href="{{ route('dosen.makul_ditawarkan') }}" title="Mata Kuliah Ditawarkan">
                                    <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>
                                    <span>Mata Kuliah Ditawarkan</span>
                                </a>
                            </li>
                            <li class="{{ Route::is('dosen.kurikulum') ? 'active' : '' }}">
                                <a href="{{ route('dosen.kurikulum') }}" title="Kurikulum Prodi">
                                    <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>
                                    <span>Kurikulum Prodi</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    
                    <li class="treeview {{ Route::is('dosen.skripsi.index') || Route::is('dosen.skripsi.detail_bimbingan') || Route::is('dosen.skripsi.ujian') || Route::is('dosen.skripsi.penetapan') ? 'active' : '' }}">
                        <a href="#">
                            <i class="fa fa-graduation-cap"><span class="path1"></span><span class="path2"></span></i>
                            <span>Skripsi</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ Route::is('dosen.skripsi.index') || Route::is('dosen.skripsi.detail_bimbingan') ? 'active' : '' }}">
                                <a href="{{ route('dosen.skripsi.index') }}" title="Pembimbing Skripsi">
                                    <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>
                                    <span>Pembimbing Skripsi <sup class="text-danger">(Beta)</sup></span>
                                </a>
                            </li>
                            <li class="{{ Route::is('dosen.skripsi.ujian') ? 'active' : '' }}">
                                <a href="{{ route('dosen.skripsi.ujian') }}" title="Ujian / Verifikasi Skripsi">
                                    <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>
                                    <span>Ujian & Luaran Skripsi</span>
                                </a>
                            </li>
                            <li class="{{ Route::is('dosen.skripsi.penetapan') ? 'active' : '' }}">
                                <a href="{{ route('dosen.skripsi.penetapan') }}" title="Persetujuan Berita Acara (TTD)">
                                    <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>
                                    <span>Penetapan Nilai (BA)</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-list-alt"><span class="path1"></span><span class="path2"></span></i>
                            <span>Perkuliahan</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ Route::is('berita_acara_dosen') ? 'active' : '' }}">
                                <a href="{{ route('berita_acara_dosen') }}"><i class="icon-Commit"><span
                                            class="path1"></span><span class="path2"></span></i>Jurnal Perkuliahan</a>
                            </li>
                            <li class="{{ Route::is('dsnpresensi_mhs') ? 'active' : '' }}">
                                <a href="{{ route('dsnpresensi_mhs') }}"><i class="icon-Commit"><span
                                            class="path1"></span><span class="path2"></span></i>Presensi Mahasiswa</a>
                            </li>
                        </ul>
                    </li>
                    
                    
                    <!--<li class="{{ Route::is('berita_acara_dosen') ? 'active' : '' }}">-->
                    <!--    <a href="{{ route('berita_acara_dosen') }}" title="Berita Acara">-->
                    <!--        <i class="fa fa-window-restore"><span class="path1"></span><span class="path2"></span></i>-->
                    <!--        <span>Berita Acara</span>-->
                    <!--    </a>-->
                    <!--</li>-->
                    <!--<li class="{{ Route::is('dsnpresensi_mhs') ? 'active' : '' }}">-->
                    <!--    <a href="{{ route('dsnpresensi_mhs') }}" title="Presensi Mahasiswa">-->
                    <!--        <i class="fa fa-table"><span class="path1"></span><span class="path2"></span></i>-->
                    <!--        <span>Presensi Mahasiswa</span>-->
                    <!--    </a>-->
                    <!--</li>-->
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-file-archive-o"><span class="path1"></span><span class="path2"></span></i>
                            <span>Berkas Ujian Smt</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ Route::is('berita_acara_ujian_dosen') ? 'active' : '' }}">
                                <a href="{{ route('berita_acara_ujian_dosen') }}"><i class="icon-Commit"><span
                                            class="path1"></span><span class="path2"></span></i>Berita Acara Ujian</a>
                            </li>
                            <li class="{{ Route::is('input_nilai_khs_dosen') ? 'active' : '' }}">
                                <a href="{{ route('input_nilai_khs_dosen') }}"><i class="icon-Commit"><span
                                            class="path1"></span><span class="path2"></span></i>Input Nilai</a>
                            </li>
                        </ul>
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
                    @if (Session::get('dosen_wali') == 1)
                        <li>
                            <a target="_blank" href="{{ url('file') }}/PANDUAN_MODUL_DOSEN_WALI.pdf"
                                title="Link Panduan Modul Dosen">
                                <i class="fa fa-question-circle"><span class="path1"></span><span
                                        class="path2"></span></i>
                                <span>Bantuan</span>
                            </a>
                        </li>
                    @else
                        <li>
                            <a target="_blank" href="#" title="Link Panduan Modul Dosen">
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
                    @endif
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