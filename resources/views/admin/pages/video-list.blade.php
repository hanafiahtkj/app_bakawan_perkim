<x-admin-layout>
  
  <x-slot name="title">
    Gallery
  </x-slot>

  <x-slot name="extra_css">
    <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/DataTables/DataTables-1.10.24/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/iziToast/dist/css/iziToast.min.css') }}">
  </x-slot>

  <!-- Main Content -->
  <div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Video</h1>
        <div class="section-header-button">
          <button class="btn btn-primary" data-toggle="modal" data-target="#form"><i class="fa fa-plus"></i> TAMBAH</button>
        </div>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="#">Dasbor</a></div>
          <div class="breadcrumb-item"><a href="#">Video</a></div>
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
                  <table class="table table-striped table-bordered" id="table-users">
                    <thead>
                      <tr>
                        <th class="text-center" style="width: 30px;">
                          #
                        </th>
                        <th>Title</th>
                        <th>Url</th>
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

  <form id="form-video" method="POST" action="{{ route('video.store') }}" novalidate>
  <div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header border-bottom-0">
          <h5 class="modal-title" id="exampleModalLabel">Tambah</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form>
          <div class="modal-body">
            <div class="form-group">
              <label for="title">Title</label>
              <input type="text" name="title" class="form-control" id="title" aria-describedby="emailHelp" placeholder="Enter Title">
            </div>
            <div class="form-group">
              <label for="url">Url Youtube</label>
              <input type="text" name="url" class="form-control" id="url" aria-describedby="emailHelp" placeholder="Url Youtube">
              <small id="emailHelp" class="form-text text-muted">Url Youtube.</small>
            </div>
          </div>
          <div class="modal-footer border-top-0 d-flex justify-content-center">
            <button type="submit" id="btn-simpan" class="btn btn-success">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  </form>

  <x-slot name="extra_js">
    <script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('plugins/DataTables/DataTables-1.10.24/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script src="{{ asset('plugins/iziToast/dist/js/iziToast.min.js') }}"></script>
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
      var dataTable = $('#table-users').DataTable({
        processing: true,
        // serverSide: true,
        ordering	  : false,
        // ajax: "{{ route('admin.getUsersDataTables') }}",
        ajax: {
            url: '{{ route('admin.getVideoDataTables') }}',
            data: function (d) {
                // d.id_kecamatan = $('#id_kecamatan').val();
                // d.id_kelurahan = $('#id_kelurahan').val();
            }
        },
        columns: [
          {data: 'id', "searchable": false},
          {data: 'title'},
          {data: 'url'},
          {data: null, "searchable": false},
        ],
        columnDefs  : [
          {
              targets: 0,
              className: "text-center"
          },
          {
            targets: 3,
            render: function ( data, type, row ) {
              return '<div class="buttons"><a href="#" data-id="'+row['id']+'" class="btn btn-icon btn-sm btn-danger btn-hapus" style="width: 29px;"><i class="fas fa-times"></i></a></div>';
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

      $("form#form-video").submit(function(e){
        e.preventDefault();
        var btn = $('#btn-simpan');
        btn.addClass('btn-progress');
        var formData = new FormData($(this)[0]);
        formData.append('_token', '{{ csrf_token() }}');
        $.ajax({
            type: "POST",
            url: "{{ route('video.store') }}",
            data: formData,
            processData: false,
            contentType: false,
            dataType: "json",
            success: function(data, textStatus, jqXHR) {
              //process data
              $(".is-invalid").removeClass("is-invalid");
              if (data['status'] == true) {
                dataTable.ajax.reload();
                $('#form').modal('hide');
              }
              btn.removeClass('btn-progress');
            },
            error: function(data, textStatus, jqXHR) {
              //process error msg
              //$('.loader').hide();
              alert(jqXHR + ' , Proses Dibatalkan!');
            },
        });
      });

      // Hapus
      $('#table-users tbody').on( 'click', '.btn-hapus', function () {
        var id = $(this).data('id');
        var url = '{{ route("video.destroy", ":id") }}';
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

    });
    </script>
  </x-slot>
</x-app-layout>