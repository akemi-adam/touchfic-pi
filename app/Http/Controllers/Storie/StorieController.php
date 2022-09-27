<?php

namespace App\Http\Controllers\Storie;

use Auth, Storage, DB, FileSupport, RequestSupport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Storie\{
    StoreStorieRequest, UpdateStorieRequest
};
use App\Models\{
    Agegroup, Chapter, Storie, Genre, User
};
use App\Events\{
    DeleteStorie, UpdateStorie
};

class StorieController extends Controller
{

    /**
     * Apply middleware exists show actions
     * 
     * @return void
     */
    public function __construct()
    {
        $this->middleware('exists:' . Storie::class, [
            'only' => [
                'show',
            ]
        ]);
    }

    /**
     * Returns all stories
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('storie.index', [
            'stories' => Storie::orderBy('id', 'DESC')->get(),
        ]);
    }

    /**
     * Sends all related stories to the current user
     * 
     * @param int $id
     * 
     * @return \Illuminate\View\View
     */
    public function myStories($id)
    {
        return view('storie.index', [
            'stories' => Auth::user()->stories,
        ]);
    }

    /**
     * Adds the stories liked by the user to an array and sends it to the view
     * 
     * @param int $id
     * 
     * @return \Illuminate\View\View
     */
    public function likes($id)
    {
        $likesData = DB::table('likes')->where('user_id', $id)->get();

        $stories = array();

        foreach ($likesData as $data) {
            $stories[] = Storie::findOrFail($data->storie_id);
        }

        return view('storie.index', [
            'stories' => $stories,
        ]);
    }

    /**
     * Takes the users who liked the story and sends them to the view
     * 
     * @param int $id
     * 
     * @return \Illuminate\View\View
     */
    public function likesOfStorie($id)
    {

        $likesData = DB::table('likes')->where('storie_id', $id)->get();

        $users = array();

        foreach ($likesData as $data) {
            $users[] = User::findOrFail($data->user_id);
        }

        return view('storie.likesofstorie', [
            'users' => $users,
        ]);
    }

    /**
     * Shows the story creation form
     * 
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('create', Storie::class);

        $agegroups = Agegroup::all();

        $genres = Genre::all();

        return view('storie.create', [
            'agegroups' => $agegroups,
            'genres' => $genres,
        ]);
    }

    /**
     * Authorizes the action, creates a story object, defines its properties, checks the cover, saves it to the database, and then makes the relationships with the columns that have many to many relationships
     * 
     * @param App\Http\Requests\Storie\StoreStorieRequest $request
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreStorieRequest $request)
    {
        $this->authorize('create', Storie::class);

        $storie = new Storie;

        $storie->title = $request->title;

        $storie->synopsis = $request->synopsis;

        $storie->agegroup_id = $request->agegroup;

        FileSupport::cover($request, $storie);

        $storie->save();

        $storie->users()->attach(Auth::user()->id);

        foreach ($request->genres as $genre) {
            $storie->genres()->attach($genre);
        }

        return redirect('/storie')->with('success_msg', 'História cadastrada com sucesso');
    }

    /**
     * Retrieves the story and the amount of likes it has
     * 
     * @param int $id
     * 
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $storie = Storie::findOrFail($id);

        $amount = DB::table('likes')->where('storie_id', $id)->count();

        return view('storie.show', [
            'storie' => $storie,
            'amount' => $amount,
        ]);
    }

    /**
     * Shows the story editing form
     * 
     * @param int $id
     * 
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        return view('storie.edit', [
            'storie' => Storie::findOrFail($id),
            'genres' => Genre::all(),
            'agegroups' => Agegroup::all(),
        ]);
    }

    /**
     * Finds the story, authorizes the action, sets the properties that have changed on the form, checks the cover, saves the story, and dispatches an UpdateStorie event
     * 
     * @param App\Http\Requests\Storie\UpdateStorieRequest $request
     * @param int $id
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateStorieRequest $request, $id)
    {
        $storie = Storie::findOrFail($id);

        $this->authorize('update', $storie);

        RequestSupport::setEditValues($request, $storie, ['title', 'synopsis', 'agegroup_id']);

        FileSupport::cover($request, $storie);

        $storie->save();

        if (!is_null($request->genres)) {

            UpdateStorie::dispatch($storie, $request);
            
        }

        return redirect()->to(route('storie.show', $storie->id))->with('success_msg', 'História editada com sucesso');
    }


    /**
     * Retrieves the story, deletes the relationships it had with other tables, dispatches an event and deletes the story
     * 
     * @param int $id
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $storie = Storie::findOrFail($id);

        $this->authorize('delete', $storie);

        DeleteStorie::dispatch($storie);

        $storie->delete();

        return redirect()->to(route('storie.mystories', Auth::user()->id))->with('success_msg', 'História deletada com sucesso!');
    }

}
