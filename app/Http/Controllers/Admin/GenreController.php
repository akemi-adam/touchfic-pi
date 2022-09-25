<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Genre;
use Auth;

class GenreController extends Controller
{
    /**
     * Show all genres
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $this->authorize('admin_operations');

        $genres = Genre::all();
        return view('admin.genre.index',[
            'genres' => $genres
        ]);
    }

    /**
     * Show the creation form
     * 
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('admin_operations');

        return view('admin.genre.create');
    }

    /**
     * Checks if the user is an administrator and if so, creates a gender object, saves its name and returns a redirect with a success message
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->authorize('admin_operations');
        
        $genre = new Genre;
        $genre->genre = $request->genre;

        $genre->save();

        return redirect('/admin/genre')->with('success_msg', 'O gênero foi cadastrado com sucesso!');
    }

    /**
     * From the id, retrieves the specific genre and returns a page with information about it
     * 
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $this->authorize('admin_operations');

        $genre = Genre::findOrFail($id);
        
        return view('admin.genre.show', [
            'genre' => $genre
        ]);
    }

    /**
     * By id, show the edit form
     * 
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $this->authorize('admin_operations');

        $genre = Genre::findOrFail($id);

        return view('admin.genre.edit', [
            'genre' => $genre,
        ]);
    }

    /**
     * Checks the user's permission level and if the user is an admin, updates the specified gender, returning to a view with a success message
     * 
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $this->authorize('admin_operations');

        $genre = Genre::findOrFail($id);
        $genre->genre = $request->genre;
        $genre->save();

        return redirect('/admin/genre')->with('success_msg', "Gênero $genre->genre editado");
    }

    /**
     * Checks the user's permission level and if he is an admin, allows the gender to be deleted
     * 
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->authorize('admin_operations');

        Genre::findOrFail($id)->delete();

        return redirect('/admin/genre')->with('success_msg', "Gênero removido com sucesso");
    }
}
