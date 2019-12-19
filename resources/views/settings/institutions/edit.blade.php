@extends('adminlte::page')

@section('title', 'Editar Institución')

@section('content_header')
<h1><i class="fas fa-fw fa-edit text-blue"></i> Editar Institución - {{ $institucion->name }}</h1>
@stop

@section('content')
<div class="container-fluid">

<div class="row ">
        <div class="col-md-6 col-md-push-3 ">
          <div class="nav-tabs-custom">
    
            <div class="tab-content box box-primary">

              <div class="active tab-pane" id="settings">
                <form class="form-horizontal" method="POST" action="{{ route('institution.update',$institucion->id) }}" autocomplete="off">
                  @method('PUT')
                  @csrf
                  <div class="form-group">
                    <div class="col-sm-12 text-center">
                      <img src="{{ asset('img/institutions') }}/{{ $institucion->image }}" width="400px" alt="">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Nombre</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" name="inputName" disabled value="{{ $institucion->name }}">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputUrl" class="col-sm-2 control-label">URL</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputUrl" name="inputUrl" value="{{ $institucion->url }}">
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