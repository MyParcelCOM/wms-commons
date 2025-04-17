<?php

declare(strict_types=1);

namespace MyParcelCom\Wms\Returns\Domain\Items;

use MyParcelCom\Wms\Returns\Domain\Payment\Currency;

/**
 * ReturnItem extends the ArrayObject class with getters to make
 *  it convenient to extract data from a return coming in from MyParcel.
 */
readonly class ReturnItem
{
    public function __construct(
        public string $externalReference,
        public string $sku,
        public string $name,
        public int $quantity,
        public int $priceAmount,
        public Currency $currency,
        public string $description,
        public ?int $weight = null,
        public ?WeightUnit $weightUnit = null,
        public ?string $comment = null,
        public ?string $returnReason = null,
    ) {
    }

    public static function fromSnakeCaseArray(array $requestArray): self
    {
        return new self(
            externalReference: $requestArray['external_reference'],
            sku: $requestArray['sku'],
            name: $requestArray['name'],
            quantity: $requestArray['quantity'],
            priceAmount: $requestArray['price_amount'],
            currency: Currency::from($requestArray['currency']),
            description: $requestArray['description'],
            weight: $requestArray['weight'] ?? null,
            weightUnit: isset($requestArray['weight_unit']) ? WeightUnit::from($requestArray['weight_unit']) : null,
            comment: $requestArray['comment'] ?? null,
            returnReason: $requestArray['return_reason'] ?? null,
        );
    }
}
