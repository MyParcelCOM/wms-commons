<?php

declare(strict_types=1);

namespace MyParcelCom\Wms\Returns\Domain\QuestionAnswer;

use Illuminate\Support\Collection;

/** @extends Collection<int, QuestionAnswer> */
class QuestionAnswerCollection extends Collection
{
    public function __construct(QuestionAnswer ...$items)
    {
        parent::__construct($items);
    }
}
