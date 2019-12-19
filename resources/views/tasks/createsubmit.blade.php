@extends('adminlte::page')

@section('title', 'Crear Tarea')

@section('title', 'Crear Tarea')

@section('content_header')
<h1><i class="fas fa-fw fa-plus text-blue"></i>Crear Tarea</h1>
@stop

@section('content')
<div class="container-fluid">

	<div class="row">
		<div class="col-md-6 col-md-push-3">
			
			@if ($client != null)
			<!-- Datos del cliente -->
			<div class="box box-primary">
				<div class="box-body box-profile">
					<div class="box-header with-border">
						<h3 class="box-title">Datos del cliente</h3>
					</div>
					<h3 class="profile-username text-center">{{ strtoupper($client->name) }}</h3>

					<p class="text-muted text-center"></p>

					<ul class="list-group list-group-unbordered">
						<li class="list-group-item">
							<b>RIF</b> <a class="pull-right">{{ $client->type_rif}}-{{ $client->rif}}</a>
						</li>
						<li class="list-group-item">
							<b>Contribuyente</b> <a class="pull-right">{{ strtoupper($client->type) }}</a>
						</li>
						<li class="list-group-item">
							<b>Estado</b> <a class="pull-right">{{ strtoupper($client->status) }}</a>
						</li>
					</ul>

				</div>
			</div>
			<!-- /.box-body client -->

			@endif       


			<div class="box box-success" style="margin-bottom: 0px;">
				<div class="box-header with-border">
					<h3 class="box-title">Datos de la tarea a crear</h3>
				</div>
				<div class="box-body">
					<form class="form-horizontal" method="POST" action="{{ route('users.store') }}" autocomplete="off">
						@method('POST')
						@csrf
						<div class="form-group">
							<label for="inputTitle" class="col-sm-2 control-label">Título</label>

							<div class="col-sm-10">
								<input type="text" class="form-control" id="inputTitle" name="inputTitle" value="{{ old('inputTitle') }}">
							</div>
						</div>
						<div class="form-group">
							<label for="inputDescription" class="col-sm-2 control-label">Descripción</label>
							<div class="col-sm-10">
								<textarea class="form-control" name="inputDescription" rows="3" placeholder="Escriba una descripción sobre la tarea..."></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="inputDate" class="col-sm-2 control-label">Fecha de Vencimiento:</label>

							<div class="col-sm-10">
								<div class="input-group date">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input type="text" name="inputDate" class="form-control pull-right" id="datepicker">
								</div>
							</div>

						</div>


						<div class="form-group">
							<label for="inputTime" class="col-sm-2 control-label">Hora:</label>

							<div class="col-sm-10">
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-clock"></i>
									</div>
									<input type="text" name="inputTime" class="form-control timepicker">

								</div>
							</div>

						</div>

						@if ($client != null)
						<div class="form-group">
							<label for="inputInstitution" class="col-sm-2 control-label">Institución</label>
							<div id="inputInstitution" class="col-sm-10">
								<select name="inputInstitution"required class="form-control col-sm-10">
									<option value="" disabled selected>Seleccione</option>
									@foreach ($client->access as $acceso)
									<option value="{{ $acceso->institution->id}}">{{ $acceso->institution->name}}</option>
									@endforeach
									<option value="0">No aplica</option>
								</select>
							</div>
						</div>
						@endif

                        <div class="form-group">
                            <label for="inputTypeRif" class="col-sm-4 control-label">Asignar esta tarea a un usuario</label>
                            <div class="col-sm-8">
                                <label class="radio-inline"><input onchange="SelectUser(this.value);" type="radio" name="inputTypeRif" required value="si">Si</label>
                                <label class="radio-inline"><input onchange="SelectUser(this.value);" type="radio" name="inputTypeRif" value="no">No</label>
                            </div>
                        </div>

				</div>
			</div>
			<div id="box-select-user" style="display: none;">
				<div class="box box-success">
					<div class="box-header with-border text-center">
						<h3 class="box-title">Seleccione el cliente al cual se le creara la tarea</h3>
					</div>
				</div>

				<div class="box box-primary">
					<div class="box-body">

						<table id="table_users" class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>ID</th>
									<th>Cedula</th>
									<th>Nombre</th>
									<th>Rol</th>
									<th>acciones</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</div>

			<div class="box-footer">
				<a href="{{ route('users.index') }}" class="btn btn-default" >Cancelar</a>
				<button type="submit" class="btn btn-success pull-right">Crear</button>
			</div>
			</form>

		</div>

	</div>

</div>
@stop

@section('js')


<script>
	$(document).ready(function() {

		$( "#datepicker" ).datepicker();
		$( ".timepicker" ).timepicker({ defaultTime: '12',});

	});

	function SelectUser(valor){
		if (valor=="si") {
			$('#box-select-user').slideDown();
			iniciarDatatable();
		} else {
			$('#box-select-user').slideUp();
			$('#table_users').DataTable().destroy();

		}

	}

	function iniciarDatatable() {
		$('#table_users').DataTable({
			"ajax": "{{ route('users.index') }}",
			"columns": [{
				data: 'id'
                },
                {
                    data: 'cedula'
                },
                {
                    data: 'name'
                },
                {
                	data: 'r_name'
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
                "sEmptyTable": "No existen profesores registrados",
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


	}

</script>
@stop