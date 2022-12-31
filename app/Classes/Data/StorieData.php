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
     * @param mixed $owners
     * @param int $genreNumber
     * 
     * @return Storie
     */
    protected function create(mixed $owners, int $genreNumber = 4) : Storie
    {
        $storie = Storie::factory()->hasAttached($owners)
            ->hasAttached(Genre::factory()->count($genreNumber))->create();

        return $storie;
    }

    /**
     * Create a story with random authors
     * 
     * @param int $userNumber
     * @param int $genreNumber
     * 
     * @return Storie
     */
    public function createRandom(int $userNumber = 1, int $genreNumber = 4) : Storie
    {
        return $this->create(User::factory()->count($userNumber), $genreNumber);
    }

    /**
     * Creates a story that belongs to the current user
     * 
     * @param int $genreNumber
     * 
     * @return Storie
     */
    public function createOwn(int $genreNumber = 4) : Storie
    {
        return $this->create(Auth::user(), $genreNumber);
    }
}
