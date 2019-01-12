@extends('layouts.app')
@section('title', 'Inicio')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>Persona<small>Ver</small></h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('inicio') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
    <li><span class="fa fa-users"></span> Personas</li> 
    <li class="active"><a href="{{ route('admin.user.index') }}"><i class="fa fa-list"></i> Ver Persona</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title"><i class="fa fa-list"></i> Ver Persona</h3>
    </div>
    <div class="box-body">

      @include('admin.users.data_table')

    </div>

    <div class="box-footer">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-4">
            <a href="{{ URL::previous() }}" class="btn btn-default btn-flat btn-block"><i class="fa fa-reply"></i> Volver</a>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>

</section>
<!-- /.content -->

@endsection
