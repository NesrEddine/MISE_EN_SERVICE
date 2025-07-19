<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\EnsureUserIsPrestataire;


class PrestatairePanelPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        //dd('prestataire');
        return $panel
            ->id('prestatairePanel')
            ->path('prestataire') // plus propre que 'prestatairePanel' comme URL
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/PrestatairePanel/Resources'), for: 'App\\Filament\\PrestatairePanel\\Resources')
            ->discoverPages(in: app_path('Filament/PrestatairePanel/Pages'), for: 'App\\Filament\\PrestatairePanel\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/PrestatairePanel/Widgets'), for: 'App\\Filament\\PrestatairePanel\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
                EnsureUserIsPrestataire::class,
                // 👇 Ajoute ton middleware personnalisé ici :
                #fn ($request, $next) => Auth::check() && Auth::user()->role === 'prestataire'
                #    ? $next($request)
                #    : abort(403, 'Accès réservé aux prestataires'),
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->login() // Active la page de login par défaut
            ->authGuard('web')
            ->brandName('Espace Prestataire');
    }
}
