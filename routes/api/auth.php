<?php

declare(strict_types=1);

use App\Http\Controllers\Api\Auth;
use Illuminate\Support\Facades\Route;

Route::post('login', Auth\LoginController::class)->name('login');
