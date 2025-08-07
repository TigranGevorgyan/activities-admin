<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

/**
 * @OA\Schema(
 *     schema="User",
 *     type="object",
 *     title="User",
 *     description="User resource with profile and roles",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Tigran Gevorgyan"),
 *     @OA\Property(property="email", type="string", format="email", example="tigran@example.com"),
 *     @OA\Property(property="phone_number", type="string", example="+374XXXXXXXX"),
 *     @OA\Property(property="profile_photo_url", type="string", format="uri", example="https://example.com/photos/1.jpg"),
 *     @OA\Property(
 *         property="roles",
 *         type="array",
 *         @OA\Items(type="string", example="manager")
 *     )
 * )
 */
class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens, HasFactory, HasProfilePhoto, Notifiable, TwoFactorAuthenticatable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number'
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    protected $appends = [
        'profile_photo_url',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function canAccessPanel(Panel $panel): bool
    {
        if ($panel->getId() === 'admin') {
            return $this->hasAnyRole(['super_admin', 'manager', 'viewer']);
        }

        return true;
    }

    public function favoriteActivities(): BelongsToMany
    {
        return $this->belongsToMany(Activity::class, 'activity_user');
    }
}
