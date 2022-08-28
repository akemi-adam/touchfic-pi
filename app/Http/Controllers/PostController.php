<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commentpost;
use App\Models\Post;
use App\Models\User;
use Auth;

class PostController extends Controller
{

    /**
     * Mostra todas as postagens cadastradas com o seu usuário respectivo.
     *
     * @var Post $posts
     * @var User $users
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        $users = User::all();

        return view('post.index', [
            'posts' => $posts,
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Cria a postagem no banco e redireiciona para a rota e action index com uma flash message.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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

    /**
     * Mostra o formulário para editar uma postagem específica
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);

        return view('post.edit', [
            'post' => $post,
        ]);
    }

    /**
     * Atualiza uma postagem específica e retorna uma mensagem de sucesso
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->content = $request->content;
        $post->save();

        return redirect("/post/$id")->with('success_msg', 'Postagem editada com sucesso!');
    }

    /**
     * Deleta uma postagem específica e retorna uma mensagem de sucesso
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $post = Post::findOrFail($id);

        if (isset($post->comments)) {
            Commentpost::where('post_id', $post->id)->delete();
        }

        $post->delete();

        return redirect('/post')->with('success_msg', 'Postagem deletada com sucesso!');
    }
}
