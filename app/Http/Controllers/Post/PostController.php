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

    public function __construct() {
        $this->middleware('exists:' . Post::class, [
            'only' => [
                'show',
            ]
        ]);
    }

    public function index()
    {
        $posts = Post::orderBy('updated_at', 'DESC')->get();

        return view('post.index', [
            'posts' => $posts,
        ]);
    }

    public function create()
    {
        $this->authorize('create', Post::class);

        return view('post.create');
    }

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);

        return view('post.show', [
            'post' => $post,
        ]);
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);

        $this->authorize('update', $post);

        return view('post.edit', [
            'post' => $post,
        ]);
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        $this->authorize('update', $post);

        $post->content = $request->content;
        $post->save();

        return redirect("/post/$id")->with('success_msg', 'Postagem editada com sucesso!');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        $this->authorize('delete', $post);

        if (isset($post->comments)) {
            Commentpost::where('post_id', $post->id)->delete();
        }

        DeletePublication::dispatch($post);

        $post->delete();

        return redirect('/post')->with('success_msg', 'Postagem deletada com sucesso!');
    }
}
