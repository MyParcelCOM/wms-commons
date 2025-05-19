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
        public ?string $sku,
        public ?string $name,
        public int $quantity,
        public int $priceAmount,
        public Currency $currency,
        public ?int $weight,
        public ?WeightUnit $weightUnit,
        public ?string $comment,
        public ?string $returnReason,
        public string $description,
        public ?string $imageUrl,
        public PreferredOutcome $preferredOutcome,
        public QuestionAnswerCollection $questionAnswers,
    ) {
    }

    public static function from(array $requestArray): self
    {
        return new self(
            externalReference: $requestArray['external_reference'],
            sku: $requestArray['sku'] ?? null,
            name: $requestArray['name'] ?? null,
            quantity: $requestArray['quantity'],
            priceAmount: $requestArray['price_amount'],
            currency: Currency::from($requestArray['currency']),
            weight: $requestArray['weight'] ?? null,
            weightUnit: WeightUnit::tryFrom($requestArray['weight_unit'] ?? ''),
            comment: $requestArray['comment'] ?? null,
            returnReason: $requestArray['return_reason'] ?? null,
            description: $requestArray['description'],
            imageUrl: $requestArray['image_url'] ?? null,
            preferredOutcome: PreferredOutcome::from($requestArray['preferred_outcome']),
            questionAnswers: new QuestionAnswerCollection(
                ...array_map(
                    fn (array $item) => QuestionAnswer::from($item),
                    $requestArray['return_question_answers'] ?? [],
                ),
            ),
        );
    }
}
