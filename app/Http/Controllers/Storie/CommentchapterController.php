<?php

namespace App\Http\Controllers\Storie;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Commentchapter;
use App\Models\Chapter;
use Auth;

class CommentchapterController extends Controller
{

    public function __construct() {
        $this->middleware('exists:' . Commentchapter::class, [
            'only' => [
                'edit', 'update'
            ]
        ]);
    }

    public function edit($id)
    {
        $this->authorize('authenticated');

        return view('storie.chapter.comment.edit', [
            'comment' => Commentchapter::findOrFail($id),
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->authorize('authenticated');

        $comment = Commentchapter::findOrFail($id);
        $comment->content = $request->content;
        $comment->save();

        return redirect()->to(route('chapter.show', $comment->chapter_id))->with('success_msg', 'Comentário editado com sucesso!');
    }
}
