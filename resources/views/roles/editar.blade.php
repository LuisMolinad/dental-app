@extends('layouts.app')

@section('title', 'Editar Rol')


@section('content_header')
    <h1 class="m-0 text-dark">Editar Rol</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-dark alert-dismissible fade show"role="alert">
                            <strong>¡Revise los campos!</strong>
                            @foreach ($errors->all() as $error)
                                <span class="badge badge-danger">{{ $error }}</span>
                            @endforeach
                            <button type="button"class="close"data-dismiss="alert"aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    {{--  --}}

                    <form action="{{ route('roles.update', $role->id) }}" method="POST">
                        {{-- @csrf --}}
                        @csrf
                        {{ method_field('PATCH') }}
                        <div class="container">

                            <div class="form-group col-md-6">
                                <label for="name">Nombre del Rol</label>
                                {{-- Las variables deben ir exactamente como se reciben en el controlador --}}
                                {{-- {!! Form::text('name', null, ['class' => 'form-control']) !!} --}}
                                <input class="form-control" type="text" name="name" id="name"
                                    value="{{ $role->name }}">
                            </div>
                            <div class="table-responsive">
                                <label for="table">Permisos para este Rol:</label>
                                <table class="table w-auto">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Permisos</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($permission as $value)
                                            <tr>
                                                <td> <input type="checkbox" name="permission[]" class="name"
                                                        value="{{ $value->id }} "
                                                        @if (in_array($value->id, $rolePermissions) == true) checked @endif></td>
                                                <td> {{ $value->name }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>


                            <button type="submit"class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
