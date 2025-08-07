<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ActivityResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'short_description' => $this->short_description,
            'description' => $this->description,
            'registration_url' => $this->registration_url,
            'location' => $this->location,
            'coordinates' => $this->coordinates,
            'dates' => $this->dates,
            'media' => $this->media,
            'activity_type' => new ActivityTypeResource($this->whenLoaded('activityType')),
            'participant' => new ParticipantResource($this->whenLoaded('participant')),
        ];
    }
}
