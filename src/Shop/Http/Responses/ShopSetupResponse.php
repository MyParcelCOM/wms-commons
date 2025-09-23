<?php

declare(strict_types=1);

namespace MyParcelCom\Wms\Shop\Http\Responses;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;

class ShopSetupResponse implements Responsable
{
    /**
     * @param string|null $authorizationUrl  URL to external authorization service.
     * @param bool        $showConfiguration Instruction to the client of the response to display configuration form
     */
    public function __construct(
        private readonly ?string $authorizationUrl = null,
        private readonly bool $showConfiguration = false,
    ) {
    }

    public function toResponse($request): JsonResponse
    {
        $responseData = [
            'show_configuration' => $this->showConfiguration,
        ];

        if ($this->authorizationUrl) {
            $responseData['authorization_url'] = $this->authorizationUrl;
        }

        return new JsonResponse(['data' => $responseData]);
    }
}
