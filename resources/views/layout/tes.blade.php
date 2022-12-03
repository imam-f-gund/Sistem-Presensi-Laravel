<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link rel="icon" type="image/x-icon" href="http://sim.umg.ac.id/front/gate/images/favicon.png">
    <title>Parkir umg - @yield('title')</title>

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{url('lte/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">

  <link rel="stylesheet" href="{{url('css/main.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{url('lte/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{url('lte/bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{url('lte/dist/css/AdminLTE.min.css')}}">

  <link rel="stylesheet" href="{{url('lte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">

  <link rel="stylesheet" href="{{url('lte/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">

  <link rel="stylesheet" href="{{url('lte/bower_components/morris.js/morris.css')}}">

  <link rel="stylesheet" href="{{url('lte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">

  <link rel="stylesheet" href="{{url('lte/dist/css/skins/skin-blue.min.css')}}">

  <link rel="stylesheet" href="{{url('css/progress-tracker.css')}}">
  

  <!-- <link rel="stylesheet" href="{{url('css/site.css')}}"> -->

  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <!-- REQUIRED JS SCRIPTS -->

  <!-- jQuery 3 -->
  <script src="{{url('lte/bower_components/jquery/dist/jquery.min.js')}}"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="{{url('lte/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
  <!-- DataTables -->
  <script src="{{url('lte/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
  <script src="{{url('lte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
  <!-- Morris.js charts -->
  <script src="{{url('lte/bower_components/raphael/raphael.min.js')}}"></script>
  <script src="{{url('lte/bower_components/morris.js/morris.min.js')}}"></script>
  <!-- Sparkline -->
  <script src="{{url('lte/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
  <!-- jvectormap -->
  <script src="{{url('lte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
  <script src="{{url('lte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
  <!-- jQuery Knob Chart -->
  <script src="{{url('lte/bower_components/jquery-knob/dist/jquery.knob.min.js')}}"></script>
  <!-- bootstrap datepicker -->
  <script src="{{url('lte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
  <script src="{{url('lte/bower_components/moment/min/moment.min.js')}}"></script>
  <script src="{{url('lte/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/locale/id.js" integrity="sha256-5aLk1fogTLyWd3GNewO2j33+AtT02NYcGkkskO+3EQQ=" crossorigin="anonymous"></script>
  
  <!-- AdminLTE App -->
  <script src="{{url('lte/dist/js/adminlte.min.js')}}"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


  
  <!-- <script src="{{url('js/site.js')}}"></script> -->
</head>

@if(Auth::user()->bagian == 'user')
<body class="hold-transition skin-green sidebar-mini">
@elseif(Auth::user()->bagian == 'admin')
<body class="hold-transition skin-yellow sidebar-mini">
@elseif(Auth::user()->bagian == 'admin2')
<body class="hold-transition skin-red sidebar-mini">
<!-- @elseif(Auth::user()->bagian == 'lpm')
<body class="hold-transition skin-purple sidebar-mini">
@elseif(Auth::user()->bagian == 'kepala lppm')
<body class="hold-transition skin-blue sidebar-mini">
@elseif(Auth::user()->bagian == 'prodi')
<body class="hold-transition skin-blue-light sidebar-mini"> -->
@endif
<div class="wrapper">
  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="{{url('/dashboard')}}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>Park</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Parkir UMG</b></span>
    </a>

    <!-- Header Navbar -->
    
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
      
        <ul class="nav navbar-nav">

          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              @if(isset(Auth::user()->foto))
                <img src="{{url(Auth::user()->foto) }}" class="user-image" alt="User Image">
              @else
                <img src="{{url('lte/dist/img/user.png')}}" class="user-image" alt="User Image">
              @endif
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs">{{ Auth::user()->name }}</span>

              
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
              @if(isset(Auth::user()->foto))
              <img src="{{ url(Auth::user()->foto) }}" class="img-circle" alt="User Image">
              @else
              <img src="{{url('lte/dist/img/user.png')}}" class="img-circle" alt="User Image">
              @endif

                <p>
                {{ Auth::user()->name }}
                <small>{{ Auth::user()->email }}</small>
                </p>
              </li>
              
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  @if(Auth::user()->bagian == 'user')
                  <a href="{{url('profileadmin/')}}" class="btn btn-default btn-flat">Profile</a>
                  @elseif(Auth::user()->bagian == 'admin')
                  <a href="{{url('profileadmin/')}}" class="btn btn-default btn-flat">Profile</a>
                  @endif
                </div>
                <div class="pull-right">
                    <a class="btn btn-default btn-flat" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
    
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
        @if(isset(Auth::user()->foto))
        <img src="{{ url(Auth::user()->foto) }}" class="img-circle" alt="User Image">
        @else
        <img src="{{url('lte/dist/img/user.png')}}" class="img-circle" alt="User Image">
        @endif
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
          <small>{{ Auth::user()->email }}</small>
          </P>
          <!-- Status -->
        </div>
      </div>

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Main Menu</li>
        <!-- Optionally, you can add icons to the links -->
        @if(Auth::user()->bagian == 'user')
        <li class="{{ (request()->is('/home')) ? 'active' : '' }}"><a href="{{url('/home')}}"><i class="fa fa-home"></i> <span>H O M E</span></a></li>
        <li class="{{ (request()->is('parkiran/')) ? 'active' : '' }}"><a href="{{url('parkiran/')}}"><i class="fa fa-motorcycle" aria-hidden="true"></i> <span>Data Parkir</span></a></li>

        @elseif(Auth::user()->bagian == 'admin')
        <li class="{{ (request()->is('/home')) ? 'active' : '' }}"><a href="{{url('/home')}}"><i class="fa fa-home"></i> <span>H O M E</span></a></li>
        <li class="{{ (request()->is('parkiran/')) ? 'active' : '' }}"><a href="{{url('parkiran/')}}"><i class="fa fa-motorcycle" aria-hidden="true"></i> <span>Data Parkir</span></a></li>
        <li class="{{ (request()->is('parkir/')) ? 'active' : '' }}"><a href="{{url('parkir/')}}"><i class="fa fa-motorcycle" aria-hidden="true"></i> <span>Data Parkir 2</span></a></li>
        @endif
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  @yield('content')

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; UMG 2019 <a href="#">Company</a>.</strong> All rights reserved.
  </footer>

  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
</body>
</html>
