<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Events\DeletePublication;
use Illuminate\Http\Request;
use App\Models\{
    Commentpost, Post
};

class ModeratorController extends Controller
{
    /**
     * Delete the post comments and delete the post
     * 
     * @param int $id
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deletePost($id)
    {
        Commentpost::where('post_id', $id)->delete();
        
        $post = Post::find($id);

        DeletePublication::dispatch($post);

        $post->delete();

        return redirect()->to(route('post.index'));
    }
}
