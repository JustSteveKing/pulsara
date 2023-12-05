<?php

declare(strict_types=1);

use App\Http\Payloads\Auth\LoginPayload;
use App\Services\IdentityService;

test('the identity service can be resolved', function (): void {
    expect(
        app()->make(
            abstract: IdentityService::class,
        ),
    )->toBeInstanceOf(IdentityService::class);
});

test('the login method will return false if authentication fails', function (): void {
    /** @var IdentityService $service */
    $service = app()->make(
        abstract: IdentityService::class,
    );

    expect(
        $service->login(
            payload: new LoginPayload(
                email: 'test@email.com',
                password: 'password',
            ),
        ),
    )->toBeFalse();
});

test('the login method will return true if authentication passes', function (): void {
    \App\Models\User::factory()->create([
        'email' => 'user@email.com',
    ]);

    /** @var IdentityService $service */
    $service = app()->make(
        abstract: IdentityService::class,
    );

    expect(
        $service->login(
            payload: new LoginPayload(
                email: 'user@email.com',
                password: 'password',
            ),
        ),
    )->toBeTrue();
});
