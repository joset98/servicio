@extends('adminlte::page')

@section('title', 'Visualizar perfil')

@section('content_header')
<h1>Insertar nuevo usuario </h1>
@stop

@section('content')
<div class="container-fluid">

    <div class="row">
        <div class="col-md-6 col-md-push-3">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Rellene el formulario</h3>
                </div>
                <div class="box-body">
                    <form class="form-horizontal" method="POST" action="{{ route('users.store') }}" autocomplete="off">
                        @method('POST')
                        @csrf

                        <div class="form-group">
                            <label for="inputCedula" class="col-sm-2 control-label">Cedula</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputCedula" name="inputCedula" pattern="[0-9]{3,20}" value="{{ old('inputCedula') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputName" class="col-sm-2 control-label">Nombre</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputName" name="inputName" value="{{ old('inputName') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputLastName" class="col-sm-2 control-label">Apellido</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputLastName" name="inputLastName" value="{{ old('inputLastName') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail" class="col-sm-2 control-label">Correo electronico</label>

                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="inputEmail" name="inputEmail" value="{{ old('inputEmail') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPhone" class="col-sm-2 control-label">Telefono</label>

                            <div class="col-sm-10">
                                <input type="phone" class="form-control" id="inputPhone" name="inputPhone" pattern="[0-9]{11}" value="{{ old('inputPhone') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputRol" class="col-sm-2 control-label">Tipo de Usuario</label>
                            <div class="col-sm-10">
                                <label class="radio-inline"><input type="radio" name="inputRol" value="3">Pasante</label>
                                <label class="radio-inline"><input type="radio" name="inputRol" value="2">Empleado</label>
                                <label class="radio-inline"><input type="radio" name="inputRol" value="1">Administrador</label>
                            </div>
                        </div>

                        <div class="box-footer">
                            <a href="{{ route('users.index') }}" class="btn btn-default" >Cancelar</a>
                            <button type="submit" class="btn btn-success pull-right">Crear</button>
                        </div>
                    </form>
                </div>
                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
        </div>
        <!-- /.nav-tabs-custom -->
    </div>


</div>
</div>
@stop