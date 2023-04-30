<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ProfilModifRequest extends FormRequest
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
    public function rules(Request $request)
    {
        // dd(is_null($request->check));
        if (is_null($request->check)) {
            return [
                'nom' => 'required'
            ];
        } else {
            return [
                'nom' => 'required',
                'email' => ['exists:users,email', 'required'],
                'mdp' => ['required', 'min:8'],
                'emailC' => 'required',
                'mdpC' => 'required'
            ];
        }

    }
}
