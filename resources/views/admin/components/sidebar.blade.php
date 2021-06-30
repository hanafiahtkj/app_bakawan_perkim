<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand sidebar-gone-show"><a href="{{ url('') }}">BAKAWAN-RTLH</a></div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="nav-item {{ (request()->routeIs('admin.dashboard')) ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard') }}" class="nav-link active"><i class="fas fa-home"></i><span>Dashboard</span></a>
            </li>
            <li class="nav-item {{ (request()->routeIs('admin.gis-rtlh')) ? 'active' : '' }}">
            <a href="{{ route('admin.gis-rtlh') }}" class="nav-link"><i class="fas fa-globe-asia"></i><span>GIS RTLH</span></a>
            </li>
            <li class="menu-header">System</li>
            <li class="nav-item dropdown {{ (request()->is('admin/setup*')) ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-database"></i> <span>Setup</span></a>
            <ul class="dropdown-menu">
                <!-- @foreach ($setups as $setup)
                    <li><a class="nav-link" href="{{ route('admin.setup-rtlh', $setup->id) }}">{{ $setup->name }}</a></li>
                @endforeach -->
                <li class="{{ (request()->routeIs('admin.setup-rtlh')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.setup-rtlh') }}">Setup RTLH</a></li>
                <li class="{{ (request()->routeIs('admin.setup-verif')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.setup-verif') }}">Setup Verifikasi RTLH</a></li>
                <li class="{{ (request()->routeIs('admin.setup-wilayah')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.setup-wilayah') }}">Setup Wilayah</a></li>
            </ul>
            </li>
            <li class="nav-item dropdown {{ (request()->is('admin/managemen*')) ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-user-edit"></i> <span>Managemen User</span></a>
            <ul class="dropdown-menu">
                <li class="{{ (request()->routeIs('users.index')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('users.index') }}">Users</a></li>
                <!-- <li><a class="nav-link" href="{{ route('roles.index') }}">Roles</a></li> -->
            </ul>
            </li>
            <li class="nav-item dropdown {{ (request()->is('admin/report*')) ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-file-pdf"></i> <span>Report</span></a>
            <ul class="dropdown-menu">
                <li class="{{ (request()->routeIs('admin.rtlh')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.rtlh') }}">RTLH</a></li>
                <!-- <li class="active"><a class="nav-link" href="layout-transparent.html">Transparent Sidebar</a></li>
                <li><a class="nav-link" href="layout-top-navigation.html">Top Navigation</a></li> -->
            </ul>
            </li>
            <li class="nav-item dropdown {{ (request()->is('admin/lainnya*')) ? 'active' : '' }}">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-share"></i> <span>Lainnya</span></a>
            <ul class="dropdown-menu">
                <li class="{{ (request()->routeIs('posts.index')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('posts.index') }}">Pengumuman</a></li>
                <li class="{{ (request()->routeIs('gallery.index')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('gallery.index') }}">Gallery</a></li>
                <li class="{{ (request()->routeIs('video.index')) ? 'active' : '' }}"><a class="nav-link" href="{{ route('video.index') }}">Video</a></li>
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