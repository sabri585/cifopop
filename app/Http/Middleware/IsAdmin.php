<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin {
    public function handle(Request $request, Closure $next) {
        
        if (!$request->user()->hasRole('administrador')) {
            abort(403, 'Operación solamente para el administrador.');
        };
        
        return $next($request);
    }
}
