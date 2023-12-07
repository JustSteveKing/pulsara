<?php

declare(strict_types=1);

use App\Http\Controllers\Api\Feeds;
use Illuminate\Support\Facades\Route;

Route::middleware([
    'cache.headers:public;max_age=2628000;etag'
])->get('/', Feeds\IndexController::class)->name('index');
