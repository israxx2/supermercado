
<div class="row">
	<div class="col-sm-6">
		<div class="form-group">
			<label>Mostrar</label>
			<select id="show_record" class="form-control select2" style="width: 100%">
				<option value="10">10 registros</option>
				<option value="25">25 registros</option>
				<option value="50">50 registros</option>
				<option value="100">100 registros</option>
				<option value="-1">Todos los registros</option>
			</select>
		</div>
	</div>

	<div class="col-sm-6">
		<div class="form-group">
			<label>Buscar</label>
			<input id="search_input" class="form-control" placeholder="EJ: Carlos Ortega">
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="row table-responsive no-left-right-margin">
			<div class="col-xs-12">
				<table id="user_table" class="table table-bordered" cellspacing="0" width="100%">
					<thead>
						<th class="text-center">Rut</th>
						<th class="text-center">Nombre</th>
						<th class="text-center">Apellido</th>
						<th class="text-center">Correo</th>
						<th class="text-center">Cargo</th>
						<th class="text-center"></th>    
					</thead>

				</table>
			</div>
		</div>
	</div>
</div>

<div class="modal modal-danger fade" id="delete_modal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
					<span aria-hidden="true">×</span>
				</button>
				<h4 class="modal-title"><i class="fa fa-question-circle margin-right-5"></i> <span>Eliminar Persona</span></h4>
			</div>
			<div class="modal-body">
				<p>¿Esta seguro que desea eliminar la persona: '<span id="valor_p"></span>' del sistema?.</p>
			</div> 
			<div class="modal-footer">
				<button type="button" class="btn btn-outline btn-flat pull-left" data-dismiss="modal"><strong>No, cancelar</strong></button>
				<form id="form" method="POST" accept-charset="utf-8">
					{{ csrf_field() }}
					{{ method_field('DELETE') }}
					<button type="submit" class="btn btn-outline btn-flat pull-right"><strong>Si, eliminar</strong></button>
				</form>
			</div>       
		</div>
	</div>        
</div>


@section('script')
<script>
	var table;
	var x;

		//PETICIÓN POR MEDIO DEL SERVIDOR
		$(document).ready(function() {
			
			
			$('[data-toggle="tooltip"]').tooltip();
			/*
			*	DATATABLE POR MEDIO DEL SERVIDOR
			*/

			$('.overlay').show();

			table = $('#user_table').DataTable({
				"processing": false,
				//"serverSide": true,
				"ajax": "{{ route('api.user.getdata') }}",
				"columns":[
				{"data": "rut"},
				{"data": "name"},
				{"data": "apellido"},
				{"data": "email"},
				{"data": "role.rol"},
				{"render" : function (data, type, row){
					html = '<div class="btn-group"><a data-toggle="tooltip" data-placement="top" title="Editar Persona" class="btn btn-primary btn-flat" href="/user/'+row['id']+'/edit/"><i class="fa fa-pencil"></i></a><a data-toggle="tooltip" data-placement="top" title="Eliminar Persona" class="btn btn-danger btn-flat" href="#"><i class="fa fa-trash"></i></a></div>';
					$('[data-toggle="tooltip"]').tooltip();
					return html;
				},
				"className": "text-center"
			}
			],
			"columnDefs": [
			{
				"targets": [ -1 ],
				"orderable": false,
			}
			],
			"createdRow": function ( row, data, index ) {

			},
			"paging": true,
			"info": true,
			"autoWidth": true,
			"bPaginate":true,
			"sPaginationType":"full_numbers",
			"bLengthChange": true,
			"bInfo" : true,
			"language": {
				"sProcessing":     "Procesando...",
				"sLengthMenu":     "Mostrar _MENU_ registros",
				"sZeroRecords":    "No se encontraron resultados",
				"sEmptyTable":     "Ningún dato disponible en esta tabla",
				"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
				"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
				"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
				"sInfoPostFix":    "",
				"sSearch":         "Buscar:",
				"sUrl":            "",
				"sInfoThousands":  ",",
				"sLoadingRecords": "Cargando...",
				"oPaginate": {
					"sFirst":    "Primero",
					"sLast":     "Último",
					"sNext":     "Siguiente",
					"sPrevious": "Anterior"
				}, 
				"oAria": {
					"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
					"sSortDescending": ": Activar para ordenar la columna de manera descendente"
				}
			},
		})

			$('.dataTables_length').addClass("hidden");
			$('.dataTables_filter').addClass("hidden");

		});

		/*
		*	DATATABLE POR MEDIO DEL CLIENTE

		$(document).ready(function() {
			table = $('#user_table').DataTable();

			$('[data-toggle="tooltip"]').tooltip();


		});

		*/

		//USAR SELECT PROPIO PARA CANTIDAD DE REGISTROS
		$('#show_record').click(function() {
			table.page.len($('#show_record').val()).draw();
			jQuery("#footer-left").text(jQuery("#tabla_inc_info").text());
		});

		//USAR INPUT PROPIO PARA FILTRO
		$('#search_input').keyup(function(){
			table.search($(this).val()).draw() ;
		})


		$(document).on('click', '#user_table tbody tr td .btn-danger', function(event) {
			var tr = $(this).closest('tr');
			var row = table.row(tr);
			var data = row.data();
			$('#valor_p').text(data['name']+' '+data['apellido']);
			$('#form').attr('action', "{{ route('admin.user.destroy', 'id') }}".replace("id", data['id']));
			$('#delete_modal').modal('toggle');
		});

		
	</script>

	@endsection
