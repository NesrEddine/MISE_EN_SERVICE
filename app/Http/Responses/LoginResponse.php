<?php

namespace App\Http\Responses;

use App\Filament\Pages\Admin\Dashboard;
use App\Filament\Pages\SuperAdmin\SuperDashboard;
use App\Filament\Pages\User\DashboardUser;
use Filament\Http\Responses\Auth\LoginResponse as BaseLoginResponse;
use Illuminate\Http\RedirectResponse;
use Livewire\Features\SupportRedirects\Redirector;

class LoginResponse extends BaseLoginResponse
{
    public function toResponse($request): RedirectResponse|Redirector
    {

        if (auth()->user()->role === 'prestataire') {
            return redirect()->to(Dashboard::getUrl(panel: 'admin'));
        }

        if (auth()->user()->role === 'utilisateur') {
            //dd('user');
            return redirect()->to(DashboardUser::getUrl(panel: 'user'));
        }

        if (auth()->user()->role === 'super') {
            //dd('user');
            return redirect()->to(SuperDashboard::getUrl(panel: 'super'));
        }

        return parent::toResponse($request);
    }
}
