<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Storie;
use App\Models\User;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $stories = $this->analyzeArgument($request->argument, Storie::class, 'title', true);
        $users = $this->analyzeArgument($request->argument, User::class, 'name');

        return view('auth.search', [
            'stories' => $stories,
            'users' => $users,
        ]);
    }

    private function analyzeArgument($argument, $model, $collumn, $join = false)
    {
        if ($join) {
            return $model::rightJoin('storie_user', 'stories.id', '=', 'storie_user.storie_id')->rightJoin('users', 'users.id', '=', 'storie_user.user_id')->where('storie_user.liked', 0)->where($collumn, 'like', "%$argument%")->get() ?: null;
        }
        return $model::where($collumn, 'like', "%$argument%")->get() ?: null;
    }
}
