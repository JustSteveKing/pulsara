<?php

declare(strict_types=1);

namespace App\Http\Controllers\OAuth\GitHub;

use Illuminate\Http\Request;
use Laravel\Socialite\SocialiteManager;
use Symfony\Component\HttpFoundation\RedirectResponse;

final readonly class RedirectController
{
    public function __construct(
        private SocialiteManager $manager,
    ) {}

    public function __invoke(Request $request): RedirectResponse
    {
        return $this->manager->driver(
            driver: 'github',
        )->redirect();
    }
}
