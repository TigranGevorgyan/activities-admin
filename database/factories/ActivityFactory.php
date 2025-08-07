<?php

namespace Database\Factories;

use App\Models\Activity;
use App\Models\Participant;
use App\Models\ActivityType;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActivityFactory extends Factory
{
    protected $model = Activity::class;

    protected static array $mediaPool = [
        'seed-images/activities/event1.jpg',
        'seed-images/activities/event2.png',
        'seed-images/activities/event3.jpg',
        'seed-images/activities/event4.jpg',
        'seed-images/activities/event5.jpg',
    ];

    public function definition(): array
    {
        $coordinates = collect(range(1, 5))->map(fn () => [
            round($this->faker->latitude(), 6),
            round($this->faker->longitude(), 6),
        ])->toArray();

        $coordinates[] = $coordinates[0];

        return [
            'name' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'short_description' => $this->faker->sentence(10),
            'source_id' => Participant::inRandomOrder()->first()->id ?? Participant::factory(),
            'activity_type_id' => ActivityType::inRandomOrder()->first()->id ?? ActivityType::factory(),
            'media' => $this->faker->randomElements(self::$mediaPool, rand(1, 3)),
            'registration_url' => $this->faker->url(),
            'location' => $this->faker->city(),
            'coordinates' => $coordinates,
            'dates' => [
                [
                    'start' => $this->faker->dateTimeBetween('now', '+1 week')->format(DATE_ATOM),
                    'end' => $this->faker->dateTimeBetween('+1 week', '+2 weeks')->format(DATE_ATOM),
                ],
            ],
        ];
    }
}
