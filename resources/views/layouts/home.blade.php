<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>@isset($title){{ $title }}@endisset</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-5.7.2/css/all.min.css') }}">
  <!-- <link rel="manifest" href="{{ asset('manifest.json') }}"> -->

  <!-- Extra CSS -->
  @isset($extra_css)
    {{ $extra_css }}
  @endisset

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('css/components.css') }}">

  @laravelPWA

  <style>
    .masthead {
      padding-top: 4.5rem;
    }
    .main-footer {
      border-top: none;
    }
    h1 {
      font-weight: 600;
    }
    .bg-primary {
      background-color: #3f51b5 !important;
    }
    .gallery.gallery-md .gallery-item {
      width: 200px;
      height: 200px;
    }
    .gallery.gallery-md .gallery-more div {
      line-height: 200px;
    }
    body.bg-image {
      background-image: url(img/web.png);
      background-position: left;
    }
    body.bg-image2 {
      background-image: url(img/web2.png);
      background-position: left;
    }
    @media (max-width: 1024px) {
      .navbar {
        left: 0px !important;
        right: 0;
      }
      .main-content {
          padding-left: 15px;
          padding-right: 15px;
          width: 100% !important;
      }
    }
    @media (max-width: 575.98px) {
      #app {
        margin-bottom: 100px;
      }
    }
    @media (min-width: 768px) {
      .welcome1 {
        color: #fff;
        BACKGROUND-COLOR: #ffa429;
        PADDING: 10PX;
        BORDER-RADIUS: 10PX;
      }
      .welcome2 {
        color: #cfd1e3;
        PADDING: 9PX;
        BACKGROUND-COLOR: #212c82;
        BORDER-RADIUS: 10PX;
      }
    }
    .navbar .dropdown-menu {
      width: auto;
    }
    .h1, h1 {
      font-size: 2.2rem;
    }
    .main-sidebar .sidebar-menu li ul.dropdown-menu li a {
      padding-left: 20px;
      overflow: auto;
    }
    .fixed-bottom {
      position: fixed !important;
    }
    .navbar .nav-link.nav-link-user img {
      width: 30px;
      height: 30px;
    }
    .main-navbar .nav-link:hover {
      color: #fff;
      /* font-weight: 700; */
      background-color : #5a6be8;
    }
  </style>
  @if (!request()->routeIs('home'))
  <style>
    .main-content {
      padding-left: 0;
      padding-right: 0;
      padding-top: 110px!important;
    }
  </style>
  @endif
</head>

<body class="layout-3 {{ (request()->routeIs('home')) ? 'bg-primary bg-image' : '' }}">
  <div id="app">
    <div class="main-wrapper">
      <div class="container">
      <!-- <div class="navbar-bg"></div> -->
      <nav class="navbar navbar-expand-lg main-navbar bg-primary">
      <div class="container">
        <a href="{{ url('') }}" class="navbar-brand d-none d-md-none">BAKAWAN-RTLH</a>
        <a class="navbar-brand d-none d-md-block" href="{{ url('') }}">
          <img src="{{ asset('img/bakawan-logo.png') }}" width="35" height="35" class="d-inline-block align-top" alt="">
        </a>
        <div class="navbar-nav">
          <a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar"><i class="fas fa-bars"></i></a>
        </div>
        <!-- <a href="{{ url('') }}" class="navbar-brand d-none d-md-block sidebar-gone-show">BAKAWAN-RTLH</a> -->
        <a class="navbar-brand d-none d-md-block sidebar-gone-show" href="{{ url('') }}">
          <img src="{{ asset('img/bakawan-logo.png') }}" width="35" height="35" class="d-inline-block align-top" alt="">
        </a>
        <div class="nav-collapse">
          <!-- <a class="sidebar-gone-show nav-collapse-toggle nav-link" href="#">
            <i class="fas fa-ellipsis-v"></i>
          </a> -->
          <ul class="navbar-nav">
            <li class="nav-item {{ (request()->is('/')) ? 'active' : '' }}"><a href="{{ url('') }}" class="nav-link">Beranda</a></li>
            <li class="nav-item {{ (request()->is('sarat-dan-kententuan')) ? 'active' : '' }}"><a href="{{ url('sarat-dan-kententuan') }}" class="nav-link">Syarat & Ketentuan</a></li>
            <li class="nav-item {{ (request()->is('gallery')) ? 'active' : '' }}"><a href="{{ url('gallery') }}" class="nav-link">Galeri</a></li>
            <li class="nav-item {{ (request()->is('panduan')) ? 'active' : '' }}"><a href="{{ url('panduan') }}" class="nav-link">Panduan</a></li>
            <!-- <li class="nav-item"><a href="{{ url('video') }}" class="nav-link">Video</a></li> -->
            <li class="nav-item dropdown {{ (request()->is('post*')) ? 'active' : '' }}"><a href="#" id="navbarDropdown" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pengumuman</a>
              <div class="dropdown-menu max-width" aria-labelledby="navbarDropdown">
                @foreach ($posts as $post)
                <a class="dropdown-item" href="{{ url('post') }}/{{ $post->id }}">{{ $post->title }}</a>
                @endforeach
              </div>
            </li>
            <!-- <li class="nav-item"><a href="#" class="nav-link">About</a></li> -->
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
          @auth
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="{{ asset((Auth::User()->foto != null) ? Auth::User()->foto : 'img/avatar/avatar-1.png') }}" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">Hi, {{ Auth::User()->name }}</div></a>
            <div class="dropdown-menu dropdown-menu-right">
              @role('Admin')
              <a href="{{ url('/admin/profile') }}" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Profil
              </a>
              <a href="{{ route('admin.dashboard') }}" class="dropdown-item has-icon"><i class="fas fa-home"></i> Dasbor</a>
              @else
              <a href="{{ url('/profile') }}" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Profil
              </a>
              <a href="{{ route('dashboard') }}" class="dropdown-item has-icon"><i class="fas fa-home"></i> Dasbor</a>
              @endrole
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
          @endauth
          </li>
        </ul>
      </div>
      </nav>

      <nav class="navbar navbar-secondary navbar-expand-lg d-none">
        <div class="container">
          <ul class="navbar-nav">
            <li class="nav-item active"><a href="{{ url('') }}" class="nav-link">Beranda</a></li>
            <li class="nav-item"><a href="{{ url('sarat-dan-kententuan') }}" class="nav-link">Syarat & Ketentuan</a></li>
            <li class="nav-item"><a href="{{ url('gallery') }}" class="nav-link">Galeri</a></li>
            <li class="nav-item"><a href="{{ url('panduan') }}" class="nav-link">Panduan</a></li>
            <!-- <li class="nav-item"><a href="{{ url('video') }}" class="nav-link">Video</a></li> -->
            <li class="nav-item dropdown"><a href="#" id="navbarDropdown" class="nav-link has-dropdown" data-toggle="dropdown">Pengumuman</a>
              <ul class="dropdown-menu">
                @foreach ($posts as $post)
                <li><a class="dropdown-item" href="{{ url('post') }}/{{ $post->id }}">{{ $post->title }}</a></li>
                @endforeach
              </ul>
            </li>
          </ul>
        </div>
      </nav>
     <!-- Main Content -->
     {{ $slot }}

     <footer class="main-footer p-3 text-white d-none d-md-inline-block" style="
          /* background-color: #8492f9; */
          border-radius: 10px;
      ">
        <div class="footer-left">
        Copyright &copy; Dinas Perumahan dan Kawasan Permukiman Kota Banjarmasin 2021
        </div>
        <div class="footer-right">
          1.0.0
        </div>
      </footer>
    </div>
    </div>
  </div>

  <nav class="navbar fixed-bottom navbar-light bg-primary text-white d-md-none">
    <div class="container">
      <div class="text-center">
          <!-- Copyright &copy; BAKAWAN-RTLH 2021 -->
          Copyright &copy; Dinas Perumahan dan Kawasan Permukiman Kota Banjarmasin 2021
        </div>
        <!-- <div class="footer-right">
          1.0.0
        </div> -->
    </div>
  </nav>

  <!-- General JS Scripts -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="{{ asset('js/stisla.js') }}"></script>

  <!-- FCM JS -->
  @include('fcm')

  <!-- Extra Js -->
  @isset($extra_js)
    {{ $extra_js }}
  @endisset

  <!-- Template JS File -->
  <script src="{{ asset('js/scripts.js') }}"></script>
  <script src="{{ asset('js/custom.js') }}"></script>

  <!-- <script type="text/javascript">
    // Initialize the service worker
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('/serviceworker.js', {
            scope: '.'
        }).then(function (registration) {
            // Registration was successful
            console.log('Laravel PWA: ServiceWorker registration successful with scope: ', registration.scope);
        }, function (err) {
            // registration failed :(
            console.log('Laravel PWA: ServiceWorker registration failed: ', err);
        });
    }
  </script> -->
</body>
</html>
