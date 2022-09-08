<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ShowNotifications extends Component
{

    public function readNotification($id)
    {
        DB::table('notifications')->where('id', $id)->update(['read_at' => now()]);
    }

    public function removeNotification($id)
    {
        DB::table('notifications')->where('id', $id)->delete();
    }

    public function render()
    {
        return view('livewire.show-notifications');
    }
}
