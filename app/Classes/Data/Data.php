<?php

namespace App\Classes\Data;

class Data
{

    /**
     * If there is no data, the model informed, initializes the information passed in the second parameter
     * 
     * @param string $model
     * @param array $datas
     * @param string $collumn
     * 
     * @return void
     */
    public function startDatas(string $model, array $datas, string $collumn)
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
