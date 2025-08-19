@extends('layout')
@section('title','Listado de Roles')

@section('css')
<style>
    body {
        background-color: #e9f2fb;
    }
</style>
@endsection

@section('content')
<div class="container py-4">
    <div class="card shadow-sm border-0">
        <div class="card-body">

            <h2 class="mb-4 border-bottom pb-2">
                <i class="bi bi-shield-lock-fill me-2"></i>Listado de Roles
            </h2>

            @if(session('type'))
                <div class="alert alert-{{ session('type') }} alert-dismissible fade show" role="alert">
                    <strong>Aviso:</strong> {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="text-end mb-3">
                <a href="{{ url('roles/create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-1"></i> Nuevo
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Nombre</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($datos as $rol)
                        <tr>
                            <td>{{ $rol->nombre }}</td>
                            <td class="text-center">
                                <a href="{{ route('roles.edit', $rol->id) }}" class="btn btn-outline-primary btn-sm me-1">
                                    Editar
                                </a>
                                <form action="{{ route('roles.destroy', $rol->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm" onclick="return confirm('¿Desea eliminar el registro?')">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@stop
