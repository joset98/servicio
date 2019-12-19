@extends('adminlte::page')

@section('css')

<link rel="stylesheet" href="{{ asset('css/users_custom.css') }}">
@stop

@section('title', 'Antesala Crear Tarea')

@section('content_header')
<h1><i class="fas fa-fw fa-plus text-blue"></i>Crear Tarea</h1>
@stop


@section('content')
	<div class="container-fluid" style="padding-top: 1em;">

		<div id="box-select-task" class="row">
			<div class="col-md-10 col-md-push-1 mt-5">
				<div class="box box-info">
					<div class="box-header with-border text-center">
						<h3 class="box-title">Seleccione el tipo de Tarea a crear</h3>
					</div>
				</div>
			</div>
			<div class="col-md-10 col-md-push-1 mt-5" style="display: flex;justify-content: center;vertical-align: middle;">
				
				<div id="task_simple" class="col-lg-3 col-xs-6">
					<!-- small box -->
					<div class="small-box bg-aqua">
						<div class="inner">
							<h3>Simple</h3>

							<p>No estará asociada a ningun cliente</p>
						</div>
						<div class="icon">
							<i class="ion ion-cube"></i>
						</div>
						<a href="{{route('tasks.createsubmit', '0')}}" class="small-box-footer"><i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
				<!-- ./col -->
				<div  id="task_client" class="col-lg-3 col-xs-6">
					<!-- small box -->
					<div class="small-box bg-green">
						<div class="inner">
							<h3>De cliente</h3>

							<p>Estará asociada a un cliente específico</p>
						</div>
						<div class="icon">
							<i class="ion ion-briefcase"></i>
						</div>
						<a href="#" class="small-box-footer"><i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>
			</div>
		</div>

		<div id="box-select-client" class="row" style="display: none;">

			<div class="col-md-10 col-md-push-1 mt-5">
				<div class="box box-success">
					<div class="box-header with-border text-center">
						<h3 class="box-title">Seleccione el cliente al cual se le creara la tarea</h3>
					</div>
				</div>
			</div>

			<div class="col-md-10 col-md-push-1 mt-5">

				<div class="box box-primary">
					<div class="box-body">
						<table id="clients" class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>RIF</th>
									<th>Nombre</th>
									<th>Tipo</th>
									<th width="115px">Acciones</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
		
			</div>
			<div class="col-md-10 col-md-push-1 text-center" style="padding-bottom: 1em;">
				<button class="back_to_select btn btn-success text-center"><span class="glyphicon glyphicon-arrow-left"></span> Regresar</button>
			</div>

		</div>

	</div>
@stop

@section('js')


<script>
	$(document).ready(function() {

		//Boton Tarea Simple
		$('body').on('click', '#task_simple', function(e) {
			e.preventDefault();
			ruta = $('#task_simple .small-box-footer').attr('href');
			$(location).attr('href', ruta);
		});

		//Boton Tarea CLient
		$('body').on('click', '#task_client', function(e) {
			e.preventDefault();
			$('#box-select-client').slideDown();
			$('#box-select-task').slideUp();
			iniciarDatatable();
		});

		//Boton Regresar a Seleccion
		$('body').on('click', '.back_to_select', function(e) {
			e.preventDefault();
			$('#box-select-client').slideUp();
			$('#box-select-task').slideDown();
			$('#clients').DataTable().destroy();
		});


	});

	function iniciarDatatable() {
		$('#clients').DataTable({
			// "serverSide": true, //Procesa la consulta del lado del servidor
			"ajax": "{{ route('clients.index') }}",
			"columns": [
			{
				render: function(data, type, row) {
					return (row.type_rif+"-"+row.rif);
				}
			},
			{
				data: 'name'
			},
			{
				render: function(data, type, row) {
					return (row.type.toUpperCase());
				}
			},
			{
				render: function(data, type, row) {
					btn ="<div class='botonera-table'>";

					btn += '<button class="select-modal btn btn-info" data-id=' +row.id + '><span class="fas fa-fw fa-check-square"></span></button></div>';

					return (btn);
				}
			},
			],
			"language": {
				"sProcessing": "Procesando...",
				"sLengthMenu": "Mostrar _MENU_ registros",
				"sZeroRecords": "No se encontraron resultados",
				"sEmptyTable": "No existen clientes registrados",
				"sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
				"sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
				"sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
				"sInfoPostFix": "",
				"sSearch": "Buscar:",
				"sUrl": "",
				"sInfoThousands": ",",
				"sLoadingRecords": "Cargando...",
				"oPaginate": {
					"sFirst": "Primero",
					"sLast": "Último",
					"sNext": "Siguiente",
					"sPrevious": "Anterior"
				},
				"oAria": {
					"sSortAscending": ": Activar para ordenar la columna de manera ascendente",
					"sSortDescending": ": Activar para ordenar la columna de manera descendente"
				}
			}
		});

		$("select").val('10');
		$('select').addClass("browser-default");

        //Boton editar
        $('body').on('click', '.select-modal', function(e) {
            e.preventDefault();
            id = $(this).attr('data-id');
            ruta = "{{route('tasks.createsubmit', '')}}/"+id;
            $(location).attr('href', ruta);
        });
	}

</script>
@stop