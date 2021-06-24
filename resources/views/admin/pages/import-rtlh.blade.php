<x-admin-layout>
  
  <x-slot name="title">
    Report RTLH
  </x-slot>

  <x-slot name="extra_css">
    <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/DataTables/DataTables-1.10.24/css/dataTables.bootstrap4.min.css') }}">
    <!-- <link rel="stylesheet" href="{{ asset('plugins/DataTables-1.10.24/css/select.bootstrap4.min.css') }}"> -->
  </x-slot>

  <!-- Main Content -->
  <div class="main-content">
    <section class="section">
      <div class="section-header">
        <div class="section-header-back">
          <a href="{{ route('admin.rtlh') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Import (Rumah Tidak Layak Huni)</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
          <div class="breadcrumb-item">Import (Rumah Tidak Layak Huni)</div>
        </div>
      </div>
      <!-- <div class="section-header">
        <h1>RTLH</h1>
        <div class="section-header-button">
          <a href="{{ route('admin.create-rtlh') }}" class="btn btn-primary mr-2"><i class="fa fa-plus"></i> TAMBAH</a>
          <a href="{{ route('admin.create-rtlh') }}" class="btn btn-success"><i class="fa fa-file-excel"></i> IMPORT EXCEL</a>
        </div>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
          <div class="breadcrumb-item">RTLH</div>
        </div>
      </div> -->

      <div class="section-body">
        <!-- <h2 class="section-title">Users</h2>
        <p class="section-lead">
          We use 'DataTables' made by @SpryMedia. You can check the full documentation <a href="https://datatables.net/">here</a>.
        </p> -->
        <form id="form-rtlh" method="POST" action="{{ route('admin.import-rtlh-upload') }}" target="_blank">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <!-- <div class="card-header">
                  <h4>Card Title</h4> 
                </div> -->
                <div class="card-body p-4">
                  <ul class="nav nav-tabs" id="myTab5" role="tablist">
                    <!-- <li class="nav-item">
                      <a class="nav-link active" id="existing-tab" data-toggle="tab" href="#existing" role="tab" aria-controls="existing" aria-selected="true">
                        Rtlh Existing</a>
                    </li> -->
                    <li class="nav-item">
                      <a class="nav-link active" id="rtlh-baru-tab" data-toggle="tab" href="#rtlh-baru" role="tab" aria-controls="rtlh-baru" aria-selected="false">
                        Rtlh Baru</a>
                    </li>
                  </ul>
                  <div class="tab-content tab-bordered" id="myTabContent6">
                    <!-- <div class="tab-pane fade show active" id="existing" role="tabpanel" aria-labelledby="existing-tab">
                      <div class="jumbotron m-0 p-4">
                        <div class="row">
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label class="control-label" for="input-name">File</label>
                              <input type="file" class="form-control" name="file_excel">
                              <a href="{{ asset('excel/Format_Excel_Data_RTLH_2017.xlsx') }}" target="_blank">Download Format Import.xls</a>
                            </div>
                            <button type="submit" target="_blank" name="type" value="existing" id="button-excel" class="btn btn-success pull-right mr-2 btn-simpan"><i class="fa fa-file-excel"></i> Import Excel</button>
                          </div>
                        </div>
                      </div>
                    </div> -->
                    <div class="tab-pane fade show active" id="rtlh-baru" role="tabpanel" aria-labelledby="rtlh-baru-tab">
                      <div class="jumbotron m-0 p-4">
                        <div class="row">
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label class="control-label" for="input-name">File</label>
                              <input type="file" class="form-control" name="file_excel2">
                              <a href="{{ asset('excel/2020_Format_Standar_Data_RTLH.xlsx') }}" target="_blank">Download Format Import.xls</a>
                            </div>
                            <button type="submit" target="_blank" name="type" value="rtlh" id="button-excel" class="btn btn-success pull-right mr-2 btn-simpan"><i class="fa fa-file-excel"></i> Import Excel</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>

        <!-- <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-striped table-bordered" id="table-rtlh">
                      <thead>
                      <tr>
                          <th class="align-middle" style="width:30px;">
                          #
                          </th>
                          <th class="align-middle">Nik / No.KTP</th>
                          <th class="align-middle">Nama Lengkap</th>
                          <th class="align-middle">Kecamatan</th>
                          <th class="align-middle">Kelurahan</th>
                          <th class="align-middle">Status Verifikasi</th>
                          <th class="align-middle">Status Realisasi</th>
                          <th class="align-middle">Tanggal</th>
                      </tr>
                      </thead>
                      <tbody>
                      </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div> -->
      </div>
    </section>
  </div>

  <x-slot name="extra_js">
    <script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('plugins/DataTables/DataTables-1.10.24/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script src="{{ asset('js/plugin.js') }}"></script>
    <script>
    $(function() {

      $('#id_kecamatan').on('change', function () {
        // alert('ok');
        var id = $(this).val();
        var url = '{{ route("getKelurahan", ":id") }}';
        url = url.replace(':id', id);
        $('#id_kelurahan').html('');
        $('#id_kelurahan').append(new Option('Pilih.....', ''))
        $.get(url, function( response ) {
            $.each(response.data, function (id, name) {
                $('#id_kelurahan').append(new Option(name, id))
            })
        });
      });

      $('#button-filter').on('click', function () {
        dataTable.ajax.reload();
      });

      // Hapus
      $('#table-rtlh tbody').on( 'click', '.btn-hapus', function () {
        var id = $(this).data('id');
        var url = '{{ route("admin.hapus-rtlh", ":id") }}';
        url = url.replace(':id', id);
        swal({
            title: 'Yakin ingin menghapus?',
            // text: 'Once deleted, you will not be able to recover this imaginary file!',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              $.ajax({
                url: url,
                data : {_token:'{{ csrf_token() }}'},
                type : "DELETE",
                dataType: "json",
                cache: true,
                success: function(response) {
                  dataTable.ajax.reload();
                }
              });
            }
          });
      });

      $("form#form-rtlh").submit(function(e){
        e.preventDefault();
        var btn = $('.btn-simpan');
        btn.addClass('btn-progress');
        var formData = new FormData($(this)[0]);
        formData.append('_token', '{{ csrf_token() }}');
        $.ajax({
            type: "POST",
            url: "{{ route('admin.import-rtlh-upload') }}",
            data: formData,
            processData: false,
            contentType: false,
            dataType: "json",
            success: function(data, textStatus, jqXHR) {
              $(".is-invalid").removeClass("is-invalid");
              if (data['status'] == true) {
                swal({
                  title: "Import Data RTLH selesai!", 
                  icon: "success",
                })
                .then((value) => {
                  
                });
              }
              else {
                printErrorMsg(data.errors);
              }
              btn.removeClass('btn-progress');
            },
            error: function(data, textStatus, jqXHR) {
              alert(jqXHR + ' , Proses Dibatalkan!');
            },
        });
      });

    });
    </script>
  </x-slot>
</x-app-layout>