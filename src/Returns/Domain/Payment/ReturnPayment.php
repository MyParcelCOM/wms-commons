<?php

declare(strict_types=1);

namespace MyParcelCom\Wms\Returns\Domain\Payment;

readonly class ReturnPayment
{
    public function __construct(
        public string $externalPaymentId,
        public int $amount,
        public Currency $currency,
    ) {
    }

    public static function fromSnakeCaseArray(array $requestArray): self
    {
        return new self(
            externalPaymentId: $requestArray['external_payment_id'],
            amount: $requestArray['amount'],
            currency: Currency::from($requestArray['currency']),
        );
    }
}
