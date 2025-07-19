<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    /**public function handle(Request $request, Closure $next, $role)
    {
        if ($role == 'prestataire' && !$request->user()->hasRole('prestataire')) {
            return redirect()->route('home');  // rediriger si ce n'est pas un prestataire
        }

        if ($role == 'utilisateur' && !$request->user()->hasRole('utilisateur')) {
            return redirect()->route('home');  // rediriger si ce n'est pas un utilisateur
        }

        return $next($request);
    }  **/

}
