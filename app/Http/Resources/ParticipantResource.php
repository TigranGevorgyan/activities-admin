<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ParticipantResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'website_url' => $this->website_url,
            'location'    => $this->location,
            'logo'        => $this->logo ? asset('storage/' . $this->logo) : null,
            'coordinates' => $this->coordinates,
        ];
    }
}
