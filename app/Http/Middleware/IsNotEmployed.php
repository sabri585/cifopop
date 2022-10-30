<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsNotEmployed {
    public function handle(Request $request, Closure $next) {
        
        if ($request->user()->hasRole('administrador', 'editor')) {
            abort(403, 'Operación no permitida para empleados.');
        };
        
        return $next($request);
    }
}
