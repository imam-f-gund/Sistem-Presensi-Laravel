@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <?php 
 $id =  Auth::user()->role_id;
 

 ?>
 
  <section class="content-header">
    <h1>
      SELAMAT DATANG {{Auth::user()->name}}
      @if($id == '8')

      <small>DASBORD REPORTING TU</small>
      @elseif($id == '7')
      <small>DASBORD REPORTING BSDM</small>
      @elseif($id == '1')
      <small>DASBORD DOSEN</small>
      @elseif($id == '2')
      <small>DASBORD KARYAWAN</small>
      @endif

    </h1>
    <ol class="breadcrumb">
      <li><i class="fa fa-dashboard active"></i> Dashboard</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">


      <!--------------------------
        | Your Page Content Here |
        -------------------------->
        <div class="panel-heading">

        </div>
        <?php 
        use Illuminate\Support\Facades\DB;
      //  $id = Auth::user()->user_id;
        $kr = DB::table('karyawan')
        ->where('user_id', '=', $id)
        ->get();

        if ($kr == '[]') {
         $kr = DB::table('Dosen')
         ->where('user_id', '=', $id)
         ->get();

         $data = json_decode($kr, TRUE);
         foreach ($data as $dt) {
          $d = $dt['id_dosen'];
          Session::put('id_dosen', $d);
        }
      }else{
        $data = json_decode($kr, TRUE);
        foreach ($data as $dt) {
          $d = $dt['id_karyawan'];
          Session::put('id_karyawan', $d);

        }

      }

      ?>

      <div class="panel-body">
       @if($id == '8')

       {!! $chart->html() !!}
       <hr>
       {!!$pie->html() !!}
       @elseif($id == '7')
       <hr>
       {!!$pie2->html() !!}
       <hr>
       {!!$kar->html() !!}
       <hr>
       @elseif($id == '1')
       <hr>
       {!!$dos->html() !!}
       @elseif($id == '2')
       {!!$karyawan->html() !!}

       <hr>

       @endif
     </div>



   </div>
 </div>



</section>
<!-- /.content -->
</div>
{!! Charts::scripts() !!}
{!! $chart->script() !!}
{!! $pie->script() !!}
{!! $pie2->script() !!}
{!! $kar->script() !!}
{!! $dos->script() !!}
{!! $karyawan->script() !!}
@endsection