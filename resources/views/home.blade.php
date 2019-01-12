@extends('layouts.app')
@section('title', 'Inicio')
@section('content')



<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Inicio
    <!-- <small>Optional description</small> -->
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content container-fluid">

  <div class="row">
    <div class="col-xs-12">               
      <div class="col-lg-12">    
        <div class="box box-primary box-solid">
          <div class="box-body">
            @include('layouts.partials.carousel')
          </div>
        </div>            
      </div>
    </div>
    
  </div>


</section>
<!-- /.content -->

@endsection
