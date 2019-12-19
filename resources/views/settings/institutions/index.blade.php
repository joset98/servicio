@extends('adminlte::page')

@section('css')

@stop

@section('title', 'Visualizar instituciones')

@section('content_header')
<h1><i class="fas fa-fw fa-university text-blue"></i>Instituciones</h1>

<div class="container-fluid">

  <div class="row">

    <div id="institutions" class="col-md-10 col-md-push-1 mt-5">

      <div class="box box-primary">

        <!-- /.box-header -->
        <div class="box-body">
          <table class="table table-bordered table-hover">
            <tbody>
            <tr>
              <th style="width: 10px"></th>
              <th>Nombre</th>
              <th>Url</th>
              <th style="width: 40px">Acciones</th>
            </tr>

            @foreach ($instituciones as $institucion)

            <tr>
              <td><img src="{{ asset('img/institutions') }}/{{ $institucion->image }}" width="200px" alt=""></td>
              <td>{{ $institucion->name }}</td>
              <td><a href="{{ $institucion->url }}" target="_blank">{{ $institucion->url }}</a></td>
              <td>
                @permission('actualizar_institucion')
                  <button class="edit-modal btn btn-info" data-id="{{ $institucion->id }}"><span class="glyphicon glyphicon-edit"></span> Editar</button>
                @endpermission
              </td>
            </tr>

            @endforeach

          </tbody></table>
        </div>
        <!-- /.box-body -->

      </div>

    </div>

  </div>

</div>
@stop

@section('js')
<script>
  $(document).ready(function() {
        //Boton editar
        $('body').on('click', '.edit-modal', function(e) {
            e.preventDefault();
            id = $(this).attr('data-id');
            ruta = "{{ route('institution.index')}}/" + id + "/edit";
            $(location).attr('href', ruta);
        });
  });
</script>
@stop