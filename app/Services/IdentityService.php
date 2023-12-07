<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\Identity\Provider;
use App\Http\Payloads\Auth\LoginPayload;
use App\Http\Payloads\Auth\RegisterPayload;
use App\Models\User;
use App\Services\Concerns\HasAuthAndDatabase;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Str;
use Laravel\Sanctum\NewAccessToken;
use Laravel\Socialite\Contracts\User as SocialiteUser;
use Laravel\Socialite\Two\User as OAuthUser;
use Throwable;

final readonly class IdentityService
{
    use HasAuthAndDatabase;

    /**
     * @param LoginPayload $payload
     * @return bool
     */
    public function login(LoginPayload $payload): bool
    {
        return $this->auth->attempt(
            credentials: $payload->toArray(),
        );
    }

    public function getAuthenticatedUser(): User|null|Authenticatable
    {
        return $this->auth->user();
    }

    /**
     * @param RegisterPayload $payload
     * @return User
     * @throws Throwable
     */
    public function register(RegisterPayload $payload): User
    {
        return $this->database->transaction(
            callback: fn () => User::query()->create(
                attributes: $payload->toArray(),
            ),
            attempts: 3,
        );
    }

    public function handleOauth(OAuthUser|SocialiteUser $payload, Provider $provider): void
    {
        $user = $this->database->transaction(
            callback: fn () => User::query()->firstOrCreate(
                attributes: [
                    'email' => $payload->getEmail(),
                    'provider' => $provider,
                    'provider_id' => $payload->getId(),
                ],
                values: [
                    'first_name' => Str::of((string) $payload->getName())->beforeLast(' ')->toString(),
                    'last_name' => Str::of((string) $payload->getName())->afterLast(' ')->toString(),
                    'avatar' => $payload->getAvatar(),
                    'access_token' => $payload?->token,
                    'email_verified_at' => now(),
                ]
            )
        );

        $this->auth->loginUsingId(
            id: $user->getKey(),
        );
    }

    /**
     * @param Authenticatable|User $user
     * @param string $name
     * @param array<int,string> $permissions
     * @return NewAccessToken
     */
    public function createToken(Authenticatable|User $user, string $name, array $permissions = ['*']): NewAccessToken
    {
        return $user?->createToken(
            name: $name,
            abilities: $permissions,
        );
    }
}
