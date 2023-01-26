<?php

namespace App\Http\Requests;

use App\Traits\RequestValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class ContactsCreateOrEditRequest extends FormRequest
{
    use RequestValidationTrait;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'email|string|min:6|max:50',
            'name' => 'required|string|min:6|max:50',
            'phone' => ['string', 'min:12', 'max:13', 'regex:/^[0-9]*$/'],
            'whatsapp' => ['string', 'min:12', 'max:13', 'regex:/^[0-9]*$/'],
            'notes' => 'string|max:250'
        ];
    }
}
