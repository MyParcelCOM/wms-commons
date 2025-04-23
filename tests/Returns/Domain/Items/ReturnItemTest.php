<?php

declare(strict_types=1);

namespace Tests\Returns\Domain\Items;

use Faker\Factory;
use MyParcelCom\Wms\Returns\Domain\Items\ReturnItem;
use MyParcelCom\Wms\Returns\Domain\Items\WeightUnit;
use MyParcelCom\Wms\Returns\Domain\Payment\Currency;
use PHPUnit\Framework\TestCase;

class ReturnItemTest extends TestCase
{

    public function test_it_can_be_created_from_snake_case_array(): void
    {
        $faker = Factory::create();
        $stub = [
            'external_reference' => $faker->word(),
            'sku'                => $faker->word(),
            'name'               => $faker->name(),
            'quantity'           => $faker->randomNumber(),
            'price_amount'       => $faker->randomNumber(),
            'currency'           => $faker->randomElement(Currency::cases())->value,
            'weight'             => $faker->randomNumber(),
            'weight_unit'        => $faker->randomElement(WeightUnit::cases())->value,
            'comment'            => $faker->sentence(),
            'description'        => $faker->sentence(),
        ];

        $returnItem = ReturnItem::from($stub);

        $this->assertEquals($returnItem->externalReference, $stub['external_reference']);
        $this->assertEquals($returnItem->sku, $stub['sku']);
        $this->assertEquals($returnItem->name, $stub['name']);
        $this->assertEquals($returnItem->quantity, $stub['quantity']);
        $this->assertEquals($returnItem->priceAmount, $stub['price_amount']);
        $this->assertEquals($returnItem->currency->value, $stub['currency']);
        $this->assertEquals($returnItem->weight, $stub['weight']);
        $this->assertEquals($returnItem->weightUnit->value, $stub['weight_unit']);
        $this->assertEquals($returnItem->comment, $stub['comment']);
        $this->assertEquals($returnItem->description, $stub['description']);

    }
}
