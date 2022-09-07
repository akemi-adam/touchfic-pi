<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use App\Events\StorieLike;
use Livewire\Component;
use App\Models\Storie;
use App\Models\User;
use Auth;

class Like extends Component
{

    public $storieId;

    public $authorId;

    public function status()
    {
        if (count(DB::table('storie_user')->where('user_id', Auth::user()->id)->where('storie_id', $this->storieId)->where('liked', 1)->get()) !== 0) {
            return true;
        }
        return false;
    }

    public function enjoy()
    {
        DB::insert('insert into storie_user (storie_id, user_id, liked) values (?, ?, ?)', [
            $this->storieId, Auth::user()->id, 1
        ]);

        StorieLike::dispatch(Auth::user(), Storie::find($this->storieId), User::find($this->authorId));

        $this->status = true;
    }

    public function unlike()
    {
        DB::delete('delete from storie_user where liked = 1 and storie_id = ? and user_id = ?', [
            $this->storieId, Auth::user()->id
        ]);

        $this->status = false;
    }

    public function render()
    {
        return view('livewire.like');
    }
}
