<x-home-layout>

  <x-slot name="title">Galeri - Bakawan RTLH</x-slot>

  <x-slot name="extra_css">
    <link rel="stylesheet" href="{{ asset('plugins/chocolat/dist/css/chocolat.css') }}">
  </x-slot>

  <!-- Main Content -->
  <div class="main-content">
      <section class="section">
        <div class="section-header">
          <div class="section-header-back">
            <a href="{{ url('') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
          </div>
          <h1>Galeri</h1>
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
                    @foreach ($video as $gall)
                    <div class="col-md-4">
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

          <div class="row">
            <div class="col-12">
              <div class="card">
                <!-- <div class="card-header">
                  <h4>Basic DataTables</h4>
                </div> -->
                <div class="card-body">
                  <!-- <h5>Hello</h5>
                  <div class="gallery gallery-md">
                    <div class="gallery-item" data-image="http://127.0.0.1:8000/uploads/foto//1623720352_CwOxc9tUsAA8N0igdffdggdfghdhdgg.jpg" data-title="Image 1"></div>
                    <div class="gallery-item" data-image="http://127.0.0.1:8000/uploads/foto//1623720352_CwOxc9tUsAA8N0igdffdggdfghdhdgg.jpg" data-title="Image 2"></div>
                    <div class="gallery-item" data-image="http://127.0.0.1:8000/uploads/foto//1623720352_CwOxc9tUsAA8N0igdffdggdfghdhdgg.jpg" data-title="Image 3"></div>
                    <div class="gallery-item" data-image="http://127.0.0.1:8000/uploads/foto//1623720352_CwOxc9tUsAA8N0igdffdggdfghdhdgg.jpg" data-title="Image 4"></div>
                    <div class="gallery-item gallery-more" data-image="http://127.0.0.1:8000/uploads/foto//1623720352_CwOxc9tUsAA8N0igdffdggdfghdhdgg.jpg" data-title="Image 8">
                      <div>+2</div>
                    </div>
                    <div class="gallery-item gallery-hide" data-image="http://127.0.0.1:8000/uploads/foto//1623720352_CwOxc9tUsAA8N0igdffdggdfghdhdgg.jpg" data-title="Image 9"></div>
                  </div> -->
                  @foreach ($gallery as $gall)
                    @if (count($gall->files) > 0)
                      <h5>{{ $gall->name }}</h5>
                      <hr>
                      <div class="gallery gallery-md">
                      @foreach ($gall->files as $file)
                        @if ($loop->iteration == 5)
                          <div class="gallery-item gallery-more" data-image="{{ url('') }}/{{ $file->path }}" data-title="{{ $file->file_name }}">
                            <div>+ {{ $loop->remaining + 1 }}</div>
                          </div>
                        @elseif ($loop->iteration > 5)
                          <div class="gallery-item gallery-hide" data-image="{{ url('') }}/{{ $file->path }}" data-title="{{ $file->file_name }}"></div>
                        @else
                        <div class="gallery-item" data-image="{{ url('') }}/{{ $file->path }}" data-title="{{ $file->file_name }}"></div>
                        @endif
                      @endforeach
                      </div>
                    @endif
                  @endforeach
                </div>
              </div>
            </div>
          </div>

        </div>
      </section>
  </div>

  <x-slot name="extra_js">
    <script src="{{ asset('plugins/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
    <script>
      
    </script>
  </x-slot>

</x-home-layout>