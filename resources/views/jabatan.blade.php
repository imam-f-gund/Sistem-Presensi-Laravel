@extends('layouts.app')


@section('title', 'Dashboard')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Selamat Datang {{Auth::user()->username}}
      <small>Reporting Bsdm</small>
    </h1>
    @if(session()->has('error'))
    <div class="alert alert-warning">
      {{ session()->get('error') }}
    </div>
    @endif
     @if(session()->has('info'))
    <div class="alert alert-success">
      {{ session()->get('info') }}
    </div>
    @endif
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
             <h4>JABATAN</h4>
 <table id="example2" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
             <div>
            
           
            <thead style="background-color:#343a40;color:white;border-color::#454d55;">
              <tr>

               <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" >nama jabatan</th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" >Masukan jumlah jam</th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" >Masukan jumlah hari 1 minggu
                </th>
                 <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" >Jumlah jam minimal per hari
                </th>
                 <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" >Action
                </th>
               

              </tr>
            </thead>
           <tbody>
              @foreach ($jabatan as $i => $blog)
              @php $class = $i % 2 === 0 ? 'even' : 'odd'; @endphp
              <tr class="{{$class}}">
                 <form class="form" action=" {{url('/jabatan/'.$blog->id_jabatan)}}" method="post" enctype="multipart/form-data">
      {{ csrf_field() }}
      <input type="hidden" name="_method" value="PUT">
              
               <td> {{$blog->nama_jabatan}} </td>
               <td> <input type="text" name="jumlah_jam" value="{{$blog->jumlah_jam}}"></td>
               <td> <input type="text" name="jumlah_hari_1_minggu" value="{{$blog->jumlah_hari_1_minggu}}"></td>
               <td> <input type="text" name="jam_perhari" value="{{$blog->jam_perhari}}"></td>
              <td><button type="submit" class="btn btn-info">Update</button></td>
               
                 </form>
             </tr>
             @endforeach
           </tbody>
         </table>           </div>
          
       
       <!-- /.box-body -->
     </div>
       
  <script type="text/javascript">
   $('#exampleB0').DataTable();
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript">
   $(document).ready(function(){
    document.getElementById("Btnsort").disabled = true;
   });

  $('#prodi').click(function(e){
    var cat_id = e.target.value; 
     console.log(cat_id);
      if (cat_id == '.') {
        document.getElementById("Btnsort").disabled = true;
        }else{
        document.getElementById("Btnsort").disabled = false;
          localStorage.prodi=cat_id;
        }

  });
  $('#Btnsort').click(function(){
       var getProdi = localStorage.getItem('prodi');
       window.location = " {{url('/')}}/RepotDosen/"+getProdi; 
       
       
     });


</script>


    </section>
    <!-- /.content -->
  </div>

  @endsection