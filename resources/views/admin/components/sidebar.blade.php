<div class="main-sidebar bg-gradasi">
    <aside id="sidebar-wrapper" class="bg-gradasi">
        <!-- <div class="sidebar-brand sidebar-gone-show"><a href="{{ url('') }}">BAKAWAN-RTLH</a></div> -->
        <div class="sidebar-brand">
            <a href="{{ url('/') }}">
               BAKAWAN-RTLH
            </a>
            </div>
            <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ url('/') }}">
                <img src="{{ asset('img/bakawan-logo.png') }}" class="d-inline-block" alt="" style="height: 35px;">
            </a>
        </div>
        <div class="user-panel mt-3 pb-3 mb-0 border-bottom" style="flex-direction: column;box-sizing: border-box;display: flex;place-content: center;align-items: center;">
            <div class="image">
                <img width="64" src="{{ asset((Auth::User()->foto != null) ? Storage::url('avatars/'.Auth::User()->foto) : 'img/avatar/avatar-1.png') }}" class="rounded-circle img-circle elevation-2 mb-2" alt="User Image">
            </div>
            <div class="text-white">
                <h6 class="d-block">{{ Auth::User()->name }}</h6>
            </div>
        </div>
        <ul class="sidebar-menu">
            <!-- <li class="menu-header">Dasbor</li> -->
            <li class="nav-item {{ (request()->routeIs('admin.dashboard')) ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard') }}" class="nav-link active"><i class="fas fa-home"></i><span>Dasbor</span></a>
            </li>
            <li class="nav-item {{ (request()->routeIs('admin.gis-rtlh')) ? 'active' : '' }}">
            <a href="{{ route('gis') }}" target="_blank" class="nav-link"><i class="fas fa-globe-asia"></i><span>WebGIS</span></a>
            </li>
            <li class="nav-item {{ (request()->routeIs('admin.rtlh')) ? 'active' : '' }}">
            <a href="{{ route('admin.rtlh') }}"class="nav-link"><i class="fas fa-city"></i> <span>Data RTLH</span></a>
            </li>
            <!-- <li class="menu-header">Data</li> -->
            <!-- <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-store"></i> <span>Perumahan</span></a>
            <ul class="dropdown-menu">
                <li class=""><a class="nav-link" href="">Data SPM</a></li>
                <li class=""><a class="nav-link" href="">Data PSU</a></li>
                <li class=""><a class="nav-link" href="">E-Profil Kelurahan</a></li>
            </ul>
            </li>
            <li class="nav-item dropdown {{ (request()->is('admin/pemukiman*')) ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-city"></i> <span>Pemukiman</span></a>
            <ul class="dropdown-menu">
                <li class="{{ (request()->routeIs('admin.rtlh')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.rtlh') }}">Data RTLH</a></li>
                <li class="{{ (request()->routeIs('admin.kawasan-kumuh.index')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.kawasan-kumuh.index') }}">Data Kawasan Kumuh</a></li>
                <li class=""><a class="nav-link" href="{{ route('admin.bantaran-sungai.index') }}">Data Bantaran Sungai</a></li>
            </ul>
            </li>
            <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-campground"></i> <span>Pertanahan</span></a>
            <ul class="dropdown-menu">
                <li class=""><a class="nav-link" href="">Data Pertanahan</a></li>
            </ul>
            </li> -->
            <li class="menu-header">System</li>
            <li class="nav-item dropdown {{ (request()->is('admin/setup*')) ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-database"></i> <span>Setup</span></a>
            <ul class="dropdown-menu">
                <li class="{{ (request()->routeIs('admin.setup-rtlh')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.setup-rtlh') }}">Setup RTLH</a></li>
                <li class="{{ (request()->routeIs('admin.setup-verif')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.setup-verif') }}">Setup Verifikasi RTLH</a></li>
                <li class="{{ (request()->routeIs('admin.setup-wilayah')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.setup-wilayah') }}">Setup Wilayah</a></li>
            </ul>
            </li>
            <li class="nav-item dropdown {{ (request()->is('admin/managemen*')) ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-user-edit"></i> <span>Managemen User</span></a>
            <ul class="dropdown-menu">
                <li class="{{ (request()->routeIs('users.index')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('users.index') }}">Users</a></li>
            </ul>
            </li>
            <li class="nav-item dropdown {{ (request()->is('admin/lainnya*')) ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-share"></i> <span>Lainnya</span></a>
            <ul class="dropdown-menu">
                <li class="{{ (request()->routeIs('posts.index')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('posts.index') }}">Pengumuman</a></li>
                <li class="{{ (request()->routeIs('gallery.index')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('gallery.index') }}">Galeri</a></li>
                <li class="{{ (request()->routeIs('video.index')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('video.index') }}">Video</a></li>
                <li class="{{ (request()->routeIs('admin.syarat-ketentuan')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.syarat-ketentuan') }}">Sarat & Ketentuan</a></li>
            </ul>
            </li>
        </ul>

        <!-- <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
            <i class="fas fa-rocket"></i> Documentation
            </a>
        </div> -->
    </aside>
</div>
