<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="icon" type="image/x-icon" href="http://sim.umg.ac.id/front/gate/images/favicon.png">
  <title>REPORTING - @yield('title')</title>

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
  href="{{url('css/font.css')}}?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

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
    
  <!-- AdminLTE App -->
  <script src="{{url('lte/dist/js/adminlte.min.js')}}"></script>
  <script src="{{url('js/sweetalert.min.js')}}"></script>
   <script src="{{url('js/chart/bootstrap-datepicker.min.js')}}"></script>
 
  <!-- DataTables -->
  <!-- <script src="{{url('lte/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
  <script src="{{url('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
-->
<!-- <script src="{{url('js/site.js')}}"></script> -->
</head>


<body class="hold-transition skin-yellow sidebar-mini">
  <?php 

  $id = Auth::user()->user_id;
  ?>

  <div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">

      <!-- Logo -->
      <a href="{{url('/home')}}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>SIM</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>REPORTING</b></span>
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
                <img src="{{ Storage::url(Auth::user()->foto) }}" class="user-image" alt="User Image">
                @else
                <img src="{{url('lte/dist/img/user.png')}}" class="user-image" alt="User Image">
                @endif
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span class="hidden-xs">{{ Auth::user()->username}}</span>
              </a>
              <ul class="dropdown-menu">
                <!-- The user image in the menu -->
                <li class="user-header">
                  @if(isset(Auth::user()->foto))
                  <img src="{{ Storage::url(Auth::user()->foto) }}" class="img-circle" alt="User Image">
                  @else
                  <img src="{{url('lte/dist/img/user.png')}}" class="img-circle" alt="User Image">
                  @endif

                  <p>
                    {{ Auth::user()->username }} - {{ Auth::user()->email }}
                    <small>{{ Auth::user()->prodi }}</small>
                  </p>
                </li>

                <!-- Menu Footer-->
                <li class="user-footer">

                  <div class="pull-right">
                    
                  <a class="btn btn-default btn-flat" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                      {{ __('Logout') }} 
                      <i class="fa fa-sign-out pull-right" style="margin-top:4px;"></i>
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
          <img src="{{ Storage::url(Auth::user()->foto) }}" class="img-circle" alt="User Image">
          @else
          <img src="{{url('lte/dist/img/user.png')}}" class="img-circle" alt="User Image">
          @endif
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->username }}</p>
          <!-- Status -->
        </div>
      </div>

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Main Menu</li>

        <li>

          <a href="{{url('/home')}}"><i class="fa fa-dashboard"></i>DASBORD</a></li>
          <li>
           @if(Auth::user()->role_id == '8')
           <li class="treeview " style="height: auto;">
            <a href="#">
              <i class="fa fa-pie-chart"></i>
              <span>REPORTING TU</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu" style="display: none;">
             <li>
              <a href="{{url('/reportingTU')}}"><i class="fa fa-circle-o"></i>PRESENSI MATKUL DOSEN</a></li>

            </ul>
           
          </li></a></l>

          @elseif(Auth::user()->role_id == '1')

          <li class="treeview " style="height: auto;">
            <a href="#">
              <i class="fa fa-pie-chart"></i>
              <span>REPORTING DOSEN</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu" style="display: none;">

              <li><a href="{{url('/RepotDosenID/'.$id)}}" id="1"><i class="fa fa-circle-o"></i>Presensi Dosen</a></li>
              <li><a href="{{url('/matkulID/'.$id)}}" id="1"><i class="fa fa-circle-o"></i> Presensi Mata kuliah Dosen</a></li>

            </ul>
          </li></a></l>

          @elseif(Auth::user()->role_id == '2')


          <li class="treeview " style="height: auto;">
            <a href="#">
              <i class="fa fa-pie-chart"></i>
              <span>KARYAWAN</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu" style="display: none;">

             <li>
              <a href="{{url('/RepotKaryawanID/'.$id)}}"><i class="fa fa-circle-o"></i>REPORTING KARYAWAN</a></li>


            </ul>
          </li></a></l>


          @elseif(Auth::user()->role_id == '7')
          <ul class="treeview-menu" style="display: block;">
          </ul>
          <li class="treeview " style="height: auto;">
            <a href="#">
              <i class="fa fa-pie-chart"></i>
              <span>REPORTING BSDM</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu" style="display: none;">
              <li><a href="{{url('/RepotDosen')}}" id="2"><i class="fa fa-circle-o"></i>Presensi Dosen</a></li>
              <li><a href="{{url('/RepotKaryawan')}}"><i class="fa fa-circle-o"></i> Presensi Karyawan</a></li>
               <li><a href="{{url('/reportingTU')}}"><i class="fa fa-circle-o"></i>Presensi Matkul Dosen</a></li>
            </ul>
          </li></a></l>

           <li class="treeview " style="height: auto;">
            <a href="#">
              <i class="fa fa-pie-chart"></i>
              <span>PENGATURAN</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu" style="display: none;">
                 <li><a href="{{url('/jabatan')}}" ><i class="fa fa-circle-o"></i>JABATAN</a></li>
          <li><a href="{{url('/periode')}}" ><i class="fa fa-circle-o"></i>PERIODE PRESENSI</a></li>
          <li><a href="{{url('/periode_matkul')}}" ><i class="fa fa-circle-o"></i>PERIODE PRESENSI MATKUL</a></li>
            </ul>
          </li></a></l>
                   @endif

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
        <strong>Copyright &copy; 2019 <a href="#">UMG</a>.</strong> All rights reserved.
      </footer>

  <!-- Add the sidebar's background. This div must be placed
    immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
  </div>
  <!-- ./wrapper -->

</body>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script> -->
<script type="text/javascript">

 $('#1').click(function(){
   localStorage.removeItem('Total');
   localStorage.role=1;
   console.log('1');

 });
 $('#2').click(function(){
    //alert('2');
    localStorage.role=2;
    console.log('2');

  });
 $('#logout').click(function(){
  localStorage.clear();
});
   // dateTo = moment().format('YYYY-MM-DD');
    //dateFrom = moment().subtract(6,'d').format('YYYY-MM-DD');

 /* const date = moment("2019-12-30");
 const dow = date.day(1);*/
// console.log(dateFrom);
</script>
</html>
