<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->startDatas(Permission::class, ['commun user', 'moderator', 'admin'], 'permission');
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
