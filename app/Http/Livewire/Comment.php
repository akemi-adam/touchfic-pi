<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Events\CommentEvent;
use Illuminate\Http\Request;
use App\Events\DeleteComment;
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

    /**
     * List the comments
     * 
     * @return void
     */
    public function index()
    {
        $this->comments = $this->model::where($this->foreignCollumn, $this->foreignId)->get();
    }

    /**
     * Checks if the user is logged in, validates the form and associates it with either a post or a chapter
     * 
     * @return void
     */
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

    /**
     * Retrieves the comment, undoes its relationships in the database, deletes it, and re-renders the comments
     * 
     * @param int $id
     * 
     * @return void
     */
    public function delete($id)
    {
        $comment = $this->model::findOrFail($id);

        DeleteComment::dispatch($comment);

        $comment->delete();

        $this->index();
    }

    public function render()
    {
        return view('livewire.comment');
    }

}
