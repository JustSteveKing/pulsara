<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

// Authenticate
Route::middleware([])->prefix('auth')->as('auth:')->group(
    base_path('routes/api/auth.php'),
);

// Get my profile
// Update my profile
Route::middleware(['auth:sanctum'])->prefix('profiles')->as('profiles:')->group(
    base_path('routes/api/profiles.php'),
);


// Group endpoints
Route::middleware([])->prefix('feeds')->as('feeds:')->group(
    base_path('routes/api/feeds.php'),
);


// Posting
