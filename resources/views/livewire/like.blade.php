<div>
    @if (!$this->status())
        <form wire:submit.prevent="enjoy()">
            <button id="enjoy" class="like-button" onclick="incrementDisplay()"><i class="fa-regular fa-heart"></i> Curtir</button>
        </form>
    @else
        <form wire:submit.prevent="unlike()">
            <button id="unlike" class="like-button" onclick="decrementDisplay()"><i class="fa-solid fa-heart"></i> Descurtir</button>
        </form>
    @endif
</div>
