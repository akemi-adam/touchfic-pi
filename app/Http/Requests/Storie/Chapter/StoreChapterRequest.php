<?php

namespace App\Http\Requests\Storie\Chapter;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class StoreChapterRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::check();
    }

    public function rules()
    {
        return [
            'title' => 'string|required|max:100|min:3',
            'authornotes' => 'string|nullable',
            'content' => 'string|required|min:10',
            'track' => 'string|nullable',
        ];
    }
}
