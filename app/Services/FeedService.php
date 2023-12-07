<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Post;
use App\Services\Concerns\HasAuthAndDatabase;
use Illuminate\Database\Eloquent\Builder;

final class FeedService
{
    use HasAuthAndDatabase;

    public function main(): Builder
    {
        return Post::query()->with([
            'profile.user',
            'group',
        ])->approved()->whereHas(
            'group',
            fn (Builder $builder) => $builder->verified(),
        )->latest();
    }
}
