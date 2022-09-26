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
     * From a join in the database tables, retrieves the list of authors and their stories
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $stories = Storie::rightJoin('storie_user', 'stories.id', '=', 'storie_user.storie_id')
                        ->rightJoin('users', 'users.id', '=', 'storie_user.user_id')
                        ->where('storie_user.liked', 0)
                        ->whereNotNull('storie_user.user_id')
                        ->orderBy('stories.id', 'DESC')
                        ->get();

        return view('storie.index', [
            'stories' => $stories,
        ]);
    }

    /**
     * From a join in the database tables, retrieves the histories of the current user
     * 
     * @param int $id
     * 
     * @return \Illuminate\View\View
     */
    public function myStories($id)
    {
        $stories = Storie::rightJoin('storie_user', 'stories.id', '=', 'storie_user.storie_id')
                    ->rightJoin('users', 'users.id', '=', 'storie_user.user_id')
                    ->where('storie_user.user_id', $id)
                    ->where('storie_user.liked', 0)
                    ->orderBy('stories.id', 'DESC')
                    ->get();

        return view('storie.mystories', [
            'stories' => $stories,
        ]);
    }

    /**
     * From a join in the database tables, retrieves the stories that the user has liked
     * 
     * @param int $id
     * 
     * @return \Illuminate\View\View
     */
    public function likes($id)
    {
        $stories = Storie::rightJoin('storie_user', 'stories.id', '=', 'storie_user.storie_id')
                    ->rightJoin('users', 'users.id', '=', 'storie_user.user_id')
                    ->where('storie_user.user_id', $id)
                    ->where('storie_user.liked', 1)
                    ->orderBy('stories.title', 'ASC')
                    ->get();

        return view('storie.mystories', [
            'stories' => $stories,
        ]);
    }

    /**
     * From a join in the database tables, the users who have liked the respective story by its id
     * 
     * @param int $id
     * 
     * @return \Illuminate\View\View
     */
    public function likesOfStorie($id)
    {

        $datas = DB::table('storie_user')
                    ->join('users', 'users.id', '=', 'storie_user.user_id')
                    ->where('storie_user.storie_id', $id)
                    ->where('storie_user.liked', 1)
                    ->get();

        return view('storie.likesofstorie', [
            'datas' => $datas,
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

        $storie->users()->attach(Auth::user()->id, ['author_id' => Auth::user()->id, 'author_name' => Auth::user()->name]);

        foreach ($request->genres as $genre) {
            $storie->genres()->attach($genre);
        }

        return redirect('/storie')->with('success_msg', 'História cadastrada com sucesso');
    }

    /**
     * Retrieves the story, its genres and, together with its chapters and the total number of likes, displays it
     * 
     * @param int $id
     * 
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $storie = Storie::rightJoin('storie_user', 'stories.id', '=', 'storie_user.storie_id')
                    ->rightJoin('users', 'users.id', '=', 'storie_user.user_id')
                    ->where('stories.id', $id)
                    ->first();

        $genres = DB::table('genre_storie')
                    ->join('genres', 'genre_storie.genre_id', '=', 'genres.id')
                    ->where('genre_storie.storie_id', $storie->storie_id)
                    ->select('genres.genre')
                    ->orderBy('genres.genre', 'ASC')
                    ->get();

        $chapters = Chapter::where('storie_id', $storie->storie_id)->get();

        $amount = DB::table('storie_user')->where('liked', 1)->where('storie_id', $id)->count() ?: 0;

        return view('storie.show', [
            'storie' => $storie,
            'genres' => $genres,
            'chapters' => $chapters,
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
        $storie = Storie::rightJoin('storie_user', 'stories.id', '=', 'storie_user.storie_id')
                    ->rightJoin('users', 'users.id', '=', 'storie_user.user_id')
                    ->where('stories.id', $id)
                    ->first();

        $genres = Genre::all();

        $selectsGenres = Genre::join('genre_storie', 'genres.id', '=', 'genre_storie.genre_id')
                            ->where('genre_storie.storie_id', $id)
                            ->get();

        $agegroups = Agegroup::all();

        return view('storie.edit', [
            'storie' => $storie,
            'genres' => $genres,
            'agegroups' => $agegroups,
            'selectsGenres' => $selectsGenres,
        ]);
    }

    /**
     * Retrieves the story, checks the authorization, checks which fields have changed, checks the cover, and saves the story. It also checks the genres and does all the necessary procedures against the database tables if any genre has been changed, and can dispatch an UpdateStorie event.
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

            UpdateStorie::dispatch($storie);

            $storie->genres()->detach();

            foreach ($request->genres as $genre) {
                $storie->genres()->attach($genre);
            }

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

        $storie->users()->detach();
        $storie->genres()->detach();

        DeleteStorie::dispatch($storie);

        DB::table('storie_user')->where('storie_id', $id)->where('liked', 1)->delete();

        $storie->delete();

        return redirect()->to(route('storie.mystories', Auth::user()->id))->with('success_msg', 'História deletada com sucesso!');
    }

}
