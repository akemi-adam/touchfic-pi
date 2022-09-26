<?php

namespace App\Classes\Support;

class RequestSupport
{

    /**
     * Checks if the fields of a form have changed, and if so, changes the property of the respective form.
     * 
     * @param Illuminate\Http\Request $request
     * @param mixed $model
     * @param array $fields
     * 
     * @return void
     */
    public function setEditValues($request, $model, array $fields)
    {
        for ($i = 0; $i < count($fields); $i++) {

            $field = $fields[$i];

            $model->$field = is_null($request->$field) ? $model->$field : $request->$field;

        }
    }

}