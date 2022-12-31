<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Traits\Data;

class PermissionSeeder extends Seeder
{
    use Data;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->startDatas(Permission::class, ['commun user', 'moderator', 'admin'], 'permission');
    }

}
