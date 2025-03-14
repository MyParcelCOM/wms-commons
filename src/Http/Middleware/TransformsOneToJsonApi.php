<?php

declare(strict_types=1);

namespace MyParcelCom\Wms\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;

class TransformsOneToJsonApi
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if (!$response instanceof JsonResponse) {
            return $response;
        }

        $originalControllerResponse = $response->getOriginalContent();

        if (empty($originalControllerResponse)) {
            return new JsonResponse(['data' => []]);
        }

        if (!$originalControllerResponse instanceof ProvidesJsonAPI) {
            return $response;
        }

        return new JsonResponse([
            'data' => $originalControllerResponse->transformToJsonApiArray(),
        ]);
    }
}
