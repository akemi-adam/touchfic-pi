<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Genre;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->startDatas(Genre::class, ['Aventura', 'Românce', 'Terror', 'Horror', 'Sci-fi', 'Mistério', 'Investigação', 'Drama', 'Suspense', 'Fantasia', 'Distopia'], 'genre');
    }

    private function startDatas($model, $datas, $collumn)
    {
        if (count($model::all()) === 0) {
            foreach ($datas as $data) {
                $model::create([
                    $collumn => $data,
                ]);
            }
        }
    }
    
}
