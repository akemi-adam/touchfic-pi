<?php

namespace App\Http\Controllers\Auth;

use App\Models\{
    User, Storie
};
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Auth;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {

        $unlikedStories = array();

        $recommendations = array();

        $likedGenres = DB::table('storie_user')
            ->join('stories', 'stories.id', '=', 'storie_user.storie_id')
            ->join('genre_storie', 'genre_storie.storie_id', '=', 'stories.id')
            ->where('storie_user.user_id', Auth::user()->id)
            ->where('storie_user.liked', 1)
            ->orderBy('genre_storie.genre_id', 'desc')
            ->distinct()
            ->select('genre_storie.genre_id')
            ->get();

        $unlikedStoriesIds = DB::table('storie_user')
            ->where('user_id', '!=', Auth::user()->id)
            ->where('liked', 0)
            ->select('storie_id')
            ->get();

        foreach ($unlikedStoriesIds as $item) {
            $unlikedStories[] = Storie::findOrFail($item->storie_id);
        }

        $limit = 0;

        foreach ($unlikedStories as $unlikedStorie) {

            $qualified = 0;

            foreach ($unlikedStorie->genres as $storieGenre) {

                for ($i=0; $i < count($likedGenres); $i++) { 

                    if ($likedGenres[$i]->genre_id === $storieGenre->id) {
                        $qualified++;        
                    }
                }

            }

            if ($qualified >= 3 && $limit < 5) {
                $recommendations[] = $unlikedStorie;
                $limit++;
            }

        }

        return view('auth.dashboard', [
            'recommendations' => $recommendations
        ]);
    }

}
