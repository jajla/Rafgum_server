<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\Attributes\Test;

class EmailVerificationTest extends TestCase
{
    use DatabaseTransactions;

    #[Test]
    public function email_verification_flow_works_correctly_for_filament()
    {
        Notification::fake();

        $user = User::factory()->create([
            'email_verified_at' => null,
        ]);

        // Wysłanie maila weryfikacyjnego
        $user->sendEmailVerificationNotification();

        Notification::assertSentTo($user, VerifyEmail::class);

        // Próba wejścia do panelu Filament (oczekiwany 403)
        $this->actingAs($user)
            ->get('/admin')
            ->assertStatus(403);

        // Generujemy link weryfikacyjny
        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(60),
            [
                'id' => $user->id,
                'hash' => sha1($user->email),
            ]
        );

        // Kliknięcie linku weryfikacyjnego
        $this->actingAs($user)
            ->get($verificationUrl)
            ->assertRedirect('/admin');

        // Sprawdzenie czy email został zweryfikowany
        $this->assertNotNull($user->fresh()->email_verified_at);
    }
}
