<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

final class DeviceIdentifier
{
    /**
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->header('X-DEVICE-ID')) {
            $request->headers->set(
                key: 'X-DEVICE-ID',
                values: Str::uuid()->toString(),
            );
        }

        /** @var Response $response */
        $response = $next($request);

        $response->headers->set(
            key: 'X-DEVICE-ID',
            values: $request->header(
                key: 'X-DEVICE-ID',
            ),
        );

        return $response;
    }
}
