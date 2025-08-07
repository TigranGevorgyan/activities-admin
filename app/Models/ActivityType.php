<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @OA\Schema(
 *     schema="ActivityType",
 *     type="object",
 *     title="ActivityType",
 *     description="Activity type",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Hiking"),
 *     @OA\Property(property="icon", type="string", example="uploads/icons/hiking.png"),
 *     @OA\Property(property="order", type="integer", example=1)
 * )
 */
class ActivityType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'icon',
        'order',
    ];

    public function activities(): HasMany
    {
        return $this->hasMany(Activity::class);
    }
}
