<?php

namespace App\Services;

use App\Models\ActivityType;
use Illuminate\Database\Eloquent\Collection;

class ActivityTypeService
{
    public function getAll(): Collection
    {
        return ActivityType::orderBy('order')->get();
    }
}
