@extends('layout')
@section('title','Listado de Usuarios')

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

            <h2 class="mb-4 border-bottom pb-2">Listado de Usuarios</h2>

            @if(session('type'))
                <div class="alert alert-{{ session('type') }} alert-dismissible fade show" role="alert">
                    <strong>Aviso:</strong> {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="text-end mb-3">
                <a href="{{ url('usuarios/create') }}" class="btn btn-primary">
                    <i class="bi bi-person-plus-fill me-1"></i> Nuevo
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Nombre</th>
                            <th>Teléfono</th>
                            <th>Rol</th>
                            <th>Correo</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($datos as $usuario)
                        <tr>
                            <td>{{ $usuario->nombre }}</td>
                            <td>{{ $usuario->telefono }}</td>
                            <td>{{ $usuario->rol->nombre }}</td>
                            <td>{{ $usuario->email }}</td>
                            <td class="text-center">
                                <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-outline-primary btn-sm me-1">
                                    Editar
                                </a>
                                <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('¿Desea eliminar el usuario?')" class="btn btn-outline-danger btn-sm">
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
