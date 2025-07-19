<?php

namespace App\Filament\Pages\Auth;

use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use Filament\Facades\Filament;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Http\Responses\Auth\Contracts\LoginResponse;
use Filament\Http\Responses\Auth\Contracts\LoginResponse as LoginResponseContract;
use Filament\Models\Contracts\FilamentUser;
use Filament\Pages\Auth\Login as BaseLogin;


class Login extends BaseLogin
{
    public function mount(): void
    {
        parent::mount();

        #$this->form->fill([
        #    'email' => 'admin@filamentphp.com',
        #    'password' => 'password',
        #    'remember' => true,
        #    'role' => 'prestataire',
        #]);
    }

    protected function getForms(): array
    {
        return [
            'form' => $this->form(
                $this->makeForm()
                    ->schema($this->getFormSchema())
                    ->statePath('data'),
            ),
        ];
    }

    protected function getFormSchema(): array
    {
        return [
            #Select::make('role')
            #    ->label('Rôle')
            #    ->options([
            #        'utilisateur' => 'Utilisateur',
            #        'prestataire' => 'Prestataire',
            #    ])
            #    ->required(),

            TextInput::make('email')
                ->label('Email')
                ->email()
                ->required()
                ->autocomplete('username'),

            TextInput::make('password')
                ->label('Mot de passe')
                ->password()
                ->required()
                ->autocomplete('current-password'),

            Checkbox::make('remember')
                ->label('Se souvenir de moi'),

            //ViewField::make('register_link')
              //  ->view('filament.pages.auth.partials.register-link')
        ];
    }

    public function authenticate(): ?LoginResponseContract
    {
        try {
            $this->rateLimit(5);
        } catch (TooManyRequestsException $exception) {
            $this->getRateLimitedNotification($exception)?->send();

            return null;
        }

        $data = $this->form->getState();

        if (!Filament::auth()->attempt($this->getCredentialsFromFormData($data), $data['remember'] ?? false)) {
            $this->throwFailureValidationException();
        }

        $user = Filament::auth()->user();

        // Désactivation de l'envoi automatique
        if (app()->bound('verified-event-listener')) {
            // on désactive l'envoi ici si besoin
        }

        if (
            ($user instanceof FilamentUser) &&
            (!$user->canAccessPanel(Filament::getCurrentPanel()))
        ) {
            Filament::auth()->logout();

            $this->throwFailureValidationException();
        }
        //dd(class_exists(\App\Http\Responses\LoginResponse::class));

        session()->regenerate();

        return app(LoginResponse::class);
    }
}
