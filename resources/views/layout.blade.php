<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ url('css/style.css') }}" type="text/css">
    
    @yield('css')
    <title>@yield('title')</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container d-flex align-items-center justify-content-between">
            
            <!-- Rol del usuario -->
            <div class="d-flex align-items-center me-4 gap-3">
                <span class="badge bg-primary text-white px-3 py-2 fs-6">
                    <i class="bi bi-person-badge-fill me-1"></i> {{ Auth::user()->rol->nombre }}
                </span>
                <span class="badge bg-primary text-white px-3 py-2 fs-6 gap-2">
                    {{ Auth::user()->nombre }}
                </span>
            </div>

            <!-- Enlace a inicio centrado -->
            <a class="navbar-brand mx-auto fw-bold" href="{{ url('home') }}">Inicio</a>

            <!-- Botón para dispositivos pequeños -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" 
                aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Contenido colapsable -->
            <div class="collapse navbar-collapse" id="navbarContent">
                @if (Auth::user())
                    <ul class="navbar-nav ms-auto">
                        @if (Auth::user()->rol->nombre == "Administrador")
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('roles') }}">Roles</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('categorias') }}">Categorías</a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('usuarios') }}">Usuarios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-danger" href="{{ url('logout') }}">Salir</a>
                        </li>
                    </ul>
                @endif
            </div>
        </div>
    </nav>


    <div class="container mt-4">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    @yield('js')
</body>
</html>
