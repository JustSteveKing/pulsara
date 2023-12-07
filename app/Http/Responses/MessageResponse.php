<?php

declare(strict_types=1);

namespace App\Http\Responses;

use App\Http\Factories\HeaderFactory;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use JustSteveKing\Tools\Http\Enums\Status;

final readonly class MessageResponse implements Responsable
{
    public function __construct(
        private array|string $data,
        private Status $status = Status::OK,
        private string $key = 'message',
    ) {
    }

    public function toResponse($request): JsonResponse
    {
        return new JsonResponse(
            data: [
                $this->key => $this->data,
            ],
            status: $this->status->value,
            headers: HeaderFactory::default(),
        );
    }
}
