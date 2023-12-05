<?php

declare(strict_types=1);

namespace App\Http\Controllers\OAuth\GitHub;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\RedirectResponse;

final class RedirectController
{
    public function __invoke(Request $request): RedirectResponse
    {
        return Socialite::driver(
            driver: 'github',
        )->redirect();
    }
}
