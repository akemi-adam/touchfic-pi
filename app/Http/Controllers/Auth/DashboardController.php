<?php

namespace App\Http\Controllers\Auth;

use App\Models\{
    User, Storie
};
use App\Http\Controllers\Controller;
use DB, Auth, StorieSupport;

class DashboardController extends Controller
{
    /**
     * Returns story recommendations to the user based on the genres they read the most
     *
     * @return \Illuminate\View\View
     */
    public function __invoke()
    {
        $likedStories = StorieSupport::likeInfo(Auth::id(), 'user_id', Storie::class, 'storie_id');

        $tannedGenres = array();

        foreach ($likedStories as $storie) {

            foreach ($storie->genres as $genre) {
                $tannedGenres[] = $genre->id;
            }

        }

        $ids =  StorieSupport::untaggedStories($likedStories);

        $untaggedStories = array();

        foreach ($ids as $id) {
            $untaggedStories[] = Storie::findOrFail($id->id);
        }

        $recommendations = array();

        $limit = 0;

        foreach ($untaggedStories as $untaggedStorie) {

            $qualified = 0;
            
            foreach ($untaggedStorie->genres as $genre) {
                

                for ($i = 0; $i < count($tannedGenres); $i++) { 
                    
                    if ($genre->id === $tannedGenres[$i]) {
                        $qualified++;
                    }
    
                }
            }

            if ($qualified >= 2 && $limit < 5) {
                $recommendations[] = $untaggedStorie;
                $limit++;
            }

        }

        return view('auth.dashboard', [
            'recommendations' => $recommendations,
        ]);

    }

}
