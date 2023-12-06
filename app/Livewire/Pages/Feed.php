<?php

declare(strict_types=1);

namespace App\Livewire\Pages;

use App\Enums\Publishing\Stage;
use App\Enums\Publishing\Status;
use App\Models\Group;
use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\Factory;
use Livewire\Component;
use Livewire\WithPagination;

final class Feed extends Component
{
    use WithPagination;

    public function render(Factory $factory): View
    {
        return $factory->make(
            view: 'livewire.pages.feed',
            data: [
                'posts' => Post::query()->with([
                    'profile.user'
                ])->approved()->whereHas(
                    'group',
                    fn (Builder $builder) => $builder->verified(),
                )->latest()->paginate(),
            ],
        );
    }
}
