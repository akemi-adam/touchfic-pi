<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facedes\DB;
use Illuminate\Http\Request;
use Auth;

class Comment extends Component
{

    public $model, $foreignCollumn, $foreignId, $content, $comments, $editRoute;

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
