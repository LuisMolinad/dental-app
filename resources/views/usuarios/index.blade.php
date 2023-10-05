@extends('adminlte::page')

@section('title', 'Control Usuarios')
{{-- <link rel="stylesheet" href="{{ asset('css/botton.css') }}"> --}}
<link rel="stylesheet" href="{{ asset('css/notificacion.css') }}">
{{-- Necesario para la animación de las tablas --}}
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
{{-- <link rel="shortcut icon" href="{{ asset('./img/LOGO-PLUS-CHEMICAL-CORREO-01.png') }}"> --}}
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
                        <table id="users" class="display">
                            <thead>
                                <tr>
                                    <th style="display:none">ID </th>
                                    <th scope="col">NOMBRE</th>
                                    <th scope="col">E-MAIL</th>
                                    <th scope="col">ROL</th>
                                    <th scope="col">ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($usuarios as $usuario)
                                    <tr>
                                        <td id="idUsuario" style="display:none">{{ $usuario->id }}</td>
                                        <td id="nombreUsuario">{{ $usuario->name }}</td>
                                        <td id="emailUsuario">{{ $usuario->email }}</td>
                                        <td id="rolUsuario">
                                            @if (!empty($usuario->getRoleNames()))
                                                @foreach ($usuario->getRoleNames() as $roleName)
                                                    {{ $roleName }}
                                                @endforeach
                                            @endif
                                        </td>
                                        <td id="acciones">
                                            <a class="btn btn-warning"
                                                href="{{ route('usuarios.edit', $usuario->id) }}">Editar</a>
                                            <form id="EditForm{{ $usuario->id }}"
                                                action="{{ route('usuarios.destroy', ['usuario' => $usuario->id]) }}"
                                                method="post">
                                                @csrf
                                                {{ method_field('DELETE') }}
                                                <button
                                                    onclick="return alerta_eliminar_usuario('{{ $usuario->id }}','{{ $usuario->name }}')"
                                                    type="submit" class="btn btn-danger">Eliminar</button>
                                            </form>
                                            <form method="POST">
                                                @csrf
                                                <div style="display: none;">
                                                    <label for="email">E-mail</label>
                                                    <input type="text" id="email" name="email"
                                                        value="{{ $usuario->email }}">
                                                </div>
                                            </form>
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
        });
    </script>
@stop
