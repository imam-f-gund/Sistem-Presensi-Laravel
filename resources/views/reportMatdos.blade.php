@extends('layouts.app')

@section('title', 'Reporting Matkul')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Selamat Datang {{Auth::user()->name}}
      <br>
      <small>Reporting Matkul <large class="text-bold"></large> </small>
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
        <h3 class="box-title"></h3>
      </div>
      <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
        <thead style="background-color:#343a40;color:white;border-color::#454d55;">
          <tr>

            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Nama Matkul</th>
            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" >Kode Matkul</th>
            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" >Sks</th>
             <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" >Action</th>

          </tr>
        </thead>
        <tbody>
          @foreach ($Dosen as $i => $blog)
          @php $class = $i % 2 === 0 ? 'even' : 'odd'; @endphp
          <tr class="{{$class}}">
           <td class="sorting_1">{{$blog->nama_matkul}} </td>
           <td> {{$blog->kode_matkul}} </td>
           <td>{{$blog->sks}}</td>
           <td>  <a href="{{url('/matkul/'.$blog->id_matkul)}}" class="btn btn-success">PILIH</a></td> 

         </tr>
         @endforeach
       </tbody>
     </table>


   </div>
   <!-- /.box-body -->
 </div>



 <script type="text/javascript">
   $('#example1').DataTable();
 </script>

</section>

<!-- /.content -->
</div>

@endsection