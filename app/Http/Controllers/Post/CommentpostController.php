<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Commentpost;
use Auth;

class CommentpostController extends Controller
{
    /**
     * Apply middleware exists edit and update actions
     * 
     * @return void
     */
    public function __construct() {
        $this->middleware('exists:' . Commentpost::class, [
            'only' => [
                'edit', 'update'
            ]
        ]);
    }

    /**
     * Returns the comment edit form
     * 
     * @param int $id
     * 
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $this->authorize('authenticated');

        return view('post.comment.edit', [
            'comment' => Commentpost::findOrFail($id),
        ]);
    }

    /**
     * Retrieves the comment by id, updates its content and redirects the user to the post to which the comment belongs
     * 
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $this->authorize('authenticated');

        $comment = Commentpost::findOrFail($id);

        $comment->content = $request->content;
        
        $comment->save();

        return redirect("/post/$comment->post_id")->with('success_msg', 'Comentário editado com sucesso!');
    }
}
