<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Agegroup;

class AgegroupSeeder extends Seeder
{
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
