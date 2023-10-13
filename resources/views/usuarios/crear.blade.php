@extends('layouts.app')


@section('title', 'Alta Usuario')
@section('content_header')
    <div class="container" style="padding-top: 1rem">
        <h1>Alta Usuario </h1>
    </div>
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
                            <button type="button"class="close"data-dismiss="alert"aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <form action="{{ route('usuarios.store') }}" method="post">
                        @csrf
                        @method('POST')
                        <div class="container">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="name">Nombre</label>
                                    {{-- Las variables deben ir exactamente como se reciben en el controlador --}}

                                    <input type="text" class="form-control" id="name" name="name"
                                        value=" {{ old('name') }} "required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email">E-mail</label>

                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ old('email') }}" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="password">Password</label>

                                    <input type="password" class="form-control" id="password" name="password"
                                        value="{{ old('password') }}" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="confirm-password">Confirmar Password</label>
                                    <input type="password" class="form-control" id="confirm-password"
                                        name="confirm-password" value="{{ old('confirm-password') }}" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Roles</label>
                                    {{--  {!! Form::select('roles[]', $roles, [], ['class' => 'form-control']) !!} --}}
                                    <select name="roles[]" class="form-control">
                                        @foreach ($roles as $value => $label)
                                            <option value="{{ $value }}">{{ $label }}</option>
                                        @endforeach
                                    </select>

                                </div>

                            </div>
                            @can('crear-Usuarios')
                                <button type="submit"class="btn btn-primary">Guardar</button>
                            @endcan
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@stop
