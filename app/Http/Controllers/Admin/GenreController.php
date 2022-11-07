<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Genre;
use Auth, Logger;

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

        Logger::log('genre', 'info', Auth::user()->name . ' has accessed the page that lists all the genres');

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

        Logger::log('genre', 'info', Auth::user()->name . ' has accessed the genre registration form');

        return view('admin.genre.create');
    }

    /**
     * Checks if the user is an administrator and if so, creates a gender object, saves its name and returns a redirect with a success message
     * 
     * @param Request $request
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->authorize('admin_operations');
        
        $genre = new Genre;
        $genre->genre = $request->genre;

        $genre->save();

        Logger::log('genre', 'info', Auth::user()->name . ' registered a new genre: [New genre: ' . $genre->id . '] ' . $genre->genre);

        return redirect('/admin/genre')->with('success_msg', 'O gênero foi cadastrado com sucesso!');
    }

    /**
     * From the id, retrieves the specific genre and returns a page with information about it
     * 
     * @param int $id
     * 
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $this->authorize('admin_operations');

        $genre = Genre::findOrFail($id);

        Logger::log('genre', 'info', Auth::user()->name . ' visualized a specific genre: [Genre: ' . $genre->id . '] ' . $genre->genre);
        
        return view('admin.genre.show', [
            'genre' => $genre
        ]);
    }

    /**
     * By id, show the edit form
     * 
     * @param int $id
     * 
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $this->authorize('admin_operations');

        $genre = Genre::findOrFail($id);

        Logger::log('genre', 'info', Auth::user()->name . ' has accessed the edit form: [Genre: ' . $genre->id . '] ' . $genre->genre);

        return view('admin.genre.edit', [
            'genre' => $genre,
        ]);
    }

    /**
     * Checks the user's permission level and if the user is an admin, updates the specified gender, returning to a view with a success message
     * 
     * @param Request $request
     * @param int $id
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $this->authorize('admin_operations');

        $genre = Genre::findOrFail($id);

        $genre->update([ 'genre' => $request->genre ]);

        Logger::log('genre', 'info', Auth::user()->name . ' updated a genre: [Genre: ' . $genre->id . '] ' . $genre->genre);

        return redirect('/admin/genre')->with('success_msg', "Gênero $genre->genre editado");
    }

    /**
     * Checks the user's permission level and if he is an admin, allows the gender to be deleted
     * 
     * @param int $id
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->authorize('admin_operations');

        $genre = Genre::findOrFail($id);

        $genre->stories()->detach();

        $genre->delete();

        Logger::log('genre', 'info', Auth::user()->name . ' deleted a genre: [Genre: ' . $id . '] ' . $genre->genre);

        return redirect('/admin/genre')->with('success_msg', "Gênero removido com sucesso");
    }
}
