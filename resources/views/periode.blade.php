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
             <h4>PERIODE PRESENSI</h4>
            <br />
            <table id="example2" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
             <div>
              <thead style="background-color:#343a40;color:white;border-color::#454d55;">
                <tr>
                 <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" >Nama Periode</th>
                 <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" >Awal Periode
                 </th>
                 <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" >Akhir Periode
                 </th>
                 <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" >Jumlah Hari Libur
                 </th>
                 <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" >Action
                 </th>
               </tr>
             </thead>
             <tbody>
               <form class="form" action="{{url('/periode_post')}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <td><input type="text" name="nama_periode" value=""></td>
                <td><div >
                  <input data-provide="datepicker" type="text" name="awal_periode" id="awal_periode" class="form-control" placeholder="awal periode" />
                </div></td>
                <td><div>
                  <input data-provide="datepicker" type="text" name="akhir_periode" id="akhir_periode" class="form-control" placeholder="akhir periode" />
                </div></td>
                <!-- <td> <input type="text" name="awal_periode" value=""></td> -->
                <!-- <td> <input type="text" name="akhir_periode" value=""></td> -->
                <td> <input type="text" name="jumlah_hari_libur" value=""></td>
                <td><button type="submit" class="btn btn-success">simpan</button></td>
              </form>
            </tbody>
          </table>
          <br />
          <table id="example2" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
           <div>
            <thead style="background-color:#343a40;color:white;border-color::#454d55;">
              <tr>
               <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" >Masukan Nama Periode</th>
               <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" >Masukan Awal Periode
               </th>
               <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" >Masukan Akhir Periode
               </th>
               <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" >Masukan Jumlah Hari Libur
               </th>
               <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" >Masukan Action Edit
               </th>
               <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" >Masukan Acrion Delete
               </th>
            </tr>
           </thead>
           <tbody>
           </tr>
           @foreach ($periode as $i => $blog)
           @php $class = $i % 2 === 0 ? 'even' : 'odd'; @endphp
           <tr class="{{$class}}">

             <form class="form" action=" {{url('/periode/'.$blog->id_periode)}}" method="post" enctype="multipart/form-data">
              {{ csrf_field() }}
              <input type="hidden" name="_method" value="PUT">
              <td> <input type="text" name="nama_periode" value="{{$blog->nama_periode}}"></td>
              <!-- <td><div >
                <input data-provide="datepicker" type="text" name="awal_periode" id="awal_periode" class="form-control" placeholder="{{$blog->awal_periode}}" />
              </div></td>
              <td><div >
                <input data-provide="datepicker" type="text" name="akhir_periode" id="awal_periode" class="form-control" placeholder="{{$blog->akhir_periode}}" />
              </div></td> -->
              <td> <input type="text" name="awal_periode" class="" value="{{$blog->awal_periode}}"></td>
              <td> <input type="text" name="akhir_periode" class="" value="{{$blog->akhir_periode}}"></td>
              <td> <input type="text" name="jumlah_hari_libur" value="{{$blog->jumlah_hari_libur}}"></td>
              <td><button type="submit" class="btn btn-info">Update</button></td>
            </form>
            <form class="form" action="{{url('/periode_delete/'.$blog->id_periode)}}" method="post">
              <td><button type="submit" name="submit" class="btn btn-warning" >Delete</button></td>
              {{ csrf_field() }}<!-- token wajib -->
              <input type="hidden" name="_method" value="DELETE">
            </form>
          </tr>
          @endforeach

        </tbody>
      </table>           </div>


      <!-- /.box-body -->
    </div>

    <script type="text/javascript">
      $("#awal_periode" ).datepicker({
        format: "yyyy-mm-dd",
        weekStart: 0,
        calendarWeeks: true,
        autoclose: true,

        orientation: "auto"
      });
      $("#akhir_periode" ).datepicker({
        format: "yyyy-mm-dd",
        weekStart: 0,
        calendarWeeks: true,
        autoclose: true,
        orientation: "auto"
      });
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