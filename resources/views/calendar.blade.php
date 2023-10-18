@extends('layouts.app')
@section('title', 'Calendario')
{{-- Plugins --}}
@section('plugins.FullCalendar', true)
@section('plugins.Jquery', true)

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/calendar.css') }}">
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
    {{--    <div class="modal fade" id="citaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div> --}}
@stop

@push('js')
    <script src="{{ asset('js/calendar.js') }}"></script>
@endpush
