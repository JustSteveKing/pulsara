<?php

declare(strict_types=1);

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', \App\Livewire\Pages\Feed::class);

Route::middleware(['guest'])->prefix('oauth')->as('oauth:')->group(
    base_path('routes/web/oauth.php'),
);

Route::get('/dashboard', fn() => view('dashboard'))->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function (): void {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
