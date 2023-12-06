<?php

declare(strict_types=1);

use App\Http\Controllers\OAuth;
use Illuminate\Support\Facades\Route;

Route::prefix('github')->as('github:')->group(static function (): void {
    Route::get('redirect', OAuth\GitHub\RedirectController::class)->name('redirect');
    Route::get('callback', OAuth\GitHub\CallbackController::class)->name('callback');
});
