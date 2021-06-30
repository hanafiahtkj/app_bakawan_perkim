<x-admin-layout>

  <x-slot name="title">Setup Rtlh</x-slot>

  <x-slot name="extra_css">
    <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/DataTables/DataTables-1.10.24/css/dataTables.bootstrap4.min.css') }}">
  </x-slot>

  <!-- Main Content -->
  <div class="main-content" id="app">
    <section class="section">
      <div class="section-header">
        <h1>Setup Rtlh</h1>
        <!-- <div class="section-header-button">
          <a href="{{ route('users.create') }}" class="btn btn-primary">Add New</a>
        </div> -->
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dasbor</a></div>
          <div class="breadcrumb-item">Setup Rtlh</div>
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

                <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Setup 1</label>
                  <div class="col-sm-12 col-md-6">
                    <select class="form-control" id="setup_id" @change="getSetups1()">
                      @foreach ($setups as $setup)
                        <option value="{{ $setup->id }}">{{ $setup->name }}</option>
                      @endforeach
                    </select>
                    </div>
                </div>

                <div class="form-group row mb-4">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Setup 2</label>
                  <div class="col-sm-12 col-md-6">
                    <select class="form-control" id="parent_id" @change="getSetups2()" v-model="parent_id">
                      <option value="">Pilih...</option>
                      <option v-for="(setup, index) in parents" :key="index" v-bind:value="setup.id">
                      @{{ setup.name }}
                      </option>
                    </select>
                    </div>
                </div>

                <div class="table-responsive">
                  <table class="table table-striped table-bordered" id="table-usersxx">
                    <thead>
                    </thead>
                    <tbody>
                      <tr v-for="(setup, index) in form.data" :key="index">
                        <td> 
                        <input type="text" class="form-control" v-model="setup.name">
                        </td>
                        <td>
                          <!-- <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" v-model="setup.status" id="defaultCheck1">
                            <label class="form-check-label" for="defaultCheck1">
                              Aktif
                            </label>
                          </div> -->
                          <button type="button" class="btn btn-danger btn-icon" @click="deleteSetup(setup.id)"><i class="fas fa-times"></i></button>
                        </td>
                      </tr>
                      <tr>
                        <td colspan="2"> 
                          <button type="button" class="btn btn-success mr-2" @click="submitForm()"><i class="fas fa-save"></i> Simpan</button>
                          <button type="button" class="btn btn-primary" @click="tambahRow()"><i class="fas fa-plus"></i> Tambah</button>
                        </td>
                      </tr>
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
    <script src="{{ asset('plugins/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script src="{{ asset('plugins/vuejs/vue.min.js') }}"></script>
    <script type="text/javascript">
    
    function buildFormData(formData, data, parentKey) {
      if (data && typeof data === 'object' && !(data instanceof Date) && !(data instanceof File)) {
        Object.keys(data).forEach(key => {
          buildFormData(formData, data[key], parentKey ? `${parentKey}[${key}]` : key);
        });
      } else {
        const value = data == null ? '' : data;

        formData.append(parentKey, value);
      }
    }

    // ----- VUE JS ----- //
    let dataVue= {
      parents : [],
      parent_id : '',
      form : {
        data : []
      }
    };

    var app = new Vue({
      el: '#app',
      data: dataVue,
      mounted () {
        // var parent_id = $('#parent_id').val();
        this.getSetups1();
      },
      methods: {
        getSetups1: function () 
        {
          // alert(parent_id);
          // var id = $(this).data('id');
          dataVue.parents = [];
          dataVue.parent_id = '';
          var parent_id = $('#setup_id').val();
          var url = '{{ route("admin.getDataSetups", ":id") }}';
          url = url.replace(':id', parent_id);
          $.ajax({
            type: "GET",
            url: url,
            data: {},
            processData: false,
            contentType: false,
            dataType: "json",
            async:false,
            success: function(data, textStatus, jqXHR) {
              //process data
              console.log(data.setups);
              dataVue.parents = data.setups;
            },
            error: function(data, textStatus, jqXHR) {
              //process error msg
              alert(jqXHR + ' , Proses Dibatalkan!');
            },
          });
          
          this.getSetups2();
        },
        getSetups2: function () 
        {
          // alert(parent_id);
          // var id = $(this).data('id');
          dataVue.form.data = [];
          var parent_id = dataVue.parent_id;
          if (parent_id != '') {
            var url = '{{ route("admin.getDataSetups", ":id") }}';
            url = url.replace(':id', parent_id);
            $.ajax({
              type: "GET",
              url: url,
              data: {},
              processData: false,
              contentType: false,
              dataType: "json",
              success: function(data, textStatus, jqXHR) {
                //process data
                console.log(data.setups);
                dataVue.form.data = data.setups;
              },
              error: function(data, textStatus, jqXHR) {
                //process error msg
                alert(jqXHR + ' , Proses Dibatalkan!');
              },
            });
          }
        },
        tambahRow: function () 
        {
          var parent_id = $('#parent_id').val();
          this.form.data.push({
            id        : '', 
            parent_id : parent_id,
            name      : '',
            status    : '1',
          });
        },
        submitForm()
        {
          //console.log(this.FORM);
          const formData = new FormData();
          formData.append('_token', '{{ csrf_token() }}');
          buildFormData(formData, this.form);
          console.log(formData);
        
          $.ajax({
              type: "POST",
              url: "{{ route('admin.setup-rtlh.store') }}",
              data: formData,
              processData: false,
              contentType: false,
              dataType: "json",
              success: function(data, textStatus, jqXHR) {
                //process data
                $('.loader').hide();
                if (data['status'] == true) {
                  alert(data['msg']);
                  this.getSetups();
                  return;
              } 
              alert(data['msg']);
              },
              error: function(data, textStatus, jqXHR) {
                //process error msg
                $('.loader').hide();
                alert(jqXHR + ' , Proses Dibatalkan!');
              },
          });
        },
        deleteSetup: function (id) 
        {
          var url = '{{ route("admin.setup-rtlh.destroy", ":id") }}';
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
                  type : "POST",
                  dataType: "json",
                  cache: true,
                  async:false,
                  success: function(response) {
                    //dataTable.ajax.reload();
                  }
                });

                this.getSetups2();
              }
            });
        },
      }
    });
    </script>
  </x-slot>

</x-app-layout>