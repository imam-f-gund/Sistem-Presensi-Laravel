@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Selamat Datang {{Auth::user()->name}}
      <br>
      <small>Reporting Presensi <large class="text-bold"><!-- {{$Dos->name}} - {{$Dos->nip}} --></large> </small>

    </h1>
    <ol class="breadcrumb">
      <li><i class="fa fa-dashboard active"></i> Dashboard</li>
    </ol>
  </section>
  <?php
    $id =Auth::user()->role_id;
    ?>

  <!-- Main content -->
  <section class="content">


      <!--------------------------
        | Your Page Content Here |
        -------------------------->

        <div class="box">
          <!-- /.box-header -->
          <div class="box-body table-responsive">
           <div class="box-header">
            <h3 class="box-title">{{$Dos->name}} - {{$Dos->nip}}</h3>
          </div>
          <div>
            <select class="form-control m-bot15" name="role_tahun" id="tahun">
             <option  id="" >Pilih Tahun</option>
             <option value="null"  id="aa" >All</option>
             @foreach($D as $role)

             <option value="{{$role}}"  id="aa" >{{$role}}</option>
             @endForeach


           </select>

           <select class="form-control m-bot15" name="bulan" id="bulan">
            <option>Pilih Bulan</option>

            <option value="null"  name="null">All</option>
            @foreach($M as $bulan)

            <option value="{{$bulan}}" name="{{$bulan}}">{{$bulan}}</option>
            @endForeach


          </select>
          <button class="btn btn-success" id="Btnsort">Sort</button>
          <p>
           @if($id == '7')
          <form class="form" action=" {{url('/hitung_periode')}}" method="post" enctype="multipart/form-data">
           {{ csrf_field() }}
           <select class="form-control m-bot15" name="role_periode" id="periode">
             <option  id="" >Pilih periode</option>
             
             @foreach($periode as $role)

             <option value="{{$role->id_periode}}">{{$role->nama_periode}} awal :  {{$role->awal_periode}} dan akhir : {{$role->akhir_periode}} - hari libur : {{$role->jumlah_hari_libur}}</option>
             @endForeach


           </select>
           <button class="btn btn-primary"  type="submit">hitung</button>
         </form>
         @if($message == 'AMAN')
          <td class="col-md-4"><div class="alert alert-info">{{$message}}</div></td>
       @elseif($message == 'PERINGATAN')
        <td class="col-md-4"><div class="alert alert-warning">{{$message}}</div></td>
       @endif
       
        <td class="col-md-4"><div class="aria-label">Total jam masuk : {{$total}}</div></td>
        <td class="col-md-4"><div class="aria-label">jumlah hari aktif : {{$hari_aktif}}</div></td>

         @endif
        <tr>
        </div>
        <br/>
        <!-- <div class="row input-daterange">
          <div class="col-md-4">
            <input data-provide="datepicker" type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date" />
          </div>
          <div class="col-md-4">
            <input data-provide="datepicker" type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" />
          </div>

          <div class="col-md-4">
           <input type="text" name="" id="total" class="form-control" placeholder="total" readonly />
         </div>
         <br>
         <div class="col-md-4">
          <button type="button" name="filter" id="sum" class="btn btn-primary">Cek Total Masuk</button>
          

        </div>

      </div> -->
      <br />


      <a href="{{ url('downloadExcelDos/xls') }}" ><button class="btn btn-success" >Download Excel xls</button></a>
         <!-- <a href="{{ url('filter/11') }}"><button class="btn btn-success">11</button></a>
           <a href="{{ url('filter/12') }}"><button class="btn btn-success">12</button></a> -->


           <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
            <thead style="background-color:#343a40;color:white;border-color::#454d55;">
              <tr>


                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">NIP</th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">NAME</th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">DATE</th>


                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" >DAYS</th>

                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" >HISTORY</th>


                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" >JAM MASUK</th>

                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label=
                "CSS grade: activate to sort column ascending" >VALIDASI</th>

                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" >HISTORY</th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" >JAM KELUAR</th>
              
                 <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" >VALIDASI</th>

                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label=
                "CSS grade: activate to sort column ascending" >TOTAL JAM</th>

                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" >DEVICE</th>
            
             <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" >KETERANGAN</th>
              </tr>

            </thead>
            <tbody>
              @foreach ($Dosen as $i => $blog)
              @php $class = $i % 2 === 0 ? 'even' : 'odd'; @endphp
              <tr class="{{$class}}">

               
               <td> {{$blog->nip}}  </td>
               <td> {{$blog->name}}   </td>
               <td> {{$blog->tanggal}} </td>
               <td> {{$blog->hari}} </td>
               <td> {{$blog->ketmasuk}} </td>
               <td> {{$blog->jammasuk}} </td>
               <td> {{$blog->valmas}} </td>
                <td> {{$blog->ketkeluar}} </td>
               <td> {{$blog->jamkeluar}} </td>
               <td> {{$blog->valkel}} </td>
               <td> {{$blog->totjam}} </td>
               <td> {{$blog->device}} </td>
                <td> {{$blog->keterangan}} </td>

          </tr>
          @endforeach
        </tbody>
      </table>


    </div>
    <!-- /.box-body -->
  </div>

  <script type="text/javascript">
    $(document).ready(function(){  
      var sum = localStorage.getItem('total');
      document.getElementById('total').value =sum;
      document.getElementById("Btnsort").disabled = true;
      
    });

    $("#from_date" ).datepicker({
      format: "yyyy-mm-dd",
      weekStart: 0,
      calendarWeeks: true,
      autoclose: true,

      orientation: "auto"
    });
    $("#to_date" ).datepicker({
      format: "yyyy-mm-dd",
      weekStart: 0,
      calendarWeeks: true,
      autoclose: true,
      orientation: "auto"
    });

    $('.datepicker').datepicker();

    $('#example1').DataTable();
  </script>
  <!--  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
  <script type="text/JavaScript">

    function from(id){
     document.getElementById('from_date').value =id;
     
   }
   function to(id){
     document.getElementById('to_date').value =id;

   }

   $('#refresh').click(function(){
    localStorage.removeItem('total');
     // document.getElementById('from_date').value =id;
     document.getElementById('total').value ='total';
   });


   $('#sum').click(function(){
     var from=$("#from_date").val();
     var to=$("#to_date").val();
     if($.trim(from).length>0 & $.trim(to).length>0 ){

       $.ajax({
        type: "GET",
        url:"/totaldos/"+from+"/"+to,
        crossDomain: true,
        cache: false,
        success: function(data){

          console.log(data);

          localStorage.total=data[0].timesum;
          window.location = "/totaldosF/"+from+"/"+to;


        },
        error: function(err){
          console.log(err);

        }
      });



     }else{
      alert('Mohon Masukan Data From Date Dan To Date Terlebih Dahulu..! ')
    }

  });


   $('#1').click(function(data){
     localStorage.removeItem('total');
     localStorage.role=1;
   });
   $('#2').click(function(data){
    localStorage.role=2;

  });
   $('#Btnsort').click(function(){
     var tahun = localStorage.getItem('tahun');
     var bulan = localStorage.getItem('bulan');
     var role = localStorage.getItem('role');
     console.log(role);
     localStorage.removeItem('total');
    
     if (role == 1) {
       if (tahun == '.' && bulan == '.') {

       }else if (bulan == 'null' && tahun == 'null') {

         window.location = "{{url('/RepotDosenIDAll')}}";

       }else if (bulan == 'null' && tahun != 'null') {
        window.location = "{{url('/')}}/filter/"+tahun; 
      } else if (tahun != 'null' && bulan != 'null') {

       window.location = "{{url('/')}}/filter/"+bulan+"/"+tahun; 
       localStorage.bulan = 'null';
     }else if (tahun == 'null' && bulan != 'null'){
     }

   }else if(role == 2){
     if (tahun == '.' && bulan == '.') {

     }else if (bulan == 'null' && tahun == 'null') {

       window.location = "{{url('/reportdosR')}}";

     }else if (bulan == 'null' && tahun != 'null') {
      
      window.location = "{{url('/')}}/filter/"+tahun; 
    } else if (tahun != 'null' && bulan != 'null') {

     window.location = "{{url('/')}}/filter/"+bulan+"/"+tahun; 
     localStorage.bulan = 'null';
   }else if (tahun == 'null' && bulan != 'null'){

   }
 }

});

   $('#bulan').click(function(e){

     console.log(e);
     // alert(e);
     var cat_id = e.target.value; 
     console.log(cat_id);

     if (cat_id == 'January') {
      document.getElementById("Btnsort").disabled = false;
      var m = cat_id;
      var res = m.replace("January", "1"); 
      localStorage.bulan=res;
    }else if (cat_id == 'February') {
      document.getElementById("Btnsort").disabled = false;
      var m = cat_id;
      var res = m.replace("February", "2"); 
      localStorage.bulan=res;
    }else if (cat_id == 'March') {
      document.getElementById("Btnsort").disabled = false;
      var m = cat_id;
      var res = m.replace("March", "3"); 
      localStorage.bulan=res;
    }else if (cat_id == 'April') {
      document.getElementById("Btnsort").disabled = false;
      var m = cat_id;
      var res = m.replace("April", "4"); 
      localStorage.bulan=res;
    }else if (cat_id == 'Mey') {
      document.getElementById("Btnsort").disabled = false;
      var m = cat_id;
      var res = m.replace("Mey", "5"); 
      localStorage.bulan=res;
    }else if (cat_id == 'June') {
      document.getElementById("Btnsort").disabled = false;
      var m = cat_id;
      var res = m.replace("June", "6"); 
      localStorage.bulan=res;
    }else if (cat_id == 'July') {
      document.getElementById("Btnsort").disabled = false;
      var m = cat_id;
      var res = m.replace("July", "7"); 
      localStorage.bulan=res;
    }else if (cat_id == 'August') {
      document.getElementById("Btnsort").disabled = false;
      var m = cat_id;
      var res = m.replace("August", "8"); 
      localStorage.bulan=res;
    }else if (cat_id == 'September') {
      document.getElementById("Btnsort").disabled = false;
      var m = cat_id;
      var res = m.replace("September", "9"); 
      localStorage.bulan=res;
    }else if (cat_id == 'October') {
      document.getElementById("Btnsort").disabled = false;
      var m = cat_id;
      var res = m.replace("October", "10"); 
      localStorage.bulan=res;
    }else if (cat_id == 'November') {
      document.getElementById("Btnsort").disabled = false;
      var m = cat_id;
      var res = m.replace("November", "11");
      localStorage.bulan=res;
    }else if (cat_id == 'December') {
      document.getElementById("Btnsort").disabled = false;
      var m = cat_id;
      var res = m.replace("December", "12");
      localStorage.bulan=res;
    }else if (cat_id == 'null') {
      var m = cat_id;
      localStorage.bulan=m;
      document.getElementById("Btnsort").disabled = false;
    }else{
      document.getElementById("Btnsort").disabled = true;
    }

  });
   $(document).ready(function(){

     var d = new Date();
     var n = d.getFullYear();
     $('#tahun').click(function(e){
       var cat_id = e.target.value; 
       console.log(cat_id);
       localStorage.tahun=cat_id;
     });
   });

 </script>

</section>
<!-- /.content -->  
</div>

@endsection