<?php

namespace App\Providers;

use App\Http\Responses\CustomLogoutResponse;
use BezhanSalleh\LanguageSwitch\Enums\Placement;
use BezhanSalleh\LanguageSwitch\LanguageSwitch;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\ServiceProvider;
use Filament\Auth\Http\Responses\Contracts\LogoutResponse as FilamentLogoutResponse;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */

    public function register(): void
    {
        $this->app->bind(FilamentLogoutResponse::class, CustomLogoutResponse::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        LanguageSwitch::configureUsing(function (LanguageSwitch $switch) {
            $switch
                ->locales(['en', 'pl'])
                ->outsidePanelPlacement(Placement::TopRight)
                ->visible(outsidePanels: true);
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
