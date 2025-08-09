<?php

namespace Database\Factories;

use App\Models\ActivityType;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActivityTypeFactory extends Factory
{
    protected $model = ActivityType::class;

    protected static array $icons = [
        'seed-images/activity-types/education.jpg',
        'seed-images/activity-types/sports.png',
        'seed-images/activity-types/concert.jpg',
        'seed-images/activity-types/festival.jpg',
        'seed-images/activity-types/conference.jpg',
    ];

    public function definition(): array
    {
        return [
            'name' => ucfirst($this->faker->word()),
            'icon' => $this->faker->randomElement(self::$icons),
            'order' => $this->faker->numberBetween(0, 20),
        ];
    }
}
