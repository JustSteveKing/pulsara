<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use App\Services\Concerns\HasAuthAndDatabase;
use Illuminate\Database\Eloquent\Model;

final readonly class ProfileService
{
    use HasAuthAndDatabase;

    public function mine(): User|Model
    {
        return User::query()->with(['profile'])->findOrFail(
            id: $this->auth->id(),
        );
    }
}
