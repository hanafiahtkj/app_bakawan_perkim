<x-admin-layout>

  <x-slot name="title">Users</x-slot>

  <x-slot name="extra_css">
    <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/DataTables/DataTables-1.10.24/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/iziToast/dist/css/iziToast.min.css') }}">
  </x-slot>

  <!-- Main Content -->
  <div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Users</h1>
        <div class="section-header-button">
          <a href="{{ route('users.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> TAMBAH</a>
        </div>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dasbor</a></div>
          <div class="breadcrumb-item">Users</div>
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
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label class="control-label" for="input-code">Kelurahan</label>
                      <select class="form-control selectric" name="id_kelurahan" id="id_kelurahan">
                        <option value="">Pilih....</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <button type="button" id="button-filter" class="btn btn-primary pull-right "><i class="fa fa-filter"></i> Filter</button>
                  </div>
                </div>
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
                <div class="table-responsive">
                  <table class="table table-striped table-bordered" id="table-users">
                    <thead>
                      <tr>
                        <th class="text-center" style="width: 30px;">
                          #
                        </th>
                        <!-- <th>Foto</th> -->
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Kecamatan</th>
                        <th>Kelurahan</th>
                        <!-- <th>Status</th> -->
                        <!-- <th>Date Added</th> -->
                        <th>Aksi</th>
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

  <x-slot name="extra_js">
    <script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('plugins/DataTables/DataTables-1.10.24/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script src="{{ asset('plugins/iziToast/dist/js/iziToast.min.js') }}"></script>
    <script>
    $(function() {

      @if (session('success'))
        iziToast.success({
          title: 'Success!',
          message: 'Data user berhasil disimpan...',
          position: 'topRight'
        });
      @endif

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
      var dataTable = $('#table-users').DataTable({
        processing: true,
        // serverSide: true,
        ordering	  : false,
        // ajax: "{{ route('admin.getUsersDataTables') }}",
        ajax: {
            url: '{{ route('admin.getUsersDataTables') }}',
            data: function (d) {
                d.id_kecamatan = $('#id_kecamatan').val();
                d.id_kelurahan = $('#id_kelurahan').val();
            }
        },
        columns: [
          {data: 'id', "searchable": false},
          {data: 'name'},
          {data: 'username'},
          {data: 'role', "searchable": false},
          {data: 'kecamatan', "searchable": false},
          {data: 'kelurahan', "searchable": false},
          {data: null, "searchable": false},
        ],
        columnDefs  : [
          // {
          //   targets: 1,
          //   render: function ( data, type, row ) {
          //     return '<img alt="image" src="{{ asset('img/avatar/avatar-4.png') }}" class="rounded-circle" width="35" data-toggle="tooltip" title="Wildan Ahdian">';
          //   },
          // },
          {
            targets: 6,
            render: function ( data, type, row ) {
              var url = '{{ route("users.edit", ":id") }}';
              url = url.replace(':id', row['id']);
              return '<div class="buttons"><a href="'+url+'" class="btn btn-icon btn-sm btn-primary" style="width: 29px;"><i class="far fa-edit"></i></a><a href="#" data-id="'+row['id']+'" class="btn btn-icon btn-sm btn-danger btn-hapus" style="width: 29px;"><i class="fas fa-times"></i></a></div>';
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

      $('#button-filter').on('click', function () {
        dataTable.ajax.reload();
      });

      // Hapus
      $('#table-users tbody').on( 'click', '.btn-hapus', function () {
        var id = $(this).data('id');
        var url = '{{ route("users.destroy", ":id") }}';
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
    
    });
    </script>
  </x-slot>

</x-app-layout>