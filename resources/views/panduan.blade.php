<x-home-layout>

  <x-slot name="title">Panduan - Bakawan RTLH</x-slot>

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
          <h1>Panduan</h1>
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
                <div class="card-body p-3">
                  <table class="table table-striped">
                    <tbody>
                      <tr>
                        
                        <td>Panduan Untuk Admin</td>
                        <td class="text-right"><a href="{{ url('pdf/manual_admin.pdf') }}" target="_blank" class="btn btn-primary"><i class="fas fa-download"></i> Download PDF</button></a>
                      </tr>
                      <tr>
                        
                        <td>Panduan Untuk Petugas Kelurahan</td>
                        <td  class="text-right"><a href="{{ url('pdf/manual_petugas_kelurahan.pdf') }}" target="_blank" class="btn btn-primary"><i class="fas fa-download"></i> Download PDF</button></td>
                      </tr>
                      <tr>
                        
                        <td>Panduan Untuk TFL</td>
                        <td  class="text-right"><a href="{{ url('pdf/manual_tfl.pdf') }}" target="_blank" class="btn btn-primary"><i class="fas fa-download"></i> Download PDF</button></td>
                      </tr>
                      <tr>
                        
                        <td>Panduan Untuk Konsultan</td>
                        <td  class="text-right"><a href="{{ url('pdf/manual_konsultan.pdf') }}" target="_blank" class="btn btn-primary"><i class="fas fa-download"></i> Download PDF</button></td>
                      </tr>
                    </tbody>
                  </table>
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