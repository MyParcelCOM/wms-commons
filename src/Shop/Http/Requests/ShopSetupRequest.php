<?php

declare(strict_types=1);

namespace MyParcelCom\Wms\Shop\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class ShopSetupRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'data.settings'     => 'array',
            'data.redirect_url' => 'url',
        ];
    }
}
