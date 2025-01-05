<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RolUsuario
{
    /**
     * Handle an incoming request.
     *f
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($request->user()->rol ===1){
            return redirect()->route('home');
        }
        return $next($request);
    }
}
