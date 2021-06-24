<x-admin-layout>

  <x-slot name="title">My Profile</x-slot>

  <x-slot name="extra_css">
    <link rel="stylesheet" href="{{ asset('plugins/izitoast/dist/css/iziToast.min.css') }}">
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
        <h1>My Profile</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
          <div class="breadcrumb-item">My Profile</div>
        </div>
      </div>

      <div class="section-body">
        <!-- <h2 class="section-title">Create New Post</h2>
        <p class="section-lead">
          On this page you can create a new post and fill in all fields.
        </p> -->
        <form method="POST" action="{{ route('admin.profile-update') }}" novalidate="" enctype="multipart/form-data">
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
                    <input type="text" class="form-control @if($errors->has('name')) is-invalid @endif" name="name" value="{{ old('name', isset($profile) ? $profile->name : '') }}">
                    @if($errors->has('name'))
                      <div class="invalid-feedback">{{$errors->first('name')}}</div>
                    @endif
                  </div>
                </div>
                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Username</label>
                  <div class="col-sm-12 col-md-7">
                    <input type="text" class="form-control @if($errors->has('username')) is-invalid @endif" name="username" value="{{ old('username', isset($profile) ? $profile->username : '') }}" autocomplete="off">
                    @if($errors->has('username'))
                      <div class="invalid-feedback">{{$errors->first('username')}}</div>
                    @endif
                  </div>
                </div>
                <!-- <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Email</label>
                  <div class="col-sm-12 col-md-7">
                    <input type="email" class="form-control @if($errors->has('email')) is-invalid @endif" name="email" value="{{ old('email', isset($profile) ? $profile->email : '') }}" readonly>
                    @if($errors->has('email'))
                      <div class="invalid-feedback">{{$errors->first('email')}}</div>
                    @endif
                  </div>
                </div> -->
                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Password</label>
                  <div class="col-sm-12 col-md-7">
                    <input type="password" class="form-control @if($errors->has('password')) is-invalid @endif" name="password">
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
                <!-- <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Role</label>
                  <div class="col-sm-12 col-md-7">
                    <input type="text" class="form-control">
                  </div>
                </div>
                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Keterangan</label>
                  <div class="col-sm-12 col-md-7">
                    <textarea class="form-control" rows="5"></textarea>
                  </div>
                </div>
                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Status</label>
                  <div class="col-sm-12 col-md-7">
                    <select class="form-control selectric">
                      <option>Publish</option>
                      <option>Draft</option>
                      <option>Pending</option>
                    </select>
                  </div>
                </div> -->
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
                    <img src="{{ asset(($profile->foto != null) ? $profile->foto : 'img/avatar/avatar-1.png') }}" id="preview" class="img-thumbnail" style="width:250px;">
                  </div>
                </div>
                <div class="form-group row mb-4">
                  <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                  <div class="col-sm-12 col-md-7">
                    <input type="hidden" name="id" value="{{ $profile->id }}">
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
    <script src="{{ asset('plugins/izitoast/dist/js/iziToast.min.js') }}"></script>
    <script>
    $(function() {

      @if (session('success'))
        iziToast.success({
          title: 'Success!',
          message: 'Data profile berhasil disimpan...',
          position: 'topRight'
        });
      @endif

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

    });
    </script>
  </x-slot>
</x-app-layout>