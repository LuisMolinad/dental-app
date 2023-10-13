@extends('layouts.app')
@section('plugins.Toastr', true)

@section('content_header')

    <h1 class="m-0 text-dark">Gestión de Pacientes</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header ui-sortable-handle">
                        <div class="card-title">
                            <a role="button" class="btn btn-success" href="#">Crear Paciente</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive-sm container-fluid contenedor">
                            {{--        @include('layouts.notificacion') --}}
                            <table id="pacientes" class="table table-stripedS">
                                <thead>
                                    <tr>
                                        <th style="display:none">ID </th>
                                        <th scope="col" style="text-align: center">Nombre</th>
                                        <th scope="col" style="text-align: center">Apellido</th>
                                        <th scope="col" style="text-align: center">Edad</th>
                                        <th scope="col" style="text-align: center">Teléfono</th>
                                        <th scope="col" style="text-align: center">Email</th>
                                        <th scope="col" style="text-align: center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pacientes as $paciente)
                                        <tr>
                                            <td id="idPaciente" style="display:none">{{ $paciente->id }}</td>
                                            <td id="nombrePaciente" style="text-align: center">{{ $paciente->nombre }}</td>
                                            <td id="apellidoPaciente" style="text-align: center">{{ $paciente->apellido }}
                                            </td>
                                            <td id="edadPaciente" style="text-align: center">
                                                {{ \Carbon\Carbon::parse($paciente->fecha_nacimiento)->age }}
                                            <td id="telefonoPaciente" style="text-align: center">{{ $paciente->telefono }}
                                            </td>
                                            <td id="correoPaciente" style="text-align: center">
                                                {{ $paciente->correo_electronico }}</td>
                                            <td id="acciones" style="text-align: center">
                                                <div class="btn-group btn-group-sm">
                                                    <form action="{{-- {{ route('pacientes.edit', $paciente->id) }} --}}" method="GET">
                                                        @csrf
                                                        <button type="submit"
                                                            class="btn btn-warning btn-editar">Editar</button>
                                                    </form>

                                                    <form id="{{-- EditForm{{ $paciente->id }} --}}" action="{{-- {{ route('pacientes.destroy', ['paciente' => $paciente->id]) }} --}}"
                                                        method="post">
                                                        @csrf
                                                        {{ method_field('DELETE') }}
                                                        <button type="submit"
                                                            class="btn btn-danger btn-eliminar">Eliminar</button>
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
    </div>
@stop

@push('js')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('#pacientes').DataTable({
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
@endpush
