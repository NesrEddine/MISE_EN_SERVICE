<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Filament\Http\Responses\Auth\Contracts\LoginResponse;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Auth\Events\Registered;



class AppServiceProvider extends ServiceProvider
{

   // public $singletons = [
   //     \Filament\Http\Responses\Auth\Contracts\LoginResponse::class => \App\Http\Responses\LoginResponse::class,
   // ];



    public function register(): void
    {
        $this->app->singleton(
            LoginResponse::class,\App\Http\Responses\LoginResponse::class
        );
    }


    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
       // \Event::forget(Registered::class, SendEmailVerificationNotification::class);
    }
}
