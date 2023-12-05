<?php

declare(strict_types=1);

namespace App\Http\Controllers\OAuth\GitHub;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\User;

final class CallbackController
{
    public function __invoke(Request $request)
    {
        /** @var User $user */
        $user = Socialite::driver(
            driver: 'github',
        )->user();

        dd($user);

        // check user account, etc etc
        // redirect
    }
}
