<x-home-layout>

  <x-slot name="title">{{ $post->title }} - Bakawan RTLH</x-slot>

  <x-slot name="extra_css">
    <link rel="stylesheet" href="{{ asset('plugins/chocolat/chocolat.css') }}">
  </x-slot>

  <!-- Main Content -->
  <div class="main-content">
      <section class="section">
        <div class="section-header">
          <div class="section-header-back d-none d-md-inline">
            <a href="{{ url('') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
          </div>
          <h1>{{ $post->title }}</h1>
        </div>

        <div class="section-body">
          <!-- <h2 class="section-title">Create New</h2> -->
          <!-- <p class="section-lead">
            On this page you can create a new post and fill in all fields.
          </p> -->

          <div class="row">
            <div class="col-12">
              <div class="card">
                <!-- <div class="card-header">
                  <h4>Basic DataTables</h4>
                </div> -->
                <div class="card-body">
                  <div class="article-metas mb-2">
                    <div class="article-meta">Published at {{ $post->tgl }}</div>
                  </div>
                  {!! $post->content !!}
                  
                </div>
              </div>
            </div>
          </div>

        </div>
      </section>
  </div>

  <x-slot name="extra_js">
    <script src="{{ asset('plugins/chocolat/jquery.chocolat.min.js') }}"></script>
  </x-slot>

</x-home-layout>