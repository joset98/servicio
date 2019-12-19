@extends('adminlte::page')

@section('title', 'Actualizar perfil')

@section('content_header')
<h1><i class="fas fa-fw fa-edit text-blue"></i> Actualizar perfil</h1>
@stop

@section('content')
<div class="container-fluid">

<div class="row ">
        <div class="col-md-6 col-md-push-3 ">
          <div class="nav-tabs-custom">
    
            <div class="tab-content box box-primary">

              <div class="active tab-pane" id="settings">
                <form class="form-horizontal" method="POST" action="{{ route('perfil.update') }}" autocomplete="off">
                  @method('PUT')
                  @csrf
                  <div class="form-group">
                    <label for="inputCedulaDisable" class="col-sm-2 control-label">Cedula</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputCedulaDisable" name="inputCedulaDisable" disabled value="{{ Auth::user()->cedula }}">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Nombre</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" name="inputName" value="{{ Auth::user()->name }}">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputLastName" class="col-sm-2 control-label">Apellido</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputLastName" name="inputLastName" value="{{ Auth::user()->lastname }}">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Correo electronico</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputEmail" name="inputEmail" value="{{ Auth::user()->email }}">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPhone" class="col-sm-2 control-label">Telefono</label>

                    <div class="col-sm-10">
                      <input type="phone" class="form-control" id="inputPhone" name="inputPhone" pattern="[0-9]{11}" value="{{ Auth::user()->phone }}">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-success">Actualizar</button>
                    </div>
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