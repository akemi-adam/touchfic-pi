<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agegroup;
use App\Models\Storie;
use App\Models\Genre;
use App\Models\User;
use Auth;

class StorieController extends Controller
{

    public function index()
    {
        
        $stories = Storie::rightJoin('storie_user', 'stories.id', '=', 'storie_user.storie_id')->rightJoin('users', 'users.id', '=', 'storie_user.user_id')->whereNotNull('storie_user.user_id')->orderBy('stories.id', 'DESC')->get();

        return view('storie.index', [
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

    public function store(Request $request)
    {
        $storie = new Storie;

        $storie->title = $request->title;
        $storie->synopsis = $request->synopsis;
        $storie->agegroup_id = $request->agegroup;
        $storie->save();

        $storie->users()->attach(Auth::user()->id);

        foreach ($request->genres as $genre) {
            $storie->genres()->attach($genre);
        }

        return redirect('/storie')->with('success_msg', 'História cadastrada com sucesso');
    }

    public function show($id)
    {
        return view('storie.show');
    }


    public function edit($id)
    {
        return view('storie.edit');
    }


    public function update(Request $request, $id)
    {
        return 'Em construção';
    }


    public function destroy($id)
    {
        return 'Em construção';
    }
}
