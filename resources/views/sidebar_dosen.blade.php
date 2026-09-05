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
                        <span class="sidebar-user-email"
                            title="{{ Session::get('username') }}">{{ strtolower(Session::get('username')) }}</span>
                        <span class="sidebar-user-role">
                            @if (Session::get('is_dekan') == 1)
                                <span class="badge badge-danger">Dekan</span>
                            @elseif (Session::get('is_kaprodi') == 1 || Session::get('kaprodi') != null)
                                <span class="badge badge-success">Kaprodi</span>
                            @else
                                <span class="badge badge-info">Dosen</span>
                            @endif
                        </span>
                    </div>
                </div>

                <style>
                    .sidebar-collapse .sidebar-prodi-panel {
                        display: none !important;
                    }
                </style>

                @php
                    $kaprodiList = Session::get('kaprodi_list');
                    $idDosen = Session::get('id_dosen') ?: Session::get('id_pegawai');

                    // Jika id_dosen belum ada di session, coba deteksi dari username dosen
                    if (!$idDosen && Session::get('username')) {
                        try {
                            $userDosen = \Illuminate\Support\Facades\DB::table('user_dosen')
                                ->where('email_login', Session::get('username'))
                                ->first();
                            if ($userDosen) {
                                $idDosen = $userDosen->id_pegawai;
                                \Illuminate\Support\Facades\Session::put('id_dosen', $idDosen);
                            }
                        } catch (\Exception $e) {}
                    }

                    // Auto-sync kaprodi_list langsung dari akd_pegawai_role jika session kosong atau hanya berisi 1 prodi
                    // agar dosen yang baru ditugaskan multi-prodi langsung mendapatkan dropdown tanpa perlu logout-login ulang
                    if ($idDosen && (!is_array($kaprodiList) || count($kaprodiList) <= 1)) {
                        try {
                            $dbRoles = \Illuminate\Support\Facades\DB::table('akd_pegawai_role')
                                ->where('id_pegawai', $idDosen)
                                ->where('role_code', 'kaprodi')
                                ->where('is_active', 1)
                                ->where(function ($q) {
                                    $q->whereNull('tgl_selesai')->orWhere('tgl_selesai', '>=', date('Y-m-d'));
                                })
                                ->get();

                            if ($dbRoles->isNotEmpty()) {
                                $prodiMap = \Illuminate\Support\Facades\DB::table('akd_program_studi')
                                    ->whereIn('kode_program_studi', $dbRoles->pluck('unit_id')->toArray())
                                    ->get()
                                    ->keyBy('kode_program_studi');

                                $syncedList = [];
                                foreach ($dbRoles as $dr) {
                                    $pObj = $prodiMap->get($dr->unit_id);
                                    $syncedList[] = [
                                        'kode_program_studi' => $dr->unit_id,
                                        'nama_program_studi' => $pObj ? $pObj->nama_program_studi : $dr->unit_id,
                                        'role_code'          => 'kaprodi',
                                        'status_jabatan'     => $dr->status_jabatan,
                                        'is_primary'         => (int)$dr->is_primary
                                    ];
                                }
                                if (count($syncedList) > 0) {
                                    $kaprodiList = $syncedList;
                                    \Illuminate\Support\Facades\Session::put('kaprodi_list', $kaprodiList);
                                    \Illuminate\Support\Facades\Session::put('is_kaprodi', 1);
                                }
                            }
                        } catch (\Exception $e) {
                            // Fallback jika database belum dapat diakses
                        }
                    }

                    if (!empty($kaprodiList) && is_array($kaprodiList)) {
                        $curr = collect($kaprodiList)->firstWhere('kode_program_studi', Session::get('kode_program_studi')) ?: $kaprodiList[0];
                        if ($curr && (!Session::has('nama_program_studi') || empty(Session::get('nama_program_studi')))) {
                            \Illuminate\Support\Facades\Session::put('nama_program_studi', is_array($curr) ? $curr['nama_program_studi'] : $curr->nama_program_studi);
                        }
                    }
                @endphp

                @if (is_array($kaprodiList) && count($kaprodiList) > 1)
                    <div class="sidebar-prodi-panel px-15 py-10 mb-10" style="background: rgba(255,255,255,0.06); margin: 0 15px 15px; border-radius: 8px; border: 1px solid rgba(255,255,255,0.12);">
                        <div class="d-flex justify-content-between align-items-center mb-5">
                            <span class="text-uppercase font-size-11" style="color: #ffc107; letter-spacing: 0.5px; font-weight: 600;">
                                <i class="fa fa-exchange mr-5"></i> Unit / Prodi Aktif
                            </span>
                            <span class="badge badge-warning font-size-10">{{ count($kaprodiList) }} Prodi</span>
                        </div>
                        <select class="form-control form-control-sm text-dark font-weight-bold" id="select_switch_prodi_sidebar" onchange="doSwitchProdi(this.value)" style="border-radius: 6px; font-size: 12px; cursor: pointer; height: 32px; background-color: #ffffff;">
                            @foreach ($kaprodiList as $kp)
                                @php
                                    $kpKode = is_array($kp) ? $kp['kode_program_studi'] : $kp->kode_program_studi;
                                    $kpNama = is_array($kp) ? $kp['nama_program_studi'] : $kp->nama_program_studi;
                                    $kpStatus = is_array($kp) ? ($kp['status_jabatan'] ?? 'definitif') : ($kp->status_jabatan ?? 'definitif');
                                @endphp
                                <option value="{{ $kpKode }}" {{ Session::get('kode_program_studi') == $kpKode ? 'selected' : '' }}>
                                    {{ $kpKode }} - {{ $kpNama }} {{ $kpStatus != 'definitif' ? '('.strtoupper($kpStatus).')' : '' }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @elseif (Session::has('nama_program_studi') && Session::get('nama_program_studi') != '')
                    <div class="sidebar-prodi-panel px-15 py-5 mb-10" style="margin: 0 15px;">
                        <span class="badge badge-primary-light font-size-11" style="width: 100%; text-align: left; padding: 6px 10px; border-radius: 6px; white-space: normal; display: block;">
                            <i class="fa fa-graduation-cap mr-5"></i> {{ Session::get('kode_program_studi') }} - {{ Session::get('nama_program_studi') }}
                        </span>
                    </div>
                @endif

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
                    @if (Session::get('is_kaprodi') == 1 || Session::get('kaprodi') != NULL || Session::get('kaprodi') != '')
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
                                                class="path1"></span><span class="path2"></span></i>Jurnal Perkuliahan
                                        Prodi</a>
                                </li>
                                <li class="{{ Route::is('kplihat_penilaian') ? 'active' : '' }}">
                                    <a href="{{ route('kplihat_penilaian') }}"><i class="fa fa-list-alt"><span
                                                class="path1"></span><span class="path2"></span></i>Penilaian Semester</a>
                                </li>
                                <li class="{{ Route::is('kpkurikulum') ? 'active' : '' }}">
                                    <a href="{{ route('kpkurikulum') }}"><i class="fa fa-book"><span
                                                class="path1"></span><span class="path2"></span></i>Kurikulum Prodi</a>
                                </li>
                                <li class="{{ Route::is('kpdaftar_mhs') ? 'active' : '' }}">
                                    <a href="{{ route('kpdaftar_mhs') }}"><i class="fa fa-users"><span
                                                class="path1"></span><span class="path2"></span></i>Daftar Mahasiswa</a>
                                </li>
                                <li class="{{ Route::is('kptranskrip_nilai') ? 'active' : '' }}">
                                    <a href="{{ route('kptranskrip_nilai') }}"><i class="fa fa-file-text-o"><span
                                                class="path1"></span><span class="path2"></span></i>Transkrip Nilai</a>
                                </li>
                                <li class="{{ Route::is('kpskripsi_index') ? 'active' : '' }}">
                                    <a href="{{ route('kpskripsi_index') }}"><i class="fa fa-graduation-cap"><span
                                                class="path1"></span><span class="path2"></span></i>Manajemen Skripsi <sup
                                            class="text-danger">(Beta)</sup></a>
                                </li>
                                <li class="treeview {{ Route::is('kpskripsi_aspek') || Route::is('kpskripsi_rubrik') ? 'active menu-open' : '' }}">
                                    <a href="#">
                                        <i class="fa fa-sliders"><span class="path1"></span><span class="path2"></span></i>
                                        <span>Konfigurasi</span>
                                        <span class="pull-right-container">
                                            <i class="fa fa-angle-right pull-right"></i>
                                        </span>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li class="{{ Route::is('kpskripsi_aspek') ? 'active' : '' }}">
                                            <a href="{{ route('kpskripsi_aspek') }}"><i class="fa fa-book"><span
                                                        class="path1"></span><span class="path2"></span></i>Aspek Penilaian <sup
                                                     class="text-danger">(Beta)</sup></a>
                                        </li>
                                        <li class="{{ Route::is('kpskripsi_rubrik') ? 'active' : '' }}">
                                            <a href="{{ route('kpskripsi_rubrik') }}"><i class="fa fa-list-ul"><span
                                                        class="path1"></span><span class="path2"></span></i>Indikator Penilaian <sup
                                                     class="text-danger">(Beta)</sup></a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="{{ Route::is('kpskripsi_penetapan') ? 'active' : '' }}">
                                    <a href="{{ route('kpskripsi_penetapan') }}"><i class="fa fa-gavel"><span
                                                class="path1"></span><span class="path2"></span></i>Penetapan Nilai
                                        <sup class="text-danger">(Beta)</sup></a>
                                </li>
                                <li class="{{ Route::is('kpskripsi_bimbingan') ? 'active' : '' }}">
                                    <a href="{{ route('kpskripsi_bimbingan') }}"><i class="fa fa-check-square-o"><span
                                                class="path1"></span><span class="path2"></span></i>Approval Bimbingan
                                        <sup class="text-danger">(Beta)</sup></a>
                                </li>
                            </ul>
                        </li>
                    @endif

                    @if (Session::get('dosen_wali') == 1)
                        <li class="{{ Route::is('dosenacckrs') ? 'active' : '' }}">
                            <a href="{{ route('dosenacckrs') }}" title="Acc KRS">
                                <i class="fa fa-check-square-o"><span class="path1"></span><span class="path2"></span></i>
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
                    <li
                        class="treeview {{ Route::is('makul_diampu_dosen') || Route::is('dosen.makul_ditawarkan') || Route::is('dosen.kurikulum') ? 'active' : '' }}">
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

                    <li
                        class="treeview {{ Route::is('dosen.skripsi.index') || Route::is('dosen.skripsi.detail_bimbingan') || Route::is('dosen.skripsi.ujian') || Route::is('dosen.skripsi.penetapan') ? 'active' : '' }}">
                        <a href="#">
                            <i class="fa fa-graduation-cap"><span class="path1"></span><span class="path2"></span></i>
                            <span>Skripsi <sup class="text-danger">(Beta)</sup></span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li
                                class="{{ Route::is('dosen.skripsi.index') || Route::is('dosen.skripsi.detail_bimbingan') ? 'active' : '' }}">
                                <a href="{{ route('dosen.skripsi.index') }}" title="Pembimbing Skripsi">
                                    <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>
                                    <span>List Bimbingan</span>
                                </a>
                            </li>
                            <li class="{{ Route::is('dosen.skripsi.ujian') ? 'active' : '' }}">
                                <a href="{{ route('dosen.skripsi.ujian') }}" title="Ujian / Verifikasi Skripsi">
                                    <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>
                                    <span>Penilaian Ujian</span>
                                </a>
                            </li>
                            <li class="{{ Route::is('dosen.skripsi.penetapan') ? 'active' : '' }}">
                                <a href="{{ route('dosen.skripsi.penetapan') }}" title="Persetujuan Berita Acara (TTD)">
                                    <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>
                                    <span>Penetapan BA</span>
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
                                <i class="fa fa-question-circle"><span class="path1"></span><span class="path2"></span></i>
                                <span>Bantuan</span>
                            </a>
                        </li>
                    @else
                        <li>
                            <a target="_blank" href="#" title="Link Panduan Modul Dosen">
                                <i class="fa fa-question-circle"><span class="path1"></span><span class="path2"></span></i>
                                <span>Bantuan</span>
                            </a>
                            {{-- <a href="javascript:void(0)" id="bantuan" title="Download">
                                <i class="fa fa-question-circle"><span class="path1"></span><span class="path2"></span></i>
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
        $(document).ready(function () {

            var token = "{{ Session::get('token') }}";
            var userlogin = "{{ Session::get('username') }}";

            $('#bantuan').on('click', function () {
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
                    success: function (data) {
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

        function doSwitchProdi(kodeProdi) {
            if (!kodeProdi) return;
            
            if (typeof showToastr === 'function') {
                showToastr('info', 'Memproses', 'Beralih program studi aktif...');
            }

            $.ajax({
                url: "{{ route('switch_prodi') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    kode_prodi: kodeProdi
                },
                success: function(res) {
                    if (res.status) {
                        if (typeof showToastr === 'function') {
                            showToastr('success', 'Berhasil', res.message);
                        }
                        setTimeout(function() {
                            window.location.reload();
                        }, 500);
                    } else {
                        if (typeof showToastr === 'function') {
                            showToastr('error', 'Gagal', res.message);
                        } else {
                            alert(res.message);
                        }
                    }
                },
                error: function(xhr) {
                    var msg = xhr.responseJSON ? xhr.responseJSON.message : 'Terjadi kesalahan saat beralih program studi!';
                    if (typeof showToastr === 'function') {
                        showToastr('error', 'Error', msg);
                    } else {
                        alert(msg);
                    }
                }
            });
        }
    </script>
@endsection