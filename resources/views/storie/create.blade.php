@extends('layouts.main')

@section('title', 'Crie um mundo!')

@section('content')
    <h2>
        Criar uma história
    </h2>
    <form action="{{ route('storie.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <label for="title" class="label-tag">Título</label>
        <input type="text" class="input-title" placeholder="Título" name="title" autofocus><br>
        <label for="cover">Capa</label><br>
        <input type="file" name="cover">
        <label for="agegroup" class="label-tag">Faixa etária</label>
        <select name="agegroup">
            @foreach ($agegroups as $agegroup)
                <option value="{{ $agegroup->id }}">{{ $agegroup->agegroup }}</option>
            @endforeach
        </select>
        <label for="synopsis" class="label-tag">Sinopse</label>
        <textarea name="synopsis" cols="90" rows="15" class="desc-textarea" placeholder="Sinopse..."></textarea>
        @foreach ($genres as $genre)
            <label for="{{$genre->genre}}">{{$genre->genre}}</label>
            <input type="checkbox" name="genres[]" value="{{$genre->id}}" id="{{$genre->genre}}">
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