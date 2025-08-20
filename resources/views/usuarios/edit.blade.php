@extends('layout')
@section('title','Editar Usuario')

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
        <div class="card-body">
            <h3 class="mb-4">Editar Usuario</h3>

            <form id="form" action="{{ route('usuarios.update',$datos->id) }}" method="POST" novalidate>
                @csrf
                @method('PUT')

                {{-- Nombre --}}
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror" placeholder="Ingrese nombre" value="{{ old('nombre', $datos->nombre) }}">
                    @error('nombre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Teléfono --}}
                <div class="mb-3">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input type="text" name="telefono" id="telefono" class="form-control @error('telefono') is-invalid @enderror" placeholder="Ingrese teléfono" value="{{ old('telefono', $datos->telefono) }}">
                    @error('telefono')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Rol --}}
                <div class="mb-3">
                    <label class="form-label">Seleccione el rol del usuario</label>
                     @foreach($roles as $rol)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="id_rol" id="r{{ $rol->nombre }}" value="{{ $rol->id }}" {{ old('id_rol', $datos->id_rol) == $rol->id ? 'checked' : '' }}>
                            <label class="form-check-label" for="r{{ $rol->nombre }}">{{ $rol->nombre }}</label>
                        </div>
                    @endforeach
                    @error('id_rol')
                        <div class="text-danger mt-1 small">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="mb-3">
                    <label for="email" class="form-label">Correo electrónico</label>
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Ingrese correo" value="{{ old('email', $datos->email) }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Ingrese nueva clave">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                @if(Auth::user()->id_rol === 1)
                <div class="mt-4">
                <label class="form-label d-block mb-3 fw-bold fs-5">Permisos</label>
                    <div class="row">
                        @php
                            $grupos = [];
                            foreach ($acciones as $accion) {
                                $grupos[$accion->modulo][] = $accion;
                                // dd($acciones);
                            }
                        @endphp
                        @foreach($grupos as $modulo => $items)
                            <div class="card mb-3 shadow-sm">
                                <div class="card-header bg-primary text-white mt-3">
                                    <h5 class="mb-0">{{ $modulo }}</h5>
                                </div>
                                <div class="card-body">
                                    @foreach($items as $item)
                                        <div class="form-check mb-2">
                                            <input type="checkbox" id="accion_{{ $item->id }}" name="accion_id[]" class="form-check-input" value="{{ $item->id }}"
                                                {{ in_array($item->id, $permisosAsignados ?? []) ? 'checked' : '' }}
                                            >
                                            <label for="accion_{{ $item->id }}" class="form-check-label" style="cursor: pointer;">
                                                {{ $item->nombre }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach


                        {{-- @foreach ($acciones as $nombre => $id)
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="accion[]" value="{{ $id }}" id="accion_{{ $id }}">
                                    <label class="form-check-label" for="accion_{{ $id }}">
                                        {{ $nombre }}
                                    </label>
                                </div>
                            </div>
                        @endforeach 
                    </div>
                </div>  --}}
                @endif

                {{-- Botones --}}
                <div class="mt-4">
                    <button type="submit" class="btn btn-success">Guardar</button>
                    <a href="{{ url('usuarios') }}" class="btn btn-secondary">Cancelar</a>
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
            telefono: {
                required: true,
                digits: true
            },
            id_rol: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            password: {
                minlength: 6 // no es requerida, pero si la ingresan, debe ser válida
            }
        }
    });
</script>
@stop
