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
                      <a class="nav-link" data-stts="null" href="#">Menunggu <span class="badge badge-primary">{{ $tot_menunggu }}</span></a>
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

          <form method="GET" action="{{ route('export-rtlh') }}" target="_blank">
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
                        <button type="button" id="button-filter" class="btn btn-primary pull-right mr-2 mb-2"><i class="fa fa-filter"></i> Filter</button>
                        <button type="submit" target="_blank" name="type" value="excel" id="button-excel" class="btn btn-success pull-right mr-2 mb-2"><i class="fa fa-file-excel"></i> Export Excel</button>
                        <button type="submit" target="_blank" name="type" value="json" id="button-json" class="btn btn-success pull-right mb-2"><i class="far fa-copy"></i> Export JSON</button>
                      </div>
                    </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <input type="hidden" name="stts_verif" id="stts-verif" value="all">
          </form>

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

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form id="form-realisasi" method="POST" action="{{ route('real-rtlh') }}" novalidate>
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Realisasi</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="exampleFormControlSelect1">Status Realisasi</label>
              <select class="form-control" name="stts_realisasi" id="stts_realisasi">
              @foreach ($stts_realisasi as $setup)
              <option value="{{ $setup->id }}">{{ $setup->name }}</option>
              @endforeach
              </select>
            </div>
          </div>
          <div class="modal-footer pt-0">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            <input type="hidden" name="id_rtlh" id="id_rtlh" value="">
            <button type="submit" class="btn btn-success">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <x-slot name="extra_js">
    <script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('plugins/DataTables/DataTables-1.10.24/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/sweetalert/dist/sweetalert.min.js') }}"></script>
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
                d.id_kecamatan = $('#id_kecamatan').val();
                d.id_kelurahan = $('#id_kelurahan').val();
                d.jml_kk = $('#jml_kk').val();
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
              var url1 = "{{ url('/verif-rtlh') }}/" + row['id'];
              var url2 = "{{ url('/view-rtlh') }}/" + row['id'];
              var item = ((row['stts_verif'] == null)) ? '<a class="dropdown-item" href="'+url2+'">Lihat</a><a class="dropdown-item" href="'+url1+'">Verifikasi</a>' : '<a class="dropdown-item btn-batal" data-id="'+row['id']+'" href="'+url2+'">Batal Verif</a><a class="dropdown-item btn-realisasi" data-id="'+row['id']+'" href="'+url2+'">Realisasi</a>';
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

      // Hapus
      $('#table-rtlh tbody').on( 'click', '.btn-realisasi', function (e) {
        e.preventDefault();
        $('#id_rtlh').val($(this).data('id'));
        $('#exampleModal').modal('show');
        //alert('ok');
      });

      // Hapus
      $('#table-rtlh tbody').on( 'click', '.btn-batal', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var url = '{{ route("batal-verif", ":id") }}';
        url = url.replace(':id', id);
        swal({
            title: 'Yakin ingin membatalkan?',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              $.ajax({
                url: url,
                data : {_token:'{{ csrf_token() }}'},
                type : "POST",
                dataType: "json",
                cache: true,
                success: function(response) {
                  dataTable.ajax.reload();
                }
              });
            }
          });
      });
    
      $('#stts-tab .nav-link').on('click', function (e) {
        e.preventDefault();
        $('#stts-verif').val($(this).data('stts'));
        $('#stts-tab .nav-link').removeClass('active').find('.badge-white').removeClass('badge-white').addClass('badge-primary');
        $(this).addClass('active').find('.badge-primary').removeClass('badge-primary').addClass('badge-white');
        $('#table-rtlh').DataTable().ajax.reload()
        // alert('ok');
      });

      $("form#form-realisasi").submit(function(e){
        e.preventDefault();
        //$('.loader').show();
        var formData = new FormData($(this)[0]);
        formData.append('_token', '{{ csrf_token() }}');
        $.ajax({
            type: "POST",
            url: "{{ route('real-rtlh') }}",
            data: formData,
            processData: false,
            contentType: false,
            dataType: "json",
            success: function(data, textStatus, jqXHR) {
              //process data
              $(".is-invalid").removeClass("is-invalid");
              if (data['status'] == true) {
                swal({
                  title: "Tersimpan!", 
                  icon: "success",
                })
                .then((value) => {
                  dataTable.ajax.reload();
                  $('#exampleModal').modal('hide');
                  //window.location = "{{ route('dashboard') }}";
                });
              }
              else {
                printErrorMsg(data.errors);
              }
            },
            error: function(data, textStatus, jqXHR) {
              //process error msg
              //$('.loader').hide();
              alert(jqXHR + ' , Proses Dibatalkan!');
            },
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

      $('#button-filter').on('click', function () {
        dataTable.ajax.reload();
      });

    }); 
    </script>
  </x-slot>
</x-app-layout>
