@extends('layouts.main')

@section('title', 'Histórias')

@section('content')
    @foreach ($stories as $storie)
        <h3>{{ $storie->title  }}</h3>
        <strong>Faixa etária: {{ $storie->agegroup->agegroup }}</strong>
        <strong>Número de palavras: {{ $storie->numberofwords }}</strong>
        {{-- <strong>Número de likes: </strong> --}}
        <p>
            {{ $storie->synopsis }}
        </p>
    @endforeach
@endsection