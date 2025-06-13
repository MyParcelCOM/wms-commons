<?php

declare(strict_types=1);

namespace MyParcelCom\Wms\Returns\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use MyParcelCom\Wms\Returns\Domain\Address\Address;
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

    public function consumerAddress(): Address
    {
        return Address::from($this->input('data.consumer_address'));
    }

    public function returnAddress(): Address
    {
        return Address::from($this->input('data.return_address'));
    }

    public function payment(): ReturnPayment|null
    {
        $paymentData = $this->input('data.payment');
        return $paymentData
            ? ReturnPayment::from($paymentData)
            : null;
    }

    public function items(): ReturnItemCollection
    {
        return new ReturnItemCollection(
            ...array_map(
            fn (array $item) => ReturnItem::from($item),
            $this->input('data.items'),
        ),
        );
    }
}
