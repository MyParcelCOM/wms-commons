<?php

declare(strict_types=1);

namespace MyParcelCom\Wms\Returns\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use MyParcelCom\Wms\Returns\Domain\Items\ReturnItem;
use MyParcelCom\Wms\Returns\Domain\Items\ReturnItemCollection;
use MyParcelCom\Wms\Returns\Domain\Payment\ReturnPayment;

class ReturnRequest extends FormRequest
{
    public function orderReference(): string
    {
        return $this->input('data.order_reference');
    }

    public function createdAt(): Carbon
    {
        return Carbon::createFromTimestamp($this->input('data.created_at'));
    }

    public function consumerAddress(): array
    {
        return $this->input('data.consumer_address');
    }

    public function returnAddress(): array
    {
        return $this->input('data.return_address');
    }

    public function payment(): ReturnPayment
    {
        return ReturnPayment::fromSnakeCaseArray($this->input('data.payment'));
    }

    public function items(): ReturnItemCollection
    {
        return new ReturnItemCollection(
            ...array_map(
                fn (array $item) => ReturnItem::fromSnakeCaseArray($item),
                $this->input('data.items')
            )
        );
    }
}
