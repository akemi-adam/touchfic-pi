<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Commentpost;
use App\Models\Post;
use App\Models\User;
use Auth;

class CommentpostController extends Controller
{
    public function store(Request $request, Post $post, User $user)
    {
        $comment = Commentpost::create([
            'content' => $request->content,
            'post_id' => $post->id,
            'user_id' => Auth::user()->id,
        ]);

        $comments = $post->comments;

        return redirect("/post/$post->id")->with('success_msg', 'Comentário adicionado com sucesso!');
    }

    public function edit($id)
    {
        return view('post.comment.edit', [
            'comment' => Commentpost::findOrFail($id),
        ]);
    }

    public function update(Request $request, $id)
    {
        $comment = Commentpost::findOrFail($id);
        $comment->content = $request->content;
        $comment->save();

        return redirect("/post/$comment->post_id")->with('success_msg', 'Postagem editada com sucesso!');
    }

    public function destroy($id)
    {
        $comment = Commentpost::findOrFail($id);
        $post_id = $comment->post_id;
        $comment->delete();

        return redirect("/post/$post_id")->with('success_msg', 'Postagem editada com sucesso!');
    }
}
