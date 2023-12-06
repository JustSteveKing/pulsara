<?php

declare(strict_types=1);

namespace App\Http\Controllers\OAuth\GitHub;

use App\Enums\Identity\Provider;
use App\Services\IdentityService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Laravel\Socialite\SocialiteManager;

final readonly class CallbackController
{
    public function __construct(
        private SocialiteManager $manager,
        private IdentityService $service,
    ) {
    }

    public function __invoke(Request $request): RedirectResponse
    {
        $this->service->handleOauth(
            payload: $this->manager->driver(
                driver: 'github',
            )->user(),
            provider: Provider::GitHub,
        );

        return new RedirectResponse(
            url: '/',
        );
    }
}
