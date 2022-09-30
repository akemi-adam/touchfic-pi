<?php

namespace App\Http\Controllers\Storie;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SearchRequest;
use Illuminate\Http\Request;
use App\Models\Storie;
use App\Models\User;

class SearchController extends Controller
{
    /**
     * Retrieves the stories and users that match what was searched for and returns to a view
     * 
     * @param \Illuminate\Http\SearchRequest $request
     * 
     * @return \Illuminate\View\View
     */
    public function search(SearchRequest $request)
    {
        $stories = Storie::where('title', 'like', "%$request->search%")->get() ?: null;

        $users =  User::where('name', 'like', "%$request->search%")->get() ?: null;

        return view('auth.search', [
            'stories' => $stories,
            'users' => $users,
            'search' => $request->search,
        ]);
    }

}
