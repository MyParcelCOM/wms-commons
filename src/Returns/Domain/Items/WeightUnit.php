<?php

declare(strict_types=1);

namespace MyParcelCom\Wms\Returns\Domain\Items;

enum WeightUnit: string
{
    case MILLIGRAM = 'mg';
    case GRAM = 'g';
    case KILOGRAM = 'kg';
    case OUNCE = 'oz';
    case POUND = 'lb';
}
