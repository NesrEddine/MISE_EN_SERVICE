<?php

namespace App\Providers\Filament;

use App\Filament\Pages\SuperAdmin\SuperDashboard;
use App\Filament\Pages\Auth\Login;
use App\Filament\Pages\Auth\Register;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\RedirectToProperPanelMiddleware;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Auth\EmailVerification\EmailVerificationPrompt;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\SpatieLaravelTranslatablePlugin;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class SuperAdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        //dd('login test');
        return $panel
            ->brandName('SUPER ADMIN')
            ->id('super')
            ->path('super')
            ->login(Login::class)
            ->registration(Register::class)
            //->emailVerification(EmailVerificationPrompt::class)
            ->passwordReset()
            ->profile()
            ->discoverClusters(in: app_path('Filament/Clusters/SuperAdmin'), for: 'App\\Filament\\Clusters\\SuperAdmin')
            #->discoverResources(in: app_path('Filament/Resources/SuperAdmin'), for: 'App\\Filament\\Resources\\SuperAdmin')
            #->discoverPages(in: app_path('Filament/Pages/SuperAdmin'), for: 'App\\Filament\\Pages\\SuperAdmin')
            ->pages([
                SuperDashboard::class,
                //Register::class, // <- ici
            ])
            //->discoverWidgets(in: app_path('Filament/Widgets/Admin'), for: 'App\\Filament\\Widgets\\Admin')
            ->widgets([
                Widgets\AccountWidget::class,
                #Widgets\FilamentInfoWidget::class,
            ])
            ->unsavedChangesAlerts()
            //->brandLogo(fn () => view('filament.app.logo'))
            ->brandLogoHeight('1.25rem')
            ->navigationGroups([
                'Shop',
                'Blog',
            ])
            ->databaseNotifications()
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
            ])
            ->authMiddleware([
                RedirectToProperPanelMiddleware::class,
                Authenticate::class,
            ])
            ->plugin(
                SpatieLaravelTranslatablePlugin::make()
                    ->defaultLocales(['en', 'es', 'nl']),
            );

    }
}
