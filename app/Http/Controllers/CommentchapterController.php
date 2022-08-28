<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commentchapter;
use App\Models\Chapter;
use Auth;

class CommentchapterController extends Controller
{
    public function store(Request $request, Chapter $chapter)
    {
        Commentchapter::create([
            'content' => $request->content,
            'chapter_id' => $chapter->id,
            'user_id' => Auth::user()->id,
        ]);

        $comments = $chapter->comments;

        return redirect()->to(route('chapter.show', $chapter->id))->with('success_msg', 'Comentário adicionado com sucesso!');
    }

    public function edit($id)
    {
        return view('storie.chapter.comment.edit', [
            'comment' => Commentchapter::findOrFail($id),
        ]);
    }

    public function update(Request $request, $id)
    {
        $comment = Commentchapter::findOrFail($id);
        $comment->content = $request->content;
        $comment->save();

        return redirect()->to(route('chapter.show', $comment->chapter_id))->with('success_msg', 'Comentário editado com sucesso!');
    }

    public function destroy($id)
    {
        $comment = Commentchapter::findOrFail($id);
        $chapter_id = $comment->chapter_id;
        $comment->delete();

        return redirect()->to(route('chapter.show', $chapter_id))->with('success_msg', 'Comentário excluído com sucesso!');
    }
}
