@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>  @if(isset(Auth::user()->name))
      Selamat Datang {{Auth::user()->name}}
  @else
  <h1>Error</h1>
   @endif
      
      <br>
     
    </h1>
    <ol class="breadcrumb">
      <li><i class="fa fa-dashboard active"></i>Error</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
   
 
      <!--------------------------
        | Your Page Content Here |
        -------------------------->
       
        <div class="raw">
           <div class="col-xs-12">
            <div class="box-body table-responsive">
            
            <h2>Data Not Found...!</h2>
         
           </div>
            </div>

        </div>
       


    </section>
    <!-- /.content -->
  </div>

  @endsection