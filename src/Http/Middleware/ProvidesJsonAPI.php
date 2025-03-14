<?php

declare(strict_types=1);

namespace MyParcelCom\Wms\Http\Middleware;

use JsonSerializable;

interface ProvidesJsonAPI extends JsonSerializable
{
    public function transformToJsonApiArray(): array;
}
