@extends('layouts.app')

@section('title', 'Crear Roles')
{{-- <link rel="shortcut icon" href="{{ asset('./img/icono1.png') }}"> --}}

@section('content_header')
    <h1 class="m-0 text-dark">Crear Rol</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-dark alert-dismissible fade show" role="alert">
                            <strong>¡Revise los campos!</strong>
                            @foreach ($errors->all() as $error)
                                <span class="badge badge-danger">{{ $error }}</span>
                            @endforeach
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif


                    <form action="{{ route('roles.store') }}" method="POST">
                        @csrf
                        <div class="container">
                            <div class="form-group col-md-6">
                                <label for="name">Nombre del Rol</label>
                                <!-- Las variables deben ir exactamente como se reciben en el controlador -->
                                <input type="text" name="name" class="form-control">
                            </div>
                            <div class="table-responsive">
                                <label for="table">Permisos para este Rol:</label>
                                <table class="table w-auto">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Permisos</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($permission as $value)
                                            <tr>
                                                <td><input type="checkbox" name="permission[]" value="{{ $value->id }}"
                                                        class="name">
                                                </td>
                                                <td>{{ $value->name }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="container">
                                @can('crear-rol')
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                @endcan
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
{{-- @section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop --}}

@push('js')
    <!-- Librerias para las data tables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('#articulos').DataTable({
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
@endpush
