<div>
    <input type="text" wire:model="search" name="search">
    <button wire:click="$emit('listTracks')" type="button">
        Procurar
    </button>
    @if ($listed)
    <select name="track">
        @foreach ($tracks['tracks']['items'] as $track)
            @php
                $trackId = explode(':', $track['uri'])[2];
            @endphp
            <option value="{{ $trackId }}">
                {{ $track['name'] }} por {{ $track['artists'][0]['name'] }}
            </option>
        @endforeach
    </select>
        {{-- @php
            $teste = $tracks['tracks']['items'];
        @endphp --}}
    @endif
    {{-- @foreach ($tracks as $track)
        
    @endforeach --}}
</div>
