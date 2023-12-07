<?php

declare(strict_types=1);

use App\Http\Controllers\Api\Profiles;
use Illuminate\Support\Facades\Route;

Route::get('/', Profiles\IndexController::class)->name('my-profile');

