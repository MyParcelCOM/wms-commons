<?php

declare(strict_types=1);

namespace MyParcelCom\Wms\Returns\Domain\Items;

use Illuminate\Support\Collection;

/** @extends Collection<int, ReturnItem> */
class ReturnItemCollection extends Collection
{
    public function __construct(ReturnItem ...$items)
    {
        parent::__construct($items);
    }
}
