<?php

declare(strict_types=1);

namespace Tests\Returns\Domain\Items;

use Faker\Factory;
use MyParcelCom\Wms\Returns\Domain\Items\PreferredOutcome;
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
            'return_reason'      => $faker->sentence(),
            'image_url'          => $faker->url(),
            'preferred_outcome'  => $faker->randomElement(PreferredOutcome::cases())->value,
            'return_question_answers' => [
                [
                    'code' => 'myparcelcom:question-1',
                    'answer'      => 'This is the solution',
                    'description' => 'This is the description',
                ],
                [
                    'code' => 'myparcelcom:question-2',
                    'answer'      => 'Yet another solution',
                    'description' => 'Yet another description',
                ],
            ],
        ];

        $returnItem = ReturnItem::from($stub);

        $this->assertEquals($returnItem->externalReference, $stub['external_reference']);
        $this->assertEquals($returnItem->sku, $stub['sku']);
        $this->assertEquals($returnItem->name, $stub['name']);
        $this->assertEquals($returnItem->quantity, $stub['quantity']);
        $this->assertEquals($returnItem->priceAmount, $stub['price_amount']);
        $this->assertEquals($returnItem->currency, Currency::from($stub['currency']));
        $this->assertEquals($returnItem->weight, $stub['weight']);
        $this->assertEquals($returnItem->weightUnit, WeightUnit::from($stub['weight_unit']));
        $this->assertEquals($returnItem->comment, $stub['comment']);
        $this->assertEquals($returnItem->description, $stub['description']);
        $this->assertEquals($returnItem->returnReason, $stub['return_reason']);
        $this->assertEquals($returnItem->imageUrl, $stub['image_url']);
        $this->assertEquals($returnItem->preferredOutcome, PreferredOutcome::from($stub['preferred_outcome']));
        $this->assertEquals($returnItem->questionAnswers[0]->code, $stub['return_question_answers'][0]['code']);
        $this->assertEquals($returnItem->questionAnswers[0]->answer, $stub['return_question_answers'][0]['answer']);
        $this->assertEquals($returnItem->questionAnswers[0]->description, $stub['return_question_answers'][0]['description']);
        $this->assertEquals($returnItem->questionAnswers[1]->code, $stub['return_question_answers'][1]['code']);
        $this->assertEquals($returnItem->questionAnswers[1]->answer, $stub['return_question_answers'][1]['answer']);
        $this->assertEquals($returnItem->questionAnswers[1]->description, $stub['return_question_answers'][1]['description']);
    }
}
