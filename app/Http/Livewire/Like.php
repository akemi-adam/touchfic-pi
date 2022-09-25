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
        if (count(DB::table('storie_user')->where('user_id', Auth::user()->id)->where('storie_id', $this->storieId)->where('liked', 1)->get()) !== 0) {
            return true;
        }
        return false;
    }

    /**
     * Registers in the bank that the user has liked the story, dispenses a StorieLike event, and sets status to true
     * 
     * @return void
     */
    public function enjoy()
    {
        $authorName = User::where('id', $this->authorId)->first(['name']);

        DB::insert('insert into storie_user (storie_id, user_id, liked, author_id, author_name) values (?, ?, ?, ?, ?)', [
            $this->storieId, Auth::user()->id, 1, $this->authorId, $authorName['name']
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
        DB::delete('delete from storie_user where liked = 1 and storie_id = ? and user_id = ?', [
            $this->storieId, Auth::user()->id
        ]);

        Unlike::dispatch(Storie::findOrFail($this->storieId));

        $this->status = false;
    }

    public function render()
    {
        return view('livewire.like');
    }
}
