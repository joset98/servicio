@extends('adminlte::page')

@section('title', 'Visualizar perfil')

@section('content_header')
<div class="container justify-content-md-center">
    <h1> Editar</h1>
</div>
@stop

@section('content')
<div class="container-fluid">

    <div class="row">
        <div class="col-md-6 col-md-push-3">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Datos del usuario</h3>
                </div>
                <div class="box-body">
                    <form class="form-horizontal" method="POST" action="{{ route('users.update', $user -> cedula) }}" autocomplete="off">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="inputCedulaDisable" class="col-sm-2 control-label">Cedula</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputCedula" name="inputCedula" value="{{ $user->cedula }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputName" class="col-sm-2 control-label">Nombre</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="inputName" name="inputName" value="{{ $user->name }}">
                            </div>

                            <label for="inputLastName" class="col-sm-2 control-label">Apellido</label>

                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="inputLastName" name="inputLastName" value="{{ $user->lastname }}">
                            </div>
                        </div>
                        <div class="form-group">

                        </div>
                        <div class="form-group">
                            <label for="inputEmail" class="col-sm-2 control-label">Correo electronico</label>

                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="inputEmail" name="inputEmail" value="{{ $user->email }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPhone" class="col-sm-2 control-label">Telefono</label>

                            <div class="col-sm-10">
                                <input type="phone" class="form-control" id="inputPhone" name="inputPhone" pattern="[0-9]{11}" value="{{ $user->phone }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputRol" class="col-sm-2 control-label">Tipo de Usuario</label>
                            <div class="col-sm-10">
                                <label class="radio-inline"><input type="radio" name="inputRol" value="3" {{  ($user->r_name =="pasante") ? "checked" : "" }}>Pasante</label>
                                <label class="radio-inline"><input type="radio" name="inputRol" value="2" {{  ($user->r_name =="empleado") ? "checked" : "" }}>Empleado</label>
                                <label class="radio-inline"><input type="radio" name="inputRol" value="1" {{  ($user->r_name =="administrador") ? "checked" : "" }}>Administrador</label>
                            </div>
                        </div>

                        <div class="box-footer">
                            <a href="{{ route('users.index') }}" class="btn btn-default">Cancelar</a>
                            <button type="submit" class="btn btn-success pull-right">Actualizar</button>
                        </div>
                    </form>
                </div>
                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
        </div>
    </div>
</div>
@stop