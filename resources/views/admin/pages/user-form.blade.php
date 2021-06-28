<x-admin-layout>

  <x-slot name="title">Create New User</x-slot>

  <x-slot name="extra_css">
    <style>
      .file {
        visibility: hidden;
        position: absolute;
      }
    </style>
  </x-slot>

  <!-- Main Content -->
  <div class="main-content">
    <section class="section">
      <div class="section-header">
        <div class="section-header-back">
          <a href="{{ route('users.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Create New User</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
          <div class="breadcrumb-item"><a href="{{ url('/admin/users') }}">Users</a></div>
          <div class="breadcrumb-item">Create New Post</div>
        </div>
      </div>

      <div class="section-body">
        <!-- <h2 class="section-title">Create New Post</h2>
        <p class="section-lead">
          On this page you can create a new post and fill in all fields.
        </p> -->
        @if(isset($user))
          <form method="POST" action="{{ route('users.update', $user->id) }}" novalidate="" enctype="multipart/form-data">
          @method('PATCH')
        @else
          <form method="POST" action="{{ route('users.store') }}" novalidate="" enctype="multipart/form-data">
        @endif
        @csrf
        <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- <div class="card-header">
                <h4>Write Your Post</h4>
              </div> -->
              <div class="card-body pt-5">
                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama</label>
                  <div class="col-sm-12 col-md-7">
                    <input type="text" class="form-control @if($errors->has('name')) is-invalid @endif" name="name" value="{{ old('name', isset($user) ? $user->name : '') }}">
                    @if($errors->has('name'))
                      <div class="invalid-feedback">{{$errors->first('name')}}</div>
                    @endif
                  </div>
                </div>
                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Username</label>
                  <div class="col-sm-12 col-md-7">
                    <input type="text" class="form-control @if($errors->has('username')) is-invalid @endif" name="username" value="{{ old('username', isset($user) ? $user->username : '') }}" autocomplete="off">
                    @if($errors->has('username'))
                      <div class="invalid-feedback">{{$errors->first('username')}}</div>
                    @endif
                  </div>
                </div>
                <!-- <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Email</label>
                  <div class="col-sm-12 col-md-7">
                    <input type="email" class="form-control @if($errors->has('email')) is-invalid @endif" name="email" value="{{ old('email', isset($user) ? $user->email : '') }}">
                    @if($errors->has('email'))
                      <div class="invalid-feedback">{{$errors->first('email')}}</div>
                    @endif
                  </div>
                </div> -->
                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Password</label>
                  <div class="col-sm-12 col-md-7">
                    <input type="password" class="form-control @if($errors->has('password')) is-invalid @endif" name="password" autocomplete="off">
                    @if($errors->has('password'))
                      <div class="invalid-feedback">{{$errors->first('password')}}</div>
                    @endif
                  </div>
                </div>
                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Password Confirmation</label>
                  <div class="col-sm-12 col-md-7">
                    <input type="password" class="form-control @if($errors->has('password_confirmation')) is-invalid @endif" name="password_confirmation">
                    @if($errors->has('password_confirmation'))
                      <div class="invalid-feedback">{{$errors->first('password_confirmation')}}</div>
                    @endif
                  </div>
                </div>
                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Role</label>
                  <div class="col-sm-12 col-md-7">
                    <select class="form-control" id="id_role" name="id_role">
                      @foreach ($roles as $role)
                        <option value="{{ $role->name }}" {{ old('id_role', isset($roleName) ? $roleName : '') == $role->name ? "selected" : "" }}>{{ $role->name }}</option>
                      @endforeach
                    </select>
                    </div>
                </div>
                <div class="form-group row mb-4" id="form-kecamatan" style="display:none;">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kecamatan</label>
                  <div class="col-sm-12 col-md-7">
                    <select class="form-control selectric @if($errors->has('id_kecamatan')) is-invalid @endif" name="id_kecamatan" id="id_kecamatan">
                      <option value="">Pilih....</option>
                      @foreach ($kecamatan as $id => $name)
                          <option value="{{ $id }}" {{ old('id_kecamatan', isset($user) ? $user->id_kecamatan : '') == $id ? "selected" : "" }}>{{ $name }}</option>
                      @endforeach
                    </select>
                    @if($errors->has('id_kecamatan'))
                      <div class="invalid-feedback">{{$errors->first('id_kecamatan')}}</div>
                    @endif
                  </div>
                </div>
                <div class="form-group row mb-4" id="form-kelurahan" style="display:none;">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kelurahan</label>
                  <div class="col-sm-12 col-md-7">
                    <select class="form-control selectric @if($errors->has('id_kelurahan')) is-invalid @endif" name="id_kelurahan" id="id_kelurahan">
                      <option value="">Pilih....</option>
                    </select>
                    @if($errors->has('id_kelurahan'))
                      <div class="invalid-feedback">{{$errors->first('id_kelurahan')}}</div>
                    @endif
                  </div>
                </div>
                <div class="form-group row mb-4" id="form-wa" style="display:none;">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">No Wa</label>
                  <div class="col-sm-12 col-md-7">
                    <input type="text" class="form-control numeric @if($errors->has('no_wa')) is-invalid @endif" name="no_wa" value="{{ old('no_wa', isset($user) ? $user->no_wa : '') }}" autocomplete="off">
                    @if($errors->has('no_wa'))
                      <div class="invalid-feedback">{{$errors->first('no_wa')}}</div>
                    @endif
                  </div>
                </div>
                <div class="form-group row mb-4" id="form-pekerjaan" style="display:none;">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Pekerjaan</label>
                  <div class="col-sm-12 col-md-7">
                    <input type="text" class="form-control @if($errors->has('pekerjaan')) is-invalid @endif" name="pekerjaan" value="{{ old('pekerjaan', isset($user) ? $user->pekerjaan : '') }}" autocomplete="off">
                    @if($errors->has('pekerjaan'))
                      <div class="invalid-feedback">{{$errors->first('pekerjaan')}}</div>
                    @endif
                  </div>
                </div>
                <div class="form-group row mb-4" id="form-foto">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Foto</label>
                  <div class="col-sm-12 col-md-7">
                    <input type="file" name="foto" class="file" accept="image/*">
                    <div class="input-group mb-2">
                      <input type="text" class="form-control" disabled placeholder="Upload File" id="file">
                      <div class="input-group-append">
                        <button type="button" class="browse btn btn-primary">Browse...</button>
                      </div>
                    </div>
                    <img src="{{ asset(isset($user) ? $user->foto : 'img/avatar/avatar-1.png') }}" id="preview" class="img-thumbnail" style="width:250px;">
                  </div>
                </div>
                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                  <div class="col-sm-12 col-md-7">
                    <button class="btn btn-primary">Simpan</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        </form>
      </div>
    </section>
  </div>

  <x-slot name="extra_js">
    <script src="{{ asset('js/plugin.js') }}"></script>

    <script> 
    
      $('#id_role').on('change', function () {
        //alert('ok');
        var id = $(this).val();
        if (id == 'General') {
          $('#form-kecamatan').show();
          $('#form-kelurahan').show();
          $('#form-wa').show();
          $('#form-pekerjaan').show();
        }
        else {
          $('#form-kecamatan').hide();
          $('#form-kelurahan').hide();
          $('#form-wa').hide();
          $('#form-pekerjaan').hide();
        }
      });

      $('#id_role').change();

      $('#id_kecamatan').on('change', function () {
        // alert('ok');
        var id_kelurahan = '{{ old('id_kelurahan', isset($user) ? $user->id_kelurahan : '') }}';
        var id = $(this).val();
        var url = '{{ route("getKelurahan", ":id") }}';
        url = url.replace(':id', id);
        $('#id_kelurahan').html('');
        $('#id_kelurahan').append(new Option('Pilih.....', ''))
        $.get(url, function( response ) {
            $.each(response.data, function (id, name) {
                // $('#id_kelurahan').append(new Option(name, id))
                $('#id_kelurahan').append('<option value="'+id+'" '+ ((id == id_kelurahan) ? 'selected' : '') +'>'+name+'</option>');
            })
        });
      });

      $('#id_kecamatan').change();

      $(document).on("click", ".browse", function() {
        var file = $(this).parents().find(".file");
        file.trigger("click");
      });
      $('input[type="file"]').change(function(e) {
        var fileName = e.target.files[0].name;
        $("#file").val(fileName);

        var reader = new FileReader();
        reader.onload = function(e) {
          // get loaded data and render thumbnail.
          document.getElementById("preview").src = e.target.result;
        };
        // read the image file as a data URL.
        reader.readAsDataURL(this.files[0]);
      });
    </script>
  </x-slot>
</x-app-layout>