@extends('layouts.main')

@section('title', 'História show')

@section('content')
    <h2>
        {{ $storie->title }}
    </h2>
    <img src="/img/storie/cover/{{ $storie->cover }}" class="cover-show"><br>
    <a href="{{ route('user.show', $storie->user_id) }}">{{ $storie->name }}</a><br>
    <span>Faixa etária: {{ $storie->agegroup->agegroup }}</span><br>
    <span>Número de palavras: {{ $storie->numberofwords }}</span><br>
    <span>Gêneros:</span>
    <ul>
        @foreach ($genres as $genre)
            <li style="color:rgb(87, 87, 87)">{{$genre->genre}}</li> 
        @endforeach
    </ul>
    <h4>Sinopse:</h4>
    <p>{{ $storie->synopsis }}</p>
    @if (Auth::user()->id === $storie->user_id)
        <form action="{{ route('storie.edit', $storie->storie_id) }}" method="get">
            <button>
                Editar
            </button>
        </form>
        <form action="{{ route('storie.destroy', $storie->storie_id) }}" method="post">
            @csrf
            @method('delete')
            <button>
                Deletar
            </button>
        </form>
    @endif
    <hr>
    <h3>
        Capítulos
    </h3>
@endsection