<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @OA\Schema(
 *     schema="Participant",
 *     type="object",
 *     title="Participant",
 *     description="Participant entity",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Event Organizer Inc."),
 *     @OA\Property(property="website_url", type="string", format="uri", example="https://example.com"),
 *     @OA\Property(property="logo", type="string", example="uploads/logos/participant1.png"),
 *     @OA\Property(property="location", type="string", example="Berlin"),
 *     @OA\Property(property="coordinates", type="object", example={"lat": 52.52, "lng": 13.405}),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-08-08T12:00:00Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-08-08T12:00:00Z")
 * )
 */
class Participant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'website_url',
        'logo',
        'location',
        'coordinates',
    ];

    protected $casts = [
        'coordinates' => 'array',
    ];

    public function activities(): HasMany
    {
        return $this->hasMany(Activity::class, 'source_id');
    }

    public function setCoordinatesAttribute($value): void
    {
        if (is_string($value)) {
            // Decode and re-encode to strip whitespace/formatting
            $decoded = json_decode($value, true);
            $this->attributes['coordinates'] = json_encode($decoded);
        } else {
            $this->attributes['coordinates'] = json_encode($value);
        }
    }
}
