<?php

namespace App\Classes\Support;

use App\Models\Storie;
use DB;

class StorieSupport  
{
    /**
     * Retrieves which users have liked a story or which stories a user has liked
     * 
     * @param int $id
     * @param string $collumn
     * @param App\Models\User|App\Models\Storie $model
     * @param string $property
     * 
     * @return array
     */
    public function likeInfo(int $id, string $collumn, $model, string $property) : array
    {
        $likesData = DB::table('likes')->where($collumn, $id)->get();

        $array = array();

        foreach ($likesData as $data) {
            $array[] = $model::findOrFail($data->$property);
        }

        return $array;
    }

    /**
     * Returns stories not liked by the user
     * 
     * @param $likedStories
     * 
     * @return App\Models\Storie;
     */
    public function untaggedStories($likedStories)
    {
        $ids = array();

        foreach ($likedStories as $likedStorie) {
            $ids[] = $likedStorie->id;
        }

        $untaggedStories = DB::table('stories')->whereNotIn('id', $ids)->select('id')->get();

        return $untaggedStories;
    }
}
