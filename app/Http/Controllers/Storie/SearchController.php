<?php

namespace App\Http\Controllers\Storie;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Storie;
use App\Models\User;

class SearchController extends Controller
{
    /**
     * Retrieves the stories and users that match what was searched for and returns to a view
     * 
     * @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\View\View
     */
    public function search(Request $request)
    {

        $stories = Storie::rightJoin('storie_user', 'stories.id', '=', 'storie_user.storie_id')
                    ->rightJoin('users', 'users.id', '=', 'storie_user.user_id')
                    ->where('storie_user.liked', 0)
                    ->where('title', 'like', "%$request->argument%")
                    ->get() ?: null;

        $users =  User::where('name', 'like', "%$request->argument%")->get() ?: null;

        return view('auth.search', [
            'stories' => $stories,
            'users' => $users,
            'argument' => $request->argument,
        ]);
    }

}
