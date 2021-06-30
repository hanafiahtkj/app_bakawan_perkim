<x-admin-layout>
  
  <x-slot name="title">
    Role List
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
        <h1>Roles</h1>
        <div class="section-header-button">
          <a href="{{ route('roles.create') }}" class="btn btn-primary">Add New</a>
        </div>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="#">Dasbor</a></div>
          <div class="breadcrumb-item"><a href="#">Modules</a></div>
          <div class="breadcrumb-item">DataTables</div>
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
                <div class="table-responsive">
                  <table class="table table-striped" id="table-roles">
                    <thead>
                      <tr>
                        <th class="text-center" style="width:30px;">
                          #
                        </th>
                        <th>Role</th>
                        <th style="width:80px;">Status</th>
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
    <!-- <script src="../node_modules/datatables.net-select-bs4/js/select.bootstrap4.min.js"></script> -->
    <script>
    $(function() {
      $("#table-roles").dataTable({
        processing: true,
        // serverSide: true,
        ordering	  : false,
        ajax: "{{ route('admin.getRolesDataTables') }}",
        columns: [
          {data: 'id'},
          {data: 'name'},
          {data: null},
        ],
        columnDefs  : [
          {
            targets: 2,
            render: function ( data, type, row ) {
              return '<div class="badge badge-success">Enabled</div>';
            },
          },
          // {
          //   targets: 5,
          //   render: function ( data, type, row ) {
          //     return '<div class="badge badge-success">Enabled</div>';
          //   },
          // },
          // {
          //   targets: 7,
          //   render: function ( data, type, row ) {
          //     return '<a href="#" class="btn btn-secondary">Detail</a>';
          //   },
          // },
        ],
      });
    });
    </script>
  </x-slot>
</x-app-layout>