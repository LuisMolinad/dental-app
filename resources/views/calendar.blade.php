@extends('layouts.app')
@section('title', 'Calendario')
{{-- Plugins --}}
@section('plugins.FullCalendar', true)
@section('plugins.Jquery', true)
@section('plugins.Toastr', true)
@section('plugins.Sweetalert2', true)

@push('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/calendar.css') }}">

    <link rel="stylesheet" href="{{ asset('css/button.css') }}">
@endpush




@section('content_header')

    <h1 class="m-0 text-dark"></h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="card">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <!-- Contenido del encabezado -->
                    </div>
                </div>
                <div id='calendar' class="card-body">
                    <!-- Contenido del calendario -->
                </div>
            </div>
        </div>
    </div>
    {{-- Modal crear cita --}}
    <div class="modal fade" id="citaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Crear Cita:</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="error-messages">
                        <!-- Aquí mostrarás los mensajes de error -->
                    </div>
                    {{-- Formulario --}}
                    <form id="formulario-paciente" class="row g-3 needs-validation" action="{{-- {{ route('pacientes.store') }} --}}"
                        method="post" novalidate>
                        @csrf
                        @method('POST')

                        <div class="row">
                            <div class="col-md-6">
                                <label for="Paciente" class="form-label">Paciente:</label>
                                <input type="text" class="form-control" id="Paciente" name="Paciente" required>
                                <div class="valid-feedback">
                                    Es correcto
                                </div>

                            </div>
                            <div class="col-md-6">
                                <label for="fecha_cita" class="form-label">Fecha:</label>
                                <input type="date" class="form-control" id="fecha_cita" name="fecha_cita" required>
                                <div class="valid-feedback">
                                    Es correcto
                                </div>

                            </div>
                            <div class="col-md-6">
                                <label for="inicioCita" class="form-label">Inicio:</label>
                                <input type="time" class="form-control" id="inicioCita" name="inicioCita" required>
                                <div class="valid-feedback">
                                    Es correcto
                                </div>

                            </div>
                            <div class="col-md-6">
                                <label for="finCita" class="form-label">Fin:</label>
                                <input type="time" class="form-control" id="finCita" name="finCita" required>
                                <div class="valid-feedback">
                                    Es correcto
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="tratamiento" class="form-label">Tratamiento:</label>
                                <select class="form-select form-select-sm" id="tratamiento"
                                    aria-label=".form-select-sm example">
                                    <option selected>Open this select menu</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                        </div>

                        <div class="modal-footer col-12">
                            <button type="button" class="btn btn-secondary float-right"
                                data-bs-dismiss="modal">Cancelar</button>
                            <button class="btn btn-success float-right" type="submit">Guardar Paciente</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@push('js')
    <script src="{{ asset('js/calendar.js') }}"></script>
@endpush
