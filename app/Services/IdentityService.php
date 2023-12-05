<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Payloads\Auth\LoginPayload;
use App\Http\Payloads\Auth\RegisterPayload;
use App\Models\User;
use Illuminate\Auth\AuthManager;
use Illuminate\Database\DatabaseManager;
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
    ) {}

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
}
