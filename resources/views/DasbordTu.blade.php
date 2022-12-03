@extends('layouts.app')

@section('title', 'Reporting TU')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Selamat Datang {{Auth::user()->name}}
      <br>
      <small>Reporting TU <large class="text-bold"></large> </small>
     
    </h1>
    <ol class="breadcrumb">
      <li><i class="fa fa-dashboard active"></i> Dashboard</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">


<div class="box">
          <!-- /.box-header -->
          <div class="box-body table-responsive">
           <div class="box-header">

           </div>

           <table id="example0" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
            <thead style="background-color:#343a40;color:white;border-color::#454d55;">
              <tr>

                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">nama Prodi</th>
               
               
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" >
                Action</th>

              </tr>
            </thead>
            <tbody>
              @foreach ($pr as $i => $blog)
              @php $class = $i % 2 === 0 ? 'even' : 'odd'; @endphp
              <tr class="{{$class}}">
                <?php
                  $id_fakultas = $blog->id_fakultas;
                  ?>
               <td> {{$blog->nama_prodi}}</td>
               <td><a href="{{url('/reportMatdos/'.$id_fakultas)}}" class="btn btn-success">PILIH</a>  </td>

             </tr>
             @endforeach
           </tbody>
         </table>


       </div>
       <!-- /.box-body -->
     </div>

   
 
      <!--------------------------
        | Your Page Content Here |
        -------------------------->
       
        <script type="text/javascript">
   $('#example0').DataTable();
</script>

       


    </section>
    <!-- /.content -->
  </div>

  @endsection