@extends('layouts.app')
@section('title', 'Gestión Pacientes')
@section('plugins.Toastr', true)
@section('plugins.Sweetalert2', true)
@section('plugins.Datatables', true)

<meta name="csrf-token" content="{{ csrf_token() }}">

@push('css')
    <link rel="stylesheet" href="{{ asset('css/pacientes.css') }}">
@endpush
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
                                        {{--  <th style="display:none">ID </th> --}}
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
                                            {{--  <td id="idPaciente" style="display:none">{{ $paciente->id }}</td> --}}
                                            <td style="text-align: center">{{ $paciente->nombre }}
                                            </td>
                                            <td id="apellidoPaciente" style="text-align: center">{{ $paciente->apellido }}
                                            </td>
                                            <td id="edadPaciente" style="text-align: center">
                                                {{ \Carbon\Carbon::parse($paciente->fecha_nacimiento)->age }}
                                            <td id="telefonoPaciente" style="text-align: center">{{ $paciente->telefono }}
                                            </td>
                                            <td id="correoPaciente" style="text-align: center">
                                                {{ $paciente->correo_electronico }}</td>
                                            <td id="acciones" style="text-align: center">
                                                <div class="btn-group" role="group">
                                                    {{-- href al historial clinico --}}
                                                    <a href="" class="btn btn-outline-warning"
                                                        title="Historial Clínico"> <i class="fa-solid fa-file-medical"
                                                            style="color: #fa0000;"></i></a>
                                                    <button type="button" class="btn btn-info btn-editar"
                                                        value="{{ $paciente->id }}" title="Ver información del paciente"><i
                                                            class="fa-regular fa-eye" style="color: #ffffff;"></i> </button>

                                                    <form id="EditForm{{ $paciente->id }}"
                                                        action="{{ route('pacientes.destroy', ['paciente' => $paciente->id]) }}"
                                                        method="post">
                                                        @csrf
                                                        {{ method_field('DELETE') }}
                                                        <button
                                                            onclick="return alerta_eliminar_paciente('{{ $paciente->id }}','{{ $paciente->nombre }}')"
                                                            class="btn btn-danger btn-eliminar" type="submit"
                                                            title="Eliminar Paciente"><i class="fa-solid fa-trash-can"
                                                                style="color: #ffffff;"></i></button>
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
                                    <input type="text" class="form-control" id="telefono" name="telefono"
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
                            <input type="text" class="form-control" id="contacto_emergencia" disabled>
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

    {{-- TODO Modal editar --}}
    <div class="modal fade" id="pacienteModalEditar" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Información Paciente</h1>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="error-messagesEdit">
                        <!-- Aquí mostrarás los mensajes de error -->
                    </div>
                    {{-- Formulario --}}



                    <div class="row">
                        <input id="idPaciente" class="form-control" id="nombreEdit" style="display: none"
                            name="idPaciente" readonly required>
                        <div class="col-md-6">

                            <label for="nombreEdit" class="form-label">Nombre:</label>
                            <input type="text" class="form-control" id="nombreEdit" name="nombreEdit" readonly
                                required>
                            <div class="valid-feedback">
                                Es correcto
                            </div>

                        </div>

                        <div class="col-md-6">
                            <label for="apellidoEdit" class="form-label">Apellido:</label>
                            <input type="text" class="form-control" id="apellidoEdit" name="apellidoEdit" readonly
                                required>
                            <div class="valid-feedback">
                                Es correcto
                            </div>

                        </div>
                        <div class="col-md-6">
                            <label for="fecha_nacimientoEdit" class="form-label">Fecha de Nacimiento:</label>
                            <input type="date" class="form-control" id="fecha_nacimientoEdit"
                                name="fecha_nacimientoEdit" readonly required>
                            <div class="valid-feedback">
                                Es correcto
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="telefonoEdit" class="form-label">Teléfono:</label>
                            <div class="input-group has-validation">
                                {{-- <span class="input-group-text" id="inputGroupPrepend">@</span> --}}
                                <input type="text" class="form-control" id="telefonoEdit" name="telefonoEdit"
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
                                <input type="email" class="form-control" id="correo_electronicoEdit"
                                    name="correo_electronicoEdit" aria-describedby="inputGroupPrepend" required>
                                <div class="valid-feedback">
                                    Es correcto
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="chkContactoEmergenciaEdit">
                            <label class="form-check-label" for="chkContactoEmergenciaEdit">
                                ¿Tiene un contacto de emergencia?
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="nombre_contacto_emergenciaEdit" class="form-label">Nombre del contacto:</label>
                        <input type="text" class="form-control" id="nombre_contacto_emergenciaEdit" disabled>
                    </div>

                    <div class="col-md-6">
                        <label for="contacto_emergenciaEdit" class="form-label">Teléfono del contacto:</label>
                        <input type="text" class="form-control" id="contacto_emergenciaEdit" disabled>
                    </div>

                    <div class="modal-footer col-12">
                        <button type="button" class="btn btn-secondary float-right"
                            data-bs-dismiss="modal">Cancelar</button>
                        <button id="btn-actualizar" class="btn btn-success float-right btn-actualizar"
                            type="submit">Actualizar
                            Paciente</button>
                    </div>

                    {{-- Fin formulario --}}
                </div>
            </div>
        </div>
    </div>

@stop

@section('js')
    <script src="https://kit.fontawesome.com/c662e065a6.js" crossorigin="anonymous"></script>
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
    {{-- Check Box para campos opcional Crear Paciente --}}
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

    {{-- **Check Box para campos opcional Editar Paciente --}}
    <script>
        const chkContactoEmergenciaEdit = document.getElementById('chkContactoEmergenciaEdit');
        const nombre_contacto_emergenciaEdit = document.getElementById('nombre_contacto_emergenciaEdit');
        const contacto_emergenciaEdit = document.getElementById('contacto_emergenciaEdit');

        chkContactoEmergenciaEdit.addEventListener('change', function() {
            if (chkContactoEmergenciaEdit.checked) {
                nombre_contacto_emergenciaEdit.disabled = false;
                contacto_emergenciaEdit.disabled = false;
            } else {
                nombre_contacto_emergenciaEdit.disabled = true;
                contacto_emergenciaEdit.disabled = true;
            }
        });
    </script>

    {{-- **Archivo con la estructura de sweetAlert2 --}}
    <script src="{{ asset('js/paciente.js') }}"></script>


    {{-- **Consulta ajax para ruta edit y cargar datos al modal --}}
    <script>
        // Cuando se hace clic en el botón "Editar"
        $(document).on('click', '.btn-editar', function() {
            var paciente = $(this).val();
            console.log(paciente);
            // Define la URL directamente
            var url = "/pacientes/" + paciente + "/edit";
            console.log(url);
            // Realizar una solicitud Ajax para obtener los datos del paciente
            $.ajax({
                type: 'GET',
                url: url,
                success: function(data) {
                    console.log(data);
                    console.log(data.nombre);
                    console.log(data.telefono);

                    // Llenar los campos del modal con los datos del paciente
                    $('#idPaciente').val(data.id);
                    $('#nombreEdit').val(data.nombre);
                    $('#apellidoEdit').val(data.apellido);
                    $('#fecha_nacimientoEdit').val(data.fecha_nacimiento);
                    $('#telefonoEdit').val(data.telefono);
                    $('#correo_electronicoEdit').val(data.correo_electronico);
                    $('#nombre_contacto_emergenciaEdit').val(data.nombre_contacto_emergencia);
                    $('#contacto_emergenciaEdit').val(data.contacto_emergencia);
                    // Abre el modal de edición
                    $('#pacienteModalEditar').modal('show');
                }
            });
        });
    </script>

    {{-- **Funcion para actualizar UPDATE la información del paciente --}}
    <script>
        // Agregar un manejador de eventos al botón "Actualizar"
        $(document).on('click', '.btn-actualizar', function() {
            var paciente = parseInt($('#idPaciente').val());


            /*  var newData = {
                 nombre: $('#nombreEdit').val(),
                 apellido: $('#apellidoEdit').val(),
                 fecha_nacimiento: $('#fecha_nacimientoEdit').val(),
                 telefono: $('#telefonoEdit').val(),
                 correo_electronico: $('#correo_electronicoEdit').val(),
                 nombre_contacto_emergencia: $('#nombre_contacto_emergenciaEdit').val(),
                 contacto_emergencia: $('#contacto_emergenciaEdit').val()
             }; */
            var nombre = $('#nombreEdit').val();
            var apellido = $('#apellidoEdit').val();
            var fecha_nacimiento = $('#fecha_nacimientoEdit').val();
            var telefono = $('#telefonoEdit').val();
            var correo_electronico = $('#correo_electronicoEdit').val();
            var nombre_contacto_emergencia = $('#nombre_contacto_emergenciaEdit').val();
            var contacto_emergencia = $('#contacto_emergenciaEdit').val();
            // console.log(newData);
            // Realizar una solicitud AJAX para actualizar los datos
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'PATCH', // Cambia esto al método HTTP correcto (PUT o PATCH)
                url: '/pacientes/' + paciente, // Ajusta la URL según tu estructura de rutas
                data: {
                    /* // Incluye el token CSRF en los datos
                    newData // Resto de tus datos de la solicitud */
                    nombre: nombre,
                    fecha_nacimiento: fecha_nacimiento,
                    telefono: telefono,
                    correo_electronico: correo_electronico,
                    nombre_contacto_emergencia: nombre_contacto_emergencia,
                    contacto_emergencia: contacto_emergencia

                },
                success: function(response) {
                    // Actualizar la información mostrada en el modal
                    $('#nombreEdit').text(nombre);
                    $('#apellidoEdit').text(apellido);
                    $('#telefonoEdit').text(telefono);
                    $('#correo_electronicoEdit').text(correo_electronico);
                    $('#nombre_contacto_emergenciaEdit').text(nombre_contacto_emergencia);
                    $('#contacto_emergenciaEdit').text(contacto_emergencia);
                    // Actualiza otros campos según sea necesario

                    // Cierra el modal
                    /*   $('#pacienteModalEditar').modal('hide'); */

                    // Agrega una notificación o mensaje de éxito si lo deseas
                    toastr.success('Datos actualizados correctamente');
                    // Redirige a la página deseada después de un breve retraso
                    setTimeout(function() {
                            window.location.href = '{{ route('pacientes.index') }}';
                        },
                        1000
                    ); // Redirige después de 1 segundos 
                },
                error: function(response) {
                    /*  console.log(newData); */
                    // Error: La validación ha fallado, muestra los errores en el modal
                    var errors = response.responseJSON.errors;
                    var errorMessages = $('.error-messagesEdit');

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
                    $('#pacienteModalEditar').modal('show');
                }
            });
        });
    </script>
@stop
