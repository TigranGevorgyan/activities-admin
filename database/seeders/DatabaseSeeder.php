<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Participant;
use App\Models\ActivityType;
use App\Models\Activity;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(RoleSeeder::class);

        $users = User::factory(10)->create();
        $activityTypes = ActivityType::factory(5)->create();
        $participants = Participant::factory(8)->create();
        $activities = Activity::factory(20)->create();

        $users->each(function ($user) use ($activities) {
            $user->favoriteActivities()->attach(
                $activities->random(rand(2, 5))->pluck('id')
            );
        });

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ])->assignRole('super_admin');
    }
}
