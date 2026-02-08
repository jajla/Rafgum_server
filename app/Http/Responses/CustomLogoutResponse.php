<?php

namespace App\Http\Responses;

use Filament\Auth\Http\Responses\Contracts\LogoutResponse as FilamentLogoutResponse;
use Illuminate\Http\RedirectResponse;

class CustomLogoutResponse implements FilamentLogoutResponse
{
    public function toResponse($request): RedirectResponse
    {
        return redirect('/');
    }
}
