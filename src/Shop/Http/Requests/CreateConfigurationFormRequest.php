<?php

namespace MyParcelCom\Wms\Shop\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;

class CreateConfigurationFormRequest extends FormRequest
{
    /**
     * @return Collection<array-key, array{code: string, label: string}>
     */
    public function mpReturnReasons(): Collection
    {
        return collect($this->input('data.return_reasons', []));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'data.return_reasons'         => 'array|min:1',
            'data.return_reasons.*.code'  => 'required|string',
            'data.return_reasons.*.label' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'data.return_reasons' => 'Your shop requires at least one linked return reason.',
        ];
    }
}
