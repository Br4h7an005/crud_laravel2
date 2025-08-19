@extends('layout')
@section('title','Saludo')

@section('css')
<style>
    body {
        background-color: #e9f2fb;
    }
</style>
@endsection

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm border-0">
        <div class="card-body text-center">
            <div class="d-flex justify-content-center align-items-center mb-3">
                <img src="https://laravel.com/img/logomark.min.svg" alt="Laravel Logo" width="50" height="50" class="me-3">
                <h3 class="mb-0">Bienvenido a mi página con Laravel</h3>
            </div>
            <p class="text-muted">Esta es una aplicación construida usando el framework Laravel.</p>
        </div>
    </div>
</div>
@stop
