<x-home-layout>

      <x-slot name="title">Selamat Datang - Bakawan RTLH</x-slot>  

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <!-- <div class="section-header">
            <div class="section-header-back">
              <a href="features-posts.html" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Create New</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
              <div class="breadcrumb-item"><a href="#">Posts</a></div>
              <div class="breadcrumb-item">Create New Post</div>
            </div>
          </div> -->
 
          <div class="section-body">
            <!-- <h2 class="section-title">Create New</h2>
            <p class="section-lead">
              On this page you can create a new post and fill in all fields.
            </p> -->

            <div class="hero text-white px-0">
              <div class="hero-inner">
                  <div class="row">
                    <div class="col-sm-5 mb-4">
                    <h1 style="
                          color: #fff;
                          BACKGROUND-COLOR: #ffa429;
                          PADDING: 10PX;
                          BORDER-RADIUS: 10PX;
                      ">Selamat Datang</h1>
                      <h3 class="lead" style="
                          color: #cfd1e3;
                          PADDING: 9PX;
                          BACKGROUND-COLOR: #212c82;
                          BORDER-RADIUS: 10PX;
                      "><b>BAKAWAN RTLH - Banjarmasin Aplikasi Wadah Pendataan Rumah Tidak Layak Huni</b></h3>
                      <!-- <p style="
                          color: #fff;
                          PADDING: 9PX;
                          BACKGROUND-COLOR: #4f5ecc;
                          BORDER-RADIUS: 10PX;
                      ">Banjarmasin Aplikasi Wadah Pendataan Rumah Tidak Layak Huni</p> -->
                      <!-- <p style="
                          color: #fff;
                          PADDING: 9PX;
                          BACKGROUND-COLOR: #4f5ecc;
                          BORDER-RADIUS: 10PX;
                      ">BANJARMASIN APLIKASI WADAH PENDATAAN RUMAH TIDAK LAYAK HUNI</p> -->
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
                    <div class="col-sm-7 mb-4">
                      <div class="image d-lg-block">
                        <img src="{{ asset('img/web4.png') }}" class="img-fluid" alt="Responsive image">
                      </div>
                    </div>
                </div>
              </div>
            </div>

          </div>
        </section>
    </div>
    
</x-home-layout>