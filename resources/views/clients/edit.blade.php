@extends('adminlte::page')

@section('title', 'Visualizar perfil')

@section('content_header')
<h1><i class="fas fa-fw fa-briefcase text-blue"></i> Editar Cliente - {{ strtoupper($cliente->name) }}</h1>
@stop

@section('content')
<div class="container-fluid">

    <div class="row">
        <div class="col-md-6 col-md-push-3">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Datos básicos</h3>
                </div>
                <div class="box-body">
                    <form class="form-horizontal" method="POST" action="{{ route('clients.update' ,$cliente->id) }}" autocomplete="off">
                        @method('PUT')
                        @csrf


                        <div class="form-group">
                            <label for="inputRif" class="col-sm-2 control-label">RIF</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputRif" value="{{$cliente->type_rif}}-{{$cliente->rif}}" disabled="disabled" name="inputRif">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputName" class="col-sm-2 control-label">Razon social</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control"  id="inputName" value="{{$cliente->name}}" required name="inputName">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail" class="col-sm-2 control-label">Correo electronico</label>

                            <div class="col-sm-10">
                                <input type="email" class="form-control" value="{{$cliente->email}}" id="inputEmail" required  name="inputEmail">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputStatus" class="col-sm-2 control-label">Estado</label>
                            <div id="inputStatus" class="col-sm-10">
                                <select name="inputStatus"required class="form-control col-sm-10">
                                    <option value="" disabled>Seleccione</option>
                                    <option  
                                    @if($cliente->status =="activo")
                                    selected
                                    @endif
                                    value="activo">Activo</option>
                                    <option                                     
                                    @if($cliente->status =="inactivo")
                                    selected
                                    @endif
                                    value="inactivo">Inactivo</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputTC" class="col-sm-2 control-label">Tipo de Usuario</label>
                            <div id="inputTC" class="col-sm-10">
                                <span></span>
                                <label class="radio-inline"><input type="radio" name="inputTC" required value="3" disabled>Seleccione el tipo de RIF</label>
                            </div>
                        </div>

                        <div id="accesos" style="display: none;">
                            
                            <!-- Titulo accesos -->
                            <div class="box-header with-border ">
                                <h3 class="box-title">Accesos</h3>
                            </div>

                            <!-- SENIAT -->
        @foreach ($cliente->access as $acceso)
        @if  ($acceso->id_institution == "1" || $acceso->id_institution == "2")
                            <div class="box box-primary">
                                <div class="box-header with-border text-center ">
                                     <h3 class="profile-username text-center">{{ $acceso->institution->name}}<img class="img-responsive" style="margin: 0 auto;" width="15%" src="{{ asset('img/institutions') }}/{{ $acceso->institution->image}}" alt="User profile picture"></h3>

                                </div>
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="inputSeniatUsuario" class="col-sm-3 control-label">Usuario</label>

                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{ $acceso->user}}" id="inputSeniatUsuario" name="inputSeniatUsuario">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputSeniatPassword" class="col-sm-3 control-label">Contraseña</label>

                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{ $acceso->password}}" id="inputSeniatPassword" name="inputSeniatPassword">
                                        </div>
                                    </div>
                                </div>
                            </div>
        @endif
        @endforeach

                            
                            <!-- FAOV -->
        @foreach ($cliente->access as $acceso)
        @if  ($acceso->id_institution == "5")
                            <div class="box box-primary">
                                <div class="box-header with-border text-center ">
                                   <h3 class="profile-username text-center">{{ $acceso->institution->name}}<img class="img-responsive" style="margin: 0 auto;" width="15%" src="{{ asset('img/institutions') }}/{{ $acceso->institution->image}}" alt="User profile picture"></h3>
                                </div>
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="inputFAOVUsuario" class="col-sm-3 control-label">Usuario</label>

                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{ $acceso->user}}" id="inputFAOVUsuario" name="inputFAOVUsuario">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputFAOVPassword" class="col-sm-3 control-label">Contraseña</label>

                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{ $acceso->password}}" id="inputFAOVPassword" name="inputFAOVPassword">
                                        </div>
                                    </div>
                                </div>
                            </div>
        @endif
        @endforeach

                            <!-- SIM -alcaldia -->
        @foreach ($cliente->access as $acceso)
        @if  ($acceso->id_institution == "6")

                            <div class="box box-primary">
                                <div class="box-header with-border text-center ">
                                   <h3 class="profile-username text-center">{{ $acceso->institution->name}}<img class="img-responsive" style="margin: 0 auto;" width="15%" src="{{ asset('img/institutions') }}/{{ $acceso->institution->image}}" alt="User profile picture"></h3>
                                </div>
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="inputSIMEmail" class="col-sm-3 control-label">Correo electronico</label>

                                        <div class="col-sm-9">
                                            <input type="email" class="form-control" value="{{ $acceso->user}}" id="inputSIMEmail" name="inputSIMEmail">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputSIMPassword" class="col-sm-3 control-label">Contraseña</label>

                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{ $acceso->password}}" id="inputSIMPassword" name="inputSIMPassword">
                                        </div>
                                    </div>
                                </div>
                            </div>

        @endif
        @endforeach
@if  ($cliente->type_rif == "J")

                            <!-- IVSS -->
        @foreach ($cliente->access as $acceso)
        @if  ($acceso->id_institution == "3")

                            <div id="box-ivss" style="display: none" class="box box-primary">
                                <div class="box-header with-border text-center ">
                                   <h3 class="profile-username text-center">{{ $acceso->institution->name}}<img class="img-responsive" style="margin: 0 auto;" width="15%" src="{{ asset('img/institutions') }}/{{ $acceso->institution->image}}" alt="User profile picture"></h3>
                                </div>
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="inputSIVSSnpatrono" class="col-sm-3 control-label">Numero de patrono</label>

                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{ $acceso->user}}" id="inputIVSSnpatrono" name="inputIVSSnpatrono">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputIVSSPassword" class="col-sm-3 control-label">Contraseña</label>

                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{ $acceso->password}}" id="inputIVSSPassword" name="inputIVSSPassword">
                                        </div>
                                    </div>
                                </div>
                            </div>

        @endif
        @endforeach

                            <!-- INCES -->

        @foreach ($cliente->access as $acceso)
        @if  ($acceso->id_institution == "4")

                            <div id="box-inces" style="display: none" class="box box-primary">
                                <div class="box-header with-border text-center ">
                                   <h3 class="profile-username text-center">{{ $acceso->institution->name}}<img class="img-responsive" style="margin: 0 auto;" width="15%" src="{{ asset('img/institutions') }}/{{ $acceso->institution->image}}" alt="User profile picture"></h3>
                                </div>
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="inputINCESUsuario" class="col-sm-3 control-label">Usuario</label>

                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{ $acceso->user}}" id="inputINCESUsuario" name="inputINCESUsuario">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputINCESPassword" class="col-sm-3 control-label">Contraseña</label>

                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{ $acceso->password}}" id="inputINCESPassword" name="inputINCESPassword">
                                        </div>
                                    </div>
                                </div>
                            </div>

        @endif
        @endforeach

    @endif

                        </div>


                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Actualizar</button>
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

@section('js')
<script>

    $( document ).ready(function() {
        if ('{{$cliente->type_rif}}' != '') {
            cargarTC('{{$cliente->type_rif}}');
        }
    });


    function cargarTC(valor) {

        $("#inputTC").html("");
        if (valor=="J") {

            $("#box-ivss").show();
            $("#box-inces").show();

            html ='<label class="radio-inline"><input type="radio" name="inputTC" @if ($cliente->type == "formal" ) checked="checked" @endif required value="formal">Formal</label>';

            html +='<label class="radio-inline"><input type="radio" name="inputTC" @if ($cliente->type == "especial" ) checked="checked" @endif value="especial">Especial</label>';

            html+='<label class="radio-inline"><input type="radio" name="inputTC" @if ($cliente->type == "ordinario" ) checked="checked" @endif value="ordinario">Ordinario</label>';

            $("#inputTC").append(html);

        }else {
            $("#box-ivss").hide();
            $("#box-inces").hide();
            
            $("#inputTC").append('<label class="radio-inline"><input type="radio" name="inputTC" required checked="checked" value="ordinario">Ordinario</label>');
        }
        
        $("#accesos").show();

    }

</script>
@endsection()