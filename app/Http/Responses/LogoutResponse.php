<?php
use Filament\Facades\Filament;
use Illuminate\Http\RedirectResponse;
use Filament\Http\Responses\Auth\LogoutResponse as BaseLogoutResponse;

class LogoutResponse extends BaseLogoutResponse
{
    public function toResponse($request): RedirectResponse
    {
        if (Filament::getCurrentPanel()->getId() === 'admin') {
            return redirect()->to(Filament::getLoginUrl());
        }

        if (Filament::getCurrentPanel()->getId() === 'user') {
            return redirect()->to(Filament::getLoginUrl());
        }

        return parent::toResponse($request);
    }
}
