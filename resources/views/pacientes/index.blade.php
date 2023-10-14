@extends('layouts.app')
@section('plugins.Toastr', true)

@section('content_header')
    @error('correo_electronico')
        <div class="text-danger">{{ $message }}</div>
    @enderror
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
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#citaModal">
                                Crear Nuevo Paciente
                            </button>
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

                                                    <form id=" EditForm{{ $paciente->id }}"
                                                        action="{{ route('pacientes.destroy', ['paciente' => $paciente->id]) }}"
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
    {{-- Todo correspondiente a la tabla --}}
    {{-- Modal --}}
    <div class="modal fade" id="citaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Crear Paciente</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- Formulario --}}
                    <form id="crearPacienteForm" class="row g-3 needs-validation" action="{{ route('pacientes.store') }}"
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
                                <div class="invalid-feedback">
                                    Escriba un nombre
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="apellido" class="form-label">Apellido:</label>
                                <input type="text" class="form-control" id="apellido" name="apellido" required>
                                <div class="valid-feedback">
                                    Es correcto
                                </div>
                                <div class="invalid-feedback">
                                    Escriba un apellido
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento:</label>
                                <input type="date" class="form-control" id="fecha_nacimiento"
                                    name="fecha_nacimiento"required>
                                <div class="valid-feedback">
                                    Es correcto
                                </div>
                                <div class="invalid-feedback">
                                    No puede dejar este campo vacío
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
                                    <div class="invalid-feedback">
                                        Escriba un teléfono
                                    </div>
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
                                    <div class="invalid-feedback">
                                        Escriba un correo válido
                                    </div>
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
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            var crearPacienteForm = document.getElementById('crearPacienteForm');

            crearPacienteForm.addEventListener('submit', function(event) {
                event.preventDefault();

                // Agrega la validación de Bootstrap al formulario
                if (!crearPacienteForm.checkValidity()) {
                    event.stopPropagation();
                    crearPacienteForm.classList.add('was-validated');
                } else {
                    // Recolecta los datos del formulario
                    var formData = new FormData(crearPacienteForm);

                    // Realiza una solicitud AJAX
                    fetch('pacientes', {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .getAttribute('content')
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            // Manejar la respuesta de la solicitud AJAX
                            if (data.success) {
                                // Éxito: muestra un mensaje y realiza cualquier otra acción necesaria
                                alert('Paciente creado exitosamente');
                                // Opcional: Redirigir al usuario o cerrar el modal, etc.
                            } else {
                                // Error: muestra un mensaje de error o maneja el error
                                alert('Hubo un error al crear el paciente');
                            }
                        })
                        .catch(error => {
                            console.error(error);
                        });
                }
            });
        });
    </script> --}}

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
@endpush
