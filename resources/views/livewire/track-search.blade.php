<div class="spotify-search">
    <p>Selecionar música do <span><i class="fa-brands fa-spotify"></i> Spotify</span> para capítulo (opcional, somente prévia)</p>
    <input type="text" wire:model="search" name="search" placeholder="Pesquise no Spotify...">

    <div class="button-container">
        <button wire:click="$emit('listTracks')" type="button">
            Procurar
        </button>
    </div>
    @if ($listed)
    <select name="track" size="10">
        @foreach ($tracks['tracks']['items'] as $track)
            @php
                $trackId = explode(':', $track['uri'])[2];
            @endphp
            <option value="{{ $trackId }}">
                {{ $track['name'] }} por {{ $track['artists'][0]['name'] }}
            </option>
        @endforeach
    </select>
    @endif
</div>
