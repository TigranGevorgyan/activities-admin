<?php

namespace Database\Factories;

use App\Models\Participant;
use Illuminate\Database\Eloquent\Factories\Factory;

class ParticipantFactory extends Factory
{
    protected $model = Participant::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'website_url' => $this->faker->url(),
            'logo' => 'participants/logos/' . $this->faker->word() . '.png',
            'location' => $this->faker->address(),
            'coordinates' => [
                [$this->faker->latitude(), $this->faker->longitude()],
                [$this->faker->latitude(), $this->faker->longitude()],
                [$this->faker->latitude(), $this->faker->longitude()],
                [$this->faker->latitude(), $this->faker->longitude()],
                [$this->faker->latitude(), $this->faker->longitude()],
            ],
        ];
    }
}
