<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;

class GenreController extends Controller
{
    /**
     * 
     * Resgata os dados do banco e devolve pra página /admin/genre/index
     */

    public function index()
    {
        $genres = Genre::all();
        return view('admin.genre.index',[
            'genres' => $genres
        ]);
    }

    /**
     * Retorna um formulário para criação de gêneros
     */

    public function create()
    {
        return view('admin.genre.create');
    }

    /**
     * Action que vai operar no banco salvando as informações e redirecionar a página para mostrar os dados salvos
     */

    public function store(Request $request)
    {
        $genre = new Genre;
        $genre->genre = $request->genre;

        $genre->save();

        return redirect('/admin/genre')->with('success_msg', 'O gênero foi cadastrado com sucesso!');
    }

    /**
     * Procura o gênero pelo seu id específico e retorna um objeto dele para a página show
     */

    public function show($id)
    {
        $genre = Genre::findOrFail($id);
        
        return view('admin.genre.show', [
            'genre' => $genre
        ]);
    }

    public function edit($id)
    {
        $genre = Genre::findOrFail($id);

        return view('admin.genre.edit', [
            'genre' => $genre,
        ]);
    }

    public function update(Request $request, $id)
    {
        $genre = Genre::findOrFail($id);
        $genre->genre = $request->genre;
        $genre->save();

        return redirect('/admin/genre')->with('success_msg', "Gênero $genre->genre editado");
    }

    public function destroy($id)
    {
        Genre::findOrFail($id)->delete();

        return redirect('/admin/genre')->with('success_msg', "Gênero removido com sucesso");
    }
}
