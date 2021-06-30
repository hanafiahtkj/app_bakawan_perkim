<x-admin-layout>

  <x-slot name="title">Setup Verifikasi Rtlh</x-slot>

  <x-slot name="extra_css">
    <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/DataTables/DataTables-1.10.24/css/dataTables.bootstrap4.min.css') }}">
  </x-slot>

  <!-- Main Content -->
  <div class="main-content" id="app">
    <section class="section">
      <div class="section-header">
        <h1>Setup Verifikasi RTLH</h1>
        <!-- <div class="section-header-button">
          <a href="{{ route('users.create') }}" class="btn btn-primary">Add New</a>
        </div> -->
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dasbor</a></div>
          <div class="breadcrumb-item">Setup Verifikasi Rtlh</div>
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
                <div class="form-group row mb-0">
                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Setup</label>
                  <div class="col-sm-12 col-md-6">
                    <select class="form-control" id="setup_id" v-model="form.id_setup" @change="getSetups()">
                      @foreach ($setups as $setup)
                        <option value="{{ $setup->id }}">{{ $setup->name }}</option>
                      @endforeach
                    </select>
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
              <div class="card-header">
                <h4>Custom Field List</h4>
                <div class="card-header-action">
                <button v-if="!is_form" type="button" class="btn btn-sm btn-info" @click="clickTambah()"><i class="fas fa-plus"></i></button>
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive" v-if="!is_form" >
                  <table class="table table-striped table-bordered" id="table-rtlh">
                      <thead>
                        <tr>
                            <th class="text-center" style="width: 30px;">#</th>
                            <th>Nama</th>
                            <th>Type</th>
                            <th>Sort Order</th>
                            <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="(setup, index) in setups" :key="index">
                          <td class="text-center">@{{ index + 1 }}</td>
                          <td>@{{ setup.name }}</td>
                          <td>@{{ setup.type }}</td>
                          <td>@{{ setup.sort_order }}</td>
                          <td>
                            <div class="buttons">
                              <button @click="clickEdit(setup.id)" class="btn btn-icon btn-sm btn-primary" style="width: 29px;"><i class="far fa-edit"></i></button>
                              <button @click="deleteSetup(setup.id)" class="btn btn-icon btn-sm btn-danger btn-hapus" style="width: 29px;"><i class="fas fa-times"></i></button>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                  </table>
                </div>

                <div v-if="is_form">
                  <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Custom Field Name</label>
                    <div class="col-sm-12 col-md-7">
                      <input type="text" class="form-control" name="name" v-model="form.name">
                    </div>
                  </div>

                  <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Type</label>
                    <div class="col-sm-12 col-md-7">
                      <select class="form-control" id="input-type" name="type" v-model="form.type">
                        <option value="file">File</option>
                        <option value="radio">Radio</option>
                      </select>
                      </div>
                  </div>

                  <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Status</label>
                    <div class="col-sm-12 col-md-7">
                      <select class="form-control" id="input-status" name="status" v-model="form.status">
                        <option value="1">Enabled</option>
                        <option value="0">Disabled</option>
                      </select>
                      </div>
                  </div>

                  <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Sort Order</label>
                    <div class="col-sm-12 col-md-7">
                      <input type="text" class="form-control" name="sort_order" v-model="form.sort_order">
                    </div>
                  </div>

                  <div class="table-responsive" v-if="form.type=='radio'">
                    <table class="table table-striped table-bordered" id="table-usersxx">
                      <thead>
                        <tr>
                          <th>Custom Field Value Name</th>
                          <th>Sort Order</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="(setup, index) in form.data" :key="index">
                          <td> 
                            <input type="text" class="form-control" v-model="setup.name">
                          </td>
                          <td> 
                            <input type="text" class="form-control" v-model="setup.sort_order">
                          </td>
                          <td>
                            <button type="button" class="btn btn-danger btn-icon" @click="deleteRow(index)"><i class="fas fa-times"></i></button>
                          </td>
                        </tr>
                        <tr>
                          <td colspan="2"> 
                          </td>
                          <td>
                            <!-- <button type="button" class="btn btn-primary" @click="submitForm()">+ Simpan</button> -->
                            <button type="button" class="btn btn-primary btn-icon" @click="tambahRow()"><i class="fas fa-plus"></i></button>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>

                  <div class="form-group row mb-4 mt-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                    <div class="col-sm-12 col-md-7">
                      <button class="btn btn-success mr-2" @click="submitForm()">Simpan</button>
                      <button class="btn btn-primary" @click="clickBatal()">Batal</button>
                    </div>
                  </div>

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
      is_form : false,
      setups : [],
      form : {
        id_setup : '',
        id : '',
        name : '',
        type : 'file',
        status : '1',
        sort_order : '',
        data : []
      }
    };

    var app = new Vue({
      el: '#app',
      data: dataVue,
      mounted () {
        // var parent_id = $('#parent_id').val();
        this.getSetups();
      },
      methods: {
        clickTambah: function () 
        {
          dataVue.is_form = true;
          dataVue.form = {
            id_setup : $('#setup_id').val(),
            id : '',
            name : '',
            type : 'file',
            status : '1',
            sort_order : '',
            data : []
          };
        },
        clickEdit: function (id) 
        {
          //this.is_form = true;
          var parent_id = id;
          if (parent_id != '') {
            var url = '{{ route("admin.getDataSetupsVerifDtl", ":id") }}';
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
                console.log(data.setup);
                //dataVue.setups = data.setups;
                dataVue.is_form = true;
                dataVue.form = {
                  id_setup : data.setup.id_setup,
                  id : data.setup.id,
                  name : data.setup.name,
                  type : data.setup.type,
                  status : data.setup.status,
                  sort_order : data.setup.sort_order,
                  data : data.setup_value
                };
              },
              error: function(data, textStatus, jqXHR) {
                //process error msg
                alert(jqXHR + ' , Proses Dibatalkan!');
              },
            });
          }
          console.log(dataVue);
        },
        clickBatal: function () 
        {
          this.is_form = false;
        },
        getSetups: function () 
        {
          dataVue.setups = [];
          var parent_id = $('#setup_id').val();
          if (parent_id != '') {
            var url = '{{ route("admin.getDataSetupsVerif", ":id") }}';
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
                dataVue.setups = data.setups;
              },
              error: function(data, textStatus, jqXHR) {
                //process error msg
                alert(jqXHR + ' , Proses Dibatalkan!');
              },
            });
          }
        },
        deleteSetup: function (id) 
        {
          var url = '{{ route("admin.setup-verif.destroy", ":id") }}';
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

                this.getSetups();
              }
            });
        },
        tambahRow: function () 
        {
          // var parent_id = $('#parent_id').val();
          this.form.data.push({
            id        : '', 
            name      : '',
            sort_order : '',
          });
        },
        deleteRow: function (index) 
        {
          console.log(index);
          console.log(this.form.data);
          this.form.data.splice(index, 1);
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
              url: "{{ route('admin.setup-verif.store') }}",
              data: formData,
              processData: false,
              contentType: false,
              dataType: "json",
              async:false,
              success: function(data, textStatus, jqXHR) {
                //process data
                $('.loader').hide();
                if (data['status'] == true) {
                  alert(data['msg']);
                  dataVue.is_form = false;
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

          this.getSetups();
        },
      }
    });
    </script>
  </x-slot>

</x-app-layout>