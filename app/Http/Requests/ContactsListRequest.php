<?php

namespace App\Http\Requests;

use App\Traits\RequestValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class ContactsListRequest extends FormRequest
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
            'page' => 'required|integer|min:1',
            'limit' => 'required|integer|min:1',
            'search' => ['string'],
        ];
    }
}
