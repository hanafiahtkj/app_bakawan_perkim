<x-admin-layout>

  <x-slot name="title">Data Rumah di Kawasan Kumuh</x-slot>

  <x-slot name="extra_css">
    <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/DataTables/DataTables-1.10.24/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/iziToast/dist/css/iziToast.min.css') }}">
  </x-slot>

  <!-- Main Content -->
  <div class="main-content">
    <section class="section">
      <div class="section-header customs">
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dasbor</a></div>
          <div class="breadcrumb-item">Pemukiman</div>
          <div class="breadcrumb-item">Data Rumah di Kawasan Kumuh</div>
        </div>
      </div>

      <div class="section-body">

        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between mb-4">
                    <div>
                        <h4 class="card-title mb-0">Basis Data</h4>
                        <div class="small text-medium-emphasis">
                            Jumlah Rumah di Kawasan Kumuh
                        </div>
                    </div>
                    <div class="btn-toolbar d-block" role="toolbar" aria-label="Toolbar with buttons">
                        <button id="btn-create" class="btn btn-primary" data-toggle="tooltip" title="Tambah Data">
                            <i class="fas fa-plus-circle"></i>
                        </button>
                    </div>
                </div>

                <div class="table-responsive">
                  <table class="table table-striped table-bordered" id="dataTable" style="width: 100%;">
                    <thead class="bg-primary">
                      <tr>
                        <th>Kecamatan</th>
                        <th>Kelurahan</th>
                        <th>Jumlah Rumah</th>
                        <th>Jumlah KK</th>
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

  <form id="formWrapperModal" method="POST" action="" class="needs-validation" novalidate>
    @method('PATCH')
    <div class="modal fade" id="formModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header border-bottom-0">
            <h5 class="modal-title" id="formModalLabel">Tambah</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group required">
                <label>Kecamatan</label>
                <select onChange="getKelurahan(this.value);" class="form-control selectric" name="id_kecamatan" id="id_kecamatan" required>
                    <option value="">Pilih....</option>
                    @foreach ($kecamatan as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
                <div class="invalid-feedback">Kecamatan wajib diisi.</div>
            </div>
            <div class="form-group required">
                <label>Kelurahan</label>
                <select class="form-control selectric" name="id_kelurahan" id="id_kelurahan" required disabled></select>
                <div class="invalid-feedback">Kelurahan wajib diisi.</div>
            </div>
            <div class="form-group required">
                <label>Jumlah Rumah</label>
                <input type="number" name="jml_rumah" class="form-control" required>
                <div class="invalid-feedback">Jumlah Rumah wajib diisi.</div>
            </div>
            <div class="form-group required">
                <label>Jumlah KK</label>
                <input type="number" name="jml_kk" class="form-control" required>
                <div class="invalid-feedback">Jumlah KK wajib diisi.</div>
            </div>
        </div>
        <div class="modal-footer border-top-0 d-flex">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" id="btn-store" class="btn btn-dark">Simpan</button>
        </div>
        </div>
    </div>
    </div>
  </form>

  <x-slot name="extra_js">
    <script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('plugins/DataTables/DataTables-1.10.24/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script src="{{ asset('plugins/iziToast/dist/js/iziToast.min.js') }}"></script>
    <script src="{{ asset('js/plugin.js') }}"></script>
    <script>

    function getKelurahan(id, id_kel = '', disabled = false)
    {
      $('#id_kelurahan').prop('disabled', true);
      var id  = id;
      var url = '{{ route("getKelurahan", ":id") }}';
      url = url.replace(':id', id);
      $('#id_kelurahan').html(new Option('Mengambil Data.....', ''));
      $.get(url, function( response ) {
        $('#id_kelurahan').prop('disabled', false);
        $('#id_kelurahan').html(new Option('Pilih.....', ''));
        $.each(response.data, function (id, name) {
          $('#id_kelurahan').append('<option value="'+id+'" '+ ((id == id_kel) ? 'selected' : '') +'>'+name+'</option>');
        });

        if (id_kel != '') {
          $('#id_kelurahan').prop('disabled', disabled);
        }
      });
    }

    $(function() {

      var dataTable = $('#dataTable').DataTable({
        processing: true,
        // ordering: false,
        ajax: {
            url: '{{ route('admin.kawasan-kumuh.getDataTables') }}',
            data: function (d) {
                //
            }
        },
        columns: [
          {data: 'kecamatan'},
          {data: 'kelurahan'},
          {data: 'jml_rumah'},
          {data: 'jml_kk'},
          {data: null, "searchable": false},
        ],
        columnDefs  : [
          {
            targets: 4,
            render: function ( data, type, row ) {
              return '<div class="buttons"><a href="javascript:void(0);" class="btn btn-icon btn-sm btn-info btn-edit" style="width: 29px;"><i class="far fa-edit"></i></a><a href="#" data-id="'+row['id']+'" class="btn btn-icon btn-sm btn-danger btn-hapus" style="width: 29px;"><i class="fas fa-times"></i></a></div>';
            },
          },
        ]
      });

      $('#button-filter').on('click', function () {
        dataTable.ajax.reload();
      });

      $('#btn-create').click(function () {
        var url = '{{ route("admin.kawasan-kumuh.store") }}';
        $("#formWrapperModal").attr('action', url);
        $('#formModal .modal-title').text('Tambah');
        $('[name="_method"]').val('POST');
        $('#formModal').modal('show');
      });

      // Hapus
      $('#dataTable tbody').on( 'click', '.btn-hapus', function () {
        var id = $(this).data('id');
        var url = '{{ route("admin.kawasan-kumuh.destroy", ":id") }}';
        url = url.replace(':id', id);
        swal({
            title: 'Yakin ingin menghapus?',
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

      $("#formWrapperModal").submit(function(e){
        var form = $(this);
        if (form[0].checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        else {
          e.preventDefault();
          var btn = $('#btn-store');
          btn.addClass('btn-progress');
          var formData = new FormData($(this)[0]);
          formData.append('_token', '{{ csrf_token() }}');
          $.ajax({
              type: "POST",
              url: $(this).attr('action'),
              data: formData,
              processData: false,
              contentType: false,
              dataType: "json",
              success: function(data, textStatus, jqXHR) {
                $(".is-invalid").removeClass("is-invalid");
                if (data['status'] == true) {
                  swal({
                    title: "Data berhasil disimpan!",
                    icon: "success",
                  })
                  .then((value) => {
                    window.location = "{{ route('admin.kawasan-kumuh.index') }}";
                  });
                }
                else {
                  printErrorMsg(data.errors);
                }
                btn.removeClass('btn-progress');
              },
              error: function(data, textStatus, jqXHR) {
                alert('Terjadi kesalahan , Proses dibatalkan!');
              },
          });
        }
        form.addClass('was-validated');
      });

      $('#dataTable tbody').on( 'click', '.btn-edit', function () {
          var idx = $(this).parents('tr');
          var data = dataTable.row(idx).data();
          populateForm($('#formModal'), data);
          getKelurahan(data.id_kecamatan, data.id_kelurahan)
          $('#formModal .modal-title').text('Ubah');
          $('#formModal').modal('show')
          var url = '{{ route("admin.kawasan-kumuh.update", ":id") }}';
          url = url.replace(':id', data['id']);
          $("#formWrapperModal").attr('action', url);
          $('[name="_method"]').val('PATCH');
      });

    });
    </script>
  </x-slot>

</x-app-layout>
