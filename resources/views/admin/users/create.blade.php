@extends('layouts.app')
@section('title', 'Inicio')
@section('content')



<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>Persona<small>Registrar</small></h1>
	<ol class="breadcrumb">
		<li><a href="{{ route('inicio') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
		<li><span class="fa fa-users"></span> Personas</li> 
		<li class="active"><a href="{{ route('admin.user.index') }}"><i class="fa fa-list"></i> Registrar Persona</a></li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
	<form action="{{ route('admin.user.store') }}" method="POST" accept-charset="utf-8">
		{{ csrf_field() }}
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title"><i class="fa fa-list"></i> Registrar Persona</h3>
				
			</div>
			<div class="box-body">
				<div class="container-fluid">
					<div class="row">

						@if ($errors->any())
						<div class="col-sm-12">
							<div class="alert alert-danger alert-dismissible">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<h4><i class="icon fa fa-ban"></i> Alerta!</h4>
								@foreach ($errors->all() as $error)
								<strong>·</strong> {{ $error }}
								<br>
								@endforeach
							</div>
						</div>
						@endif
						<div class="col-sm-6">
							<div class="form-group {{ $errors->has('rut') ? 'has-error' : '' }}">
								<label for="rut">Rut</label>
								<input type="text" class="form-control rut" name="rut" id="rut" placeholder="" value="{{ old('rut') }}" required>
								<!-- <p class="text-red">{{ $errors->first('rut') }}</p> -->
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
								<label for="name">Nombre</label>
								<input type="text" class="form-control" name="name" id="name" placeholder="" value="{{ old('name') }}" required>
								<!-- <p class="text-red">{{ $errors->first('name') }}</p> -->
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
								<label for="email">Correo</label>
								<input type="email" class="form-control" name="email" id="email" placeholder="" value="{{ old('email') }}" required>
								<!-- <p class="text-red">{{ $errors->first('email') }}</p> -->
							</div>
						</div>			
						<div class="col-sm-6" >
							<div class="form-group {{ $errors->has('apellido') ? 'has-error' : '' }}">
								<label for="apellido">Apellido</label>
								<input type="text" class="form-control" name="apellido" id="apellido" placeholder="" value="{{ old('apellido') }}" required>
								<!-- <p class="text-red">{{ $errors->first('apellido') }}</p> -->
							</div>		
						</div>
						<div class="col-sm-6" >
							<div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
								<label for="password">Contraseña</label>
								<input type="text" class="form-control" name="password" id="password" value="{{ old('password') }}" required>
								<!-- <p class="text-red">{{ $errors->first('password') }}</p> -->
							</div>		
						</div>
						<div class="col-sm-6" >
							<div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
								<label for="password">Confirmar Contraseña</label>
								<input type="text" class="form-control" name="password_confirmation" id="password_confirmation" value="" required>
							</div>		
						</div>
						<div class="col-sm-6">
							<div class="form-group {{ $errors->has('id_rol') ? 'has-error' : '' }}">
								<label for="id_oficina">Rol</label>
								<select class="form-control select2" name="id_rol" name="id_rol" required>
									<option value="" selected disabled>Seleccione una opción</option>
									@foreach($roles as $rol)
									@if ($rol->id == old('id_rol'))
									<option value="{{ $rol->id }}" selected>{{ $rol->rol }}</option>
									@else
									<option value="{{ $rol->id }}">{{ $rol->rol }}</option>
									@endif
									@endforeach
								</select>
								<!-- <p class="text-red">{{ $errors->first('id_rol') }}</p> -->
							</div>
						</div>
					</div>
				</div>

			</div>

			<div class="box-footer">
				<div class="container-fluid">
					<div class="row">
						<div class="col-sm-4">
							<a href="{{ URL::previous() }}" class="btn btn-default btn-flat btn-block"><i class="fa fa-reply"></i> Volver</a>
						</div>
						<div class="col-sm-4 pull-right">
							<button type="submit" class="btn btn-flat btn-primary btn-block">Registrar</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</section>


<!-- /.content -->

@section('script')
<script>
	$(document).ready(function() {
		$('.select2').select2({
			'width' : '100%',

			'language' : 'es'
		});
	});

	$('.rut').rut({
		formatear :true,
		placeholder: false,
		fn_error : function(input){
		}
	});

	$('.rut').trigger('blur');

	$('form').submit(function(event) {
		$(this).find('button').prop('disabled', true);
	});
</script>
@endsection

@endsection
