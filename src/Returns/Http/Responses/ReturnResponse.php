<?php

declare(strict_types=1);

namespace MyParcelCom\Wms\Returns\Http\Responses;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
class ReturnResponse implements Responsable
{
    /**
     * @param string $wmsReturnId The unique identifier assigned to the return by the Warehouse Management System (WMS).
     */
    public function __construct(
        private readonly string $wmsReturnId
    ) {
    }

    public function toResponse($request): JsonResponse
    {
        return new JsonResponse([
           'data' => [
               'wms_return_id' => $this->wmsReturnId,
           ]
        ]);
    }
}
