<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\RolesController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('login');
});

Route::get('login', function () {
    return view('login');
})->name('login');

// Ruta para salir
Route::get('logout', function()  {
    Auth::logout();
    return redirect('/');
});


// Ruta para gestionar la validación de usuarios
Route::post('check', [UsuarioController::class, 'check']);

// Rutas protegidas
Route::middleware(["auth"])->group(function (){
    // Ruta de inicio
    Route::get('home', function (){
        return view('saludo');
    });
    
    // Rutas para enlazar las carpetas de las vistas con los controladores
    Route::resource('/usuarios', UsuarioController::class);

    // Protejer rutas, solo usuarios con rol "Administrador" pueden ingresar
    Route::middleware(['admin'])->group(function () {
        Route::resource('/categorias', CategoriaController::class);
        Route::resource('/roles', RolesController::class);        
    });

    // Protejer la ruta de producto (en construcción) para que solo el cliente pueda acceder a el
    // Lógica...
});