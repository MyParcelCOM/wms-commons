<?php

declare(strict_types=1);

namespace Tests\Returns\Domain\Items;

use Faker\Factory;
use MyParcelCom\Wms\Returns\Domain\Items\PreferredOutcome;
use MyParcelCom\Wms\Returns\Domain\Items\ReturnItem;
use MyParcelCom\Wms\Returns\Domain\Items\ReturnItemCollection;
use MyParcelCom\Wms\Returns\Domain\Items\WeightUnit;
use MyParcelCom\Wms\Returns\Domain\Payment\Currency;
use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertCount;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertInstanceOf;

class ReturnItemCollectionTest extends TestCase
{
    public function test_it_can_create_a_collection_of_return_items(): void
    {
        $faker = Factory::create();

        $stub1 = [
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
            'return_reason'      => $faker->sentence(),
            'image_url'          => $faker->url(),
            'preferred_outcome'  => $faker->randomElement(PreferredOutcome::cases())->value,
        ];

        $stub2 = [
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
            'return_reason'      => $faker->sentence(),
            'image_url'          => $faker->url(),
            'preferred_outcome'  => $faker->randomElement(PreferredOutcome::cases())->value,
        ];

        $item1 = ReturnItem::from($stub1);;
        $item2 = ReturnItem::from($stub2);

        $collection = new ReturnItemCollection($item1, $item2);

        assertCount(2, $collection);

        assertInstanceOf(ReturnItem::class, $collection[0]);
        assertInstanceOf(ReturnItem::class, $collection[1]);

        assertEquals($item1, $collection[0]);
        assertEquals($item2, $collection[1]);
    }
}
