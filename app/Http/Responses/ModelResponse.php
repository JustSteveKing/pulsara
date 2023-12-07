<?php

declare(strict_types=1);

namespace App\Http\Responses;

use App\Http\Factories\HeaderFactory;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use JustSteveKing\Tools\Http\Enums\Status;

final readonly class ModelResponse implements Responsable
{
    public function __construct(
        private JsonResource $data,
        private string $key,
        private array $meta = [],
        private array $links = [],
        private Status $status = Status::OK,
    ) {
    }

    public function toResponse($request): JsonResponse
    {
        return new JsonResponse(
            data: [
                $this->key => $this->data,
                'meta' => $this->meta,
                'links' => $this->links,
            ],
            status: $this->status->value,
            headers: HeaderFactory::default(),
        );
    }
}
