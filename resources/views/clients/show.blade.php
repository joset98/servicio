@extends('adminlte::page')

@section('title', 'Visualizar cliente')

@section('content_header')
<h1><i class="fas fa-fw fa-briefcase text-blue"></i> Cliente - {{ strtoupper($cliente->name) }}</h1>
@stop

@section('content')
<div class="container-fluid">

<div class="row">
  
      @permission('actualizar_cliente')
        <div class="col-md-10 col-md-push-1 text-right" style="padding-bottom: 1em;">
            <button class="add-task-modal btn btn-primary text-right"><span class="glyphicon glyphicon-plus"></span> Crear Tarea</button>
            <button class="edit-modal btn btn-success text-right"><span class="glyphicon glyphicon-edit"></span> Editar</button>
        </div> 
      @endpermission

        <div class="col-md-6 col-md-push-3">

          <!-- Datos del cliente -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <div class="box-header with-border">
                <h3 class="box-title">Datos básicos</h3>
              </div>
              <h3 class="profile-username text-center">{{ strtoupper($cliente->name) }}</h3>

              <p class="text-muted text-center"></p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>RIF</b> <a class="pull-right">{{ $cliente->type_rif}}-{{ $cliente->rif}}</a>
                </li>
                <li class="list-group-item">
                  <b>Correo electronico</b> <a class="pull-right">{{ $cliente->email}}</a>
                </li>
                <li class="list-group-item">
                  <b>Contribuyente</b> <a class="pull-right">{{ strtoupper($cliente->type) }}</a>
                </li>
                <li class="list-group-item">
                  <b>Estado</b> <a class="pull-right">{{ strtoupper($cliente->status) }}</a>
                </li>
              </ul>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->



          <div class="box box-success">
            <div class="box-body box-profile">
              <div class="box-header text-center ">
                <h3 class="box-title">Accesos</h3>
              </div>
            </div>
            <!-- /.box-body -->
          </div>

          <!-- Accesos -->
          @foreach ($cliente->access as $acceso)
          <div class="box box-primary">
            <div class="box-body box-profile">
              <h3 class="profile-username text-center">{{ $acceso->institution->name}}</h3>
              <img class="img-responsive" style="margin: 0 auto;" width="40%" src="{{ asset('img/institutions') }}/{{ $acceso->institution->image}}" alt="User profile picture">

              <p class="text-muted text-center"></p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Usuario</b> <a class="pull-right">{{ $acceso->user }}</a>
                </li>
                <li class="list-group-item">
                  <b>Contraseña</b> <a class="pull-right">{{ $acceso->password }}</a>
                </li>
                <li class="list-group-item text-center">
                  <a class="btn btn-primary" target="_blank" href="{{ $acceso->institution->url}}">Acceder</a>
                </li>
              </ul>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
@endforeach

        </div>
        <!-- /.col -->

      </div>
</div>
@stop

@section('js')


<script>
    $(document).ready(function() {

        //Boton Agregar
        $('body').on('click', '.edit-modal', function(e) {
            e.preventDefault();
            ruta = "{{ route('clients.edit', $cliente->id)}}";
            $(location).attr('href', ruta);
        });

        $('body').on('click', '.add-task-modal', function(e) {
            e.preventDefault();
            ruta = "{{ route('tasks.createsubmit', $cliente->id)}}";
            $(location).attr('href', ruta);
        });

    });
</script>
@stop