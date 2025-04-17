<?php

declare(strict_types=1);

namespace Tests\Returns\Http\Requests;

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Support\Arr;
use MyParcelCom\Wms\Returns\Domain\Address\Address;
use MyParcelCom\Wms\Returns\Domain\Items\ReturnItem;
use MyParcelCom\Wms\Returns\Domain\Payment\ReturnPayment;
use MyParcelCom\Wms\Returns\Http\Requests\ReturnRequest;
use PHPUnit\Framework\TestCase;

class ReturnRequestTest extends TestCase
{
    public function test_it_parses_incoming_data_correctly(): void
    {
        $faker = Factory::create();
        $stub = [
            'data' => [
                'order_reference'  => $faker->uuid(),
                'created_at'       => $faker->unixTime(),
                'consumer_address' => [
                    "street_1" => $faker->streetName(),
                    "street_2" => null,
                    "street_number" => $faker->randomNumber(),
                    "street_number_suffix" => $faker->word(),
                    "postal_code" => $faker->postcode(),
                    "city" => $faker->city(),
                    "state_code" => $faker->countryCode(),
                    "country_code" => $faker->countryCode(),
                    "company" => $faker->company(),
                    "first_name" => $faker->firstName(),
                    "last_name" => $faker->lastName(),
                    "email" => $faker->email(),
                    "phone_number" => $faker->phoneNumber(),
                ],
                'return_address'   => [
                    "street_1" => $faker->streetName(),
                    "street_2" => $faker->streetName(),
                    "street_number" => $faker->randomNumber(),
                    "street_number_suffix" => $faker->word(),
                    "postal_code" => $faker->postcode(),
                    "city" => $faker->city(),
                    "state_code" => $faker->countryCode(),
                    "country_code" => $faker->countryCode(),
                    "company" => $faker->company(),
                    "first_name" => $faker->firstName(),
                    "last_name" => $faker->lastName(),
                    "email" => $faker->email(),
                    "phone_number" => $faker->phoneNumber(),
                ],
                'payment'          => [
                    'external_payment_id' => 'payment-12345',
                    'amount'              => 1000,
                    'currency'            => 'USD',
                ],
                'items'            => [
                    [
                        'external_reference' => 'ref-item-1',
                        'sku'                => 'sku-123',
                        'name'               => 'Sample Item 1',
                        'quantity'           => 2,
                        'price_amount'       => 500,
                        'currency'           => 'USD',
                        'weight'             => 10,
                        'weight_unit'        => 'kg',
                        'comment'            => 'No issues',
                        'return_reason'      => 'damaged',
                        'description'        => 'A sample item description',
                    ],
                    [
                        'external_reference' => 'ref-item-2',
                        'sku'                => 'sku-456',
                        'name'               => 'Sample Item 2',
                        'quantity'           => 1,
                        'price_amount'       => 300,
                        'currency'           => 'USD',
                        'weight'             => 20,
                        'weight_unit'        => 'kg',
                        'comment'            => 'Wrong size',
                        'return_reason'      => 'wrong_size',
                        'description'        => 'Another sample item description',
                    ],
                ]
            ]
        ];

        $request = new ReturnRequest();
        $request->replace($stub);

        $this->assertEquals($request->orderReference(), Arr::get($stub, 'data.order_reference'));
        $this->assertEquals($request->createdAt(), Carbon::createFromTimestamp(Arr::get($stub, 'data.created_at')));
        $this->assertAddressMatchesStubArray($request->consumerAddress(), Arr::get($stub, 'data.consumer_address'));
        $this->assertAddressMatchesStubArray($request->returnAddress(), Arr::get($stub, 'data.return_address'));
        $this->assertPaymentMatchesStubArray($request->payment(), Arr::get($stub, 'data.payment'));
        $this->assertItemMatchesStubArray($request->items()[0], Arr::get($stub, 'data.items.0'));
        $this->assertItemMatchesStubArray($request->items()[1], Arr::get($stub, 'data.items.1'));
    }

    private function assertAddressMatchesStubArray(Address $address, array $stub): void
    {
        $this->assertEquals($address->street1, $stub['street_1']);
        $this->assertEquals($address->street2, $stub['street_2']);
        $this->assertEquals($address->streetNumber, $stub['street_number']);
        $this->assertEquals($address->streetNumberSuffix, $stub['street_number_suffix']);
        $this->assertEquals($address->postalCode, $stub['postal_code']);
        $this->assertEquals($address->city, $stub['city']);
        $this->assertEquals($address->stateCode, $stub['state_code']);
        $this->assertEquals($address->countryCode, $stub['country_code']);
        $this->assertEquals($address->company, $stub['company']);
        $this->assertEquals($address->firstName, $stub['first_name']);
        $this->assertEquals($address->lastName, $stub['last_name']);
        $this->assertEquals($address->email, $stub['email']);
        $this->assertEquals($address->phoneNumber, $stub['phone_number']);
    }

    private function assertPaymentMatchesStubArray(ReturnPayment $payment, array $stub): void
    {
        $this->assertEquals($payment->externalPaymentId, $stub['external_payment_id']);
        $this->assertEquals($payment->amount, $stub['amount']);
        $this->assertEquals($payment->currency->value, $stub['currency']);
    }

    private function assertItemMatchesStubArray(ReturnItem $item, array $stub): void
    {
        $this->assertEquals($item->externalReference, $stub['external_reference']);
        $this->assertEquals($item->sku, $stub['sku']);
        $this->assertEquals($item->name, $stub['name']);
        $this->assertEquals($item->quantity, $stub['quantity']);
        $this->assertEquals($item->priceAmount, $stub['price_amount']);
        $this->assertEquals($item->currency->value, $stub['currency']);
        $this->assertEquals($item->weight, $stub['weight']);
        $this->assertEquals($item->weightUnit->value, $stub['weight_unit']);
        $this->assertEquals($item->comment, $stub['comment']);
        $this->assertEquals($item->returnReason, $stub['return_reason']);
        $this->assertEquals($item->description, $stub['description']);
    }

}
