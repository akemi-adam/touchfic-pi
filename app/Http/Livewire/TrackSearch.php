<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Chapter;
use Spotify;

class TrackSearch extends Component
{

    public $search, $tracks, $listed = false;

    protected $rules = [
        'search' => 'required',
    ];

    protected $listeners = [
        'listTracks' => 'index',
    ];

    public function index()
    {
        $this->validate();

        $this->listed = true;

        $this->tracks = Spotify::searchTracks($this->search)->limit(30)->get();
    }

    public function render()
    {
        return view('livewire.track-search');
    }
}
