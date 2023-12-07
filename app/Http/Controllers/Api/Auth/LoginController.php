<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Auth;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Responses\MessageResponse;
use App\Services\IdentityService;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Validation\ValidationException;

final readonly class LoginController
{
    public function __construct(
        private IdentityService $service,
    ) {}

    public function __invoke(LoginRequest $request): Responsable
    {
        if (! $this->service->login(payload: $request->payload())) {
            throw ValidationException::withMessages(
                messages: [
                    'email' => 'Invalid credentials.',
                ]
            );
        }

        $token = $this->service->createToken(
            user: $this->service->getAuthenticatedUser(),
            name: $request->header(
                key: 'X-DEVICE-ID',
            ),
        );

        return new MessageResponse(
            data: $token->plainTextToken,
            key: 'token',
        );
    }
}
