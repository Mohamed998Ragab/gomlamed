<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Gomla Med</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('admin/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendors/mdi/css/materialdesignicons.min.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('admin/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/js/select.dataTables.min.css') }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('admin/css/vertical-layout-light/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('front/img/Gomla.png') }}"  />

</head>
<style>


  td p {
      width: 400px;
      height: 90%;
      white-space: wrap !important;
  }
  .sidebar .nav .nav-item .nav-link .menu-title {
    color: #fff !important;
  }
  .mdi-bookmark {
    color: #523e00 !important;
  }
</style>

<body>
    <div class="container-scroller">

        @include('admin.layout.header')

        <div class="container-fluid page-body-wrapper">

            @include('admin.layout.sidebar')

            @yield('content')

        </div>
    </div>

    <!-- plugins:js -->
    <!-- Include lazysizes library -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/lozad/dist/lozad.min.js"></script>
    <script>
        const observer = lozad(); // lazy loads elements with default selector as '.lozad'
observer.observe();
    </script>
    <script src="{{ asset('admin/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('admin/js/template.js') }}"></script>
    <script src="{{ asset('admin/js/custom.js') }}"></script>
</body>

</html>
