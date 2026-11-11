<?php

namespace App\Services;

use App\Models\Visit;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Enums\Roles;

class VisitService
{
    // public function getAvailableTimesForDate(?string $date): array
    // {
    //     if (!$date) {
    //         return [];
    //     }

    //     $date = Carbon::parse($date);

    //     $startPeriod = $date->copy()->hour(9);
    //     $endPeriod = $date->copy()->hour(18);

    //     $times = CarbonPeriod::create(
    //         $startPeriod,
    //         '30 minutes',
    //         $endPeriod
    //     );

    //     $reservations = Visit::whereDate('date', $date)
    //         ->pluck('time')
    //         ->map(fn($time) => Carbon::parse($time)->format('H:i'))
    //         ->toArray();

    //     $availableReservations = [];

    //     foreach ($times as $time) {
    //         $formattedTime = $time->format('H:i');

    //         if (!in_array($formattedTime, $reservations)) {
    //             $availableReservations[$formattedTime] = $formattedTime;
    //         }
    //     }

    //     return $availableReservations;
    // }
   
   
   
   /*
   
    public function getAvailableTimesForDate(?string $date, ?int $ignoreVisitId = null): array
{
    if (!$date) {
        return [];
    }

    $date = Carbon::parse($date);

    $startPeriod = $date->copy()->hour(9);
    $endPeriod = $date->copy()->hour(18);

    $times = CarbonPeriod::create(
        $startPeriod,
        '30 minutes',
        $endPeriod
    );

    $query = Visit::whereDate('date', $date);

    if ($ignoreVisitId) {
        $query->where('id', '!=', $ignoreVisitId);
    }

    $reservations = $query
        ->pluck('time')
        ->map(fn($time) => Carbon::parse($time)->format('H:i'))
        ->toArray();

    $availableReservations = [];

    foreach ($times as $time) {
        $formattedTime = $time->format('H:i');

        if (!in_array($formattedTime, $reservations)) {
            $availableReservations[$formattedTime] = $formattedTime;
        }
    }

    return $availableReservations;
}*/


    public function getAvailableTimesForDate(
        ?string $date,
        ?int $ignoreVisitId = null
    ): array {
        if (!$date) {
            return [];
        }

        $date = Carbon::parse($date);

        $startPeriod = $date->copy()->hour(9);
        $endPeriod = $date->copy()->hour(18);

        $times = CarbonPeriod::create(
            $startPeriod,
            '30 minutes',
            $endPeriod
        );

        $query = Visit::whereDate('date', $date);

        if ($ignoreVisitId) {
            $query->where('id', '!=', $ignoreVisitId);
        }

        $reservations = $query
            ->get()
            ->groupBy(
                fn ($visit) => Carbon::parse($visit->time)->format('H:i')
            );

        $availableReservations = [];

        $isAdmin = auth()->user()?->role === Roles::Admin;

        foreach ($times as $time) {
            $formattedTime = $time->format('H:i');

            $visits = $reservations->get($formattedTime, collect());

            $hasMain = $visits->contains('status', 'glowny');
            $hasAdditional = $visits->contains('status', 'dodatkowy');

            if ($isAdmin) {
                // Admin może wybrać godzinę, jeśli brakuje jednego statusu
                if (!$hasMain || !$hasAdditional) {
                    $availableReservations[$formattedTime] = $formattedTime;
                }
            } else {
                // Klient może wybrać tylko całkowicie wolną godzinę
                if (!$hasMain && !$hasAdditional) {
                    $availableReservations[$formattedTime] = $formattedTime;
                }
            }
        }

        return $availableReservations;
    }
}