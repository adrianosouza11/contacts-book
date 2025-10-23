<?php

namespace App\Http\Requests\AddressSearch;

use Illuminate\Foundation\Http\FormRequest;
class GetSearchPostalCodeRequest extends FormRequest
{
    public function authorize() : bool
    {
        return true;
    }

    public function rules() : array
    {
        return [
            'postal_code' => [
                'required',
                'string',
                'min:8',
                'max:9',
                'regex:/^\d{5}-?\d{3}$/'
            ],
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'postal_code.regex' => 'Postal code must be in the format 99999-999 or 99999999'
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'postal_code' => $this->route('postal_code'),
        ]);
    }
}
