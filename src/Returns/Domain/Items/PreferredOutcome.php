<?php

declare(strict_types=1);

namespace MyParcelCom\Wms\Returns\Domain\Items;

enum PreferredOutcome: string
{
    case EXCHANGE = 'exchange';
    case REFUND = 'refund';
}
