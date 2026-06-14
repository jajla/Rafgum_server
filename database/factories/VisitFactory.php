<?php

namespace Database\Factories;

use App\Enums\Services;
use App\Models\Visit;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Visit>
 */
class VisitFactory extends Factory
{
    protected $model = Visit::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),

            'date' => fake()
                ->dateTimeBetween('now', '+3 months')
                ->format('Y-m-d'),

            'time' => fake()->time('H:i'),

            'service_type' => fake()->randomElement(
                array_column(Services::cases(), 'value')
            ),

            'status' => fake()->randomElement([
                'pending',
                'confirmed',
                'completed',
                'cancelled',
            ]),
        ];
    }
}