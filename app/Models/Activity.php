<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @OA\Schema(
 *     schema="Activity",
 *     type="object",
 *     title="Activity",
 *     description="Activity resource",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Tech Workshop"),
 *     @OA\Property(property="short_description", type="string", example="Short summary here..."),
 *     @OA\Property(property="description", type="string", example="Full activity description."),
 *     @OA\Property(property="registration_url", type="string", format="uri", example="https://example.com/register"),
 *     @OA\Property(property="location", type="string", example="Berlin, Germany"),
 *     @OA\Property(property="coordinates", type="object", example={"lat": 52.52, "lng": 13.405}),
 *     @OA\Property(property="dates", type="array", @OA\Items(type="string", format="date"), example={"2025-09-01", "2025-09-03"}),
 *     @OA\Property(property="media", type="array", @OA\Items(type="string", format="uri"), example={"uploads/images/1.jpg", "uploads/images/2.jpg"}),
 *     @OA\Property(property="participant", ref="#/components/schemas/Participant"),
 *     @OA\Property(property="activity_type", ref="#/components/schemas/ActivityType"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-08-08T12:00:00Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-08-08T12:10:00Z")
 * )
 */
class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'source_id',
        'media',
        'short_description',
        'registration_url',
        'location',
        'coordinates',
        'dates',
        'activity_type_id',
    ];

    protected $casts = [
        'media' => 'array',
        'coordinates' => 'array',
        'dates' => 'array',
    ];

    public function activityType(): BelongsTo
    {
        return $this->belongsTo(ActivityType::class);
    }

    public function participant(): BelongsTo
    {
        return $this->belongsTo(Participant::class, 'source_id');
    }

    public function setCoordinatesAttribute($value): void
    {
        if (is_string($value)) {
            $decoded = json_decode($value, true);
            $this->attributes['coordinates'] = json_encode($decoded);
        } else {
            $this->attributes['coordinates'] = json_encode($value);
        }
    }

    public function setDatesAttribute($value): void
    {
        if (is_string($value)) {
            $decoded = json_decode($value, true);
            $this->attributes['dates'] = json_encode($decoded);
        } else {
            $this->attributes['dates'] = json_encode($value);
        }
    }

    public function likedByUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'activity_user');
    }
}
