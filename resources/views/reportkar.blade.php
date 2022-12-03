@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Selamat Datang {{Auth::user()->name}}
      <br>
      <small>Reporting Presensi <large class="text-bold"></large> </small>

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

        <div class="box">
          <!-- /.box-header -->
          <div class="box-body table-responsive">
           <div class="box-header">

           </div>

           <table id="e" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
            <thead style="background-color:#343a40;color:white;border-color::#454d55;">
              <tr>

                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Nip</th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" >Name</th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" >Jenis Kelamin</th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" >Alamat</th>
                   <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" >Action</th>
                

              </tr>
            </thead>
            <tbody>
              @foreach ($kar as $i => $blog)
              @php $class = $i % 2 === 0 ? 'even' : 'odd'; @endphp
              <tr class="{{$class}}">

                <td> {{$blog->nip}}</td>
                <td> {{$blog->name}} </td>
                <td> {{$blog->jenis_kelamin}}  </td>
                <td> {{$blog->alamat}}  </td>
                <td><a href="{{url('/PresensiKar/'.$blog->id_karyawan)}}" class="btn btn-success">PILIH</a>  </td>

              </tr>
              @endforeach
            </tbody>
          </table>


        </div>
        <!-- /.box-body -->
      </div>



      <script type="text/javascript">
       $('#e').DataTable();
     </script>



   </section>
   <!-- /.content -->
 </div>

 @endsection