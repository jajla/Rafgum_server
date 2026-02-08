<?php

namespace App\Providers;

use App\Http\Responses\LogoutResponse;
use BezhanSalleh\LanguageSwitch\LanguageSwitch;
use Filament\Http\Responses\Auth\Contracts\LogoutResponse as LogoutResponseContract;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */

    public function register(): void
    {

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        LanguageSwitch::configureUsing(function (LanguageSwitch $switch) {
            $switch
                ->locales(['en', 'pl']); // also accepts a closure
        });


        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            return (new MailMessage)
                ->subject(Lang::get('Verify Email Address'))
                ->greeting(Lang::get('Hello') . ' ' . $notifiable->name . '!')
                ->line(Lang::get('Please click the button below to verify your email address.'))
                ->action(Lang::get('Verify Email Address'), $url)
                ->line(Lang::get('If you did not create an account, no further action is required.'));

        });
        /* if (app()->isLocal()) {
         DB::listen(function ($query) {
             logger($query->sql, $query->bindings);
         });
     }*/
    }
}
