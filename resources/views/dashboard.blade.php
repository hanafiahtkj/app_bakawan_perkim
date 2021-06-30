<x-app-layout>

  <x-slot name="title">Dasbor</x-slot>

  <x-slot name="extra_css">
    <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/DataTables/DataTables-1.10.24/css/dataTables.bootstrap4.min.css') }}">
    <!-- <link rel="stylesheet" href="{{ asset('plugins/DataTables-1.10.24/css/select.bootstrap4.min.css') }}"> -->
  </x-slot>
  
  <!-- Main Content -->
  <div class="main-content">
      <section class="section">
        <!-- <div class="section-header">
          <h1>List Data</h1>
          <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dasbor</a></div>
            <div class="breadcrumb-item"><a href="#">Posts</a></div>
            <div class="breadcrumb-item">Create New Post</div>
          </div>
        </div> -->

        <div class="section-body">

          <div class="row mb-4">
            <div class="col-12">
              <div class="card mb-0">
                <div class="card-body">
                  <ul class="nav nav-pills" id="stts-tab">
                    <li class="nav-item">
                      <a class="nav-link active" data-stts="all" href="#">Semua <span class="badge badge-white">{{ $tot_all }}</span></a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-stts="null" href="#">Menunggu<span class="badge badge-primary">{{ $tot_menunggu }}</span></a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-stts="3" href="#">Perlu perbaikan <span class="badge badge-primary">{{ $tot_perbaikan }}</span></a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-stts="1" href="#">Diterima <span class="badge badge-primary">{{ $tot_diterima }}</span></a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-stts="2" href="#">Ditolak <span class="badge badge-primary">{{ $tot_ditolak }}</span></a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>

          <!-- <h2 class="section-title">List Datatables</h2>
          <p class="section-lead">
            On this page you can create a new post and fill in all fields.
          </p> -->
          <input type="hidden" name="stts_verif" id="stts-verif" value="all">
          <div class="row">
              <div class="col-12">
                  <div class="card">
                  <!-- <div class="card-header">
                      <h4>Basic DataTables</h4>
                  </div> -->
                  <div class="card-body">
                      <div class="table-responsive">
                      <table class="table table-striped table-bordered" id="table-rtlh">
                          <thead>
                          <tr>
                              <th class="align-middle">
                              #
                              </th>
                              <th class="align-middle">Nik / No.KTP</th>
                              <th class="align-middle">Nama Lengkap</th>
                              <th class="align-middle">Kecamatan</th>
                              <th class="align-middle">Kelurahan</th>
                              <th class="align-middle">Status Verifikasi</th>
                              <th class="align-middle">Status Realisasi</th>
                              <th class="align-middle">Tanggal</th>
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

  <x-slot name="extra_js">
    <script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('plugins/DataTables/DataTables-1.10.24/js/dataTables.bootstrap4.min.js') }}"></script>
    <!-- <script src="../node_modules/datatables.net-select-bs4/js/select.bootstrap4.min.js"></script> -->
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
        // lengthMenu: [ 5, 10, 25, 50, 75, 100 ],
        processing: true,
        // serverSide: true,
        // ordering	  : false,
        // ajax: "{{ route('getRtlhDataTables') }}",
        ajax: {
            url: '{{ route('getRtlhDataTables') }}',
            data: function (d) {
                d.stts_verif = $('input[name=stts_verif]').val();
            }
        },
        columns: [
          {data: null},
          {data: 'nik'},
          {data: 'nama_lengkap'},
          {data: 'name_kecamatan'},
          {data: 'name_kelurahan'},
          {data: 'ket_verif'},
          {data: 'ket_realisasi'},
          {data: 'tanggal'},
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
              var ket_verif = (row['stts_verif'] == null) ? 'Menunggu' : row['ket_verif'];
              ket_verif += (row['catatan'] == null) ? '' : ',<br> Catatan : ' + row['catatan'];
              return ket_verif;
            },
          },
          {
            targets: 6,
            render: function ( data, type, row ) {
              return (row['stts_realisasi'] == null) ? 'Belum Realisasi' : row['ket_realisasi'];
            },
          },
          {
            targets: 8,
            render: function ( data, type, row ) {
              var url1 = "{{ url('/edit-rtlh') }}/" + row['id'];
              var url2 = "{{ url('/view-rtlh') }}/" + row['id'];
              var item = ((row['stts_verif'] == null) || (row['stts_verif'] == 3)) ? '<a class="dropdown-item" href="'+url1+'">Edit</a>' : '<a class="dropdown-item" href="'+url2+'">Lihat</a>';
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
    
      $('#stts-tab .nav-link').on('click', function (e) {
        e.preventDefault();
        $('#stts-verif').val($(this).data('stts'));
        $('#stts-tab .nav-link').removeClass('active').find('.badge-white').removeClass('badge-white').addClass('badge-primary');
        $(this).addClass('active').find('.badge-primary').removeClass('badge-primary').addClass('badge-white');
        $('#table-rtlh').DataTable().ajax.reload()
      });

    }); 
    </script>
  </x-slot>
</x-app-layout>
