@extends('layout')
@section('title','Listado de Categorías')

@section('css')
<style>
  body {
    background-color: #e9f2fb;
  }
  .card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
</style>
@endsection

@section('content')
<div class="container mt-5">
  <div class="card shadow-sm">
    <div class="card-header">
      <h2 class="mb-0">Listado de Categorías</h2>
      <a href="{{ url('categorias/create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Nuevo
      </a>
    </div>
    <div class="card-body p-0">
      @if(session('type'))
        <div class="alert alert-{{ session('type') }} alert-dismissible fade show m-3" role="alert">
          <strong>Aviso:</strong> {{ session('message') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
      @endif

      <table class="table table-striped table-hover mb-0">
        <thead class="bg-light">
          <tr>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach($datos as $categoria)
          <tr>
            <td>{{ $categoria->nombre }}</td>
            <td>{{ $categoria->descripcion }}</td>
            <td>
              <a href="{{ route('categorias.edit', $categoria->id) }}" class="btn btn-outline-primary btn-sm">Editar</a>
              <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-outline-danger btn-sm" onclick="return confirm('¿Desea eliminar la categoría?')">Eliminar</button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@stop
