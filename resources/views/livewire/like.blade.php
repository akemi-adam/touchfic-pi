<div>
    @if (!$this->status())
        <form wire:submit.prevent="enjoy()">
            <button id="enjoy" class="like-button" onclick="incrementDisplay()">Curtir</button>
        </form>
    @else
        <form wire:submit.prevent="unlike()">
            <button id="unlike" class="like-button" onclick="decrementDisplay()">Descurtir</button>
        </form>
    @endif
</div>
