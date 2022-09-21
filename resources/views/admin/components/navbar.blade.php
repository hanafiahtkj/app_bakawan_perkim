<div class="navbar-bg bg-transparent"></div>
<nav class="navbar fixed-top navbar-expand-lg main-navbar bg-white">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            {{-- <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li> --}}
        </ul>
        {{-- <div class="search-element">
            <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="250">
            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
            <div class="search-backdrop"></div>
        </div> --}}
    </form>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep"><i class="far fa-bell"></i></a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
                <div class="dropdown-header">Notifications
                <!-- <div class="float-right">
                    <a href="#">Mark All As Read</a>
                </div> -->
                </div>
                <div class="dropdown-list-content dropdown-list-icons" id="notification">
                </div>
                <div class="dropdown-footer text-center">
                <!-- <a href="#">View All <i class="fas fa-chevron-right"></i></a> -->
                </div>
            </div>
        </li>
        <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
        <img alt="image" src="{{ asset((Auth::User()->foto != null) ? Storage::url('avatars/'.Auth::User()->foto) : 'img/avatar/avatar-1.png') }}" class="rounded-circle mr-1">
        <div class="d-sm-none d-lg-inline-block">Hi, {{ Auth::User()->name }}</div></a>
        <div class="dropdown-menu dropdown-menu-right">
            <a href="{{ route('admin.profile') }}" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Profil
            </a>
            <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a href="route('logout')" class="dropdown-item has-icon text-danger"
                onclick="event.preventDefault(); this.closest('form').submit();">
                <i class="fas fa-sign-out-alt"></i> {{ __('Log out') }}
            </a>
            </form>
        </div>
        </li>
    </ul>
</nav>
