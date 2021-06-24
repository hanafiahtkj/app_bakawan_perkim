<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>@isset($title){{ $title }}@endisset</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{ asset('plugins/bootstrap-4.6.0/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <link rel="manifest" href="{{ asset('manifest.json') }}">
  
  <!-- Extra CSS -->
  @isset($extra_css)
    {{ $extra_css }}
  @endisset

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('css/components.css') }}">
  <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

  @laravelPWA
</head>

<body class="layout-2">
  <div id="app">
    <div class="main-wrapper">

      <!-- Main Navbar -->
      @include('admin.components.navbar')

      <!-- Main Sidebar -->
      @include('admin.components.sidebar')

      <!-- Main Content -->
      {{ $slot }}

      <!-- Main Footer -->
      @include('admin.components.footer')

    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="{{ asset('plugins/bootstrap-4.6.0/js/bootstrap.min.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="{{ asset('js/stisla.js') }}"></script>

  <!-- JS Libraies -->
  <script src="{{ asset('js/sticky-kit.min.js') }}"></script>

  <!-- FCM JS -->
  @include('fcm')

  <!-- Extra Js -->
  @isset($extra_js)
    {{ $extra_js }}
  @endisset

  <!-- Template JS File -->
  <script src="{{ asset('js/scripts.js') }}"></script>
  <script src="{{ asset('js/custom.js') }}"></script>
</body>
</html>
