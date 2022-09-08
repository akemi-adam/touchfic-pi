<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Commentpost;
use App\Models\Post;
use Auth;

class CommentpostController extends Controller
{

    public function store(Request $request, Post $post)
    {
        $this->authorize('authenticated');

        Commentpost::create([
            'content' => $request->content,
            'post_id' => $post->id,
            'user_id' => Auth::user()->id,
        ]);

        return redirect("/post/$post->id")->with('success_msg', 'Comentário adicionado com sucesso!');
    }

    public function edit($id)
    {
        $this->authorize('authenticated');

        return view('post.comment.edit', [
            'comment' => Commentpost::findOrFail($id),
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->authorize('authenticated');

        $comment = Commentpost::findOrFail($id);
        $comment->content = $request->content;
        $comment->save();

        return redirect("/post/$comment->post_id")->with('success_msg', 'Comentário editado com sucesso!');
    }

    public function destroy($id)
    {
        $this->authorize('authenticated');
        
        $comment = Commentpost::findOrFail($id);
        $post_id = $comment->post_id;
        $comment->delete();

        return redirect("/post/$post_id")->with('success_msg', 'Comentário excluído com sucesso!');
    }
}
