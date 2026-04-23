                <!-- sidebar menu-->
                <ul class="sidebar-menu" data-widget="tree"><br><br>
                    {{-- <center><a href="#"
                            class="mr-15 bg-lightest h-50 w-50 l-h-50 rounded-circle text-center overflow-hidden">
                            <img src="{{ url('images/usernew.jpg') }}" class="h-50 align-self-end" alt="">
                    </a><br><br><small>Admin Akademik</small></center><br><br> --}}
                    <div class="media-list">
                        <div class="media py-10 px-0 align-items-center">
                            <p class="avatar avatar-lg status-success">
                                {{-- <img src="{{ url('images/usernew.jpg') }}" alt="..."> --}}
                            </p>
                            <div class="media-body">
                                <p class="font-size-14"style="color: #fff;">
                                    {{ Session::get('nama') }}
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
                    <li class="{{ Route::is('dekregistrasi') ? 'active' : '' }}">
                        <a href="{{ route('dekregistrasi') }}" title="Dosen Wali">
                            <i class="fa fa-list-ul" aria-hidden="true"><span class="path1"></span><span
                                    class="path2"></span></i>
                            <span>Daftar Camaba</span>
                        </a>
                    </li>
                    <li class="{{ Route::is('dkndaftar_mhs') ? 'active' : '' }}">
                        <a href="{{ route('dkndaftar_mhs') }}" title="Dosen Wali">
                            <i class="fa fa-list-ul" aria-hidden="true"><span class="path1"></span><span
                                    class="path2"></span></i>
                            <span>Daftar Mahasiswa</span>
                        </a>
                    </li>
                    <li class="{{ Route::is('dkndosenwali') ? 'active' : '' }}">
                        <a href="{{ route('dkndosenwali') }}" title="Dosen Wali">
                            <i class="fa fa-users"><span class="path1"></span><span class="path2"></span></i>
                            <span>Dosen Wali</span>
                        </a>
                    </li>
                    {{-- <li class="{{ Route::is('dknacckrs') ? 'active' : '' }}">
                        <a href="{{ route('dknacckrs') }}"><i class="fa fa-check-square-o"><span
                                    class="path1"></span><span class="path2"></span></i>Acc KRS</a>
                    </li> --}}
                    <li class="{{ Route::is('dknmakulpenawaran') ? 'active' : '' }}">
                        <a href="{{ route('dknmakulpenawaran') }}"
                            title="Penawaran
                        Matakuliah"><i class="fa fa-book"><span
                                    class="path1"></span><span class="path2"></span></i>
                            <span>Penawaran Matakuliah</span>
                        </a>
                    </li>
                    <li class="{{ Route::is('dkninput_nilai_khs') ? 'active' : '' }}">
                        <a href="{{ route('dkninput_nilai_khs') }}"
                            title="Penawaran
                        Matakuliah"><i class="fa fa-book"><span
                                    class="path1"></span><span class="path2"></span></i>
                            <span>Input Nilai KHS</span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-file"><span class="path1"></span><span class="path2"></span></i>
                            <span>Print Out</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ Route::is('dkntranskrip_nilai') ? 'active' : '' }}">
                                <a href="{{ route('dkntranskrip_nilai') }}"><i class="icon-Commit"><span
                                            class="path1"></span><span class="path2"></span></i>Transkrip Nilai</a>
                            </li>
                            <li class="{{ Route::is('dkndaftarhadirkuliah') ? 'active' : '' }}">
                                <a href="{{ route('dkndaftarhadirkuliah') }}"><i class="icon-Commit"><span
                                            class="path1"></span><span class="path2"></span></i>Daftar
                                    Hadir Kuliah</a>
                            </li>
                            <li class="{{ Route::is('dkndaftarhadirujian') ? 'active' : '' }}">
                                <a href="{{ route('dkndaftarhadirujian') }}"><i class="icon-Commit"><span
                                            class="path1"></span><span class="path2"></span></i>Daftar
                                    Hadir Ujian</a>
                            </li>
                            <li class="{{ Route::is('dkntranskripakademik') ? 'active' : '' }}">
                                <a href="{{ route('dkntranskripakademik') }}"><i class="icon-Commit"><span
                                            class="path1"></span><span class="path2"></span></i>Transkrip Akademik</a>
                            </li>
                        </ul>
                    </li>
                    <li class="{{ Route::is('dknskripsi_index_sk') ? 'active' : '' }}">
                        <a href="{{ route('dknskripsi_index_sk') }}"><i class="fa fa-file-text-o"><span
                                    class="path1"></span><span class="path2"></span></i>
                            <span>Validasi SK Pembimbing</span>
                        </a>
                    </li>
                    <li class="{{ Route::is('dknlap_ipkmahasiswa') ? 'active' : '' }}">
                        <a href="{{ route('dknlap_ipkmahasiswa') }}"><i class="fa fa-file-text-o"><span
                                    class="path1"></span><span class="path2"></span></i>
                            <span>Laporan IPK</span>
                        </a>
                    </li>
                    {{-- <li>
                        <a href="https://docs.google.com/spreadsheets/d/1sQMdT2eKn7ohJko3g_JhI1Evk1sIpn0hW-BcjF0Rnxw/edit?usp=sharing"
                            target="_blank" title="Jadwal Ujian"><i class="fa fa-calendar"><span
                                    class="path1"></span><span class="path2"></span></i>
                            <span>Jadwal Ujian</span></a>
                    </li> --}}
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-cogs"><span class="path1"></span><span class="path2"></span></i>
                            <span>Pengaturan</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ Route::is('dkngantipassword') ? 'active' : '' }}">
                                <a href="{{ route('dkngantipassword') }}"><i class="icon-Commit"><span
                                            class="path1"></span><span class="path2"></span></i>Ganti
                                    Password</a>
                            </li>
                        </ul>
                    </li>
                </ul>
