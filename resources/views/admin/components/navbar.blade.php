<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
<a class="navbar-brand sidebar-gone-hide" href="{{ url('') }}">
    <img src="{{ asset('img/bakawan-logo.png') }}" width="30" height="30" class="d-inline-block align-top" alt="">
</a>
<a href="{{ url('') }}" class="navbar-brand sidebar-gone-hide">BAKAWAN-RTLH</a>
<a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar"><i class="fas fa-bars"></i></a>
<div class="nav-collapse">
    <a class="sidebar-gone-show nav-collapse-toggle nav-link" href="#">
    <i class="fas fa-ellipsis-v"></i>
    </a>
    <ul class="navbar-nav">
        <li class="nav-item active"><a href="{{ url('') }}" class="nav-link">Home</a></li>
        <li class="nav-item"><a href="{{ url('sarat-dan-kententuan') }}" class="nav-link">Syarat & Ketentuan</a></li>
        <li class="nav-item"><a href="{{ url('gallery') }}" class="nav-link">Gallery</a></li>
        <li class="nav-item"><a href="{{ url('video') }}" class="nav-link">Video</a></li>
        <li class="nav-item dropdown"><a href="#" id="navbarDropdown" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pengumuman</a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            @foreach ($posts as $post)
            <a class="dropdown-item" href="{{ url('post') }}/{{ $post->id }}">{{ $post->title }}</a>
            @endforeach
            </div>
        </li>
    </ul>
</div>
<form class="form-inline ml-auto">
    <!-- <ul class="navbar-nav">
    <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
    </ul> -->
    <!-- <div class="search-element">
    <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="250">
    <button class="btn" type="submit"><i class="fas fa-search"></i></button>
    <div class="search-backdrop"></div>
    </div> -->
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
        <a href="#">View All <i class="fas fa-chevron-right"></i></a>
        </div>
    </div>
    </li>
    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
    <img alt="image" src="{{ asset((Auth::User()->foto != null) ? Auth::User()->foto : 'img/avatar/avatar-1.png') }}" class="rounded-circle mr-1">
    <div class="d-sm-none d-lg-inline-block">Hi, {{ Auth::User()->name }}</div></a>
    <div class="dropdown-menu dropdown-menu-right">
        <!-- <div class="dropdown-title">Logged in 5 min ago</div> -->
        <a href="{{ route('admin.profile') }}" class="dropdown-item has-icon">
        <i class="far fa-user"></i> Profile
        </a>
        <div class="dropdown-divider"></div>
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