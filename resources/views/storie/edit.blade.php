@extends('layouts.main')

@section('title', 'Editar história')

@section('content')
    <h2>
        {{ $storie->title }}
    </h2>
    <form action="{{ route('storie.update', $storie->storie_id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <label for="title" class="label-tag">Titulo</label>
        <input type="text" class="input-title" placeholder="Título" name="title" autofocus value="{{$storie->title}}"><br>
        <select name="agegroup">
            @foreach ($agegroups as $agegroup)
                <option value="{{ $agegroup->id }}">{{ $agegroup->agegroup }}</option>
            @endforeach
        </select><br>
        <label for="cover">Capa</label>
        <img src="{{ asset('storage/images/storie/cover/' . $storie->cover) }}" class="cover-show"><br>
        <input type="file" name="cover"><br>
        <h4>Sinopse:</h4>
        <textarea name="synopsis" cols="90" rows="15" class="desc-textarea" placeholder="Sinopse...">{{ $storie->synopsis }}</textarea>
        @for ($i = 0; $i < count($genres); $i++)
            @php
                $listed = false;
            @endphp
            @for ($j = 0; $j < count($selectsGenres); $j++)
                @if ($genres[$i]->id === $selectsGenres[$j]->genre_id)
                    <label for="{{$genres[$i]->genre}}">{{$genres[$i]->genre}}</label>
                    <input type="checkbox" name="genres[]" value="{{$genres[$i]->id}}" id="{{$genres[$i]->genre}}" checked>
                    @php
                        $listed = true;
                    @endphp
                @endif
            @endfor
            @if (!$listed)
                <label for="{{$genres[$i]->genre}}">{{$genres[$i]->genre}}</label>
                <input type="checkbox" name="genres[]" value="{{$genres[$i]->id}}" id="{{$genres[$i]->genre}}">
            @endif
        @endfor
        {{-- @foreach ($genres as $genre)
            <label for="{{$genre->genre}}">{{$genre->genre}}</label>
            <input type="checkbox" name="genres[]" value="{{$genre->id}}" id="{{$genre->genre}}">
            {{$i = 0}}
            @if ($noSelectedGenres[$i]->id === $genre->id)
                <label for="{{$genre->genre}}">{{$genre->genre}}</label>
                <input type="checkbox" name="genres[]" value="{{$genre->id}}" id="{{$genre->genre}}"> 
            @else
                <label for="{{$genre->genre}}">{{$genre->genre}}</label>
                <input type="checkbox" name="genres[]" value="{{$genre->id}}" id="{{$genre->genre}}" checked> 
            @endif
            {{$i++}}
        @endforeach --}}
        <div class="container-submit">
            <div class="submit-story-button">
                <button>
                    Enviar
                </button>
            </div>
        </div>
    </form>
@endsection