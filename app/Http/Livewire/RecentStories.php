<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Storie;

class RecentStories extends Component
{
    public function index()
    {
        return Storie::orderBy('updated_at', 'desc')->limit(5)->get();
    }

    public function render()
    {
        return view('livewire.recent-stories');
    }
}
