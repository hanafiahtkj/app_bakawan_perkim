<x-app-layout>

    <x-slot name="title">Profile</x-slot>

    <x-slot name="extra_css">
        <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/leaflet/leaflet.css') }}">
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
                    <a href="{{ url('/dashboard') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>Profile</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ url('/dashboard') }}">Dasbor</a></div>
                    <div class="breadcrumb-item">Profile</div>
                </div>
            </div>

            <div class="section-body">
                <!-- <h2 class="section-title">Create New</h2>
          <p class="section-lead">
            On this page you can create a new post and fill in all fields.
          </p> -->
                <form method="POST" action="{{ route('profile-update') }}" novalidate=""
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <!-- <div class="card-header">
                    <h4>Write Your Post</h4>
                  </div> -->
                                <div class="card-body pt-5">
                                    <div class="form-group row mb-4">
                                        <label
                                            class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text"
                                                class="form-control @if ($errors->has('name')) is-invalid @endif"
                                                name="name"
                                                value="{{ old('name', isset($profile) ? $profile->name : '') }}">
                                            @if ($errors->has('name'))
                                                <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Email</label>
                      <div class="col-sm-12 col-md-7">
                        <input type="email" class="form-control @if ($errors->has('email')) is-invalid @endif" name="email" value="{{ old('email', isset($profile) ? $profile->email : '') }}" readonly>
                        @if ($errors->has('email'))
<div class="invalid-feedback">{{ $errors->first('email') }}</div>
@endif
                      </div>
                    </div> -->
                                    <div class="form-group row mb-4">
                                        <label
                                            class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Username</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="text"
                                                class="form-control @if ($errors->has('username')) is-invalid @endif"
                                                name="username"
                                                value="{{ old('username', isset($profile) ? $profile->username : '') }}"
                                                autocomplete="off">
                                            @if ($errors->has('username'))
                                                <div class="invalid-feedback">{{ $errors->first('username') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Password
                                            Lama</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="password"
                                                class="form-control @if ($errors->has('old_password')) is-invalid @endif"
                                                name="old_password">
                                            @if ($errors->has('old_password'))
                                                <div class="invalid-feedback">{{ $errors->first('old_password') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label
                                            class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Password</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="password"
                                                class="form-control @if ($errors->has('password')) is-invalid @endif"
                                                name="password">
                                            @if ($errors->has('password'))
                                                <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Password
                                            Confirmation</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="password"
                                                class="form-control @if ($errors->has('password_confirmation')) is-invalid @endif"
                                                name="password_confirmation">
                                            @if ($errors->has('password_confirmation'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('password_confirmation') }}</div>
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
                                    @role('General')
                                        <div class="form-group row mb-4" id="form-kecamatan">
                                            <label
                                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kecamatan</label>
                                            <div class="col-sm-12 col-md-7">
                                                <select
                                                    class="form-control selectric @if ($errors->has('id_kecamatan')) is-invalid @endif"
                                                    name="id_kecamatan" id="id_kecamatan" disabled>
                                                    <option value="">Pilih....</option>
                                                    @foreach ($kecamatan as $id => $name)
                                                        <option value="{{ $id }}"
                                                            {{ old('id_kecamatan', isset($profile) ? $profile->id_kecamatan : '') == $id ? 'selected' : '' }}>
                                                            {{ $name }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('id_kecamatan'))
                                                    <div class="invalid-feedback">{{ $errors->first('id_kecamatan') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row mb-4" id="form-kelurahan">
                                            <label
                                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kelurahan</label>
                                            <div class="col-sm-12 col-md-7">
                                                <select
                                                    class="form-control selectric @if ($errors->has('id_kelurahan')) is-invalid @endif"
                                                    name="id_kelurahan" id="id_kelurahan" disabled>
                                                    <option value="">Pilih....</option>
                                                </select>
                                                @if ($errors->has('id_kelurahan'))
                                                    <div class="invalid-feedback">{{ $errors->first('id_kelurahan') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row mb-4">
                                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">No
                                                Wa</label>
                                            <div class="col-sm-12 col-md-7">
                                                <input type="text"
                                                    class="form-control numeric @if ($errors->has('no_wa')) is-invalid @endif"
                                                    name="no_wa"
                                                    value="{{ old('no_wa', isset($profile) ? $profile->no_wa : '') }}"
                                                    autocomplete="off">
                                                @if ($errors->has('no_wa'))
                                                    <div class="invalid-feedback">{{ $errors->first('no_wa') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row mb-4">
                                            <label
                                                class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Pekerjaan</label>
                                            <div class="col-sm-12 col-md-7">
                                                <input type="text"
                                                    class="form-control @if ($errors->has('pekerjaan')) is-invalid @endif"
                                                    name="pekerjaan"
                                                    value="{{ old('pekerjaan', isset($profile) ? $profile->pekerjaan : '') }}"
                                                    autocomplete="off">
                                                @if ($errors->has('pekerjaan'))
                                                    <div class="invalid-feedback">{{ $errors->first('pekerjaan') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    @endrole
                                    <div class="form-group row mb-4" id="form-foto">
                                        <label
                                            class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Foto</label>
                                        <div class="col-sm-12 col-md-7">
                                            <input type="file" name="foto" class="file" accept="image/*">
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control" disabled
                                                    placeholder="Upload File" id="file">
                                                <div class="input-group-append">
                                                    <button type="button"
                                                        class="browse btn btn-primary">Browse...</button>
                                                </div>
                                            </div>
                                            <img src="{{ asset($profile->foto != null ? $profile->foto : 'img/avatar/avatar-1.png') }}"
                                                id="preview" class="img-thumbnail" style="width:250px;">
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

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Maps</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="mapid" style="height: 480px;"></div>
                </div>
                <div class="modal-footer pt-0">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                </div>
            </div>
        </div>
    </div>

    <x-slot name="extra_js">
        <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
        <script src="{{ asset('plugins/inputmask/jquery.inputmask.min.js') }}"></script>
        <script src="{{ asset('plugins/sweetalert/dist/sweetalert.min.js') }}"></script>
        <script src="{{ asset('plugins/leaflet/leaflet.js') }}"></script>
        <script>
            function printErrorMsg(msg) {
                var focus = '';
                $.each(msg, function(key, value) {
                    console.log(key);
                    $('[name="' + key + '"]').addClass('is-invalid');
                    $('.feedback-' + key).text(value);

                    if (focus == '') {
                        focus = '1';
                        $('[name="' + key + '"]').focus();
                    }
                });
            }

            $(function() {

                $('#id_kecamatan').on('change', function() {
                    // alert('ok');
                    var id_kelurahan =
                        '{{ old('id_kelurahan', isset($profile) ? $profile->id_kelurahan : '') }}';
                    var id = $(this).val();
                    var url = '{{ route('getKelurahan', ':id') }}';
                    url = url.replace(':id', id);
                    $.get(url, function(response) {
                        $('#id_kelurahan').html('');
                        $('#id_kelurahan').append(new Option('Pilih.....', ''))
                        $.each(response.data, function(id, name) {
                            // $('#id_kelurahan').append(new Option(name, id))
                            $('#id_kelurahan').append('<option value="' + id + '" ' + ((id ==
                                    id_kelurahan) ? 'selected' : '') + '>' + name +
                                '</option>');
                        })
                    });
                });

                $('#id_kecamatan').change();

                // banjarmasin = -3.317219,114.524172
                var map = L.map('mapid').setView([-3.317219, 114.524172], 13);

                L.tileLayer(
                    'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiaGFuYWZpMDciLCJhIjoiY2tubmNiY2N6MDV3ZDJvcGdrMXh3aTh3eSJ9.gHOs5sTl8lPwP-IzHYgH_g', {
                        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                        maxZoom: 18,
                        id: 'mapbox/streets-v11',
                        tileSize: 512,
                        zoomOffset: -1,
                        accessToken: 'your.mapbox.access.token'
                    }).addTo(map);

                map.on('click', onMapClick);
                var markers = [];

                function onMapClick(e) {
                    var geojsonFeature = {
                        "type": "Feature",
                        "properties": {},
                        "geometry": {
                            "type": "Point",
                            "coordinates": [e.latlng.lat, e.latlng.lng]
                        }
                    }
                    if (markers.length > 0) {
                        map.removeLayer(markers.pop());
                    }
                    var marker;
                    $('#koordinat_rumah').val(e.latlng.lat + ',' + e.latlng.lng);
                    L.geoJson(geojsonFeature, {
                        pointToLayer: function(feature, latlng) {
                            marker = L.marker(e.latlng, {
                                riseOnHover: true,
                                draggable: true,
                            });
                            markers.push(marker);
                            return marker;
                        }
                    }).addTo(map);
                }

                $('#exampleModal').on('shown.bs.modal', function() {
                    setTimeout(function() {
                        map.invalidateSize();
                    }, 10);
                });

                $('#pernah_dibantu2').on('click', function(e) {
                    $('[name="bantuan_dari"]').val('-');
                });

                $('.btn-kembali').on('click', function(e) {
                    e.preventDefault();
                    $('#myTab5 a[href="' + $(this).data('target') + '"]').tab('show');
                });

                $('.btn-lanjut').on('click', function(e) {
                    e.preventDefault();
                    var type = $(this).data('type');
                    var target = $(this).data('target');
                    var formData = new FormData($('#form-rtlh')[0]);
                    formData.append('type', type);
                    formData.append('_token', '{{ csrf_token() }}');
                    $.ajax({
                        type: "POST",
                        url: "{{ route('validasi-rtlh') }}",
                        data: formData,
                        processData: false,
                        contentType: false,
                        dataType: "json",
                        success: function(data, textStatus, jqXHR) {
                            //process data
                            $(".is-invalid").removeClass("is-invalid");
                            if (data['status'] == true) {
                                $('#myTab5 a[href="' + target + '"]').tab('show');
                            } else {
                                printErrorMsg(data.errors);
                            }
                        },
                        error: function(data, textStatus, jqXHR) {
                            alert(jqXHR + ' , Proses Dibatalkan!');
                        },
                    });
                });

                $('#tgl_lahir').daterangepicker({
                    singleDatePicker: true,
                    autoApply: true,
                    showDropdowns: true,
                    locale: {
                        format: 'DD/MM/YYYY'
                    }
                });

                $('#id_kecamatan').on('change', function() {
                    // alert('ok');
                    var id = $(this).val();
                    var url = '{{ route('getKelurahan', ':id') }}';
                    url = url.replace(':id', id);
                    $.get(url, function(response) {
                        $('#id_kelurahan').html('');
                        $('#id_kelurahan').append(new Option('Pilih.....', ''))
                        $.each(response.data, function(id, name) {
                            $('#id_kelurahan').append(new Option(name, id))
                        })
                    });
                });

                $("form#form-rtlh").submit(function(e) {
                    e.preventDefault();
                    //$('.loader').show();
                    var formData = new FormData($(this)[0]);
                    formData.append('_token', '{{ csrf_token() }}');
                    $.ajax({
                        type: "POST",
                        url: "{{ route('simpan-rtlh') }}",
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
                                        window.location = "{{ route('dashboard') }}";
                                    });
                            } else {
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
