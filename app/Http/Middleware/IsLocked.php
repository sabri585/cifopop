<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class IsLocked {
    public function handle(Request $request, Closure $next) {
        
        //nombre de rutas permitidas para los usuarios bloqueados
        $allowed = ['contacto', 'contacto.email', 'user.locked', 'logout'];
        
        //toma el usuario identificado y el nombre de la ruta
        $user = $request->user();
        $ruta = Route::currentRouteName();
        
        //si hay usuario, está bloqueado o intenta acceder a una ruta no permitida,
        //le llevamos a la ruta de bloqueo
        if ($user && $user->hasRole('bloqueado') && !in_array($ruta, $allowed)) {
            return redirect()->route('user.locked');
        }
         
         return $next($request);
    }
}