<?php

namespace App\Http\Controllers;

use App\Http\Requests\Storie\StorieRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Agegroup;
use App\Models\Chapter;
use App\Models\Storie;
use App\Models\Genre;
use App\Models\User;
use Auth, File;

class StorieController extends Controller
{

    public function index()
    {
        
        $stories = Storie::rightJoin('storie_user', 'stories.id', '=', 'storie_user.storie_id')->rightJoin('users', 'users.id', '=', 'storie_user.user_id')->where('storie_user.liked', 0)->whereNotNull('storie_user.user_id')->orderBy('stories.id', 'DESC')->get();

        return view('storie.index', [
            'stories' => $stories,
        ]);
    }

    public function myStories($id)
    {
        $stories = Storie::rightJoin('storie_user', 'stories.id', '=', 'storie_user.storie_id')->rightJoin('users', 'users.id', '=', 'storie_user.user_id')->where('storie_user.user_id', $id)->orderBy('stories.id', 'DESC')->get();

        return view('storie.mystories', [
            'stories' => $stories,
        ]);
    }

    public function likes($id)
    {
        $stories = Storie::rightJoin('storie_user', 'stories.id', '=', 'storie_user.storie_id')->rightJoin('users', 'users.id', '=', 'storie_user.user_id')->where('storie_user.user_id', $id)->where('storie_user.liked', 1)->orderBy('stories.title', 'ASC')->get();

        return view('storie.mystories', [
            'stories' => $stories,
        ]);
    }


    public function create()
    {
        $agegroups = Agegroup::all();
        $genres = Genre::all();
        return view('storie.create', [
            'agegroups' => $agegroups,
            'genres' => $genres,
        ]);
    }

    public function store(StorieRequest $request)
    {
        $storie = new Storie;

        $storie->title = $request->title;
        $storie->synopsis = $request->synopsis;
        $storie->agegroup_id = $request->agegroup;

        if ($request->hasFile('cover') && $request->file('cover')->isValid()) {

            if (!($storie->cover === "default-storie-cover.png")) {
                File::delete('img/storie/cover/' . $storie->cover);
            }

            $requestCover = $request->cover;
            $extension = $requestCover->extension();
            $coverName = md5($requestCover->getClientOriginalName() . strtotime('now') . '.' . $extension);

            $request->cover->move(public_path('img/storie/cover'), $coverName);
            $storie->cover = $coverName;

        }

        $storie->save();

        $storie->users()->attach(Auth::user()->id);

        foreach ($request->genres as $genre) {
            $storie->genres()->attach($genre);
        }

        return redirect('/storie')->with('success_msg', 'História cadastrada com sucesso');
    }

    public function show($id)
    {
        $storie = Storie::rightJoin('storie_user', 'stories.id', '=', 'storie_user.storie_id')->rightJoin('users', 'users.id', '=', 'storie_user.user_id')->where('stories.id', $id)->first();

        $genres = DB::table('genre_storie')->join('genres', 'genre_storie.genre_id', '=', 'genres.id')->where('genre_storie.storie_id', $storie->storie_id)->select('genres.genre')->orderBy('genres.genre', 'ASC')->get();

        $chapters = Chapter::where('storie_id', $storie->storie_id)->get();

        $amount = DB::table('storie_user')->where('liked', 1)->where('storie_id', $id)->count() ?: 0;

        return view('storie.show', [
            'storie' => $storie,
            'genres' => $genres,
            'chapters' => $chapters,
            'amount' => $amount,
        ]);
    }


    public function edit($id)
    {
        $storie = Storie::rightJoin('storie_user', 'stories.id', '=', 'storie_user.storie_id')->rightJoin('users', 'users.id', '=', 'storie_user.user_id')->where('stories.id', $id)->first();

        $genres = Genre::all();

        $agegroups = Agegroup::all();

        return view('storie.edit', [
            'storie' => $storie,
            'genres' => $genres,
            'agegroups' => $agegroups,
        ]);
    }

    public function update(StorieRequest $request, $id)
    {
        $storie = Storie::findOrFail($id);

        $storie->title = $request->title;
        $storie->synopsis = $request->synopsis;
        $storie->agegroup_id = $request->agegroup;

        if ($request->hasFile('cover') && $request->file('cover')->isValid()) {

            if (!($storie->cover === "default-storie-cover.png")) {
                File::delete('img/storie/cover/' . $storie->cover);
            }

            $requestCover = $request->cover;
            $extension = $requestCover->extension();
            $coverName = md5($requestCover->getClientOriginalName() . strtotime('now') . '.' . $extension);

            $request->cover->move(public_path('img/storie/cover'), $coverName);
            $storie->cover = $coverName;

        }

        $storie->save();

        $storie->genres()->detach();

        foreach ($request->genres as $genre) {
            $storie->genres()->attach($genre);
        }

        return redirect()->to(route('storie.show', $storie->id))->with('success_msg', 'História editada com sucesso');
    }


    public function destroy($id)
    {
        $storie = Storie::findOrFail($id);

        $storie->users()->detach();
        $storie->genres()->detach();

        $storie->delete();

        return redirect()->to(route('storie.mystories', Auth::user()->id))->with('success_msg', 'História deletada com sucesso!');
    }
}
