<?php

namespace App\Filament\Resources\User\UserResource\Pages\Auth;

use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Auth\VerifyEmail;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\URL;

class CreateUser extends CreateRecord
{
    //protected static string $resource = UserResource::class;

    protected function afterCreate(): void
    {
        $user = $this->record;

        $notification = new VerifyEmail();
        $notification->url = URL::temporarySignedRoute(
            'filament.user.auth.email-verification.verify',
            now()->addMinutes(config('auth.verification.expire', 60)),
            [
                'id' => $user->getKey(),
                'hash' => sha1($user->getEmailForVerification()),
            ],
        );

        $user->notify($notification);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

}
