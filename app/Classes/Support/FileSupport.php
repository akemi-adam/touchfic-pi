<?php

namespace App\Classes\Support;

use App\Models\ {
    Storie, User
};
use Storage;

class FileSupport
{

    /**
     * Check the cover image
     * 
     * @param Illuminate\Http\Request $request
     * @param App\Models\Storie
     */
    public function cover($request, Storie $model)
    {
        $this->imageVerify($request, $model, 'cover', 'default-storie-cover.png', 'storie/cover/');
    }

    /**
     * Checks the avatar image
     * 
     * @param Illuminate\Http\Request $request
     * @param App\Models\User $model
     */
    public function avatar($request, User $model)
    {
        $this->imageVerify($request, $model, 'avatar', 'default-user-avatar.png', 'user/avatar/');
    }

    /**
     * Check the image, then see if it already exists so you can delete the previous avatar and finally encode the image
     * 
     * @param Illuminate\Http\Request $request
     * @param App\Models\Storie | App\Models\User $model
     * @param string $collumn
     * @param string $defaultArchive
     * @param string $path
     */
    public function imageVerify($request, $model, $collumn, $defaultArchive, $path)
    {
        if (!$request->hasFile($collumn) && !$request->file($collumn)->isValid()) {
            return false;
        }

        if ($model->$collumn !== $defaultArchive) {
            $this->deleteOldImage($path, $model->$collumn);
        }

        $this->hashImage($request, $model, $collumn, $path);
    }

    /**
     * Deletes the anti image
     * 
     * @param string $path
     * @param string $name
     * 
     * @return void
     */
    protected function deleteOldImage($path, $name)
    {
        Storage::disk('public')->delete('images/' . $path . $name);
    }

    /**
     * Hash the image, save it in the system and change its respective property in the template
     * 
     * @param Illuminate\Http\Request $request
     * @param App\Models\Storie | App\Models\User $model
     * @param string $collumn
     * 
     * @return void
     */
    protected function hashImage($request, $model, $collumn, $path)
    {
        $newName = $request->file($collumn)->hashName();

        $request->file($collumn)->storeAs('public/images/' . $path, $newName);

        $model->$collumn = $newName;
    }

}
