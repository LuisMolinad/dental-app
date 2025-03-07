@extends('adminlte::page')
{{-- @section('plugins.Toastr', true) --}}

<link rel="shortcut icon" href="{{ asset('./img/icono1.png') }}">
{{-- @section('plugins.Jquery', true)
 --}}


@section('plugins.Datatables', true)
@section('title')
    {{--  <link rel="shortcut icon" href="{{ asset('./img/icono1.png') }}"> --}}
    {{ config('adminlte.title') }}
    @hasSection('subtitle')
        | @yield('subtitle')
    @endif
@stop

@section('css')
    @yield('css')

@stop

@section('content_header')
    @yield('content_header')
@stop

@section('content')
    @yield('content')

@stop
@section('footer')
    <div class="float-right d-none d-sm-block">
        V 0.0.1
    </div>
    <strong>&copy; 2023 <a href="#">Nombre de tu empresa</a>.</strong> Todos los derechos reservados.
@stop

@section('js')
    @yield('js')
    <script src="https://kit.fontawesome.com/c662e065a6.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/eliminar_sweetalert2.js') }}"></script>
@stop
