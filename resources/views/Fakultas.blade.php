@extends('layouts.app')

@section('title', 'Reporting TU')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Selamat Datang {{Auth::user()->name}}
      <small>REPORTING TU <large class="text-bold"></large></small>
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
       <div>
        <select class="form-control m-bot15" name="prodi" id="prodi">
          <option value="" name="">Pilih Prodi</option>
          <option value="null" name="">All</option>
          @foreach($FF as $k)
          <option value="{{$k->nama_prodi}}" name="{{$k->nama_prodi}}">{{$k->nama_prodi}}</option>
          @endForeach
        </select>
        <br>
        <button class="btn btn-success" id="Btnsort">Sort</button>
      </div>
      <br>
      <table id="example0" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
        <thead style="background-color:#343a40;color:white;border-color::#454d55;">
          <tr>
            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Nip</th>
            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Name</th>
            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Prodi</th>
            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Jenis Kelamin</th>
            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Alamat</th>
            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" >
            Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($pr as $i => $blog)
          @php $class = $i % 2 === 0 ? 'even' : 'odd'; @endphp
          <tr class="{{$class}}">
           <td> {{$blog->nip}}</td>
           <td> {{$blog->name}}</td>
           <td> {{$blog->nama_prodi}}</td>
           <td> {{$blog->jenis_kelamin}}</td>
           <td> {{$blog->alamat}}</td>
           <td><a href="{{url('/reportMatdos/'.$blog->id_dosen)}}" class="btn btn-success">PILIH</a>  </td>
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
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
       <script type="text/javascript">


        $('#prodi').click(function(e){
          var cat_id = e.target.value; 
          console.log(cat_id);
          localStorage.prodi=cat_id;

        });
        $('#Btnsort').click(function(){
         var getProdi = localStorage.getItem('prodi');
         if (getProdi == 'null') {

          window.location = "{{url('/RepotDosenMat/null')}}"; 
        }else{

         window.location = " {{url('/')}}/RepotDosenMat/"+getProdi; 
       }
     });
   </script>

 </section>
 <!-- /.content -->
</div>

@endsection