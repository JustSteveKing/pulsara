<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\User;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

final class AuthServiceProvider extends ServiceProvider
{
    /**
     * @var array<class-string,class-string>
     */
    protected $policies = [
        User::class => UserPolicy::class
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
}
