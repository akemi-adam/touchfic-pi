@extends('layouts.main')

@section('title', 'Editar história')

@section('content')
    <h2>
        {{ $storie->title }}
    </h2>

    {{-- Error messages --}}
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('storie.update', $storie->id) }}" method="post" enctype="multipart/form-data">
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

        @foreach ($genres as $genre)

            @php
                $listed = false;
            @endphp
            
            @foreach ($storie->genres as $selectGenre)
                @if ($selectGenre->genre === $genre->genre)
                    <label for="{{$genre->genre}}">{{$genre->genre}}</label>
                    <input type="checkbox" name="genres[]" value="{{$genre->id}}" id="{{$genre->genre}}" checked>
                    @php
                        $listed = true;
                    @endphp
                @endif
            @endforeach

            @if (!$listed)
                <label for="{{$genre->genre}}">{{$genre->genre}}</label>
                <input type="checkbox" name="genres[]" value="{{$genre->id}}" id="{{$genre->genre}}">
            @endif

        @endforeach

        <div class="container-submit">
            <div class="submit-story-button">
                <button>
                    Enviar
                </button>
            </div>
        </div>
    </form>
@endsection