@extends('adminlte::page')

@section('title', 'Control Usuarios')
@section('plugins.Sweetalert2', true)
<link rel="shortcut icon" href="{{ asset('./img/icono1.png') }}">
<script src="{{ asset('js/eliminar_sweetalert2.js') }}"></script>
@section('content_header')

    <h1>Control de Usuarios </h1>

@stop


@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <a role="button" class="btn btn-success" href="{{ route('usuarios.create') }}">Crear Usuario</a>
                    <br>
                    <br>

                    <div class="table-responsive-sm container-fluid contenedor">
                        {{--        @include('layouts.notificacion') --}}
                        <table id="users" class="table table-striped    ">
                            <thead>
                                <tr>
                                    <th style="display:none">ID </th>
                                    <th scope="col" style="text-align: center">NOMBRE</th>
                                    <th scope="col" style="text-align: center">E-MAIL</th>
                                    <th scope="col" style="text-align: center">ROL</th>
                                    <th scope="col" style="text-align: center">ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($usuarios as $usuario)
                                    <tr>
                                        <td id="idUsuario" style="display:none">{{ $usuario->id }}</td>
                                        <td id="nombreUsuario" style="text-align: center">{{ $usuario->name }}</td>
                                        <td id="emailUsuario" style="text-align: center">{{ $usuario->email }}</td>
                                        <td id="rolUsuario" style="text-align: center">
                                            @if (!empty($usuario->getRoleNames()))
                                                @foreach ($usuario->getRoleNames() as $roleName)
                                                    {{ $roleName }}
                                                @endforeach
                                            @endif
                                        </td>
                                        <td id="acciones" style="text-align: center">
                                            <div class="btn-group btn-group-sm">
                                                <form action="{{ route('usuarios.edit', $usuario->id) }}" method="GET">
                                                    @csrf
                                                    <button type="submit"
                                                        class="btn btn-warning btn-editar">Editar</button>
                                                </form>

                                                <form id="EditForm{{ $usuario->id }}"
                                                    action="{{ route('usuarios.destroy', ['usuario' => $usuario->id]) }}"
                                                    method="post">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                    <button
                                                        onclick="return alerta_eliminar_usuario('{{ $usuario->id }}','{{ $usuario->name }}')"
                                                        type="submit" class="btn btn-danger btn-eliminar">Eliminar</button>
                                                </form>

                                            </div>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/tabla.css') }}">
@stop

@section('js')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('#users').DataTable({
                "lengthMenu": [
                    [5, 10, 25, -1],
                    [5, 10, 25, "Todos"]
                ],
                "language": {
                    "lengthMenu": "Mostrar _MENU_ records por página",
                    "zeroRecords": "No se encuentran datos relacionados - ",
                    "info": "Mostrando página _PAGE_ de _PAGES_",
                    "infoEmpty": "No hay registros disponibles ",
                    "infoFiltered": "(filtrado de _MAX_ registros totales)",
                    'search': 'Buscar',
                    'paginate': {
                        'first': 'Primero',
                        'last': 'Ultimo',
                        'next': 'Siguiente',
                        'previous': 'Anterior',
                    },

                },
            });
            // Verifica si existe un mensaje Toastr en la sesión
            var toastrMessage = @json(session('toastr'));

            if (toastrMessage) {
                // Muestra la notificación Toastr con el estilo adecuado
                toastr[toastrMessage.type](toastrMessage.message);
            }

        });
    </script>
@stop
