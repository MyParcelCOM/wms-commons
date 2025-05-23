<?php

declare(strict_types=1);

namespace Tests\Returns\Domain\Items;

use Faker\Factory;
use MyParcelCom\Wms\Returns\Domain\Items\PreferredOutcome;
use MyParcelCom\Wms\Returns\Domain\Items\ReturnItem;
use MyParcelCom\Wms\Returns\Domain\Items\WeightUnit;
use MyParcelCom\Wms\Returns\Domain\Payment\Currency;
use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertEquals;

class ReturnItemTest extends TestCase
{

    public function test_it_can_be_created_from_snake_case_array(): void
    {
        $faker = Factory::create();
        $stub = [
            'external_reference'      => $faker->word(),
            'sku'                     => $faker->word(),
            'name'                    => $faker->name(),
            'quantity'                => $faker->randomNumber(),
            'price_amount'            => $faker->randomNumber(),
            'currency'                => $faker->randomElement(Currency::cases())->value,
            'weight'                  => $faker->randomNumber(),
            'weight_unit'             => $faker->randomElement(WeightUnit::cases())->value,
            'comment'                 => $faker->sentence(),
            'description'             => $faker->sentence(),
            'return_reason'           => $faker->sentence(),
            'image_url'               => $faker->url(),
            'preferred_outcome'       => $faker->randomElement(PreferredOutcome::cases())->value,
            'return_question_answers' => [
                [
                    'code'        => 'myparcelcom:question-1',
                    'answer'      => 'This is the solution',
                    'description' => 'This is the description',
                ],
                [
                    'code'        => 'myparcelcom:question-2',
                    'answer'      => 'Yet another solution',
                    'description' => 'Yet another description',
                ],
            ],
        ];

        $returnItem = ReturnItem::from($stub);

        assertEquals($stub['external_reference'], $returnItem->externalReference);
        assertEquals($stub['sku'], $returnItem->sku);
        assertEquals($stub['name'], $returnItem->name);
        assertEquals($stub['quantity'], $returnItem->quantity);
        assertEquals($stub['price_amount'], $returnItem->priceAmount);
        assertEquals(Currency::from($stub['currency']), $returnItem->currency);
        assertEquals($stub['weight'], $returnItem->weight);
        assertEquals(WeightUnit::from($stub['weight_unit']), $returnItem->weightUnit);
        assertEquals($stub['comment'], $returnItem->comment);
        assertEquals($stub['description'], $returnItem->description);
        assertEquals($stub['return_reason'], $returnItem->returnReason);
        assertEquals($stub['image_url'], $returnItem->imageUrl);
        assertEquals(PreferredOutcome::from($stub['preferred_outcome']), $returnItem->preferredOutcome);
        assertEquals($stub['return_question_answers'][0]['code'], $returnItem->questionAnswers[0]->code);
        assertEquals($stub['return_question_answers'][0]['answer'], $returnItem->questionAnswers[0]->answer);
        assertEquals(
            $stub['return_question_answers'][0]['description'],
            $returnItem->questionAnswers[0]->description,
        );
        assertEquals($stub['return_question_answers'][1]['code'], $returnItem->questionAnswers[1]->code);
        assertEquals($stub['return_question_answers'][1]['answer'], $returnItem->questionAnswers[1]->answer);
        assertEquals(
            $stub['return_question_answers'][1]['description'],
            $returnItem->questionAnswers[1]->description,
        );
    }
}
