<?php

declare(strict_types=1);

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

final class Handler extends ExceptionHandler
{
    /**
     * @var array<int,string>
     */
    protected $dontFlash = [];

    public function register(): void
    {
        $this->reportable(function (Throwable $e): void {});
    }
}
