<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar position-relative">
        <div class="multinav">
            <div class="multinav-scroll" style="height: 100%;">
                @if (Session::get('jabatan') == 'Super Admin')
                    @include('menu_superadmin')
                @elseif(Session::get('jabatan') == 'Akademik')
                    @include('menu_superadmin')
                @elseif (Session::get('jabatan') == 'Dekanat')
                    @include('menu_dekanat')
                @elseif (Session::get('jabatan') == 'Penerimaan Mahasiswa Baru')
                    @include('menu_pmb')
                @endif
            </div>
        </div>
    </section>
    <div class="sidebar-footer">

        <a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Keluar"><span
                class="icon-Lock-overturning"><span class="path1"></span><span class="path2"></span></span></a>
    </div>
</aside>
