@extends('adminlte::page')

@section('title', 'Gestion Roles')

@section('content_header')
    <h1 class="m-0 text-dark">Gestion Roles</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive-sm container-fluid contenedor">
                        {{-- Notificaciones --}}
                        {{--       @include('layouts.notificacion') --}}
                        <table class="table table-striped" id="roles">
                            <thead>
                                <tr>
                                    <th scope="col" style="text-align: center">ROL</th>
                                    <th scope="col" style="text-align: center">ACCIONES</th>
                                </tr>
                            </thead>

                            <tbody>
                                @can('crear-rol')
                                    <a role="button" class="btn btn-success" href="{{ route('roles.create') }}">Crear Rol</a>
                                    <br>
                                    <br>
                                @endcan
                                @foreach ($roles as $role)
                                    <tr>
                                        <td id="nombreRol" style="text-align: center">{{ $role->name }}</td>
                                        <td style="text-align: center">
                                            @can('editar-rol')
                                                <a class="btn btn-warning"
                                                    href="{{ route('roles.edit', $role->id) }}">Editar</a>
                                            @endcan

                                            @can('borrar-rol')
                                                <form id="EditForm{{ $role->id }}"
                                                    action="{{ route('roles.destroy', $role->id) }}" method="post"
                                                    style="display: inline">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                    <button
                                                        onclick="return alerta_eliminar_role('{{ $role->id }}','{{ $role->name }}')"
                                                        type="submit" class="btn btn-danger">Eliminar</button>
                                                </form>
                                            @endcan
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
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <!-- Librerias para las data tables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('#roles').DataTable({
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
