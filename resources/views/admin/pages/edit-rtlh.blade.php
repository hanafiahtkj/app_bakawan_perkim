<x-admin-layout>

  <x-slot name="title">Edit Data</x-slot>

  <x-slot name="extra_css">
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/leaflet/leaflet.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/leaflet-locatecontrol/dist/L.Control.Locate.min.css') }}" />
  </x-slot>

  <!-- Main Content -->
  <div class="main-content">
      <section class="section">
        <div class="section-header">
          <div class="section-header-back">
            <a href="{{ route('admin.rtlh') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
          </div>
          <h1>Edit Data</h1>
          <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dasbor</a></div>
            <div class="breadcrumb-item">Edit Data</div>
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
                  <fieldset>
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
                              <input type="text" class="form-control numeric" name="nik" value="{{ $rtlh->nik }}">
                              <div class="invalid-feedback feedback-nik"></div>
                            </div>
                          </div>
                          <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">No.KK</label>
                            <div class="col-sm-12 col-md-7">
                              <input type="text" class="form-control numeric" name="no_kk" value="{{ $rtlh->no_kk }}">
                              <div class="invalid-feedback feedback-no_kk"></div>
                            </div>
                          </div>
                          <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Lengkap</label>
                            <div class="col-sm-12 col-md-7">
                              <input type="text" class="form-control" name="nama_lengkap" value="{{ $rtlh->nama_lengkap }}">
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
                                    <option value="{{ $id }}" {{ ($rtlh->id_kecamatan == $id) ? "selected" : "" }}>{{ $name }}</option>
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
                              <textarea class="form-control selectric" name="alamat_lengkap" rows="3" style="height: 100px;">{{ $rtlh->alamat_lengkap }}</textarea>
                              <div class="invalid-feedback feedback-alamat_lengkap"></div>
                            </div>
                          </div>
                          <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tanggal Lahir</label>
                            <div class="col-sm-12 col-md-7">
                              <input type="text" class="form-control" name="tgl_lahir" id="tgl_lahir" value="{{ $rtlh->tgl_lahir2 }}" readonly>
                              <div class="invalid-feedback feedback-tgl_lahir"></div>
                            </div>
                          </div>
                          <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Jenis Kelamin</label>
                            <div class="col-sm-12 col-md-7">
                              @foreach ($jenis_kel as $setup)
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" name="jenis_kelamin" type="radio" id="inlineradio{{ $setup->id }}" value="{{ $setup->id }}" {{ ( $rtlh->jenis_kelamin == $setup->id) ? 'checked' : '' }}>
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
                                <option value="{{ $setup->id }}" {{ ( $rtlh->jenis_pekerjaan == $setup->id) ? 'selected' : '' }}>{{ $setup->name }}</option>
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
                                <option value="{{ $setup->id }}" {{ ( $rtlh->pendidikan == $setup->id) ? 'selected' : '' }}>{{ $setup->name }}</option>
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
                                <option value="{{ $setup->id }}" {{ ( $rtlh->jml_penghasilan == $setup->id) ? 'selected' : '' }}>{{ $setup->name }}</option>
                                @endforeach
                              </select>
                              <div class="invalid-feedback feedback-jml_penghasilan"></div>
                            </div>
                          </div>
                          <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Pernah Mendapat Bantuan Perumahan / Sejenis</label>
                            <div class="col-sm-12 col-md-7">
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" name="pernah_dibantu" type="radio" id="pernah_dibantu1" value="1" {{ ( $rtlh->pernah_dibantu == 1) ? 'checked' : '' }}>
                                <label class="form-check-label" for="pernah_dibantu1">Ya</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" name="pernah_dibantu" type="radio" id="pernah_dibantu2" value="0" {{ ( $rtlh->pernah_dibantu == 0) ? 'checked' : '' }}>
                                <label class="form-check-label" for="pernah_dibantu2">Tidak</label>
                              </div>
                            </div>
                          </div>
                          <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Jika Pernah dapat bantuan, dari :</label>
                            <div class="col-sm-12 col-md-7">
                              <input type="text" class="form-control" name="bantuan_dari" value="{{ $rtlh->bantuan_dari }}">
                              <div class="invalid-feedback feedback-bantuan_dari"></div>
                            </div>
                          </div>
                          <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-7">
                              <button type="button" class="btn btn-primary btn-lanjut" data-type="identitas" data-target="#kondisi">Lanjut <i class="fas fa-angle-double-right"></i></button>
                            </div>
                          </div>
                        </div>
                        <div class="tab-pane fade" id="kondisi" role="tabpanel" aria-labelledby="kondisi-tab">
                          <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Jumlah KK dalam rumah</label>
                            <div class="col-sm-12 col-md-7">
                              <input type="text" class="form-control numeric" name="jml_kk" value="{{ $kondisiRumah->jml_kk }}">
                              <div class="invalid-feedback feedback-jml_kk"></div>
                            </div>
                          </div>
                          <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Jumlah Penghuni</label>
                            <div class="col-sm-12 col-md-7">
                              <input type="text" class="form-control numeric" name="jml_penghuni" value="{{ $kondisiRumah->jml_penghuni }}">
                              <div class="invalid-feedback feedback-jml_penghuni"></div>
                            </div>
                          </div>
                          <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Luas Rumah (Panjang / Lebar)</label>
                            <div class="col-sm-12 col-md-3">
                              <input type="text" class="form-control numeric" name="panjang1" placeholder="Panjang" value="{{ $kondisiRumah->panjang }}">
                              <div class="invalid-feedback feedback-panjang1"></div>
                            </div>
                            <div class="col-sm-12 col-md-3">
                              <input type="text" class="form-control numeric" name="lebar1" placeholder="Lebar" value="{{ $kondisiRumah->lebar }}">
                              <div class="invalid-feedback feedback-lebar1"></div>
                            </div>
                          </div>
                          <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Status Kepemilikan tanah</label>
                            <div class="col-sm-12 col-md-7">
                              <select class="form-control selectric" name="stts_tanah">
                                <option value="">Pilih.....</option>
                                @foreach ($stts_tanah as $setup)
                                <option value="{{ $setup->id }}" {{ ( $kondisiRumah->stts_tanah == $setup->id) ? 'selected' : '' }}>{{ $setup->name }}</option>
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
                                <option value="{{ $setup->id }}" {{ ( $kondisiRumah->stts_rumah == $setup->id) ? 'selected' : '' }}>{{ $setup->name }}</option>
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
                                <option value="{{ $setup->id }}" {{ ( $kondisiRumah->stts_tanah_lain == $setup->id) ? 'selected' : '' }}>{{ $setup->name }}</option>
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
                                <option value="{{ $setup->id }}" {{ ( $kondisiRumah->stts_rumah_lain == $setup->id) ? 'selected' : '' }}>{{ $setup->name }}</option>
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
                                  <input class="form-check-input" name="bukti_kepemilikan[]" type="checkbox" id="inlineCheckbox{{ $setup->id }}" value="{{ $setup->id }}" {{ ( $rtlhBukti->contains($setup->id) ) ? 'checked' : '' }}>
                                  <label class="form-check-label" for="inlineCheckbox{{ $setup->id }}">{{ $setup->name }}</label>
                                </div>
                              @endforeach
                            </div>
                          </div>
                          <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Foto 0 % Bangunan</label>
                            <div class="col-sm-12 col-md-7">
                              <!-- <input type="file" class="form-control" name="foto_bangunan"> -->
                              <div class="input-group">
                                <div class="custom-file">
                                  <input type="file" class="custom-file-input" id="inputGroupFile04" name="foto_bangunan">
                                  <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                  <a class="btn btn-secondary btn-img" href="{{ url($kondisiRumah->foto_bangunan) }}" target="_blank"><i class="fas fa-image"></i></a>
                                </div>
                              </div>
                              <div class="invalid-feedback feedback-foto_bangunah"></div>
                            </div>
                          </div>
                          <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Koordinat Rumah</label>
                            <div class="col-sm-12 col-md-7">
                              <!-- <input type="text" class="form-control" name="koordinat_rumah" value="{{ $kondisiRumah->koordinat_rumah }}"> -->
                              <div class="input-group mb-3">
                                <input type="text" class="form-control"  name="koordinat_rumah" id="koordinat_rumah" value="{{ $kondisiRumah->koordinat_rumah }}" placeholder="latitude, longitude">
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
                                  <input class="form-check-input" name="pondasi" type="radio" id="inlineradio{{ $setup->id }}" value="{{ $setup->id }}" {{ ( $kelayakanRumah->pondasi == $setup->id) ? 'checked' : '' }}>
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
                                  <input class="form-check-input" name="kondisi_kolom" type="radio" id="inlineradio{{ $setup->id }}" value="{{ $setup->id }}" {{ ( $kelayakanRumah->kondisi_kolom == $setup->id) ? 'checked' : '' }}>
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
                                  <input class="form-check-input" name="kondisi_konstruksi" type="radio" id="inlineradio{{ $setup->id }}" value="{{ $setup->id }}" {{ ( $kelayakanRumah->kondisi_konstruksi == $setup->id) ? 'checked' : '' }}>
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
                                  <input class="form-check-input" name="jendela" type="radio" id="inlineradio{{ $setup->id }}" value="{{ $setup->id }}" {{ ( $kelayakanRumah->jendela == $setup->id) ? 'checked' : '' }}>
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
                                  <input class="form-check-input" name="ventilasi" type="radio" id="inlineradio{{ $setup->id }}" value="{{ $setup->id }}" {{ ( $kelayakanRumah->ventilasi == $setup->id) ? 'checked' : '' }}>
                                  <label class="form-check-label" for="inlineradio{{ $setup->id }}">{{ $setup->name }}</label>
                                </div>
                              @endforeach
                            </div>
                          </div>
                          <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Fungsi Ruang</label>
                            <div class="col-sm-12 col-md-7">
                              <select class="form-control selectric" name="fungsi_ruang">
                                <option value="">Pilih.....</option>
                                @foreach ($fungsi_ruang as $setup)
                                <option value="{{ $setup->id }}" {{ ( $kelayakanRumah->fungsi_ruang == $setup->id) ? 'selected' : '' }}>{{ $setup->name }}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                          <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kepemilikan Kamar Mandi dan WC</label>
                            <div class="col-sm-12 col-md-7">
                              <select class="form-control selectric" name="stts_wc">
                                <option value="">Pilih.....</option>
                                @foreach ($stts_wc as $setup)
                                <option value="{{ $setup->id }}" {{ ( $kelayakanRumah->stts_wc == $setup->id) ? 'selected' : '' }}>{{ $setup->name }}</option>
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
                                <option value="{{ $setup->id }}" {{ ( $kelayakanRumah->jarak_air_tpa == $setup->id) ? 'selected' : '' }}>{{ $setup->name }}</option>
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
                                <option value="{{ $setup->id }}" {{ ( $kelayakanRumah->jenis_kloset == $setup->id) ? 'selected' : '' }}>{{ $setup->name }}</option>
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
                                <option value="{{ $setup->id }}" {{ ( $kelayakanRumah->jenis_tpa == $setup->id) ? 'selected' : '' }}>{{ $setup->name }}</option>
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
                                <option value="{{ $setup->id }}" {{ ( $kelayakanRumah->sumber_air_minum == $setup->id) ? 'selected' : '' }}>{{ $setup->name }}</option>
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
                                <option value="{{ $setup->id }}" {{ ( $kelayakanRumah->sumber_listrik == $setup->id) ? 'selected' : '' }}>{{ $setup->name }}</option>
                                @endforeach
                              </select>
                              <div class="invalid-feedback feedback-sumber_listrik"></div>
                            </div>
                          </div>
                          <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Luas Tanah (Panjang / Lebar)</label>
                            <div class="col-sm-12 col-md-3">
                              <input type="text" class="form-control numeric" name="panjang2" placeholder="Panjang" value="{{ $kelayakanRumah->panjang }}">
                              <div class="invalid-feedback feedback-panjang2"></div>
                            </div>
                            <div class="col-sm-12 col-md-3">
                              <input type="text" class="form-control numeric" name="lebar2" placeholder="Lebar" value="{{ $kelayakanRumah->lebar }}">
                              <div class="invalid-feedback feedback-lebar2"></div>
                            </div>
                          </div>
                          <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Material Atap</label>
                            <div class="col-sm-12 col-md-7">
                              <select class="form-control selectric" name="material_atap">
                                <option value="">Pilih.....</option>
                                @foreach ($material_atap as $setup)
                                <option value="{{ $setup->id }}" {{ ( $kelayakanRumah->material_atap == $setup->id) ? 'selected' : '' }}>{{ $setup->name }}</option>
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
                                  <input class="form-check-input" name="kondisi_atap" type="radio" id="inlineradio{{ $setup->id }}" value="{{ $setup->id }}" {{ ( $kelayakanRumah->kondisi_atap == $setup->id) ? 'checked' : '' }}>
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
                                <option value="{{ $setup->id }}" {{ ( $kelayakanRumah->material_dinding == $setup->id) ? 'selected' : '' }}>{{ $setup->name }}</option>
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
                                  <input class="form-check-input" name="kondisi_dinding" type="radio" id="inlineradio{{ $setup->id }}" value="{{ $setup->id }}" {{ ( $kelayakanRumah->kondisi_dinding == $setup->id) ? 'checked' : '' }}>
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
                                <option value="{{ $setup->id }}" {{ ( $kelayakanRumah->material_lantai == $setup->id) ? 'selected' : '' }}>{{ $setup->name }}</option>
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
                                  <input class="form-check-input" name="kondisi_lantai" type="radio" id="inlineradio{{ $setup->id }}" value="{{ $setup->id }}" {{ ( $kelayakanRumah->kondisi_lantai == $setup->id) ? 'checked' : '' }}>
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
                                  <input class="form-check-input" name="kondisi_plafon" type="radio" id="inlineradio{{ $setup->id }}" value="{{ $setup->id }}" {{ ( $kelayakanRumah->kondisi_plafon == $setup->id) ? 'checked' : '' }}>
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
                                  <input class="form-check-input" name="kondisi_balok" type="radio" id="inlineradio{{ $setup->id }}" value="{{ $setup->id }}" {{ ( $kelayakanRumah->kondisi_balok == $setup->id) ? 'checked' : '' }}>
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
                                  <input class="form-check-input" name="kondisi_sloof" type="radio" id="inlineradio{{ $setup->id }}" value="{{ $setup->id }}" {{ ( $kelayakanRumah->kondisi_sloof == $setup->id) ? 'checked' : '' }}>
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
                                <option value="{{ $setup->id }}" {{ ( $rtlh->kawasan_rumah == $setup->id) ? 'selected' : '' }}>{{ $setup->name }}</option>
                                @endforeach
                              </select>
                              <div class="invalid-feedback feedback-kawasan_rumah"></div>
                            </div>
                          </div>
                          <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-6 col-md-3">
                              <button type="button" class="btn btn-secondary btn-kembali mr-2" data-target="#kondisi"><i class="fas fa-angle-double-left"></i> Kembali</button>
                            </div>
                            <div class="col-sm-6 col-md-4 text-right">
                              <input type="hidden" name="id_rtlh" value="{{ $rtlh->id }}">
                              <button id="btn-simpan" class="btn btn-success" type="submit"> <i class="fas fa-save"></i> Simpan</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </fieldset>
                </div>
              </div>
            </div>
          </form>
        </div>
      </section>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <!-- <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Maps</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div> -->
        <div class="modal-body">
          
        </div>
        <!-- <div class="modal-footer pt-0">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div> -->
      </div>
    </div>
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
    <script src="{{ asset('js/plugin.js') }}"></script>
    <script src="{{ asset('plugins/leaflet-locatecontrol/dist/L.Control.Locate.min.js') }}" charset="utf-8"></script>
    <script>

    function printErrorMsg (msg) {
      var focus = '';
      $.each( msg, function( key, value ) {
        console.log(key);
        $('[name="'+key+'"]').addClass('is-invalid');
        $('.feedback-'+key).text(value);

        if (focus == '') {
          focus = '1';
          $('[name="'+key+'"]').focus();
        }
      });
    }

    function getKelurahan(id) {
      var id_kelurahan = '{{ $rtlh->id_kelurahan }}';
      var url = '{{ route("getKelurahan", ":id") }}';
      url = url.replace(':id', id);
      $.get(url, function( response ) {
          // alert('ok');
          $('#id_kelurahan').html('');
          $('#id_kelurahan').append('<option value="">Pilih....</option>')
          $.each(response.data, function (id, name) {
              // $('#id_kelurahan').append(new Option(name, id));
              $('#id_kelurahan').append('<option value="'+id+'" '+ ((id == id_kelurahan) ? 'selected' : '') +'>'+name+'</option>')
          })
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
      
      var koordinat = $('#koordinat_rumah').val().split(',');
      var pointStart = '';
      //alert(koordinat[0]);
      if (koordinat.length == 2) {
        pointStart = [koordinat[0], koordinat[1]];
      }
      else {
        // banjarmasin = -3.317219,114.524172
        pointStart = [-3.317219,114.524172];
      }

      var map = L.map('mapid').setView(pointStart, 13);

      L.control.locate({
        strings: {
          title: "Tampilkan Lokasi Anda"
        }
      }).addTo(map);

      map.on('locationfound', onMapClick);
      
      L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiaGFuYWZpMDciLCJhIjoiY2tubmNiY2N6MDV3ZDJvcGdrMXh3aTh3eSJ9.gHOs5sTl8lPwP-IzHYgH_g', {
          attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
          maxZoom: 18,
          id: 'mapbox/streets-v11',
          tileSize: 512,
          zoomOffset: -1,
          accessToken: 'your.mapbox.access.token'
      }).addTo(map);

      map.on('click', onMapClick);
      var markers = [];

      if (koordinat.length == 2) {
        var marker = new L.Marker([koordinat[0], koordinat[1]], {
            riseOnHover: true,
            draggable: true,
        });
        marker.addTo(map);
        markers.push(marker);
      }
      
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

      getKelurahan('{{ $rtlh->id_kecamatan }}');

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

      $("form#form-rtlh").submit(function(e){
        e.preventDefault();
        var btn = $('#btn-simpan');
        btn.addClass('btn-progress');
        var formData = new FormData($(this)[0]);
        formData.append('_token', '{{ csrf_token() }}');
        $.ajax({
            type: "POST",
            url: "{{ route('admin.update-rtlh') }}",
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
    });
    </script>
  </x-slot>
</x-admin-layout>
