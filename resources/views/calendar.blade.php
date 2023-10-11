@extends('adminlte::page')
{{-- @section('plugins.Toastr', true) --}}
@section('title', 'AdminLTE')
@section('plugins.FullCalendar', true)
<link rel="shortcut icon" href="{{ asset('./img/icono1.png') }}">
@section('content_header')

    <h1 class="m-0 text-dark">Caendario</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div id='calendar'></div>
                </div>
            </div>
        </div>
    </div>

@stop

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: "dayGridMonth" /*Inicializa por medio de la vista de mes*/ ,
                locale: "es" /*Idioma espanol*/ ,
                height: 650,
                headerToolbar: {
                    left: 'prevYear,prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                    //right: "dayGridMonth,timeGridWeek,timeGridDay,listWeek",
                },
                //editable: true, //para que puedan moverse los eventos
                //dayMaxEvents: true, // cuando se encuentran muchos eventos se mostrara una burbuja

                //Formato de Tiempo
                eventTimeFormat: { // like '14:30:00'
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: false
                },

                //Para que no de el error pasada las 11:00 pm
                nextDayThreshold: '23:00:00',

            });
            calendar.render();
        });
    </script>
@endpush
