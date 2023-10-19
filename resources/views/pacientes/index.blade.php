@extends('layouts.app')
@section('plugins.Toastr', true)
@section('plugins.Sweetalert2', true)
@section('plugins.Datatables', true)
@section('content_header')
    <h1 class="m-0 text-dark">Gestión de Pacientes</h1>
@stop

@section('content')
    {{-- Todo correspondiente a la tabla --}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header ui-sortable-handle">
                        <div class="card-title">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#pacienteModal">
                                Crear Nuevo Paciente
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive-sm container-fluid">
                            {{--        @include('layouts.notificacion') --}}
                            <table id="pacientes" class="table table-striped" style="width:100%">
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

                                                    <form id="EditForm{{ $paciente->id }}"
                                                        action="{{ route('pacientes.destroy', ['paciente' => $paciente->id]) }}"
                                                        method="post">
                                                        @csrf
                                                        {{ method_field('DELETE') }}
                                                        <button
                                                            onclick="return alerta_eliminar_paciente('{{ $paciente->id }}','{{ $paciente->nombre }}')"
                                                            class="btn btn-danger btn-eliminar"
                                                            type="submit">Eliminar</button>
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

    {{-- Modal --}}
    <div class="modal fade" id="pacienteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Crear Paciente</h1>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="error-messages">
                        <!-- Aquí mostrarás los mensajes de error -->
                    </div>
                    {{-- Formulario --}}
                    <form id="formulario-paciente" class="row g-3 needs-validation" action="{{ route('pacientes.store') }}"
                        method="post" novalidate>
                        @csrf
                        @method('POST')

                        <div class="row">
                            <div class="col-md-6">
                                <label for="nombre" class="form-label">Nombre:</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                                <div class="valid-feedback">
                                    Es correcto
                                </div>

                            </div>

                            <div class="col-md-6">
                                <label for="apellido" class="form-label">Apellido:</label>
                                <input type="text" class="form-control" id="apellido" name="apellido" required>
                                <div class="valid-feedback">
                                    Es correcto
                                </div>

                            </div>
                            <div class="col-md-6">
                                <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento:</label>
                                <input type="date" class="form-control" id="fecha_nacimiento"
                                    name="fecha_nacimiento"required>
                                <div class="valid-feedback">
                                    Es correcto
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="telefono" class="form-label">Teléfono:</label>
                                <div class="input-group has-validation">
                                    {{-- <span class="input-group-text" id="inputGroupPrepend">@</span> --}}
                                    <input type="number" class="form-control" id="telefono" name="telefono"
                                        aria-describedby="inputGroupPrepend" required>

                                    <div class="valid-feedback">
                                        Es correcto
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="correo_electronico" class="form-label">Email:</label>

                                <div class="input-group has-validation">
                                    {{-- <span class="input-group-text" id="inputGroupPrepend">@</span> --}}
                                    <input type="email" class="form-control" id="correo_electronico"
                                        name="correo_electronico" aria-describedby="inputGroupPrepend" required>
                                    <div class="valid-feedback">
                                        Es correcto
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="chkContactoEmergencia">
                                <label class="form-check-label" for="chkContactoEmergencia">
                                    ¿Tiene un contacto de emergencia?
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="nombre_contacto_emergencia" class="form-label">Nombre del contacto:</label>
                            <input type="text" class="form-control" id="nombre_contacto_emergencia" disabled>
                        </div>

                        <div class="col-md-6">
                            <label for="contacto_emergencia" class="form-label">Teléfono del contacto:</label>
                            <input type="number" class="form-control" id="contacto_emergencia" disabled>
                        </div>

                        <div class="modal-footer col-12">
                            <button type="button" class="btn btn-secondary float-right"
                                data-bs-dismiss="modal">Cancelar</button>
                            <button class="btn btn-success float-right" type="submit">Guardar Paciente</button>
                        </div>
                    </form>
                    {{-- Fin formulario --}}
                </div>
            </div>
        </div>
    </div>
    {{-- FIN Modal --}}
    {{-- Modal editar --}}
    <div class="modal fade" id="pacienteModalEditar" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Crear Paciente</h1>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="error-messages">
                        <!-- Aquí mostrarás los mensajes de error -->
                    </div>
                    {{-- Formulario --}}
                    <form id="formulario-paciente" class="row g-3 needs-validation"
                        action="{{ route('pacientes.store') }}" method="post" novalidate>
                        @csrf
                        @method('POST')

                        <div class="row">
                            <div class="col-md-6">
                                <label for="nombre" class="form-label">Nombre:</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                                <div class="valid-feedback">
                                    Es correcto
                                </div>

                            </div>

                            <div class="col-md-6">
                                <label for="apellido" class="form-label">Apellido:</label>
                                <input type="text" class="form-control" id="apellido" name="apellido" required>
                                <div class="valid-feedback">
                                    Es correcto
                                </div>

                            </div>
                            <div class="col-md-6">
                                <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento:</label>
                                <input type="date" class="form-control" id="fecha_nacimiento"
                                    name="fecha_nacimiento"required>
                                <div class="valid-feedback">
                                    Es correcto
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="telefono" class="form-label">Teléfono:</label>
                                <div class="input-group has-validation">
                                    {{-- <span class="input-group-text" id="inputGroupPrepend">@</span> --}}
                                    <input type="number" class="form-control" id="telefono" name="telefono"
                                        aria-describedby="inputGroupPrepend" required>

                                    <div class="valid-feedback">
                                        Es correcto
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="correo_electronico" class="form-label">Email:</label>

                                <div class="input-group has-validation">
                                    {{-- <span class="input-group-text" id="inputGroupPrepend">@</span> --}}
                                    <input type="email" class="form-control" id="correo_electronico"
                                        name="correo_electronico" aria-describedby="inputGroupPrepend" required>
                                    <div class="valid-feedback">
                                        Es correcto
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="chkContactoEmergencia">
                                <label class="form-check-label" for="chkContactoEmergencia">
                                    ¿Tiene un contacto de emergencia?
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="nombre_contacto_emergencia" class="form-label">Nombre del contacto:</label>
                            <input type="text" class="form-control" id="nombre_contacto_emergencia" disabled>
                        </div>

                        <div class="col-md-6">
                            <label for="contacto_emergencia" class="form-label">Teléfono del contacto:</label>
                            <input type="number" class="form-control" id="contacto_emergencia" disabled>
                        </div>

                        <div class="modal-footer col-12">
                            <button type="button" class="btn btn-secondary float-right"
                                data-bs-dismiss="modal">Cancelar</button>
                            <button class="btn btn-success float-right" type="submit">Guardar Paciente</button>
                        </div>
                    </form>
                    {{-- Fin formulario --}}
                </div>
            </div>
        </div>
    </div>

@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('#pacientes').DataTable({
                responsive: true,
                "lengthMenu": [
                    [5, 10],
                    [5, 10]
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
    {{-- Script que valida los campos del formulario --}}
    <script>
        (function() {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
    {{-- Validar del lado del servidor --}}
    <script>
        $(document).ready(function() {
            $('#formulario-paciente').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    success: function(response) {
                        toastr.success('Paciente creado exitosamente');

                        // Redirige a la página deseada después de un breve retraso
                        setTimeout(function() {
                                window.location.href = '{{ route('pacientes.index') }}';
                            },
                            2000
                        ); // Redirige después de 2 segundos (ajusta el tiempo según tus necesidades)
                    },
                    error: function(response) {
                        // Error: La validación ha fallado, muestra los errores en el modal
                        var errors = response.responseJSON.errors;
                        var errorMessages = $('.error-messages');

                        // Limpia los mensajes de error previos
                        errorMessages.html('');

                        // Recorre los errores y muéstralos en el modal
                        $.each(errors, function(field, messages) {
                            $('#' + field).addClass('is-invalid');
                            $('#' + field + '-error').html(messages[0]);
                            // Agrega el mensaje al área de errores
                            errorMessages.append('<div class="alert alert-danger">' +
                                messages[0] + '</div>');
                        });

                        // Abre el modal con los errores
                        $('#pacienteModal').modal('show');
                    }
                });
            });
        });
    </script>
    {{-- Check Box para campos opcional --}}
    <script>
        const chkContactoEmergencia = document.getElementById('chkContactoEmergencia');
        const nombre_contacto_emergencia = document.getElementById('nombre_contacto_emergencia');
        const contacto_emergencia = document.getElementById('contacto_emergencia');

        chkContactoEmergencia.addEventListener('change', function() {
            if (chkContactoEmergencia.checked) {
                nombre_contacto_emergencia.disabled = false;
                contacto_emergencia.disabled = false;
            } else {
                nombre_contacto_emergencia.disabled = true;
                contacto_emergencia.disabled = true;
            }
        });
    </script>
    <script src="{{ asset('js/paciente.js') }}"></script>
@stop
