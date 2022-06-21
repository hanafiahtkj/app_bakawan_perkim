<x-admin-layout>

  <x-slot name="title">Tambah Data</x-slot>

  <x-slot name="extra_css">
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/leaflet/leaflet.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/leaflet-groupedlayercontrol/dist/leaflet.groupedlayercontrol.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/Leaflet.markercluster-1.4.1/dist/MarkerCluster.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/Leaflet.markercluster-1.4.1/dist/MarkerCluster.Default.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/leaflet-locatecontrol/dist/L.Control.Locate.min.css') }}" />
  </x-slot>

  <!-- Main Content -->
  <div class="main-content">
      <section class="section">
        <div class="section-header">
          <div class="section-header-back">
            <a href="{{ route('admin.rtlh') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
          </div>
          <h1>Tambah Data</h1>
          <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dasbor</a></div>
            <div class="breadcrumb-item">Tambah Data</div>
          </div>
        </div>

        <div class="section-body">
          <!-- <h2 class="section-title">Create New</h2>
          <p class="section-lead">
            On this page you can create a new post and fill in all fields.
          </p> -->
          <form id="form-rtlh" method="POST" action="{{ route('simpan-rtlh') }}" novalidate>
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>DATA RTLH</h4>
                  </div>
                  <div class="card-body">
                    <ul class="nav nav-tabs nav-justified" id="myTab5" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link disabled active" id="identitas-tab" data-toggle="tab" href="#identitas" role="tab" aria-controls="identitas" aria-selected="true">
                          1. Identitas Diri</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link disabled" id="kondisi-tab" data-toggle="tab" href="#kondisi" role="tab" aria-controls="kondisi" aria-selected="false">
                          2. Kondisi Rumah</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link disabled" id="kelayakan-tab" data-toggle="tab" href="#kelayakan" role="tab" aria-controls="kelayakan" aria-selected="false">
                          3. Kelayakan Rumah</a>
                      </li>
                    </ul>
                    <div class="tab-content tab-bordered" id="myTabContent6">
                      <div class="tab-pane fade show active" id="identitas" role="tabpanel" aria-labelledby="identitas-tab">
                        <div class="form-group row mb-4">
                          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">NIK / No.KTP</label>
                          <div class="col-sm-12 col-md-7">
                            <input type="text" class="form-control numeric" onkeyup="cek_length(this);" name="nik" id="form-nik">
                            <div class="invalid-feedback feedback-nik"></div>
                          </div>
                          <!-- <div class="col-sm-12 col-md-2">
                            <div class="spinner-border spinner-border-sm" role="status">
                              <span class="sr-only">Loading...</span>
                            </div>
                          </div> -->
                        </div>
                        
                        <div class="form-group row mb-4">
                          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">No.KK</label>
                          <div class="col-sm-12 col-md-7">
                            <input type="text" class="form-control numeric" name="no_kk" id="form-no_kk">
                            <div class="invalid-feedback feedback-no_kk"></div>
                          </div>
                        </div>

                        <div class="form-group row mb-4">
                          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Lengkap</label>
                          <div class="col-sm-12 col-md-7">
                            <input type="text" class="form-control" name="nama_lengkap">
                            <div class="invalid-feedback feedback-nama_lengkap"></div>
                          </div>
                        </div>
                        @hasrole('General')
                        <div class="form-group row mb-4">
                          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kecamatan</label>
                          <div class="col-sm-12 col-md-7">
                            <select class="form-control selectric" id="id_kecamatan" disabled>
                              <option value="">Pilih....</option>
                              @foreach ($kecamatan as $id => $name)
                                  <option value="{{ $id }}" {{ ($profile->id_kecamatan == $id) ? "selected" : "" }}>{{ $name }}</option>
                              @endforeach
                            </select>
                            <input type="hidden" name="id_kecamatan" id="id_kecamatan" value="{{ $profile->id_kecamatan }}"/>
                            <div class="invalid-feedback feedback-id_kecamatan"></div>
                          </div>
                        </div>
                        <div class="form-group row mb-4">
                          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kelurahan</label>
                          <div class="col-sm-12 col-md-7">
                            <select class="form-control selectric" id="id_kelurahan" disabled>
                              <option value="">Pilih....</option>
                            </select>
                            <input type="hidden" name="id_kelurahan" value="{{ $profile->id_kelurahan }}"/>
                            <div class="invalid-feedback feedback-id_kelurahan"></div>
                          </div>
                        </div>
                        @else
                        <div class="form-group row mb-4">
                          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kecamatan</label>
                          <div class="col-sm-12 col-md-7">
                            <select class="form-control selectric" name="id_kecamatan" id="id_kecamatan">
                              <option value="">Pilih....</option>
                              @foreach ($kecamatan as $id => $name)
                                  <option value="{{ $id }}">{{ $name }}</option>
                              @endforeach
                            </select>
                            <div class="invalid-feedback feedback-id_kecamatan"></div>
                          </div>
                        </div>
                        <div class="form-group row mb-4">
                          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kelurahan</label>
                          <div class="col-sm-12 col-md-7">
                            <select class="form-control selectric" name="id_kelurahan" id="id_kelurahan">
                              <option value="">Pilih....</option>
                            </select>
                            <div class="invalid-feedback feedback-id_kelurahan"></div>
                          </div>
                        </div>
                        @endhasrole
                        <div class="form-group row mb-4">
                          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Alamat Lengkap</label>
                          <div class="col-sm-12 col-md-7">
                            <textarea class="form-control selectric" name="alamat_lengkap" rows="3" style="height: 100px;"></textarea>
                            <div class="invalid-feedback feedback-alamat_lengkap"></div>
                          </div>
                        </div>
                        <div class="form-group row mb-4">
                          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tanggal Lahir</label>
                          <div class="col-sm-12 col-md-7">
                            <input type="text" class="form-control" name="tgl_lahir" id="tgl_lahir" readonly>
                            <div class="invalid-feedback feedback-tgl_lahir"></div>
                          </div>
                        </div>
                        <div class="form-group row mb-4">
                          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Jenis Kelamin</label>
                          <div class="col-sm-12 col-md-7">
                            @foreach ($jenis_kel as $setup)
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" name="jenis_kelamin" type="radio" id="inlineradio{{ $setup->id }}" value="{{ $setup->id }}">
                              <label class="form-check-label" for="inlineradio{{ $setup->id }}">{{ $setup->name }}</label>
                            </div>
                            @endforeach
                            <div class="invalid-feedback feedback-jenis_kelamin"></div>
                          </div>
                        </div>
                        <div class="form-group row mb-4">
                          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Jenis Pekerjaan</label>
                          <div class="col-sm-12 col-md-7">
                            <select class="form-control selectric" name="jenis_pekerjaan">
                              <option value="">Pilih.....</option>
                              @foreach ($jenis_pek as $setup)
                              <option value="{{ $setup->id }}">{{ $setup->name }}</option>
                              @endforeach
                            </select>
                            <div class="invalid-feedback feedback-jenis_pekerjaan"></div>
                          </div>
                        </div>
                        <div class="form-group row mb-4">
                          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Pendidikan Terakhir</label>
                          <div class="col-sm-12 col-md-7">
                            <select class="form-control selectric" name="pendidikan">
                              <option value="">Pilih.....</option>
                              @foreach ($pendidikan as $setup)
                              <option value="{{ $setup->id }}">{{ $setup->name }}</option>
                              @endforeach
                            </select>
                            <div class="invalid-feedback feedback-pendidikan"></div>
                          </div>
                        </div>
                        <div class="form-group row mb-4">
                          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Jumlah Penghasilan</label>
                          <div class="col-sm-12 col-md-7">
                            <select class="form-control selectric" name="jml_penghasilan">
                              <option value="">Pilih.....</option>
                              @foreach ($jml_penghasilan as $setup)
                              <option value="{{ $setup->id }}">{{ $setup->name }}</option>
                              @endforeach
                            </select>
                            <div class="invalid-feedback feedback-jml_penghasilan"></div>
                          </div>
                        </div>
                        <div class="form-group row mb-4">
                          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Pernah Mendapat Bantuan Perumahan / Sejenis</label>
                          <div class="col-sm-12 col-md-7">
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" name="pernah_dibantu" type="radio" id="pernah_dibantu1" value="1">
                              <label class="form-check-label" for="pernah_dibantu1">Ya</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" name="pernah_dibantu" type="radio" id="pernah_dibantu2" value="0">
                              <label class="form-check-label" for="pernah_dibantu2">Tidak</label>
                            </div>
                          </div>
                        </div>
                        <div class="form-group row mb-4">
                          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Jika Pernah dapat bantuan, dari :</label>
                          <div class="col-sm-12 col-md-7">
                            <input type="text" class="form-control" name="bantuan_dari">
                            <div class="invalid-feedback feedback-bantuan_dari"></div>
                          </div>
                        </div>
                        <div class="form-group row mb-4">
                          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                          <div class="col-sm-12 col-md-7 text-right">
                            <button type="button" class="btn btn-primary btn-lanjut" data-type="identitas" data-target="#kondisi">Lanjut <i class="fas fa-angle-double-right"></i></button>
                          </div>
                        </div>
                      </div>
                      <div class="tab-pane fade" id="kondisi" role="tabpanel" aria-labelledby="kondisi-tab">
                        <div class="form-group row mb-4">
                          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Jumlah KK dalam rumah</label>
                          <div class="col-sm-12 col-md-7">
                            <input type="text" class="form-control numeric" name="jml_kk">
                            <div class="invalid-feedback feedback-jml_kk"></div>
                          </div>
                        </div>
                        <div class="form-group row mb-4">
                          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Jumlah Penghuni</label>
                          <div class="col-sm-12 col-md-7">
                            <input type="text" class="form-control numeric" name="jml_penghuni">
                            <div class="invalid-feedback feedback-jml_penghuni"></div>
                          </div>
                        </div>
                        <div class="form-group row mb-4">
                          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Luas Rumah (Panjang / Lebar)</label>
                          <div class="col-sm-12 col-md-3">
                            <input type="text" class="form-control numeric" name="panjang1" placeholder="Panjang">
                            <div class="invalid-feedback feedback-panjang1"></div>
                          </div>
                          <div class="col-sm-12 col-md-3">
                            <input type="text" class="form-control numeric" name="lebar1" placeholder="Lebar">
                            <div class="invalid-feedback feedback-lebar1"></div>
                          </div>
                        </div>
                        <div class="form-group row mb-4">
                          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Fungsi Ruang</label>
                          <div class="col-sm-12 col-md-7">
                            <select class="form-control selectric" name="fungsi_ruang">
                              <option value="">Pilih.....</option>
                              @foreach ($fungsi_ruang as $setup)
                              <option value="{{ $setup->id }}">{{ $setup->name }}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                        <div class="form-group row mb-4">
                          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Status Kepemilikan tanah</label>
                          <div class="col-sm-12 col-md-7">
                            <select class="form-control selectric" name="stts_tanah">
                              <option value="">Pilih.....</option>
                              @foreach ($stts_tanah as $setup)
                              <option value="{{ $setup->id }}">{{ $setup->name }}</option>
                              @endforeach
                            </select>
                            <div class="invalid-feedback feedback-stts_tanah"></div>
                          </div>
                        </div>
                        <div class="form-group row mb-4">
                          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Status Kepemilikan rumah</label>
                          <div class="col-sm-12 col-md-7">
                            <select class="form-control selectric" name="stts_rumah">
                              <option value="">Pilih.....</option>
                              @foreach ($stts_rumah as $setup)
                              <option value="{{ $setup->id }}">{{ $setup->name }}</option>
                              @endforeach
                            </select>
                            <div class="invalid-feedback feedback-stts_rumah"></div>
                          </div>
                        </div>
                        <div class="form-group row mb-4">
                          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Aset tanah di tempat lain</label>
                          <div class="col-sm-12 col-md-7">
                            <select class="form-control selectric" name="stts_tanah_lain">
                              <option value="">Pilih.....</option>
                              @foreach ($stts_tanah_lain as $setup)
                              <option value="{{ $setup->id }}">{{ $setup->name }}</option>
                              @endforeach
                            </select>
                            <div class="invalid-feedback feedback-stts_tanah_lain"></div>
                          </div>
                        </div>
                        <div class="form-group row mb-4">
                          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Aset rumah di tempat lain</label>
                          <div class="col-sm-12 col-md-7">
                            <select class="form-control selectric" name="stts_rumah_lain">
                              <option value="">Pilih.....</option>
                              @foreach ($stts_rumah_lain as $setup)
                              <option value="{{ $setup->id }}">{{ $setup->name }}</option>
                              @endforeach
                            </select>
                            <div class="invalid-feedback feedback-stts_rumah_lain"></div>
                          </div>
                        </div>
                        <div class="form-group row mb-4">
                          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Bukti Kepemilikan</label>
                          <div class="col-sm-12 col-md-7">
                            @foreach ($bukti_kepemilikan as $setup)
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" name="bukti_kepemilikan[]" type="checkbox" id="inlineCheckbox{{ $setup->id }}" value="{{ $setup->id }}">
                                <label class="form-check-label" for="inlineCheckbox{{ $setup->id }}">{{ $setup->name }}</label>
                              </div>
                            @endforeach
                          </div>
                        </div>
                        <div class="form-group row mb-4">
                          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Foto 0 % Bangunan</label>
                          <div class="col-sm-12 col-md-7">
                            <input type="file" class="form-control" name="foto_bangunan">
                            <div class="invalid-feedback feedback-foto_bangunah"></div>
                          </div>
                        </div>
                        <div class="form-group row mb-4">
                          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Koordinat Rumah</label>
                          <div class="col-sm-12 col-md-7">
                            <!-- <input type="text" class="form-control" name="koordinat_rumah"> -->
                            <div class="input-group mb-3">
                              <input type="text" class="form-control" name="koordinat_rumah" id="koordinat_rumah" value="" placeholder="latitude, longitude">
                              <div class="input-group-append">
                                <button class="btn btn-success" type="button" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-map-marker-alt"></i></button>
                              </div>
                            </div>
                            <div class="invalid-feedback feedback-koordinat_rumah"></div>
                          </div>
                        </div>
                        <div class="form-group row mb-4">
                          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                          <div class="col-sm-6 col-md-3">
                          <button type="button" class="btn btn-secondary btn-kembali" data-target="#identitas"><i class="fas fa-angle-double-left"></i> Kembali</button>
                          </div>
                          <div class="col-sm-6 col-md-4 text-right">
                          <button type="button" class="btn btn-primary btn-lanjut" data-type="kondisi" data-target="#kelayakan">Lanjut <i class="fas fa-angle-double-right"></i></button>
                          </div>
                        </div>
                      </div>
                      <div class="tab-pane fade" id="kelayakan" role="tabpanel" aria-labelledby="kelayakan-tab">
                        <div class="form-group row mb-4">
                          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Pondasi</label>
                          <div class="col-sm-12 col-md-7">
                            @foreach ($pondasi as $setup)
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" name="pondasi" type="radio" id="inlineradio{{ $setup->id }}" value="{{ $setup->id }}">
                                <label class="form-check-label" for="inlineradio{{ $setup->id }}">{{ $setup->name }}</label>
                              </div>
                            @endforeach
                          </div>
                        </div>
                        <div class="form-group row mb-4">
                          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kondisi Kolom</label>
                          <div class="col-sm-12 col-md-7">
                            @foreach ($kondisi_kolom as $setup)
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" name="kondisi_kolom" type="radio" id="inlineradio{{ $setup->id }}" value="{{ $setup->id }}">
                                <label class="form-check-label" for="inlineradio{{ $setup->id }}">{{ $setup->name }}</label>
                              </div>
                            @endforeach
                          </div>
                        </div>
                        <div class="form-group row mb-4">
                          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kondisi Konstruksi Atap</label>
                          <div class="col-sm-12 col-md-7">
                            @foreach ($kondisi_konstruksi as $setup)
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" name="kondisi_konstruksi" type="radio" id="inlineradio{{ $setup->id }}" value="{{ $setup->id }}">
                                <label class="form-check-label" for="inlineradio{{ $setup->id }}">{{ $setup->name }}</label>
                              </div>
                            @endforeach
                          </div>
                        </div>
                        <div class="form-group row mb-4">
                          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Jendela / Lubang Cahaya</label>
                          <div class="col-sm-12 col-md-7">
                            @foreach ($jendela as $setup)
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" name="jendela" type="radio" id="inlineradio{{ $setup->id }}" value="{{ $setup->id }}">
                                <label class="form-check-label" for="inlineradio{{ $setup->id }}">{{ $setup->name }}</label>
                              </div>
                            @endforeach
                          </div>
                        </div>
                        <div class="form-group row mb-4">
                          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Ventilasi</label>
                          <div class="col-sm-12 col-md-7">
                            @foreach ($ventilasi as $setup)
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" name="ventilasi" type="radio" id="inlineradio{{ $setup->id }}" value="{{ $setup->id }}">
                                <label class="form-check-label" for="inlineradio{{ $setup->id }}">{{ $setup->name }}</label>
                              </div>
                            @endforeach
                          </div>
                        </div>
                        <div class="form-group row mb-4">
                          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kepemilikan Kamar Mandi dan WC</label>
                          <div class="col-sm-12 col-md-7">
                            <select class="form-control selectric" name="stts_wc">
                              <option value="">Pilih.....</option>
                              @foreach ($stts_wc as $setup)
                              <option value="{{ $setup->id }}">{{ $setup->name }}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                        <div class="form-group row mb-4">
                          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Jarak Sumber Air Minum ke TPA Tinja</label>
                          <div class="col-sm-12 col-md-7">
                            <select class="form-control selectric" name="jarak_air_tpa">
                              <option value="">Pilih.....</option>
                              @foreach ($jarak_air_tpa as $setup)
                              <option value="{{ $setup->id }}">{{ $setup->name }}</option>
                              @endforeach
                            </select>
                            <div class="invalid-feedback feedback-jarak_air_tpa"></div>
                          </div>
                        </div>
                        <div class="form-group row mb-4">
                          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Jenis Kloset</label>
                          <div class="col-sm-12 col-md-7">
                            <select class="form-control selectric" name="jenis_kloset">
                              <option value="">Pilih.....</option>
                              @foreach ($jenis_kloset as $setup)
                              <option value="{{ $setup->id }}">{{ $setup->name }}</option>
                              @endforeach
                            </select>
                            <div class="invalid-feedback feedback-jenis_kloset"></div>
                          </div>
                        </div>
                        <div class="form-group row mb-4">
                          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Jenis TPA</label>
                          <div class="col-sm-12 col-md-7">
                            <select class="form-control selectric" name="jenis_tpa">
                              <option value="">Pilih.....</option>
                              @foreach ($jenis_tpa as $setup)
                              <option value="{{ $setup->id }}">{{ $setup->name }}</option>
                              @endforeach
                            </select>
                            <div class="invalid-feedback feedback-jenis_tpa"></div>
                          </div>
                        </div>
                        <div class="form-group row mb-4">
                          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Sumbe Air Minum</label>
                          <div class="col-sm-12 col-md-7">
                            <select class="form-control selectric" name="sumber_air_minum">
                              <option value="">Pilih.....</option>
                              @foreach ($sumber_air_minum as $setup)
                              <option value="{{ $setup->id }}">{{ $setup->name }}</option>
                              @endforeach
                            </select>
                            <div class="invalid-feedback feedback-sumber_air_minum"></div>
                          </div>
                        </div>
                        <div class="form-group row mb-4">
                          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Sumber Listrik</label>
                          <div class="col-sm-12 col-md-7">
                            <select class="form-control selectric" name="sumber_listrik">
                              <option value="">Pilih.....</option>
                              @foreach ($sumber_listrik as $setup)
                              <option value="{{ $setup->id }}">{{ $setup->name }}</option>
                              @endforeach
                            </select>
                            <div class="invalid-feedback feedback-sumber_listrik"></div>
                          </div>
                        </div>
                        <div class="form-group row mb-4">
                          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Luas Tanah (Panjang / Lebar)</label>
                          <div class="col-sm-12 col-md-3">
                            <input type="text" class="form-control numeric" name="panjang2" placeholder="Panjang">
                            <div class="invalid-feedback feedback-panjang2"></div>
                          </div>
                          <div class="col-sm-12 col-md-3">
                            <input type="text" class="form-control numeric" name="lebar2" placeholder="Lebar">
                            <div class="invalid-feedback feedback-lebar2"></div>
                          </div>
                        </div>
                        <div class="form-group row mb-4">
                          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Material Atap</label>
                          <div class="col-sm-12 col-md-7">
                            <select class="form-control selectric" name="material_atap">
                              <option value="">Pilih.....</option>
                              @foreach ($material_atap as $setup)
                              <option value="{{ $setup->id }}">{{ $setup->name }}</option>
                              @endforeach
                            </select>
                            <div class="invalid-feedback feedback-material_atap"></div>
                          </div>
                        </div>
                        <div class="form-group row mb-4">
                          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kondisi Atap</label>
                          <div class="col-sm-12 col-md-7">
                            @foreach ($kondisi_atap as $setup)
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" name="kondisi_atap" type="radio" id="inlineradio{{ $setup->id }}" value="{{ $setup->id }}">
                                <label class="form-check-label" for="inlineradio{{ $setup->id }}">{{ $setup->name }}</label>
                              </div>
                            @endforeach
                          </div>
                        </div>
                        <div class="form-group row mb-4">
                          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Material Dinding Terluas</label>
                          <div class="col-sm-12 col-md-7">
                            <select class="form-control selectric" name="material_dinding">
                              <option value="">Pilih.....</option>
                              @foreach ($material_dinding as $setup)
                              <option value="{{ $setup->id }}">{{ $setup->name }}</option>
                              @endforeach
                            </select>
                            <div class="invalid-feedback feedback-material_dinding"></div>
                          </div>
                        </div>
                        <div class="form-group row mb-4">
                          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kondisi Dinding</label>
                          <div class="col-sm-12 col-md-7">
                            @foreach ($kondisi_dinding as $setup)
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" name="kondisi_dinding" type="radio" id="inlineradio{{ $setup->id }}" value="{{ $setup->id }}">
                                <label class="form-check-label" for="inlineradio{{ $setup->id }}">{{ $setup->name }}</label>
                              </div>
                            @endforeach
                          </div>
                        </div>
                        <div class="form-group row mb-4">
                          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Material Lantai Terluas</label>
                          <div class="col-sm-12 col-md-7">
                            <select class="form-control selectric" name="material_lantai">
                              <option value="">Pilih.....</option>
                              @foreach ($material_lantai as $setup)
                              <option value="{{ $setup->id }}">{{ $setup->name }}</option>
                              @endforeach
                            </select>
                            <div class="invalid-feedback feedback-material_lantai"></div>
                          </div>
                        </div>
                        <div class="form-group row mb-4">
                          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kondisi Lantai</label>
                          <div class="col-sm-12 col-md-7">
                            @foreach ($kondisi_lantai as $setup)
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" name="kondisi_lantai" type="radio" id="inlineradio{{ $setup->id }}" value="{{ $setup->id }}">
                                <label class="form-check-label" for="inlineradio{{ $setup->id }}">{{ $setup->name }}</label>
                              </div>
                            @endforeach
                          </div>
                        </div>
                        <div class="form-group row mb-4">
                          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kondisi Plafon</label>
                          <div class="col-sm-12 col-md-7">
                            @foreach ($kondisi_plafon as $setup)
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" name="kondisi_plafon" type="radio" id="inlineradio{{ $setup->id }}" value="{{ $setup->id }}">
                                <label class="form-check-label" for="inlineradio{{ $setup->id }}">{{ $setup->name }}</label>
                              </div>
                            @endforeach
                          </div>
                        </div>
                        <div class="form-group row mb-4">
                          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kondisi Balok</label>
                          <div class="col-sm-12 col-md-7">
                            @foreach ($kondisi_balok as $setup)
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" name="kondisi_balok" type="radio" id="inlineradio{{ $setup->id }}" value="{{ $setup->id }}">
                                <label class="form-check-label" for="inlineradio{{ $setup->id }}">{{ $setup->name }}</label>
                              </div>
                            @endforeach
                          </div>
                        </div>
                        <div class="form-group row mb-4">
                          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kondisi Sloof</label>
                          <div class="col-sm-12 col-md-7">
                            @foreach ($kondisi_sloof as $setup)
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" name="kondisi_sloof" type="radio" id="inlineradio{{ $setup->id }}" value="{{ $setup->id }}">
                                <label class="form-check-label" for="inlineradio{{ $setup->id }}">{{ $setup->name }}</label>
                              </div>
                            @endforeach
                          </div>
                        </div>
                        <div class="form-group row mb-4">
                          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kawasan Rumah</label>
                          <div class="col-sm-12 col-md-7">
                            <select class="form-control selectric" name="kawasan_rumah">
                              <option value="">Pilih.....</option>
                              @foreach ($kawasan_rumah as $setup)
                              <option value="{{ $setup->id }}">{{ $setup->name }}</option>
                              @endforeach
                            </select>
                            <div class="invalid-feedback feedback-kawasan_rumah"></div>
                          </div>
                        </div>
                        <div class="form-group row mb-4">
                          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                          <div class="col-sm-6 col-md-3">
                            <button type="button" class="btn btn-secondary btn-kembali mr-2" data-target="#kondisi"><i class="fas fa-angle-double-left"></i> Kembali</button>
                            <!-- <button class="btn btn-success" type="submit"> <i class="fas fa-save"></i> Simpan</button> -->
                            <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                              Launch demo modal
                            </button> -->
                          </div>
                          <div class="col-sm-6 col-md-4 text-right">
                            <input type="hidden" id="is_old" name="is_old">
                            <button id="btn-simpan" class="btn btn-success" type="submit"> <i class="fas fa-save"></i> Simpan</button>
                          </div>
                        </div>
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
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
    <script src="{{ asset('plugins/leaflet-groupedlayercontrol/dist/leaflet.groupedlayercontrol.min.js') }}"></script>
    <script src="{{ asset('plugins/leaflet-groupedlayercontrol/example/exampledata.js') }}"></script>
    <script src="{{ asset('plugins/Leaflet.markercluster-1.4.1/dist/leaflet.markercluster.js') }}"></script>
    <script src="{{ asset('js/plugin.js') }}"></script>
    <script src="{{ asset('plugins/leaflet-locatecontrol/dist/L.Control.Locate.min.js') }}" charset="utf-8"></script>
    <script>

    function cek_length(obj) {
      console.log('ok');
      // var url = '{{ route("rtlh-by-nik", ":id") }}';
      // var value = $(obj).val();
      // url = url.replace(':id', value);

      // $.getJSON(url, function(result){
      //   if (result.status == true) {
      //     //$(obj).prop('readonly', true);
      //     $('#is_old').val(1);
      //     populateForm($('#form-rtlh'), result.rtlh);
      //   }
      // });

    }

    function printErrorMsg (msg, idForm = '') {
      var focus = '';
      $.each( msg, function( key, value ) {
        console.log(key);
        // $('[name="'+key+'"]').addClass('is-invalid');
        // $('.feedback-'+key).text(value);

        var obj = $(((idForm != '') ? idForm + ' ' : '') + '[name="'+key+'"]');
        obj.removeClass('is-invalid');
        obj.addClass('is-invalid');
        obj.siblings('.invalid-feedback').text(value);
        obj.removeClass('is-valid');

        if (focus == '') {
          focus = '1';
          $('[name="'+key+'"]').focus();
        }
      });
    }

    function printRequired(validasi) {
      var focus = '';
      $.each( validasi, function( key, value ) {
        //console.log(key);
        $('[name="'+key+'"]').parents('.form-group').addClass('required');
      });
    }

    $(function() {
      // get all validasi
      $.ajax({
            type: "GET",
            url: "{{ route('get-all-validasi') }}",
            //data: formData,
            // processData: false,
            // contentType: false,
            dataType: "json",
            success: function(data, textStatus, jqXHR) {
                printRequired(data.validasi);
            },
            error: function(data, textStatus, jqXHR) {
              //alert(jqXHR + ' , Proses Dibatalkan!');
            },
      });

      $('#id_kecamatan').on('change', function () {
        // alert('ok');
        var id_kelurahan = '{{ old('id_kelurahan', isset($profile) ? $profile->id_kelurahan : '') }}';
        var id = $(this).val();
        var url = '{{ route("getKelurahan", ":id") }}';
        url = url.replace(':id', id);
        $.get(url, function( response ) {
            $('#id_kelurahan').html('');
            $('#id_kelurahan').append(new Option('Pilih.....', ''))
            $.each(response.data, function (id, name) {
                // $('#id_kelurahan').append(new Option(name, id))
                $('#id_kelurahan').append('<option value="'+id+'" '+ ((id == id_kelurahan) ? 'selected' : '') +'>'+name+'</option>');
            })
        });
      });

      $('#id_kecamatan').change();

      $('#pernah_dibantu2').on('click', function (e) {
        $('[name="bantuan_dari"]').val('-');
      });
      
      $('.btn-kembali').on('click', function (e) {
        e.preventDefault();
        var target = $(this).data('target');
        $(target+'-tab').removeClass('disabled');
        $('#myTab5 a[href="'+$(this).data('target')+'"]').tab('show');
        $(target+'-tab').addClass('disabled');
      });

      $('.btn-lanjut').on('click', function (e) {
        e.preventDefault();
        var btn = $(this);
        btn.addClass('btn-progress');
        var type = $(this).data('type');
        var target = $(this).data('target');
        var formData = new FormData($('#form-rtlh')[0]);
        formData.append('type', type);
        formData.append('_token', '{{ csrf_token() }}');
        $.ajax({
            type: "POST",
            url: "{{ route('admin.validasi-rtlh') }}",
            data: formData,
            processData: false,
            contentType: false,
            dataType: "json",
            success: function(data, textStatus, jqXHR) {
              //process data
              $(".is-invalid").removeClass("is-invalid");
              if (data['status'] == true) {
                $(target+'-tab').removeClass('disabled');
                $('#myTab5 a[href="'+target+'"]').tab('show');
                $(target+'-tab').addClass('disabled');
              }
              else {
                printErrorMsg(data.errors);
              }
              btn.removeClass('btn-progress');
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

      $('#id_kecamatan').on('change', function () {
        // alert('ok');
        var id = $(this).val();
        var url = '{{ route("getKelurahan", ":id") }}';
        url = url.replace(':id', id);
        $.get(url, function( response ) {
            $('#id_kelurahan').html('');
            $('#id_kelurahan').append(new Option('Pilih.....', ''))
            $.each(response.data, function (id, name) {
                $('#id_kelurahan').append(new Option(name, id))
            })
        });
      });

      $("form#form-rtlh").submit(function(e){
        e.preventDefault();
        var btn = $('#btn-simpan');
        btn.addClass('btn-progress');
        var formData = new FormData($(this)[0]);
        formData.append('_token', '{{ csrf_token() }}');
        $.ajax({
            type: "POST",
            url: "{{ route('admin.simpan-rtlh') }}",
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
                  window.location = "{{ route('admin.rtlh') }}";
                });
              }
              else {
                printErrorMsg(data.errors);
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

      var osmStreet = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiaGFuYWZpMDciLCJhIjoiY2tubmNiY2N6MDV3ZDJvcGdrMXh3aTh3eSJ9.gHOs5sTl8lPwP-IzHYgH_g', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
      });

      var markerClusters = new L.MarkerClusterGroup({
        spiderfyOnMaxZoom: true,
        showCoverageOnHover: false,
        zoomToBoundsOnClick: true,
        disableClusteringAtZoom: 17
      });

      var map = L.map(document.getElementById('mapid'), {
        zoom: 13,
        center: [-3.314771,114.6185566],
        layers: [osmStreet, markerClusters],
        zoomControl: false,
        attributionControl: false
      });

      var greenIcon = new L.Icon({
        iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
      });

      var blueIcon = new L.Icon({
        iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-blue.png',
        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
        iconSize: [25, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41]
      });

      let kelurahanLayer = L.geoJson(null);
      let Kelurahan = L.geoJson(null, {
        style: function (feature) {
          return {
            color: "#42a7f5",
            fill: true,
            fillOpacity: 0,
            opacity: 0.3,
            width: 0.01,
            clickable: false,
            riseOnHover: true
          };
        },

        onEachFeature: function (feature, layer) {
         
          layer.on({
            mouseover: function (e) {
              let layer = e.target;
              layer.setStyle({
                weight: 3,
                color: "#00FFFF",
                fillOpacity: 0.05,
                opacity: 1
              });

              if (!L.Browser.ie && !L.Browser.opera) {
                layer.bringToFront();
              }
            },
            mouseout: function (e) {
              Kelurahan.resetStyle(e.target);
            }
          });
        }
      });

      $.getJSON("{{ route('admin.gis-kelurahan-geojson') }}", function ( response ) {
        Kelurahan.addData(response.data);
      });

      let kecamatanColors = {"Banjarmasin Barat":"#ffb400",
        "Banjarmasin Selatan":"#70a1d7",
        "Banjarmasin Tengah":"#a1de93",
        "Banjarmasin Timur":"#f47c7c",
        "Banjarmasin Utara":"#f7f48b"};
      
      let kecamatanLayer = L.geoJson(null);
      let Kecamatan = L.geoJson(null, {
        style: function (feature) {
          return {
            name: Kecamatan,
            color: "white",
            fillColor: kecamatanColors[feature.properties.KECAMATAN],
            fillOpacity: 0.7,
            opacity: 1,
            width: 1,
            dashArray: '3',
            clickable: true,
            riseOnHover: true
          };
        },

        onEachFeature: function (feature, layer) {

          if (feature.properties) {
              let content = "<table class='table table-sm table-striped table-bordered table-condensed'>" + "<tr><th>KODE KEC.</th><td>" + feature.properties.KODE_KEC +
              "<tr><th>LUAS (KM<sup>2</sup>)</th><td>" + feature.properties.LUAS +
              "</td></tr>" + "<tr><th>JUMLAH KELURAHAN</th><td>" + feature.properties.JUMLAH_KEL + 
              "</td></tr>" + "<tr><th>JUMLAH PENDUDUK (JIWA)</th><td>" + feature.properties.JUMLAH_JIWA + 
              "</td></tr>" + "<tr><th>KEPADATAN PENDUDUK (JIWA/KM<sup>2</sup>)</th><td>" + feature.properties.KEPADATAN + 
              // "</td></tr>" + "<tr><th>AKSES AMAN (%)</th><td>" + feature.properties.AKSES_AMAN + 
              // "</td></tr>" + "<tr><th>AKSES DASAR/CUBLUK (%)</th><td>" + feature.properties.AKSES_DASAR + 
              // "</td></tr>" + "<tr><th>TANPA AKSES/ PENGGUNA JAMBAN DI PINGGIR SUNGAI (%)</th><td>" + feature.properties.TANPA_AKSES + 
              "</td></tr>" +  "</td></tr>" + "<table>" ;

              layer.on({
                click: function (e) {
                  $("#feature-title").html(feature.properties.KECAMATAN);
                  $("#feature-info").html(content);
                  $("#featureModal").modal("show");
                    
                }
              });
          }

          layer.on({
            mouseover: function (e) {
              
              let layer = e.target;
              layer.setStyle({
                weight: 4,
                color: "#666",
                fillOpacity: 0.1,
                dashArray: '',
                opacity: 1
              });


              if (!L.Browser.ie && !L.Browser.opera) {
                layer.bringToFront();
              }

            },
            mouseout: function (e) {
              Kecamatan.resetStyle(e.target);
            }
          });
        }
      });

      $.getJSON("{{ route('admin.gis-kecamatan-geojson') }}", function ( response ) {
        Kecamatan.addData(response.data);
      });

      //Legenda Kecamatan//
      let kecLegend = L.control({
        name: 'kecLegend',
        position: 'bottomleft'
      });

      kecLegend.onAdd = function (map) {
          let divKec = L.DomUtil.create("divKec", "info legend");
          divKec.innerHTML += "<h6><b>Legenda :</b> Kecamatan</h6>";
          divKec.innerHTML += '<p><i style="background: #ffb400"></i><span>Banjarmasin Barat</span><br></p>';
          divKec.innerHTML += '<p><i style="background: #70a1d7"></i><span>Banjarmasin Selatan</span><br></p>';
          divKec.innerHTML += '<p><i style="background: #a1de93"></i><span>Banjarmasin Tengah</span><br></p>';
          divKec.innerHTML += '<p><i style="background: #f47c7c"></i><span>Banjarmasin Timur</span><br></p>';
          divKec.innerHTML += '<p><i style="background: #f7f48b"></i><span>Banjarmasin Utara</span><br></p>';
            
          return divKec;
      };

      /*DELINIASI KUMUH*/
      let kumuhLayer = L.geoJson(null);
      let kumuh = L.geoJson(null, {
        style: function (feature) {
          return {
            color: "grey",
            fillColor: "magenta",
            fillOpacity: 0.5,
            opacity: 0.5,
            width: 0.001,
            clickable: true,
            title: feature.properties.KATEGORI,
            riseOnHover: true
          };
        },
        onEachFeature: function (feature, layer) {
          if (feature.properties) {
            let content = "<table class='table table-sm table-striped table-bordered table-condensed'>" + "<tr><th>KRITERIA KUMUH</th><td>" + feature.properties.KRITERIA_KUMUH + "<tr><th>LUASAN KUMUH (M<SUP>2</SUP>)</th><td>" + feature.properties.LUAS + "</td></tr>" + "<tr><th>KELURAHAN</th><td>" + feature.properties.KELURAHAN + "</td></tr>" + "<tr><th>RT</th><td>" + feature.properties.RT+ "</td></tr>" +  "</td></tr>" + "<table>";
            layer.on({
              click: function (e) {
                $("#feature-title").html(feature.properties.KATEGORI);
                $("#feature-info").html(content);
                $("#featureModal").modal("show");

              }
            });
          }
          layer.on({
            mouseover: function (e) {
              let layer = e.target;
              layer.setStyle({
                weight: 3,
                color: "#00FFFF",
                opacity: 1
              });
              if (!L.Browser.ie && !L.Browser.opera) {
                layer.bringToFront();
              }
            },
            mouseout: function (e) {
              kumuh.resetStyle(e.target);
            }
          });
        }
      });

      $.getJSON("{{ route('admin.gis-kumuh-geojson') }}", function ( response ) {
        kumuh.addData(response.data);
      });

      /*DELINIASI KUMUH*/
      let kumuh2022Layer = L.geoJson(null);
      let kumuh2022 = L.geoJson(null, {
        style: function (feature) {
          return {
            color: "grey",
            fillColor: "#c10d0d",
            fillOpacity: 0.5,
            opacity: 0.5,
            width: 0.001,
            clickable: true,
            title: feature.properties.NAMOBJ,
            riseOnHover: true
          };
        },
        onEachFeature: function (feature, layer) {
          if (feature.properties) {
            let content = "<table class='table table-sm table-striped table-bordered table-condensed'>" + "<tr><th>LOKASI</th><td>" + feature.properties.NAMOBJ + "</td></tr><table>";
            layer.on({
              click: function (e) {
                $("#feature-title").html(feature.properties.NAMOBJ);
                $("#feature-info").html(content);
                $("#featureModal").modal("show");

              }
            });
          }
          layer.on({
            mouseover: function (e) {
              let layer = e.target;
              layer.setStyle({
                weight: 3,
                color: "#00FFFF",
                opacity: 1
              });
              if (!L.Browser.ie && !L.Browser.opera) {
                layer.bringToFront();
              }
            },
            mouseout: function (e) {
              kumuh2022.resetStyle(e.target);
            }
          });
        }
      });

      $.getJSON("{{ route('admin.gis-kumuh-2022-geojson') }}", function ( response ) {
        kumuh2022.addData(response.data);
      });

      // Overlay layers are grouped
      var groupedOverlays = {
        "UTILITAS KOTA & BATAS ADMINISTRASI": {
          "Kelurahan": kelurahanLayer,
          "Kecamatan": kecamatanLayer,
        },
        "TEMATIK": {
          "Deliniasi Kumuh 2015": kumuhLayer,
          "Deliniasi Kumuh 2022": kumuh2022Layer,
        }
      };

      // Use the custom grouped layer control, not "L.control.layers"
      L.control.groupedLayers(ExampleData.Basemaps, groupedOverlays).addTo(map);

      /* Layer control listeners that allow for a single markerClusters layer */
      map.on("overlayadd", function(e) {
        if (e.layer === kelurahanLayer) {
          markerClusters.addLayer(Kelurahan);
          //console.log(gRtlh);
        }
        if (e.layer === kecamatanLayer) {
          kecLegend.addTo(this);
          markerClusters.addLayer(Kecamatan);
          //console.log(gRtlh);
        }
        if (e.layer === kumuhLayer) {
          markerClusters.addLayer(kumuh);
          //console.log(gRtlh2);
        }
        if (e.layer === kumuh2022Layer) {
          markerClusters.addLayer(kumuh2022);
          //console.log(gRtlh2);
        }
      });

      map.on("overlayremove", function(e) {
        if (e.layer === kelurahanLayer) {
          markerClusters.removeLayer(Kelurahan);
        }
        if (e.layer === kecamatanLayer) {
          this.removeControl(kecLegend);
          markerClusters.removeLayer(Kecamatan);
        }
        if (e.layer === kumuhLayer) {
          markerClusters.removeLayer(kumuh);
        }
        if (e.layer === kumuh2022Layer) {
          markerClusters.removeLayer(kumuh2022);
        }
      });

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
              pointToLayer: function (feature, latlng) {
                  marker = L.marker(e.latlng, {
                      riseOnHover: true,
                      draggable: true,
                  });
                  markers.push(marker);
                  return marker;
              }
          }).addTo(map);
      }
      
      $('#exampleModal').on('shown.bs.modal', function(){
          setTimeout(function() {
              map.invalidateSize();
          }, 10);
      });

      L.control.locate({
        strings: {
          title: "Tampilkan Lokasi Anda"
        }
      }).addTo(map);

      map.on('locationfound', onMapClick);

    });
    </script>
  </x-slot>
</x-admin-layout>
