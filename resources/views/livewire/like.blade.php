<div>
    @if (!$this->status())
        <form wire:submit.prevent="enjoy()">
            <button id="enjoy" onclick="incrementDisplay()">Curtir</button>
        </form>
    @else
        <form wire:submit.prevent="unlike()">
            <button id="unlike" onclick="decrementDisplay()">Descurtir</button>
        </form>
    @endif
</div>
