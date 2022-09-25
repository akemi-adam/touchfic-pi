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

    /**
     * Validates the data based on the rules defined in the class, sets listed to true and defines which tracks will receive the tracks filtered by search, with a limit value of 30 tracks
     * 
     * @return void
     */
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
