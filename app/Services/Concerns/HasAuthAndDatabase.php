<?php

declare(strict_types=1);

namespace App\Services\Concerns;

use Illuminate\Auth\AuthManager;
use Illuminate\Database\DatabaseManager;

trait HasAuthAndDatabase
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
}
