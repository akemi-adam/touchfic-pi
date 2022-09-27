<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use App\Events\{
    StorieLike, Unlike
};
use Livewire\Component;
use App\Models\Storie;
use App\Models\User;
use Auth;

class Like extends Component
{

    public $storieId;

    public $authorId;

    /**
     * Checks if the story has already been liked by the user
     * 
     * @return bool
     */
    public function status()
    {

        $enjoyed = count(
            DB::table('likes')->where('user_id', Auth::id())->where('storie_id', $this->storieId)->get()
        );

        if ($enjoyed === 0) {
            return false;
        }

        return true;

    }

    /**
     * Registers in the bank that the user has liked the story, dispenses a StorieLike event, and sets status to true
     * 
     * @return void
     */
    public function enjoy()
    {

        DB::table('likes')->insert([
            'storie_id' => $this->storieId, 'user_id' => Auth::id()
        ]);

        StorieLike::dispatch(Auth::user(), Storie::find($this->storieId), User::find($this->authorId));

        $this->status = true;

    }

    /**
     * Remove the like record from the database, dispatch a Unlike event, and set status to false
     * 
     * @return void
     */
    public function unlike()
    {

        DB::table('likes')->where('storie_id', $this->storieId)->where('user_id', Auth::id())->delete();

        Unlike::dispatch(Storie::findOrFail($this->storieId));

        $this->status = false;

    }

    public function render()
    {
        return view('livewire.like');
    }
}
