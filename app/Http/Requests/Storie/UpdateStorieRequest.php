<?php

namespace App\Http\Requests\Storie;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Auth;

class UpdateStorieRequest extends FormRequest
{
    public function authorize()
    {
        return DB::table('storie_user')->where('user_id', Auth::user()->id)->where('storie_id', $this->route('id'))->where('liked', 0);
    }

    public function rules()
    {
        return [
            'title' => 'string|nullable|max:100|min:3',
            'cover' => 'mimes:jpeg,png,jpg,gif,webp',
            'agegroup' => 'nullable',
            'synopsis' => 'nullable|string',
            'genres' => 'nullable',
        ];
    }
}
