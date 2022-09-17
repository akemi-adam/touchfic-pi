<?php

namespace App\Http\Requests\Storie;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class StoreStorieRequest extends FormRequest
{
    public function authorize()
    {
        return !is_null(Auth::user()->email_verified_at);
    }

    public function rules()
    {
        return [
            'title' => 'string|required|max:100|min:3',
            'cover' => 'mimes:jpeg,png,jpg,gif,webp',
            'agegroup' => 'required',
            'synopsis' => 'required|string|min:20',
            'genres' => 'required',
        ];
    }
}
