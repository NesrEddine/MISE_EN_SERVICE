<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Filament\Facades\Filament;

class RedirectToProperPanelMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if ($user) {
            $currentPanel = Filament::getCurrentPanel()?->getId();
            //dd($user->role);

            // Redirect 'admin' users away from non-admin panels
            if ($user->role === 'prestataire' && $currentPanel !== 'admin') {
                return redirect()->to(Filament::getPanel('admin')->getUrl());
            }

            // Redirect 'utilisateur' users away from non-user panels
            if ($user->role === 'utilisateur' && $currentPanel !== 'user') {
                return redirect()->to(Filament::getPanel('user')->getUrl());
            }

            // Redirect 'superAdmin' users away from non-user panels
            if ($user->role === 'super' && $currentPanel !== 'super') {
                return redirect()->to(Filament::getPanel('super')->getUrl());
            }
        }

        return $next($request);
    }
}
