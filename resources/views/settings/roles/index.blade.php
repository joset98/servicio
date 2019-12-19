@extends('adminlte::page')

@section('css')

<style>
input[type=checkbox]
{
  /* Double-sized Checkboxes */
  -ms-transform: scale(1.2); /* IE */
  -moz-transform: scale(1.2); /* FF */
  -webkit-transform: scale(1.2); /* Safari and Chrome */
  -o-transform: scale(1.2); /* Opera */
  padding: 10px;
}

</style>
@stop

@section('title', 'Visualizar Roles')
@php
$index = 1
@endphp
@section('content_header')
<h1>Gestion de Permisos y Roles del Sistema</h1>

<div class="container-fluid">
  <div class="row">
    <div id="institutions" class="col-md-10 col-md-push-1 mt-5">
      <div class="box box-primary">

        <!-- /.box-header -->
        <div class="box-body">
        <form class="form-horizontal" method="POST" action="{{ route('roles.store') }}" autocomplete="off">             
              @method('POST')
                @csrf
          <table class="table table-bordered table-hover">
            <tbody>
              <tr>
                <th>ID</th>
                <th>Permisos</th>
                <th>Pasante</th>
                <th>Empleado</th>
                <th>Administrador</th>
              </tr>

             
              @foreach ($permissions as $permission)
              <tr>
                <td> {{$permission->id}}</td>
                <td> {{$permission->display_name}}</td>         
                <td class="text-center custom-checkbox">
                          <input type="checkbox" class="custom-control-input" name="{{$permission->name}}[]" value="3" 
                          {{$permission->role()->where('name','pasante')->exists()?'checked': ''}} >
                </td>
                        <td class="text-center custom-checkbox">
                          <input type="checkbox" class="custom-control-input" name="{{$permission->name}}[]" value="2" 
                          {{$permission->role()->where('name','empleado')->exists()? 'checked':''}}>
                </td>
                <td class="text-center custom-checkbox">
                          <input type="checkbox" class="custom-control-input" name="{{$permission->name}}[]" value="1" 
                          {{$permission->role()->where('name','administrador')->exists()? 'checked':''}} disabled>

                </td>
               
             
              </tr>
              @endforeach
            </tbody>
          </table>
          <div class="box-footer">
            <a href="{{ route('roles.index') }}" class="btn btn-default" >Restablecer</a>
            @permission('modificar_permisos') 
            <button type="submit" class="btn btn-success pull-right">Actualizar</button>
            @endpermission
         </div>
          </form>
        </div>
        <!-- /.box-body -->
      </div>
    </div>
  </div>
</div>
@stop


@section('js')
<script type="text/javascript" charset="utf8" src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
<script type="text/javascript" charset="utf8" src="{{ asset('js/dataTables.min.js') }}"></script>
<script type="text/javascript" charset="utf8" src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
@stop