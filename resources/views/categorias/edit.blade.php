@extends('layout')
@section('title','Editar Categoría')

@section('css')
<style>
  body {
    background-color: #f0f4f8;
  }
</style>
@endsection

@section('content')
<div class="container mt-5">
  <div class="card shadow-sm mx-auto" style="max-width: 600px;">
    <div class="card-body">
      <h3 class="card-title text-center mb-4">Editar Categoría</h3>
      <form id="form" action="{{ route('categorias.update', $datos->id) }}" method="POST" novalidate>
        @csrf
        @method('PUT')

        <div class="mb-3">
          <label for="nombre" class="form-label fw-semibold">Nombre</label>
          <input 
            type="text" 
            class="form-control @error('nombre') is-invalid @enderror" 
            id="nombre" 
            name="nombre" 
            placeholder="Ingrese el nombre" 
            value="{{ old('nombre', $datos->nombre) }}"
            required
            maxlength="50"
          >
          @error('nombre')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="descripcion" class="form-label fw-semibold">Descripción</label>
          <input 
            type="text" 
            class="form-control @error('descripcion') is-invalid @enderror" 
            id="descripcion" 
            name="descripcion" 
            placeholder="Ingrese la descripción" 
            value="{{ old('descripcion', $datos->descripcion) }}"
            required
            maxlength="200"
          >
          @error('descripcion')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="d-flex justify-content-center gap-3 mt-4">
          <button type="submit" class="btn btn-success px-4 fw-semibold">Guardar</button>
          <a href="{{ url('categorias') }}" class="btn btn-secondary px-4 fw-semibold">Cancelar</a>
        </div>
      </form>
    </div>
  </div>
</div>
@stop

@section('js')
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="{{ url('js/jquery.validate.min.js') }}"></script>
<script src="{{ url('js/localization/messages_es.min.js') }}"></script>
<script>
  $("#form").validate({
    rules: {
      nombre: {
        required: true,
        maxlength: 50
      },
      descripcion: {
        required: true,
        maxlength: 200
      }
    },
    errorClass: "invalid-feedback",
    errorElement: "div",
    highlight: function(element) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function(element) {
      $(element).removeClass('is-invalid');
    },
    errorPlacement: function(error, element) {
      error.insertAfter(element);
    }
  });
</script>
@stop
