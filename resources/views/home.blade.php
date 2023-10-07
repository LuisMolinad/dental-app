@extends('adminlte::page')
@section('plugins.Toastr', true)
@section('title', 'AdminLTE')
<link rel="shortcut icon" href="{{ asset('./img/icono1.png') }}">
@section('content_header')

    <h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p class="mb-0">You are logged in!</p>
                </div>
            </div>
        </div>
    </div>
@stop
