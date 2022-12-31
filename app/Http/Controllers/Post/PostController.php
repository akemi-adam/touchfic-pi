<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Events\DeletePublication;
use Illuminate\Http\Request;
use App\Models\Commentpost;
use App\Models\Post;
use Auth;

class PostController extends Controller
{

    /**
     * Apply middleware exists show actions
     */
    public function __construct() {
        $this->middleware('exists:' . Post::class, [
            'only' => [
                'show',
            ]
        ]);
    }

    /**
     * Retrieves the most recent posts and returns a view
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $posts = Post::orderBy('updated_at', 'DESC')->get();

        return view('post.index', [
            'posts' => $posts,
        ]);
    }

    /**
     * Returns the post creation form
     * 
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('create', Post::class);

        return view('post.create');
    }

    /**
     * Saves the post to the database
     * 
     * @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->authorize('create', Post::class);

        Post::create([
            'content' => $request->content,
            'user_id' => Auth::user()->id,
        ]);

        return redirect('/post')->with('success_msg', 'A postagem foi cadastrada com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * 
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        return view('post.show', [
            'post' => Post::findOrFail($id),
        ]);
    }

    /**
     * Shows the post edition form
     * 
     * @param int id
     * 
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);

        $this->authorize('update', $post);

        return view('post.edit', [
            'post' => $post,
        ]);
    }

    /**
     * Retrieves the post, checks the authorization and updates the post in the database
     * 
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        $this->authorize('update', $post);

        $post->content = $request->content;
        $post->save();

        return redirect()->to(route('post.update', $post->id))->with('success_msg', 'Postagem editada com sucesso!');
    }

    /**
     * It finds the post in the bank and, if it passes authorization and if it has comments, deletes them along with it. Dispatch a DeletePublication event
     * 
     * @param int $id
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        $this->authorize('delete', $post);

        if (isset($post->comments)) 
            Commentpost::where('post_id', $post->id)->delete();

        DeletePublication::dispatch($post);

        $post->delete();

        return redirect()->to(route('post.index'))->with('success_msg', 'Postagem deletada com sucesso!');
    }
}
