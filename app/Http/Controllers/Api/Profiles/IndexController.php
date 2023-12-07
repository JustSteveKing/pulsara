<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Profiles;

use App\Http\Resources\ProfileResource;
use App\Http\Responses\ModelResponse;
use App\Services\ProfileService;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;

final readonly class IndexController
{
    public function __construct(
        private ProfileService $service,
    ) {
    }

    public function __invoke(Request $request): Responsable
    {
        $user = $this->service->mine();

        return new ModelResponse(
            data: new ProfileResource(
                resource: $user,
            ),
            key: 'profile',
            meta: [
                'request-id' => $request->fingerprint(),
            ],
            links: [
                '__self' => \route('profiles:my-profile'),
            ],
        );
    }
}
