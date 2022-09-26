<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Commentpost;
use App\Models\Post;

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
        
        Post::findOrFail($id)->delete();

        return redirect()->to(route('post.index'));
    }
}
