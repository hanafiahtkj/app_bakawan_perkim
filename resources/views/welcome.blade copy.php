<!DOCTYPE html>
<html lang="en"> 
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Selamat Datang - Bakawan RTLH</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- CSS Libraries -->

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('css/components.css') }}">

  <style>
    .masthead {
      padding-top: 4.5rem;
    }
    .main-footer {
      border-top: none;
    }
    body.layout-3 .main-content {
      padding-top: 80px;
    }
    .hero-wrapper {
        display: inline-block;
        width: 100%;
        height: 580px;
    }
  </style>
</head>

<body class="layout-3">
  <div id="app">
    <div class="main-wrapper">
      <div class="container-fluid">
      <!-- <div class="navbar-bg"></div> -->
      <nav class="navbar navbar-expand-lg main-navbar bg-primary">
      <div class="container">
        <a href="{{ url('') }}" class="navbar-brand sidebar-gone-hide">BKWN-RTLH</a>
        <!-- <div class="navbar-nav">
          <a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar"><i class="fas fa-bars"></i></a>
        </div> -->
        <div class="nav-collapse">
          <a class="sidebar-gone-show nav-collapse-toggle nav-link" href="#">
            <i class="fas fa-ellipsis-v"></i>
          </a>
          <ul class="navbar-nav">
            <li class="nav-item active"><a href="{{ url('') }}" class="nav-link">Home</a></li>
            <li class="nav-item"><a href="#" class="nav-link">About</a></li>
          </ul>
        </div>
        <form class="form-inline ml-auto">
          <ul class="navbar-nav">
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
          </ul>
          <div class="search-element">
            <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="250">
            <button class="btn" type="submit"><i class="fas fa-search"></i></button>
            <div class="search-backdrop"></div>
            <!-- <div class="search-result">
              <div class="search-header">
                Histories
              </div>
              <div class="search-item">
                <a href="#">How to hack NASA using CSS</a>
                <a href="#" class="search-close"><i class="fas fa-times"></i></a>
              </div>
              <div class="search-item">
                <a href="#">Kodinger.com</a>
                <a href="#" class="search-close"><i class="fas fa-times"></i></a>
              </div>
              <div class="search-item">
                <a href="#">#Stisla</a>
                <a href="#" class="search-close"><i class="fas fa-times"></i></a>
              </div>
              <div class="search-header">
                Result
              </div>
              <div class="search-item">
                <a href="#">
                  <img class="mr-3 rounded" width="30" src="../assets/img/products/product-3-50.png" alt="product">
                  oPhone S9 Limited Edition
                </a>
              </div>
              <div class="search-item">
                <a href="#">
                  <img class="mr-3 rounded" width="30" src="../assets/img/products/product-2-50.png" alt="product">
                  Drone X2 New Gen-7
                </a>
              </div>
              <div class="search-item">
                <a href="#">
                  <img class="mr-3 rounded" width="30" src="../assets/img/products/product-1-50.png" alt="product">
                  Headphone Blitz
                </a>
              </div>
              <div class="search-header">
                Projects
              </div>
              <div class="search-item">
                <a href="#">
                  <div class="search-icon bg-danger text-white mr-3">
                    <i class="fas fa-code"></i>
                  </div>
                  Stisla Admin Template
                </a>
              </div>
              <div class="search-item">
                <a href="#">
                  <div class="search-icon bg-primary text-white mr-3">
                    <i class="fas fa-laptop"></i>
                  </div>
                  Create a new Homepage Design
                </a>
              </div>
            </div> -->
          </div>
        </form>
        <ul class="navbar-nav navbar-right">
          <!-- <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep"><i class="far fa-bell"></i></a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right">
              <div class="dropdown-header">Notifications
                <div class="float-right">
                  <a href="#">Mark All As Read</a>
                </div>
              </div>
              <div class="dropdown-list-content dropdown-list-icons">
                <a href="#" class="dropdown-item dropdown-item-unread">
                  <div class="dropdown-item-icon bg-primary text-white">
                    <i class="fas fa-code"></i>
                  </div>
                  <div class="dropdown-item-desc">
                    Template update is available now!
                    <div class="time text-primary">2 Min Ago</div>
                  </div>
                </a>
                <a href="#" class="dropdown-item">
                  <div class="dropdown-item-icon bg-info text-white">
                    <i class="far fa-user"></i>
                  </div>
                  <div class="dropdown-item-desc">
                    <b>You</b> and <b>Dedik Sugiharto</b> are now friends
                    <div class="time">10 Hours Ago</div>
                  </div>
                </a>
                <a href="#" class="dropdown-item">
                  <div class="dropdown-item-icon bg-success text-white">
                    <i class="fas fa-check"></i>
                  </div>
                  <div class="dropdown-item-desc">
                    <b>Kusnaedi</b> has moved task <b>Fix bug header</b> to <b>Done</b>
                    <div class="time">12 Hours Ago</div>
                  </div>
                </a>
                <a href="#" class="dropdown-item">
                  <div class="dropdown-item-icon bg-danger text-white">
                    <i class="fas fa-exclamation-triangle"></i>
                  </div>
                  <div class="dropdown-item-desc">
                    Low disk space. Let's clean it!
                    <div class="time">17 Hours Ago</div>
                  </div>
                </a>
                <a href="#" class="dropdown-item">
                  <div class="dropdown-item-icon bg-info text-white">
                    <i class="fas fa-bell"></i>
                  </div>
                  <div class="dropdown-item-desc">
                    Welcome to Stisla template!
                    <div class="time">Yesterday</div>
                  </div>
                </a>
              </div>
              <div class="dropdown-footer text-center">
                <a href="#">View All <i class="fas fa-chevron-right"></i></a>
              </div>
            </div>
          </li> -->
          @auth
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="{{ asset('img/avatar/avatar-1.png') }}" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">Hi, {{ Auth::User()->name }}</div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <a href="{{ url('/profile') }}" class="dropdown-item has-icon">
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
          @endauth
          <!-- <li><a href="#" class="nav-link nav-link-lg">Login</a> -->
          </li>
        </ul>
      </div>
      </nav>

      <!-- <header class="masthead">
            <div class="container h-100">
                <div class="row h-100 align-items-center justify-content-center text-center">
                    <div class="col-lg-10 align-self-end">
                        <h1 class="text-uppercase text-white font-weight-bold">Your Favorite Source of Free Bootstrap Themes</h1>
                        <hr class="divider my-4">
                    </div>
                    <div class="col-lg-8 align-self-baseline">
                        <p class="text-white-75 font-weight-light mb-5">Start Bootstrap can help you build better websites using the Bootstrap framework! Just download a theme and start customizing, no strings attached!</p>
                        <a class="btn btn-primary btn-xl js-scroll-trigger" href="#about">Find Out More</a>
                    </div>
                </div>
            </div>
        </header> -->

      <!-- <nav class="navbar navbar-secondary navbar-expand-lg">
        <div class="container">
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a href="/dashboard" class="nav-link"><i class="fas fa-fire"></i><span>Dasbor</span></a>
            </li>
            <li class="nav-item">
              <a href="/create-new" class="nav-link"><i class="far fa-clone"></i><span>Ceate New</span></a>
            </li>
          </ul>
        </div>
      </nav> -->

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <!-- <div class="section-header">
            <div class="section-header-back">
              <a href="features-posts.html" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Create New</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Dasbor</a></div>
              <div class="breadcrumb-item"><a href="#">Posts</a></div>
              <div class="breadcrumb-item">Create New Post</div>
            </div>
          </div> -->

          <div class="section-body">
            <!-- <h2 class="section-title">Create New</h2>
            <p class="section-lead">
              On this page you can create a new post and fill in all fields.
            </p> -->

            <div class="row">
              <div class="col-12 mb-4">
                <div class="hero-wrapper bg-primary"> 
                  <div class="hero bg-primary rounded-3 text-center text-white">
                    <div class="hero-inner">
                      <h1>Selamat Datang</h1>
                      <h3 class="lead">Bakawan RTLH (Rumah Tidak Layak Huni)</h3>
                      <div class="mt-4">
                      @if (Route::has('login'))
                        @auth
                          @role('Admin')
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-warning btn-lg btn-icon icon-left mr-2"><i class="far fa-user"></i> Dashboad</a>
                          @else
                            <a href="{{ route('dashboard') }}" class="btn btn-warning btn-lg btn-icon icon-left mr-2"><i class="far fa-user"></i> Dashboad</a>
                          @endrole
                        @else
                        <a href="{{ route('login') }}" class="btn btn-warning btn-lg icon-left mr-2"><i class="far fa-user"></i> Login</a>
                            <!-- @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-outline-white btn-lg btn-icon icon-left"><i class="far fa-user"></i> Register</a>
                            @endif -->
                        @endauth
                      @endif
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </section>
    </div>

      <footer class="main-footer p-3" style="
          /* background-color: #8492f9; */
          border-radius: 10px;
      ">
        <div class="footer-left">
          Copyright &copy; 2021
          <!-- <div class="bullet"></div> Design By <a href="https://nauval.in/">Muhamad Nauval Azhar</a> -->
        </div>
        <div class="footer-right">
          1.0.0
        </div>
      </footer>
    </div>
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="{{ asset('js/stisla.js') }}"></script>

  <!-- FCM JS -->
  @include('fcm')

  <!-- Template JS File -->
  <script src="{{ asset('js/scripts.js') }}"></script>
  <script src="{{ asset('js/custom.js') }}"></script>
</body>
</html>
