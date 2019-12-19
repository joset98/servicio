@extends('adminlte::page')
<!-- DATA TABLES 2 
                           
-->

@section('css')

<link rel="stylesheet" href="{{ asset('css/users_custom.css') }}">
@stop

@section('title', 'Visualizar clientes')

@section('content_header')
<h1><i class="fas fa-fw fa-briefcase text-blue"></i>Clientes</h1>
@stop


@section('content')
    <div class="container-fluid" style="padding-top: 1em;">

        <div class="row">

            @permission('agregar_cliente')
            <div class="col-md-10 col-md-push-1 text-right" style="padding-bottom: 1em;">
                <button class="add-modal btn btn-success text-right"><span class="glyphicon glyphicon-plus"></span> Nuevo</button>
            </div>
            @endpermission

            <div class="col-md-10 col-md-push-1 mt-5">

                <div class="box box-primary">
                    <div class="box-body">
                        <table id="clients" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>RIF</th>
                                    <th>Nombre</th>
                                    <th>Correo electronico</th>
                                    <th>Tipo</th>
                                    <th>Estado</th>
                                    <th width="115px">Acciones</th>
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


<script>
    $(document).ready(function() {
        $('#clients').DataTable({
            // "serverSide": true, //Procesa la consulta del lado del servidor
            "ajax": "{{ route('clients.index') }}",
            "columns": [
                {
                    render: function(data, type, row) {
                        return (row.type_rif+"-"+row.rif);
                    }
                },
                {
                    data: 'name'
                },
                {
                    data: 'email'
                },
                {
                    render: function(data, type, row) {
                        return (row.type.toUpperCase());
                    }
                },
                {
                    render: function(data, type, row) {
                        status ='<div class="botonera-table">';

                        if (row.status=="activo") {
                            status+='<p class="text-success  btn btn-success">'
                        }else {
                            status+='<p class="text-danger btn btn-danger">'
                        }
                            status+=row.status.toUpperCase()+'</p></div>'
                        return (status);
                    }
                },
                {
                    render: function(data, type, row) {
                        btn ="<div class='botonera-table'>";

                        @permission('mostrar_cliente')
                            // Boton Visualizar
                            btn += '<button class="show-modal btn btn-success" data-id=' +
                                row.id + '><span class="glyphicon glyphicon-eye-open"></span></button>';
                        @endpermission

                        @permission('actualizar_cliente')
                            // Boton editar
                            btn += '<button class="edit-modal btn btn-info" data-id=' +
                                row.id + '><span class="glyphicon glyphicon-edit"></span></button>';
                        @endpermission

                        @permission('eliminar_cliente')
                            // Boton eliminar
                            btn += ' <button class="delete-modal btn btn-danger" data-id=' + row.id +
                                '><span class="glyphicon glyphicon-trash"></span></button>';
                        @endpermission

                        btn +="</div>";

                        return (btn);
                    }
                },
            ],
            "language": {
                "sProcessing": "Procesando...",
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "No existen clientes registrados",
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
            ruta = "{{ route('clients.create')}}";
            $(location).attr('href', ruta);
        });

        //Boton Agregar
        $('body').on('click', '.show-modal', function(e) {
            e.preventDefault();
            id = $(this).attr('data-id');
            ruta = "{{ route('clients.index')}}/"+id;
            $(location).attr('href', ruta);
        });

        //Boton editar
        $('body').on('click', '.edit-modal', function(e) {
            e.preventDefault();
            id = $(this).attr('data-id');
            ruta = "{{ route('clients.index')}}/" + id + "/edit";
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
                    url: "{{ route('clients.index')}}/" + id,
                    headers: {
                        'X-CSRF-TOKEN': token
                    },
                    type: 'DELETE',
                    datatype: 'json',
                    success: function(respuesta) {
                        if (respuesta.status = "success") {
                            $('#clients').DataTable().ajax.reload();
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