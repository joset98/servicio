@extends('adminlte::page')

@section('title', 'Visualizar perfil')

@section('content_header')
<h1><i class="fas fa-fw fa-user text-blue"></i> Perfil</h1>
@stop

@section('content')
<div class="container-fluid">

<div class="row">
        <div class="col-md-6 col-md-push-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="{{ asset('img/user.png') }}" alt="User profile picture">

              <h3 class="profile-username text-center">{{ Auth::user()->name }} {{ Auth::user()->lastname }}</h3>

              <p class="text-muted text-center">{{ Auth::user()->rol() }}</p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Cedula</b> <a class="pull-right">{{ Auth::user()->cedula }}</a>
                </li>
                <li class="list-group-item">
                  <b>Correo electronico</b> <a class="pull-right">{{ Auth::user()->email }}</a>
                </li>
                <li class="list-group-item">
                  <b>Telefono</b> <a class="pull-right">{{ Auth::user()->phone }}</a>
                </li>
              </ul>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->



        </div>
        <!-- /.col -->

      </div>
</div>
@stop