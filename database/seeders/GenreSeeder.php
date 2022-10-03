<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Genre;
use Data;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Data::startDatas(
            Genre::class, [
                'Aventura', 'Românce', 'Terror', 'Horror', 'Sci-fi', 'Mistério', 'Investigação', 'Drama', 'Suspense', 'Fantasia', 'Distopia'
            ],
            'genre'
        );
    }
    
}
