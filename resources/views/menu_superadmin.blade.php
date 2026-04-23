                <!-- sidebar menu-->
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header"><h7>{{ Session::get('nama') }}<br>
                    <span class="lowercase">({{ Session::get('username') }})</span></h7>
                    </li>
                    
                    <li class="header">Daftar Menu</li>
                    <li class="{{ Route::is('home') ? 'active' : '' }}">
                        <a href="{{ route('home') }}" title="Beranda">
                            <i class="fa fa-home"><span class="path1"></span>
                                <span class="path2"></span></i>
                            <span>Beranda</span>
                        </a>
                    </li>
                    @if (Session::get('jabatan') != 'Akademik')
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-database"><span class="path1"></span><span class="path2"></span></i>
                                <span>Master</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-right pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li class="{{ request()->is('akademik/tahunajaran') ? 'active' : '' }}">
                                    <a href="{{ url('akademik/tahunajaran') }}"><i class="icon-Commit"><span
                                                class="path1"></span><span class="path2"></span></i>Tahun
                                        Akademik</a>
                                </li>
                                <li class="{{ request()->is('akademik/kegiatanakademik') ? 'active' : '' }}">
                                    <a href="{{ url('akademik/kegiatanakademik') }}"><i class="icon-Commit"><span
                                                class="path1"></span><span class="path2"></span></i>Kegiatan
                                        Akademik</a>
                                </li>
                                <li class="{{ request()->is('akademik/kalenderakademik') ? 'active' : '' }}">
                                    <a href="{{ url('akademik/kalenderakademik') }}"><i class="icon-Commit"><span
                                                class="path1"></span><span class="path2"></span></i>Kalender
                                        Akademik</a>
                                </li>
                                <li class="{{ request()->is('akademik/fakultas') ? 'active' : '' }}">
                                    <a href="{{ url('akademik/fakultas') }}"><i class="icon-Commit"><span
                                                class="path1"></span><span class="path2"></span></i>Fakultas</a>
                                </li>
                                <li class="{{ request()->is('akademik/programstudi') ? 'active' : '' }}">
                                    <a href="{{ url('akademik/programstudi') }}"><i class="icon-Commit"><span
                                                class="path1"></span><span class="path2"></span></i>Program Studi</a>
                                </li>
                                <li class="{{ request()->is('akademik/kurikulum') ? 'active' : '' }}">
                                    <a href="{{ url('akademik/kurikulum') }}"><i class="icon-Commit"><span
                                                class="path1"></span><span class="path2"></span></i>Kurikulum</a>
                                </li>
                                <li class="{{ request()->is('akademik/matakuliah') ? 'active' : '' }}">
                                    <a href="{{ url('akademik/matakuliah') }}"><i class="icon-Commit"><span
                                                class="path1"></span><span class="path2"></span></i>Matakuliah</a>
                                </li>
                                <li class="{{ request()->is('akademik/dosen') ? 'active' : '' }}">
                                    <a href="{{ url('akademik/dosen') }}"><i class="icon-Commit"><span
                                                class="path1"></span><span class="path2"></span></i>Dosen</a>
                                </li>
                                <li class="{{ Route::is('dkndosenwali') ? 'active' : '' }}">
                                    <a href="{{ route('dkndosenwali') }}"><i class="icon-Commit"><span
                                                class="path1"></span><span class="path2"></span></i>Dosen
                                        Wali</a>
                                </li>
                                <li class="{{ Route::is('akqrcode') ? 'active' : '' }}">
                                    <a href="{{ route('akqrcode') }}"><i class="icon-Commit"><span
                                                class="path1"></span><span class="path2"></span></i>QR Code</a>
                                </li>

                            </ul>
                        </li>
                    @endif
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-book"><span class="path1"></span><span class="path2"></span></i>
                            <span>Data Matakuliah</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ Route::is('akmakulprasyarat') ? 'active' : '' }}">
                                <a href="{{ route('akmakulprasyarat') }}"><i class="icon-Commit"><span
                                            class="path1"></span><span class="path2"></span></i>Matakuliah
                                    Prasyarat</a>
                            </li>
                            <li class="{{ Route::is('akmakulpenawaran') ? 'active' : '' }}"><a
                                    href="{{ route('akmakulpenawaran') }}"><i class="icon-Commit"><span
                                            class="path1"></span><span class="path2"></span></i>Penawaran
                                    Matakuliah</a>
                            </li>
                            <li class="{{ Route::is('akjadwalujian') ? 'active' : '' }}"><a
                                    href="{{ route('akjadwalujian') }}"><i class="icon-Commit"><span
                                            class="path1"></span><span class="path2"></span></i>Jadwal
                                    Ujian</a>
                            </li>
                            <!-- <li class="{{ Route::is('akinputnilaikhs') ? 'active' : '' }}"><a
                                    href="{{ route('akinputnilaikhs') }}"><i class="icon-Commit"><span
                                            class="path1"></span><span class="path2"></span></i>Input
                                    Nilai KHS</a></li> -->
                            <li class="{{ Route::is('input_nilai_khs_akademik') ? 'active' : '' }}"><a
                                    href="{{ route('input_nilai_khs_akademik') }}"><i class="icon-Commit"><span
                                            class="path1"></span><span class="path2"></span></i>Input
                                    Nilai KHS</a></li>
                        </ul>
                    </li>

                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-users"><span class="path1"></span><span class="path2"></span></i>
                            <span>Data Camaba</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            {{-- <li class="{{ Route::is('akimportdatapmb') ? 'active' : '' }}">
                                <a href="{{ route('akimportdatapmb') }}"><i class="icon-Commit"><span
                                            class="path1"></span><span class="path2"></span></i>Import
                                    Dari PMB</a>
                            </li> --}}
                            <li class="{{ Route::is('aktambahcalonmhs') ? 'active' : '' }}"><a
                                    href="{{ route('aktambahcalonmhs') }}"><i class="icon-Commit"><span
                                            class="path1"></span><span class="path2"></span></i>Tambah
                                    Calon
                                    Mahasiswa</a></li>
                            <li class="{{ Route::is('daftarmaba') ? 'active' : '' }}">
                                <a href="{{ route('daftarmaba') }}"><i class="icon-Commit"><span
                                            class="path1"></span><span class="path2"></span></i>Daftar
                                    Calon Mahasiswa</a>
                            </li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-address-card"><span class="path1"></span><span
                                    class="path2"></span></i>
                            <span>Data Mahasiswa</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ request()->is('akademik/mahasiswa') ? 'active' : '' }}">
                                <a href="{{ url('akademik/mahasiswa') }}"><i class="icon-Commit"><span
                                            class="path1"></span><span class="path2"></span></i>Daftar
                                    Mahasiswa</a>
                            </li>
                            <li class="{{ request()->is('akademik/passwordmahasiswa') ? 'active' : '' }}">
                                <a href="{{ url('akademik/passwordmahasiswa') }}"><i class="icon-Commit"><span
                                            class="path1"></span><span class="path2"></span></i>Password
                                    Mahasiswa</a>
                            </li>
                            {{-- <li class="{{ request()->is('akademik/nilaimahasiswa') ? 'active' : '' }}">
                                <a href="{{ url('akademik/nilaimahasiswa') }}"><i class="icon-Commit"><span
                                            class="path1"></span><span
                                            class="path2"></span></i>Input Nilai Mahasiswa</a>
                            </li> --}}
                            <li class="{{ request()->is('akademik/mahasiswalulusan') ? 'active' : '' }}"><a
                                    href="{{ url('akademik/mahasiswalulusan') }}"><i class="icon-Commit"><span
                                            class="path1"></span><span class="path2"></span></i>Mahasiswa Lulus</a>
                            </li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-user-secret"><span class="path1"></span><span class="path2"></span></i>
                            <span>Aktivitas</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ Route::is('akdpresensi_mhs') ? 'active' : '' }}">
                                <a href="{{ route('akdpresensi_mhs') }}"><i class="icon-Commit"><span
                                            class="path1"></span><span class="path2"></span></i>Presensi
                                    Mahasiswa</a>
                            </li>
                            <li class="{{ Route::is('akdaftardosen') ? 'active' : '' }}">
                                <a href="{{ route('akdaftardosen') }}"><i class="icon-Commit"><span
                                            class="path1"></span><span class="path2"></span></i>Berita Acara</a>
                            </li>
                            <li class="{{ Route::is('akdaftardosen_ba_ujian') ? 'active' : '' }}">
                                <a href="{{ route('akdaftardosen_ba_ujian') }}"><i class="icon-Commit"><span
                                            class="path1"></span><span class="path2"></span></i>Berita Acara
                                    Ujian</a>
                            </li>
                            <li class="{{ Route::is('rekap_ba_dosen') ? 'active' : '' }}">
                                <a href="{{ route('rekap_ba_dosen') }}"><i class="icon-Commit"><span
                                            class="path1"></span><span class="path2"></span></i>Rekap Berita
                                    Acara</a>
                            </li>
                        </ul>
                    </li>
                    <li class="{{ Route::is('aklihat_penilaian') ? 'active' : '' }}">
                        <a href="{{ url('akademik/lihat-penilaian') }}" title="Progres Penilaian">
                            <i class="fa fa-list-ul"><span class="path1"></span><span class="path2"></span></i>
                            <span>Progres Penilaian</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('akademik/registrasi') ? 'active' : '' }}">
                        <a href="{{ url('akademik/registrasi') }}" title="Registrasi">
                            <i class="fa fa-user"><span class="path1"></span><span class="path2"></span></i>
                            <span>Registrasi</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('akademik/herregistrasi') ? 'active' : '' }}">
                        <a href="{{ url('akademik/herregistrasi') }}" title="Her Registrasi"><i
                                class="fa fa-user-plus"><span class="path1"></span><span
                                    class="path2"></span></i><span> Her
                                Registrasi</span></a>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-file-text-o"><span class="path1"></span><span class="path2"></span></i>
                            <span>Laporan</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ Route::is('lap_ipkmahasiswa') ? 'active' : '' }}">
                                <a href="{{ route('lap_ipkmahasiswa') }}"><i class="icon-Commit"><span
                                            class="path1"></span><span class="path2"></span></i>IPK
                                    Mahasiswa</a>
                            </li>
                            {{-- <li class="{{ Route::is('lap_herregistrasi') ? 'active' : '' }}">
                                <a href="{{ route('lap_herregistrasi') }}"><i class="icon-Commit"><span
                                            class="path1"></span><span class="path2"></span></i>Her
                                    Registrasi
                                    Mahasiswa</a>
                            </li>
                            <li class="{{ Route::is('kewarganegaraan') ? 'active' : '' }}"><a
                                    href="{{ route('kewarganegaraan') }}"><i class="icon-Commit"><span
                                            class="path1"></span><span class="path2"></span></i>Kewarganegaraan</a>
                            </li>
                            <li class="{{ Route::is('dispensasi') ? 'active' : '' }}">
                                <a href="{{ route('dispensasi') }}"><i class="icon-Commit"><span
                                            class="path1"></span><span class="path2"></span></i>Dispensasi</a>
                            </li> --}}

                        </ul>
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

                            <li class="{{ request()->is('akademik/daftarhadirkuliah') ? 'active' : '' }}">
                                <a href="{{ url('akademik/daftarhadirkuliah') }}"><i class="icon-Commit"><span
                                            class="path1"></span><span class="path2"></span></i>Daftar Hadir
                                    Kuliah</a>
                            </li>
                            <li class="{{ request()->is('akademik/daftarhadirujian') ? 'active' : '' }}">
                                <a href="{{ url('akademik/daftarhadirujian') }}"><i class="icon-Commit"><span
                                            class="path1"></span><span class="path2"></span></i>Daftar Hadir
                                    Ujian</a>
                            </li>
                            <li class="{{ request()->is('akademik/kartuujian') ? 'active' : '' }}">
                                <a href="{{ url('akademik/kartuujian') }}"><i class="icon-Commit"><span
                                            class="path1"></span><span class="path2"></span></i>Kartu Ujian</a>
                            </li>
                            <li class="{{ request()->is('akademik/hasilstudi') ? 'active' : '' }}">
                                <a href="{{ url('akademik/hasilstudi') }}"><i class="icon-Commit"><span
                                            class="path1"></span><span class="path2"></span></i>Kartu Hasil
                                    Studi</a>
                            </li>
                            <li class="{{ request()->is('akademik/transkipnilai') ? 'active' : '' }}">
                                <a href="{{ url('akademik/transkipnilai') }}"><i class="icon-Commit"><span
                                            class="path1"></span><span class="path2"></span></i>Transkip Nilai</a>
                            </li>
                            <li class="{{ request()->is('akademik/transkipakademik') ? 'active' : '' }}">
                                <a href="{{ url('akademik/transkipakademik') }}"><i class="icon-Commit"><span
                                            class="path1"></span><span class="path2"></span></i>Transkip
                                    Akademik</a>
                            </li>
                            <li class="{{ request()->is('akademik/krsmahasiswa') ? 'active' : '' }}">
                                <a href="{{ url('akademik/krsmahasiswa') }}"><i class="icon-Commit"><span
                                            class="path1"></span><span class="path2"></span></i>KRS
                                    Mahasiswa</a>
                            </li>
                        </ul>
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
                            <li class="{{ request()->is('akademik/user') ? 'active' : '' }}">
                                <a href="{{ url('akademik/user') }}"><i class="icon-Commit"><span
                                            class="path1"></span><span class="path2"></span></i>User</a>
                            </li>
                            <li class="{{ request()->is('akademik/gantipassword') ? 'active' : '' }}">
                                <a href="{{ url('akademik/gantipassword') }}"><i class="icon-Commit"><span
                                            class="path1"></span><span class="path2"></span></i>Ganti Password</a>
                            </li>
                        </ul>
                    </li>
                </ul>
