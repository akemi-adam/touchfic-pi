<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Events\CommentEvent;
use Illuminate\Http\Request;
use App\Models\{
    User, Storie
};
use Auth;

class Comment extends Component
{

    public $model, $foreignCollumn, $foreignId, $content, $comments, $editRoute, $publication;

    protected $rules = [
        'content' => 'required',
    ];

    protected $listeners = [
        'listComments' => 'index',
    ];

    public function index()
    {
        $this->comments = $this->model::where($this->foreignCollumn, $this->foreignId)->get();
    }

    public function store()
    {
        if (Auth::check()) {

            $this->validate();
        
            $this->model::create([
                'content' => $this->content,
                $this->foreignCollumn => $this->foreignId,
                'user_id' => Auth::user()->id,
            ]);

            if ($this->foreignCollumn === "post_id") {

                $owner = User::find($this->publication->user_id);

                CommentEvent::dispatch($owner, Auth::user(), $this->publication);

            } else if ($this->foreignCollumn === 'chapter_id') {

                $storieData = DB::table('storie_user')->where('storie_id', $this->publication->storie->id)->where('liked', 0)->get();

                $owner = User::find($storieData[0]->user_id);

                CommentEvent::dispatch($owner, Auth::user(), $this->publication);
            }

        }
    }

    public function delete($id)
    {
        $this->model::where('id', $id)->delete();

        $this->index();
    }

    public function render()
    {
        return view('livewire.comment');
    }

}
