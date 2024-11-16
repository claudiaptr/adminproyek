<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title', 'Default Title')</title> 
    
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('src/assets/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('src/assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('src/assets/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('src/assets/vendors/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('src/assets/vendors/typicons/typicons.css') }}">
    <link rel="stylesheet" href="{{ asset('src/assets/vendors/simple-line-icons/css/simple-line-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('src/assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('src/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
    
    <!-- endinject -->
    

    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('src/assets/css/style.css') }}">
    <!-- endinject -->

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="shortcut icon" href="{{ asset('src/assets/images/favicon.png') }}" />
    
    @stack('css') <!-- Untuk memasukkan CSS tambahan pada halaman tertentu -->
</head>
<body class="with-welcome-text">
    <div class="container-scroller">


        @include('navbar')

        <div class="container-fluid page-body-wrapper">
        @include('sidebar')
   
        @yield('content') <!-- Menampilkan konten spesifik halaman -->

        </div>
    </div>

    <!-- plugins:js -->
    <script src="{{ asset('src/assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('src/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <!-- endinject -->
    
    <!-- Plugin js for this page -->
    <script src="{{ asset('src/assets/vendors/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('src/assets/vendors/progressbar.js/progressbar.min.js') }}"></script>
    <!-- End plugin js for this page -->
    
    <!-- inject:js -->
    <script src="{{ asset('src/assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('src/assets/js/template.js') }}"></script>
    <script src="{{ asset('src/assets/js/settings.js') }}"></script>
    <script src="{{ asset('src/assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('src/assets/js/todolist.js') }}"></script>
    <!-- endinject -->
    
    <!-- Custom js for this page-->
    <script src="{{ asset('src/assets/js/jquery.cookie.js') }}" type="text/javascript"></script>
    <script src="{{ asset('src/assets/js/dashboard.js') }}"></script>
    <!-- End custom js for this page-->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    @stack('js') <!-- Menyertakan JavaScript tambahan yang bisa ditambahkan oleh halaman spesifik -->
</body>
</html>
