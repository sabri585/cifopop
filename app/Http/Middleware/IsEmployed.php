<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsEmployed {
    public function handle(Request $request, Closure $next) {
        
        if (!$request->user()->hasRole('administrador', 'editor')) {
            abort(403, 'Operación solo para empleados.');
        };
        
        return $next($request);
    }
}
