<?php

namespace App\Http\Controllers\Storie;

use Auth, Storage, DB, FileSupport, RequestSupport, StorieSupport;
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
     * @param User $user
     * 
     * @return \Illuminate\View\View
     */
    public function myStories(User $user)
    {
        return view('storie.index', [
            'stories' => $user->stories,
        ]);
    }

    /**
     * Gets the stories liked through the likeInfo function
     * 
     * @param int $id
     * 
     * @return \Illuminate\View\View
     */
    public function likes($id)
    {
        $stories = StorieSupport::likeInfo($id, 'user_id', Storie::class, 'storie_id');

        return view('storie.index', [
            'stories' => $stories,
        ]);
    }

    /**
     * Gets the users who liked the story through the likeInfo function
     * 
     * @param int $id
     * 
     * @return \Illuminate\View\View
     */
    public function likesOfStorie($id)
    {
        $users = StorieSupport::likeInfo($id, 'storie_id', User::class, 'user_id');

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

        $storie = Storie::create([
            'title' => $request->title,
            'synopsis' => $request->synopsis,
            'agegroup_id' => $request->agegroup,
        ]);

        FileSupport::cover($request, $storie);

        $storie->save();

        $storie->users()->attach(Auth::id());

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
