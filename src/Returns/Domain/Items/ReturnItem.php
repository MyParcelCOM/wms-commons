<?php

declare(strict_types=1);

namespace MyParcelCom\Wms\Returns\Domain\Items;

use MyParcelCom\Wms\Returns\Domain\Payment\Currency;
use MyParcelCom\Wms\Returns\Domain\QuestionAnswer\QuestionAnswer;
use MyParcelCom\Wms\Returns\Domain\QuestionAnswer\QuestionAnswerCollection;

/**
 * ReturnItem extends the ArrayObject class with getters to make
 *  it convenient to extract data from a return coming in from MyParcel.
 */
readonly class ReturnItem
{
    public function __construct(
        public string $externalReference,
        public int $quantity,
        public int $priceAmount,
        public Currency $currency,
        public string $description,
        public PreferredOutcome $preferredOutcome,
        public ?WeightUnit $weightUnit = null,
        public ?int $weight = null,
        public ?string $sku = null,
        public ?string $name = null,
        public ?string $comment = null,
        public ?string $returnReason = null,
        public ?string $imageUrl = null,
        public ?QuestionAnswerCollection $questionAnswers = null,
    ) {
    }

    public static function from(array $requestArray): self
    {
        return new self(
            externalReference: $requestArray['external_reference'],
            quantity: $requestArray['quantity'],
            priceAmount: $requestArray['price_amount'],
            currency: Currency::from($requestArray['currency']),
            description: $requestArray['description'],
            preferredOutcome: PreferredOutcome::from($requestArray['preferred_outcome']),
            weightUnit: isset($requestArray['weight_unit']) ? WeightUnit::from($requestArray['weight_unit']) : null,
            weight: $requestArray['weight'] ?? null,
            sku: $requestArray['sku'] ?? null,
            name: $requestArray['name'] ?? null,
            comment: $requestArray['comment'] ?? null,
            returnReason: $requestArray['return_reason'] ?? null,
            imageUrl: $requestArray['image_url'] ?? null,
            questionAnswers: isset($requestArray['return_question_answers'])
                ? new QuestionAnswerCollection(
                    ...array_map(
                        fn (array $item) => QuestionAnswer::from($item),
                        $requestArray['return_question_answers'],
                    )
                ) : null,
        );
    }
}
