<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Genre;
use App\Traits\Data;

class GenreSeeder extends Seeder
{
    use Data;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->startDatas(
            Genre::class, [
                'Aventura', 'Românce', 'Terror', 'Horror', 'Sci-fi', 'Mistério', 'Investigação', 'Drama', 'Suspense', 'Fantasia', 'Distopia'
            ],
            'genre'
        );
    }
    
}
