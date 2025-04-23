<?php

declare(strict_types=1);

namespace Tests\Returns\Domain\Payment;

use Faker\Factory;
use MyParcelCom\Wms\Returns\Domain\Payment\Currency;
use MyParcelCom\Wms\Returns\Domain\Payment\ReturnPayment;
use PHPUnit\Framework\TestCase;

class ReturnPaymentTest extends TestCase
{
    public function test_it_can_be_created_from_snake_case_array(): void
    {
        $faker = Factory::create();
        $stub = [
            'external_payment_id' => $faker->uuid(),
            'amount'              => $faker->randomNumber(),
            'currency'            => $faker->randomElement(Currency::cases())->value,
        ];

        $payment = ReturnPayment::from($stub);

        $this->assertEquals($payment->externalPaymentId, $stub['external_payment_id']);
        $this->assertEquals($payment->amount, $stub['amount']);
        $this->assertEquals($payment->currency->value, $stub['currency']);
    }
}
