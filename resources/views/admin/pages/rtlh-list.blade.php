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
        <h1>RTLH</h1>
        <div class="section-header-button">
          <a href="{{ route('admin.create-rtlh') }}" class="btn btn-primary mr-2"><i class="fa fa-plus"></i> TAMBAH</a>
          <a href="{{ route('admin.import-rtlh') }}" class="btn btn-success"><i class="fa fa-file-excel"></i> IMPORT EXCEL</a>
        </div>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dasbor</a></div>
          <div class="breadcrumb-item">RTLH</div>
        </div>
      </div>

      <div class="section-body">
        <!-- <h2 class="section-title">Users</h2>
        <p class="section-lead">
          We use 'DataTables' made by @SpryMedia. You can check the full documentation <a href="https://datatables.net/">here</a>.
        </p> -->
        <form method="GET" action="{{ route('admin.export-rtlh') }}" target="_blank">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <!-- <div class="card-header">
                  <h4>Card Title</h4> 
                </div> -->
                <div class="card-body p-4">
                  <div class="jumbotron m-0 p-4">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label class="control-label" for="input-name">Kecamatan</label>
                        <select class="form-control selectric" name="id_kecamatan" id="id_kecamatan">
                          <option value="">Pilih....</option>
                          @foreach ($kecamatan as $id => $name)
                              <option value="{{ $id }}">{{ $name }}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label class="control-label" for="input-code">Kelurahan</label>
                        <select class="form-control selectric" name="id_kelurahan" id="id_kelurahan">
                          <option value="">Pilih....</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label class="control-label" for="input-date-added">Jumlah KK</label>
                        <input type="text" name="jml_kk" value="" id="jml_kk" class="form-control numeric">
                      </div>
                      <button type="button" id="button-filter" class="btn btn-primary pull-right mr-2 mb-2"><i class="fa fa-filter"></i> Filter</button>
                      <button type="button" target="_blank" name="type" value="json" id="button-show" class="btn btn-dark pull-right mr-2 mb-2" data-toggle="modal" data-target="#form">Show / Hide</button>
                      <button type="submit" target="_blank" name="type" value="excel" id="button-excel" class="btn btn-success pull-right mr-2"><i class="fa fa-file-excel"></i> Export Excel</button>
                      <button type="submit" target="_blank" name="type" value="json" id="button-json" class="btn btn-success pull-right"><i class="far fa-copy"></i> Export JSON</button>
                    </div>
                  </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>

        <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- <div class="card-header">
                <h4>Basic DataTables</h4>
              </div> -->
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-striped table-bordered display" id="table-rtlh">
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
                          @foreach ($setups as $setup)
                            <th class="align-middle">{{ $setup->name }}</th>
                          @endforeach
                          <th class="align-middle">Aksi</th>
                      </tr>
                      </thead>
                      <tbody>
                      </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <form id="form-video" method="POST" action="{{ route('video.store') }}" novalidate>
  <div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header border-bottom-0">
          <h5 class="modal-title" id="exampleModalLabel">Show / Hide Columns</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form>
          <div class="modal-body">
            @foreach ($setups as $setup)
              <div class="form-check">
                <input class="form-check-input toggle-vis" data-column="{{ $loop->iteration + 7 }}" name="column" type="checkbox" value="{{ $setup->id }}" id="defaultCheck{{ $setup->id }}">
                <label class="form-check-label" for="defaultCheck{{ $setup->id }}">
                {{ $setup->name }}
                </label>
              </div>
            @endforeach
          </div>
          <!-- <div class="modal-footer border-top-0 d-flex justify-content-center">
            <button type="submit" id="btn-simpan" class="btn btn-success">Simpan</button>
          </div> -->
        </form>
      </div>
    </div>
  </div>
  </form>

  <x-slot name="extra_js">
    <script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('plugins/DataTables/DataTables-1.10.24/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script src="{{ asset('js/plugin.js') }}"></script>
    <script>
    $(function() {
      $.fn.dataTableExt.oApi.fnPagingInfo = function (oSettings)
      {
        return {
            "iStart": oSettings._iDisplayStart,
            "iEnd": oSettings.fnDisplayEnd(),
            "iLength": oSettings._iDisplayLength,
            "iTotal": oSettings.fnRecordsTotal(),
            "iFilteredTotal": oSettings.fnRecordsDisplay(),
            "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
            "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
        };
      };
      var dataTable = $("#table-rtlh").DataTable({
        processing: true,
        // serverSide: true,
        ordering	  : false,
        // ajax: "{{ route('getRtlhDataTables') }}",
        ajax: {
            url: '{{ route('admin.getRtlhDataTables') }}',
            data: function (d) {
                d.id_kecamatan = $('#id_kecamatan').val();
                d.id_kelurahan = $('#id_kelurahan').val();
                d.jml_kk = $('#jml_kk').val();
            }
        },
        columns: [
          {data: null},
          {data: 'nik'},
          {data: 'nama_lengkap'},
          {data: 'kecamatan'},
          {data: 'kelurahan'},
          {data: 'ket_verif'},
          {data: 'ket_realisasi'},
          {data: 'tanggal'},
          @foreach ($setups as $setup)
          {data: '{{ $setup->ref }}', visible: false},
          @endforeach
          {data: null},
        ],
        columnDefs  : [
          {
              targets: 0,
              className: "text-center"
          },
          {
            targets: 5,
            render: function ( data, type, row ) {
              return (row['stts_verif'] == null) ? 'Menunggu' : row['ket_verif'];
            },
          },
          {
            targets: 6,
            render: function ( data, type, row ) {
              return (row['stts_realisasi'] == null) ? 'Belum Realisasi' : row['ket_realisasi'];
            },
          },
          {
            targets: {{ count($setups) + 8 }},
            render: function ( data, type, row ) {
             // var url1 = "{{ url('/edit-rtlh') }}/" + row['id'];
              var url2 = "{{ url('/admin/report/view-rtlh') }}/" + row['id'];
              var url3 = "{{ url('/admin/report/edit-rtlh') }}/" + row['id'];
              var item = 
                '<a class="dropdown-item" href="'+url2+'">Lihat</a>'+
                '<a class="dropdown-item" href="'+url3+'">Edit</a>'+
                '<a class="dropdown-item btn-hapus" href="#" data-id="'+row['id']+'">Hapus</a>';
              html = '<div class="dropdown">' +
                        '<button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Aksi</button>'+
                        '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">'+
                          item
                        '</div>'+
                      '</div>';
              return html;
            },
          },
        ],
        rowCallback : function (row, data, iDisplayIndex) {
          var info = this.fnPagingInfo();
          var page = info.iPage;
          var length = info.iLength;
          var index = page * length + (iDisplayIndex + 1);
          // setiap row
          $('td:eq(0)', row).html(index);
        }
      });

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

      $('.toggle-vis').on('change', function (e) {
        e.preventDefault();
        // alert($(this).attr('data-column'));
        // Get the column API object
        var column = dataTable.column( $(this).attr('data-column') );
        // Toggle the visibility
        column.visible( $(this).is(':checked') );
      });

    });
    </script>
  </x-slot>
</x-app-layout>