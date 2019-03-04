<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Text Crud</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/main.css')}}">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
     <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    @yield('styles')
   
  </head>
  <body class="app sidebar-mini rtl">
    <!-- Navbar-->
    <header class="app-header"><a class="app-header__logo" href="index.html">Prueba</a>
      <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
    </header>


    
    <!-- Sidebar menu-->
    @include('elements.sidebar')
    <!-- End Sidebar-->

    @yield('content')

    <!-- Essential javascripts for application to work-->
    <script src="{{ URL::asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ URL::asset('js/popper.min.js') }}"></script>
    <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('js/main.js') }}"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="{{ URL::asset('js/plugins/pace.min.js') }}"></script>
    <!-- Page specific javascripts-->
    <script type="text/javascript" src="{{ URL::asset('js/plugins/chart.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/plugins/datatables/datatables.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/plugins/sweetalert2.all.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/plugins/select2.min.js') }}"></script>

    @yield('scripts')
  </body>
</html>