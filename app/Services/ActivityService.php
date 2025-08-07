<?php

namespace App\Services;

use App\Models\Activity;
use Illuminate\Pagination\LengthAwarePaginator;

class ActivityService
{
    public function getAllPaginated(int $perPage = 10): LengthAwarePaginator
    {
        return Activity::with(['activityType', 'participant'])
            ->latest()
            ->paginate($perPage);
    }
}
