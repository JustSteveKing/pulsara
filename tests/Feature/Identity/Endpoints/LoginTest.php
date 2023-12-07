<?php

declare(strict_types=1);

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Middleware\DeviceIdentifier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Testing\Fluent\AssertableJson;
use JustSteveKing\Tools\Http\Enums\Status;
use Laravel\Sanctum\PersonalAccessToken;
use function Pest\Laravel\postJson;

test('the device identifier middleware works', function (): void {
    $middleware = new DeviceIdentifier();

    $response = $middleware->handle(
        request: Request::create(
            uri: '/',
        ),
        next: fn (Request $request) => new Response(),
    );
    expect(
        $response->headers->get('X-DEVICE-ID'),
    )->not->toBeNull();
});

test('the login validation works', function (): void {
    postJson(
        uri: action(LoginController::class),
    )->assertStatus(
        status: Status::UNPROCESSABLE_CONTENT->value,
    )->assertJsonValidationErrorFor(
        key: 'email',
    )->assertJsonValidationErrorFor(
        key: 'password',
    );
});

test('the login validation works for email', function (): void {
    postJson(
        uri: action(LoginController::class),
        data: [
            'password' => 'password',
        ]
    )->assertStatus(
        status: Status::UNPROCESSABLE_CONTENT->value,
    )->assertJsonValidationErrorFor(
        key: 'email',
    );
});

test('the login validation works for password', function (): void {
    postJson(
        uri: action(LoginController::class),
        data: [
            'email' => 'test@email.com',
        ]
    )->assertStatus(
        status: Status::UNPROCESSABLE_CONTENT->value,
    )->assertJsonValidationErrorFor(
        key: 'password',
    );
});

test('the authentication logic will complain if credentials are invalid', function (): void {
    postJson(
        uri: action(LoginController::class),
        data: [
            'email' => 'test@user.com',
            'password' => 'password',
        ]
    )->assertStatus(
        status: Status::UNPROCESSABLE_CONTENT->value,
    )->assertJsonValidationErrorFor(
        key: 'email',
    );
});

test('the endpoint will return a token if authentication passes', function (): void {
    $user = User::factory()->create();

    postJson(
        uri: action(LoginController::class),
        data: [
            'email' => $user->email,
            'password' => 'password',
        ]
    )->assertStatus(
        status: Status::OK->value,
    )->assertJson(fn (AssertableJson $json) => $json
        ->has('token')->etc()
    );

    expect(
        PersonalAccessToken::query()->count(),
    )->toEqual(1);
});
