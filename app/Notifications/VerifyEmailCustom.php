<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;

class VerifyEmailCustom extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Delivery channels
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Mail representation
     */
    public function toMail($notifiable): MailMessage
    {
        Log::info('Weryfikacja mail: user name = ' . $notifiable->name);
        // Generowanie URL weryfikacji
        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
            [
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
            ]
        );



        return (new MailMessage)
            ->greeting("Hello {$notifiable->name}!!") // <-- spersonalizowane powitanie
            ->subject('Verify Your Email Address')
            ->line('Please click the button below to verify your email address.')
            ->action('Verify Email', $verificationUrl)
            ->line('If you did not create an account, no further action is required.');
    }
}
