<?php

namespace App\Traits;

trait Data
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
    public function startDatas(string $model, array $datas, string $collumn) : void
    {
        if (count($model::all()) === 0) {
        
            foreach ($datas as $data) {

                $model::create([
                    $collumn => $data,
                ]);

            }
        
        }
    }

    /**
     * Searches for and returns an id that does not exist in the model table
     * 
     * @param int $id
     * @param string $model
     * 
     * @return int
     */
    public function noIdExists(int $id, string $model) : int
    {
        if ($model::find($id)) {
            return $this->noIdExists(rand(), $model);
        }

        return $id;
    }

}
