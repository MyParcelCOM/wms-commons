<?php

declare(strict_types=1);

namespace MyParcelCom\Wms\Shop\Http\Responses;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class ShopTearDownResponse implements Responsable
{
    public function toResponse($request): SymfonyResponse
    {
        return new Response('', SymfonyResponse::HTTP_NO_CONTENT);
    }
}
