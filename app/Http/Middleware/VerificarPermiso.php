<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class VerificarPermiso
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $accionNombre): Response
    {
        // Crear una variable que guarde el usuario autenticado
        $usuario = auth()->user();

        // Realizar comprobación si existe usuario autenticado o no tiene permiso
        if (!$usuario || !$usuario->tienePermiso($accionNombre)) {
            abort(403, 'No tienees permiso para esta acción');
        }

        return $next($request);
    }
}
