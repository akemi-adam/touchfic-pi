@extends('layouts.main')

@section('title', 'Histórias')

@section('content')
    @foreach ($stories as $storie)
        <h3><a href="{{  route('storie.show', $storie->storie_id) }}">{{ $storie->title }}</a></h3>
        <img src="/img/storie/cover/{{ $storie->cover }}" class="cover-index">
        <strong>Faixa etária: {{ $storie->agegroup->agegroup }}</strong><br>
        <strong>Número de palavras: {{ $storie->numberofwords }}</strong><br>
        <a href="{{ route('user.show', $storie->user_id) }}">{{$storie->name}}</a>
        {{-- <strong>Número de likes: </strong> --}}
        <p>
            {{ $storie->synopsis }}
        </p>
        <hr>
    @endforeach
@endsection