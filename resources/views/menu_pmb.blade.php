                <!-- sidebar menu-->
                <ul class="sidebar-menu" data-widget="tree"><br><br>
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
                    <li class="{{ Route::is('aktambahcalonmhs') ? 'active' : '' }}"><a
                            href="{{ route('aktambahcalonmhs') }}"><i class="icon-Commit"><span
                                    class="path1"></span><span class="path2"></span></i>Tambah
                            Calon
                            Mahasiswa</a></li>
                    <li class="{{ Route::is('daftarmaba') ? 'active' : '' }}">
                        <a href="{{ route('daftarmaba') }}"><i class="icon-Commit"><span class="path1"></span><span
                                    class="path2"></span></i>Daftar
                            Calon Mahasiswa</a>
                    </li>
                    <li class="{{ Route::is('akregistrasipmb') ? 'active' : '' }}">
                        <a href="{{ route('akregistrasipmb') }}"><i class="icon-Commit"><span
                                    class="path1"></span><span class="path2"></span></i>
                            Registrasi Mahasiswa</a>
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
                            <li class="{{ request()->is('akademik/gantipassword') ? 'active' : '' }}">
                                <a href="{{ url('akademik/gantipassword') }}"><i class="icon-Commit"><span
                                            class="path1"></span><span class="path2"></span></i>Ganti Password</a>
                            </li>
                        </ul>
                    </li>
                </ul>
