<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Chapter;
use Spotify;

class TrackSearch extends Component
{

    public $search, $tracks, $listed = false;

    protected $listeners = [
        'listTracks' => 'index',
    ];

    public function index()
    {
        $this->listed = true;

        $this->tracks = Spotify::searchTracks($this->search)->limit(10)->get();
    }

    public function render()
    {
        return view('livewire.track-search');
    }
}
