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
    <h4>Sinopse:</h4>
    <p>{{ $storie->synopsis }}</p>
    <hr>
    <h3>
        Capítulos
    </h3>
@endsection