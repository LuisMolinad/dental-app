@extends('layouts.app')
{{-- <link rel="shortcut icon" href="{{ asset('./img/icono1.png') }}"> --}}

@section('title', 'Editar Usuario')
{{-- <link rel="stylesheet" href="{{ asset('css/botton.css') }}">
 --}}
@section('content_header')
    <div class="container" style="padding-top: 1rem">
        <h1>Editar Usuario</h1>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    {{-- Manejador de Errores que muestra aquellos que no estan llenos --}}
                    {{-- El formulario siguiente se ha hecho con el uso de la libreria HTML COLLECTIVE
    Su funcion principal es facilitar la creacion de formularios de envio de alguna variable
    Para mas informacion revisar la docunentacion oficial --}}
                    <form method="post" action="{{ route('usuarios.update', $user->id) }}">
                        @method('PUT')
                        @csrf
                        <div class="container">
                            {{-- Manejador de Errores que muestra aquellos que no están llenos --}}
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
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="name">Nombre</label>
                                    {{-- Las variables deben ir exactamente como se reciben en el controlador --}}
                                    <input type="text" name="name" value="{{ $user->name }}" class="form-control">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email">E-mail</label>
                                    <input type="text" name="email" value="{{ $user->email }}" class="form-control">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" class="form-control">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="confirm-password">Confirmar Password</label>
                                    <input type="password" name="confirm-password" class="form-control">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Roles</label>
                                    <select name="roles[]" class="form-control">
                                        @foreach ($roles as $value => $label)
                                            <option value="{{ $value }}"
                                                @if (in_array($value, $userRole)) selected @endif>
                                                {{ $label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            @can('editar-Usuarios')
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            @endcan
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@stop
