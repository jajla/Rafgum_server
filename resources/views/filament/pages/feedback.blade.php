<x-filament-panels::page>

    {{-- FORM – tylko USER --}}
    @if (Auth::user()?->role === \App\Enums\Roles::User)
        <x-filament::card>
            <form wire:submit.prevent="submit">
                {{ $this->form }}
            </form>
        </x-filament::card>
    @endif

    {{-- TABLE – tylko ADMIN --}}
    @if (Auth::user()?->role === \App\Enums\Roles::Admin)
        <x-filament::card class="mt-6">
            {{ $this->table}}
        </x-filament::card>
    @endif

</x-filament-panels::page>
