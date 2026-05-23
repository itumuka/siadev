                @php
                    $nama = Session::get('nama') ?? 'PMB Admin';
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
                        <span class="sidebar-user-email" title="{{ Session::get('username') }}">{{ strtolower(Session::get('username') ?? 'pmb@umuka.ac.id') }}</span>
                        <span class="sidebar-user-role">PMB</span>
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
