<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read User $resource
 */
final class ProfileResource extends JsonResource
{
    /**
     * @return array<string,mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'name' => [
                'first' => $this->resource->first_name,
                'last' => $this->resource->last_name,
                'full' => $this->resource->name,
            ],
            'handle' => $this->resource->profile->handle,
            'email' => [
                'address' => $this->resource->email,
                'verified' => null !== $this->resource->email_verified_at
            ],
            'country' => $this->resource->profile->country,
            'provider' => $this->resource->provider,

            'role' => $this->resource->role,
            'images' => [
                'avatar' => $this->resource->avatar,
                'cover' => $this->resource->profile->cover,
            ]
        ];
    }
}
