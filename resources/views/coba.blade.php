@extends('layouts.app')

@section('title', 'Reporting TU')

@section('content')
<div class="content-wrapper">

  <!-- Content Header (Page header) -->
  <style>
    body {
      margin: 0;
      padding: 0;
      width: 100%;
      height: 100%;
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column
    }

    canvas {
      position: absolute;
      top: 0;
      left: 0;
    }
  </style>
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
             <input type="file" id="imageUpload">
  <video id="video" width="640" height="480" autoplay muted></video>
<button id="snap">Snap Photo</button>
<canvas id="canvas" width="640" height="480"></canvas>
           </div>



       </div>
       <!-- /.box-body -->
     </div>

   
 
      <!--------------------------
        | Your Page Content Here |
        -------------------------->
       
        <script type="text/javascript">
   $('#example0').DataTable();
</script>
<script type="text/javascript">
 var video = document.getElementById('video');
var canvas = document.getElementById('canvas');
var context = canvas.getContext('2d');


// Get access to the camera!
if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
    // Not adding `{ audio: true }` since we only want video now
    navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {
        //video.src = window.URL.createObjectURL(stream);
        video.srcObject = stream;
        video.play();
    });
}



// Trigger photo take
document.getElementById("snap").addEventListener("click", function() {
  context.drawImage(video, 0, 0, 640, 480);
});
</script>
       


    </section>
    <!-- /.content -->
  </div>

  @endsection