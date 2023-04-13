<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRegisterRequest extends FormRequest
{
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nom'=> 'required',
            'email'=> ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8', 'same:password_repeat'],
            'password_repeat' => ['required', 'min:8'],
        ];
    }
}
