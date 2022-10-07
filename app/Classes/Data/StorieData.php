<?php

namespace App\Classes\Data;

use App\Models\{
    Genre, Storie, User
};
use Auth;

class StorieData
{
    /**
     * Create a story linked to user and genres
     * 
     * @param int $userNumber
     * @param int $genreNumber
     * 
     * @return Collection
     */
    protected function create($owners, int $genreNumber = 4) : Storie
    {
        $storie = Storie::factory()->hasAttached($owners)
            ->hasAttached(Genre::factory()->count($genreNumber))->create();

        return $storie;
    }

    public function createRandom(int $userNumber = 1, int $genreNumber = 4)
    {
        return $this->create(User::factory()->count($userNumber), $genreNumber);
    }

    public function createOwn(int $genreNumber = 4)
    {
        return $this->create(Auth::user(), $genreNumber);
    }
}
