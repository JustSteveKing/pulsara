<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Feeds;

use App\Http\Resources\PostResource;
use App\Http\Responses\CollectionResponse;
use App\Services\FeedService;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

final readonly class IndexController
{
    public function __construct(
        private FeedService $service,
    ) {
    }

    public function __invoke(Request $request): Responsable
    {
        return new CollectionResponse(
            key: 'feeds',
            data: PostResource::collection(
                resource: Cache::rememberForever(
                    key: 'posts-page' . $request->get('page', '1'),
                    callback: fn () => $this->service->main()->paginate(),
                ),
            ),
        );
    }
}
