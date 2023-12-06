<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\Identity\Provider;
use App\Http\Payloads\Auth\LoginPayload;
use App\Http\Payloads\Auth\RegisterPayload;
use App\Models\User;
use Illuminate\Auth\AuthManager;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Str;
use Laravel\Socialite\Contracts\User as SocialiteUser;
use Laravel\Socialite\Two\User as OAuthUser;
use Throwable;

final readonly class IdentityService
{
    /**
     * @param AuthManager $auth
     * @param DatabaseManager $database
     */
    public function __construct(
        private AuthManager $auth,
        private DatabaseManager $database,
    ) {
    }

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
}
