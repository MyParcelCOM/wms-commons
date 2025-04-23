<?php

declare(strict_types=1);

namespace Tests\Returns\Http\Requests;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use MyParcelCom\Wms\Returns\Domain\Address\Address;
use MyParcelCom\Wms\Returns\Domain\Items\ReturnItem;
use MyParcelCom\Wms\Returns\Domain\Items\WeightUnit;
use MyParcelCom\Wms\Returns\Domain\Payment\Currency;
use MyParcelCom\Wms\Returns\Domain\Payment\ReturnPayment;
use MyParcelCom\Wms\Returns\Http\Requests\ReturnRequest;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertEquals;


class ReturnRequestTest extends TestCase
{
    public function test_it_parses_incoming_data_correctly(): void
    {
        $timestamp = Carbon::now()->unix();
        $stub = [
            'data' => [
                'order_reference'  => 'ref-order-123',
                'created_at'       => 1745409687,
                'consumer_address' => [
                    "street_1" => 'Bakers Street',
                    "street_2" => null,
                    "street_number" => 123,
                    "street_number_suffix" => 'A',
                    "postal_code" => '1010XS',
                    "city" => 'Amsterdam',
                    "state_code" => 'NH',
                    "country_code" => 'NL',
                    "company" => 'MyParcel',
                    "first_name" => 'Sherlock',
                    "last_name" => 'Holmes',
                    "email" => 'sher.holm@myparcel.com',
                    "phone_number" => '06-35212523',
                ],
                'return_address'   => [
                    "street_1" => 'Cookers Street',
                    "street_2" => 'Cookies Street',
                    "street_number" => 111,
                    "street_number_suffix" => 'BCD',
                    "postal_code" => '9999ZZ',
                    "city" => 'Harlem',
                    "state_code" => 'FR',
                    "country_code" => 'NL',
                    "company" => null,
                    "first_name" => 'John',
                    "last_name" => 'Watson',
                    "email" => 'john-watson@walla.co.il',
                    "phone_number" => '06-12345678',
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
                        'currency'           => 'EUR',
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
                        'currency'           => 'ILS',
                        'weight'             => 20,
                        'weight_unit'        => 'lb',
                        'comment'            => 'This is massive',
                        'return_reason'      => 'wrong_size',
                        'description'        => 'Another sample item description',
                    ],
                ]
            ]
        ];

        $request = new ReturnRequest();
        $request->replace($stub);

        assertEquals('ref-order-123', $request->orderReference());
        assertEquals(Carbon::createFromTimestamp(1745409687), $request->createdAt());

        assertEquals('Bakers Street', $request->consumerAddress()->street1);;
        assertEquals(null, $request->consumerAddress()->street2);
        assertEquals(123, $request->consumerAddress()->streetNumber);;
        assertEquals('A', $request->consumerAddress()->streetNumberSuffix);
        assertEquals('1010XS', $request->consumerAddress()->postalCode);
        assertEquals('Amsterdam', $request->consumerAddress()->city);
        assertEquals('NH', $request->consumerAddress()->stateCode);
        assertEquals('NL', $request->consumerAddress()->countryCode);
        assertEquals('MyParcel', $request->consumerAddress()->company);
        assertEquals('Sherlock', $request->consumerAddress()->firstName);
        assertEquals('Holmes', $request->consumerAddress()->lastName);
        assertEquals('sher.holm@myparcel.com', $request->consumerAddress()->email);
        assertEquals('06-35212523', $request->consumerAddress()->phoneNumber);

        assertEquals('Cookers Street', $request->returnAddress()->street1);;
        assertEquals('Cookies Street', $request->returnAddress()->street2);
        assertEquals(111, $request->returnAddress()->streetNumber);;
        assertEquals('BCD', $request->returnAddress()->streetNumberSuffix);
        assertEquals('9999ZZ', $request->returnAddress()->postalCode);
        assertEquals('Harlem', $request->returnAddress()->city);
        assertEquals('FR', $request->returnAddress()->stateCode);
        assertEquals('NL', $request->returnAddress()->countryCode);
        assertEquals(null, $request->returnAddress()->company);
        assertEquals('John', $request->returnAddress()->firstName);
        assertEquals('Watson', $request->returnAddress()->lastName);
        assertEquals('john-watson@walla.co.il', $request->returnAddress()->email);
        assertEquals('06-12345678', $request->returnAddress()->phoneNumber);

        assertEquals('payment-12345', $request->payment()->externalPaymentId);
        assertEquals(1000, $request->payment()->amount);
        assertEquals(Currency::USD, $request->payment()->currency);

        assertEquals('ref-item-1', $request->items()[0]->externalReference);
        assertEquals('sku-123', $request->items()[0]->sku);
        assertEquals('Sample Item 1', $request->items()[0]->name);
        assertEquals(2, $request->items()[0]->quantity);
        assertEquals(500, $request->items()[0]->priceAmount);
        assertEquals(Currency::EUR, $request->items()[0]->currency);
        assertEquals(10, $request->items()[0]->weight);
        assertEquals(WeightUnit::KILOGRAM, $request->items()[0]->weightUnit);
        assertEquals('No issues', $request->items()[0]->comment);
        assertEquals('damaged', $request->items()[0]->returnReason);
        assertEquals('A sample item description', $request->items()[0]->description);

        assertEquals('ref-item-2', $request->items()[1]->externalReference);
        assertEquals('sku-456', $request->items()[1]->sku);
        assertEquals('Sample Item 2', $request->items()[1]->name);
        assertEquals(1, $request->items()[1]->quantity);
        assertEquals(300, $request->items()[1]->priceAmount);
        assertEquals(Currency::ILS, $request->items()[1]->currency);
        assertEquals(20, $request->items()[1]->weight);
        assertEquals(WeightUnit::POUND, $request->items()[1]->weightUnit);
        assertEquals('This is massive', $request->items()[1]->comment);
        assertEquals('wrong_size', $request->items()[1]->returnReason);
        assertEquals('Another sample item description', $request->items()[1]->description);

    }


    private function assertItemMatchesStubArray(array $stub, ReturnItem $item): void
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
