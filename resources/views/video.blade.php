<x-home-layout>

  <x-slot name="title">Video - Bakawan RTLH</x-slot>

  <!-- Main Content -->
  <div class="main-content">
      <section class="section">
        <div class="section-header">
          <div class="section-header-back">
            <a href="{{ url('') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
          </div>
          <h1>Video</h1>
        </div>

        <div class="section-body">
          <!-- <h2 class="section-title">Create New</h2>
          <p class="section-lead">
            On this page you can create a new post and fill in all fields.
          </p> -->

          <div class="row">
            <div class="col-12">
              <div class="card">
                <!-- <div class="card-header">
                  <h4>Basic DataTables</h4>
                </div> -->
                <div class="card-body">
                  <div class="row">
                    @foreach ($gallery as $gall)
                    <div class="col-4">
                      <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="{{ $gall->url }}" allowfullscreen></iframe>
                      </div>
                    </div>
                    @endforeach
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </section>
  </div>

</x-home-layout>