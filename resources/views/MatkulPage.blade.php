@extends('layouts.app')

@section('title', 'Reporting TU')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Selamat Datang {{Auth::user()->name}}
      <br>            
      <?php
      $id =Auth::user()->role_id;
      ?>
      <small>Reporting TU <large class="text-bold"> Matkul </large> </small>
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
        @if($message == 'null')
        @elseif($message != 'null')
        @if($message == 'PERINGATAN')
        <td class="col-md-4"><div class="alert alert-warning">{{$message}}</div></td>
        @elseif($message == 'AMAN')
        <td class="col-md-4"><div class="alert alert-info">{{$message}}</div></td>
        @endif
        <td class="col-md-4"><div class="aria-label-bold">TOTAL SKS: {{$total}}</div></td>
        <td class="col-md-4"><div class="aria-label">jumlah mengajar : {{$hari_aktif}}</div></td>
        @endif
      </div>
      <br>
      <table id="example2" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
       <div>
         <select class="form-control m-bot15" name="role_tahun" id="tahun">
           <option value=""  id="" >Tahun Ajaran</option>
           @foreach($D as $role)
           <option value="{{$role}}"  id="aa" >{{$role}}</option>
           @endForeach
         </select>
         <button class="btn btn-success" id="Btnsort">Sort</button>
       </div>
       <br>
       <div>
        <form  action=" {{url('/hitung_sks')}}" method="post" enctype="multipart/form-data">
         {{ csrf_field() }}
         @if($id == '7')
         <select class="form-control m-bot15" name="periode_matkul" id="matkul">
           <option value=""  id="null" >periode presensi matkul dosen</option>
           @foreach($periode_matkul as $role)
           <option value="{{$role->id_periode_matkul}}"  id="aa" >{{$role->nama_periode}} : {{$role->periode_awal}} - {{$role->periode_akhir}} : Max Sks {{$role->jumlah_sks}}</option>
           @endForeach
         </select>
         <button class="btn btn-primary"  type="submit" id="hitung">Hitung</button>
         @endif
       </form>
     </div>
     <br>
     <a href="{{ url('downloadExcelMatDos/xls') }}"><button class="btn btn-success">Download Excel xls</button></a>
     <br>
     <br>
     <thead style="background-color:#343a40;color:white;border-color::#454d55;">
      <tr>
        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" >Keterangan</th>
        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" >Materi
        </th>
        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" >
        Date Mulai</th>
        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" >
        Date Selesai</th>
        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" >
        Total Jam</th>
        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" >
        Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($Matkul as $i => $blog)
      @php $class = $i % 2 === 0 ? 'even' : 'odd'; @endphp
      <tr class="{{$class}}">
       <td> {{$blog->keterangan}} </td>
       <td> {{$blog->materi}} </td>
       <td> {{$blog->jam_masuk}} </td>
       <td> {{$blog->jam_pulang}} </td>
       <td> {{$blog->total}} </td>
       <td>  <a href=" {{url('/MPresensiMhs/'.$blog->id_matkul.'/'.$blog->id_presensi_matkul)}}" class="btn btn-success">PILIH</a></td>
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
<script type="text/javascript">
 $(document).ready(function(){
   document.getElementById("hitung").disabled = true;
 });
</script>
<script type="text/javascript">
  $(document).ready(function(){
   document.getElementById("Btnsort").disabled = true;
   $('#Btnsort').click(function(){
     //        alert('jj');
     var tahun = localStorage.getItem('tahun');
     var role = localStorage.getItem('role');
     if (tahun == 'null') {

       window.location = " {{url('/')}}/matkulR";
     }else if (tahun != 'null') {
      window.location = " {{url('/')}}/filterThMat/"+tahun; 
    }
  });
   var d = new Date();
   var n = d.getFullYear();
   $('#tahun').click(function(e){
     // console.log(e);
     var cat_id = e.target.value; 
     console.log(cat_id);
     localStorage.tahun=cat_id;
     if (cat_id != '') {
       document.getElementById("Btnsort").disabled = false;
     }
   });
   $('#matkul').click(function(e){
     // console.log(e);
     var cat_id = e.target.value; 
     console.log(cat_id);
    // localStorage.a=cat_id;
    if (cat_id != '') {
     document.getElementById("hitung").disabled = false;
   }else if(cat_id == ''){
     document.getElementById("hitung").disabled = true;
   }
 });
 });
</script>
</section>
<!-- /.content -->
</div>

@endsection