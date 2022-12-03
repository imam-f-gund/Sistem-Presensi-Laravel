@extends('layouts.app')

@section('title', 'Reporting TU')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Selamat Datang {{Auth::user()->name}}
      <br>
      <small>Reporting TU <large class="text-bold">Presensi Mahasiswa </large> </small>
      <br>

      @foreach ($Dosen as $ii)
      <small>Dosen Pengampuh <large class="text-bold">{{$ii->name}}</large> </small>
       @endforeach
       
      <br>
       @foreach ($Matkul as $i)
      <small>Mata Kuliah <large class="text-bold">{{$i->nama_matkul}} </large> </small>
      @endforeach
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
           <a href="{{ url('downloadExcel/xls') }}"><button class="btn btn-success">Download Excel xls</button></a>
           <table id="example2" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
            <thead style="background-color:#343a40;color:white;border-color::#454d55;">
              <tr>

                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">NIM</th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" >NAME</th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" >DEVICE</th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" >KETERANGAN</th>
                 <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" >MATA KULIAH
                </th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" >MATERI
                </th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" >DATE
                </th><th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" >DAYS
                </th>
                

              </tr>
            </thead>
            <tbody>

              @foreach ($Presensi as $i => $blog)
              @php $class = $i % 2 === 0 ? 'even' : 'odd'; @endphp
              <tr class="{{$class}}">

               <td> {{$blog->nim}} </td>
               <td> {{$blog->name}} </td>
               <td> {{$blog->device}} </td>
               <td> {{$blog->keterangan}} </td>
                <td> {{$blog->nama_matkul}} </td>
               <td> {{$blog->materi}} </td>
               <td> {{$blog->created_at}} </td>
               <td> {{$blog->days}} </td>
             </tr>
             @endforeach
           </tbody>
         </table>


       </div>
       <!-- /.box-body -->
     </div>



     <script type="text/javascript">
       $('#example2').DataTable();
     </script>


   </section>
   <!-- /.content -->
 </div>

 @endsection