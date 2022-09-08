<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Commentpost;
use Auth;

class CommentpostController extends Controller
{
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
}
