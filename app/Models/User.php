<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\Identity\Provider;
use App\Enums\Identity\Role;
use Carbon\CarbonInterface;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property string $id
 * @property string $first_name
 * @property null|string $last_name
 * @property string $email
 * @property null|string $password
 * @property Role $role
 * @property Provider $provider
 * @property null|string $provider_id
 * @property null|string $avatar
 * @property null|string $access_token
 * @property null|string $remember_token
 * @property null|CarbonInterface $email_verified_at
 * @property null|CarbonInterface $created_at
 * @property null|CarbonInterface $updated_at
 * @property null|CarbonInterface $deleted_at
 * @property Profile $profile
 * @property Collection<Group> $ownedGroups
 */
final class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasUlids;
    use Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'role',
        'provider',
        'provider_id',
        'avatar',
        'access_token',
        'remember_token',
        'email_verified_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'provider_id',
        'access_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'access_token' => 'encrypted',
        'role' => Role::class,
        'provider' => Provider::class,
    ];

    public function name(): Attribute
    {
        return new Attribute(
            get: fn (): string => "{$this->first_name} {$this->last_name}",
        );
    }

    public function profile(): HasOne
    {
        return $this->hasOne(
            related: Profile::class,
            foreignKey: 'user_id',
        );
    }

    public function ownedGroups(): HasMany
    {
        return $this->hasMany(
            related: Group::class,
            foreignKey: 'user_id',
        );
    }
}
