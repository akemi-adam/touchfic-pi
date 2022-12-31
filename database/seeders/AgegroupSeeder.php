<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Agegroup;
use App\Traits\Data;

class AgegroupSeeder extends Seeder
{
    use Data;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->startDatas(Agegroup::class, ['Livre', '10', '12', '14', '16', '+18'], 'agegroup');
    } 
}
