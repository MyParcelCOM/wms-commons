<?php

declare(strict_types=1);

namespace MyParcelCom\Wms\Returns\Domain\QuestionAnswer;

// The QuestionAnswer class is used to map MyParcel question codes to their respective answer and a description.
readonly class QuestionAnswer
{
    public function __construct(
        public string $code,
        public string $answer,
        public string $description,
    ) {
    }

    public static function from(array $data): self
    {
        return new self(
            code: $data['code'],
            answer: $data['answer'],
            description: $data['description'],
        );
    }
}
