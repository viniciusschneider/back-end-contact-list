<?php

namespace App\Http\Requests;

use App\Traits\RequestValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|string|min:8|max:50',
            'email' => 'required|email||min:8|max:50',
            'password' => 'required|string|confirmed|min:8|max:50',
        ];
    }
}
