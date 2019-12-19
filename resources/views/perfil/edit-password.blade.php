@extends('adminlte::page')

@section('title', 'Cambio de contraseña')

@section('content_header')
<h1><i class="fas fa-fw fa-lock text-blue"></i> Cambio de contraseña</h1>
@stop

@section('content')
<div class="container-fluid">

<div class="row">
        <div class="col-md-6 col-md-push-3">
          <div class="nav-tabs-custom">
    
            <div class="tab-content box box-primary">

              <div class="active tab-pane" id="settings">
                <form class="form-horizontal" method="POST" action="{{ route('perfil.password.update') }}" autocomplete="off">
                  @method('PUT')
                  @csrf
                  <div class="form-group">
                    <label for="passworda" class="col-sm-4 control-label">Contraseña actual</label>

                    <div class="col-sm-8">
                      <input type="password" class="form-control" id="passworda" name="passworda" required minlength="8" maxlength="12" placeholder="Contraseña actual">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="passwordn" class="col-sm-4 control-label">Nueva Contraseña</label>

                    <div class="col-sm-8">
                      <input type="password" class="form-control" id="passwordn" name="passwordn" required minlength="8" maxlength="12" placeholder="Nueva Contraseña">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="passwordc" class="col-sm-4 control-label">Confirmacion Contraseña</label>

                    <div class="col-sm-8">
                      <input type="password" class="form-control" id="passwordc" name="passwordc" required minlength="8" maxlength="12"  placeholder="Confirmacion Contraseña">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-8">
                      <button type="submit" class="btn btn-success">Modificar contraseña</button>
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