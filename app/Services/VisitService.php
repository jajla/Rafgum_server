<?php

namespace App\Services;

use App\Models\Visit;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

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
}
}