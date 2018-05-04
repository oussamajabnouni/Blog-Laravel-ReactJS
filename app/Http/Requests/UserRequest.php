<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|min:3',
            'email' => [
                'required',
                Rule::unique('users')->ignore(Auth::user()->id)
            ],
            'phone' => 'nullable|min:8|numeric',
            'about' => 'nullable|min:10|max:1024'
        ];
    }
}
