<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'slug' => '',
            'title' => 'required|min:3',
            'description' => 'required|min:10',
            'content' => 'required|min:10',
            'published' => 'nullable|boolean',
            'published_at' => 'nullable|date',
        ];
    }
}
