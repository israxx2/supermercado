
@if($resourceScript == 'general')
<!-- REQUIRED JS SCRIPTS -->
<!-- jQuery 3 -->
<script src="{{ asset('js/app.js') }}"></script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
Both of these plugins are recommended to enhance the
user experience. -->
@endif


@if($resourceScript == 'login')
<!-- Rut Chileno -->
<script src="{{ asset('js/app.js') }}"></script>
<script>
	$(function () {
		$('input').iCheck({
			checkboxClass: 'icheckbox_square-blue',
			radioClass: 'iradio_square-blue',
			increaseArea: '20%' /* optional */
		});
	});
</script>

@endif

@if($resourceScript == 'userCreate')
<!-- funciones genericas -->
<script src="{{ asset('js/app.js') }}"></script>

<script>
	function unblockUI(){
		$.unblockUI();
	};
	$(document).ajaxStart(function() {
		blockUI();
	}).ajaxStop(function() {
		unblockUI();
	});
</script>
@endif

@if($resourceScript == 'userIndex')
<script src="{{ asset('js/app.js') }}"></script>
<!-- Activa y desactiva pantalla de carga -->
<script>
	$(document).ajaxStart(function() {
		blockUI();
	}).ajaxStop(function() {
		unblockUI();
	});
</script>

@endif

@include('layouts.partials.notify')

<!-- AGREGAR NUEVOS RECURSOS DE SCRIPT ACA (ASIGNARLE UN VALOR A LA VARIABLE $resources Y ASIGNARSELA EN EL CONTROLADOR-->

@yield('script')

