<?php

namespace App\Http\Requests\ContactBook;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostContactRequest extends FormRequest
{
    public function authorize() : bool
    {
        return true;
    }

    public function rules() : array
    {
        return [
            'contact_name' => ['required', 'string', 'max:45'],
            'contact_phone' => ['required', 'string', 'max:11',
                Rule::unique('contact_books','contact_phone')
            ],
            'contact_email' => ['required', 'email', 'max:155',
                Rule::unique('contact_books', 'contact_email')
            ],
            'address' => ['required', 'string', 'max:255'],
            'number' => ['required', 'string', 'min:1', 'max:45'],
            'neighborhood' => ['required', 'string', 'max:45'],
            'city' => ['required', 'string', 'max:32'],
            'state' => ['required', 'string', 'max:20'],
            'postal_code' => ['required', 'string', 'max:8'],
        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
