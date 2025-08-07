<?php

namespace App\Services;

use App\Models\Participant;
use Illuminate\Pagination\LengthAwarePaginator;

class ParticipantService
{
    public function getPaginated(int $perPage = 10): LengthAwarePaginator
    {
        return Participant::query()->paginate($perPage);
    }
}
