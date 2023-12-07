<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Enums\Publishing\Stage;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

/**
 * @property-read Post $resource
 */
final class PostResource extends JsonResource
{
    /**
     * @return array<string,mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'content' => Str::of($this->resource->content)->limit(200)->toString(),
            'published' => [
                'state' => Stage::Approved === $this->resource->stage,
                'timestamp' => $this->resource->published_at?->timestamp,
            ],
            'handle' => $this->resource->profile->handle,
            'group' => [
                'id' => $this->resource->group->id,
                'name' => $this->resource->group->name,
                'images' => [
                    'avatar' => $this->resource->group->avatar,
                    'cover' => $this->resource->group->cover,
                ]
            ]
        ];
    }
}
