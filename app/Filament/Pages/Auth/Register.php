<?php

namespace App\Filament\Pages\Auth;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Pages\Auth\Register as BaseRegister;
use Filament\Pages\Auth\Contracts\RegistrationResponse;
use Filament\Facades\Filament;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;

class Register extends BaseRegister
{
    public function form(Form $form): Form
    {
        return $this->makeForm()
            ->schema([
                $this->getNameFormComponent(),
                $this->getEmailFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getPasswordConfirmationFormComponent(),
                $this->getRoleFormComponent(),
            ])
            ->statePath('data');
    }

    protected function getRoleFormComponent(): Component
    {
        return Select::make('role')
            ->options([
                'utilisateur' => 'Utilisateur',
                'prestataire' => 'Prestataire',
            ])
            ->default('utilisateur')
            ->required();
    }

   //public function register(): ?RegistrationResponse
   //{
   //    try {
   //        $this->rateLimit(2);
   //    } catch (TooManyRequestsException $e) {
   //        $this->getRateLimitedNotification($e)?->send();
   //        return null;
   //    }

   //    $user = $this->wrapInDatabaseTransaction(function () {
   //        $this->callHook('beforeValidate');
   //        $data = $this->form->getState();
   //        $this->callHook('afterValidate');
   //        $data = $this->mutateFormDataBeforeRegister($data);
   //        $this->callHook('beforeRegister');
   //        $user = $this->handleRegistration($data);
   //        $this->form->model($user)->saveRelationships();
   //        $this->callHook('afterRegister');
   //        return $user;
   //    });

   //    event(new \Illuminate\Auth\Events\Registered($user));

   //    // Envoi-manuel ici : seulement à l’inscription !
   //    $this->sendEmailVerificationNotification($user);

   //    Filament::auth()->login($user);
   //    session()->regenerate();

   //    return app(RegistrationResponse::class);
   //}
}
