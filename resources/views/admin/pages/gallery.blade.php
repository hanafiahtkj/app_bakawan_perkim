<x-admin-layout>
  
  <x-slot name="title">
    Galeri
  </x-slot>

  <x-slot name="extra_css">
    <link rel="stylesheet" href="{{ asset('plugins/leaflet/leaflet.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/Leaflet.markercluster-1.4.1/dist/MarkerCluster.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/Leaflet.markercluster-1.4.1/dist/MarkerCluster.Default.css') }}">
  </x-slot>

  <!-- Main Content -->
  <div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Galeri</h1>
        <div class="section-header-button">
          <a href="{{ route('gallery.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> TAMBAH</a>
        </div>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="#">Dasbor</a></div>
          <div class="breadcrumb-item"><a href="#">Gallery</a></div>
        </div>
      </div>

      <div class="section-body">
        <!-- <h2 class="section-title">Users</h2>
        <p class="section-lead">
          We use 'DataTables' made by @SpryMedia. You can check the full documentation <a href="https://datatables.net/">here</a>.
        </p> -->

        <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- <div class="card-header">
                <h4>Basic DataTables</h4>
              </div> -->
              <div class="card-body">
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <x-slot name="extra_js">
    <script src="{{ asset('plugins/leaflet/leaflet.js') }}"></script>
    <script src="{{ asset('plugins/Leaflet.markercluster-1.4.1/dist/leaflet.markercluster.js') }}"></script>
    <script>
    $(function() {
      

    });
    </script>
  </x-slot>
</x-app-layout>