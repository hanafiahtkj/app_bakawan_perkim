<x-home-layout>

    <x-slot name="title">Bakawan RTLH - Banjarmasin Aplikasi Wadah Pendataan Rumah Tidak Layak Huni</x-slot>

    <div class="main-content">
        <section class="section">

            <div class="section-body">
                <div class="hero text-white p-0 pt-5">
                    <div class="hero-inner">
                        <div class="row">
                            <div class="col-md-5 mb-5">
                                <h1 class="welcome1">Selamat Datang</h1>
                                <h3 class="lead bg-bluee"><b>BAKAWAN RTLH - Banjarmasin Aplikasi Wadah Pendataan Rumah
                                        Tidak Layak Huni</b></h3>
                                <div class="mt-4">
                                    @if (Route::has('login'))
                                        @auth
                                            @role('Admin')
                                                <a href="{{ route('admin.dashboard') }}"
                                                    class="btn btn-warning btn-lg btn-icon icon-left mr-2"><i
                                                        class="far fa-user"></i> Dasbor</a>
                                            @else
                                                <a href="{{ route('dashboard') }}"
                                                    class="btn btn-warning btn-lg btn-icon icon-left mr-2"><i
                                                        class="far fa-user"></i> Dasbor</a>
                                            @endrole
                                        @else
                                            <a href="{{ route('login') }}" class="btn btn-warning btn-lg icon-left mr-2"><i
                                                    class="far fa-user"></i> Login</a>
                                        @endauth
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-7 mb-4">
                                <div class="image d-lg-block">
                                    <img src="{{ asset('img/web4.png') }}" class="img-fluid" alt="Responsive image">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row stats">
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12 mb-4">
                        <div class="card card-statistic shadow-sm h-100">
                            <div class="card-body d-flex flex-column justify-content-between p-3">
                                <div class="d-flex align-items-center">
                                    <div class="icon-stat mr-3">
                                        <i class="fas fa-home fa-2x text-primary"></i>
                                    </div>
                                    <div class="text-right w-100">
                                        <h6 class="mb-0 text-muted text-uppercase">Total Kasus RTLH</h6>
                                        <h3 class="mb-0 text-primary">{{ $tot_diterima + 3470 }}</h3>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <span class="text-muted"><small>Terdata saat ini</small></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12 mb-4">
                        <div class="card card-statistic shadow-sm h-100">
                            <div class="card-body d-flex flex-column justify-content-between p-3">
                                <div class="d-flex align-items-center">
                                    <div class="icon-stat mr-3">
                                        <i class="fas fa-check-circle fa-2x text-success"></i>
                                    </div>
                                    <div class="text-right w-100">
                                        <h6 class="mb-0 text-muted text-uppercase">Total Perbaikan Rumah</h6>
                                        <h3 class="mb-0 text-success">{{ $tot_realisasi }}</h3>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <span class="text-muted"><small>Berhasil diperbaiki</small></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12 mb-4">
                        <div class="card card-statistic shadow-sm h-100">
                            <div class="card-body d-flex flex-column justify-content-between p-3">
                                <div class="d-flex align-items-center">
                                    <div class="icon-stat mr-3">
                                        <i class="fas fa-exclamation-triangle fa-2x text-danger"></i>
                                    </div>
                                    <div class="text-right w-100">
                                        <h6 class="mb-0 text-muted text-uppercase">Tanpa Akses WC</h6>
                                        <h3 class="mb-0 text-danger">{{ $tot_tanpa_wc }}</h3>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <span class="text-muted"><small>Perlu perhatian khusus</small></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-4">
                        <div class="card card-statistic shadow-sm h-100">
                            <div class="card-body d-flex flex-column justify-content-between p-3">
                                <div class="d-flex align-items-center">
                                    <div class="icon-stat mr-3">
                                        <i class="fas fa-toilet fa-2x text-info"></i>
                                    </div>
                                    <div class="text-right">
                                        <h6 class="mb-0 text-muted text-uppercase">Bantuan WC</h6>
                                        <h3 class="mb-0 text-info">{{ $tot_memiliki_wc }}</h3>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <span class="text-muted"><small>Berhasil diperbaiki</small></span>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>

                {{-- <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12 mb-4">
                        <div class="card shadow-sm h-100">
                            <div class="card-header">
                                <h4 class="card-title">Status Fungsi Ruang dari RTLH</h4>
                            </div>
                            <div class="card-body d-flex flex-column align-items-center justify-content-center">
                                <canvas id="doughnutChart1"></canvas>
                                <div class="chart-legend mt-3 text-center">
                                    <span class="legend-item"><i class="fas fa-circle text-primary"></i> Zona
                                        Perumahan</span>
                                    <span class="legend-item"><i class="fas fa-circle text-danger"></i> Bukan Zona
                                        Perumahan</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 mb-4">
                        <div class="card shadow-sm h-100">
                            <div class="card-header">
                                <h4 class="card-title">Distribusi RTLH per Kecamatan</h4>
                            </div>
                            <div class="card-body d-flex flex-column align-items-center justify-content-center">
                                <canvas id="doughnutChart2"></canvas>
                                <div class="chart-legend mt-3 text-center">
                                    <span class="legend-item"><i class="fas fa-circle text-primary"></i> Banjarmasin
                                        Utara</span>
                                    <span class="legend-item"><i class="fas fa-circle text-success"></i> Banjarmasin
                                        Selatan</span>
                                    <span class="legend-item"><i class="fas fa-circle text-warning"></i> Banjarmasin
                                        Timur</span>
                                    <span class="legend-item"><i class="fas fa-circle text-danger"></i> Banjarmasin
                                        Barat</span>
                                    <span class="legend-item"><i class="fas fa-circle text-info"></i> Banjarmasin
                                        Tengah</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}


                <section class="py-5">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="card shadow-lg border-0 rounded-4">
                                    <div class="card-body p-4 p-md-5 text-center">
                                        <h2 class="card-title fw-bold mb-3 text-primary display-5 display-md-4">
                                            Cek Status Calon Penerima Bantuan
                                        </h2>
                                        <p class="lead text-muted mb-4 fs-6 fs-md-5">
                                            Cek status calon penerima bantuan perumahan dari database Bakawan RTLH
                                            dengan mudah dan transparan.
                                        </p>
                                        <form id="checkStatusForm" action="#" method="POST"
                                            class="needs-validation" novalidate>
                                            @csrf
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="nik_kk" name="nik_kk"
                                                    placeholder="Masukkan 16 digit NIK atau Nomor KK" minlength="16"
                                                    maxlength="16" pattern="[0-9]{16}" required>
                                                {{-- <label for="nik_kk">NIK atau Nomor Kartu Keluarga</label> --}}
                                                <div class="invalid-feedback text-start">
                                                    Mohon masukkan 16 digit angka yang valid.
                                                </div>
                                            </div>
                                            <small class="d-block text-start text-muted mb-4 fs-7">
                                                <i class="bi bi-info-circle me-1"></i> Format: 16 digit angka <span
                                                    class="float-end" id="char-count">0/16</span>
                                            </small>
                                            <button type="submit" class="btn btn-primary btn-lg w-100">
                                                <i class="bi bi-search me-2"></i>Cek Sekarang
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <div class="modal fade" id="statusModal" tabindex="-1" role="dialog"
                    aria-labelledby="statusModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content border-0 shadow-lg rounded-4">
                            <div class="modal-header d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <i id="modal-header-icon" class="fas fa-check-circle text-primary fa-lg me-2"></i>
                                    <h5 class="modal-title mb-0" id="statusModalLabel">Hasil Verifikasi</h5>
                                </div>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body p-4">
                                <div id="modal-status-alert" class="alert d-flex align-items-center" role="alert">
                                    <i id="modal-status-icon" class="me-2"></i>
                                    <span id="modal-status-text"></span>
                                </div>

                                <div class="list-group list-group-flush">
                                    <div class="list-group-item d-flex align-items-center">
                                        <div class="icon-circle icon-circle-primary me-3">
                                            <i class="fas fa-user-circle"></i>
                                        </div>
                                        <div>
                                            <small class="text-uppercase text-muted">Nama Lengkap</small>
                                            <h5 class="mb-0" id="modal-nama"></h5>
                                        </div>
                                    </div>
                                    <div class="list-group-item d-flex align-items-center">
                                        <div class="icon-circle icon-circle-primary me-3">
                                            <i class="fas fa-id-card"></i>
                                        </div>
                                        <div>
                                            <small class="text-uppercase text-muted">NIK</small>
                                            <h5 class="mb-0" id="modal-nik"></h5>
                                        </div>
                                    </div>
                                    <div class="list-group-item d-flex align-items-center">
                                        <div class="icon-circle icon-circle-primary me-3">
                                            <i class="fas fa-home"></i>
                                        </div>
                                        <div>
                                            <small class="text-uppercase text-muted">Nomor Kartu Keluarga</small>
                                            <h5 class="mb-0" id="modal-kk"></h5>
                                        </div>
                                    </div>
                                    <div class="list-group-item d-flex align-items-center">
                                        <div class="icon-circle icon-circle-primary me-3">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>
                                        <div>
                                            <small class="text-uppercase text-muted">Alamat Lengkap</small>
                                            <h5 class="mb-0" id="modal-alamat"></h5>
                                        </div>
                                    </div>
                                    <div class="list-group-item d-flex align-items-center">
                                        <div class="icon-circle icon-circle-primary me-3">
                                            <i class="fas fa-calendar-alt"></i>
                                        </div>
                                        <div>
                                            <small class="text-uppercase text-muted">Tanggal Terdaftar</small>
                                            <h5 class="mb-0" id="modal-tanggal-terdaftar"></h5>
                                        </div>
                                    </div>
                                    <div class="list-group-item d-flex align-items-center">
                                        <div class="icon-circle icon-circle-primary me-3">
                                            <i class="fas fa-calendar-check"></i>
                                        </div>
                                        <div>
                                            <small class="text-uppercase text-muted">Tanggal Penerimaan Bantuan</small>
                                            <h5 class="mb-0" id="modal-tanggal-bantuan"></h5>
                                        </div>
                                    </div>
                                </div>

                                <div class="alert alert-info mt-3 d-flex align-items-start" role="alert">
                                    <i class="fas fa-info-circle me-3"></i>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">Keterangan</h6>
                                        <p class="mb-0" id="modal-keterangan"></p>
                                    </div>
                                </div>

                                <div class="alert alert-warning mt-3 d-flex align-items-start" role="alert">
                                    <i class="fas fa-lock me-3"></i>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">Informasi Keamanan Data</h6>
                                        <p class="mb-0">NIK dan Nomor KK telah di-mask untuk melindungi privasi Anda.
                                            Data ini telah diverifikasi dari database resmi Bakawan RTLH.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="notFoundModal" tabindex="-1" role="dialog"
                    aria-labelledby="notFoundModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content border-0 shadow-lg rounded-4">
                            <div class="modal-header d-flex justify-content-between align-items-center border-0 pb-0">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-exclamation-circle text-danger fa-lg me-2"></i>
                                    <h5 class="modal-title mb-0" id="notFoundModalLabel">Data Tidak Ditemukan</h5>
                                </div>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body p-4 text-center">
                                <div class="d-flex flex-column align-items-center mb-3">
                                    <div
                                        class="icon-file-warning rounded-circle d-flex align-items-center justify-content-center mb-3">
                                        <i class="fas fa-file-alt text-danger fa-3x"></i>
                                    </div>
                                    <h5 class="fw-bold mb-1">NIK/KK Tidak Ditemukan</h5>
                                    <p class="text-muted">
                                        NIK atau Nomor Kartu Keluarga yang Anda masukkan tidak terdaftar dalam database
                                        Bakawan RTLH. Silakan periksa kembali nomor yang dimasukkan.
                                    </p>
                                </div>

                                <div class="alert alert-warning text-start" role="alert">
                                    <h6 class="mb-2"><i class="fas fa-exclamation-triangle me-2"></i>Saran
                                        Pemeriksaan</h6>
                                    <ul class="mb-0 ps-3">
                                        <li>Pastikan NIK/KK terdiri dari 16 digit angka.</li>
                                        <li>Periksa kembali angka yang dimasukkan.</li>
                                        <li>Hubungi Petugas kelurahan untuk informasi pendaftaran.</li>
                                    </ul>
                                </div>

                                <button type="button" class="btn btn-dark btn-lg mt-3 w-100" data-dismiss="modal">
                                    Coba Lagi
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <section class="p-2 pt-4 bg-bluee">
                    <div class="container">
                        <h3 class="text-center font-weight-bold mb-2 text-white">Informasi Program Bantuan RTLH</h3>
                        <p class="text-center text-muted mb-4">Semua yang perlu Anda ketahui tentang program bantuan
                            rumah tidak layak huni</p>
                        <div class="row justify-content-center">
                            <div class="col-lg-6 mb-4">
                                <div class="card h-100 shadow-sm border-0 rounded-lg">
                                    <div class="card-body p-4">
                                        <div class="d-flex align-items-center mb-3">
                                            <i class="fas fa-hand-holding-heart text-primary fa-lg mr-2"></i>
                                            <h5 class="font-weight-bold mb-0">Jenis Bantuan</h5>
                                        </div>
                                        <ul class="list-unstyled">
                                            <li class="mb-3 d-flex align-items-start">
                                                <div class="mr-3">
                                                    <i class="fas fa-check-circle text-success mt-1"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">Bantuan Stimulan Rumah Swadaya</h6>
                                                    <p class="text-muted mb-0 small">Bantuan peningkatan kualitas bagi
                                                        rumah tidak layak huni</p>
                                                </div>
                                            </li>
                                            <li class="mb-3 d-flex align-items-start">
                                                <div class="mr-3">
                                                    <i class="fas fa-check-circle text-success mt-1"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">Pembangunan Sanitasi</h6>
                                                    <p class="text-muted mb-0 small">Pembangunan toilet dan septiktank
                                                    </p>
                                                </div>
                                            </li>
                                            {{-- <li class="d-flex align-items-start">
                                                <div class="mr-3">
                                                    <i class="fas fa-check-circle text-success mt-1"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">Perbaikan Infrastruktur</h6>
                                                    <p class="text-muted mb-0 small">Akses jalan lingkungan</p>
                                                </div>
                                            </li> --}}
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-4">
                                <div class="card h-100 shadow-sm border-0 rounded-lg">
                                    <div class="card-body p-4">
                                        <div class="d-flex align-items-center mb-3">
                                            <i class="fas fa-clipboard-check text-primary fa-lg mr-2"></i>
                                            <h5 class="font-weight-bold mb-0">Syarat & Kriteria</h5>
                                        </div>
                                        <ul class="list-unstyled">
                                            <li class="mb-3 d-flex align-items-start">
                                                <div class="mr-3">
                                                    <i class="fas fa-user-friends text-primary mt-1"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">Warga Banjarmasin yang sudah berkeluarga</h6>
                                                    <p class="text-muted mb-0 small">Dibuktikan dengan KTP dan KK</p>
                                                </div>
                                            </li>
                                            <li class="mb-3 d-flex align-items-start">
                                                <div class="mr-3">
                                                    <i class="fas fa-home text-primary mt-1"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">Memiliki / Menguasai tanah dan rumah dengan alas
                                                        hak yang sah</h6>
                                                    <p class="text-muted mb-0 small">Dibuktikan dengan Dokumen Alas Hak
                                                        (SHM, HGB, Sporadik, Surat Segel, dsb)</p>
                                                </div>
                                            </li>
                                            <li class="d-flex align-items-start">
                                                <div class="mr-3">
                                                    <i class="fas fa-dollar-sign text-primary mt-1"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">Masyarakat Berpenghasilan Rendah (MBR)</h6>
                                                    <p class="text-muted mb-0 small">MBR yang memiliki batas
                                                        penghasilan atau di bawah UMK (Upah Minimum Kota)</p>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="px-2 pt-4 bg-bluee mt-4">
                    <div class="container">
                        <h3 class="text-center font-weight-bold mb-2 text-white">Alur Pendaftaran</h3>
                        <p class="text-center text-muted mb-4">Ikuti langkah-langkah berikut untuk mendaftar program
                            RTLH</p>
                        <div class="row text-center">
                            <div class="col-lg-3 col-md-6 mb-4">
                                <div class="card h-100 border-0">
                                    <div class="card-body">
                                        <div
                                            class="circle-number mb-3 mx-auto d-flex align-items-center justify-content-center">
                                            1
                                        </div>
                                        <h5 class="font-weight-bold">Persiapan Dokumen</h5>
                                        <p class="text-muted mb-0">Siapkan KTP, KK, Salinan Alas hak, dan foto rumah
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 mb-4">
                                <div class="card h-100 border-0">
                                    <div class="card-body">
                                        <div
                                            class="circle-number mb-3 mx-auto d-flex align-items-center justify-content-center">
                                            2
                                        </div>
                                        <h5 class="font-weight-bold">Pendaftaran</h5>
                                        <p class="text-muted mb-0">Daftar melalui petugas di kantor kelurahan</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 mb-4">
                                <div class="card h-100 border-0">
                                    <div class="card-body">
                                        <div
                                            class="circle-number mb-3 mx-auto d-flex align-items-center justify-content-center">
                                            3
                                        </div>
                                        <h5 class="font-weight-bold">Verifikasi</h5>
                                        <p class="text-muted mb-0">Tim verifikator akan melakukan survey dan assessment
                                            ke lokasi</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 mb-4">
                                <div class="card h-100 border-0">
                                    <div class="card-body">
                                        <div
                                            class="circle-number mb-3 mx-auto d-flex align-items-center justify-content-center">
                                            4
                                        </div>
                                        <h5 class="font-weight-bold">Pelaksanaan</h5>
                                        <p class="text-muted mb-0">Jika lolos verifikasi, masuk pertimbangan (menunggu
                                            antrian berdasarkan urutan prioritas dan ketersediaan anggaran)</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </section>
    </div>

    <x-slot name="extra_css">
        <style>
            .stats .fas {
                font-size: 40px !important;
            }

            .modal {
                z-index: 2000 !important;
            }

            .modal-backdrop {
                z-index: 0 !important;
            }

            .icon-circle {
                width: 40px;
                height: 40px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                background-color: #f0f5ff;
                /* Default background */
                color: #4b89ff;
                /* Default icon color */
                font-size: 1.25rem;
                margin-right: 10px;
            }

            /* Ganti warna latar belakang dan ikon untuk setiap kasus */
            .icon-circle-primary {
                background-color: #e6f0ff;
                color: #4b89ff;
            }

            .icon-circle-success {
                background-color: #e7fff0;
                color: #51c472;
            }

            .icon-circle-danger {
                background-color: #fff1f1;
                color: #ff5454;
            }

            .icon-circle-warning {
                background-color: #fff8e1;
                color: #ffa000;
            }

            .icon-file-warning {
                width: 6rem;
                height: 6rem;
                background-color: #ffe6e6;
            }

            .icon-file-warning i {
                font-size: 3rem;
            }

            .bg-bluee {

                PADDING: 9PX;
                BACKGROUND-COLOR: #212c82;
                BORDER-RADIUS: 10PX;
            }
        </style>
    </x-slot>

    <x-slot name="extra_js">
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Logika untuk hitungan karakter NIK/KK
                const nikInput = document.getElementById('nik_kk');
                const charCountSpan = document.getElementById('char-count');

                nikInput.addEventListener('input', function() {
                    const currentLength = this.value.length;
                    charCountSpan.textContent = `${currentLength}/16`;
                });

                // Logika untuk menangani pengiriman formulir dan menampilkan modal
                const form = document.getElementById('checkStatusForm');
                form.addEventListener('submit', function(event) {
                    event.preventDefault(); // Mencegah form dari pengiriman data

                    // Cek validasi form bawaan Bootstrap
                    if (form.checkValidity() === false) {
                        event.stopPropagation();
                        form.classList.add('was-validated');
                        return;
                    }

                    // Ambil nilai NIK/KK dari input
                    const nik_kk = document.getElementById('nik_kk').value;

                    // Buat endpoint API dengan parameter GET
                    const endpoint = `/check-status?nik_kk=${nik_kk}`;

                    // Lakukan permintaan AJAX (Fetch API) ke server
                    fetch(endpoint, {
                            method: 'GET',
                            headers: {
                                'Content-Type': 'application/json'
                            }
                        })
                        .then(response => {
                            // Jika respons 404, kita akan langsung menampilkan modal notFoundModal
                            if (response.status === 404) {
                                return response.json().then(errorData => {
                                    // Tampilkan modal data tidak ditemukan
                                    $('#notFoundModal').modal('show');
                                    // Lempar error untuk menghentikan alur
                                    throw new Error(errorData.message);
                                });
                            }
                            if (!response.ok) {
                                throw new Error(`Server responded with status: ${response.status}`);
                            }
                            return response.json();
                        })
                        .then(data => {
                            // Tangani respons data
                            if (data.status === 'success') {
                                const modalInfo = data.modal_info;
                                const mainData = data.data;

                                console.log(mainData);

                                // Isi konten modal dengan data yang diterima
                                document.getElementById('modal-nama').textContent = mainData.nama_lengkap;
                                document.getElementById('modal-nik').textContent = mainData.nik;
                                document.getElementById('modal-kk').textContent = mainData.no_kk;
                                document.getElementById('modal-alamat').textContent = mainData
                                    .alamat_lengkap;
                                document.getElementById('modal-tanggal-terdaftar').textContent = mainData
                                    .tanggal_terdaftar;
                                document.getElementById('modal-tanggal-bantuan').textContent = mainData
                                    .tanggal_bantuan || 'Belum menerima bantuan';
                                document.getElementById('modal-keterangan').textContent = modalInfo
                                    .keterangan_tambahan;

                                // Sesuaikan tampilan modal berdasarkan status
                                const alertElement = document.getElementById('modal-status-alert');
                                const iconElement = document.getElementById('modal-status-icon');
                                const textElement = document.getElementById('modal-status-text');
                                const headerIcon = document.getElementById('modal-header-icon');

                                // Hapus semua kelas alert dan ikon sebelumnya
                                alertElement.classList.remove('alert-success', 'alert-danger',
                                    'alert-warning', 'alert-info');

                                // Tambahkan kelas dan konten baru sesuai status
                                alertElement.classList.add(`alert-${modalInfo.type}`);
                                iconElement.className = `${modalInfo.icon} me-2`;
                                textElement.textContent = modalInfo.label;
                                headerIcon.className =
                                    `${modalInfo.icon} text-${modalInfo.type} fa-lg me-2`;

                                // Tampilkan modal
                                $('#statusModal').modal('show');
                            } else if (data.status === 'not_found') {
                                // Jika data tidak ditemukan, tampilkan pesan error
                                alert(data.message);
                            } else {
                                // Tangani kasus lain yang tidak terduga
                                alert('Terjadi kesalahan tidak terduga. Silakan coba lagi.');
                            }
                        })
                        .catch(error => {
                            // Tangani error pada proses fetch, termasuk masalah jaringan dan parsing JSON
                            console.error('Error:', error);
                            // alert('Terjadi kesalahan. Periksa koneksi Anda atau hubungi admin.');
                        });
                });

                // Reset validasi saat formulir direset
                form.addEventListener('reset', function() {
                    form.classList.remove('was-validated');
                });
            });
        </script>
    </x-slot>

</x-home-layout>
