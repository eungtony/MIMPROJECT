<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class userRequest extends Request
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'agence_id' => 'required',
            'poste_id' => 'required',
            'statut_id' => 'required'
        ];
    }
}