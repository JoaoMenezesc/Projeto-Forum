<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'min:3',
                'max:100'
            ],

            'email' => [
                'required',
                'email',
                'min:3',
                'max:100',
                //'unique:users,email',
                    Rule::unique('users', 'email')->ignore($this->user)
            ],

            'password'=> [
                'required',
                'min:6',
                'max:25',
            ]
        ];
    }
}
