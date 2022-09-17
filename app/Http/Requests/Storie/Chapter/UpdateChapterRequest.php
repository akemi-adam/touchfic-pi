<?php

namespace App\Http\Requests\Storie\Chapter;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use App\Models\{
    User, Storie, Chapter
};
use Auth;

class UpdateChapterRequest extends FormRequest
{
    public function authorize()
    {
        $chapter = Chapter::findOrFail($this->route('id'));

        return DB::table('storie_user')->where('user_id', Auth::user()->id)->where('storie_id', $chapter->storie_id)->where('liked', 0);
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
