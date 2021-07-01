<x-home-layout>

  <x-slot name="title">Syarat & Ketentuan - Bakawan RTLH</x-slot>

  <!-- Main Content -->
  <div class="main-content">
      <section class="section">
        <div class="section-header">
          <div class="section-header-back">
            <a href="{{ url('') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
          </div>
          <h1>Syarat & Ketentuan</h1>
        </div>

        <div class="section-body">
          <!-- <h2 class="section-title">Create New</h2>
          <p class="section-lead">
            On this page you can create a new post and fill in all fields.
          </p> -->

          <div class="card">
                <!-- <div class="card-header">
                  <h4>Basic DataTables</h4>
                </div> -->
            <div class="card-body p-1">
                <div class="image d-lg-block">
                  <a href="{{ asset('img/bsps.jpg') }}" class="chocolat-image" title="Just an example">
                      <div>
                        <img alt="image" src="{{ asset('img/bsps.jpg') }}" class="img-fluid" alt="Responsive image">
                      </div>
                  </a>
                </div>
              </div>
          </div>
            

          <div class="card">
                <!-- <div class="card-header">
                  <h4>Basic DataTables</h4>
                </div> -->
            <div class="card-body p-1">
                <div class="image d-lg-block">
                  <a href="{{ asset('img/Penerima2.jpg') }}" class="chocolat-image" title="Just an example">
                      <div>
                        <img alt="image" src="{{ asset('img/Penerima2.jpg') }}" class="img-fluid" alt="Responsive image">
                      </div>
                  </a>
                </div>
                </div>
              </div>
          </div>


          <!-- <div class="row">
              <div class="col-12 mb-4">
                  
              </div>
          </div> -->

        </div>
      </section>
  </div>

</x-home-layout>