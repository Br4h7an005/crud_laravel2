<!DOCTYPE html>
<html lang="es">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Inicio de sesión</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
   <style>
      body {
         background: linear-gradient(to bottom right, #ffffff, #f0f0f0);
         min-height: 100vh;
      }
   </style>
</head>
<body>
   <div class="d-flex align-items-center justify-content-center min-vh-100">
      <div class="container">
         <div class="row justify-content-center">
            <div class="col-md-6">
               <div class="card shadow-sm border-0">
                  <div class="card-body p-4">
                     <h3 class="text-center mb-4">Inicio de Sesión</h3>
                     @if(session('type'))
                        <div class="alert alert-{{ session('type') }} alert-dismissible fade show" role="alert">
                           <strong>Aviso:</strong> {{ session('message') }}
                           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                     @endif

                     <form action="check" method="POST">
                        @csrf
                        <div class="mb-3">
                           <label for="email" class="form-label">Email</label>
                           <input type="email" class="form-control" id="email" name="email" placeholder="Ingrese su Email">
                        </div>

                        <div class="mb-3">
                           <label for="password" class="form-label">Contraseña</label>
                           <input type="password" class="form-control" id="password" name="password" placeholder="Ingrese su contraseña">
                        </div>

                        <div class="d-grid">
                           <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>
</html>
