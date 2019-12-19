@extends('adminlte::page')

@section('title', 'Visualizar perfil')

@section('content_header')
<h1><i class="fas fa-fw fa-plus-square text-blue"></i>Agregar Cliente</h1>
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
                    <form class="form-horizontal" method="POST" action="{{ route('clients.store') }}" autocomplete="off">
                        @method('POST')
                        @csrf

                        <div class="form-group">
                            <label for="inputTypeRif" class="col-sm-2 control-label">Tipo de RIF</label>
                            <div class="col-sm-10">
                                <label class="radio-inline"><input onchange="cargarTC(this.value);" type="radio" name="inputTypeRif"  
                                    @if (old('inputTypeRif') == "V" )
                                        checked="checked" 
                                    @endif
                                    required value="V">V</label>
                                <label class="radio-inline"><input onchange="cargarTC(this.value);" type="radio" 
                                    @if (old('inputTypeRif') == "J" )
                                    checked="checked" 
                                    @endif
                                    name="inputTypeRif" value="J">J</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputRif" class="col-sm-2 control-label">RIF</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputRif" value="{{ old('inputRif')}}" pattern="[0-9]{9}" onchange="RIFrellenado(this.value)"  required name="inputRif">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputName" class="col-sm-2 control-label">Razon social</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputName" value="{{ old('inputName')}}" required name="inputName">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail" class="col-sm-2 control-label">Correo electronico</label>

                            <div class="col-sm-10">
                                <input type="email" class="form-control" value="{{ old('inputEmail')}}" id="inputEmail" required onchange="Emailrellenado(this.value)" name="inputEmail">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputStatus" class="col-sm-2 control-label">Estado</label>
                            <div id="inputStatus" class="col-sm-10">
                                <select name="inputStatus"required class="form-control col-sm-10">
                                    <option value="" disabled selected>Seleccione</option>
                                    <option value="activo">Activo</option>
                                    <option value="inactivo">Inactivo</option>
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
                            <div class="box box-primary">
                                <div class="box-header with-border text-center ">
                                    <h3 class="box-title ">SENIAT</h3>
                                </div>
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="inputSeniatUsuario" class="col-sm-3 control-label">Usuario</label>

                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{ old('inputSeniatUsuario')}}" id="inputSeniatUsuario" name="inputSeniatUsuario">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputSeniatPassword" class="col-sm-3 control-label">Contraseña</label>

                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{ old('inputSeniatPassword')}}" id="inputSeniatPassword" name="inputSeniatPassword">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- FAOV -->
                            <div class="box box-primary">
                                <div class="box-header with-border text-center ">
                                    <h3 class="box-title ">FAOV</h3>
                                </div>
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="inputFAOVUsuario" class="col-sm-3 control-label">Usuario</label>

                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{ old('inputFAOVUsuario')}}" id="inputFAOVUsuario" name="inputFAOVUsuario">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputFAOVPassword" class="col-sm-3 control-label">Contraseña</label>

                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{ old('inputFAOVPassword')}}" id="inputFAOVPassword" name="inputFAOVPassword">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- SIM -alcaldia -->
                            <div class="box box-primary">
                                <div class="box-header with-border text-center ">
                                    <h3 class="box-title ">SIM - Sistemas de tributos Alcaldía</h3>
                                </div>
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="inputSIMEmail" class="col-sm-3 control-label">Correo electronico</label>

                                        <div class="col-sm-9">
                                            <input type="email" class="form-control" value="{{ old('inputSIMEmail')}}" id="inputSIMEmail" name="inputSIMEmail">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputSIMPassword" class="col-sm-3 control-label">Contraseña</label>

                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{ old('inputSIMPassword')}}" id="inputSIMPassword" name="inputSIMPassword">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- IVSS -->
                            <div id="box-ivss" style="display: none" class="box box-primary">
                                <div class="box-header with-border text-center ">
                                    <h3 class="box-title ">IVSS</h3>
                                </div>
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="inputSIVSSnpatrono" class="col-sm-3 control-label">Numero de patrono</label>

                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{ old('inputIVSSnpatrono')}}" id="inputIVSSnpatrono" name="inputIVSSnpatrono">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputIVSSPassword" class="col-sm-3 control-label">Contraseña</label>

                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{ old('inputIVSSPassword')}}" id="inputIVSSPassword" name="inputIVSSPassword">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- INCES -->
                            <div id="box-inces" style="display: none" class="box box-primary">
                                <div class="box-header with-border text-center ">
                                    <h3 class="box-title ">INCES</h3>
                                </div>
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="inputINCESUsuario" class="col-sm-3 control-label">Usuario</label>

                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{ old('inputINCESUsuario')}}" id="inputINCESUsuario" name="inputINCESUsuario">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputINCESPassword" class="col-sm-3 control-label">Contraseña</label>

                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{ old('inputINCESPassword')}}" id="inputINCESPassword" name="inputINCESPassword">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>


                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Agregar</button>
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
        if ('{{old('inputTypeRif')}}' != '') {
            cargarTC('{{old('inputTypeRif')}}');
        }
    });


    function cargarTC(valor) {

        RIFrellenado($("#inputRif").val());
        Emailrellenado($("#inputEmail").val());

        $("#inputTC").html("");
        if (valor=="J") {

            $("#box-ivss").show();
            $("#box-inces").show();

            html ='<label class="radio-inline"><input type="radio" name="inputTC" @if (old("inputTC") == "formal" ) checked="checked" @endif required value="formal">Formal</label>';

            html +='<label class="radio-inline"><input type="radio" name="inputTC" @if (old("inputTC") == "especial" ) checked="checked" @endif value="especial">Especial</label>';

            html+='<label class="radio-inline"><input type="radio" name="inputTC" @if (old("inputTC") == "ordinario" ) checked="checked" @endif value="ordinario">Ordinario</label>';

            $("#inputTC").append(html);

        }else {
            $("#box-ivss").hide();
            $("#box-inces").hide();
            
            $("#inputTC").append('<label class="radio-inline"><input type="radio" name="inputTC" required checked="checked" value="ordinario">Ordinario</label>');
        }
        
        $("#accesos").show();

    }

    function RIFrellenado(valor) {
        if (valor!="") {

            TypeRif = $("input:radio[name=inputTypeRif]:checked").val();

            if (TypeRif) {

                $("#inputFAOVUsuario").val(TypeRif+valor+"01");

                if (TypeRif=="J") {
                    $("#inputINCESUsuario").val(TypeRif+valor);
                }
            }

        }

    }

    function Emailrellenado(valor) {
        if (valor!="") {
           $("#inputSIMEmail").val(valor);
        }
    }


</script>
@endsection()