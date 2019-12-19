@extends('adminlte::page')
<!-- DATA TABLES 2 
                           
-->

@section('css')
{{-- <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}"> --}}
<link rel="stylesheet" href="{{ asset('css/users_custom.css') }}"> 
@stop

@section('title', 'Visualizar usuarios')

@section('content_header')
<h1><i class="fas fa-fw fa-user text-blue"></i>Usuarios</h1>
@stop



@section('content')

<div class="container-fluid" style="padding-top: 1em;">
    <div class="row">

        @permission('agregar_nuevo_usuario')
        <div class="col-md-10 col-md-push-1 text-right" style="padding-bottom: 1em;">
            <button class="add-modal btn btn-success text-right"><span class="glyphicon glyphicon-plus"></span> Nuevo</button>
        </div>
        @endpermission

        <div class="col-md-10 col-md-push-1 mt-5">

            <div class="box box-primary">
                @csrf
                <div class="box-body">

                    <table id="table_users" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Cedula</th>
                                <th>Nombre</th>
                                <th>Telefono</th>
                                <th>Correo</th>
                                <th>Rol</th>
                                <th>acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@stop

@section('js')
{{-- <script type="text/javascript" charset="utf8" src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
<script type="text/javascript" charset="utf8" src="{{ asset('js/dataTables.min.js') }}"></script>
<script type="text/javascript" charset="utf8" src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
--}}
<script>
    $(document).ready(function() {

        $('#table_users').DataTable({
            // "serverSide": true, //Procesa la consulta del lado del servidor
            "ajax": "{{ route('users.index') }}",
            "columns": [{
                    data: 'id'
                },
                {
                    data: 'cedula'
                },
                {
                    data: 'name'
                },
                {
                    data: 'phone'
                },
                {
                    data: 'email'
                },
                {
                    data: 'r_name'
                },
                {
                    render: function(data, type, row) {
                        let btn = "<div class='botonera-table'>"


                        btn += '<button class="edit-modal btn btn-info" data-id=' +
                            row.id + '><span class="glyphicon glyphicon-edit"></span></button>';

                        btn += ' <button class="delete-modal btn btn-danger" data-id=' + row.id +
                            '><span class="glyphicon glyphicon-trash"></span></button>'
                        
                        return btn +="</div>";
                    }
                }
            ],
            "language": {
                "sProcessing": "Procesando...",
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "No existen profesores registrados",
                "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix": "",
                "sSearch": "Buscar:",
                "sUrl": "",
                "sInfoThousands": ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }
        });

        $("select").val('10');
        $('select').addClass("browser-default");

        //Boton Agregar
        $('body').on('click', '.add-modal', function(e) {
            e.preventDefault();
            ruta = "{{ route('users.create')}}";
            $(location).attr('href', ruta);
        });
        //Boton editar
        $('body').on('click', '.edit-modal', function(e) {
            e.preventDefault();
            id = $(this).attr('data-id');
            ruta = "{{ route('users.index')}}/" + id + "/edit";
            $(location).attr('href', ruta);
        });
        //Boton eliminar
        $('body').on('click', '.delete-modal', function(e) {
            e.preventDefault();
            id = $(this).attr('data-id');
            token = $('meta[name=csrf-token]').attr("content");
            e.preventDefault();
            swal({
                title: '',
                text: '¿Seguro desea eliminar el registro?',
                type: 'question',
                showCancelButton: true,
                confirmButtonText: 'Si',
                cancelButtonText: 'No'
            }).then(function() {
                $.ajax({
                    url: "{{ route('users.index')}}/" + id,
                    headers: {
                        'X-CSRF-TOKEN': token
                    },
                    type: 'DELETE',
                    datatype: 'json',
                    success: function(respuesta) {
                        if (respuesta.status = "success") {
                            $('#table_users').DataTable().ajax.reload();
                            toastr.success(respuesta.msg);
                        } else {
                            toastr.error(respuesta.msg);
                        }
                    },

                });
            }).catch(swal.noop);
        });
    });
</script>
@stop