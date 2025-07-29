<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // return $next($request);
        if (!Auth::check()) {
            return redirect('/login');
        }
         $user = Auth::user();

        // Vérifier si l'utilisateur a au moins un des rôles requis
        foreach ($roles as $role) {
            if ($user->hasRole($role)) {
                return $next($request);
            }
        }
         // Si l'utilisateur n'a aucun des rôles requis
        abort(403, 'Accès refusé. Vous n\'avez pas les permissions nécessaires.');
   
    }
}
